<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Lumban Silintong | Ultimate Digital Portal</title>

    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --emerald-950: #064e3b;
            --emerald-500: #10b981;
            --emerald-50: #ecfdf5;
            --amber-500: #f59e0b;
            --blue-500: #3b82f6;
            --glass: rgba(255, 255, 255, 0.8);
        }

        body { 
            font-family: 'Plus Jakarta Sans', sans-serif; 
            background: #ffffff; 
            color: var(--emerald-950); 
            overflow-x: hidden; 
        }
        .font-serif { font-family: 'Playfair Display', serif; }

        /* --- 1. NAVIGATION & SIDEBAR (DESKTOP & MOBILE) --- */
        .nav-top {
            position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
            width: 90%; max-width: 1400px; height: 85px;
            background: var(--glass); backdrop-filter: blur(25px);
            border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 35px;
            z-index: 1000; display: flex; align-items: center; padding: 0 40px;
            transition: 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .nav-scrolled { top: 10px; width: 95%; height: 75px; background: rgba(255, 255, 255, 0.98); box-shadow: 0 20px 50px rgba(0,0,0,0.08); }

        /* Sidebar Desktop */
        .magic-sidebar {
            position: fixed; left: 40px; top: 50%; transform: translateY(-50%);
            width: 85px; height: 75vh; background: linear-gradient(135deg, var(--emerald-950), #022c22);
            backdrop-filter: blur(20px); border-radius: 40px; z-index: 1100; 
            display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 20px;
            box-shadow: 0 30px 60px rgba(6, 78, 59, 0.25); border: 1px solid rgba(255,255,255,0.1);
        }

        /* Sidebar Mobile (Bottom Nav) */
        .mobile-nav {
            position: fixed; bottom: 20px; left: 50%; transform: translateX(-50%);
            width: 90%; height: 70px; background: var(--emerald-950);
            border-radius: 25px; z-index: 1100; display: none;
            align-items: center; justify-content: space-around; padding: 0 20px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        @media (max-width: 1024px) {
            .magic-sidebar { display: none; }
            .mobile-nav { display: flex; }
            .main-container { margin-left: 0 !important; padding-top: 120px !important; }
        }

        .side-item {
            position: relative; width: 55px; height: 55px; display: flex;
            align-items: center; justify-content: center; border-radius: 20px;
            color: rgba(255,255,255,0.4); font-size: 20px; transition: 0.4s;
        }
        .side-item:hover, .side-item.active { color: #fff; background: rgba(255,255,255,0.15); transform: translateY(-3px); }
        .side-item.active { color: var(--emerald-500); background: #fff; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }

        .info-box {
            position: absolute; left: 100px; background: white; padding: 25px;
            border-radius: 30px; box-shadow: 25px 25px 60px rgba(0,0,0,0.15);
            opacity: 0; visibility: hidden; transform: translateX(-20px); transition: 0.4s;
            min-width: 320px; border: 1px solid rgba(0,0,0,0.05); color: var(--emerald-950);
        }
        .side-item:hover .info-box { opacity: 1; visibility: visible; transform: translateX(0); }

        /* --- 2. HERO SLIDER --- */
        .slider-container { border-radius: 60px; overflow: hidden; position: relative; box-shadow: 0 40px 100px rgba(0,0,0,0.1); }
        .slider-wrapper { display: flex; transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1); }
        .slide { min-width: 100%; height: 85vh; position: relative; }
        .slide-content { 
            position: absolute; inset: 0; 
            background: linear-gradient(to right, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.2) 60%, transparent 100%);
            display: flex; flex-direction: column; justify-content: center; padding-left: 10%; color: white;
        }

        /* --- 3. CRUD EMPTY STATES --- */
        .empty-state {
            border: 3px dashed #f1f5f9; border-radius: 50px; padding: 80px 40px;
            text-align: center; color: #cbd5e1; transition: 0.4s;
            background: #fcfcfc;
        }
        .empty-state:hover { border-color: var(--emerald-500); background: #fff; }

        /* --- 4. GLASS CARDS & STATS --- */
        .stat-card {
            background: white; border-radius: 45px; padding: 45px; transition: 0.5s;
            border: 1px solid #f8fafc; position: relative; overflow: hidden;
        }
        .stat-card::before {
            content: ''; position: absolute; top: -50%; left: -50%; width: 200%; height: 200%;
            background: radial-gradient(circle, rgba(16,185,129,0.05) 0%, transparent 70%);
            opacity: 0; transition: 0.5s;
        }
        .stat-card:hover::before { opacity: 1; }
        .stat-card:hover { transform: translateY(-15px); box-shadow: 0 40px 80px rgba(6, 78, 59, 0.08); }

        .service-locked {
            position: relative; border-radius: 45px; background: white; border: 1px solid #f1f5f9;
            padding: 40px; transition: 0.5s; overflow: hidden;
        }
        .lock-overlay {
            position: absolute; inset: 0; background: rgba(255,255,255,0.1);
            backdrop-filter: blur(10px); display: flex; align-items: center; justify-content: center;
            opacity: 0; transition: 0.4s; z-index: 10;
        }
        .service-locked:hover .lock-overlay { opacity: 1; }

        /* --- 5. FOOTER (COMPACT & PRO) --- */
        .glass-footer {
            background: linear-gradient(rgba(6, 78, 59, 0.95), rgba(0, 0, 0, 0.98)), 
                        url('https://images.unsplash.com/photo-1501785888041-af3ef285b470?auto=format&fit=crop&q=80&w=2070');
            background-size: cover; background-attachment: fixed;
            border-radius: 80px 80px 0 0; position: relative;
        }

        /* --- LAYOUT --- */
        .main-container { margin-left: 160px; padding-top: 140px; transition: 0.5s; }
        .btn-premium {
            background: linear-gradient(135deg, var(--emerald-950), #065f46);
            color: #fff; padding: 18px 38px; border-radius: 22px;
            font-weight: 800; font-size: 11px; text-transform: uppercase;
            letter-spacing: 2px; transition: 0.4s; display: inline-block;
            box-shadow: 0 15px 35px rgba(6, 78, 59, 0.2);
        }
        .btn-premium:hover { transform: translateY(-4px) scale(1.02); background: var(--emerald-500); box-shadow: 0 20px 40px rgba(16, 185, 129, 0.3); }

        .no-scrollbar::-webkit-scrollbar { display: none; }
    </style>
</head>

<body x-data="{ 
    scrolled: false, 
    activeTab: 'home', 
    slide: 0, 
    totalSlides: 6,
    faq: null 
}" @scroll.window="scrolled = (window.pageYOffset > 50)" x-init="setInterval(() => slide = (slide + 1) % totalSlides, 8000)">

    {{-- ============================================= --}}
    {{-- 1. NAVBAR DESA (INCLUDE) --}}
    {{-- ============================================= --}}
    @include('layouts.navigation_desa')

    {{-- ============================================= --}}
    {{-- 2. MAGIC SIDEBAR + MOBILE NAV (INCLUDE) --}}
    {{-- ============================================= --}}
    @include('layouts.navigation_magic_sidebar')

    {{-- ============================================= --}}
    {{-- MAIN CONTENT (LENGKAP, SEMUA KONTEN UTUH) --}}
    {{-- ============================================= --}}
    <div class="main-container">

        {{-- HERO SLIDER --}}
        <section class="px-[5%] mb-32">
            <div class="slider-container group">
                <div class="slider-wrapper" :style="'transform: translateX(-' + (slide * 100) + '%)'">
                    @php
                        $hero = [
                            ['t' => 'Peradaban Digital Lumban Silintong', 'd' => 'Menyatukan teknologi dengan kearifan lokal Toba.', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb'],
                            ['t' => 'UMKM Naik Kelas Menuju Global', 'd' => 'Mendorong ekonomi kreatif warga semakin kompetitif.', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b'],
                            ['t' => 'Harmonisasi Alam Danau Toba', 'd' => 'Menjaga kelestarian pesisir untuk generasi masa depan.', 'img' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077'],
                            ['t' => 'Pelayanan Publik Satu Genggaman', 'd' => 'Akses administrasi kini lebih cepat dan transparan.', 'img' => 'https://images.unsplash.com/photo-1472214103451-9374bd1c798e'],
                            ['t' => 'Budaya Batak Yang Mendunia', 'd' => 'Melestarikan adat istiadat di tengah modernisasi.', 'img' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470'],
                            ['t' => 'Lumban Silintong Excellence', 'd' => 'Bersama membangun desa cerdas (Smart Village).', 'img' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e'],
                        ];
                    @endphp
                    @foreach($hero as $h)
                    <div class="slide">
                        <img src="{{ $h['img'] }}?auto=format&fit=crop&q=80&w=2070" class="absolute inset-0 w-full h-full object-cover brightness-[0.7]">
                        <div class="slide-content">
                            <h2 class="text-7xl font-serif italic mb-6 leading-tight" data-aos="fade-up">{{ $h['t'] }}</h2>
                            <p class="text-2xl font-light italic opacity-90 max-w-2xl" data-aos="fade-up" data-aos-delay="200">{{ $h['d'] }}</p>
                            <div class="mt-12" data-aos="fade-up" data-aos-delay="400">
                                <a href="#layanan" class="btn-premium">E-Service Desa</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="absolute bottom-10 right-20 flex gap-3">
                    @foreach($hero as $index => $h)
                        <div @click="slide = {{ $index }}" class="w-12 h-1.5 rounded-full cursor-pointer transition-all duration-500" :class="slide === {{ $index }} ? 'bg-emerald-500 w-20' : 'bg-white/30 hover:bg-white/60'"></div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- PROFIL DESA --}}
        <section id="profil" class="py-32 px-[5%] bg-stone-50 rounded-[80px]">
            <div class="grid lg:grid-cols-2 gap-24 items-center">
                @if(isset($profil) && $profil)
                    <div class="grid grid-cols-2 gap-8" data-aos="zoom-in-right">
                        <div class="space-y-8">
                            <img src="{{ $profil->foto1 }}" class="rounded-[50px] h-96 w-full object-cover shadow-2xl">
                            <div class="bg-emerald-950 p-10 rounded-[50px] text-white">
                                <h4 class="text-4xl font-serif italic mb-4">Visi</h4>
                                <p class="text-sm opacity-60 leading-relaxed italic">"{{ $profil->visi }}"</p>
                            </div>
                        </div>
                        <div class="pt-20 space-y-8">
                            <div class="bg-white p-10 rounded-[50px] shadow-sm border border-gray-100">
                                <h4 class="text-4xl font-serif italic text-emerald-950 mb-4">Misi</h4>
                                <ul class="text-xs text-gray-400 space-y-3 italic">
                                    @foreach(explode(',', $profil->misi) as $m)
                                        <li>• {{ $m }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <img src="{{ $profil->foto2 }}" class="rounded-[50px] h-80 w-full object-cover shadow-xl">
                        </div>
                    </div>
                    <div data-aos="fade-left">
                        <span class="text-emerald-500 font-black tracking-[0.4em] text-[10px] uppercase">Sejarah & Filosofi</span>
                        <h2 class="text-6xl font-serif italic mb-10 leading-tight mt-4">Jejak Langkah <br> Tanah Leluhur.</h2>
                        <p class="text-gray-400 leading-loose italic mb-10">{{ $profil->deskripsi }}</p>
                        <div class="grid grid-cols-2 gap-6">
                            <div class="p-8 bg-white rounded-[35px] shadow-sm">
                                <h5 class="font-bold text-emerald-950 mb-2">Adat Toba</h5>
                                <p class="text-[10px] text-gray-400">Menjunjung tinggi falsafah Dalihan Na Tolu.</p>
                            </div>
                            <div class="p-8 bg-white rounded-[35px] shadow-sm">
                                <h5 class="font-bold text-emerald-950 mb-2">Digitalisasi</h5>
                                <p class="text-[10px] text-gray-400">Efisiensi birokrasi melalui sistem cloud desa.</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="lg:col-span-2 empty-state">
                        <i class="fa-solid fa-landmark text-5xl mb-6 opacity-20"></i>
                        <h3 class="text-2xl font-serif italic text-slate-400">Informasi Profil Belum Diinput</h3>
                        <p class="text-sm mt-2 italic">Admin sedang mempersiapkan data visi, misi, dan sejarah desa.</p>
                    </div>
                @endif
            </div>
        </section>

        {{-- BERITA & PENGUMUMAN --}}
        <section id="berita" class="py-32 px-[5%]">
            <div class="grid lg:grid-cols-12 gap-20">
                <div class="lg:col-span-8">
                    <div class="flex justify-between items-end mb-16">
                        <h2 class="text-6xl font-serif italic leading-none">Warta Utama.</h2>
                        <a href="#" class="text-[10px] font-black uppercase text-emerald-500 border-b-2 border-emerald-500 pb-2">Semua Berita</a>
                    </div>
                    @if(isset($beritas) && count($beritas) > 0)
                        <div class="grid md:grid-cols-2 gap-12">
                            @foreach($beritas as $b)
                            <div class="group cursor-pointer">
                                <div class="rounded-[50px] overflow-hidden h-72 mb-8 relative">
                                    <img src="{{ $b->cover }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                                    <div class="absolute top-6 left-6 bg-white/90 px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest text-emerald-900">{{ $b->kategori }}</div>
                                </div>
                                <h4 class="text-3xl font-serif italic text-emerald-950 group-hover:text-emerald-500 transition">{{ $b->judul }}</h4>
                                <p class="text-sm text-gray-400 mt-4 leading-relaxed italic line-clamp-2">{{ $b->ringkasan }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state">
                            <i class="fa-solid fa-newspaper text-5xl mb-6 opacity-20"></i>
                            <h3 class="text-xl italic text-slate-400">Belum Ada Berita Terbaru</h3>
                        </div>
                    @endif
                </div>
                <div class="lg:col-span-4">
                    <h3 class="text-4xl font-serif italic mb-16">Pengumuman</h3>
                    @if(isset($pengumumans) && count($pengumumans) > 0)
                        <div class="space-y-6">
                            @foreach($pengumumans as $p)
                            <div class="p-10 bg-emerald-50/50 rounded-[40px] border border-emerald-100 hover:border-emerald-500 transition group">
                                <span class="text-[10px] font-black text-emerald-600 tracking-widest">{{ $p->tanggal }}</span>
                                <h5 class="text-xl font-bold text-emerald-950 mt-3 italic">{{ $p->judul }}</h5>
                                <div class="w-10 h-1 bg-emerald-200 mt-6 group-hover:w-full transition-all duration-500"></div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-state !py-24">
                            <p class="italic text-sm">Tidak ada pengumuman aktif.</p>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        {{-- STRUKTUR APARATUR --}}
        <section class="py-32 px-[5%] overflow-hidden">
            <div class="text-center mb-24">
                <span class="text-emerald-500 font-black tracking-[0.5em] text-[10px] uppercase">Pelayan Masyarakat</span>
                <h2 class="text-6xl font-serif italic mt-4">Struktur Aparatur</h2>
            </div>
            <div class="flex gap-10 overflow-x-auto pb-12 snap-x no-scrollbar">
                @if(isset($aparaturs) && count($aparaturs) > 0)
                    @foreach($aparaturs as $a)
                    <div class="snap-center shrink-0 w-80 group">
                        <div class="rounded-[55px] overflow-hidden h-[480px] mb-8 grayscale group-hover:grayscale-0 transition duration-700 shadow-2xl relative">
                            <img src="{{ $a->foto }}" class="w-full h-full object-cover">
                            <div class="absolute inset-x-0 bottom-0 p-8 bg-gradient-to-t from-emerald-950 to-transparent text-white opacity-0 group-hover:opacity-100 transition duration-500">
                                <p class="text-xs italic opacity-70">"Melayani dengan integritas dan digitalisasi."</p>
                            </div>
                        </div>
                        <h5 class="text-3xl font-serif italic text-emerald-950">{{ $a->nama }}</h5>
                        <p class="text-[10px] font-black uppercase text-emerald-500 tracking-widest mt-2">{{ $a->jabatan }}</p>
                    </div>
                    @endforeach
                @else
                    @for($i=1; $i<=6; $i++)
                    <div class="snap-center shrink-0 w-80 opacity-20">
                        <div class="rounded-[55px] bg-slate-100 h-[480px] mb-8 flex items-center justify-center text-4xl"><i class="fa-solid fa-user-tie"></i></div>
                        <div class="h-6 bg-slate-100 rounded-full w-3/4 mb-3"></div>
                        <div class="h-3 bg-slate-100 rounded-full w-1/2"></div>
                    </div>
                    @endfor
                @endif
            </div>
        </section>

        {{-- STATISTIK --}}
        <section id="statistik" class="py-32 px-[5%] bg-stone-50 rounded-[80px]">
            <div class="grid lg:grid-cols-4 md:grid-cols-2 gap-8">
                @php
                    $stats = [
                        ['i' => 'fa-users', 'v' => $stat_penduduk ?? '0', 'l' => 'Total Penduduk', 'c' => 'text-emerald-600 bg-emerald-100'],
                        ['i' => 'fa-house-user', 'v' => $stat_kk ?? '0', 'l' => 'Kepala Keluarga', 'c' => 'text-blue-600 bg-blue-100'],
                        ['i' => 'fa-briefcase', 'v' => $stat_umkm_count ?? '0', 'l' => 'Pelaku UMKM', 'c' => 'text-amber-600 bg-amber-100'],
                        ['i' => 'fa-map', 'v' => $stat_luas ?? '0', 'l' => 'Luas Wilayah (Ha)', 'c' => 'text-purple-600 bg-purple-100'],
                    ];
                @endphp
                @foreach($stats as $s)
                <div class="stat-card" data-aos="fade-up">
                    <div class="w-16 h-16 {{ $s['c'] }} rounded-2xl flex items-center justify-center text-2xl mb-10 shadow-sm"><i class="fa-solid {{ $s['i'] }}"></i></div>
                    <h3 class="text-6xl font-serif italic text-emerald-950 mb-3">{{ $s['v'] }}</h3>
                    <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">{{ $s['l'] }}</p>
                </div>
                @endforeach
            </div>
        </section>

        {{-- LAYANAN DIGITAL (LOCKED) --}}
        <section id="layanan" class="py-32 px-[5%]">
            <div class="grid lg:grid-cols-2 gap-24 items-center">
                <div data-aos="fade-right">
                    <h2 class="text-7xl font-serif italic leading-tight mb-10 text-emerald-950">Birokrasi <br> Dalam Klik.</h2>
                    <p class="text-gray-400 leading-loose italic mb-12">Portal mandiri Lumban Silintong menjamin keamanan data pribadi. Akses administrasi dan pengaduan hanya untuk warga yang terverifikasi.</p>
                    <div class="flex gap-6">
                        <a href="/login" class="btn-premium">Login Warga</a>
                        <a href="#faq" class="px-8 py-5 rounded-2xl border-2 border-emerald-950 text-[10px] font-black uppercase tracking-widest hover:bg-emerald-950 hover:text-white transition">Panduan</a>
                    </div>
                </div>
                <div class="space-y-8" data-aos="fade-left">
                    <div class="service-locked group cursor-pointer" onclick="window.location='/login'">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-3xl font-serif italic mb-2">E-Surat Keterangan</h4>
                                <p class="text-xs text-gray-400 italic">Domisili, Usaha, Kematian, dan 12 jenis lainnya.</p>
                            </div>
                            <div class="text-3xl text-slate-100 group-hover:text-emerald-500 transition"><i class="fa-solid fa-file-contract"></i></div>
                        </div>
                        <div class="lock-overlay">
                            <div class="bg-white px-8 py-4 rounded-3xl shadow-2xl flex items-center gap-4">
                                <i class="fa-solid fa-lock text-emerald-600"></i>
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Terautentikasi</span>
                            </div>
                        </div>
                    </div>
                    <div class="service-locked group cursor-pointer" onclick="window.location='/login'">
                        <div class="flex justify-between items-start">
                            <div>
                                <h4 class="text-3xl font-serif italic mb-2">Aspirasi & Keluhan</h4>
                                <p class="text-xs text-gray-400 italic">Sampaikan suara anda langsung ke jajaran kepala desa.</p>
                            </div>
                            <div class="text-3xl text-slate-100 group-hover:text-emerald-500 transition"><i class="fa-solid fa-comment-dots"></i></div>
                        </div>
                        <div class="lock-overlay">
                            <div class="bg-white px-8 py-4 rounded-3xl shadow-2xl flex items-center gap-4">
                                <i class="fa-solid fa-lock text-emerald-600"></i>
                                <span class="text-[10px] font-black uppercase tracking-[0.2em]">Terautentikasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- UMKM / PASAR DIGITAL --}}
        <section id="umkm" class="py-32 px-[5%]">
            <div class="flex justify-between items-end mb-20">
                <h2 class="text-6xl font-serif italic leading-none">Pasar Digital <br> Lokal Premium.</h2>
                <div class="hidden md:block h-px flex-1 mx-20 bg-slate-100"></div>
                <a href="#" class="text-[10px] font-black uppercase tracking-widest border-b-2 border-emerald-500 pb-2">Katalog</a>
            </div>
            @if(isset($umkms) && count($umkms) > 0)
                <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-12">
                    @foreach($umkms as $u)
                    <div class="group cursor-pointer" data-aos="fade-up">
                        <div class="rounded-[60px] overflow-hidden h-[550px] relative mb-8 shadow-2xl">
                            <img src="{{ $u->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                            <div class="absolute bottom-8 left-8 bg-white/95 backdrop-blur-md px-8 py-4 rounded-[25px] shadow-xl">
                                <span class="text-lg font-black text-emerald-950">Rp {{ number_format($u->price, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <h4 class="text-3xl font-serif italic text-emerald-950">{{ $u->name }}</h4>
                        <p class="text-[10px] font-black uppercase text-emerald-500 tracking-[0.3em] mt-3 italic">Produk Unggulan Desa</p>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fa-solid fa-basket-shopping text-5xl mb-6 opacity-20"></i>
                    <h3 class="text-xl italic text-slate-400 uppercase tracking-widest">Etalase Masih Kosong</h3>
                </div>
            @endif
        </section>

        {{-- GALERI FOTO --}}
        <section id="galeri" class="py-32 px-[5%] bg-stone-50 rounded-[80px]">
            <h2 class="text-5xl font-serif italic text-center mb-20">Dokumentasi Kegiatan</h2>
            @if(isset($galeris) && count($galeris) > 0)
                <div class="grid md:grid-cols-4 gap-6">
                    @foreach($galeris as $g)
                        <div class="h-80 rounded-[40px] overflow-hidden shadow-xl hover:scale-95 transition duration-500">
                            <img src="{{ $g->photo }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <p class="italic">Belum ada foto kegiatan desa yang diunggah.</p>
                </div>
            @endif
        </section>

        {{-- PETA & FAQ --}}
        <section id="peta" class="py-32 px-[5%]">
            <div class="grid lg:grid-cols-2 gap-24">
                <div class="rounded-[60px] overflow-hidden shadow-2xl h-[600px] border-8 border-white">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.668102377317!2d99.0435942!3d2.332309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04306443c683%3A0x868a8600868a86!2sLumban%20Silintong!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
                <div>
                    <h2 class="text-5xl font-serif italic mb-16 italic">Pusat Informasi</h2>
                    <div class="space-y-4">
                        @php
                            $faqs = [
                                ['q' => 'Bagaimana cara registrasi warga?', 'a' => 'Kunjungi kantor desa dengan membawa KTP dan KK asli untuk proses verifikasi oleh admin portal.'],
                                ['q' => 'Apakah layanan surat digital berbayar?', 'a' => 'Tidak. Seluruh layanan administrasi melalui portal ini gratis tanpa biaya sepeser pun.'],
                                ['q' => 'Bagaimana jika lupa password portal?', 'a' => 'Silakan klik tombol "Lupa Password" atau hubungi petugas IT desa di kantor.'],
                            ];
                        @endphp
                        @foreach($faqs as $i => $f)
                        <div class="bg-white p-8 rounded-[35px] border border-gray-100 cursor-pointer transition hover:border-emerald-200" @click="faq === {{ $i }} ? faq = null : faq = {{ $i }}">
                            <div class="flex justify-between items-center text-emerald-950 font-bold">
                                <span>{{ $f['q'] }}</span>
                                <i class="fa-solid" :class="faq === {{ $i }} ? 'fa-minus' : 'fa-plus'"></i>
                            </div>
                            <div x-show="faq === {{ $i }}" x-collapse class="mt-6 text-sm text-gray-400 leading-loose italic">
                                {{ $f['a'] }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>

        {{-- FOOTER --}}
        <footer class="glass-footer text-white pt-28 pb-14 px-[8%] mt-24">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-20 relative z-10 mb-20">
                <div class="md:col-span-6">
                    <h2 class="text-7xl font-serif italic text-white mb-10 leading-none">LS.</h2>
                    <p class="text-lg font-light text-emerald-100/40 italic max-w-sm mb-12">"Mewujudkan kemandirian desa melalui tata kelola cerdas dan digitalisasi yang inklusif."</p>
                    <div class="flex gap-4">
                        <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-emerald-500 transition cursor-pointer"><i class="fa-brands fa-instagram text-xl"></i></div>
                        <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-emerald-500 transition cursor-pointer"><i class="fa-brands fa-facebook-f text-xl"></i></div>
                        <div class="w-14 h-14 rounded-2xl bg-white/5 border border-white/10 flex items-center justify-center hover:bg-emerald-500 transition cursor-pointer"><i class="fa-brands fa-whatsapp text-xl"></i></div>
                    </div>
                </div>
                <div class="md:col-span-3">
                    <h5 class="text-[10px] font-black uppercase tracking-[0.4em] text-emerald-400 mb-10">Navigasi Cepat</h5>
                    <ul class="space-y-4 text-emerald-100/40 italic text-sm">
                        <li><a href="#profil" class="hover:text-white transition">Tentang Desa</a></li>
                        <li><a href="#berita" class="hover:text-white transition">Berita & Acara</a></li>
                        <li><a href="#umkm" class="hover:text-white transition">Katalog UMKM</a></li>
                        <li><a href="#layanan" class="hover:text-white transition">Portal Mandiri</a></li>
                    </ul>
                </div>
                <div class="md:col-span-3">
                    <h5 class="text-[10px] font-black uppercase tracking-[0.4em] text-emerald-400 mb-10">Hubungi Kami</h5>
                    <p class="text-sm text-emerald-100/40 italic mb-8">Kec. Balige, Kab. Toba,<br>Sumatera Utara, 22312.</p>
                    <p class="text-2xl font-serif italic text-white">halo@lumbansilintong.id</p>
                </div>
            </div>
            <div class="pt-10 border-t border-white/5 text-center">
                <p class="text-[9px] font-black uppercase tracking-[0.6em] text-emerald-100/10">© 2026 IT DEL - Digital Excellence for Rural Innovation</p>
            </div>
        </footer>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 1200, once: true, easing: 'ease-out-expo' });
    </script>
</body>
</html>