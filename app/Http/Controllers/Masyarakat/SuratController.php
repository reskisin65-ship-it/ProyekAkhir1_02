<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\PengajuanSurat;
use App\Helpers\NotifikasiHelper;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class SuratController extends Controller
{
    private const MAX_BERKAS_TOTAL_BYTES = 10485760; // 10 MB

    public function index(Request $request)  // ← Tambahkan Request $request
    {
        $query = PengajuanSurat::where('user_id', Auth::user()->user_id);
        
        // ==============================================
        // FILTER BERDASARKAN STATUS
        // ==============================================
        if ($request->filled('status') && $request->status != 'all') {
            $query->where('status', $request->status);
        }
        
        
        // ==============================================
        // EKSEKUSI QUERY
        // ==============================================
        $pengajuan = $query->orderBy('created_at', 'desc')->paginate(10);
        
        // Kirim data filter ke view untuk menampilkan filter aktif
        $filterStatus = $request->status;
        return view('masyarakat.surat.index', compact('pengajuan', 'filterStatus'));
    }

    public function create()
    {
        $user = Auth::user();
        $dataPenduduk = $user->dataPenduduk;
        return view('masyarakat.surat.create', compact('user', 'dataPenduduk'));
    }

    public function store(Request $request)
    {
        $tanggalLahirMaks = Carbon::now()->subYears(17)->format('Y-m-d');

        $request->validate([
            'jenis_surat' => 'required',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|size:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:' . $tanggalLahirMaks,
            'nomor_telepon' => 'required|max:15',
            'keperluan' => 'required|min:5',
            'keterangan' => 'nullable',
            'berkas_pendukung' => 'nullable|array',
            'berkas_pendukung.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240',
        ], [
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir harus 17 tahun atau lebih.',
            'berkas_pendukung.*.max' => 'Setiap file maksimal 10 MB.',
            'berkas_pendukung.*.mimes' => 'Format file harus JPG, PNG, atau PDF.',
        ]);

        $berkasPaths = $this->processBerkasPendukungUpload($request);

        $pengajuan = PengajuanSurat::create([
            'user_id' => Auth::user()->user_id,
            'jenis_surat' => $request->jenis_surat,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
            'berkas_pendukung' => $berkasPaths ?: null,
            'status' => 'menunggu',
            'tgl_pengajuan' => now(),
        ]);

        NotifikasiHelper::suratBaru(
            Auth::user()->user_id,
            $request->jenis_surat,
            $pengajuan->id_surat,
            Auth::user()->name
        );

        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil dikirim!');
    }

    public function show($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::user()->user_id)->findOrFail($id);
        return view('masyarakat.surat.show', compact('pengajuan'));
    }

    public function edit($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::user()->user_id)
            ->where('status', 'menunggu')
            ->findOrFail($id);

        $existingBerkas = collect($pengajuan->getBerkasPendukungList())
            ->map(function (string $path) {
                $size = Storage::disk('public')->exists($path)
                    ? Storage::disk('public')->size($path)
                    : 0;

                return [
                    'path' => $path,
                    'name' => basename($path),
                    'size' => $size,
                ];
            })
            ->values()
            ->all();

        return view('masyarakat.surat.edit', compact('pengajuan', 'existingBerkas'));
    }

    public function update(Request $request, $id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::user()->user_id)
            ->where('status', 'menunggu')
            ->findOrFail($id);
        
        $tanggalLahirMaks = Carbon::now()->subYears(17)->format('Y-m-d');

        $request->validate([
            'jenis_surat' => 'required',
            'nama_lengkap' => 'required|min:3',
            'nik' => 'required|size:16',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:' . $tanggalLahirMaks,
            'nomor_telepon' => 'required|max:15',
            'keperluan' => 'required|min:5',
            'keterangan' => 'nullable',
            'berkas_pendukung' => 'nullable|array',
            'berkas_pendukung.*' => 'file|mimes:jpg,jpeg,png,pdf|max:10240',
            'berkas_pendukung_keep' => 'nullable|array',
            'berkas_pendukung_keep.*' => 'string',
        ], [
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir harus 17 tahun atau lebih.',
            'berkas_pendukung.*.max' => 'Setiap file maksimal 10 MB.',
            'berkas_pendukung.*.mimes' => 'Format file harus JPG, PNG, atau PDF.',
        ]);

        $keptPaths = $this->resolveKeptBerkasPaths($pengajuan, $request->input('berkas_pendukung_keep', []));
        $berkasPaths = $this->processBerkasPendukungUpload($request, $keptPaths);

        $this->deleteRemovedBerkas($pengajuan->getBerkasPendukungList(), $berkasPaths);

        $pengajuan->update([
            'jenis_surat' => $request->jenis_surat,
            'nama_lengkap' => $request->nama_lengkap,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'nomor_telepon' => $request->nomor_telepon,
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
            'berkas_pendukung' => $berkasPaths ?: null,
        ]);

        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::user()->user_id)
            ->where('status', 'menunggu')
            ->findOrFail($id);
        
        $this->deleteAllBerkas($pengajuan);
        
        $pengajuan->delete();

        return redirect()->route('masyarakat.surat.index')
            ->with('success', 'Pengajuan surat berhasil dibatalkan!');
    }

    public function download($id)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::user()->user_id)->findOrFail($id);
        
        if (!$pengajuan->file_surat || !Storage::disk('public')->exists($pengajuan->file_surat)) {
            return back()->with('error', 'File surat tidak ditemukan!');
        }
        
        return Storage::disk('public')->download($pengajuan->file_surat, 'Surat_' . $pengajuan->jenis_surat . '.pdf');
    }

    public function downloadPendukung($id, $index)
    {
        $pengajuan = PengajuanSurat::where('user_id', Auth::user()->user_id)->findOrFail($id);
        $files = $pengajuan->getBerkasPendukungList();

        if (! isset($files[$index]) || ! Storage::disk('public')->exists($files[$index])) {
            return back()->with('error', 'File pendukung tidak ditemukan!');
        }

        $path = $files[$index];
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filename = 'Pendukung_' . ($index + 1) . ($extension ? '.' . $extension : '');

        return Storage::disk('public')->download($path, $filename);
    }

    private function processBerkasPendukungUpload(Request $request, array $existingPaths = []): array
    {
        $paths = $existingPaths;
        $totalSize = $this->calculateStoredBerkasSize($paths);

        if ($request->hasFile('berkas_pendukung')) {
            foreach ($request->file('berkas_pendukung') as $file) {
                if (! $file) {
                    continue;
                }

                $totalSize += $file->getSize();

                if ($totalSize > self::MAX_BERKAS_TOTAL_BYTES) {
                    throw ValidationException::withMessages([
                        'berkas_pendukung' => 'Total ukuran semua berkas pendukung tidak boleh melebihi 10 MB.',
                    ]);
                }

                $paths[] = $file->store('pendukung_surat', 'public');
            }
        }

        return $paths;
    }

    private function resolveKeptBerkasPaths(PengajuanSurat $pengajuan, array $keepPaths): array
    {
        $allowed = $pengajuan->getBerkasPendukungList();

        return array_values(array_filter($keepPaths, fn ($path) => in_array($path, $allowed, true)));
    }

    private function calculateStoredBerkasSize(array $paths): int
    {
        $total = 0;

        foreach ($paths as $path) {
            if (Storage::disk('public')->exists($path)) {
                $total += Storage::disk('public')->size($path);
            }
        }

        return $total;
    }

    private function deleteRemovedBerkas(array $oldPaths, array $newPaths): void
    {
        foreach ($oldPaths as $path) {
            if (! in_array($path, $newPaths, true) && Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }

    private function deleteAllBerkas(PengajuanSurat $pengajuan): void
    {
        foreach ($pengajuan->getBerkasPendukungList() as $path) {
            if (Storage::disk('public')->exists($path)) {
                Storage::disk('public')->delete($path);
            }
        }
    }
}
