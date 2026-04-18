{{-- resources/views/masyarakat/surat/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Riwayat Pengajuan Surat')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📋 Riwayat Pengajuan Surat</h1>
        <a href="{{ route('masyarakat.surat.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">
            + Ajukan Surat Baru
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Jenis Surat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($pengajuan as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $item->jenis_surat }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($item->status == 'diproses') bg-blue-100 text-blue-700
                                @elseif($item->status == 'selesai') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                @if($item->status == 'menunggu') ⏳ Menunggu
                                @elseif($item->status == 'diproses') 🔄 Diproses
                                @elseif($item->status == 'selesai') ✅ Selesai
                                @else ❌ Ditolak @endif
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('masyarakat.surat.show', $item->id_surat) }}" class="text-emerald-600 hover:text-emerald-800">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                @if($item->status == 'menunggu')
                                <a href="{{ route('masyarakat.surat.edit', $item->id_surat) }}" class="text-yellow-500 hover:text-yellow-700">
                                    <i class="fa-solid fa-edit"></i>
                                </a>
                                <form action="{{ route('masyarakat.surat.destroy', $item->id_surat) }}" method="POST" onsubmit="return confirm('Yakin batalkan pengajuan?')" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                                @endif
                                @if($item->status == 'selesai' && $item->file_surat)
                                <a href="{{ route('masyarakat.surat.download', $item->id_surat) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fa-solid fa-download"></i>
                                </a>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                            <i class="fa-regular fa-file-lines text-4xl mb-2 block"></i>
                            Belum ada pengajuan surat
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $pengajuan->links() }}
    </div>
</div>
@endsection
