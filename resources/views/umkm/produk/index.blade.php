{{-- resources/views/umkm/produk/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📦 Kelola Produk</h1>
        <div class="flex gap-3">
            <a href="{{ route('umkm.dashboard') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                ← Profil Usaha
            </a>
            <a href="{{ route('umkm.produk.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                + Tambah Produk
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    @if($produk->count() > 0)
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Foto</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Nama Produk</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Harga</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Stok</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($produk as $item)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3">
                        @if($item->foto_produk)
                        <img src="{{ asset('storage/' . $item->foto_produk) }}" class="w-10 h-10 rounded object-cover">
                        @else
                        <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center">📷</div>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $item->nama_produk }}</td>
                    <td class="px-4 py-3">Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                    <td class="px-4 py-3">{{ $item->stok }}</td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <a href="{{ route('umkm.produk.edit', $item->id_produk) }}" class="text-yellow-500 hover:text-yellow-700">Edit</a>
                            <form action="{{ route('umkm.produk.destroy', $item->id_produk) }}" method="POST" onsubmit="return confirm('Yakin hapus?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="bg-white rounded-xl shadow-md p-12 text-center">
        <p class="text-gray-400">Belum ada produk</p>
        <a href="{{ route('umkm.produk.create') }}" class="inline-block mt-3 text-emerald-600 hover:underline">Tambah Produk →</a>
    </div>
    @endif
</div>
@endsection
