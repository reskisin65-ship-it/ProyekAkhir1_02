{{-- resources/views/admin/berita-create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Editor Berita | Pro Panel')

@section('content')
<!-- Google Fonts: Inter & Plus Jakarta Sans -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --primary-glow: conic-gradient(from 180deg at 50% 50%, #10b981 0deg, #34d399 112deg, #059669 228deg, #10b981 360deg);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #fcfcfd;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.7);
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.04);
    }

    .input-premium {
        @apply w-full px-0 py-4 bg-transparent border-b border-gray-200 focus:border-emerald-500 outline-none transition-all duration-500 placeholder:text-gray-300;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 10px 20px -10px rgba(16, 185, 129, 0.5);
    }

    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px -10px rgba(16, 185, 129, 0.6);
    }

    /* Custom Checkbox/Radio */
    .radio-custom:checked + .radio-label {
        @apply border-emerald-500 bg-emerald-50 text-emerald-700 ring-1 ring-emerald-500;
    }

    /* Floating Animation for Image Preview */
    .float-anim {
        animation: floating 3s ease-in-out infinite;
    }

    @keyframes floating {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
</style>

<div class="min-h-screen py-12 px-6 lg:px-12 mb-20" x-data="newsApp()">
    <div class="max-w-6xl mx-auto">
        
        {{-- Header Section --}}
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-16 animate__animated animate__fadeIn">
            <div>
                <nav class="flex items-center space-x-2 text-xs font-bold tracking-[0.2em] text-gray-400 uppercase mb-4">
                    <a href="{{ route('admin.berita.index') }}" class="hover:text-emerald-500 transition-colors">berita</a>
                    <span>/</span>
                    <span class="text-emerald-500">buat berita baru</span>
                </nav>
                <h1 class="text-6xl font-extrabold text-slate-900 tracking-tighter">
                    buat berita <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-400">baru.</span>
                </h1>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.berita.index') }}" class="px-10 py-3 rounded-xl font-bold text-white hover:bg-red-500 transition-all text-sm bg-gray-900">BATAL</a>
            </div>
        </header>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            @csrf

            {{-- Main Content Column --}}
            <div class="lg:col-span-8 space-y-12 animate__animated animate__fadeInUp">
                
                {{-- Title Input --}}
                <div class="group">
                    <label class="block text-[10px] font-black text-gray-700 uppercase tracking-[0.3em] mb-2 group-focus-within:text-emerald-500 transition-colors">judul</label>
                    <input type="text" name="judul" required 
                        class="text-4xl lg:text-5xl font-bold input-premium" 
                        placeholder="masukkan judul disini...">
                </div>

                {{-- Content Area --}}
                <div class="glass-card rounded-[2.5rem] p-10 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-gray-600 opacity-0 group-focus-within:opacity-100 transition-all"></div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-6">isi artikel</label>
                    <textarea name="isi_berita" rows="18" required 
                        class="w-full bg-transparent border-none focus:ring-0 text-lg text-slate-700 leading-[1.8] placeholder:text-gray-400"
                        placeholder="masukkan isi berita disini..."></textarea>
                </div>
            </div>

            {{-- Sidebar Column --}}
            <div class="lg:col-span-4 space-y-8 animate__animated animate__fadeInRight delay-100ms">
                
                {{-- Media Card --}}
                <div class="glass-card rounded-[2.5rem] p-8">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-6 text-center">lampirkan gambar</label>
                    
                    <div class="relative group aspect-square rounded-[2rem] overflow-hidden bg-gray-50 border-2 border-dashed border-gray-200 hover:border-emerald-400 transition-all">
                        <template x-if="imageUrl">
                            <div class="relative h-full w-full">
                                <img :src="imageUrl" class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                    <span class="text-white text-xs font-bold uppercase tracking-widest">tukar gambar</span>
                                </div>
                            </div>
                        </template>
                        <template x-if="!imageUrl">
                            <div class="flex flex-col items-center justify-center h-full p-6 text-center">
                                <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                    <svg class="w-8 h-8 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-width="2" stroke-linecap="round"/></svg>
                                </div>
                                <p class="text-xs font-bold text-gray-400 leading-relaxed uppercase">masukkan gambar anda disini</p>
                            </div>
                        </template>
                        <input type="file" name="foto" @change="handleImage" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    </div>
                </div>

                {{-- Settings Card --}}
                <div class="bg-slate-900 rounded-[2.5rem] p-10 text-white shadow-2xl shadow-emerald-900/20">
                    <h3 class="text-xl font-bold mb-8">pilih</h3>
                    
                    <div class="space-y-8">
                        {{-- Category Select --}}
                        <div class="space-y-3 group">
    {{-- Label dengan efek hover --}}
    <label class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.4em] group-focus-within:text-emerald-300 transition-colors">
        Klasifikasi Kategori
    </label>

    <div class="relative">
        {{-- Select Input --}}
        <select name="kategori" 
            class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-5 text-sm text-white focus:ring-2 focus:ring-emerald-500/50 outline-none transition-all appearance-none cursor-pointer hover:bg-white/10 ring-1 ring-transparent hover:ring-white/20">
            
            {{-- Styling Option: Latar Putih, Teks Hitam --}}
            <option value="berita" class="bg-white text-slate-700 py-3">🗞️ Berita</option>
            <option value="pengumuman" class="bg-white text-slate-700 py-3">📢 Pengumuman</option>
            <option value="kegiatan" class="bg-white text-slate-700 py-3">📅Kegiatan</option>
        </select>

        {{-- Ikon Panah Custom yang lebih Elegan --}}
        <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-emerald-400 group-focus-within:rotate-180 transition-transform duration-300">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
            </svg>
        </div>
    </div>
</div>

<style>
    /* Menghilangkan styling default browser pada option (beberapa browser memerlukan ini) */
    select option {
        padding: 12px;
        font-weight: 600;
    }
</style>

                        {{-- Date --}}
                        <div class="space-y-3">
                            <span class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em]">Publish Date</span>
                            <input type="date" name="tanggal_publikasi" value="{{ date('Y-m-d') }}" 
                                class="w-full bg-white/5 border border-white/10 rounded-2xl py-4 px-4 text-sm focus:ring-2 focus:ring-emerald-500 transition-all">
                        </div>

                        {{-- Status Switch --}}
                        <div class="space-y-3">
                            <span class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em]">Visibility</span>
                            <div class="flex gap-3">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="publish" checked class="peer hidden">
                                    <div class="py-3 text-center rounded-xl border border-white/10 peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all text-[10px] font-black uppercase tracking-widest opacity-60 peer-checked:opacity-100">Publish</div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="draft" class="peer hidden">
                                    <div class="py-3 text-center rounded-xl border border-white/10 peer-checked:bg-white peer-checked:text-slate-900 transition-all text-[10px] font-black uppercase tracking-widest opacity-60 peer-checked:opacity-100">Draft</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Floating Publish Bar --}}
            <div class="fixed bottom-10 left-1/2 -translate-x-1/2 w-[90%] max-w-4xl z-50">
                <div class="glass-card p-4 rounded-[2rem] flex items-center justify-between shadow-2xl">
                    <div class="hidden md:flex items-center ml-4 space-x-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest">publish artikel</span>
                    </div>
                    <button type="submit" class="btn-gradient px-10 py-4 rounded-2xl text-white font-extrabold text-sm uppercase tracking-widest transition-all w-full md:w-auto">
                        Publish
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Alpine.js Logic --}}
<script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script>
    function newsApp() {
        return {
            imageUrl: null,
            handleImage(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => { this.imageUrl = e.target.result; };
                    reader.readAsDataURL(file);
                }
            }
        }
    }
</script>
@endsection