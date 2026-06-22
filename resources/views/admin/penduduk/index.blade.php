@extends('layouts.admin')

@section('title', 'Kelola Data Penduduk - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.85);
        --glass-border: rgba(0, 0, 0, 0.06);
        --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.04);
        --accent-gradient: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        --transition: all 0.4s cubic-bezier(0.2, 0.95, 0.4, 1);
        
        --blue: #3b82f6;
        --green: #10b981;
        --purple: #8b5cf6;
        --teal: #14b8a6;
        --orange: #f59e0b;
    }

    body {
        background: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Container */
    .premium-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Header Section */
    .header-section {
        margin-bottom: 2rem;
    }

    .page-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .page-title {
        font-family: 'Instrument Serif', serif;
        font-size: 2.5rem;
        font-weight: 400;
        line-height: 1.2;
        color: #0f172a;
    }

    .page-title span {
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Add Button */
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.5rem;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 24px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
    }

    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(16,185,129,0.35);
        gap: 0.8rem;
    }

    /* Alert */
    .alert-glass {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.2rem;
        border-radius: 24px;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(16px);
        animation: slideIn 0.4s ease;
    }

    .alert-success { background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.15); }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Stats Mini Cards */
    .stats-mini {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .stat-mini-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 0.8rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: var(--transition);
        cursor: pointer;
    }

    .stat-mini-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--glass-shadow);
        background: white;
    }

    .stat-mini-icon {
        width: 40px;
        height: 40px;
        border-radius: 16px;
        background: rgba(59,130,246,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue);
    }

    .stat-mini-info h4 {
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1;
        color: #0f172a;
    }

    .stat-mini-info p {
        font-size: 0.7rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Table Container Premium */
    .table-premium {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--glass-shadow);
    }

    .table-header {
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .table-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-title i {
        font-size: 1.2rem;
        color: var(--blue);
    }

    .table-title h3 {
        font-weight: 700;
        font-size: 1rem;
        color: #1e293b;
    }

    /* Search Box */
    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        padding: 0.4rem 0.8rem;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        transition: var(--transition);
    }

    .search-box:hover {
        border-color: var(--blue);
        box-shadow: 0 2px 8px rgba(59,130,246,0.1);
    }

    .search-box input {
        border: none;
        outline: none;
        padding: 0.4rem;
        font-size: 0.8rem;
        width: 200px;
    }

    .search-box button {
        background: none;
        border: none;
        cursor: pointer;
        color: #94a3b8;
        transition: var(--transition);
    }

    .search-box button:hover {
        color: var(--blue);
    }

    /* Table Styling */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead th {
        text-align: left;
        padding: 1rem 1rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .data-table tbody tr {
        transition: var(--transition);
        cursor: pointer;
    }

    .data-table tbody tr:hover {
        background: rgba(59,130,246,0.04);
        transform: scale(1.002);
    }

    .data-table td {
        padding: 1rem 1rem;
        font-size: 0.85rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    /* NIK Style */
    .nik-code {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        background: #f1f5f9;
        padding: 0.2rem 0.5rem;
        border-radius: 10px;
        display: inline-block;
    }

    /* Avatar for Name */
    .name-cell {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.8rem;
    }

    /* Status Badge */
    .status-badge-table {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.7rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .status-kk { background: #d1fae5; color: #059669; }
    .status-istri { background: #fce7f3; color: #db2777; }
    .status-anak { background: #dbeafe; color: #2563eb; }
    .status-lain { background: #fef3c7; color: #d97706; }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.8rem;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-edit {
        background: rgba(59,130,246,0.1);
        color: #3b82f6;
    }

    .btn-edit:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: rgba(239,68,68,0.1);
        color: #ef4444;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
    }

    /* Pagination */
    .pagination-container {
        padding: 1rem 1.2rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 0.3rem;
        flex-wrap: wrap;
    }

    .pagination .page-item .page-link {
        padding: 0.5rem 1rem;
        border-radius: 14px;
        background: white;
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        transition: var(--transition);
        border: 1px solid #e2e8f0;
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: white;
        border-color: transparent;
    }

    .pagination .page-item .page-link:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        border-radius: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .premium-container { padding: 1rem; }
        .stats-mini { flex-wrap: wrap; }
        .data-table { min-width: 900px; }
        .table-premium { overflow-x: auto; }
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
</style>

<div class="premium-container">
    
    <!-- Header Section -->
    <div class="header-section fade-up">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <div class="page-badge">DATABASE KEPENDUDUKAN</div>
                <h1 class="page-title">Data <span>Penduduk</span></h1>
                <p class="text-slate-400 mt-1 text-sm">Kelola dan pantau data kependudukan Desa Lumban Silintong</p>
            </div>
            <div class="flex gap-3 flex-wrap">
                <a href="{{ route('admin.keluarga.index') }}" class="btn-add" style="background: linear-gradient(135deg, #3b82f6, #8b5cf6); box-shadow: 0 4px 12px rgba(59,130,246,0.25);">
                    <i class="fa-solid fa-house-chimney-user"></i> Lihat Data Keluarga
                </a>
                <a href="{{ route('admin.penduduk.create') }}" class="btn-add">
                    <i class="fa-solid fa-plus"></i> Tambah Data Penduduk
                </a>
            </div>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="alert-glass alert-success fade-up delay-1">
        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
            <i class="fa-solid fa-check text-sm"></i>
        </div>
        <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- ===== STATISTIK DETAIL ===== -->
    <div class="fade-up delay-2" style="margin-bottom: 2rem;">

        <!-- Row 1: Overview Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem; margin-bottom: 1.5rem;">
            <!-- Total Penduduk -->
            <div style="background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%); border-radius: 20px; padding: 1.5rem; color: white; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
                <i class="fa-solid fa-users" style="font-size: 1.5rem; margin-bottom: 0.5rem; opacity: 0.9;"></i>
                <h3 style="font-size: 2rem; font-weight: 800; margin: 0.3rem 0;">{{ number_format($totalPenduduk, 0, ',', '.') }}</h3>
                <p style="font-size: 0.8rem; opacity: 0.85; font-weight: 500;">Total Penduduk</p>
            </div>
            <!-- Laki-laki -->
            <div style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 20px; padding: 1.5rem; color: white; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
                <i class="fa-solid fa-person" style="font-size: 1.5rem; margin-bottom: 0.5rem; opacity: 0.9;"></i>
                <h3 style="font-size: 2rem; font-weight: 800; margin: 0.3rem 0;">{{ number_format($totalLaki, 0, ',', '.') }}</h3>
                <p style="font-size: 0.8rem; opacity: 0.85; font-weight: 500;">Laki-laki ({{ $totalPenduduk > 0 ? round($totalLaki/$totalPenduduk*100, 1) : 0 }}%)</p>
            </div>
            <!-- Perempuan -->
            <div style="background: linear-gradient(135deg, #ec4899 0%, #db2777 100%); border-radius: 20px; padding: 1.5rem; color: white; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
                <i class="fa-solid fa-person-dress" style="font-size: 1.5rem; margin-bottom: 0.5rem; opacity: 0.9;"></i>
                <h3 style="font-size: 2rem; font-weight: 800; margin: 0.3rem 0;">{{ number_format($totalPerempuan, 0, ',', '.') }}</h3>
                <p style="font-size: 0.8rem; opacity: 0.85; font-weight: 500;">Perempuan ({{ $totalPenduduk > 0 ? round($totalPerempuan/$totalPenduduk*100, 1) : 0 }}%)</p>
            </div>
            <!-- Kepala Keluarga -->
            <div style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 20px; padding: 1.5rem; color: white; position: relative; overflow: hidden;">
                <div style="position: absolute; top: -10px; right: -10px; width: 60px; height: 60px; background: rgba(255,255,255,0.15); border-radius: 50%;"></div>
                <i class="fa-solid fa-house-chimney" style="font-size: 1.5rem; margin-bottom: 0.5rem; opacity: 0.9;"></i>
                <h3 style="font-size: 2rem; font-weight: 800; margin: 0.3rem 0;">{{ number_format($totalKk, 0, ',', '.') }}</h3>
                <p style="font-size: 0.8rem; opacity: 0.85; font-weight: 500;">Kepala Keluarga</p>
            </div>
        </div>

        <!-- Row 2: Detailed Breakdown Cards -->
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.2rem;">

            <!-- Kelompok Usia -->
            <div style="background: var(--glass-bg); backdrop-filter: blur(16px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 1.5rem;">
                <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 32px; height: 32px; border-radius: 10px; background: rgba(99,102,241,0.1); display: inline-flex; align-items: center; justify-content: center; color: #6366f1;"><i class="fa-solid fa-cake-candles"></i></span>
                    Kelompok Usia
                </h4>
                @php $usiaData = [['label' => 'Anak (< 17th)', 'val' => $usiaAnak, 'color' => '#6366f1'], ['label' => 'Pemuda (17-30th)', 'val' => $usiaPemuda, 'color' => '#3b82f6'], ['label' => 'Dewasa (31-55th)', 'val' => $usiaDewasa, 'color' => '#10b981'], ['label' => 'Lansia (> 55th)', 'val' => $usiaLansia, 'color' => '#f59e0b']]; @endphp
                @foreach($usiaData as $u)
                <div style="margin-bottom: 0.8rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;">
                        <span style="font-size: 0.8rem; color: #475569; font-weight: 500;">{{ $u['label'] }}</span>
                        <span style="font-size: 0.8rem; font-weight: 700; color: #0f172a;">{{ $u['val'] }} <small style="color:#94a3b8;">({{ $totalPenduduk > 0 ? round($u['val']/$totalPenduduk*100, 1) : 0 }}%)</small></span>
                    </div>
                    <div style="height: 8px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $totalPenduduk > 0 ? ($u['val']/$totalPenduduk*100) : 0 }}%; background: {{ $u['color'] }}; border-radius: 10px; transition: width 1s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Agama -->
            <div style="background: var(--glass-bg); backdrop-filter: blur(16px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 1.5rem;">
                <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 32px; height: 32px; border-radius: 10px; background: rgba(16,185,129,0.1); display: inline-flex; align-items: center; justify-content: center; color: #10b981;"><i class="fa-solid fa-place-of-worship"></i></span>
                    Agama
                </h4>
                @php $agamaColors = ['Islam' => '#10b981', 'Kristen' => '#3b82f6', 'Katolik' => '#8b5cf6', 'Hindu' => '#f59e0b', 'Buddha' => '#ef4444', 'Konghucu' => '#ec4899']; @endphp
                @foreach($agamaStats as $agama => $count)
                <div style="margin-bottom: 0.8rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;">
                        <span style="font-size: 0.8rem; color: #475569; font-weight: 500;">{{ $agama }}</span>
                        <span style="font-size: 0.8rem; font-weight: 700; color: #0f172a;">{{ $count }} <small style="color:#94a3b8;">({{ $totalPenduduk > 0 ? round($count/$totalPenduduk*100, 1) : 0 }}%)</small></span>
                    </div>
                    <div style="height: 8px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $totalPenduduk > 0 ? ($count/$totalPenduduk*100) : 0 }}%; background: {{ $agamaColors[$agama] ?? '#64748b' }}; border-radius: 10px; transition: width 1s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Status Perkawinan -->
            <div style="background: var(--glass-bg); backdrop-filter: blur(16px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 1.5rem;">
                <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 32px; height: 32px; border-radius: 10px; background: rgba(236,72,153,0.1); display: inline-flex; align-items: center; justify-content: center; color: #ec4899;"><i class="fa-solid fa-heart"></i></span>
                    Status Perkawinan
                </h4>
                @php $kawinColors = ['Belum Kawin' => '#6366f1', 'Kawin' => '#10b981', 'Cerai Hidup' => '#f59e0b', 'Cerai Mati' => '#64748b']; @endphp
                @foreach($kawinStats as $status => $count)
                <div style="margin-bottom: 0.8rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;">
                        <span style="font-size: 0.8rem; color: #475569; font-weight: 500;">{{ $status }}</span>
                        <span style="font-size: 0.8rem; font-weight: 700; color: #0f172a;">{{ $count }} <small style="color:#94a3b8;">({{ $totalPenduduk > 0 ? round($count/$totalPenduduk*100, 1) : 0 }}%)</small></span>
                    </div>
                    <div style="height: 8px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $totalPenduduk > 0 ? ($count/$totalPenduduk*100) : 0 }}%; background: {{ $kawinColors[$status] ?? '#64748b' }}; border-radius: 10px; transition: width 1s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Status Keluarga -->
            <div style="background: var(--glass-bg); backdrop-filter: blur(16px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 1.5rem;">
                <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 32px; height: 32px; border-radius: 10px; background: rgba(245,158,11,0.1); display: inline-flex; align-items: center; justify-content: center; color: #f59e0b;"><i class="fa-solid fa-people-roof"></i></span>
                    Status dalam Keluarga
                </h4>
                @php $kelData = [['label' => 'Kepala Keluarga', 'val' => $totalKk, 'color' => '#f59e0b'], ['label' => 'Istri', 'val' => $totalIstri, 'color' => '#ec4899'], ['label' => 'Anak', 'val' => $totalAnak, 'color' => '#3b82f6']]; @endphp
                @foreach($kelData as $k)
                <div style="margin-bottom: 0.8rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;">
                        <span style="font-size: 0.8rem; color: #475569; font-weight: 500;">{{ $k['label'] }}</span>
                        <span style="font-size: 0.8rem; font-weight: 700; color: #0f172a;">{{ $k['val'] }} <small style="color:#94a3b8;">({{ $totalPenduduk > 0 ? round($k['val']/$totalPenduduk*100, 1) : 0 }}%)</small></span>
                    </div>
                    <div style="height: 8px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $totalPenduduk > 0 ? ($k['val']/$totalPenduduk*100) : 0 }}%; background: {{ $k['color'] }}; border-radius: 10px; transition: width 1s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pendidikan -->
            <div style="background: var(--glass-bg); backdrop-filter: blur(16px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 1.5rem;">
                <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 32px; height: 32px; border-radius: 10px; background: rgba(59,130,246,0.1); display: inline-flex; align-items: center; justify-content: center; color: #3b82f6;"><i class="fa-solid fa-graduation-cap"></i></span>
                    Tingkat Pendidikan
                </h4>
                @php $pendidikanColors = ['Tidak/Belum Sekolah' => '#94a3b8', 'Belum Tamat SD/Sederajat' => '#64748b', 'Tamat SD/Sederajat' => '#f59e0b', 'SLTP/Sederajat' => '#f97316', 'SLTA/Sederajat' => '#10b981', 'Diploma I/II' => '#06b6d4', 'Akademi/Diploma III/S.Muda' => '#3b82f6', 'Diploma IV/Strata I' => '#6366f1', 'Strata II' => '#8b5cf6', 'Strata III' => '#a855f7']; @endphp
                @foreach($pendidikanStats as $pend => $count)
                <div style="margin-bottom: 0.7rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.2rem;">
                        <span style="font-size: 0.75rem; color: #475569; font-weight: 500;">{{ $pend }}</span>
                        <span style="font-size: 0.75rem; font-weight: 700; color: #0f172a;">{{ $count }}</span>
                    </div>
                    <div style="height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $totalPenduduk > 0 ? ($count/$totalPenduduk*100) : 0 }}%; background: {{ $pendidikanColors[$pend] ?? '#64748b' }}; border-radius: 10px; transition: width 1s ease;"></div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pekerjaan -->
            <div style="background: var(--glass-bg); backdrop-filter: blur(16px); border: 1px solid var(--glass-border); border-radius: 20px; padding: 1.5rem;">
                <h4 style="font-weight: 700; color: #0f172a; margin-bottom: 1rem; display: flex; align-items: center; gap: 0.5rem;">
                    <span style="width: 32px; height: 32px; border-radius: 10px; background: rgba(139,92,246,0.1); display: inline-flex; align-items: center; justify-content: center; color: #8b5cf6;"><i class="fa-solid fa-briefcase"></i></span>
                    Pekerjaan
                </h4>
                @php $jobColors = ['#8b5cf6','#6366f1','#3b82f6','#0ea5e9','#06b6d4','#10b981','#f59e0b','#f97316','#ef4444','#ec4899','#a855f7','#64748b','#475569','#334155']; $ji = 0; @endphp
                @foreach($pekerjaanStats as $job => $count)
                <div style="margin-bottom: 0.7rem;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 0.2rem;">
                        <span style="font-size: 0.75rem; color: #475569; font-weight: 500;">{{ $job }}</span>
                        <span style="font-size: 0.75rem; font-weight: 700; color: #0f172a;">{{ $count }}</span>
                    </div>
                    <div style="height: 6px; background: #f1f5f9; border-radius: 10px; overflow: hidden;">
                        <div style="height: 100%; width: {{ $totalPenduduk > 0 ? ($count/$totalPenduduk*100) : 0 }}%; background: {{ $jobColors[$ji % count($jobColors)] }}; border-radius: 10px; transition: width 1s ease;"></div>
                    </div>
                </div>
                @php $ji++; @endphp
                @endforeach
            </div>

        </div>
    </div>

        <form action="{{ route('admin.penduduk.index') }}" method="GET" class="filter-form fade-up delay-3" style="margin-bottom: 1.5rem; background: var(--glass-bg); padding: 1.5rem; border-radius: 20px; border: 1px solid var(--glass-border);">
            <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:1rem;">
                <i class="fa-solid fa-filter text-blue-500"></i>
                <h3 style="font-weight:700; color:#1e293b;">Filter Data Penduduk</h3>
            </div>
            <div style="display:flex; flex-wrap:wrap; gap:10px;">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari NIK / Nama" style="flex:1; min-width:150px; padding:0.6rem 1rem; border-radius:12px; border:1px solid #e2e8f0; outline:none;">
                <select name="jenis_kelamin" style="flex:1; min-width:120px; padding:0.6rem 1rem; border-radius:12px; border:1px solid #e2e8f0; outline:none; background:white;">
                    <option value="">Semua JK</option>
                    <option value="L" {{ request('jenis_kelamin') == 'L' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="P" {{ request('jenis_kelamin') == 'P' ? 'selected' : '' }}>Perempuan</option>
                </select>
                <select name="usia" style="flex:1; min-width:120px; padding:0.6rem 1rem; border-radius:12px; border:1px solid #e2e8f0; outline:none; background:white;">
                    <option value="">Semua Usia</option>
                    <option value="anak" {{ request('usia') == 'anak' ? 'selected' : '' }}>Anak (&lt; 17th)</option>
                    <option value="pemuda" {{ request('usia') == 'pemuda' ? 'selected' : '' }}>Pemuda (17-30th)</option>
                    <option value="dewasa" {{ request('usia') == 'dewasa' ? 'selected' : '' }}>Dewasa (31-55th)</option>
                    <option value="lansia" {{ request('usia') == 'lansia' ? 'selected' : '' }}>Lansia (&gt; 55th)</option>
                </select>
                <select name="status_perkawinan" style="flex:1; min-width:150px; padding:0.6rem 1rem; border-radius:12px; border:1px solid #e2e8f0; outline:none; background:white;">
                    <option value="">Semua Status Kawin</option>
                    <option value="Belum Kawin" {{ request('status_perkawinan') == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                    <option value="Kawin" {{ request('status_perkawinan') == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                    <option value="Cerai Hidup" {{ request('status_perkawinan') == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                    <option value="Cerai Mati" {{ request('status_perkawinan') == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                </select>
                <select name="status_keluarga" style="flex:1; min-width:150px; padding:0.6rem 1rem; border-radius:12px; border:1px solid #e2e8f0; outline:none; background:white;">
                    <option value="">Semua Status Keluarga</option>
                    <option value="Kepala Keluarga" {{ request('status_keluarga') == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                    <option value="Istri" {{ request('status_keluarga') == 'Istri' ? 'selected' : '' }}>Istri</option>
                    <option value="Anak" {{ request('status_keluarga') == 'Anak' ? 'selected' : '' }}>Anak</option>
                </select>
                <select name="agama" style="flex:1; min-width:120px; padding:0.6rem 1rem; border-radius:12px; border:1px solid #e2e8f0; outline:none; background:white;">
                    <option value="">Semua Agama</option>
                    <option value="Islam" {{ request('agama') == 'Islam' ? 'selected' : '' }}>Islam</option>
                    <option value="Kristen" {{ request('agama') == 'Kristen' ? 'selected' : '' }}>Kristen</option>
                    <option value="Katolik" {{ request('agama') == 'Katolik' ? 'selected' : '' }}>Katolik</option>
                    <option value="Hindu" {{ request('agama') == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                    <option value="Buddha" {{ request('agama') == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                    <option value="Konghucu" {{ request('agama') == 'Konghucu' ? 'selected' : '' }}>Konghucu</option>
                </select>
                <select name="pendidikan" style="flex:1; min-width:150px; padding:0.6rem 1rem; border-radius:12px; border:1px solid #e2e8f0; outline:none; background:white;">
                    <option value="">Semua Pendidikan</option>
                    <option value="Tidak/Belum Sekolah" {{ request('pendidikan') == 'Tidak/Belum Sekolah' ? 'selected' : '' }}>Tidak/Belum Sekolah</option>
                    <option value="Belum Tamat SD/Sederajat" {{ request('pendidikan') == 'Belum Tamat SD/Sederajat' ? 'selected' : '' }}>Belum Tamat SD</option>
                    <option value="Tamat SD/Sederajat" {{ request('pendidikan') == 'Tamat SD/Sederajat' ? 'selected' : '' }}>Tamat SD</option>
                    <option value="SLTP/Sederajat" {{ request('pendidikan') == 'SLTP/Sederajat' ? 'selected' : '' }}>SLTP</option>
                    <option value="SLTA/Sederajat" {{ request('pendidikan') == 'SLTA/Sederajat' ? 'selected' : '' }}>SLTA</option>
                    <option value="Diploma I/II" {{ request('pendidikan') == 'Diploma I/II' ? 'selected' : '' }}>Diploma I/II</option>
                    <option value="Akademi/Diploma III/S.Muda" {{ request('pendidikan') == 'Akademi/Diploma III/S.Muda' ? 'selected' : '' }}>Diploma III</option>
                    <option value="Diploma IV/Strata I" {{ request('pendidikan') == 'Diploma IV/Strata I' ? 'selected' : '' }}>S1/D4</option>
                    <option value="Strata II" {{ request('pendidikan') == 'Strata II' ? 'selected' : '' }}>S2</option>
                    <option value="Strata III" {{ request('pendidikan') == 'Strata III' ? 'selected' : '' }}>S3</option>
                </select>
                <select name="pekerjaan" style="flex:1; min-width:150px; padding:0.6rem 1rem; border-radius:12px; border:1px solid #e2e8f0; outline:none; background:white;">
                    <option value="">Semua Pekerjaan</option>
                    <option value="Belum / Tidak Bekerja" {{ request('pekerjaan') == 'Belum / Tidak Bekerja' ? 'selected' : '' }}>Belum / Tidak Bekerja</option>
                    <option value="Pelajar / Mahasiswa" {{ request('pekerjaan') == 'Pelajar / Mahasiswa' ? 'selected' : '' }}>Pelajar / Mahasiswa</option>
                    <option value="Mengurus Rumah Tangga" {{ request('pekerjaan') == 'Mengurus Rumah Tangga' ? 'selected' : '' }}>Mengurus Rumah Tangga</option>
                    <option value="Petani / Pekebun" {{ request('pekerjaan') == 'Petani / Pekebun' ? 'selected' : '' }}>Petani / Pekebun</option>
                    <option value="Nelayan" {{ request('pekerjaan') == 'Nelayan' ? 'selected' : '' }}>Nelayan</option>
                    <option value="Buruh Harian Lepas" {{ request('pekerjaan') == 'Buruh Harian Lepas' ? 'selected' : '' }}>Buruh Harian Lepas</option>
                    <option value="Wiraswasta / Pedagang" {{ request('pekerjaan') == 'Wiraswasta / Pedagang' ? 'selected' : '' }}>Wiraswasta / Pedagang</option>
                    <option value="Pegawai Negeri Sipil (PNS)" {{ request('pekerjaan') == 'Pegawai Negeri Sipil (PNS)' ? 'selected' : '' }}>Pegawai Negeri Sipil (PNS)</option>
                    <option value="TNI / POLRI" {{ request('pekerjaan') == 'TNI / POLRI' ? 'selected' : '' }}>TNI / POLRI</option>
                    <option value="Karyawan Swasta" {{ request('pekerjaan') == 'Karyawan Swasta' ? 'selected' : '' }}>Karyawan Swasta</option>
                    <option value="Guru / Dosen" {{ request('pekerjaan') == 'Guru / Dosen' ? 'selected' : '' }}>Guru / Dosen</option>
                    <option value="Tenaga Medis" {{ request('pekerjaan') == 'Tenaga Medis' ? 'selected' : '' }}>Tenaga Medis</option>
                    <option value="Pensiunan" {{ request('pekerjaan') == 'Pensiunan' ? 'selected' : '' }}>Pensiunan</option>
                    <option value="Lainnya" {{ request('pekerjaan') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
                <div style="display:flex; gap:0.5rem; flex: 1; min-width: 100px;">
                    <button type="submit" style="background:#3b82f6; color:white; padding:0.6rem 1.2rem; border-radius:12px; border:none; cursor:pointer; font-weight:600; flex:1; transition: 0.3s;" onmouseover="this.style.background='#2563eb'" onmouseout="this.style.background='#3b82f6'">Terapkan</button>
                    <a href="{{ route('admin.penduduk.index') }}" style="background:#f1f5f9; color:#64748b; padding:0.6rem 1.2rem; border-radius:12px; text-decoration:none; display:inline-flex; align-items:center; justify-content:center; font-weight:600; transition: 0.3s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">Reset</a>
                </div>
            </div>
        </form>

        <!-- Table Container -->
        <div class="table-premium fade-up delay-4">
            <div class="table-header">
                <div class="table-title">
                    <i class="fa-solid fa-table-list"></i>
                    <h3>Daftar Penduduk</h3>
                </div>
            </div>

        <div class="overflow-x-auto">
            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>No KK</th>
                        <th>Nama Lengkap</th>
                        <th>JK</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduk as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration + ($penduduk->currentPage() - 1) * $penduduk->perPage() }}</td>
                        <td><span class="nik-code">{{ $item->nik }}</span></td>
                        <td><span class="nik-code" style="background: #e0f2fe; color: #0369a1;">{{ $item->no_kk ?? '-' }}</span></td>
                        <td>
                            <div class="name-cell">
                                <div class="avatar">{{ substr($item->nama_lengkap, 0, 1) }}</div>
                                <span class="font-semibold">{{ $item->nama_lengkap }}</span>
                            </div>
                        </td>
                        <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($item->alamat, 35) }}</td>
                        <td>
                            <span class="status-badge-table status-{{ strtolower(str_replace(' ', '-', $item->status_keluarga)) }}">
                                <i class="fa-regular fa-circle-user"></i>
                                {{ $item->status_keluarga }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.penduduk.show', $item->id_penduduk) }}" class="btn-action" style="background: rgba(16,185,129,0.1); color: #10b981;" title="Detail" onmouseover="this.style.background='#10b981'; this.style.color='white';" onmouseout="this.style.background='rgba(16,185,129,0.1)'; this.style.color='#10b981';">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.penduduk.edit', $item->id_penduduk) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.penduduk.destroy', $item->id_penduduk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="empty-state">
                            <div class="empty-icon">
                                <i class="fa-regular fa-folder-open text-3xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-400">Belum ada data penduduk</p>
                            <a href="{{ route('admin.penduduk.create') }}" class="inline-block mt-3 text-emerald-600 hover:text-emerald-700">+ Tambah data</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($penduduk->hasPages())
        <div class="pagination-container">
            {{ $penduduk->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    // Row hover animation
    document.querySelectorAll('.data-table tbody tr').forEach(row => {
        row.addEventListener('mouseenter', () => {
            row.style.transition = 'all 0.3s ease';
        });
    });
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection