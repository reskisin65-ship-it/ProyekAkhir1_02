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

        /* Sidebar Styles */
        .magic-sidebar {
            position: fixed; left: 30px; top: 50%; transform: translateY(-50%);
            width: 80px; background: linear-gradient(135deg, #064e3b, #022c22);
            backdrop-filter: blur(20px); border-radius: 45px; z-index: 1100; 
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 18px;
            padding: 25px 0;
            box-shadow: 0 25px 50px rgba(6, 78, 59, 0.3); border: 1px solid rgba(255,255,255,0.12);
        }
        .side-item {
            position: relative; width: 52px; height: 52px; display: flex;
            align-items: center; justify-content: center; border-radius: 24px;
            color: rgba(255,255,255,0.45); font-size: 22px; transition: 0.3s;
            cursor: pointer;
        }
        .side-item:hover, .side-item.active { color: #fff; background: rgba(255,255,255,0.12); transform: translateY(-3px); }
        .side-item.active { color: #10b981; background: #fff; box-shadow: 0 8px 20px rgba(0,0,0,0.1); }

        .main-container { margin-left: 140px; padding-top: 120px; transition: 0.3s; min-height: 80vh; }

        @media (max-width: 1024px) {
            .magic-sidebar { display: none; }
            .main-container { margin-left: 0 !important; padding-top: 110px !important; }
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
            padding: 50px 6% 30px 6%;
            margin-top: 60px;
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

<body x-data="{ scrolled: false, tahun: new Date().getFullYear() }" 
      @scroll.window="scrolled = (window.pageYOffset > 50)">

    @include('layouts.navigation_desa')
    @include('layouts.navigation_magic_sidebar')

    <div class="main-container">
        @yield('content')
    </div>

    {{-- FOOTER MODERN - UNTUK ADMIN --}}
    <footer class="footer-modern">
        <div class="max-w-7xl mx-auto relative z-10">
            
            {{-- Header Logo & CTA Admin --}}
            <div class="footer-logo-center" data-aos="fade-up">
                <div class="abstract-star"></div>
                <h2 class="text-4xl md:text-5xl font-serif italic text-white mb-2">Admin Panel</h2>
                <p class="text-emerald-400/80 tracking-widest text-[10px] uppercase font-bold mb-6">Kelola Data & Informasi Desa</p>
                
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
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 border-t border-white/10 pt-10">
                
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
                        <li><a href="{{ route('admin.statistik') }}" class="footer-link">Statistik</a></li>
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
                        <a href="#" class="text-white/40 hover:text-emerald-400 transition"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-white/40 hover:text-emerald-400 transition"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="text-white/40 hover:text-emerald-400 transition"><i class="fa-brands fa-youtube"></i></a>
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
                    © <span x-text="tahun"></span> DESA LUMBAN SILINTONG
                </p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1000, once: true, easing: 'ease-out-cubic' });
    </script>
    @stack('scripts')
</body>
</html>