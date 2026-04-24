@extends('layouts.app') {{-- Sesuaikan dengan layout utama web kamu --}}

@section('content')
<div class="min-h-screen bg-white pb-20">
    {{-- Header Section --}}
    <div class="pt-16 pb-10 text-center px-4">
        <div class="flex justify-center mb-4">
            <span class="text-5xl">🛍️</span>
        </div>
        <h1 class="text-5xl font-black text-emerald-950 italic mb-4 tracking-tighter">
            UMKM Desa <span class="text-emerald-500">Lumban Silintong</span>
        </h1>
        <p class="text-slate-500 max-w-2xl mx-auto font-medium">
            Dukung produk lokal! Temukan berbagai produk unggulan dari UMKM Desa Lumban Silintong yang berkualitas dan autentik.
        </p>
    </div>

    {{-- FITUR PENDAFTARAN & KELOLA (LOGIKA OTOMATIS) --}}
    <div class="flex justify-center mb-12">
        @auth
            @php
                $myUmkm = \App\Models\Umkm::where('user_id', auth()->id())->first();
            @endphp

            @if(!$myUmkm)
                {{-- Jika Belum Daftar --}}
                <a href="{{ route('umkm.create') }}" class="group flex items-center gap-4 px-8 py-5 bg-emerald-600 text-white rounded-[2rem] font-black shadow-2xl shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all">
                    <i class="fa-solid fa-rocket text-xl"></i>
                    <span>DAFTARKAN UMKM SAYA SEKARANG</span>
                </a>
            @elseif($myUmkm->status == 'pending')
                {{-- Jika Menunggu --}}
                <div class="flex items-center gap-4 px-8 py-5 bg-amber-50 text-amber-700 rounded-[2rem] font-bold border border-amber-100 shadow-lg shadow-amber-100">
                    <i class="fa-solid fa-clock-rotate-left animate-spin-slow"></i>
                    <span>PENDAFTARAN SEDANG DITINJAU ADMIN</span>
                </div>
            @elseif($myUmkm->status == 'approved')
                {{-- Jika Sudah Disetujui --}}
                <a href="{{ route('umkm.dashboard') }}" class="group flex items-center gap-4 px-8 py-5 bg-emerald-950 text-white rounded-[2rem] font-black shadow-2xl shadow-emerald-900/20 hover:bg-black hover:-translate-y-1 transition-all">
                    <i class="fa-solid fa-gauge-high text-xl text-emerald-400"></i>
                    <span>BUKA PANEL KELOLA UMKM</span>
                </a>
            @endif
        @else
            {{-- Jika Belum Login --}}
            <a href="{{ route('login') }}" class="px-8 py-5 bg-slate-100 text-slate-500 rounded-[2rem] font-bold hover:bg-slate-200 transition">
                Masuk untuk mendaftarkan UMKM Anda
            </a>
        @endauth
    </div>

    {{-- Filter Kategori --}}
    <div class="flex flex-wrap justify-center gap-3 mb-16">
        <button class="px-6 py-2 bg-emerald-500 text-white rounded-full font-bold shadow-lg shadow-emerald-100">Semua</button>
        <button class="px-6 py-2 bg-slate-50 text-slate-500 rounded-full font-bold hover:bg-slate-100 transition">🍔 Makanan</button>
        <button class="px-6 py-2 bg-slate-50 text-slate-500 rounded-full font-bold hover:bg-slate-100 transition">🎨 Kerajinan</button>
        <button class="px-6 py-2 bg-slate-50 text-slate-500 rounded-full font-bold hover:bg-slate-100 transition">👕 Fashion</button>
        <button class="px-6 py-2 bg-slate-50 text-slate-500 rounded-full font-bold hover:bg-slate-100 transition">🌾 Pertanian</button>
    </div>

    {{-- Daftar UMKM (Data dari Database) --}}
    <div class="max-w-7xl mx-auto px-6">
        @if($umkms->isEmpty())
            <div class="text-center py-20 bg-slate-50 rounded-[3rem] border-2 border-dashed border-slate-200">
                <div class="text-6xl mb-4">🏪</div>
                <h3 class="text-2xl font-black text-slate-300 uppercase tracking-tighter italic">Belum Ada UMKM</h3>
                <p class="text-slate-400">Belum ada UMKM yang terdaftar atau disetujui saat ini.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($umkms as $item)
                    <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                        {{-- PERBAIKAN: Gambar Muncul (Pastikan jalankan php artisan storage:link) --}}
                        <img src="{{ asset('storage/'.$item->logo) }}" class="w-full h-48 object-cover rounded-[2rem] mb-6 shadow-inner bg-slate-100" onerror="this.src='https://via.placeholder.com/400x300?text=Logo+UMKM'">
                        
                        <h4 class="text-xl font-black text-emerald-950 mb-2">{{ $item->nama_usaha }}</h4>
                        <span class="inline-block px-4 py-1 bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase rounded-full mb-4">{{ $item->kategori }}</span>
                        <p class="text-slate-500 text-sm mb-6 line-clamp-2">{{ $item->deskripsi }}</p>
                        
                        {{-- FIX: Mengirimkan objek $item secara utuh untuk menghindari missing parameter --}}
                        <a href="{{ route('umkm.show', $item) }}" class="block text-center py-4 bg-slate-50 text-emerald-950 font-black rounded-2xl group-hover:bg-emerald-600 group-hover:text-white transition-all uppercase text-xs tracking-widest mb-3">Detail Usaha</a>
                        
                        {{-- TAMBAHAN: Fitur CRUD (Edit & Hapus) --}}
                        @auth
                            @if(auth()->id() == $item->user_id || auth()->user()->role == 'admin')
                            <div class="flex gap-2">
                                {{-- FIX: Mengirimkan objek $item untuk route edit & destroy --}}
                                <a href="{{ route('umkm.edit', $item) }}" class="flex-1 text-center py-2 bg-amber-50 text-amber-600 rounded-xl font-bold text-xs hover:bg-amber-100 transition">EDIT</a>
                                <form action="{{ route('umkm.destroy', $item) }}" method="POST" class="flex-1" onsubmit="return confirm('Hapus UMKM ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full text-center py-2 bg-red-50 text-red-600 rounded-xl font-bold text-xs hover:bg-red-100 transition">HAPUS</button>
                                </form>
                            </div>
                            @endif
                        @endauth
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection