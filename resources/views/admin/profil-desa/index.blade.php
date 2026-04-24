{{-- resources/views/admin/profil-desa/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Profil Desa - Admin')

@section('content')
<style>
    /* ============================================ */
    /* ANIMATIONS & KEYFRAMES */
    /* ============================================ */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.05); }
    }
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes zoom-in {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    
    /* ============================================ */
    /* UTILITY CLASSES */
    /* ============================================ */
    .floating { animation: float 3s ease-in-out infinite; }
    .animate-pulse-slow { animation: pulse-slow 4s ease-in-out infinite; }
    
    /* ============================================ */
    /* TEXT WRAP FIX - AGAR TIDAK KELUAR KOTAK */
    /* ============================================ */
    .text-wrap-fix {
        word-wrap: break-word;
        overflow-wrap: break-word;
        word-break: break-word;
        white-space: normal;
        max-width: 100%;
    }
    
    .text-preview {
        max-height: 120px;
        overflow-y: auto;
        padding-right: 10px;
    }
    
    /* Custom scrollbar untuk text preview */
    .text-preview::-webkit-scrollbar {
        width: 4px;
    }
    .text-preview::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .text-preview::-webkit-scrollbar-thumb {
        background: #10b981;
        border-radius: 10px;
    }
    
    /* ============================================ */
    /* CARD STYLES */
    /* ============================================ */
    .info-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slide-up 0.6s ease forwards;
        opacity: 0;
    }
    .info-card:nth-child(1) { animation-delay: 0.05s; }
    .info-card:nth-child(2) { animation-delay: 0.1s; }
    .info-card:nth-child(3) { animation-delay: 0.15s; }
    .info-card:nth-child(4) { animation-delay: 0.2s; }
    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
    }
    
    .preview-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        animation: zoom-in 0.6s ease forwards;
        opacity: 0;
    }
    .preview-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 25px 40px -15px rgba(16, 185, 129, 0.2);
    }
    
    .aparatur-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slide-up 0.5s ease forwards;
        opacity: 0;
    }
    .aparatur-card:nth-child(1) { animation-delay: 0.05s; }
    .aparatur-card:nth-child(2) { animation-delay: 0.1s; }
    .aparatur-card:nth-child(3) { animation-delay: 0.15s; }
    .aparatur-card:nth-child(4) { animation-delay: 0.2s; }
    .aparatur-card:nth-child(5) { animation-delay: 0.25s; }
    .aparatur-card:hover {
        background: linear-gradient(90deg, #f0fdf4, transparent);
    }
    
    /* ============================================ */
    /* BUTTON STYLES */
    /* ============================================ */
    .btn-edit-premium {
        background: linear-gradient(135deg, #10b981, #059669);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-edit-premium::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .btn-edit-premium:hover::before {
        width: 300px;
        height: 300px;
    }
    .btn-edit-premium:hover {
        transform: scale(1.02);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }
    
    .action-edit {
        transition: all 0.3s ease;
    }
    .action-edit:hover {
        background: #3b82f6;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .action-delete {
        transition: all 0.3s ease;
    }
    .action-delete:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }
    
    /* Line Clamp */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Premium --}}
        <div class="relative mb-10">
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl animate-pulse-slow"></div>
            </div>
            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg floating">
                            <i class="fa-solid fa-building text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl md:text-5xl font-serif italic text-emerald-900">🏛️ Kelola Profil Desa</h1>
                            <p class="text-gray-500 mt-1 ml-1">Kelola sejarah, visi misi, dan informasi desa lainnya</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 ml-16">
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <i class="fa-regular fa-clock"></i>
                            <span>Terakhir diperbarui: {{ now()->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.profil-desa.edit') }}" 
                       class="btn-edit-premium group relative px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        <i class="fa-solid fa-pen text-sm group-hover:rotate-12 transition-transform duration-300"></i>
                        <span class="relative z-10">Edit Profil Desa</span>
                    </a>
                </div>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-full mt-5 ml-16"></div>
        </div>
        
        {{-- Preview Card Premium --}}
        <div class="preview-card bg-white rounded-2xl shadow-xl overflow-hidden mb-8 border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-4 border-b border-gray-100">
                <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <i class="fa-regular fa-eye text-emerald-500"></i>
                    </div>
                    Preview Profil Desa
                </h2>
            </div>
            
            <div class="p-6">
                {{-- Sejarah --}}
                <div class="mb-6">
                    <h3 class="text-lg font-semibold text-emerald-700 mb-2 flex items-center gap-2">
                        <i class="fa-regular fa-clock"></i> Sejarah Desa
                    </h3>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        @if($profil && $profil->sejarah)
                            <div class="text-gray-600 leading-relaxed text-wrap-fix text-preview">
                                {{ $profil->sejarah }}
                            </div>
                        @else
                            <p class="text-gray-400 italic text-center py-4">Belum diisi</p>
                        @endif
                    </div>
                </div>
                
                {{-- Visi & Misi --}}
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    {{-- Visi Card --}}
                    <div>
                        <h3 class="text-lg font-semibold text-emerald-700 mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-eye"></i> Visi
                        </h3>
                        <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/30 rounded-xl p-4 border border-emerald-100 h-48">
                            @if($profil && $profil->visi)
                                <div class="text-gray-700 leading-relaxed text-wrap-fix text-preview italic h-full">
                                    "{{ $profil->visi }}"
                                </div>
                            @else
                                <p class="text-gray-400 italic text-center py-4">Belum diisi</p>
                            @endif
                        </div>
                    </div>
                    
                    {{-- Misi Card --}}
                    <div>
                        <h3 class="text-lg font-semibold text-emerald-700 mb-2 flex items-center gap-2">
                            <i class="fa-solid fa-flag-checkered"></i> Misi
                        </h3>
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100/30 rounded-xl p-4 border border-blue-100 h-48">
                            @if($profil && $profil->misi)
                                <div class="text-gray-700 leading-relaxed text-wrap-fix text-preview">
                                    {{ $profil->misi }}
                                </div>
                            @else
                                <p class="text-gray-400 italic text-center py-4">Belum diisi</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                {{-- Informasi Desa Cards --}}
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                    <div class="info-card bg-gradient-to-br from-emerald-50 to-emerald-100/30 rounded-xl p-3 text-center">
                        <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center mx-auto mb-2 shadow-md">
                            <i class="fa-regular fa-calendar text-white text-sm"></i>
                        </div>
                        <p class="text-xl font-bold text-emerald-700 text-wrap-fix">{{ $profil->tahun_berdiri ?? '-' }}</p>
                        <p class="text-[9px] text-gray-500">Tahun Berdiri</p>
                    </div>
                    <div class="info-card bg-gradient-to-br from-blue-50 to-blue-100/30 rounded-xl p-3 text-center">
                        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center mx-auto mb-2 shadow-md">
                            <i class="fa-solid fa-map text-white text-sm"></i>
                        </div>
                        <p class="text-xl font-bold text-blue-700 text-wrap-fix">{{ $profil->luas_wilayah ?? '-' }}</p>
                        <p class="text-[9px] text-gray-500">Luas (km²)</p>
                    </div>
                    <div class="info-card bg-gradient-to-br from-amber-50 to-amber-100/30 rounded-xl p-3 text-center">
                        <div class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center mx-auto mb-2 shadow-md">
                            <i class="fa-solid fa-tree text-white text-sm"></i>
                        </div>
                        <p class="text-xl font-bold text-amber-700 text-wrap-fix">{{ $profil->jumlah_dusun ?? '-' }}</p>
                        <p class="text-[9px] text-gray-500">Jumlah Dusun</p>
                    </div>
                    <div class="info-card bg-gradient-to-br from-purple-50 to-purple-100/30 rounded-xl p-3 text-center">
                        <div class="w-10 h-10 bg-purple-500 rounded-xl flex items-center justify-center mx-auto mb-2 shadow-md">
                            <i class="fa-solid fa-users text-white text-sm"></i>
                        </div>
                        <p class="text-xl font-bold text-purple-700 text-wrap-fix">{{ $aparaturs->count() }}</p>
                        <p class="text-[9px] text-gray-500">Aparatur</p>
                    </div>
                </div>
                
                {{-- Kontak --}}
                <div class="grid md:grid-cols-2 gap-4 pt-4 border-t border-gray-100">
                    <div class="flex items-center gap-3 text-sm text-gray-600 group hover:bg-emerald-50 p-3 rounded-xl transition-all duration-300">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition-all duration-300">
                            <i class="fa-regular fa-envelope text-emerald-500 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="text-wrap-fix">{{ $profil->email_desa ?? 'Email belum diisi' }}</span>
                    </div>
                    <div class="flex items-center gap-3 text-sm text-gray-600 group hover:bg-emerald-50 p-3 rounded-xl transition-all duration-300">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition-all duration-300">
                            <i class="fa-regular fa-phone text-emerald-500 group-hover:text-white text-sm"></i>
                        </div>
                        <span>{{ $profil->telepon_desa ?? 'Telepon belum diisi' }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Tabel Aparatur Desa Premium --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-4 border-b border-gray-100 flex justify-between items-center flex-wrap gap-4">
                <div>
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                            <i class="fa-solid fa-users text-emerald-500"></i>
                        </div>
                        Aparatur Desa
                    </h2>
                    <p class="text-xs text-gray-500 mt-1">Data perangkat desa Lumban Silintong</p>
                </div>
                <a href="{{ route('admin.pengurus.index') }}" 
                   class="group px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-105 flex items-center gap-2 text-sm">
                    <i class="fa-solid fa-users-gear group-hover:rotate-12 transition-transform"></i>
                    Kelola Aparatur
                </a>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">No</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Foto</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Nama</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Jabatan</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($aparaturs->take(5) as $index => $a)
                        <tr class="aparatur-card hover:bg-emerald-50/30 transition duration-300">
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $index + 1 }}</td>
                            <td class="px-6 py-4">
                                <div class="w-10 h-10 rounded-full overflow-hidden bg-gradient-to-br from-emerald-100 to-emerald-200 shadow-md">
                                    @if($a->foto)
                                        <img src="{{ asset('storage/' . $a->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fa-solid fa-user text-emerald-500"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 font-medium text-gray-800 text-wrap-fix">{{ $a->nama_pengurus ?? $a->nama }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-emerald-100 text-emerald-700 rounded-full text-xs font-semibold">
                                    {{ $a->jabatan }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.pengurus.edit', $a->id_pengurus) }}" 
                                       class="action-edit w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all duration-300">
                                        <i class="fa-solid fa-eye text-sm"></i>
                                    </a>
                                    <form action="{{ route('admin.pengurus.destroy', $a->id_pengurus) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-delete w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-all duration-300">
                                            <i class="fa-solid fa-trash text-sm"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-solid fa-users-slash text-3xl text-gray-400"></i>
                                </div>
                                <p>Belum ada data aparatur desa</p>
                                <a href="{{ route('admin.pengurus.index') }}" class="inline-block mt-3 text-emerald-600 text-sm hover:underline">
                                    Kelola Aparatur
                                </a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($aparaturs->count() > 5)
            <div class="bg-gray-50 px-6 py-3 text-center border-t border-gray-100">
                <a href="{{ route('admin.pengurus.index') }}" class="text-emerald-600 text-sm font-semibold hover:underline inline-flex items-center gap-1 group">
                    Lihat Semua Aparatur ({{ $aparaturs->count() }})
                    <i class="fa-solid fa-arrow-right text-xs group-hover:translate-x-1 transition"></i>
                </a>
            </div>
            @endif
        </div>
        
        {{-- Info Footer --}}
        <div class="mt-8 text-center">
            <p class="text-xs text-gray-400 flex items-center justify-center gap-2 flex-wrap">
                <i class="fa-regular fa-circle-check text-emerald-500"></i> Data profil desa dikelola oleh administrator
                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                <i class="fa-regular fa-clock"></i> Update terakhir: {{ now()->translatedFormat('d F Y H:i') }}
            </p>
        </div>
    </div>
</div>
@endsection