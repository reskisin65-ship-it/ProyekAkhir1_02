<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Desa Lumban Silintong
|--------------------------------------------------------------------------
*/

// ==============================================
// ROUTES UNTUK SEMUA USER (GUEST + LOGIN)
// ==============================================

// Halaman Beranda (Home)
Route::get('/', [PageController::class, 'home'])->name('home');

// Halaman Profil Desa
Route::get('/profil-desa', [PageController::class, 'profilDesa'])->name('profil-desa');

// Halaman Berita & Pengumuman (pakai PageController)
Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/berita/{id}', [PageController::class, 'beritaShow'])->name('berita.show');

// Halaman Galeri
Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');

// Halaman UMKM Publik
Route::get('/umkm', [PageController::class, 'umkm'])->name('umkm');
Route::get('/umkm/{id}', [PageController::class, 'umkmShow'])->name('umkm.show');

// Halaman Kontak & Testimoni
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'kirimPesan'])->name('kontak.send');

// ==============================================
// ROUTES AUTHENTIKASI (LOGIN, REGISTER, LOGOUT)
// ==============================================

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');

// ==============================================
// ROUTES YANG MEMERLUKAN LOGIN (SEMUA ROLE)
// ==============================================

Route::middleware(['auth'])->group(function () {
    
    // Dashboard (redirect sesuai role)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Testimoni (kirim testimoni)
    Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
});

// ==============================================
// ROUTES UNTUK ROLE: MASYARAKAT
// ==============================================

Route::middleware(['auth', 'role:masyarakat'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    
    // Dashboard Masyarakat
    Route::get('/dashboard', [DashboardController::class, 'masyarakat'])->name('dashboard');
    
    // Pengajuan Surat
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/surat/{id}/download', [SuratController::class, 'download'])->name('surat.download');
    
    // Aspirasi
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    
    // Request Akun UMKM
    Route::get('/request-umkm', [UmkmController::class, 'requestForm'])->name('request-umkm');
    Route::post('/request-umkm', [UmkmController::class, 'storeRequest']);
    
    // Profil Saya
    Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');
    Route::put('/profil', [DashboardController::class, 'updateProfil'])->name('profil.update');
});

// ==============================================
// ROUTES UNTUK ROLE: PEMILIK UMKM
// ==============================================

Route::middleware(['auth', 'role:umkm'])->prefix('umkm')->name('umkm.')->group(function () {
    
    // Dashboard UMKM
    Route::get('/dashboard', [UmkmController::class, 'dashboard'])->name('dashboard');
    
    // Kelola Profil UMKM
    Route::get('/profil', [UmkmController::class, 'editProfil'])->name('profil.edit');
    Route::put('/profil', [UmkmController::class, 'updateProfil']);
    
    // Kelola Produk UMKM
    Route::get('/produk', [UmkmController::class, 'produkIndex'])->name('produk.index');
    Route::get('/produk/create', [UmkmController::class, 'produkCreate'])->name('produk.create');
    Route::post('/produk', [UmkmController::class, 'produkStore'])->name('produk.store');
    Route::get('/produk/{id}/edit', [UmkmController::class, 'produkEdit'])->name('produk.edit');
    Route::put('/produk/{id}', [UmkmController::class, 'produkUpdate'])->name('produk.update');
    Route::delete('/produk/{id}', [UmkmController::class, 'produkDestroy'])->name('produk.destroy');
});

