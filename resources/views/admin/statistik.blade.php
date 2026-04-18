{{-- resources/views/admin/statistik.blade.php --}}
@extends('layouts.admin')

@section('title', 'Statistik Desa - Admin Panel')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section --}}
        <div class="relative mb-10">
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl animate-pulse-slow"></div>
            </div>
            <div class="relative flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                            <i class="fa-solid fa-chart-line text-white text-lg"></i>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-800 tracking-tight">
                            Statistik <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-600">Desa</span>
                        </h1>
                    </div>
                    <p class="text-slate-500 ml-12">Dashboard statistik lengkap Desa Lumban Silintong</p>
                </div>
                <div class="flex gap-3">
                    <div class="flex items-center gap-2 px-3 py-2 bg-white rounded-xl shadow-sm border border-slate-100">
                        <i class="fa-solid fa-sync-alt text-emerald-500 text-xs animate-spin-slow"></i>
                        <span class="text-xs text-slate-500">Auto Update</span>
                    </div>
                    <button onclick="window.location.reload()" class="group px-4 py-2 bg-gradient-to-r from-emerald-600 to-emerald-500 text-white rounded-xl hover:shadow-lg transition-all duration-300 hover:scale-105 flex items-center gap-2">
                        <i class="fa-solid fa-rotate-right group-hover:rotate-180 transition-transform duration-500"></i>
                        <span class="text-sm font-semibold">Refresh Data</span>
                    </button>
                </div>
            </div>
            <div class="w-20 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-full mt-4 ml-12"></div>
        </div>

        {{-- Statistik Penduduk Premium --}}
        <div class="stat-section bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden mb-8 transition-all duration-500 hover:shadow-2xl hover:shadow-emerald-500/10">
            <div class="section-header bg-gradient-to-r from-emerald-50/50 to-white px-6 py-4 border-b border-slate-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                            <i class="fa-solid fa-users text-white text-lg"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-slate-800">Statistik Penduduk</h2>
                            <p class="text-xs text-slate-400">Data demografi terkini</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="flex items-center gap-1 text-[10px] text-emerald-600 bg-emerald-50 px-2 py-1 rounded-full">
                            <i class="fa-solid fa-database text-[8px]"></i> Real-time
                        </span>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
                    {{-- Card Total Penduduk --}}
                    <div class="stat-card group bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white relative overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-users text-3xl text-white/80 group-hover:scale-110 transition-transform duration-300"></i>
                                <i class="fa-solid fa-arrow-trend-up text-white/40 text-sm group-hover:rotate-12 transition-transform duration-300"></i>
                            </div>
                            <p class="text-emerald-100 text-sm font-medium">Total Penduduk</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['total_penduduk'] ?? 0) }}</p>
                            <div class="mt-3 h-1 bg-white/20 rounded-full overflow-hidden">
                                <div class="h-full bg-white/50 rounded-full w-full"></div>
                            </div>
                        </div>
                    </div>

                    {{-- Card Laki-laki --}}
                    <div class="stat-card group bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white relative overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-mars text-3xl text-white/80 group-hover:scale-110 transition-transform duration-300"></i>
                                <i class="fa-solid fa-chart-line text-white/40 text-sm"></i>
                            </div>
                            <p class="text-blue-100 text-sm font-medium">Laki-laki</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['penduduk_pria'] ?? 0) }}</p>
                            <div class="mt-3 h-1 bg-white/20 rounded-full overflow-hidden">
                                <div class="h-full bg-white/50 rounded-full transition-all duration-700" style="width: {{ ($statistik['penduduk_pria'] / max($statistik['total_penduduk'], 1)) * 100 }}%"></div>
                            </div>
                            <p class="text-[10px] text-blue-100 mt-2">{{ ($statistik['penduduk_pria'] / max($statistik['total_penduduk'], 1)) * 100 }}% dari total</p>
                        </div>
                    </div>

                    {{-- Card Perempuan --}}
                    <div class="stat-card group bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-5 text-white relative overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-venus text-3xl text-white/80 group-hover:scale-110 transition-transform duration-300"></i>
                                <i class="fa-solid fa-chart-line text-white/40 text-sm"></i>
                            </div>
                            <p class="text-pink-100 text-sm font-medium">Perempuan</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['penduduk_wanita'] ?? 0) }}</p>
                            <div class="mt-3 h-1 bg-white/20 rounded-full overflow-hidden">
                                <div class="h-full bg-white/50 rounded-full transition-all duration-700" style="width: {{ ($statistik['penduduk_wanita'] / max($statistik['total_penduduk'], 1)) * 100 }}%"></div>
                            </div>
                            <p class="text-[10px] text-pink-100 mt-2">{{ ($statistik['penduduk_wanita'] / max($statistik['total_penduduk'], 1)) * 100 }}% dari total</p>
                        </div>
                    </div>

                    {{-- Card Kepala Keluarga --}}
                    <div class="stat-card group bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-5 text-white relative overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-house-user text-3xl text-white/80 group-hover:scale-110 transition-transform duration-300"></i>
                                <i class="fa-solid fa-chart-pie text-white/40 text-sm"></i>
                            </div>
                            <p class="text-amber-100 text-sm font-medium">Kepala Keluarga</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['total_kk'] ?? 0) }}</p>
                            <div class="mt-3 h-1 bg-white/20 rounded-full overflow-hidden">
                                <div class="h-full bg-white/50 rounded-full transition-all duration-700" style="width: {{ ($statistik['total_kk'] / max($statistik['total_penduduk'], 1)) * 100 }}%"></div>
                            </div>
                            <p class="text-[10px] text-amber-100 mt-2">Rasio {{ ($statistik['total_kk'] / max($statistik['total_penduduk'], 1)) * 100 }}%</p>
                        </div>
                    </div>
                </div>

                {{-- Kelompok Umur --}}
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <i class="fa-solid fa-chart-line text-emerald-500"></i>
                        <h3 class="font-semibold text-slate-700">📈 Kelompok Umur Penduduk</h3>
                    </div>
                    <div class="space-y-4">
                        @php $totalPenduduk = max($statistik['total_penduduk'] ?? 1, 1); @endphp
                        
                        <div class="group">
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-child text-emerald-500 text-xs"></i>
                                    <span class="font-medium text-slate-600">0 - 14 tahun</span>
                                </span>
                                <span class="font-semibold text-slate-700">{{ number_format($statistik['kelompok_umur_0_14'] ?? 0) }} jiwa</span>
                            </div>
                            <div class="relative">
                                <div class="w-full bg-emerald-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="progress-bar bg-gradient-to-r from-emerald-500 to-emerald-400 h-2.5 rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">{{ round(($statistik['kelompok_umur_0_14'] ?? 0) / $totalPenduduk * 100, 1) }}% dari total penduduk</p>
                        </div>
                        
                        <div class="group">
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-person-walking-arrow-right text-blue-500 text-xs"></i>
                                    <span class="font-medium text-slate-600">15 - 29 tahun</span>
                                </span>
                                <span class="font-semibold text-slate-700">{{ number_format($statistik['kelompok_umur_15_29'] ?? 0) }} jiwa</span>
                            </div>
                            <div class="relative">
                                <div class="w-full bg-blue-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="progress-bar bg-gradient-to-r from-blue-500 to-blue-400 h-2.5 rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">{{ round(($statistik['kelompok_umur_15_29'] ?? 0) / $totalPenduduk * 100, 1) }}% dari total penduduk</p>
                        </div>
                        
                        <div class="group">
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-briefcase text-amber-500 text-xs"></i>
                                    <span class="font-medium text-slate-600">30 - 59 tahun</span>
                                </span>
                                <span class="font-semibold text-slate-700">{{ number_format($statistik['kelompok_umur_30_59'] ?? 0) }} jiwa</span>
                            </div>
                            <div class="relative">
                                <div class="w-full bg-amber-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="progress-bar bg-gradient-to-r from-amber-500 to-amber-400 h-2.5 rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">{{ round(($statistik['kelompok_umur_30_59'] ?? 0) / $totalPenduduk * 100, 1) }}% dari total penduduk</p>
                        </div>
                        
                        <div class="group">
                            <div class="flex justify-between text-sm mb-1.5">
                                <span class="flex items-center gap-2">
                                    <i class="fa-solid fa-cane text-purple-500 text-xs"></i>
                                    <span class="font-medium text-slate-600">60+ tahun</span>
                                </span>
                                <span class="font-semibold text-slate-700">{{ number_format($statistik['kelompok_umur_60'] ?? 0) }} jiwa</span>
                            </div>
                            <div class="relative">
                                <div class="w-full bg-purple-100 rounded-full h-2.5 overflow-hidden">
                                    <div class="progress-bar bg-gradient-to-r from-purple-500 to-purple-400 h-2.5 rounded-full transition-all duration-1000 ease-out" style="width: 0%"></div>
                                </div>
                            </div>
                            <p class="text-[10px] text-slate-400 mt-1 opacity-0 group-hover:opacity-100 transition-opacity">{{ round(($statistik['kelompok_umur_60'] ?? 0) / $totalPenduduk * 100, 1) }}% dari total penduduk</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik UMKM Premium --}}
        <div class="stat-section bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden mb-8 transition-all duration-500 hover:shadow-2xl hover:shadow-amber-500/10">
            <div class="section-header bg-gradient-to-r from-amber-50/50 to-white px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-store text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Statistik UMKM</h2>
                        <p class="text-xs text-slate-400">Usaha Mikro Kecil dan Menengah</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="umkm-card group relative bg-gradient-to-br from-amber-500 to-amber-600 rounded-2xl p-5 text-white overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-shop text-2xl text-white/80 group-hover:scale-110 transition-transform"></i>
                                <i class="fa-solid fa-chart-simple text-white/40"></i>
                            </div>
                            <p class="text-amber-100 text-sm">Total UMKM</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['total_umkm'] ?? 0) }}</p>
                            <div class="mt-2 flex items-center gap-1 text-[10px] text-amber-100">
                                <i class="fa-solid fa-building"></i>
                                <span>Usaha terdaftar</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="umkm-card group relative bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-5 text-white overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-circle-check text-2xl text-white/80 group-hover:scale-110 transition-transform"></i>
                                <i class="fa-solid fa-chart-line text-white/40"></i>
                            </div>
                            <p class="text-green-100 text-sm">UMKM Aktif</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['umkm_approved'] ?? 0) }}</p>
                            <div class="mt-2 h-1 bg-white/20 rounded-full overflow-hidden">
                                <div class="h-full bg-white/50 rounded-full" style="width: {{ ($statistik['umkm_approved'] / max($statistik['total_umkm'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="umkm-card group relative bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-2xl p-5 text-white overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-clock text-2xl text-white/80 group-hover:scale-110 transition-transform"></i>
                                <i class="fa-solid fa-hourglass-half text-white/40"></i>
                            </div>
                            <p class="text-yellow-100 text-sm">Menunggu Verifikasi</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format(($statistik['total_umkm'] ?? 0) - ($statistik['umkm_approved'] ?? 0)) }}</p>
                            <div class="mt-2 h-1 bg-white/20 rounded-full overflow-hidden">
                                <div class="h-full bg-white/50 rounded-full" style="width: {{ ((($statistik['total_umkm'] ?? 0) - ($statistik['umkm_approved'] ?? 0)) / max($statistik['total_umkm'], 1)) * 100 }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Statistik Layanan Premium --}}
        <div class="stat-section bg-white rounded-3xl shadow-xl border border-slate-100 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/10">
            <div class="section-header bg-gradient-to-r from-blue-50/50 to-white px-6 py-4 border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center shadow-md">
                        <i class="fa-solid fa-envelope-open-text text-white text-lg"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-slate-800">Statistik Layanan</h2>
                        <p class="text-xs text-slate-400">Aktivitas pelayanan publik</p>
                    </div>
                </div>
            </div>
            
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div class="service-card group relative bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-5 text-white overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-newspaper text-2xl text-white/80 group-hover:rotate-12 transition-transform"></i>
                                <i class="fa-solid fa-chart-line text-white/40"></i>
                            </div>
                            <p class="text-blue-100 text-sm">Total Berita</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['total_berita'] ?? 0) }}</p>
                            <div class="mt-2 flex items-center gap-1 text-[10px] text-blue-100">
                                <i class="fa-regular fa-newspaper"></i>
                                <span>Informasi publik</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card group relative bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-5 text-white overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-comment-dots text-2xl text-white/80 group-hover:rotate-12 transition-transform"></i>
                                <i class="fa-solid fa-chart-pie text-white/40"></i>
                            </div>
                            <p class="text-purple-100 text-sm">Total Aspirasi</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['total_aspirasi'] ?? 0) }}</p>
                            <div class="mt-2 flex items-center gap-1 text-[10px] text-purple-100">
                                <i class="fa-regular fa-message"></i>
                                <span>Suara warga</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="service-card group relative bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl p-5 text-white overflow-hidden cursor-pointer">
                        <div class="absolute inset-0 bg-gradient-to-r from-white/0 via-white/10 to-white/0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000"></div>
                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-3">
                                <i class="fa-solid fa-file-signature text-2xl text-white/80 group-hover:rotate-12 transition-transform"></i>
                                <i class="fa-solid fa-chart-simple text-white/40"></i>
                            </div>
                            <p class="text-emerald-100 text-sm">Pengajuan Surat</p>
                            <p class="text-3xl font-bold mt-1 counter">{{ number_format($statistik['total_surat'] ?? 0) }}</p>
                            <div class="mt-2 flex items-center gap-1 text-[10px] text-emerald-100">
                                <i class="fa-regular fa-file"></i>
                                <span>Administrasi</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Info Premium --}}
        <div class="mt-8 p-4 bg-white/50 backdrop-blur-sm rounded-2xl border border-slate-100">
            <div class="flex flex-col md:flex-row items-center justify-between gap-3 text-center md:text-left">
                <div class="flex items-center gap-4 flex-wrap justify-center">
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <i class="fa-solid fa-database text-emerald-500"></i>
                        <span>Sumber: Database Desa Lumban Silintong</span>
                    </div>
                    <div class="w-1 h-1 bg-slate-300 rounded-full hidden md:block"></div>
                    <div class="flex items-center gap-2 text-xs text-slate-400">
                        <i class="fa-regular fa-clock text-emerald-500"></i>
                        <span>Update terakhir: {{ now()->format('d F Y H:i:s') }}</span>
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
    </div>
