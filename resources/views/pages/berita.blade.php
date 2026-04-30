{{-- resources/views/pages/berita.blade.php --}}
@extends('layouts.app')

@section('title', 'Berita & Pengumuman - Desa Lumban Silintong')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20">
    
    {{-- ============================================= --}}
    {{-- HERO SECTION DENGAN PARALLAX & ANIMASI --}}
    {{-- ============================================= --}}
    <div class="relative h-[500px] md:h-[550px] overflow-hidden">
        <div class="absolute inset-0 animate-scale-slow">
            <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=1920" 
                 class="w-full h-full object-cover"
                 alt="Hero Background">
            <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/90 via-emerald-900/70 to-emerald-800/40"></div>
        </div>
        
        <!-- Animated Wave Background -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" fill="#f8fafc">
                <path d="M0,64L48,69.3C96,75,192,85,288,85.3C384,85,480,75,576,69.3C672,64,768,64,864,69.3C960,75,1056,85,1152,85.3C1248,85,1344,75,1392,69.3L1440,64L1440,120L1392,120C1344,120,1248,120,1152,120C1056,120,960,120,864,120C768,120,672,120,576,120C480,120,384,120,288,120C192,120,96,120,48,120L0,120Z"/>
            </svg>
        </div>
        
        <div class="relative h-full flex items-center animate-fadeInUp">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white">
                <div class="max-w-3xl">
                    <div class="flex items-center gap-2 mb-4 animate-slideInLeft">
                        <div class="w-12 h-0.5 bg-emerald-400 rounded-full animate-pulse"></div>
                        <span class="text-sm font-medium tracking-[0.3em] uppercase text-emerald-200">BERITA DESA</span>
                    </div>
                    <h1 class="text-5xl md:text-6xl lg:text-7xl font-serif font-bold mb-4 leading-tight animate-slideInLeft" style="animation-delay: 0.1s">
                        Berita & <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-300 to-teal-200">Pengumuman</span>
                    </h1>
                    <p class="text-base md:text-lg text-gray-200 mb-8 leading-relaxed max-w-2xl animate-slideInLeft" style="animation-delay: 0.2s">
                        Informasi terkini seputar kegiatan, pembangunan, dan pengumuman resmi 
                        Desa Lumban Silintong disajikan secara transparan dan cepat.
                    </p>
                    <div class="flex flex-wrap gap-4 animate-slideInLeft" style="animation-delay: 0.3s">
                        <a href="#berita-terkini" class="group inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-full text-sm font-semibold hover:from-emerald-600 hover:to-teal-600 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                            <span>Jelajahi Berita</span>
                            <i class="fa-solid fa-arrow-down group-hover:translate-y-1 transition-transform duration-300"></i>
                        </a>
                        <a href="#trending" class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 backdrop-blur-md text-white rounded-full text-sm font-semibold hover:bg-white/20 transition-all duration-300 border border-white/20 hover:scale-105">
                            <i class="fa-solid fa-fire-flame"></i>
                            <span>Trending</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        

        {{-- ============================================= --}}
        {{-- FEATURED BERITA DENGAN OVERLAY ELEGAN --}}
        @if(isset($beritaUtama) && $beritaUtama)
        <div class="mb-20 animate-fadeInUp" style="animation-delay: 0.3s">
            <div class="group relative rounded-2xl overflow-hidden shadow-2xl">
                <div class="h-[400px] md:h-[480px] overflow-hidden">
                    <img src="{{ $beritaUtama->foto ? asset('storage/' . $beritaUtama->foto) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1200' }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                </div>
                <div class="absolute inset-0 bg-gradient-to-t from-black/95 via-black/60 to-transparent"></div>
                <div class="absolute inset-0 flex items-end">
                    <div class="p-8 md:p-10 text-white max-w-3xl animate-slideInUp">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="inline-block px-3 py-1.5 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-lg">
                                {{ ucfirst($beritaUtama->kategori) }}
                            </span>
                            <span class="text-sm text-gray-300">
                                <i class="fa-regular fa-calendar mr-1"></i> {{ $beritaUtama->tanggal_publikasi->format('d F Y') }}
                            </span>
                            <span class="text-sm text-gray-300">
                                <i class="fa-regular fa-clock mr-1"></i> {{ $beritaUtama->created_at->diffForHumans() }}
                            </span>
                        </div>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight hover:text-emerald-300 transition-colors duration-300">{{ $beritaUtama->judul }}</h2>
                        <p class="text-gray-200 mb-6 line-clamp-2 text-lg">{{ $beritaUtama->ringkasan }}</p>
                        <a href="{{ route('berita.show', $beritaUtama->slug) }}" 
                           class="inline-flex items-center gap-2 px-6 py-3 bg-white text-emerald-700 rounded-full text-sm font-semibold hover:bg-gray-100 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-0.5 group/btn">
                            <span>Baca Selengkapnya</span>
                            <i class="fa-solid fa-arrow-right text-xs group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
                <!-- Animated border -->
                <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 via-teal-400 to-emerald-400 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-700 origin-left"></div>
            </div>
        </div>
        @endif

        {{-- ============================================= --}}
        {{-- STATISTIK DENGAN COUNTER ANIMASI --}}
        {{-- ============================================= --}}
        {{-- ============================================= --}}
{{-- STATISTIK CARD - ELEGAN & INTERAKTIF --}}
{{-- ============================================= --}}
<div class="flex justify-center mb-20 animate-fadeInUp" style="animation-delay: 0.4s">
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 md:gap-8 max-w-4xl mx-auto">
        {{-- Card 1: Total Berita --}}
        <div class="stat-card bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group cursor-pointer">
            <div class="relative">
                <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-md">
                    <i class="fa-regular fa-newspaper text-emerald-600 text-3xl"></i>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white text-xs font-bold opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <i class="fa-solid fa-chart-line"></i>
                </div>
            </div>
            <p class="text-4xl md:text-5xl font-bold text-gray-800 stat-number mb-2" data-target="{{ $beritas->total() }}">0</p>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Berita</p>
            <div class="w-12 h-0.5 bg-emerald-200 mx-auto mt-4 group-hover:w-24 transition-all duration-500"></div>
        </div>

        {{-- Card 2: Total Pembaca --}}
        <div class="stat-card bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group cursor-pointer">
            <div class="relative">
                <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-md">
                    <i class="fa-regular fa-eye text-blue-600 text-3xl"></i>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <i class="fa-solid fa-eye"></i>
                </div>
            </div>
            <p class="text-4xl md:text-5xl font-bold text-gray-800 stat-number mb-2" data-target="{{ number_format($beritas->sum('dibaca'), 0, '', '') }}">0</p>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Pembaca</p>
            <div class="w-12 h-0.5 bg-blue-200 mx-auto mt-4 group-hover:w-24 transition-all duration-500"></div>
        </div>

        {{-- Card 3: Total Kegiatan --}}
        <div class="stat-card bg-white rounded-2xl p-8 text-center shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100 group cursor-pointer">
            <div class="relative">
                <div class="w-20 h-20 bg-gradient-to-br from-amber-100 to-amber-50 rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 group-hover:rotate-6 transition-all duration-500 shadow-md">
                    <i class="fa-regular fa-calendar-check text-amber-600 text-3xl"></i>
                </div>
                <div class="absolute -top-2 -right-2 w-8 h-8 bg-amber-500 rounded-full flex items-center justify-center text-white text-xs font-bold opacity-0 group-hover:opacity-100 transition-all duration-300">
                    <i class="fa-solid fa-calendar"></i>
                </div>
            </div>
            <p class="text-4xl md:text-5xl font-bold text-gray-800 stat-number mb-2" data-target="{{ $beritas->where('kategori', 'kegiatan')->count() }}">0</p>
            <p class="text-sm font-medium text-gray-500 uppercase tracking-wider">Total Kegiatan</p>
            <div class="w-12 h-0.5 bg-amber-200 mx-auto mt-4 group-hover:w-24 transition-all duration-500"></div>
        </div>
    </div>
</div>
        {{-- ============================================= --}}
        {{-- BERITA TERKINI & TRENDING SIDEBAR --}}
        {{-- ============================================= --}}
        <div id="berita-terkini" class="grid lg:grid-cols-3 gap-8 mb-16 animate-fadeInUp" style="animation-delay: 0.5s">
            
            {{-- Kolom Kiri & Tengah: Daftar Berita --}}
            <div class="lg:col-span-2">
                <div class="flex flex-wrap justify-between items-center gap-4 mb-8">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-md">
                            <i class="fa-regular fa-clock text-white text-sm"></i>
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-bold text-gray-800">Berita Terkini</h2>
                            <p class="text-xs text-gray-500">Update terbaru dari desa</p>
                        </div>
                    </div>
                    
                    {{-- Filter Kategori dengan Animasi --}}
                    <div class="flex flex-wrap gap-2">
                        <button data-filter="all" class="filter-btn active px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-300 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white shadow-md hover:shadow-lg hover:-translate-y-0.5">Semua</button>
                        <button data-filter="berita" class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 hover:-translate-y-0.5">📰 Berita</button>
                        <button data-filter="pengumuman" class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 hover:-translate-y-0.5">📢 Pengumuman</button>
                        <button data-filter="kegiatan" class="filter-btn px-4 py-2 rounded-xl text-xs font-semibold transition-all duration-300 bg-gray-100 text-gray-600 hover:bg-emerald-50 hover:text-emerald-600 hover:-translate-y-0.5">🎉 Kegiatan</button>
                    </div>
                </div>

                <div class="space-y-5" id="berita-grid">
                    @forelse($beritas as $index => $berita)
                    <div class="berita-card bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1 border border-gray-100 animate-slideInLeft" style="animation-delay: {{ 0.05 * $index }}s" data-kategori="{{ $berita->kategori }}">
                        <div class="flex flex-col sm:flex-row gap-5 p-5">
                            <div class="sm:w-40 h-28 flex-shrink-0 overflow-hidden rounded-xl group">
                                <img src="{{ $berita->foto ? asset('storage/' . $berita->foto) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=200' }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <span class="inline-block px-2 py-1 rounded-full text-[9px] font-bold uppercase tracking-wider
                                        @if($berita->kategori == 'berita') bg-blue-100 text-blue-700
                                        @elseif($berita->kategori == 'pengumuman') bg-amber-100 text-amber-700
                                        @else bg-emerald-100 text-emerald-700 @endif">
                                        @if($berita->kategori == 'berita') 📰 Berita
                                        @elseif($berita->kategori == 'pengumuman') 📢 Pengumuman
                                        @else 🎉 Kegiatan @endif
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        <i class="fa-regular fa-calendar mr-1"></i> {{ $berita->tanggal_publikasi->format('d M Y') }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        <i class="fa-regular fa-eye mr-1"></i> {{ number_format($berita->dibaca) }} dibaca
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold text-gray-800 hover:text-emerald-600 transition-colors duration-300 line-clamp-1">
                                    <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                </h3>
                                <p class="text-gray-500 text-sm mt-2 line-clamp-2">{{ $berita->ringkasan }}</p>
                                <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center gap-1 mt-3 text-emerald-600 text-sm font-semibold hover:gap-2 transition-all duration-300 group/link">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fa-solid fa-arrow-right text-xs group-hover/link:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-20 bg-gray-50 rounded-2xl animate-fadeIn">
                        <i class="fa-regular fa-newspaper text-6xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-semibold text-gray-500">Belum Ada Berita</h3>
                        <p class="text-sm text-gray-400 mt-2">Belum ada berita yang dipublikasikan.</p>
                    </div>
                    @endforelse
                </div>

                {{-- Pagination dengan Animasi --}}
                <div class="mt-10 flex justify-center">
                    {{ $beritas->appends(request()->query())->links() }}
                </div>
            </div>

            {{-- Kolom Kanan: Trending & Populer dengan Animasi --}}
            <div class="space-y-6">
                {{-- Trending Card dengan Gradient --}}
                <div class="trending-card bg-gradient-to-br from-orange-500 via-orange-600 to-red-600 rounded-2xl p-6 text-white shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-1 animate-slideInRight">
                    <div class="flex items-center gap-2 mb-5">
                        <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm">
                            <i class="fa-solid fa-fire-flame text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">Trending Minggu Ini</h3>
                            <p class="text-xs text-white/70">Paling banyak dibaca</p>
                        </div>
                    </div>
                    <div class="space-y-4">
                        @php
                            $trending = $beritas->sortByDesc('dibaca')->take(5);
                        @endphp
                        @foreach($trending as $index => $berita)
                        <a href="{{ route('berita.show', $berita->slug) }}" class="trending-item flex items-start gap-3 group hover:bg-white/10 p-2 rounded-xl transition-all duration-300">
                            <span class="text-2xl font-bold text-white/40 w-8 group-hover:text-white/70 transition">{{ str_pad($index+1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="flex-1">
                                <p class="text-sm font-medium group-hover:text-white transition line-clamp-2">{{ $berita->judul }}</p>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-white/60">{{ number_format($berita->dibaca) }} dibaca</span>
                                    <span class="w-1 h-1 bg-white/40 rounded-full"></span>
                                    <span class="text-xs text-white/60">{{ $berita->tanggal_publikasi->format('d M Y') }}</span>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-white/30 group-hover:text-white/70 group-hover:translate-x-1 transition-all duration-300"></i>
                        </a>
                        @endforeach
                    </div>
                </div>


                {{-- Berita Terpopuler --}}
                <div class="bg-white rounded-2xl p-6 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 animate-slideInRight" style="animation-delay: 0.2s">
                    <div class="flex items-center gap-2 mb-5">
                        <i class="fa-solid fa-chart-line text-emerald-500 text-lg"></i>
                        <h3 class="font-bold text-gray-800">Terpopuler Bulan Ini</h3>
                    </div>
                    <div class="space-y-4">
                        @foreach($beritas->take(3) as $berita)
                        <a href="{{ route('berita.show', $berita->slug) }}" class="popular-item flex gap-4 group">
                            <div class="w-20 h-20 flex-shrink-0 overflow-hidden rounded-xl">
                                <img src="{{ $berita->foto ? asset('storage/' . $berita->foto) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=100' }}" 
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </div>
                            <div>
                                <h4 class="text-sm font-semibold text-gray-800 group-hover:text-emerald-600 transition line-clamp-2">{{ $berita->judul }}</h4>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-xs text-gray-400">{{ $berita->tanggal_publikasi->format('d M Y') }}</span>
                                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                    <span class="text-xs text-gray-400"><i class="fa-regular fa-eye mr-1"></i>{{ number_format($berita->dibaca) }}</span>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================= --}}
    {{-- FOOTER CTA DENGAN ANIMASI --}}
    {{-- ============================================= --}}
    <div class="bg-gradient-to-r from-emerald-900 via-emerald-800 to-teal-900 py-16 mt-8 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-64 h-64 bg-white rounded-full filter blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-400 rounded-full filter blur-3xl animate-pulse-slow" style="animation-delay: 1s"></div>
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10 animate-fadeInUp">
            <h3 class="text-3xl md:text-4xl font-bold text-white mb-3">Tetap Terinformasi</h3>
            <p class="text-emerald-200 mb-8 max-w-md mx-auto">Dapatkan berita terbaru langsung dari website desa kami</p>
        </div>
    </div>
</div>

<style>
    /* Animations */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    @keyframes fadeInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeInRight {
        from {
            opacity: 0;
            transform: translateX(30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes scaleSlow {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    @keyframes pulseSlow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.1); }
    }
    
    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out forwards;
    }
    
    .animate-fadeInLeft {
        animation: fadeInLeft 0.8s ease-out forwards;
    }
    
    .animate-fadeInRight {
        animation: fadeInRight 0.8s ease-out forwards;
    }
    
    .animate-scaleIn {
        animation: scaleIn 0.5s ease-out forwards;
        opacity: 0;
    }
    
    .animate-scale-slow {
        animation: scaleSlow 20s ease-in-out infinite;
    }
    
    .animate-pulse-slow {
        animation: pulseSlow 4s ease-in-out infinite;
    }
    
    .animate-slideInLeft {
        animation: slideInLeft 0.6s ease-out forwards;
        opacity: 0;
    }
    
    .animate-slideInRight {
        animation: fadeInRight 0.6s ease-out forwards;
        opacity: 0;
    }
    
    .animate-slideInUp {
        animation: slideInUp 0.6s ease-out forwards;
        opacity: 0;
    }
    
    .filter-btn.active { 
        background: linear-gradient(to right, #10b981, #059669);
        color: white; 
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    
    .filter-btn.active:hover { 
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    }
    
    .stat-card:hover .stat-number {
        color: #10b981;
    }
    
    .trending-card {
        background: linear-gradient(135deg, #f97316, #ea580c, #dc2626);
    }
    
    .trending-item {
        transition: all 0.3s ease;
    }
    
    .category-tag {
        transition: all 0.3s ease;
    }
    
    .popular-item {
        transition: all 0.3s ease;
    }
    
    .social-btn {
        transition: all 0.3s ease;
    }
    
    .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
    
    html {
        scroll-behavior: smooth;
    }
    
    /* Pagination Styling */
    .pagination {
        display: flex;
        gap: 8px;
    }
    .pagination .page-item .page-link {
        padding: 8px 14px;
        border-radius: 12px;
        background: white;
        color: #4b5563;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .pagination .page-item.active .page-link {
        background: linear-gradient(to right, #10b981, #059669);
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .pagination .page-item .page-link:hover {
        background: #10b981;
        color: white;
        transform: translateY(-2px);
    }
</style>

<script>
    // Counter Animation for Statistics
    document.addEventListener('DOMContentLoaded', function() {
        const statNumbers = document.querySelectorAll('.stat-number');
        
        const animateNumber = (element) => {
            const target = parseInt(element.dataset.target);
            let current = 0;
            const increment = target / 50;
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    element.textContent = target.toLocaleString();
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 20);
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateNumber(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        statNumbers.forEach(stat => observer.observe(stat));
    });
    
    // Filter Kategori
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active');
                b.classList.remove('bg-gradient-to-r', 'from-emerald-600', 'to-emerald-500', 'text-white', 'shadow-md');
                b.classList.add('bg-gray-100', 'text-gray-600');
            });
            this.classList.add('active');
            this.classList.remove('bg-gray-100', 'text-gray-600');
            this.classList.add('bg-gradient-to-r', 'from-emerald-600', 'to-emerald-500', 'text-white', 'shadow-md');
            
            const filter = this.dataset.filter;
            document.querySelectorAll('.berita-card').forEach(card => {
                if (filter === 'all' || card.dataset.kategori === filter) {
                    card.style.display = 'flex';
                    card.style.opacity = '0';
                    setTimeout(() => { card.style.opacity = '1'; }, 10);
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Hover animation for trending items
    document.querySelectorAll('.trending-item').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });
        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
    
    // Hover animation for category tags
    document.querySelectorAll('.category-tag').forEach(tag => {
        tag.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        tag.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
</script>
@endsection