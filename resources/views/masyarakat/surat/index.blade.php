{{-- resources/views/masyarakat/surat/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Riwayat Pengajuan Surat')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Header --}}
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-serif italic text-emerald-800">📋 Riwayat Pengajuan Surat</h1>
            <p class="text-gray-500 mt-1">Pantau status pengajuan surat Anda di sini</p>
        </div>
        <a href="{{ route('masyarakat.surat.create') }}" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:from-emerald-500 hover:to-emerald-600 transition shadow-md hover:shadow-lg flex items-center gap-2">
            <i class="fa-solid fa-plus"></i> Ajukan Surat Baru
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

    @if($surat->count() > 0)
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-emerald-50 to-white border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Jenis Surat</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Tanggal Pengajuan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($surat as $index => $s)
                    <tr class="hover:bg-emerald-50/30 transition duration-200">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-gray-800">{{ $s->jenis_surat }}</td>
                        <td class="px-6 py-4 text-sm text-gray-500">{{ $s->created_at->translatedFormat('d F Y, H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit
                                @if($s->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($s->status == 'diproses') bg-blue-100 text-blue-700
                                @elseif($s->status == 'selesai') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                @if($s->status == 'menunggu') <i class="fa-regular fa-clock"></i> Menunggu
                                @elseif($s->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Diproses
                                @elseif($s->status == 'selesai') <i class="fa-regular fa-circle-check"></i> Selesai
                                @else <i class="fa-regular fa-circle-xmark"></i> Ditolak @endif
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('masyarakat.surat.show', $s->id_surat) }}" class="text-emerald-600 hover:text-emerald-700 text-sm font-semibold inline-flex items-center gap-1 group" title="Detail">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                
                                @if($s->status == 'menunggu')
                                <a href="{{ route('masyarakat.surat.edit', $s->id_surat) }}" class="text-blue-600 hover:text-blue-700 text-sm font-semibold inline-flex items-center gap-1 group" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                
                                <form action="{{ route('masyarakat.surat.destroy', $s->id_surat) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan pengajuan surat ini?')">
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
            <i class="fa-regular fa-file-lines text-4xl text-gray-400"></i>
        </div>
        <h3 class="text-xl font-serif italic text-gray-400">Belum Ada Pengajuan Surat</h3>
        <p class="text-gray-400 mt-2">Silakan ajukan surat administrasi melalui tombol di atas.</p>
        <a href="{{ route('masyarakat.surat.create') }}" class="inline-block mt-4 px-5 py-2 bg-emerald-500 text-white rounded-lg text-sm hover:bg-emerald-600 transition">
            Ajukan Surat Sekarang
        </a>
    </div>
    @endif
</div>
@endsection