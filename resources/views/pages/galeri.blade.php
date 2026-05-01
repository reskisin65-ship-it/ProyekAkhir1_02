{{-- resources/views/pages/galeri.blade.php --}}
@extends('layouts.app')

@section('title', 'Galeri - Lumban Silintong')

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
        --shadow-2xl: 0 32px 64px rgba(0,0,0,0.1);
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
       FILTER BUTTONS PREMIUM
    ============================================ */
    .filter-container {
        margin-bottom: 2rem;
    }

    .filter-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        justify-content: center;
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

    /* ============================================
       GALERI GRID PREMIUM
    ============================================ */
    .galeri-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
    }

    .galeri-item {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        transition: var(--transition-bounce);
        animation: fadeInUp 0.6s ease both;
        cursor: pointer;
    }

    .galeri-item:nth-child(1) { animation-delay: 0.1s; }
    .galeri-item:nth-child(2) { animation-delay: 0.15s; }
    .galeri-item:nth-child(3) { animation-delay: 0.2s; }
    .galeri-item:nth-child(4) { animation-delay: 0.25s; }
    .galeri-item:nth-child(5) { animation-delay: 0.3s; }
    .galeri-item:nth-child(6) { animation-delay: 0.35s; }
    .galeri-item:nth-child(7) { animation-delay: 0.4s; }
    .galeri-item:nth-child(8) { animation-delay: 0.45s; }

    .galeri-item:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-2xl);
    }

    .galeri-image {
        aspect-ratio: 1 / 1;
        overflow: hidden;
        position: relative;
    }

    .galeri-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.7s var(--transition-slow);
        pointer-events: none; /* Biar klik ditangani oleh div parent */
    }

    .galeri-item:hover .galeri-image img {
        transform: scale(1.08);
    }

    .galeri-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2), transparent);
        opacity: 0;
        transition: var(--transition-slow);
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        padding: 1.2rem;
    }

    .galeri-item:hover .galeri-overlay {
        opacity: 1;
    }

    .galeri-info {
        transform: translateY(20px);
        transition: var(--transition-bounce);
        flex: 1;
    }

    .galeri-item:hover .galeri-info {
        transform: translateY(0);
    }

    .galeri-category {
        display: inline-block;
        padding: 0.2rem 0.7rem;
        background: var(--primary);
        color: white;
        border-radius: 40px;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .galeri-title {
        font-size: 0.85rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .galeri-date {
        font-size: 0.6rem;
        color: rgba(255,255,255,0.7);
    }

    /* Action Buttons on Hover */
    .galeri-actions {
        display: flex;
        gap: 0.5rem;
        transform: translateY(20px);
        transition: var(--transition-bounce);
        opacity: 0;
    }

    .galeri-item:hover .galeri-actions {
        transform: translateY(0);
        opacity: 1;
    }

    .galeri-action-btn {
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(4px);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: var(--transition-bounce);
        cursor: pointer;
        border: none;
    }

    .galeri-action-btn:hover {
        background: var(--primary);
        transform: scale(1.05);
    }

    /* Empty State */
    .empty-state {
        grid-column: span 4;
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
       LIGHTBOX PREMIUM
    ============================================ */
    .lightbox {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.95);
        backdrop-filter: blur(20px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 2rem;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .lightbox.show {
        display: flex;
    }

    .lightbox-container {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
    }

    .lightbox-close {
        position: absolute;
        top: -3rem;
        right: 0;
        background: none;
        border: none;
        color: white;
        font-size: 2rem;
        cursor: pointer;
        transition: var(--transition-bounce);
    }

    .lightbox-close:hover {
        color: var(--primary);
        transform: rotate(90deg);
    }

    .lightbox-img {
        max-width: 100%;
        max-height: 85vh;
        border-radius: 24px;
        box-shadow: var(--shadow-2xl);
    }

    .lightbox-caption {
        text-align: center;
        color: white;
        margin-top: 1rem;
        font-size: 0.85rem;
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
    @media (max-width: 1200px) {
        .galeri-grid { grid-template-columns: repeat(3, 1fr); }
        .empty-state { grid-column: span 3; }
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 0.8rem; }
        .galeri-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .empty-state { grid-column: span 2; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .filter-group { gap: 0.5rem; }
        .filter-btn { padding: 0.4rem 1rem; font-size: 0.7rem; }
    }

    @media (max-width: 480px) {
        .galeri-grid { grid-template-columns: 1fr; }
        .empty-state { grid-column: span 1; }
        .stats-grid { grid-template-columns: 1fr; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- Header Section --}}
    <div class="header-section">
        <div class="header-badge">
            <i class="fa-regular fa-images"></i>
            <span>Dokumentasi Desa</span>
        </div>
        <h1 class="header-title">
            Galeri <span>Kegiatan</span>
        </h1>
        <p class="header-subtitle">
            Dokumentasi momen berharga dalam kegiatan pembangunan, budaya, dan keseharian masyarakat Desa Lumban Silintong.
        </p>
    </div>

    {{-- Statistics Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-regular fa-images"></i></div>
            <div class="stat-value">{{ $galeris->total() }}</div>
            <div class="stat-label">Total Foto</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-regular fa-calendar-check"></i></div>
            <div class="stat-value">{{ $galeris->where('kategori', 'kegiatan')->count() }}</div>
            <div class="stat-label">Kegiatan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-hard-hat"></i></div>
            <div class="stat-value">{{ $galeris->where('kategori', 'pembangunan')->count() }}</div>
            <div class="stat-label">Pembangunan</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-drumstick-bite"></i></div>
            <div class="stat-value">{{ $galeris->where('kategori', 'budaya')->count() }}</div>
            <div class="stat-label">Budaya</div>
        </div>
    </div>

    {{-- Filter Buttons --}}
    <div class="filter-container">
        <div class="filter-group">
            <button class="filter-btn active" data-filter="all">
                <i class="fa-regular fa-layer-group"></i> Semua
            </button>
            <button class="filter-btn" data-filter="kegiatan">
                <i class="fa-regular fa-calendar-check"></i> Kegiatan
            </button>
            <button class="filter-btn" data-filter="pembangunan">
                <i class="fa-solid fa-hard-hat"></i> Pembangunan
            </button>
            <button class="filter-btn" data-filter="budaya">
                <i class="fa-solid fa-drumstick-bite"></i> Budaya
            </button>
            <button class="filter-btn" data-filter="wisata">
                <i class="fa-solid fa-tree"></i> Wisata
            </button>
            <button class="filter-btn" data-filter="umkm">
                <i class="fa-solid fa-store"></i> UMKM
            </button>
        </div>
    </div>

    {{-- Galeri Grid --}}
    <div class="galeri-grid" id="galeri-grid">
        @forelse($galeris as $index => $galeri)
        <div class="galeri-item" data-kategori="{{ $galeri->kategori }}" data-id="{{ $galeri->id_galeri }}" 
             onclick="openLightbox(this, '{{ asset('storage/' . $galeri->gambar_galeri) }}', '{{ addslashes($galeri->judul_galeri) }}')">
            <div class="galeri-image">
                <img src="{{ asset('storage/' . $galeri->gambar_galeri) }}" alt="{{ $galeri->judul_galeri }}">
            </div>
            <div class="galeri-overlay">
                <div class="galeri-info">
                    <span class="galeri-category">
                        @if($galeri->kategori == 'kegiatan') 📅 Kegiatan
                        @elseif($galeri->kategori == 'pembangunan') 🏗️ Pembangunan
                        @elseif($galeri->kategori == 'budaya') 🎭 Budaya
                        @elseif($galeri->kategori == 'wisata') 🌲 Wisata
                        @else 🏪 UMKM @endif
                    </span>
                    <h4 class="galeri-title">{{ Str::limit($galeri->judul_galeri, 45) }}</h4>
                    <div class="galeri-date">
                        <i class="fa-regular fa-calendar"></i> {{ $galeri->created_at->translatedFormat('d M Y') }}
                    </div>
                </div>
                <div class="galeri-actions">
                    <a href="{{ route('galeri.show', $galeri->id_galeri) }}" class="galeri-action-btn" title="Lihat Detail" onclick="event.stopPropagation()">
                        <i class="fa-regular fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon"><i class="fa-regular fa-images"></i></div>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada Galeri</h3>
            <p class="text-gray-400 mt-2">Belum ada dokumentasi foto yang diunggah.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($galeris->hasPages())
    <div class="pagination-wrapper">
        {{ $galeris->appends(request()->query())->links() }}
    </div>
    @endif

    {{-- Tutorial Section --}}
    <div class="tutorial-section">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Galeri</h3>
        </div>
        <p class="tutorial-intro">
            Halaman <strong>Galeri Kegiatan</strong> menampilkan dokumentasi foto kegiatan, pembangunan, budaya, wisata, dan UMKM Desa Lumban Silintong.
        </p>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>🖼️ Klik Gambar</h4>
                    <p>Klik langsung pada gambar untuk melihat <strong>preview foto</strong> dalam ukuran besar (lightbox).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>👁️ Icon Mata</h4>
                    <p>Klik icon <strong><i class="fa-regular fa-eye"></i> mata</strong> untuk melihat <strong>halaman detail</strong> foto (deskripsi lengkap).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>🏷️ Filter Kategori</h4>
                    <p>Gunakan tombol filter di atas untuk menyaring foto berdasarkan kategori.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>❌ Tutup Preview</h4>
                    <p>Klik tombol <strong>ESC</strong> atau klik area luar gambar untuk menutup preview.</p>
                </div>
            </div>
        </div>
        <div class="tutorial-footer">
            <i class="fa-regular fa-bell"></i>
            <span>💡 <strong>Tips:</strong> Klik gambar untuk preview cepat, atau klik icon mata untuk melihat detail lengkap foto.</span>
        </div>
    </div>
</div>

{{-- Lightbox Modal --}}
<div id="lightbox" class="lightbox" onclick="closeLightbox()">
    <div class="lightbox-container" onclick="event.stopPropagation()">
        <button class="lightbox-close" onclick="closeLightbox()">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>
        <img id="lightbox-img" class="lightbox-img" src="">
        <div id="lightbox-caption" class="lightbox-caption"></div>
    </div>
</div>

<script>
    // Lightbox functions
    function openLightbox(element, imgSrc, caption) {
        event.stopPropagation();
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxCaption = document.getElementById('lightbox-caption');
        
        lightboxImg.src = imgSrc;
        lightboxCaption.innerHTML = caption;
        lightbox.classList.add('show');
        document.body.style.overflow = 'hidden';
    }
    
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.remove('show');
        document.body.style.overflow = '';
    }
    
    // Close with ESC key
    document.addEventListener('keydown', function(e) {
        const lightbox = document.getElementById('lightbox');
        if (e.key === 'Escape' && lightbox.classList.contains('show')) {
            closeLightbox();
        }
    });
    
    // Filter Galeri
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active');
            });
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            const items = document.querySelectorAll('.galeri-item');
            
            items.forEach(item => {
                if (filter === 'all' || item.dataset.kategori === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection