{{-- resources/views/masyarakat/aspirasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Riwayat Aspirasi')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-serif italic text-emerald-800">💬 Riwayat Aspirasi</h1>
            <p class="text-gray-500 mt-1">Pantau status aspirasi, saran, dan keluhan Anda di sini</p>
        </div>
        <a href="{{ route('masyarakat.aspirasi.create') }}" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-semibold hover:from-blue-500 hover:to-blue-600 transition shadow-md hover:shadow-lg flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Aspirasi Baru
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl flex items-center gap-3 border-l-4 border-emerald-500">
        <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl flex items-center gap-3 border-l-4 border-red-500">
        <i class="fa-solid fa-circle-exclamation text-red-500 text-xl"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    @if($aspirasi->count() > 0)
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-blue-50 to-white border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-blue-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($aspirasi as $index => $a)
                    <tr class="hover:bg-blue-50/30 transition duration-200">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ Str::limit($a->judul, 40) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($a->kategori == 'saran') bg-green-100 text-green-700
                                @elseif($a->kategori == 'keluhan') bg-red-100 text-red-700
                                @elseif($a->kategori == 'masukan') bg-blue-100 text-blue-700
                                @else bg-purple-100 text-purple-700 @endif">
                                @if($a->kategori == 'saran') 💡 Saran
                                @elseif($a->kategori == 'keluhan') 😞 Keluhan
                                @elseif($a->kategori == 'masukan') 📝 Masukan
                                @else ❓ Pertanyaan @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $a->created_at->translatedFormat('d F Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit
                                @if($a->status == 'baru') bg-yellow-100 text-yellow-700
                                @elseif($a->status == 'diproses') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700 @endif">
                                @if($a->status == 'baru') <i class="fa-regular fa-clock"></i> Baru
                                @elseif($a->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Diproses
                                @else <i class="fa-regular fa-circle-check"></i> Selesai @endif
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('masyarakat.aspirasi.show', $a->id_aspirasi) }}" class="text-blue-600 hover:text-blue-700" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                
                                @if($a->status == 'baru')
                                <a href="{{ route('masyarakat.aspirasi.edit', $a->id_aspirasi) }}" class="text-green-600 hover:text-green-700" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                
                                <form action="{{ route('masyarakat.aspirasi.destroy', $a->id_aspirasi) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan aspirasi ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700" title="Batalkan">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else
    <div class="bg-white rounded-2xl shadow-lg p-12 text-center">
        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <i class="fa-regular fa-comment-dots text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-xl font-serif italic text-gray-400">Belum Ada Aspirasi</h3>
        <p class="text-gray-400 mt-2">Silakan sampaikan aspirasi, saran, atau keluhan Anda.</p>
        <a href="{{ route('masyarakat.aspirasi.create') }}" class="inline-block mt-4 px-5 py-2 bg-blue-500 text-white rounded-lg text-sm hover:bg-blue-600 transition">
            Sampaikan Aspirasi Sekarang
        </a>
    </div>
    @endif
</div>
@endsection