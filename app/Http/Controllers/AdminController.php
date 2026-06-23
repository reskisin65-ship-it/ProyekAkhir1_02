<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Umkm;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\PengajuanSurat;
use App\Models\Aspirasi;
use App\Models\ProfilDesa;
use App\Models\DataPengurus;
use App\Models\DataPenduduk;
use App\Models\PengaturanStatistik;
use App\Models\Role;
use App\Models\Notifikasi;
use App\Helpers\NotifikasiHelper;
use App\Services\SuratGeneratorService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Dashboard Admin
     */
    public function dashboard()
    {
        $totalPenduduk = DataPenduduk::count();
        $totalPengurus = DataPengurus::count();
        $totalBerita = Berita::count();
        $totalGaleri = Galeri::count();
        $totalUmkm = Umkm::count();
        $umkmPending = Umkm::where('status', 'pending')->count();
        $totalSurat = PengajuanSurat::count();
        $suratMenunggu = PengajuanSurat::where('status', 'menunggu')->count();
        $totalAspirasi = Aspirasi::count();
        $aspirasiBaru = Aspirasi::where('status', 'baru')->count();
        
        $pengajuanTerbaru = PengajuanSurat::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        $umkmTerbaru = Umkm::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        $aspirasiTerbaru = Aspirasi::with('user')->orderBy('created_at', 'desc')->limit(5)->get();
        
        return view('admin.dashboard', compact(
            'totalPenduduk', 'totalPengurus', 'totalBerita', 'totalGaleri',
            'totalUmkm', 'umkmPending', 'totalSurat', 'suratMenunggu',
            'totalAspirasi', 'aspirasiBaru', 'pengajuanTerbaru', 
            'umkmTerbaru', 'aspirasiTerbaru'
        ));
    }

    // ==============================================
    // MANAJEMEN ASPIRASI
    // ==============================================

    public function aspirasi()
    {
        $status = request('status', 'all');
        $query = Aspirasi::with('user')->orderBy('created_at', 'desc');
        
        if ($status != 'all') {
            $query->where('status', $status);
        }
        
        $aspirasi = $query->paginate(15);
        
        $statistik = [
            'total' => Aspirasi::count(),
            'baru' => Aspirasi::where('status', 'baru')->count(),
            'diproses' => Aspirasi::where('status', 'diproses')->count(),
            'selesai' => Aspirasi::where('status', 'selesai')->count(),
        ];
        
        return view('admin.aspirasi.index', compact('aspirasi', 'statistik'));
    }

    public function aspirasiRespond(Request $request, $id)
    {
        $request->validate([
            'respon' => 'required|min:5',
        ]);
        
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update([
            'respon_admin' => $request->respon,
            'status' => 'selesai'
        ]);

        NotifikasiHelper::aspirasiDijawab(
            $aspirasi->user_id,
            $aspirasi->judul,
            $aspirasi->id_aspirasi,
            Auth::user()->user_id
        );

        return redirect()->route('admin.aspirasi.index')->with('success', 'Respon berhasil dikirim!');
    }

    public function aspirasiStatus($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        $aspirasi->update(['status' => 'diproses']);

        NotifikasiHelper::aspirasiDiproses(
            $aspirasi->user_id,
            $aspirasi->judul,
            $aspirasi->id_aspirasi,
            Auth::user()->user_id
        );

        return back()->with('success', 'Status aspirasi diperbarui!');
    }

    public function aspirasiShow($id)
    {
        $aspirasi = Aspirasi::with('user')->findOrFail($id);
        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    public function aspirasiDestroy($id)
    {
        $aspirasi = Aspirasi::findOrFail($id);
        
        if ($aspirasi->lampiran && Storage::disk('public')->exists($aspirasi->lampiran)) {
            Storage::disk('public')->delete($aspirasi->lampiran);
        }
        
        $aspirasi->delete();
        
        return back()->with('success', 'Aspirasi berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN BERITA
    // ==============================================

    public function berita()
    {
        $beritas = Berita::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.berita.index', compact('beritas'));
    }

    public function beritaCreate()
    {
        return view('admin.berita.create');
    }

    public function beritaStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:5',
            'kategori' => 'required|in:berita,pengumuman,kegiatan',
            'isi_berita' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_publikasi' => 'required|date',
            'status' => 'required|in:publish,draft',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('berita', 'public');
        }

        Berita::create([
            'user_id' => Auth::user()->user_id,
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'ringkasan' => Str::limit($request->isi_berita, 150),
            'isi_berita' => $request->isi_berita,
            'foto' => $fotoPath,
            'status' => $request->status ?? 'publish',
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'slug' => Str::slug($request->judul) . '-' . time(),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan!');
    }

    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|min:5',
            'kategori' => 'required|in:berita,pengumuman,kegiatan',
            'isi_berita' => 'required|min:10',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'tanggal_publikasi' => 'required|date',
            'status' => 'required|in:publish,draft',
        ]);

        $fotoPath = $berita->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('berita', 'public');
        }

        $berita->update([
            'judul' => $request->judul,
            'kategori' => $request->kategori,
            'ringkasan' => Str::limit($request->isi_berita, 150),
            'isi_berita' => $request->isi_berita,
            'foto' => $fotoPath,
            'status' => $request->status ?? 'publish',
            'tanggal_publikasi' => $request->tanggal_publikasi,
            'slug' => Str::slug($request->judul) . '-' . time(),
        ]);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diperbarui!');
    }

    public function beritaDestroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        if ($berita->foto && Storage::disk('public')->exists($berita->foto)) {
            Storage::disk('public')->delete($berita->foto);
        }
        
        $berita->delete();
        
        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN GALERI
    // ==============================================

    public function galeri(Request $request)
    {
        $kategori = $request->query('kategori');
        $allowedKategori = ['kegiatan', 'pembangunan', 'budaya', 'wisata', 'umkm'];

        $query = Galeri::orderBy('created_at', 'desc');
        if ($kategori && in_array($kategori, $allowedKategori)) {
            $query->where('kategori', $kategori);
        }

        $galeris = $query->paginate(12)->appends($request->query());

        $totalGaleri = Galeri::count();
        $galeriKegiatan = Galeri::where('kategori', 'kegiatan')->count();
        $galeriPembangunan = Galeri::where('kategori', 'pembangunan')->count();
        $galeriBudaya = Galeri::where('kategori', 'budaya')->count();
        $galeriWisata = Galeri::where('kategori', 'wisata')->count();
        $galeriUmkm = Galeri::where('kategori', 'umkm')->count();

        return view('admin.galeri.index', compact(
            'galeris',
            'kategori',
            'totalGaleri',
            'galeriKegiatan',
            'galeriPembangunan',
            'galeriBudaya',
            'galeriWisata',
            'galeriUmkm'
        ));
    }

    public function galeriCreate()
    {
        return view('admin.galeri.create');
    }

    public function galeriStore(Request $request)
    {
        $request->validate([
            'judul' => 'required|min:3',
            'kategori' => 'required',
            'fotos' => 'required|array',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'nullable|string|max:2000',
        ]);

        $galeri = Galeri::create([
            'user_id' => Auth::id(),
            'judul_galeri' => $request->judul,
            'gambar_galeri' => '', // temporary
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $index => $foto) {
                $gambarPath = $foto->store('galeri', 'public');
                if ($index === 0) {
                    $galeri->update(['gambar_galeri' => $gambarPath]);
                }
                $galeri->fotos()->create(['foto_path' => $gambarPath]);
            }
        }

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri dan foto berhasil ditambahkan!');
    }


    public function galeriShow($id)
    {
        $galeri = Galeri::findOrFail($id);
        return view('admin.galeri.show', compact('galeri'));
    }

    public function galeriEdit($id)
    {
        $galeri = Galeri::with('fotos')->findOrFail($id);
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function galeriUpdate(Request $request, $id)
    {
        $galeri = Galeri::findOrFail($id);
        
        $request->validate([
            'judul' => 'required|min:3',
            'kategori' => 'required',
            'fotos' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
            'deleted_fotos' => 'nullable|string',
            'replace_fotos' => 'nullable|array',
            'replace_fotos.*' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = [
            'judul_galeri' => $request->judul,
            'kategori' => $request->kategori,
            'deskripsi' => $request->deskripsi,
        ];

        // 1. Process deleted photos
        if ($request->filled('deleted_fotos')) {
            $deletedIds = explode(',', $request->deleted_fotos);
            foreach ($deletedIds as $fotoId) {
                $foto = $galeri->fotos()->find($fotoId);
                if ($foto) {
                    if (Storage::disk('public')->exists($foto->foto_path)) {
                        Storage::disk('public')->delete($foto->foto_path);
                    }
                    $foto->delete();
                }
            }
        }

        // 2. Process replaced photos
        if ($request->hasFile('replace_fotos')) {
            foreach ($request->file('replace_fotos') as $fotoId => $file) {
                $foto = $galeri->fotos()->find($fotoId);
                if ($foto) {
                    // Delete old file
                    if (Storage::disk('public')->exists($foto->foto_path)) {
                        Storage::disk('public')->delete($foto->foto_path);
                    }
                    // Store new file
                    $foto->update(['foto_path' => $file->store('galeri', 'public')]);
                }
            }
        }

        // 3. Process newly appended photos
        if ($request->hasFile('fotos')) {
            foreach ($request->file('fotos') as $foto) {
                $gambarPath = $foto->store('galeri', 'public');
                $galeri->fotos()->create(['foto_path' => $gambarPath]);
            }
        }

        // 4. Update the main 'gambar_galeri' column if necessary
        $firstFoto = $galeri->fotos()->first();
        $data['gambar_galeri'] = $firstFoto ? $firstFoto->foto_path : '';
        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
            ->with('success', 'Galeri berhasil diperbarui!');
    }

    public function galeriDestroy($id)
    {
        $galeri = Galeri::findOrFail($id);
        
        if ($galeri->fotos) {
            foreach ($galeri->fotos as $foto) {
                if (Storage::disk('public')->exists($foto->foto_path)) {
                    Storage::disk('public')->delete($foto->foto_path);
                }
            }
        }
        
        if ($galeri->gambar_galeri && Storage::disk('public')->exists($galeri->gambar_galeri)) {
            // Also check the main gambar_galeri just in case
            Storage::disk('public')->delete($galeri->gambar_galeri);
        }
        
        $galeri->delete();
        
        return redirect()->route('admin.galeri.index')
            ->with('success', 'Foto berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN UMKM
    // ==============================================

    public function umkm()
    {
        // Hitung statistik dari SEMUA UMKM (tanpa filter)
        $statistik = [
            'total' => Umkm::count(),
            'pending' => Umkm::where('status', 'pending')->count(),
            'approved' => Umkm::where('status', 'approved')->count(),
            'rejected' => Umkm::where('status', 'rejected')->count(),
        ];
        
        $status = request('status', 'all');
        
        $query = Umkm::with('user')->orderBy('created_at', 'desc');
        
        // Filter berdasarkan status jika bukan 'all'
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $umkms = $query->paginate(15);
        
        return view('admin.umkm.index', compact('umkms', 'statistik'));
    }

    public function umkmApprove($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['status' => 'approved']);

        $roleUmkm = Role::where('nama_role', 'umkm')->first();
        if ($roleUmkm && !$umkm->user->isAdmin()) {
            $umkm->user->update(['id_role' => $roleUmkm->id_role]);
        }

        NotifikasiHelper::umkmDisetujui(
            $umkm->user_id,
            $umkm->nama_usaha,
            $umkm->id_umkm,
            Auth::user()->user_id
        );

        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM berhasil disetujui!');
    }

    public function umkmReject(Request $request, $id)
    {
        $request->validate([
            'alasan_penolakan' => 'required|string|min:3|max:500'
        ]);

        $umkm = Umkm::findOrFail($id);
        $umkm->update([
            'status' => 'rejected',
            'alasan_penolakan' => $request->alasan_penolakan
        ]);

        NotifikasiHelper::umkmDitolak(
            $umkm->user_id,
            $umkm->nama_usaha,
            $umkm->id_umkm,
            $request->alasan_penolakan,
            Auth::user()->user_id
        );

        return redirect()->route('admin.umkm.index')
            ->with('success', 'UMKM ditolak dengan alasan diberikan!');
    }

    /**
 * Hapus UMKM (Admin)
 */
public function umkmDestroy($id)
{
    $umkm = Umkm::findOrFail($id);
    
    // Hapus logo jika ada
    if ($umkm->logo && Storage::disk('public')->exists($umkm->logo)) {
        Storage::disk('public')->delete($umkm->logo);
    }
    
    // Hapus bukti usaha jika ada
    if ($umkm->bukti_usaha && Storage::disk('public')->exists($umkm->bukti_usaha)) {
        Storage::disk('public')->delete($umkm->bukti_usaha);
    }
    
    // PERBAIKAN: Cek apakah relasi produk ada sebelum melakukan foreach
    if (method_exists($umkm, 'produk') && $umkm->produk) {
        foreach ($umkm->produk as $produk) {
            if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $produk->delete();
        }
    }
    
    $umkm->delete();
    
    return redirect()->route('admin.umkm.index')
        ->with('success', 'UMKM berhasil dihapus!');
}

    // ==============================================
    // MANAJEMEN PENGAJUAN SURAT
    // ==============================================

    public function pengajuanSurat()
    {
        $status = request('status', 'all');
        $query = PengajuanSurat::with('user')->orderBy('created_at', 'desc');
        
        if ($status != 'all') {
            $query->where('status', $status);
        }
        
        $pengajuan = $query->paginate(15);
        
        $statistik = [
            'total' => PengajuanSurat::count(),
            'menunggu' => PengajuanSurat::where('status', 'menunggu')->count(),
            'diproses' => PengajuanSurat::where('status', 'diproses')->count(),
            'selesai' => PengajuanSurat::where('status', 'selesai')->count(),
            'ditolak' => PengajuanSurat::where('status', 'ditolak')->count(),
        ];
        
        return view('admin.pengajuan-surat.index', compact('pengajuan', 'statistik'));
    }

    public function pengajuanSuratShow($id)
    {
        $pengajuan = PengajuanSurat::with('user')->findOrFail($id);
        return view('admin.pengajuan-surat.show', compact('pengajuan'));
    }

    public function pengajuanSuratApprove($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update(['status' => 'diproses']);

        try {
            app(SuratGeneratorService::class)->generate($pengajuan->fresh());
            $message = 'Pengajuan surat diterima, sedang diproses, dan draft surat otomatis dibuat!';
        } catch (\Throwable $e) {
            report($e);
            $message = 'Pengajuan surat diterima dan sedang diproses, namun draft surat gagal dibuat. Silakan generate ulang.';
        }

        NotifikasiHelper::suratDiproses(
            $pengajuan->user_id,
            $pengajuan->jenis_surat,
            $pengajuan->id_surat,
            Auth::user()->user_id
        );

        return back()->with('success', $message);
    }

    public function pengajuanSuratComplete(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'required|file|mimes:pdf|max:2048',
        ]);
        
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        $filePath = $request->file('file_surat')->store('surat_selesai', 'public');
        
        $pengajuan->update([
            'status' => 'selesai',
            'file_surat' => $filePath,
        ]);

        NotifikasiHelper::suratSelesai(
            $pengajuan->user_id,
            $pengajuan->jenis_surat,
            $pengajuan->id_surat,
            Auth::user()->user_id
        );

        return redirect()->route('admin.pengajuan-surat.index')
            ->with('success', 'Surat selesai dan telah diunggah!');
    }

    public function pengajuanSuratReject(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'required|min:5',
        ]);
        
        $pengajuan = PengajuanSurat::findOrFail($id);
        $pengajuan->update([
            'status' => 'ditolak',
            'catatan_penolakan' => $request->catatan,
        ]);

        NotifikasiHelper::suratDitolak(
            $pengajuan->user_id,
            $pengajuan->jenis_surat,
            $pengajuan->id_surat,
            $request->catatan,
            Auth::user()->user_id
        );

        return back()->with('success', 'Pengajuan surat ditolak!');
    }

    public function pengajuanSuratDestroy($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        if ($pengajuan->hasBerkasPendukung()) {
            foreach ($pengajuan->getBerkasPendukungList() as $path) {
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }
        }
        if ($pengajuan->file_surat && Storage::disk('public')->exists($pengajuan->file_surat)) {
            Storage::disk('public')->delete($pengajuan->file_surat);
        }
        if ($pengajuan->file_surat_draft && Storage::disk('public')->exists($pengajuan->file_surat_draft)) {
            Storage::disk('public')->delete($pengajuan->file_surat_draft);
        }
        
        $pengajuan->delete();
        
        return redirect()->route('admin.pengajuan-surat.index')
            ->with('success', 'Pengajuan surat berhasil dihapus!');
    }

    public function pengajuanSuratDownload($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        
        if (!$pengajuan->file_surat || !Storage::disk('public')->exists($pengajuan->file_surat)) {
            return back()->with('error', 'File surat tidak ditemukan!');
        }
        
        return Storage::disk('public')->download($pengajuan->file_surat, 'Surat_' . $pengajuan->jenis_surat . '.pdf');
    }

    public function pengajuanSuratDownloadDraft($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        if (!$pengajuan->file_surat_draft || !Storage::disk('public')->exists($pengajuan->file_surat_draft)) {
            return back()->with('error', 'Draft surat belum tersedia!');
        }

        $filename = 'Draft_' . str_replace(' ', '_', $pengajuan->jenis_surat) . '.pdf';
        return Storage::disk('public')->download($pengajuan->file_surat_draft, $filename);
    }

    public function pengajuanSuratRegenerateDraft($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        if ($pengajuan->status !== 'diproses') {
            return back()->with('error', 'Draft surat hanya dapat dibuat ulang saat status diproses.');
        }

        try {
            app(SuratGeneratorService::class)->generate($pengajuan);
            return back()->with('success', 'Draft surat berhasil dibuat ulang!');
        } catch (\Throwable $e) {
            report($e);
            return back()->with('error', 'Gagal membuat ulang draft surat: ' . $e->getMessage());
        }
    }

    public function pengajuanSuratDownloadPendukung($id, $index = 0)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);
        $files = $pengajuan->getBerkasPendukungList();

        if (! isset($files[$index]) || ! Storage::disk('public')->exists($files[$index])) {
            return back()->with('error', 'File pendukung tidak ditemukan!');
        }

        $path = $files[$index];
        $extension = pathinfo($path, PATHINFO_EXTENSION);
        $filename = 'Pendukung_' . ($index + 1) . '_' . str_replace(' ', '_', $pengajuan->jenis_surat) . ($extension ? '.' . $extension : '');

        return Storage::disk('public')->download($path, $filename);
    }

    // ==============================================
    // MANAJEMEN DATA PENDUDUK
    // ==============================================

    public function penduduk(Request $request)
    {
        $query = DataPenduduk::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_lengkap', 'like', "%{$search}%")
                  ->orWhere('nik', 'like', "%{$search}%");
            });
        }

        if ($request->filled('jenis_kelamin')) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->filled('status_perkawinan')) {
            $query->where('status_perkawinan', $request->status_perkawinan);
        }

        if ($request->filled('pendidikan')) {
            $query->where('pendidikan', $request->pendidikan);
        }

        if ($request->filled('pekerjaan')) {
            $query->where('pekerjaan', $request->pekerjaan);
        }

        if ($request->filled('agama')) {
            $query->where('agama', $request->agama);
        }

        if ($request->filled('status_keluarga')) {
            $query->where('status_keluarga', $request->status_keluarga);
        }

        if ($request->filled('usia')) {
            $now = \Carbon\Carbon::now();
            if ($request->usia == 'anak') {
                $query->where('tanggal_lahir', '>', $now->copy()->subYears(17)->format('Y-m-d'));
            } elseif ($request->usia == 'pemuda') {
                $query->whereBetween('tanggal_lahir', [$now->copy()->subYears(30)->format('Y-m-d'), $now->copy()->subYears(17)->format('Y-m-d')]);
            } elseif ($request->usia == 'dewasa') {
                $query->whereBetween('tanggal_lahir', [$now->copy()->subYears(55)->format('Y-m-d'), $now->copy()->subYears(30)->format('Y-m-d')]);
            } elseif ($request->usia == 'lansia') {
                $query->where('tanggal_lahir', '<=', $now->copy()->subYears(55)->format('Y-m-d'));
            }
        }

        $penduduk = $query->orderBy('created_at', 'desc')->paginate(20)->withQueryString();
        
        // Statistics
        $totalPenduduk = DataPenduduk::count();
        $totalLaki = DataPenduduk::where('jenis_kelamin', 'L')->count();
        $totalPerempuan = DataPenduduk::where('jenis_kelamin', 'P')->count();
        $totalKk = DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count();
        $totalIstri = DataPenduduk::where('status_keluarga', 'Istri')->count();
        $totalAnak = DataPenduduk::where('status_keluarga', 'Anak')->count();

        // Usia
        $now = \Carbon\Carbon::now();
        $usiaAnak = DataPenduduk::where('tanggal_lahir', '>', $now->copy()->subYears(17)->format('Y-m-d'))->count();
        $usiaPemuda = DataPenduduk::whereBetween('tanggal_lahir', [$now->copy()->subYears(30)->format('Y-m-d'), $now->copy()->subYears(17)->format('Y-m-d')])->count();
        $usiaDewasa = DataPenduduk::whereBetween('tanggal_lahir', [$now->copy()->subYears(55)->format('Y-m-d'), $now->copy()->subYears(30)->format('Y-m-d')])->count();
        $usiaLansia = DataPenduduk::where('tanggal_lahir', '<=', $now->copy()->subYears(55)->format('Y-m-d'))->count();

        // Agama
        $agamaStats = DataPenduduk::selectRaw('agama, count(*) as total')->groupBy('agama')->pluck('total', 'agama')->toArray();

        // Status Perkawinan
        $kawinStats = DataPenduduk::selectRaw('status_perkawinan, count(*) as total')->groupBy('status_perkawinan')->pluck('total', 'status_perkawinan')->toArray();

        // Pendidikan
        $pendidikanStats = DataPenduduk::selectRaw('pendidikan, count(*) as total')->groupBy('pendidikan')->pluck('total', 'pendidikan')->toArray();

        // Pekerjaan
        $pekerjaanStats = DataPenduduk::selectRaw('pekerjaan, count(*) as total')->groupBy('pekerjaan')->orderByDesc('total')->pluck('total', 'pekerjaan')->toArray();

        return view('admin.penduduk.index', compact(
            'penduduk', 'totalPenduduk', 'totalLaki', 'totalPerempuan',
            'totalKk', 'totalIstri', 'totalAnak',
            'usiaAnak', 'usiaPemuda', 'usiaDewasa', 'usiaLansia',
            'agamaStats', 'kawinStats', 'pendidikanStats', 'pekerjaanStats'
        ));
    }

    public function pendudukCreate()
    {
        $roleMasyarakat = Role::where('nama_role', 'masyarakat')->first();
        $users = User::when($roleMasyarakat, function($query) use ($roleMasyarakat) {
            return $query->where('id_role', $roleMasyarakat->id_role);
        })->get();
        
        return view('admin.penduduk.create', compact('users'));
    }

    public function pendudukStore(Request $request)
    {
        $tanggalLahirMaks = Carbon::now()->subYears(17)->format('Y-m-d');

        $request->validate([
            'nik' => 'required|size:16|unique:data_penduduk,nik',
            'no_kk' => 'required|size:16',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:' . $tanggalLahirMaks,
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => [
                'required',
                Rule::in(['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']),
            ],
            'alamat' => 'required',
            'kelurahan_desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'status_keluarga' => [
                'required',
                'string',
                'max:30',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->status_perkawinan === 'Belum Kawin' && in_array($value, ['Istri', 'Kepala Keluarga'])) {
                        $fail('Status keluarga Istri atau Kepala Keluarga tidak boleh untuk penduduk yang belum kawin.');
                    }
                    if ($request->jenis_kelamin === 'L' && $value === 'Istri') {
                        $fail('Penduduk laki-laki tidak boleh memiliki status keluarga Istri.');
                    }
                    if ($request->jenis_kelamin === 'P' && $value === 'Kepala Keluarga') {
                        $fail('Penduduk perempuan tidak boleh memiliki status keluarga Kepala Keluarga.');
                    }
                },
            ],
        ], [
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir harus 17 tahun atau lebih.',
        ]);

        DataPenduduk::create(array_merge($request->all(), ['rt_rw' => '']));

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil ditambahkan!');
    }

    public function pendudukEdit($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        $roleMasyarakat = Role::where('nama_role', 'masyarakat')->first();
        $users = User::when($roleMasyarakat, function($query) use ($roleMasyarakat) {
            return $query->where('id_role', $roleMasyarakat->id_role);
        })->get();
        
        return view('admin.penduduk.edit', compact('penduduk', 'users'));
    }

    public function pendudukShow($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        
        // Find family members if they have a no_kk
        $keluarga = collect();
        if (!empty($penduduk->no_kk)) {
            $anggota = DataPenduduk::where('no_kk', $penduduk->no_kk)->get();
            $keluarga = $anggota->sortBy(function ($m) {
                $status = strtolower($m->status_keluarga);
                $order = 4;
                if ($status === 'kepala keluarga') $order = 1;
                elseif ($status === 'istri') $order = 2;
                elseif ($status === 'anak') $order = 3;
                
                return $order . '_' . $m->tanggal_lahir;
            })->values();
        }

        return view('admin.penduduk.show', compact('penduduk', 'keluarga'));
    }

    public function pendudukUpdate(Request $request, $id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        
        $tanggalLahirMaks = Carbon::now()->subYears(17)->format('Y-m-d');

        $request->validate([
            'nik' => 'required|size:16|unique:data_penduduk,nik,' . $id . ',id_penduduk',
            'no_kk' => 'required|size:16',
            'nama_lengkap' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before_or_equal:' . $tanggalLahirMaks,
            'agama' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'status_perkawinan' => [
                'required',
                Rule::in(['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati']),
            ],
            'alamat' => 'required',
            'kelurahan_desa' => 'required',
            'kecamatan' => 'required',
            'kabupaten_kota' => 'required',
            'provinsi' => 'required',
            'status_keluarga' => [
                'required',
                'string',
                'max:30',
                function ($attribute, $value, $fail) use ($request) {
                    if ($request->status_perkawinan === 'Belum Kawin' && in_array($value, ['Istri', 'Kepala Keluarga'])) {
                        $fail('Status keluarga Istri atau Kepala Keluarga tidak boleh untuk penduduk yang belum kawin.');
                    }
                    if ($request->jenis_kelamin === 'L' && $value === 'Istri') {
                        $fail('Penduduk laki-laki tidak boleh memiliki status keluarga Istri.');
                    }
                    if ($request->jenis_kelamin === 'P' && $value === 'Kepala Keluarga') {
                        $fail('Penduduk perempuan tidak boleh memiliki status keluarga Kepala Keluarga.');
                    }
                },
            ],
        ], [
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir harus 17 tahun atau lebih.',
        ]);

        $penduduk->update($request->except('rt_rw'));

        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil diperbarui!');
    }

    public function pendudukDestroy($id)
    {
        $penduduk = DataPenduduk::findOrFail($id);
        $penduduk->delete();
        
        return redirect()->route('admin.penduduk.index')
            ->with('success', 'Data penduduk berhasil dihapus!');
    }

    public function keluargaIndex(Request $request)
    {
        $search = $request->input('search');

        if ($search) {
            $matchedKkNumbers = DataPenduduk::where('nama_lengkap', 'LIKE', "%{$search}%")
                ->orWhere('nik', 'LIKE', "%{$search}%")
                ->orWhere('no_kk', 'LIKE', "%{$search}%")
                ->orWhere('alamat', 'LIKE', "%{$search}%")
                ->pluck('no_kk')
                ->filter()
                ->unique()
                ->toArray();

            if (empty($matchedKkNumbers)) {
                $kkPaginator = DataPenduduk::whereRaw('1 = 0')->paginate(9);
            } else {
                $kkPaginator = DataPenduduk::whereIn('no_kk', $matchedKkNumbers)
                    ->whereNotNull('no_kk')
                    ->where('no_kk', '!=', '')
                    ->select('no_kk')
                    ->groupBy('no_kk')
                    ->paginate(9);
            }
        } else {
            $kkPaginator = DataPenduduk::whereNotNull('no_kk')
                ->where('no_kk', '!=', '')
                ->select('no_kk')
                ->groupBy('no_kk')
                ->paginate(9);
        }

        $kkOnPage = $kkPaginator->pluck('no_kk')->toArray();

        $members = DataPenduduk::whereIn('no_kk', $kkOnPage)->get();

        $grouped = $members->groupBy('no_kk');

        $families = [];
        foreach ($grouped as $noKk => $familyMembers) {
            $head = $familyMembers->first(function ($m) {
                return strtolower($m->status_keluarga) === 'kepala keluarga';
            });

            if (!$head) {
                $head = $familyMembers->first();
            }

            $sortedMembers = $familyMembers->sortBy(function ($m) {
                $status = strtolower($m->status_keluarga);
                $order = 4;
                if ($status === 'kepala keluarga') $order = 1;
                elseif ($status === 'istri') $order = 2;
                elseif ($status === 'anak') $order = 3;
                
                return $order . '_' . $m->tanggal_lahir;
            })->values();

            $families[] = [
                'no_kk' => $noKk,
                'head_name' => $head ? $head->nama_lengkap : 'Tidak Diketahui',
                'alamat' => $head ? $head->alamat : ($familyMembers->first() ? $familyMembers->first()->alamat : '-'),
                'members' => $sortedMembers,
            ];
        }

        return view('admin.keluarga.index', compact('families', 'kkPaginator', 'search'));
    }

    public function keluargaShow($no_kk)
    {
        $familyMembers = DataPenduduk::where('no_kk', $no_kk)->get();

        if ($familyMembers->isEmpty()) {
            return redirect()->route('admin.keluarga.index')->with('error', 'Data Keluarga tidak ditemukan.');
        }

        $head = $familyMembers->first(function ($m) {
            return strtolower($m->status_keluarga) === 'kepala keluarga';
        });

        if (!$head) {
            $head = $familyMembers->first();
        }

        $sortedMembers = $familyMembers->sortBy(function ($m) {
            $status = strtolower($m->status_keluarga);
            if ($status === 'kepala keluarga') return 1;
            if ($status === 'istri') return 2;
            if ($status === 'anak') return 3;
            return 4;
        })->values();

        return view('admin.keluarga.show', compact('no_kk', 'head', 'sortedMembers'));
    }

    // ==============================================
    // MANAJEMEN DATA PENGURUS (APARATUR DESA)
    // ==============================================

    public function pengurus()
    {
        $pengurus = DataPengurus::orderBy('id_pengurus', 'asc')->paginate(15);
        return view('admin.pengurus.index', compact('pengurus'));
    }

    public function pengurusCreate()
    {
        return view('admin.pengurus.create');
    }

    public function pengurusStore(Request $request)
    {
        $request->validate([
            'nama_pengurus' => 'required|min:3|max:100',
            'jabatan' => 'required|min:3|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('pengurus', 'public');
        }

        DataPengurus::create([
            'nama_pengurus' => $request->nama_pengurus,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil ditambahkan!');
    }

    public function pengurusEdit($id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        return view('admin.pengurus.edit', compact('pengurus'));
    }

    public function pengurusUpdate(Request $request, $id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        
        $request->validate([
            'nama_pengurus' => 'required|min:3|max:100',
            'jabatan' => 'required|min:3|max:100',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = $pengurus->foto;
        if ($request->hasFile('foto')) {
            if ($fotoPath && Storage::disk('public')->exists($fotoPath)) {
                Storage::disk('public')->delete($fotoPath);
            }
            $fotoPath = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update([
            'nama_pengurus' => $request->nama_pengurus,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil diperbarui!');
    }

    public function pengurusDestroy($id)
    {
        $pengurus = DataPengurus::findOrFail($id);
        
        if ($pengurus->foto && Storage::disk('public')->exists($pengurus->foto)) {
            Storage::disk('public')->delete($pengurus->foto);
        }
        
        $pengurus->delete();
        
        return redirect()->route('admin.pengurus.index')
            ->with('success', 'Pengurus berhasil dihapus!');
    }

    // ==============================================
    // MANAJEMEN PROFIL DESA
    // ==============================================

    public function profilDesa()
    {
        $profil = ProfilDesa::first();
        return view('admin.profil-desa.index', compact('profil'));
    }

    public function updateProfilDesa(Request $request)
    {
        $profil = ProfilDesa::first();
        
        $request->validate([
            'sejarah' => 'required',
            'visi' => 'required',
            'misi' => 'required',
        ]);

        if ($profil) {
            $profil->update(array_merge($request->all(), ['user_id' => Auth::id()]));
        } else {
            ProfilDesa::create(array_merge($request->all(), ['user_id' => Auth::id()]));
        }

        return redirect()->route('admin.profil-desa.index')
            ->with('success', 'Profil desa berhasil diperbarui!');
    }

    // ==============================================
    // MANAJEMEN STATISTIK
    // ==============================================

    public function statistik()
    {
        $statistik = [
            // Kependudukan
            'total_penduduk'       => DataPenduduk::count(),
            'penduduk_pria'        => DataPenduduk::where('jenis_kelamin', 'L')->count(),
            'penduduk_wanita'      => DataPenduduk::where('jenis_kelamin', 'P')->count(),
            'total_kk'             => DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count(),
            // Kelompok Umur
            'kelompok_umur_0_14'   => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count(),
            'kelompok_umur_15_29'  => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count(),
            'kelompok_umur_30_59'  => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count(),
            'kelompok_umur_60'     => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count(),
            // UMKM
            'total_umkm'           => Umkm::count(),
            'umkm_approved'        => Umkm::where('status', 'approved')->count(),
            'umkm_pending'         => Umkm::where('status', 'pending')->count(),
            'umkm_rejected'        => Umkm::where('status', 'rejected')->count(),
            // Pengajuan Surat
            'total_surat'          => PengajuanSurat::count(),
            'surat_menunggu'       => PengajuanSurat::where('status', 'menunggu')->count(),
            'surat_diproses'       => PengajuanSurat::where('status', 'diproses')->count(),
            'surat_selesai'        => PengajuanSurat::where('status', 'selesai')->count(),
            'surat_ditolak'        => PengajuanSurat::where('status', 'ditolak')->count(),
            // Aspirasi
            'total_aspirasi'       => Aspirasi::count(),
            'aspirasi_baru'        => Aspirasi::where('status', 'baru')->count(),
            'aspirasi_diproses'    => Aspirasi::where('status', 'diproses')->count(),
            'aspirasi_selesai'     => Aspirasi::where('status', 'selesai')->count(),
            // Konten & Perangkat
            'total_berita'         => Berita::count(),
            'total_pengurus'       => DataPengurus::count(),
            'total_galeri'         => Galeri::count(),
        ];

        return view('admin.statistik.index', compact('statistik'));
    }

    public function statistikKelola()
    {
        $realtime = [
            'total_penduduk' => DataPenduduk::count(),
            'laki_laki' => DataPenduduk::where('jenis_kelamin', 'L')->count(),
            'perempuan' => DataPenduduk::where('jenis_kelamin', 'P')->count(),
            'kepala_keluarga' => DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count(),
            'kelompok_umur_0_14' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count(),
            'kelompok_umur_15_29' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count(),
            'kelompok_umur_30_59' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count(),
            'kelompok_umur_60' => DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count(),
            'total_umkm' => Umkm::count(),
            'umkm_aktif' => Umkm::where('status', 'approved')->count(),
            'total_surat' => PengajuanSurat::count(),
            'total_aspirasi' => Aspirasi::count(),
            'total_berita' => Berita::count(),
        ];
        
        $pengaturan = PengaturanStatistik::all()->keyBy('key');
        
        return view('admin.statistik.kelola', compact('realtime', 'pengaturan'));
    }

    public function statistikUpdate(Request $request)
    {
        $keys = [
            'total_penduduk', 'laki_laki', 'perempuan', 'kepala_keluarga',
            'kelompok_umur_0_14', 'kelompok_umur_15_29', 'kelompok_umur_30_59', 'kelompok_umur_60',
            'total_umkm', 'umkm_aktif', 'total_surat', 'total_aspirasi', 'total_berita'
        ];
        
        foreach ($keys as $key) {
            $mode = $request->input("mode_{$key}", 'otomatis');
            $nilai = $request->input($key);
            
            if ($mode == 'manual' && $nilai !== null) {
                PengaturanStatistik::updateOrCreate(
                    ['key' => $key],
                    ['nilai_awal' => $nilai, 'mode' => 'manual']
                );
            } elseif ($mode == 'hybrid' && $nilai !== null) {
                PengaturanStatistik::updateOrCreate(
                    ['key' => $key],
                    ['nilai_awal' => $nilai, 'mode' => 'hybrid']
                );
            } else {
                PengaturanStatistik::where('key', $key)->delete();
            }
        }
        
        return redirect()->route('admin.statistik.kelola')->with('success', 'Pengaturan statistik berhasil disimpan!');
    }
}