<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\PengajuanSurat;
use App\Models\DataPenduduk;
use App\Models\Umkm;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil data asli dari database
        $stats = [
            'total_warga' => DataPenduduk::count(),
            'surat_pending' => PengajuanSurat::where('status', 'pending')->count(),
            'umkm_aktif' => Umkm::count(),
            'total_berita' => Berita::count(),
        ];

        $recentSurats = PengajuanSurat::with('user')->latest()->take(5)->get();
        $recentBeritas = Berita::latest()->take(3)->get();
        
        return view('dashboard.admin', compact('stats', 'recentSurats', 'recentBeritas'));
    }
}