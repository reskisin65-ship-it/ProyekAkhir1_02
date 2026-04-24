{{-- resources/views/admin/keuangan/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Keuangan Desa - Admin')

@section('content')
<style>
    .stat-card {
        transition: all 0.3s ease;
    }
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
    }
    .pending-card {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border-left: 4px solid #d97706;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-serif italic text-emerald-800">💰 Keuangan Desa</h1>
                <p class="text-gray-500 mt-1">Kelola pemasukan dan pengeluaran desa secara transparan</p>
            </div>
            <div class="flex gap-3">
                <a href="{{ route('admin.keuangan.create') }}" 
                   class="px-5 py-2.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:shadow-lg transition flex items-center gap-2">
                    <i class="fa-solid fa-plus"></i> Tambah Transaksi
                </a>
                <a href="{{ route('admin.keuangan.kategori') }}" 
                   class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fa-solid fa-tags"></i> Kategori
                </a>
                <a href="{{ route('admin.keuangan.laporan') }}" 
                   class="px-5 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl hover:bg-gray-50 transition flex items-center gap-2">
                    <i class="fa-solid fa-print"></i> Laporan
                </a>
            </div>
        </div>
        
        {{-- Filter Tahun --}}
        <div class="mb-6 flex justify-end">
            <form method="GET" class="flex gap-2">
                <select name="tahun" class="px-4 py-2 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200">
                    @for($i = date('Y'); $i >= date('Y')-5; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-xl hover:bg-emerald-600 transition">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
            </form>
        </div>
        
        {{-- Statistik Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="stat-card bg-white rounded-2xl p-6 shadow-md border border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-money-bill-trend-up text-emerald-600 text-xl"></i>
                    </div>
                    <span class="text-xs text-gray-400">Tahun {{ $tahun }}</span>
                </div>
                <p class="text-2xl font-bold text-emerald-700">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mt-1">Total Pemasukan</p>
            </div>
            
            <div class="stat-card bg-white rounded-2xl p-6 shadow-md border border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-red-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-money-bill-trend-down text-red-600 text-xl"></i>
                    </div>
                    <span class="text-xs text-gray-400">Tahun {{ $tahun }}</span>
                </div>
                <p class="text-2xl font-bold text-red-600">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mt-1">Total Pengeluaran</p>
            </div>
            
            <div class="stat-card bg-white rounded-2xl p-6 shadow-md border border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-wallet text-blue-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($saldo, 0, ',', '.') }}</p>
                <p class="text-sm text-gray-500 mt-1">Saldo Akhir</p>
            </div>
            
            <div class="stat-card bg-white rounded-2xl p-6 shadow-md border border-gray-100">
                <div class="flex items-center justify-between mb-3">
                    <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-chart-line text-purple-600 text-xl"></i>
                    </div>
                </div>
                <p class="text-2xl font-bold text-purple-600">{{ number_format($totalPemasukan > 0 ? ($totalPengeluaran / $totalPemasukan) * 100 : 0, 1) }}%</p>
                <p class="text-sm text-gray-500 mt-1">Rasio Pengeluaran</p>
            </div>
        </div>
        
        {{-- Grafik Pemasukan vs Pengeluaran --}}
        <div class="bg-white rounded-2xl shadow-xl p-6 mb-8">
            <h3 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-chart-line text-emerald-500"></i> Grafik Pemasukan vs Pengeluaran {{ $tahun }}
            </h3>
            <canvas id="keuanganChart" height="100"></canvas>
        </div>
        
        {{-- Transaksi Pending --}}
        @if($transaksiPending->count() > 0)
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-amber-50 to-white px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-amber-700 flex items-center gap-2">
                    <i class="fa-solid fa-clock"></i> Menunggu Persetujuan ({{ $transaksiPending->count() }})
                </h3>
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Pengaju</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transaksiPending as $t)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $t->jenis == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $t->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $t->kategori->nama_kategori }}</td>
                            <td class="px-6 py-4 text-sm">{{ Str::limit($t->deskripsi, 40) }}</td>
                            <td class="px-6 py-4 text-sm font-semibold {{ $t->jenis == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $t->creator->name }}</td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <button onclick="openApproveModal({{ $t->id_transaksi }}, '{{ addslashes($t->deskripsi) }}')" 
                                            class="px-3 py-1.5 bg-green-500 text-white rounded-lg text-xs hover:bg-green-600 transition">
                                        <i class="fa-solid fa-check"></i> Setuju
                                    </button>
                                    <button onclick="openRejectModal({{ $t->id_transaksi }}, '{{ addslashes($t->deskripsi) }}')" 
                                            class="px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs hover:bg-red-600 transition">
                                        <i class="fa-solid fa-times"></i> Tolak
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        
        {{-- Transaksi Terbaru --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-4 border-b border-gray-100">
                <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                    <i class="fa-solid fa-list-ul"></i> Transaksi Terbaru
                </h3>
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
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($transaksiTerbaru as $t)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 text-sm">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d M Y') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold {{ $t->jenis == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                    {{ $t->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $t->kategori->nama_kategori }}</td>
                            <td class="px-6 py-4 text-sm">{{ Str::limit($t->deskripsi, 40) }}</td>
                            <td class="px-6 py-4 text-sm font-semibold {{ $t->jenis == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                                Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($t->status == 'disetujui') bg-green-100 text-green-700
                                    @elseif($t->status == 'pending') bg-yellow-100 text-yellow-700
                                    @else bg-red-100 text-red-700 @endif">
                                    {{ $t->status == 'disetujui' ? '✅ Disetujui' : ($t->status == 'pending' ? '⏳ Pending' : '❌ Ditolak') }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex gap-2">
                                    <a href="{{ route('admin.keuangan.edit', $t->id_transaksi) }}" class="text-blue-600 hover:text-blue-700">
                                        <i class="fa-solid fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.keuangan.destroy', $t->id_transaksi) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-700">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Approve --}}
<div id="approveModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black/50" onclick="closeApproveModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="bg-gradient-to-r from-green-500 to-green-600 px-6 py-4 rounded-t-2xl">
                <h3 class="text-xl font-bold text-white">✅ Setujui Transaksi</h3>
            </div>
            <form id="approveForm" method="POST" class="p-6">
                @csrf
                <p class="text-gray-600 mb-4">Apakah Anda yakin ingin menyetujui transaksi ini?</p>
                <p class="text-sm text-gray-500 mb-4" id="approveDeskripsi"></p>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeApproveModal()" class="px-4 py-2 border border-gray-300 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">Ya, Setujui</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Reject --}}
<div id="rejectModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black/50" onclick="closeRejectModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="bg-gradient-to-r from-red-500 to-red-600 px-6 py-4 rounded-t-2xl">
                <h3 class="text-xl font-bold text-white">❌ Tolak Transaksi</h3>
            </div>
            <form id="rejectForm" method="POST" class="p-6">
                @csrf
                <p class="text-gray-600 mb-4" id="rejectDeskripsi"></p>
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Penolakan</label>
                    <textarea name="catatan" rows="3" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:border-red-500 focus:ring-2 focus:ring-red-200"></textarea>
                </div>
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border border-gray-300 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600">Ya, Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Grafik
    const ctx = document.getElementById('keuanganChart').getContext('2d');
    const chartData = @json($dataPerBulan);
    
    const labels = [];
    const pemasukanData = [];
    const pengeluaranData = [];
    
    Object.values(chartData).forEach(item => {
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
    
    function openApproveModal(id, deskripsi) {
        const modal = document.getElementById('approveModal');
        const form = document.getElementById('approveForm');
        const deskripsiEl = document.getElementById('approveDeskripsi');
        
        deskripsiEl.innerHTML = '<strong>' + deskripsi + '</strong>';
        form.action = '/admin/keuangan/' + id + '/approve';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeApproveModal() {
        document.getElementById('approveModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    function openRejectModal(id, deskripsi) {
        const modal = document.getElementById('rejectModal');
        const form = document.getElementById('rejectForm');
        const deskripsiEl = document.getElementById('rejectDeskripsi');
        
        deskripsiEl.innerHTML = 'Tolak transaksi: <strong>' + deskripsi + '</strong>';
        form.action = '/admin/keuangan/' + id + '/reject';
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection