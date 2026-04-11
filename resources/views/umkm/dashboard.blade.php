{{-- resources/views/umkm/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'UMKM Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-3xl font-serif italic text-emerald-800 mb-4">
            👋 Selamat Datang, {{ Auth::user()->name }}!
        </h1>
        <p class="text-gray-500">Anda login sebagai <span class="font-semibold text-emerald-600">Pemilik UMKM</span></p>
        
        <div class="grid md:grid-cols-2 gap-6 mt-8">
            <div class="bg-emerald-50 rounded-xl p-6 text-center">
                <i class="fa-solid fa-store text-3xl text-emerald-600 mb-3"></i>
                <h3 class="font-semibold text-emerald-800">Kelola Profil UMKM</h3>
                <p class="text-sm text-gray-500 mt-1">Update informasi usaha Anda</p>
            </div>
            <div class="bg-emerald-50 rounded-xl p-6 text-center">
                <i class="fa-solid fa-box text-3xl text-emerald-600 mb-3"></i>
                <h3 class="font-semibold text-emerald-800">Kelola Produk</h3>
                <p class="text-sm text-gray-500 mt-1">Tambah/edit produk UMKM</p>
            </div>
        </div>
    </div>
</div>
@endsection