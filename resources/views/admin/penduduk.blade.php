{{-- resources/views/admin/penduduk.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Data Penduduk')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📋 Data Penduduk</h1>
        <a href="{{ route('admin.penduduk.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm hover:bg-emerald-700">
            + Tambah Data
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">NIK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Nama Lengkap</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">JK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Tempat, Tgl Lahir</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Alamat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($penduduk as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm font-mono">{{ $item->nik }}</td>
                        <td class="px-4 py-3 text-sm font-medium">{{ $item->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-sm">{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td class="px-4 py-3 text-sm">{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm">{{ Str::limit($item->alamat, 30) }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                {{ $item->status_keluarga }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.penduduk.edit', $item->id_penduduk) }}" class="text-blue-600 hover:text-blue-700">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.penduduk.destroy', $item->id_penduduk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-4 py-8 text-center text-gray-400">Belum ada data penduduk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection