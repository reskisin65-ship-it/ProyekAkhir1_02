{{-- resources/views/admin/galeri-create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Galeri')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📸 Tambah Foto Galeri</h1>
        <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg text-sm hover:bg-gray-600">
            ← Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.galeri.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Judul Galeri <span class="text-red-500">*</span></label>
                <input type="text" name="judul" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                    <option value="">Pilih Kategori</option>
                    <option value="kegiatan">Kegiatan</option>
                    <option value="pembangunan">Pembangunan</option>
                    <option value="budaya">Budaya</option>
                    <option value="alam">Alam</option>
                    <option value="wisata">Wisata</option>
                    <option value="umkm">UMKM</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Foto <span class="text-red-500">*</span></label>
                <input type="file" name="foto" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" accept="image/*" required>
                <p class="text-gray-400 text-sm mt-1">Format: JPG, JPEG, PNG. Maks: 2MB</p>
                @error('foto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                    Simpan
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
