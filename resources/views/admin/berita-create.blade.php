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

        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg">
                <h3 class="text-red-800 font-semibold mb-2">Validasi Error:</h3>
                <ul class="text-red-700 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Judul Berita *</label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required class="w-full px-3 py-2 border {{ $errors->has('judul') ? 'border-red-500' : '' }} rounded-lg focus:ring-2 focus:ring-emerald-500">
                    @error('judul')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                    <select name="kategori" required class="w-full px-3 py-2 border {{ $errors->has('kategori') ? 'border-red-500' : '' }} rounded-lg">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="berita" {{ old('kategori') == 'berita' ? 'selected' : '' }}>Berita</option>
                        <option value="pengumuman" {{ old('kategori') == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                        <option value="kegiatan" {{ old('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    </select>
                    @error('kategori')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" class="w-full px-3 py-2 border rounded-lg">
                        <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>Publish</option>
                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publikasi *</label>
                    <input type="date" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', date('Y-m-d')) }}" required class="w-full px-3 py-2 border {{ $errors->has('tanggal_publikasi') ? 'border-red-500' : '' }} rounded-lg">
                    @error('tanggal_publikasi')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Gambar (Opsional)</label>
                    <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 border {{ $errors->has('foto') ? 'border-red-500' : '' }} rounded-lg">
                    @error('foto')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita *</label>
                    <textarea name="isi_berita" rows="10" required class="w-full px-3 py-2 border {{ $errors->has('isi_berita') ? 'border-red-500' : '' }} rounded-lg">{{ old('isi_berita') }}</textarea>
                    @error('isi_berita')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
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
