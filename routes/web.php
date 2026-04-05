<?php

use Illuminate\Support\Facades\Route;
use App\Models\Berita;
use App\Models\About;
use App\Models\PengajuanSurat;

// Import Controllers
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SuratController as AdminSurat;
use App\Http\Controllers\Masyarakat\SuratController as WargaSurat;

Route::get('/', function () {
    $beritas = Berita::where('status', 'publik')->latest()->take(3)->get();
    $about = About::first();
    return view('welcome', compact('beritas', 'about'));
});

Route::get('/dashboard', function () {
    if (!auth()->check()) return redirect()->route('login');
    $role = auth()->user()->role->nama_role;
    if ($role == 'admin') return redirect()->route('admin.dashboard');
    if ($role == 'umkm') return redirect()->route('umkm.dashboard');
    return redirect()->route('masyarakat.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// GROUP ADMIN
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    
    // Kelola Berita
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    
    // Kelola Surat (Admin)
    Route::get('/surat', [AdminSurat::class, 'index'])->name('admin.surat.index');
    Route::patch('/surat/{surat}/status', [AdminSurat::class, 'updateStatus'])->name('admin.surat.status');
    Route::delete('/surat/{surat}', [AdminSurat::class, 'destroy'])->name('admin.surat.destroy');
});

// GROUP MASYARAKAT
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    Route::get('/dashboard', [WargaSurat::class, 'dashboard'])->name('masyarakat.dashboard');
    Route::resource('surat', WargaSurat::class)->names('masyarakat.surat');
});

require __DIR__.'/auth.php';