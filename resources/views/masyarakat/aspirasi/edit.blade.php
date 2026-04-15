{{-- resources/views/masyarakat/aspirasi/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Aspirasi')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-6">
        <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-blue-600 hover:text-blue-700 inline-flex items-center gap-2 group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-green-600 to-green-700 px-8 py-6">
            <h1 class="text-2xl md:text-3xl font-serif italic text-white">✏️ Edit Aspirasi</h1>
            <p class="text-green-100 mt-1 text-sm">Perbarui aspirasi Anda</p>
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

            <form action="{{ route('masyarakat.aspirasi.update', $aspirasi->id_aspirasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            <label class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="kategori" value="saran" {{ $aspirasi->kategori == 'saran' ? 'checked' : '' }}> 💡 Saran
                            </label>
                            <label class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="kategori" value="keluhan" {{ $aspirasi->kategori == 'keluhan' ? 'checked' : '' }}> 😞 Keluhan
                            </label>
                            <label class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="kategori" value="masukan" {{ $aspirasi->kategori == 'masukan' ? 'checked' : '' }}> 📝 Masukan
                            </label>
                            <label class="flex items-center gap-2 p-3 border rounded-xl cursor-pointer hover:bg-blue-50 transition">
                                <input type="radio" name="kategori" value="pertanyaan" {{ $aspirasi->kategori == 'pertanyaan' ? 'checked' : '' }}> ❓ Pertanyaan
                            </label>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul</label>
                        <input type="text" name="judul" value="{{ old('judul', $aspirasi->judul) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Isi Aspirasi</label>
                        <textarea name="isi" rows="6" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition">{{ old('isi', $aspirasi->isi_aspirasi) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Lampiran (Opsional)</label>
                        @if($aspirasi->lampiran)
                        <div class="mb-2 p-2 bg-gray-50 rounded-lg flex items-center gap-2">
                            <i class="fa-solid fa-file-pdf text-red-500"></i>
                            <span class="text-sm text-gray-600">Lampiran saat ini: {{ basename($aspirasi->lampiran) }}</span>
                            <a href="{{ Storage::url($aspirasi->lampiran) }}" target="_blank" class="text-blue-500 text-sm hover:underline">Lihat</a>
                        </div>
                        @endif
                        <input type="file" name="lampiran" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>
                </div>

                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('masyarakat.aspirasi.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl font-semibold hover:from-green-500 hover:to-green-600 transition shadow-md">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection