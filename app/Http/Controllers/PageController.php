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
        
        return view('home', compact(
            'profil', 'beritas', 'pengumumans', 'aparaturs', 
            'galeris', 'umkms', 'stat_penduduk', 'stat_kk', 
            'stat_umkm_count', 'stat_luas'
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
        
        // Untuk sementara, simpan ke session saja
        // Nanti bisa disimpan ke database atau kirim email
        
        return redirect()->route('kontak')->with('success', 'Pesan Anda telah terkirim! Kami akan segera merespon.');
    }
}