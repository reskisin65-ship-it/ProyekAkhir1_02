{{-- resources/views/admin/dashboard.blade.php --}}
@extends('layouts.admin')

@section('title', 'Dashboard Admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    {{-- Welcome Card --}}
    <div class="bg-gradient-to-r from-emerald-600 to-emerald-800 rounded-2xl p-6 text-white mb-8">
        <div class="flex justify-between items-start">
            <div>
                <h1 class="text-2xl font-bold">Selamat Datang, {{ Auth::user()->name }}!</h1>
                <p class="text-emerald-100 mt-1">Berikut ringkasan aktivitas Desa Lumban Silintong</p>
            </div>
            <div class="text-right">
                <p class="text-sm text-emerald-200">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</p>
                <p class="text-xs text-emerald-200">{{ \Carbon\Carbon::now()->format('H:i') }} WIB</p>
            </div>
        </div>
    </div>

    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition border-l-4 border-emerald-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-sm">Total Penduduk</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalPenduduk ?? 0) }}</p>
                    <div class="mt-2 flex items-center gap-1">
                        <i class="fa-solid fa-arrow-up text-emerald-500 text-xs"></i>
                        <span class="text-xs text-green-600">+2.5%</span>
                    </div>
                </div>
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-users text-emerald-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition border-l-4 border-amber-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-sm">UMKM Terdaftar</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalUmkm ?? 0) }}</p>
                    @if(($umkmPending ?? 0) > 0)
                    <p class="text-xs text-yellow-600 mt-1">{{ $umkmPending }} menunggu verifikasi</p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-store text-amber-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-sm">Pengajuan Surat</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalSurat ?? 0) }}</p>
                    @if(($suratMenunggu ?? 0) > 0)
                    <p class="text-xs text-blue-600 mt-1">{{ $suratMenunggu }} perlu diproses</p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-envelope text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl p-5 shadow-sm hover:shadow-md transition border-l-4 border-purple-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-gray-400 text-sm">Aspirasi</p>
                    <p class="text-3xl font-bold text-gray-800">{{ number_format($totalAspirasi ?? 0) }}</p>
                    @if(($aspirasiBaru ?? 0) > 0)
                    <p class="text-xs text-purple-600 mt-1">{{ $aspirasiBaru }} aspirasi baru</p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fa-solid fa-comment-dots text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Data Tables --}}
    <div class="grid lg:grid-cols-2 gap-6">
        {{-- Pengajuan Surat Terbaru --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h2 class="font-semibold text-gray-800">📋 Pengajuan Surat Terbaru</h2>
                <a href="{{ route('admin.pengajuan-surat.index') }}" class="text-emerald-600 text-sm hover:underline">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($pengajuanTerbaru as $item)
                <div class="px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-center">
                        <div>
                            <p class="font-medium text-gray-800">{{ $item->jenis_surat }}</p>
                            <p class="text-xs text-gray-400">{{ $item->user->name ?? '-' }} • {{ $item->created_at->translatedFormat('d M Y') }}</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($item->status == 'diproses') bg-blue-100 text-blue-700
                                @elseif($item->status == 'selesai') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                            <a href="{{ route('admin.pengajuan-surat.show', $item->id_surat) }}" class="text-emerald-600">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-gray-400">Belum ada pengajuan surat</div>
                @endforelse
            </div>
        </div>

        {{-- Aspirasi Terbaru --}}
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="bg-gray-50 px-6 py-4 border-b flex justify-between items-center">
                <h2 class="font-semibold text-gray-800">💬 Aspirasi Terbaru</h2>
                <a href="{{ route('admin.aspirasi.index') }}" class="text-emerald-600 text-sm hover:underline">Lihat Semua →</a>
            </div>
            <div class="divide-y divide-gray-100">
                @forelse($aspirasiTerbaru as $item)
                <div class="px-6 py-4 hover:bg-gray-50 transition">
                    <div class="flex justify-between items-start">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">{{ Str::limit($item->judul, 50) }}</p>
                            <p class="text-xs text-gray-400">{{ $item->user->name ?? '-' }} • {{ $item->created_at->diffForHumans() }}</p>
                        </div>
                        <span class="px-2 py-1 rounded-full text-xs font-semibold ml-3
                            @if($item->status == 'baru') bg-red-100 text-red-700
                            @elseif($item->status == 'diproses') bg-yellow-100 text-yellow-700
                            @else bg-green-100 text-green-700 @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="px-6 py-8 text-center text-gray-400">Belum ada aspirasi</div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
