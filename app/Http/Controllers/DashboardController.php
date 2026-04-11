<?php
// app/Http/Controllers/DashboardController.php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\PengajuanSurat;
use App\Models\Aspirasi;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->role && $user->role->nama_role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role && $user->role->nama_role === 'umkm') {
            return redirect()->route('umkm.dashboard');
        } else {
            return redirect()->route('masyarakat.dashboard');
        }
    }

    public function masyarakat()
    {
        $userId = Auth::id();
        
        // Statistik
        $totalSurat = PengajuanSurat::where('user_id', $userId)->count();
        $totalAspirasi = Aspirasi::where('user_id', $userId)->count();
        $suratSelesai = PengajuanSurat::where('user_id', $userId)->where('status', 'selesai')->count();
        $suratMenunggu = PengajuanSurat::where('user_id', $userId)->whereIn('status', ['menunggu', 'diproses'])->count();
        
        // Data terbaru
        $pengajuanTerbaru = PengajuanSurat::where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $beritas = Berita::where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->limit(4)
            ->get();
        
        $pengumuman = Berita::where('kategori', 'pengumuman')
            ->where('status', 'publish')
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get();
        
        $galeris = Galeri::orderBy('created_at', 'desc')->limit(4)->get();
        
        return view('masyarakat.dashboard', compact(
            'totalSurat', 'totalAspirasi', 'suratSelesai', 'suratMenunggu',
            'pengajuanTerbaru', 'beritas', 'pengumuman', 'galeris'
        ));
    }

    // Method lainnya...
}