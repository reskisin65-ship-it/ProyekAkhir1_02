{{-- resources/views/admin/umkm.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola UMKM - Lumban Silintong')

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

    .editorial-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 3rem;
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

    .filter-architecture {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
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

    .table-architecture {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
    }

    .umkm-node {
        display: grid;
        grid-template-columns: 70px 1.5fr 1fr 1fr 1fr 1.2fr 1fr;
        align-items: center;
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.4s;
    }

    .umkm-node:hover {
        background: #fafafa;
        transform: translateX(4px);
    }

    .umkm-node:last-child {
        border-bottom: none;
    }

    .table-header {
        display: grid;
        grid-template-columns: 70px 1.5fr 1fr 1fr 1fr 1.2fr 1fr;
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-mute);
    }

    .umkm-avatar {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--accent-primary), #059669);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1rem;
    }

    .category-pill {
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        width: fit-content;
    }

    .cat-kuliner { background: #fef3c7; color: #d97706; }
    .cat-fashion { background: #f3e8ff; color: #9333ea; }
    .cat-kriya { background: #d1fae5; color: #059669; }
    .cat-jasa { background: #dbeafe; color: #2563eb; }
    .cat-default { background: #e5e7eb; color: #4b5563; }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
    }

    .status-pending { background: #fef3c7; color: #d97706; }
    .status-approved { background: #d1fae5; color: #059669; }
    .status-rejected { background: #fee2e2; color: #dc2626; }

    .action-deck {
        display: flex;
        gap: 0.5rem;
        opacity: 0.7;
        transition: all 0.3s;
    }

    .umkm-node:hover .action-deck {
        opacity: 1;
    }

    .deck-btn {
        width: 36px;
        height: 36px;
        border-radius: 12px;
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

    .btn-approve { background: var(--accent-primary); color: white; border-color: var(--accent-primary); }
    .btn-approve:hover { background: #059669; }

    .btn-reject { background: #ef4444; color: white; border-color: #ef4444; }
    .btn-reject:hover { background: #dc2626; }

    .void-container {
        padding: 5rem 0;
        text-align: center;
        border: 2px dashed #e5e5e5;
        border-radius: 40px;
    }

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

    @media (max-width: 1200px) {
        .umkm-node, .table-header {
            grid-template-columns: 60px 1.2fr 0.9fr 0.9fr 0.9fr 1fr 0.9fr;
            gap: 0.5rem;
        }
    }

    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1rem; }
        .stats-architecture { grid-template-columns: repeat(2, 1fr); }
        .table-architecture { overflow-x: auto; }
        .umkm-node, .table-header { min-width: 900px; }
    }

    @media (max-width: 640px) {
        .stats-architecture { grid-template-columns: 1fr; }
        .editorial-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .brand-title { font-size: 2rem; }
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
    
    <header class="editorial-header fade-up">
        <div>
            <h1 class="brand-title font-display">Kelola<br><span style="color: var(--accent-primary);">UMKM</span>.</h1>
            <p class="brand-subtitle">
                Kelola dan verifikasi pendaftaran UMKM desa dengan presisi.
            </p>
        </div>
    </header>

    <div class="stats-architecture fade-up" style="animation-delay: 0.05s">
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-solid fa-store text-emerald-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $statistik['total'] ?? $umkms->total() }}</div>
            <div class="stat-label">Total UMKM</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(245,158,11,0.1);">
                <i class="fa-regular fa-clock text-yellow-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $statistik['pending'] ?? $umkms->where('status', 'pending')->count() }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-regular fa-circle-check text-emerald-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $statistik['approved'] ?? $umkms->where('status', 'approved')->count() }}</div>
            <div class="stat-label">Disetujui</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(239,68,68,0.1);">
                <i class="fa-solid fa-ban text-red-500 text-xl"></i>
            </div>
            <div class="stat-value">{{ $statistik['rejected'] ?? $umkms->where('status', 'rejected')->count() }}</div>
            <div class="stat-label">Ditolak</div>
        </div>
    </div>

    <div class="filter-architecture fade-up" style="animation-delay: 0.1s">
        <a href="{{ route('admin.umkm.index', ['status' => 'all']) }}" 
           class="filter-pill {{ request('status', 'all') == 'all' ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ route('admin.umkm.index', ['status' => 'pending']) }}" 
           class="filter-pill {{ request('status') == 'pending' ? 'active' : '' }}">
            Menunggu
        </a>
        <a href="{{ route('admin.umkm.index', ['status' => 'approved']) }}" 
           class="filter-pill {{ request('status') == 'approved' ? 'active' : '' }}">
            Disetujui
        </a>
        <a href="{{ route('admin.umkm.index', ['status' => 'rejected']) }}" 
           class="filter-pill {{ request('status') == 'rejected' ? 'active' : '' }}">
            Ditolak
        </a>
    </div>

    @if(session('success'))
    <div class="alert-node alert-success fade-up" style="animation-delay: 0.15s">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    <div class="table-architecture fade-up" style="animation-delay: 0.2s">
        <div class="table-header">
            <div>No</div>
            <div>Nama Usaha / Pemilik</div>
            <div>Kategori</div>
            <div>Alamat</div>
            <div>Tanggal Daftar</div>
            <div>Status</div>
            <div>Aksi</div>
        </div>

        @forelse($umkms as $index => $umkm)
        <div class="umkm-node" style="animation-delay: {{ 0.05 * $loop->index }}s">
            <div class="text-sm text-gray-500 font-medium">{{ $umkms->firstItem() + $index }}</div>
            
            <div class="flex items-center gap-3">
                <div class="umkm-avatar">
                    <i class="fa-solid fa-store text-sm"></i>
                </div>
                <div>
                    <div class="font-medium text-gray-800">{{ $umkm->nama_usaha }}</div>
                    <div class="text-xs text-gray-400">{{ $umkm->pemilik ?? $umkm->user->name ?? '-' }}</div>
                </div>
            </div>
            
            <div>
                <span class="category-pill 
                    @if($umkm->kategori == 'kuliner') cat-kuliner
                    @elseif($umkm->kategori == 'fashion') cat-fashion
                    @elseif($umkm->kategori == 'kriya') cat-kriya
                    @elseif($umkm->kategori == 'jasa') cat-jasa
                    @else cat-default @endif">
                    {{ ucfirst($umkm->kategori ?? 'Lainnya') }}
                </span>
            </div>
            
            <div class="text-sm text-gray-500 line-clamp-1">
                {{ $umkm->alamat ?? '-' }}
            </div>
            
            <div class="text-sm text-gray-500">
                {{ $umkm->created_at->translatedFormat('d M Y') }}<br>
                <span class="text-xs">{{ $umkm->created_at->format('H:i') }} WIB</span>
            </div>
            
            <div>
                <span class="status-badge status-{{ $umkm->status }}">
                    @if($umkm->status == 'pending') <i class="fa-regular fa-clock"></i> Menunggu
                    @elseif($umkm->status == 'approved') <i class="fa-regular fa-circle-check"></i> Disetujui
                    @else <i class="fa-solid fa-ban"></i> Ditolak @endif
                </span>
            </div>
            
            <div class="action-deck">
                @if($umkm->status == 'pending')
                <form action="{{ route('admin.umkm.approve', $umkm->id_umkm) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="deck-btn btn-approve" title="Setujui">
                        <i class="fa-regular fa-circle-check"></i>
                    </button>
                </form>
                <form action="{{ route('admin.umkm.reject', $umkm->id_umkm) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="deck-btn btn-reject" title="Tolak">
                        <i class="fa-solid fa-ban"></i>
                    </button>
                </form>
                @endif
                
                <form action="{{ route('admin.umkm.destroy', $umkm->id_umkm) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="deck-btn" title="Hapus">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="void-container">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-store text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada UMKM</h3>
            <p class="text-gray-400 mt-2">Belum ada UMKM yang terdaftar di sistem</p>
        </div>
        @endforelse
    </div>

    @if($umkms->hasPages())
    <div class="pagination-container">
        {{ $umkms->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection