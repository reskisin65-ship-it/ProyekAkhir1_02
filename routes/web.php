<?php

use Illuminate\Support\Facades\Route;
use App\Models\Berita;
use App\Models\About;

// Import Admin Controllers
use App\Http\Controllers\Admin\BeritaController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\Admin\SuratController as AdminSurat;
use App\Http\Controllers\Admin\PendudukController as AdminPenduduk;
use App\Http\Controllers\Admin\UmkmController as AdminUmkm;

// Import Masyarakat Controllers
use App\Http\Controllers\Masyarakat\SuratController as WargaSurat;

// Import UMKM Owner Controllers
use App\Http\Controllers\Umkm\OwnerController as UmkmOwner;

/*
|--------------------------------------------------------------------------
| Web Routes - Desa Lumban Silintong
|--------------------------------------------------------------------------
*/

// 1. HALAMAN UTAMA (GUEST & MASYARAKAT)
Route::get('/', function () {
    $beritas = Berita::where('status', 'publik')->latest()->take(3)->get();
    $about = About::first();
    return view('welcome', compact('beritas', 'about'));
});

// 2. LOGIKA REDIRECT DASHBOARD (PENENTU ROLE)
Route::get('/dashboard', function () {
    if (!auth()->check()) return redirect()->route('login');
    
    $role = auth()->user()->role->nama_role;
    
    if ($role == 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role == 'umkm') {
        return redirect()->route('umkm.dashboard');
    } else {
        return redirect()->route('masyarakat.dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

// 3. KELOMPOK AKSES ADMIN (Prefix: admin)
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    // Dashboard Utama Admin
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('admin.dashboard');
    
    // Modul Berita
    Route::resource('berita', BeritaController::class)->names('admin.berita');
    
    // Modul Data Penduduk
    Route::resource('penduduk', AdminPenduduk::class)->names('admin.penduduk');
    
    // Modul Manajemen UMKM (Validasi/List Global)
    Route::get('/umkm', [AdminUmkm::class, 'index'])->name('admin.umkm.index');
    Route::delete('/umkm/{umkm}', [AdminUmkm::class, 'destroy'])->name('admin.umkm.destroy');

    // Modul Verifikasi Surat
    Route::get('/surat', [AdminSurat::class, 'index'])->name('admin.surat.index');
    Route::patch('/surat/{surat}/status', [AdminSurat::class, 'updateStatus'])->name('admin.surat.status');
    Route::delete('/surat/{surat}', [AdminSurat::class, 'destroy'])->name('admin.surat.destroy');
});

// 4. KELOMPOK AKSES MASYARAKAT (Prefix: masyarakat)
Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->group(function () {
    // Dashboard Warga (Terintegrasi Konten Utama)
    Route::get('/dashboard', [WargaSurat::class, 'dashboard'])->name('masyarakat.dashboard');
    
    // Modul Pengajuan Surat Warga
    Route::resource('surat', WargaSurat::class)->names('masyarakat.surat');
});

// 5. KELOMPOK AKSES PEMILIK UMKM (Prefix: umkm)
Route::middleware(['auth', 'role:umkm'])->prefix('umkm')->group(function () {
    // Dashboard Bisnis UMKM
    Route::get('/dashboard', [UmkmOwner::class, 'index'])->name('umkm.dashboard');
    
    // Pendaftaran Profil Usaha & Kelola Produk
    Route::post('/register-usaha', [UmkmOwner::class, 'storeUsaha'])->name('umkm.store_usaha');
    
    // Nantinya di sini ditambahkan CRUD Produk:
    // Route::resource('produk', ProdukController::class)->names('umkm.produk');
});

// Load Route Autentikasi Laravel Breeze (Login/Register/Logout)
require __DIR__.'/auth.php';