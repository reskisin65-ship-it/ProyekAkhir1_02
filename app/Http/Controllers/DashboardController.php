<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\PengajuanSurat;
use App\Models\Aspirasi;
use App\Models\Galeri;
use App\Models\DataPenduduk;
use App\Models\Umkm;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Redirect berdasarkan role
     */
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role && $user->role->nama_role === 'admin') {
            return redirect('/admin/dashboard');
        }
        
        return redirect('/masyarakat/dashboard');
    }

    /**
     * Dashboard Masyarakat
     */
    public function masyarakat()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $userId = Auth::id();
        
        // ==============================================
        // STATISTIK PENGGUNA
        // ==============================================
        $totalSurat = PengajuanSurat::where('user_id', $userId)->count();
        $totalAspirasi = Aspirasi::where('user_id', $userId)->count();
        $suratSelesai = PengajuanSurat::where('user_id', $userId)->where('status', 'selesai')->count();
        $suratMenunggu = PengajuanSurat::where('user_id', $userId)->whereIn('status', ['menunggu', 'diproses'])->count();
        
        $pengajuanTerbaru = PengajuanSurat::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        // ==============================================
        // BERITA & PENGUMUMAN
        // ==============================================
        $beritas = Berita::where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        
        $pengumuman = Berita::where('kategori', 'pengumuman')
            ->where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // ==============================================
        // GALERI
        // ==============================================
        $galeris = Galeri::orderBy('created_at', 'desc')->limit(4)->get();
        
        // ==============================================
        // DATA STATISTIK UNTUK DIAGRAM
        // ==============================================
        $totalPenduduk = DataPenduduk::count();
        $pendudukPria = DataPenduduk::where('jenis_kelamin', 'L')->count();
        $pendudukWanita = DataPenduduk::where('jenis_kelamin', 'P')->count();
        $totalKK = DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count();
        
        // Kelompok Umur
        $kelompokUmur014 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count();
        $kelompokUmur1529 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count();
        $kelompokUmur3059 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count();
        $kelompokUmur60 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count();
        
        $statistik = [
            'total_penduduk' => $totalPenduduk,
            'penduduk_pria' => $pendudukPria,
            'penduduk_wanita' => $pendudukWanita,
            'total_kk' => $totalKK,
            'kelompok_umur_0_14' => $kelompokUmur014,
            'kelompok_umur_15_29' => $kelompokUmur1529,
            'kelompok_umur_30_59' => $kelompokUmur3059,
            'kelompok_umur_60' => $kelompokUmur60,
        ];
        
        // ==============================================
        // DATA ASPIRASI PUBLIK - TAMPILKAN SEMUA ASPIRASI
        // ==============================================
        $aspirasiPublik = Aspirasi::orderBy('created_at', 'desc')
            ->limit(6)
            ->get();
        
        return view('masyarakat.dashboard', compact(
            'totalSurat', 'totalAspirasi', 'suratSelesai', 'suratMenunggu',
            'pengajuanTerbaru', 'beritas', 'pengumuman', 'galeris', 'statistik',
            'aspirasiPublik'
        ));
    }

    /**
     * Halaman Profil Masyarakat/UMKM
     */
    public function profil()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        
        // Jika admin, redirect ke dashboard admin
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak memiliki akses ke halaman ini.');
        }

        $dataPenduduk = $user->dataPenduduk ?? new DataPenduduk();
        
        return view('masyarakat.profil', compact('user', 'dataPenduduk'));
    }

    /**
     * Update Profil Masyarakat/UMKM
     */
    public function updateProfil(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        $oldName = $user->name;
        
        // Admin tidak bisa akses
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat mengubah profil di sini.');
        }

        $dataPenduduk = $user->dataPenduduk;

        $tanggalLahirMaks = Carbon::now()->subYears(17)->format('Y-m-d');

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'nomor_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:500',
            'foto_profil' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nik' => [
                'nullable',
                'string',
                'size:16',
                Rule::unique('data_penduduk', 'nik')->ignore($dataPenduduk?->id_penduduk, 'id_penduduk'),
            ],
            'nama_lengkap' => 'nullable|string|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tempat_lahir' => 'nullable|string|max:50',
            'tanggal_lahir' => 'nullable|date|before_or_equal:' . $tanggalLahirMaks,
            'agama' => 'nullable|string|max:20',
            'pendidikan' => 'nullable|string|max:50',
            'pekerjaan' => 'nullable|string|max:50',
            'status_perkawinan' => 'nullable|string|max:20',
            'alamat_penduduk' => 'nullable|string',
            'kelurahan_desa' => 'nullable|string|max:50',
            'kecamatan' => 'nullable|string|max:50',
            'kabupaten_kota' => 'nullable|string|max:50',
            'provinsi' => 'nullable|string|max:50',
            'status_keluarga' => 'nullable|string|max:30',
            'no_kk' => 'nullable|string|max:20',
        ], [
            'tanggal_lahir.before_or_equal' => 'Tanggal lahir harus 17 tahun atau lebih.',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'nomor_telepon' => $request->nomor_telepon,
            'alamat' => $request->alamat,
        ];

        // Upload foto profil
        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $data['foto_profil'] = $request->file('foto_profil')->store('foto_profil', 'public');
        }

        $user->update($data);

        $pendudukData = [
            'user_id' => $user->user_id,
            'nik' => $request->nik,
            'nama_lengkap' => $request->nama_lengkap,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'agama' => $request->agama,
            'pendidikan' => $request->pendidikan,
            'pekerjaan' => $request->pekerjaan,
            'status_perkawinan' => $request->status_perkawinan,
            'alamat' => $request->alamat_penduduk,
            'rt_rw' => '',
            'kelurahan_desa' => $request->kelurahan_desa,
            'kecamatan' => $request->kecamatan,
            'kabupaten_kota' => $request->kabupaten_kota,
            'provinsi' => $request->provinsi,
            'status_keluarga' => $request->status_keluarga,
            'no_kk' => $request->no_kk,
        ];

        if ($request->nama_lengkap === $oldName) {
            $pendudukData['nama_lengkap'] = $request->name;
        }

        if ($dataPenduduk) {
            $dataPenduduk->update(array_filter($pendudukData, fn($value) => $value !== null));
        } elseif (collect($pendudukData)->except('user_id')->filter()->isNotEmpty()) {
            DataPenduduk::create($pendudukData);
        }

        return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update Password
     */
    public function updatePassword(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $user = Auth::user();
        
        // Admin tidak bisa akses
        if ($user->isAdmin()) {
            return redirect()->route('admin.dashboard')->with('error', 'Admin tidak dapat mengubah password di sini.');
        }

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        // Cek password lama
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Password lama tidak sesuai!']);
        }

        // Update password
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return redirect()->back()->with('success', 'Password berhasil diubah!');
    }
    /**
     * Upload Foto Profil (AJAX-friendly, standalone)
     */
    public function updateFoto(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->back()->with('error', 'Tidak diizinkan.');
        }

        $request->validate([
            'foto_profil' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'foto_profil.required' => 'Pilih file foto terlebih dahulu.',
            'foto_profil.image'    => 'File harus berupa gambar.',
            'foto_profil.mimes'    => 'Format foto: JPG, JPEG, PNG, atau WEBP.',
            'foto_profil.max'      => 'Ukuran foto maksimal 2MB.',
        ]);

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama jika ada
            if ($user->foto_profil && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $path = $request->file('foto_profil')->store('foto_profil', 'public');
            $user->update(['foto_profil' => $path]);
        }

        return redirect()->back()->with('success', 'Foto profil berhasil diperbarui!');
    }
}
