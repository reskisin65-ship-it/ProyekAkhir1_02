{{-- resources/views/admin/galeri.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Galeri')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📸 Kelola Galeri</h1>
        <a href="{{ route('admin.galeri.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm hover:bg-emerald-700">
            + Tambah Foto
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($galeris as $item)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden group">
            <div class="h-48 overflow-hidden">
                <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition">
            </div>
            <div class="p-3">
                <p class="font-medium text-sm">{{ Str::limit($item->judul, 30) }}</p>
                <p class="text-xs text-gray-400">{{ $item->created_at->format('d M Y') }}</p>
                <div class="flex gap-2 mt-2">
                    <form action="{{ route('admin.galeri.destroy', $item->id_galeri) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 text-sm hover:text-red-700">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            Belum ada foto galeri
        </div>
        @endforelse
    </div>
</div>
@endsection