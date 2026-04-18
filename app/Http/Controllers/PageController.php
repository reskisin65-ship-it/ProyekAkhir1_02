<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use App\Models\DataPengurus;
use App\Models\User;
use App\Models\Umkm;
use App\Models\Berita;
use App\Models\Galeri;
use App\Models\DataPenduduk;
use App\Models\Role;
use App\Models\PengajuanSurat;
use App\Models\Aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    /**
     * Halaman Beranda (Home)
     */
    public function home()
    {
        // Profil Desa
        $profil = ProfilDesa::first();
        
        // Berita (limit 4)
        $beritas = Berita::orderBy('created_at', 'desc')->limit(4)->get();
        
        // Pengumuman (limit 3)
        $pengumumans = Berita::where('kategori', 'pengumuman')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        // Pengurus Desa (Aparatur)
        $aparaturs = DataPengurus::orderBy('id_pengurus')->get();
        
        // Galeri (limit 8)
        $galeris = Galeri::orderBy('created_at', 'desc')->limit(8)->get();
        
        // UMKM (limit 6)
        $umkms = Umkm::limit(6)->get();
        
        // Statistik dari Data Penduduk
        $stat_penduduk = DataPenduduk::count();
        $stat_penduduk = $stat_penduduk > 0 ? number_format($stat_penduduk) : '0';
        
        $stat_kk = DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count();
        $stat_kk = $stat_kk > 0 ? number_format($stat_kk) : '0';
        
        $stat_umkm_count = Umkm::count();
        $stat_umkm_count = $stat_umkm_count > 0 ? $stat_umkm_count : '0';
        
        $stat_luas = $profil->luas_wilayah ?? '12.5';
        
        // ==============================================
        // DATA UNTUK DIAGRAM STATISTIK DI HOME
        // ==============================================
        // Data Penduduk berdasarkan jenis kelamin
        $penduduk_pria = DataPenduduk::where('jenis_kelamin', 'L')->count();
        $penduduk_wanita = DataPenduduk::where('jenis_kelamin', 'P')->count();
        
        // Kelompok Umur
        $kelompok_umur_0_14 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count();
        $kelompok_umur_15_29 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count();
        $kelompok_umur_30_59 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count();
        $kelompok_umur_60 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count();
        
        return view('home', compact(
            'profil', 'beritas', 'pengumumans', 'aparaturs', 
            'galeris', 'umkms', 'stat_penduduk', 'stat_kk', 
            'stat_umkm_count', 'stat_luas',
            'penduduk_pria', 'penduduk_wanita',
            'kelompok_umur_0_14', 'kelompok_umur_15_29', 
            'kelompok_umur_30_59', 'kelompok_umur_60'
        ));
    }

    /**
     * Halaman Profil Desa
     */
    public function profilDesa()
    {
        $profil = ProfilDesa::first();
        $aparaturs = DataPengurus::orderBy('id_pengurus')->get();
        
        $stat_penduduk = DataPenduduk::count();
        $stat_penduduk = $stat_penduduk > 0 ? number_format($stat_penduduk) : '0';
        
        $stat_kk = DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count();
        $stat_kk = $stat_kk > 0 ? number_format($stat_kk) : '0';
        
        $stat_umkm_count = Umkm::count();
        $stat_umkm_count = $stat_umkm_count > 0 ? $stat_umkm_count : '0';
        
        $stat_luas = $profil->luas_wilayah ?? '12.5';
        $stat_dusun = '6';
        $stat_tahun_berdiri = '1920';
        
        return view('pages.profil-desa', compact(
            'profil', 'aparaturs', 
            'stat_penduduk', 'stat_kk', 
            'stat_umkm_count', 'stat_luas', 
            'stat_dusun', 'stat_tahun_berdiri'
        ));
    }

    /**
     * Halaman Berita & Pengumuman
     */
    public function berita()
    {
        $beritas = Berita::where('status', 'publish')
            ->orderBy('tanggal_publikasi', 'desc')
            ->paginate(9);
            
        $beritaUtama = Berita::where('status', 'publish')
            ->orderBy('tanggal_publikasi', 'desc')
            ->first();
        
        return view('pages.berita', compact('beritas', 'beritaUtama'));
    }

    /**
     * Halaman Pencarian Berita
     */
    public function beritaSearch(Request $request)
    {
        $keyword = $request->get('q');
        
        $beritas = Berita::where('status', 'publish')
            ->where(function($query) use ($keyword) {
                $query->where('judul', 'like', '%' . $keyword . '%')
                      ->orWhere('ringkasan', 'like', '%' . $keyword . '%')
                      ->orWhere('isi_berita', 'like', '%' . $keyword . '%');
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->paginate(9);
            
        $beritaUtama = null;
        
        return view('pages.berita', compact('beritas', 'beritaUtama', 'keyword'));
    }

    /**
     * Halaman Detail Berita (menggunakan slug)
     */
    public function beritaShow($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();
        
        // Increment counter pembaca
        $berita->increment('dibaca');
        
        // Rekomendasi berita terkait (gunakan id_berita, bukan id)
        $rekomendasi = Berita::where('status', 'publish')
            ->where('id_berita', '!=', $berita->id_berita)
            ->where('kategori', $berita->kategori)
            ->orderBy('tanggal_publikasi', 'desc')
            ->limit(3)
            ->get();
        
        return view('pages.berita-detail', compact('berita', 'rekomendasi'));
    }

    /**
     * Halaman Galeri
     */
    public function galeri()
    {
        $galeris = Galeri::orderBy('created_at', 'desc')->paginate(12);
        return view('pages.galeri', compact('galeris'));
    }

    /**
     * Halaman UMKM Publik
     */
    public function umkm()
    {
        $umkms = Umkm::paginate(9);
        return view('pages.umkm', compact('umkms'));
    }

    /**
     * Halaman Kontak
     */
    public function kontak()
    {
        return view('pages.kontak');
    }

    /**
     * Kirim Pesan Kontak
     */
    public function kirimPesan(Request $request)
    {
        $request->validate([
            'nama' => 'required|min:3',
            'email' => 'required|email',
            'subjek' => 'required|min:3',
            'pesan' => 'required|min:10',
        ]);
        
        return redirect()->route('kontak')->with('success', 'Pesan Anda telah terkirim! Kami akan segera merespon.');
    }

    /**
     * ==============================================
     * Halaman Statistik Desa untuk Publik
     * ==============================================
     * Menampilkan data statistik realtime dari database:
     * - Jumlah penduduk berdasarkan jenis kelamin
     * - Jumlah Kepala Keluarga
     * - Kelompok umur penduduk
     * - Jumlah UMKM (aktif & pending)
     * - Jumlah layanan (berita, aspirasi, pengajuan surat)
     */
    public function statistik()
    {
        // ==============================================
        // DATA PENDUDUK (menggunakan model DataPenduduk)
        // ==============================================
        $totalPenduduk = DataPenduduk::count();
        $pendudukPria = DataPenduduk::where('jenis_kelamin', 'L')->count();
        $pendudukWanita = DataPenduduk::where('jenis_kelamin', 'P')->count();
        $totalKK = DataPenduduk::where('status_keluarga', 'Kepala Keluarga')->count();

        // ==============================================
        // KELOMPOK UMUR (menggunakan tanggal_lahir)
        // ==============================================
        $kelompokUmur014 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 0 AND 14')->count();
        $kelompokUmur1529 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 15 AND 29')->count();
        $kelompokUmur3059 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) BETWEEN 30 AND 59')->count();
        $kelompokUmur60 = DataPenduduk::whereRaw('TIMESTAMPDIFF(YEAR, tanggal_lahir, CURDATE()) >= 60')->count();

        // ==============================================
        // DATA UMKM
        // ==============================================
        $totalUmkm = Umkm::count();
        $umkmApproved = Umkm::where('status', 'approved')->count();
        $umkmPending = Umkm::where('status', 'pending')->count();
        $umkmRejected = Umkm::where('status', 'rejected')->count();

        // ==============================================
        // DATA LAYANAN
        // ==============================================
        $totalBerita = Berita::count();
        $totalAspirasi = Aspirasi::count();
        $totalSurat = PengajuanSurat::count();

        // Statistik tambahan untuk surat berdasarkan status
        $suratPending = PengajuanSurat::where('status', 'pending')->count();
        $suratApproved = PengajuanSurat::where('status', 'disetujui')->count();
        $suratCompleted = PengajuanSurat::where('status', 'selesai')->count();
        $suratRejected = PengajuanSurat::where('status', 'ditolak')->count();

        // ==============================================
        // PERSIAPAN DATA UNTUK CHART
        // ==============================================
        $chartData = [
            'penduduk' => [
                'labels' => ['Laki-laki', 'Perempuan', 'Kepala Keluarga'],
                'values' => [$pendudukPria, $pendudukWanita, $totalKK],
                'colors' => ['#3b82f6', '#ec489a', '#f59e0b'],
                'title' => 'Statistik Penduduk'
            ],
            'umur' => [
                'labels' => ['0-14 tahun', '15-29 tahun', '30-59 tahun', '60+ tahun'],
                'values' => [$kelompokUmur014, $kelompokUmur1529, $kelompokUmur3059, $kelompokUmur60],
                'colors' => ['#10b981', '#3b82f6', '#f59e0b', '#8b5cf6'],
                'title' => 'Kelompok Umur Penduduk'
            ],
            'umkm' => [
                'labels' => ['Aktif (Approved)', 'Menunggu Verifikasi', 'Ditolak'],
                'values' => [$umkmApproved, $umkmPending, $umkmRejected],
                'colors' => ['#22c55e', '#eab308', '#ef4444'],
                'title' => 'Statistik UMKM'
            ],
            'layanan' => [
                'labels' => ['Pengajuan Surat', 'Aspirasi', 'Berita'],
                'values' => [$totalSurat, $totalAspirasi, $totalBerita],
                'colors' => ['#06b6d4', '#a855f7', '#ec489a'],
                'title' => 'Statistik Layanan'
            ]
        ];

        // Data untuk statistik cards
        $statistics = [
            'total_penduduk' => $totalPenduduk,
            'total_umkm' => $totalUmkm,
            'total_surat' => $totalSurat,
            'total_aspirasi' => $totalAspirasi,
            'penduduk_pria' => $pendudukPria,
            'penduduk_wanita' => $pendudukWanita,
            'total_kk' => $totalKK,
            'umkm_approved' => $umkmApproved,
            'umkm_pending' => $umkmPending,
            'kelompok_umur_0_14' => $kelompokUmur014,
            'kelompok_umur_15_29' => $kelompokUmur1529,
            'kelompok_umur_30_59' => $kelompokUmur3059,
            'kelompok_umur_60' => $kelompokUmur60,
        ];

        return view('pages.statistik', compact('chartData', 'statistics'));
    }
}