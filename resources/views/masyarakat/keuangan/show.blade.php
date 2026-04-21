{{-- resources/views/masyarakat/keuangan/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Transaksi - Keuangan Desa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('masyarakat.keuangan.index', request()->query()) }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali
            </a>
        </div>
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-6">
                <div class="flex items-center gap-3">
                    <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-receipt text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Detail Transaksi</h1>
                        <p class="text-emerald-100 text-sm">Informasi lengkap transaksi keuangan desa</p>
                    </div>
                </div>
            </div>
            
            <div class="p-8">
                <div class="grid gap-6">
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <span class="text-gray-500">Tanggal Transaksi</span>
                        <span class="font-semibold text-gray-800">{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <span class="text-gray-500">Jenis Transaksi</span>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $transaksi->jenis == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $transaksi->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                        </span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <span class="text-gray-500">Kategori</span>
                        <span class="font-semibold text-gray-800">{{ $transaksi->kategori->nama_kategori }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <span class="text-gray-500">Deskripsi</span>
                        <span class="font-semibold text-gray-800 text-right max-w-[60%]">{{ $transaksi->deskripsi }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                        <span class="text-gray-500">Jumlah</span>
                        <span class="text-2xl font-bold {{ $transaksi->jenis == 'pemasukan' ? 'text-emerald-600' : 'text-red-600' }}">
                            Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                        </span>
                    </div>
                    
                    @if($transaksi->bukti_foto)
                    <div class="pb-4 border-b border-gray-100">
                        <span class="text-gray-500 block mb-3">Bukti Transaksi</span>
                        <img src="{{ asset('storage/' . $transaksi->bukti_foto) }}" alt="Bukti Transaksi" class="rounded-xl max-h-64 w-auto shadow-md">
                    </div>
                    @endif
                    
                    <div class="flex justify-between items-center pt-2">
                        <span class="text-gray-500">Status</span>
                        <span class="px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                            <i class="fa-regular fa-circle-check mr-1"></i> Disetujui
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection