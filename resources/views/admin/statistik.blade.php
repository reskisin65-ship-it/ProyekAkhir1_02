{{-- resources/views/admin/statistik.blade.php --}}
@extends('layouts.admin')

@section('title', 'Statistik Desa')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📊 Statistik Desa Lumban Silintong</h1>
        <p class="text-gray-500">Data statistik kependudukan dan layanan desa</p>
    </div>

    {{-- Statistik Penduduk --}}
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">👥 Statistik Penduduk</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-4 text-white">
                <p class="text-emerald-100 text-sm">Total Penduduk</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['total_penduduk'] ?? 0) }}</p>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 text-white">
                <p class="text-blue-100 text-sm">Laki-laki</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['penduduk_pria'] ?? 0) }}</p>
            </div>
            <div class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-xl p-4 text-white">
                <p class="text-pink-100 text-sm">Perempuan</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['penduduk_wanita'] ?? 0) }}</p>
            </div>
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-4 text-white">
                <p class="text-amber-100 text-sm">Kepala Keluarga</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['total_kk'] ?? 0) }}</p>
            </div>
        </div>

        <h3 class="font-semibold text-gray-700 mb-3">📈 Kelompok Umur</h3>
        <div class="space-y-3">
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>0 - 14 tahun</span>
                    <span>{{ number_format($statistik['kelompok_umur_0_14'] ?? 0) }} jiwa</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ ($statistik['kelompok_umur_0_14'] ?? 0) / ($statistik['total_penduduk'] ?? 1) * 100 }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>15 - 29 tahun</span>
                    <span>{{ number_format($statistik['kelompok_umur_15_29'] ?? 0) }} jiwa</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ ($statistik['kelompok_umur_15_29'] ?? 0) / ($statistik['total_penduduk'] ?? 1) * 100 }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>30 - 59 tahun</span>
                    <span>{{ number_format($statistik['kelompok_umur_30_59'] ?? 0) }} jiwa</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-amber-500 h-2 rounded-full" style="width: {{ ($statistik['kelompok_umur_30_59'] ?? 0) / ($statistik['total_penduduk'] ?? 1) * 100 }}%"></div>
                </div>
            </div>
            <div>
                <div class="flex justify-between text-sm mb-1">
                    <span>60+ tahun</span>
                    <span>{{ number_format($statistik['kelompok_umur_60'] ?? 0) }} jiwa</span>
                </div>
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-purple-500 h-2 rounded-full" style="width: {{ ($statistik['kelompok_umur_60'] ?? 0) / ($statistik['total_penduduk'] ?? 1) * 100 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Statistik UMKM --}}
    <div class="bg-white rounded-xl shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">🏪 Statistik UMKM</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-gradient-to-br from-amber-500 to-amber-600 rounded-xl p-4 text-white">
                <p class="text-amber-100 text-sm">Total UMKM</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['total_umkm'] ?? 0) }}</p>
            </div>
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl p-4 text-white">
                <p class="text-green-100 text-sm">UMKM Aktif</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['umkm_approved'] ?? 0) }}</p>
            </div>
            <div class="bg-gradient-to-br from-yellow-500 to-yellow-600 rounded-xl p-4 text-white">
                <p class="text-yellow-100 text-sm">Menunggu Verifikasi</p>
                <p class="text-2xl font-bold">{{ number_format(($statistik['total_umkm'] ?? 0) - ($statistik['umkm_approved'] ?? 0)) }}</p>
            </div>
        </div>
    </div>

    {{-- Statistik Layanan --}}
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">📋 Statistik Layanan</h2>
        <div class="grid md:grid-cols-3 gap-4">
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl p-4 text-white">
                <p class="text-blue-100 text-sm">Total Berita</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['total_berita'] ?? 0) }}</p>
            </div>
            <div class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl p-4 text-white">
                <p class="text-purple-100 text-sm">Total Aspirasi</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['total_aspirasi'] ?? 0) }}</p>
            </div>
            <div class="bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl p-4 text-white">
                <p class="text-emerald-100 text-sm">Total Pengajuan Surat</p>
                <p class="text-2xl font-bold">{{ number_format($statistik['total_surat'] ?? 0) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection