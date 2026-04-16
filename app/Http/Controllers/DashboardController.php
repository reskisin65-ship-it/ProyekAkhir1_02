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
    // HAPUS METHOD index() ATAU JADIKAN SEPERTI INI
    public function index()
    {
        // Redirect langsung ke halaman sesuai role
        $user = Auth::user();
        
        if ($user->role && $user->role->nama_role === 'admin') {
            return redirect('/admin/dashboard');
        }
        
        // Masyarakat dan UMKM sama-sama ke dashboard masyarakat
        return redirect('/masyarakat/dashboard');
    }

    public function masyarakat()
    {
        // Cegah redirect loop - pastikan user login
        if (!Auth::check()) {
            return redirect('/login');
        }
        
        $userId = Auth::id();
        
        $totalSurat = PengajuanSurat::where('user_id', $userId)->count();
        $totalAspirasi = Aspirasi::where('user_id', $userId)->count();
        $suratSelesai = PengajuanSurat::where('user_id', $userId)->where('status', 'selesai')->count();
        $suratMenunggu = PengajuanSurat::where('user_id', $userId)->whereIn('status', ['menunggu', 'diproses'])->count();
        
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

    public function profil()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }
        return view('masyarakat.profil');
    }

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