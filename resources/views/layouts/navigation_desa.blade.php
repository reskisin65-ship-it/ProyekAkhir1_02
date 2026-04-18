{{-- resources/views/layouts/navigation_desa.blade.php --}}
<nav class="nav-top" :class="{ 'nav-scrolled': scrolled }" x-data="{ mobileMenuOpen: false }">
    <div class="w-full flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-12 h-12 bg-emerald-950 rounded-2xl flex items-center justify-center text-white shadow-lg rotate-3 group-hover:rotate-0 transition-all duration-500">
                <span class="text-xl font-black">LS</span>
            </div>
            <div class="hidden md:block">
                <span class="text-xl font-serif italic text-emerald-950 leading-tight">Lumban Silintong</span>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center gap-8">
            <div class="flex gap-4 text-sm font-medium">
                
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: ADMIN --}}
                {{-- ============================================= --}}
                @auth
                    @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        <a href="{{ route('admin.pengajuan-surat.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Pengajuan Surat</a>
                        <a href="{{ route('admin.penduduk.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Data Penduduk</a>
                        <a href="{{ route('admin.berita.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Berita</a>
                        <a href="{{ route('admin.galeri.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Galeri</a>
                        <a href="{{ route('admin.aspirasi.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Aspirasi</a>
                        <a href="{{ route('admin.umkm.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">UMKM</a>
                        <a href="{{ route('admin.pengurus.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Pengurus</a>
                        <a href="{{ route('admin.statistik.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Statistik</a>
                        
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: UMKM --}}
                {{-- ============================================= --}}
                    @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
                        <a href="{{ route('umkm.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        <a href="{{ route('umkm.produk.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Produk Saya</a>
                        <a href="{{ route('umkm.profil.edit') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Profil UMKM</a>
                        <a href="{{ route('berita') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Berita</a>
                        <a href="{{ route('galeri') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Galeri</a>
                        <a href="{{ route('umkm') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">UMKM</a>
                        
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: MASYARAKAT --}}
                {{-- ============================================= --}}
                    @else
                        <a href="{{ route('masyarakat.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        <a href="{{ route('masyarakat.surat.create') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Ajukan Surat</a>
                        <a href="{{ route('masyarakat.surat.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Riwayat Surat</a>
                        <a href="{{ route('masyarakat.aspirasi.create') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Kirim Aspirasi</a>
                        <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Aspirasi Saya</a>
                        <a href="{{ route('berita') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Berita</a>
                        <a href="{{ route('galeri') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Galeri</a>
                        <a href="{{ route('umkm') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">UMKM</a>
                        {{-- TAMBAHKAN MENU STATISTIK UNTUK MASYARAKAT --}}
                        <a href="{{ route('statistik.publik') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Statistik Desa</a>
                    @endif
                @else
                    {{-- ============================================= --}}
                    {{-- MENU UNTUK GUEST (BELUM LOGIN) --}}
                    {{-- ============================================= --}}
                    <a href="{{ route('home') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Beranda</a>
                    <a href="{{ route('profil-desa') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Profil Desa</a>
                    <a href="{{ route('berita') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Berita</a>
                    <a href="{{ route('galeri') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Galeri</a>
                    <a href="{{ route('umkm') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">UMKM</a>
                    <a href="{{ route('kontak') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Kontak</a>
                    {{-- TAMBAHKAN MENU STATISTIK UNTUK GUEST --}}
                    <a href="{{ route('statistik.publik') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Statistik Desa</a>
                @endauth
            </div>
            
            {{-- Tombol Auth --}}
            <div class="flex gap-3">
                @auth
                    <div class="flex items-center gap-3 relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu" class="flex items-center gap-2 px-3 py-2 rounded-full bg-emerald-50 hover:bg-emerald-100 transition">
                            <div class="w-8 h-8 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white text-sm font-bold">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-medium text-emerald-800">{{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-emerald-600"></i>
                        </button>
                        
                        <div x-show="userMenu" @click.away="userMenu = false" x-cloak class="absolute top-full right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-xs text-gray-400">{{ Auth::user()->email }}</p>
                                <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-[9px] font-bold uppercase
                                    @if(Auth::user()->role->nama_role == 'admin') bg-red-100 text-red-700
                                    @elseif(Auth::user()->role->nama_role == 'umkm') bg-amber-100 text-amber-700
                                    @else bg-emerald-100 text-emerald-700 @endif">
                                    {{ Auth::user()->role->nama_role }}
                                </span>
                            </div>
                            <div class="py-1">
                                @if(Auth::user()->role->nama_role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Dashboard</a>
                                    <a href="{{ route('admin.pengajuan-surat.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Pengajuan Surat</a>
                                    <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Data Penduduk</a>
                                    <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Berita</a>
                                    <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Galeri</a>
                                    <a href="{{ route('admin.aspirasi.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Aspirasi</a>
                                    <a href="{{ route('admin.umkm.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">UMKM</a>
                                    <a href="{{ route('admin.statistik.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Statistik</a>
                                @elseif(Auth::user()->role->nama_role == 'umkm')
                                    <a href="{{ route('umkm.dashboard') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Dashboard</a>
                                    <a href="{{ route('umkm.produk.index') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Produk Saya</a>
                                    <a href="{{ route('umkm.profil.edit') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Profil UMKM</a>
                                @else
                                    <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Dashboard</a>
                                    <a href="{{ route('masyarakat.surat.create') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Ajukan Surat</a>
                                    <a href="{{ route('masyarakat.aspirasi.create') }}" class="flex items-center gap-3 px-4 py-2 hover:bg-emerald-50 transition">Kirim Aspirasi</a>
                                @endif
                            </div>
                            <div class="border-t border-gray-100 mt-1 pt-1">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-3 w-full px-4 py-2 text-left hover:bg-red-50 transition text-red-600">
                                        <i class="fa-solid fa-sign-out-alt"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-emerald-500 text-white text-sm font-medium hover:bg-emerald-600 transition shadow-md">
                        <i class="fa-regular fa-user-plus mr-1"></i> Daftar
                    </a>
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-full border-2 border-emerald-500 text-emerald-600 text-sm font-medium hover:bg-emerald-50 transition">
                        <i class="fa-solid fa-sign-in-alt mr-1"></i> Masuk
                    </a>
                @endauth
            </div>
        </div>

        {{-- Mobile Menu Button --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
            <i class="fa-solid text-emerald-700" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
        </button>
    </div>

    {{-- Mobile Menu Dropdown --}}
    <div x-show="mobileMenuOpen" x-collapse class="lg:hidden absolute top-full left-0 right-0 mt-3 mx-4 bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl border border-white/20 overflow-hidden z-50">
        <div class="flex flex-col py-4">
            @auth
                @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Dashboard</a>
                    <a href="{{ route('admin.pengajuan-surat.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Pengajuan Surat</a>
                    <a href="{{ route('admin.penduduk.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Data Penduduk</a>
                    <a href="{{ route('admin.berita.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Berita</a>
                    <a href="{{ route('admin.galeri.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Galeri</a>
                    <a href="{{ route('admin.aspirasi.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Aspirasi</a>
                    <a href="{{ route('admin.umkm.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">UMKM</a>
                    <a href="{{ route('admin.statistik.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Statistik</a>
                @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
                    <a href="{{ route('umkm.dashboard') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Dashboard</a>
                    <a href="{{ route('umkm.produk.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Produk Saya</a>
                    <a href="{{ route('umkm.profil.edit') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Profil UMKM</a>
                    <a href="{{ route('berita') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Berita</a>
                    <a href="{{ route('galeri') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Galeri</a>
                    <a href="{{ route('statistik.publik') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Statistik Desa</a>
                @else
                    <a href="{{ route('masyarakat.dashboard') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Dashboard</a>
                    <a href="{{ route('masyarakat.surat.create') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Ajukan Surat</a>
                    <a href="{{ route('masyarakat.surat.index') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Riwayat Surat</a>
                    <a href="{{ route('masyarakat.aspirasi.create') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Kirim Aspirasi</a>
                    <a href="{{ route('berita') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Berita</a>
                    <a href="{{ route('galeri') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Galeri</a>
                    <a href="{{ route('statistik.publik') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Statistik Desa</a>
                @endif
            @else
                <a href="{{ route('home') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Beranda</a>
                <a href="{{ route('profil-desa') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Profil Desa</a>
                <a href="{{ route('berita') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Berita</a>
                <a href="{{ route('galeri') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Galeri</a>
                <a href="{{ route('umkm') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">UMKM</a>
                <a href="{{ route('kontak') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Kontak</a>
                <a href="{{ route('statistik.publik') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Statistik Desa</a>
            @endauth
            
            <div class="border-t border-gray-100 my-2"></div>
            
            @auth
                <form action="{{ route('logout') }}" method="POST" class="mx-4 my-1">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 rounded-xl bg-red-500 text-white text-center">Logout</button>
                </form>
                <div class="px-5 py-2 text-sm text-emerald-600">
                    <i class="fa-regular fa-user mr-1"></i> {{ Auth::user()->name }}
                </div>
            @else
                <a href="{{ route('register') }}" class="mx-4 my-1 px-4 py-2 rounded-xl bg-emerald-500 text-white text-center">Daftar</a>
                <a href="{{ route('login') }}" class="mx-4 my-1 px-4 py-2 rounded-xl border border-emerald-500 text-emerald-600 text-center">Masuk</a>
            @endauth
        </div>
    </div>
</nav>

<style>
    .nav-top {
        position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
        width: 90%; max-width: 1400px; height: 80px;
        background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 50px;
        z-index: 1000; display: flex; align-items: center; padding: 0 40px;
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .nav-scrolled { top: 10px; width: 95%; height: 70px; background: rgba(255, 255, 255, 0.98); box-shadow: 0 15px 40px rgba(0,0,0,0.08); }
    [x-cloak] { display: none !important; }
</style>