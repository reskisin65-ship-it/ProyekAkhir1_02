{{-- resources/views/masyarakat/aspirasi/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Sampaikan Aspirasi')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-blue-600 hover:text-blue-700 inline-flex items-center gap-2 group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-6">
            <h1 class="text-2xl md:text-3xl font-serif italic text-white">💬 Sampaikan Aspirasi</h1>
            <p class="text-blue-100 mt-1 text-sm">Suara Anda penting untuk kemajuan desa</p>
        </div>

        <div class="p-8">
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 rounded-xl text-red-600 text-sm border-l-4 border-red-500">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('masyarakat.aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="space-y-6">
                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-tag text-blue-500 mr-1"></i> Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <label class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="kategori" value="saran" class="text-blue-500" required> 💡 Saran
                            </label>
                            <label class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="kategori" value="keluhan" class="text-blue-500"> 😞 Keluhan
                            </label>
                            <label class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="kategori" value="masukan" class="text-blue-500"> 📝 Masukan
                            </label>
                            <label class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="kategori" value="pertanyaan" class="text-blue-500"> ❓ Pertanyaan
                            </label>
                        </div>
                    </div>

                    {{-- Judul --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-heading text-blue-500 mr-1"></i> Judul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul') }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                               placeholder="Masukkan judul aspirasi Anda">
                    </div>

                    {{-- Isi Aspirasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-message text-blue-500 mr-1"></i> Isi Aspirasi <span class="text-red-500">*</span>
                        </label>
                        <textarea name="isi" rows="6" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                                  placeholder="Tulis aspirasi, saran, atau keluhan Anda secara detail...">{{ old('isi') }}</textarea>
                    </div>

                    {{-- Lampiran --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-paperclip text-blue-500 mr-1"></i> Lampiran (Opsional)
                        </label>
                        <input type="file" name="lampiran" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        <p class="text-xs text-gray-400 mt-1">Format: PDF, JPG, PNG. Maksimal 2MB</p>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('masyarakat.aspirasi.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl font-semibold hover:from-blue-500 hover:to-blue-600 transition shadow-md hover:shadow-lg flex items-center gap-2">
                        <i class="fa-regular fa-paper-plane"></i> Kirim Aspirasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Info Box --}}
    <div class="mt-6 bg-blue-50 rounded-xl p-4 border-l-4 border-blue-500">
        <div class="flex items-start gap-3">
            <i class="fa-solid fa-circle-info text-blue-500 text-xl"></i>
            <div>
                <h4 class="font-semibold text-blue-800">Informasi Penting</h4>
                <p class="text-sm text-blue-700 mt-1">Aspirasi Anda akan ditanggapi maksimal 3 hari kerja oleh perangkat desa. Pastikan data yang Anda masukkan jelas dan mudah dipahami.</p>
            </div>
        </div>
    </div>
</div>
@endsection
