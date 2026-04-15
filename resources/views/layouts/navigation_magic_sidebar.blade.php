{{-- resources/views/layouts/navigation_magic_sidebar.blade.php --}}
<aside class="magic-sidebar">
    {{-- Menu Beranda (sesuai role setelah login) --}}
    @auth
        @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-house"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Beranda</h5>
                    <p class="text-xs text-gray-400">Dashboard admin</p>
                </div>
            </a>
        @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
            <a href="{{ route('umkm.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-house"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Beranda</h5>
                    <p class="text-xs text-gray-400">Dashboard UMKM</p>
                </div>
            </a>
        @else
            <a href="{{ route('masyarakat.dashboard') }}" class="side-item group">
                <i class="fa-solid fa-house"></i>
                <div class="info-box">
                    <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                    <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Beranda</h5>
                    <p class="text-xs text-gray-400">Dashboard masyarakat</p>
                </div>
            </a>
        @endif
    @else
        <a href="{{ route('home') }}" class="side-item group">
            <i class="fa-solid fa-house"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Beranda</h5>
                <p class="text-xs text-gray-400">Halaman utama desa</p>
            </div>
        </a>
    @endauth
    
    {{-- Menu Publik Lainnya --}}
    <a href="{{ route('profil-desa') }}" class="side-item group">
        <i class="fa-solid fa-landmark-dome"></i>
        <div class="info-box">
            <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
            <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Profil Desa</h5>
            <p class="text-xs text-gray-400">Sejarah, visi misi, struktur</p>
        </div>
    </a>
    
    <a href="{{ route('berita') }}" class="side-item group">
        <i class="fa-solid fa-newspaper"></i>
        <div class="info-box">
            <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
            <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Berita</h5>
            <p class="text-xs text-gray-400">Informasi & pengumuman</p>
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
            <p class="text-xs text-gray-400">Produk unggulan desa</p>
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

    {{-- Menu Khusus Setelah Login (Dashboard Tambahan) --}}
    @auth
    <div class="w-full h-px bg-white/20 my-2"></div>
    
    @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
        {{-- Admin sudah punya Beranda yang mengarah ke admin.dashboard --}}
    @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
        {{-- UMKM sudah punya Beranda yang mengarah ke umkm.dashboard --}}
        <a href="{{ route('umkm.produk.index') }}" class="side-item group">
            <i class="fa-solid fa-box"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Produk Saya</h5>
                <p class="text-xs text-gray-400">Kelola produk UMKM</p>
            </div>
        </a>
    @else
        {{-- Masyarakat sudah punya Beranda yang mengarah ke masyarakat.dashboard --}}
        <a href="{{ route('masyarakat.surat.index') }}" class="side-item group">
            <i class="fa-solid fa-envelope"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Riwayat Surat</h5>
                <p class="text-xs text-gray-400">Pengajuan surat Anda</p>
            </div>
        </a>
        <a href="{{ route('masyarakat.aspirasi.index') }}" class="side-item group">
            <i class="fa-solid fa-comment-dots"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
                <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Aspirasi Saya</h5>
                <p class="text-xs text-gray-400">Aspirasi yang dikirim</p>
            </div>
        </a>
    @endif
    
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

{{-- Mobile Bottom Navigation --}}
<div class="mobile-nav">
    @auth
        @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
                <i class="fa-solid fa-house"></i>
            </a>
        @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
            <a href="{{ route('umkm.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
                <i class="fa-solid fa-house"></i>
            </a>
        @else
            <a href="{{ route('masyarakat.dashboard') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
                <i class="fa-solid fa-house"></i>
            </a>
        @endif
    @else
        <a href="{{ route('home') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
            <i class="fa-solid fa-house"></i>
        </a>
    @endauth
    
    <a href="{{ route('profil-desa') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
        <i class="fa-solid fa-landmark-dome"></i>
    </a>
    <a href="{{ route('berita') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
        <i class="fa-solid fa-newspaper"></i>
    </a>
    <a href="{{ route('galeri') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
        <i class="fa-solid fa-photo-film"></i>
    </a>
    <a href="{{ route('umkm') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
        <i class="fa-solid fa-shop"></i>
    </a>
    
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