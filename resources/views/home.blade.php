{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda - Desa Digital Premium')

@section('content')
<style>
    /* ============================================ */
    /* ANIMATIONS & KEYFRAMES */
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
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slide-left {
        from { opacity: 0; transform: translateX(-30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slide-right {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes zoom-in {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    @keyframes count-up {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.05); }
    }
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    @keyframes bounce {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    /* ============================================ */
    /* UTILITY CLASSES */
    /* ============================================ */
    .floating { animation: float 3s ease-in-out infinite; }
    .floating-slow { animation: float-slow 4s ease-in-out infinite; }
    .pulse-glow { animation: pulse-glow 2s infinite; }
    .shine { position: relative; overflow: hidden; }
    .shine::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -60%;
        width: 200%;
        height: 200%;
        background: linear-gradient(115deg, rgba(255,255,255,0) 10%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 90%);
        transform: rotate(25deg);
        animation: shine 4s infinite;
    }
    .animate-pulse-slow { animation: pulse-slow 4s ease-in-out infinite; }
    .animate-spin-slow { animation: spin-slow 2s linear infinite; }
    .animate-bounce { animation: bounce 0.5s ease-in-out; }

    /* ============================================ */
    /* CARD STYLES */
    /* ============================================ */
    .stat-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slide-up 0.6s ease forwards;
        opacity: 0;
    }
    .stat-card:nth-child(1) { animation-delay: 0.05s; }
    .stat-card:nth-child(2) { animation-delay: 0.1s; }
    .stat-card:nth-child(3) { animation-delay: 0.15s; }
    .stat-card:nth-child(4) { animation-delay: 0.2s; }
    .stat-card:hover { transform: translateY(-10px) scale(1.02); }
    
    .service-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: zoom-in 0.6s ease forwards;
        opacity: 0;
    }
    .service-card:nth-child(1) { animation-delay: 0.1s; }
    .service-card:nth-child(2) { animation-delay: 0.2s; }
    .service-card:hover { transform: translateY(-12px) scale(1.02); box-shadow: 0 30px 50px -15px rgba(0,0,0,0.25); }
    
    .news-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slide-left 0.6s ease forwards;
        opacity: 0;
    }
    .news-card:nth-child(1) { animation-delay: 0.05s; }
    .news-card:nth-child(2) { animation-delay: 0.1s; }
    .news-card:nth-child(3) { animation-delay: 0.15s; }
    .news-card:nth-child(4) { animation-delay: 0.2s; }
    .news-card:hover { transform: translateX(8px) translateY(-5px); box-shadow: 0 20px 35px -12px rgba(0,0,0,0.15); }
    
    .gallery-item {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: zoom-in 0.5s ease forwards;
        opacity: 0;
    }
    .gallery-item:nth-child(1) { animation-delay: 0.05s; }
    .gallery-item:nth-child(2) { animation-delay: 0.1s; }
    .gallery-item:nth-child(3) { animation-delay: 0.15s; }
    .gallery-item:nth-child(4) { animation-delay: 0.2s; }
    .gallery-item:hover { transform: scale(1.05) rotate(1deg); box-shadow: 0 25px 40px -15px rgba(0,0,0,0.25); }
    
    .faq-item {
        transition: all 0.3s ease;
        animation: slide-right 0.5s ease forwards;
        opacity: 0;
    }
    .faq-item:nth-child(1) { animation-delay: 0.05s; }
    .faq-item:nth-child(2) { animation-delay: 0.1s; }
    .faq-item:nth-child(3) { animation-delay: 0.15s; }
    .faq-item:hover { background-color: #f0fdf4; transform: translateX(5px); }
    
    /* ============================================ */
    /* HERO SLIDER */
    /* ============================================ */
    .slider-container { border-radius: 40px; overflow: hidden; position: relative; box-shadow: 0 40px 80px rgba(0,0,0,0.15); }
    .slider-wrapper { display: flex; transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1); }
    .slide { min-width: 100%; height: 85vh; position: relative; }
    .slide-content { 
        position: absolute; inset: 0; 
        background: linear-gradient(105deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.3) 50%, transparent 100%);
        display: flex; flex-direction: column; justify-content: center; padding-left: 8%; color: white;
    }
    
    /* ============================================ */
    /* PREMIUM BUTTONS */
    /* ============================================ */
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
    .btn-premium:hover { transform: translateY(-3px) scale(1.02); background: #10b981; box-shadow: 0 15px 35px rgba(16, 185, 129, 0.4); }
    
    .btn-outline-premium {
        background: transparent; border: 2px solid rgba(255,255,255,0.5);
        backdrop-filter: blur(10px); padding: 14px 32px; border-radius: 50px;
        font-weight: 600; transition: 0.3s;
    }
    .btn-outline-premium:hover { background: rgba(255,255,255,0.2); border-color: white; transform: translateY(-2px); }
    
    /* ============================================ */
    /* LOCKED CARD (UNTUK GUEST) */
    /* ============================================ */
    .locked-card {
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    .locked-card .locked-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
        z-index: 20;
    }
    .locked-card:hover .locked-overlay {
        opacity: 1;
    }
    .locked-card .locked-content {
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }
    .locked-card:hover .locked-content {
        transform: scale(1);
    }
    
    /* ============================================ */
    /* STAT CARD PREMIUM */
    /* ============================================ */
    .stat-card-premium {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    .stat-card-premium:hover::before {
        left: 100%;
    }
    .stat-card-premium:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 40px -15px rgba(0, 0, 0, 0.2);
    }
    
    /* ============================================ */
    /* CHART CONTAINER & OPTIONS */
    /* ============================================ */
    .chart-container {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .chart-container:hover {
        transform: translateY(-4px);
        box-shadow: 0 30px 50px -20px rgba(16, 185, 129, 0.3);
    }
    
    .chart-option {
        position: relative;
        overflow: hidden;
    }
    .chart-option::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .chart-option:hover::before {
        width: 300px;
        height: 300px;
    }
    
    .setting-btn {
        position: relative;
        overflow: hidden;
    }
    .setting-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .setting-btn:hover::before {
        width: 400px;
        height: 400px;
    }
    
    .data-option {
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .data-option:hover {
        transform: translateX(5px);
    }
    
    /* Quick Card */
    .quick-card {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .quick-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #10b981, #059669);
        transition: width 0.3s ease;
    }
    .quick-card:hover::after {
        width: 100%;
    }
    .quick-card:hover {
        transform: translateY(-5px) scale(1.05);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
    }
    
    /* FAQ STYLES */
    .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s ease-out; }
    .faq-item.active .faq-answer { max-height: 400px; transition: max-height 0.4s ease-in; }
    .faq-item.active .faq-icon { transform: rotate(180deg); }
    
    /* LINE CLAMP */
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
    
    /* SCROLLBAR */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #10b981, #059669); border-radius: 10px; }
    
    [x-cloak] { display: none !important; }
</style>

{{-- ============================================= --}}
{{-- 1. HERO SLIDER PREMIUM --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="slider-container group" x-data="{ slide: 0, totalSlides: 6 }" x-init="setInterval(() => slide = (slide + 1) % totalSlides, 6000)">
        <div class="slider-wrapper" :style="'transform: translateX(-' + (slide * 100) + '%)'">
            @php
                $hero = [
                    ['t' => 'Peradaban Digital Lumban Silintong', 'd' => 'Menyatukan teknologi dengan kearifan lokal Toba.', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', 'badge' => '✨ Smart Village'],
                    ['t' => 'UMKM Naik Kelas Menuju Global', 'd' => 'Mendorong ekonomi kreatif warga semakin kompetitif.', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b', 'badge' => '🚀 Ekonomi Kreatif'],
                    ['t' => 'Harmonisasi Alam Danau Toba', 'd' => 'Menjaga kelestarian pesisir untuk generasi masa depan.', 'img' => 'https://images.unsplash.com/photo-1533105079780-92b9be482077', 'badge' => '🌿 Ekowisata'],
                    ['t' => 'Pelayanan Publik Satu Genggaman', 'd' => 'Akses administrasi kini lebih cepat dan transparan.', 'img' => 'https://images.unsplash.com/photo-1472214103451-9374bd1c798e', 'badge' => '📱 E-Government'],
                    ['t' => 'Budaya Batak Yang Mendunia', 'd' => 'Melestarikan adat istiadat di tengah modernisasi.', 'img' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470', 'badge' => '🎭 Kearifan Lokal'],
                    ['t' => 'Lumban Silintong Excellence', 'd' => 'Bersama membangun desa cerdas (Smart Village).', 'img' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e', 'badge' => '🏆 Smart Village'],
                ];
            @endphp
            @foreach($hero as $h)
            <div class="slide">
                <img src="{{ $h['img'] }}?auto=format&fit=crop&q=80&w=2070" class="absolute inset-0 w-full h-full object-cover brightness-[0.6]">
                <div class="slide-content">
                    <span class="inline-block px-5 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-xs font-bold rounded-full mb-5 tracking-wide shadow-lg animate-pulse">{{ $h['badge'] }}</span>
                    <h2 class="text-5xl md:text-7xl font-serif italic mb-5 leading-tight">{{ $h['t'] }}</h2>
                    <p class="text-lg md:text-2xl font-light italic opacity-95 max-w-2xl">{{ $h['d'] }}</p>
                    <div class="mt-10 flex flex-wrap gap-4">
                        <a href="#layanan-publik" class="btn-premium">✨ Layanan Publik</a>
                        <a href="#berita" class="btn-outline-premium">📖 Pelajari →</a>
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
{{-- 2. WELCOME SECTION DENGAN STATISTIK PREMIUM --}}
{{-- ============================================= --}}
<section class="px-[5%] py-16 bg-gradient-to-br from-emerald-50 via-white to-emerald-50/30 rounded-[60px] mx-[5%] mb-20 shadow-sm">
    <div class="text-center max-w-3xl mx-auto mb-14">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">✨ Selamat Datang</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-5">Desa Lumban Silintong</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-6 rounded-full"></div>
        <p class="text-gray-600 mt-6 leading-relaxed text-lg">Desa digital yang mengintegrasikan teknologi modern dengan kearifan lokal Batak Toba. Kami hadir untuk memberikan pelayanan terbaik bagi seluruh warga.</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="stat-card-premium text-center p-6 bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-emerald-100 group">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-all duration-300 group-hover:shadow-emerald-500/30">
                <i class="fa-solid fa-users text-white text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-emerald-700 counter">{{ $stat_penduduk }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1 font-semibold">Total Penduduk</p>
        </div>
        <div class="stat-card-premium text-center p-6 bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-blue-100 group">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-all duration-300 group-hover:shadow-blue-500/30">
                <i class="fa-solid fa-house-user text-white text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-blue-700 counter">{{ $stat_kk }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1 font-semibold">Kepala Keluarga</p>
        </div>
        <div class="stat-card-premium text-center p-6 bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-amber-100 group">
            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-all duration-300 group-hover:shadow-amber-500/30">
                <i class="fa-solid fa-store text-white text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-amber-700 counter">{{ $stat_umkm_count }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1 font-semibold">UMKM Aktif</p>
        </div>
        <div class="stat-card-premium text-center p-6 bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-purple-100 group">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition-all duration-300 group-hover:shadow-purple-500/30">
                <i class="fa-solid fa-map text-white text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-purple-700">{{ $stat_luas }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1 font-semibold">Luas Wilayah (Ha)</p>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 3. STATISTIK DENGAN DIAGRAM PREMIUM --}}
{{-- ============================================= --}}
<section class="px-[5%] py-16 bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 rounded-[60px] mx-[5%] mb-20 shadow-xl">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-8 gap-4">
        <div>
            <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block shadow-sm">📊 Data Statistik</span>
            <h2 class="text-4xl md:text-5xl font-serif italic text-emerald-900 mt-4">Visualisasi Data Penduduk</h2>
            <p class="text-gray-500 text-sm mt-2">Data realtime dari database desa</p>
        </div>
        
        {{-- Tombol Setting Premium --}}
        <div class="w-full md:w-auto" x-data="{ 
            settingOpen: false, 
            chartType: 'bar', 
            dataType: 'penduduk'
        }">
            <button @click="settingOpen = !settingOpen" class="setting-btn group flex items-center justify-center gap-2 px-4 py-2.5 md:px-6 md:py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 text-sm md:text-base w-full md:w-auto">
                <i class="fa-solid fa-sliders-h text-xs md:text-sm group-hover:rotate-90 transition-transform duration-500"></i>
                <span class="font-semibold">Pengaturan Diagram</span>
                <i class="fa-solid fa-chevron-down text-xs transition-all duration-300" :class="settingOpen ? 'rotate-180' : ''"></i>
            </button>
            
            <div x-show="settingOpen" @click.away="settingOpen = false" x-cloak 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="mt-3 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 overflow-hidden z-50 w-full md:w-[480px]">
                
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-4 md:px-5 py-3 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-white text-sm md:text-base"><i class="fa-solid fa-chart-simple mr-2"></i> Customize Chart</h3>
                        <p class="text-[9px] md:text-[10px] text-emerald-100">Sesuaikan tampilan diagram sesuai kebutuhan</p>
                    </div>
                    <button @click="settingOpen = false" class="text-white/80 hover:text-white transition-transform hover:rotate-90 duration-300">
                        <i class="fa-solid fa-times text-lg"></i>
                    </button>
                </div>
                
                <div class="p-4 md:p-5">
                    <div class="mb-5 md:mb-6">
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-wider mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-chart-line text-emerald-500"></i> Jenis Diagram
                        </label>
                        <div class="grid grid-cols-2 gap-2 md:gap-3">
                            <button @click="chartType = 'bar'; updateChart(chartType, dataType); settingOpen = false" class="chart-option group px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300" :class="chartType === 'bar' ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg scale-105' : 'bg-gray-100 text-gray-600 hover:bg-emerald-100 hover:scale-105'">
                                <i class="fa-solid fa-chart-bar mr-1 md:mr-2"></i> Bar Chart
                                <div x-show="chartType === 'bar'" class="w-full h-0.5 bg-white/50 mt-1 rounded-full animate-pulse"></div>
                            </button>
                            <button @click="chartType = 'line'; updateChart(chartType, dataType); settingOpen = false" class="chart-option group px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300" :class="chartType === 'line' ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg scale-105' : 'bg-gray-100 text-gray-600 hover:bg-emerald-100 hover:scale-105'">
                                <i class="fa-solid fa-chart-line mr-1 md:mr-2"></i> Line Chart
                                <div x-show="chartType === 'line'" class="w-full h-0.5 bg-white/50 mt-1 rounded-full animate-pulse"></div>
                            </button>
                            <button @click="chartType = 'pie'; updateChart(chartType, dataType); settingOpen = false" class="chart-option group px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300" :class="chartType === 'pie' ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg scale-105' : 'bg-gray-100 text-gray-600 hover:bg-emerald-100 hover:scale-105'">
                                <i class="fa-solid fa-chart-pie mr-1 md:mr-2"></i> Pie Chart
                                <div x-show="chartType === 'pie'" class="w-full h-0.5 bg-white/50 mt-1 rounded-full animate-pulse"></div>
                            </button>
                            <button @click="chartType = 'doughnut'; updateChart(chartType, dataType); settingOpen = false" class="chart-option group px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300" :class="chartType === 'doughnut' ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg scale-105' : 'bg-gray-100 text-gray-600 hover:bg-emerald-100 hover:scale-105'">
                                <i class="fa-solid fa-chart-simple mr-1 md:mr-2"></i> Donut Chart
                                <div x-show="chartType === 'doughnut'" class="w-full h-0.5 bg-white/50 mt-1 rounded-full animate-pulse"></div>
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-[10px] font-black uppercase text-gray-400 tracking-wider mb-3 flex items-center gap-2">
                            <i class="fa-solid fa-database text-emerald-500"></i> Kategori Data
                        </label>
                        <div class="space-y-2">
                            <button @click="dataType = 'penduduk'; updateChart(chartType, dataType); settingOpen = false" class="data-option w-full px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300 text-left flex items-center justify-between group" :class="dataType === 'penduduk' ? 'bg-gradient-to-r from-emerald-50 to-emerald-100 text-emerald-700 border-l-4 border-emerald-500 shadow-md' : 'bg-gray-50 text-gray-600 hover:bg-emerald-50'">
                                <span class="flex items-center gap-2 md:gap-3">
                                    <i class="fa-solid fa-users text-base md:text-lg" :class="dataType === 'penduduk' ? 'text-emerald-500' : 'text-gray-400'"></i>
                                    <div>
                                        <p class="font-semibold text-xs md:text-sm">📊 Statistik Penduduk</p>
                                        <p class="text-[8px] md:text-[10px] text-gray-400">Laki-laki, Perempuan, Kepala Keluarga</p>
                                    </div>
                                </span>
                                <i x-show="dataType === 'penduduk'" class="fa-solid fa-check-circle text-emerald-500 text-sm md:text-xl animate-bounce"></i>
                            </button>
                            <button @click="dataType = 'umur'; updateChart(chartType, dataType); settingOpen = false" class="data-option w-full px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300 text-left flex items-center justify-between group" :class="dataType === 'umur' ? 'bg-gradient-to-r from-emerald-50 to-emerald-100 text-emerald-700 border-l-4 border-emerald-500 shadow-md' : 'bg-gray-50 text-gray-600 hover:bg-emerald-50'">
                                <span class="flex items-center gap-2 md:gap-3">
                                    <i class="fa-solid fa-chart-line text-base md:text-lg" :class="dataType === 'umur' ? 'text-emerald-500' : 'text-gray-400'"></i>
                                    <div>
                                        <p class="font-semibold text-xs md:text-sm">📈 Kelompok Umur</p>
                                        <p class="text-[8px] md:text-[10px] text-gray-400">0-14, 15-29, 30-59, 60+ tahun</p>
                                    </div>
                                </span>
                                <i x-show="dataType === 'umur'" class="fa-solid fa-check-circle text-emerald-500 text-sm md:text-xl animate-bounce"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="bg-gradient-to-r from-gray-50 to-gray-100 px-4 md:px-5 py-3 border-t border-gray-100">
                    <p class="text-[9px] md:text-[10px] text-gray-400 text-center flex items-center justify-center gap-2 flex-wrap">
                        <i class="fa-solid fa-sync-alt text-emerald-500 animate-spin-slow"></i> Data diupdate secara realtime
                        <i class="fa-solid fa-magic text-purple-500"></i> Premium Visualization
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="chart-container bg-gradient-to-br from-white to-gray-50 rounded-2xl p-4 md:p-8 mb-6 shadow-xl border border-gray-100 relative overflow-hidden group transition-all duration-500 hover:shadow-2xl">
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 via-transparent to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        <div class="absolute top-0 right-0 w-64 md:w-96 h-64 md:h-96 bg-gradient-to-br from-emerald-400/10 to-transparent rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-0 w-48 md:w-64 h-48 md:h-64 bg-gradient-to-tr from-blue-400/5 to-transparent rounded-full blur-2xl"></div>
        
        <div id="chartLoading" class="absolute inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center z-10 opacity-0 invisible transition-all duration-300 rounded-2xl">
            <div class="flex flex-col items-center gap-3">
                <div class="w-10 h-10 md:w-12 md:h-12 border-4 border-emerald-200 border-t-emerald-600 rounded-full animate-spin"></div>
                <p class="text-xs md:text-sm text-emerald-600 font-semibold">Memuat diagram...</p>
            </div>
        </div>
        
        <canvas id="homeStatistikChart" width="800" height="450" style="max-height: 450px; width: 100%; position: relative; z-index: 1;"></canvas>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mt-6">
        <div class="quick-card bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl p-2 md:p-3 text-center hover:scale-105 transition-all duration-300 cursor-pointer border border-blue-200 shadow-sm group" onclick="quickChange('bar', 'penduduk')">
            <div class="flex items-center justify-center gap-1 md:gap-2">
                <i class="fa-solid fa-venus-mars text-blue-500 text-xs md:text-base group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] md:text-xs font-semibold text-gray-600">Jenis Kelamin</span>
            </div>
            <p class="text-base md:text-lg font-bold text-blue-600">{{ number_format($penduduk_pria + $penduduk_wanita) }}</p>
            <p class="text-[8px] md:text-[9px] text-gray-400">Total Jiwa</p>
        </div>
        <div class="quick-card bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-xl p-2 md:p-3 text-center hover:scale-105 transition-all duration-300 cursor-pointer border border-emerald-200 shadow-sm group" onclick="quickChange('pie', 'penduduk')">
            <div class="flex items-center justify-center gap-1 md:gap-2">
                <i class="fa-solid fa-chart-pie text-emerald-500 text-xs md:text-base group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] md:text-xs font-semibold text-gray-600">Komposisi</span>
            </div>
            <p class="text-base md:text-lg font-bold text-emerald-600">{{ $penduduk_pria }} : {{ $penduduk_wanita }}</p>
            <p class="text-[8px] md:text-[9px] text-gray-400">Pria : Wanita</p>
        </div>
        <div class="quick-card bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-xl p-2 md:p-3 text-center hover:scale-105 transition-all duration-300 cursor-pointer border border-purple-200 shadow-sm group" onclick="quickChange('bar', 'umur')">
            <div class="flex items-center justify-center gap-1 md:gap-2">
                <i class="fa-solid fa-calendar-week text-purple-500 text-xs md:text-base group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] md:text-xs font-semibold text-gray-600">Produktif</span>
            </div>
            <p class="text-base md:text-lg font-bold text-purple-600">{{ number_format($kelompok_umur_15_29 + $kelompok_umur_30_59) }}</p>
            <p class="text-[8px] md:text-[9px] text-gray-400">Usia Produktif</p>
        </div>
        <div class="quick-card bg-gradient-to-br from-amber-50 to-amber-100/50 rounded-xl p-2 md:p-3 text-center hover:scale-105 transition-all duration-300 cursor-pointer border border-amber-200 shadow-sm group" onclick="quickChange('doughnut', 'umur')">
            <div class="flex items-center justify-center gap-1 md:gap-2">
                <i class="fa-solid fa-chart-simple text-amber-500 text-xs md:text-base group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] md:text-xs font-semibold text-gray-600">Rasio</span>
            </div>
            <p class="text-base md:text-lg font-bold text-amber-600">{{ number_format(($kelompok_umur_0_14 / max($kelompok_umur_60, 1)) * 100, 1) }}%</p>
            <p class="text-[8px] md:text-[9px] text-gray-400">Rasio Anak vs Lansia</p>
        </div>
    </div>
    
    <div class="text-center text-[10px] md:text-xs text-gray-400 mt-6 flex items-center justify-center gap-2 md:gap-4 flex-wrap">
        <span class="flex items-center gap-1 px-2 md:px-3 py-1 bg-emerald-50 rounded-full"><i class="fa-solid fa-chart-simple text-emerald-500 text-xs"></i> Klik "Pengaturan Diagram"</span>
        <span class="flex items-center gap-1 px-2 md:px-3 py-1 bg-blue-50 rounded-full"><i class="fa-solid fa-chart-line text-blue-500 text-xs"></i> Hover untuk detail</span>
        <span class="flex items-center gap-1 px-2 md:px-3 py-1 bg-purple-50 rounded-full"><i class="fa-solid fa-arrow-pointer text-purple-500 text-xs"></i> Klik card untuk akses cepat</span>
    </div>
</section>

{{-- ============================================= --}}
{{-- 4. LAYANAN PUBLIK (Terbuka untuk semua) --}}
{{-- ============================================= --}}
<section id="layanan-publik" class="py-20 px-[5%] bg-gradient-to-br from-emerald-50/30 to-white rounded-[80px] mx-[5%] mb-20">
    <div class="text-center mb-14">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">📋 AKSES MUDAH</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-5">Layanan Publik</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-6 rounded-full"></div>
        <p class="text-gray-500 mt-5 max-w-2xl mx-auto">Akses berbagai layanan informasi desa secara mudah dan cepat. Pilih menu di bawah untuk menjelajahi konten desa.</p>
    </div>
    
    <div class="grid md:grid-cols-5 gap-6 max-w-6xl mx-auto">
        <a href="{{ route('profil-desa') }}" class="service-card group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-emerald-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-landmark-dome text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">Profil Desa</h3>
                <p class="text-xs text-gray-400">Sejarah & Struktur</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>
        <a href="{{ route('berita') }}" class="service-card group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-newspaper text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">Berita</h3>
                <p class="text-xs text-gray-400">Info & Pengumuman</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>
        <a href="{{ route('galeri') }}" class="service-card group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-purple-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-photo-film text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">Galeri</h3>
                <p class="text-xs text-gray-400">Dokumentasi Kegiatan</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>
        <a href="{{ route('umkm') }}" class="service-card group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500 to-amber-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-shop text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">UMKM</h3>
                <p class="text-xs text-gray-400">Produk Unggulan</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>
        <a href="{{ route('kontak') }}" class="service-card group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-500 to-rose-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-envelope text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">Kontak</h3>
                <p class="text-xs text-gray-400">Hubungi Kami</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>
        </a>
    </div>
</section>

{{-- ============================================= --}}
{{-- 5. LAYANAN DIGITAL (TERKUNCI - BUTUH LOGIN) --}}
{{-- ============================================= --}}
<section class="py-20 px-[5%] bg-gradient-to-r from-stone-100 to-white rounded-[80px] mx-[5%] mb-20">
    <div class="text-center mb-14">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">⚡ Akses Cepat</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-5">Layanan Digital Desa</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-6 rounded-full"></div>
        <p class="text-gray-500 mt-5 max-w-2xl mx-auto">Akses layanan administrasi secara online. <span class="text-emerald-600 font-semibold">Login terlebih dahulu</span> untuk menggunakan layanan berikut.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        {{-- Layanan Ajukan Surat (Terkunci) --}}
        <div class="locked-card group relative bg-white rounded-2xl overflow-hidden shadow-xl cursor-pointer" onclick="window.location='{{ route('login') }}'">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-emerald-600 opacity-0 group-hover:opacity-5 transition duration-500"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
            <div class="relative z-10 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <i class="fa-solid fa-file-signature text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif italic text-emerald-800 mb-2">Ajukan Surat</h3>
                        <p class="text-gray-500 text-sm">Domisili, Usaha, Tidak Mampu, Kelahiran, Kematian, dan 12 jenis lainnya.</p>
                        <div class="mt-5 flex items-center gap-2 text-emerald-600 text-sm font-semibold group-hover:gap-3 transition-all">
                            <span>Ajukan Sekarang</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                        </div>
                    </div>
                    <div class="text-5xl text-emerald-100 group-hover:text-emerald-200 transition group-hover:scale-110 duration-300">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-black/60 to-emerald-900/60 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 z-20 locked-overlay">
                <div class="bg-white/95 backdrop-blur-md px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 locked-content">
                    <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-lock text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-emerald-600 uppercase tracking-wider">Terautentikasi</p>
                        <p class="text-xs text-gray-500">Login untuk mengakses</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Layanan Aspirasi (Terkunci) --}}
        <div class="locked-card group relative bg-white rounded-2xl overflow-hidden shadow-xl cursor-pointer" onclick="window.location='{{ route('login') }}'">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-5 transition duration-500"></div>
            <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-700"></div>
            <div class="relative z-10 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                            <i class="fa-solid fa-comment-dots text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif italic text-emerald-800 mb-2">Aspirasi & Keluhan</h3>
                        <p class="text-gray-500 text-sm">Sampaikan suara, saran, atau keluhan Anda langsung ke jajaran perangkat desa.</p>
                        <div class="mt-5 flex items-center gap-2 text-emerald-600 text-sm font-semibold group-hover:gap-3 transition-all">
                            <span>Sampaikan Aspirasi</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                        </div>
                    </div>
                    <div class="text-5xl text-blue-100 group-hover:text-blue-200 transition group-hover:scale-110 duration-300">
                        <i class="fa-solid fa-message"></i>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-black/60 to-blue-900/60 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 z-20 locked-overlay">
                <div class="bg-white/95 backdrop-blur-md px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3 locked-content">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-700 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-lock text-white text-sm"></i>
                    </div>
                    <div>
                        <p class="text-[10px] font-black text-blue-600 uppercase tracking-wider">Terautentikasi</p>
                        <p class="text-xs text-gray-500">Login untuk mengirim</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 6. PROFIL DESA PREVIEW --}}
{{-- ============================================= --}}
<section class="py-20 px-[5%] bg-gradient-to-br from-emerald-900/5 to-transparent rounded-[80px] mx-[5%] mb-20">
    <div class="grid lg:grid-cols-2 gap-16 items-center">
        <div class="relative" data-aos="fade-right">
            <div class="grid grid-cols-2 gap-5">
                <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=500" class="rounded-3xl h-80 w-full object-cover shadow-xl border-4 border-white">
                <div class="mt-12">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=500" class="rounded-3xl h-64 w-full object-cover shadow-xl border-4 border-white">
                </div>
            </div>
            <div class="absolute -bottom-6 -left-6 bg-gradient-to-r from-emerald-500 to-emerald-700 text-white p-5 rounded-2xl shadow-xl">
                <p class="text-3xl font-bold">1920</p>
                <p class="text-xs opacity-90">Tahun Berdiri</p>
            </div>
        </div>
        <div data-aos="fade-left">
            <span class="text-emerald-500 font-black tracking-[0.4em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">🏛️ Tentang Desa</span>
            <h2 class="text-5xl md:text-6xl font-serif italic mb-6 leading-tight mt-5 text-emerald-900">Jejak Langkah <br> Tanah Leluhur</h2>
            <p class="text-gray-600 leading-loose mb-8">Desa Lumban Silintong terletak di pesisir Danau Toba, Kecamatan Balige, Kabupaten Toba, Sumatera Utara. Desa ini memiliki sejarah panjang sebagai pusat kebudayaan Batak Toba yang kaya akan adat istiadat dan kearifan lokal.</p>
            <div class="flex flex-wrap gap-3 mb-8">
                <div class="flex items-center gap-2 bg-white px-4 py-2.5 rounded-xl shadow-sm border border-emerald-100">
                    <i class="fa-solid fa-landmark text-emerald-500 text-lg"></i>
                    <span class="text-sm font-semibold text-gray-700">Budaya Batak</span>
                </div>
                <div class="flex items-center gap-2 bg-white px-4 py-2.5 rounded-xl shadow-sm border border-emerald-100">
                    <i class="fa-solid fa-cloud-arrow-up text-emerald-500 text-lg"></i>
                    <span class="text-sm font-semibold text-gray-700">Digitalisasi</span>
                </div>
                <div class="flex items-center gap-2 bg-white px-4 py-2.5 rounded-xl shadow-sm border border-emerald-100">
                    <i class="fa-solid fa-leaf text-emerald-500 text-lg"></i>
                    <span class="text-sm font-semibold text-gray-700">Ekowisata</span>
                </div>
            </div>
            <a href="{{ route('profil-desa') }}" class="inline-flex items-center gap-2 text-emerald-600 font-semibold hover:gap-3 transition-all duration-300 bg-emerald-50 px-6 py-3 rounded-full">
                Pelajari Lebih Lanjut <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 7. BERITA TERKINI & PENGUMUMAN --}}
{{-- ============================================= --}}
<section id="berita" class="py-20 px-[5%] bg-gradient-to-br from-stone-100 to-white rounded-[80px] mx-[5%] mb-20">
    <div class="grid lg:grid-cols-12 gap-12">
        <div class="lg:col-span-8">
            <div class="flex justify-between items-end mb-12 flex-wrap gap-4">
                <div>
                    <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">📰 Update Terkini</span>
                    <h2 class="text-4xl md:text-5xl font-serif italic text-emerald-900 mt-4">Warta Utama</h2>
                </div>
                <a href="{{ route('berita') }}" class="text-[10px] font-black uppercase text-emerald-600 border-b-2 border-emerald-500 pb-2 hover:pb-1 transition-all">Semua Berita →</a>
            </div>
            @if(isset($beritas) && count($beritas) > 0)
                <div class="grid md:grid-cols-2 gap-8">
                    @foreach($beritas as $berita)
                    <div class="news-card group cursor-pointer bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                        <div class="rounded-t-2xl overflow-hidden h-56 relative">
                            <img src="{{ $berita->foto ? asset('storage/' . $berita->foto) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=500' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider text-emerald-700">{{ $berita->kategori }}</div>
                        </div>
                        <div class="p-5">
                            <h4 class="text-xl font-serif italic text-emerald-800 group-hover:text-emerald-500 transition line-clamp-2">{{ $berita->judul }}</h4>
                            <p class="text-sm text-gray-500 mt-2 leading-relaxed line-clamp-2">{{ $berita->ringkasan }}</p>
                            <div class="mt-4 flex items-center gap-4 text-xs text-gray-400">
                                <span><i class="fa-regular fa-calendar mr-1"></i> {{ $berita->created_at->translatedFormat('d M Y') }}</span>
                                <span><i class="fa-regular fa-eye mr-1"></i> {{ number_format($berita->dibaca ?? rand(50,500)) }} dibaca</span>
                            </div>
                        </div>
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
            <div class="bg-white rounded-2xl p-6 shadow-md sticky top-24">
                <h3 class="text-2xl font-serif italic mb-5 text-emerald-800 flex items-center gap-2">
                    <i class="fa-solid fa-bullhorn text-emerald-500"></i> Pengumuman
                </h3>
                @if(isset($pengumumans) && count($pengumumans) > 0)
                    <div class="space-y-4">
                        @foreach($pengumumans as $p)
                        <div class="border-l-4 border-emerald-400 pl-4 py-2 hover:bg-emerald-50/50 rounded-r-lg transition">
                            <span class="text-[9px] font-black text-emerald-500 tracking-wider">{{ $p->created_at->translatedFormat('d M Y') }}</span>
                            <h5 class="text-base font-bold text-gray-700 mt-1">{{ $p->judul }}</h5>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-10">
                        <p class="italic text-sm text-gray-400">Tidak ada pengumuman aktif.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 8. APARATUR DESA --}}
{{-- ============================================= --}}
<section class="py-20 px-[5%] overflow-hidden">
    <div class="text-center mb-14">
        <span class="text-emerald-500 font-black tracking-[0.5em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">👥 Pelayan Masyarakat</span>
        <h2 class="text-5xl md:text-6xl font-serif italic mt-5 text-emerald-900">Struktur Aparatur</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-6 rounded-full"></div>
    </div>
    <div class="flex gap-8 overflow-x-auto pb-8 snap-x no-scrollbar justify-center">
        @if(isset($aparaturs) && count($aparaturs) > 0)
            @foreach($aparaturs as $a)
            <div class="snap-center shrink-0 w-72 group">
                <div class="rounded-2xl overflow-hidden h-[400px] mb-5 grayscale group-hover:grayscale-0 transition duration-500 shadow-xl relative">
                    <img src="{{ $a->foto ? asset('storage/' . $a->foto) : 'https://randomuser.me/api/portraits/men/1.jpg' }}" class="w-full h-full object-cover">
                    <div class="absolute inset-x-0 bottom-0 p-5 bg-gradient-to-t from-emerald-900 to-transparent text-white opacity-0 group-hover:opacity-100 transition duration-300">
                        <p class="text-xs italic opacity-90">"Melayani dengan integritas dan digitalisasi."</p>
                    </div>
                </div>
                <h5 class="text-2xl font-serif italic text-emerald-800 text-center">{{ $a->nama }}</h5>
                <p class="text-[10px] font-black uppercase text-emerald-500 tracking-wider mt-1 text-center">{{ $a->jabatan }}</p>
            </div>
            @endforeach
        @else
            @for($i=1; $i<=4; $i++)
            <div class="snap-center shrink-0 w-72 opacity-50">
                <div class="rounded-2xl bg-slate-100 h-[400px] mb-5 flex items-center justify-center text-4xl"><i class="fa-solid fa-user-tie text-gray-300"></i></div>
                <div class="h-5 bg-slate-100 rounded-full w-3/4 mb-2 mx-auto"></div>
                <div class="h-3 bg-slate-100 rounded-full w-1/2 mx-auto"></div>
            </div>
            @endfor
        @endif
    </div>
</section>

{{-- ============================================= --}}
{{-- 9. UMKM PREVIEW --}}
{{-- ============================================= --}}
<section id="umkm" class="py-20 px-[5%] bg-gradient-to-br from-amber-50/50 to-white rounded-[80px] mx-[5%] mb-20">
    <div class="flex justify-between items-end mb-12 flex-wrap gap-4">
        <div>
            <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">🛍️ Belanja Lokal</span>
            <h2 class="text-4xl md:text-5xl font-serif italic text-emerald-900 mt-4">Pasar Digital <br> Lokal Premium</h2>
        </div>
        <a href="{{ route('umkm') }}" class="text-[10px] font-black uppercase text-emerald-600 border-b-2 border-emerald-500 pb-2 hover:pb-1 transition-all">Lihat Katalog →</a>
    </div>
    @if(isset($umkms) && count($umkms) > 0)
        <div class="grid lg:grid-cols-3 md:grid-cols-2 gap-8">
            @foreach($umkms as $u)
            <div class="group cursor-pointer bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up">
                <div class="relative h-72 overflow-hidden">
                    <img src="{{ $u->logo ? asset('storage/' . $u->logo) : 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=500' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-md px-4 py-2 rounded-xl shadow-md">
                      <span class="text-lg font-black text-emerald-700">Rp {{ number_format(optional(optional($u->produk)->first())->harga ?? 0, 0, ',', '.') }}</span>
                    </div>
                    <div class="absolute top-4 right-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-3 py-1 rounded-full text-[9px] font-bold shadow-md">⭐ UMKM Unggulan</div>
                </div>
                <div class="p-5">
                    <h4 class="text-xl font-serif italic text-emerald-800">{{ $u->nama_usaha }}</h4>
                    <p class="text-[9px] font-black uppercase text-emerald-500 tracking-[0.3em] mt-2">{{ ucfirst($u->kategori) }}</p>
                </div>
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

{{-- ============================================= --}}
{{-- 10. GALERI KEGIATAN --}}
{{-- ============================================= --}}
<section id="galeri" class="py-20 px-[5%]">
    <div class="text-center mb-14">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">📸 Momen Berharga</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-5">Dokumentasi Kegiatan</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-6 rounded-full"></div>
    </div>
    @if(isset($galeris) && count($galeris) > 0)
        <div class="grid md:grid-cols-4 gap-5">
            @foreach($galeris as $g)
                <div class="gallery-item h-72 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:scale-95">
                    <img src="{{ $g->gambar_galeri ? asset('storage/' . $g->gambar_galeri) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=300' }}" class="w-full h-full object-cover hover:scale-110 transition duration-500">
                </div>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('galeri') }}" class="inline-flex items-center gap-2 text-emerald-600 font-semibold hover:gap-3 transition-all duration-300 bg-emerald-50 px-6 py-3 rounded-full">
                Lihat Semua Galeri <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    @else
        <div class="empty-state">
            <p class="italic">Belum ada foto kegiatan desa yang diunggah.</p>
        </div>
    @endif
</section>

{{-- ============================================= --}}
{{-- 11. ASPIRASI PUBLIK (SEMUA ASPIRASI) --}}
{{-- ============================================= --}}
<section class="px-[5%] py-16 mb-20">
    <div class="text-center mb-12">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">💬 Aspirasi Warga</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-4">Suara Warga</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-5 rounded-full"></div>
        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Aspirasi, saran, dan keluhan warga Desa Lumban Silintong</p>
    </div>

    <div class="max-w-5xl mx-auto">
        @if(isset($aspirasiPublik) && $aspirasiPublik->count() > 0)
            <div class="grid md:grid-cols-2 gap-6">
                @foreach($aspirasiPublik as $aspirasi)
                <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden border border-gray-100">
                    {{-- Header Aspirasi --}}
                    <div class="bg-gradient-to-r from-blue-50 to-white px-6 py-4 border-b border-gray-100">
                        <div class="flex items-start justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center shadow-md">
                                    <i class="fa-solid fa-user text-white text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $aspirasi->user->name ?? 'Warga' }}</p>
                                    <p class="text-[10px] text-gray-400 flex items-center gap-1">
                                        <i class="fa-regular fa-calendar"></i> 
                                        {{ $aspirasi->created_at->translatedFormat('d F Y') }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="px-3 py-1 rounded-full text-[10px] font-semibold
                                    @if($aspirasi->kategori == 'saran') bg-green-100 text-green-700
                                    @elseif($aspirasi->kategori == 'keluhan') bg-red-100 text-red-700
                                    @elseif($aspirasi->kategori == 'masukan') bg-blue-100 text-blue-700
                                    @else bg-purple-100 text-purple-700 @endif">
                                    @if($aspirasi->kategori == 'saran') 💡 Saran
                                    @elseif($aspirasi->kategori == 'keluhan') 😞 Keluhan
                                    @elseif($aspirasi->kategori == 'masukan') 📝 Masukan
                                    @else ❓ Pertanyaan @endif
                                </span>
                                <span class="px-2 py-0.5 rounded-full text-[9px] font-semibold
                                    @if($aspirasi->status == 'baru') bg-yellow-100 text-yellow-700
                                    @elseif($aspirasi->status == 'diproses') bg-blue-100 text-blue-700
                                    @else bg-green-100 text-green-700 @endif">
                                    @if($aspirasi->status == 'baru') 🆕 Baru
                                    @elseif($aspirasi->status == 'diproses') ⚙️ Diproses
                                    @else ✅ Selesai @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Body Aspirasi --}}
                    <div class="px-6 py-4">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $aspirasi->judul }}</h3>
                        <p class="text-sm text-gray-600 leading-relaxed line-clamp-3">
                            {{ $aspirasi->isi_aspirasi }}
                        </p>
                    </div>
                    
                    {{-- Jawaban Admin (jika ada) --}}
                    @if($aspirasi->respon_admin && $aspirasi->respon_admin != '')
                    <div class="mx-6 mb-4 p-4 bg-gradient-to-r from-emerald-50 to-green-50 rounded-xl border-l-4 border-emerald-500 group-hover:shadow-md transition-all duration-300">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center flex-shrink-0 shadow-sm">
                                <i class="fa-solid fa-headset text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-1">
                                    <span class="text-xs font-bold text-emerald-700">Admin Desa</span>
                                    <span class="text-[9px] text-gray-400">{{ $aspirasi->updated_at->translatedFormat('d F Y') }}</span>
                                </div>
                                <p class="text-sm text-gray-700 leading-relaxed">
                                    {{ $aspirasi->respon_admin }}
                                </p>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="mx-6 mb-4 p-4 bg-gradient-to-r from-gray-50 to-gray-100 rounded-xl border-l-4 border-gray-300">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-400 flex items-center justify-center flex-shrink-0">
                                <i class="fa-regular fa-hourglass-half text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-xs text-gray-500">⏳ Menunggu tanggapan dari admin desa</p>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                    {{-- Footer --}}
                    <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <i class="fa-regular fa-heart"></i>
                            <span>Dukung aspirasi ini</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="{{ route('login') }}" class="text-[10px] text-emerald-600 hover:text-emerald-700 transition flex items-center gap-1">
                                <i class="fa-regular fa-comment"></i> Sampaikan Aspirasi
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <div class="text-center mt-10">
                <a href="{{ route('login') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-105 text-sm font-semibold">
                    <i class="fa-regular fa-pen-to-square"></i>
                    Login untuk Sampaikan Aspirasi
                </a>
            </div>
        @else
            <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                    <i class="fa-regular fa-comment-dots text-4xl text-gray-400"></i>
                </div>
                <h3 class="text-xl font-serif italic text-gray-400">Belum Ada Aspirasi</h3>
                <p class="text-gray-400 mt-2">Jadilah yang pertama menyampaikan aspirasi, saran, atau keluhan Anda.</p>
                <a href="{{ route('login') }}" class="inline-block mt-4 px-6 py-2 bg-emerald-500 text-white rounded-lg text-sm hover:bg-emerald-600 transition">
                    Login untuk Menyampaikan Aspirasi
                </a>
            </div>
        @endif
    </div>
</section>

{{-- ============================================= --}}
{{-- 12. PETA & FAQ (TIPS & PANDUAN) --}}
{{-- ============================================= --}}
<section id="peta" class="py-20 px-[5%] bg-gradient-to-br from-stone-100 to-white rounded-[80px] mx-[5%] mb-20">
    <div class="grid lg:grid-cols-2 gap-16">
        <div class="rounded-2xl overflow-hidden shadow-xl h-[450px] border-4 border-white">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.668102377317!2d99.0435942!3d2.332309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04306443c683%3A0x868a8600868a86!2sLumban%20Silintong!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div>
            <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">📍 Info & Bantuan</span>
            <h2 class="text-4xl md:text-5xl font-serif italic mb-8 mt-4 text-emerald-900">Pusat Informasi</h2>
            <div class="space-y-4" x-data="{ activeFaq: null }">
                @php
                    $faqs = [
                        ['q' => 'Bagaimana cara registrasi warga?', 'a' => 'Kunjungi kantor desa dengan membawa KTP dan KK asli untuk proses verifikasi oleh admin portal.'],
                        ['q' => 'Apakah layanan surat digital berbayar?', 'a' => 'Tidak. Seluruh layanan administrasi melalui portal ini gratis tanpa biaya sepeser pun.'],
                        ['q' => 'Bagaimana jika lupa password portal?', 'a' => 'Silakan klik tombol "Lupa Password" atau hubungi petugas IT desa di kantor.'],
                        ['q' => 'Apakah UMKM bisa mendaftar sendiri?', 'a' => 'Ya, pemilik UMKM dapat mendaftar melalui menu "Request Akun UMKM" setelah login sebagai masyarakat.'],
                    ];
                @endphp
                @foreach($faqs as $i => $f)
                <div class="faq-item bg-white p-5 rounded-xl border border-gray-100 cursor-pointer transition-all hover:border-emerald-200 hover:shadow-md" @click="activeFaq = activeFaq === {{ $i }} ? null : {{ $i }}">
                    <div class="flex justify-between items-center text-emerald-800 font-semibold">
                        <span class="flex items-center gap-2"><i class="fa-regular fa-circle-question text-emerald-500"></i> {{ $f['q'] }}</span>
                        <i class="fa-solid text-emerald-500 transition-transform duration-300" :class="activeFaq === {{ $i }} ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </div>
                    <div x-show="activeFaq === {{ $i }}" x-collapse class="mt-3 text-sm text-gray-500 leading-relaxed pl-6 border-l-2 border-emerald-200">
                        {{ $f['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 13. CTA BANTUAN PREMIUM --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-emerald-800 rounded-3xl p-12 text-center text-white shadow-2xl relative overflow-hidden group">
        <div class="absolute top-0 right-0 opacity-10 group-hover:scale-110 transition-transform duration-700">
            <i class="fa-solid fa-headset text-8xl"></i>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/5 to-white/0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
        <div class="relative z-10">
            <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-5 animate-bounce">
                <i class="fa-solid fa-headset text-3xl"></i>
            </div>
            <h3 class="text-3xl font-serif italic mb-3">💬 Butuh Bantuan?</h3>
            <p class="text-emerald-100/80 mb-6 max-w-2xl mx-auto">Jika mengalami kendala dalam menggunakan layanan digital desa, silakan hubungi admin atau datang langsung ke kantor desa.</p>
            <div class="flex gap-5 justify-center flex-wrap">
                <a href="{{ route('kontak') }}" class="px-8 py-3.5 bg-white text-emerald-700 rounded-full font-semibold hover:bg-emerald-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 inline-flex items-center gap-2 group">
                    <i class="fa-regular fa-envelope group-hover:scale-110 transition"></i> Hubungi Kami
                </a>
                <a href="#" class="px-8 py-3.5 border-2 border-white text-white rounded-full font-semibold hover:bg-white/10 transition-all duration-300 hover:-translate-y-1 inline-flex items-center gap-2 group">
                    <i class="fa-brands fa-whatsapp group-hover:scale-110 transition"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .empty-state {
        border: 2px dashed #e2e8f0; border-radius: 40px; padding: 60px 30px;
        text-align: center; background: #f8fafc;
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    
    /* Locked card overlay styles */
    .locked-card {
        position: relative;
    }
    .locked-card .locked-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.6);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
        z-index: 20;
    }
    .locked-card:hover .locked-overlay {
        opacity: 1;
    }
    .locked-card .locked-content {
        transform: scale(0.9);
        transition: transform 0.3s ease;
    }
    .locked-card:hover .locked-content {
        transform: scale(1);
    }
</style>

{{-- Script untuk Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk diagram dari server
    const statistikData = {
        penduduk: {
            labels: ['👨 Laki-laki', '👩 Perempuan', '🏠 Kepala Keluarga'],
            values: [{{ $penduduk_pria ?? 0 }}, {{ $penduduk_wanita ?? 0 }}, {{ str_replace('.', '', $stat_kk ?? '0') }}],
            colors: ['rgba(59, 130, 246, 0.85)', 'rgba(236, 72, 153, 0.85)', 'rgba(245, 158, 11, 0.85)'],
            borderColors: ['rgb(59, 130, 246)', 'rgb(236, 72, 153)', 'rgb(245, 158, 11)'],
            hoverColors: ['rgba(59, 130, 246, 1)', 'rgba(236, 72, 153, 1)', 'rgba(245, 158, 11, 1)'],
            title: '📊 Statistik Penduduk',
            unit: 'Jiwa'
        },
        umur: {
            labels: ['👶 0-14 tahun', '🧑 15-29 tahun', '👨 30-59 tahun', '👴 60+ tahun'],
            values: [{{ $kelompok_umur_0_14 ?? 0 }}, {{ $kelompok_umur_15_29 ?? 0 }}, {{ $kelompok_umur_30_59 ?? 0 }}, {{ $kelompok_umur_60 ?? 0 }}],
            colors: ['rgba(16, 185, 129, 0.85)', 'rgba(59, 130, 246, 0.85)', 'rgba(245, 158, 11, 0.85)', 'rgba(139, 92, 246, 0.85)'],
            borderColors: ['rgb(16, 185, 129)', 'rgb(59, 130, 246)', 'rgb(245, 158, 11)', 'rgb(139, 92, 246)'],
            hoverColors: ['rgba(16, 185, 129, 1)', 'rgba(59, 130, 246, 1)', 'rgba(245, 158, 11, 1)', 'rgba(139, 92, 246, 1)'],
            title: '📈 Kelompok Umur Penduduk',
            unit: 'Jiwa'
        }
    };

    let homeChart = null;
    let currentChartType = 'bar';
    let currentDataType = 'penduduk';

    function formatNumber(value) {
        if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
        if (value >= 1000) return (value / 1000).toFixed(1) + 'K';
        return value.toString();
    }

    function showLoading() {
        const loading = document.getElementById('chartLoading');
        if (loading) {
            loading.classList.remove('opacity-0', 'invisible');
            loading.classList.add('opacity-100', 'visible');
        }
    }

    function hideLoading() {
        const loading = document.getElementById('chartLoading');
        if (loading) {
            loading.classList.add('opacity-0', 'invisible');
            loading.classList.remove('opacity-100', 'visible');
        }
    }

    function updateChart(chartType, dataType) {
        showLoading();
        
        setTimeout(() => {
            currentChartType = chartType;
            currentDataType = dataType;
            
            const data = statistikData[dataType];
            if (!data) {
                hideLoading();
                return;
            }
            
            const ctx = document.getElementById('homeStatistikChart').getContext('2d');
            
            if (homeChart) {
                homeChart.destroy();
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
                interaction: {
                    mode: 'index',
                    intersect: false,
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
                        displayColors: true,
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
                        },
                        onClick: function(e, legendItem, legend) {
                            const index = legendItem.index;
                            const ci = legend.chart;
                            const meta = ci.getDatasetMeta(0);
                            meta.data[index].hidden = !meta.data[index].hidden;
                            ci.update();
                        }
                    }
                },
                onHover: function(event, activeElements) {
                    const canvas = document.getElementById('homeStatistikChart');
                    canvas.style.cursor = activeElements.length ? 'pointer' : 'default';
                }
            };
            
            if (!isPieType) {
                baseOptions.scales = {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)',
                            drawBorder: false,
                            lineWidth: 1,
                            drawTicks: false
                        },
                        ticks: {
                            callback: function(value) {
                                return formatNumber(value);
                            },
                            font: { size: 11, family: "'Inter', sans-serif" },
                            color: '#6b7280'
                        },
                        title: {
                            display: true,
                            text: `📊 Jumlah (${data.unit})`,
                            font: { size: 11, weight: 'bold', family: "'Inter', sans-serif" },
                            color: '#6b7280'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { 
                            font: { size: 12, weight: 'bold', family: "'Inter', sans-serif" },
                            color: '#374151'
                        }
                    }
                };
            } else {
                baseOptions.plugins.tooltip.callbacks.label = function(context) {
                    const total = data.values.reduce((a, b) => a + b, 0);
                    const percentage = ((context.raw / total) * 100).toFixed(1);
                    return `${context.label}: ${context.raw.toLocaleString()} ${data.unit} (${percentage}%)`;
                };
            }
            
            if (isPieType) {
                homeChart = new Chart(ctx, {
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
                homeChart = new Chart(ctx, {
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
                            pointHoverBackgroundColor: '#059669',
                            hoverBackgroundColor: chartType === 'bar' ? data.hoverColors : null,
                            hoverBorderWidth: chartType === 'bar' ? 2 : 0,
                            hoverBorderColor: chartType === 'bar' ? '#fff' : null,
                            maxBarThickness: 80
                        }]
                    },
                    options: baseOptions
                });
            }
            
            hideLoading();
        }, 300);
    }
    
    function quickChange(chartType, dataType) {
        updateChart(chartType, dataType);
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        updateChart('bar', 'penduduk');
    });
    
    window.updateChart = updateChart;
    window.quickChange = quickChange;
</script>
@endsection