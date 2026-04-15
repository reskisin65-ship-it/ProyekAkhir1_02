{{-- resources/views/masyarakat/surat/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('masyarakat.surat.index') }}" class="text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-2 group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Riwayat
        </a>
    </div>

    {{-- Detail Card --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-6">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-serif italic text-white">Detail Pengajuan Surat</h1>
                    <p class="text-emerald-100 mt-1 text-sm">Informasi lengkap pengajuan Anda</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold flex items-center gap-2
                    @if($surat->status == 'menunggu') bg-yellow-500 text-white
                    @elseif($surat->status == 'diproses') bg-blue-500 text-white
                    @elseif($surat->status == 'selesai') bg-green-500 text-white
                    @else bg-red-500 text-white @endif">
                    @if($surat->status == 'menunggu') <i class="fa-regular fa-clock"></i> Menunggu Verifikasi
                    @elseif($surat->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Sedang Diproses
                    @elseif($surat->status == 'selesai') <i class="fa-regular fa-circle-check"></i> Selesai
                    @else <i class="fa-regular fa-circle-xmark"></i> Ditolak @endif
                </span>
            </div>
        </div>

        {{-- Progress Status --}}
        <div class="px-8 pt-6">
            <div class="relative">
                <div class="overflow-hidden h-2 mb-4 text-xs flex rounded-full bg-gray-200">
                    <div class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center transition-all duration-1000
                        @if($surat->status == 'menunggu') bg-yellow-500 w-1/4
                        @elseif($surat->status == 'diproses') bg-blue-500 w-2/4
                        @elseif($surat->status == 'selesai') bg-green-500 w-full
                        @else bg-red-500 w-full @endif">
                    </div>
                </div>
                <div class="flex justify-between text-xs text-gray-500">
                    <span class="text-center w-1/4">📝 Diajukan</span>
                    <span class="text-center w-1/4">🔄 Diproses</span>
                    <span class="text-center w-1/4">✅ Selesai</span>
                    <span class="text-center w-1/4">📋 Diambil</span>
                </div>
            </div>
        </div>

        {{-- Content --}}
        <div class="p-8">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-file-alt text-emerald-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Jenis Surat</p>
                            <p class="font-semibold text-gray-800">{{ $surat->jenis_surat }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-regular fa-user text-emerald-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Nama Lengkap</p>
                            <p class="font-semibold text-gray-800">{{ $surat->nama_lengkap }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-id-card text-emerald-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">NIK</p>
                            <p class="font-semibold text-gray-800">{{ $surat->nik }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-location-dot text-emerald-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Tempat, Tanggal Lahir</p>
                            <p class="font-semibold text-gray-800">{{ $surat->tempat_lahir }}, {{ \Carbon\Carbon::parse($surat->tanggal_lahir)->translatedFormat('d F Y') }}</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-phone text-emerald-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Nomor Telepon</p>
                            <p class="font-semibold text-gray-800">{{ $surat->nomor_telepon }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-regular fa-calendar text-emerald-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Tanggal Pengajuan</p>
                            <p class="font-semibold text-gray-800">{{ $surat->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-clipboard-list text-emerald-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Keperluan</p>
                            <p class="font-semibold text-gray-800">{{ $surat->keperluan }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Catatan Penolakan (jika ada) --}}
            @if($surat->status == 'ditolak' && $surat->catatan_penolakan)
            <div class="mt-6 p-4 bg-red-50 rounded-xl border-l-4 border-red-500">
                <div class="flex items-start gap-3">
                    <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                    <div>
                        <p class="font-semibold text-red-800">Catatan Penolakan</p>
                        <p class="text-sm text-red-700 mt-1">{{ $surat->catatan_penolakan }}</p>
                    </div>
                </div>
            </div>
            @endif

            {{-- Tombol Aksi --}}
            <div class="mt-8 flex gap-4 justify-end flex-wrap">
                @if($surat->status == 'selesai' && $surat->file_surat)
                <a href="{{ route('masyarakat.surat.download', $surat->id_surat) }}" class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-download"></i> Unduh Surat
                </a>
                @endif
                
                @if($surat->status == 'ditolak')
                <a href="{{ route('masyarakat.surat.create') }}" class="px-6 py-3 bg-emerald-600 text-white rounded-xl font-semibold hover:bg-emerald-700 transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-repeat"></i> Ajukan Ulang
                </a>
                @endif
                
                {{-- TOMBOL EDIT & BATALKAN - HANYA UNTUK STATUS MENUNGGU --}}
                @if($surat->status == 'menunggu')
                <a href="{{ route('masyarakat.surat.edit', $surat->id_surat) }}" class="px-6 py-3 bg-blue-600 text-white rounded-xl font-semibold hover:bg-blue-700 transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-pen"></i> Edit Pengajuan
                </a>
                
                <form action="{{ route('masyarakat.surat.destroy', $surat->id_surat) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan pengajuan surat ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition inline-flex items-center gap-2">
                        <i class="fa-solid fa-trash"></i> Batalkan
                    </button>
                </form>
                @endif
                
                <a href="{{ route('masyarakat.surat.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection