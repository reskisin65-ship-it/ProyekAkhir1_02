{{-- resources/views/admin/galeri.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Galeri')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-center mb-8 gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 flex items-center gap-2">
                <span class="text-4xl">📸</span> 
                Kelola Galeri
            </h1>
            <p class="text-gray-500 mt-1">Kelola dokumentasi foto kegiatan Desa Lumban Silintong</p>
        </div>
        <a href="{{ route('admin.galeri.create') }}" class="group px-5 py-3 bg-gradient-to-r from-emerald-500 to-emerald-700 text-white rounded-xl text-sm font-semibold hover:from-emerald-600 hover:to-emerald-800 transition-all duration-300 shadow-md hover:shadow-lg flex items-center gap-2">
            <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Tambah Foto
        </a>
    </div>

    {{-- Alert Success --}}
    @if(session('success'))
    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-emerald-50 text-green-700 rounded-xl border-l-4 border-emerald-500 shadow-sm flex items-center gap-3">
        <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="font-medium">{{ session('success') }}</span>
    </div>
    @endif

    {{-- Statistik --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-blue-100 text-sm">Total Foto</p>
                    <p class="text-3xl font-bold">{{ $galeris->total() }}</p>
                </div>
                <svg class="w-10 h-10 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-purple-100 text-sm">Kegiatan</p>
                    <p class="text-3xl font-bold">{{ $galeris->where('kategori', 'kegiatan')->count() }}</p>
                </div>
                <svg class="w-10 h-10 text-purple-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-xl p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-orange-100 text-sm">Pembangunan</p>
                    <p class="text-3xl font-bold">{{ $galeris->where('kategori', 'pembangunan')->count() }}</p>
                </div>
                <svg class="w-10 h-10 text-orange-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
            </div>
        </div>
        <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-4 text-white shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-emerald-100 text-sm">Budaya & Wisata</p>
                    <p class="text-3xl font-bold">{{ $galeris->whereIn('kategori', ['budaya', 'wisata'])->count() }}</p>
                </div>
                <svg class="w-10 h-10 text-emerald-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
        </div>
    </div>

    {{-- Galeri Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @forelse($galeris as $item)
        <div class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-300 overflow-hidden hover:-translate-y-1">
            {{-- Image Container --}}
            <div class="relative h-56 overflow-hidden bg-gray-200">
                <img src="{{ asset('storage/' . $item->gambar_galeri) }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                     alt="{{ $item->judul_galeri }}">
                
                {{-- Kategori Badge --}}
                <div class="absolute top-3 left-3">
                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold shadow-md
                        @if($item->kategori == 'kegiatan') bg-blue-500 text-white
                        @elseif($item->kategori == 'pembangunan') bg-orange-500 text-white
                        @elseif($item->kategori == 'budaya') bg-purple-500 text-white
                        @elseif($item->kategori == 'wisata') bg-teal-500 text-white
                        @elseif($item->kategori == 'umkm') bg-pink-500 text-white
                        @else bg-gray-500 text-white
                        @endif">
                        {{ ucfirst($item->kategori) }}
                    </span>
                </div>
                
                {{-- Overlay Aksi --}}
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-all duration-300 flex items-center justify-center gap-3">
                    <a href="{{ route('admin.galeri.show', $item->id_galeri) }}" 
                       class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-blue-500 hover:bg-blue-500 hover:text-white transition-all duration-300 shadow-lg transform hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('admin.galeri.edit', $item->id_galeri) }}" 
                       class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-yellow-500 hover:bg-yellow-500 hover:text-white transition-all duration-300 shadow-lg transform hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </a>
                    <form action="{{ route('admin.galeri.destroy', $item->id_galeri) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-500 hover:bg-red-500 hover:text-white transition-all duration-300 shadow-lg transform hover:scale-110">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            
            {{-- Info Container --}}
            <div class="p-4">
                <h3 class="font-bold text-gray-800 line-clamp-1">{{ $item->judul_galeri }}</h3>
                <div class="flex items-center justify-between mt-2">
                    <div class="flex items-center gap-1 text-gray-400 text-xs">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $item->created_at->format('d M Y') }}</span>
                    </div>
                    <a href="{{ route('admin.galeri.show', $item->id_galeri) }}" class="text-blue-500 hover:text-blue-700 text-xs font-medium flex items-center gap-1">
                        Detail →
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20 bg-gray-50 rounded-2xl">
            <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada Foto Galeri</h3>
            <p class="text-gray-400 mt-2">Klik tombol "Tambah Foto" untuk mulai mengunggah dokumentasi</p>
            <a href="{{ route('admin.galeri.create') }}" class="inline-block mt-4 px-5 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                + Tambah Foto Pertama
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination Links --}}
    <div class="mt-8 flex justify-center">
        {{ $galeris->links() }}
    </div>
</div>

<style>
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection
