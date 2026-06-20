<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UmkmController;
use App\Http\Controllers\Masyarakat\SuratController;
use App\Http\Controllers\Masyarakat\AspirasiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\Admin\KontakDesaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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
Route::get('/galeri/{id}', [PageController::class, 'galeriShow'])->name('galeri.show');
Route::get('/umkm', [UmkmController::class, 'index'])->name('umkm');
Route::get('/kontak', [PageController::class, 'kontak'])->name('kontak');
Route::post('/kontak', [PageController::class, 'kirimPesan'])->name('kontak.send');

// ==============================================
// ROUTES STATISTIK (UNTUK MASYARAKAT & GUEST)
// ==============================================
Route::get('/statistik-desa', [PageController::class, 'statistik'])->name('statistik.publik');

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

    Route::get('/umkm/daftar', [UmkmController::class, 'create'])->name('umkm.create');
    Route::post('/umkm/daftar', [UmkmController::class, 'store'])->name('umkm.store');
    Route::get('/umkm/dashboard', [UmkmController::class, 'dashboard'])->name('umkm.dashboard');
    Route::get('/admin/umkm/list', [UmkmController::class, 'index'])->name('umkm.index');
    Route::put('/umkm/profil/update', [UmkmController::class, 'updateProfil'])->name('umkm.profil.update');
    Route::get('/umkm/status', [UmkmController::class, 'status'])->name('umkm.status.admin');
    Route::get('/umkm/status', [UmkmController::class, 'status'])->name('umkm.status');
    Route::delete('/umkm/{id}', [UmkmController::class, 'destroy'])->whereNumber('id')->name('umkm.destroy');
    Route::get('/umkm/{id}/edit', [UmkmController::class, 'edit'])->whereNumber('id')->name('umkm.edit');
    Route::put('/umkm/{id}', [UmkmController::class, 'update'])->whereNumber('id')->name('umkm.update');
    Route::get('/umkm/{id}', [UmkmController::class, 'show'])->whereNumber('id')->name('umkm.show');
    Route::post('/produk/store', [ProductController::class, 'store'])->name('produk.store');
    Route::delete('/produk/{product}', [ProductController::class, 'destroy'])->name('produk.destroy');
    
    // NOTIFIKASI
    Route::get('/notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
    Route::get('/notifikasi/ambil', [NotifikasiController::class, 'ambil'])->name('notifikasi.ambil');
    Route::post('/notifikasi/baca', [NotifikasiController::class, 'baca'])->name('notifikasi.baca');
    Route::post('/notifikasi/baca-semua', [NotifikasiController::class, 'bacaSemua'])->name('notifikasi.baca-semua');
    Route::delete('/notifikasi/hapus-semua', [NotifikasiController::class, 'hapusSemua'])->name('notifikasi.hapus-semua');
    Route::delete('/notifikasi/{id}', [NotifikasiController::class, 'hapus'])->name('notifikasi.hapus');
});

Route::get('/umkm/{id}', [UmkmController::class, 'show'])->whereNumber('id')->name('umkm.show');

// ==============================================
// ROUTES UNTUK MASYARAKAT & UMKM (SEMUA USER LOGIN)
// ==============================================

Route::middleware(['auth'])->prefix('masyarakat')->name('masyarakat.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'masyarakat'])->name('dashboard');
    
    // SURAT
    Route::get('/surat', [SuratController::class, 'index'])->name('surat.index');
    Route::get('/surat/create', [SuratController::class, 'create'])->name('surat.create');
    Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/{id}/edit', [SuratController::class, 'edit'])->whereNumber('id')->name('surat.edit');
    Route::get('/surat/{id}/download', [SuratController::class, 'download'])->whereNumber('id')->name('surat.download');
    Route::put('/surat/{id}', [SuratController::class, 'update'])->whereNumber('id')->name('surat.update');
    Route::delete('/surat/{id}', [SuratController::class, 'destroy'])->whereNumber('id')->name('surat.destroy');
    Route::get('/surat/{id}', [SuratController::class, 'show'])->whereNumber('id')->name('surat.show');
    
    // ASPIRASI
    Route::get('/aspirasi', [AspirasiController::class, 'index'])->name('aspirasi.index');
    Route::get('/aspirasi/create', [AspirasiController::class, 'create'])->name('aspirasi.create');
    Route::post('/aspirasi', [AspirasiController::class, 'store'])->name('aspirasi.store');
    Route::get('/aspirasi/{id}', [AspirasiController::class, 'show'])->name('aspirasi.show');
    Route::get('/aspirasi/{id}/edit', [AspirasiController::class, 'edit'])->name('aspirasi.edit');
    Route::put('/aspirasi/{id}', [AspirasiController::class, 'update'])->name('aspirasi.update');
    Route::delete('/aspirasi/{id}', [AspirasiController::class, 'destroy'])->name('aspirasi.destroy');
    
    // PROFIL
    Route::get('/profil', [DashboardController::class, 'profil'])->name('profil');
    Route::put('/profil', [DashboardController::class, 'updateProfil'])->name('profil.update');
    Route::put('/profil/password', [DashboardController::class, 'updatePassword'])->name('profil.password');
    Route::post('/profil/foto', [DashboardController::class, 'updateFoto'])->name('profil.foto');
    
    // UMKM
    Route::get('/umkm/create', [UmkmController::class, 'createForm'])->name('umkm.create');
    Route::post('/umkm/store', [UmkmController::class, 'storeMasyarakat'])->name('umkm.store');
    Route::get('/umkm/status', [UmkmController::class, 'statusMasyarakat'])->name('umkm.status');
    
    // KEUANGAN MASYARAKAT
    Route::get('/keuangan', [App\Http\Controllers\Masyarakat\KeuanganController::class, 'index'])->name('keuangan.index');
    Route::get('/keuangan/{id}', [App\Http\Controllers\Masyarakat\KeuanganController::class, 'show'])->name('keuangan.show');
    
    // STATISTIK MASYARAKAT
    Route::get('/statistik', [App\Http\Controllers\Masyarakat\StatistikController::class, 'masyarakat'])->name('statistik');
});

// ==============================================
// ROUTES UNTUK KELOLA UMKM (SETELAH APPROVED)
// ==============================================

Route::middleware(['auth', 'role:umkm'])->prefix('umkm')->name('umkm.')->group(function () {
    Route::get('/profil', [UmkmController::class, 'editProfil'])->name('profil.edit');
    Route::put('/profil', [UmkmController::class, 'updateProfil']);
    Route::get('/produk', [UmkmController::class, 'produkIndex'])->name('produk.index');
    Route::get('/produk/{umkmId?}', [UmkmController::class, 'produkIndex'])->whereNumber('umkmId')->name('produk.index.umkm');
    Route::get('/produk/create/{umkmId?}', [UmkmController::class, 'produkCreate'])->whereNumber('umkmId')->name('produk.create');
    Route::post('/produk', [UmkmController::class, 'produkStore'])->name('produk.store');
    Route::get('/produk/{id}/edit', [UmkmController::class, 'produkEdit'])->whereNumber('id')->name('produk.edit');
    Route::post('/produk/{id}', [UmkmController::class, 'produkUpdate'])->whereNumber('id')->name('produk.update');
    Route::delete('/produk/{id}', [UmkmController::class, 'produkDestroy'])->whereNumber('id')->name('produk.destroy');
});

// ==============================================
// ROUTES UNTUK ROLE: ADMIN
// ==============================================

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    // DASHBOARD
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // UMKM
    Route::get('/umkm', [AdminController::class, 'umkm'])->name('umkm.index');
    Route::post('/umkm/{id}/approve', [AdminController::class, 'umkmApprove'])->name('umkm.approve');
    Route::post('/umkm/{id}/reject', [AdminController::class, 'umkmReject'])->name('umkm.reject');
    Route::delete('/umkm/{id}', [AdminController::class, 'umkmDestroy'])->name('umkm.destroy');
    
    // PENGAJUAN SURAT
    Route::get('/pengajuan-surat', [AdminController::class, 'pengajuanSurat'])->name('pengajuan-surat.index');
    Route::get('/pengajuan-surat/{id}/download-surat', [AdminController::class, 'pengajuanSuratDownload'])->whereNumber('id')->name('pengajuan-surat.download-surat');
    Route::get('/pengajuan-surat/{id}/download-pendukung', [AdminController::class, 'pengajuanSuratDownloadPendukung'])->whereNumber('id')->name('pengajuan-surat.download-pendukung');
    Route::post('/pengajuan-surat/{id}/approve', [AdminController::class, 'pengajuanSuratApprove'])->whereNumber('id')->name('pengajuan-surat.approve');
    Route::post('/pengajuan-surat/{id}/complete', [AdminController::class, 'pengajuanSuratComplete'])->whereNumber('id')->name('pengajuan-surat.complete');
    Route::post('/pengajuan-surat/{id}/reject', [AdminController::class, 'pengajuanSuratReject'])->whereNumber('id')->name('pengajuan-surat.reject');
    Route::delete('/pengajuan-surat/{id}', [AdminController::class, 'pengajuanSuratDestroy'])->whereNumber('id')->name('pengajuan-surat.destroy');
    Route::get('/pengajuan-surat/{id}', [AdminController::class, 'pengajuanSuratShow'])->whereNumber('id')->name('pengajuan-surat.show');
    
    // ASPIRASI
    Route::get('/aspirasi', [AdminController::class, 'aspirasi'])->name('aspirasi.index');
    Route::post('/aspirasi/{id}/respond', [AdminController::class, 'aspirasiRespond'])->name('aspirasi.respond');
    Route::post('/aspirasi/{id}/status', [AdminController::class, 'aspirasiStatus'])->name('aspirasi.status');
    Route::delete('/aspirasi/{id}', [AdminController::class, 'aspirasiDestroy'])->name('aspirasi.destroy');
    Route::get('/aspirasi/{id}', [AdminController::class, 'aspirasiShow'])->name('aspirasi.show');
    
    // BERITA
    Route::get('/berita', [AdminController::class, 'berita'])->name('berita.index');
    Route::get('/berita/create', [AdminController::class, 'beritaCreate'])->name('berita.create');
    Route::post('/berita', [AdminController::class, 'beritaStore'])->name('berita.store');
    Route::get('/berita/{id}/edit', [AdminController::class, 'beritaEdit'])->name('berita.edit');
    Route::put('/berita/{id}', [AdminController::class, 'beritaUpdate'])->name('berita.update');
    Route::delete('/berita/{id}', [AdminController::class, 'beritaDestroy'])->name('berita.destroy');
    
    // GALERI
    Route::get('/galeri', [AdminController::class, 'galeri'])->name('galeri.index');
    Route::get('/galeri/create', [AdminController::class, 'galeriCreate'])->name('galeri.create');
    Route::post('/galeri', [AdminController::class, 'galeriStore'])->name('galeri.store');
    Route::get('/galeri/{id}', [AdminController::class, 'galeriShow'])->name('galeri.show');
    Route::get('/galeri/{id}/edit', [AdminController::class, 'galeriEdit'])->name('galeri.edit');
    Route::put('/galeri/{id}', [AdminController::class, 'galeriUpdate'])->name('galeri.update');
    Route::delete('/galeri/{id}', [AdminController::class, 'galeriDestroy'])->name('galeri.destroy');
    
    // DATA PENDUDUK
    Route::get('/penduduk', [AdminController::class, 'penduduk'])->name('penduduk.index');
    Route::get('/penduduk/create', [AdminController::class, 'pendudukCreate'])->name('penduduk.create');
    Route::post('/penduduk', [AdminController::class, 'pendudukStore'])->name('penduduk.store');
    Route::get('/penduduk/{id}/edit', [AdminController::class, 'pendudukEdit'])->name('penduduk.edit');
    Route::put('/penduduk/{id}', [AdminController::class, 'pendudukUpdate'])->name('penduduk.update');
    Route::delete('/penduduk/{id}', [AdminController::class, 'pendudukDestroy'])->name('penduduk.destroy');
    
    // PROFIL DESA (ADMIN)
    Route::get('/profil-desa', [App\Http\Controllers\Admin\ProfilDesaController::class, 'index'])->name('profil-desa.index');
    Route::get('/profil-desa/edit', [App\Http\Controllers\Admin\ProfilDesaController::class, 'edit'])->name('profil-desa.edit');
    Route::put('/profil-desa', [App\Http\Controllers\Admin\ProfilDesaController::class, 'update'])->name('profil-desa.update');
    
    // DATA PENGURUS
    Route::prefix('pengurus')->name('pengurus.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\DataPengurusController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\DataPengurusController::class, 'create'])->name('create');
        Route::post('/', [App\Http\Controllers\Admin\DataPengurusController::class, 'store'])->name('store');
        Route::get('/kategori', [App\Http\Controllers\Admin\DataPengurusController::class, 'showKategori'])->name('kategori');
        Route::post('/kategori', [App\Http\Controllers\Admin\DataPengurusController::class, 'storeKategori'])->name('kategori.store');
        Route::delete('/kategori/{key}', [App\Http\Controllers\Admin\DataPengurusController::class, 'destroyKategori'])->name('kategori.destroy');
        Route::post('/update-urutan', [App\Http\Controllers\Admin\DataPengurusController::class, 'updateUrutan'])->name('update-urutan');
        Route::post('/sync-levels', [App\Http\Controllers\Admin\DataPengurusController::class, 'syncLevels'])->name('sync-levels');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\DataPengurusController::class, 'edit'])->whereNumber('id')->name('edit');
        Route::post('/{id}/naik', [App\Http\Controllers\Admin\DataPengurusController::class, 'naikUrutan'])->whereNumber('id')->name('naik');
        Route::post('/{id}/turun', [App\Http\Controllers\Admin\DataPengurusController::class, 'turunUrutan'])->whereNumber('id')->name('turun');
        Route::put('/{id}', [App\Http\Controllers\Admin\DataPengurusController::class, 'update'])->whereNumber('id')->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\DataPengurusController::class, 'destroy'])->whereNumber('id')->name('destroy');
    });
    
    // STATISTIK
    Route::get('/statistik', [AdminController::class, 'statistik'])->name('statistik.index');
    Route::get('/statistik/kelola', [AdminController::class, 'statistikKelola'])->name('statistik.kelola');
    Route::put('/statistik/update', [AdminController::class, 'statistikUpdate'])->name('statistik.update');
    
    // KEUANGAN ADMIN
    Route::prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\KeuanganController::class, 'index'])->name('index');
        Route::get('/create', [App\Http\Controllers\Admin\KeuanganController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Admin\KeuanganController::class, 'store'])->name('store');
        Route::get('/kategori', [App\Http\Controllers\Admin\KeuanganController::class, 'kategori'])->name('kategori');
        Route::post('/kategori/store', [App\Http\Controllers\Admin\KeuanganController::class, 'kategoriStore'])->name('kategori.store');
        Route::put('/kategori/{id}', [App\Http\Controllers\Admin\KeuanganController::class, 'kategoriUpdate'])->whereNumber('id')->name('kategori.update');
        Route::delete('/kategori/{id}', [App\Http\Controllers\Admin\KeuanganController::class, 'kategoriDestroy'])->whereNumber('id')->name('kategori.destroy');
        Route::get('/laporan', [App\Http\Controllers\Admin\KeuanganController::class, 'laporan'])->name('laporan');
        Route::get('/{id}/edit', [App\Http\Controllers\Admin\KeuanganController::class, 'edit'])->whereNumber('id')->name('edit');
        Route::get('/{id}', [App\Http\Controllers\Admin\KeuanganController::class, 'show'])->whereNumber('id')->name('show');
        Route::put('/{id}', [App\Http\Controllers\Admin\KeuanganController::class, 'update'])->whereNumber('id')->name('update');
        Route::delete('/{id}', [App\Http\Controllers\Admin\KeuanganController::class, 'destroy'])->whereNumber('id')->name('destroy');
    });

    // KONTAK DESA
    Route::resource('kontak-desa', App\Http\Controllers\Admin\KontakDesaController::class);
    Route::get('/kontak-desa/{id}/toggle-status', [KontakDesaController::class, 'toggleStatus'])->name('kontak-desa.toggle-status');

    // NOTIFIKASI ADMIN
    Route::get('/notifikasi', [NotifikasiController::class, 'adminIndex'])->name('notifikasi.index');
});