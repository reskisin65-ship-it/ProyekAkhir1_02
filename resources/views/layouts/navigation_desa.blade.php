{{-- resources/views/layouts/navigation_desa.blade.php --}}
<!-- Memuat Google Font Poppins & Montserrat untuk memastikan bentuk font mirip seperti di gambar -->
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Poppins:wght@800;900&display=swap" rel="stylesheet">

<nav class="nav-top" :class="{ 'nav-scrolled': scrolled }" x-data="{}">
    <div class="w-full flex justify-between items-center">
        {{-- Logo & Title --}}
        <div class="flex items-center gap-3.5">
            <div class="w-12 h-12 bg-[#101828] rounded-xl flex items-center justify-center text-[#00A389] shadow-lg shadow-black/20 hover:scale-105 transition-all duration-500">
                <span class="text-2xl font-black tracking-tighter" style="font-family: 'Poppins', sans-serif;">LS</span>
            </div>
            <div class="hidden md:flex items-center gap-1.5" style="font-family: 'Poppins', 'Montserrat', sans-serif;">
                {{-- Font lurus, besar, sangat tebal (black), jarak huruf rapat (tighter) sesuai gambar --}}
                <span class="text-[32px] font-black tracking-[-0.04em] text-[#101828]">Lumban</span>
                <span class="text-[32px] font-black tracking-[-0.04em] text-[#00A389]">Silintong</span>
            </div>
        </div>

        {{-- Tombol Auth --}}
        <div class="flex gap-3 items-center">
            @auth
                {{-- User Menu dengan Desain Premium (Hitam & Hijau Teal) --}}
                <div class="flex items-center gap-3 relative" x-data="{ userMenu: false }">
                    <button @click="userMenu = !userMenu" 
                            class="flex items-center gap-3 px-4 py-2 rounded-full bg-[#101828] hover:bg-gray-900 transition-all duration-300 hover:scale-105 shadow-lg shadow-black/20 group border border-gray-800">
                        <div class="w-8 h-8 bg-[#00A389]/20 rounded-full flex items-center justify-center text-[#00A389] text-sm font-bold backdrop-blur-sm">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-bold text-white tracking-wide">{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-[10px] text-[#00A389] transition-transform duration-300 group-hover:rotate-180"></i>
                    </button>
                    
                    {{-- Dropdown Menu --}}
                    <div x-show="userMenu" 
                        @click.away="userMenu = false" 
                        x-cloak 
                        class="absolute top-full right-0 mt-3 w-80 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50 max-h-[85vh] flex flex-col"
                        x-transition:enter="transition-all duration-300 ease-out"
                        x-transition:enter-start="opacity-0 -translate-y-5 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition-all duration-200 ease-in"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 -translate-y-5 scale-95">
                        
                        {{-- Header Profil --}}
                        <div class="bg-[#101828] px-6 py-6 text-white flex-shrink-0 border-b-4 border-[#00A389] relative overflow-hidden">
                            <!-- Dekorasi background -->
                            <div class="absolute top-[-20px] right-[-20px] w-24 h-24 bg-[#00A389]/20 rounded-full blur-2xl"></div>
                            
                            <div class="flex items-center gap-4 relative z-10">
                                <div class="w-14 h-14 bg-[#00A389] text-white rounded-2xl flex items-center justify-center text-2xl font-black shadow-inner">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div>
                                    <h4 class="font-bold text-lg tracking-wide">{{ Auth::user()->name }}</h4>
                                    <p class="text-xs text-gray-400 font-medium">{{ Auth::user()->email }}</p>
                                    <span class="inline-block mt-2 px-3 py-1 rounded-full text-[10px] font-extrabold uppercase tracking-wider
                                        @if(Auth::user()->role->nama_role == 'admin') bg-red-500/20 text-red-400
                                        @elseif(Auth::user()->role->nama_role == 'umkm') bg-amber-500/20 text-amber-400
                                        @else bg-[#00A389]/20 text-[#00A389] @endif">
                                        {{ Auth::user()->role->nama_role }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                      

                        @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
                            @php $isAdminSection = Request::routeIs('admin.*'); @endphp
                            <div class="px-6 py-3 border-t border-gray-100">
                                <a href="{{ $isAdminSection ? route('masyarakat.dashboard') : route('admin.dashboard') }}" 
                                   class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-xl bg-[#00A389] text-white font-semibold hover:bg-[#0dc2a3] transition-all duration-200 shadow-sm">
                                    <i class="fa-solid fa-arrows-rotate"></i>
                                    <span>{{ $isAdminSection ? 'Ke Beranda' : 'Admin Panel' }}</span>
                                </a>
                            </div>
                        @endif
                        
                        {{-- Divider --}}
                        <div class="border-t border-gray-100 my-1"></div>
                        
                        {{-- Logout Button --}}
                        <div class="p-4">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-[#101828] hover:bg-red-600 text-white rounded-xl font-bold tracking-wide transition-all duration-300 hover:scale-[1.02] shadow-md">
                                    <i class="fa-solid fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="btn-nav-login px-6 py-2.5 rounded-full font-bold tracking-wide transition-all duration-300 flex items-center gap-2">
                    <i class="fa-solid fa-sign-in-alt"></i> Masuk
                </a>
                <a href="{{ route('register') }}" class="btn-nav-register px-6 py-2.5 rounded-full text-white font-bold tracking-wide transition-all duration-300 flex items-center gap-2 shadow-lg">
                    <i class="fa-solid fa-user-plus"></i> Daftar
                </a>
            @endauth
        </div>
    </div>
</nav>

<style>
    .nav-top {
        position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
        width: 90%; max-width: 1400px; height: 85px;
        background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 0, 0, 0.05); border-radius: 50px;
        z-index: 1000; display: flex; align-items: center; padding: 0 40px;
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
    }
    .nav-scrolled { 
        top: 10px; width: 95%; height: 75px; 
        background: rgba(255, 255, 255, 0.98); 
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08); 
        border-color: rgba(0, 163, 137, 0.2);
    }
    
    @media (min-width: 1025px) {
        .nav-top {
            left: 120px;
            right: 30px;
            width: auto;
            transform: none;
            max-width: none;
        }
        .nav-scrolled {
            top: 10px;
            left: 120px;
            right: 30px;
            width: auto;
        }
    }
    
    [x-cloak] { display: none !important; }
    
    /* Hide scrollbar utility */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    /* Custom Scrollbar untuk Mobile Menu */
    .custom-scroll::-webkit-scrollbar {
        width: 4px;
    }
    .custom-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .custom-scroll::-webkit-scrollbar-thumb {
        background: #00A389;
        border-radius: 10px;
    }
    
    /* Premium Hover for Register (Daftar) Button - Hijau Teal */
    .btn-nav-register {
        background: #00A389; /* Hijau Teal Premium sesuai gambar */
        border: 2px solid #00A389;
        position: relative;
        overflow: hidden;
    }
    .btn-nav-register::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-nav-register:hover {
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 10px 25px rgba(0, 163, 137, 0.4) !important;
        background: #00c4a5; /* Teal lebih cerah saat hover */
        border-color: #00c4a5;
    }
    .btn-nav-register:hover::before {
        left: 100%;
    }
    .btn-nav-register:hover i {
        transform: scale(1.1) rotate(5deg);
        transition: 0.3s;
    }
    
    /* Premium Hover for Login (Masuk) Button - Outline Biru Dongker */
    .btn-nav-login {
        border: 2px solid #101828 !important;
        color: #101828 !important;
        background: transparent;
        position: relative;
        overflow: hidden;
    }
    .btn-nav-login:hover {
        color: #00A389 !important; /* Teks hijau teal saat hover */
        border-color: #101828 !important;
        background: #101828 !important;
        transform: translateY(-2px) scale(1.02);
        box-shadow: 0 10px 20px rgba(16, 24, 40, 0.15) !important;
    }
    .btn-nav-login:hover i {
        transform: scale(1.1) translateX(3px);
        transition: 0.3s;
    }
</style>