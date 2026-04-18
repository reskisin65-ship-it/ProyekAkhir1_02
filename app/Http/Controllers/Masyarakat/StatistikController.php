<?php
// app/Http/Controllers/Masyarakat/StatistikController.php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use App\Models\Umkm;
use App\Models\Berita;
use App\Models\Aspirasi;
use App\Models\PengajuanSurat;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    /**
     * Menampilkan halaman statistik untuk masyarakat dan guest
     */
    public function index()
    {
        // Data Penduduk
        $totalPenduduk = Penduduk::count();
        $pendudukPria = Penduduk::where('jenis_kelamin', 'L')->count();
        $pendudukWanita = Penduduk::where('jenis_kelamin', 'P')->count();
        $totalKK = Penduduk::where('status_keluarga', 'kepala_keluarga')->count();

        // Kelompok Umur (menggunakan RAW query untuk kompatibilitas)
        $kelompokUmur014 = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count();
        $kelompokUmur1529 = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count();
        $kelompokUmur3059 = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count();
        $kelompokUmur60 = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count();

        // Data UMKM
        $totalUmkm = Umkm::count();
        $umkmApproved = Umkm::where('status', 'approved')->count();

        // Data Layanan
        $totalBerita = Berita::count();
        $totalAspirasi = Aspirasi::count();
        $totalSurat = PengajuanSurat::count();

        $statistik = [
            'total_penduduk' => $totalPenduduk,
            'penduduk_pria' => $pendudukPria,
            'penduduk_wanita' => $pendudukWanita,
            'total_kk' => $totalKK,
            'kelompok_umur_0_14' => $kelompokUmur014,
            'kelompok_umur_15_29' => $kelompokUmur1529,
            'kelompok_umur_30_59' => $kelompokUmur3059,
            'kelompok_umur_60' => $kelompokUmur60,
            'total_umkm' => $totalUmkm,
            'umkm_approved' => $umkmApproved,
            'total_berita' => $totalBerita,
            'total_aspirasi' => $totalAspirasi,
            'total_surat' => $totalSurat,
        ];

        return view('masyarakat.statistik', compact('statistik'));
    }

    /**
     * API endpoint untuk update realtime (optional)
     */
    public function api()
    {
        $totalPenduduk = Penduduk::count();
        $pendudukPria = Penduduk::where('jenis_kelamin', 'L')->count();
        $pendudukWanita = Penduduk::where('jenis_kelamin', 'P')->count();
        $totalKK = Penduduk::where('status_keluarga', 'kepala_keluarga')->count();

        $kelompokUmur014 = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count();
        $kelompokUmur1529 = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count();
        $kelompokUmur3059 = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count();
        $kelompokUmur60 = Penduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count();

        $totalUmkm = Umkm::count();
        $umkmApproved = Umkm::where('status', 'approved')->count();
        $totalBerita = Berita::count();
        $totalAspirasi = Aspirasi::count();
        $totalSurat = PengajuanSurat::count();

        return response()->json([
            'total_penduduk' => $totalPenduduk,
            'penduduk_pria' => $pendudukPria,
            'penduduk_wanita' => $pendudukWanita,
            'total_kk' => $totalKK,
            'kelompok_umur_0_14' => $kelompokUmur014,
            'kelompok_umur_15_29' => $kelompokUmur1529,
            'kelompok_umur_30_59' => $kelompokUmur3059,
            'kelompok_umur_60' => $kelompokUmur60,
            'total_umkm' => $totalUmkm,
            'umkm_approved' => $umkmApproved,
            'total_berita' => $totalBerita,
            'total_aspirasi' => $totalAspirasi,
            'total_surat' => $totalSurat,
        ]);
    }
}