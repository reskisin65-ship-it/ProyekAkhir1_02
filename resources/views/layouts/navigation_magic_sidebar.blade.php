<nav class="magic-sidebar">
    <!-- Top Logo -->
    <div class="w-16 h-16 bg-emerald-950 rounded-full flex items-center justify-center text-white text-2xl font-black shadow-2xl">
        LS
    </div>

    <!-- Menu Items -->
    <div class="flex flex-col gap-10">
        <a href="/" class="nav-item-splash group">
            <i class="fa-solid fa-house"></i>
            <div class="tooltip-card">
                <h4 class="text-xl font-black uppercase tracking-widest text-emerald-600">Beranda</h4>
                <p class="text-sm text-gray-400 mt-2">Halaman Utama Portal Desa</p>
            </div>
        </a>

        <a href="#" class="nav-item-splash group">
            <i class="fa-solid fa-newspaper"></i>
            <div class="tooltip-card">
                <h4 class="text-xl font-black uppercase tracking-widest text-emerald-600">Berita</h4>
                <p class="text-sm text-gray-400 mt-2">Update Kegiatan & Informasi</p>
            </div>
        </a>

        <a href="#" class="nav-item-splash group">
            <i class="fa-solid fa-file-signature"></i>
            <div class="tooltip-card">
                <h4 class="text-xl font-black uppercase tracking-widest text-emerald-600">Layanan</h4>
                <p class="text-sm text-gray-400 mt-2">Pengajuan Surat Administrasi</p>
            </div>
        </a>

        <a href="#" class="nav-item-splash group">
            <i class="fa-solid fa-shop"></i>
            <div class="tooltip-card">
                <h4 class="text-xl font-black uppercase tracking-widest text-emerald-600">UMKM</h4>
                <p class="text-sm text-gray-400 mt-2">Produk Unggulan Warga</p>
            </div>
        </a>

        @auth
        <a href="{{ route('dashboard') }}" class="nav-item-splash group">
            <i class="fa-solid fa-user-gear"></i>
            <div class="tooltip-card">
                <h4 class="text-xl font-black uppercase tracking-widest text-emerald-600">Panel</h4>
                <p class="text-sm text-gray-400 mt-2">Dashboard Saya</p>
            </div>
        </a>
        @endauth
    </div>

    <!-- Bottom Action (Logout/Login) -->
    @auth
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="nav-item-splash text-red-400 hover:text-red-500">
            <i class="fa-solid fa-power-off"></i>
        </button>
    </form>
    @else
    <a href="{{ route('login') }}" class="nav-item-splash text-emerald-950">
        <i class="fa-solid fa-right-to-bracket"></i>
    </a>
    @endguest
</nav>