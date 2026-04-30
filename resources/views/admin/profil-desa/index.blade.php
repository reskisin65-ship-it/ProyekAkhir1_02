{{-- resources/views/admin/profil-desa/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Profil Desa - Lumban Silintong')

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
        --accent-amber: #f59e0b;
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

    .brand-title span {
        color: var(--accent-primary);
        font-family: 'Instrument Sans', serif;
        font-style: italic;
    }

    .brand-subtitle {
        font-size: 0.85rem;
        color: var(--text-mute);
        margin-top: 1rem;
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
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    /* Preview Card */
    .preview-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        margin-bottom: 2rem;
    }

    .preview-card:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .card-header {
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--border-color);
    }

    .card-header h2 {
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-header h2 i {
        color: var(--accent-primary);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin: 1.5rem 0;
    }

    .stat-node {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 1rem;
        text-align: center;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-node:hover {
        transform: translateY(-3px);
        border-color: var(--accent-primary);
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.75rem;
    }

    .stat-value {
        font-size: 1.3rem;
        font-weight: 800;
        line-height: 1.2;
    }

    .stat-label {
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-mute);
        margin-top: 0.2rem;
    }

    /* Visi Misi Grid */
    .vm-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.2rem;
        margin-bottom: 1.5rem;
    }

    .vm-card {
        background: #f8fafc;
        border: 1px solid var(--border-color);
        border-radius: 20px;
        padding: 1.2rem;
        transition: all 0.3s;
    }

    .vm-card:hover {
        transform: translateY(-2px);
        border-color: var(--accent-primary);
    }

    .vm-title {
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .vm-title.visi i { color: var(--accent-primary); }
    .vm-title.misi i { color: var(--accent-blue); }

    .vm-content {
        font-size: 0.8rem;
        line-height: 1.5;
        color: var(--text-mute);
        font-style: italic;
    }

    /* Sejarah Content */
    .sejarah-content {
        background: #f8fafc;
        border-radius: 20px;
        padding: 1rem;
        border: 1px solid var(--border-color);
        max-height: 150px;
        overflow-y: auto;
    }

    .sejarah-content p {
        font-size: 0.85rem;
        line-height: 1.6;
        color: var(--text-main);
    }

    .sejarah-content::-webkit-scrollbar {
        width: 4px;
    }
    .sejarah-content::-webkit-scrollbar-track {
        background: #e2e8f0;
        border-radius: 10px;
    }
    .sejarah-content::-webkit-scrollbar-thumb {
        background: var(--accent-primary);
        border-radius: 10px;
    }

    /* Kontak Row */
    .kontak-row {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-color);
    }

    .kontak-item {
        flex: 1;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.6rem 1rem;
        background: #f8fafc;
        border-radius: 16px;
        transition: all 0.3s;
    }

    .kontak-item:hover {
        background: var(--accent-primary);
    }

    .kontak-item:hover .kontak-icon i,
    .kontak-item:hover .kontak-text {
        color: white;
    }

    .kontak-icon {
        width: 36px;
        height: 36px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .kontak-icon i { font-size: 0.9rem; color: var(--accent-primary); }

    .kontak-text {
        font-size: 0.8rem;
        color: var(--text-mute);
        transition: all 0.3s;
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
        grid-template-columns: 60px 80px 1fr 1.5fr 100px;
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
    }

    .aparatur-row {
        display: grid;
        grid-template-columns: 60px 80px 1fr 1.5fr 100px;
        align-items: center;
        padding: 0.8rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s;
    }

    .aparatur-row:hover {
        background: #fafafa;
    }

    .aparatur-row:last-child {
        border-bottom: none;
    }

    /* Avatar */
    .avatar-small {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        overflow: hidden;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-small img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .avatar-small i {
        font-size: 1.2rem;
        color: var(--gray);
    }

    /* Badge Jabatan */
    .jabatan-badge {
        display: inline-block;
        padding: 0.25rem 0.8rem;
        background: #d1fae5;
        color: #059669;
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 700;
    }

    /* Action Buttons */
    .action-deck {
        display: flex;
        gap: 0.5rem;
        opacity: 0.6;
        transition: all 0.3s;
    }

    .aparatur-row:hover .action-deck {
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
    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-icon {
        width: 70px;
        height: 70px;
        background: #f1f5f9;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    /* Table Footer */
    .table-footer {
        background: #f8fafc;
        padding: 0.8rem 1.5rem;
        text-align: center;
        border-top: 1px solid var(--border-color);
    }

    .table-footer a {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--accent-primary);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.2s;
    }

    .table-footer a:hover { gap: 0.6rem; }

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

    /* Animations */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .fade-up { animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.2s; }

    /* Responsive */
    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .vm-grid { grid-template-columns: 1fr; }
        .kontak-row { flex-direction: column; }
        .table-header, .aparatur-row { min-width: 650px; }
        .table-architecture { overflow-x: auto; }
    }

    @media (max-width: 768px) {
        .editorial-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .brand-title { font-size: 2rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .btn-premium { padding: 0.6rem 1.2rem; font-size: 0.75rem; }
    }
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Header --}}
    <header class="editorial-header fade-up">
        <div>
            <h1 class="brand-title font-display">Kelola<br><span>Profil Desa</span>.</h1>
            <p class="brand-subtitle">
                Kelola sejarah, visi misi, dan informasi desa Lumban Silintong.
            </p>
        </div>
        <a href="{{ route('admin.profil-desa.edit') }}" class="btn-premium">
            <i class="fa-solid fa-pen"></i> Edit Profil Desa
        </a>
    </header>

    {{-- Preview Card --}}
    <div class="preview-card fade-up delay-1">
        <div class="card-header">
            <h2><i class="fa-regular fa-eye"></i> Preview Profil Desa</h2>
        </div>
        <div style="padding: 1.5rem;">
            
            {{-- Sejarah --}}
            <div style="margin-bottom: 1.5rem;">
                <h3 style="font-size: 0.8rem; font-weight: 700; margin-bottom: 0.5rem; display: flex; align-items: center; gap: 0.4rem;">
                    <i class="fa-regular fa-clock" style="color: var(--accent-primary);"></i> Sejarah Desa
                </h3>
                <div class="sejarah-content">
                    @if($profil && $profil->sejarah)
                        <p>{{ $profil->sejarah }}</p>
                    @else
                        <p style="color: var(--text-mute); text-align: center;">Belum ada data sejarah</p>
                    @endif
                </div>
            </div>

            {{-- Visi & Misi --}}
            <div class="vm-grid">
                <div class="vm-card">
                    <div class="vm-title visi">
                        <i class="fa-solid fa-eye"></i> Visi
                    </div>
                    <div class="vm-content">
                        @if($profil && $profil->visi)
                            "{{ $profil->visi }}"
                        @else
                            <span style="color: var(--text-mute);">Belum ada visi</span>
                        @endif
                    </div>
                </div>
                <div class="vm-card">
                    <div class="vm-title misi">
                        <i class="fa-solid fa-flag-checkered"></i> Misi
                    </div>
                    <div class="vm-content">
                        @if($profil && $profil->misi)
                            {{ $profil->misi }}
                        @else
                            <span style="color: var(--text-mute);">Belum ada misi</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Informasi Desa Stats --}}
            <div class="stats-grid">
                <div class="stat-node">
                    <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                        <i class="fa-regular fa-calendar" style="color: var(--accent-primary);"></i>
                    </div>
                    <div class="stat-value">{{ $profil->tahun_berdiri ?? '-' }}</div>
                    <div class="stat-label">Tahun Berdiri</div>
                </div>
                <div class="stat-node">
                    <div class="stat-icon" style="background: rgba(59,130,246,0.1);">
                        <i class="fa-solid fa-map" style="color: var(--accent-blue);"></i>
                    </div>
                    <div class="stat-value">{{ $profil->luas_wilayah ?? '-' }}</div>
                    <div class="stat-label">Luas (km²)</div>
                </div>
                <div class="stat-node">
                    <div class="stat-icon" style="background: rgba(245,158,11,0.1);">
                        <i class="fa-solid fa-tree" style="color: var(--accent-amber);"></i>
                    </div>
                    <div class="stat-value">{{ $profil->jumlah_dusun ?? '-' }}</div>
                    <div class="stat-label">Jumlah Dusun</div>
                </div>
                <div class="stat-node">
                    <div class="stat-icon" style="background: rgba(139,92,246,0.1);">
                        <i class="fa-solid fa-users" style="color: var(--accent-purple);"></i>
                    </div>
                    <div class="stat-value">{{ $aparaturs->count() }}</div>
                    <div class="stat-label">Aparatur Desa</div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="kontak-row">
                <div class="kontak-item">
                    <div class="kontak-icon"><i class="fa-regular fa-envelope"></i></div>
                    <div class="kontak-text">{{ $profil->email_desa ?? 'Email belum diisi' }}</div>
                </div>
                <div class="kontak-item">
                    <div class="kontak-icon"><i class="fa-regular fa-phone"></i></div>
                    <div class="kontak-text">{{ $profil->telepon_desa ?? 'Telepon belum diisi' }}</div>
                </div>
                <div class="kontak-item">
                    <div class="kontak-icon"><i class="fa-regular fa-location-dot"></i></div>
                    <div class="kontak-text">{{ $profil->alamat_kantor ?? 'Alamat belum diisi' }}</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Aparatur Desa Table --}}
    <div class="table-architecture fade-up delay-2">
        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 0.5rem;">
            <h2><i class="fa-solid fa-users"></i> Aparatur Desa</h2>
            <a href="{{ route('admin.pengurus.index') }}" style="font-size: 0.7rem; font-weight: 700; color: var(--accent-primary); text-decoration: none; display: inline-flex; align-items: center; gap: 0.3rem;">
                Kelola Semua <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        
        <div class="table-header">
            <div>No</div><div>Foto</div><div>Nama</div><div>Jabatan</div><div style="text-align: center;">Aksi</div>
        </div>
        
        @forelse($aparaturs->take(5) as $index => $a)
        <div class="aparatur-row" style="animation-delay: {{ 0.03 * $loop->index }}s">
            <div style="font-size: 0.8rem; color: var(--text-mute);">{{ $index + 1 }}</div>
            <div>
                <div class="avatar-small">
                    @if($a->foto)
                        <img src="{{ asset('storage/' . $a->foto) }}" alt="{{ $a->nama_pengurus }}">
                    @else
                        <i class="fa-solid fa-user"></i>
                    @endif
                </div>
            </div>
            <div style="font-weight: 600; font-size: 0.85rem;">{{ $a->nama_pengurus ?? $a->nama }}</div>
            <div><span class="jabatan-badge">{{ $a->jabatan }}</span></div>
            <div>
                <div class="action-deck" style="justify-content: center;">
                    <a href="{{ route('admin.pengurus.edit', $a->id_pengurus) }}" class="deck-btn btn-edit" title="Edit">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <form action="{{ route('admin.pengurus.destroy', $a->id_pengurus) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="deck-btn btn-delete" title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon"><i class="fa-solid fa-users-slash" style="font-size: 2rem; color: var(--text-mute);"></i></div>
            <p style="color: var(--text-mute); font-size: 0.8rem;">Belum ada data aparatur desa</p>
            <a href="{{ route('admin.pengurus.index') }}" style="display: inline-block; margin-top: 0.8rem; font-size: 0.75rem; color: var(--accent-primary); text-decoration: none;">Kelola Aparatur →</a>
        </div>
        @endforelse
        
        @if($aparaturs->count() > 5)
        <div class="table-footer">
            <a href="{{ route('admin.pengurus.index') }}">
                Lihat Semua Aparatur ({{ $aparaturs->count() }}) <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        @endif
    </div>

    {{-- Footer Info --}}
    <div class="footer-info fade-up delay-3">
        <span><i class="fa-regular fa-circle-check" style="color: var(--accent-primary);"></i> Data dikelola oleh administrator</span>
        <span><i class="fa-regular fa-clock" style="color: var(--accent-primary);"></i> Update: {{ now()->translatedFormat('d F Y H:i') }}</span>
        <span><i class="fa-solid fa-shield-alt" style="color: var(--accent-primary);"></i> Data terverifikasi</span>
    </div>
</div>
@endsection