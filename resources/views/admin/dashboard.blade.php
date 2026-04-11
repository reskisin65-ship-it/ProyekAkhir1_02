{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-3xl font-serif italic text-emerald-800 mb-4">
            👋 Selamat Datang, {{ Auth::user()->name }}!
        </h1>
        <p class="text-gray-500">Anda login sebagai <span class="font-semibold text-emerald-600">Administrator</span></p>
        
        <div class="grid md:grid-cols-4 gap-6 mt-8">
            <div class="bg-emerald-50 rounded-xl p-6 text-center">
                <i class="fa-solid fa-users text-3xl text-emerald-600 mb-3"></i>
                <h3 class="font-semibold text-emerald-800">Data Penduduk</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola data warga</p>
            </div>
            <div class="bg-emerald-50 rounded-xl p-6 text-center">
                <i class="fa-solid fa-envelope text-3xl text-emerald-600 mb-3"></i>
                <h3 class="font-semibold text-emerald-800">Pengajuan Surat</h3>
                <p class="text-sm text-gray-500 mt-1">Verifikasi surat</p>
            </div>
            <div class="bg-emerald-50 rounded-xl p-6 text-center">
                <i class="fa-solid fa-newspaper text-3xl text-emerald-600 mb-3"></i>
                <h3 class="font-semibold text-emerald-800">Kelola Berita</h3>
                <p class="text-sm text-gray-500 mt-1">Posting berita & pengumuman</p>
            </div>
            <div class="bg-emerald-50 rounded-xl p-6 text-center">
                <i class="fa-solid fa-store text-3xl text-emerald-600 mb-3"></i>
                <h3 class="font-semibold text-emerald-800">UMKM</h3>
                <p class="text-sm text-gray-500 mt-1">Kelola UMKM desa</p>
            </div>
        </div>
    </div>
</div>
@endsection