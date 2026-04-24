{{-- resources/views/pages/profil-desa.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Desa Lumban Silintong')

@section('content')
<style>
    /* ============================================ */
    /* CUSTOM STYLES PREMIUM */
    /* ============================================ */
    .hero-parallax {
        background-attachment: fixed;
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
        transform: translateZ(0);
        will-change: transform;
    }
    
    .wave-divider {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        overflow: hidden;
        line-height: 0;
    }
    
    .stat-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .stat-card:hover {
        transform: translateY(-8px);
    }
    
    /* Fix untuk teks panjang */
    .word-break {
        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: normal;
        max-width: 100%;
    }
    
    .visi-text, .misi-text {
        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: normal;
        max-height: 300px;
        overflow-y: auto;
        padding-right: 10px;
    }
    
    /* Custom scrollbar untuk teks panjang */
    .visi-text::-webkit-scrollbar, 
    .misi-text::-webkit-scrollbar {
        width: 4px;
    }
    .visi-text::-webkit-scrollbar-track,
    .misi-text::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .visi-text::-webkit-scrollbar-thumb,
    .misi-text::-webkit-scrollbar-thumb {
        background: #10b981;
        border-radius: 10px;
    }
    
    .gallery-slider {
        display: flex;
        gap: 20px;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        padding-bottom: 20px;
    }
    .gallery-slider::-webkit-scrollbar {
        height: 8px;
    }
    .gallery-slider::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .gallery-slider::-webkit-scrollbar-thumb {
        background: #10b981;
        border-radius: 10px;
    }
    .gallery-item {
        scroll-snap-align: start;
        flex-shrink: 0;
        width: 280px;
        transition: all 0.3s ease;
    }
    .gallery-item:hover {
        transform: translateY(-5px) scale(1.02);
    }
    
    .menu-link.active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
    }
    .menu-link.active .w-8 {
        background: white;
    }
    .menu-link.active .w-8 i {
        color: #059669;
    }
    
    .timeline-item {
        position: relative;
        padding-left: 30px;
        border-left: 2px solid #10b981;
        margin-bottom: 25px;
    }
    .timeline-item::before {
        content: '';
        position: absolute;
        left: -8px;
        top: 0;
        width: 14px;
        height: 14px;
        background: #10b981;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
    }
    
    .profil-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .profil-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
    }
    
    /* Loading skeleton */
    .skeleton {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }
    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
</style>

{{-- ============================================= --}}
{{-- HERO SECTION DENGAN MULTIPLE GAMBAR --}}
{{-- ============================================= --}}
<section class="relative h-[70vh] min-h-[600px] overflow-hidden">
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-black/40 z-10"></div>
        <div class="hero-slider w-full h-full">
            <div class="hero-slide w-full h-full absolute inset-0 opacity-0 transition-opacity duration-1000">
                <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=1920" class="w-full h-full object-cover">
            </div>
            <div class="hero-slide w-full h-full absolute inset-0 opacity-0 transition-opacity duration-1000">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920" class="w-full h-full object-cover">
            </div>
            <div class="hero-slide w-full h-full absolute inset-0 opacity-0 transition-opacity duration-1000">
                <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=1920" class="w-full h-full object-cover">
            </div>
            <div class="hero-slide w-full h-full absolute inset-0 opacity-0 transition-opacity duration-1000">
                <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1920" class="w-full h-full object-cover">
            </div>
            <div class="hero-slide w-full h-full absolute inset-0 opacity-0 transition-opacity duration-1000">
                <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1920" class="w-full h-full object-cover">
            </div>
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/85 via-emerald-900/70 to-emerald-800/50 z-20"></div>
    </div>
    
    <div class="relative z-30 h-full flex items-center justify-center text-center">
        <div class="max-w-4xl mx-auto px-4" data-aos="fade-up" data-aos-duration="1000">
            <div class="inline-flex items-center gap-2 px-5 py-2 bg-white/20 backdrop-blur-md rounded-full text-white text-xs font-bold uppercase tracking-wider mb-6 border border-white/30">
                <i class="fa-regular fa-building mr-1"></i> Profil Desa
            </div>
            <h1 class="text-5xl md:text-7xl font-serif italic text-white mb-5 leading-tight">Lumban Silintong</h1>
            <div class="w-24 h-1 bg-emerald-400 mx-auto rounded-full mb-6"></div>
            <p class="text-white/90 text-lg md:text-xl max-w-2xl mx-auto">Desa Digital yang Modern, Transparan, dan Berbudaya</p>
            <div class="mt-8 flex gap-4 justify-center">
                <a href="#sejarah" class="px-6 py-3 bg-emerald-500 text-white rounded-full text-sm font-semibold hover:bg-emerald-600 transition shadow-lg">
                    <i class="fa-regular fa-clock mr-2"></i> Jelajahi
                </a>
                <a href="{{ route('galeri') }}" class="px-6 py-3 bg-white/20 backdrop-blur text-white rounded-full text-sm font-semibold hover:bg-white/30 transition border border-white/30">
                    <i class="fa-regular fa-images mr-2"></i> Galeri
                </a>
            </div>
        </div>
    </div>
    
    <div class="wave-divider z-30">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full">
            <path fill="#f8fafc" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

{{-- ============================================= --}}
{{-- BREADCRUMB --}}
{{-- ============================================= --}}
<div class="bg-slate-50 py-3 border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-500 hover:text-emerald-600 transition"><i class="fa-solid fa-house mr-1"></i> Beranda</a>
            <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
            <span class="text-emerald-600 font-medium">Profil Desa</span>
        </div>
    </div>
</div>

{{-- ============================================= --}}
{{-- STATISTIK CARD PREMIUM --}}
{{-- ============================================= --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 relative z-20">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="stat-card bg-white rounded-xl p-4 shadow-lg text-center border border-gray-100">
            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                <i class="fa-solid fa-calendar-alt text-emerald-600 text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-emerald-700">{{ $stat_tahun_berdiri ?? '1920' }}</p>
            <p class="text-[10px] text-gray-500 font-semibold uppercase">Tahun Berdiri</p>
        </div>
        <div class="stat-card bg-white rounded-xl p-4 shadow-lg text-center border border-gray-100">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                <i class="fa-solid fa-users text-blue-600 text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-blue-700">{{ number_format($stat_penduduk ?? 0) }}</p>
            <p class="text-[10px] text-gray-500 font-semibold uppercase">Total Penduduk</p>
        </div>
        <div class="stat-card bg-white rounded-xl p-4 shadow-lg text-center border border-gray-100">
            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                <i class="fa-solid fa-house-user text-amber-600 text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-amber-700">{{ number_format($stat_kk ?? 0) }}</p>
            <p class="text-[10px] text-gray-500 font-semibold uppercase">Kepala Keluarga</p>
        </div>
        <div class="stat-card bg-white rounded-xl p-4 shadow-lg text-center border border-gray-100">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-2">
                <i class="fa-solid fa-map text-purple-600 text-xl"></i>
            </div>
            <p class="text-2xl font-bold text-purple-700">{{ $stat_luas ?? '12.5' }}</p>
            <p class="text-[10px] text-gray-500 font-semibold uppercase">Luas (km²)</p>
        </div>
    </div>
</div>

{{-- ============================================= --}}
{{-- MAIN CONTENT DENGAN SIDEBAR MENU --}}
{{-- ============================================= --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid lg:grid-cols-4 gap-8">
        
        {{-- SIDEBAR MENU KIRI (Sticky) --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-5 py-4">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <i class="fa-regular fa-compass"></i> Menu Navigasi
                    </h3>
                </div>
                <div class="p-3 space-y-1">
                    <a href="#sejarah" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-clock text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Sejarah Desa</span>
                    </a>
                    <a href="#visi-misi" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-compass text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Visi & Misi</span>
                    </a>
                    <a href="#struktur" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-users text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Struktur Organisasi</span>
                    </a>
                    <a href="#wilayah" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-map text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Wilayah & Peta</span>
                    </a>
                    <a href="#galeri-desa" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-images text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Galeri Desa</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="lg:col-span-3 space-y-10">
            
            {{-- ============================================= --}}
            {{-- SEJARAH DESA --}}
            {{-- ============================================= --}}
            <section id="sejarah" class="scroll-mt-24 bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 profil-card" data-aos="fade-up">
                <div class="relative h-72 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/80 to-emerald-800/60 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1200" class="w-full h-full object-cover">
                    <div class="absolute inset-0 z-20 flex items-center px-8">
                        <div>
                            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur rounded-full text-white text-xs font-bold mb-3">📜 Tradisi & Sejarah</span>
                            <h2 class="text-3xl md:text-4xl font-serif italic text-white">Sejarah Desa</h2>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    @if(isset($profil) && $profil && $profil->sejarah)
                        <p class="text-gray-600 leading-relaxed word-break">{{ $profil->sejarah }}</p>
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <h3 class="text-lg font-semibold text-emerald-700 mb-4">📅 Timeline Sejarah</h3>
                            <div class="timeline-item">
                                <p class="text-sm text-gray-600">Desa Lumban Silintong berdiri sebagai desa adat Batak Toba yang kaya akan kearifan lokal.</p>
                            </div>
                            <div class="timeline-item">
                                <p class="text-sm text-gray-600">Memasuki era digitalisasi dengan peluncuran website desa dan layanan online.</p>
                            </div>
                            <div class="timeline-item">
                                <p class="text-sm text-gray-600">Menjadi desa percontohan digital di Kabupaten Toba, Sumatera Utara.</p>
                            </div>
                        </div>
                    @else
                        <div class="empty-state py-16 text-center">
                            <i class="fa-regular fa-clock text-5xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-serif italic text-gray-400">Sejarah Desa Belum Tersedia</h3>
                            <p class="text-sm text-gray-400 mt-2">Informasi sejarah desa akan segera diupdate oleh admin.</p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- ============================================= --}}
            {{-- VISI & MISI (DENGAN FIX OVERFLOW) --}}
            {{-- ============================================= --}}
            <section id="visi-misi" class="scroll-mt-24" data-aos="fade-up" data-aos-delay="100">
                @if((isset($profil) && $profil && $profil->visi) || (isset($profil) && $profil && $profil->misi))
                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Visi Card --}}
                        @if(isset($profil) && $profil && $profil->visi)
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-2xl p-8 shadow-xl text-white transform hover:scale-105 transition duration-500 profil-card">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-5 backdrop-blur">
                                <i class="fa-solid fa-eye text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-serif italic mb-4">Visi</h3>
                            <div class="visi-text text-emerald-100 leading-relaxed italic word-break max-h-64 overflow-y-auto">
                                "{{ $profil->visi }}"
                            </div>
                            <div class="mt-6 w-16 h-0.5 bg-white/30 rounded-full"></div>
                        </div>
                        @endif

                        {{-- Misi Card --}}
                        @if(isset($profil) && $profil && $profil->misi)
                        <div class="bg-white rounded-2xl p-8 shadow-xl border border-gray-100 transform hover:scale-105 transition duration-500 profil-card">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-5 shadow-lg">
                                <i class="fa-solid fa-flag-checkered text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-serif italic text-emerald-800 mb-4">Misi</h3>
                            <div class="misi-text space-y-3 max-h-64 overflow-y-auto pr-2">
                                @foreach(explode("\n", $profil->misi) as $misi)
                                    @if(trim($misi))
                                    <div class="flex items-start gap-3">
                                        <i class="fa-solid fa-check-circle text-emerald-500 mt-1 text-sm flex-shrink-0"></i>
                                        <span class="text-gray-600 text-sm word-break">{{ trim($misi) }}</span>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="empty-state py-16 text-center bg-white rounded-2xl shadow-sm">
                        <i class="fa-regular fa-compass text-5xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-serif italic text-gray-400">Visi & Misi Belum Tersedia</h3>
                        <p class="text-sm text-gray-400 mt-2">Visi dan misi desa akan segera diupdate oleh admin.</p>
                    </div>
                @endif
            </section>

            {{-- ============================================= --}}
            {{-- STRUKTUR ORGANISASI --}}
            {{-- ============================================= --}}
            <section id="struktur" class="scroll-mt-24" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 profil-card">
                    <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-6 border-b border-gray-100">
                        <h2 class="text-2xl font-serif italic text-emerald-800 flex items-center gap-2">
                            <i class="fa-solid fa-users text-emerald-500"></i> Struktur Organisasi
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">Perangkat Desa Lumban Silintong</p>
                    </div>
                    <div class="p-8">
                        @if(isset($aparaturs) && count($aparaturs) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                                @foreach($aparaturs as $index => $a)
                                <div class="text-center group cursor-pointer profil-card">
                                    <div class="relative">
                                        <div class="w-28 h-28 mx-auto rounded-full overflow-hidden shadow-lg group-hover:shadow-xl transition-all duration-300 border-4 border-white">
                                            <img src="{{ $a->foto ? asset('storage/' . $a->foto) : 'https://randomuser.me/api/portraits/lego/' . ($index+1) . '.jpg' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                                        </div>
                                        @if($index == 0)
                                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-md">
                                            <i class="fa-solid fa-crown text-white text-xs"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <h4 class="font-bold text-emerald-800 mt-4">{{ $a->nama }}</h4>
                                    <p class="text-[10px] font-black uppercase text-emerald-500 tracking-wider">{{ $a->jabatan }}</p>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state py-16 text-center">
                                <i class="fa-solid fa-users-slash text-5xl text-gray-300 mb-4"></i>
                                <h3 class="text-xl font-serif italic text-gray-400">Struktur Organisasi Belum Tersedia</h3>
                                <p class="text-sm text-gray-400 mt-2">Data perangkat desa akan segera diupdate oleh admin.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            {{-- ============================================= --}}
            {{-- WILAYAH & PETA --}}
            {{-- ============================================= --}}
            <section id="wilayah" class="scroll-mt-24" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 profil-card">
                    <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-6 border-b border-gray-100">
                        <h2 class="text-2xl font-serif italic text-emerald-800 flex items-center gap-2">
                            <i class="fa-solid fa-map text-emerald-500"></i> Wilayah & Peta
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">Lokasi geografis Desa Lumban Silintong</p>
                    </div>
                    <div class="p-8">
                        <div class="rounded-xl overflow-hidden shadow-lg h-96">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.668102377317!2d99.0435942!3d2.332309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04306443c683%3A0x868a8600868a86!2sLumban%20Silintong!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl profil-card">
                                <i class="fa-solid fa-location-dot text-emerald-500 text-xl"></i>
                                <div>
                                    <p class="text-[10px] text-gray-400">Kecamatan</p>
                                    <p class="font-semibold text-emerald-800 text-sm">Balige</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl profil-card">
                                <i class="fa-solid fa-building text-emerald-500 text-xl"></i>
                                <div>
                                    <p class="text-[10px] text-gray-400">Kabupaten</p>
                                    <p class="font-semibold text-emerald-800 text-sm">Toba</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl profil-card">
                                <i class="fa-solid fa-flag text-emerald-500 text-xl"></i>
                                <div>
                                    <p class="text-[10px] text-gray-400">Provinsi</p>
                                    <p class="font-semibold text-emerald-800 text-sm">Sumatera Utara</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl profil-card">
                                <i class="fa-solid fa-water text-emerald-500 text-xl"></i>
                                <div>
                                    <p class="text-[10px] text-gray-400">Luas Wilayah</p>
                                    <p class="font-semibold text-emerald-800 text-sm">{{ $stat_luas ?? '12.5' }} km²</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- ============================================= --}}
            {{-- GALERI DESA (DARI DATABASE) --}}
            {{-- ============================================= --}}
            <section id="galeri-desa" class="scroll-mt-24" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 profil-card">
                    <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-6 border-b border-gray-100">
                        <div class="flex justify-between items-center flex-wrap gap-4">
                            <div>
                                <h2 class="text-2xl font-serif italic text-emerald-800 flex items-center gap-2">
                                    <i class="fa-solid fa-images text-emerald-500"></i> Galeri Kegiatan
                                </h2>
                                <p class="text-gray-500 text-sm mt-1">Dokumentasi kegiatan desa Lumban Silintong</p>
                            </div>
                            <a href="{{ route('galeri') }}" class="text-emerald-600 hover:text-emerald-700 text-sm font-semibold flex items-center gap-1 group">
                                Lihat Semua <i class="fa-solid fa-arrow-right group-hover:translate-x-1 transition"></i>
                            </a>
                        </div>
                    </div>
                    <div class="p-8">
                        @if(isset($galeris) && count($galeris) > 0)
                            <div class="gallery-slider">
                                @foreach($galeris as $g)
                                <div class="gallery-item rounded-xl overflow-hidden shadow-lg bg-white">
                                    <img src="{{ $g->gambar_galeri ? asset('storage/' . $g->gambar_galeri) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=300' }}" class="w-full h-48 object-cover transition duration-500 hover:scale-105">
                                    <div class="p-3">
                                        <p class="text-sm font-semibold text-gray-800 line-clamp-1">{{ $g->judul_galeri ?? 'Dokumentasi Desa' }}</p>
                                        <p class="text-xs text-gray-400">{{ $g->created_at->translatedFormat('d F Y') }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-12">
                                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-regular fa-images text-4xl text-gray-400"></i>
                                </div>
                                <p class="text-gray-400">Belum ada foto kegiatan yang diunggah</p>
                                @auth
                                    @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
                                    <a href="{{ route('admin.galeri.create') }}" class="inline-block mt-3 text-emerald-600 text-sm hover:underline">Upload Foto Sekarang</a>
                                    @endif
                                @endauth
                            </div>
                        @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<script>
    // Hero Slider
    let currentSlide = 0;
    const slides = document.querySelectorAll('.hero-slide');
    const totalSlides = slides.length;
    
    function showSlide(index) {
        slides.forEach((slide, i) => {
            if (i === index) {
                slide.style.opacity = '1';
            } else {
                slide.style.opacity = '0';
            }
        });
    }
    
    function nextSlide() {
        currentSlide = (currentSlide + 1) % totalSlides;
        showSlide(currentSlide);
    }
    
    if (totalSlides > 0) {
        showSlide(0);
        setInterval(nextSlide, 5000);
    }
    
    // Smooth scroll dan active menu
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
    
    // Update active menu saat scroll
    window.addEventListener('scroll', function() {
        const sections = ['sejarah', 'visi-misi', 'struktur', 'wilayah', 'galeri-desa'];
        let current = '';
        for (let section of sections) {
            const element = document.getElementById(section);
            if (element) {
                const rect = element.getBoundingClientRect();
                if (rect.top <= 200 && rect.bottom >= 200) {
                    current = section;
                    break;
                }
            }
        }
        if (current) {
            document.querySelectorAll('.menu-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        }
    });
</script>
@endsection