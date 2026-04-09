{{-- resources/views/navigation_desa.blade.php --}}
@php
    // Simulasi status login - di aplikasi nyata gunakan Auth::check()
    $isLoggedIn = session('isLoggedIn', false) ?? false;
    $userName = session('userName', 'Warga Desa') ?? 'Warga Desa';
@endphp

<nav class="nav-top" :class="{ 'nav-scrolled': scrolled }" x-data="{ 
    isLoggedIn: {{ $isLoggedIn ? 'true' : 'false' }},
    userName: '{{ $userName }}',
    mobileMenuOpen: false
}">
    <div class="w-full flex justify-between items-center">
        {{-- Logo & Brand --}}
        <a href="/" class="flex items-center gap-5 group">
            <div class="w-14 h-14 bg-emerald-950 rounded-[22px] flex items-center justify-center text-white shadow-2xl rotate-6 group-hover:rotate-0 transition-all duration-500">
                <span class="text-xl font-black">LS</span>
            </div>
            <div class="hidden md:flex flex-col">
                <span class="text-2xl font-serif italic text-emerald-950 leading-none">Lumban Silintong</span>
                <span class="text-[9px] font-black uppercase tracking-[0.4em] text-emerald-500 mt-1">Excellence Village Portal</span>
            </div>
        </a>

        {{-- Desktop Menu Lengkap (sama seperti sidebar) --}}
        <div class="hidden lg:flex items-center gap-8">
            <div class="flex gap-8 text-[11px] font-bold uppercase tracking-[0.2em]">
                <a href="/" class="text-emerald-950/50 hover:text-emerald-600 transition duration-300">Beranda</a>
                <a href="#profil" class="text-emerald-950/50 hover:text-emerald-600 transition duration-300">Profil</a>
                <a href="#berita" class="text-emerald-950/50 hover:text-emerald-600 transition duration-300">Warta Desa</a>
                <a href="#umkm" class="text-emerald-950/50 hover:text-emerald-600 transition duration-300">UMKM</a>
                <a href="#layanan" class="text-emerald-950/50 hover:text-emerald-600 transition duration-300">Layanan</a>
                <a href="#galeri" class="text-emerald-950/50 hover:text-emerald-600 transition duration-300">Galeri</a>
                <a href="#peta" class="text-emerald-950/50 hover:text-emerald-600 transition duration-300">Geografis</a>
            </div>

            {{-- Tombol Auth dengan Efek Liquid Fill --}}
            <div class="flex items-center gap-4">
                <template x-if="!isLoggedIn">
                    <div class="flex gap-3">
                        {{-- Tombol Masuk (Login) - Efek Liquid Fill Hijau --}}
                        <a href="/login" class="relative overflow-hidden group btn-auth btn-login">
                            <span class="relative z-10 flex items-center gap-2">
                                <i class="fa-regular fa-right-to-bracket text-xs"></i>
                                <span>Masuk</span>
                            </span>
                            <div class="liquid-fill liquid-fill-green"></div>
                        </a>
                        
                        {{-- Tombol Daftar (Register) - Efek Liquid Fill Biru --}}
                        <a href="/register" class="relative overflow-hidden group btn-auth btn-register">
                            <span class="relative z-10 flex items-center gap-2">
                                <i class="fa-regular fa-user-plus text-xs"></i>
                                <span>Daftar</span>
                            </span>
                            <div class="liquid-fill liquid-fill-blue"></div>
                        </a>
                    </div>
                </template>

                <template x-if="isLoggedIn">
                    <div class="flex items-center gap-4">
                        {{-- Avatar & Nama User --}}
                        <div class="flex items-center gap-3 px-3 py-2 rounded-2xl bg-emerald-50/50">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-700 flex items-center justify-center text-white text-sm font-bold">
                                <span x-text="userName.charAt(0).toUpperCase()"></span>
                            </div>
                            <span class="text-sm font-medium text-emerald-800" x-text="userName"></span>
                        </div>
                        
                        {{-- Tombol Logout - Efek Liquid Fill Merah --}}
                        <a href="/logout" class="relative overflow-hidden group btn-auth btn-logout">
                            <span class="relative z-10 flex items-center gap-2">
                                <i class="fa-regular fa-arrow-right-from-bracket text-xs"></i>
                                <span>Keluar</span>
                            </span>
                            <div class="liquid-fill liquid-fill-red"></div>
                        </a>
                    </div>
                </template>
            </div>
        </div>

        {{-- Mobile Menu Toggle Button --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden w-12 h-12 rounded-2xl bg-emerald-950/10 flex items-center justify-center text-emerald-950">
            <i class="fa-solid text-xl" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
        </button>
    </div>

    {{-- Mobile Dropdown Menu --}}
    <div x-show="mobileMenuOpen" x-collapse class="lg:hidden absolute top-full left-0 right-0 mt-4 mx-4 bg-white/95 backdrop-blur-xl rounded-3xl shadow-2xl border border-white/20 overflow-hidden z-50">
        <div class="flex flex-col py-6">
            <a href="/" class="px-6 py-4 text-emerald-950/70 hover:bg-emerald-50 transition flex items-center gap-3">
                <i class="fa-solid fa-house w-5"></i> Beranda
            </a>
            <a href="#profil" class="px-6 py-4 text-emerald-950/70 hover:bg-emerald-50 transition flex items-center gap-3">
                <i class="fa-solid fa-landmark-dome w-5"></i> Profil Desa
            </a>
            <a href="#berita" class="px-6 py-4 text-emerald-950/70 hover:bg-emerald-50 transition flex items-center gap-3">
                <i class="fa-solid fa-newspaper w-5"></i> Warta Desa
            </a>
            <a href="#umkm" class="px-6 py-4 text-emerald-950/70 hover:bg-emerald-50 transition flex items-center gap-3">
                <i class="fa-solid fa-shop w-5"></i> UMKM
            </a>
            <a href="#layanan" class="px-6 py-4 text-emerald-950/70 hover:bg-emerald-50 transition flex items-center gap-3">
                <i class="fa-solid fa-fingerprint w-5"></i> Layanan
            </a>
            <a href="#galeri" class="px-6 py-4 text-emerald-950/70 hover:bg-emerald-50 transition flex items-center gap-3">
                <i class="fa-solid fa-photo-film w-5"></i> Galeri
            </a>
            <a href="#peta" class="px-6 py-4 text-emerald-950/70 hover:bg-emerald-50 transition flex items-center gap-3">
                <i class="fa-solid fa-map-location-dot w-5"></i> Geografis
            </a>
            
            <div class="border-t border-gray-100 my-2"></div>
            
            <template x-if="!isLoggedIn">
                <div class="px-6 py-3 flex flex-col gap-3">
                    <a href="/login" class="w-full py-3 rounded-xl bg-emerald-500 text-white text-center font-bold text-sm flex items-center justify-center gap-2">
                        <i class="fa-regular fa-right-to-bracket"></i> Masuk
                    </a>
                    <a href="/register" class="w-full py-3 rounded-xl border-2 border-emerald-500 text-emerald-600 text-center font-bold text-sm flex items-center justify-center gap-2">
                        <i class="fa-regular fa-user-plus"></i> Daftar
                    </a>
                </div>
            </template>
            
            <template x-if="isLoggedIn">
                <div class="px-6 py-3">
                    <div class="flex items-center gap-3 mb-4 p-3 bg-emerald-50 rounded-xl">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-700 flex items-center justify-center text-white font-bold">
                            <span x-text="userName.charAt(0).toUpperCase()"></span>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-emerald-800" x-text="userName"></p>
                            <p class="text-xs text-emerald-500">Warga Terverifikasi</p>
                        </div>
                    </div>
                    <a href="/logout" class="w-full py-3 rounded-xl bg-red-500 text-white text-center font-bold text-sm flex items-center justify-center gap-2">
                        <i class="fa-regular fa-arrow-right-from-bracket"></i> Keluar
                    </a>
                </div>
            </template>
        </div>
    </div>
</nav>

{{-- CSS untuk Efek Liquid Fill & Glassmorphism --}}
<style>
    /* Glassmorphism Navbar */
    .nav-top {
        position: fixed;
        top: 20px;
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 1400px;
        height: 85px;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.5);
        border-radius: 45px;
        z-index: 1000;
        display: flex;
        align-items: center;
        padding: 0 32px;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.04);
    }
    
    .nav-scrolled {
        top: 12px;
        width: 94%;
        height: 72px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        border-radius: 38px;
    }
    
    /* Base Button Style */
    .btn-auth {
        padding: 10px 24px;
        border-radius: 40px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: none;
        background: transparent;
        position: relative;
        z-index: 1;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: white;
    }
    
    /* Warna default untuk masing-masing tombol */
    .btn-login {
        background: linear-gradient(135deg, #10b981, #059669);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }
    
    .btn-register {
        background: linear-gradient(135deg, #3b82f6, #2563eb);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25);
    }
    
    .btn-logout {
        background: linear-gradient(135deg, #ef4444, #dc2626);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.25);
    }
    
    /* Liquid Fill Effect Container */
    .liquid-fill {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border-radius: 40px;
        z-index: -1;
        transition: transform 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        transform: scaleX(0);
        transform-origin: left;
    }
    
    /* Warna liquid fill */
    .liquid-fill-green {
        background: linear-gradient(135deg, #047857, #065f46);
    }
    
    .liquid-fill-blue {
        background: linear-gradient(135deg, #1d4ed8, #1e3a8a);
    }
    
    .liquid-fill-red {
        background: linear-gradient(135deg, #b91c1c, #7f1d1d);
    }
    
    /* Hover Effect - Liquid Fill menyala */
    .btn-auth:hover .liquid-fill {
        transform: scaleX(1);
    }
    
    .btn-auth:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }
    
    .btn-auth:active {
        transform: translateY(1px);
    }
    
    /* Pastikan teks tetap di atas liquid fill */
    .btn-auth span {
        position: relative;
        z-index: 2;
    }
    
    /* Mobile menu styling */
    @media (max-width: 1024px) {
        .nav-top {
            padding: 0 20px;
            width: 94%;
        }
        .nav-scrolled {
            width: 92%;
        }
    }
    
    /* Animasi tambahan untuk efek mewah */
    @keyframes subtleGlow {
        0%, 100% { opacity: 0.6; }
        50% { opacity: 1; }
    }
    
    .btn-auth {
        animation: subtleGlow 2s ease-in-out infinite;
    }
    
    .btn-auth:hover {
        animation: none;
    }
</style>

{{-- Script untuk handling logout confirmation (opsional) --}}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Konfirmasi logout
        const logoutBtn = document.querySelector('a[href="/logout"]');
        if (logoutBtn) {
            logoutBtn.addEventListener('click', function(e) {
                e.preventDefault();
                if (confirm('Apakah Anda yakin ingin keluar dari portal desa?')) {
                    window.location.href = '/logout';
                }
            });
        }
    });
</script>