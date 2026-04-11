{{-- resources/views/layouts/navigation_magic_sidebar.blade.php --}}
<aside class="magic-sidebar">
    <a href="{{ route('home') }}" class="side-item group">
        <i class="fa-solid fa-house"></i>
        <div class="info-box">
            <span class="text-[9px] font-black uppercase text-emerald-500 tracking-wider">Menu</span>
            <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Beranda</h5>
            <p class="text-xs text-gray-400">Halaman utama desa</p>
        </div>
    </a>
    
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
            <h5 class="text-lg font-serif italic text-emerald-950 mt-1">Warta Desa</h5>
            <p class="text-xs text-gray-400">Berita & pengumuman</p>
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
</aside>

{{-- Mobile Bottom Navigation --}}
<div class="mobile-nav">
    <a href="{{ route('home') }}" class="text-white/60 hover:text-emerald-400 text-xl transition">
        <i class="fa-solid fa-house"></i>
    </a>
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
    <a href="{{ route('login') }}" class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center text-white shadow-lg hover:scale-110 transition">
        <i class="fa-solid fa-user"></i>
    </a>
</div>