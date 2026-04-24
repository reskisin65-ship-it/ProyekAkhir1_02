{{-- resources/views/admin/keuangan/laporan.blade.php --}}
@extends('layouts.app')

@section('title', 'Laporan Keuangan - Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-serif italic text-emerald-800">📊 Laporan Keuangan</h1>
                <p class="text-gray-500 mt-1">Laporan pemasukan dan pengeluaran desa</p>
            </div>
            <a href="{{ route('admin.keuangan.index') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700">
                <i class="fa-solid fa-arrow-left"></i> Kembali
            </a>
        </div>
        
        {{-- Filter Periode --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" name="dari_tanggal" value="{{ $dariTanggal }}" 
                           class="px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" name="sampai_tanggal" value="{{ $sampaiTanggal }}" 
                           class="px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <button type="submit" class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                </div>
                <div>
                    <button onclick="window.print()" class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition">
                        <i class="fa-solid fa-print"></i> Cetak
                    </button>
                </div>
            </form>
        </div>
        
        {{-- Ringkasan --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl p-6 text-white">
                <p class="text-emerald-100 text-sm">Total Pemasukan</p>
                <p class="text-3xl font-bold">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
            </div>
            <div class="bg-gradient-to-r from-red-500 to-red-600 rounded-2xl p-6 text-white">
                <p class="text-red-100 text-sm">Total Pengeluaran</p>
                <p class="text-3xl font-bold">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
            </div>
            <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-2xl p-6 text-white">
                <p class="text-blue-100 text-sm">Saldo Akhir</p>
                <p class="text-3xl font-bold">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
            </div>
        </div>
        
        {{-- Tabel Transaksi --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-emerald-50 to-white border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600">Jenis</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600">Deskripsi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($transaksis as $t)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $t->jenis == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $t->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $t->kategori->nama_kategori }}</td>
                            <td class="px-6 py-4 text-sm">{{ $t->deskripsi }}</td>
                            <td class="px-6 py-4 text-sm font-semibold {{ $t->jenis == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <i class="fa-regular fa-folder-open text-4xl mb-3 block"></i>
                                <p>Tidak ada transaksi dalam periode ini</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .nav-top, .magic-sidebar, .mobile-nav, .btn-premium, form, a, button {
            display: none !important;
        }
        body {
            background: white;
            padding: 20px;
        }
        .main-container {
            margin: 0 !important;
            padding: 0 !important;
        }
        .rounded-2xl, .rounded-3xl {
            border-radius: 0 !important;
            box-shadow: none !important;
        }
    }
</style>
@endsection