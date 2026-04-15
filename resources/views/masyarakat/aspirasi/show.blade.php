{{-- resources/views/masyarakat/aspirasi/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Aspirasi')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-blue-600 hover:text-blue-700 inline-flex items-center gap-2 group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali
        </a>
    </div>

    {{-- Detail Card --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
            <div class="flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-serif italic text-white">Detail Aspirasi</h1>
                    <p class="text-blue-100 mt-1 text-sm">Informasi lengkap aspirasi Anda</p>
                </div>
                <span class="px-4 py-2 rounded-full text-sm font-semibold flex items-center gap-2
                    @if($aspirasi->status == 'baru') bg-yellow-500 text-white
                    @elseif($aspirasi->status == 'diproses') bg-blue-500 text-white
                    @else bg-green-500 text-white @endif">
                    @if($aspirasi->status == 'baru') <i class="fa-regular fa-clock"></i> Baru
                    @elseif($aspirasi->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Diproses
                    @else <i class="fa-regular fa-circle-check"></i> Selesai @endif
                </span>
            </div>
        </div>

        <div class="p-8">
            <div class="grid md:grid-cols-2 gap-6">
                <div class="space-y-4">
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-tag text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Kategori</p>
                            <p class="font-semibold text-gray-800">
                                @if($aspirasi->kategori == 'saran') 💡 Saran
                                @elseif($aspirasi->kategori == 'keluhan') 😞 Keluhan
                                @elseif($aspirasi->kategori == 'masukan') 📝 Masukan
                                @else ❓ Pertanyaan @endif
                            </p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-heading text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Judul</p>
                            <p class="font-semibold text-gray-800">{{ $aspirasi->judul }}</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fa-regular fa-calendar text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Tanggal Pengajuan</p>
                            <p class="font-semibold text-gray-800">{{ $aspirasi->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>
                </div>
                <div class="space-y-4">
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-user text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Diajukan Oleh</p>
                            <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                        </div>
                    </div>
                    @if($aspirasi->lampiran)
                    <div class="flex items-start gap-3 pb-3 border-b border-gray-100">
                        <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-paperclip text-blue-600 text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Lampiran</p>
                            <a href="{{ Storage::url($aspirasi->lampiran) }}" target="_blank" class="text-blue-600 text-sm hover:underline">Lihat Lampiran</a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Isi Aspirasi --}}
            <div class="mt-6 p-5 bg-gray-50 rounded-xl">
                <h3 class="font-semibold text-gray-700 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-message text-blue-500"></i> Isi Aspirasi
                </h3>
                <p class="text-gray-600 leading-relaxed">{{ $aspirasi->isi }}</p>
            </div>

            {{-- Respon (jika ada) --}}
            @if($aspirasi->respon)
            <div class="mt-6 p-5 bg-green-50 rounded-xl border-l-4 border-green-500">
                <h3 class="font-semibold text-green-700 mb-3 flex items-center gap-2">
                    <i class="fa-solid fa-reply-all"></i> Respon dari Perangkat Desa
                </h3>
                <p class="text-gray-600 leading-relaxed">{{ $aspirasi->respon }}</p>
                <p class="text-xs text-gray-400 mt-2">Ditanggapi: {{ $aspirasi->updated_at->translatedFormat('d F Y, H:i') }}</p>
            </div>
            @endif

            {{-- Tombol Aksi --}}
            <div class="mt-8 flex gap-4 justify-end flex-wrap">
                @if($aspirasi->status == 'baru')
                <a href="{{ route('masyarakat.aspirasi.edit', $aspirasi->id_aspirasi) }}" class="px-6 py-3 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition inline-flex items-center gap-2">
                    <i class="fa-solid fa-pen"></i> Edit Aspirasi
                </a>
                
                <form action="{{ route('masyarakat.aspirasi.destroy', $aspirasi->id_aspirasi) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan aspirasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-6 py-3 bg-red-600 text-white rounded-xl font-semibold hover:bg-red-700 transition inline-flex items-center gap-2">
                        <i class="fa-solid fa-trash"></i> Batalkan
                    </button>
                </form>
                @endif
                
                <a href="{{ route('masyarakat.aspirasi.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>
@endsection