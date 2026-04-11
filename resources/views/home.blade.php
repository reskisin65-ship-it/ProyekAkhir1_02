{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda - Desa Digital Premium')

@section('content')
{{-- ============================================= --}}
{{-- 1. HERO SLIDER --}}
{{-- ============================================= --}}
<section class="px-[5%] mb-20">
    <div class="slider-container group">
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
{{-- 2. WELCOME SECTION DENGAN STATISTIK --}}
{{-- ============================================= --}}
<section class="px-[5%] py-16 bg-gradient-to-br from-emerald-50 via-white to-emerald-50/30 rounded-[60px] mx-[5%] mb-20 shadow-sm">
    <div class="text-center max-w-3xl mx-auto mb-14">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">✨ Selamat Datang</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-5">Desa Lumban Silintong</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-6 rounded-full"></div>
        <p class="text-gray-600 mt-6 leading-relaxed text-lg">Desa digital yang mengintegrasikan teknologi modern dengan kearifan lokal Batak Toba. Kami hadir untuk memberikan pelayanan terbaik bagi seluruh warga.</p>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="text-center p-6 bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-emerald-100">
            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-users text-white text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-emerald-700">{{ $stat_penduduk ?? '2,450' }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1 font-semibold">Total Penduduk</p>
        </div>
        <div class="text-center p-6 bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-blue-100">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-house-user text-white text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-blue-700">{{ $stat_kk ?? '780' }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1 font-semibold">Kepala Keluarga</p>
        </div>
        <div class="text-center p-6 bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-amber-100">
            <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-store text-white text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-amber-700">{{ $stat_umkm_count ?? '45' }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1 font-semibold">UMKM Aktif</p>
        </div>
        <div class="text-center p-6 bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 border border-purple-100">
            <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <i class="fa-solid fa-map text-white text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-purple-700">{{ $stat_luas ?? '1,250' }}</p>
            <p class="text-xs text-gray-500 uppercase tracking-wider mt-1 font-semibold">Luas Wilayah (Ha)</p>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 3. LAYANAN PUBLIK (PROFIL DESA, BERITA, GALERI, UMKM, KONTAK) --}}
{{-- ============================================= --}}
<section id="layanan-publik" class="py-20 px-[5%] bg-gradient-to-br from-emerald-50/30 to-white rounded-[80px] mx-[5%] mb-20">
    <div class="text-center mb-14">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">📋 AKSES MUDAH</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-5">Layanan Publik</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-6 rounded-full"></div>
        <p class="text-gray-500 mt-5 max-w-2xl mx-auto">Akses berbagai layanan informasi desa secara mudah dan cepat. Pilih menu di bawah untuk menjelajahi konten desa.</p>
    </div>
    
    <div class="grid md:grid-cols-5 gap-6 max-w-6xl mx-auto">
        {{-- Profil Desa --}}
        <a href="{{ route('profil-desa') }}" class="group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-500 to-emerald-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-landmark-dome text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">Profil Desa</h3>
                <p class="text-xs text-gray-400">Sejarah & Struktur</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </div>
        </a>

        {{-- Berita --}}
        <a href="{{ route('berita') }}" class="group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-newspaper text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">Berita</h3>
                <p class="text-xs text-gray-400">Info & Pengumuman</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </div>
        </a>

        {{-- Galeri --}}
        <a href="{{ route('galeri') }}" class="group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-purple-500 to-purple-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-photo-film text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">Galeri</h3>
                <p class="text-xs text-gray-400">Dokumentasi Kegiatan</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </div>
        </a>

        {{-- UMKM --}}
        <a href="{{ route('umkm') }}" class="group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-amber-500 to-amber-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-shop text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">UMKM</h3>
                <p class="text-xs text-gray-400">Produk Unggulan</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </div>
        </a>

        {{-- Kontak --}}
        <a href="{{ route('kontak') }}" class="group relative bg-white rounded-2xl p-6 text-center shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 cursor-pointer overflow-hidden">
            <div class="absolute inset-0 bg-gradient-to-br from-rose-500 to-rose-700 opacity-0 group-hover:opacity-10 transition duration-500"></div>
            <div class="relative z-10">
                <div class="w-16 h-16 bg-gradient-to-br from-rose-500 to-rose-600 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg group-hover:scale-110 transition duration-300">
                    <i class="fa-solid fa-envelope text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-emerald-800 mb-1">Kontak</h3>
                <p class="text-xs text-gray-400">Hubungi Kami</p>
                <div class="mt-3 flex items-center justify-center gap-1 text-emerald-500 text-xs font-semibold opacity-0 group-hover:opacity-100 transition">
                    <span>Selengkapnya</span>
                    <i class="fa-solid fa-arrow-right text-xs"></i>
                </div>
            </div>
        </a>
    </div>
</section>

{{-- ============================================= --}}
{{-- 4. LAYANAN DIGITAL (SURAT & ASPIRASI TERKUNCI) --}}
{{-- ============================================= --}}
<section class="py-20 px-[5%] bg-gradient-to-r from-stone-100 to-white rounded-[80px] mx-[5%] mb-20">
    <div class="text-center mb-14">
        <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">⚡ Akses Cepat</span>
        <h2 class="text-5xl md:text-6xl font-serif italic text-emerald-900 mt-5">Layanan Digital Desa</h2>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-6 rounded-full"></div>
        <p class="text-gray-500 mt-5 max-w-2xl mx-auto">Akses layanan administrasi secara online. <span class="text-emerald-600 font-semibold">Login terlebih dahulu</span> untuk menggunakan layanan berikut.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-8 max-w-5xl mx-auto">
        {{-- Layanan Surat --}}
        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 cursor-pointer" onclick="window.location='/login'">
            <div class="absolute inset-0 bg-gradient-to-br from-emerald-600/10 to-emerald-800/10 opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="relative z-10 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl flex items-center justify-center mb-5 shadow-lg">
                            <i class="fa-solid fa-file-signature text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif italic text-emerald-800 mb-2">E-Surat Keterangan</h3>
                        <p class="text-gray-500 text-sm">Domisili, Usaha, Tidak Mampu, Kelahiran, Kematian, dan 12 jenis lainnya.</p>
                        <div class="mt-5 flex items-center gap-2 text-emerald-600 text-sm font-semibold group-hover:gap-3 transition-all">
                            <span>Ajukan Sekarang</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                    <div class="text-5xl text-emerald-100 group-hover:text-emerald-200 transition">
                        <i class="fa-solid fa-file-contract"></i>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-black/60 to-emerald-900/60 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 z-20">
                <div class="bg-white/95 backdrop-blur-md px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
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

        {{-- Layanan Aspirasi --}}
        <div class="group relative bg-white rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 cursor-pointer" onclick="window.location='/login'">
            <div class="absolute inset-0 bg-gradient-to-br from-blue-600/10 to-blue-800/10 opacity-0 group-hover:opacity-100 transition duration-500"></div>
            <div class="relative z-10 p-8">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mb-5 shadow-lg">
                            <i class="fa-solid fa-comment-dots text-white text-2xl"></i>
                        </div>
                        <h3 class="text-2xl font-serif italic text-emerald-800 mb-2">Aspirasi & Keluhan</h3>
                        <p class="text-gray-500 text-sm">Sampaikan suara, saran, atau keluhan Anda langsung ke jajaran perangkat desa.</p>
                        <div class="mt-5 flex items-center gap-2 text-emerald-600 text-sm font-semibold group-hover:gap-3 transition-all">
                            <span>Sampaikan Aspirasi</span>
                            <i class="fa-solid fa-arrow-right text-xs"></i>
                        </div>
                    </div>
                    <div class="text-5xl text-blue-100 group-hover:text-blue-200 transition">
                        <i class="fa-solid fa-message"></i>
                    </div>
                </div>
            </div>
            <div class="absolute inset-0 bg-gradient-to-br from-black/60 to-blue-900/60 backdrop-blur-sm flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-500 z-20">
                <div class="bg-white/95 backdrop-blur-md px-6 py-4 rounded-2xl shadow-2xl flex items-center gap-3">
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
{{-- 5. PROFIL DESA PREVIEW --}}
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
{{-- 7. BERITA & PENGUMUMAN --}}
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
                    @foreach($beritas as $b)
                    <div class="group cursor-pointer bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300">
                        <div class="rounded-t-2xl overflow-hidden h-56 relative">
                            <img src="{{ $b->cover }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider text-emerald-700">{{ $b->kategori }}</div>
                        </div>
                        <div class="p-5">
                            <h4 class="text-xl font-serif italic text-emerald-800 group-hover:text-emerald-500 transition line-clamp-2">{{ $b->judul }}</h4>
                            <p class="text-sm text-gray-500 mt-2 leading-relaxed line-clamp-2">{{ $b->ringkasan }}</p>
                            <div class="mt-4 flex items-center gap-4 text-xs text-gray-400">
                                <span><i class="fa-regular fa-calendar mr-1"></i> {{ \Carbon\Carbon::parse($b->tanggal)->format('d M Y') ?? 'Jan 2025' }}</span>
                                <span><i class="fa-regular fa-eye mr-1"></i> {{ number_format($b->dibaca ?? rand(50,500)) }} dibaca</span>
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
                            <span class="text-[9px] font-black text-emerald-500 tracking-wider">{{ $p->tanggal ?? 'Jan 2025' }}</span>
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
                    <img src="{{ $a->foto }}" class="w-full h-full object-cover">
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
{{-- 9. UMKM (PASAR DIGITAL) --}}
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
                    <img src="{{ $u->image }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                    <div class="absolute bottom-4 left-4 bg-white/95 backdrop-blur-md px-4 py-2 rounded-xl shadow-md">
                        <span class="text-lg font-black text-emerald-700">Rp {{ number_format($u->price, 0, ',', '.') }}</span>
                    </div>
                    <div class="absolute top-4 right-4 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white px-3 py-1 rounded-full text-[9px] font-bold shadow-md">⭐ UMKM Unggulan</div>
                </div>
                <div class="p-5">
                    <h4 class="text-xl font-serif italic text-emerald-800">{{ $u->name }}</h4>
                    <p class="text-[9px] font-black uppercase text-emerald-500 tracking-[0.3em] mt-2">Produk Unggulan Desa</p>
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
{{-- 10. GALERI --}}
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
                <div class="h-72 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:scale-95">
                    <img src="{{ $g->photo }}" class="w-full h-full object-cover hover:scale-110 transition duration-500">
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
{{-- 11. PETA & FAQ --}}
{{-- ============================================= --}}
<section id="peta" class="py-20 px-[5%] bg-gradient-to-br from-stone-100 to-white rounded-[80px] mx-[5%] mb-20">
    <div class="grid lg:grid-cols-2 gap-16">
        <div class="rounded-2xl overflow-hidden shadow-xl h-[450px] border-4 border-white">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.668102377317!2d99.0435942!3d2.332309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04306443c683%3A0x868a8600868a86!2sLumban%20Silintong!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div>
            <span class="text-emerald-500 font-black tracking-[0.3em] text-[10px] uppercase bg-emerald-100 px-4 py-1.5 rounded-full inline-block">📍 Info & Bantuan</span>
            <h2 class="text-4xl md:text-5xl font-serif italic mb-8 mt-4 text-emerald-900">Pusat Informasi</h2>
            <div class="space-y-4">
                @php
                    $faqs = [
                        ['q' => 'Bagaimana cara registrasi warga?', 'a' => 'Kunjungi kantor desa dengan membawa KTP dan KK asli untuk proses verifikasi oleh admin portal.'],
                        ['q' => 'Apakah layanan surat digital berbayar?', 'a' => 'Tidak. Seluruh layanan administrasi melalui portal ini gratis tanpa biaya sepeser pun.'],
                        ['q' => 'Bagaimana jika lupa password portal?', 'a' => 'Silakan klik tombol "Lupa Password" atau hubungi petugas IT desa di kantor.'],
                        ['q' => 'Apakah UMKM bisa mendaftar sendiri?', 'a' => 'Ya, pemilik UMKM dapat mendaftar melalui menu "Request Akun UMKM" setelah login sebagai masyarakat.'],
                    ];
                @endphp
                @foreach($faqs as $i => $f)
                <div class="bg-white p-5 rounded-xl border border-gray-100 cursor-pointer transition-all hover:border-emerald-200 hover:shadow-md" @click="faq === {{ $i }} ? faq = null : faq = {{ $i }}">
                    <div class="flex justify-between items-center text-emerald-800 font-semibold">
                        <span class="flex items-center gap-2"><i class="fa-regular fa-circle-question text-emerald-500"></i> {{ $f['q'] }}</span>
                        <i class="fa-solid text-emerald-500 transition-transform duration-300" :class="faq === {{ $i }} ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </div>
                    <div x-show="faq === {{ $i }}" x-collapse class="mt-3 text-sm text-gray-500 leading-relaxed pl-6 border-l-2 border-emerald-200">
                        {{ $f['a'] }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================= --}}
{{-- 12. CTA SECTION --}}
{{-- ============================================= --}}
<section class="py-20 px-[5%]">
    <div class="bg-gradient-to-r from-emerald-800 via-emerald-700 to-emerald-800 rounded-3xl p-12 text-center text-white shadow-2xl">
        <h2 class="text-4xl md:text-5xl font-serif italic mb-4">✨ Siap Menjadi Bagian dari Desa Digital?</h2>
        <p class="text-emerald-100/90 mb-8 max-w-2xl mx-auto text-lg">Daftarkan diri Anda sekarang untuk mengakses layanan administrasi digital, berita terkini, dan berbagai fitur menarik lainnya.</p>
        <div class="flex gap-5 justify-center flex-wrap">
            <a href="/register" class="px-8 py-3.5 bg-white text-emerald-700 rounded-full font-bold hover:bg-emerald-50 transition-all duration-300 shadow-lg hover:shadow-xl hover:-translate-y-1">📝 Daftar Sekarang</a>
            <a href="/login" class="px-8 py-3.5 border-2 border-white text-white rounded-full font-bold hover:bg-white/10 transition-all duration-300 hover:-translate-y-1">🔐 Login</a>
        </div>
    </div>
</section>


@endsection