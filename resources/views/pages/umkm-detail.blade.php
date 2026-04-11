{{-- resources/views/pages/umkm-detail.blade.php --}}
@extends('layouts.app')

@section('title', $umkm->nama_usaha . ' - Lumban Silintong')

@section('content')
<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- Breadcrumb --}}
    <div class="flex items-center gap-2 text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-emerald-600"><i class="fa-solid fa-house mr-1"></i> Beranda</a>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        <a href="{{ route('umkm') }}" class="hover:text-emerald-600">UMKM</a>
        <i class="fa-solid fa-chevron-right text-xs"></i>
        <span class="text-emerald-600 font-medium">{{ $umkm->nama_usaha }}</span>
    </div>

    <div class="grid lg:grid-cols-2 gap-10">
        
        {{-- Foto UMKM --}}
        <div class="rounded-2xl overflow-hidden shadow-lg bg-white p-2">
            <img src="{{ $umkm->logo ?? 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=600' }}" 
                 class="w-full h-96 object-cover rounded-xl">
        </div>

        {{-- Informasi UMKM --}}
        <div>
            <div class="mb-2">
                <span class="inline-block px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">
                    {{ ucfirst($umkm->kategori ?? 'UMKM') }}
                </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-serif italic text-emerald-900 mb-4">{{ $umkm->nama_usaha }}</h1>
            
            <div class="space-y-3 mb-6">
                <div class="flex items-center gap-3 text-gray-600">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-user text-emerald-600 text-sm"></i>
                    </div>
                    <span><strong>Pemilik:</strong> {{ $umkm->pemilik ?? $umkm->user->name ?? '-' }}</span>
                </div>
                <div class="flex items-center gap-3 text-gray-600">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-location-dot text-emerald-600 text-sm"></i>
                    </div>
                    <span><strong>Alamat:</strong> {{ $umkm->alamat_usaha ?? $umkm->alamat ?? '-' }}</span>
                </div>
                <div class="flex items-center gap-3 text-gray-600">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i class="fa-solid fa-phone text-emerald-600 text-sm"></i>
                    </div>
                    <span><strong>Telepon:</strong> {{ $umkm->no_telepon ?? $umkm->nomor_telepon ?? '-' }}</span>
                </div>
            </div>

            <div class="border-t border-gray-100 pt-6 mb-6">
                <h3 class="text-xl font-serif italic text-emerald-800 mb-3">📝 Deskripsi</h3>
                <p class="text-gray-600 leading-relaxed">
                    {{ $umkm->deskripsi ?? 'Deskripsi belum tersedia.' }}
                </p>
            </div>

            <div class="flex gap-3">
                @if($umkm->no_telepon ?? $umkm->nomor_telepon)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_telepon ?? $umkm->nomor_telepon) }}" 
                   target="_blank" class="px-5 py-2 bg-green-500 text-white rounded-full text-sm font-semibold hover:bg-green-600 transition inline-flex items-center gap-2">
                    <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
                </a>
                @endif
                <a href="{{ route('umkm') }}" class="px-5 py-2 border border-emerald-500 text-emerald-600 rounded-full text-sm font-semibold hover:bg-emerald-50 transition">
                    <i class="fa-solid fa-arrow-left mr-1"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    {{-- Produk UMKM --}}
    @if(isset($produk) && $produk->count() > 0)
    <div class="mt-16">
        <h2 class="text-2xl font-serif italic text-emerald-800 mb-6 text-center">📦 Produk Unggulan</h2>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($produk as $item)
            <div class="bg-white rounded-xl overflow-hidden shadow-md hover:shadow-lg transition">
                <div class="h-48 overflow-hidden">
                    <img src="{{ $item->foto_produk ?? 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=400' }}" 
                         class="w-full h-full object-cover hover:scale-105 transition duration-500">
                </div>
                <div class="p-4">
                    <h4 class="font-bold text-emerald-800">{{ $item->nama_produk }}</h4>
                    <p class="text-sm text-gray-500 mt-1 line-clamp-2">{{ $item->deskripsi }}</p>
                    <div class="mt-3 flex justify-between items-center">
                        <span class="text-lg font-bold text-emerald-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        <span class="text-xs text-gray-400">Stok: {{ $item->stok ?? 0 }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection