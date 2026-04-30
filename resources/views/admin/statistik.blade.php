{{-- resources/views/admin/statistik.blade.php --}}
@extends('layouts.admin')

@section('title', 'Statistik Desa - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
        --dark: #0f172a;
        --dark-soft: #1e293b;
        --gray: #64748b;
        --gray-light: #94a3b8;
        --gray-soft: #f1f5f9;
        --bg: #fafbfc;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.03);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.05);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.08);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.1);
        --transition: all 0.25s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.35s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--dark);
        -webkit-font-smoothing: antialiased;
    }

    ::-webkit-scrollbar { width: 6px; height: 6px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--gray-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
        background-size: 20px 20px;
        opacity: 0.4;
    }

    /* Animations */
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.05); }
    }
    
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes countUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-pulse-slow { animation: pulse-slow 6s ease-in-out infinite; }
    .animate-spin-slow { animation: spin-slow 2s linear infinite; }
    .animate-up { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.2s; }

    /* Container */
    .container-premium {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Header Section */
    .header-section {
        position: relative;
        margin-bottom: 2.5rem;
    }
    
    .header-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 0.75rem;
    }
    
    .header-badge i { font-size: 0.65rem; color: var(--primary); }
    .header-badge span { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em; color: var(--primary-dark); text-transform: uppercase; }

    .header-title {
        font-size: clamp(1.8rem, 4vw, 3rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
    }
    
    .header-title span { color: var(--primary); font-family: 'Instrument Serif', serif; font-style: italic; }

    .header-subtitle {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
    }

    /* Glass Card */
    .stat-card-premium {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 28px;
        overflow: hidden;
        transition: var(--transition-bounce);
    }
    
    .stat-card-premium:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    /* Cards */
    .card-gradient {
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
    }
    
    .card-gradient::after {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s;
    }
    
    .card-gradient:hover::after {
        left: 100%;
    }
    
    .card-gradient:hover {
        transform: translateY(-5px);
        filter: brightness(1.02);
    }
    
    .counter {
        animation: countUp 0.6s ease-out;
    }

    /* Progress Bar */
    .progress-container {
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 4px;
        border-radius: 10px;
        transition: width 0.8s ease-out;
    }

    /* Footer */
    .footer-premium {
        margin-top: 2rem;
        padding: 1rem 1.5rem;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        transition: var(--transition);
    }
    
    .footer-premium:hover {
        box-shadow: var(--shadow-sm);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .header-section { margin-bottom: 1.5rem; }
        .card-gradient p.text-3xl { font-size: 1.5rem; }
        .footer-premium { flex-direction: column; text-align: center; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- Header Section --}}
    <div class="header-section animate-up">
        <div class="header-badge">
            <i class="fa-solid fa-chart-line"></i>
            <span>Data Analytics</span>
        </div>
        <h1 class="header-title">
            Statistik<br>
            <span>Desa Lumban Silintong</span>
        </h1>
    </div>

    {{-- Statistik Penduduk --}}
    <div class="stat-card-premium animate-up delay-1">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                    <i class="fa-solid fa-users text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Statistik Penduduk</h2>
                    <p class="text-[11px] text-gray-400">Data demografi terkini</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                {{-- Total Penduduk --}}
                <div class="card-gradient bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-users text-2xl text-white/80"></i>
                        <i class="fa-solid fa-chart-line text-white/30 text-sm"></i>
                    </div>
                    <p class="text-emerald-100 text-xs font-medium">Total Penduduk</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['total_penduduk'] ?? 0) }}</p>
                    <div class="mt-3 progress-container">
                        <div class="progress-bar bg-white/50 w-full"></div>
                    </div>
                </div>

                {{-- Laki-laki --}}
                <div class="card-gradient bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-mars text-2xl text-white/80"></i>
                    </div>
                    <p class="text-blue-100 text-xs font-medium">Laki-laki</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['penduduk_pria'] ?? 0) }}</p>
                    <div class="mt-3 progress-container">
                        <div class="progress-bar bg-white/50" style="width: {{ ($statistik['penduduk_pria'] / max($statistik['total_penduduk'], 1)) * 100 }}%"></div>
                    </div>
                    <p class="text-[9px] text-blue-100 mt-2">{{ round(($statistik['penduduk_pria'] / max($statistik['total_penduduk'], 1)) * 100, 1) }}% dari total</p>
                </div>

                {{-- Perempuan --}}
                <div class="card-gradient bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-venus text-2xl text-white/80"></i>
                    </div>
                    <p class="text-pink-100 text-xs font-medium">Perempuan</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['penduduk_wanita'] ?? 0) }}</p>
                    <div class="mt-3 progress-container">
                        <div class="progress-bar bg-white/50" style="width: {{ ($statistik['penduduk_wanita'] / max($statistik['total_penduduk'], 1)) * 100 }}%"></div>
                    </div>
                    <p class="text-[9px] text-pink-100 mt-2">{{ round(($statistik['penduduk_wanita'] / max($statistik['total_penduduk'], 1)) * 100, 1) }}% dari total</p>
                </div>

                {{-- Kepala Keluarga --}}
                <div class="card-gradient bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-house-user text-2xl text-white/80"></i>
                    </div>
                    <p class="text-amber-100 text-xs font-medium">Kepala Keluarga</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['total_kk'] ?? 0) }}</p>
                    <div class="mt-3 progress-container">
                        <div class="progress-bar bg-white/50" style="width: {{ ($statistik['total_kk'] / max($statistik['total_penduduk'], 1)) * 100 }}%"></div>
                    </div>
                    <p class="text-[9px] text-amber-100 mt-2">Rasio {{ round(($statistik['total_kk'] / max($statistik['total_penduduk'], 1)) * 100, 1) }}%</p>
                </div>
            </div>

            {{-- Kelompok Umur --}}
            <div>
                <div class="flex items-center gap-2 mb-4">
                    <i class="fa-solid fa-chart-line text-emerald-500 text-sm"></i>
                    <h3 class="font-semibold text-slate-700 text-sm">📈 Kelompok Umur Penduduk</h3>
                </div>
                <div class="space-y-4">
                    @php $totalPenduduk = max($statistik['total_penduduk'] ?? 1, 1); @endphp
                    
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="flex items-center gap-2 text-xs text-slate-600">
                                <i class="fa-solid fa-child text-emerald-500"></i> 0 - 14 tahun
                            </span>
                            <span class="font-semibold text-slate-700 text-sm">{{ number_format($statistik['kelompok_umur_0_14'] ?? 0) }} jiwa</span>
                        </div>
                        <div class="w-full bg-emerald-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-emerald-500 to-emerald-400 h-2 rounded-full transition-all duration-700" style="width: {{ ($statistik['kelompok_umur_0_14'] / $totalPenduduk) * 100 }}%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">{{ round(($statistik['kelompok_umur_0_14'] / $totalPenduduk) * 100, 1) }}% dari total penduduk</p>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="flex items-center gap-2 text-xs text-slate-600">
                                <i class="fa-solid fa-person-walking text-blue-500"></i> 15 - 29 tahun
                            </span>
                            <span class="font-semibold text-slate-700 text-sm">{{ number_format($statistik['kelompok_umur_15_29'] ?? 0) }} jiwa</span>
                        </div>
                        <div class="w-full bg-blue-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-blue-500 to-blue-400 h-2 rounded-full transition-all duration-700" style="width: {{ ($statistik['kelompok_umur_15_29'] / $totalPenduduk) * 100 }}%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">{{ round(($statistik['kelompok_umur_15_29'] / $totalPenduduk) * 100, 1) }}% dari total penduduk</p>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="flex items-center gap-2 text-xs text-slate-600">
                                <i class="fa-solid fa-briefcase text-amber-500"></i> 30 - 59 tahun
                            </span>
                            <span class="font-semibold text-slate-700 text-sm">{{ number_format($statistik['kelompok_umur_30_59'] ?? 0) }} jiwa</span>
                        </div>
                        <div class="w-full bg-amber-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-amber-500 to-amber-400 h-2 rounded-full transition-all duration-700" style="width: {{ ($statistik['kelompok_umur_30_59'] / $totalPenduduk) * 100 }}%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">{{ round(($statistik['kelompok_umur_30_59'] / $totalPenduduk) * 100, 1) }}% dari total penduduk</p>
                    </div>
                    
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="flex items-center gap-2 text-xs text-slate-600">
                                <i class="fa-solid fa-cane text-purple-500"></i> 60+ tahun
                            </span>
                            <span class="font-semibold text-slate-700 text-sm">{{ number_format($statistik['kelompok_umur_60'] ?? 0) }} jiwa</span>
                        </div>
                        <div class="w-full bg-purple-100 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-purple-500 to-purple-400 h-2 rounded-full transition-all duration-700" style="width: {{ ($statistik['kelompok_umur_60'] / $totalPenduduk) * 100 }}%"></div>
                        </div>
                        <p class="text-[10px] text-slate-400 mt-1">{{ round(($statistik['kelompok_umur_60'] / $totalPenduduk) * 100, 1) }}% dari total penduduk</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik UMKM --}}
    <div class="stat-card-premium animate-up delay-2 mt-6">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-md">
                    <i class="fa-solid fa-store text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Statistik UMKM</h2>
                    <p class="text-[11px] text-gray-400">Usaha Mikro Kecil dan Menengah</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="card-gradient bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-shop text-2xl text-white/80"></i>
                    </div>
                    <p class="text-amber-100 text-xs">Total UMKM</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['total_umkm'] ?? 0) }}</p>
                    <div class="mt-2 flex items-center gap-1 text-[9px] text-amber-100">
                        <i class="fa-solid fa-building"></i> Usaha terdaftar
                    </div>
                </div>
                
                <div class="card-gradient bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-circle-check text-2xl text-white/80"></i>
                    </div>
                    <p class="text-green-100 text-xs">UMKM Aktif</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['umkm_approved'] ?? 0) }}</p>
                    <div class="mt-2 progress-container">
                        <div class="progress-bar bg-white/50" style="width: {{ ($statistik['umkm_approved'] / max($statistik['total_umkm'], 1)) * 100 }}%"></div>
                    </div>
                </div>
                
                <div class="card-gradient bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-clock text-2xl text-white/80"></i>
                    </div>
                    <p class="text-yellow-100 text-xs">Menunggu Verifikasi</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format(($statistik['total_umkm'] ?? 0) - ($statistik['umkm_approved'] ?? 0)) }}</p>
                    <div class="mt-2 progress-container">
                        <div class="progress-bar bg-white/50" style="width: {{ ((($statistik['total_umkm'] ?? 0) - ($statistik['umkm_approved'] ?? 0)) / max($statistik['total_umkm'], 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik Layanan --}}
    <div class="stat-card-premium animate-up delay-3 mt-6">
        <div class="p-6">
            <div class="flex items-center gap-3 mb-6">
                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                    <i class="fa-solid fa-envelope-open-text text-white text-lg"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Statistik Layanan</h2>
                    <p class="text-[11px] text-gray-400">Aktivitas pelayanan publik</p>
                </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                <div class="card-gradient bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-newspaper text-2xl text-white/80"></i>
                    </div>
                    <p class="text-blue-100 text-xs">Total Berita</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['total_berita'] ?? 0) }}</p>
                    <div class="mt-2 flex items-center gap-1 text-[9px] text-blue-100">
                        <i class="fa-regular fa-newspaper"></i> Informasi publik
                    </div>
                </div>
                
                <div class="card-gradient bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-comment-dots text-2xl text-white/80"></i>
                    </div>
                    <p class="text-purple-100 text-xs">Total Aspirasi</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['total_aspirasi'] ?? 0) }}</p>
                    <div class="mt-2 flex items-center gap-1 text-[9px] text-purple-100">
                        <i class="fa-regular fa-message"></i> Suara warga
                    </div>
                </div>
                
                <div class="card-gradient bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white">
                    <div class="flex items-center justify-between mb-3">
                        <i class="fa-solid fa-file-signature text-2xl text-white/80"></i>
                    </div>
                    <p class="text-emerald-100 text-xs">Pengajuan Surat</p>
                    <p class="text-2xl font-bold mt-1 counter">{{ number_format($statistik['total_surat'] ?? 0) }}</p>
                    <div class="mt-2 flex items-center gap-1 text-[9px] text-emerald-100">
                        <i class="fa-regular fa-file"></i> Administrasi
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    <div class="footer-premium animate-up delay-4">
        <div class="flex items-center gap-4 flex-wrap justify-center md:justify-start">
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <i class="fa-solid fa-database text-emerald-500"></i>
                <span> Desa Lumban Silintong</span>
            </div>
            <div class="w-1 h-1 bg-slate-300 rounded-full hidden md:block"></div>
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <i class="fa-regular fa-clock text-emerald-500"></i>
                <span>Update: {{ now()->format('d F Y H:i:s') }}</span>
            </div>
            <div class="w-1 h-1 bg-slate-300 rounded-full hidden md:block"></div>
            <div class="flex items-center gap-2 text-xs text-slate-400">
                <i class="fa-solid fa-shield-alt text-emerald-500"></i>
                <span>Data terverifikasi</span>
            </div>
        </div>
        <div class="flex items-center gap-2 text-xs text-slate-400">
            <i class="fa-solid fa-chart-line text-emerald-500 animate-pulse"></i>
            <span>Statistik realtime</span>
        </div>
    </div>
</div>
@endsection