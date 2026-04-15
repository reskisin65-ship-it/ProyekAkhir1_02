{{-- resources/views/masyarakat/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Masyarakat - Lumban Silintong')

@section('content')
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    @keyframes shine {
        0% { transform: translateX(-100%) rotate(25deg); }
        20% { transform: translateX(100%) rotate(25deg); }
        100% { transform: translateX(100%) rotate(25deg); }
    }
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
        50% { box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); }
    }
    .floating { animation: float 3s ease-in-out infinite; }
    .shine { position: relative; overflow: hidden; }
    .shine::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -60%;
        width: 200%;
        height: 200%;
        background: linear-gradient(115deg, rgba(255,255,255,0) 10%, rgba(255,255,255,0.25) 50%, rgba(255,255,255,0) 90%);
        transform: rotate(25deg);
        animation: shine 4s infinite;
    }
    .pulse-glow { animation: pulse-glow 2s infinite; }
    .stat-card { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
    .stat-card:hover { transform: translateY(-8px) scale(1.02); }
    .service-card { transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1); }
    .service-card:hover { transform: translateY(-10px) scale(1.02); box-shadow: 0 25px 40px -12px rgba(0,0,0,0.25); }
    .news-card { transition: all 0.3s ease; }
    .news-card:hover { transform: translateY(-5px); box-shadow: 0 20px 30px -10px rgba(0,0,0,0.15); }
    .gallery-item { transition: all 0.5s ease; }
    .gallery-item:hover { transform: scale(1.05); box-shadow: 0 20px 30px -10px rgba(0,0,0,0.2); }
    .faq-item { transition: all 0.3s ease; }
    .faq-item:hover { background-color: #f0fdf4; }
    .faq-answer { max-height: 0; overflow: hidden; transition: max-height 0.4s ease-out; }
    .faq-item.active .faq-answer { max-height: 300px; transition: max-height 0.4s ease-in; }
    .faq-item.active .faq-icon { transform: rotate(180deg); }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .slider-container { border-radius: 60px; overflow: hidden; position: relative; box-shadow: 0 40px 100px rgba(0,0,0,0.1); }
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
</style>

{{-- ============================================= --}}
{{-- 1. HERO SLIDER --}}
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
                    <span class="inline-block px-4 py-1.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white text-xs font-bold rounded-full mb-5 tracking-wide shadow-lg">{{ $h['badge'] }}</span>
                    <h2 class="text-6xl md:text-7xl font-serif italic mb-5 leading-tight" data-aos="fade-up">{{ $h['t'] }}</h2>
                    <p class="text-xl md:text-2xl font-light italic opacity-95 max-w-2xl" data-aos="fade-up" data-aos-delay="200">{{ $h['d'] }}</p>
                    <div class="mt-10 flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="400">
                        <a href="{{ route('masyarakat.surat.create') }}" class="btn-premium bg-gradient-to-r from-emerald-600 to-emerald-700 hover:from-emerald-500 hover:to-emerald-600 shadow-xl">📝 Ajukan Surat</a>
                        <a href="{{ route('masyarakat.aspirasi.create') }}" class="px-7 py-3.5 rounded-full bg-white/15 backdrop-blur-md border border-white/30 text-white text-xs font-bold uppercase tracking-wider hover:bg-white/25 transition-all duration-300">💬 Aspirasi →</a>
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
{{-- 2. GREETING CARD --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-10">
    <div class="bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-800 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden floating">
        <div class="absolute top-0 right-0 opacity-10">
            <i class="fa-solid fa-user-check text-8xl"></i>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-3xl pulse-glow">
                    <i class="fa-regular fa-face-smile"></i>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-serif italic">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-emerald-100 mt-1">Senang bertemu dengan Anda hari ini 🌟</p>
                </div>
            </div>
            <p class="text-emerald-100/90 max-w-2xl mt-4">Nikmati berbagai layanan digital desa yang dapat diakses dengan mudah. Ajukan surat, sampaikan aspirasi, dan pantau informasinya secara real-time.</p>
            <div class="mt-5 flex gap-3">
                <span class="bg-white/20 px-3 py-1 rounded-full text-xs"><i class="fa-regular fa-calendar mr-1"></i> {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                <span class="bg-white/20 px-3 py-1 rounded-full text-xs"><i class="fa-regular fa-clock mr-1"></i> {{ \Carbon\Carbon::now()->format('H:i') }} WIB</span>
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 3. STATISTIK PENGGUNA --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-16">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="stat-card bg-white rounded-3xl p-6 text-center shadow-lg border border-gray-100">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-file-lines text-white text-2xl"></i>
            </div>
            <p class="text-4xl font-bold text-emerald-700 count-up" data-target="{{ $totalSurat ?? 0 }}">{{ number_format($totalSurat ?? 0) }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-2 font-semibold">Total Pengajuan Surat</p>
            <div class="mt-3 w-full bg-gray-100 rounded-full h-1">
                <div class="bg-emerald-500 h-1 rounded-full" style="width: {{ min(($totalSurat ?? 0) / 50 * 100, 100) }}%"></div>
            </div>
        </div>
        <div class="stat-card bg-white rounded-3xl p-6 text-center shadow-lg border border-gray-100">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-comment-dots text-white text-2xl"></i>
            </div>
            <p class="text-4xl font-bold text-blue-700 count-up" data-target="{{ $totalAspirasi ?? 0 }}">{{ number_format($totalAspirasi ?? 0) }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-2 font-semibold">Aspirasi Terkirim</p>
            <div class="mt-3 w-full bg-gray-100 rounded-full h-1">
                <div class="bg-blue-500 h-1 rounded-full" style="width: {{ min(($totalAspirasi ?? 0) / 50 * 100, 100) }}%"></div>
            </div>
        </div>
        <div class="stat-card bg-white rounded-3xl p-6 text-center shadow-lg border border-gray-100">
            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-check-circle text-white text-2xl"></i>
            </div>
            <p class="text-4xl font-bold text-amber-700 count-up" data-target="{{ $suratSelesai ?? 0 }}">{{ number_format($suratSelesai ?? 0) }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-2 font-semibold">Surat Selesai</p>
            <div class="mt-3 w-full bg-gray-100 rounded-full h-1">
                <div class="bg-amber-500 h-1 rounded-full" style="width: {{ min(($suratSelesai ?? 0) / 50 * 100, 100) }}%"></div>
            </div>
        </div>
        <div class="stat-card bg-white rounded-3xl p-6 text-center shadow-lg border border-gray-100">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-clock text-white text-2xl"></i>
            </div>
            <p class="text-4xl font-bold text-purple-700 count-up" data-target="{{ $suratMenunggu ?? 0 }}">{{ number_format($suratMenunggu ?? 0) }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-2 font-semibold">Surat Diproses</p>
            <div class="mt-3 w-full bg-gray-100 rounded-full h-1">
                <div class="bg-purple-500 h-1 rounded-full" style="width: {{ min(($suratMenunggu ?? 0) / 50 * 100, 100) }}%"></div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 4. LAYANAN DIGITAL (AJUKAN SURAT & ASPIRASI SAJA) --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">⚡ Akses Cepat</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-4">Layanan Digital Desa</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-5 rounded-full"></div>
        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Nikmati berbagai layanan administrasi desa secara online tanpa harus datang ke kantor.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        {{-- Layanan Ajukan Surat --}}
        <a href="{{ route('masyarakat.surat.create') }}" class="service-card group relative bg-white rounded-3xl overflow-hidden shadow-xl cursor-pointer shine">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-emerald-600 opacity-0 group-hover:opacity-5 transition duration-500"></div>
            <div class="relative z-10 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 transition duration-300 group-hover:rotate-3">
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
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </a>

        {{-- Layanan Aspirasi --}}
        <a href="{{ route('masyarakat.aspirasi.create') }}" class="service-card group relative bg-white rounded-3xl overflow-hidden shadow-xl cursor-pointer shine">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-5 transition duration-500"></div>
            <div class="relative z-10 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 transition duration-300 group-hover:rotate-3">
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
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-blue-400 to-blue-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
        </a>
    </div>
</section>

{{-- ============================================= --}}
{{-- 5. STATUS PENGAJUAN SURAT TERBARU --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100" data-aos="fade-up">
        <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-5 border-b border-gray-100">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h2 class="text-2xl font-serif italic text-emerald-800">📋 Status Pengajuan Surat Terbaru</h2>
                    <p class="text-gray-500 text-sm mt-1">Pantau perkembangan pengajuan surat Anda</p>
                </div>
                <a href="{{ route('masyarakat.surat.index') }}" class="text-emerald-600 text-sm font-semibold hover:underline inline-flex items-center gap-1 group">
                    Lihat Semua <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if(isset($pengajuanTerbaru) && $pengajuanTerbaru->count() > 0)
                <div class="space-y-4">
                    @foreach($pengajuanTerbaru as $surat)
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center p-4 bg-gray-50 rounded-xl hover:bg-emerald-50 transition-all duration-300 hover:shadow-md">
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-800">{{ $surat->jenis_surat }}</h3>
                            <p class="text-xs text-gray-400 mt-1">Diajukan: {{ $surat->created_at->translatedFormat('d F Y, H:i') }}</p>
                            <div class="mt-2 w-full md:w-64">
                                <div class="h-1.5 bg-gray-200 rounded-full overflow-hidden">
                                    <div class="h-full rounded-full transition-all duration-1000
                                        @if($surat->status == 'menunggu') bg-yellow-500 w-1/3
                                        @elseif($surat->status == 'diproses') bg-blue-500 w-2/3
                                        @elseif($surat->status == 'selesai') bg-green-500 w-full
                                        @else bg-red-500 w-full @endif">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 mt-3 md:mt-0">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1
                                @if($surat->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($surat->status == 'diproses') bg-blue-100 text-blue-700
                                @elseif($surat->status == 'selesai') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                @if($surat->status == 'menunggu') <i class="fa-regular fa-clock"></i> Menunggu
                                @elseif($surat->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Diproses
                                @elseif($surat->status == 'selesai') <i class="fa-regular fa-circle-check"></i> Selesai
                                @else <i class="fa-regular fa-circle-xmark"></i> Ditolak @endif
                            </span>
                            <a href="{{ route('masyarakat.surat.show', $surat->id_surat) }}" class="text-emerald-600 hover:text-emerald-700 transition hover:scale-110">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-regular fa-file-lines text-3xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-400">Belum ada pengajuan surat</p>
                    <a href="{{ route('masyarakat.surat.create') }}" class="inline-block mt-3 text-emerald-600 text-sm font-semibold hover:underline">Ajukan Surat →</a>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 6. BERITA TERKINI & PENGUMUMAN --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100" data-aos="fade-right">
            <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-5 border-b border-gray-100">
                <div class="flex justify-between items-center flex-wrap gap-4">
                    <div>
                        <h2 class="text-2xl font-serif italic text-emerald-800">📰 Berita Terkini</h2>
                        <p class="text-gray-500 text-sm mt-1">Informasi terbaru dari Desa Lumban Silintong</p>
                    </div>
                    <a href="{{ route('berita') }}" class="text-emerald-600 text-sm font-semibold hover:underline inline-flex items-center gap-1 group">
                        Lihat Semua <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                    </a>
                </div>
            </div>
            <div class="p-6">
                @if(isset($beritas) && $beritas->count() > 0)
                    <div class="space-y-5">
                        @foreach($beritas as $berita)
                        <div class="news-card flex gap-4 pb-4 border-b border-gray-100 last:border-0 bg-white rounded-xl p-3">
                            <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 shadow-md">
                                <img src="{{ $berita->foto ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=100' }}" class="w-full h-full object-cover transition duration-500">
                            </div>
                            <div class="flex-1">
                                <span class="inline-block px-2 py-0.5 rounded text-[9px] font-bold uppercase
                                    @if($berita->kategori == 'berita') bg-blue-100 text-blue-700
                                    @elseif($berita->kategori == 'pengumuman') bg-amber-100 text-amber-700
                                    @else bg-emerald-100 text-emerald-700 @endif">
                                    {{ ucfirst($berita->kategori) }}
                                </span>
                                <h3 class="font-bold text-gray-800 mt-1 hover:text-emerald-600 transition line-clamp-2">
                                    <a href="{{ route('berita.show', $berita->id_berita) }}">{{ $berita->judul }}</a>
                                </h3>
                                <div class="flex items-center gap-3 mt-1">
                                    <p class="text-xs text-gray-400"><i class="fa-regular fa-calendar mr-1"></i> {{ $berita->created_at->translatedFormat('d M Y') }}</p>
                                    <p class="text-xs text-gray-400"><i class="fa-regular fa-eye mr-1"></i> {{ number_format($berita->dibaca ?? rand(10, 200)) }} dilihat</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fa-regular fa-newspaper text-3xl text-gray-400"></i>
                        </div>
                        <p class="text-gray-400">Belum ada berita terbaru</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="space-y-6" data-aos="fade-left">
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-amber-50 to-white px-6 py-4 border-b border-gray-100">
                    <h2 class="text-xl font-serif italic text-emerald-800 flex items-center gap-2">
                        <i class="fa-solid fa-bullhorn text-amber-500"></i> Pengumuman
                    </h2>
                </div>
                <div class="p-5">
                    @if(isset($pengumuman) && $pengumuman->count() > 0)
                        <div class="space-y-3">
                            @foreach($pengumuman as $p)
                            <div class="border-l-4 border-amber-400 pl-3 py-2 hover:bg-amber-50/50 rounded-r-lg transition-all duration-300 hover:translate-x-1">
                                <h4 class="font-semibold text-gray-800 text-sm">{{ $p->judul }}</h4>
                                <p class="text-xs text-gray-400 mt-1 flex items-center gap-1"><i class="fa-regular fa-calendar"></i> {{ $p->created_at->translatedFormat('d M Y') }}</p>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-400 text-sm text-center py-5">Tidak ada pengumuman</p>
                    @endif
                </div>
            </div>

            <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-3xl p-6 text-white shadow-xl floating">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-circle-info text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-serif italic">Info Cepat</h3>
                </div>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2 group hover:translate-x-1 transition"><i class="fa-solid fa-check-circle text-emerald-300"></i> Layanan surat online 24 jam</li>
                    <li class="flex items-center gap-2 group hover:translate-x-1 transition"><i class="fa-solid fa-check-circle text-emerald-300"></i> Aspirasi ditanggapi maksimal 3 hari</li>
                    <li class="flex items-center gap-2 group hover:translate-x-1 transition"><i class="fa-solid fa-check-circle text-emerald-300"></i> Kantor desa buka Senin-Sabtu</li>
                    <li class="flex items-center gap-2 group hover:translate-x-1 transition"><i class="fa-solid fa-check-circle text-emerald-300"></i> Bantuan: hubungi admin desa</li>
                </ul>
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 7. GALERI KEGIATAN --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100" data-aos="fade-up">
        <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-5 border-b border-gray-100">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h2 class="text-2xl font-serif italic text-emerald-800">📸 Galeri Kegiatan</h2>
                    <p class="text-gray-500 text-sm mt-1">Dokumentasi momen berharga desa</p>
                </div>
                <a href="{{ route('galeri') }}" class="text-emerald-600 text-sm font-semibold hover:underline inline-flex items-center gap-1 group">
                    Lihat Semua <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                </a>
            </div>
        </div>
        <div class="p-6">
            @if(isset($galeris) && $galeris->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach($galeris as $index => $g)
                    <div class="gallery-item group relative rounded-xl overflow-hidden shadow-md cursor-pointer">
                        <div class="h-40 overflow-hidden">
                            <img src="{{ $g->foto ?? 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=300' }}" class="w-full h-full object-cover transition duration-700">
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-3">
                            <p class="text-white text-xs font-semibold">{{ $g->judul_galeri ?? 'Dokumentasi' }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fa-regular fa-images text-3xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-400">Belum ada galeri foto</p>
                </div>
            @endif
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 8. TIPS & PANDUAN (ACCORDION STYLE - KLIK UNTUK BUKA) --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">💡 Panduan Pengguna</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-4">Tips & Panduan</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-5 rounded-full"></div>
        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Klik pada setiap kartu untuk membuka panduan lengkap penggunaan layanan digital desa.</p>
    </div>

    <div class="max-w-4xl mx-auto space-y-4" x-data="{ activeFaq: null }">
        {{-- FAQ 1: Cara Ajukan Surat --}}
        <div class="faq-item bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 transition-all duration-300" :class="{ 'active': activeFaq === 1, 'shadow-xl': activeFaq === 1 }" @click="activeFaq = activeFaq === 1 ? null : 1">
            <div class="flex justify-between items-center p-6 cursor-pointer hover:bg-emerald-50/30 transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-file-circle-check text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">📄 Cara Ajukan Surat</h3>
                        <p class="text-sm text-gray-500 mt-1">Panduan lengkap mengajukan surat administrasi online</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down text-emerald-500 transition-transform duration-300 faq-icon"></i>
            </div>
            <div class="faq-answer px-6 pb-6" x-show="activeFaq === 1" x-collapse>
                <div class="pt-2 border-t border-gray-100">
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <h4 class="font-semibold text-emerald-700 mb-3 flex items-center gap-2"><i class="fa-solid fa-list-check"></i> Langkah-langkah:</h4>
                            <ul class="space-y-3 text-gray-600 text-sm">
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold mt-0.5">1</span> Login ke akun masyarakat Anda</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold mt-0.5">2</span> Klik menu <span class="font-semibold">"Ajukan Surat"</span> di dashboard</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold mt-0.5">3</span> Pilih jenis surat yang dibutuhkan</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold mt-0.5">4</span> Isi formulir dengan data diri yang lengkap</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold mt-0.5">5</span> Unggah dokumen pendukung (jika diperlukan)</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-emerald-100 rounded-full flex items-center justify-center text-emerald-600 text-xs font-bold mt-0.5">6</span> Klik <span class="font-semibold">"Kirim"</span> dan tunggu verifikasi</li>
                            </ul>
                        </div>
                        <div class="bg-emerald-50 rounded-xl p-4">
                            <h4 class="font-semibold text-emerald-700 mb-3 flex items-center gap-2"><i class="fa-regular fa-lightbulb"></i> Tips:</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-emerald-500 text-xs mt-1"></i> Pastikan data NIK sesuai dengan KTP</li>
                                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-emerald-500 text-xs mt-1"></i> Upload dokumen dalam format PDF/JPG maksimal 2MB</li>
                                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-emerald-500 text-xs mt-1"></i> Cek secara berkala status pengajuan Anda</li>
                            </ul>
                            <div class="mt-4 p-3 bg-white rounded-lg">
                                <p class="text-xs text-gray-500"><i class="fa-regular fa-clock mr-1"></i> Estimasi waktu pemrosesan: 1-3 hari kerja</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FAQ 2: Cara Sampaikan Aspirasi --}}
        <div class="faq-item bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 transition-all duration-300" :class="{ 'active': activeFaq === 2, 'shadow-xl': activeFaq === 2 }" @click="activeFaq = activeFaq === 2 ? null : 2">
            <div class="flex justify-between items-center p-6 cursor-pointer hover:bg-emerald-50/30 transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-comment-dots text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">💬 Cara Sampaikan Aspirasi</h3>
                        <p class="text-sm text-gray-500 mt-1">Panduan menyampaikan saran, masukan, atau keluhan</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down text-emerald-500 transition-transform duration-300 faq-icon"></i>
            </div>
            <div class="faq-answer px-6 pb-6" x-show="activeFaq === 2" x-collapse>
                <div class="pt-2 border-t border-gray-100">
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <h4 class="font-semibold text-emerald-700 mb-3 flex items-center gap-2"><i class="fa-solid fa-list-check"></i> Langkah-langkah:</h4>
                            <ul class="space-y-3 text-gray-600 text-sm">
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs font-bold mt-0.5">1</span> Login ke akun masyarakat Anda</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs font-bold mt-0.5">2</span> Klik menu <span class="font-semibold">"Aspirasi"</span> di dashboard</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs font-bold mt-0.5">3</span> Pilih kategori aspirasi (saran/keluhan/masukan)</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs font-bold mt-0.5">4</span> Tulis judul dan isi aspirasi dengan jelas</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs font-bold mt-0.5">5</span> Lampirkan foto/dokumen pendukung (opsional)</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xs font-bold mt-0.5">6</span> Klik <span class="font-semibold">"Kirim"</span> dan aspirasi Anda akan diproses</li>
                            </ul>
                        </div>
                        <div class="bg-blue-50 rounded-xl p-4">
                            <h4 class="font-semibold text-blue-700 mb-3 flex items-center gap-2"><i class="fa-regular fa-lightbulb"></i> Tips:</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-blue-500 text-xs mt-1"></i> Sampaikan aspirasi dengan bahasa yang sopan</li>
                                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-blue-500 text-xs mt-1"></i> Sertakan bukti pendukung jika ada keluhan</li>
                                <li class="flex items-start gap-2"><i class="fa-solid fa-check text-blue-500 text-xs mt-1"></i> Aspirasi akan ditanggapi maksimal 3 hari</li>
                            </ul>
                            <div class="mt-4 p-3 bg-white rounded-lg">
                                <p class="text-xs text-gray-500"><i class="fa-regular fa-clock mr-1"></i> Estimasi respon: 1-3 hari kerja</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- FAQ 3: Pantau Status --}}
        <div class="faq-item bg-white rounded-2xl shadow-md overflow-hidden border border-gray-100 transition-all duration-300" :class="{ 'active': activeFaq === 3, 'shadow-xl': activeFaq === 3 }" @click="activeFaq = activeFaq === 3 ? null : 3">
            <div class="flex justify-between items-center p-6 cursor-pointer hover:bg-emerald-50/30 transition">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-magnifying-glass-chart text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">🔍 Pantau Status</h3>
                        <p class="text-sm text-gray-500 mt-1">Cek status pengajuan surat dan aspirasi Anda</p>
                    </div>
                </div>
                <i class="fa-solid fa-chevron-down text-emerald-500 transition-transform duration-300 faq-icon"></i>
            </div>
            <div class="faq-answer px-6 pb-6" x-show="activeFaq === 3" x-collapse>
                <div class="pt-2 border-t border-gray-100">
                    <div class="grid md:grid-cols-2 gap-6 mt-4">
                        <div>
                            <h4 class="font-semibold text-emerald-700 mb-3 flex items-center gap-2"><i class="fa-solid fa-list-check"></i> Cara Melihat Status:</h4>
                            <ul class="space-y-3 text-gray-600 text-sm">
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 text-xs font-bold mt-0.5">1</span> Login ke akun masyarakat Anda</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 text-xs font-bold mt-0.5">2</span> Buka menu <span class="font-semibold">"Riwayat Surat"</span> atau <span class="font-semibold">"Aspirasi"</span></li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 text-xs font-bold mt-0.5">3</span> Lihat status pada kolom yang tersedia</li>
                                <li class="flex items-start gap-3"><span class="w-5 h-5 bg-amber-100 rounded-full flex items-center justify-center text-amber-600 text-xs font-bold mt-0.5">4</span> Klik <span class="font-semibold">"Detail"</span> untuk informasi lebih lanjut</li>
                            </ul>
                        </div>
                        <div class="bg-amber-50 rounded-xl p-4">
                            <h4 class="font-semibold text-amber-700 mb-3 flex items-center gap-2"><i class="fa-regular fa-lightbulb"></i> Arti Status:</h4>
                            <ul class="space-y-2 text-sm text-gray-600">
                                <li class="flex items-start gap-2"><span class="w-3 h-3 bg-yellow-500 rounded-full mt-1"></span> <span class="font-semibold">Menunggu</span> - Pengajuan sedang dalam antrian</li>
                                <li class="flex items-start gap-2"><span class="w-3 h-3 bg-blue-500 rounded-full mt-1"></span> <span class="font-semibold">Diproses</span> - Sedang diproses oleh petugas</li>
                                <li class="flex items-start gap-2"><span class="w-3 h-3 bg-green-500 rounded-full mt-1"></span> <span class="font-semibold">Selesai</span> - Pengajuan telah selesai</li>
                                <li class="flex items-start gap-2"><span class="w-3 h-3 bg-red-500 rounded-full mt-1"></span> <span class="font-semibold">Ditolak</span> - Pengajuan ditolak, cek catatan</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 9. CTA BANTUAN --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-emerald-800 rounded-3xl p-10 text-center text-white shadow-2xl relative overflow-hidden" data-aos="zoom-in">
        <div class="absolute top-0 right-0 opacity-10">
            <i class="fa-solid fa-headset text-8xl"></i>
        </div>
        <div class="relative z-10">
            <h3 class="text-3xl font-serif italic mb-3">💬 Butuh Bantuan?</h3>
            <p class="text-emerald-100/80 mb-6 max-w-2xl mx-auto">Jika mengalami kendala dalam menggunakan layanan digital desa, silakan hubungi admin atau datang langsung ke kantor desa.</p>
            <div class="flex gap-5 justify-center flex-wrap">
                <a href="{{ route('kontak') }}" class="px-8 py-3.5 bg-white text-emerald-700 rounded-full font-semibold hover:bg-emerald-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1 inline-flex items-center gap-2">
                    <i class="fa-regular fa-envelope"></i> Hubungi Kami
                </a>
                <a href="#" class="px-8 py-3.5 border-2 border-white text-white rounded-full font-semibold hover:bg-white/10 transition-all duration-300 hover:-translate-y-1 inline-flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp"></i> WhatsApp
                </a>
            </div>
        </div>
    </div>
</section>

<script>
    // Counter Animation for Stats
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.count-up');
        counters.forEach(counter => {
            const target = parseInt(counter.dataset.target);
            if (target > 0) {
                let current = 0;
                const increment = target / 50;
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString();
                        setTimeout(updateCounter, 30);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };
                updateCounter();
            }
        });
    });
</script>
@endsection