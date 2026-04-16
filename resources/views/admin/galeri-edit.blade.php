{{-- resources/views/admin/galeri-edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Galeri')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📸 Edit Galeri</h1>
        <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg text-sm hover:bg-gray-600">
            ← Kembali
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <form action="{{ route('admin.galeri.update', $galeri->id_galeri) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Judul Galeri <span class="text-red-500">*</span></label>
                <input type="text" name="judul" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" value="{{ old('judul', $galeri->judul_galeri) }}" required>
                @error('judul')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                    <option value="">Pilih Kategori</option>
                    <option value="kegiatan" {{ $galeri->kategori == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="pembangunan" {{ $galeri->kategori == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="budaya" {{ $galeri->kategori == 'budaya' ? 'selected' : '' }}>Budaya</option>
                    <option value="alam" {{ $galeri->kategori == 'alam' ? 'selected' : '' }}>Alam</option>
                    <option value="wisata" {{ $galeri->kategori == 'wisata' ? 'selected' : '' }}>Wisata</option>
                    <option value="umkm" {{ $galeri->kategori == 'umkm' ? 'selected' : '' }}>UMKM</option>
                </select>
                @error('kategori')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Foto Saat Ini</label>
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $galeri->gambar_galeri) }}" class="w-48 h-32 object-cover rounded-lg border" alt="{{ $galeri->judul_galeri }}">
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Ganti Foto (Opsional)</label>
                <input type="file" name="foto" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" accept="image/*">
                <p class="text-gray-400 text-sm mt-1">Kosongkan jika tidak ingin mengganti foto. Format: JPG, JPEG, PNG. Maks: 2MB</p>
                @error('foto')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                    Simpan Perubahan
                </button>
                <a href="{{ route('admin.galeri.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection