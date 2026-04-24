{{-- resources/views/masyarakat/aspirasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Aspirasi Saya - Lumban Silintong')

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
    @keyframes shimmer {
        0% { background-position: -1000px 0; }
        100% { background-position: 1000px 0; }
    }

    /* ============================================ */
    /* UTILITY CLASSES */
    /* ============================================ */
    .floating { animation: float 3s ease-in-out infinite; }
    .animate-pulse-slow { animation: pulse-slow 4s ease-in-out infinite; }
    
    /* ============================================ */
    /* ASPIRASI CARD STYLES */
    /* ============================================ */
    .aspirasi-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        animation: slide-up 0.6s ease forwards;
        opacity: 0;
        position: relative;
        overflow: hidden;
    }
    .aspirasi-card:nth-child(1) { animation-delay: 0.05s; }
    .aspirasi-card:nth-child(2) { animation-delay: 0.1s; }
    .aspirasi-card:nth-child(3) { animation-delay: 0.15s; }
    .aspirasi-card:nth-child(4) { animation-delay: 0.2s; }
    .aspirasi-card:nth-child(5) { animation-delay: 0.25s; }
    .aspirasi-card:nth-child(6) { animation-delay: 0.3s; }
    
    .aspirasi-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.15), transparent);
        transition: left 0.6s ease;
        z-index: 1;
        pointer-events: none;
    }
    
    .aspirasi-card:hover::before {
        left: 100%;
    }
    
    .aspirasi-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 40px -15px rgba(16, 185, 129, 0.25);
        border-color: rgba(16, 185, 129, 0.3);
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 5px 12px;
        border-radius: 30px;
        font-size: 10px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .status-badge:hover {
        transform: scale(1.05);
    }
    .status-baru { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; }
    .status-diproses { background: #dbeafe; color: #2563eb; border: 1px solid #bfdbfe; }
    .status-selesai { background: #d1fae5; color: #059669; border: 1px solid #a7f3d0; }
    
    /* Kategori Badge */
    .kategori-badge {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 10px;
        border-radius: 30px;
        font-size: 9px;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    .kategori-badge:hover {
        transform: scale(1.05);
    }
    .kategori-saran { background: #d1fae5; color: #059669; }
    .kategori-keluhan { background: #fee2e2; color: #dc2626; }
    .kategori-masukan { background: #dbeafe; color: #2563eb; }
    .kategori-pertanyaan { background: #f3e8ff; color: #9333ea; }
    
    /* Filter Button */
    .filter-btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
        cursor: pointer;
    }
    .filter-btn.active {
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .filter-btn::before {
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
    .filter-btn:hover::before {
        width: 200px;
        height: 200px;
    }
    
    /* Action Buttons */
    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        transition: all 0.3s ease;
        background: white;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }
    .action-btn:hover {
        transform: translateY(-3px) scale(1.1);
    }
    .action-btn.view:hover { background: #3b82f6; color: white; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); }
    .action-btn.edit:hover { background: #10b981; color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
    .action-btn.delete:hover { background: #ef4444; color: white; box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3); }
    
    /* Response Admin Card - ELEGAN */
    .response-card {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-left: 4px solid #10b981;
        border-radius: 12px;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    .response-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    .response-card:hover::before {
        left: 100%;
    }
    .response-card:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.15);
    }
    
    /* Proses Card */
    .proses-card {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border-left: 4px solid #3b82f6;
        border-radius: 12px;
        transition: all 0.3s ease;
    }
    .proses-card:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.15);
    }
    
    /* Pagination */
    .pagination {
        display: flex;
        gap: 8px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .pagination .page-item {
        list-style: none;
    }
    .pagination .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 12px;
        border-radius: 12px;
        background: white;
        border: 1px solid #e2e8f0;
        color: #4b5563;
        font-weight: 500;
        transition: all 0.3s ease;
    }
    .pagination .page-link:hover {
        background: #f0fdf4;
        border-color: #10b981;
        color: #059669;
        transform: translateY(-2px);
    }
    .pagination .active .page-link {
        background: linear-gradient(135deg, #10b981, #059669);
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .pagination .disabled .page-link {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    /* Empty State */
    .empty-state {
        animation: zoom-in 0.6s ease forwards;
    }
    
    /* Line Clamp */
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    /* Scrollbar */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: linear-gradient(135deg, #10b981, #059669); border-radius: 10px; }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- HEADER PREMIUM --}}
        <div class="relative mb-10">
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl animate-pulse-slow"></div>
            </div>
            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-6">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg floating">
                            <i class="fa-solid fa-comment-dots text-white text-2xl"></i>
                        </div>
                        <div>
                            <h1 class="text-4xl md:text-5xl font-serif italic text-emerald-900">💬 Aspirasi Saya</h1>
                            <p class="text-gray-500 mt-1 ml-1">Lihat dan pantau semua aspirasi yang telah Anda kirimkan</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 ml-16">
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <i class="fa-regular fa-clock"></i>
                            <span>Respon maksimal 3 hari kerja</span>
                        </div>
                        <div class="w-1 h-1 bg-gray-300 rounded-full"></div>
                        <div class="flex items-center gap-2 text-xs text-gray-400">
                            <i class="fa-regular fa-lock"></i>
                            <span>Identitas Anda aman</span>
                        </div>
                    </div>
                </div>
                
                {{-- Tombol Kirim Aspirasi Baru --}}
                <a href="{{ route('masyarakat.aspirasi.create') }}" class="group relative px-8 py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-2xl font-bold hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-3 overflow-hidden">
                    <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/20 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-700"></div>
                    <i class="fa-solid fa-pen-to-square text-lg group-hover:rotate-12 transition-transform duration-300"></i>
                    <span class="relative z-10">Kirim Aspirasi Baru</span>
                </a>
            </div>
            <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-full mt-5 ml-16"></div>
        </div>

        {{-- STATISTIK CARD --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-10">
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 text-center hover:scale-105 transition-all duration-300 group border border-white/20 shadow-lg">
                <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 transition">
                    <i class="fa-solid fa-list-check text-white text-xl"></i>
                </div>
                <p class="text-3xl font-bold text-emerald-700" id="total-count">{{ $aspirasi->total() }}</p>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Total Aspirasi</p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 text-center hover:scale-105 transition-all duration-300 group border border-white/20 shadow-lg">
                <div class="w-14 h-14 bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 transition">
                    <i class="fa-regular fa-clock text-white text-xl"></i>
                </div>
                <p class="text-3xl font-bold text-yellow-600" id="menunggu-count">{{ $aspirasi->where('status', 'baru')->count() }}</p>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Menunggu</p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 text-center hover:scale-105 transition-all duration-300 group border border-white/20 shadow-lg">
                <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 transition">
                    <i class="fa-solid fa-spinner fa-spin text-white text-xl"></i>
                </div>
                <p class="text-3xl font-bold text-blue-600" id="diproses-count">{{ $aspirasi->where('status', 'diproses')->count() }}</p>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Diproses</p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-5 text-center hover:scale-105 transition-all duration-300 group border border-white/20 shadow-lg">
                <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg group-hover:scale-110 transition">
                    <i class="fa-regular fa-circle-check text-white text-xl"></i>
                </div>
                <p class="text-3xl font-bold text-green-600" id="selesai-count">{{ $aspirasi->where('status', 'selesai')->count() }}</p>
                <p class="text-xs text-gray-500 font-semibold uppercase tracking-wider mt-1">Selesai</p>
            </div>
        </div>

        {{-- FILTER KATEGORI --}}
        <div class="mb-8">
            <div class="flex flex-wrap gap-3 justify-center">
                <button data-filter="all" class="filter-btn active px-5 py-2.5 rounded-xl text-sm font-semibold bg-white border-2 border-emerald-500 text-emerald-600 transition-all duration-300">
                    <i class="fa-solid fa-list mr-2"></i> Semua
                </button>
                <button data-filter="saran" class="filter-btn px-5 py-2.5 rounded-xl text-sm font-semibold bg-white border-2 border-gray-200 text-gray-600 hover:border-emerald-300 transition-all duration-300">
                    <i class="fa-regular fa-lightbulb mr-2"></i> 💡 Saran
                </button>
                <button data-filter="keluhan" class="filter-btn px-5 py-2.5 rounded-xl text-sm font-semibold bg-white border-2 border-gray-200 text-gray-600 hover:border-emerald-300 transition-all duration-300">
                    <i class="fa-regular fa-face-frown mr-2"></i> 😞 Keluhan
                </button>
                <button data-filter="masukan" class="filter-btn px-5 py-2.5 rounded-xl text-sm font-semibold bg-white border-2 border-gray-200 text-gray-600 hover:border-emerald-300 transition-all duration-300">
                    <i class="fa-regular fa-message mr-2"></i> 📝 Masukan
                </button>
                <button data-filter="pertanyaan" class="filter-btn px-5 py-2.5 rounded-xl text-sm font-semibold bg-white border-2 border-gray-200 text-gray-600 hover:border-emerald-300 transition-all duration-300">
                    <i class="fa-regular fa-circle-question mr-2"></i> ❓ Pertanyaan
                </button>
            </div>
        </div>

        {{-- ALERT MESSAGES --}}
        @if(session('success'))
        <div class="mb-6 p-5 bg-gradient-to-r from-emerald-50 to-emerald-100/30 rounded-2xl border-l-4 border-emerald-500 shadow-md">
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

        {{-- ASPIRASI CARDS GRID --}}
        <div id="aspirasi-container" class="grid md:grid-cols-2 gap-6">
            @forelse($aspirasi as $aspirasiItem)
            <div class="aspirasi-card bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden" data-kategori="{{ $aspirasiItem->kategori }}" data-status="{{ $aspirasiItem->status }}">
                {{-- Header Card --}}
                <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-4 border-b border-gray-100">
                    <div class="flex items-start justify-between">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center shadow-md">
                                <i class="fa-solid fa-user text-white text-sm"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                                <p class="text-[10px] text-gray-400 flex items-center gap-1">
                                    <i class="fa-regular fa-calendar"></i> 
                                    {{ $aspirasiItem->created_at->translatedFormat('d F Y, H:i') }}
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <span class="kategori-badge
                                @if($aspirasiItem->kategori == 'saran') kategori-saran
                                @elseif($aspirasiItem->kategori == 'keluhan') kategori-keluhan
                                @elseif($aspirasiItem->kategori == 'masukan') kategori-masukan
                                @else kategori-pertanyaan @endif">
                                @if($aspirasiItem->kategori == 'saran') 💡 Saran
                                @elseif($aspirasiItem->kategori == 'keluhan') 😞 Keluhan
                                @elseif($aspirasiItem->kategori == 'masukan') 📝 Masukan
                                @else ❓ Pertanyaan @endif
                            </span>
                        </div>
                    </div>
                </div>
                
                {{-- Body Card --}}
                <div class="px-6 py-4">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $aspirasiItem->judul }}</h3>
                    <p class="text-gray-600 leading-relaxed line-clamp-3">
                        {{ $aspirasiItem->isi_aspirasi }}
                    </p>
                </div>
                
                {{-- Status Card --}}
                <div class="px-6 pb-2">
                    <span class="status-badge
                        @if($aspirasiItem->status == 'baru') status-baru
                        @elseif($aspirasiItem->status == 'diproses') status-diproses
                        @else status-selesai @endif">
                        @if($aspirasiItem->status == 'baru') <i class="fa-regular fa-clock"></i> Menunggu Tanggapan
                        @elseif($aspirasiItem->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Sedang Diproses
                        @else <i class="fa-regular fa-circle-check"></i> Selesai Ditanggapi @endif
                    </span>
                </div>
                
                {{-- ============================================= --}}
                {{-- RESPONSE ADMIN - DENGAN DESAIN ELEGAN --}}
                {{-- ============================================= --}}
                @if($aspirasiItem->respon_admin && $aspirasiItem->respon_admin != '')
                <div class="mx-6 mb-4 p-4 response-card">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center flex-shrink-0 shadow-md">
                            <i class="fa-solid fa-headset text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold text-emerald-700">
                                    <i class="fa-regular fa-message mr-1"></i> Tanggapan Admin Desa
                                </span>
                                <span class="text-[9px] text-gray-400">
                                    <i class="fa-regular fa-calendar mr-1"></i>{{ $aspirasiItem->updated_at->translatedFormat('d F Y') }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-700 leading-relaxed mt-1">
                                <i class="fa-solid fa-quote-left text-emerald-400 text-xs mr-1"></i>
                                {{ $aspirasiItem->respon_admin }}
                            </p>
                            <div class="mt-2 flex items-center gap-2">
                                <span class="text-[9px] text-emerald-600 bg-emerald-100 px-2 py-0.5 rounded-full">
                                    <i class="fa-regular fa-circle-check mr-1"></i> Terverifikasi
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif($aspirasiItem->status == 'diproses')
                <div class="mx-6 mb-4 p-4 proses-card">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center flex-shrink-0 shadow-md">
                            <i class="fa-solid fa-spinner fa-spin text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold text-blue-700">
                                    <i class="fa-regular fa-clock mr-1"></i> Status Proses
                                </span>
                            </div>
                            <p class="text-sm text-blue-700 leading-relaxed">
                                ⏳ Aspirasi Anda sedang diproses oleh admin desa. Mohon tunggu tanggapan dalam 1-3 hari kerja.
                            </p>
                        </div>
                    </div>
                </div>
                @elseif($aspirasiItem->status == 'baru')
                <div class="mx-6 mb-4 p-4 bg-gradient-to-r from-amber-50 to-amber-100/30 rounded-xl border-l-4 border-amber-400">
                    <div class="flex items-start gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-500 to-amber-600 flex items-center justify-center flex-shrink-0 shadow-md">
                            <i class="fa-regular fa-bell text-white text-sm"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-xs font-bold text-amber-700">
                                    <i class="fa-regular fa-hourglass-half mr-1"></i> Menunggu Tanggapan
                                </span>
                            </div>
                            <p class="text-sm text-amber-700 leading-relaxed">
                                Aspirasi Anda telah terkirim dan akan segera ditanggapi oleh admin desa.
                            </p>
                        </div>
                    </div>
                </div>
                @endif
                
                {{-- Footer Card --}}
                <div class="px-6 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <div class="flex items-center gap-1 text-[10px] text-gray-400">
                        <i class="fa-regular fa-heart"></i>
                        <span>Terima kasih atas aspirasinya</span>
                    </div>
                    <div class="flex items-center gap-2">
                        @if($aspirasiItem->status == 'baru')
                        <a href="{{ route('masyarakat.aspirasi.edit', $aspirasiItem->id_aspirasi) }}" class="action-btn edit text-emerald-600" title="Edit">
                            <i class="fa-solid fa-pen text-sm"></i>
                        </a>
                        <form action="{{ route('masyarakat.aspirasi.destroy', $aspirasiItem->id_aspirasi) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin membatalkan aspirasi ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="action-btn delete text-red-600" title="Hapus">
                                <i class="fa-solid fa-trash text-sm"></i>
                            </button>
                        </form>
                        @endif
                        <a href="{{ route('masyarakat.aspirasi.show', $aspirasiItem->id_aspirasi) }}" class="action-btn view text-blue-600" title="Detail">
                            <i class="fa-solid fa-eye text-sm"></i>
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-2 empty-state bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl p-16 text-center border border-white/20">
                <div class="w-32 h-32 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fa-regular fa-comment-dots text-5xl text-emerald-400"></i>
                </div>
                <h3 class="text-2xl font-serif italic text-emerald-800 mb-3">Belum Ada Aspirasi</h3>
                <p class="text-gray-500 max-w-md mx-auto">Sampaikan aspirasi, saran, atau keluhan Anda untuk membantu kemajuan desa Lumban Silintong.</p>
                <a href="{{ route('masyarakat.aspirasi.create') }}" class="inline-flex items-center gap-2 mt-6 px-8 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:shadow-xl transition-all duration-300 hover:scale-105 group">
                    <i class="fa-solid fa-pen-to-square group-hover:rotate-12 transition-transform duration-300"></i>
                    Kirim Aspirasi Sekarang
                </a>
            </div>
            @endforelse
        </div>
        
        {{-- PAGINATION --}}
        @if($aspirasi->lastPage() > 1)
        <div class="mt-8">
            {{ $aspirasi->links() }}
        </div>
        @endif

        {{-- TIPS & PANDUAN --}}
        <div class="mt-12 grid md:grid-cols-3 gap-5">
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-5 text-center group hover:scale-105 transition-all duration-300 border border-white/20">
                <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fa-regular fa-pen-to-square text-white text-lg"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-1">Tulis Aspirasi</h4>
                <p class="text-xs text-gray-500">Sampaikan dengan jelas dan detail agar mudah dipahami</p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-5 text-center group hover:scale-105 transition-all duration-300 border border-white/20">
                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fa-regular fa-clock text-white text-lg"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-1">Pantau Status</h4>
                <p class="text-xs text-gray-500">Cek secara berkala perkembangan aspirasi Anda</p>
            </div>
            <div class="bg-white/80 backdrop-blur-sm rounded-xl p-5 text-center group hover:scale-105 transition-all duration-300 border border-white/20">
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                    <i class="fa-regular fa-circle-check text-white text-lg"></i>
                </div>
                <h4 class="font-bold text-gray-800 mb-1">Respon Cepat</h4>
                <p class="text-xs text-gray-500">Aspirasi akan ditanggapi maksimal 3 hari kerja</p>
            </div>
        </div>
    </div>
</div>

<script>
    // Filter Aspirasi by Kategori
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const filterValue = this.dataset.filter;
            
            // Update active class pada button
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active');
                b.classList.remove('bg-gradient-to-r', 'from-emerald-500', 'to-emerald-600', 'text-white', 'border-transparent');
                b.classList.add('bg-white', 'border-gray-200', 'text-gray-600');
            });
            this.classList.add('active');
            this.classList.remove('bg-white', 'border-gray-200', 'text-gray-600');
            this.classList.add('bg-gradient-to-r', 'from-emerald-500', 'to-emerald-600', 'text-white', 'border-transparent');
            
            // Filter cards
            const cards = document.querySelectorAll('#aspirasi-container .aspirasi-card');
            let visibleCount = 0;
            let menungguCount = 0;
            let diprosesCount = 0;
            let selesaiCount = 0;
            
            cards.forEach(card => {
                if (filterValue === 'all' || card.dataset.kategori === filterValue) {
                    card.style.display = 'block';
                    visibleCount++;
                    
                    const statusCard = card.dataset.status;
                    if (statusCard === 'baru') menungguCount++;
                    else if (statusCard === 'diproses') diprosesCount++;
                    else if (statusCard === 'selesai') selesaiCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update statistik counts
            document.getElementById('total-count').innerText = visibleCount;
            document.getElementById('menunggu-count').innerText = menungguCount;
            document.getElementById('diproses-count').innerText = diprosesCount;
            document.getElementById('selesai-count').innerText = selesaiCount;
        });
    });
</script>
@endsection