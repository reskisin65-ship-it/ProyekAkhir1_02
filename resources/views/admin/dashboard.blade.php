{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Welcome Card --}}
    <div class="bg-gradient-to-r from-emerald-800 to-emerald-900 rounded-2xl p-6 text-white mb-8">
        <h1 class="text-3xl font-serif italic">👋 Selamat Datang, {{ Auth::user()->name }}!</h1>
        <p class="text-emerald-200 mt-1">Anda login sebagai Administrator</p>
    </div>

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-emerald-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Penduduk</p>
                    <p class="text-3xl font-bold text-emerald-700">{{ number_format($totalPenduduk ?? 0) }}</p>
                </div>
                <i class="fa-solid fa-users text-3xl text-emerald-200"></i>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-blue-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">UMKM Terdaftar</p>
                    <p class="text-3xl font-bold text-blue-700">{{ number_format($totalUmkm ?? 0) }}</p>
                </div>
                <i class="fa-solid fa-store text-3xl text-blue-200"></i>
            </div>
            @if(($umkmPending ?? 0) > 0)
            <p class="text-xs text-yellow-600 mt-2">{{ $umkmPending }} menunggu verifikasi</p>
            @endif
        </div>
        <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-amber-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Pengajuan Surat</p>
                    <p class="text-3xl font-bold text-amber-700">{{ number_format($totalSurat ?? 0) }}</p>
                </div>
                <i class="fa-solid fa-envelope text-3xl text-amber-200"></i>
            </div>
            @if(($suratMenunggu ?? 0) > 0)
            <p class="text-xs text-yellow-600 mt-2">{{ $suratMenunggu }} menunggu diproses</p>
            @endif
        </div>
        <div class="bg-white rounded-xl p-5 shadow-md border-l-4 border-purple-500">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Aspirasi</p>
                    <p class="text-3xl font-bold text-purple-700">{{ number_format($totalAspirasi ?? 0) }}</p>
                </div>
                <i class="fa-solid fa-comment-dots text-3xl text-purple-200"></i>
            </div>
            @if(($aspirasiBaru ?? 0) > 0)
            <p class="text-xs text-yellow-600 mt-2">{{ $aspirasiBaru }} aspirasi baru</p>
            @endif
        </div>
    </div>

    {{-- Recent Data Tables --}}
    <div class="grid lg:grid-cols-2 gap-8">
        {{-- Pengajuan Surat Terbaru --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-700">📋 Pengajuan Surat Terbaru</h2>
            </div>
            <div class="p-4">
                @if(isset($pengajuanTerbaru) && $pengajuanTerbaru->count() > 0)
                <div class="space-y-3">
                    @foreach($pengajuanTerbaru as $item)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->jenis_surat }}</p>
                            <p class="text-xs text-gray-400">{{ $item->user->name ?? '-' }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($item->status == 'diproses') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                            <a href="{{ route('admin.pengajuan-surat.show', $item->id_surat) }}" class="text-emerald-600">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-400 text-center py-4">Belum ada pengajuan surat</p>
                @endif
            </div>
        </div>

        {{-- UMKM Terbaru --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b">
                <h2 class="text-lg font-semibold text-gray-700">🏪 UMKM Terbaru</h2>
            </div>
            <div class="p-4">
                @if(isset($umkmTerbaru) && $umkmTerbaru->count() > 0)
                <div class="space-y-3">
                    @foreach($umkmTerbaru as $item)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->nama_usaha }}</p>
                            <p class="text-xs text-gray-400">{{ $item->user->name ?? '-' }}</p>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($item->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($item->status == 'approved') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                            <a href="{{ route('admin.umkm.index') }}" class="text-emerald-600">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-gray-400 text-center py-4">Belum ada UMKM terdaftar</p>
                @endif
            </div>
        </div>
    </div>

    {{-- Quick Menu --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8">
        <a href="{{ route('admin.penduduk.index') }}" class="bg-white rounded-xl p-4 text-center shadow-md hover:shadow-lg transition group">
            <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-emerald-500 transition">
                <i class="fa-solid fa-users text-emerald-600 group-hover:text-white"></i>
            </div>
            <p class="font-semibold text-gray-700">Data Penduduk</p>
        </a>
        <a href="{{ route('admin.berita.index') }}" class="bg-white rounded-xl p-4 text-center shadow-md hover:shadow-lg transition group">
            <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-blue-500 transition">
                <i class="fa-solid fa-newspaper text-blue-600 group-hover:text-white"></i>
            </div>
            <p class="font-semibold text-gray-700">Kelola Berita</p>
        </a>
        <a href="{{ route('admin.galeri.index') }}" class="bg-white rounded-xl p-4 text-center shadow-md hover:shadow-lg transition group">
            <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-purple-500 transition">
                <i class="fa-solid fa-photo-film text-purple-600 group-hover:text-white"></i>
            </div>
            <p class="font-semibold text-gray-700">Kelola Galeri</p>
        </a>
        <a href="{{ route('admin.umkm.index') }}" class="bg-white rounded-xl p-4 text-center shadow-md hover:shadow-lg transition group">
            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-3 group-hover:bg-amber-500 transition">
                <i class="fa-solid fa-store text-amber-600 group-hover:text-white"></i>
            </div>
            <p class="font-semibold text-gray-700">Kelola UMKM</p>
        </a>
    </div>
</div>
@endsection