{{-- resources/views/pages/berita-detail.blade.php --}}
@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="bg-gray-50/50 min-h-screen pb-20">
    {{-- Progress Bar (Interaktif saat scroll) --}}
    <div id="scroll-progress" class="fixed top-0 left-0 h-1 bg-emerald-500 z-50 transition-all duration-150" style="width: 0%"></div>

    <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-10">
        
        {{-- Breadcrumb & Meta --}}
        <nav class="flex flex-wrap items-center gap-2 text-xs uppercase tracking-widest text-gray-400 mb-8 font-medium">
            <a href="{{ route('home') }}" class="hover:text-emerald-600 transition">Beranda</a>
            <span class="opacity-30">/</span>
            <a href="{{ route('berita') }}" class="hover:text-emerald-600 transition">Berita</a>
            <span class="opacity-30">/</span>
            <span class="text-emerald-700 font-bold truncate max-w-[200px]">{{ $berita->judul }}</span>
        </nav>

        {{-- Header Section --}}
        <header class="text-center mb-12">
            <div class="inline-flex items-center gap-3 mb-6">
                <span class="px-4 py-1.5 rounded-full text-[11px] font-black uppercase tracking-tighter
                    @if($berita->kategori == 'berita') bg-blue-600 text-white
                    @elseif($berita->kategori == 'pengumuman') bg-amber-500 text-white
                    @else bg-emerald-600 text-white @endif shadow-lg shadow-emerald-200">
                    {{ $berita->kategori }}
                </span>
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <time class="text-sm text-gray-500 font-medium italic">{{ $berita->tanggal_publikasi->translatedFormat('d F Y') }}</time>
            </div>
            
            <h1 class="text-4xl md:text-6xl font-serif text-slate-900 leading-[1.1] mb-8 group-hover:tracking-tight transition-all duration-700">
                {{ $berita->judul }}
            </h1>

            <div class="flex items-center justify-center gap-6 text-gray-400 text-sm border-y border-gray-100 py-4 mb-10">
                <span class="flex items-center gap-2"><i class="fa-regular fa-eye text-emerald-500"></i> {{ number_format($berita->dibaca) }} Views</span>
                <span class="flex items-center gap-2"><i class="fa-regular fa-clock text-emerald-500"></i> 5 Menit Baca</span>
            </div>

            @if($berita->gambar)
            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-emerald-100 to-teal-100 rounded-[2rem] blur opacity-25 group-hover:opacity-50 transition duration-1000"></div>
                <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[16/9]">
                    <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-1000">
                </div>
            </div>
            @endif
        </header>

        {{-- Content Area --}}
        <div class="relative flex flex-col md:flex-row gap-12">
            
            {{-- Floating Social Sidebar (Hanya tampil di desktop) --}}
            <aside class="hidden md:flex flex-col gap-4 sticky top-24 h-fit">
                <span class="text-[10px] font-bold text-gray-300 uppercase vertical-text tracking-widest mb-4">Share</span>
                <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->url()) }}" target="_blank" class="w-11 h-11 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-400 hover:text-[#25d366] hover:shadow-md transition-all">
                    <i class="fa-brands fa-whatsapp text-lg"></i>
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-11 h-11 rounded-full bg-white shadow-sm flex items-center justify-center text-gray-400 hover:text-[#1877f2] hover:shadow-md transition-all">
                    <i class="fa-brands fa-facebook-f text-lg"></i>
                </a>
            </aside>

            {{-- Body Text --}}
            <div class="flex-1 min-w-0">
                <div class="prose prose-emerald prose-lg max-w-none 
                    prose-p:text-gray-600 prose-p:leading-relaxed prose-p:mb-6
                    prose-headings:font-serif prose-headings:text-slate-800
                    prose-dropcap:text-5xl prose-dropcap:font-bold prose-dropcap:text-emerald-700 prose-dropcap:mr-3 prose-dropcap:float-left">
                    
                    {!! nl2br(e($berita->isi_berita)) !!}
                </div>

                {{-- Tag / Footer Artikel --}}
                <div class="mt-16 pt-8 border-t border-gray-100 flex flex-wrap items-center justify-between gap-6">
                    <div class="flex items-center gap-3">
                        <img src="https://ui-avatars.com/api/?name=Admin&background=059669&color=fff" class="w-12 h-12 rounded-full border-2 border-white shadow-sm">
                        <div>
                            <p class="text-sm font-bold text-slate-800">Ditulis oleh Admin</p>
                            <p class="text-xs text-gray-400">Tim Redaksi & Publikasi</p>
                        </div>
                    </div>
                    <button onclick="window.print()" class="text-sm font-medium text-emerald-600 hover:text-emerald-700 flex items-center gap-2">
                        <i class="fa-solid fa-print"></i> Cetak Artikel
                    </button>
                </div>
            </div>
        </div>
    </article>

    {{-- Related Content Section --}}
    @if(isset($rekomendasi) && $rekomendasi->count() > 0)
    <section class="bg-emerald-950 mt-24 py-20 text-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h3 class="text-3xl font-serif italic mb-2">Baca Juga</h3>
                    <div class="h-1 w-20 bg-emerald-500"></div>
                </div>
                <a href="{{ route('berita') }}" class="text-emerald-400 hover:text-white transition text-sm font-bold tracking-widest uppercase">Lihat Semua <i class="fa-solid fa-arrow-right ml-2"></i></a>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                @foreach($rekomendasi as $item)
                <a href="{{ route('berita.show', $item->slug) }}" class="group">
                    <div class="relative overflow-hidden rounded-xl aspect-video mb-4">
                        <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=500' }}" 
                             alt="{{ $item->judul }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700 opacity-80 group-hover:opacity-100">
                    </div>
                    <h4 class="text-lg font-bold leading-snug group-hover:text-emerald-400 transition">{{ $item->judul }}</h4>
                    <p class="text-emerald-700 text-xs mt-3 uppercase tracking-tighter font-black">{{ $item->tanggal_publikasi->format('d M Y') }}</p>
                </a>
                @endforeach
            </div>
        </div>
    </section>
    @endif
</div>

<style>
    .vertical-text {
        writing-mode: vertical-rl;
        transform: rotate(180deg);
    }
    /* Efek Dropcap otomatis pada paragraf pertama */
    .prose p:first-of-type::first-letter {
        float: left;
        font-size: 4rem;
        line-height: 1;
        font-weight: bold;
        margin-right: 0.5rem;
        color: #059669;
        font-family: serif;
    }
</style>

<script>
    // Script untuk scroll progress bar
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("scroll-progress").style.width = scrolled + "%";
    };
</script>
@endsection