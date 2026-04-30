{{-- resources/views/admin/berita-edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Berita')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-8">
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">✏️ Edit Berita</h1>
        
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
        
        <form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" 
                       class="w-full px-4 py-2 border {{ $errors->has('judul') ? 'border-red-500' : '' }} rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('judul')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select name="kategori" class="w-full px-4 py-2 border {{ $errors->has('kategori') ? 'border-red-500' : '' }} rounded-lg focus:ring-emerald-500 focus:border-emerald-500">
                    <option value="umum" {{ old('kategori', $berita->kategori) == 'umum' ? 'selected' : '' }}>Umum</option>
                    <option value="kegiatan" {{ old('kategori', $berita->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="pengumuman" {{ old('kategori', $berita->kategori) == 'pengumuman' ? 'selected' : '' }}>Pengumuman</option>
                </select>
                @error('kategori')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Isi Berita</label>
                <textarea name="isi_berita" rows="8" class="w-full px-4 py-2 border {{ $errors->has('isi_berita') ? 'border-red-500' : '' }} rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>{{ old('isi_berita', $berita->isi_berita) }}</textarea>
                @error('isi_berita')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Foto Saat Ini</label>
                @if($berita->foto)
                    <img src="{{ asset('storage/' . $berita->foto) }}" class="w-32 h-32 object-cover rounded-lg">
                @else
                    <p class="text-gray-400">Tidak ada foto</p>
                @endif
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Ganti Foto</label>
                <input type="file" name="foto" accept="image/*" class="w-full px-4 py-2 border {{ $errors->has('foto') ? 'border-red-500' : '' }} rounded-lg">
                @error('foto')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publikasi</label>
                <input type="date" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', $berita->tanggal_publikasi) }}" 
                       class="w-full px-4 py-2 border {{ $errors->has('tanggal_publikasi') ? 'border-red-500' : '' }} rounded-lg focus:ring-emerald-500 focus:border-emerald-500" required>
                @error('tanggal_publikasi')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>
            
            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700 transition">Simpan</button>
                <a href="{{ route('admin.berita.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection