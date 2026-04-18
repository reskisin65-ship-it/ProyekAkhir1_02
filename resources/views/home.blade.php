{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda - Desa Digital Premium')

@section('content')
{{-- ============================================= --}}
{{-- 1. HERO SLIDER ULTIMATE --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="slider-container group" x-data="{ slide: 0, totalSlides: 6 }" x-init="setInterval(() => slide = (slide + 1) % totalSlides, 5000)">
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
                <img src="{{ $h['img'] }}?auto=format&fit=crop&q=80&w=2070" class="absolute inset-0 w-full h-full object-cover brightness-[0.65]">
                <div class="slide-content">
                    <span class="inline-block px-4 py-1.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-xs font-bold rounded-full mb-5 tracking-wide shadow-lg animate-pulse">{{ $h['badge'] }}</span>
                    <h2 class="text-6xl md:text-7xl font-serif italic mb-5 leading-tight" data-aos="fade-up">{{ $h['t'] }}</h2>
                    <p class="text-xl md:text-2xl font-light italic opacity-95 max-w-2xl" data-aos="fade-up" data-aos-delay="200">{{ $h['d'] }}</p>
                    <div class="mt-10 flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="400">
                        <a href="#layanan-publik" class="btn-premium bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-500 hover:to-emerald-600 shadow-xl">✨ Layanan Publik</a>
                        <a href="#berita" class="px-7 py-3.5 rounded-full bg-white/15 backdrop-blur-md border border-white/30 text-white text-xs font-bold uppercase tracking-wider hover:bg-white/25 transition-all duration-300">📖 Pelajari →</a>
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
{{-- 2.5. STATISTIK DENGAN DIAGRAM PREMIUM ULTIMATE --}}
{{-- ============================================= --}}
<section class="px-[5%] py-16 bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 rounded-[60px] mx-[5%] mb-20 shadow-xl">
    <div class="flex justify-between items-center mb-8 flex-wrap gap-4">
        <div>
            <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block shadow-sm">📊 Data Statistik</span>
            <h2 class="text-4xl md:text-5xl font-serif italic text-emerald-900 mt-4">Visualisasi Data Penduduk</h2>
            <p class="text-gray-500 text-sm mt-2">Data realtime dari database desa</p>
        </div>
        
        {{-- Tombol Setting Premium Ultimate - Responsive --}}
        <div class="relative" x-data="{ 
            settingOpen: false, 
            chartType: 'bar', 
            dataType: 'penduduk',
            isMobile: window.innerWidth < 768
        }" x-init="window.addEventListener('resize', () => { isMobile = window.innerWidth < 768 })">
            <button @click="settingOpen = !settingOpen" class="setting-btn group flex items-center gap-2 px-4 py-2.5 md:px-6 md:py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 text-sm md:text-base">
                <i class="fa-solid fa-sliders-h text-xs md:text-sm group-hover:rotate-90 transition-transform duration-500"></i>
                <span class="font-semibold hidden sm:inline">Pengaturan Diagram</span>
                <span class="font-semibold sm:hidden">Setting</span>
                <i class="fa-solid fa-chevron-down text-xs transition-all duration-300" :class="settingOpen ? 'rotate-180' : ''"></i>
            </button>
            
            {{-- Dropdown Setting Premium Ultimate - Responsive --}}
            <div x-show="settingOpen" @click.away="settingOpen = false" x-cloak 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 overflow-hidden z-50"
                :class="isMobile ? 'fixed left-4 right-4 top-1/2 transform -translate-y-1/2 max-h-[85vh] overflow-y-auto' : 'absolute right-0 mt-4 w-[400px]'">
                
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-4 md:px-5 py-3 flex items-center justify-between">
                    <div>
                        <h3 class="font-bold text-white text-sm md:text-base"><i class="fa-solid fa-chart-simple mr-2"></i> Customize Chart</h3>
                        <p class="text-[9px] md:text-[10px] text-emerald-100">Sesuaikan tampilan diagram sesuai kebutuhan</p>
                    </div>
                    <button @click="settingOpen = false" class="sm:hidden text-white/80 hover:text-white">
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
                                <i class="fa-solid fa-chart-bar mr-1 md:mr-2"></i> Bar
                                <div x-show="chartType === 'bar'" class="w-full h-0.5 bg-white/50 mt-1 rounded-full animate-pulse"></div>
                            </button>
                            <button @click="chartType = 'line'; updateChart(chartType, dataType); settingOpen = false" class="chart-option group px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300" :class="chartType === 'line' ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg scale-105' : 'bg-gray-100 text-gray-600 hover:bg-emerald-100 hover:scale-105'">
                                <i class="fa-solid fa-chart-line mr-1 md:mr-2"></i> Line
                                <div x-show="chartType === 'line'" class="w-full h-0.5 bg-white/50 mt-1 rounded-full animate-pulse"></div>
                            </button>
                            <button @click="chartType = 'pie'; updateChart(chartType, dataType); settingOpen = false" class="chart-option group px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300" :class="chartType === 'pie' ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg scale-105' : 'bg-gray-100 text-gray-600 hover:bg-emerald-100 hover:scale-105'">
                                <i class="fa-solid fa-chart-pie mr-1 md:mr-2"></i> Pie
                                <div x-show="chartType === 'pie'" class="w-full h-0.5 bg-white/50 mt-1 rounded-full animate-pulse"></div>
                            </button>
                            <button @click="chartType = 'doughnut'; updateChart(chartType, dataType); settingOpen = false" class="chart-option group px-3 md:px-4 py-2 md:py-3 rounded-xl text-xs md:text-sm font-semibold transition-all duration-300" :class="chartType === 'doughnut' ? 'bg-gradient-to-r from-emerald-500 to-emerald-600 text-white shadow-lg scale-105' : 'bg-gray-100 text-gray-600 hover:bg-emerald-100 hover:scale-105'">
                                <i class="fa-solid fa-chart-simple mr-1 md:mr-2"></i> Donut
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
    
    {{-- Canvas untuk Diagram dengan Efek Premium Ultimate --}}
    <div class="chart-container bg-gradient-to-br from-white to-gray-50 rounded-2xl p-4 md:p-8 mb-6 shadow-xl border border-gray-100 relative overflow-hidden group transition-all duration-500 hover:shadow-2xl">
        <!-- Efek background gradient animasi -->
        <div class="absolute inset-0 bg-gradient-to-br from-emerald-500/5 via-transparent to-blue-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
        <div class="absolute top-0 right-0 w-64 md:w-96 h-64 md:h-96 bg-gradient-to-br from-emerald-400/10 to-transparent rounded-full blur-3xl animate-pulse-slow"></div>
        <div class="absolute bottom-0 left-0 w-48 md:w-64 h-48 md:h-64 bg-gradient-to-tr from-blue-400/5 to-transparent rounded-full blur-2xl"></div>
        
        <!-- Loading overlay -->
        <div id="chartLoading" class="absolute inset-0 bg-white/80 backdrop-blur-sm flex items-center justify-center z-10 opacity-0 invisible transition-all duration-300 rounded-2xl">
            <div class="flex flex-col items-center gap-3">
                <div class="w-10 h-10 md:w-12 md:h-12 border-4 border-emerald-200 border-t-emerald-600 rounded-full animate-spin"></div>
                <p class="text-xs md:text-sm text-emerald-600 font-semibold">Memuat diagram...</p>
            </div>
        </div>
        
        <canvas id="homeStatistikChart" width="800" height="450" style="max-height: 450px; width: 100%; position: relative; z-index: 1;"></canvas>
    </div>
    
    {{-- Statistik Cards Mini Premium --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-4 mt-6">
        <div class="quick-card bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-xl p-2 md:p-3 text-center hover:scale-105 transition-all duration-300 cursor-pointer border border-blue-200 shadow-sm group" onclick="quickChange('bar', 'penduduk')">
            <div class="flex items-center justify-center gap-1 md:gap-2">
                <i class="fa-solid fa-venus-mars text-blue-500 text-xs md:text-base group-hover:scale-110 transition-transform"></i>
                <span class="text-[10px] md:text-xs font-semibold text-gray-600">Jenis Kelamin</span>
            </div>
            <p class="text-base md:text-lg font-bold text-blue-600">{{ number_format($penduduk_pria + $penduduk_wanita) }}</p>
            <p class="text-[8px] md:text-[9px] text-gray-400">Total Jiwa</p>
            <div class="absolute inset-0 bg-blue-500/0 group-hover:bg-blue-500/5 rounded-xl transition-all duration-300"></div>
        </div>
        <div class="quick-card bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-xl p-2 md:p-3 text-center hover:scale-105 transition-all duration-300 cursor-pointer border border-emerald-200 shadow-sm group relative" onclick="quickChange('pie', 'penduduk')">
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
    
    {{-- Keterangan Premium --}}
    <div class="text-center text-[10px] md:text-xs text-gray-400 mt-6 flex items-center justify-center gap-2 md:gap-4 flex-wrap">
        <span class="flex items-center gap-1 px-2 md:px-3 py-1 bg-emerald-50 rounded-full"><i class="fa-solid fa-chart-simple text-emerald-500 text-xs"></i> Klik "Pengaturan Diagram"</span>
        <span class="flex items-center gap-1 px-2 md:px-3 py-1 bg-blue-50 rounded-full"><i class="fa-solid fa-chart-line text-blue-500 text-xs"></i> Hover untuk detail</span>
        <span class="flex items-center gap-1 px-2 md:px-3 py-1 bg-purple-50 rounded-full"><i class="fa-solid fa-arrow-pointer text-purple-500 text-xs"></i> Klik card untuk akses cepat</span>
    </div>
</section>

{{-- ============================================= --}}
{{-- 3. LAYANAN PUBLIK (Sama seperti sebelumnya) --}}
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

{{-- Sisanya (Layanan Digital, Profil Desa Preview, Berita, Aparatur, UMKM, Galeri, Peta & FAQ, CTA) --}}
{{-- ... (lanjutkan dengan konten yang sama seperti sebelumnya) --}}

<style>
    /* CSS Premium untuk Efek Hover yang Luar Biasa */
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
    
    /* Stat Card Premium */
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
    
    /* Chart Container Premium */
    .chart-container {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .chart-container:hover {
        transform: translateY(-4px);
        box-shadow: 0 30px 50px -20px rgba(16, 185, 129, 0.3);
    }
    
    /* Chart Option Button */
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
    
    /* Setting Button */
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
    
    /* Service Card */
    .service-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 40px -15px rgba(0, 0, 0, 0.15);
    }
    
    /* Quick Card */
    .quick-card {
        position: relative;
        overflow: hidden;
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
    
    /* Animations */
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.05); }
    }
    .animate-pulse-slow {
        animation: pulse-slow 4s ease-in-out infinite;
    }
    .animate-spin-slow {
        animation: spin 2s linear infinite;
    }
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .empty-state {
        border: 2px dashed #e2e8f0; border-radius: 40px; padding: 60px 30px;
        text-align: center; background: #f8fafc;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .no-scrollbar::-webkit-scrollbar { display: none; }
    [x-cloak] { display: none !important; }
</style>

{{-- Script untuk Chart.js dengan Animasi Premium --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data untuk diagram dari server
    const statistikData = {
        penduduk: {
            labels: ['👨 Laki-laki', '👩 Perempuan', '🏠 Kepala Keluarga'],
            values: [{{ $penduduk_pria ?? 0 }}, {{ $penduduk_wanita ?? 0 }}, {{ str_replace('.', '', $stat_kk ?? '0') }}],
            colors: [
                'rgba(59, 130, 246, 0.85)',
                'rgba(236, 72, 153, 0.85)', 
                'rgba(245, 158, 11, 0.85)'
            ],
            borderColors: [
                'rgb(59, 130, 246)',
                'rgb(236, 72, 153)',
                'rgb(245, 158, 11)'
            ],
            hoverColors: [
                'rgba(59, 130, 246, 1)',
                'rgba(236, 72, 153, 1)',
                'rgba(245, 158, 11, 1)'
            ],
            title: '📊 Statistik Penduduk',
            unit: 'Jiwa'
        },
        umur: {
            labels: ['👶 0-14 tahun', '🧑 15-29 tahun', '👨 30-59 tahun', '👴 60+ tahun'],
            values: [{{ $kelompok_umur_0_14 ?? 0 }}, {{ $kelompok_umur_15_29 ?? 0 }}, {{ $kelompok_umur_30_59 ?? 0 }}, {{ $kelompok_umur_60 ?? 0 }}],
            colors: [
                'rgba(16, 185, 129, 0.85)',
                'rgba(59, 130, 246, 0.85)',
                'rgba(245, 158, 11, 0.85)',
                'rgba(139, 92, 246, 0.85)'
            ],
            borderColors: [
                'rgb(16, 185, 129)',
                'rgb(59, 130, 246)',
                'rgb(245, 158, 11)',
                'rgb(139, 92, 246)'
            ],
            hoverColors: [
                'rgba(16, 185, 129, 1)',
                'rgba(59, 130, 246, 1)',
                'rgba(245, 158, 11, 1)',
                'rgba(139, 92, 246, 1)'
            ],
            title: '📈 Kelompok Umur Penduduk',
            unit: 'Jiwa'
        }
    };

    let homeChart = null;
    let currentChartType = 'bar';
    let currentDataType = 'penduduk';

    // Fungsi untuk format angka dengan satuan
    function formatNumber(value) {
        if (value >= 1000000) return (value / 1000000).toFixed(1) + 'M';
        if (value >= 1000) return (value / 1000).toFixed(1) + 'K';
        return value.toString();
    }

    // Fungsi untuk menampilkan loading
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
            
            // Konfigurasi base options premium
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
            
            // Tambah scales untuk chart non-pie
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
    
    // Fungsi quick change
    function quickChange(chartType, dataType) {
        updateChart(chartType, dataType);
    }
    
    // Inisialisasi diagram default
    document.addEventListener('DOMContentLoaded', function() {
        updateChart('bar', 'penduduk');
    });
    
    // Expose fungsi ke global
    window.updateChart = updateChart;
    window.quickChange = quickChange;
</script>
@endsection