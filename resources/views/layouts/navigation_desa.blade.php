<!-- TOP NAVBAR FULL SCREEN (GOOEY) -->
<nav class="nav-top-full">
    <div class="w-full flex justify-between items-center px-4">
        <!-- Logo Area -->
        <a href="/" class="flex items-center gap-10 group">
            <div class="w-24 h-24 bg-emerald-950 rounded-3xl flex items-center justify-center text-white text-4xl font-black transition-all hover:rotate-12">LS</div>
            <h1 class="text-6xl font-black tracking-tighter text-black uppercase italic leading-none">Silintong</h1>
        </a>

        <!-- Links -->
        <div class="hidden xl:flex gap-6">
            @php 
                $menu = [
                    'Home' => '/', 'Profil' => '#', 'Berita' => '#', 
                    'UMKM' => '#', 'Galeri' => '#', 'Info' => '#', 'Kontak' => '#'
                ]; 
            @endphp
            @foreach($menu as $name => $link)
            <a href="{{ $link }}" class="nav-link-gooey">{{ $name }}<div class="gooey-bg"></div></a>
            @endforeach
        </div>

        <!-- Auth & Logout Section -->
        <div class="flex items-center gap-10">
            @auth
                <!-- Link Dashboard -->
                <a href="{{ route('dashboard') }}" class="nav-link-gooey text-black !border-b-[10px] !border-emerald-500 pb-1">
                    DASHBOARD <div class="gooey-bg"></div>
                </a>

                <!-- Logout Button Gooey Style -->
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="nav-link-gooey text-red-600 !font-black">
                        LOGOUT <div class="gooey-bg !bg-red-500"></div>
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="text-3xl font-extrabold text-black mr-12">Log In</a>
                <a href="{{ route('register') }}" class="liquid-fill px-20 py-8 rounded-[2rem] font-black uppercase text-xl shadow-giant">
                    <span>Daftar Akun</span>
                </a>
            @endguest
        </div>
    </div>
</nav>

<!-- MAGIC SIDEBAR (LENGKAP DENGAN LOGOUT) -->
<aside class="magic-sidebar shadow-giant">
    <!-- Menu Atas & Tengah -->
    <div class="flex flex-col gap-8">
        @php
            $sides = [
                ['i' => 'fa-house', 't' => 'Beranda', 'd' => 'Portal Utama'],
                ['i' => 'fa-id-card', 't' => 'Profil', 'd' => 'Visi & Sejarah'],
                ['i' => 'fa-file-invoice', 't' => 'Layanan', 'd' => 'Urus Administrasi'],
                ['i' => 'fa-store', 't' => 'UMKM', 'd' => 'Produk Warga'],
                ['i' => 'fa-images', 't' => 'Galeri', 'd' => 'Dokumentasi'],
                ['i' => 'fa-bullhorn', 't' => 'Info', 'd' => 'Pengumuman'],
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

    <!-- Bagian Bawah: Tombol Logout Sidebar -->
    @auth
    <div class="mt-auto pb-4">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="side-item-magic group text-red-400 hover:text-white">
                <i class="fa-solid fa-power-off"></i>
                <div class="side-tooltip !bg-red-600">
                    <h5 class="text-4xl font-black text-white italic uppercase leading-none">Keluar</h5>
                    <p class="text-2xl text-red-100 font-medium mt-3 leading-tight">Akhiri Sesi Login</p>
                </div>
            </button>
        </form>
    </div>
    @endauth
</aside>