{{-- resources/views/admin/berita-create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Tambah Berita')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.berita.index') }}" class="text-emerald-600 hover:text-emerald-700">← Kembali</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">📝 Tambah Berita</h1>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita *</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                    <select name="kategori" required class="w-full px-3 py-2 border rounded-lg">
                        <option value="berita">Berita</option>
                        <option value="pengumuman">Pengumuman</option>
                        <option value="kegiatan">Kegiatan</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border rounded-lg">
                        <option value="publish">Publish</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publikasi *</label>
                    <input type="date" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', date('Y-m-d')) }}" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar (Opsional)</label>
                    <input type="file" name="gambar" accept="image/*" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita *</label>
                    <textarea name="isi" rows="10" required class="w-full px-3 py-2 border rounded-lg">{{ old('isi') }}</textarea>
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection