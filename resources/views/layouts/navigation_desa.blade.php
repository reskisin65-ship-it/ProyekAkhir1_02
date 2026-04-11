{{-- resources/views/navigation_desa.blade.php --}}
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
            <div class="flex gap-6 text-sm font-medium">
                <a href="{{ route('home') }}" class="text-emerald-950/70 hover:text-emerald-600 transition">Beranda</a>
                <a href="{{ route('profil-desa') }}" class="text-emerald-950/70 hover:text-emerald-600 transition">Profil Desa</a>
                <a href="{{ route('berita') }}" class="text-emerald-950/70 hover:text-emerald-600 transition">Berita</a>
                <a href="{{ route('galeri') }}" class="text-emerald-950/70 hover:text-emerald-600 transition">Galeri</a>
                <a href="{{ route('umkm') }}" class="text-emerald-950/70 hover:text-emerald-600 transition">UMKM</a>
                <a href="{{ route('kontak') }}" class="text-emerald-950/70 hover:text-emerald-600 transition">Kontak</a>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('register') }}" class="px-5 py-2 rounded-full bg-emerald-500 text-white text-sm font-medium hover:bg-emerald-600 transition shadow-md">Daftar</a>
                <a href="{{ route('login') }}" class="px-5 py-2 rounded-full border-2 border-emerald-500 text-emerald-600 text-sm font-medium hover:bg-emerald-50 transition">Masuk</a>
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
            <a href="{{ route('home') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Beranda</a>
            <a href="{{ route('profil-desa') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Profil Desa</a>
            <a href="{{ route('berita') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Berita</a>
            <a href="{{ route('galeri') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Galeri</a>
            <a href="{{ route('umkm') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">UMKM</a>
            <a href="{{ route('kontak') }}" class="px-5 py-3 text-emerald-800 hover:bg-emerald-50 transition">Kontak</a>
            <div class="border-t border-gray-100 my-2"></div>
            <a href="{{ route('register') }}" class="mx-4 my-1 px-4 py-2 rounded-xl bg-emerald-500 text-white text-center transition">Daftar</a>
            <a href="{{ route('login') }}" class="mx-4 my-1 px-4 py-2 rounded-xl border border-emerald-500 text-emerald-600 text-center transition">Masuk</a>
        </div>
    </div>
</nav>