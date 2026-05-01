{{-- resources/views/masyarakat/surat/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Riwayat Pengajuan Surat - Lumban Silintong')

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
        flex-wrap: wrap;
        gap: 1rem;
    }

    .brand-title {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        letter-spacing: -0.05em;
        color: var(--system-bg);
    }

    .brand-title span {
        color: var(--accent-primary);
        font-family: 'Instrument Sans', serif;
        font-style: italic;
    }

    .brand-subtitle {
        font-size: 0.85rem;
        color: var(--text-mute);
        margin-top: 0.5rem;
        max-width: 420px;
        line-height: 1.6;
    }

    /* Button Premium */
    .btn-premium {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.7rem 1.6rem;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary));
        color: white;
        border: none;
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
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
        padding: 1rem;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-node:hover {
        transform: translateY(-3px);
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
        border-color: var(--accent-primary);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 0.75rem;
    }

    .stat-value {
        font-size: 1.6rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.2rem;
    }

    .stat-label {
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
    }

    /* Filter Section */
    .filter-architecture {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        align-items: center;
    }

    .filter-pill {
        padding: 0.5rem 1.2rem;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: white;
        border: 1px solid var(--border-color);
        color: var(--text-mute);
        transition: all 0.3s;
        text-decoration: none;
    }

    .filter-pill:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
    }

    .filter-pill.active {
        background: var(--system-bg);
        color: white;
        border-color: var(--system-bg);
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

    /* Table Architecture */
    .table-architecture {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
        transition: all 0.4s;
    }

    .table-architecture:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .table-header {
        display: grid;
        grid-template-columns: 70px 1.8fr 1.2fr 1.2fr 120px;
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-mute);
    }

    .surat-row {
        display: grid;
        grid-template-columns: 70px 1.8fr 1.2fr 1.2fr 120px;
        align-items: center;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s;
        cursor: pointer;
    }

    .surat-row:hover {
        background: #fafafa;
    }

    .surat-row:last-child {
        border-bottom: none;
    }

    /* Jenis Surat Badge */
    .jenis-pill {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.25rem 0.8rem;
        background: #f1f5f9;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--dark);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.8rem;
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 700;
    }

    .status-menunggu { background: #fef3c7; color: #d97706; }
    .status-diproses { background: #dbeafe; color: #2563eb; }
    .status-selesai { background: #d1fae5; color: #059669; }
    .status-ditolak { background: #fee2e2; color: #dc2626; }

    /* Action Buttons */
    .action-deck {
        display: flex;
        gap: 0.5rem;
        opacity: 0.6;
        transition: all 0.3s;
        justify-content: flex-end;
    }

    .surat-row:hover .action-deck {
        opacity: 1;
    }

    .deck-btn {
        width: 34px;
        height: 34px;
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

    .btn-view:hover { background: var(--accent-primary); border-color: var(--accent-primary); }
    .btn-edit:hover { background: var(--accent-blue); border-color: var(--accent-blue); }
    .btn-delete:hover { background: var(--accent-red); border-color: var(--accent-red); }
    .btn-download:hover { background: var(--accent-purple); border-color: var(--accent-purple); }

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

    /* Footer Info */
    .footer-info {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .footer-info span {
        font-size: 0.7rem;
        color: var(--text-mute);
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .table-header, .surat-row {
            min-width: 800px;
        }
        .table-architecture { overflow-x: auto; }
    }

    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1rem; }
        .stats-architecture { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .editorial-header { flex-direction: column; align-items: flex-start; }
        .brand-title { font-size: 2rem; }
        .stats-architecture { grid-template-columns: 1fr; }
        .filter-architecture { overflow-x: auto; flex-wrap: nowrap; padding-bottom: 0.5rem; }
    }

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

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Header --}}
    <header class="editorial-header fade-up">
        <div>
            <h1 class="brand-title font-display">Riwayat<br><span>Pengajuan Surat</span>.</h1>
            <p class="brand-subtitle">
                Pantau status pengajuan surat Anda dan unduh dokumen yang telah selesai diproses.
            </p>
        </div>
        <a href="{{ route('masyarakat.surat.create') }}" class="btn-premium">
            <i class="fa-solid fa-plus"></i> Ajukan Surat Baru
        </a>
    </header>

    {{-- Statistics --}}
    <div class="stats-architecture fade-up delay-1">
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-regular fa-file-lines text-emerald-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $pengajuan->total() }}</div>
            <div class="stat-label">Total Pengajuan</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(245,158,11,0.1);">
                <i class="fa-regular fa-clock text-yellow-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $pengajuan->where('status', 'menunggu')->count() }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1);">
                <i class="fa-solid fa-spinner fa-spin text-blue-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $pengajuan->where('status', 'diproses')->count() }}</div>
            <div class="stat-label">Diproses</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-regular fa-circle-check text-emerald-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $pengajuan->where('status', 'selesai')->count() }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </div>

    {{-- Filter Pills --}}
    <div class="filter-architecture fade-up delay-2">
        <a href="{{ route('masyarakat.surat.index', ['status' => 'all']) }}" 
           class="filter-pill {{ request('status', 'all') == 'all' ? 'active' : '' }}">
            <i class="fa-solid fa-layer-group"></i> Semua
        </a>
        <a href="{{ route('masyarakat.surat.index', ['status' => 'menunggu']) }}" 
           class="filter-pill {{ request('status') == 'menunggu' ? 'active' : '' }}">
            <i class="fa-regular fa-clock"></i> Menunggu
        </a>
        <a href="{{ route('masyarakat.surat.index', ['status' => 'diproses']) }}" 
           class="filter-pill {{ request('status') == 'diproses' ? 'active' : '' }}">
            <i class="fa-solid fa-spinner"></i> Diproses
        </a>
        <a href="{{ route('masyarakat.surat.index', ['status' => 'selesai']) }}" 
           class="filter-pill {{ request('status') == 'selesai' ? 'active' : '' }}">
            <i class="fa-regular fa-circle-check"></i> Selesai
        </a>
        <a href="{{ route('masyarakat.surat.index', ['status' => 'ditolak']) }}" 
           class="filter-pill {{ request('status') == 'ditolak' ? 'active' : '' }}">
            <i class="fa-solid fa-ban"></i> Ditolak
        </a>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert-node alert-success fade-up delay-2">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check"></i><span>{{ session('success') }}</span></div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-node alert-error fade-up delay-2">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-exclamation"></i><span>{{ session('error') }}</span></div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
    </div>
    @endif

    {{-- Table --}}
    <div class="table-architecture fade-up delay-3">
        <div class="table-header">
            <div>No</div>
            <div>Jenis Surat</div>
            <div>Tanggal Pengajuan</div>
            <div>Status</div>
            <div style="text-align: right;">Aksi</div>
        </div>

        @forelse($pengajuan as $index => $item)
        <div class="surat-row" style="animation-delay: {{ $loop->index * 0.05 }}s">
            <div class="text-sm text-gray-500 font-medium">{{ $pengajuan->firstItem() + $index }}</div>
            
            <div>
                <span class="jenis-pill">
                    @if(str_contains($item->jenis_surat, 'Domisili')) 📄
                    @elseif(str_contains($item->jenis_surat, 'Usaha')) 🏪
                    @elseif(str_contains($item->jenis_surat, 'Tidak Mampu')) 📑
                    @elseif(str_contains($item->jenis_surat, 'Kelahiran')) 👶
                    @elseif(str_contains($item->jenis_surat, 'Kematian')) ⚰️
                    @elseif(str_contains($item->jenis_surat, 'SKCK')) 🛂
                    @else 📋 @endif
                    {{ $item->jenis_surat }}
                </span>
            </div>
            
            <div class="text-sm text-gray-500">
                {{ $item->created_at->translatedFormat('d M Y') }}<br>
                <span class="text-xs text-gray-400">{{ $item->created_at->format('H:i') }} WIB</span>
            </div>
            
            <div>
                <span class="status-badge status-{{ $item->status }}">
                    @if($item->status == 'menunggu') <i class="fa-regular fa-clock"></i> Menunggu
                    @elseif($item->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Diproses
                    @elseif($item->status == 'selesai') <i class="fa-regular fa-circle-check"></i> Selesai
                    @else <i class="fa-solid fa-ban"></i> Ditolak @endif
                </span>
            </div>
            
            <div style="text-align: right;">
                <div class="action-deck">
                    <a href="{{ route('masyarakat.surat.show', $item->id_surat) }}" class="deck-btn btn-view" title="Lihat Detail">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                    @if($item->status == 'menunggu')
                    <a href="{{ route('masyarakat.surat.edit', $item->id_surat) }}" class="deck-btn btn-edit" title="Edit">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <form action="{{ route('masyarakat.surat.destroy', $item->id_surat) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin membatalkan pengajuan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="deck-btn btn-delete" title="Batalkan">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    @endif
                    @if($item->status == 'selesai' && $item->file_surat)
                    <a href="{{ route('masyarakat.surat.download', $item->id_surat) }}" class="deck-btn btn-download" title="Download">
                        <i class="fa-solid fa-download"></i>
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="void-container">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-file-lines text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada Pengajuan Surat</h3>
            <p class="text-gray-400 mt-2">Silakan ajukan surat Anda melalui tombol di atas</p>
            <a href="{{ route('masyarakat.surat.create') }}" class="inline-flex items-center gap-2 mt-3 px-4 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition">
                <i class="fa-solid fa-plus"></i> Ajukan Surat Sekarang
            </a>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($pengajuan->hasPages())
    <div class="pagination-container">
        {{ $pengajuan->appends(request()->query())->links() }}
    </div>
    @endif

    {{-- ============================================ --}}
{{-- TUTORIAL - Halaman Riwayat Pengajuan Surat --}}
{{-- ============================================ --}}
<div class="tutorial-section animate-up delay-4" style="margin-top: 2rem; background: linear-gradient(135deg, #f8fafc, #ffffff); border-radius: 24px; padding: 1.8rem; border: 1px solid var(--border-color); transition: all 0.3s;">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
        <i class="fa-regular fa-circle-question" style="font-size: 1.5rem; color: var(--accent-primary);"></i>
        <h3 style="font-size: 1rem; font-weight: 700; margin: 0; color: var(--accent-primary);">📋 Tentang Halaman Ini</h3>
    </div>
    
    <p style="font-size: 0.85rem; color: #475569; margin-bottom: 1.2rem; line-height: 1.6;">
        Halaman <strong>Riwayat Pengajuan Surat</strong> menampilkan semua surat yang pernah Anda ajukan beserta statusnya. 
        Anda dapat memantau perkembangan pengajuan dari awal hingga surat selesai diterbitkan.
    </p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1rem; margin-bottom: 1.2rem;">
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-solid fa-filter" style="font-size: 0.8rem; color: var(--accent-primary);"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">Filter </h4>
                <p style="font-size: 0.7rem; color: #64748b;">Gunakan filter untuk menampilkan berdasarkan status surat, apakah semua, menunggu, diproses, selesai, ataupun ditolak.</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-solid fa-eye" style="font-size: 0.8rem; color: var(--accent-primary);"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">Lihat Detail</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Klik ikon mata 👁️ untuk melihat detail lengkap pengajuan Anda.</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-solid fa-pen" style="font-size: 0.8rem; color: var(--accent-primary);"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">Edit Pengajuan</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Hanya untuk status <strong>Menunggu</strong>. Klik ikon pensil untuk memperbaiki data.</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-solid fa-download" style="font-size: 0.8rem; color: var(--accent-primary);"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">Unduh Surat</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Jika status <strong>Selesai</strong>, klik ikon download untuk mengunduh surat digital.</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-solid fa-trash" style="font-size: 0.8rem; color: var(--accent-primary);"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">Batalkan Pengajuan</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Hanya untuk status <strong>Menunggu</strong>. Klik ikon tong sampah untuk membatalkan.</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #fef3c7; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-regular fa-lightbulb" style="font-size: 0.8rem; color: #d97706;"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">Tips</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Ajukan surat baru dengan tombol <strong>+ Ajukan Surat Baru</strong> di atas.</p>
            </div>
        </div>
    </div>
    
    <div style="background: #ecfdf5; border-radius: 16px; padding: 0.8rem 1rem; margin-top: 0.5rem;">
        <p style="font-size: 0.7rem; color: #059669; margin: 0; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-regular fa-clock"></i>
            <span>⏱️ <strong>Waktu Proses:</strong> Verifikasi dan penerbitan surat membutuhkan waktu 1-3 hari kerja setelah pengajuan masuk.</span>
        </p>
    </div>
</div>

<style>
    .tutorial-section > div > div:hover {
        background: rgba(5, 150, 105, 0.05);
        transform: translateX(4px);
    }
</style>

    {{-- Footer Info --}}
    <div class="footer-info fade-up delay-4">
        <span><i class="fa-regular fa-circle-info" style="color: var(--accent-primary);"></i> Pengajuan diproses 1-3 hari kerja</span>
        <span><i class="fa-regular fa-clock" style="color: var(--accent-primary);"></i> Update realtime</span>
        <span><i class="fa-solid fa-shield-alt" style="color: var(--accent-primary);"></i> Data terverifikasi</span>
    </div>
</div>

<script>
    // Auto close alerts after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert-node').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(20px)';
            setTimeout(() => alert.remove(), 300);
        });
    }, 4000);
    
    // Row click to view detail
    document.querySelectorAll('.surat-row').forEach(row => {
        row.addEventListener('click', function(e) {
            if (e.target.closest('.action-deck') || e.target.closest('a') || e.target.closest('button')) {
                return;
            }
            const link = this.querySelector('a.btn-view');
            if (link) window.location.href = link.href;
        });
    });
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection