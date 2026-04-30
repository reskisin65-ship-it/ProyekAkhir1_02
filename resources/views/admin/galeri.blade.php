@extends('layouts.admin')

@section('title', 'Kelola Galeri - Lumban Silintong')

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
        --pink: #ec4899;
        --teal: #14b8a6;
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

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        padding: 1rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: var(--transition);
    }

    .stat-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--glass-shadow);
        background: white;
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .stat-info h4 {
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1;
        color: #0f172a;
    }

    .stat-info p {
        font-size: 0.7rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Gallery Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }

    /* Gallery Card */
    .gallery-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        overflow: hidden;
        transition: var(--transition);
    }

    .gallery-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.15);
        background: white;
    }

    /* Image Container */
    .image-container {
        position: relative;
        height: 240px;
        overflow: hidden;
        background: #f1f5f9;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .gallery-card:hover .image-container img {
        transform: scale(1.05);
    }

    /* Category Badge */
    .category-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        backdrop-filter: blur(8px);
    }

    .badge-kegiatan { background: rgba(59,130,246,0.9); color: white; }
    .badge-pembangunan { background: rgba(245,158,11,0.9); color: white; }
    .badge-budaya { background: rgba(139,92,246,0.9); color: white; }
    .badge-wisata { background: rgba(20,184,166,0.9); color: white; }
    .badge-umkm { background: rgba(236,72,153,0.9); color: white; }
    .badge-default { background: rgba(100,116,139,0.9); color: white; }

    /* Overlay Actions */
    .overlay-actions {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1rem;
        opacity: 0;
        transition: var(--transition);
    }

    .gallery-card:hover .overlay-actions {
        opacity: 1;
    }

    .action-btn {
        width: 44px;
        height: 44px;
        background: white;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
        transform: translateY(20px);
        opacity: 0;
    }

    .gallery-card:hover .action-btn {
        transform: translateY(0);
        opacity: 1;
    }

    .action-btn:nth-child(1) { transition-delay: 0.05s; }
    .action-btn:nth-child(2) { transition-delay: 0.1s; }
    .action-btn:nth-child(3) { transition-delay: 0.15s; }

    .action-btn:hover {
        transform: scale(1.1);
    }

    .action-view { color: var(--blue); }
    .action-view:hover { background: var(--blue); color: white; }

    .action-edit { color: var(--orange); }
    .action-edit:hover { background: var(--orange); color: white; }

    .action-delete { color: #ef4444; }
    .action-delete:hover { background: #ef4444; color: white; }

    /* Info Card */
    .info-card {
        padding: 1rem;
    }

    .info-title {
        font-weight: 700;
        font-size: 0.9rem;
        color: #1e293b;
        margin-bottom: 0.5rem;
        line-clamp: 1;
    }

    .info-date {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.7rem;
        color: #94a3b8;
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
        text-align: center;
        padding: 4rem;
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 32px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .premium-container { padding: 1rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 0.8rem; }
    }

    @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
        .gallery-grid { grid-template-columns: 1fr; }
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

    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<div class="premium-container">
    
    <!-- Header Section -->
    <div class="header-section fade-up">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <div class="page-badge">DOKUMENTASI VISUAL</div>
                <h1 class="page-title">Kelola <span>Galeri</span></h1>
                <p class="text-slate-400 mt-1 text-sm">Kelola dokumentasi foto kegiatan Desa Lumban Silintong</p>
            </div>
            <a href="{{ route('admin.galeri.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Foto
            </a>
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

    <!-- Stats Cards -->
    <div class="stats-grid fade-up delay-2">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1); color: var(--blue);">
                <i class="fa-solid fa-images text-xl"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $galeris->total() }}</h4>
                <p>Total Foto</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: var(--orange);">
                <i class="fa-solid fa-calendar-check text-xl"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $galeris->where('kategori', 'kegiatan')->count() }}</h4>
                <p>Kegiatan</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(139,92,246,0.1); color: var(--purple);">
                <i class="fa-solid fa-hard-hat text-xl"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $galeris->where('kategori', 'pembangunan')->count() }}</h4>
                <p>Pembangunan</p>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(20,184,166,0.1); color: var(--teal);">
                <i class="fa-solid fa-umbrella-beach text-xl"></i>
            </div>
            <div class="stat-info">
                <h4>{{ $galeris->whereIn('kategori', ['budaya', 'wisata', 'umkm'])->count() }}</h4>
                <p>Budaya & Wisata</p>
            </div>
        </div>
    </div>

    <!-- Gallery Grid -->
    <div class="gallery-grid fade-up delay-3">
        @forelse($galeris as $item)
        <div class="gallery-card">
            <div class="image-container">
                <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="{{ $item->judul_galeri }}">
                
                <!-- Category Badge -->
                <span class="category-badge badge-{{ $item->kategori }}">
                    <i class="fa-regular fa-folder-open mr-1"></i> {{ ucfirst($item->kategori) }}
                </span>
                
                <!-- Overlay Actions -->
                <div class="overlay-actions">
                    <a href="{{ route('admin.galeri.show', $item->id_galeri) }}" class="action-btn action-view" title="Lihat Detail">
                        <i class="fa-solid fa-eye text-lg"></i>
                    </a>
                    <a href="{{ route('admin.galeri.edit', $item->id_galeri) }}" class="action-btn action-edit" title="Edit Foto">
                        <i class="fa-solid fa-pen text-lg"></i>
                    </a>
                    <form action="{{ route('admin.galeri.destroy', $item->id_galeri) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn action-delete" title="Hapus Foto">
                            <i class="fa-solid fa-trash text-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
            
            <div class="info-card">
                <h3 class="info-title">{{ $item->judul_galeri }}</h3>
                <div class="info-date">
                    <i class="fa-regular fa-calendar"></i>
                    <span>{{ $item->created_at->translatedFormat('d F Y') }}</span>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-images text-4xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-500">Belum Ada Foto Galeri</h3>
            <p class="text-gray-400 mt-2">Klik tombol "Tambah Foto" untuk mulai mengunggah dokumentasi</p>
            <a href="{{ route('admin.galeri.create') }}" class="inline-block mt-4 btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Foto Pertama
            </a>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($galeris->hasPages())
    <div class="pagination-container">
        {{ $galeris->links() }}
    </div>
    @endif
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection