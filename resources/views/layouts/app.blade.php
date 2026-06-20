<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lumban Silintong | @yield('title', 'Desa Digital Premium')</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --emerald-950: #064e3b;
            --emerald-500: #10b981;
            --glass: rgba(255, 255, 255, 0.85);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #fafaf8; 
            color: var(--emerald-950); 
            overflow-x: hidden; min-height: 100dvh;
        }
        .font-serif { font-family: 'Playfair Display', serif; }

        /* Navbar */
        .nav-top {
            position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            width: 90%; max-width: 1400px; height: 80px;
            background: var(--glass); backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 50px;
            z-index: 1000; display: flex; align-items: center; padding: 0 40px;
            transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-scrolled { top: 10px; width: 95%; height: 70px; background: rgba(255, 255, 255, 0.98); box-shadow: 0 15px 40px rgba(0,0,0,0.08); }

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

        /* Sidebar Desktop */
        .magic-sidebar {
            position: fixed;
            left: 30px;
            top: 50%;
            transform: translateY(-50%);
            width: 65px;  /* DIPERKECIL dari 80px menjadi 65px */
            background: linear-gradient(135deg, #064e3b, #022c22);
            backdrop-filter: blur(20px);
            border-radius: 35px; /* DIPERKECIL */
            z-index: 1100;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            padding: 20px 0;
            box-shadow: 0 25px 50px rgba(6, 78, 59, 0.3);
            border: 1px solid rgba(255,255,255,0.12);
            height: auto;
            max-height: calc(100vh - 60px);
            overflow-y: auto;
            overflow-x: hidden;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .magic-sidebar::-webkit-scrollbar {
            display: none;
        }
        .side-item {
            position: relative; width: 44px; height: 44px; display: flex;
            align-items: center; justify-content: center; border-radius: 20px;
            color: rgba(255,255,255,0.45); font-size: 18px; transition: 0.3s;
            cursor: pointer;
            flex-shrink: 0;
        }
        .side-item:hover, .side-item.active { color: #fff; background: rgba(255,255,255,0.12); transform: translateY(-2px); }
        .side-item.active { color: #10b981; background: #fff; box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .info-box {
            position: absolute; left: 75px; background: white; padding: 12px 20px;
            border-radius: 24px; box-shadow: 0 20px 40px rgba(0,0,0,0.12);
            opacity: 0; visibility: hidden; transform: translateX(-15px); transition: 0.3s;
            min-width: 220px; border: 1px solid rgba(0,0,0,0.04);
            z-index: 1200;
        }
        .info-box h5 {
            font-size: 14px;
            margin-top: 4px;
        }
        .info-box p {
            font-size: 10px;
        }
        .info-box span {
            font-size: 8px;
        }
        .side-item:hover .info-box { opacity: 1; visibility: visible; transform: translateX(0); }

        /* Scaling Responsif Berdasarkan Tinggi Layar */
        @media (max-height: 850px) {
            .magic-sidebar {
                gap: 8px;
                padding: 15px 0;
            }
            .side-item {
                width: 38px;
                height: 38px;
                font-size: 16px;
                border-radius: 16px;
            }
            .info-box {
                left: 60px;
                padding: 10px 16px;
                min-width: 200px;
            }
        }

        @media (max-height: 700px) {
            .magic-sidebar {
                gap: 6px;
                padding: 10px 0;
            }
            .side-item {
                width: 32px;
                height: 32px;
                font-size: 14px;
                border-radius: 12px;
            }
            .info-box {
                left: 50px;
                padding: 8px 12px;
                min-width: 180px;
            }
        }

        /* Mobile Bottom Nav */
        .mobile-nav {
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            width: 90%; height: 65px; background: #064e3b;
            border-radius: 35px; z-index: 1100; display: none;
            align-items: center; justify-content: space-around; padding: 0 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }
        .mobile-nav a {
            font-size: 18px;
        }
        @media (max-width: 1024px) {
            .magic-sidebar { display: none; }
            .mobile-nav { display: flex; }
            .main-container { margin-left: 0 !important; padding-top: 88px !important; }
        }
        .main-container { margin-left: 120px; padding-top: 100px; transition: 0.3s; }

        /* Hero Slider */
        .slider-container { border-radius: 60px; overflow: hidden; position: relative; box-shadow: 0 40px 80px rgba(0,0,0,0.1); }
        .slider-wrapper { display: flex; transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1); }
        .slide { min-width: 100%; height: 85vh; position: relative; }
        .slide-content { 
            position: absolute; inset: 0; 
            background: linear-gradient(to right, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
            display: flex; flex-direction: column; justify-content: center; padding-left: 8%; color: white;
        }
        .btn-premium {
            background: linear-gradient(135deg, #064e3b, #065f46);
            color: #fff; padding: 16px 36px; border-radius: 40px;
            font-weight: 700; font-size: 11px; text-transform: uppercase;
            letter-spacing: 1.5px; transition: 0.3s; display: inline-block;
            box-shadow: 0 10px 25px rgba(6, 78, 59, 0.25);
        }
        .btn-premium:hover { transform: translateY(-3px) scale(1.02); background: #10b981; box-shadow: 0 15px 30px rgba(16, 185, 129, 0.35); }

        .empty-state {
            border: 2px dashed #e2e8f0; border-radius: 40px; padding: 60px 30px;
            text-align: center; background: #f8fafc;
        }

        /* ============================================ */
        /* FOOTER - GAMBAR CERAH, TEKS BESAR PUTIH/HIJAU */
        /* ============================================ */
        .footer-cerah {
            background: linear-gradient(180deg, #0a2a1f 0%, #041a10 100%);
            border-radius: 32px 32px 0 0;
            margin-top: 60px;
            position: relative;
            overflow: hidden;
        }
        
        /* Background gambar dengan blur minimal */
        .footer-cerah::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=2070');
            background-size: cover;
            background-position: center 35%;
            background-repeat: no-repeat;
            opacity: 0.35;
            filter: blur(2px);
            pointer-events: none;
        }
        
        /* Overlay tipis untuk kontras */
        .footer-cerah::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(180deg, rgba(10, 42, 31, 0.5) 0%, rgba(4, 26, 16, 0.85) 100%);
            pointer-events: none;
        }
        
        /* Teks navigasi lebih besar dan putih */
        .footer-link-cerah {
            transition: all 0.3s ease;
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.95rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        
        .footer-link-cerah:hover {
            color: #34d399;
            transform: translateX(5px);
        }
        
        .footer-heading {
            font-size: 0.7rem;
            font-weight: 700;
            letter-spacing: 0.2em;
            color: #34d399;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }
        
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>

<body x-data="{ scrolled: false, scrollProgress: 0, slide: 0, totalSlides: 6, faq: null, tahun: new Date().getFullYear() }" 
      @scroll.window="scrolled = (window.pageYOffset > 50); scrollProgress = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;" 
      x-init="setInterval(() => slide = (slide + 1) % totalSlides, 7000)">

    {{-- Progress Bar Dinamis berdasarkan Role --}}
    @php
        $progressColor = 'linear-gradient(to right, #10b981, #34d399)'; // Masyarakat / Guest (Emerald)
        if(auth()->check()) {
            if(auth()->user()->isAdmin()) {
                $progressColor = 'linear-gradient(to right, #3b82f6, #60a5fa)'; // Admin (Blue)
            } elseif(auth()->user()->isUmkm()) {
                $progressColor = 'linear-gradient(to right, #f59e0b, #fbbf24)'; // UMKM (Amber)
            }
        }
    @endphp
    <div class="fixed top-0 left-0 h-[4px] z-[11000] transition-all duration-150 ease-out shadow-[0_0_12px_rgba(0,0,0,0.3)]" 
         :style="`width: ${scrollProgress}%; background: {{ $progressColor }};`">
    </div>

    @include('layouts.navigation_desa')
    @include('layouts.navigation_magic_sidebar')

    <div class="main-container">
        @yield('content')
    </div>

    {{-- ============================================= --}}
    {{-- FOOTER - GAMBAR CERAH, TEKS BESAR PUTIH/HIJAU --}}
    {{-- ============================================= --}}
    <footer class="footer-cerah text-white pt-10 pb-28 px-6 md:pt-16 md:pb-10 md:px-[6%]">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row justify-between gap-6 md:gap-10 mb-6 md:mb-10">
                
                {{-- Left Section - Silintong --}}
                <div class="md:w-2/5">
                    <h1 class="text-4xl md:text-7xl font-serif italic text-emerald-400 tracking-wide mb-2 md:mb-3 leading-tight">Silintong</h1>
                    <p class="text-white/60 text-sm md:text-base italic mt-1 md:mt-2 leading-relaxed max-w-sm">
                        Pusat Digitalisasi Peradaban Desa<br>Pesisir Danau Toba.
                    </p>
                </div>

                {{-- Middle Section - Navigasi & Layanan --}}
                <div class="md:w-2/5">
                    <div class="grid grid-cols-2 gap-6 md:gap-10">
                        <div>
                            <h5 class="footer-heading mb-3">NAVIGASI</h5>
                            <ul class="space-y-2 md:space-y-3">
                                <li><a href="{{ route('home') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Beranda</a></li>
                                <li><a href="{{ route('profil-desa') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Profil Desa</a></li>
                                <li><a href="{{ route('berita') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Berita</a></li>
                                <li><a href="{{ route('galeri') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Galeri</a></li>
                                <li><a href="{{ route('umkm') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">UMKM</a></li>
                                <li><a href="{{ route('kontak') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Kontak</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="footer-heading mb-3">LAYANAN</h5>
                            <ul class="space-y-2 md:space-y-3">
                                @auth
                                    @if(auth()->user()->role == 'admin')
                                        <li><a href="{{ route('admin.dashboard') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Dashboard Admin</a></li>
                                        <li><a href="{{ route('admin.pengajuan-surat.index') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Kelola Surat</a></li>
                                        <li><a href="{{ route('admin.aspirasi.index') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Kelola Aspirasi</a></li>
                                    @else
                                        {{-- Menu untuk Masyarakat & Pemilik UMKM disamakan --}}
                                        <li><a href="{{ route('masyarakat.dashboard') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Dashboard</a></li>
                                        <li><a href="{{ route('masyarakat.surat.index') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Layanan Surat</a></li>
                                        <li><a href="{{ route('masyarakat.aspirasi.index') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Aspirasi & Pengaduan</a></li>
                                        <li><a href="{{ route('masyarakat.keuangan.index') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Transparansi Keuangan</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ route('login') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Layanan Surat</a></li>
                                    <li><a href="{{ route('login') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Aspirasi & Pengaduan</a></li>
                                    <li><a href="{{ route('umkm') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">UMKM Lokal</a></li>
                                    <li><a href="{{ route('galeri') }}" class="footer-link-cerah text-sm md:text-[0.95rem]">Galeri Desa</a></li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Right Section - Lokasi --}}
                <div class="md:w-1/5">
                    <h5 class="footer-heading mb-3">KANTOR</h5>
                    <p class="text-white/60 text-sm leading-relaxed">
                        Kabupaten Toba,<br>
                        Sumatera Utara,<br>
                        Indonesia.
                    </p>
                </div>
            </div>

            {{-- Bottom Tagline --}}
            <div class="border-t border-white/15 pt-6 md:pt-8 flex flex-col md:flex-row justify-between items-center gap-3 md:gap-4">
                <p class="text-white/40 text-xs md:text-sm italic tracking-wide text-center md:text-left">
                    Mewujudkan masa depan desa digital yang harmonis dengan keindahan alam Toba.
                </p>
                <p class="text-white/25 text-[9px] md:text-[10px] tracking-wider text-center md:text-right">
                    © <span x-text="tahun"></span> DESA LUMBAN SILINTONG
                </p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true, easing: 'ease-out-cubic' });
    </script>
    {{-- Confirm Dialog (Global) --}}
    <div id="confirm-dialog" class="fixed inset-0 z-[9999] hidden" aria-hidden="true">
        <div id="confirm-backdrop" class="absolute inset-0 bg-slate-950/50 backdrop-blur-md opacity-0 transition-opacity duration-200"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 sm:p-8">
            <div id="confirm-panel" class="w-full max-w-md opacity-0 scale-[0.98] translate-y-2 transition-all duration-200">
                <div class="relative overflow-hidden rounded-[28px] border border-white/30 bg-white/85 shadow-[0_30px_80px_-20px_rgba(2,6,23,0.45)]">
                    <div class="absolute -top-24 -right-24 h-56 w-56 rounded-full bg-emerald-400/20 blur-3xl"></div>
                    <div class="absolute -bottom-24 -left-24 h-56 w-56 rounded-full bg-sky-400/20 blur-3xl"></div>

                    <div class="relative p-7 sm:p-8">
                        <div class="flex items-start gap-4">
                            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-rose-500 to-orange-400 text-white shadow-lg shadow-rose-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 id="confirm-title" class="text-lg sm:text-xl font-black text-slate-900 tracking-tight">
                                    Konfirmasi
                                </h3>
                                <p id="confirm-message" class="mt-1.5 text-sm sm:text-[15px] leading-relaxed text-slate-600">
                                    Anda yakin mau hapus?
                                </p>
                            </div>
                            <button type="button" id="confirm-close" class="group -mr-1 -mt-1 h-10 w-10 rounded-2xl border border-slate-200/70 bg-white/70 hover:bg-white transition flex items-center justify-center">
                                <i class="fa-solid fa-xmark text-slate-500 group-hover:text-slate-900 transition"></i>
                            </button>
                        </div>

                        <div class="mt-7 flex flex-col-reverse sm:flex-row gap-3 sm:justify-end">
                            <button type="button" id="confirm-cancel"
                                    class="w-full sm:w-auto px-5 py-3 rounded-2xl font-extrabold text-[12px] uppercase tracking-[0.18em]
                                           border border-slate-200 bg-white/70 text-slate-700
                                           hover:bg-slate-50 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                                Batal
                            </button>
                            <button type="button" id="confirm-ok"
                                    class="w-full sm:w-auto px-5 py-3 rounded-2xl font-extrabold text-[12px] uppercase tracking-[0.18em]
                                           bg-gradient-to-r from-rose-600 to-orange-500 text-white shadow-lg shadow-rose-500/20
                                           hover:shadow-xl hover:shadow-rose-500/30 hover:-translate-y-0.5 transition-all duration-300">
                                Ya, Hapus
                            </button>
                        </div>

                        <div class="mt-5 text-[11px] text-slate-400">
                            Tindakan ini tidak bisa dibatalkan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (prefers-reduced-motion: reduce) {
            #confirm-backdrop, #confirm-panel { transition: none !important; }
        }
    </style>

    <script>
        (function () {
            const dialog = document.getElementById('confirm-dialog');
            const backdrop = document.getElementById('confirm-backdrop');
            const panel = document.getElementById('confirm-panel');
            const titleEl = document.getElementById('confirm-title');
            const messageEl = document.getElementById('confirm-message');
            const okBtn = document.getElementById('confirm-ok');
            const cancelBtn = document.getElementById('confirm-cancel');
            const closeBtn = document.getElementById('confirm-close');

            let resolver = null;
            let isOpen = false;

            function openDialog({ title, message, confirmText, cancelText }) {
                if (!dialog || !backdrop || !panel) return Promise.resolve(window.confirm(message || 'Anda yakin?'));

                titleEl.textContent = title || 'Konfirmasi';
                messageEl.textContent = message || 'Anda yakin?';
                okBtn.textContent = confirmText || 'Ya, Hapus';
                cancelBtn.textContent = cancelText || 'Batal';

                dialog.classList.remove('hidden');
                dialog.setAttribute('aria-hidden', 'false');
                isOpen = true;

                requestAnimationFrame(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    panel.classList.remove('opacity-0', 'scale-[0.98]', 'translate-y-2');
                    panel.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                });

                const previouslyFocused = document.activeElement;
                okBtn.focus();

                return new Promise(resolve => {
                    resolver = (value) => {
                        resolve(!!value);
                        resolver = null;
                        isOpen = false;

                        backdrop.classList.remove('opacity-100');
                        backdrop.classList.add('opacity-0');
                        panel.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                        panel.classList.add('opacity-0', 'scale-[0.98]', 'translate-y-2');

                        setTimeout(() => {
                            dialog.classList.add('hidden');
                            dialog.setAttribute('aria-hidden', 'true');
                            if (previouslyFocused && previouslyFocused.focus) previouslyFocused.focus();
                        }, 210);
                    };
                });
            }

            function close(value) {
                if (resolver) resolver(value);
            }

            function isDeleteForm(form) {
                const methodInput = form.querySelector('input[name="_method"]');
                return (methodInput && String(methodInput.value).toUpperCase() === 'DELETE')
                    || form.getAttribute('data-confirm-delete') === 'true';
            }

            window.__confirmDialog = openDialog;

            if (dialog) {
                okBtn.addEventListener('click', () => close(true));
                cancelBtn.addEventListener('click', () => close(false));
                closeBtn.addEventListener('click', () => close(false));
                backdrop.addEventListener('click', () => close(false));
                document.addEventListener('keydown', (e) => {
                    if (!isOpen) return;
                    if (e.key === 'Escape') close(false);
                    if (e.key === 'Enter') close(true);
                });
            }

            document.addEventListener('submit', async function (e) {
                const form = e.target;
                if (!(form instanceof HTMLFormElement)) return;
                if (!isDeleteForm(form)) return;

                e.preventDefault();
                e.stopImmediatePropagation();

                const message = form.getAttribute('data-confirm-message') || 'Anda yakin mau hapus?';
                const ok = await openDialog({ title: 'Konfirmasi Hapus', message, confirmText: 'Ya, Hapus', cancelText: 'Batal' });
                if (!ok) return;

                form.submit();
            }, true);
        })();
    </script>
    @stack('scripts')
    <!-- Premium Logout Dialog -->
    <div id="logout-premium-dialog" class="fixed inset-0 z-[10000] hidden" aria-hidden="true">
        <div id="logout-backdrop" class="absolute inset-0 bg-slate-900/60 backdrop-blur-xl opacity-0 transition-opacity duration-500 ease-out"></div>
        
        <div class="absolute inset-0 flex items-center justify-center p-4">
            <div id="logout-panel" class="w-full max-w-sm opacity-0 scale-90 translate-y-8 transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]">
                <div class="relative overflow-hidden rounded-[32px] bg-white/90 backdrop-blur-2xl shadow-[0_40px_100px_-20px_rgba(0,0,0,0.5)] border border-white/50 text-center p-8">
                    <!-- Abstract glowing orbs -->
                    <div class="absolute -top-20 -right-20 w-40 h-40 bg-rose-500/20 blur-[40px] rounded-full pointer-events-none"></div>
                    <div class="absolute -bottom-20 -left-20 w-40 h-40 bg-emerald-500/20 blur-[40px] rounded-full pointer-events-none"></div>

                    <!-- Icon Container -->
                    <div class="relative mx-auto w-20 h-20 bg-gradient-to-tr from-rose-500 to-red-400 rounded-3xl flex items-center justify-center shadow-xl shadow-rose-500/30 mb-6 rotate-3 transform hover:rotate-0 transition-transform duration-300">
                        <i class="fa-solid fa-arrow-right-from-bracket text-white text-3xl translate-x-0.5"></i>
                        <div class="absolute inset-0 rounded-3xl border-2 border-white/40 animate-ping opacity-20" style="animation-duration: 3s;"></div>
                    </div>

                    <h3 class="text-2xl font-black text-slate-800 tracking-tight font-serif italic mb-2">Akhiri Sesi?</h3>
                    <p class="text-slate-500 text-[13px] mb-8 px-2 leading-relaxed font-medium">
                        Apakah Anda yakin ingin keluar dari aplikasi? Anda harus login kembali untuk mengakses fitur.
                    </p>

                    <div class="flex flex-col gap-3 relative z-10">
                        <button type="button" id="logout-btn-confirm"
                                class="w-full py-3.5 rounded-2xl font-black text-[13px] uppercase tracking-widest
                                       bg-gradient-to-r from-rose-600 to-red-500 text-white shadow-lg shadow-rose-500/25
                                       hover:shadow-rose-500/40 hover:-translate-y-0.5 transition-all duration-300 relative overflow-hidden group">
                            <span class="relative z-10 flex items-center justify-center gap-2">
                                <span>Ya, Keluar</span>
                            </span>
                            <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-out"></div>
                        </button>
                        
                        <button type="button" id="logout-btn-cancel"
                                class="w-full py-3.5 rounded-2xl font-bold text-[13px] uppercase tracking-widest
                                       bg-slate-100/80 text-slate-500 hover:bg-slate-200 hover:text-slate-700
                                       transition-all duration-300">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const dialog = document.getElementById('logout-premium-dialog');
            if (!dialog) return;
            const backdrop = document.getElementById('logout-backdrop');
            const panel = document.getElementById('logout-panel');
            const confirmBtn = document.getElementById('logout-btn-confirm');
            const cancelBtn = document.getElementById('logout-btn-cancel');

            let resolver = null;
            let isOpen = false;

            function openLogoutDialog() {
                dialog.classList.remove('hidden');
                dialog.setAttribute('aria-hidden', 'false');
                isOpen = true;

                // Trigger reflow
                void dialog.offsetWidth;

                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                
                panel.classList.remove('opacity-0', 'scale-90', 'translate-y-8');
                panel.classList.add('opacity-100', 'scale-100', 'translate-y-0');

                confirmBtn.focus();

                return new Promise(resolve => {
                    resolver = (value) => {
                        resolve(!!value);
                        resolver = null;
                        isOpen = false;

                        backdrop.classList.remove('opacity-100');
                        backdrop.classList.add('opacity-0');
                        
                        panel.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                        panel.classList.add('opacity-0', 'scale-90', 'translate-y-8');

                        setTimeout(() => {
                            dialog.classList.add('hidden');
                            dialog.setAttribute('aria-hidden', 'true');
                        }, 500); 
                    };
                });
            }

            function close(value) {
                if (resolver) resolver(value);
            }

            confirmBtn.addEventListener('click', () => close(true));
            cancelBtn.addEventListener('click', () => close(false));
            backdrop.addEventListener('click', () => close(false));
            document.addEventListener('keydown', (e) => {
                if (!isOpen) return;
                if (e.key === 'Escape') close(false);
                if (e.key === 'Enter') close(true);
            });

            window.__openLogoutDialog = openLogoutDialog;
        })();
        
        // Intercept logout forms
        document.addEventListener('submit', async function (e) {
            const form = e.target;
            if (!(form instanceof HTMLFormElement)) return;
            
            const actionUrl = form.getAttribute('action') || '';
            if (!actionUrl.includes('logout')) return;

            e.preventDefault();
            e.stopImmediatePropagation();

            if (window.__openLogoutDialog) {
                const ok = await window.__openLogoutDialog();
                if (ok) form.submit();
            } else {
                form.submit();
            }
        }, true);
    </script>
</body>
</html>

