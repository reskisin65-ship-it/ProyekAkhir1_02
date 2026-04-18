{{-- resources/views/admin/berita.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Berita')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📰 Kelola Berita</h1>
        <a href="{{ route('admin.berita.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm hover:bg-emerald-700">
            + Tambah Berita
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50 border-b">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">No</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Judul</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Kategori</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Status</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Tanggal</th>
                    <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($beritas as $index => $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 text-sm font-medium">{{ Str::limit($item->judul, 40) }}</td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs 
                            @if($item->kategori == 'berita') bg-blue-100 text-blue-700
                            @elseif($item->kategori == 'pengumuman') bg-amber-100 text-amber-700
                            @else bg-emerald-100 text-emerald-700 @endif">
                            {{ ucfirst($item->kategori) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">
                        <span class="px-2 py-1 rounded-full text-xs 
                            @if($item->status == 'publish') bg-green-100 text-green-700
                            @else bg-gray-100 text-gray-600 @endif">
                            {{ $item->status == 'publish' ? 'Published' : 'Draft' }}
                        </span>
                    </td>
                    <td class="px-4 py-3 text-sm">{{ $item->created_at->format('d M Y') }}</td>
                    <td class="px-4 py-3 text-sm">
                        <div class="flex gap-2">
                            <a href="{{ route('admin.berita.edit', $item->id_berita) }}" class="text-blue-600 hover:text-blue-700">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $item->id_berita) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
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
                    <td colspan="6" class="px-4 py-8 text-center text-gray-400">Belum ada berita</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection