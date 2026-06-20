{{-- resources/views/masyarakat/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Masyarakat - Lumban Silintong')

@section('content')
<!-- Plugin: Animate.css & FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* ============================================
       DESIGN SYSTEM (selaras dengan halaman premium lain)
    ============================================ */
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --dark: #0f172a;
        --gray: #64748b;
        --border: #eef2f6;
        --shadow-sm: 0 2px 10px rgba(0,0,0,0.04);
        --shadow-md: 0 10px 30px rgba(0,0,0,0.08);
        --shadow-lg: 0 24px 60px rgba(0,0,0,0.10);
        --transition: all 0.35s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.45s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    /* Background pattern halus */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: 0;
        background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
        background-size: 26px 26px;
        opacity: 0.22;
        pointer-events: none;
    }

    body {
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%) !important;
    }

    /* ============================================ */
    /* ANIMATIONS */
    /* ============================================ */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-15px); }
    }
    @keyframes float-slow {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    @keyframes shine {
        0% { transform: translateX(-100%) rotate(25deg); }
        20% { transform: translateX(100%) rotate(25deg); }
        100% { transform: translateX(100%) rotate(25deg); }
    }
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
        50% { box-shadow: 0 0 0 20px rgba(16, 185, 129, 0); }
    }

    .floating { animation: float 3s ease-in-out infinite; }
    .floating-slow { animation: float-slow 4s ease-in-out infinite; }
    .pulse-glow { animation: pulse-glow 2s infinite; }

    /* ============================================ */
    /* HERO SLIDER - SAMA PERSIS DENGAN ASLINYA */
    /* ============================================ */
    .slider-container {
        border-radius: 60px;
        overflow: hidden;
        position: relative;
        box-shadow: var(--shadow-lg);
        border: 1px solid rgba(255,255,255,0.35);
        background: rgba(255,255,255,0.15);
        backdrop-filter: blur(10px);
    }
    .slider-wrapper { display: flex; transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1); }
    .slide { min-width: 100%; height: 85vh; position: relative; }
    .slide-content { 
        position: absolute; inset: 0; 
        background: linear-gradient(105deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 50%, transparent 100%);
        display: flex; flex-direction: column; justify-content: center; padding-left: 8%; color: white;
    }
    
    /* Premium Buttons */
    .btn-premium {
        background: linear-gradient(135deg, #064e3b, #065f46);
        color: #fff; padding: 16px 36px; border-radius: 50px;
        font-weight: 700; font-size: 11px; text-transform: uppercase;
        letter-spacing: 1.5px; transition: 0.3s; display: inline-block;
        box-shadow: 0 10px 25px rgba(6, 78, 59, 0.25);
        position: relative;
        overflow: hidden;
    }
    .btn-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s;
    }
    .btn-premium:hover::before { left: 100%; }
    .btn-premium:hover {
        transform: translateY(-3px) scale(1.02);
        background: var(--primary);
        box-shadow: 0 18px 40px rgba(16, 185, 129, 0.35);
    }
    
    .btn-outline-premium {
        background: transparent; border: 2px solid rgba(255,255,255,0.5);
        backdrop-filter: blur(10px); padding: 14px 32px; border-radius: 50px;
        font-weight: 600; transition: 0.3s;
    }
    .btn-outline-premium:hover { background: rgba(255,255,255,0.2); border-color: white; transform: translateY(-2px); }

    /* ============================================ */
    /* HERO PROFIL DESA SECTION - SAMA PERSIS DENGAN ASLINYA */
    /* ============================================ */
    .hero-profil-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        padding: 5rem 1.5rem;
        margin: 2rem 0;
        overflow: hidden;
    }

    .hero-profil-ornaments {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.12;
        pointer-events: none;
        z-index: 0;
    }

    .hero-profil-ornament-1 {
        position: absolute;
        top: 10%;
        right: 5%;
        width: 25rem;
        height: 25rem;
        background: #10b981;
        border-radius: 50%;
        filter: blur(130px);
        animation: floatOrnament1 8s ease-in-out infinite;
    }

    .hero-profil-ornament-2 {
        position: absolute;
        bottom: 10%;
        left: 5%;
        width: 20rem;
        height: 20rem;
        background: #c5a358;
        border-radius: 50%;
        filter: blur(110px);
        animation: floatOrnament2 10s ease-in-out infinite reverse;
    }

    @keyframes floatOrnament1 {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.12; }
        33% { transform: translate(-35px, -25px) scale(1.08); opacity: 0.18; }
        66% { transform: translate(25px, -35px) scale(1.05); opacity: 0.15; }
    }

    @keyframes floatOrnament2 {
        0%, 100% { transform: translate(0, 0) scale(1); opacity: 0.12; }
        33% { transform: translate(30px, 20px) scale(1.08); opacity: 0.18; }
        66% { transform: translate(-25px, 30px) scale(1.05); opacity: 0.15; }
    }

    .hero-profil-grid {
        max-width: 1280px;
        margin: 0 auto;
        width: 100%;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 4rem;
        align-items: center;
        position: relative;
        z-index: 1;
    }

    .hero-profil-left { padding: 1rem; }

    .hero-profil-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 1.2rem;
        border-radius: 60px;
        border: 1px solid rgba(16, 185, 129, 0.25);
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(4px);
        margin-bottom: 2rem;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .hero-profil-badge:hover {
        background: #10b981;
        border-color: #10b981;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(16, 185, 129, 0.2);
    }

    .hero-profil-badge:hover p { color: white; }

    .hero-profil-badge span {
        width: 0.5rem;
        height: 0.5rem;
        background: #10b981;
        border-radius: 50%;
        display: inline-block;
        animation: pingBadge 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    @keyframes pingBadge {
        0%, 100% { opacity: 1; transform: scale(1); }
        75% { opacity: 0.5; transform: scale(1.3); }
    }

    .hero-profil-badge p {
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #059669;
        margin: 0;
    }

    .hero-profil-title {
        font-size: clamp(3rem, 8vw, 6rem);
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        line-height: 0.9;
        margin-bottom: 2rem;
        letter-spacing: -0.02em;
    }

    .hero-profil-title .text-gradient {
        background: linear-gradient(135deg, #062c1f 0%, #10b981 60%, #34d399 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        display: inline-block;
    }

    .hero-profil-desc {
        max-width: 500px;
        margin-bottom: 2rem;
    }

    .hero-profil-desc p {
        font-size: 1rem;
        color: #475569;
        font-weight: 400;
        line-height: 1.7;
    }

    .btn-profil {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 60px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .btn-profil::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.5s ease;
        z-index: -1;
    }

    .btn-profil:hover::before { left: 100%; }
    .btn-profil:hover {
        background: linear-gradient(135deg, #059669, #047857);
        gap: 0.8rem;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.4);
    }

    .hero-profil-right { position: relative; }

    .hero-profil-image {
        border-radius: 60px;
        overflow: hidden;
        transform: rotate(3deg);
        transition: transform 0.6s cubic-bezier(0.34, 1.2, 0.64, 1);
        box-shadow: 0 30px 50px -20px rgba(0, 0, 0, 0.3);
    }

    .hero-profil-image:hover {
        transform: rotate(0deg);
        box-shadow: 0 40px 60px -25px rgba(0, 0, 0, 0.35);
    }

    .hero-profil-image img {
        width: 100%;
        height: auto;
        object-fit: cover;
        transition: transform 0.7s ease;
        display: block;
    }

    .hero-profil-image:hover img { transform: scale(1.05); }

    .hero-profil-quote {
        position: absolute;
        bottom: -1.5rem;
        left: -1.5rem;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        padding: 1.2rem 2rem;
        border-radius: 32px;
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.2);
        border: 1px solid rgba(255, 255, 255, 0.6);
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        cursor: pointer;
    }

    .hero-profil-quote:hover {
        transform: translateY(-8px) translateX(5px);
        box-shadow: 0 30px 50px -15px rgba(16, 185, 129, 0.25);
        border-color: rgba(16, 185, 129, 0.3);
    }

    .hero-profil-quote p:first-child {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        font-style: italic;
        margin-bottom: 0.3rem;
        line-height: 1.2;
        color: #000000;
    }

    .hero-profil-quote p:last-child {
        font-size: 0.6rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #10b981;
        margin: 0;
    }

    @media (max-width: 1024px) {
        .hero-profil-grid { grid-template-columns: 1fr; gap: 2.5rem; text-align: center; }
        .hero-profil-left { text-align: center; }
        .hero-profil-desc { margin-left: auto; margin-right: auto; }
        .hero-profil-badge { margin-left: auto; margin-right: auto; }
        .hero-profil-right { max-width: 450px; margin: 0 auto; }
        .hero-profil-quote { bottom: -1rem; left: 50%; transform: translateX(-50%); white-space: nowrap; padding: 0.8rem 1.5rem; }
    }

    @media (max-width: 768px) {
        .hero-profil-quote { white-space: normal; text-align: center; width: 85%; }
        .hero-profil-quote p:first-child { font-size: 1rem; }
    }

    /* Utility */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    [x-cloak] { display: none !important; }
</style>

<div class="bg-pattern"></div>

<div class="min-h-screen bg-[#F8FAFC] py-8 overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- ============================================= --}}
        {{-- 1. HERO SLIDER PREMIUM (KEMBALI SEPERTI ASLINYA) --}}
        {{-- ============================================= --}}
        <section class="mb-12">
            <div class="slider-container group" x-data="{ slide: 0, totalSlides: 6 }" x-init="setInterval(() => slide = (slide + 1) % totalSlides, 6000)">
                <div class="slider-wrapper" :style="'transform: translateX(-' + (slide * 100) + '%)'">
                    @php
                        $hero = [
                            ['t' => 'Peradaban Digital Lumban Silintong', 'd' => 'Menyatukan teknologi dengan kearifan lokal Toba.', 'img' => asset('images/Slider/1.png'), 'badge' => '✨ Smart Village'],
                            ['t' => 'UMKM Naik Kelas Menuju Global', 'd' => 'Mendorong ekonomi kreatif warga semakin kompetitif.', 'img' => asset('images/Slider/6.png'), 'badge' => '🚀 Ekonomi Kreatif'],
                            ['t' => 'Harmonisasi Alam Danau Toba', 'd' => 'Menjaga kelestarian pesisir untuk generasi masa depan.', 'img' => asset('images/Slider/3.png'), 'badge' => '🌿 Ekowisata'],
                            ['t' => 'Pelayanan Publik Satu Genggaman', 'd' => 'Akses administrasi kini lebih cepat dan transparan.', 'img' => asset('images/Slider/4.png'), 'badge' => '📱 E-Government'],
                            ['t' => 'Budaya Batak Yang Mendunia', 'd' => 'Melestarikan adat istiadat di tengah modernisasi.', 'img' => asset('images/Slider/5.jpg'), 'badge' => '🎭 Kearifan Lokal'],
                            ['t' => 'Lumban Silintong Excellence', 'd' => 'Bersama membangun desa cerdas (Smart Village).', 'img' => asset('images/Slider/2.png'), 'badge' => '🏆 Smart Village'],
                        ];
                    @endphp
                    @foreach($hero as $h)
                    <div class="slide">
                        <img src="{{ $h['img'] }}" class="absolute inset-0 w-full h-full object-cover brightness-[0.6]">
                        <div class="slide-content">
                            <span class="inline-block px-5 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-xs font-bold rounded-full mb-5 tracking-wide shadow-lg animate-pulse">{{ $h['badge'] }}</span>
                            <h2 class="text-5xl md:text-7xl font-serif italic mb-5 leading-tight">{{ $h['t'] }}</h2>
                            <p class="text-lg md:text-2xl font-light italic opacity-95 max-w-2xl">{{ $h['d'] }}</p>
                            <div class="mt-10 flex flex-wrap gap-4">
                                <a href="{{ route('masyarakat.surat.create') }}" class="btn-premium">📝 Ajukan Surat</a>
                                <a href="{{ route('masyarakat.aspirasi.create') }}" class="btn-outline-premium">💬 Aspirasi →</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="absolute bottom-8 right-12 flex gap-2 z-10">
                    @foreach($hero as $index => $h)
                        <div @click="slide = {{ $index }}" class="w-10 h-1.5 rounded-full cursor-pointer transition-all duration-500" :class="slide === {{ $index }} ? 'bg-emerald-400 w-16' : 'bg-white/40 hover:bg-white/70'"></div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- ============================================= --}}
        {{-- 2. HERO PROFIL DESA SECTION (KEMBALI SEPERTI ASLINYA) --}}
        {{-- ============================================= --}}
        <section class="hero-profil-section">
            <div class="hero-profil-ornaments">
                <div class="hero-profil-ornament-1"></div>
                <div class="hero-profil-ornament-2"></div>
            </div>

            <div class="hero-profil-grid">
                <div class="hero-profil-left">
                    <div class="hero-profil-badge">
                        <span></span>
                        <p>Profil</p>
                    </div>
                    
                    <h1 class="hero-profil-title">
                        Profil <br>
                        <span>Desa</span> <br>
                        <span class="text-gradient">Lumban Silintong.</span>
                    </h1>

                    <div class="hero-profil-desc">
                        <p>
                            Simfoni harmoni antara kemegahan tebing vulkanik, jernihnya Danau Toba, 
                            dan luhurnya tradisi Batak yang terjaga dalam modernitas.
                        </p>
                    </div>
                    
                    <a href="{{ route('profil-desa') }}" class="btn-profil">
                        Pelajari Lebih Lanjut <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
                
                <div class="hero-profil-right">
                    <div class="hero-profil-image">
                        <img src="{{ asset('images/profil/1.jpeg') }}" alt="Desa Lumban Silintong">
                    </div>
                    <div class="hero-profil-quote">
                        <p>"Mansai Uli"</p>
                        <p>Keindahan yang natural, budaya yang abadi.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- ============================================= --}}
        {{-- 3. GREETING CARD & STATS (Desain Baru dari UMKM) --}}
        {{-- ============================================= --}}
        <div class="relative mb-12">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="animate__animated animate__fadeInLeft">
                    <span class="inline-block px-4 py-1 mb-4 text-[10px] font-black tracking-[0.3em] text-emerald-600 uppercase bg-emerald-100/50 rounded-full">
                        Selamat Datang
                    </span>
                    <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-none tracking-tight">
                        Halo, <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">{{ Auth::user()->name }}</span>
                    </h1>
                    <p class="mt-4 text-slate-500 text-lg font-light max-w-md">
                        Nikmati berbagai layanan digital desa dengan mudah dan nyaman.
                    </p>
                </div>

                {{-- Stats Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 animate__animated animate__fadeInRight">
                    @php
                        $stats = [
                            ['label' => 'Pengajuan Surat', 'count' => $totalSurat ?? 0, 'color' => 'emerald', 'icon' => 'fa-file-lines'],
                            ['label' => 'Aspirasi', 'count' => $totalAspirasi ?? 0, 'color' => 'blue', 'icon' => 'fa-comment-dots'],
                            ['label' => 'Selesai', 'count' => $suratSelesai ?? 0, 'color' => 'green', 'icon' => 'fa-check-circle'],
                            ['label' => 'Diproses', 'count' => $suratMenunggu ?? 0, 'color' => 'amber', 'icon' => 'fa-clock'],
                        ];
                    @endphp
                    @foreach($stats as $stat)
                    <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                        <div class="flex items-center gap-2">
                            <i class="fa-solid {{ $stat['icon'] }} text-{{ $stat['color'] }}-500 text-xl group-hover:scale-110 transition-transform"></i>
                            <div class="text-2xl font-black text-{{ $stat['color'] }}-600 group-hover:scale-110 transition-transform">
                                {{ number_format($stat['count']) }}
                            </div>
                        </div>
                        <div class="text-[10px] uppercase tracking-wider font-bold text-slate-400 mt-1">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- 4. QUICK ACTION CARDS (Premium dari UMKM) --}}
        {{-- ============================================= --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-16 animate__animated animate__fadeInUp">
            {{-- Card Ajukan Surat --}}
            <a href="{{ route('masyarakat.surat.create') }}" class="group relative bg-white rounded-[2.5rem] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-teal-500 opacity-0 group-hover:opacity-5 transition duration-500"></div>
                <div class="absolute top-0 right-0 w-40 h-40 bg-emerald-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10 p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <i class="fa-solid fa-file-signature text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-slate-800 mb-2 group-hover:text-emerald-600 transition-colors">Ajukan Surat</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Domisili, Usaha, Tidak Mampu, Kelahiran, Kematian, dan 12 jenis lainnya.</p>
                            <div class="mt-5 flex items-center gap-2 text-emerald-600 text-sm font-black group-hover:gap-3 transition-all">
                                <span>AJUKAN SEKARANG</span>
                                <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                            </div>
                        </div>
                        <div class="text-5xl text-emerald-100 group-hover:text-emerald-200 transition group-hover:scale-110 duration-300">
                            <i class="fa-solid fa-file-contract"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 to-teal-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </a>

            {{-- Card Aspirasi --}}
            <a href="{{ route('masyarakat.aspirasi.create') }}" class="group relative bg-white rounded-[2.5rem] overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-cyan-500 opacity-0 group-hover:opacity-5 transition duration-500"></div>
                <div class="absolute top-0 right-0 w-40 h-40 bg-blue-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
                <div class="relative z-10 p-8">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <i class="fa-solid fa-comment-dots text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-black text-slate-800 mb-2 group-hover:text-blue-600 transition-colors">Aspirasi & Keluhan</h3>
                            <p class="text-slate-400 text-sm leading-relaxed">Sampaikan suara, saran, atau keluhan Anda langsung ke perangkat desa.</p>
                            <div class="mt-5 flex items-center gap-2 text-blue-600 text-sm font-black group-hover:gap-3 transition-all">
                                <span>SAMPAIKAN ASPIRASI</span>
                                <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                            </div>
                        </div>
                        <div class="text-5xl text-blue-100 group-hover:text-blue-200 transition group-hover:scale-110 duration-300">
                            <i class="fa-solid fa-comment-dots"></i>
                        </div>
                    </div>
                </div>
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 to-cyan-500 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
            </a>
        </div>

{{-- 5. STATISTIK DESA --}}
<div class="mb-16">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
        <div>
            <span class="inline-block px-4 py-1 mb-2 text-[10px] font-black tracking-[0.3em] text-emerald-600 uppercase bg-emerald-100/50 rounded-full">📊 Data Statistik Desa</span>
            <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">Statistik <span class="text-emerald-600">Desa</span></h2>
            <p class="text-slate-400 text-sm mt-1">Data kependudukan, demografi, dan layanan desa secara realtime</p>
        </div>
        <a href="{{ route('statistik.publik') }}" class="flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white rounded-2xl text-xs font-bold hover:bg-emerald-700 transition">
            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i> Statistik Lengkap
        </a>
    </div>

    {{-- ROW 1: 4 kartu utama kependudukan --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-5">
        @foreach([
            ['label'=>'Total Penduduk','val'=>($statistik['penduduk_pria']??0)+($statistik['penduduk_wanita']??0),'icon'=>'fa-users','from'=>'from-emerald-500','to'=>'to-teal-500','light'=>'from-emerald-50 to-teal-50','text'=>'emerald'],
            ['label'=>'Laki-laki',     'val'=>$statistik['penduduk_pria']??0,   'icon'=>'fa-mars',      'from'=>'from-blue-500','to'=>'to-cyan-500',   'light'=>'from-blue-50 to-cyan-50',   'text'=>'blue'],
            ['label'=>'Perempuan',     'val'=>$statistik['penduduk_wanita']??0, 'icon'=>'fa-venus',     'from'=>'from-pink-500','to'=>'to-rose-500',   'light'=>'from-pink-50 to-rose-50',   'text'=>'pink'],
            ['label'=>'Kepala Keluarga','val'=>$statistik['total_kk']??0,       'icon'=>'fa-house-user','from'=>'from-amber-500','to'=>'to-orange-500','light'=>'from-amber-50 to-orange-50','text'=>'amber'],
        ] as $c)
        <div class="bg-gradient-to-br {{ $c['light'] }} rounded-2xl p-5 text-center border border-{{ $c['text'] }}-100/50 hover:shadow-lg transition-all duration-300 hover:-translate-y-1">
            <div class="w-14 h-14 bg-gradient-to-br {{ $c['from'] }} {{ $c['to'] }} rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                <i class="fa-solid {{ $c['icon'] }} text-white text-xl"></i>
            </div>
            <p class="text-3xl font-black text-{{ $c['text'] }}-700">{{ number_format($c['val']) }}</p>
            <p class="text-xs font-bold text-{{ $c['text'] }}-600/70 mt-1 uppercase tracking-wider">{{ $c['label'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- ROW 2: Kelompok Umur + Status Perkawinan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

        {{-- Kelompok Umur --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-gradient-to-br from-violet-500 to-purple-600 rounded-xl flex items-center justify-center shadow">
                    <i class="fa-solid fa-chart-bar text-white"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-base">Kelompok Umur</h3>
                    <p class="text-xs text-slate-400">Sebaran usia penduduk desa</p>
                </div>
            </div>
            @php
                $umurData = [
                    ['label'=>'0 – 14 Tahun (Anak)','val'=>$statistik['kelompok_umur_0_14']??0,'color'=>'bg-emerald-500'],
                    ['label'=>'15 – 29 Tahun (Remaja/Pemuda)','val'=>$statistik['kelompok_umur_15_29']??0,'color'=>'bg-blue-500'],
                    ['label'=>'30 – 59 Tahun (Dewasa/Produktif)','val'=>$statistik['kelompok_umur_30_59']??0,'color'=>'bg-amber-500'],
                    ['label'=>'60+ Tahun (Lansia)','val'=>$statistik['kelompok_umur_60']??0,'color'=>'bg-purple-500'],
                ];
                $maxUmur = max(array_column($umurData,'val') ?: [1]);
                $totalPop = ($statistik['penduduk_pria']??0)+($statistik['penduduk_wanita']??0);
            @endphp
            <div class="space-y-3">
                @foreach($umurData as $u)
                @php $pct = $totalPop > 0 ? round($u['val']/$totalPop*100,1) : 0; @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-slate-600 font-medium">{{ $u['label'] }}</span>
                        <span class="text-sm font-black text-slate-800">{{ number_format($u['val']) }} <span class="text-xs font-normal text-slate-400">({{ $pct }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        <div class="{{ $u['color'] }} h-2.5 rounded-full" style="width:{{ $maxUmur > 0 ? round($u['val']/$maxUmur*100) : 0 }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Status Perkawinan --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-pink-600 rounded-xl flex items-center justify-center shadow">
                    <i class="fa-solid fa-heart text-white"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-base">Status Perkawinan</h3>
                    <p class="text-xs text-slate-400">Distribusi status pernikahan</p>
                </div>
            </div>
            @php
                $pkColors = ['bg-emerald-500','bg-blue-500','bg-amber-500','bg-rose-500','bg-purple-500','bg-cyan-500'];
                $pkTotal = $statistik['distribusi_perkawinan']?->sum('total') ?: 1;
                $pkMax   = $statistik['distribusi_perkawinan']?->max('total') ?: 1;
            @endphp
            @if($statistik['distribusi_perkawinan']?->count() > 0)
            <div class="space-y-3">
                @foreach($statistik['distribusi_perkawinan'] as $idx => $pk)
                @php $pct = round($pk->total/$pkTotal*100,1); @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-slate-600 font-medium">{{ $pk->status_perkawinan }}</span>
                        <span class="text-sm font-black text-slate-800">{{ number_format($pk->total) }} <span class="text-xs font-normal text-slate-400">({{ $pct }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        <div class="{{ $pkColors[$idx % count($pkColors)] }} h-2.5 rounded-full" style="width:{{ round($pk->total/$pkMax*100) }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex items-center justify-center h-24 text-slate-400 text-sm">Data belum tersedia</div>
            @endif
        </div>
    </div>

    {{-- ROW 3: Agama + Pendidikan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">

        {{-- Agama --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-yellow-500 rounded-xl flex items-center justify-center shadow">
                    <i class="fa-solid fa-place-of-worship text-white"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-base">Distribusi Agama</h3>
                    <p class="text-xs text-slate-400">Keberagaman keyakinan warga</p>
                </div>
            </div>
            @php
                $agColors  = ['bg-amber-500','bg-blue-500','bg-emerald-500','bg-rose-500','bg-purple-500','bg-cyan-500','bg-orange-500'];
                $agTotal   = $statistik['distribusi_agama']?->sum('total') ?: 1;
                $agMax     = $statistik['distribusi_agama']?->max('total') ?: 1;
            @endphp
            @if($statistik['distribusi_agama']?->count() > 0)
            <div class="space-y-3">
                @foreach($statistik['distribusi_agama'] as $idx => $ag)
                @php $pct = round($ag->total/$agTotal*100,1); @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-slate-600 font-medium">{{ $ag->agama }}</span>
                        <span class="text-sm font-black text-slate-800">{{ number_format($ag->total) }} <span class="text-xs font-normal text-slate-400">({{ $pct }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        <div class="{{ $agColors[$idx % count($agColors)] }} h-2.5 rounded-full" style="width:{{ round($ag->total/$agMax*100) }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex items-center justify-center h-24 text-slate-400 text-sm">Data belum tersedia</div>
            @endif
        </div>

        {{-- Pendidikan --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-gradient-to-br from-cyan-500 to-blue-600 rounded-xl flex items-center justify-center shadow">
                    <i class="fa-solid fa-graduation-cap text-white"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-base">Tingkat Pendidikan</h3>
                    <p class="text-xs text-slate-400">Jenjang pendidikan terakhir</p>
                </div>
            </div>
            @php
                $pdColors = ['bg-cyan-500','bg-blue-500','bg-indigo-500','bg-emerald-500','bg-purple-500','bg-amber-500','bg-rose-500'];
                $pdTotal  = $statistik['distribusi_pendidikan']?->sum('total') ?: 1;
                $pdMax    = $statistik['distribusi_pendidikan']?->max('total') ?: 1;
            @endphp
            @if($statistik['distribusi_pendidikan']?->count() > 0)
            <div class="space-y-3">
                @foreach($statistik['distribusi_pendidikan'] as $idx => $pd)
                @php $pct = round($pd->total/$pdTotal*100,1); @endphp
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-slate-600 font-medium">{{ $pd->pendidikan }}</span>
                        <span class="text-sm font-black text-slate-800">{{ number_format($pd->total) }} <span class="text-xs font-normal text-slate-400">({{ $pct }}%)</span></span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        <div class="{{ $pdColors[$idx % count($pdColors)] }} h-2.5 rounded-full" style="width:{{ round($pd->total/$pdMax*100) }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex items-center justify-center h-24 text-slate-400 text-sm">Data belum tersedia</div>
            @endif
        </div>
    </div>

    {{-- ROW 4: Pekerjaan + UMKM & Layanan --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

        {{-- Pekerjaan --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-emerald-600 rounded-xl flex items-center justify-center shadow">
                    <i class="fa-solid fa-briefcase text-white"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-base">Profesi</h3>
                    <p class="text-xs text-slate-400">6 pekerjaan terbanyak warga</p>
                </div>
            </div>
            @php
                $pkjColors = ['bg-teal-500','bg-emerald-500','bg-blue-500','bg-amber-500','bg-purple-500','bg-rose-500'];
                $pkjMax    = $statistik['distribusi_pekerjaan']?->max('total') ?: 1;
            @endphp
            @if($statistik['distribusi_pekerjaan']?->count() > 0)
            <div class="space-y-3">
                @foreach($statistik['distribusi_pekerjaan'] as $idx => $pk)
                <div>
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-sm text-slate-600 font-medium">{{ $pk->pekerjaan }}</span>
                        <span class="text-sm font-black text-slate-800">{{ number_format($pk->total) }}</span>
                    </div>
                    <div class="w-full bg-slate-100 rounded-full h-2.5 overflow-hidden">
                        <div class="{{ $pkjColors[$idx % count($pkjColors)] }} h-2.5 rounded-full" style="width:{{ round($pk->total/$pkjMax*100) }}%"></div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="flex items-center justify-center h-24 text-slate-400 text-sm">Data belum tersedia</div>
            @endif
        </div>

        {{-- UMKM & Layanan Desa --}}
        <div class="bg-white rounded-[2rem] border border-slate-100 p-6 shadow-sm hover:shadow-md transition">
            <div class="flex items-center gap-3 mb-5">
                <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-amber-500 rounded-xl flex items-center justify-center shadow">
                    <i class="fa-solid fa-bolt text-white"></i>
                </div>
                <div>
                    <h3 class="font-black text-slate-800 text-base">UMKM & Layanan Desa</h3>
                    <p class="text-xs text-slate-400">Ringkasan aktivitas layanan</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-3">
                @foreach([
                    ['label'=>'Total UMKM','val'=>$statistik['total_umkm']??0,'icon'=>'fa-store','bg'=>'bg-amber-100','text'=>'text-amber-700','icon_color'=>'text-amber-600'],
                    ['label'=>'UMKM Aktif','val'=>$statistik['umkm_aktif']??0,'icon'=>'fa-circle-check','bg'=>'bg-emerald-100','text'=>'text-emerald-700','icon_color'=>'text-emerald-600'],
                    ['label'=>'Total Berita','val'=>$statistik['total_berita']??0,'icon'=>'fa-newspaper','bg'=>'bg-blue-100','text'=>'text-blue-700','icon_color'=>'text-blue-600'],
                    ['label'=>'Aspirasi Warga','val'=>$statistik['total_aspirasi_desa']??0,'icon'=>'fa-comment-dots','bg'=>'bg-purple-100','text'=>'text-purple-700','icon_color'=>'text-purple-600'],
                ] as $item)
                <div class="flex items-center gap-3 p-3 {{ $item['bg'] }} rounded-2xl">
                    <i class="fa-solid {{ $item['icon'] }} {{ $item['icon_color'] }} text-lg"></i>
                    <div>
                        <div class="text-lg font-black {{ $item['text'] }}">{{ number_format($item['val']) }}</div>
                        <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wide">{{ $item['label'] }}</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>

        {{-- ============================================= --}}
        {{-- 6. STATUS PENGAJUAN SURAT TERBARU --}}
        {{-- ============================================= --}}
        <div class="mb-16">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-md hover:shadow-xl transition-all duration-500">
                <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-6 border-b border-slate-100">
                    <div class="flex justify-between items-center flex-wrap gap-4">
                        <div>
                            <span class="inline-block px-4 py-1 mb-2 text-[10px] font-black tracking-[0.3em] text-emerald-600 uppercase bg-emerald-100/50 rounded-full">
                                📋 Terbaru
                            </span>
                            <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Status Pengajuan Surat</h2>
                            <p class="text-slate-400 text-sm mt-1">Pantau perkembangan pengajuan surat Anda</p>
                        </div>
                        <a href="{{ route('masyarakat.surat.index') }}" class="group flex items-center gap-2 text-emerald-600 text-sm font-black hover:gap-3 transition-all">
                            LIHAT SEMUA <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                        </a>
                    </div>
                </div>
                
                <div class="p-6">
                    @if(isset($pengajuanTerbaru) && $pengajuanTerbaru->count() > 0)
                        <div class="space-y-4">
                            @foreach($pengajuanTerbaru as $surat)
                            <div class="group flex flex-col md:flex-row justify-between items-start md:items-center p-5 bg-slate-50 rounded-2xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-white transition-all duration-300 hover:shadow-md">
                                <div class="flex-1">
                                    <div class="flex items-center gap-3 mb-2">
                                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-md">
                                            <i class="fa-solid fa-file-alt text-white text-sm"></i>
                                        </div>
                                        <div>
                                            <h3 class="font-black text-slate-800 group-hover:text-emerald-600 transition">{{ $surat->jenis_surat }}</h3>
                                            <p class="text-[10px] text-slate-400">Diajukan: {{ $surat->created_at->translatedFormat('d F Y, H:i') }}</p>
                                        </div>
                                    </div>
                                    <div class="mt-2 w-full md:w-64">
                                        <div class="h-1.5 bg-slate-200 rounded-full overflow-hidden">
                                            <div class="h-full rounded-full transition-all duration-1000
                                                @if($surat->status == 'menunggu') bg-amber-500 w-1/3
                                                @elseif($surat->status == 'diproses') bg-blue-500 w-2/3
                                                @elseif($surat->status == 'selesai') bg-emerald-500 w-full
                                                @else bg-red-500 w-full @endif">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4 mt-4 md:mt-0">
                                    <span class="px-4 py-2 rounded-full text-[10px] font-black flex items-center gap-1
                                        @if($surat->status == 'menunggu') bg-amber-100 text-amber-700
                                        @elseif($surat->status == 'diproses') bg-blue-100 text-blue-700
                                        @elseif($surat->status == 'selesai') bg-emerald-100 text-emerald-700
                                        @else bg-red-100 text-red-700 @endif">
                                        @if($surat->status == 'menunggu') <i class="fa-regular fa-clock"></i> MENUNGGU
                                        @elseif($surat->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> DIPROSES
                                        @elseif($surat->status == 'selesai') <i class="fa-regular fa-circle-check"></i> SELESAI
                                        @else <i class="fa-regular fa-circle-xmark"></i> DITOLAK @endif
                                    </span>
                                    <a href="{{ route('masyarakat.surat.show', $surat->id_surat) }}" class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-emerald-600 shadow-md hover:bg-emerald-600 hover:text-white transition-all duration-300 hover:scale-110">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-regular fa-file-lines text-3xl text-slate-400"></i>
                            </div>
                            <p class="text-slate-400 font-medium">Belum ada pengajuan surat</p>
                            <a href="{{ route('masyarakat.surat.create') }}" class="inline-block mt-3 px-6 py-2 bg-emerald-500 text-white rounded-full text-sm font-bold hover:bg-emerald-600 transition">AJUKAN SURAT →</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- 7. BERITA TERKINI & PENGUMUMAN --}}
        {{-- ============================================= --}}
        <div class="grid lg:grid-cols-3 gap-8 mb-16">
            {{-- Berita Utama --}}
            <div class="lg:col-span-2 bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-md hover:shadow-xl transition-all duration-500">
                <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-6 border-b border-slate-100">
                    <div class="flex justify-between items-center flex-wrap gap-4">
                        <div>
                            <span class="inline-block px-4 py-1 mb-2 text-[10px] font-black tracking-[0.3em] text-emerald-600 uppercase bg-emerald-100/50 rounded-full">
                                📰 Terkini
                            </span>
                            <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Berita & Pengumuman</h2>
                            <p class="text-slate-400 text-sm mt-1">Informasi terbaru dari Desa Lumban Silintong</p>
                        </div>
                        <a href="{{ route('berita') }}" class="group flex items-center gap-2 text-emerald-600 text-sm font-black hover:gap-3 transition-all">
                            LIHAT SEMUA <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                        </a>
                    </div>
                </div>
                
                <div class="p-6">
                    @if(isset($beritas) && $beritas->count() > 0)
                        <div class="space-y-5">
                            @foreach($beritas as $berita)
                            <div class="group flex gap-5 p-3 rounded-xl hover:bg-slate-50 transition-all duration-300">
                                <div class="w-24 h-24 rounded-2xl overflow-hidden flex-shrink-0 shadow-md">
                                    <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://via.placeholder.com/200x150/10b981/ffffff?text=Berita' }}" class="w-full h-full object-cover transition duration-500 group-hover:scale-110" alt="{{ $berita->judul }}">
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="px-2 py-0.5 rounded-full text-[8px] font-black uppercase
                                            @if($berita->kategori == 'berita') bg-blue-100 text-blue-700
                                            @elseif($berita->kategori == 'pengumuman') bg-amber-100 text-amber-700
                                            @else bg-emerald-100 text-emerald-700 @endif">
                                            {{ ucfirst($berita->kategori) }}
                                        </span>
                                        <span class="text-[9px] text-slate-400"><i class="fa-regular fa-eye mr-1"></i> {{ number_format($berita->dibaca ?? rand(10, 200)) }}</span>
                                    </div>
                                    <h3 class="font-black text-slate-800 group-hover:text-emerald-600 transition line-clamp-1">
                                        <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                    </h3>
                                    <p class="text-xs text-slate-400 mt-1"><i class="fa-regular fa-calendar mr-1"></i> {{ $berita->created_at->translatedFormat('d M Y') }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-regular fa-newspaper text-3xl text-slate-400"></i>
                            </div>
                            <p class="text-slate-400">Belum ada berita terbaru</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Sidebar: Pengumuman + Info Cepat --}}
            <div class="space-y-6">
                {{-- Pengumuman --}}
                <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-md hover:shadow-xl transition-all duration-500">
                    <div class="bg-gradient-to-r from-amber-50 to-white px-6 py-5 border-b border-slate-100">
                        <h2 class="text-xl font-black text-slate-900 flex items-center gap-2">
                            <i class="fa-solid fa-bullhorn text-amber-500"></i> Pengumuman
                        </h2>
                    </div>
                    <div class="p-5">
                        @if(isset($pengumuman) && $pengumuman->count() > 0)
                            <div class="space-y-3">
                                @foreach($pengumuman as $p)
                                <a href="{{ route('berita.show', $p->slug) }}" class="block border-l-4 border-amber-400 pl-4 py-2 hover:bg-amber-50/50 rounded-r-lg transition-all duration-300 hover:translate-x-1">
                                    <h4 class="font-bold text-slate-800 text-sm group-hover:text-amber-700 transition line-clamp-2">{{ $p->judul }}</h4>
                                    <p class="text-[10px] text-slate-400 mt-1 flex items-center gap-1"><i class="fa-regular fa-calendar"></i> {{ $p->created_at->translatedFormat('d M Y') }}</p>
                                </a>
                                @endforeach
                            </div>
                        @else
                            <p class="text-slate-400 text-sm text-center py-5">Tidak ada pengumuman</p>
                        @endif
                    </div>
                </div>

                {{-- Info Cepat Card --}}
                <div class="bg-gradient-to-br from-emerald-600 to-teal-700 rounded-[2rem] p-6 text-white shadow-xl relative overflow-hidden group">
                    <div class="relative z-10">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                                <i class="fa-solid fa-circle-info text-2xl"></i>
                            </div>
                            <h3 class="text-xl font-black">Info Cepat</h3>
                        </div>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-center gap-2 group-hover:translate-x-2 transition-all duration-300"><i class="fa-solid fa-check-circle text-emerald-300"></i> Layanan surat online 24 jam</li>
                            <li class="flex items-center gap-2 group-hover:translate-x-2 transition-all duration-300"><i class="fa-solid fa-check-circle text-emerald-300"></i> Aspirasi ditanggapi maksimal 3 hari</li>
                            <li class="flex items-center gap-2 group-hover:translate-x-2 transition-all duration-300"><i class="fa-solid fa-check-circle text-emerald-300"></i> Kantor desa buka Senin-Sabtu</li>
                            <li class="flex items-center gap-2 group-hover:translate-x-2 transition-all duration-300"><i class="fa-solid fa-check-circle text-emerald-300"></i> Bantuan: hubungi admin desa</li>
                        </ul>
                    </div>
                    <i class="fa-solid fa-bell absolute -right-4 -bottom-4 text-8xl text-white/10 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-700"></i>
                </div>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- 8. ASPIRASI PUBLIK --}}
        {{-- ============================================= --}}
        <div class="mb-16">
            <div class="text-center mb-10">
                <span class="inline-block px-4 py-1 mb-3 text-[10px] font-black tracking-[0.3em] text-emerald-600 uppercase bg-emerald-100/50 rounded-full">
                    💬 Aspirasi Warga
                </span>
                <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">Suara Warga</h2>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-teal-500 mx-auto mt-4 rounded-full"></div>
                <p class="text-slate-400 mt-4 max-w-2xl mx-auto">Aspirasi, saran, dan keluhan warga Desa Lumban Silintong</p>
            </div>

            @if(isset($aspirasiPublik) && $aspirasiPublik->count() > 0)
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($aspirasiPublik as $aspirasi)
                    <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-slate-100">
                        <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-4 border-b border-slate-100">
                            <div class="flex items-start justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-cyan-500 flex items-center justify-center shadow-md">
                                        <i class="fa-solid fa-user text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-800">{{ $aspirasi->user->name ?? 'Warga' }}</p>
                                        <p class="text-[9px] text-slate-400 flex items-center gap-1">
                                            <i class="fa-regular fa-calendar"></i> 
                                            {{ $aspirasi->created_at->translatedFormat('d F Y') }}
                                        </p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="px-3 py-1 rounded-full text-[9px] font-black
                                        @if($aspirasi->kategori == 'saran') bg-green-100 text-green-700
                                        @elseif($aspirasi->kategori == 'keluhan') bg-red-100 text-red-700
                                        @elseif($aspirasi->kategori == 'masukan') bg-blue-100 text-blue-700
                                        @else bg-purple-100 text-purple-700 @endif">
                                        @if($aspirasi->kategori == 'saran') 💡 Saran
                                        @elseif($aspirasi->kategori == 'keluhan') 😞 Keluhan
                                        @elseif($aspirasi->kategori == 'masukan') 📝 Masukan
                                        @else ❓ Pertanyaan @endif
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="px-6 py-4">
                            <h3 class="text-lg font-bold text-slate-800 mb-2">{{ $aspirasi->judul }}</h3>
                            <p class="text-sm text-slate-600 leading-relaxed line-clamp-3">
                                {{ $aspirasi->isi_aspirasi }}
                            </p>
                        </div>
                        
                        @if($aspirasi->respon_admin && $aspirasi->respon_admin != '')
                        <div class="mx-6 mb-4 p-4 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border-l-4 border-emerald-500">
                            <div class="flex items-start gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-teal-500 flex items-center justify-center flex-shrink-0 shadow-sm">
                                    <i class="fa-solid fa-headset text-white text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs font-black text-emerald-700">Admin Desa</span>
                                        <span class="text-[8px] text-slate-400">{{ $aspirasi->updated_at->translatedFormat('d F Y') }}</span>
                                    </div>
                                    <p class="text-sm text-slate-700 leading-relaxed">
                                        {{ $aspirasi->respon_admin }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="mx-6 mb-4 p-4 bg-slate-50 rounded-xl border-l-4 border-slate-300">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-400 flex items-center justify-center flex-shrink-0">
                                    <i class="fa-regular fa-hourglass-half text-white text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-xs text-slate-500">⏳ Menunggu tanggapan dari admin desa</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="px-6 py-3 bg-slate-50 border-t border-slate-100 flex items-center justify-between">
                            <div class="flex items-center gap-2 text-xs text-slate-400">
    
                            </div>
                            <a href="{{ route('masyarakat.aspirasi.create') }}" class="text-[9px] text-emerald-600 font-black hover:text-emerald-700 transition flex items-center gap-1">
                                <i class="fa-regular fa-comment"></i> SAMPAIKAN ASPIRASI
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                
                <div class="text-center mt-10">
                    <a href="{{ route('masyarakat.aspirasi.create') }}" class="inline-flex items-center gap-2 px-8 py-4 bg-gradient-to-r from-emerald-600 to-teal-500 text-white rounded-full font-black text-sm tracking-wider hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <i class="fa-regular fa-pen-to-square"></i>
                        SAMPAIKAN ASPIRASI BARU
                    </a>
                </div>
            @else
                <div class="bg-white rounded-[2.5rem] shadow-md p-12 text-center">
                    <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-regular fa-comment-dots text-4xl text-slate-400"></i>
                    </div>
                    <h3 class="text-xl font-black text-slate-400">Belum Ada Aspirasi</h3>
                    <p class="text-slate-400 mt-2">Jadilah yang pertama menyampaikan aspirasi, saran, atau keluhan Anda.</p>
                    <a href="{{ route('masyarakat.aspirasi.create') }}" class="inline-block mt-4 px-6 py-2 bg-emerald-500 text-white rounded-full text-sm font-bold hover:bg-emerald-600 transition">
                        SAMPAIKAN ASPIRASI
                    </a>
                </div>
            @endif
        </div>

        {{-- ============================================= --}}
        {{-- 9. GALERI KEGIATAN --}}
        {{-- ============================================= --}}
        <div class="mb-16">
            <div class="bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden shadow-md hover:shadow-xl transition-all duration-500">
                <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-6 border-b border-slate-100">
                    <div class="flex justify-between items-center flex-wrap gap-4">
                        <div>
                            <span class="inline-block px-4 py-1 mb-2 text-[10px] font-black tracking-[0.3em] text-emerald-600 uppercase bg-emerald-100/50 rounded-full">
                                📸 Dokumentasi
                            </span>
                            <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight">Galeri</h2>
                            <p class="text-slate-400 text-sm mt-1">Dokumentasi momen berharga desa</p>
                        </div>
                        <a href="{{ route('galeri') }}" class="group flex items-center gap-2 text-emerald-600 text-sm font-black hover:gap-3 transition-all">
                            LIHAT SEMUA <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                        </a>
                    </div>
                </div>
                
                <div class="p-6">
                    @if(isset($galeris) && $galeris->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($galeris as $g)
                            <div class="group relative rounded-2xl overflow-hidden shadow-md cursor-pointer" onclick="window.location.href='{{ route('galeri.show', $g->id_galeri) }}'">
                                <div class="h-44 overflow-hidden">
                                    <img src="{{ $g->gambar_galeri ? asset('storage/' . $g->gambar_galeri) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=300' }}" class="w-full h-full object-cover transition duration-700 group-hover:scale-110">
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                                    <p class="text-white text-xs font-bold">{{ $g->judul_galeri ?? 'Dokumentasi' }}</p>
                                </div>
                                <div class="absolute top-3 right-3 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300 scale-0 group-hover:scale-100 shadow-lg">
                                    <i class="fa-solid fa-expand text-white text-xs"></i>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12">
                            <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-regular fa-images text-3xl text-slate-400"></i>
                            </div>
                            <p class="text-slate-400">Belum ada galeri foto</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- 10. TUTORIAL SECTION PREMIUM --}}
        {{-- ============================================= --}}
        <div class="mb-16 bg-white rounded-[2.5rem] border border-slate-100 p-8 md:p-10 shadow-md hover:shadow-xl transition-all duration-500">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fa-regular fa-circle-question text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">📖 Panduan Pengguna</h3>
                    <p class="text-slate-400 text-sm mt-1">Panduan lengkap menggunakan layanan digital Desa Lumban Silintong</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">1</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">📄 <span>Ajukan Surat</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Pilih jenis surat, isi formulir, upload dokumen, dan kirim. Status akan muncul di dashboard.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">2</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">💬 <span>Sampaikan Aspirasi</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Sampaikan saran atau keluhan Anda. Admin desa akan merespon maksimal 3 hari.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">3</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">🔍 <span>Pantau Status</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Cek status pengajuan surat dan aspirasi Anda secara realtime di dashboard.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">4</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">📰 <span>Baca Berita</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Dapatkan informasi terbaru tentang kegiatan dan pengumuman desa.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">5</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">📊 <span>Visualisasi Data</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Lihat statistik penduduk desa melalui diagram interaktif yang dapat diatur.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">6</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">💡 <span>Butuh Bantuan?</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Hubungi admin desa melalui kontak yang tersedia di halaman Kontak.</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-6 flex items-start gap-4">
                <i class="fa-regular fa-lightbulb text-emerald-500 text-2xl mt-1"></i>
                <div>
                    <span class="font-black text-emerald-800">💡 <strong>Tips Penting:</strong></span>
                    <p class="text-emerald-700 text-sm mt-1">Pastikan data yang Anda masukkan valid dan sesuai dengan dokumen resmi. Untuk pengajuan surat, upload dokumen pendukung dengan format PDF/JPG maksimal 2MB.</p>
                </div>
            </div>
        </div>

        {{-- ============================================= --}}
        {{-- 11. CTA BANTUAN --}}
        {{-- ============================================= --}}
        <div class="bg-gradient-to-r from-emerald-600 to-teal-700 rounded-[2.5rem] p-10 text-center text-white shadow-xl relative overflow-hidden group">
            <div class="absolute top-0 right-0 opacity-10 group-hover:scale-110 transition-transform duration-700">
                <i class="fa-solid fa-headset text-8xl"></i>
            </div>
            <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/5 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
            <div class="relative z-10">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-5 animate-bounce">
                    <i class="fa-solid fa-headset text-3xl"></i>
                </div>
                <h3 class="text-3xl font-black mb-3">💬 Butuh Bantuan?</h3>
                <p class="text-emerald-100/80 mb-8 max-w-2xl mx-auto">Jika mengalami kendala dalam menggunakan layanan digital desa, silakan hubungi admin atau datang langsung ke kantor desa.</p>
                <div class="flex gap-5 justify-center flex-wrap">
                    <a href="{{ route('kontak') }}" class="group inline-flex items-center gap-2 px-8 py-4 bg-white text-emerald-700 rounded-full font-black text-sm tracking-wider hover:shadow-xl transition-all duration-300 hover:scale-105">
                        <i class="fa-regular fa-envelope group-hover:scale-110 transition"></i> HUBUNGI KAMI
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Script untuk Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk diagram
    const statistikDataMasyarakat = {
        penduduk: {
            labels: ['👨 Laki-laki', '👩 Perempuan', '🏠 Kepala Keluarga'],
            values: [{{ $statistik['penduduk_pria'] ?? 0 }}, {{ $statistik['penduduk_wanita'] ?? 0 }}, {{ $statistik['total_kk'] ?? 0 }}],
            colors: ['rgba(59, 130, 246, 0.85)', 'rgba(236, 72, 153, 0.85)', 'rgba(245, 158, 11, 0.85)'],
            borderColors: ['rgb(59, 130, 246)', 'rgb(236, 72, 153)', 'rgb(245, 158, 11)'],
            hoverColors: ['rgba(59, 130, 246, 1)', 'rgba(236, 72, 153, 1)', 'rgba(245, 158, 11, 1)'],
            title: '📊 Statistik Penduduk',
            unit: 'Jiwa'
        },
        umur: {
            labels: ['👶 0-14 tahun', '🧑 15-29 tahun', '👨 30-59 tahun', '👴 60+ tahun'],
            values: [{{ $statistik['kelompok_umur_0_14'] ?? 0 }}, {{ $statistik['kelompok_umur_15_29'] ?? 0 }}, {{ $statistik['kelompok_umur_30_59'] ?? 0 }}, {{ $statistik['kelompok_umur_60'] ?? 0 }}],
            colors: ['rgba(16, 185, 129, 0.85)', 'rgba(59, 130, 246, 0.85)', 'rgba(245, 158, 11, 0.85)', 'rgba(139, 92, 246, 0.85)'],
            borderColors: ['rgb(16, 185, 129)', 'rgb(59, 130, 246)', 'rgb(245, 158, 11)', 'rgb(139, 92, 246)'],
            hoverColors: ['rgba(16, 185, 129, 1)', 'rgba(59, 130, 246, 1)', 'rgba(245, 158, 11, 1)', 'rgba(139, 92, 246, 1)'],
            title: '📈 Kelompok Umur Penduduk',
            unit: 'Jiwa'
        }
    };

    let masyarakatHomeChart = null;
    let currentChartTypeMasyarakat = 'bar';
    let currentDataTypeMasyarakat = 'penduduk';

    function formatNumberMasyarakat(value) {
        if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
        if (value >= 1000) return (value / 1000).toFixed(1) + 'K';
        return value.toString();
    }

    function showLoadingMasyarakat() {
        const loading = document.getElementById('chartLoadingM');
        if (loading) {
            loading.classList.remove('opacity-0', 'invisible');
            loading.classList.add('opacity-100', 'visible');
        }
    }

    function hideLoadingMasyarakat() {
        const loading = document.getElementById('chartLoadingM');
        if (loading) {
            loading.classList.add('opacity-0', 'invisible');
            loading.classList.remove('opacity-100', 'visible');
        }
    }

    function updateChartMasyarakat(chartType, dataType) {
        showLoadingMasyarakat();
        
        setTimeout(() => {
            currentChartTypeMasyarakat = chartType;
            currentDataTypeMasyarakat = dataType;
            
            const data = statistikDataMasyarakat[dataType];
            if (!data) {
                hideLoadingMasyarakat();
                return;
            }
            
            const ctx = document.getElementById('masyarakatStatistikChart').getContext('2d');
            
            if (masyarakatHomeChart) {
                masyarakatHomeChart.destroy();
            }
            
            const isPieType = ['pie', 'doughnut'].includes(chartType);
            
            const baseOptions = {
                responsive: true,
                maintainAspectRatio: true,
                animation: {
                    duration: 1200,
                    easing: 'easeInOutQuart',
                    animateRotate: true,
                    animateScale: true
                },
                plugins: {
                    tooltip: {
                        backgroundColor: 'rgba(0, 0, 0, 0.9)',
                        titleColor: '#f3f4f6',
                        bodyColor: '#d1d5db',
                        borderColor: '#10b981',
                        borderWidth: 2,
                        cornerRadius: 12,
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                let value = context.raw;
                                let percentage = '';
                                if (isPieType && data.values.reduce((a, b) => a + b, 0) > 0) {
                                    percentage = ` (${((value / data.values.reduce((a, b) => a + b, 0)) * 100).toFixed(1)}%)`;
                                }
                                return `${label}: ${value.toLocaleString()} ${data.unit}${percentage}`;
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                        labels: {
                            usePointStyle: true,
                            boxWidth: 12,
                            boxHeight: 12,
                            padding: 15,
                            font: { size: 11, weight: 'bold', family: "'Inter', sans-serif" },
                            color: '#374151'
                        }
                    }
                }
            };
            
            if (!isPieType) {
                baseOptions.scales = {
                    y: {
                        beginAtZero: true,
                        grid: { color: 'rgba(0, 0, 0, 0.05)', drawBorder: false },
                        ticks: {
                            callback: function(value) { return formatNumberMasyarakat(value); },
                            font: { size: 11 }
                        },
                        title: {
                            display: true,
                            text: `📊 Jumlah (${data.unit})`,
                            font: { size: 11, weight: 'bold' }
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 12, weight: 'bold' } }
                    }
                };
            }
            
            if (isPieType) {
                masyarakatHomeChart = new Chart(ctx, {
                    type: chartType,
                    data: {
                        labels: data.labels,
                        datasets: [{
                            data: data.values,
                            backgroundColor: data.colors,
                            borderColor: '#fff',
                            borderWidth: 3,
                            hoverOffset: 20,
                            cutout: chartType === 'doughnut' ? '65%' : 0,
                            hoverBackgroundColor: data.hoverColors
                        }]
                    },
                    options: baseOptions
                });
            } else {
                masyarakatHomeChart = new Chart(ctx, {
                    type: chartType,
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: data.title,
                            data: data.values,
                            backgroundColor: chartType === 'line' ? 'rgba(16, 185, 129, 0.1)' : data.colors,
                            borderColor: chartType === 'line' ? '#10b981' : data.borderColors,
                            borderWidth: chartType === 'line' ? 3 : 1,
                            borderRadius: chartType === 'bar' ? 10 : 0,
                            tension: chartType === 'line' ? 0.4 : 0,
                            fill: chartType === 'line',
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#fff',
                            pointBorderWidth: 2,
                            pointRadius: chartType === 'line' ? 6 : 0,
                            pointHoverRadius: chartType === 'line' ? 10 : 0,
                            maxBarThickness: 80
                        }]
                    },
                    options: baseOptions
                });
            }
            
            hideLoadingMasyarakat();
        }, 300);
    }
    
    function quickChangeMasyarakat(chartType, dataType) {
        updateChartMasyarakat(chartType, dataType);
    }
    
    // Inisialisasi chart default
    document.addEventListener('DOMContentLoaded', function() {
        updateChartMasyarakat('bar', 'penduduk');
    });
    
    // Expose ke global
    window.updateChartMasyarakat = updateChartMasyarakat;
    window.quickChangeMasyarakat = quickChangeMasyarakat;
</script>
@endsection