// ==============================================
// ROUTES UNTUK ROLE: ADMIN
// ==============================================

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard Admin
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // ========== MANAJEMEN PROFIL DESA ==========
    Route::get('/profil-desa', [AdminController::class, 'profilDesa'])->name('profil-desa');
    Route::put('/profil-desa', [AdminController::class, 'updateProfilDesa'])->name('profil-desa.update');
    
    // ========== MANAJEMEN DATA PENGURUS ==========
    Route::get('/pengurus', [AdminController::class, 'pengurus'])->name('pengurus.index');
    Route::get('/pengurus/create', [AdminController::class, 'pengurusCreate'])->name('pengurus.create');
    Route::post('/pengurus', [AdminController::class, 'pengurusStore'])->name('pengurus.store');
    Route::get('/pengurus/{id}/edit', [AdminController::class, 'pengurusEdit'])->name('pengurus.edit');
    Route::put('/pengurus/{id}', [AdminController::class, 'pengurusUpdate'])->name('pengurus.update');
    Route::delete('/pengurus/{id}', [AdminController::class, 'pengurusDestroy'])->name('pengurus.destroy');
    
    // ========== MANAJEMEN DATA PENDUDUK ==========
    Route::get('/penduduk', [AdminController::class, 'penduduk'])->name('penduduk.index');
    Route::get('/penduduk/create', [AdminController::class, 'pendudukCreate'])->name('penduduk.create');
    Route::post('/penduduk', [AdminController::class, 'pendudukStore'])->name('penduduk.store');
    Route::get('/penduduk/{id}/edit', [AdminController::class, 'pendudukEdit'])->name('penduduk.edit');
    Route::put('/penduduk/{id}', [AdminController::class, 'pendudukUpdate'])->name('penduduk.update');
    Route::delete('/penduduk/{id}', [AdminController::class, 'pendudukDestroy'])->name('penduduk.destroy');
    
    // ========== MANAJEMEN BERITA ==========
    Route::get('/berita', [AdminController::class, 'berita'])->name('berita.index');
    Route::get('/berita/create', [AdminController::class, 'beritaCreate'])->name('berita.create');
    Route::post('/berita', [AdminController::class, 'beritaStore'])->name('berita.store');
    Route::get('/berita/{id}/edit', [AdminController::class, 'beritaEdit'])->name('berita.edit');
    Route::put('/berita/{id}', [AdminController::class, 'beritaUpdate'])->name('berita.update');
    Route::delete('/berita/{id}', [AdminController::class, 'beritaDestroy'])->name('berita.destroy');
    
    // ========== MANAJEMEN GALERI ==========
    Route::get('/galeri', [AdminController::class, 'galeri'])->name('galeri.index');
    Route::get('/galeri/create', [AdminController::class, 'galeriCreate'])->name('galeri.create');
    Route::post('/galeri', [AdminController::class, 'galeriStore'])->name('galeri.store');
    Route::delete('/galeri/{id}', [AdminController::class, 'galeriDestroy'])->name('galeri.destroy');
    
    // ========== MANAJEMEN PENGAJUAN SURAT ==========
    Route::get('/pengajuan-surat', [AdminController::class, 'pengajuanSurat'])->name('pengajuan-surat.index');
    Route::get('/pengajuan-surat/{id}', [AdminController::class, 'pengajuanSuratShow'])->name('pengajuan-surat.show');
    Route::post('/pengajuan-surat/{id}/approve', [AdminController::class, 'pengajuanSuratApprove'])->name('pengajuan-surat.approve');
    Route::post('/pengajuan-surat/{id}/reject', [AdminController::class, 'pengajuanSuratReject'])->name('pengajuan-surat.reject');
    
    // ========== MANAJEMEN UMKM ==========
    Route::get('/umkm', [AdminController::class, 'umkm'])->name('umkm.index');
    Route::post('/umkm/{id}/approve', [AdminController::class, 'umkmApprove'])->name('umkm.approve');
    Route::delete('/umkm/{id}', [AdminController::class, 'umkmDestroy'])->name('umkm.destroy');
    
    // ========== MANAJEMEN ASPIRASI ==========
    Route::get('/aspirasi', [AdminController::class, 'aspirasi'])->name('aspirasi.index');
    Route::get('/aspirasi/{id}', [AdminController::class, 'aspirasiShow'])->name('aspirasi.show');
    Route::post('/aspirasi/{id}/respond', [AdminController::class, 'aspirasiRespond'])->name('aspirasi.respond');
    
    // ========== MANAJEMEN TESTIMONI ==========
    Route::get('/testimoni', [AdminController::class, 'testimoni'])->name('testimoni.index');
    Route::post('/testimoni/{id}/approve', [AdminController::class, 'testimoniApprove'])->name('testimoni.approve');
    Route::delete('/testimoni/{id}', [AdminController::class, 'testimoniDestroy'])->name('testimoni.destroy');
    
    // ========== STATISTIK ==========
    Route::get('/statistik', [AdminController::class, 'statistik'])->name('statistik');
    
    // ========== MANAJEMEN USER ==========
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::delete('/users/{id}', [AdminController::class, 'usersDestroy'])->name('users.destroy');
});