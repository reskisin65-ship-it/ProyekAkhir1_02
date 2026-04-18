{{-- resources/views/umkm/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit UMKM')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-6">
        <a href="{{ route('umkm.index') }}" class="text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
            <h1 class="text-2xl md:text-3xl font-serif italic text-white">✏️ Edit UMKM</h1>
            <p class="text-blue-100 mt-1">Perbarui data usaha Anda</p>
        </div>

        <div class="p-8">
            <form action="{{ route('umkm.update', $umkm->id_umkm) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Usaha *</label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                        <select name="kategori" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                            <option value="makanan" {{ $umkm->kategori == 'makanan' ? 'selected' : '' }}>🍔 Makanan</option>
                            <option value="kerajinan" {{ $umkm->kategori == 'kerajinan' ? 'selected' : '' }}>🎨 Kerajinan</option>
                            <option value="fashion" {{ $umkm->kategori == 'fashion' ? 'selected' : '' }}>👕 Fashion</option>
                            <option value="pertanian" {{ $umkm->kategori == 'pertanian' ? 'selected' : '' }}>🌾 Pertanian</option>
                            <option value="jasa" {{ $umkm->kategori == 'jasa' ? 'selected' : '' }}>💼 Jasa</option>
                            <option value="lainnya" {{ $umkm->kategori == 'lainnya' ? 'selected' : '' }}>📦 Lainnya</option>
                        </select>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pemilik</label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', $umkm->pemilik) }}" class="w-full px-4 py-3 rounded-xl border border-gray-200 bg-gray-50" readonly>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon *</label>
                        <input type="tel" name="no_telepon" value="{{ old('no_telepon', $umkm->no_telepon) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Usaha *</label>
                        <textarea name="alamat_usaha" rows="2" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">{{ old('alamat_usaha', $umkm->alamat_usaha) }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Usaha *</label>
                        <textarea name="deskripsi" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('umkm.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-semibold hover:from-blue-500 hover:to-blue-600 transition shadow-md">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
