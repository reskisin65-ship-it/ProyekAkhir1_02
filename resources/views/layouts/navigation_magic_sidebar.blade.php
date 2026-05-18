{{-- resources/views/layouts/navigation_magic_sidebar.blade.php --}}
<aside class="magic-sidebar">
    
    {{-- ============================================= --}}
    {{-- SIDEBAR UNTUK GUEST (BELUM LOGIN) --}}
    {{-- ============================================= --}}
    @guest
        <a href="{{ route('home') }}" class="side-item group">
            <i class="fa-solid fa-house"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Beranda</h5>
                <p class="text-xs text-gray-400">Halaman utama</p>
            </div>
        </a>
        <a href="{{ route('profil-desa') }}" class="side-item group">
            <i class="fa-solid fa-landmark-dome"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">🏛️ Profil Desa</h5>
                <p class="text-xs text-gray-400">Sejarah, visi misi, struktur</p>
            </div>
        </a>
        <a href="{{ route('berita') }}" class="side-item group">
            <i class="fa-solid fa-newspaper"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                <p class="text-xs text-gray-400">Informasi terkini</p>
            </div>
        </a>
        <a href="{{ route('galeri') }}" class="side-item group">
            <i class="fa-solid fa-photo-film"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
            </div>
        </a>
        <a href="{{ route('umkm') }}" class="side-item group">
            <i class="fa-solid fa-shop"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM</h5>
                <p class="text-xs text-gray-400">Produk unggulan</p>
            </div>
        </a>
        <a href="{{ route('kontak') }}" class="side-item group">
            <i class="fa-solid fa-envelope"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak</h5>
                <p class="text-xs text-gray-400">Hubungi kami</p>
            </div>
        </a>
        <a href="{{ route('statistik.publik') }}" class="side-item group">
            <i class="fa-solid fa-chart-simple"></i>
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
        @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-chart-line"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Ringkasan data desa</p>
                </div>
            </a>
            <a href="{{ route('admin.pengajuan-surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Pengajuan Surat</h5>
                    <p class="text-xs text-gray-400">Kelola surat warga</p>
                </div>
            </a>
            <a href="{{ route('admin.penduduk.index') }}" class="side-item group">
                <i class="fa-solid fa-users"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Data Penduduk</h5>
                    <p class="text-xs text-gray-400">Kelola data warga</p>
                </div>
            </a>
            <a href="{{ route('admin.berita.index') }}" class="side-item group">
                <i class="fa-solid fa-newspaper"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Kelola berita desa</p>
                </div>
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="side-item group">
                <i class="fa-solid fa-photo-film"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Kelola galeri foto</p>
                </div>
            </a>
            <a href="{{ route('admin.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Aspirasi</h5>
                    <p class="text-xs text-gray-400">Kelola aspirasi warga</p>
                </div>
            </a>
            <a href="{{ route('admin.umkm.index') }}" class="side-item group">
                <i class="fa-solid fa-store"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM</h5>
                    <p class="text-xs text-gray-400">Kelola UMKM desa</p>
                </div>
            </a>
            <a href="{{ route('admin.pengurus.index') }}" class="side-item group">
                <i class="fa-solid fa-user-tie"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Pengurus Desa</h5>
                    <p class="text-xs text-gray-400">Kelola data pengurus</p>
                </div>
            </a>
            <a href="{{ route('admin.statistik.index') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Statistik</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('admin.keuangan.index') }}" class="side-item group">
                <i class="fa-solid fa-coins"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Keuangan Desa</h5>
                    <p class="text-xs text-gray-400">Kelola pemasukan & pengeluaran</p>
                </div>
            </a>
            <a href="{{ route('admin.profil-desa.index') }}" class="side-item group">
                <i class="fa-solid fa-building"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🏛️ Profil Desa</h5>
                    <p class="text-xs text-gray-400">Kelola profil desa</p>
                </div>
            </a>
            <a href="{{ route('admin.kontak-desa.index') }}" class="side-item group">
                <i class="fa-solid fa-address-book"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak Desa</h5>
                    <p class="text-xs text-gray-400">Kelola daftar kontak</p>
                </div>
            </a>
            <a href="{{ route('notifikasi.index') }}" class="side-item group">
                <i class="fa-regular fa-bell"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🔔 Notifikasi</h5>
                    <p class="text-xs text-gray-400">Lihat semua notifikasi</p>
                </div>
            </a>

    {{-- ============================================= --}}
    {{-- SIDEBAR UNTUK ROLE: UMKM --}}
    {{-- ============================================= --}}
        @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
            @php $currentUmkmId = optional(Auth::user()->umkm)->id_umkm; @endphp
            <a href="{{ route('masyarakat.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-chart-line"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Aktivitas Anda</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.create') }}" class="side-item group">
                <i class="fa-solid fa-file-signature"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Ajukan Surat</h5>
                    <p class="text-xs text-gray-400">Buat pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Riwayat Surat</h5>
                    <p class="text-xs text-gray-400">Status pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Aspirasi Saya</h5>
                    <p class="text-xs text-gray-400">Lihat aspirasi yang dikirim</p>
                </div>
            </a>
            <a href="{{ route('berita') }}" class="side-item group">
                <i class="fa-solid fa-newspaper"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Informasi terkini</p>
                </div>
            </a>
            <a href="{{ route('galeri') }}" class="side-item group">
                <i class="fa-solid fa-photo-film"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
                </div>
            </a>
            <a href="{{ route('umkm') }}" class="side-item group">
                <i class="fa-solid fa-shop"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM Lainnya</h5>
                    <p class="text-xs text-gray-400">Lihat UMKM desa lainnya</p>
                </div>
            </a>
            <a href="{{ route('kontak') }}" class="side-item group">
                <i class="fa-solid fa-envelope"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak</h5>
                    <p class="text-xs text-gray-400">Hubungi kami</p>
                </div>
            </a>
            <a href="{{ $currentUmkmId ? route('umkm.show', $currentUmkmId) : route('umkm') }}" class="side-item group">
                <i class="fa-solid fa-boxes-stacked"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu UMKM</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kelola Produk</h5>
                    <p class="text-xs text-gray-400">Kelola produk usaha Anda</p>
                </div>
            </a>
            <a href="{{ route('statistik.publik') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.keuangan.index') }}" class="side-item group">
                <i class="fa-solid fa-coins"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Keuangan Desa</h5>
                    <p class="text-xs text-gray-400">Lihat transparansi keuangan</p>
                </div>
            </a>
            <a href="{{ route('profil-desa') }}" class="side-item group">
                <i class="fa-solid fa-landmark-dome"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🏛️ Profil Desa</h5>
                    <p class="text-xs text-gray-400">Sejarah, visi misi, struktur</p>
                </div>
            </a>
            <a href="{{ route('notifikasi.index') }}" class="side-item group">
                <i class="fa-regular fa-bell"></i>
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
                <i class="fa-solid fa-chart-line"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Aktivitas Anda</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.create') }}" class="side-item group">
                <i class="fa-solid fa-file-signature"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Ajukan Surat</h5>
                    <p class="text-xs text-gray-400">Buat pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Riwayat Surat</h5>
                    <p class="text-xs text-gray-400">Status pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Aspirasi Saya</h5>
                    <p class="text-xs text-gray-400">Lihat aspirasi yang dikirim</p>
                </div>
            </a>
            <a href="{{ route('berita') }}" class="side-item group">
                <i class="fa-solid fa-newspaper"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Informasi terkini</p>
                </div>
            </a>
            <a href="{{ route('galeri') }}" class="side-item group">
                <i class="fa-solid fa-photo-film"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
                </div>
            </a>
            <a href="{{ route('umkm') }}" class="side-item group">
                <i class="fa-solid fa-store"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">UMKM</h5>
                    <p class="text-xs text-gray-400">Produk unggulan desa</p>
                </div>
            </a>
            <a href="{{ route('kontak') }}" class="side-item group">
                <i class="fa-solid fa-envelope"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak</h5>
                    <p class="text-xs text-gray-400">Hubungi kami</p>
                </div>
            </a>            <a href="{{ route('kontak') }}" class="side-item group">
                <i class="fa-solid fa-envelope"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Kontak</h5>
                    <p class="text-xs text-gray-400">Hubungi kami</p>
                </div>
            </a>            <a href="{{ route('statistik.publik') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.keuangan.index') }}" class="side-item group">
                <i class="fa-solid fa-coins"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">Keuangan Desa</h5>
                    <p class="text-xs text-gray-400">Lihat transparansi keuangan</p>
                </div>
            </a>
            <a href="{{ route('profil-desa') }}" class="side-item group">
                <i class="fa-solid fa-landmark-dome"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🏛️ Profil Desa</h5>
                    <p class="text-xs text-gray-400">Sejarah, visi misi, struktur</p>
                </div>
            </a>
            <a href="{{ route('notifikasi.index') }}" class="side-item group">
                <i class="fa-regular fa-bell"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-base font-serif italic text-emerald-950 mt-1">🔔 Notifikasi</h5>
                    <p class="text-xs text-gray-400">Lihat semua notifikasi</p>
                </div>
            </a>
        @endif
        
        {{-- Logout untuk semua role yang login --}}
        <div class="w-full h-px bg-white/20 my-2"></div>
        <a href="{{ route('logout') }}" class="side-item side-logout group" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-sign-out-alt"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-red-500 tracking-wider">Aksi</span>
                <h5 class="text-base font-serif italic text-emerald-950 mt-1">Logout</h5>
                <p class="text-xs text-gray-400">Keluar dari portal</p>
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    @endauth
</aside>

{{-- Mobile Bottom Navigation --}}
<div class="mobile-nav flex items-center justify-between gap-3 px-4 py-1">
    <!-- Inner Scrollable Container for Links -->
    <div class="flex-1 flex items-center justify-around gap-2 overflow-x-auto no-scrollbar py-2">
        @auth
            @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
                <a href="{{ route('admin.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-chart-line"></i></a>
                <a href="{{ route('admin.pengajuan-surat.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-envelope"></i></a>
                <a href="{{ route('admin.penduduk.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-users"></i></a>
                <a href="{{ route('admin.berita.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-newspaper"></i></a>
                <a href="{{ route('admin.galeri.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-photo-film"></i></a>
                <a href="{{ route('admin.aspirasi.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-comment-dots"></i></a>
                <a href="{{ route('admin.umkm.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-store"></i></a>
                <a href="{{ route('admin.pengurus.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-user-tie"></i></a>
                <a href="{{ route('admin.statistik.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-chart-simple"></i></a>
                <a href="{{ route('admin.keuangan.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-coins"></i></a>
                <a href="{{ route('admin.profil-desa.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-landmark-dome"></i></a>
                <a href="{{ route('admin.kontak-desa.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-phone"></i></a>
                <a href="{{ route('notifikasi.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-regular fa-bell"></i></a>
            @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
                @php $currentUmkmId = optional(Auth::user()->umkm)->id_umkm; @endphp
                <a href="{{ route('masyarakat.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-chart-line"></i></a>
                <a href="{{ route('masyarakat.surat.create') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-file-signature"></i></a>
                <a href="{{ route('masyarakat.surat.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-envelope"></i></a>
                <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-comment-dots"></i></a>
                <a href="{{ route('berita') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-newspaper"></i></a>
                <a href="{{ route('galeri') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-photo-film"></i></a>
                <a href="{{ route('umkm') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-store"></i></a>
                <a href="{{ route('statistik.publik') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-chart-simple"></i></a>
                <a href="{{ route('masyarakat.keuangan.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-coins"></i></a>
                <a href="{{ route('profil-desa') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-landmark-dome"></i></a>
                <a href="{{ route('kontak') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-phone"></i></a>
                <a href="{{ $currentUmkmId ? route('umkm.show', $currentUmkmId) : route('umkm') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-boxes-stacked"></i></a>
                <a href="{{ route('notifikasi.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-regular fa-bell"></i></a>
            @else
                <a href="{{ route('masyarakat.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-chart-line"></i></a>
                <a href="{{ route('masyarakat.surat.create') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-file-signature"></i></a>
                <a href="{{ route('masyarakat.surat.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-envelope"></i></a>
                <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-comment-dots"></i></a>
                <a href="{{ route('berita') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-newspaper"></i></a>
                <a href="{{ route('galeri') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-photo-film"></i></a>
                <a href="{{ route('umkm') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-store"></i></a>
                <a href="{{ route('statistik.publik') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-chart-simple"></i></a>
                <a href="{{ route('masyarakat.keuangan.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-coins"></i></a>
                <a href="{{ route('profil-desa') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-landmark-dome"></i></a>
                <a href="{{ route('kontak') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-phone"></i></a>
                <a href="{{ route('notifikasi.index') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-regular fa-bell"></i></a>
            @endif
        @else
            <a href="{{ route('home') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-house"></i></a>
            <a href="{{ route('profil-desa') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-landmark-dome"></i></a>
            <a href="{{ route('berita') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-newspaper"></i></a>
            <a href="{{ route('galeri') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-photo-film"></i></a>
            <a href="{{ route('umkm') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-store"></i></a>
            <a href="{{ route('statistik.publik') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-chart-simple"></i></a>
            <a href="{{ route('kontak') }}" class="text-white/60 hover:text-emerald-400 text-lg transition flex-shrink-0"><i class="fa-solid fa-phone"></i></a>
        @endauth
    </div>
    
    <!-- Divider -->
    <div class="w-px h-8 bg-white/20 flex-shrink-0 mx-1"></div>

    <!-- Login/Logout CTA -->
    <div class="flex-shrink-0 flex items-center justify-center">
        @auth
            <form action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="w-9 h-9 bg-red-500/80 hover:bg-red-500 rounded-xl flex items-center justify-center text-white shadow-lg transition">
                    <i class="fa-solid fa-sign-out-alt text-sm"></i>
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="w-9 h-9 bg-emerald-500 hover:bg-emerald-600 rounded-xl flex items-center justify-center text-white shadow-lg transition">
                <i class="fa-solid fa-user text-sm"></i>
            </a>
        @endauth
    </div>
</div>

<style>
    .magic-sidebar {
        position: fixed;
        left: 30px;
        top: 50%;
        transform: translateY(-50%);
        width: 65px;  /* DIPERKECIL dari 80px menjadi 65px */
        background: linear-gradient(135deg, #064e3b, #022c22);
        backdrop-filter: blur(20px);
        border-radius: 35px; /* DIPERKECIL */
        z-index: 1100;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px; /* Kembalikan ke gap 12px agar pas di layar besar */
        padding: 20px 0; /* DIPERKECIL */
        box-shadow: 0 25px 50px rgba(6, 78, 59, 0.3);
        border: 1px solid rgba(255,255,255,0.12);
        height: auto;
        max-height: calc(100vh - 60px);
        overflow: visible; /* Sangat penting agar info-box tidak terpotong! */
    }
    
    .side-item {
        position: relative;
        width: 44px; /* DIPERKECIL dari 52px menjadi 44px */
        height: 44px; /* DIPERKECIL dari 52px menjadi 44px */
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 20px; /* DIPERKECIL */
        color: rgba(255,255,255,0.45);
        font-size: 18px; /* DIPERKECIL dari 22px menjadi 18px */
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); /* Ultra smooth spring transition */
        cursor: pointer;
        flex-shrink: 0;
    }
    
    .side-item:hover {
        color: #34d399 !important; /* Soft spring green */
        background: rgba(255,255,255,0.18);
        transform: translateY(-3px) scale(1.1) rotate(5deg); /* Premium bounce zoom + tilt! */
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.15);
    }
    
    .side-item.active {
        color: #064e3b;
        background: #fff;
        box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
        transform: scale(1.05);
    }
    
    /* Special Hover for Logout */
    .side-item.side-logout:hover {
        color: #ef4444 !important; /* Premium Crimson Red */
        background: rgba(239, 68, 68, 0.15) !important;
        transform: translateY(-3px) scale(1.1) rotate(-5deg) !important; /* Opposite tilt! */
        box-shadow: 0 8px 20px rgba(239, 68, 68, 0.2) !important;
    }
    
    .info-box {
        position: absolute;
        left: 75px;
        background: rgba(255, 255, 255, 0.96);
        backdrop-filter: blur(15px);
        padding: 12px 20px;
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(6, 78, 59, 0.12);
        opacity: 0;
        visibility: hidden;
        transform: translateX(-20px) scale(0.9);
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1); /* Dynamic bounce in! */
        min-width: 220px;
        border: 1px solid rgba(16, 185, 129, 0.15);
        z-index: 1200;
        pointer-events: none;
    }
    
    .side-item.side-logout .info-box {
        border-color: rgba(239, 68, 68, 0.15) !important;
        box-shadow: 0 20px 40px rgba(239, 68, 68, 0.12) !important;
    }
    
    .info-box h5 {
        font-size: 14px;
        margin-top: 4px;
    }
    
    .info-box p {
        font-size: 10px;
    }
    
    .info-box span {
        font-size: 8px;
        transition: color 0.3s;
    }
    
    .side-item:hover .info-box {
        opacity: 1;
        visibility: visible;
        transform: translateX(0) scale(1);
    }
    
    .side-item.side-logout:hover .info-box {
        border-color: rgba(239, 68, 68, 0.3) !important;
        box-shadow: 0 20px 40px rgba(239, 68, 68, 0.25) !important;
    }

    /* Scaling Responsif Berdasarkan Tinggi Layar agar Tidak Melebihi Viewport */
    @media (max-height: 850px) {
        .magic-sidebar {
            gap: 8px;
            padding: 15px 0;
        }
        .side-item {
            width: 38px;
            height: 38px;
            font-size: 16px;
            border-radius: 16px;
        }
        .info-box {
            left: 60px;
            padding: 10px 16px;
            min-width: 200px;
        }
    }

    @media (max-height: 700px) {
        .magic-sidebar {
            gap: 6px;
            padding: 10px 0;
        }
        .side-item {
            width: 32px;
            height: 32px;
            font-size: 14px;
            border-radius: 12px;
        }
        .info-box {
            left: 50px;
            padding: 8px 12px;
            min-width: 180px;
        }
    }
    
    .mobile-nav {
        position: fixed;
        bottom: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        height: 65px; /* DIPERKECIL */
        background: #064e3b;
        border-radius: 35px;
        z-index: 1100;
        display: none;
        align-items: center;
        justify-content: space-around;
        padding: 0 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }
    
    .mobile-nav a {
        font-size: 18px; /* DIPERKECIL */
    }
    
    /* Hide scrollbar utility */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    @media (max-width: 1024px) {
        .magic-sidebar {
            display: none;
        }
        .mobile-nav {
            display: flex;
        }
        .main-container {
            margin-left: 0 !important;
            padding-top: 110px !important;
        }
    }
    
    .main-container {
        margin-left: 120px; /* DIPERKECIL dari 140px menjadi 120px */
        padding-top: 120px;
        transition: 0.3s;
    }
</style>