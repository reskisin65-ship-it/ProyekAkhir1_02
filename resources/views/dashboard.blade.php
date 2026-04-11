{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-lg p-8">
        <h1 class="text-3xl font-serif italic text-emerald-800 mb-4">
            👋 Selamat Datang, {{ Auth::user()->name }}!
        </h1>
        <p class="text-gray-500">Anda login sebagai <span class="font-semibold text-emerald-600">{{ Auth::user()->role->nama_role ?? 'Masyarakat' }}</span></p>
        
        <div class="mt-8 p-4 bg-emerald-50 rounded-xl">
            <p class="text-emerald-700">✅ Sistem login berhasil!</p>
        </div>
    </div>
</div>
@endsection