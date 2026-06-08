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
            --emerald-400: #34d399;
            --glass: rgba(255, 255, 255, 0.85);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #fafaf8; 
            color: var(--emerald-950); 
            overflow-x: hidden;
        }
        .font-serif { font-family: 'Playfair Display', serif; }

        /* Navbar Styles */
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

        /* Sidebar Styles */
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
            justify-content: flex-start;
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
        }

        .main-container { margin-left: 120px; padding-top: 100px; transition: 0.3s; min-height: 80vh; }

        @media (max-width: 1024px) {
            .magic-sidebar { display: none; }
            .main-container { margin-left: 0 !important; padding-top: 88px !important; }
        }

        /* ============================================ */
        /* FOOTER MODERN - UNTUK ADMIN */
        /* ============================================ */
        .footer-modern {
            background-color: #0f1715;
            border-top-left-radius: 48px;
            border-top-right-radius: 48px;
            position: relative;
            overflow: hidden;
            color: #f3f4f6;
            padding: 40px 6% 110px 6%;
            margin-top: 60px;
        }

        @media (min-width: 1025px) {
            .footer-modern {
                padding: 50px 6% 35px 6%;
            }
        }

        /* Efek Motif Garis Kontur */
        .footer-modern::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 100%; height: 100%;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath fill='none' stroke='%2334d399' stroke-width='0.4' stroke-opacity='0.1' d='M20,100 C20,40 80,20 100,20 C120,20 180,40 180,100 C180,160 120,180 100,180 C80,180 20,160 20,100 Z M40,100 C40,60 80,40 100,40 C120,40 160,60 160,100 C160,140 120,160 100,160 C80,160 40,140 40,100 Z M60,100 C60,80 80,70 100,70 C120,70 140,80 140,100 C140,120 120,130 100,130 C80,130 60,120 60,100 Z'/%3E%3C/svg%3E");
            background-size: 500px;
            pointer-events: none;
        }

        .footer-logo-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-bottom: 40px;
        }

        .abstract-star {
            width: 50px;
            height: 50px;
            background: var(--emerald-500);
            -webkit-mask: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0 L61 39 L100 50 L61 61 L50 100 L39 61 L0 50 L39 39 Z'/%3E%3C/svg%3E") no-repeat center;
            mask: url("data:image/svg+xml,%3Csvg viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M50 0 L61 39 L100 50 L61 61 L50 100 L39 61 L0 50 L39 39 Z'/%3E%3C/svg%3E") no-repeat center;
            margin-bottom: 15px;
        }

        .footer-heading-modern {
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.25em;
            color: var(--emerald-400);
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .btn-footer-pill {
            background: var(--emerald-500);
            color: #0f1715;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 12px;
            transition: 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-footer-pill:hover {
            transform: translateY(-2px);
            background: #fff;
        }

        .btn-footer-outline {
            border: 1px solid rgba(255,255,255,0.2);
            color: #fff;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 12px;
            transition: 0.3s;
        }

        .btn-footer-outline:hover {
            border-color: var(--emerald-400);
            color: var(--emerald-400);
        }

        .footer-link {
            transition: 0.3s;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
        }
        
        .footer-link:hover {
            color: var(--emerald-400);
            transform: translateX(3px);
        }

        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>

<body x-data="{ scrolled: false, scrollProgress: 0, tahun: new Date().getFullYear() }" 
      @scroll.window="scrolled = (window.pageYOffset > 50); scrollProgress = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100;">

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

    {{-- FOOTER MODERN - UNTUK ADMIN --}}
    <footer class="footer-modern">
        <div class="max-w-7xl mx-auto relative z-10">
            
            {{-- Header Logo & CTA Admin --}}
            <div class="footer-logo-center mb-6 md:mb-10" data-aos="fade-up">
                <div class="abstract-star"></div>
                <h2 class="text-3xl md:text-5xl font-serif italic text-white mb-2">Admin Panel</h2>
                <p class="text-emerald-400/80 tracking-widest text-[10px] uppercase font-bold mb-4 md:mb-6">Kelola Data & Informasi Desa</p>
                
                <div class="flex flex-wrap justify-center gap-3">
                    <a href="{{ route('admin.pengajuan-surat.index') }}" class="btn-footer-pill">
                        Kelola Surat <i class="fa-solid fa-file-lines text-xs"></i>
                    </a>
                    <a href="{{ route('admin.aspirasi.index') }}" class="btn-footer-outline">
                        Kelola Aspirasi <i class="fa-solid fa-comment-dots text-xs ml-1"></i>
                    </a>
                </div>
            </div>

            {{-- Grid Footer Admin --}}
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 md:gap-8 border-t border-white/10 pt-8 md:pt-10">
                
                <div class="space-y-3">
                    <h5 class="footer-heading-modern">Kantor Desa</h5>
                    <div class="text-sm text-white/40 leading-relaxed">
                        <p>Kantor Kepala Desa</p>
                        <p>Lumban Silintong</p>
                        <p>Kec. Balige, Kab. Toba</p>
                        <p>Sumatera Utara, Indonesia</p>
                        <p class="mt-3 text-emerald-400 font-semibold text-xs">admin@lumbansilintong.desa.id</p>
                    </div>
                </div>

                <div>
                    <h5 class="footer-heading-modern">Menu Admin</h5>
                    <ul class="space-y-2">
                        <li><a href="{{ route('admin.dashboard') }}" class="footer-link">Dashboard</a></li>
                        <li><a href="{{ route('admin.pengajuan-surat.index') }}" class="footer-link">Pengajuan Surat</a></li>
                        <li><a href="{{ route('admin.penduduk.index') }}" class="footer-link">Data Penduduk</a></li>
                        <li><a href="{{ route('admin.statistik.index') }}" class="footer-link">Statistik</a></li>
                    </ul>
                </div>

                <div>
                    <h5 class="footer-heading-modern">Kelola Konten</h5>
                    <ul class="space-y-2">
                        <li><a href="{{ route('admin.berita.index') }}" class="footer-link">Kelola Berita</a></li>
                        <li><a href="{{ route('admin.galeri.index') }}" class="footer-link">Kelola Galeri</a></li>
                        <li><a href="{{ route('admin.umkm.index') }}" class="footer-link">Kelola UMKM</a></li>
                        <li><a href="{{ route('admin.pengurus.index') }}" class="footer-link">Data Pengurus</a></li>
                    </ul>
                </div>

                <div class="md:text-right">
                    <h5 class="footer-heading-modern">Ikuti Kami</h5>
                    <div class="flex md:justify-end gap-5 text-lg">
                        <a href="https://www.instagram.com/officiallumbansilintong?igsh=MXc0aHBjMXFtMmZkdw==" class="text-white/40 hover:text-emerald-400 transition"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                    <div class="mt-6">
                        <span class="inline-block px-3 py-1.5 border border-emerald-500/30 rounded-full text-[8px] text-emerald-400 font-bold uppercase tracking-tighter">
                            Administrator Panel
                        </span>
                    </div>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="mt-10 pt-6 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-3">
                <div class="flex gap-4 text-[8px] text-white/30 tracking-widest uppercase">
                    <a href="#" class="hover:text-white transition">Cookies Policy</a>
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                </div>
                <p class="text-[8px] text-white/20 tracking-[0.3em] uppercase">
                    Â© <span x-text="tahun"></span> DESA LUMBAN SILINTONG
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
        <div id="confirm-backdrop" class="absolute inset-0 bg-slate-950/55 backdrop-blur-md opacity-0 transition-opacity duration-200"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 sm:p-8">
            <div id="confirm-panel" class="w-full max-w-md opacity-0 scale-[0.98] translate-y-2 transition-all duration-200">
                <div class="relative overflow-hidden rounded-[28px] border border-white/30 bg-white/85 shadow-[0_30px_80px_-20px_rgba(2,6,23,0.5)]">
                    <div class="absolute -top-24 -right-24 h-56 w-56 rounded-full bg-emerald-400/20 blur-3xl"></div>
                    <div class="absolute -bottom-24 -left-24 h-56 w-56 rounded-full bg-indigo-400/20 blur-3xl"></div>

                    <div class="relative p-7 sm:p-8">
                        <div class="flex items-start gap-4">
                            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-rose-600 to-orange-500 text-white shadow-lg shadow-rose-500/20 flex items-center justify-center">
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

