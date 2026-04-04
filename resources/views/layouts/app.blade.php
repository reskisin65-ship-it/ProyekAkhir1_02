<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Desa Lumban Silintong | Digital Botanic Village</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&family=Playfair+Display:ital,wght@0,700;1,700&display=swap" rel="stylesheet">

    <!-- Tailwind & Libraries -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; color: #064e3b; }
        .font-serif { font-family: 'Playfair Display', serif; }

        /* MEGA PILL NAVBAR (BULAT & MELAYANG) */
        .mega-nav-pill {
            position: fixed;
            top: 30px;
            left: 50%;
            transform: translateX(-50%);
            width: 92%;
            max-width: 1400px;
            height: 120px; 
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(40px) saturate(180%);
            -webkit-backdrop-filter: blur(40px);
            border: 2px solid rgba(255, 255, 255, 0.5);
            border-radius: 60px;
            z-index: 1000;
            display: flex;
            align-items: center;
            padding: 0 60px;
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.2);
        }

        .nav-link-pill {
            font-size: 1.3rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: rgba(6, 78, 59, 0.5);
            transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        }
        .nav-link-pill:hover {
            color: #064e3b;
            transform: scale(1.15);
        }

        /* CINEMATIC SLIDER SETTINGS */
        .slider-wrapper { width: 100%; height: 100vh; overflow: hidden; position: relative; background: #000; }
        .slider-wrapper .item {
            width: 350px; 
            height: 500px;
            position: absolute;
            top: 65%;
            transform: translateY(-50%);
            border-radius: 50px;
            background-position: center;
            background-size: cover;
            transition: 1.5s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 40px 60px rgba(0,0,0,0.4);
            z-index: 10;
            cursor: pointer;
        }
        .slider-wrapper .item:nth-child(1),
        .slider-wrapper .item:nth-child(2) {
            top: 0; left: 0; transform: translateY(0);
            border-radius: 0; width: 100%; height: 100%;
        }
        .slider-wrapper .item:nth-child(3) { left: 55%; }
        .slider-wrapper .item:nth-child(4) { left: calc(55% + 400px); }
        .slider-wrapper .item:nth-child(5) { left: calc(55% + 800px); }
        .slider-wrapper .item:nth-child(6) { left: calc(55% + 1200px); opacity: 0; }

        .item .slide-content {
            position: absolute;
            top: 45%; left: 8%;
            width: 1000px;
            color: white;
            transform: translateY(-50%);
            display: none;
        }
        .item:nth-child(2) .slide-content { display: block; }
        
        .slide-content .name { font-size: 11rem; font-family: 'Playfair Display'; font-style: italic; font-weight: 700; opacity: 0; animation: fadeUp 1.5s forwards 0.3s; line-height: 0.8; }
        .slide-content .des { font-size: 2.5rem; margin-top: 40px; opacity: 0; animation: fadeUp 1.5s forwards 0.5s; font-weight: 300; }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(100px); filter: blur(20px); }
            to { opacity: 1; transform: translateY(0); filter: blur(0); }
        }

        /* Glass Module Hover HD Effect */
        .glass-module {
            position: relative;
            border-radius: 5rem;
            overflow: hidden;
            border: 3px solid rgba(255, 255, 255, 0.6);
            height: 650px;
            background: rgba(255, 255, 255, 0.1);
        }
        .blur-screen {
            position: absolute;
            inset: 0;
            backdrop-filter: blur(40px);
            z-index: 10;
            transition: 1.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-module:hover .blur-screen { backdrop-filter: blur(0px); background: rgba(0,0,0,0.3); }

        .section-gap { margin-top: 150px; }
    </style>
</head>
<body class="antialiased">

    @include('layouts.navigation_desa')

    <main class="pt-[40px]">
        {{ $slot }}
    </main>

    <!-- FOOTER: THE ICONIC LAKE GLASS VIEW -->
    <footer class="relative w-full min-h-[700px] mt-40 flex items-end overflow-hidden bg-emerald-950">
        <!-- Background Pemandangan Danau -->
        <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1920" class="absolute inset-0 w-full h-full object-cover opacity-60">
        <!-- Layer Kaca Tebal -->
        <div class="absolute inset-0 bg-gradient-to-t from-emerald-950 via-emerald-950/70 to-transparent backdrop-blur-xl"></div>
        
        <div class="relative z-20 w-full px-[10%] pb-24 text-white">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-32 items-start mb-24">
                <div class="lg:col-span-7">
                    <h2 class="text-[11rem] font-serif italic text-emerald-300 leading-none mb-12 opacity-80">Silintong.</h2>
                    <p class="text-4xl font-light leading-relaxed max-w-4xl italic opacity-90">Mewujudkan masa depan desa digital yang harmonis dengan keindahan alam Toba.</p>
                </div>
                <div class="lg:col-span-5 grid grid-cols-2 gap-10">
                    <div>
                        <h5 class="text-xl font-black uppercase tracking-[0.5em] text-emerald-400 mb-10">Navigasi</h5>
                        <ul class="space-y-6 text-3xl font-bold italic opacity-60">
                            <li><a href="#" class="hover:text-emerald-300 transition">Layanan</a></li>
                            <li><a href="#" class="hover:text-emerald-300 transition">UMKM</a></li>
                            <li><a href="#" class="hover:text-emerald-300 transition">Berita</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5 class="text-xl font-black uppercase tracking-[0.5em] text-emerald-400 mb-10">Kantor</h5>
                        <p class="text-3xl leading-relaxed opacity-70">Kabupaten Toba, <br>Sumatera Utara, <br>Indonesia.</p>
                    </div>
                </div>
            </div>
            <div class="pt-12 border-t border-white/20 flex justify-between items-center text-sm font-black uppercase tracking-[0.8em] opacity-40">
                <p>© 2026 DESA LUMBAN SILINTONG</p>
                <p>ULTRA AESTHETIC PORTAL</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>AOS.init({ duration: 1500 });</script>
</body>
</html>