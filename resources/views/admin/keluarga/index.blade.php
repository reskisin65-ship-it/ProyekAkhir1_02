@extends('layouts.admin')

@section('title', 'Kelola Data Keluarga - Lumban Silintong')

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

    /* Search Box */
    .search-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        padding: 0.4rem 0.8rem;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        transition: var(--transition);
        width: 100%;
        max-width: 450px;
    }

    .search-box:hover, .search-box:focus-within {
        border-color: var(--blue);
        box-shadow: 0 4px 12px rgba(59,130,246,0.1);
    }

    .search-box input {
        border: none;
        outline: none;
        padding: 0.4rem;
        font-size: 0.85rem;
        width: 100%;
        color: #334155;
    }

    .search-box button {
        background: none;
        border: none;
        cursor: pointer;
        color: #94a3b8;
        transition: var(--transition);
        padding: 0.2rem;
    }

    .search-box button:hover {
        color: var(--blue);
    }

    /* Family Grid */
    .family-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.2rem;
    }

    @media (max-width: 1200px) {
        .family-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 768px) {
        .family-grid { grid-template-columns: 1fr; }
    }

    /* Family Card Premium */
    .family-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--glass-shadow);
        transition: var(--transition);
        display: flex;
        flex-direction: column;
    }

    .family-card:hover {
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.07);
        border-color: rgba(59,130,246,0.2);
        transform: translateY(-3px);
    }

    .family-header {
        padding: 0.8rem 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        background: rgba(248, 250, 252, 0.5);
    }

    .family-title-area {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .family-icon {
        width: 36px;
        height: 36px;
        min-width: 36px;
        border-radius: 12px;
        background: linear-gradient(135deg, rgba(59,130,246,0.1), rgba(139,92,246,0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue);
        font-size: 0.9rem;
    }

    .family-title h3 {
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 0.85rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
        line-height: 1.3;
    }

    .family-meta {
        font-size: 0.65rem;
        color: #94a3b8;
        margin-top: 0.15rem;
        line-height: 1.4;
    }

    .family-meta span.kk-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.6rem;
        background: #e0f2fe;
        color: #0369a1;
        padding: 0.1rem 0.35rem;
        border-radius: 4px;
        font-weight: 600;
    }

    .member-count-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
        font-size: 0.6rem;
        background: #f0fdf4;
        color: #16a34a;
        padding: 0.1rem 0.4rem;
        border-radius: 4px;
        font-weight: 700;
        margin-left: 0.3rem;
    }

    /* Table Styling */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead th {
        text-align: left;
        padding: 0.45rem 0.6rem;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        color: #94a3b8;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .data-table tbody tr {
        transition: var(--transition);
    }

    .data-table tbody tr:hover {
        background: rgba(59,130,246,0.03);
    }

    .data-table td {
        padding: 0.4rem 0.6rem;
        font-size: 0.72rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    /* NIK Badge */
    .nik-code {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.6rem;
        background: #f1f5f9;
        padding: 0.15rem 0.35rem;
        border-radius: 6px;
        display: inline-block;
    }

    /* Status Badge */
    .status-badge-table {
        display: inline-flex;
        align-items: center;
        gap: 0.2rem;
        padding: 0.15rem 0.45rem;
        border-radius: 12px;
        font-size: 0.58rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-kepala-keluarga { background: #d1fae5; color: #059669; }
    .status-istri { background: #fce7f3; color: #db2777; }
    .status-anak { background: #dbeafe; color: #2563eb; }
    .status-anggota-keluarga { background: #fef3c7; color: #d97706; }
    .status-lainnya { background: #f1f5f9; color: #64748b; }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-action {
        width: 24px;
        height: 24px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
        font-size: 0.6rem;
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
        margin-top: 2rem;
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
        background: var(--glass-bg);
        border: 1px dashed var(--glass-border);
        border-radius: 28px;
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        border-radius: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: #64748b;
        font-size: 2rem;
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
</style>

<div class="premium-container">
    
    <!-- Back Button -->
    <a href="{{ route('admin.penduduk.index') }}" style="display:inline-flex;align-items:center;gap:0.6rem;padding:0.6rem 1.2rem;background:rgba(255,255,255,0.85);backdrop-filter:blur(16px);border:1px solid rgba(0,0,0,0.06);border-radius:24px;color:#1e293b;font-size:0.85rem;font-weight:600;transition:var(--transition);margin-bottom:1.5rem;text-decoration:none;" class="fade-up"
        onmouseover="this.style.transform='translateX(-6px)';this.style.borderColor='#3b82f6';this.style.boxShadow='0 8px 20px rgba(59,130,246,0.1)'"
        onmouseout="this.style.transform='';this.style.borderColor='rgba(0,0,0,0.06)';this.style.boxShadow=''">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Data Penduduk
    </a>

    <!-- Header Section -->
    <div class="header-section fade-up delay-1">
        <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:1rem;">
            <div>
                <div class="page-badge">PENGELOMPOKAN KELUARGA</div>
                <h1 class="page-title">Data <span>Keluarga</span></h1>
                <p class="text-slate-400 mt-1 text-sm">Daftar penduduk yang dikelompokkan berdasarkan Nomor Kartu Keluarga (KK)</p>
            </div>
            <a href="{{ route('admin.penduduk.create') }}" style="display:inline-flex;align-items:center;gap:0.6rem;padding:0.8rem 1.5rem;background:linear-gradient(135deg,#10b981,#059669);color:white;border-radius:24px;font-weight:700;font-size:0.85rem;text-decoration:none;transition:var(--transition);box-shadow:0 4px 12px rgba(16,185,129,0.25);"
                onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 10px 25px rgba(16,185,129,0.35)'"
                onmouseout="this.style.transform='';this.style.boxShadow='0 4px 12px rgba(16,185,129,0.25)'">
                <i class="fa-solid fa-plus"></i> Tambah Data Penduduk
            </a>
        </div>
    </div>

    <!-- Search Section -->
    <div class="search-row fade-up delay-1">
        <form action="{{ route('admin.keluarga.index') }}" method="GET" class="search-box">
            <i class="fa-solid fa-search"></i>
            <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama, NIK, No KK, atau alamat...">
            <button type="submit"><i class="fa-solid fa-arrow-right"></i></button>
        </form>
        
        <div>
            @if($search)
                <a href="{{ route('admin.keluarga.index') }}" class="text-xs text-slate-500 hover:text-blue-500 flex items-center gap-1">
                    <i class="fa-solid fa-xmark"></i> Bersihkan Pencarian
                </a>
            @endif
        </div>
    </div>

    <!-- Family Tables -->
    <div class="family-grid fade-up delay-2">
        @forelse($families as $family)
            <div class="family-card">
                <!-- Card Header -->
                <div class="family-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="family-title-area">
                        <div class="family-icon">
                            <i class="fa-solid fa-house-chimney-user"></i>
                        </div>
                        <div class="family-title">
                            <h3>Keluarga {{ $family['head_name'] }}</h3>
                            <div class="family-meta">
                                <span class="kk-badge">{{ $family['no_kk'] }}</span>
                                <span class="member-count-badge"><i class="fa-solid fa-users"></i> {{ count($family['members']) }}</span>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('admin.keluarga.show', $family['no_kk']) }}" class="btn-detail" style="font-size: 0.7rem; color: #3b82f6; background: rgba(59,130,246,0.1); padding: 0.3rem 0.6rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s;" onmouseover="this.style.background='#3b82f6'; this.style.color='white';" onmouseout="this.style.background='rgba(59,130,246,0.1)'; this.style.color='#3b82f6';">
                        Lihat Detail <i class="fa-solid fa-arrow-right" style="font-size: 0.6rem; margin-left: 0.2rem;"></i>
                    </a>
                </div>

                <!-- Card Body (Table of Members) -->
                <div style="overflow-x:auto;flex:1;">
                    <table class="data-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Status</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($family['members'] as $index => $member)
                                <tr>
                                    <td>
                                        <div style="font-weight:600;color:#1e293b;line-height:1.2;">{{ $member->nama_lengkap }}</div>
                                        <div style="font-size:0.58rem;color:#94a3b8;margin-top:1px;">{{ $member->jenis_kelamin == 'L' ? 'L' : 'P' }} · {{ $member->pekerjaan }}</div>
                                    </td>
                                    <td>
                                        <span class="status-badge-table status-{{ strtolower(str_replace(' ', '-', $member->status_keluarga)) }}">
                                            {{ $member->status_keluarga }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons justify-center">
                                            <a href="{{ route('admin.penduduk.edit', $member->id_penduduk) }}" class="btn-action btn-edit" title="Edit">
                                                <i class="fa-solid fa-pen"></i>
                                            </a>
                                            <form action="{{ route('admin.penduduk.destroy', $member->id_penduduk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Hapus">
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
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fa-solid fa-people-roof"></i>
                </div>
                <h3 class="font-bold text-slate-700 text-lg mb-1">Tidak Ada Data Keluarga</h3>
                <p class="text-slate-400 text-sm max-w-md mx-auto">
                    @if($search)
                        Tidak ditemukan keluarga yang cocok dengan pencarian "{{ $search }}". Coba gunakan kata kunci lain.
                    @else
                        Belum ada data penduduk yang dikelompokkan ke dalam keluarga. Silakan tambah data penduduk baru atau edit data yang ada dengan mengisi Nomor KK.
                    @endif
                </p>
                @if(!$search)
                    <a href="{{ route('admin.penduduk.create') }}" class="inline-block mt-4 bg-emerald-500 hover:bg-emerald-600 text-white font-bold py-2 px-6 rounded-full text-xs transition shadow-md">
                        + Tambah Data Penduduk
                    </a>
                @endif
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($kkPaginator->hasPages())
        <div class="pagination-container fade-up delay-3">
            {{ $kkPaginator->appends(['search' => $search])->links() }}
        </div>
    @endif
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
