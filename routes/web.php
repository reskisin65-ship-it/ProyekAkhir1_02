<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UmkmController;
use App\Http\Controllers\Masyarakat\SuratController;
use App\Http\Controllers\Masyarakat\AspirasiController;
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

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/profil-desa', [PageController::class, 'profilDesa'])->name('profil-desa');

// ROUTE BERITA
Route::get('/berita', [PageController::class, 'berita'])->name('berita');
Route::get('/berita/cari', [PageController::class, 'beritaSearch'])->name('berita.cari');
Route::get('/berita/{slug}', [PageController::class, 'beritaShow'])->name('berita.show');

Route::get('/galeri', [PageController::class, 'galeri'])->name('galeri');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm');
Route::get('/umkm/{id}', [UmkmController::class, 'show'])->name('umkm.show');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'kirimPesan'])->name('kontak.send');

// ==============================================
// ROUTES AUTHENTIKASI
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
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/testimoni', [TestimoniController::class, 'store'])->name('testimoni.store');
});

// ==============================================
// ROUTES UNTUK MASYARAKAT & UMKM (SEMUA USER LOGIN)
// HAPUS MIDDLEWARE 'role:masyarakat' AGAR UMKM JUGA BISA AKSES
// ==============================================

Route::middleware(['auth'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'masyarakat'])->name('dashboard');
    
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->name('surat.edit');
    Route::put('/surat/{id}', [SuratController::class, 'update'])->name('surat.update');
    Route::delete('/surat/{id}', [SuratController::class, 'destroy'])->name('surat.destroy');
    Route::get('/surat/{id}', [SuratController::class, 'show'])->name('surat.show');
    Route::get('/surat/{id}/download', [SuratController::class, 'download'])->name('surat.download');
    
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/{id}', [AspirasiController::class, 'show'])->name('aspirasi.show');
    Route::get('/aspirasi/{id}/edit', [AspirasiController::class, 'edit'])->name('aspirasi.edit');
    Route::put('/aspirasi/{id}', [AspirasiController::class, 'update'])->name('aspirasi.update');
    Route::delete('/aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
    
    Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');
    Route::put('/profil', [DashboardController::class, 'updateProfil'])->name('profil.update');
    
    Route::get('/umkm/create', [UmkmController::class, 'createForm'])->name('umkm.create');
    Route::post('/umkm/store', [UmkmController::class, 'storeMasyarakat'])->name('umkm.store');
    Route::get('/umkm/status', [UmkmController::class, 'statusMasyarakat'])->name('umkm.status');
});

// ==============================================
// ROUTES UNTUK KELOLA UMKM (SETELAH APPROVED)
// ==============================================

Route::middleware(['auth', 'role:umkm'])->prefix('umkm')->name('umkm.')->group(function () {
    Route::get('/profil', [UmkmController::class, 'editProfil'])->name('profil.edit');
    Route::put('/profil', [UmkmController::class, 'updateProfil']);
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
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // MANAJEMEN UMKM
    Route::get('/umkm', [AdminController::class, 'umkm'])->name('umkm.index');
    Route::post('/umkm/{id}/approve', [AdminController::class, 'umkmApprove'])->name('umkm.approve');
    Route::post('/umkm/{id}/reject', [AdminController::class, 'umkmReject'])->name('umkm.reject');
    Route::delete('/umkm/{id}', [AdminController::class, 'umkmDestroy'])->name('umkm.destroy');
    
    // MANAJEMEN PENGAJUAN SURAT
    Route::get('/pengajuan-surat', [AdminController::class, 'pengajuanSurat'])->name('pengajuan-surat.index');
    Route::get('/pengajuan-surat/{id}', [AdminController::class, 'pengajuanSuratShow'])->name('pengajuan-surat.show');
    Route::post('/pengajuan-surat/{id}/approve', [AdminController::class, 'pengajuanSuratApprove'])->name('pengajuan-surat.approve');
    Route::post('/pengajuan-surat/{id}/complete', [AdminController::class, 'pengajuanSuratComplete'])->name('pengajuan-surat.complete');
    Route::post('/pengajuan-surat/{id}/reject', [AdminController::class, 'pengajuanSuratReject'])->name('pengajuan-surat.reject');
    Route::delete('/pengajuan-surat/{id}', [AdminController::class, 'pengajuanSuratDestroy'])->name('pengajuan-surat.destroy');
    Route::get('/pengajuan-surat/{id}/download-surat', [AdminController::class, 'pengajuanSuratDownload'])->name('pengajuan-surat.download-surat');
    Route::get('/pengajuan-surat/{id}/download-pendukung', [AdminController::class, 'pengajuanSuratDownloadPendukung'])->name('pengajuan-surat.download-pendukung');
    
    // MANAJEMEN ASPIRASI
    Route::get('/aspirasi', [AdminController::class, 'aspirasi'])->name('aspirasi.index');
    Route::post('/aspirasi/{id}/respond', [AdminController::class, 'aspirasiRespond'])->name('aspirasi.respond');
    Route::post('/aspirasi/{id}/status', [AdminController::class, 'aspirasiStatus'])->name('aspirasi.status');
    Route::delete('/aspirasi/{id}', [AdminController::class, 'aspirasiDestroy'])->name('aspirasi.destroy');
    
    // MANAJEMEN BERITA
    Route::get('/berita', [AdminController::class, 'berita'])->name('berita.index');
    Route::get('/berita/create', [AdminController::class, 'beritaCreate'])->name('berita.create');
    Route::post('/berita', [AdminController::class, 'beritaStore'])->name('berita.store');
    Route::get('/berita/{id}/edit', [AdminController::class, 'beritaEdit'])->name('berita.edit');
    Route::put('/berita/{id}', [AdminController::class, 'beritaUpdate'])->name('berita.update');
    Route::delete('/berita/{id}', [AdminController::class, 'beritaDestroy'])->name('berita.destroy');
    
    // MANAJEMEN GALERI
    Route::get('/galeri', [AdminController::class, 'galeri'])->name('galeri.index');
    Route::get('/galeri/create', [AdminController::class, 'galeriCreate'])->name('galeri.create');
    Route::post('/galeri', [AdminController::class, 'galeriStore'])->name('galeri.store');
    Route::get('/galeri/{id}', [AdminController::class, 'galeriShow'])->name('galeri.show');
    Route::get('/galeri/{id}/edit', [AdminController::class, 'galeriEdit'])->name('galeri.edit');
    Route::put('/galeri/{id}', [AdminController::class, 'galeriUpdate'])->name('galeri.update');
    Route::delete('/galeri/{id}', [AdminController::class, 'galeriDestroy'])->name('galeri.destroy');
    
    // MANAJEMEN DATA PENDUDUK
    Route::get('/penduduk', [AdminController::class, 'penduduk'])->name('penduduk.index');
    Route::get('/penduduk/create', [AdminController::class, 'pendudukCreate'])->name('penduduk.create');
    Route::post('/penduduk', [AdminController::class, 'pendudukStore'])->name('penduduk.store');
    Route::get('/penduduk/{id}/edit', [AdminController::class, 'pendudukEdit'])->name('penduduk.edit');
    Route::put('/penduduk/{id}', [AdminController::class, 'pendudukUpdate'])->name('penduduk.update');
    Route::delete('/penduduk/{id}', [AdminController::class, 'pendudukDestroy'])->name('penduduk.destroy');
    
    // MANAJEMEN PROFIL DESA
    Route::get('/profil-desa', [AdminController::class, 'profilDesa'])->name('profil-desa');
    Route::put('/profil-desa', [AdminController::class, 'updateProfilDesa'])->name('profil-desa.update');
    
    // MANAJEMEN DATA PENGURUS
    Route::get('/pengurus', [AdminController::class, 'pengurus'])->name('pengurus.index');
    Route::get('/pengurus/create', [AdminController::class, 'pengurusCreate'])->name('pengurus.create');
    Route::post('/pengurus', [AdminController::class, 'pengurusStore'])->name('pengurus.store');
    Route::get('/pengurus/{id}/edit', [AdminController::class, 'pengurusEdit'])->name('pengurus.edit');
    Route::put('/pengurus/{id}', [AdminController::class, 'pengurusUpdate'])->name('pengurus.update');
    Route::delete('/pengurus/{id}', [AdminController::class, 'pengurusDestroy'])->name('pengurus.destroy');
    
    // STATISTIK
    Route::get('/statistik', [AdminController::class, 'statistik'])->name('statistik');
});