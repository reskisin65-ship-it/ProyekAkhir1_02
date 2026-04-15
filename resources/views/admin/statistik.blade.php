{{-- resources/views/admin/statistik.blade.php --}}
@extends('layouts.app')

@section('title', 'Statistik Desa')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">📊 Statistik Desa</h1>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-emerald-500">
            <p class="text-gray-400 text-sm">Total Penduduk</p>
            <p class="text-3xl font-bold text-emerald-700">{{ number_format($statistik['total_penduduk'] ?? 0) }}</p>
            <div class="flex gap-4 mt-2 text-xs">
                <span>👨 {{ number_format($statistik['penduduk_pria'] ?? 0) }}</span>
                <span>👩 {{ number_format($statistik['penduduk_wanita'] ?? 0) }}</span>
            </div>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-blue-500">
            <p class="text-gray-400 text-sm">Kepala Keluarga</p>
            <p class="text-3xl font-bold text-blue-700">{{ number_format($statistik['total_kk'] ?? 0) }}</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-amber-500">
            <p class="text-gray-400 text-sm">UMKM Terdaftar</p>
            <p class="text-3xl font-bold text-amber-700">{{ number_format($statistik['total_umkm'] ?? 0) }}</p>
            <p class="text-xs text-green-600 mt-1">{{ number_format($statistik['umkm_approved'] ?? 0) }} aktif</p>
        </div>
        <div class="bg-white rounded-xl p-5 shadow-sm border-l-4 border-purple-500">
            <p class="text-gray-400 text-sm">Total Berita</p>
            <p class="text-3xl font-bold text-purple-700">{{ number_format($statistik['total_berita'] ?? 0) }}</p>
        </div>
    </div>

    <div class="grid md:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h3 class="font-semibold text-gray-700 mb-3">📋 Pengajuan Surat</h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-500">Total Pengajuan</span>
                    <span class="font-semibold">{{ number_format($statistik['total_surat'] ?? 0) }}</span>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-5">
            <h3 class="font-semibold text-gray-700 mb-3">💬 Aspirasi Masyarakat</h3>
            <div class="space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-500">Total Aspirasi</span>
                    <span class="font-semibold">{{ number_format($statistik['total_aspirasi'] ?? 0) }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection