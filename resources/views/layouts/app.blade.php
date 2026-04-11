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
            overflow-x: hidden;
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

        /* Sidebar Desktop */
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
        .info-box {
            position: absolute; left: 80px; background: white; padding: 16px 24px;
            border-radius: 28px; box-shadow: 0 20px 40px rgba(0,0,0,0.12);
            opacity: 0; visibility: hidden; transform: translateX(-15px); transition: 0.3s;
            min-width: 260px; border: 1px solid rgba(0,0,0,0.04);
            z-index: 1200;
        }
        .side-item:hover .info-box { opacity: 1; visibility: visible; transform: translateX(0); }

        /* Mobile Bottom Nav */
        .mobile-nav {
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            width: 90%; height: 70px; background: #064e3b;
            border-radius: 35px; z-index: 1100; display: none;
            align-items: center; justify-content: space-around; padding: 0 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }
        @media (max-width: 1024px) {
            .magic-sidebar { display: none; }
            .mobile-nav { display: flex; }
            .main-container { margin-left: 0 !important; padding-top: 110px !important; }
        }
        .main-container { margin-left: 140px; padding-top: 120px; transition: 0.3s; }

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
        .glass-footer {
            background: linear-gradient(rgba(6, 78, 59, 0.96), rgba(0, 0, 0, 0.98)), 
                        url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=2070');
            background-size: cover; background-attachment: fixed;
            border-radius: 60px 60px 0 0;
            margin-top: 60px;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>

<body x-data="{ scrolled: false, slide: 0, totalSlides: 6, faq: null, tahun: new Date().getFullYear() }" 
      @scroll.window="scrolled = (window.pageYOffset > 50)" 
      x-init="setInterval(() => slide = (slide + 1) % totalSlides, 7000)">

    @include('layouts.navigation_desa')
    @include('layouts.navigation_magic_sidebar')

    <div class="main-container">
        @yield('content')
    </div>

    {{-- ============================================= --}}
    {{-- FOOTER - TAMPIL DI SEMUA HALAMAN --}}
    {{-- ============================================= --}}
    <footer class="glass-footer text-white pt-20 pb-8 px-[8%]">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-10 relative z-10 mb-12">
                
                {{-- Kolom 1: Brand --}}
                <div class="md:col-span-5">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-12 h-12 bg-white/10 rounded-2xl flex items-center justify-center backdrop-blur border border-white/20">
                            <span class="text-2xl font-black text-white">LS</span>
                        </div>
                        <span class="text-2xl font-serif italic text-white">Lumban Silintong</span>
                    </div>
                    <p class="text-base font-light text-emerald-100/50 italic max-w-sm mb-6 leading-relaxed">
                        "Mewujudkan kemandirian desa melalui tata kelola cerdas dan digitalisasi yang inklusif."
                    </p>
                    <div class="flex gap-3">
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gradient-to-r hover:from-emerald-500 hover:to-emerald-600 transition-all duration-300 group">
                            <i class="fa-brands fa-instagram text-sm text-white/60 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gradient-to-r hover:from-emerald-500 hover:to-emerald-600 transition-all duration-300 group">
                            <i class="fa-brands fa-facebook-f text-sm text-white/60 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gradient-to-r hover:from-emerald-500 hover:to-emerald-600 transition-all duration-300 group">
                            <i class="fa-brands fa-youtube text-sm text-white/60 group-hover:text-white"></i>
                        </a>
                        <a href="#" class="w-10 h-10 rounded-xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-gradient-to-r hover:from-emerald-500 hover:to-emerald-600 transition-all duration-300 group">
                            <i class="fa-brands fa-whatsapp text-sm text-white/60 group-hover:text-white"></i>
                        </a>
                    </div>
                </div>

                {{-- Kolom 2: Navigasi Cepat --}}
                <div class="md:col-span-3">
                    <h5 class="text-[10px] font-black uppercase tracking-[0.4em] text-emerald-400 mb-5">Navigasi</h5>
                    <ul class="space-y-3 text-emerald-100/40 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-emerald-400"></i> Beranda</a></li>
                        <li><a href="{{ route('profil-desa') }}" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-emerald-400"></i> Profil Desa</a></li>
                        <li><a href="{{ route('berita') }}" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-emerald-400"></i> Berita & Acara</a></li>
                        <li><a href="{{ route('umkm') }}" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-emerald-400"></i> Katalog UMKM</a></li>
                        <li><a href="#layanan-publik" class="hover:text-white transition flex items-center gap-2"><i class="fa-solid fa-chevron-right text-[8px] text-emerald-400"></i> Portal Mandiri</a></li>
                    </ul>
                </div>

                {{-- Kolom 3: Kontak & Informasi --}}
                <div class="md:col-span-4">
                    <h5 class="text-[10px] font-black uppercase tracking-[0.4em] text-emerald-400 mb-5">Hubungi Kami</h5>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-location-dot text-emerald-400 text-sm"></i>
                            </div>
                            <p class="text-sm text-emerald-100/40 leading-relaxed">Kec. Balige, Kab. Toba, Sumatera Utara, 22312</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0">
                                <i class="fa-regular fa-envelope text-emerald-400 text-sm"></i>
                            </div>
                            <p class="text-sm text-emerald-100/40">halo@lumbansilintong.id</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-xl bg-white/5 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-phone text-emerald-400 text-sm"></i>
                            </div>
                            <p class="text-sm text-emerald-100/40">+62 822 1234 5678</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Copyright --}}
            <div class="pt-8 border-t border-white/10 text-center">
                <p class="text-[9px] font-black uppercase tracking-[0.5em] text-emerald-100/20">
                    © <span x-text="tahun"></span> Lumban Silintong - Digital Excellence for Rural Innovation
                </p>
                <p class="text-[8px] text-emerald-100/10 mt-3 tracking-wider">
                    Dikembangkan oleh Tim Proyek Akhir IT DEL
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