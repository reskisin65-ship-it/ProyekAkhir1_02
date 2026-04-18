{{-- resources/views/umkm/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola UMKM')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    
    {{-- Header --}}
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🏪 Kelola UMKM Saya</h1>
        <a href="{{ route('umkm') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
            ← Lihat Toko Saya
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    {{-- Tabs --}}
    <div class="mb-6 border-b border-gray-200">
        <ul class="flex flex-wrap gap-4">
            <li>
                <a href="{{ route('umkm.dashboard') }}" class="inline-block px-4 py-2 text-emerald-600 border-b-2 border-emerald-600 font-semibold">
                    Profil Usaha
                </a>
            </li>
            <li>
                <a href="{{ route('umkm.produk.index') }}" class="inline-block px-4 py-2 text-gray-500 hover:text-emerald-600">
                    Produk Saya
                </a>
            </li>
        </ul>
    </div>

    {{-- Form Edit Profil UMKM --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <form action="{{ route('umkm.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Logo UMKM</label>
                @if($umkm->logo)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $umkm->logo) }}" class="w-24 h-24 rounded-full object-cover border-2 border-emerald-500">
                </div>
                @endif
                <input type="file" name="logo" accept="image/*" class="w-full border border-gray-300 rounded-lg px-4 py-2">
                <p class="text-gray-400 text-sm mt-1">Format: JPG, JPEG, PNG. Maks: 2MB</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nama Usaha <span class="text-red-500">*</span></label>
                <input type="text" name="nama_usaha" class="w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Kategori <span class="text-red-500">*</span></label>
                <select name="kategori" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>
                    <option value="makanan" {{ $umkm->kategori == 'makanan' ? 'selected' : '' }}>🍔 Makanan & Minuman</option>
                    <option value="kerajinan" {{ $umkm->kategori == 'kerajinan' ? 'selected' : '' }}>🎨 Kerajinan Tangan</option>
                    <option value="fashion" {{ $umkm->kategori == 'fashion' ? 'selected' : '' }}>👕 Fashion & Aksesoris</option>
                    <option value="pertanian" {{ $umkm->kategori == 'pertanian' ? 'selected' : '' }}>🌾 Pertanian & Perkebunan</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nama Pemilik <span class="text-red-500">*</span></label>
                <input type="text" name="pemilik" class="w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ old('pemilik', $umkm->pemilik) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                <input type="tel" name="no_telepon" class="w-full border border-gray-300 rounded-lg px-4 py-2" value="{{ old('no_telepon', $umkm->no_telepon) }}" required>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Alamat Usaha <span class="text-red-500">*</span></label>
                <textarea name="alamat_usaha" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>{{ old('alamat_usaha', $umkm->alamat_usaha) }}</textarea>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Deskripsi Usaha <span class="text-red-500">*</span></label>
                <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2" required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
            </div>

            <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                Simpan Perubahan
            </button>
        </form>
    </div>
</div>
@endsection
