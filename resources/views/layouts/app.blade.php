<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desa Lumban Silintong | Digital Botanic Platform</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root { --emerald-pro: #064e3b; --emerald-bright: #10b981; }
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: var(--emerald-pro); overflow-x: hidden; }
        .font-serif { font-family: 'Playfair Display', serif; }

        /* --- 1. NAVBAR FULL SCREEN GOOEY --- */
        .nav-top-full {
            position: fixed; top: 0; left: 0; width: 100%; height: 150px;
            background: rgba(255, 255, 255, 0.15); backdrop-filter: blur(50px) saturate(180%);
            border-bottom: 2px solid rgba(255, 255, 255, 0.2); z-index: 900;
            display: flex; align-items: center; padding: 0 4%;
        }
        .nav-link-gooey {
            position: relative; font-size: 1.6rem; font-weight: 800; color: #000 !important;
            padding: 15px 30px; transition: 0.5s; z-index: 1; text-transform: uppercase; letter-spacing: 0.1em;
        }
        .gooey-bg {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: #10b981; border-radius: 20px;
            transform: scale(0); transition: 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55);
            z-index: -1; filter: url('#goo');
        }
        .nav-link-gooey:hover .gooey-bg { transform: scale(1.15); }
        .nav-link-gooey:hover { color: #fff !important; }

        /* --- 2. MAGIC SIDEBAR (TIKTOK STYLE LENGKAP) --- */
        .magic-sidebar {
            position: fixed; left: 30px; top: 50%; transform: translateY(-50%);
            width: 110px; height: 85vh; background: #064e3b;
            border-radius: 55px; z-index: 1100;
            display: flex; flex-direction: column; align-items: center;
            justify-content: space-around; padding: 30px 0;
            box-shadow: 0 40px 100px rgba(0,0,0,0.3);
        }
        .side-item-magic {
            position: relative; width: 75px; height: 75px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 50%; color: rgba(255,255,255,0.4); font-size: 30px; transition: 0.5s;
        }
        .side-item-magic:hover { color: #fff; transform: scale(1.2); }
        .side-tooltip {
            position: absolute; left: 130px; background: white;
            padding: 25px 35px; border-radius: 30px; box-shadow: 30px 30px 60px rgba(0,0,0,0.2);
            opacity: 0; visibility: hidden; transform: translateX(-30px);
            transition: 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            min-width: 320px; color: #064e3b; z-index: 1200;
        }
        .side-item-magic:hover .side-tooltip { opacity: 1; visibility: visible; transform: translateX(0); }

        /* --- 3. LIQUID FILL EFFECT (GLOBAL) --- */
        .liquid-fill {
            position: relative; overflow: hidden; border: 3px solid #10b981;
            color: #10b981; transition: 0.5s; z-index: 1;
        }
        .liquid-fill span { position: relative; z-index: 2; }
        .liquid-fill::before {
            content: ''; position: absolute; top: 100%; left: 0;
            width: 100%; height: 100%; background: #10b981;
            transition: 0.6s cubic-bezier(0.4, 0, 0.2, 1); z-index: -1;
            border-radius: 50% 50% 0 0; transform: scaleX(1.5);
        }
        .liquid-fill:hover::before { top: 0; border-radius: 0; }
        .liquid-fill:hover { color: #fff !important; transform: translateY(-5px); }

        /* --- 4. SLIDER PERSPECTIVE --- */
        .slider-wrapper { width: 100%; height: 100vh; overflow: hidden; position: relative; background: #000; }
        .slider-wrapper .item {
            width: 350px; height: 500px; position: absolute; top: 65%;
            transform: translateY(-50%); border-radius: 40px;
            background-position: center; background-size: cover;
            transition: 1.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 40px 60px rgba(0,0,0,0.6); z-index: 10;
        }
        .slider-wrapper .item:nth-child(1), .slider-wrapper .item:nth-child(2) {
            top: 0; left: 0; transform: translateY(0); border-radius: 0; width: 100%; height: 100%;
        }
        .slider-wrapper .item:nth-child(3) { left: 55%; }
        .slider-wrapper .item:nth-child(4) { left: calc(55% + 400px); }
        .slider-wrapper .item:nth-child(5) { left: calc(55% + 800px); }
        .slider-wrapper .item:nth-child(6) { left: calc(55% + 1200px); opacity: 0; }

        .slide-content { position: absolute; top: 40%; left: 10%; width: 1000px; color: white; display: none; }
        .item:nth-child(2) .slide-content { display: block; }
        .slide-content .name { font-size: 13rem; font-family: 'Playfair Display'; font-style: italic; font-weight: 800; line-height: 0.8; animation: slideUp 1.2s forwards; }
        .slide-content .des { font-size: 3rem; margin-top: 40px; opacity: 0; animation: slideUp 1.2s 0.2s forwards; }

        @keyframes slideUp { from { opacity: 0; transform: translateY(80px); } to { opacity: 1; transform: translateY(0); } }

        /* --- 5. MODUL LAYANAN GLASS ZOOM --- */
        .glass-module { position: relative; border-radius: 5rem; overflow: hidden; border: 4px solid rgba(255, 255, 255, 0.6); height: 700px; background: rgba(255, 255, 255, 0.1); }
        .blur-screen { position: absolute; inset: 0; backdrop-filter: blur(40px); z-index: 10; transition: 1.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .glass-module:hover .blur-screen { backdrop-filter: blur(0px); background: rgba(0,0,0,0.3); }
        .glass-module:hover img { transform: scale(1.1); transition: 1.5s ease; }

        .main-container { margin-left: 140px; }
        .section-gap { margin-top: 180px; }
        
        /* --- 6. FOOTER STYLING --- */
        .footer-lake {
            position: relative; width: 100%; min-height: 750px;
            display: flex; align-items: end; overflow: hidden; margin-top: 200px;
        }
        .footer-link:hover { color: var(--emerald-bright); transform: scale(1.05); transition: 0.3s; }
    </style>
</head>
<body class="antialiased overflow-x-hidden">

    <!-- GOOEY SVG FILTER -->
    <svg xmlns="http://www.w3.org/2000/svg" class="hidden">
        <defs>
            <filter id="goo">
                <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                <feBlend in="SourceGraphic" in2="goo" />
            </filter>
        </defs>
    </svg>

    @include('layouts.navigation_desa')

    <div class="main-container">
        {{ $slot }}
    </div>

    <!-- FOOTER: HIGH-DEFINITION LAKE GLASS VIEW -->
    <footer class="footer-lake bg-emerald-950">
        <!-- Gambar Baru: Jernih, Estetik, HD -->
        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1920&q=100" class="absolute inset-0 w-full h-full object-cover">
        <!-- Overlay Kaca Emerald Gradasi -->
        <div class="absolute inset-0 bg-gradient-to-t from-[#064e3b] via-[#064e3b]/80 to-transparent backdrop-blur-xl"></div>
        
        <div class="relative z-20 w-full px-[10%] pb-24 text-white">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-32 items-start mb-24">
                <div class="lg:col-span-7">
                    <h2 class="text-[12rem] font-serif italic text-emerald-300 leading-none mb-10 opacity-70">Silintong.</h2>
                    <p class="text-5xl font-light italic leading-relaxed opacity-90 max-w-4xl">Pusat Digitalisasi Peradaban Desa Pesisir Danau Toba.</p>
                </div>
                <div class="lg:col-span-5 grid grid-cols-2 gap-10">
                    <div>
                        <h5 class="text-2xl font-black uppercase tracking-[0.5em] text-emerald-400 mb-12">Navigasi</h5>
                        <ul class="space-y-6 text-4xl font-bold italic opacity-70">
                            <li><a href="#" class="footer-link">Layanan Surat</a></li>
                            <li><a href="#" class="footer-link">UMKM Lokal</a></li>
                            <li><a href="#" class="footer-link">Galeri Desa</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-2xl font-black uppercase tracking-[0.5em] text-emerald-400 mb-12">Lokasi</h5>
                        <p class="text-4xl italic font-medium leading-relaxed opacity-80 uppercase tracking-tighter">Kabupaten Toba, <br>Sumatera Utara, Indonesia.</p>
                    </div>
                </div>
            </div>
            <div class="pt-12 border-t border-white/20 flex justify-between items-center text-xl font-black uppercase tracking-[1em] opacity-40">
                <p>© 2026 DESA LUMBAN SILINTONG</p>
                <p>ULTRA DIGITAL HUB</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>AOS.init({ duration: 1500 });</script>
</body>
</html>