{{-- resources/views/admin/keuangan/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Keuangan Desa - Lumban Silintong')

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
        max-width: 1440px;
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

    /* Stats Grid */
    .stats-architecture {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-node {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 1.2rem;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-node:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
        border-color: var(--accent-primary);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .stat-value {
        font-size: 2rem;
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

    /* Filter Toggle Button */
    .filter-toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        background: var(--system-bg);
        color: white;
        border: none;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
        margin-bottom: 1rem;
    }

    .filter-toggle-btn:hover {
        background: var(--accent-primary);
        transform: translateY(-2px);
    }

    .filter-toggle-btn i {
        transition: transform 0.3s;
    }

    .filter-toggle-btn.active i {
        transform: rotate(180deg);
    }

    /* Filter Panel */
    .filter-panel {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        display: none;
        transition: all 0.3s;
    }

    .filter-panel.show {
        display: block;
        animation: fadeInDown 0.4s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .filter-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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

    .filter-select {
        cursor: pointer;
        background: white;
    }

    .filter-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
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

    .btn-reset {
        padding: 0.6rem 1.2rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 14px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-mute);
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-reset:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
    }

    /* Active Filter Tags */
    .active-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .filter-tag {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.3rem 0.8rem;
        background: var(--primary-soft);
        border-radius: 40px;
        font-size: 0.7rem;
        color: var(--accent-primary-dark);
    }

    .filter-tag i {
        cursor: pointer;
        font-size: 0.6rem;
    }

    .filter-tag i:hover {
        color: var(--accent-red);
    }

    /* Chart Card */
    .chart-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        transition: all 0.4s;
    }

    .chart-card:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .chart-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .chart-title i {
        color: var(--accent-primary);
    }

    /* Alert */
    .alert-node {
        margin-bottom: 1.5rem;
        padding: 1rem 1.2rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .alert-success {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #059669;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
    }

    /* Pending Section */
    .pending-section {
        margin-bottom: 2rem;
        border-radius: 28px;
        overflow: hidden;
    }

    .pending-header {
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .pending-header h3 {
        font-size: 0.9rem;
        font-weight: 700;
        color: #d97706;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Table Architecture */
    .table-architecture {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
    }

    .table-header {
        display: grid;
        grid-template-columns: 100px 110px 150px 1fr 150px 120px 100px;
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
        grid-template-columns: 100px 110px 150px 1fr 150px 120px 100px;
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

    /* Badge Jenis */
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

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
    }

    .status-disetujui { background: #d1fae5; color: #059669; }
    .status-pending { background: #fef3c7; color: #d97706; }
    .status-ditolak { background: #fee2e2; color: #dc2626; }

    /* Action Buttons */
    .action-deck {
        display: flex;
        gap: 0.5rem;
        opacity: 0.6;
        transition: all 0.3s;
    }

    .transaction-row:hover .action-deck {
        opacity: 1;
    }

    .deck-btn {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
        color: var(--text-mute);
        background: white;
        cursor: pointer;
        text-decoration: none;
    }

    .deck-btn:hover {
        background: var(--system-bg);
        color: white;
        border-color: var(--system-bg);
    }

    .btn-edit:hover { background: var(--accent-blue); border-color: var(--accent-blue); }
    .btn-delete:hover { background: var(--accent-red); border-color: var(--accent-red); }

    /* Empty State */
    .void-container {
        padding: 4rem 0;
        text-align: center;
        border: 2px dashed #e5e5e5;
        border-radius: 40px;
    }

    /* Pagination */
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

    /* Modal */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .modal-container {
        background: white;
        border-radius: 32px;
        max-width: 500px;
        width: 90%;
        animation: modalSlide 0.3s ease;
        overflow: hidden;
    }

    @keyframes modalSlide {
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .table-header, .transaction-row {
            min-width: 1000px;
        }
        .table-architecture { overflow-x: auto; }
    }

    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1rem; }
        .stats-architecture { grid-template-columns: repeat(2, 1fr); }
        .filter-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 640px) {
        .stats-architecture { grid-template-columns: 1fr; }
        .editorial-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .brand-title { font-size: 2rem; }
        .filter-grid { grid-template-columns: 1fr; }
        .filter-actions { grid-column: span 1; }
    }

    .fade-up {
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Header --}}
    <header class="editorial-header fade-up">
        <div>
            <h1 class="brand-title font-display">Kelola<br><span style="color: var(--accent-primary);">Keuangan Desa</span>.</h1>
            <p class="brand-subtitle">
                Kelola pemasukan dan pengeluaran desa secara transparan dan presisi.
            </p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('admin.keuangan.kategori') }}" class="filter-pill" style="padding: 0.5rem 1.2rem; border-radius: 40px; background: white; border: 1px solid var(--border-color); text-decoration: none; font-size: 0.75rem; font-weight: 700; color: var(--text-mute);">
                <i class="fa-solid fa-tags"></i> Kategori
            </a>
            <a href="{{ route('admin.keuangan.laporan') }}" class="filter-pill" style="padding: 0.5rem 1.2rem; border-radius: 40px; background: white; border: 1px solid var(--border-color); text-decoration: none; font-size: 0.75rem; font-weight: 700; color: var(--text-mute);">
                <i class="fa-solid fa-print"></i> Laporan
            </a>
            <a href="{{ route('admin.keuangan.create') }}" class="filter-pill active" style="padding: 0.5rem 1.2rem; border-radius: 40px; background: var(--system-bg); color: white; border-color: var(--system-bg); text-decoration: none; font-size: 0.75rem; font-weight: 700;">
                <i class="fa-solid fa-plus"></i> Tambah
            </a>
        </div>
    </header>

    {{-- Statistics --}}
    <div class="stats-architecture fade-up" style="animation-delay: 0.05s">
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);"><i class="fa-solid fa-money-bill-trend-up text-emerald-600 text-xl"></i></div>
            <div class="stat-value">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pemasukan</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(239,68,68,0.1);"><i class="fa-solid fa-money-bill-trend-down text-red-600 text-xl"></i></div>
            <div class="stat-value">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pengeluaran</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1);"><i class="fa-solid fa-wallet text-blue-600 text-xl"></i></div>
            <div class="stat-value">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
            <div class="stat-label">Saldo Akhir</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(139,92,246,0.1);"><i class="fa-solid fa-chart-line text-purple-600 text-xl"></i></div>
            <div class="stat-value">{{ number_format($totalPemasukan > 0 ? ($totalPengeluaran / $totalPemasukan) * 100 : 0, 1) }}%</div>
            <div class="stat-label">Rasio Pengeluaran</div>
        </div>
    </div>

    {{-- Filter Toggle Button --}}
    <div class="fade-up" style="animation-delay: 0.1s">
        <button class="filter-toggle-btn" id="filterToggleBtn">
            <i class="fa-solid fa-sliders-h"></i> Filter Data
            <i class="fa-solid fa-chevron-down"></i>
        </button>
    </div>

    {{-- Filter Panel (Hidden by default) --}}
    <div class="filter-panel" id="filterPanel">
        <form method="GET" action="{{ route('admin.keuangan.index') }}" id="filterForm">
            <div class="filter-grid">
                <div class="filter-group">
                    <label class="filter-label"><i class="fa-regular fa-calendar"></i> Dari Tanggal</label>
                    <input type="date" name="dari_tanggal" value="{{ request('dari_tanggal') }}" class="filter-input">
                </div>
                <div class="filter-group">
                    <label class="filter-label"><i class="fa-regular fa-calendar"></i> Sampai Tanggal</label>
                    <input type="date" name="sampai_tanggal" value="{{ request('sampai_tanggal') }}" class="filter-input">
                </div>
                <div class="filter-group">
                    <label class="filter-label"><i class="fa-regular fa-calendar-alt"></i> Bulan</label>
                    <select name="bulan" class="filter-input filter-select">
                        <option value="">Semua Bulan</option>
                        @foreach(['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'] as $index => $bulan)
                            <option value="{{ $index+1 }}" {{ request('bulan') == $index+1 ? 'selected' : '' }}>{{ $bulan }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label"><i class="fa-regular fa-calendar-alt"></i> Tahun</label>
                    <select name="tahun" class="filter-input filter-select">
                        <option value="">Semua Tahun</option>
                        @for($i = date('Y'); $i >= date('Y')-5; $i--)
                            <option value="{{ $i }}" {{ request('tahun') == $i ? 'selected' : '' }}>{{ $i }}</option>
                        @endfor
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label"><i class="fa-solid fa-tag"></i> Jenis</label>
                    <select name="jenis" class="filter-input filter-select">
                        <option value="">Semua Jenis</option>
                        <option value="pemasukan" {{ request('jenis') == 'pemasukan' ? 'selected' : '' }}>💰 Pemasukan</option>
                        <option value="pengeluaran" {{ request('jenis') == 'pengeluaran' ? 'selected' : '' }}>💸 Pengeluaran</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label"><i class="fa-solid fa-folder"></i> Kategori</label>
                    <select name="kategori" class="filter-input filter-select">
                        <option value="">Semua Kategori</option>
                        @if(isset($kategoris) && $kategoris->count() > 0)
                            @foreach($kategoris as $kat)
                                <option value="{{ $kat->id_kategori }}" {{ request('kategori') == $kat->id_kategori ? 'selected' : '' }}>{{ $kat->nama_kategori }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="filter-group filter-actions">
                    <button type="submit" class="btn-filter"><i class="fa-solid fa-filter"></i> Terapkan Filter</button>
                    <a href="{{ route('admin.keuangan.index') }}" class="btn-reset"><i class="fa-solid fa-rotate-right"></i> Reset</a>
                </div>
            </div>
        </form>
    </div>

    {{-- Active Filters Tags --}}
    @if(request('dari_tanggal') || request('sampai_tanggal') || request('bulan') || request('tahun') || request('jenis') || request('kategori'))
    <div class="active-filters fade-up" style="animation-delay: 0.12s">
        <span class="filter-tag"><i class="fa-solid fa-filter"></i> Filter Aktif:</span>
        @if(request('dari_tanggal'))<span class="filter-tag">Dari: {{ request('dari_tanggal') }} <i class="fa-solid fa-xmark" onclick="removeFilter('dari_tanggal')"></i></span>@endif
        @if(request('sampai_tanggal'))<span class="filter-tag">Sampai: {{ request('sampai_tanggal') }} <i class="fa-solid fa-xmark" onclick="removeFilter('sampai_tanggal')"></i></span>@endif
        @if(request('bulan'))<span class="filter-tag">Bulan: {{ request('bulan') }} <i class="fa-solid fa-xmark" onclick="removeFilter('bulan')"></i></span>@endif
        @if(request('tahun'))<span class="filter-tag">Tahun: {{ request('tahun') }} <i class="fa-solid fa-xmark" onclick="removeFilter('tahun')"></i></span>@endif
        @if(request('jenis'))<span class="filter-tag">Jenis: {{ request('jenis') == 'pemasukan' ? 'Pemasukan' : 'Pengeluaran' }} <i class="fa-solid fa-xmark" onclick="removeFilter('jenis')"></i></span>@endif
        @if(request('kategori'))
            @php
                $kategoriNama = '';
                if(isset($kategoris)) {
                    $kat = $kategoris->firstWhere('id_kategori', request('kategori'));
                    $kategoriNama = $kat ? $kat->nama_kategori : '';
                }
            @endphp
            <span class="filter-tag">Kategori: {{ $kategoriNama }} <i class="fa-solid fa-xmark" onclick="removeFilter('kategori')"></i></span>
        @endif
    </div>
    @endif

    {{-- Chart --}}
    <div class="chart-card fade-up" style="animation-delay: 0.15s">
        <div class="chart-title">
            <i class="fa-solid fa-chart-line"></i>
            <span>Grafik Pemasukan vs Pengeluaran {{ request('tahun') ?: date('Y') }}</span>
        </div>
        <canvas id="keuanganChart" height="80"></canvas>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert-node alert-success fade-up" style="animation-delay: 0.2s">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check"></i><span>{{ session('success') }}</span></div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
    </div>
    @endif

    {{-- Pending Transactions --}}
    @if(isset($transaksiPending) && $transaksiPending->count() > 0)
    <div class="pending-section fade-up" style="animation-delay: 0.25s">
        <div class="pending-header">
            <h3><i class="fa-solid fa-clock"></i> Menunggu Persetujuan ({{ $transaksiPending->count() }})</h3>
            <i class="fa-solid fa-hourglass-half text-amber-600"></i>
        </div>
        <div class="table-architecture" style="border-radius: 0 0 28px 28px;">
            <div class="table-header">
                <div>Tanggal</div><div>Jenis</div><div>Kategori</div><div>Deskripsi</div><div>Jumlah</div><div>Pengaju</div><div>Aksi</div>
            </div>
            @foreach($transaksiPending as $t)
            <div class="transaction-row">
                <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d M Y') }}</div>
                <div><span class="jenis-pill {{ $t->jenis == 'pemasukan' ? 'jenis-pemasukan' : 'jenis-pengeluaran' }}">{{ $t->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}</span></div>
                <div class="text-sm text-gray-600">{{ $t->kategori->nama_kategori ?? '-' }}</div>
                <div class="text-sm text-gray-500">{{ Str::limit($t->deskripsi, 35) }}</div>
                <div class="text-sm font-semibold {{ $t->jenis == 'pemasukan' ? 'text-emerald-600' : 'text-red-600' }}">Rp {{ number_format($t->jumlah, 0, ',', '.') }}</div>
                <div class="text-sm text-gray-500">{{ $t->creator->name ?? '-' }}</div>
                <div class="action-deck">
                    <button onclick="openApproveModal({{ $t->id_transaksi }}, '{{ addslashes($t->deskripsi) }}')" class="deck-btn" style="background: #10b981; color: white; border-color: #10b981;" title="Setujui"><i class="fa-solid fa-check"></i></button>
                    <button onclick="openRejectModal({{ $t->id_transaksi }}, '{{ addslashes($t->deskripsi) }}')" class="deck-btn" style="background: #ef4444; color: white; border-color: #ef4444;" title="Tolak"><i class="fa-solid fa-times"></i></button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Transactions Table --}}
    <div class="table-architecture fade-up" style="animation-delay: 0.3s">
        <div class="table-header">
            <div>Tanggal</div><div>Jenis</div><div>Kategori</div><div>Deskripsi</div><div>Jumlah</div><div>Status</div><div>Aksi</div>
        </div>
        @forelse($transaksiTerbaru as $t)
        <div class="transaction-row">
            <div class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d M Y') }}</div>
            <div><span class="jenis-pill {{ $t->jenis == 'pemasukan' ? 'jenis-pemasukan' : 'jenis-pengeluaran' }}">{{ $t->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}</span></div>
            <div class="text-sm text-gray-600">{{ $t->kategori->nama_kategori ?? '-' }}</div>
            <div class="text-sm text-gray-500">{{ Str::limit($t->deskripsi, 40) }}</div>
            <div class="text-sm font-semibold {{ $t->jenis == 'pemasukan' ? 'text-emerald-600' : 'text-red-600' }}">Rp {{ number_format($t->jumlah, 0, ',', '.') }}</div>
            <div><span class="status-badge status-{{ $t->status }}">@if($t->status == 'disetujui') <i class="fa-regular fa-circle-check"></i> Disetujui @elseif($t->status == 'pending') <i class="fa-regular fa-clock"></i> Pending @else <i class="fa-solid fa-ban"></i> Ditolak @endif</span></div>
            <div class="action-deck">
                <a href="{{ route('admin.keuangan.edit', $t->id_transaksi) }}" class="deck-btn btn-edit" title="Edit"><i class="fa-solid fa-pen"></i></a>
                <form action="{{ route('admin.keuangan.destroy', $t->id_transaksi) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">@csrf @method('DELETE')<button type="submit" class="deck-btn btn-delete" title="Hapus"><i class="fa-solid fa-trash"></i></button></form>
            </div>
        </div>
        @empty
        <div class="void-container">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4"><i class="fa-regular fa-file-lines text-3xl text-gray-400"></i></div>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada Transaksi</h3>
            <p class="text-gray-400 mt-2">Silakan tambah transaksi keuangan desa</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if(method_exists($transaksiTerbaru, 'hasPages') && $transaksiTerbaru->hasPages())
    <div class="pagination-container">{{ $transaksiTerbaru->appends(request()->query())->links() }}</div>
    @endif
</div>

{{-- Modal Approve --}}
<div id="approveModal" class="modal-overlay"><div class="modal-container"><div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4"><div class="flex items-center justify-between"><h3 class="text-xl font-bold text-white"><i class="fa-solid fa-check-circle mr-2"></i> Setujui Transaksi</h3><button onclick="closeApproveModal()" class="text-white/80 hover:text-white"><i class="fa-solid fa-times text-xl"></i></button></div></div><form id="approveForm" method="POST" class="p-6">@csrf<p class="text-gray-600 mb-3">Apakah Anda yakin ingin menyetujui transaksi ini?</p><p class="text-sm text-gray-500 mb-5" id="approveDeskripsi"></p><div class="flex gap-3 justify-end"><button type="button" onclick="closeApproveModal()" class="px-4 py-2 border border-gray-300 rounded-xl text-sm font-semibold hover:bg-gray-50">Batal</button><button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700">Ya, Setujui</button></div></form></div></div>

{{-- Modal Reject --}}
<div id="rejectModal" class="modal-overlay"><div class="modal-container"><div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4"><div class="flex items-center justify-between"><h3 class="text-xl font-bold text-white"><i class="fa-solid fa-times-circle mr-2"></i> Tolak Transaksi</h3><button onclick="closeRejectModal()" class="text-white/80 hover:text-white"><i class="fa-solid fa-times text-xl"></i></button></div></div><form id="rejectForm" method="POST" class="p-6">@csrf<p class="text-gray-600 mb-3" id="rejectDeskripsi"></p><div class="mb-4"><label class="block text-sm font-semibold text-gray-700 mb-2">Catatan Penolakan</label><textarea name="catatan" rows="3" required class="w-full px-3 py-2 border border-gray-200 rounded-xl focus:border-red-500 focus:ring-2 focus:ring-red-200 transition"></textarea></div><div class="flex gap-3 justify-end"><button type="button" onclick="closeRejectModal()" class="px-4 py-2 border border-gray-300 rounded-xl text-sm font-semibold hover:bg-gray-50">Batal</button><button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl text-sm font-semibold hover:bg-red-700">Ya, Tolak</button></div></form></div></div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart
    const ctx = document.getElementById('keuanganChart').getContext('2d');
    const chartData = @json($dataPerBulan);
    const labels = []; const pemasukanData = []; const pengeluaranData = [];
    Object.values(chartData).forEach(item => { labels.push(item.bulan.substring(0, 3)); pemasukanData.push(item.pemasukan); pengeluaranData.push(item.pengeluaran); });
    new Chart(ctx, { type: 'line', data: { labels: labels, datasets: [{ label: 'Pemasukan', data: pemasukanData, borderColor: '#10b981', backgroundColor: 'rgba(16, 185, 129, 0.05)', fill: true, tension: 0.4, borderWidth: 2 }, { label: 'Pengeluaran', data: pengeluaranData, borderColor: '#ef4444', backgroundColor: 'rgba(239, 68, 68, 0.05)', fill: true, tension: 0.4, borderWidth: 2 }] }, options: { responsive: true, maintainAspectRatio: true, plugins: { tooltip: { callbacks: { label: function(context) { return context.dataset.label + ': Rp ' + context.raw.toLocaleString('id-ID'); } } }, legend: { position: 'top' } }, scales: { y: { ticks: { callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); } } } } } });
    
    // Filter Toggle
    const toggleBtn = document.getElementById('filterToggleBtn');
    const filterPanel = document.getElementById('filterPanel');
    
    if (toggleBtn && filterPanel) {
        toggleBtn.addEventListener('click', function() {
            filterPanel.classList.toggle('show');
            this.classList.toggle('active');
        });
        
        // If there are active filters, show panel by default
        @if(request('dari_tanggal') || request('sampai_tanggal') || request('bulan') || request('tahun') || request('jenis') || request('kategori'))
            filterPanel.classList.add('show');
            toggleBtn.classList.add('active');
        @endif
    }
    
    // Remove filter function
    function removeFilter(param) {
        const url = new URL(window.location.href);
        url.searchParams.delete(param);
        window.location.href = url.toString();
    }
    
    // Modal functions
    function openApproveModal(id, deskripsi) { document.getElementById('approveForm').action = '/admin/keuangan/' + id + '/approve'; document.getElementById('approveDeskripsi').innerHTML = '<strong>' + deskripsi + '</strong>'; document.getElementById('approveModal').style.display = 'flex'; document.body.style.overflow = 'hidden'; }
    function closeApproveModal() { document.getElementById('approveModal').style.display = 'none'; document.body.style.overflow = 'auto'; }
    function openRejectModal(id, deskripsi) { document.getElementById('rejectForm').action = '/admin/keuangan/' + id + '/reject'; document.getElementById('rejectDeskripsi').innerHTML = 'Tolak transaksi: <strong>' + deskripsi + '</strong>'; document.getElementById('rejectModal').style.display = 'flex'; document.body.style.overflow = 'hidden'; }
    function closeRejectModal() { document.getElementById('rejectModal').style.display = 'none'; document.body.style.overflow = 'auto'; }
    
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') { closeApproveModal(); closeRejectModal(); } });
    window.onclick = function(event) { if (event.target.classList.contains('modal-overlay')) { closeApproveModal(); closeRejectModal(); } }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection