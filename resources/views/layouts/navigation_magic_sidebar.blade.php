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
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Beranda</h5>
                <p class="text-xs text-gray-400">Halaman utama</p>
            </div>
        </a>
        <a href="{{ route('profil-desa') }}" class="side-item group">
            <i class="fa-solid fa-landmark-dome"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Profil Desa</h5>
                <p class="text-xs text-gray-400">Sejarah, visi misi</p>
            </div>
        </a>
        <a href="{{ route('berita') }}" class="side-item group">
            <i class="fa-solid fa-newspaper"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Berita</h5>
                <p class="text-xs text-gray-400">Informasi terkini</p>
            </div>
        </a>
        <a href="{{ route('galeri') }}" class="side-item group">
            <i class="fa-solid fa-photo-film"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Galeri</h5>
                <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
            </div>
        </a>
        <a href="{{ route('umkm') }}" class="side-item group">
            <i class="fa-solid fa-shop"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">UMKM</h5>
                <p class="text-xs text-gray-400">Produk unggulan</p>
            </div>
        </a>
        <a href="{{ route('kontak') }}" class="side-item group">
            <i class="fa-solid fa-envelope"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Kontak</h5>
                <p class="text-xs text-gray-400">Hubungi kami</p>
            </div>
        </a>
        <a href="{{ route('statistik.publik') }}" class="side-item group">
            <i class="fa-solid fa-chart-simple"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
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
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Ringkasan data desa</p>
                </div>
            </a>
            <a href="{{ route('admin.pengajuan-surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Pengajuan Surat</h5>
                    <p class="text-xs text-gray-400">Kelola surat warga</p>
                </div>
            </a>
            <a href="{{ route('admin.penduduk.index') }}" class="side-item group">
                <i class="fa-solid fa-users"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Data Penduduk</h5>
                    <p class="text-xs text-gray-400">Kelola data warga</p>
                </div>
            </a>
            <a href="{{ route('admin.berita.index') }}" class="side-item group">
                <i class="fa-solid fa-newspaper"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Kelola berita desa</p>
                </div>
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="side-item group">
                <i class="fa-solid fa-photo-film"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Kelola galeri foto</p>
                </div>
            </a>
            <a href="{{ route('admin.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Aspirasi</h5>
                    <p class="text-xs text-gray-400">Kelola aspirasi warga</p>
                </div>
            </a>
            <a href="{{ route('admin.umkm.index') }}" class="side-item group">
                <i class="fa-solid fa-store"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">UMKM</h5>
                    <p class="text-xs text-gray-400">Kelola UMKM desa</p>
                </div>
            </a>
            <a href="{{ route('admin.pengurus.index') }}" class="side-item group">
                <i class="fa-solid fa-user-tie"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Pengurus Desa</h5>
                    <p class="text-xs text-gray-400">Kelola data pengurus</p>
                </div>
            </a>
            <a href="{{ route('admin.statistik.index') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Statistik</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('admin.keuangan.index') }}" class="side-item group">
                <i class="fa-solid fa-coins"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Keuangan Desa</h5>
                    <p class="text-xs text-gray-400">Kelola pemasukan & pengeluaran</p>
                </div>
            </a>

    {{-- ============================================= --}}
    {{-- SIDEBAR UNTUK ROLE: UMKM --}}
    {{-- ============================================= --}}
        @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
            <a href="{{ route('umkm.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-chart-line"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Ringkasan toko Anda</p>
                </div>
            </a>
            <a href="{{ route('umkm.produk.index') }}" class="side-item group">
                <i class="fa-solid fa-box"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Produk Saya</h5>
                    <p class="text-xs text-gray-400">Kelola produk UMKM</p>
                </div>
            </a>
            <a href="{{ route('umkm.profil.edit') }}" class="side-item group">
                <i class="fa-solid fa-store"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Profil UMKM</h5>
                    <p class="text-xs text-gray-400">Edit informasi toko</p>
                </div>
            </a>
            <a href="{{ route('berita') }}" class="side-item group">
                <i class="fa-solid fa-newspaper"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Informasi terkini</p>
                </div>
            </a>
            <a href="{{ route('galeri') }}" class="side-item group">
                <i class="fa-solid fa-photo-film"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
                </div>
            </a>
            <a href="{{ route('statistik.publik') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.keuangan.index') }}" class="side-item group">
                <i class="fa-solid fa-coins"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Keuangan Desa</h5>
                    <p class="text-xs text-gray-400">Lihat transparansi keuangan</p>
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
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Dashboard</h5>
                    <p class="text-xs text-gray-400">Aktivitas Anda</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.create') }}" class="side-item group">
                <i class="fa-solid fa-file-signature"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Ajukan Surat</h5>
                    <p class="text-xs text-gray-400">Buat pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.surat.index') }}" class="side-item group">
                <i class="fa-solid fa-envelope"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Riwayat Surat</h5>
                    <p class="text-xs text-gray-400">Status pengajuan surat</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.aspirasi.index') }}" class="side-item group">
                <i class="fa-solid fa-comment-dots"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Aspirasi Saya</h5>
                    <p class="text-xs text-gray-400">Lihat aspirasi yang dikirim</p>
                </div>
            </a>
            <a href="{{ route('berita') }}" class="side-item group">
                <i class="fa-solid fa-newspaper"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Berita</h5>
                    <p class="text-xs text-gray-400">Informasi terkini</p>
                </div>
            </a>
            <a href="{{ route('galeri') }}" class="side-item group">
                <i class="fa-solid fa-photo-film"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Galeri</h5>
                    <p class="text-xs text-gray-400">Dokumentasi kegiatan</p>
                </div>
            </a>
            <a href="{{ route('umkm') }}" class="side-item group">
                <i class="fa-solid fa-store"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">UMKM</h5>
                    <p class="text-xs text-gray-400">Produk unggulan desa</p>
                </div>
            </a>
            <a href="{{ route('statistik.publik') }}" class="side-item group">
                <i class="fa-solid fa-chart-simple"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Statistik Desa</h5>
                    <p class="text-xs text-gray-400">Data statistik desa</p>
                </div>
            </a>
            <a href="{{ route('masyarakat.keuangan.index') }}" class="side-item group">
                <i class="fa-solid fa-coins"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Keuangan Desa</h5>
                    <p class="text-xs text-gray-400">Lihat transparansi keuangan</p>
                </div>
            </a>
        @endif
        
        {{-- Logout untuk semua role yang login --}}
        <div class="w-full h-px bg-white/20 my-2"></div>
        <a href="{{ route('logout') }}" class="side-item group" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fa-solid fa-sign-out-alt"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Logout</h5>
                <p class="text-xs text-gray-400">Keluar dari portal</p>
            </div>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    @endauth
</aside>

{{-- ============================================= --}}
{{-- MOBILE BOTTOM NAVIGATION --}}
{{-- ============================================= --}}
<div class="mobile-nav">
    @auth
        @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-chart-line"></i></a>
            <a href="{{ route('admin.pengajuan-surat.index') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-envelope"></i></a>
            <a href="{{ route('admin.penduduk.index') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-users"></i></a>
            <a href="{{ route('admin.statistik.index') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-chart-simple"></i></a>
            <a href="{{ route('admin.keuangan.index') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-coins"></i></a>
        @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
            <a href="{{ route('umkm.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-chart-line"></i></a>
            <a href="{{ route('umkm.produk.index') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-box"></i></a>
            <a href="{{ route('berita') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-newspaper"></i></a>
            <a href="{{ route('statistik.publik') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-chart-simple"></i></a>
            <a href="{{ route('masyarakat.keuangan.index') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-coins"></i></a>
        @else
            <a href="{{ route('masyarakat.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-chart-line"></i></a>
            <a href="{{ route('masyarakat.surat.create') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-file-signature"></i></a>
            <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-comment-dots"></i></a>
            <a href="{{ route('berita') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-newspaper"></i></a>
            <a href="{{ route('statistik.publik') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-chart-simple"></i></a>
            <a href="{{ route('masyarakat.keuangan.index') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-coins"></i></a>
        @endif
    @else
        <a href="{{ route('home') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-house"></i></a>
        <a href="{{ route('profil-desa') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-landmark-dome"></i></a>
        <a href="{{ route('berita') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-newspaper"></i></a>
        <a href="{{ route('galeri') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-photo-film"></i></a>
        <a href="{{ route('umkm') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-store"></i></a>
        <a href="{{ route('statistik.publik') }}" class="text-white/60 hover:text-emerald-400 text-xl transition"><i class="fa-solid fa-chart-simple"></i></a>
    @endauth
    
    @auth
        <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center text-white shadow-lg">
                <i class="fa-solid fa-sign-out-alt"></i>
            </button>
        </form>
    @else
        <a href="{{ route('login') }}" class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg">
            <i class="fa-solid fa-user"></i>
        </a>
    @endauth
</div>

<style>
    .magic-sidebar {
        position: fixed; left: 30px; top: 50%; transform: translateY(-50%);
        width: 80px; background: linear-gradient(135deg, #064e3b, #022c22);
        backdrop-filter: blur(20px); border-radius: 45px; z-index: 1100; 
        display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 18px;
        padding: 25px 0;
        box-shadow: 0 25px 50px rgba(6, 78, 59, 0.3); border: 1px solid rgba(255,255,255,0.12);
    }
    .side-item {
        position: relative; width: 52px; height: 52px; display: flex;
        align-items: center; justify-content: center; border-radius: 24px;
        color: rgba(255,255,255,0.45); font-size: 22px; transition: 0.3s;
        cursor: pointer;
    }
    .side-item:hover, .side-item.active { color: #fff; background: rgba(255,255,255,0.12); transform: translateY(-3px); }
    .info-box {
        position: absolute; left: 80px; background: white; padding: 16px 24px;
        border-radius: 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.12);
        opacity: 0; visibility: hidden; transform: translateX(-15px); transition: 0.3s;
        min-width: 260px; border: 1px solid rgba(0,0,0,0.04);
        z-index: 1200;
    }
    .side-item:hover .info-box { opacity: 1; visibility: visible; transform: translateX(0); }
    .mobile-nav {
        position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
        width: 90%; height: 70px; background: #064e3b;
        border-radius: 35px; z-index: 1100; display: none;
        align-items: center; justify-content: space-around; padding: 0 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    }
    @media (max-width: 1024px) {
        .magic-sidebar { display: none; }
        .mobile-nav { display: flex; }
        .main-container { margin-left: 0 !important; padding-top: 110px !important; }
    }
    .main-container { margin-left: 140px; padding-top: 120px; transition: 0.3s; }
</style>