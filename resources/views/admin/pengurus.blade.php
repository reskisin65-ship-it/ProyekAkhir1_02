{{-- resources/views/admin/pengurus.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Pengurus Desa - Lumban Silintong')

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

    /* Grid Pengurus */
    .pengrid-architecture {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .pengurus-node {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .pengurus-node:hover {
        transform: translateY(-6px);
        box-shadow: 0 25px 40px -15px rgba(16, 185, 129, 0.2);
        border-color: var(--accent-primary);
    }

    .pengurus-cover {
        height: 100px;
        background: linear-gradient(135deg, #10b98120, #05966920);
        position: relative;
    }

    .pengurus-avatar {
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
    }

    .avatar-circle {
        width: 90px;
        height: 90px;
        border-radius: 30px;
        background: linear-gradient(135deg, #10b981, #059669);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 4px solid white;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        overflow: hidden;
    }

    .avatar-circle img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .pengurus-body {
        padding: 3rem 1.5rem 1.5rem;
        text-align: center;
    }

    .pengurus-nama {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--text-main);
        margin-bottom: 0.25rem;
    }

    .jabatan-badge {
        display: inline-block;
        padding: 0.25rem 0.8rem;
        background: #ecfdf5;
        color: #059669;
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 700;
        margin-top: 0.5rem;
    }

    .info-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        color: var(--text-mute);
        margin-top: 0.75rem;
    }

    .tugas-preview {
        background: #f8fafc;
        border-radius: 16px;
        padding: 0.75rem;
        margin-top: 1rem;
        text-align: left;
    }

    .tugas-preview p {
        font-size: 0.7rem;
        color: var(--text-mute);
        line-height: 1.4;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .action-deck {
        display: flex;
        gap: 0.75rem;
        margin-top: 1.25rem;
        justify-content: center;
    }

    .deck-btn {
        padding: 0.5rem 1.2rem;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 700;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
        cursor: pointer;
        border: none;
    }

    .btn-edit {
        background: #eff6ff;
        color: #2563eb;
    }

    .btn-edit:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: #fef2f2;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
    }

    .void-container {
        grid-column: span 3;
        padding: 5rem 0;
        text-align: center;
        border: 2px dashed #e5e5e5;
        border-radius: 40px;
    }

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

    .quick-info {
        margin-top: 2rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 24px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    @media (max-width: 1200px) {
        .pengrid-architecture { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .dashboard-wrapper { padding: 1rem; }
        .stats-architecture { grid-template-columns: repeat(2, 1fr); }
        .pengrid-architecture { grid-template-columns: 1fr; }
        .editorial-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .brand-title { font-size: 2rem; }
        .quick-info { flex-direction: column; text-align: center; }
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
            <h1 class="brand-title font-display">Kelola<br><span style="color: var(--accent-primary);">Pengurus Desa</span>.</h1>
            <p class="brand-subtitle">
                Kelola data perangkat desa Lumban Silintong dengan presisi.
            </p>
        </div>
        <a href="{{ route('admin.pengurus.create') }}" 
           class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl hover:shadow-xl transition-all duration-300 hover:scale-105 flex items-center gap-2 font-semibold text-sm">
            <i class="fa-solid fa-plus"></i> Tambah Pengurus
        </a>
    </header>

    <div class="stats-architecture fade-up" style="animation-delay: 0.05s">
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-solid fa-users text-emerald-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $pengurus->total() }}</div>
            <div class="stat-label">Total Pengurus</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(139,92,246,0.1);">
                <i class="fa-solid fa-briefcase text-purple-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $pengurus->count() }}</div>
            <div class="stat-label">Aktif</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1);">
                <i class="fa-solid fa-sort-numeric-down text-blue-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $pengurus->max('urutan') ?? 0 }}</div>
            <div class="stat-label">Urutan Maks</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(245,158,11,0.1);">
                <i class="fa-regular fa-calendar text-yellow-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ now()->format('d/m/Y') }}</div>
            <div class="stat-label">Terakhir Update</div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert-node alert-success fade-up" style="animation-delay: 0.1s">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-node alert-error fade-up" style="animation-delay: 0.1s">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    <div class="pengrid-architecture fade-up" style="animation-delay: 0.15s">
        @forelse($pengurus as $item)
        <div class="pengurus-node">
            <div class="pengurus-cover">
                <div class="pengurus-avatar">
                    <div class="avatar-circle">
                        @if($item->foto)
                            <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->nama_pengurus ?? $item->nama }}">
                        @else
                            <i class="fa-solid fa-user text-white text-3xl"></i>
                        @endif
                    </div>
                </div>
            </div>
            <div class="pengurus-body">
                <h3 class="pengurus-nama">{{ $item->nama_pengurus ?? $item->nama }}</h3>
                <span class="jabatan-badge">
                    <i class="fa-solid fa-briefcase mr-1"></i> {{ $item->jabatan }}
                </span>
                
                @if($item->nip)
                <div class="info-row">
                    <i class="fa-regular fa-id-card"></i>
                    <span>NIP: {{ $item->nip }}</span>
                </div>
                @endif
                
                <div class="info-row">
                    <i class="fa-solid fa-sort-numeric-down"></i>
                    <span>Urutan: {{ $item->urutan ?? 0 }}</span>
                </div>
                
                @if($item->tugas)
                <div class="tugas-preview">
                    <p class="text-[10px] text-gray-400 uppercase tracking-wider mb-1">
                        <i class="fa-regular fa-bell mr-1"></i> Tugas & Tanggung Jawab
                    </p>
                    <p>{{ Str::limit($item->tugas, 80) }}</p>
                </div>
                @endif
                
                <div class="action-deck">
                    <a href="{{ route('admin.pengurus.edit', $item->id_pengurus) }}" class="deck-btn btn-edit">
                        <i class="fa-solid fa-pen"></i> Edit
                    </a>
                    <form action="{{ route('admin.pengurus.destroy', $item->id_pengurus) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus pengurus ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="deck-btn btn-delete">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="void-container">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-users-slash text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada Data Pengurus</h3>
            <p class="text-gray-400 mt-2">Silakan tambahkan data perangkat desa terlebih dahulu</p>
            <a href="{{ route('admin.pengurus.create') }}" class="inline-flex items-center gap-2 mt-4 px-5 py-2 bg-emerald-600 text-white rounded-xl hover:bg-emerald-700 transition">
                <i class="fa-solid fa-plus"></i> Tambah Pengurus
            </a>
        </div>
        @endforelse
    </div>

    @if($pengurus->hasPages())
    <div class="pagination-container">
        {{ $pengurus->appends(request()->query())->links() }}
    </div>
    @endif

    <div class="quick-info fade-up" style="animation-delay: 0.2s">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-emerald-500 rounded-xl flex items-center justify-center">
                <i class="fa-regular fa-lightbulb text-white"></i>
            </div>
            <div>
                <p class="font-semibold text-emerald-800 text-sm">💡 Tips Mengelola Pengurus</p>
                <p class="text-xs text-gray-600">Urutan tampilan dapat diatur dengan mengisi nilai "Urutan" (semakin kecil angka, semakin atas tampilannya)</p>
            </div>
        </div>
        <a href="{{ route('admin.profil-desa.index') }}" class="px-5 py-2 bg-white rounded-xl text-emerald-600 font-semibold text-sm hover:bg-emerald-50 transition flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> ke Profil Desa
        </a>
    </div>
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection