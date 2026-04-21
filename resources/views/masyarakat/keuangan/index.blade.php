{{-- resources/views/masyarakat/keuangan/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Transparansi Keuangan Desa')

@section('content')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="text-center mb-10">
            <h1 class="text-4xl md:text-5xl font-serif italic text-emerald-900">💰 Transparansi Keuangan Desa</h1>
            <p class="text-gray-500 mt-3">Informasi pemasukan dan pengeluaran desa secara transparan</p>
            <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-4 rounded-full"></div>
        </div>
        
        {{-- Filter --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
            <form method="GET" class="flex flex-wrap gap-4 items-end justify-center">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun</label>
                    <select name="tahun" class="px-4 py-2 rounded-lg border border-gray-200">
                        @for($i = date('Y'); $i >= date('Y')-5; $i--)
                            <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Bulan</label>
                    <select name="bulan" class="px-4 py-2 rounded-lg border border-gray-200">
                        <option value="semua" {{ $bulan == 'semua' ? 'selected' : '' }}>Semua Bulan</option>
                        @for($i = 1; $i <= 12; $i++)
                            <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                        @endfor
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis</label>
                    <select name="jenis" class="px-4 py-2 rounded-lg border border-gray-200">
                        <option value="semua" {{ $jenis == 'semua' ? 'selected' : '' }}>Semua</option>
                        <option value="pemasukan" {{ $jenis == 'pemasukan' ? 'selected' : '' }}>💰 Pemasukan</option>
                        <option value="pengeluaran" {{ $jenis == 'pengeluaran' ? 'selected' : '' }}>💸 Pengeluaran</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="px-6 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition">
                        <i class="fa-solid fa-filter"></i> Filter
                    </button>
                </div>
            </form>
        </div>
        
        {{-- Statistik Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="stat-card bg-white rounded-2xl p-6 text-center shadow-md border border-gray-100">
                <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-money-bill-trend-up text-emerald-600 text-2xl"></i>
                </div>
                <p class="text-2xl font-bold text-emerald-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mt-1">Total Pemasukan</p>
            </div>
            <div class="stat-card bg-white rounded-2xl p-6 text-center shadow-md border border-gray-100">
                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-money-bill-trend-down text-red-600 text-2xl"></i>
                </div>
                <p class="text-2xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mt-1">Total Pengeluaran</p>
            </div>
            <div class="stat-card bg-white rounded-2xl p-6 text-center shadow-md border border-gray-100">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-wallet text-blue-600 text-2xl"></i>
                </div>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mt-1">Saldo Akhir</p>
            </div>
        </div>
        
        {{-- Grafik --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-10">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-emerald-500"></i> Grafik Pemasukan vs Pengeluaran {{ $tahun }}
            </h3>
            <canvas id="keuanganChart" height="100"></canvas>
        </div>
        
        {{-- Tabel Transaksi --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800">📋 Daftar Transaksi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Tanggal</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Jenis</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Deskripsi</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Jumlah</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($transaksis as $t)
                        <tr class="hover:bg-gray-50 transition cursor-pointer" onclick="window.location='{{ route('masyarakat.keuangan.show', $t->id_transaksi) }}'">
                            <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $t->jenis == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $t->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $t->kategori->nama_kategori }}</td>
                            <td class="px-6 py-4 text-sm">{{ Str::limit($t->deskripsi, 50) }}</td>
                            <td class="px-6 py-4 text-sm font-semibold {{ $t->jenis == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <i class="fa-regular fa-folder-open text-4xl mb-3 block"></i>
                                <p>Belum ada transaksi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Pagination --}}
        <div class="mt-6">
            {{ $transaksis->appends(request()->query())->links() }}
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('keuanganChart').getContext('2d');
    const grafikData = @json($grafikData);
    
    const labels = [];
    const pemasukanData = [];
    const pengeluaranData = [];
    
    Object.values(grafikData).forEach(item => {
        labels.push(item.bulan.substring(0, 3));
        pemasukanData.push(item.pemasukan);
        pengeluaranData.push(item.pengeluaran);
    });
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: pemasukanData,
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16, 185, 129, 0.1)',
                    fill: true,
                    tension: 0.4
                },
                {
                    label: 'Pengeluaran',
                    data: pengeluaranData,
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239, 68, 68, 0.1)',
                    fill: true,
                    tension: 0.4
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' + context.raw.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: {
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                }
            }
        }
    });
</script>
@endsection