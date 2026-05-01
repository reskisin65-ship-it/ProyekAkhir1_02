{{-- resources/views/umkm/produk/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Produk - ' . ($umkm->nama_usaha ?? 'UMKM'))

@section('content')
<!-- Plugin: Animate.css & FontAwesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="min-h-screen bg-[#F8FAFC] py-12 overflow-x-hidden">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="mb-10 animate__animated animate__fadeIn">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <a href="{{ route('umkm.dashboard') }}" class="group flex items-center gap-2 text-slate-400 hover:text-emerald-600 transition-colors">
                            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                            <span class="text-sm font-medium">Kembali ke Dashboard</span>
                        </a>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tight">
                        Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Produk</span>
                    </h1>
                    <p class="text-slate-500 mt-2 max-w-md">
                        Kelola dan atur semua produk dari usaha Anda
                    </p>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ route('umkm.dashboard') }}" 
                       class="group px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-xl font-bold hover:bg-slate-50 hover:-translate-y-0.5 transition-all duration-300 shadow-sm">
                        <i class="fa-solid fa-store mr-2"></i>
                        Profil Usaha
                    </a>
                    <a href="{{ route('umkm.produk.create') }}" 
                       class="group relative overflow-hidden px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-xl font-bold shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300">
                        <span class="relative z-10 flex items-center gap-2">
                            <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform"></i>
                            Tambah Produk
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                    </a>
                </div>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-6 animate__animated animate__fadeInUp">
            <div class="bg-emerald-50 border-l-4 border-emerald-500 rounded-2xl p-4 shadow-sm">
                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-check-circle text-emerald-500 text-xl"></i>
                    <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if($produk->count() > 0)
        <div class="animate__animated animate__fadeInUp">
            {{-- Stats Cards --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wider">Total Produk</p>
                            <p class="text-3xl font-black text-slate-800">{{ $produk->count() }}</p>
                        </div>
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-box text-emerald-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wider">Total Stok</p>
                            <p class="text-3xl font-black text-slate-800">{{ $produk->sum('stok') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-cubes text-blue-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wider">Harga Tertinggi</p>
                            <p class="text-2xl font-black text-slate-800">Rp {{ number_format($produk->max('harga') ?? 0, 0, ',', '.') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-orange-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-arrow-up text-orange-600 text-xl"></i>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-2xl p-5 shadow-sm border border-slate-100 hover:shadow-md transition-all">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-slate-400 text-xs uppercase tracking-wider">Kategori Usaha</p>
                            <p class="text-xl font-black text-slate-800">{{ ucfirst($umkm->kategori ?? '-') }}</p>
                        </div>
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                            <i class="fa-solid fa-tag text-purple-600 text-xl"></i>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Products Table --}}
            <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="bg-gradient-to-r from-slate-50 to-slate-100 border-b border-slate-200">
                                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Foto</th>
                                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Nama Produk</th>
                                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Stok</th>
                                <th class="px-6 py-4 text-left text-xs font-black text-slate-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            @foreach($produk as $item)
                            <tr class="hover:bg-slate-50/80 transition-colors group">
                                <td class="px-6 py-4">
                                    @if($item->foto_produk)
                                    <div class="w-14 h-14 rounded-xl overflow-hidden shadow-sm group-hover:shadow-md transition-all">
                                        <img src="{{ asset('storage/' . $item->foto_produk) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                    @else
                                    <div class="w-14 h-14 bg-gradient-to-br from-slate-100 to-slate-200 rounded-xl flex items-center justify-center text-2xl">
                                        📷
                                    </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-bold text-slate-700">{{ $item->nama_produk }}</span>
                                    @if($item->deskripsi)
                                    <p class="text-xs text-slate-400 mt-1 line-clamp-1">{{ $item->deskripsi }}</p>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <span class="font-black text-emerald-600">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-bold
                                        @if($item->stok > 10) bg-emerald-100 text-emerald-700
                                        @elseif($item->stok > 0) bg-yellow-100 text-yellow-700
                                        @else bg-red-100 text-red-700 @endif">
                                        <i class="fa-solid fa-boxes text-xs"></i>
                                        {{ $item->stok }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('umkm.produk.edit', $item->id_produk) }}" 
                                           class="group/btn relative overflow-hidden px-4 py-2 bg-amber-50 text-amber-600 rounded-xl text-xs font-bold hover:bg-amber-100 transition-all hover:-translate-y-0.5">
                                            <span class="relative z-10 flex items-center gap-1">
                                                <i class="fa-solid fa-pen"></i>
                                                Edit
                                            </span>
                                        </a>
                                        <form action="{{ route('umkm.produk.destroy', $item->id_produk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk {{ $item->nama_produk }}?')" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="group/btn relative overflow-hidden px-4 py-2 bg-red-50 text-red-600 rounded-xl text-xs font-bold hover:bg-red-100 transition-all hover:-translate-y-0.5">
                                                <span class="relative z-10 flex items-center gap-1">
                                                    <i class="fa-solid fa-trash"></i>
                                                    Hapus
                                                </span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @else
        <div class="animate__animated animate__fadeInUp">
            <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-16 text-center">
                <div class="w-32 h-32 bg-gradient-to-br from-emerald-100 to-teal-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-solid fa-box-open text-5xl text-emerald-500"></i>
                </div>
                <h3 class="text-2xl font-black text-slate-800 mb-3">Belum Ada Produk</h3>
                <p class="text-slate-400 mb-8 max-w-md mx-auto">
                    Mulai tambahkan produk pertama Anda untuk memamerkan barang dagangan ke pelanggan.
                </p>
                <a href="{{ route('umkm.produk.create') }}" 
                   class="group relative overflow-hidden inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-full font-bold shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fa-solid fa-plus"></i>
                        Tambah Produk Pertama
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </a>
            </div>
        </div>
        @endif

        {{-- Tips Section --}}
        <div class="mt-12 bg-gradient-to-r from-emerald-50 to-teal-50 rounded-[2rem] p-8 border border-emerald-100">
            <div class="flex items-start gap-5 flex-wrap md:flex-nowrap">
                <div class="w-14 h-14 bg-emerald-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                    <i class="fa-solid fa-lightbulb text-white text-2xl"></i>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-black text-emerald-800 mb-2">Tips Menjual Produk Online</h3>
                    <div class="grid md:grid-cols-3 gap-4 mt-4">
                        <div class="flex items-center gap-2 bg-white/60 rounded-xl p-3">
                            <i class="fa-solid fa-camera text-emerald-600"></i>
                            <span class="text-sm text-emerald-800">Gunakan foto produk yang menarik</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/60 rounded-xl p-3">
                            <i class="fa-solid fa-tag text-emerald-600"></i>
                            <span class="text-sm text-emerald-800">Tentukan harga yang kompetitif</span>
                        </div>
                        <div class="flex items-center gap-2 bg-white/60 rounded-xl p-3">
                            <i class="fa-solid fa-clipboard-list text-emerald-600"></i>
                            <span class="text-sm text-emerald-800">Deskripsikan produk dengan detail</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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