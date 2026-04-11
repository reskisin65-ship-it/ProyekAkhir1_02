{{-- resources/views/masyarakat/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Masyarakat - Lumban Silintong')

@section('content')
<style>
    .floating {
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
        100% { transform: translateY(0px); }
    }
    .pulse-slow {
        animation: pulse 2s ease-in-out infinite;
    }
    @keyframes pulse {
        0%, 100% { opacity: 1; }
        50% { opacity: 0.7; }
    }
    .shine {
        position: relative;
        overflow: hidden;
    }
    .shine::after {
        content: '';
        position: absolute;
        top: -50%;
        left: -60%;
        width: 200%;
        height: 200%;
        background: linear-gradient(115deg, rgba(255,255,255,0) 10%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 90%);
        transform: rotate(25deg);
        animation: shine 3s infinite;
    }
    @keyframes shine {
        0% { transform: translateX(-100%) rotate(25deg); }
        20% { transform: translateX(100%) rotate(25deg); }
        100% { transform: translateX(100%) rotate(25deg); }
    }
    .card-hover {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover:hover {
        transform: translateY(-8px) scale(1.02);
        box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.25);
    }
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
    .gradient-border {
        position: relative;
        background: white;
        border-radius: 24px;
    }
    .gradient-border::before {
        content: '';
        position: absolute;
        inset: -2px;
        background: linear-gradient(135deg, #10b981, #3b82f6, #f59e0b);
        border-radius: 26px;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .gradient-border:hover::before {
        opacity: 1;
    }
</style>

{{-- ============================================= --}}
{{-- 1. HERO SLIDER (KARUSEL GAMBAR BESAR) --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-10">
    <div class="slider-container group relative rounded-3xl overflow-hidden shadow-2xl" x-data="{ slide: 0, totalSlides: 5 }" x-init="setInterval(() => slide = (slide + 1) % totalSlides, 5000)">
        <div class="slider-wrapper flex transition-transform duration-700 ease-out" :style="'transform: translateX(-' + (slide * 100) + '%)'">
            @php
                $heroSlides = [
                    ['title' => 'Selamat Datang di Portal Desa Digital', 'subtitle' => 'Nikmati kemudahan layanan administrasi online', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', 'btn_text' => 'Ajukan Surat', 'btn_link' => '#'],
                    ['title' => 'Layanan Surat Online 24 Jam', 'subtitle' => 'Ajukan surat kapan saja, di mana saja', 'img' => 'https://images.unsplash.com/photo-1582407947304-fd86f028f716', 'btn_text' => 'Ajukan Sekarang', 'btn_link' => '#'],
                    ['title' => 'Sampaikan Aspirasimu', 'subtitle' => 'Suaramu penting untuk kemajuan desa', 'img' => 'https://images.unsplash.com/photo-1472214103451-9374bd1c798e', 'btn_text' => 'Sampaikan Aspirasi', 'btn_link' => '#'],
                    ['title' => 'Dukung UMKM Lokal', 'subtitle' => 'Belanja produk unggulan desa', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b', 'btn_text' => 'Lihat UMKM', 'btn_link' => '#'],
                    ['title' => 'Desa Digital Modern', 'subtitle' => 'Transparansi dan pelayanan terbaik', 'img' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e', 'btn_text' => 'Jelajahi', 'btn_link' => '#'],
                ];
            @endphp
            @foreach($heroSlides as $hs)
            <div class="slide min-w-full h-[500px] relative">
                <img src="{{ $hs['img'] }}?auto=format&fit=crop&q=80&w=1600" class="absolute inset-0 w-full h-full object-cover brightness-75">
                <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/50 to-transparent"></div>
                <div class="absolute inset-0 flex flex-col justify-center px-12 md:px-20">
                    <h1 class="text-4xl md:text-6xl font-serif italic text-white mb-4 animate-fade-in-up">{{ $hs['title'] }}</h1>
                    <p class="text-lg md:text-xl text-white/90 mb-8 max-w-2xl">{{ $hs['subtitle'] }}</p>
                    <div class="flex gap-4">
                        <a href="{{ $hs['btn_link'] }}" class="px-6 py-3 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-full font-semibold hover:from-emerald-600 hover:to-emerald-700 transition shadow-lg hover:shadow-xl transform hover:-translate-y-1">
                            {{ $hs['btn_text'] }}
                        </a>
                        <a href="{{ route('profil-desa') }}" class="px-6 py-3 bg-white/20 backdrop-blur border border-white/30 text-white rounded-full font-semibold hover:bg-white/30 transition">
                            Pelajari Desa
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="absolute bottom-5 left-1/2 -translate-x-1/2 flex gap-2 z-10">
            @foreach($heroSlides as $index => $hs)
            <div @click="slide = {{ $index }}" class="w-2 h-2 rounded-full cursor-pointer transition-all duration-300" :class="slide === {{ $index }} ? 'bg-emerald-400 w-8' : 'bg-white/60'"></div>
            @endforeach
        </div>
        <button @click="slide = (slide - 1 + totalSlides) % totalSlides" class="absolute left-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/30 hover:bg-black/50 rounded-full flex items-center justify-center text-white transition z-10">
            <i class="fa-solid fa-chevron-left"></i>
        </button>
        <button @click="slide = (slide + 1) % totalSlides" class="absolute right-4 top-1/2 -translate-y-1/2 w-10 h-10 bg-black/30 hover:bg-black/50 rounded-full flex items-center justify-center text-white transition z-10">
            <i class="fa-solid fa-chevron-right"></i>
        </button>
    </div>
</section>

{{-- ============================================= --}}
{{-- 2. GREETING CARD DENGAN ANIMASI --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-10">
    <div class="bg-gradient-to-r from-emerald-600 via-emerald-700 to-emerald-800 rounded-3xl p-8 text-white shadow-2xl relative overflow-hidden floating">
        <div class="absolute top-0 right-0 opacity-10">
            <i class="fa-solid fa-user-check text-8xl"></i>
        </div>
        <div class="relative z-10">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center text-3xl">
                    <i class="fa-regular fa-face-smile"></i>
                </div>
                <div>
                    <h1 class="text-3xl md:text-4xl font-serif italic">Selamat Datang, {{ Auth::user()->name }}!</h1>
                    <p class="text-emerald-100 mt-1">Senang bertemu dengan Anda hari ini 🌟</p>
                </div>
            </div>
            <p class="text-emerald-100/90 max-w-2xl mt-4">Nikmati berbagai layanan digital desa yang dapat diakses dengan mudah. Ajukan surat, sampaikan aspirasi, dan pantau informasinya secara real-time.</p>
            <div class="mt-4 flex gap-2">
                <span class="bg-white/20 px-3 py-1 rounded-full text-xs">📅 {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</span>
                <span class="bg-white/20 px-3 py-1 rounded-full text-xs">🕐 {{ \Carbon\Carbon::now()->format('H:i') }} WIB</span>
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 3. STATISTIK PENGGUNA (DENGAN COUNTER ANIMASI) --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-16">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="stat-card bg-white rounded-3xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-l-4 border-emerald-500 group">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-file-lines text-white text-2xl"></i>
            </div>
            <p class="text-4xl font-bold text-emerald-700 count-up" data-target="{{ $totalSurat ?? 0 }}">{{ number_format($totalSurat ?? 0) }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-2 font-semibold">Total Pengajuan Surat</p>
        </div>
        <div class="stat-card bg-white rounded-3xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-l-4 border-blue-500 group">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-comment-dots text-white text-2xl"></i>
            </div>
            <p class="text-4xl font-bold text-blue-700 count-up" data-target="{{ $totalAspirasi ?? 0 }}">{{ number_format($totalAspirasi ?? 0) }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-2 font-semibold">Aspirasi Terkirim</p>
        </div>
        <div class="stat-card bg-white rounded-3xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-l-4 border-amber-500 group">
            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-check-circle text-white text-2xl"></i>
            </div>
            <p class="text-4xl font-bold text-amber-700 count-up" data-target="{{ $suratSelesai ?? 0 }}">{{ number_format($suratSelesai ?? 0) }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-2 font-semibold">Surat Selesai</p>
        </div>
        <div class="stat-card bg-white rounded-3xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-l-4 border-purple-500 group">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-clock text-white text-2xl"></i>
            </div>
            <p class="text-4xl font-bold text-purple-700 count-up" data-target="{{ $suratMenunggu ?? 0 }}">{{ number_format($suratMenunggu ?? 0) }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-2 font-semibold">Surat Diproses</p>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 4. LAYANAN DIGITAL (TANPA GEMBOK - FULL AKSES) DENGAN ANIMASI --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="text-center mb-12" data-aos="fade-up">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">⚡ Akses Cepat</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-4">Layanan Digital Desa</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-5 rounded-full"></div>
        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Nikmati berbagai layanan administrasi desa secara online tanpa harus datang ke kantor.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        {{-- Layanan Surat --}}
        <a href="{{ route('masyarakat.surat.create') }}" class="group relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 cursor-pointer card-hover gradient-border">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-emerald-600 opacity-0 group-hover:opacity-5 transition duration-500"></div>
            <div class="relative z-10 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 transition duration-300 group-hover:rotate-3">
                            <i class="fa-solid fa-file-signature text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif italic text-emerald-800 mb-2">Ajukan Surat</h3>
                        <p class="text-gray-500 text-sm">Domisili, Usaha, Tidak Mampu, Kelahiran, Kematian, dan lainnya.</p>
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
        </a>

        {{-- Layanan Aspirasi --}}
        <a href="{{ route('masyarakat.aspirasi.create') }}" class="group relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 cursor-pointer card-hover gradient-border">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-600 opacity-0 group-hover:opacity-5 transition duration-500"></div>
            <div class="relative z-10 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-5 shadow-lg group-hover:scale-110 transition duration-300 group-hover:rotate-3">
                            <i class="fa-solid fa-comment-dots text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif italic text-emerald-800 mb-2">Aspirasi & Keluhan</h3>
                        <p class="text-gray-500 text-sm">Sampaikan suara, saran, atau keluhan Anda langsung ke perangkat desa.</p>
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
        </a>
    </div>
</section>

{{-- ============================================= --}}
{{-- 5. STATUS PENGAJUAN SURAT TERBARU (DENGAN PROGRESS BAR) --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100" data-aos="fade-up">
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
{{-- 6. BERITA TERKINI & PENGUMUMAN (DENGAN CARD HOVER EFFECT) --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="grid lg:grid-cols-3 gap-8">
        {{-- Berita Terkini --}}
        <div class="lg:col-span-2 bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100" data-aos="fade-right">
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
                        <div class="flex gap-4 pb-4 border-b border-gray-100 last:border-0 group hover:bg-emerald-50/30 -mx-2 p-2 rounded-xl transition-all duration-300">
                            <div class="w-24 h-24 rounded-xl overflow-hidden flex-shrink-0 shadow-md group-hover:shadow-lg transition">
                                <img src="{{ $berita->foto ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=100' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                            </div>
                            <div class="flex-1">
                                <span class="inline-block px-2 py-0.5 rounded text-[9px] font-bold uppercase
                                    @if($berita->kategori == 'berita') bg-blue-100 text-blue-700
                                    @elseif($berita->kategori == 'pengumuman') bg-amber-100 text-amber-700
                                    @else bg-emerald-100 text-emerald-700 @endif">
                                    {{ ucfirst($berita->kategori) }}
                                </span>
                                <h3 class="font-bold text-gray-800 mt-1 group-hover:text-emerald-600 transition line-clamp-2">
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

        {{-- Pengumuman & Info Cepat --}}
        <div class="space-y-6" data-aos="fade-left">
            {{-- Pengumuman --}}
            <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100">
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

            {{-- Info Cepat dengan Background Gradient --}}
            <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-3xl p-6 text-white shadow-lg floating">
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

            {{-- Quote of the Day --}}
            <div class="bg-white rounded-3xl p-6 shadow-md border border-gray-100 text-center">
                <i class="fa-solid fa-quote-left text-emerald-300 text-2xl mb-3"></i>
                <p class="text-gray-600 italic text-sm">"Bersama kita bangun desa digital yang modern, transparan, dan berbudaya."</p>
                <p class="text-xs text-emerald-600 mt-3 font-semibold">- Pemerintah Desa Lumban Silintong</p>
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 7. GALERI KEGIATAN (DENGAN MASONRY GRID) --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="bg-white rounded-3xl shadow-lg overflow-hidden border border-gray-100" data-aos="fade-up">
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
                    <div class="group relative rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:scale-105 cursor-pointer" data-aos="zoom-in" data-aos-delay="{{ $index * 100 }}">
                        <div class="h-40 overflow-hidden">
                            <img src="{{ $g->foto ?? 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=300' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
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
{{-- 8. TIPS & PANDUAN (DENGAN ICON ANIMASI) --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="text-center mb-10" data-aos="fade-up">
        <h2 class="text-3xl md:text-4xl font-serif italic text-emerald-800">💡 Tips & Panduan</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-3 rounded-full"></div>
        <p class="text-gray-500 mt-3">Panduan mudah menggunakan layanan digital desa</p>
    </div>
    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-gradient-to-br from-emerald-50 to-white rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 group" data-aos="flip-left">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-file-circle-check text-white text-2xl"></i>
            </div>
            <h3 class="font-semibold text-emerald-800 mb-2">Cara Ajukan Surat</h3>
            <p class="text-gray-500 text-sm">Pilih jenis surat, isi data diri, dan kirim. Surat akan diproses oleh perangkat desa.</p>
        </div>
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 group" data-aos="flip-left" data-aos-delay="100">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-comment text-white text-2xl"></i>
            </div>
            <h3 class="font-semibold text-emerald-800 mb-2">Cara Sampaikan Aspirasi</h3>
            <p class="text-gray-500 text-sm">Tulis judul, pilih kategori, dan sampaikan aspirasi Anda. Akan ditanggapi maksimal 3 hari.</p>
        </div>
        <div class="bg-gradient-to-br from-amber-50 to-white rounded-2xl p-6 text-center shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 group" data-aos="flip-left" data-aos-delay="200">
            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                <i class="fa-solid fa-magnifying-glass-chart text-white text-2xl"></i>
            </div>
            <h3 class="font-semibold text-emerald-800 mb-2">Pantau Status</h3>
            <p class="text-gray-500 text-sm">Cek status pengajuan surat Anda di menu Riwayat Surat secara real-time.</p>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 9. CTA BANTUAN (DENGAN BACKGROUND GRADIENT) --}}
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