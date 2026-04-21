<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\PengajuanSurat;
use App\Models\Aspirasi;
use App\Models\Galeri;
use App\Models\DataPenduduk;
use App\Models\Umkm;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Halaman Profil Masyarakat
     */
    public function profil()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('masyarakat.profil');
    }

    /**
     * Update Profil Masyarakat
     */
    public function updateProfil(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $request->validate([
            'name' => 'required|min:3',
            'nomor_telepon' => 'nullable|max:15',
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'nomor_telepon' => $request->nomor_telepon,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}