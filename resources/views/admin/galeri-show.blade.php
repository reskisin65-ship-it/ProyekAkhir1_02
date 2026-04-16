{{-- resources/views/admin/galeri-show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Galeri')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📸 Detail Galeri</h1>
        <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg text-sm hover:bg-gray-600">
            ← Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2">
                <img src="{{ asset('storage/' . $galeri->gambar_galeri) }}" class="w-full h-full object-cover" alt="{{ $galeri->judul_galeri }}">
            </div>
            <div class="md:w-1/2 p-6">
                <table class="w-full">
                    <tr class="border-b">
                        <th class="text-left py-3 w-32">Judul</th>
                        <td class="py-3">{{ $galeri->judul_galeri }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left py-3 w-32">Kategori</th>
                        <td class="py-3">
                            <span class="px-2 py-1 rounded-full text-xs 
                                @if($galeri->kategori == 'kegiatan') bg-blue-100 text-blue-700
                                @elseif($galeri->kategori == 'pembangunan') bg-orange-100 text-orange-700
                                @elseif($galeri->kategori == 'budaya') bg-purple-100 text-purple-700
                                @elseif($galeri->kategori == 'alam') bg-green-100 text-green-700
                                @elseif($galeri->kategori == 'wisata') bg-yellow-100 text-yellow-700
                                @else bg-gray-100 text-gray-700
                                @endif">
                                {{ ucfirst($galeri->kategori) }}
                            </span>
                        </td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left py-3">Tanggal Upload</th>
                        <td class="py-3">{{ $galeri->created_at->format('d F Y H:i') }}</td>
                    </tr>
                    <tr class="border-b">
                        <th class="text-left py-3">Terakhir Update</th>
                        <td class="py-3">{{ $galeri->updated_at->format('d F Y H:i') }}</td>
                    </tr>
                </table>
                
                <div class="flex gap-3 mt-6">
                    <a href="{{ route('admin.galeri.edit', $galeri->id_galeri) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('admin.galeri.destroy', $galeri->id_galeri) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection