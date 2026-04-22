{{-- resources/views/admin/pengurus-create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Pengurus Desa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('admin.pengurus.index') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali
            </a>
        </div>
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-user-tie text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Tambah Pengurus Desa</h1>
                        <p class="text-emerald-100 text-sm">Tambahkan data perangkat desa baru</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('admin.pengurus.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <div class="space-y-6">
                    {{-- Nama Lengkap --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-user text-emerald-500 mr-1"></i> Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_pengurus" value="{{ old('nama_pengurus') }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition"
                               placeholder="Masukkan nama lengkap">
                    </div>
                    
                    {{-- Jabatan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-briefcase text-emerald-500 mr-1"></i> Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="jabatan" value="{{ old('jabatan') }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition"
                               placeholder="Contoh: Kepala Desa, Sekretaris Desa">
                    </div>
                    
                    {{-- NIP --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-id-card text-emerald-500 mr-1"></i> NIP (Opsional)
                        </label>
                        <input type="text" name="nip" value="{{ old('nip') }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition"
                               placeholder="Nomor Induk Pegawai">
                    </div>
                    
                    {{-- Tugas --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-tasks text-emerald-500 mr-1"></i> Tugas & Tanggung Jawab
                        </label>
                        <textarea name="tugas" rows="3"
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition resize-none"
                                  placeholder="Deskripsikan tugas dan tanggung jawab">{{ old('tugas') }}</textarea>
                    </div>
                    
                    {{-- Foto --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-camera text-emerald-500 mr-1"></i> Foto
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-400 transition">
                            <input type="file" name="foto" id="foto" class="hidden" accept="image/*">
                            <label for="foto" class="cursor-pointer flex flex-col items-center gap-2">
                                <i class="fa-solid fa-cloud-upload-alt text-4xl text-gray-400 hover:text-emerald-500 transition"></i>
                                <span class="text-sm text-gray-500">Klik untuk upload foto</span>
                                <span class="text-xs text-gray-400">Format: JPG, PNG (Maks. 2MB)</span>
                            </label>
                            <div id="preview" class="mt-3 hidden">
                                <img id="previewImage" src="#" alt="Preview" class="max-h-32 mx-auto rounded-lg shadow-md">
                            </div>
                        </div>
                    </div>
                    
                    {{-- Urutan --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-sort-numeric-down text-emerald-500 mr-1"></i> Urutan Tampil
                        </label>
                        <input type="number" name="urutan" value="{{ old('urutan', 0) }}"
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                        <p class="text-xs text-gray-400 mt-1">Semakin kecil angka, semakin atas tampilannya</p>
                    </div>
                </div>
                
                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('admin.pengurus.index') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center gap-2">
                        <i class="fa-solid fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('preview');
                const previewImage = document.getElementById('previewImage');
                previewImage.src = event.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection