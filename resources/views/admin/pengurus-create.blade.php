{{-- resources/views/admin/pengurus-create.blade.php --}}
@extends('layouts.admin')
@section('title', 'Tambah Pengurus Desa')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="mb-6">
        <a href="{{ route('admin.pengurus.index') }}" class="text-emerald-600 hover:text-emerald-700">← Kembali</a>
    </div>

    <div class="bg-white rounded-xl shadow-sm p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">👥 Tambah Pengurus Desa</h1>

        <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama *</label>
                    <input type="text" name="nama" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jabatan *</label>
                    <input type="text" name="jabatan" required class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                    <input type="text" name="nip" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" value="0" class="w-full px-3 py-2 border rounded-lg">
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tugas</label>
                    <textarea name="tugas" rows="3" class="w-full px-3 py-2 border rounded-lg"></textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Foto</label>
                    <input type="file" name="foto" accept="image/*" class="w-full px-3 py-2 border rounded-lg">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.pengurus.index') }}" class="px-4 py-2 border rounded-lg hover:bg-gray-50">Batal</a>
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection