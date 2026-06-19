{{-- resources/views/admin/berita-create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Editor Berita | Panel Admin')

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
        width: 100%;
        padding: 1rem 0;
        background: transparent;
        border: none;
        border-bottom: 1px solid #e5e7eb;
        outline: none;
        transition: border-color 0.5s;
    }
    .input-premium:focus { border-color: #10b981; }
    .input-premium::placeholder { color: #d1d5db; }

    .btn-gradient {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        box-shadow: 0 10px 20px -10px rgba(16, 185, 129, 0.5);
    }
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 25px -10px rgba(16, 185, 129, 0.6);
    }

    /* Responsive typography */
    .title-input {
        font-size: clamp(1.5rem, 5vw, 3rem);
        font-weight: 800;
    }

    .headline-h1 {
        font-size: clamp(2rem, 6vw, 3.75rem);
        font-weight: 800;
        letter-spacing: -0.04em;
        line-height: 1.05;
    }

    /* Foto preview constrained */
    .foto-preview-wrap {
        width: 100%;
        max-width: 100%;
        overflow: hidden;
    }

    /* Floating publish bar — sits above mobile nav */
    .publish-bar {
        position: fixed;
        bottom: 110px; /* above mobile nav (76px + 14px gap + extra) */
        left: 50%;
        transform: translateX(-50%);
        width: 90%;
        max-width: 56rem;
        z-index: 50;
    }

    @media (min-width: 1025px) {
        /* On desktop the mobile nav is hidden, so bring bar back down */
        .publish-bar {
            bottom: 2.5rem;
        }
    }

    /* Page bottom padding so content not hidden behind publish bar */
    .page-bottom-pad {
        padding-bottom: 10rem;
    }

    @media (min-width: 1025px) {
        .page-bottom-pad { padding-bottom: 5rem; }
    }

    select option {
        padding: 12px;
        font-weight: 600;
    }
</style>

<div class="min-h-screen py-8 px-4 sm:px-6 lg:px-12 page-bottom-pad" x-data="newsApp()">
    <div class="max-w-6xl mx-auto">
        
        {{-- Header Section --}}
        <header class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 animate__animated animate__fadeIn">
            <div class="min-w-0">
                <nav class="flex items-center space-x-2 text-xs font-bold tracking-[0.2em] text-gray-400 uppercase mb-3">
                    <a href="{{ route('admin.berita.index') }}" class="hover:text-emerald-500 transition-colors">berita</a>
                    <span>/</span>
                    <span class="text-emerald-500">buat berita baru</span>
                </nav>
                <h1 class="headline-h1 text-slate-900">
                    buat berita <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-400">baru.</span>
                </h1>
            </div>
            <div class="flex items-center gap-4 flex-shrink-0">
                <a href="{{ route('admin.berita.index') }}" class="px-6 py-3 rounded-xl font-bold text-white hover:bg-red-500 transition-all text-sm bg-gray-900 whitespace-nowrap">BATAL</a>
            </div>
        </header>

        <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            @csrf

            {{-- Main Content Column --}}
            <div class="lg:col-span-8 space-y-8 animate__animated animate__fadeInUp">
                
                {{-- Title Input --}}
                <div class="group">
                    <label class="block text-[10px] font-black text-gray-700 uppercase tracking-[0.3em] mb-2 group-focus-within:text-emerald-500 transition-colors">judul</label>
                    <input type="text" name="judul" required 
                        class="title-input input-premium w-full" 
                        placeholder="masukkan judul disini...">
                </div>

                {{-- Content Area --}}
                <div class="glass-card rounded-3xl p-6 sm:p-10 relative overflow-hidden group">
                    <div class="absolute top-0 left-0 w-1 h-full bg-gray-600 opacity-0 group-focus-within:opacity-100 transition-all"></div>
                    <label class="block text-[10px] font-black text-gray-500 uppercase tracking-[0.3em] mb-4">isi artikel</label>
                    <textarea name="isi_berita" rows="16" required 
                        class="w-full bg-transparent border-none focus:ring-0 text-base text-slate-700 leading-relaxed placeholder:text-gray-400 resize-y min-h-[200px]"
                        placeholder="masukkan isi berita disini..."></textarea>
                </div>
            </div>

            {{-- Sidebar Column --}}
            <div class="lg:col-span-4 space-y-6 animate__animated animate__fadeInRight">
                
                {{-- Media Card --}}
                <div class="glass-card rounded-3xl p-6">
                    <label class="block text-[10px] font-black text-gray-400 uppercase tracking-[0.3em] mb-4 text-center">lampirkan gambar</label>
                    
                    <div class="relative group aspect-square rounded-2xl overflow-hidden bg-gray-50 border-2 border-dashed border-gray-200 hover:border-emerald-400 transition-all foto-preview-wrap">
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
                                <div class="w-14 h-14 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-3 group-hover:scale-110 transition-transform">
                                    <svg class="w-7 h-7 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6v6m0 0v6m0-6h6m-6 0H6" stroke-width="2" stroke-linecap="round"/></svg>
                                </div>
                                <p class="text-xs font-bold text-gray-400 leading-relaxed uppercase">masukkan gambar anda disini</p>
                            </div>
                        </template>
                        <input type="file" name="foto" @change="handleImage" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    </div>
                </div>

                {{-- Settings Card --}}
                <div class="bg-slate-900 rounded-3xl p-6 sm:p-8 text-white shadow-2xl shadow-emerald-900/20">
                    <h3 class="text-lg font-bold mb-6">pilih</h3>
                    
                    <div class="space-y-6">
                        {{-- Category Select --}}
                        <div class="space-y-2 group">
                            <label class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.4em]">
                                Klasifikasi Kategori
                            </label>
                            <div class="relative">
                                <select name="kategori" 
                                    class="w-full bg-white/5 border border-white/10 rounded-2xl py-3 px-4 text-sm text-white focus:ring-2 focus:ring-emerald-500/50 outline-none transition-all appearance-none cursor-pointer hover:bg-white/10">
                                    <option value="berita" class="bg-white text-slate-700">🗞️ Berita</option>
                                    <option value="pengumuman" class="bg-white text-slate-700">📢 Pengumuman</option>
                                    <option value="kegiatan" class="bg-white text-slate-700">📅 Kegiatan</option>
                                </select>
                                <div class="absolute inset-y-0 right-4 flex items-center pointer-events-none text-emerald-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </div>
                        </div>

                        {{-- Date --}}
                        <div class="space-y-2">
                            <span class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em]">Publish Date</span>
                            <input type="date" name="tanggal_publikasi" value="{{ date('Y-m-d') }}" readonly
                                class="w-full bg-white/5 border border-white/10 rounded-2xl py-3 px-4 text-sm opacity-70 cursor-not-allowed">
                        </div>

                        {{-- Status Switch --}}
                        <div class="space-y-2">
                            <span class="block text-[10px] font-black text-emerald-400 uppercase tracking-[0.3em]">Visibility</span>
                            <div class="flex gap-3">
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="publish" checked class="peer hidden">
                                    <div class="py-3 text-center rounded-xl border border-white/10 peer-checked:bg-emerald-500 peer-checked:border-emerald-500 transition-all text-[10px] font-black uppercase tracking-widest opacity-60 peer-checked:opacity-100">Set Publish</div>
                                </label>
                                <label class="flex-1 cursor-pointer">
                                    <input type="radio" name="status" value="draft" class="peer hidden">
                                    <div class="py-3 text-center rounded-xl border border-white/10 peer-checked:bg-white peer-checked:text-slate-900 transition-all text-[10px] font-black uppercase tracking-widest opacity-60 peer-checked:opacity-100">Set Draft</div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Floating Publish Bar — above mobile nav --}}
            <div class="publish-bar">
                <div class="glass-card p-3 sm:p-4 rounded-2xl flex items-center justify-between shadow-2xl gap-3">
                    <div class="hidden sm:flex items-center ml-2 space-x-3">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse flex-shrink-0"></div>
                        <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest whitespace-nowrap">simpan artikel ke sistem</span>
                    </div>
                    <button type="submit" class="btn-gradient px-8 py-3.5 rounded-xl text-white font-extrabold text-sm uppercase tracking-widest transition-all w-full sm:w-auto">
                        Simpan Berita
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