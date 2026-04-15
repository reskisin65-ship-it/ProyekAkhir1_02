{{-- resources/views/umkm/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola UMKM Saya')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-serif italic text-emerald-800">🏪 Kelola UMKM Saya</h1>
            <p class="text-gray-500 mt-1">Daftar UMKM yang Anda daftarkan</p>
        </div>
        <a href="{{ route('umkm.create') }}" class="px-5 py-2 bg-purple-600 text-white rounded-xl text-sm font-semibold hover:bg-purple-700 transition shadow-md">
            <i class="fa-solid fa-plus mr-1"></i> Daftar UMKM Baru
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-xl border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-xl border-l-4 border-red-500">
        {{ session('error') }}
    </div>
    @endif

    @if(isset($umkm) && $umkm)
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
                <h2 class="text-white font-semibold">Status Pengajuan UMKM</h2>
            </div>
            <div class="p-6">
                <div class="flex justify-between items-start flex-wrap gap-4">
                    <div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $umkm->nama_usaha }}</h3>
                        <p class="text-sm text-gray-500 mt-1">
                            <i class="fa-regular fa-calendar mr-1"></i> Diajukan: {{ $umkm->created_at->translatedFormat('d F Y') }}
                        </p>
                        <p class="text-sm text-gray-500">
                            <i class="fa-regular fa-clock mr-1"></i> Terakhir update: {{ $umkm->updated_at->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>
                    <div>
                        @if($umkm->status == 'pending')
                            <span class="px-4 py-2 rounded-full text-sm font-semibold bg-yellow-100 text-yellow-700">
                                <i class="fa-solid fa-spinner fa-pulse"></i> Menunggu Verifikasi
                            </span>
                        @elseif($umkm->status == 'approved')
                            <span class="px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                <i class="fa-regular fa-circle-check"></i> Disetujui
                            </span>
                        @else
                            <span class="px-4 py-2 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                <i class="fa-regular fa-circle-xmark"></i> Ditolak
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Progress Bar --}}
                <div class="mt-6">
                    <div class="overflow-hidden h-2 text-xs flex rounded-full bg-gray-200">
                        <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center transition-all duration-1000
                            @if($umkm->status == 'pending') bg-yellow-500 w-1/2
                            @elseif($umkm->status == 'approved') bg-green-500 w-full
                            @else bg-red-500 w-full @endif">
                        </div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-2">
                        <span>📝 Diajukan</span>
                        <span>🔄 Verifikasi</span>
                        <span>✅ Aktif</span>
                    </div>
                </div>

                {{-- Tombol Aksi --}}
                <div class="mt-6 flex gap-3 justify-end">
                    @if($umkm->status == 'pending')
                        <a href="{{ route('umkm.edit', $umkm->id_umkm) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                            <i class="fa-solid fa-pen"></i> Edit
                        </a>
                        <form action="{{ route('umkm.destroy', $umkm->id_umkm) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg text-sm font-semibold hover:bg-red-700 transition">
                                <i class="fa-solid fa-trash"></i> Batalkan
                            </button>
                        </form>
                    @endif

                    @if($umkm->status == 'rejected')
                        <a href="{{ route('umkm.edit', $umkm->id_umkm) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition">
                            <i class="fa-solid fa-pen"></i> Edit & Ajukan Ulang
                        </a>
                    @endif

                    @if($umkm->status == 'approved')
                        <a href="{{ route('umkm.dashboard') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm font-semibold hover:bg-emerald-700 transition">
                            <i class="fa-solid fa-store"></i> Kelola UMKM
                        </a>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg p-12 text-center border border-gray-100">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-store text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-serif italic text-gray-400">Belum Ada UMKM</h3>
            <p class="text-gray-400 mt-2">Anda belum mendaftarkan UMKM.</p>
            <a href="{{ route('umkm.create') }}" class="inline-block mt-4 px-5 py-2 bg-purple-600 text-white rounded-lg text-sm hover:bg-purple-700 transition">
                Daftar UMKM Sekarang
            </a>
        </div>
    @endif
</div>
@endsection