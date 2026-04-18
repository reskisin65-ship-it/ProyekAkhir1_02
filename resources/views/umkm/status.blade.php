{{-- resources/views/umkm/status.blade.php --}}
@extends('layouts.app')

@section('title', 'Status UMKM')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-6">
        <a href="{{ route('umkm') }}" class="text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke UMKM
        </a>
    </div>

    @if(isset($umkm) && $umkm)
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
            <h1 class="text-2xl md:text-3xl font-serif italic text-white">📋 Status Pengajuan UMKM</h1>
        </div>
        <div class="p-8">
            <div class="flex justify-between items-center mb-6">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">{{ $umkm->nama_usaha }}</h2>
                    <p class="text-sm text-gray-500">Diajukan: {{ $umkm->created_at->translatedFormat('d F Y, H:i') }}</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold
                    @if($umkm->status == 'pending') bg-yellow-100 text-yellow-700
                    @elseif($umkm->status == 'approved') bg-green-100 text-green-700
                    @else bg-red-100 text-red-700 @endif">
                    @if($umkm->status == 'pending') <i class="fa-solid fa-spinner fa-pulse"></i> Menunggu Verifikasi
                    @elseif($umkm->status == 'approved') <i class="fa-regular fa-circle-check"></i> Disetujui
                    @else <i class="fa-regular fa-circle-xmark"></i> Ditolak @endif
                </span>
            </div>

            <div class="border-t border-gray-100 pt-4 space-y-2">
                <p><strong>Nama Usaha:</strong> {{ $umkm->nama_usaha }}</p>
                <p><strong>Kategori:</strong> {{ ucfirst($umkm->kategori) }}</p>
                <p><strong>Pemilik:</strong> {{ $umkm->pemilik }}</p>
                <p><strong>Telepon:</strong> {{ $umkm->no_telepon }}</p>
                <p><strong>Alamat:</strong> {{ $umkm->alamat_usaha }}</p>
                <p><strong>Deskripsi:</strong> {{ $umkm->deskripsi }}</p>
            </div>

            @if($umkm->status == 'pending')
            <div class="mt-6 p-4 bg-yellow-50 rounded-xl">
                <p class="text-yellow-700 text-sm">Pengajuan sedang diproses. Mohon tunggu verifikasi admin.</p>
            </div>
            @endif

            @if($umkm->status == 'approved')
            <div class="mt-6 p-4 bg-green-50 rounded-xl">
                <p class="text-green-700 text-sm">Selamat! Akun UMKM Anda sudah aktif.</p>
                <a href="{{ route('umkm.dashboard') }}" class="inline-block mt-2 px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm">Kelola UMKM →</a>
            </div>
            @endif

            @if($umkm->status == 'rejected')
            <div class="mt-6 p-4 bg-red-50 rounded-xl">
                <p class="text-red-700 text-sm">Pengajuan ditolak. Silakan perbaiki data dan hubungi admin.</p>
            </div>
            @endif
        </div>
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-xl p-12 text-center">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa-solid fa-store text-3xl text-gray-400"></i>
        </div>
        <p class="text-gray-400">Belum ada pengajuan UMKM</p>
        <a href="{{ route('masyarakat.umkm.create') }}" class="inline-block mt-3 px-4 py-2 bg-purple-600 text-white rounded-lg">Daftar UMKM</a>
    </div>
    @endif
</div>
@endsection
