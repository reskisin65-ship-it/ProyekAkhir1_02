@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-white pb-20">
    {{-- Header Section --}}
    <div class="pt-16 pb-10 text-center px-4">
        <div class="flex justify-center mb-4 text-5xl">🛍️</div>
        <h1 class="text-5xl font-black text-emerald-950 italic mb-4 tracking-tighter">
            UMKM Desa <span class="text-emerald-500">Lumban Silintong</span>
        </h1>
        <p class="text-slate-500 max-w-2xl mx-auto font-medium">
            Dukung produk lokal! Temukan berbagai produk unggulan dari UMKM Desa Lumban Silintong.
        </p>
    </div>

    {{-- TOMBOL DAFTAR / STATUS / KELOLA (INI YANG TADI GAADA) --}}
    <div class="flex justify-center mb-12">
        @auth
            @if(!$umkm)
                {{-- Jika Belum Daftar --}}
                <a href="{{ route('umkm.create') }}" class="px-8 py-5 bg-emerald-600 text-white rounded-[2rem] font-black shadow-2xl hover:bg-emerald-700 transition-all hover:-translate-y-1">
                    🚀 DAFTARKAN UMKM SAYA SEKARANG
                </a>
            @elseif($umkm->status == 'pending')
                {{-- Jika Menunggu --}}
                <div class="px-8 py-5 bg-amber-50 text-amber-700 rounded-[2rem] font-bold border border-amber-100 shadow-lg shadow-amber-100">
                    ⏳ PENDAFTARAN SEDANG DITINJAU ADMIN
                </div>
            @elseif($umkm->status == 'approved')
                {{-- Jika Sudah Disetujui --}}
                <a href="{{ route('umkm.dashboard') }}" class="px-8 py-5 bg-emerald-950 text-white rounded-[2rem] font-black shadow-2xl hover:bg-black transition-all hover:-translate-y-1">
                    ⚙️ KELOLA PROFIL UMKM SAYA
                </a>
            @endif
        @else
            <a href="{{ route('login') }}" class="px-8 py-5 bg-slate-100 text-slate-500 rounded-[2rem] font-bold">
                Masuk untuk mendaftarkan UMKM
            </a>
        @endauth
    </div>

    {{-- Filter Kategori --}}
    <div class="flex flex-wrap justify-center gap-3 mb-16">
        <button class="px-6 py-2 bg-emerald-500 text-white rounded-full font-bold">Semua</button>
        <button class="px-6 py-2 bg-slate-50 text-slate-500 rounded-full font-bold">🍔 Makanan</button>
        <button class="px-6 py-2 bg-slate-50 text-slate-500 rounded-full font-bold">🎨 Kerajinan</button>
    </div>

    {{-- List UMKM Publik --}}
    <div class="max-w-7xl mx-auto px-6">
        @if($umkms->isEmpty())
            <div class="text-center py-20 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <div class="text-6xl mb-4">🏪</div>
                <h3 class="text-2xl font-black text-slate-300 uppercase italic">Belum Ada UMKM</h3>
                <p class="text-slate-400">Belum ada UMKM yang terdaftar saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($umkms as $item)
                    <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all">
                        <img src="{{ asset('storage/'.$item->logo) }}" class="w-full h-48 object-cover rounded-[2rem] mb-6">
                        <h4 class="text-xl font-black text-emerald-950 mb-2">{{ $item->nama_usaha }}</h4>
                        <span class="inline-block px-4 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase rounded-full">{{ $item->kategori }}</span>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection