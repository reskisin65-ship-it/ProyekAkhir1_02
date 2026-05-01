{{-- resources/views/pages/umkm.blade.php --}}
@extends('layouts.app')

@section('title', 'UMKM - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* ============================================
       DESIGN SYSTEM PREMIUM
    ============================================ */
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
        --dark: #0f172a;
        --dark-soft: #1e293b;
        --gray: #64748b;
        --gray-light: #94a3b8;
        --gray-soft: #f1f5f9;
        --bg: #fafbfc;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.04);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.06);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.08);
        --shadow-2xl: 0 32px 64px rgba(0,0,0,0.12);
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        --transition-slow: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: var(--dark);
        -webkit-font-smoothing: antialiased;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--gray-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    /* Background Pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
        background-size: 20px 20px;
        opacity: 0.4;
    }

    /* Background Ornaments */
    .bg-ornament {
        position: fixed;
        width: 60vw;
        height: 60vw;
        border-radius: 50%;
        z-index: -1;
        filter: blur(120px);
        opacity: 0.3;
        animation: floatOrnament 16s ease-in-out infinite;
    }
    @keyframes floatOrnament {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-30px, -30px) scale(1.05); }
    }
    .ornament-1 { top: -20%; right: -10%; background: radial-gradient(circle, var(--primary-light) 0%, transparent 70%); }
    .ornament-2 { bottom: -20%; left: -10%; background: radial-gradient(circle, #8b5cf6 0%, transparent 70%); animation-delay: -5s; }

    /* Container Premium */
    .container-premium {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ============================================
       HEADER SECTION PREMIUM
    ============================================ */
    .header-section {
        text-align: center;
        margin-bottom: 3rem;
        animation: fadeInUp 0.6s ease;
    }

    .header-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 1rem;
    }

    .header-badge i { font-size: 0.7rem; color: var(--primary); }
    .header-badge span { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; color: var(--primary-dark); text-transform: uppercase; }

    .header-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
        color: var(--dark);
    }

    .header-title span {
        color: var(--primary);
        font-family: 'Instrument Serif', serif;
        font-style: italic;
    }

    .header-subtitle {
        font-size: 0.9rem;
        color: var(--gray);
        margin-top: 0.5rem;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* ============================================
       STATISTICS CARDS
    ============================================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    .stat-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 1.2rem;
        text-align: center;
        transition: var(--transition-bounce);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        background: var(--primary-soft);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
    }

    .stat-icon i { font-size: 1.3rem; color: var(--primary); }
    .stat-value { font-size: 1.6rem; font-weight: 800; line-height: 1.2; }
    .stat-label { font-size: 0.65rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--gray); margin-top: 0.3rem; }

    /* ============================================
       FILTER & SEARCH PREMIUM
    ============================================ */
    .filter-section {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .filter-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .filter-btn {
        padding: 0.6rem 1.5rem;
        background: white;
        border: 1px solid var(--border);
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray);
        cursor: pointer;
        transition: var(--transition-bounce);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
        overflow: hidden;
    }

    .filter-btn::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 0;
        height: 2px;
        background: var(--primary);
        transition: width 0.3s;
    }

    .filter-btn:hover::before {
        width: 100%;
    }

    .filter-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
    }

    .filter-btn.active {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
    }

    .filter-btn.active::before {
        background: white;
    }

    .search-wrapper {
        position: relative;
        width: 280px;
    }

    .search-input {
        width: 100%;
        padding: 0.7rem 1rem 0.7rem 2.5rem;
        background: white;
        border: 1px solid var(--border);
        border-radius: 60px;
        font-size: 0.8rem;
        transition: var(--transition);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-soft);
    }

    .search-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--gray-light);
        font-size: 0.8rem;
    }

    /* ============================================
       UMKM GRID PREMIUM
    ============================================ */
    .umkm-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .umkm-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        transition: var(--transition-bounce);
        border: 1px solid var(--border);
        animation: fadeInUp 0.6s ease both;
    }

    .umkm-card:nth-child(1) { animation-delay: 0.1s; }
    .umkm-card:nth-child(2) { animation-delay: 0.15s; }
    .umkm-card:nth-child(3) { animation-delay: 0.2s; }
    .umkm-card:nth-child(4) { animation-delay: 0.25s; }
    .umkm-card:nth-child(5) { animation-delay: 0.3s; }
    .umkm-card:nth-child(6) { animation-delay: 0.35s; }

    .umkm-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary);
    }

    .umkm-image {
        position: relative;
        height: 220px;
        overflow: hidden;
    }

    .umkm-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s var(--transition-slow);
    }

    .umkm-card:hover .umkm-image img {
        transform: scale(1.08);
    }

    .umkm-category {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.3rem 1rem;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(4px);
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--primary-dark);
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .umkm-content {
        padding: 1.2rem;
    }

    .umkm-title {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 0.3rem;
        transition: var(--transition);
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .umkm-card:hover .umkm-title {
        color: var(--primary);
    }

    .umkm-meta {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 0.7rem;
        color: var(--gray);
        margin-bottom: 0.5rem;
    }

    .umkm-meta i {
        width: 14px;
        color: var(--primary);
    }

    .umkm-address {
        font-size: 0.7rem;
        color: var(--gray);
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .umkm-address i {
        color: var(--primary);
        font-size: 0.65rem;
        width: 14px;
    }

    .umkm-desc {
        font-size: 0.75rem;
        color: var(--gray-light);
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .umkm-link {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        transition: var(--transition);
    }

    .umkm-link:hover {
        gap: 0.7rem;
    }

    /* ============================================
       EMPTY STATE
    ============================================ */
    .empty-state {
        grid-column: span 3;
        text-align: center;
        padding: 4rem;
        background: white;
        border-radius: 28px;
        border: 1px solid var(--border);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--gray-soft);
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .empty-icon i { font-size: 2.5rem; color: var(--gray-light); }

    /* ============================================
       PAGINATION PREMIUM
    ============================================ */
    .pagination-wrapper {
        margin-top: 2.5rem;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .pagination .page-link {
        padding: 0.5rem 1rem;
        border-radius: 14px;
        background: white;
        border: 1px solid var(--border);
        color: var(--gray);
        font-size: 0.8rem;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
    }

    .pagination .active .page-link {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-color: transparent;
        box-shadow: 0 2px 8px rgba(16,185,129,0.2);
    }

    .pagination .page-link:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    /* ============================================
       TUTORIAL SECTION
    ============================================ */
    .tutorial-section {
        margin-top: 3rem;
        background: white;
        border-radius: 28px;
        padding: 1.8rem;
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .tutorial-section:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i { font-size: 1.3rem; color: var(--primary); }
    .tutorial-header h3 { font-size: 0.9rem; font-weight: 700; margin: 0; }

    .tutorial-intro {
        font-size: 0.8rem;
        color: var(--gray);
        margin-bottom: 1rem;
        line-height: 1.6;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.6rem;
        border-radius: 16px;
        transition: var(--transition);
    }

    .tutorial-item:hover {
        background: var(--primary-soft);
        transform: translateX(3px);
    }

    .tutorial-num {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    .tutorial-text h4 { font-size: 0.8rem; font-weight: 700; margin-bottom: 0.2rem; }
    .tutorial-text p { font-size: 0.65rem; color: var(--gray); line-height: 1.4; }

    .tutorial-footer {
        margin-top: 1rem;
        padding: 0.8rem 1rem;
        background: #ecfdf5;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .tutorial-footer i { color: var(--primary); }
    .tutorial-footer span { font-size: 0.7rem; color: #059669; }

    /* Responsive */
    @media (max-width: 1024px) {
        .umkm-grid { grid-template-columns: repeat(2, 1fr); }
        .empty-state { grid-column: span 2; }
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 0.8rem; }
        .umkm-grid { grid-template-columns: 1fr; }
        .empty-state { grid-column: span 1; }
        .filter-section { flex-direction: column; }
        .search-wrapper { width: 100%; }
        .filter-group { justify-content: center; }
        .tutorial-grid { grid-template-columns: 1fr; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="bg-pattern"></div>
<div class="bg-ornament ornament-1"></div>
<div class="bg-ornament ornament-2"></div>

<div class="container-premium">

    {{-- Header Section --}}
    <div class="header-section">
        <div class="header-badge">
            <i class="fa-solid fa-store"></i>
            <span>Produk Lokal</span>
        </div>
        <h1 class="header-title">
            UMKM <span>Lumban Silintong</span>
        </h1>
        <p class="header-subtitle">
            Dukung produk lokal! Temukan berbagai produk unggulan dari UMKM Desa Lumban Silintong.
        </p>
    </div>

    {{-- Statistics Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-store"></i></div>
            <div class="stat-value">{{ $umkms->total() }}</div>
            <div class="stat-label">Total UMKM</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-utensils"></i></div>
            <div class="stat-value">{{ $umkms->where('kategori', 'makanan')->count() }}</div>
            <div class="stat-label">Makanan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-palette"></i></div>
            <div class="stat-value">{{ $umkms->where('kategori', 'kerajinan')->count() }}</div>
            <div class="stat-label">Kerajinan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-shirt"></i></div>
            <div class="stat-value">{{ $umkms->where('kategori', 'fashion')->count() }}</div>
            <div class="stat-label">Fashion</div>
        </div>
    </div>

    {{-- Filter & Search --}}
    <div class="filter-section">
        <div class="filter-group">
            <button class="filter-btn active" data-filter="all">
                <i class="fa-solid fa-layer-group"></i> Semua
            </button>
            <button class="filter-btn" data-filter="makanan">
                <i class="fa-solid fa-utensils"></i> Makanan
            </button>
            <button class="filter-btn" data-filter="kerajinan">
                <i class="fa-solid fa-palette"></i> Kerajinan
            </button>
            <button class="filter-btn" data-filter="fashion">
                <i class="fa-solid fa-shirt"></i> Fashion
            </button>
            <button class="filter-btn" data-filter="pertanian">
                <i class="fa-solid fa-seedling"></i> Pertanian
            </button>
        </div>
        <div class="search-wrapper">
            <i class="fa-solid fa-search search-icon"></i>
            <input type="text" id="search-umkm" class="search-input" placeholder="Cari UMKM...">
        </div>
    </div>

    {{-- UMKM Grid --}}
    <div class="umkm-grid" id="umkm-grid">
        @forelse($umkms as $umkm)
        <div class="umkm-card" data-kategori="{{ $umkm->kategori ?? 'umum' }}" data-nama="{{ strtolower($umkm->nama_usaha) }}">
            <div class="umkm-image">
                <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=500' }}" alt="{{ $umkm->nama_usaha }}">
                <div class="umkm-category">
                    @if($umkm->kategori == 'makanan') 🍔 Makanan
                    @elseif($umkm->kategori == 'kerajinan') 🎨 Kerajinan
                    @elseif($umkm->kategori == 'fashion') 👕 Fashion
                    @elseif($umkm->kategori == 'pertanian') 🌾 Pertanian
                    @else 🏪 UMKM @endif
                </div>
            </div>
            <div class="umkm-content">
                <h3 class="umkm-title">{{ $umkm->nama_usaha }}</h3>
                <div class="umkm-meta">
                    <i class="fa-regular fa-user"></i>
                    <span>{{ $umkm->pemilik ?? $umkm->user->name ?? 'Pengelola' }}</span>
                </div>
                <div class="umkm-address">
                    <i class="fa-solid fa-location-dot"></i>
                    <span>{{ $umkm->alamat_usaha ?? $umkm->alamat ?? 'Alamat tidak tersedia' }}</span>
                </div>
                <div class="umkm-meta">
                    <i class="fa-solid fa-phone"></i>
                    <span>{{ $umkm->no_telepon ?? $umkm->nomor_telepon ?? '-' }}</span>
                </div>
                <p class="umkm-desc">{{ Str::limit($umkm->deskripsi ?? 'Deskripsi belum tersedia', 80) }}</p>
                <a href="{{ route('umkm.show', $umkm->id_umkm) }}" class="umkm-link">
                    Lihat Detail <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon"><i class="fa-solid fa-store"></i></div>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada UMKM</h3>
            <p class="text-gray-400 mt-2">Belum ada UMKM yang terdaftar.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($umkms->hasPages())
    <div class="pagination-wrapper">
        {{ $umkms->appends(request()->query())->links() }}
    </div>
    @endif

    {{-- Tutorial Section --}}
    <div class="tutorial-section">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman UMKM</h3>
        </div>
        <p class="tutorial-intro">
            Halaman <strong>UMKM Desa Lumban Silintong</strong> menampilkan daftar Usaha Mikro Kecil dan Menengah yang terdaftar di desa. Dukung produk lokal dengan berbelanja di UMKM desa.
        </p>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>🏷️ Filter Kategori</h4>
                    <p>Gunakan tombol filter untuk menyaring UMKM berdasarkan kategori (Makanan, Kerajinan, Fashion, Pertanian).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>🔍 Pencarian</h4>
                    <p>Gunakan kolom pencarian untuk mencari UMKM berdasarkan nama usaha.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>📋 Lihat Detail</h4>
                    <p>Klik tombol "Lihat Detail" untuk melihat informasi lengkap UMKM, termasuk kontak dan produk.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>📊 Statistik</h4>
                    <p>Lihat total jumlah UMKM dan jumlah per kategori di bagian atas halaman.</p>
                </div>
            </div>
        </div>
        <div class="tutorial-footer">
            <i class="fa-regular fa-bell"></i>
            <span>💡 <strong>Tips:</strong> Dukung UMKM lokal dengan membeli produk-produk unggulan desa Lumban Silintong.</span>
        </div>
    </div>
</div>

<script>
    // Filter Kategori
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active');
                b.classList.remove('bg-gradient-to-r', 'from-emerald-600', 'to-emerald-500', 'text-white', 'shadow-md');
                b.classList.add('bg-white', 'border-gray-200', 'text-gray-600');
            });
            this.classList.add('active');
            this.classList.remove('bg-white', 'border-gray-200', 'text-gray-600');
            this.classList.add('bg-gradient-to-r', 'from-emerald-600', 'to-emerald-500', 'text-white', 'shadow-md');
            
            const filter = this.dataset.filter;
            const cards = document.querySelectorAll('.umkm-card');
            
            cards.forEach(card => {
                if (filter === 'all' || card.dataset.kategori === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    // Search UMKM
    const searchInput = document.getElementById('search-umkm');
    if (searchInput) {
        searchInput.addEventListener('keyup', function() {
            const search = this.value.toLowerCase();
            const cards = document.querySelectorAll('.umkm-card');
            
            cards.forEach(card => {
                const nama = card.dataset.nama;
                if (search === '' || (nama && nama.includes(search))) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    }
</script>
@endsection