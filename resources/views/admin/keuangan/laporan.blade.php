{{-- resources/views/admin/keuangan/laporan.blade.php --}}
@extends('layouts.admin')

@section('title', 'Laporan Keuangan - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --system-bg: #0a0a0a;
        --card-bg: #ffffff;
        --accent-primary: #10b981;
        --accent-yellow: #f59e0b;
        --accent-blue: #3b82f6;
        --accent-purple: #8b5cf6;
        --accent-red: #ef4444;
        --text-main: #171717;
        --text-mute: #737373;
        --border-color: #f1f1f1;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #fafafa;
        color: var(--text-main);
        letter-spacing: -0.02em;
    }

    .font-display { font-family: 'Instrument Sans', sans-serif; }

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    .dashboard-wrapper {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 2rem;
    }

    /* Editorial Header */
    .editorial-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
    }

    .brand-title {
        font-size: 3rem;
        font-weight: 800;
        line-height: 0.9;
        letter-spacing: -0.05em;
        color: var(--system-bg);
    }

    .brand-subtitle {
        font-size: 0.9rem;
        color: var(--text-mute);
        margin-top: 1rem;
        max-width: 450px;
        line-height: 1.6;
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1.2rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-mute);
        text-decoration: none;
        transition: all 0.3s;
    }

    .back-link:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateX(-4px);
    }

    /* Filter Card */
    .filter-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 1.2rem 1.5rem;
        margin-bottom: 2rem;
        transition: all 0.4s;
    }

    .filter-card:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .filter-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
    }

    .filter-label i {
        color: var(--accent-primary);
        margin-right: 0.3rem;
    }

    .filter-input {
        padding: 0.6rem 1rem;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        font-size: 0.85rem;
        transition: all 0.3s;
        background: white;
    }

    .filter-input:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px rgba(16,185,129,0.1);
    }

    .btn-filter {
        padding: 0.6rem 1.2rem;
        background: var(--system-bg);
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 0.75rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-filter:hover {
        background: var(--accent-primary);
        transform: translateY(-2px);
    }

    .btn-print {
        background: var(--accent-blue);
    }

    .btn-print:hover {
        background: #2563eb;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 1.2rem;
        transition: all 0.4s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .stat-card.pemasukan {
        border-left: 4px solid var(--accent-primary);
    }

    .stat-card.pengeluaran {
        border-left: 4px solid var(--accent-red);
    }

    .stat-card.saldo {
        border-left: 4px solid var(--accent-blue);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.2rem;
    }

    .stat-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
    }

    .stat-card.pemasukan .stat-value { color: var(--accent-primary); }
    .stat-card.pengeluaran .stat-value { color: var(--accent-red); }
    .stat-card.saldo .stat-value { color: var(--accent-blue); }

    /* Table */
    .table-architecture {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
    }

    .table-header {
        display: grid;
        grid-template-columns: 120px 110px 150px 1fr 180px;
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-mute);
    }

    .transaction-row {
        display: grid;
        grid-template-columns: 120px 110px 150px 1fr 180px;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s;
    }

    .transaction-row:hover {
        background: #fafafa;
    }

    .transaction-row:last-child {
        border-bottom: none;
    }

    /* Badge */
    .jenis-pill {
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        width: fit-content;
    }

    .jenis-pemasukan { background: #d1fae5; color: #059669; }
    .jenis-pengeluaran { background: #fee2e2; color: #dc2626; }

    /* Empty State */
    .void-container {
        padding: 4rem 0;
        text-align: center;
        border: 2px dashed #e5e5e5;
        border-radius: 40px;
    }

    /* Print Styles */
    @media print {
        .filter-card, .back-link, .btn-print, .btn-filter, .editorial-header .back-link {
            display: none !important;
        }
        body {
            background: white;
            padding: 0;
            margin: 0;
        }
        .dashboard-wrapper {
            padding: 0;
            margin: 0;
        }
        .bg-pattern {
            display: none;
        }
        .stat-card, .table-architecture {
            box-shadow: none;
            border: 1px solid #ddd;
        }
        .transaction-row:hover {
            background: none;
        }
        .stat-card:hover {
            transform: none;
        }
    }

    /* Animations */
    .fade-up {
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.2s; }

    /* Responsive */
    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1rem; }
        .stats-grid { grid-template-columns: repeat(3, 1fr); }
        .table-header, .transaction-row {
            min-width: 800px;
        }
        .table-architecture { overflow-x: auto; }
    }

    @media (max-width: 768px) {
        .editorial-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .brand-title { font-size: 2rem; }
        .stats-grid { gap: 0.75rem; }
        .stat-value { font-size: 1.2rem; }
        .filter-form { flex-direction: column; align-items: stretch; }
        .filter-group { width: 100%; }
        .btn-filter, .btn-print { width: 100%; justify-content: center; }
    }
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Header --}}
    <header class="editorial-header fade-up">
        <div>
            <h1 class="brand-title font-display">Laporan<br><span style="color: var(--accent-primary);">Keuangan Desa</span>.</h1>
            <p class="brand-subtitle">
                Laporan pemasukan dan pengeluaran desa secara transparan.
            </p>
        </div>
        <a href="{{ route('admin.keuangan.index') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Keuangan
        </a>
    </header>

    {{-- Filter Periode --}}
    <div class="filter-card fade-up delay-1">
        <form method="GET" class="filter-form">
            <div class="filter-group">
                <label class="filter-label"><i class="fa-regular fa-calendar"></i> Dari Tanggal</label>
                <input type="date" name="dari_tanggal" value="{{ $dariTanggal }}" class="filter-input">
            </div>
            <div class="filter-group">
                <label class="filter-label"><i class="fa-regular fa-calendar"></i> Sampai Tanggal</label>
                <input type="date" name="sampai_tanggal" value="{{ $sampaiTanggal }}" class="filter-input">
            </div>
            <div class="filter-group">
                <button type="submit" class="btn-filter">
                    <i class="fa-solid fa-filter"></i> Filter
                </button>
            </div>
            <div class="filter-group">
                <button type="button" onclick="window.print()" class="btn-filter btn-print">
                    <i class="fa-solid fa-print"></i> Cetak Laporan
                </button>
            </div>
        </form>
    </div>

    {{-- Ringkasan Stats --}}
    <div class="stats-grid fade-up delay-2">
        <div class="stat-card pemasukan">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-solid fa-money-bill-trend-up text-emerald-600 text-xl"></i>
            </div>
            <div class="stat-value">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pemasukan</div>
        </div>
        <div class="stat-card pengeluaran">
            <div class="stat-icon" style="background: rgba(239,68,68,0.1);">
                <i class="fa-solid fa-money-bill-trend-down text-red-600 text-xl"></i>
            </div>
            <div class="stat-value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pengeluaran</div>
        </div>
        <div class="stat-card saldo">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1);">
                <i class="fa-solid fa-wallet text-blue-600 text-xl"></i>
            </div>
            <div class="stat-value">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
            <div class="stat-label">Saldo Akhir</div>
        </div>
    </div>

    {{-- Tabel Transaksi --}}
    <div class="table-architecture fade-up delay-3">
        <div class="table-header">
            <div>Tanggal</div>
            <div>Jenis</div>
            <div>Kategori</div>
            <div>Deskripsi</div>
            <div>Jumlah</div>
        </div>

        @forelse($transaksis as $t)
        <div class="transaction-row">
            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</div>
            <div>
                <span class="jenis-pill {{ $t->jenis == 'pemasukan' ? 'jenis-pemasukan' : 'jenis-pengeluaran' }}">
                    {{ $t->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                </span>
            </div>
            <div class="text-sm text-gray-600">{{ $t->kategori->nama_kategori ?? '-' }}</div>
            <div class="text-sm text-gray-500">{{ $t->deskripsi }}</div>
            <div class="text-sm font-semibold {{ $t->jenis == 'pemasukan' ? 'text-emerald-600' : 'text-red-600' }}">
                Rp {{ number_format($t->jumlah, 0, ',', '.') }}
            </div>
        </div>
        @empty
        <div class="void-container">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-file-lines text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-400">Tidak Ada Transaksi</h3>
            <p class="text-gray-400 mt-2">Tidak ada transaksi dalam periode yang dipilih</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($transaksis, 'hasPages') && $transaksis->hasPages())
    <div class="pagination-container fade-up delay-4" style="margin-top: 1.5rem; display: flex; justify-content: center;">
        {{ $transaksis->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<style>
    .pagination-container {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 0.3rem;
        flex-wrap: wrap;
    }

    .pagination .page-link {
        padding: 0.5rem 1rem;
        border-radius: 14px;
        background: white;
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s;
        border: 1px solid #e2e8f0;
        text-decoration: none;
    }

    .pagination .active .page-link {
        background: var(--system-bg);
        color: white;
        border-color: transparent;
    }

    .pagination .page-link:hover {
        background: var(--accent-primary);
        color: white;
        transform: translateY(-2px);
    }
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection