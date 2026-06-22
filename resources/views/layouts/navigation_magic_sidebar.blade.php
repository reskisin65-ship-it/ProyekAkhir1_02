{{-- resources/views/layouts/navigation_magic_sidebar.blade.php --}}

<aside class="magic-sidebar" id="magic-sidebar">

    {{-- Arrow toggle button — top of sidebar --}}
    <button id="sidebar-toggle"
        onclick="toggleSidebar()"
        title="Perlebar / Perkecil Sidebar"
        class="side-item side-toggle-btn flex-shrink-0 group"
        style="margin-bottom: 4px;">
        <i id="sidebar-toggle-icon" class="fa-solid fa-chevron-right side-icon" style="font-size:14px; transition: transform 0.4s ease;"></i>
        <span class="side-label" style="font-size:10px;">Tutup</span>
    </button>

    {{-- Divider --}}
    <div style="width:100%;height:1px;background:rgba(255,255,255,0.12);margin:0 0 4px 0;"></div>


    {{-- ============================================= --}}
    {{-- SIDEBAR UNTUK GUEST (BELUM LOGIN) --}}
    {{-- ============================================= --}}
    @guest
        <a href="{{ route('home') }}" class="side-item group">
            <i class="fa-solid fa-house side-icon"></i>
            <span class="side-label">Beranda</span>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Beranda</h5>
                <p class="text-xs text-gray-400">Halaman utama</p>
            </div>
        </a>
        <a href="{{ route('profil-desa') }}" class="side-item group">
            <i class="fa-solid fa-landmark-dome side-icon"></i>
            <span class="side-label">Profil Desa</span>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">🛕 Profil Desa</h5>
                <p class="text-xs text-gray-400">Sejarah, visi misi, struktur</p>
            </div>
        </a>
        <a href="{{ route('berita') }}" class="side-item group">
            <i class="fa-solid fa-newspaper side-icon"></i>
            <span class="side-label">Berita</span>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                <p class="text-xs text-gray-400">Informasi terkini</p>
            </div>
        </a>
        <a href="{{ route('galeri') }}" class="side-item group">
            <i class="fa-solid fa-photo-film side-icon"></i>
            <span class="side-label">Galeri</span>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
            </div>
        </a>
        <a href="{{ route('umkm') }}" class="side-item group">
            <i class="fa-solid fa-shop side-icon"></i>
            <span class="side-label">UMKM</span>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM</h5>
                <p class="text-xs text-gray-400">Produk unggulan</p>
            </div>
        </a>
        <a href="{{ route('kontak') }}" class="side-item group">
            <i class="fa-solid fa-envelope side-icon"></i>
            <span class="side-label">Kontak</span>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak</h5>
                <p class="text-xs text-gray-400">Hubungi kami</p>
            </div>
        </a>
        <a href="{{ route('statistik.publik') }}" class="side-item group">
            <i class="fa-solid fa-chart-simple side-icon"></i>
            <span class="side-label">Statistik</span>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
                <p class="text-xs text-gray-400">Data statistik desa</p>
            </div>
        </a>
    @endguest

    {{-- ============================================= --}}
    {{-- SIDEBAR UNTUK ROLE: ADMIN --}}
    {{-- ============================================= --}}
    @auth
        @php
        $isAdminArea = Request::routeIs('admin.*');
    @endphp
    @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin' && $isAdminArea)
            <a href="{{ route('admin.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-chart-line side-icon"></i>
                <span class="side-label">Dashboard</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Ringkasan data desa</p>
                </div>
            </a>
            <a href="{{ route('admin.pengajuan-surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope side-icon"></i>
                <span class="side-label">Surat</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Pengajuan Surat</h5>
                    <p class="text-xs text-gray-400">Kelola surat warga</p>
                </div>
            </a>
            <a href="{{ route('admin.penduduk.index') }}" class="side-item group">
                <i class="fa-solid fa-users side-icon"></i>
                <span class="side-label">Penduduk</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Data Penduduk</h5>
                    <p class="text-xs text-gray-400">Kelola data warga</p>
                </div>
            </a>
            <a href="{{ route('admin.keluarga.index') }}" class="side-item group">
                <i class="fa-solid fa-house-chimney side-icon"></i>
                <span class="side-label">Keluarga</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Data Keluarga</h5>
                    <p class="text-xs text-gray-400">Kelola data keluarga</p>
                </div>
            </a>
            <a href="{{ route('admin.berita.index') }}" class="side-item group">
                <i class="fa-solid fa-newspaper side-icon"></i>
                <span class="side-label">Berita</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Kelola berita desa</p>
                </div>
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="side-item group">
                <i class="fa-solid fa-photo-film side-icon"></i>
                <span class="side-label">Galeri</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Kelola galeri foto</p>
                </div>
            </a>
            <a href="{{ route('admin.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots side-icon"></i>
                <span class="side-label">Aspirasi</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Aspirasi</h5>
                    <p class="text-xs text-gray-400">Kelola aspirasi warga</p>
                </div>
            </a>
            <a href="{{ route('admin.umkm.index') }}" class="side-item group">
                <i class="fa-solid fa-store side-icon"></i>
                <span class="side-label">UMKM</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM</h5>
                    <p class="text-xs text-gray-400">Kelola UMKM desa</p>
                </div>
            </a>
            <a href="{{ route('admin.pengurus.index') }}" class="side-item group">
                <i class="fa-solid fa-user-tie side-icon"></i>
                <span class="side-label">Pengurus</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Pengurus Desa</h5>
                    <p class="text-xs text-gray-400">Kelola data pengurus</p>
                </div>
            </a>
            <a href="{{ route('admin.statistik.index') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple side-icon"></i>
                <span class="side-label">Statistik</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Statistik</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('admin.keuangan.index') }}" class="side-item group">
                <i class="fa-solid fa-coins side-icon"></i>
                <span class="side-label">Keuangan</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Keuangan Desa</h5>
                    <p class="text-xs text-gray-400">Kelola pemasukan &amp; pengeluaran</p>
                </div>
            </a>
            <a href="{{ route('admin.profil-desa.index') }}" class="side-item group">
                <i class="fa-solid fa-building side-icon"></i>
                <span class="side-label">Profil</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🛕 Profil Desa</h5>
                    <p class="text-xs text-gray-400">Kelola profil desa</p>
                </div>
            </a>
            <a href="{{ route('admin.kontak-desa.index') }}" class="side-item group">
                <i class="fa-solid fa-address-book side-icon"></i>
                <span class="side-label">Kontak</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak Desa</h5>
                    <p class="text-xs text-gray-400">Kelola daftar kontak</p>
                </div>
            </a>
            <a href="{{ route('admin.notifikasi.index') }}" class="side-item group">
                <i class="fa-regular fa-bell side-icon"></i>
                <span class="side-label">Notifikasi</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🔔 Notifikasi</h5>
                    <p class="text-xs text-gray-400">Lihat semua notifikasi</p>
                </div>
            </a>

    {{-- ============================================= --}}
    {{-- SIDEBAR UNTUK ROLE: UMKM --}}
    {{-- ============================================= --}}
        @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'admin' && !$isAdminArea)
            <a href="{{ route('masyarakat.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-chart-line side-icon"></i>
                <span class="side-label">Dashboard</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Aktivitas Anda</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.create') }}" class="side-item group">
                <i class="fa-solid fa-file-signature side-icon"></i>
                <span class="side-label">Ajukan</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Ajukan Surat</h5>
                    <p class="text-xs text-gray-400">Buat pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope side-icon"></i>
                <span class="side-label">Riwayat</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Riwayat Surat</h5>
                    <p class="text-xs text-gray-400">Status pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots side-icon"></i>
                <span class="side-label">Aspirasi</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Aspirasi Saya</h5>
                    <p class="text-xs text-gray-400">Lihat aspirasi yang dikirim</p>
                </div>
            </a>
            <a href="{{ route('berita') }}" class="side-item group">
                <i class="fa-solid fa-newspaper side-icon"></i>
                <span class="side-label">Berita</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Informasi terkini</p>
                </div>
            </a>
            <a href="{{ route('galeri') }}" class="side-item group">
                <i class="fa-solid fa-photo-film side-icon"></i>
                <span class="side-label">Galeri</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
                </div>
            </a>
            <a href="{{ route('umkm') }}" class="side-item group">
                <i class="fa-solid fa-store side-icon"></i>
                <span class="side-label">UMKM</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM</h5>
                    <p class="text-xs text-gray-400">Produk unggulan desa</p>
                </div>
            </a>
            <a href="{{ route('kontak') }}" class="side-item group">
                <i class="fa-solid fa-envelope side-icon"></i>
                <span class="side-label">Kontak</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak</h5>
                    <p class="text-xs text-gray-400">Hubungi kami</p>
                </div>
            </a>
            <a href="{{ route('statistik.publik') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple side-icon"></i>
                <span class="side-label">Statistik</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('profil-desa') }}" class="side-item group">
                <i class="fa-solid fa-landmark-dome side-icon"></i>
                <span class="side-label">Profil</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Profil Desa</h5>
                    <p class="text-xs text-gray-400">Sejarah, visi misi, struktur</p>
                </div>
            </a>
            <a href="{{ route('notifikasi.index') }}" class="side-item group">
                <i class="fa-regular fa-bell side-icon"></i>
                <span class="side-label">Notifikasi</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Notifikasi</h5>
                    <p class="text-xs text-gray-400">Lihat semua notifikasi</p>
                </div>
            </a>
            {{-- Tombol kembali ke Admin Panel --}}
            <a href="{{ route('admin.dashboard') }}" class="side-item group" style="border:1px solid rgba(59,130,246,0.4);">
                <i class="fa-solid fa-shield-halved side-icon" style="color:#60a5fa;"></i>
                <span class="side-label" style="color:#93c5fd;">Admin</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase tracking-wider" style="color:#3b82f6;">Admin Panel</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kembali ke Admin</h5>
                    <p class="text-xs text-gray-400">Masuk ke dashboard admin</p>
                </div>
            </a>

        @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
            @php $currentUmkmId = optional(Auth::user()->umkm)->id_umkm; @endphp
            <a href="{{ route('masyarakat.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-chart-line side-icon"></i>
                <span class="side-label">Dashboard</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Aktivitas Anda</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.create') }}" class="side-item group">
                <i class="fa-solid fa-file-signature side-icon"></i>
                <span class="side-label">Ajukan</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Ajukan Surat</h5>
                    <p class="text-xs text-gray-400">Buat pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope side-icon"></i>
                <span class="side-label">Riwayat</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Riwayat Surat</h5>
                    <p class="text-xs text-gray-400">Status pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots side-icon"></i>
                <span class="side-label">Aspirasi</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Aspirasi Saya</h5>
                    <p class="text-xs text-gray-400">Lihat aspirasi yang dikirim</p>
                </div>
            </a>
            <a href="{{ route('berita') }}" class="side-item group">
                <i class="fa-solid fa-newspaper side-icon"></i>
                <span class="side-label">Berita</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Informasi terkini</p>
                </div>
            </a>
            <a href="{{ route('galeri') }}" class="side-item group">
                <i class="fa-solid fa-photo-film side-icon"></i>
                <span class="side-label">Galeri</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
                </div>
            </a>
            <a href="{{ route('umkm') }}" class="side-item group">
                <i class="fa-solid fa-shop side-icon"></i>
                <span class="side-label">UMKM</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM Lainnya</h5>
                    <p class="text-xs text-gray-400">Lihat UMKM desa lainnya</p>
                </div>
            </a>
            <a href="{{ route('kontak') }}" class="side-item group">
                <i class="fa-solid fa-envelope side-icon"></i>
                <span class="side-label">Kontak</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak</h5>
                    <p class="text-xs text-gray-400">Hubungi kami</p>
                </div>
            </a>
            <a href="{{ $currentUmkmId ? route('umkm.show', $currentUmkmId) : route('umkm') }}" class="side-item group">
                <i class="fa-solid fa-boxes-stacked side-icon"></i>
                <span class="side-label">Produk</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu UMKM</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kelola USAHA</h5>
                    <p class="text-xs text-gray-400">Kelola usaha Anda</p>
                </div>
            </a>
            <a href="{{ route('statistik.publik') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple side-icon"></i>
                <span class="side-label">Statistik</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('profil-desa') }}" class="side-item group">
                <i class="fa-solid fa-landmark-dome side-icon"></i>
                <span class="side-label">Profil</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">�� Profil Desa</h5>
                    <p class="text-xs text-gray-400">Sejarah, visi misi, struktur</p>
                </div>
            </a>
            <a href="{{ route('notifikasi.index') }}" class="side-item group relative">
                <i class="fa-regular fa-bell side-icon"></i>
                @if(isset($unreadNotifications) && $unreadNotifications > 0)
                    <span class="absolute top-1 right-1 inline-flex items-center justify-center w-5 h-5 rounded-full bg-red-500 text-[10px] font-bold text-white shadow-lg">
                        {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                    </span>
                @endif
                <span class="side-label">Notifikasi</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🔔 Notifikasi</h5>
                    <p class="text-xs text-gray-400">Lihat semua notifikasi</p>
                </div>
            </a>

    {{-- ============================================= --}}
    {{-- SIDEBAR UNTUK ROLE: MASYARAKAT --}}
    {{-- ============================================= --}}
        @else
            <a href="{{ route('masyarakat.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-chart-line side-icon"></i>
                <span class="side-label">Dashboard</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Aktivitas Anda</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.create') }}" class="side-item group">
                <i class="fa-solid fa-file-signature side-icon"></i>
                <span class="side-label">Ajukan</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Ajukan Surat</h5>
                    <p class="text-xs text-gray-400">Buat pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope side-icon"></i>
                <span class="side-label">Riwayat</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Riwayat Surat</h5>
                    <p class="text-xs text-gray-400">Status pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots side-icon"></i>
                <span class="side-label">Aspirasi</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Aspirasi Saya</h5>
                    <p class="text-xs text-gray-400">Lihat aspirasi yang dikirim</p>
                </div>
            </a>
            <a href="{{ route('berita') }}" class="side-item group">
                <i class="fa-solid fa-newspaper side-icon"></i>
                <span class="side-label">Berita</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Informasi terkini</p>
                </div>
            </a>
            <a href="{{ route('galeri') }}" class="side-item group">
                <i class="fa-solid fa-photo-film side-icon"></i>
                <span class="side-label">Galeri</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
                </div>
            </a>
            <a href="{{ route('umkm') }}" class="side-item group">
                <i class="fa-solid fa-store side-icon"></i>
                <span class="side-label">UMKM</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM</h5>
                    <p class="text-xs text-gray-400">Produk unggulan desa</p>
                </div>
            </a>
            <a href="{{ route('kontak') }}" class="side-item group">
                <i class="fa-solid fa-envelope side-icon"></i>
                <span class="side-label">Kontak</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak</h5>
                    <p class="text-xs text-gray-400">Hubungi kami</p>
                </div>
            </a>
            <a href="{{ route('statistik.publik') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple side-icon"></i>
                <span class="side-label">Statistik</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('profil-desa') }}" class="side-item group">
                <i class="fa-solid fa-landmark-dome side-icon"></i>
                <span class="side-label">Profil</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🛕 Profil Desa</h5>
                    <p class="text-xs text-gray-400">Sejarah, visi misi, struktur</p>
                </div>
            </a>
            <a href="{{ route('notifikasi.index') }}" class="side-item group">
                <i class="fa-regular fa-bell side-icon"></i>
                <span class="side-label">Notifikasi</span>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🔔 Notifikasi</h5>
                    <p class="text-xs text-gray-400">Lihat semua notifikasi</p>
                </div>
            </a>
        @endif

        {{-- Logout untuk semua role yang login --}}
        <div class="w-full h-px bg-white/20 my-2"></div>
        <button type="button" class="side-item side-logout group" onclick="if(window.__openLogoutDialog){window.__openLogoutDialog().then(ok=>{if(ok)document.getElementById('sidebar-logout-form').submit();})}else{document.getElementById('sidebar-logout-form').submit();}">
            <i class="fa-solid fa-sign-out-alt side-icon"></i>
            <span class="side-label" style="color:#f87171;">Keluar</span>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-red-500 tracking-wider">Aksi</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Logout</h5>
                <p class="text-xs text-gray-400">Keluar dari portal</p>
            </div>
        </button>
        <form id="sidebar-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    @endauth
</aside>

{{-- Mobile Bottom Navigation --}}
<div class="mobile-nav" id="mobile-nav">
    <div class="flex-1 flex items-center justify-around overflow-x-auto no-scrollbar">
        @auth
            @php
        $isAdminArea = Request::routeIs('admin.*');
    @endphp
    @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin' && $isAdminArea)
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.pengajuan-surat.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Surat</span>
                </a>
                <a href="{{ route('admin.penduduk.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-users"></i>
                    <span>Penduduk</span>
                </a>
                <a href="{{ route('admin.keluarga.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-house-chimney"></i>
                    <span>Keluarga</span>
                </a>
                <a href="{{ route('admin.berita.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Berita</span>
                </a>
                <a href="{{ route('admin.galeri.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-photo-film"></i>
                    <span>Galeri</span>
                </a>
                <a href="{{ route('admin.aspirasi.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span>Aspirasi</span>
                </a>
                <a href="{{ route('admin.umkm.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-store"></i>
                    <span>UMKM</span>
                </a>
                <a href="{{ route('admin.pengurus.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-user-tie"></i>
                    <span>Pengurus</span>
                </a>
                <a href="{{ route('admin.statistik.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Statistik</span>
                </a>
                <a href="{{ route('admin.keuangan.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-coins"></i>
                    <span>Keuangan</span>
                </a>
                <a href="{{ route('admin.profil-desa.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-landmark-dome"></i>
                    <span>Profil</span>
                </a>
                <a href="{{ route('admin.kontak-desa.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>Kontak</span>
                </a>
                <a href="{{ route('admin.notifikasi.index') }}" class="mobile-nav-item">
                    <i class="fa-regular fa-bell"></i>
                    <span>Notif</span>
                </a>
            @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'admin' && !$isAdminArea)
                {{-- Admin di halaman publik: menu mobile identik masyarakat --}}
                <a href="{{ route('masyarakat.dashboard') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('masyarakat.surat.create') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-file-signature"></i>
                    <span>Ajukan</span>
                </a>
                <a href="{{ route('masyarakat.surat.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Riwayat</span>
                </a>
                <a href="{{ route('masyarakat.aspirasi.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span>Aspirasi</span>
                </a>
                <a href="{{ route('berita') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Berita</span>
                </a>
                <a href="{{ route('galeri') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-photo-film"></i>
                    <span>Galeri</span>
                </a>
                <a href="{{ route('umkm') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-store"></i>
                    <span>UMKM</span>
                </a>
                <a href="{{ route('kontak') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>Kontak</span>
                </a>
                <a href="{{ route('statistik.publik') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Statistik</span>
                </a>
                <a href="{{ route('profil-desa') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-landmark-dome"></i>
                    <span>Profil</span>
                </a>
                <a href="{{ route('notifikasi.index') }}" class="mobile-nav-item">
                    <i class="fa-regular fa-bell"></i>
                    <span>Notif</span>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-shield-halved" style="color:#60a5fa;"></i>
                    <span style="color:#93c5fd;">Admin</span>
                </a>

        @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
                @php $currentUmkmId = optional(Auth::user()->umkm)->id_umkm; @endphp
                <a href="{{ route('masyarakat.dashboard') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('masyarakat.surat.create') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-file-signature"></i>
                    <span>Ajukan</span>
                </a>
                <a href="{{ route('masyarakat.surat.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Riwayat</span>
                </a>
                <a href="{{ route('masyarakat.aspirasi.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span>Aspirasi</span>
                </a>
                <a href="{{ route('berita') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Berita</span>
                </a>
                <a href="{{ route('galeri') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-photo-film"></i>
                    <span>Galeri</span>
                </a>
                <a href="{{ route('umkm') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-store"></i>
                    <span>UMKM</span>
                </a>
                <a href="{{ route('statistik.publik') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Statistik</span>
                </a>
                <a href="{{ route('profil-desa') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-landmark-dome"></i>
                    <span>Profil</span>
                </a>
                <a href="{{ route('kontak') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>Kontak</span>
                </a>
                <a href="{{ $currentUmkmId ? route('umkm.show', $currentUmkmId) : route('umkm') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <span>Produk</span>
                </a>
                <a href="{{ route('notifikasi.index') }}" class="mobile-nav-item">
                    <i class="fa-regular fa-bell"></i>
                    <span>Notif</span>
                </a>
            @else
                <a href="{{ route('masyarakat.dashboard') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-chart-line"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('masyarakat.surat.create') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-file-signature"></i>
                    <span>Ajukan</span>
                </a>
                <a href="{{ route('masyarakat.surat.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Riwayat</span>
                </a>
                <a href="{{ route('masyarakat.aspirasi.index') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-comment-dots"></i>
                    <span>Aspirasi</span>
                </a>
                <a href="{{ route('berita') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-newspaper"></i>
                    <span>Berita</span>
                </a>
                <a href="{{ route('galeri') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-photo-film"></i>
                    <span>Galeri</span>
                </a>
                <a href="{{ route('umkm') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-store"></i>
                    <span>UMKM</span>
                </a>
                <a href="{{ route('statistik.publik') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-chart-simple"></i>
                    <span>Statistik</span>
                </a>
                <a href="{{ route('profil-desa') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-landmark-dome"></i>
                    <span>Profil</span>
                </a>
                <a href="{{ route('kontak') }}" class="mobile-nav-item">
                    <i class="fa-solid fa-phone"></i>
                    <span>Kontak</span>
                </a>
                <a href="{{ route('notifikasi.index') }}" class="mobile-nav-item">
                    <i class="fa-regular fa-bell"></i>
                    <span>Notif</span>
                </a>
            @endif
        @else
            <a href="{{ route('home') }}" class="mobile-nav-item">
                <i class="fa-solid fa-house"></i>
                <span>Beranda</span>
            </a>
            <a href="{{ route('profil-desa') }}" class="mobile-nav-item">
                <i class="fa-solid fa-landmark-dome"></i>
                <span>Profil</span>
            </a>
            <a href="{{ route('berita') }}" class="mobile-nav-item">
                <i class="fa-solid fa-newspaper"></i>
                <span>Berita</span>
            </a>
            <a href="{{ route('galeri') }}" class="mobile-nav-item">
                <i class="fa-solid fa-photo-film"></i>
                <span>Galeri</span>
            </a>
            <a href="{{ route('umkm') }}" class="mobile-nav-item">
                <i class="fa-solid fa-store"></i>
                <span>UMKM</span>
            </a>
            <a href="{{ route('statistik.publik') }}" class="mobile-nav-item">
                <i class="fa-solid fa-chart-simple"></i>
                <span>Statistik</span>
            </a>
            <a href="{{ route('kontak') }}" class="mobile-nav-item">
                <i class="fa-solid fa-phone"></i>
                <span>Kontak</span>
            </a>
        @endauth
    </div>

    <!-- Divider -->
    <div class="w-px h-10 bg-white/20 flex-shrink-0 mx-1"></div>

    <!-- Login/Logout CTA -->
    <div class="flex-shrink-0 flex flex-col items-center justify-center gap-0.5">
        @auth
            <form id="mobile-logout-form" action="{{ route('logout') }}" method="POST" class="hidden">@csrf</form>
            <button type="button"
                    onclick="if(window.__openLogoutDialog){window.__openLogoutDialog().then(ok=>{if(ok)document.getElementById('mobile-logout-form').submit();})}else{document.getElementById('mobile-logout-form').submit();}"
                    class="mobile-nav-item text-red-400 hover:text-red-300">
                <i class="fa-solid fa-sign-out-alt"></i>
                <span>Keluar</span>
            </button>
        @else
            <a href="{{ route('login') }}" class="mobile-nav-item">
                <i class="fa-solid fa-user"></i>
                <span>Masuk</span>
            </a>
        @endauth
    </div>
</div>

<style>
    /* ==========================================
       DESKTOP SIDEBAR (Magic Sidebar)
       ========================================== */
    .magic-sidebar {
        position: fixed;
        left: 30px;
        top: 30px;
        bottom: 30px;
        transform: none;
        width: 65px;
        background: linear-gradient(135deg, #064e3b, #022c22);
        backdrop-filter: blur(20px);
        border-radius: 35px;
        z-index: 1100;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        gap: 12px;
        padding: 20px 0;
        box-shadow: 0 25px 50px rgba(6, 78, 59, 0.3);
        border: 1px solid rgba(255,255,255,0.12);
        height: auto;
        max-height: calc(100vh - 60px);
        overflow-y: auto;
        overflow-x: visible;
        scrollbar-width: none;
        -ms-overflow-style: none;
        transition: width 0.4s cubic-bezier(0.4, 0, 0.2, 1), padding 0.4s cubic-bezier(0.4, 0, 0.2, 1), border-radius 0.4s;
    }

    .magic-sidebar::-webkit-scrollbar {
        display: none;
    }

    /* ---- EXPANDED STATE ---- */
    .magic-sidebar.expanded {
        width: 155px;
        border-radius: 28px;
        padding: 20px 10px;
        align-items: stretch;
    }

    .magic-sidebar.expanded .side-item {
        width: 100%;
        border-radius: 16px;
        justify-content: flex-start;
        padding: 0 12px;
        gap: 10px;
    }

    .magic-sidebar.expanded .side-label {
        opacity: 1;
        max-width: 120px;
        transform: translateX(0);
    }

    .magic-sidebar.expanded .info-box {
        display: none !important; /* Hide tooltip when expanded */
    }

    /* ---- SIDE ITEM ---- */
    .side-item {
        position: relative;
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px;
        color: rgba(255,255,255,0.55);
        font-size: 18px;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        cursor: pointer;
        flex-shrink: 0;
        text-decoration: none;
    }

    .side-item .side-icon {
        flex-shrink: 0;
        font-size: 18px;
        transition: font-size 0.3s;
    }

    /* Label teks (tersembunyi di mode collapsed) */
    .side-label {
        font-size: 11px;
        font-weight: 700;
        color: rgba(255,255,255,0.75);
        white-space: nowrap;
        overflow: hidden;
        opacity: 0;
        max-width: 0;
        transform: translateX(-8px);
        transition: opacity 0.35s ease, max-width 0.35s ease, transform 0.35s ease;
        letter-spacing: 0.02em;
    }

    .side-item:hover {
        color: #34d399 !important;
        background: rgba(255,255,255,0.18);
        transform: translateY(-3px) scale(1.1) rotate(5deg);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.15);
    }

    .magic-sidebar.expanded .side-item:hover {
        transform: translateX(3px) scale(1.02);
    }

    .side-item.active {
        color: #064e3b;
        background: #fff;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
        transform: scale(1.05);
    }

    .magic-sidebar.expanded .side-item.active {
        transform: translateX(3px);
    }

    /* Logout special */
    .side-item.side-logout:hover {
        color: #ef4444 !important;
        background: rgba(239, 68, 68, 0.15) !important;
        transform: translateY(-3px) scale(1.1) rotate(-5deg) !important;
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2) !important;
    }

    .magic-sidebar.expanded .side-item.side-logout:hover {
        transform: translateX(3px) !important;
    }

    /* ---- INFO BOX: hidden in DOM, cloned via JS to body as fixed tooltip ---- */
    .info-box {
        display: none !important;
    }

    /* ---- FLOATING TOOLTIP (injected by JS into <body>) ---- */
    #sidebar-floating-tooltip {
        position: fixed;
        background: rgba(255, 255, 255, 0.97);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        padding: 12px 20px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(6, 78, 59, 0.15);
        min-width: 220px;
        border: 1px solid rgba(16, 185, 129, 0.2);
        z-index: 9999;
        pointer-events: none;
        opacity: 0;
        transform: translateX(-8px);
        transition: opacity 0.25s ease, transform 0.25s cubic-bezier(0.34, 1.2, 0.64, 1);
    }
    #sidebar-floating-tooltip.visible {
        opacity: 1;
        transform: translateX(0);
    }
    #sidebar-floating-tooltip.logout-style {
        border-color: rgba(239, 68, 68, 0.25);
        box-shadow: 0 20px 40px rgba(239, 68, 68, 0.15);
    }
    #sidebar-floating-tooltip .tt-label {
        font-size: 8px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.12em;
        color: #10b981;
    }
    #sidebar-floating-tooltip.logout-style .tt-label {
        color: #ef4444;
    }
    #sidebar-floating-tooltip .tt-title {
        font-size: 14px;
        font-weight: 700;
        color: #064e3b;
        margin-top: 4px;
        font-style: italic;
    }
    #sidebar-floating-tooltip .tt-desc {
        font-size: 10px;
        color: #9ca3af;
        margin-top: 2px;
    }

    /* Arrow toggle button styles */
    .side-toggle-btn {
        position: relative;
    }
    .side-toggle-btn .side-icon {
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
    }
    .magic-sidebar.expanded .side-toggle-btn .side-icon {
        transform: rotate(180deg);
    }
    /* Hide the toggle button on mobile */
    @media (max-width: 1024px) {
        #sidebar-toggle { display: none !important; }
    }

    /* ---- Responsive Scaling by Screen Height ---- */
    @media (max-height: 850px) {
        .magic-sidebar { gap: 8px; padding: 15px 0; }
        .magic-sidebar.expanded { padding: 15px 10px; }
        .side-item { width: 38px; height: 38px; font-size: 16px; border-radius: 16px; }
        .side-item .side-icon { font-size: 16px; }
        .info-box { left: 60px; padding: 10px 16px; min-width: 200px; }
    }

    @media (max-height: 700px) {
        .magic-sidebar { gap: 6px; padding: 10px 0; }
        .magic-sidebar.expanded { padding: 10px 10px; }
        .side-item { width: 32px; height: 32px; font-size: 14px; border-radius: 12px; }
        .side-item .side-icon { font-size: 14px; }
        .info-box { left: 50px; padding: 8px 12px; min-width: 180px; }
    }

    /* ==========================================
       MOBILE BOTTOM NAVIGATION
       ========================================== */
    .mobile-nav {
        position: fixed;
        bottom: 14px;
        left: 50%;
        transform: translateX(-50%);
        width: 92%;
        max-width: min(500px, calc(100vw - 16px));
        height: 76px;
        background: #064e3b;
        border-radius: 28px;
        z-index: 1100;
        display: none;
        align-items: center;
        padding: 0 8px;
        box-shadow: 0 12px 36px rgba(0,0,0,0.3), 0 0 0 1px rgba(255,255,255,0.08);
        gap: 0;
    }

    /* Mobile nav item: icon + label stacked */
    .mobile-nav-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        color: rgba(255,255,255,0.55);
        text-decoration: none;
        flex-shrink: 0;
        min-width: 44px;
        padding: 6px 8px;
        border-radius: 12px;
        transition: color 0.25s, background 0.25s;
        cursor: pointer;
        background: none;
        border: none;
    }

    .mobile-nav-item i {
        font-size: 16px;
        line-height: 1;
    }

    .mobile-nav-item span {
        font-size: 9px;
        font-weight: 700;
        letter-spacing: 0.02em;
        white-space: nowrap;
        line-height: 1;
    }

    .mobile-nav-item:hover,
    .mobile-nav-item.active {
        color: #34d399;
        background: rgba(255,255,255,0.1);
    }

    /* Hide scrollbar utility */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    /* ==========================================
       RESPONSIVE BREAKPOINTS
       ========================================== */
    @media (min-width: 1025px) {
        .main-container {
            margin-left: 120px;
            transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .main-container.sidebar-open {
            margin-left: 210px;
        }
    }

    @media (max-width: 1024px) {
        .magic-sidebar { display: none; }
        #sidebar-toggle { display: none !important; }
        .mobile-nav { display: flex; }
        .main-container {
            margin-left: 0 !important;
            padding-top: 110px !important;
        }
    }

    .main-container {
        margin-left: 120px;
        padding-top: 120px;
        transition: margin-left 0.4s cubic-bezier(0.4, 0, 0.2, 1), padding-top 0.3s;
    }
</style>

<script>
(function() {
    var expanded = false;
    var saved = localStorage.getItem('sidebar-expanded');
    if (saved === 'true') expanded = true;

    function applySidebar() {
        var sidebar = document.getElementById('magic-sidebar');
        var icon = document.getElementById('sidebar-toggle-icon');
        var main = document.querySelector('.main-container');
        if (!sidebar) return;
        if (expanded) {
            sidebar.classList.add('expanded');
            if (icon) {
                icon.classList.remove('fa-chevron-right');
                icon.classList.add('fa-chevron-left');
            }
            if (main) main.classList.add('sidebar-open');
        } else {
            sidebar.classList.remove('expanded');
            if (icon) {
                icon.classList.remove('fa-chevron-left');
                icon.classList.add('fa-chevron-right');
            }
            if (main) main.classList.remove('sidebar-open');
        }
    }

    window.toggleSidebar = function() {
        expanded = !expanded;
        localStorage.setItem('sidebar-expanded', expanded ? 'true' : 'false');
        applySidebar();
    };

    // Apply on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', applySidebar);
    } else {
        applySidebar();
    }
})();
</script>

<script>
/* ── Floating sidebar tooltip (position: fixed, bypasses overflow clip) ── */
(function () {
    // Create the shared tooltip element once
    var tooltip = document.createElement('div');
    tooltip.id = 'sidebar-floating-tooltip';
    tooltip.innerHTML =
        '<div class="tt-label"></div>' +
        '<div class="tt-title"></div>' +
        '<div class="tt-desc"></div>';
    document.body.appendChild(tooltip);

    var hideTimer = null;

    function showTooltip(item) {
        var sidebar = document.getElementById('magic-sidebar');
        // Don't show tooltip when sidebar is expanded
        if (sidebar && sidebar.classList.contains('expanded')) return;

        var infoBox = item.querySelector('.info-box');
        if (!infoBox) return;

        // Read content from the hidden .info-box
        var labelEl = infoBox.querySelector('span');
        var titleEl = infoBox.querySelector('h5');
        var descEl  = infoBox.querySelector('p');

        tooltip.querySelector('.tt-label').textContent = labelEl ? labelEl.textContent : '';
        tooltip.querySelector('.tt-title').textContent = titleEl ? titleEl.textContent : '';
        tooltip.querySelector('.tt-desc').textContent  = descEl  ? descEl.textContent  : '';

        // Logout style
        if (item.classList.contains('side-logout')) {
            tooltip.classList.add('logout-style');
        } else {
            tooltip.classList.remove('logout-style');
        }

        // Position: vertically centered on the item, to its right
        var rect = item.getBoundingClientRect();
        var sidebarRect = sidebar ? sidebar.getBoundingClientRect() : { right: rect.right };
        var leftPos = sidebarRect.right + 12;
        var topPos  = rect.top + (rect.height / 2);

        tooltip.style.left = leftPos + 'px';
        tooltip.style.top  = topPos + 'px';
        tooltip.style.transform = 'translateX(-8px) translateY(-50%)';

        // Show
        clearTimeout(hideTimer);
        tooltip.classList.add('visible');
        tooltip.style.transform = 'translateX(0) translateY(-50%)';
    }

    function hideTooltip() {
        tooltip.classList.remove('visible');
        tooltip.style.transform = 'translateX(-8px) translateY(-50%)';
    }

    function bindItems() {
        var items = document.querySelectorAll('.magic-sidebar .side-item');
        items.forEach(function (item) {
            item.addEventListener('mouseenter', function () {
                clearTimeout(hideTimer);
                showTooltip(item);
            });
            item.addEventListener('mouseleave', function () {
                hideTimer = setTimeout(hideTooltip, 80);
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', bindItems);
    } else {
        bindItems();
    }
})();
</script>