</div>

<style>
    /* Animations */
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.1); }
    }
    
    @keyframes spin-slow {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 6s ease-in-out infinite;
    }
    
    .animate-spin-slow {
        animation: spin-slow 2s linear infinite;
    }
    
    /* Stat Card */
    .stat-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        filter: brightness(1.05);
    }
    
    .umkm-card, .service-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .umkm-card:hover, .service-card:hover {
        transform: translateY(-5px) scale(1.02);
    }
    
    /* Section */
    .stat-section {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    /* Progress Bar Animation */
    .progress-bar {
        animation: slideIn 0.8s ease-out forwards;
    }
    
    /* Counter Animation */
    .counter {
        animation: countUp 0.6s ease-out;
    }
    
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Hover Effects */
    .stat-section:hover .section-header {
        background: linear-gradient(to right, rgba(16, 185, 129, 0.1), rgba(255,255,255,0));
    }
    
    /* Custom Scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #10b981;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #059669;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .stat-card, .umkm-card, .service-card {
            padding: 16px;
        }
        
        .stat-card p.text-3xl, .umkm-card p.text-3xl, .service-card p.text-3xl {
            font-size: 24px;
        }
    }
</style>

<script>
    // Trigger progress bar animation on load
    document.addEventListener('DOMContentLoaded', function() {
        // Set progress bars width after a small delay for animation
        setTimeout(function() {
            document.querySelectorAll('.progress-bar').forEach(bar => {
                const parent = bar.parentElement.parentElement;
                const percentText = parent.querySelector('.font-semibold');
                if (percentText) {
                    const value = parseInt(percentText.innerText.replace(/[^0-9]/g, ''));
                    const total = {{ $statistik['total_penduduk'] ?? 1 }};
                    const percent = (value / total) * 100;
                    bar.style.width = percent + '%';
                }
            });
        }, 100);
    });
</script>
@endsection