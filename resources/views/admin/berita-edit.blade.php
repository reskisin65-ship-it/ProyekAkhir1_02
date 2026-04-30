{{-- resources/views/admin/berita-edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Berita | Panel Admin')

@section('content')
<div class="min-h-screen bg-[#f8fafc] py-12 px-4 sm:px-6 lg:px-8 font-sans">
    <div class="max-w-5xl mx-auto">
        
        {{-- Breadcrumb Navigation --}}
        <nav class="flex mb-8 animate-fade-in" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.berita.index') }}" class="text-sm text-gray-500 hover:text-indigo-600 transition-colors flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">Edit Berita</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- Main Header --}}
        <div class="mb-10 text-center sm:text-left">
            <h1 class="text-4xl font-extrabold text-gray-900 tracking-tight sm:text-5xl">
                Edit <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-600 to-emerald-500">Konten Berita</span>
            </h1>
            <p class="mt-3 text-lg text-gray-500">Perbarui informasi, sesuaikan kategori, dan kelola aset visual berita.</p>
        </div>

        {{-- Error handling with animation --}}
        @if ($errors->any())
        <div class="mb-8 p-5 bg-red-50/50 backdrop-blur-md border-l-4 border-red-500 rounded-xl shadow-sm animate-shake">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-bold text-red-800 uppercase tracking-wider">Terjadi Kesalahan Input</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside space-y-1 font-medium">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif

        {{-- Main Form Card (Glassmorphism Effect) --}}
        <div class="relative group">
            {{-- Decorative glow behind card --}}
            <div class="absolute -inset-1 bg-gradient-to-r from-indigo-500 to-emerald-500 rounded-2xl blur opacity-15 group-hover:opacity-25 transition duration-1000 group-hover:duration-200"></div>
            
            <div class="relative bg-white/80 backdrop-blur-xl border border-white/40 rounded-2xl shadow-2xl overflow-hidden shadow-indigo-100/50">
                <form action="{{ route('admin.berita.update', $berita->id_berita) }}" method="POST" enctype="multipart/form-data" class="divide-y divide-gray-100">
                    @csrf
                    @method('PUT')

                    <div class="p-8 sm:p-10 space-y-8">
                        
                        {{-- Judul Input --}}
                        <div class="group/input">
                            <label class="block text-sm font-bold text-gray-700 mb-2 transition-colors group-focus-within/input:text-indigo-600">
                                Judul Berita <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" 
                                   class="block w-full px-5 py-4 bg-gray-50/50 border-0 ring-1 ring-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 text-gray-800 placeholder-gray-400 font-medium"
                                   placeholder="Masukkan judul..." required>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            {{-- Kategori Select --}}
                            <div class="group/input">
                                <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within/input:text-indigo-600">
                                    Kategori Berita
                                </label>
                                <div class="relative">
                                    <select name="kategori" class="appearance-none block w-full px-5 py-4 bg-gray-50/50 border-0 ring-1 ring-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 font-medium text-gray-700">
                                        <option value="umum" {{ old('kategori', $berita->kategori) == 'umum' ? 'selected' : '' }}>🌎 Berita</option>
                                        <option value="kegiatan" {{ old('kategori', $berita->kategori) == 'kegiatan' ? 'selected' : '' }}>📅 Kegiatan</option>
                                        <option value="pengumuman" {{ old('kategori', $berita->kategori) == 'pengumuman' ? 'selected' : '' }}>📢 Pengumuman</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-400">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Tanggal Input --}}
                            <div class="group/input">
                                <label class="block text-sm font-bold text-gray-700 mb-2 group-focus-within/input:text-indigo-600">
                                    Tanggal Publikasi
                                </label>
                                <input type="date" name="tanggal_publikasi" value="{{ old('tanggal_publikasi', $berita->tanggal_publikasi) }}" 
                                       class="block w-full px-5 py-4 bg-gray-50/50 border-0 ring-1 ring-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 font-medium text-gray-700" required>
                            </div>
                        </div>

                        {{-- Isi Berita (Textarea) --}}
                        <div class="group/input">
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-sm font-bold text-gray-700 group-focus-within/input:text-indigo-600 transition-colors">
                                    Konten Berita Lengkap
                                </label>
                                <span class="text-xs font-semibold text-gray-400 uppercase tracking-widest">Markdown Supported</span>
                            </div>
                            <textarea name="isi_berita" rows="12" 
                                      class="block w-full px-5 py-4 bg-gray-50/50 border-0 ring-1 ring-gray-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:bg-white transition-all duration-300 text-gray-700 leading-relaxed font-normal" 
                                      placeholder="Tuliskan isi berita di sini..." required>{{ old('isi_berita', $berita->isi_berita) }}</textarea>
                        </div>

                        {{-- Foto Upload Section --}}
                        <div class="bg-gray-50/50 p-6 rounded-2xl border border-dashed border-gray-200" x-data="imagePreview()">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                                <div>
                                    <h3 class="text-base font-bold text-gray-800 mb-2">Media Utama</h3>
                                    <p class="text-sm text-gray-500 mb-6">Unggah foto berkualitas tinggi (JPG, PNG, atau WebP) maksimal 2MB untuk hasil terbaik.</p>
                                    
                                    <div class="relative">
                                        <input type="file" name="foto" @change="previewImage" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                                        <div class="flex items-center justify-center w-full px-6 py-4 bg-indigo-50 text-indigo-700 rounded-xl border border-indigo-200 hover:bg-indigo-100 transition-colors group/upload">
                                            <svg class="w-5 h-5 mr-3 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                                            <span class="font-bold">Ganti Foto Baru</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="relative">
                                    <p class="text-xs font-bold text-gray-400 mb-3 uppercase tracking-tighter">Preview Media</p>
                                    <div class="aspect-video w-full relative rounded-xl overflow-hidden bg-white shadow-inner border border-gray-100 group/image">
                                        {{-- Current Image / New Preview --}}
                                        <template x-if="imageUrl">
                                            <img :src="imageUrl" class="w-full h-full object-cover animate-fade-in-down">
                                        </template>
                                        <template x-if="!imageUrl">
                                            @if($berita->foto)
                                                <img src="{{ asset('storage/' . $berita->foto) }}" class="w-full h-full object-cover shadow-lg">
                                            @else
                                                <div class="flex flex-col items-center justify-center h-full text-gray-300">
                                                    <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                                    <span class="text-xs">tidak ada media</span>
                                                </div>
                                            @endif
                                        </template>
                                        
                                        {{-- Overlay indicator --}}
                                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover/image:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                                            <span class="text-white text-xs font-bold uppercase">Klik "Ganti Foto" untuk Mengganti</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Form Footer --}}
                    <div class="px-8 py-6 bg-gray-50/80 flex flex-col sm:flex-row justify-end items-center gap-4">
                        <a href="{{ route('admin.berita.index') }}" 
                           class="w-full sm:w-auto px-8 py-3.5 text-sm font-bold text-gray-500 hover:text-gray-700 bg-white border border-gray-200 rounded-xl hover:bg-gray-100 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            Batalkan
                        </a>
                        <button type="submit" 
                                class="w-full sm:w-auto px-10 py-3.5 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white font-bold rounded-xl shadow-lg shadow-indigo-200 hover:shadow-indigo-300 hover:scale-[1.02] active:scale-95 transition-all duration-300 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Help Footer --}}
        <p class="mt-8 text-center text-sm text-gray-400">
            Terakhir diubah oleh <span class="font-bold text-gray-500">{{ auth()->user()->name ?? 'Admin' }}</span> pada {{ $berita->updated_at->format('d M Y, H:i') }}
        </p>
    </div>
</div>

{{-- Tailwind Custom Animations --}}
<style>
    @keyframes fade-in-down {
        0% { opacity: 0; transform: translateY(-20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes fade-in {
        0% { opacity: 0; }
        100% { opacity: 1; }
    }
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        25% { transform: translateX(-5px); }
        75% { transform: translateX(5px); }
    }
    .animate-fade-in-down {
        animation: fade-in-down 0.5s ease-out;
    }
    .animate-fade-in {
        animation: fade-in 0.8s ease-out;
    }
    .animate-shake {
        animation: shake 0.4s ease-in-out 0s 2;
    }
    
    /* Scrollbar Styling */
    textarea::-webkit-scrollbar {
        width: 8px;
    }
    textarea::-webkit-scrollbar-track {
        background: transparent;
    }
    textarea::-webkit-scrollbar-thumb {
        background: #e2e8f0;
        border-radius: 10px;
    }
    textarea::-webkit-scrollbar-thumb:hover {
        background: #cbd5e1;
    }
</style>

{{-- Alpine.js Logic for Image Preview --}}
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function imagePreview() {
        return {
            imageUrl: null,
            previewImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.imageUrl = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>
@endsection