{{-- resources/views/pages/berita-detail.blade.php --}}
@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-emerald-600"><i class="fa-solid fa-house mr-1"></i> Beranda</a>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        <a href="{{ route('berita') }}" class="hover:text-emerald-600">Berita</a>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        <span class="text-emerald-600 font-medium line-clamp-1">{{ $berita->judul }}</span>
    </div>

    {{-- Header --}}
    <div class="mb-8">
        <div class="flex items-center gap-3 mb-4 flex-wrap">
            <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold
                @if($berita->kategori == 'berita') bg-blue-100 text-blue-700
                @elseif($berita->kategori == 'pengumuman') bg-amber-100 text-amber-700
                @else bg-emerald-100 text-emerald-700 @endif">
                @if($berita->kategori == 'berita') 📰 Berita
                @elseif($berita->kategori == 'pengumuman') 📢 Pengumuman
                @else 🎉 Kegiatan @endif
            </span>
            <span class="text-sm text-gray-500"><i class="fa-regular fa-calendar mr-1"></i> {{ $berita->tanggal_publikasi->translatedFormat('d F Y') }}</span>
            <span class="text-sm text-gray-500"><i class="fa-regular fa-eye mr-1"></i> {{ number_format($berita->dibaca) }} kali dibaca</span>
        </div>
        <h1 class="text-3xl md:text-5xl font-serif italic text-emerald-900 mb-5">{{ $berita->judul }}</h1>
        @if($berita->gambar)
        <div class="rounded-2xl overflow-hidden shadow-xl max-h-[500px]">
            <img src="{{ $berita->gambar }}" class="w-full h-full object-cover">
        </div>
        @endif
    </div>

    {{-- Content --}}
    <div class="prose prose-lg max-w-none text-gray-600 leading-loose">
        {!! nl2br(e($berita->isi_berita)) !!}
    </div>

    {{-- Share Section --}}
    <div class="border-t border-gray-100 mt-10 pt-8">
        <h4 class="font-semibold text-gray-700 mb-4">Bagikan artikel ini:</h4>
        <div class="flex gap-3">
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-10 h-10 bg-[#1877f2] rounded-xl flex items-center justify-center text-white hover:scale-110 transition">
                <i class="fa-brands fa-facebook-f"></i>
            </a>
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($berita->judul) }}" target="_blank" class="w-10 h-10 bg-[#1da1f2] rounded-xl flex items-center justify-center text-white hover:scale-110 transition">
                <i class="fa-brands fa-twitter"></i>
            </a>
            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' - ' . request()->url()) }}" target="_blank" class="w-10 h-10 bg-[#25d366] rounded-xl flex items-center justify-center text-white hover:scale-110 transition">
                <i class="fa-brands fa-whatsapp"></i>
            </a>
        </div>
    </div>

    {{-- Rekomendasi Berita --}}
    @if(isset($rekomendasi) && $rekomendasi->count() > 0)
    <div class="border-t border-gray-100 mt-10 pt-10">
        <h3 class="text-2xl font-serif italic text-emerald-800 mb-6">📖 Artikel Terkait</h3>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($rekomendasi as $item)
            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition">
                <div class="h-40 overflow-hidden">
                    <img src="{{ $item->gambar ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=500' }}" class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="p-4">
                    <h4 class="font-bold text-emerald-800 line-clamp-2">{{ $item->judul }}</h4>
                    <p class="text-xs text-gray-400 mt-2">{{ $item->tanggal_publikasi->format('d M Y') }}</p>
                    <a href="{{ route('berita.show', $item->slug) }}" class="inline-block mt-3 text-emerald-600 text-sm font-semibold">Baca →</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection