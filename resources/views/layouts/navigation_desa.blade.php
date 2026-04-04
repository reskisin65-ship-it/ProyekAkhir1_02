<nav class="mega-nav-pill">
    <div class="w-full flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="flex items-center gap-6 group">
            <div class="w-20 h-20 bg-emerald-950 rounded-full flex items-center justify-center text-white text-3xl font-black transition-all group-hover:rotate-12 shadow-2xl">LS</div>
            <div class="leading-none">
                <h1 class="text-4xl font-black tracking-tighter text-emerald-950 uppercase">Silintong</h1>
                <p class="text-[9px] uppercase tracking-[0.6em] font-black text-emerald-800/40 mt-1 italic">Botanic Digital Hub</p>
            </div>
        </a>

        <!-- Menu Links -->
        <div class="hidden xl:flex gap-16 items-center">
            <a href="/" class="nav-link-pill text-emerald-950 border-b-4 border-emerald-500 pb-1">Home</a>
            <a href="#" class="nav-link-pill">Profil</a>
            <a href="#" class="nav-link-pill">Berita</a>
            <a href="#" class="nav-link-pill">UMKM</a>
            <a href="#" class="nav-link-pill">Kontak</a>
        </div>

        <!-- Auth -->
        <div class="flex items-center gap-8">
            @auth
                <a href="{{ route('dashboard') }}" class="text-xl font-black text-emerald-950">Office</a>
            @else
                <a href="{{ route('login') }}" class="text-xl font-extrabold text-emerald-950 px-4">Login</a>
                <a href="{{ route('register') }}" class="px-12 py-6 bg-emerald-950 text-white text-[11px] font-black uppercase tracking-widest rounded-full shadow-giant hover:bg-emerald-700 transition-all">Mulai</a>
            @endguest
        </div>
    </div>
</nav>