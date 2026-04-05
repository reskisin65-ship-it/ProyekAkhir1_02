<!-- TOP NAVBAR FULL SCREEN (GOOEY) -->
<nav class="nav-top-full">
    <div class="w-full flex justify-between items-center px-4">
        <!-- Logo Area -->
        <a href="/" class="flex items-center gap-10 group">
            <div class="w-24 h-24 bg-emerald-950 rounded-3xl flex items-center justify-center text-white text-4xl font-black transition-all hover:rotate-12 shadow-2xl">LS</div>
            <h1 class="text-6xl font-black tracking-tighter text-black uppercase italic leading-none">Silintong</h1>
        </a>

        <!-- Links -->
        <div class="hidden xl:flex gap-6">
            @php 
                $menu = [
                    'Home' => '/', 'Profil' => '#', 'Berita' => '#', 
                    'UMKM' => '#', 'Galeri' => '#', 'Pengumuman' => '#', 'Kontak' => '#'
                ]; 
            @endphp
            @foreach($menu as $name => $link)
            <a href="{{ $link }}" class="nav-link-gooey">{{ $name }}<div class="gooey-bg"></div></a>
            @endforeach
        </div>

        <!-- Auth & Dashboard -->
        <div class="flex items-center gap-10">
            @auth
                <a href="{{ route('dashboard') }}" class="nav-link-gooey text-black border-b-[10px] border-emerald-500 pb-1">DASHBOARD <div class="gooey-bg"></div></a>
            @else
                <a href="{{ route('login') }}" class="text-2xl font-bold text-black mr-12 hover:text-emerald-600 transition">Log In</a>
                <a href="{{ route('register') }}" class="btn-liquid px-20 py-8 rounded-[2rem] font-black uppercase text-xl shadow-giant">
                    <span>Daftar Akun</span>
                </a>
            @endguest
        </div>
    </div>
</nav>

<!-- MAGIC SIDEBAR (LENGKAP 7 MENU) -->
<aside class="magic-sidebar shadow-giant">
    <div class="flex flex-col gap-12">
        @php
            $sides = [
                ['i' => 'fa-house', 't' => 'Beranda', 'd' => 'Portal Utama'],
                ['i' => 'fa-id-card', 't' => 'Profil Desa', 'd' => 'Sejarah & Visi'],
                ['i' => 'fa-file-invoice', 't' => 'Layanan Surat', 'd' => 'Administrasi Digital'],
                ['i' => 'fa-store', 't' => 'UMKM Desa', 'd' => 'Produk Warga Lokal'],
                ['i' => 'fa-images', 't' => 'Galeri Visual', 'd' => 'Dokumentasi Desa'],
                ['i' => 'fa-bullhorn', 't' => 'Aspirasi', 'd' => 'Suara Masyarakat'],
                ['i' => 'fa-newspaper', 't' => 'Berita', 'd' => 'Warta Terkini'],
            ];
        @endphp
        @foreach($sides as $s)
        <div class="side-item-magic group">
            <i class="fa-solid {{ $s['i'] }}"></i>
            <div class="side-tooltip shadow-giant">
                <h5 class="text-4xl font-black text-emerald-600 italic uppercase leading-none">{{ $s['t'] }}</h5>
                <p class="text-2xl text-gray-400 font-medium mt-3 leading-tight">{{ $s['d'] }}</p>
            </div>
        </div>
        @endforeach
    </div>
</aside>