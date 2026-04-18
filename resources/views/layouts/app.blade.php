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

<body x-data="{ scrolled: false, slide: 0, totalSlides: 6, faq: null, tahun: new Date().getFullYear() }" 
      @scroll.window="scrolled = (window.pageYOffset > 50)" 
      x-init="setInterval(() => slide = (slide + 1) % totalSlides, 7000)">

    @include('layouts.navigation_desa')
    @include('layouts.navigation_magic_sidebar')

    <div class="main-container">
        @yield('content')
    </div>

    {{-- ============================================= --}}
    {{-- FOOTER - GAMBAR CERAH, TEKS BESAR PUTIH/HIJAU --}}
    {{-- ============================================= --}}
    <footer class="footer-cerah text-white pt-16 pb-10 px-[6%]">
        <div class="max-w-7xl mx-auto relative z-10">
            <div class="flex flex-col md:flex-row justify-between gap-10 mb-10">
                
                {{-- Left Section - Silintong --}}
                <div class="md:w-2/5">
                    <h1 class="text-6xl md:text-7xl font-serif italic text-emerald-400 tracking-wide mb-3 leading-tight">Silintong</h1>
                    <p class="text-white/60 text-base italic mt-2 leading-relaxed max-w-sm">
                        Pusat Digitalisasi Peradaban Desa<br>Pesisir Danau Toba.
                    </p>
                </div>

                {{-- Middle Section - Navigasi & Layanan --}}
                <div class="md:w-2/5">
                    <div class="grid grid-cols-2 gap-10">
                        <div>
                            <h5 class="footer-heading">NAVIGASI</h5>
                            <ul class="space-y-3">
                                <li><a href="{{ route('home') }}" class="footer-link-cerah">Beranda</a></li>
                                <li><a href="{{ route('profil-desa') }}" class="footer-link-cerah">Profil Desa</a></li>
                                <li><a href="{{ route('berita') }}" class="footer-link-cerah">Berita</a></li>
                                <li><a href="{{ route('galeri') }}" class="footer-link-cerah">Galeri</a></li>
                                <li><a href="{{ route('umkm') }}" class="footer-link-cerah">UMKM</a></li>
                                <li><a href="{{ route('kontak') }}" class="footer-link-cerah">Kontak</a></li>
                            </ul>
                        </div>
                        <div>
                            <h5 class="footer-heading">LAYANAN</h5>
                            <ul class="space-y-3">
                                <li><a href="{{ route('masyarakat.surat.create') }}" class="footer-link-cerah">Layanan Surat</a></li>
                                <li><a href="{{ route('masyarakat.aspirasi.create') }}" class="footer-link-cerah">Aspirasi & Pengaduan</a></li>
                                <li><a href="#" class="footer-link-cerah">UMKM Lokal</a></li>
                                <li><a href="#" class="footer-link-cerah">Galeri Desa</a></li>
                                <li><a href="#" class="footer-link-cerah">Informasi Publik</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Right Section - Lokasi --}}
                <div class="md:w-1/5">
                    <h5 class="footer-heading">KANTOR</h5>
                    <p class="text-white/60 text-sm leading-relaxed">
                        Kabupaten Toba,<br>
                        Sumatera Utara,<br>
                        Indonesia.
                    </p>
                </div>
            </div>

            {{-- Bottom Tagline --}}
            <div class="border-t border-white/15 pt-8 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-white/40 text-sm italic tracking-wide">
                    Mewujudkan masa depan desa digital yang harmonis dengan keindahan alam Toba.
                </p>
                <p class="text-white/25 text-[10px] tracking-wider">
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
