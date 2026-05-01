{{-- resources/views/umkm/index.blade.php --}}
@extends('layouts.app')

@section('title', 'UMKM Desa Lumban Silintong')

@section('content')
<!-- Plugin: Animate.css & FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="min-h-screen bg-[#F8FAFC] py-12 overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- 1. Hero & Stats Section --}}
        <div class="relative mb-16">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8">
                <div class="animate__animated animate__fadeInLeft">
                    <span class="inline-block px-4 py-1 mb-4 text-[10px] font-black tracking-[0.3em] text-emerald-600 uppercase bg-emerald-100/50 rounded-full">
                        Local Pride
                    </span>
                    <h1 class="text-5xl md:text-7xl font-black text-slate-900 leading-none tracking-tight">
                        Pusat <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">UMKM</span>
                    </h1>
                    <p class="mt-4 text-slate-500 text-lg font-light max-w-md">
                        Koleksi produk unggulan dari tangan kreatif warga Desa Lumban Silintong.
                    </p>
                </div>

                {{-- Stats Grid --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 animate__animated animate__fadeInRight">
                    @php
                        $stats = [
                            ['label' => 'Total Usaha', 'count' => $umkms->total(), 'color' => 'slate'],
                            ['label' => 'Kuliner', 'count' => $umkms->where('kategori', 'makanan')->count(), 'color' => 'orange'],
                            ['label' => 'Kriya', 'count' => $umkms->where('kategori', 'kerajinan')->count(), 'color' => 'blue'],
                            ['label' => 'Fashion', 'count' => $umkms->where('kategori', 'fashion')->count(), 'color' => 'purple'],
                        ];
                    @endphp
                    @foreach($stats as $stat)
                    <div class="bg-white p-5 rounded-[2rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group">
                        <div class="text-2xl font-black text-{{ $stat['color'] }}-600 group-hover:scale-110 transition-transform">
                            {{ $stat['count'] }}
                        </div>
                        <div class="text-[10px] uppercase tracking-wider font-bold text-slate-400">{{ $stat['label'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- 2. Action & Filter Bar --}}
        <div class="flex flex-col md:flex-row items-center justify-between gap-6 mb-12 animate__animated animate__fadeInUp">
            {{-- Filter --}}
            <div class="flex p-1.5 bg-slate-200/50 backdrop-blur-md rounded-full w-full md:w-auto overflow-x-auto no-scrollbar">
                <button class="filter-btn active whitespace-nowrap px-8 py-2.5 rounded-full text-xs font-black transition-all" data-target="all">SEMUA</button>
                <button class="filter-btn whitespace-nowrap px-8 py-2.5 rounded-full text-xs font-black text-slate-500 transition-all" data-target="makanan">MAKANAN</button>
                <button class="filter-btn whitespace-nowrap px-8 py-2.5 rounded-full text-xs font-black text-slate-500 transition-all" data-target="kerajinan">KERAJINAN</button>
                <button class="filter-btn whitespace-nowrap px-8 py-2.5 rounded-full text-xs font-black text-slate-500 transition-all" data-target="fashion">FASHION</button>
            </div>

            {{-- Create/Manage Button --}}
            @auth
                @php 
                    $myUmkm = $umkms->where('user_id', Auth::id())->first(); 
                    if(!$myUmkm) {
                        $myUmkm = \App\Models\Umkm::where('user_id', Auth::id())->first();
                    }
                @endphp
                
                @if(!$myUmkm)
                    {{-- Belum punya UMKM --}}
                    <a href="{{ route('umkm.create') }}" class="group flex items-center gap-3 px-8 py-4 bg-emerald-600 text-white rounded-full font-bold shadow-lg shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all">
                        <span>DAFTARKAN USAHA</span>
                        <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform"></i>
                    </a>
                @elseif($myUmkm->status == 'approved')
                    {{-- UMKM sudah disetujui --}}
                    <a href="{{ route('umkm.show', $myUmkm->id_umkm) }}" class="group flex items-center gap-3 px-8 py-4 bg-slate-900 text-white rounded-full font-bold shadow-lg hover:shadow-slate-200 hover:-translate-y-1 transition-all">
                        <span>KELOLA USAHA</span>
                        <i class="fa-solid fa-gear group-hover:rotate-90 transition-transform"></i>
                    </a>
                @elseif($myUmkm->status == 'pending')
                    {{-- UMKM masih menunggu persetujuan (KUNING) --}}
                    <a href="{{ route('masyarakat.umkm.status') }}" class="group flex items-center gap-3 px-8 py-4 bg-amber-500 text-white rounded-full font-bold shadow-lg shadow-amber-200 hover:bg-amber-600 hover:-translate-y-1 transition-all">
                        <span class="flex items-center gap-2">
                            <i class="fa-regular fa-clock fa-pulse"></i>
                            MENUNGGU PERSETUJUAN
                        </span>
                        <i class="fa-solid fa-chart-simple group-hover:rotate-12 transition-transform"></i>
                    </a>
                @elseif($myUmkm->status == 'rejected')
                    {{-- UMKM ditolak --}}
                    <a href="{{ route('umkm.create') }}" class="group flex items-center gap-3 px-8 py-4 bg-red-500 text-white rounded-full font-bold shadow-lg shadow-red-200 hover:bg-red-600 hover:-translate-y-1 transition-all">
                        <span>AJUKAN ULANG</span>
                        <i class="fa-solid fa-rotate-right group-hover:rotate-90 transition-transform"></i>
                    </a>
                @endif
            @endauth
        </div>

        {{-- 3. UMKM Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($umkms as $index => $item)
            <div class="umkm-card group bg-white rounded-[3rem] p-4 border border-slate-50 shadow-[0_20px_50px_rgba(0,0,0,0.02)] hover:shadow-[0_40px_80px_rgba(0,0,0,0.06)] transition-all duration-500 hover:-translate-y-3" 
                 data-kategori="{{ strtolower($item->kategori) }}">
                
                {{-- Image Container --}}
                <div class="relative h-64 rounded-[2.5rem] overflow-hidden">
                    <img src="{{ $item->logo ? asset('storage/' . $item->logo) : 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800' }}" 
                         class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    
                    {{-- Category Badge --}}
                    <div class="absolute top-5 left-5">
                        <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-emerald-700 text-[10px] font-black uppercase tracking-widest rounded-full shadow-sm">
                            {{ $item->kategori }}
                        </span>
                    </div>
                    
                    {{-- Status Badge untuk UMKM milik sendiri yang pending --}}
                    @if(Auth::check() && Auth::id() == $item->user_id && $item->status == 'pending')
                    <div class="absolute top-5 right-5">
                        <span class="px-3 py-1 bg-amber-500 text-white text-[8px] font-black uppercase tracking-wider rounded-full shadow-sm">
                            <i class="fa-regular fa-clock"></i> Menunggu
                        </span>
                    </div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="p-6">
                    <h3 class="text-2xl font-bold text-slate-800 mb-2 group-hover:text-emerald-600 transition-colors">{{ $item->nama_usaha }}</h3>
                    <p class="text-slate-400 text-sm font-light leading-relaxed mb-6 line-clamp-2">{{ $item->deskripsi }}</p>

                    <div class="flex items-center justify-between pb-4 border-b border-slate-50">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center text-[10px] font-bold text-slate-500 capitalize">
                                {{ substr($item->pemilik, 0, 1) }}
                            </div>
                            <span class="text-xs font-bold text-slate-600">{{ $item->pemilik }}</span>
                        </div>
                        
                        {{-- Tombol Detail/Kelola berdasarkan status --}}
                        @if(Auth::check() && Auth::id() == $item->user_id)
                            @if($item->status == 'approved')
                                <a href="{{ route('umkm.show', $item->id_umkm) }}" class="group/btn relative overflow-hidden px-5 py-2 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-full text-xs font-black uppercase tracking-wider shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                                    <span class="relative z-10 flex items-center gap-2">
                                        <i class="fa-solid fa-screwdriver-wrench"></i>
                                        KELOLA
                                    </span>
                                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 transform scale-x-0 group-hover/btn:scale-x-100 transition-transform duration-300 origin-left"></div>
                                </a>
                            @else
                                <a href="{{ route('masyarakat.umkm.status') }}" class="group/btn relative overflow-hidden px-5 py-2 bg-amber-100 text-amber-700 rounded-full text-xs font-black uppercase tracking-wider shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-0.5">
                                    <span class="relative z-10 flex items-center gap-2">
                                        <i class="fa-regular fa-clock"></i>
                                        STATUS
                                    </span>
                                    <div class="absolute inset-0 bg-amber-200 transform scale-x-0 group-hover/btn:scale-x-100 transition-transform duration-300 origin-left"></div>
                                </a>
                            @endif
                        @else
                            <a href="{{ route('umkm.show', $item->id_umkm) }}" class="group/btn relative overflow-hidden px-5 py-2 bg-slate-100 text-emerald-600 rounded-full text-xs font-black uppercase tracking-wider hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-0.5">
                                <span class="relative z-10 flex items-center gap-1">
                                    Detail 
                                    <i class="fa-solid fa-arrow-right group-hover/btn:translate-x-1 transition-transform"></i>
                                </span>
                            </a>
                        @endif
                    </div>

                    {{-- Fitur Edit & Hapus (Hanya muncul jika pemilik dan UMKM sudah approved) --}}
                    @if(Auth::check() && Auth::id() == $item->user_id && $item->status == 'approved')
                    <div class="mt-4 flex gap-2">
                        <a href="{{ route('umkm.edit', $item->id_umkm) }}" class="flex-1 py-3 bg-amber-50 text-amber-600 text-center rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-amber-100 transition-colors">
                            <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                        </a>
                        <form action="{{ route('umkm.destroy', $item->id_umkm) }}" method="POST" class="flex-1">
                            @csrf @method('DELETE')
                            <button type="submit" class="w-full py-3 bg-red-50 text-red-600 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-100 transition-colors" onclick="return confirm('Hapus UMKM?')">
                                <i class="fa-solid fa-trash mr-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="col-span-full py-20 text-center">
                <div class="text-6xl mb-4">🏪</div>
                <p class="text-slate-400">Belum ada UMKM yang terdaftar di kategori ini.</p>
            </div>
            @endforelse
        </div>

        {{-- Pagination --}}
        <div class="mt-10">
            {{ $umkms->links() }}
        </div>

        {{-- ============================================== --}}
        {{-- TUTORIAL SECTION PREMIUM --}}
        {{-- ============================================== --}}
        <div class="mt-16 bg-white rounded-[3rem] border border-slate-100 p-8 md:p-12 shadow-[0_30px_60px_-20px_rgba(0,0,0,0.05)]">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fa-regular fa-circle-question text-white text-2xl"></i>
                </div>
                <div>
                    <h3 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tighter">📖 Tentang Halaman <span class="text-emerald-500">Pusat UMKM</span></h3>
                    <p class="text-slate-400 text-sm mt-1">Panduan lengkap menggunakan portal UMKM Desa Lumban Silintong</p>
                </div>
            </div>
            
            <p class="text-slate-500 leading-relaxed mb-10 pb-4 border-b border-slate-100">
                Halaman <strong>Pusat UMKM</strong> menyajikan informasi lengkap tentang pelaku usaha, 
                produk unggulan, serta cara terhubung dengan pemilik usaha di Desa Lumban Silintong.
            </p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">1</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">🏷️ <span>Filter Kategori</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Gunakan tombol filter di atas untuk melihat UMKM berdasarkan kategori usaha (Kuliner, Kerajinan, atau Fashion).</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">2</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">👀 <span>Lihat Detail UMKM</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Klik tombol "Detail" untuk melihat informasi lengkap UMKM termasuk kontak WhatsApp pemilik.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">3</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">📦 <span>Jelajahi Produk</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Di halaman detail, Anda bisa melihat katalog produk unggulan dari setiap UMKM.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">4</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">🛒 <span>Pesan Produk</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Hubungi pemilik melalui WhatsApp yang tersedia untuk melakukan pemesanan produk.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">5</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">➕ <span>Daftar UMKM (Khusus Pemilik)</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Jika Anda memiliki usaha, klik tombol "Daftarkan Usaha" untuk mendaftarkan UMKM Anda.</p>
                    </div>
                </div>
                
                <div class="group p-6 bg-slate-50 rounded-2xl hover:bg-emerald-50 transition-all duration-300 hover:-translate-y-1">
                    <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center font-black text-lg mb-4 shadow-md group-hover:scale-110 transition-transform">6</div>
                    <div>
                        <h4 class="font-black text-slate-800 mb-2 flex items-center gap-2">⚙️ <span>Kelola Usaha (Khusus Pemilik)</span></h4>
                        <p class="text-slate-500 text-sm leading-relaxed">Setelah UMKM disetujui, Anda dapat mengelola produk dan informasi usaha melalui tombol "Kelola Usaha".</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-6 flex items-start gap-4">
                <i class="fa-regular fa-lightbulb text-emerald-500 text-2xl mt-1"></i>
                <div>
                    <span class="font-black text-emerald-800">💡 <strong>Tips Penting:</strong></span>
                    <p class="text-emerald-700 text-sm mt-1">Pastikan Anda menghubungi pemilik UMKM melalui kontak WhatsApp yang tersedia untuk pemesanan. Setiap produk memiliki keunikan dan khas tersendiri dari Desa Lumban Silintong. Dukung terus UMKM lokal!</p>
                </div>
            </div>
        </div>

        {{-- 5. Footer Information Card --}}
        <div class="mt-16 bg-white rounded-[3.5rem] border border-slate-100 p-8 md:p-12 shadow-[0_30px_60px_-20px_rgba(0,0,0,0.05)]">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="text-3xl font-black text-slate-900 mb-4">Tentang Program UMKM Desa</h2>
                    <p class="text-slate-500 leading-relaxed">
                        Portal UMKM Desa Lumban Silintong adalah wadah digital bagi para pelaku usaha lokal untuk memamerkan produk terbaik mereka. Kami berkomitmen untuk memperluas jangkauan pasar dan mendigitalisasi ekonomi desa.
                    </p>
                </div>
                
                {{-- Kondisi Berdasarkan Status UMKM --}}
                @auth
                    @php 
                        $userUmkm = \App\Models\Umkm::where('user_id', Auth::id())->first(); 
                    @endphp
                    @if($userUmkm && $userUmkm->status == 'approved')
                        {{-- Untuk Pemilik UMKM yang sudah approved --}}
                        <div class="bg-gradient-to-br from-emerald-600 to-teal-700 rounded-[2rem] p-8 text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <h3 class="text-2xl font-black mb-4">Kelola Usaha Anda</h3>
                                <p class="text-emerald-100/80 mb-6 text-sm">Kelola produk dan informasi UMKM Anda dengan mudah.</p>
                                <div class="flex flex-col sm:flex-row gap-3">
                                    <a href="{{ route('umkm.show', $userUmkm->id_umkm) }}" 
                                       class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white text-emerald-700 rounded-xl font-black text-sm tracking-wider hover:scale-105 transition-transform">
                                        <i class="fa-solid fa-store"></i>
                                        Kelola Produk
                                    </a>
                                    <a href="{{ route('umkm.edit', $userUmkm->id_umkm) }}" 
                                       class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-emerald-500/30 backdrop-blur-sm text-white rounded-xl font-black text-sm tracking-wider hover:bg-emerald-500/50 transition-transform">
                                        <i class="fa-solid fa-pen"></i>
                                        Edit Profil
                                    </a>
                                </div>
                            </div>
                            <i class="fa-solid fa-chart-line absolute -right-4 -bottom-4 text-8xl text-white/10 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-700"></i>
                        </div>
                    @elseif($userUmkm && $userUmkm->status == 'pending')
                        {{-- Untuk Pemilik UMKM yang masih pending --}}
                        <div class="bg-gradient-to-br from-amber-500 to-orange-600 rounded-[2rem] p-8 text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <h3 class="text-2xl font-black mb-4">⏳ Menunggu Verifikasi</h3>
                                <p class="text-amber-100/80 mb-6 text-sm">UMKM Anda sedang dalam proses verifikasi oleh admin. Mohon tunggu konfirmasi.</p>
                                <a href="{{ route('masyarakat.umkm.status') }}" 
                                   class="inline-flex items-center gap-2 px-6 py-3 bg-white/20 backdrop-blur-sm rounded-xl font-black text-sm hover:bg-white/30 transition-transform">
                                    <i class="fa-solid fa-clock"></i>
                                    Lihat Status
                                </a>
                            </div>
                            <i class="fa-solid fa-hourglass-half absolute -right-4 -bottom-4 text-8xl text-white/10 group-hover:rotate-12 group-hover:scale-110 transition-transform duration-700"></i>
                        </div>
                    @else
                        {{-- Untuk Masyarakat Biasa / Belum punya UMKM --}}
                        <div class="bg-gradient-to-br from-emerald-600 to-teal-700 rounded-[2rem] p-8 text-white relative overflow-hidden group">
                            <div class="relative z-10">
                                <h3 class="text-2xl font-black mb-4">✨ Ingin Bergabung?</h3>
                                <p class="text-emerald-100/80 mb-6 text-sm">Jika Anda warga desa yang memiliki usaha kuliner, kerajinan, atau jasa, jangan ragu untuk mendaftar!</p>
                                <a href="{{ route('umkm.create') }}" 
                                   class="inline-flex items-center gap-2 px-8 py-3 bg-white text-emerald-700 rounded-full font-black text-xs tracking-widest uppercase hover:scale-105 transition-transform">
                                    <i class="fa-solid fa-rocket"></i>
                                    Daftarkan Usaha
                                </a>
                            </div>
                            <i class="fa-solid fa-handshake absolute -right-4 -bottom-4 text-8xl text-white/10 group-hover:rotate-6 group-hover:scale-110 transition-transform duration-700"></i>
                        </div>
                    @endif
                @else
                    {{-- Untuk Guest / Belum Login --}}
                    <div class="bg-gradient-to-br from-emerald-600 to-teal-700 rounded-[2rem] p-8 text-white relative overflow-hidden group">
                        <div class="relative z-10">
                            <h3 class="text-2xl font-black mb-4">✨ Ingin Bergabung?</h3>
                            <p class="text-emerald-100/80 mb-6 text-sm">Jika Anda warga desa yang memiliki usaha kuliner, kerajinan, atau jasa, jangan ragu untuk mendaftar!</p>
                            <a href="{{ route('login') }}" 
                               class="inline-flex items-center gap-2 px-8 py-3 bg-white text-emerald-700 rounded-full font-black text-xs tracking-widest uppercase hover:scale-105 transition-transform">
                                <i class="fa-solid fa-sign-in-alt"></i>
                                Login / Daftar
                            </a>
                        </div>
                        <i class="fa-solid fa-handshake absolute -right-4 -bottom-4 text-8xl text-white/10 group-hover:rotate-6 group-hover:scale-110 transition-transform duration-700"></i>
                    </div>
                @endauth
            </div>
        </div>

    </div>
</div>

<style>
    /* Filter Button Styling */
    .filter-btn.active {
        background-color: white;
        color: #059669;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    
    .umkm-card { transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275); }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            // Update UI Button
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active', 'bg-white', 'text-emerald-600');
                b.classList.add('text-slate-500');
            });
            this.classList.add('active', 'bg-white', 'text-emerald-600');
            this.classList.remove('text-slate-500');

            const target = this.dataset.target;
            const cards = document.querySelectorAll('.umkm-card');

            cards.forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px) scale(0.95)';
                
                setTimeout(() => {
                    if (target === 'all' || card.dataset.kategori === target) {
                        card.style.display = 'block';
                        setTimeout(() => {
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0) scale(1)';
                        }, 50);
                    } else {
                        card.style.display = 'none';
                    }
                }, 300);
            });
        });
    });
</script>
@endsection