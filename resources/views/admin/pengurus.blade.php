{{-- resources/views/admin/pengurus.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Pengurus Desa - Lumban Silintong')

@section('content')
<style>
    /* ============================================ */
    /* ANIMATIONS & KEYFRAMES */
    /* ============================================ */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    @keyframes pulse-glow {
        0%, 100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.4); }
        50% { box-shadow: 0 0 0 15px rgba(16, 185, 129, 0); }
    }
    @keyframes shine {
        0% { background-position: -100%; }
        100% { background-position: 200%; }
    }
    @keyframes slide-up {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* ============================================ */
    /* CARD STYLES */
    /* ============================================ */
    .pengurus-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slide-up 0.6s ease forwards;
        opacity: 0;
        position: relative;
        overflow: hidden;
    }
    .pengurus-card:nth-child(1) { animation-delay: 0.05s; }
    .pengurus-card:nth-child(2) { animation-delay: 0.1s; }
    .pengurus-card:nth-child(3) { animation-delay: 0.15s; }
    .pengurus-card:nth-child(4) { animation-delay: 0.2s; }
    .pengurus-card:nth-child(5) { animation-delay: 0.25s; }
    .pengurus-card:nth-child(6) { animation-delay: 0.3s; }
    
    .pengurus-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s ease;
        z-index: 1;
        pointer-events: none;
    }
    
    .pengurus-card:hover::before {
        left: 100%;
    }
    
    .pengurus-card:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 25px 40px -15px rgba(16, 185, 129, 0.25);
    }
    
    /* ============================================ */
    /* AVATAR STYLES */
    /* ============================================ */
    .avatar-wrapper {
        position: relative;
        transition: all 0.3s ease;
    }
    .avatar-wrapper:hover {
        transform: scale(1.05);
    }
    .avatar-wrapper::after {
        content: '';
        position: absolute;
        inset: -3px;
        background: linear-gradient(135deg, #10b981, #059669, #34d399);
        border-radius: 50%;
        z-index: -1;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    .avatar-wrapper:hover::after {
        opacity: 1;
        animation: pulse-glow 1.5s infinite;
    }
    
    /* ============================================ */
    /* BUTTON STYLES */
    /* ============================================ */
    .btn-edit {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        color: #2563eb;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-edit::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(37, 99, 235, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .btn-edit:hover::before {
        width: 200px;
        height: 200px;
    }
    .btn-edit:hover {
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
    }
    
    .btn-delete {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        color: #dc2626;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .btn-delete::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(220, 38, 38, 0.2);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }
    .btn-delete:hover::before {
        width: 200px;
        height: 200px;
    }
    .btn-delete:hover {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }
    
    /* ============================================ */
    /* EMPTY STATE */
    /* ============================================ */
    .empty-state {
        animation: slide-up 0.6s ease forwards;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Tombol Kembali ke Profil Desa --}}
        <div class="mb-6">
            <a href="{{ route('admin.profil-desa.index') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 group transition-all duration-300 hover:gap-3">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span class="font-medium">Kembali ke Profil Desa</span>
            </a>
        </div>
        
        {{-- Header Premium --}}
        <div class="relative mb-10">
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl animate-pulse-slow"></div>
            </div>
            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg floating">
                            <i class="fa-solid fa-users text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl md:text-5xl font-serif italic text-emerald-900">👥 Kelola Pengurus Desa</h1>
                            <p class="text-gray-500 mt-1 ml-1">Kelola data perangkat desa Lumban Silintong</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 ml-16">
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <i class="fa-regular fa-building"></i>
                            <span>{{ $pengurus->total() }} Perangkat Desa</span>
                        </div>
                        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <i class="fa-regular fa-clock"></i>
                            <span>Terakhir diperbarui: {{ now()->translatedFormat('d F Y') }}</span>
                        </div>
                    </div>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.pengurus.create') }}" 
                       class="group relative px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2 overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                        <i class="fa-solid fa-plus text-sm group-hover:rotate-90 transition-transform duration-300"></i>
                        <span class="relative z-10">Tambah Pengurus</span>
                    </a>
                </div>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-full mt-5 ml-16"></div>
        </div>

        {{-- Alert Messages Premium --}}
        @if(session('success'))
        <div class="mb-6 p-5 bg-gradient-to-r from-emerald-50 to-emerald-100/30 rounded-2xl border-l-4 border-emerald-500 shadow-md animate-bounce">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-500 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-circle-check text-white text-lg"></i>
                </div>
                <div>
                    <p class="font-semibold text-emerald-700">Berhasil!</p>
                    <p class="text-sm text-emerald-600">{{ session('success') }}</p>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-5 bg-gradient-to-r from-red-50 to-red-100/30 rounded-2xl border-l-4 border-red-500 shadow-md">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-circle-exclamation text-white text-lg"></i>
                </div>
                <div>
                    <p class="font-semibold text-red-700">Terjadi Kesalahan</p>
                    <p class="text-sm text-red-600">{{ session('error') }}</p>
                </div>
            </div>
        </div>
        @endif

        {{-- Cards Grid Premium --}}
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($pengurus as $item)
            <div class="pengurus-card bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                <div class="relative">
                    {{-- Background Gradient Decoration --}}
                    <div class="absolute top-0 right-0 w-40 h-40 bg-gradient-to-br from-emerald-500/5 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 bg-gradient-to-tr from-blue-500/5 to-transparent rounded-full blur-2xl"></div>
                    
                    {{-- Card Content --}}
                    <div class="p-6">
                        <div class="flex flex-col items-center text-center">
                            {{-- Avatar with Glow Effect --}}
                            <div class="avatar-wrapper mb-4">
                                <div class="w-28 h-28 rounded-full overflow-hidden bg-gradient-to-br from-emerald-100 to-emerald-200 shadow-lg">
                                    @if($item->foto)
                                        <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-emerald-400 to-emerald-600">
                                            <i class="fa-solid fa-user text-white text-4xl"></i>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            {{-- Name & Position --}}
                            <h3 class="text-xl font-bold text-gray-800">{{ $item->nama_pengurus ?? $item->nama }}</h3>
                            <div class="inline-flex items-center gap-1 px-3 py-1 bg-emerald-100 rounded-full mt-2">
                                <i class="fa-solid fa-briefcase text-emerald-600 text-xs"></i>
                                <span class="text-xs font-semibold text-emerald-700">{{ $item->jabatan }}</span>
                            </div>
                            
                            {{-- NIP (if exists) --}}
                            @if($item->nip)
                            <div class="mt-3 flex items-center gap-1 text-xs text-gray-400">
                                <i class="fa-regular fa-id-card"></i>
                                <span>NIP: {{ $item->nip }}</span>
                            </div>
                            @endif
                            
                            {{-- Tugas (if exists) --}}
                            @if($item->tugas)
                            <div class="mt-3 p-3 bg-gray-50 rounded-xl text-left w-full">
                                <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1 flex items-center gap-1">
                                    <i class="fa-regular fa-bell"></i> Tugas & Tanggung Jawab
                                </p>
                                <p class="text-xs text-gray-600 line-clamp-2">{{ Str::limit($item->tugas, 80) }}</p>
                            </div>
                            @endif
                            
                            {{-- Urutan Badge --}}
                            <div class="mt-3 flex items-center gap-1 text-[10px] text-gray-400 bg-gray-100 px-2 py-1 rounded-full">
                                <i class="fa-solid fa-sort-numeric-down"></i>
                                <span>Urutan: {{ $item->urutan ?? 0 }}</span>
                            </div>
                            
                            {{-- Action Buttons --}}
                            <div class="flex gap-3 mt-5 w-full">
                                <a href="{{ route('admin.pengurus.edit', $item->id_pengurus) }}" 
                                   class="btn-edit flex-1 px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center justify-center gap-2 transition-all duration-300">
                                    <i class="fa-solid fa-pen"></i> Edit
                                </a>
                                <form action="{{ route('admin.pengurus.destroy', $item->id_pengurus) }}" method="POST" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete w-full px-4 py-2.5 rounded-xl text-sm font-semibold flex items-center justify-center gap-2 transition-all duration-300">
                                        <i class="fa-solid fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Bottom Decoration --}}
                    <div class="h-1 bg-gradient-to-r from-emerald-400 via-emerald-500 to-emerald-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                </div>
            </div>
            @empty
            <div class="col-span-full">
                <div class="empty-state bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-16 text-center border border-white/20">
                    <div class="w-32 h-32 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6 floating">
                        <i class="fa-solid fa-users-slash text-5xl text-emerald-400"></i>
                    </div>
                    <h3 class="text-2xl font-serif italic text-emerald-800 mb-3">Belum Ada Data Pengurus</h3>
                    <p class="text-gray-500 max-w-md mx-auto">Silakan tambahkan data perangkat desa terlebih dahulu.</p>
                    <a href="{{ route('admin.pengurus.create') }}" class="inline-flex items-center gap-2 mt-6 px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:shadow-xl transition-all duration-300 hover:scale-105 group">
                        <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                        Tambah Pengurus Sekarang
                    </a>
                </div>
            </div>
            @endforelse
        </div>
        
        {{-- Pagination Premium --}}
        @if($pengurus->hasPages())
        <div class="mt-10">
            {{ $pengurus->links() }}
        </div>
        @endif
        
        {{-- Quick Info Card --}}
        <div class="mt-10 bg-gradient-to-r from-emerald-50 to-emerald-100/30 rounded-2xl p-5 border border-emerald-100">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-emerald-500 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fa-regular fa-lightbulb text-white text-xl"></i>
                    </div>
                    <div>
                        <h4 class="font-semibold text-emerald-800">💡 Tips Mengelola Pengurus</h4>
                        <p class="text-sm text-gray-600">Urutan tampilan dapat diatur dengan mengisi nilai "Urutan" (semakin kecil angka, semakin atas tampilannya)</p>
                    </div>
                </div>
                <a href="{{ route('admin.profil-desa.index') }}" class="px-5 py-2 bg-white rounded-xl text-emerald-600 font-semibold hover:bg-emerald-50 transition flex items-center gap-2 group">
                    <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Profil Desa
                </a>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.05); }
    }
    @keyframes bounce {
        0%, 100% { transform: translateX(0); }
        50% { transform: translateX(5px); }
    }
    .animate-pulse-slow {
        animation: pulse-slow 4s ease-in-out infinite;
    }
    .animate-bounce {
        animation: bounce 0.5s ease-in-out;
    }
    .floating {
        animation: float 3s ease-in-out infinite;
    }
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection