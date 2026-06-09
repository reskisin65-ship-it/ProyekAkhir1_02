{{-- resources/views/layouts/navigation_desa.blade.php --}}
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&family=Poppins:wght@800;900&display=swap" rel="stylesheet">

<nav class="nav-top" :class="{ 'nav-scrolled': scrolled }" x-data="{ userMenu: false, mobileMenu: false }">
    <div class="w-full flex justify-between items-center gap-2">

        {{-- ===== LOGO ===== --}}
        <a href="{{ route('home') }}" class="flex items-center gap-2 flex-shrink-0">
            <div class="w-10 h-10 sm:w-11 sm:h-11 bg-[#101828] rounded-xl flex items-center justify-center text-[#00A389] shadow-lg hover:scale-105 transition-all duration-300 flex-shrink-0">
                <span class="text-lg sm:text-xl font-black tracking-tighter" style="font-family:'Poppins',sans-serif;">LS</span>
            </div>
            <div class="hidden sm:flex items-center gap-1" style="font-family:'Poppins','Montserrat',sans-serif;">
                <span class="text-xl md:text-2xl lg:text-[28px] font-black tracking-[-0.04em] text-[#101828]">Lumban</span>
                <span class="text-xl md:text-2xl lg:text-[28px] font-black tracking-[-0.04em] text-[#00A389]">Silintong</span>
            </div>
            {{-- Nama singkat utk layar sangat kecil --}}
            <span class="sm:hidden text-base font-black tracking-tight text-[#101828]" style="font-family:'Poppins',sans-serif;">
                Lumban<span class="text-[#00A389]">Silintong</span>
            </span>
        </a>

        {{-- ===== AUTH SECTION ===== --}}
        <div class="flex items-center gap-2">

            @auth
                @php
                    $unreadNotifications = Auth::user()->notifikasiBelumDibaca()->count();
                @endphp

                {{-- ---- NOTIFICATION BELL ---- --}}
                <a href="{{ route('notifikasi.index') }}"
                   class="relative inline-flex items-center justify-center w-11 h-11 rounded-full bg-[#101828] text-white hover:bg-gray-900 transition-all duration-300 border border-gray-800"
                   aria-label="Notifikasi">
                    <i class="fa-regular fa-bell text-lg"></i>
                    @if($unreadNotifications > 0)
                        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-5 h-5 rounded-full bg-red-500 text-[10px] font-bold text-white shadow-lg translate-x-1 -translate-y-1">
                            {{ $unreadNotifications > 99 ? '99+' : $unreadNotifications }}
                        </span>
                    @endif
                </a>

                {{-- ---- USER BUTTON (semua ukuran) ---- --}}
                <div class="relative" x-data="{ userMenu: false }">
                    {{-- Desktop: nama + avatar + chevron --}}
                    <button @click="userMenu = !userMenu"
                            class="hidden md:flex items-center gap-2.5 px-3 py-2 rounded-full bg-[#101828] hover:bg-gray-900 transition-all duration-300 border border-gray-800 group">
                        <div class="w-7 h-7 bg-[#00A389]/20 rounded-full flex items-center justify-center text-[#00A389] text-xs font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-semibold text-white max-w-[120px] truncate">{{ Auth::user()->name }}</span>
                        <i class="fa-solid fa-chevron-down text-[9px] text-[#00A389] transition-transform duration-300 group-hover:rotate-180"></i>
                    </button>

                    {{-- Mobile: hanya avatar bulat --}}
                    <button @click="userMenu = !userMenu"
                            class="md:hidden w-9 h-9 bg-[#101828] rounded-full flex items-center justify-center text-[#00A389] text-sm font-bold border-2 border-[#00A389]/40 hover:border-[#00A389] transition-all duration-300 shadow-lg">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </button>

                    {{-- Dropdown (sama untuk semua ukuran) --}}
                    <div x-show="userMenu"
                         @click.away="userMenu = false"
                         x-cloak
                         class="absolute top-full right-0 mt-3 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-gray-100 overflow-hidden z-50 flex flex-col"
                         style="width: min(320px, calc(100vw - 24px));"
                         x-transition:enter="transition-all duration-250 ease-out"
                         x-transition:enter-start="opacity-0 -translate-y-3 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition-all duration-150 ease-in"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 -translate-y-3 scale-95">

                        {{-- Header profil --}}
                        <div class="bg-[#101828] px-5 py-5 text-white border-b-4 border-[#00A389] relative overflow-hidden">
                            <div class="absolute top-[-20px] right-[-20px] w-20 h-20 bg-[#00A389]/20 rounded-full blur-2xl"></div>
                            <div class="flex items-center gap-3 relative z-10">
                                <div class="w-12 h-12 bg-[#00A389] text-white rounded-2xl flex items-center justify-center text-xl font-black shadow-inner flex-shrink-0">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                <div class="min-w-0">
                                    <h4 class="font-bold text-base truncate">{{ Auth::user()->name }}</h4>
                                    <p class="text-xs text-gray-400 truncate">{{ Auth::user()->email }}</p>
                                    <span class="inline-block mt-1.5 px-2.5 py-0.5 rounded-full text-[9px] font-extrabold uppercase tracking-wider
                                        @if(Auth::user()->role->nama_role == 'admin') bg-red-500/20 text-red-400
                                        @elseif(Auth::user()->role->nama_role == 'umkm') bg-amber-500/20 text-amber-400
                                        @else bg-[#00A389]/20 text-[#00A389] @endif">
                                        {{ Auth::user()->role->nama_role }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        {{-- Switch panel (admin only) --}}
                        @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
                            @php $isAdminSection = Request::routeIs('admin.*'); @endphp
                            <div class="px-4 py-3 border-b border-gray-100">
                                <a href="{{ $isAdminSection ? route('masyarakat.dashboard') : route('admin.dashboard') }}"
                                   class="w-full inline-flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-[#00A389] text-white font-semibold text-sm hover:bg-[#0dc2a3] transition-all duration-200 shadow-sm">
                                    <i class="fa-solid fa-arrows-rotate text-xs"></i>
                                    <span>{{ $isAdminSection ? 'Ke Beranda' : 'Admin Panel' }}</span>
                                </a>
                            </div>
                        @endif

                        {{-- Profile link untuk masyarakat dan UMKM saja --}}
                        @if(optional(Auth::user()->role)->nama_role !== 'admin')
                            <div class="px-4 pt-3">
                                <a href="{{ route('masyarakat.profil') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-gray-50 transition text-sm text-gray-700 font-medium">
                                    <i class="fa-solid fa-user-circle text-gray-400 w-4 text-center"></i>
                                    <span>Profil Saya</span>
                                </a>
                            </div>
                        @endif

                        {{-- Logout --}}
                        <div class="px-4 pb-4 pt-2">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-[#101828] hover:bg-red-600 text-white rounded-xl font-bold text-sm tracking-wide transition-all duration-300">
                                    <i class="fa-solid fa-sign-out-alt"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

            @else
                {{-- ---- GUEST: Desktop → full button, Mobile → ikon + text compact ---- --}}

                {{-- Desktop (md+): tombol penuh --}}
                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('login') }}" class="btn-nav-login px-5 py-2 rounded-full font-bold text-sm tracking-wide transition-all duration-300 flex items-center gap-1.5">
                        <i class="fa-solid fa-sign-in-alt text-xs"></i>
                        <span>Masuk</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn-nav-register px-5 py-2 rounded-full text-white font-bold text-sm tracking-wide transition-all duration-300 flex items-center gap-1.5 shadow-lg">
                        <i class="fa-solid fa-user-plus text-xs"></i>
                        <span>Daftar</span>
                    </a>
                </div>

                {{-- Mobile (< md): titik 3 / ellipsis menu --}}
                <div class="md:hidden relative" x-data="{ guestMenu: false }">
                    <button @click="guestMenu = !guestMenu"
                            class="w-9 h-9 rounded-full bg-[#101828] flex items-center justify-center text-white hover:bg-gray-800 transition-all duration-200 shadow-lg">
                        <i class="fa-solid fa-ellipsis-vertical text-sm"></i>
                    </button>
                    <div x-show="guestMenu"
                         @click.away="guestMenu = false"
                         x-cloak
                         class="absolute top-full right-0 mt-2 bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden z-50 py-2"
                         style="min-width: 160px;"
                         x-transition:enter="transition-all duration-200 ease-out"
                         x-transition:enter-start="opacity-0 -translate-y-2 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="transition-all duration-150 ease-in"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95">
                        <a href="{{ route('login') }}"
                           class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-[#101828] hover:bg-gray-50 transition">
                            <i class="fa-solid fa-sign-in-alt text-[#00A389] w-4 text-center"></i>
                            <span>Masuk</span>
                        </a>
                        <a href="{{ route('register') }}"
                           class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-[#101828] hover:bg-gray-50 transition">
                            <i class="fa-solid fa-user-plus text-[#00A389] w-4 text-center"></i>
                            <span>Daftar</span>
                        </a>
                    </div>
                </div>

            @endauth
        </div>
    </div>
</nav>

<style>
    /* ============================================================
       NAV TOP — Responsive Floating Navbar
       ============================================================ */
    .nav-top {
        position: fixed;
        top: 12px;
        left: 50%;
        transform: translateX(-50%);
        width: calc(100% - 24px);
        max-width: 600px;
        height: 60px;
        background: rgba(255, 255, 255, 0.92);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(0, 0, 0, 0.06);
        border-radius: 50px;
        z-index: 1000;
        display: flex;
        align-items: center;
        padding: 0 16px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
    }

    /* Tablet */
    @media (min-width: 640px) {
        .nav-top {
            top: 14px;
            max-width: 720px;
            height: 66px;
            padding: 0 22px;
        }
    }

    /* Desktop (sidebar ada) */
    @media (min-width: 1025px) {
        .nav-top {
            top: 18px;
            left: 120px;
            right: 24px;
            width: auto;
            max-width: none;
            transform: none;
            height: 72px;
            padding: 0 32px;
        }
        .nav-scrolled {
            top: 10px;
            left: 120px;
            right: 24px;
            width: auto;
        }
    }

    /* Sidebar expanded */
    @media (min-width: 1025px) {
        .main-container.sidebar-open ~ .nav-top,
        body:has(.magic-sidebar.expanded) .nav-top {
            left: 210px;
        }
    }

    .nav-scrolled {
        background: rgba(255, 255, 255, 0.98);
        box-shadow: 0 12px 36px rgba(0, 0, 0, 0.1);
        border-color: rgba(0, 163, 137, 0.15);
    }

    /* Mobile scrolled — lebih compact */
    @media (max-width: 639px) {
        .nav-scrolled {
            top: 8px;
            height: 54px;
        }
    }

    /* ---- Buttons ---- */
    .btn-nav-register {
        background: #00A389;
        border: 2px solid #00A389;
        position: relative;
        overflow: hidden;
    }
    .btn-nav-register::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
        transition: 0.5s;
    }
    .btn-nav-register:hover {
        transform: translateY(-1px) scale(1.02);
        box-shadow: 0 8px 20px rgba(0, 163, 137, 0.35);
        background: #00c4a5;
        border-color: #00c4a5;
    }
    .btn-nav-register:hover::before { left: 100%; }

    .btn-nav-login {
        border: 2px solid #101828;
        color: #101828;
        background: transparent;
    }
    .btn-nav-login:hover {
        color: #00A389;
        background: #101828;
        transform: translateY(-1px) scale(1.02);
        box-shadow: 0 8px 16px rgba(16, 24, 40, 0.12);
    }

    /* ---- Utilities ---- */
    [x-cloak] { display: none !important; }

    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

