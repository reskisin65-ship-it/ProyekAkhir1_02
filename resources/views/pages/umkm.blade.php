{{-- resources/views/pages/umkm.blade.php --}}
@extends('layouts.app')

@section('title', 'Katalog UMKM - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&family=Outfit:wght@100;300;500;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>

<style>
    /* ============================================
       DESIGN SYSTEM PREMIUM
    ============================================ */
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.06);
        --primary-glow: rgba(16, 185, 129, 0.15);
        --emerald-deep: #064e3b;
        --dark: #0f172a;
        --gray: #64748b;
        --gray-light: #94a3b8;
        --gray-soft: #f1f5f9;
        --bg: #fafbfc;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.04);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.06);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.1);
        --shadow-2xl: 0 32px 64px rgba(0,0,0,0.12);
        --transition: all 0.4s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.5s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: var(--dark);
        -webkit-font-smoothing: antialiased;
        overflow-x: hidden;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--gray-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    /* Background Pattern & Ornaments */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
        background-size: 20px 20px;
        opacity: 0.4;
    }

    .bg-ornament {
        position: fixed;
        width: 60vw;
        height: 60vw;
        border-radius: 50%;
        z-index: -1;
        filter: blur(120px);
        opacity: 0.3;
        pointer-events: none;
    }
    .ornament-1 { 
        top: -20%; 
        right: -10%; 
        background: radial-gradient(circle, var(--primary-light) 0%, transparent 70%);
        animation: floatSlow 20s ease-in-out infinite;
    }
    .ornament-2 { 
        bottom: -20%; 
        left: -10%; 
        background: radial-gradient(circle, #8b5cf6 0%, transparent 70%);
        animation: floatSlow 25s ease-in-out infinite reverse;
    }
    @keyframes floatSlow {
        0%, 100% { transform: translate(0, 0) scale(1); }
        33% { transform: translate(-30px, -20px) scale(1.05); }
        66% { transform: translate(20px, -30px) scale(1.03); }
    }

    .container-premium {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ============================================
       HERO SECTION
    ============================================ */
    .hero-section {
        text-align: center;
        margin-bottom: 3rem;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 1rem;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease forwards;
    }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
        color: var(--dark);
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.7s ease 0.1s forwards;
    }

    .hero-title span {
        color: var(--primary);
        font-family: 'Playfair Display', serif;
        font-style: italic;
        display: inline-block;
    }

    .hero-subtitle {
        font-size: 0.9rem;
        color: var(--gray);
        margin-top: 0.5rem;
        max-width: 550px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease 0.2s forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Stats Row */
    .stats-row {
        display: flex;
        justify-content: center;
        gap: 2rem;
        margin-top: 2rem;
        flex-wrap: wrap;
    }

    .stat-item {
        text-align: center;
        padding: 0.5rem 1.5rem;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.5s ease forwards;
    }
    .stat-item:nth-child(1) { animation-delay: 0.25s; }
    .stat-item:nth-child(2) { animation-delay: 0.3s; }
    .stat-item:nth-child(3) { animation-delay: 0.35s; }
    .stat-item:nth-child(4) { animation-delay: 0.4s; }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 800;
        color: var(--primary);
        line-height: 1;
        transition: all 0.3s ease;
    }

    .stat-item:hover .stat-number {
        transform: scale(1.1);
        text-shadow: 0 0 10px var(--primary-glow);
    }

    .stat-label {
        font-size: 0.65rem;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--gray);
        letter-spacing: 0.05em;
    }

    /* ============================================
       FILTER SECTION
    ============================================ */
    .filter-section {
        margin-bottom: 2rem;
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease 0.45s forwards;
    }

    .filter-wrapper {
        background: white;
        border-radius: 80px;
        padding: 0.8rem;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border);
    }

    .filter-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        flex: 1;
    }

    .filter-btn {
        padding: 0.6rem 1.5rem;
        background: transparent;
        border: none;
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray);
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        position: relative;
    }

    .filter-btn::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: var(--primary);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .filter-btn:hover::after {
        width: 30px;
    }

    .filter-btn:hover {
        color: var(--primary);
        transform: translateY(-3px);
        background: var(--primary-soft);
    }

    .filter-btn.active {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: 0 4px 15px rgba(16, 185, 129, 0.25);
    }

    .filter-btn.active::after {
        background: white;
    }

    .search-wrapper {
        position: relative;
        width: 280px;
    }

    .search-input {
        width: 100%;
        padding: 0.7rem 1rem 0.7rem 2.5rem;
        background: var(--gray-soft);
        border: none;
        border-radius: 60px;
        font-size: 0.8rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        background: white;
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
       UMKM GRID
    ============================================ */
    .umkm-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.8rem;
        min-height: 400px;
    }

    .umkm-card {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        display: block;
    }

    .umkm-card:hover {
        transform: translateY(-10px);
        box-shadow: var(--shadow-2xl);
        border-color: var(--primary);
    }

    .card-inner {
        position: relative;
        background: white;
        overflow: hidden;
    }

    .img-zoom-wrapper {
        position: relative;
        overflow: hidden;
        height: 280px;
    }

    .img-zoom-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .umkm-card:hover .img-zoom-wrapper img {
        transform: scale(1.12) rotate(1deg);
    }

    .img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.8), rgba(0,0,0,0.2), transparent);
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    .umkm-card:hover .img-overlay {
        opacity: 1;
    }

    .category-badge {
        position: absolute;
        top: 1rem;
        left: 1rem;
        padding: 0.3rem 1rem;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(4px);
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 700;
        color: var(--primary-dark);
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        z-index: 2;
        transform: translateX(0);
    }

    .umkm-card:hover .category-badge {
        background: var(--primary);
        color: white;
        transform: translateX(5px);
    }

    .hover-action {
        position: absolute;
        bottom: 1.5rem;
        left: 0;
        right: 0;
        text-align: center;
        transform: translateY(30px);
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.34, 1.2, 0.64, 1);
        z-index: 2;
    }

    .umkm-card:hover .hover-action {
        transform: translateY(0);
        opacity: 1;
    }

    .detail-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        padding: 0.7rem 1.5rem;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--primary);
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }

    .detail-link:hover {
        background: var(--primary);
        color: white;
        gap: 0.8rem;
        transform: scale(1.05);
    }

    .umkm-content {
        padding: 1.2rem;
    }

    .umkm-title {
        font-size: 1rem;
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 0.3rem;
        transition: all 0.3s ease;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .umkm-card:hover .umkm-title {
        color: var(--primary);
        transform: translateX(5px);
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
        transition: all 0.3s ease;
    }

    .umkm-card:hover .umkm-meta i {
        transform: scale(1.1);
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

    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 0.8rem;
        border-top: 1px solid var(--border);
    }

    .owner-info {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .owner-avatar {
        width: 32px;
        height: 32px;
        background: var(--primary-soft);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .umkm-card:hover .owner-avatar {
        background: var(--primary);
        transform: scale(1.05);
    }

    .umkm-card:hover .owner-avatar i {
        color: white;
    }

    .owner-avatar i {
        font-size: 0.7rem;
        color: var(--primary);
        transition: all 0.3s ease;
    }

    .owner-name {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--dark);
    }

    .wa-btn {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--gray);
        transition: all 0.3s cubic-bezier(0.34, 1.2, 0.64, 1);
        text-decoration: none;
    }

    .wa-btn:hover {
        background: #25d366;
        color: white;
        border-color: #25d366;
        transform: scale(1.1) rotate(5deg);
    }

    /* Empty State */
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
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .empty-icon i { font-size: 2.5rem; color: var(--gray-light); }

    /* Pagination */
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
        transition: all 0.3s ease;
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
        transform: translateY(-2px) scale(1.05);
    }

    /* Footer CTA */
    .footer-cta {
        margin-top: 3rem;
        background: linear-gradient(135deg, var(--emerald-deep), #0f2b22);
        border-radius: 32px;
        padding: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .footer-cta::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.05) 0%, transparent 70%);
        animation: rotateBg 20s linear infinite;
    }

    @keyframes rotateBg {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }

    .footer-cta:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-2xl);
    }

    .footer-cta h3 {
        font-size: 1.6rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
        position: relative;
        z-index: 1;
    }

    .footer-cta p {
        color: var(--primary-light);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .btn-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.9rem 2rem;
        background: white;
        color: var(--emerald-deep);
        border-radius: 60px;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        position: relative;
        z-index: 1;
    }

    .btn-cta:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-3px) scale(1.05);
        gap: 1rem;
        box-shadow: 0 10px 25px rgba(16,185,129,0.3);
    }

    /* Tutorial Section */
    .tutorial-section {
        margin-top: 2.5rem;
        background: white;
        border-radius: 28px;
        padding: 1.8rem;
        border: 1px solid var(--border);
        transition: all 0.4s ease;
    }

    .tutorial-section:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
        transform: translateY(-5px);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i { 
        font-size: 1.3rem; 
        color: var(--primary);
        transition: all 0.3s ease;
    }

    .tutorial-section:hover .tutorial-header i {
        transform: scale(1.1) rotate(5deg);
    }

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
        transition: all 0.3s ease;
    }

    .tutorial-item:hover {
        background: var(--primary-soft);
        transform: translateX(5px);
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
        transition: all 0.3s ease;
    }

    .tutorial-item:hover .tutorial-num {
        transform: scale(1.1) rotate(5deg);
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
        transition: all 0.3s ease;
    }

    .tutorial-section:hover .tutorial-footer {
        background: #d1fae5;
    }

    .tutorial-footer i { color: var(--primary); }
    .tutorial-footer span { font-size: 0.7rem; color: #059669; }

    /* Responsive */
    @media (max-width: 1024px) {
        .umkm-grid { grid-template-columns: repeat(2, 1fr); }
        .empty-state { grid-column: span 2; }
        .filter-wrapper { flex-direction: column; border-radius: 28px; }
        .search-wrapper { width: 100%; }
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .umkm-grid { grid-template-columns: 1fr; }
        .empty-state { grid-column: span 1; }
        .hero-title { font-size: 2rem; }
        .stats-row { flex-direction: column; align-items: center; gap: 1rem; }
        .filter-group { justify-content: center; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .footer-cta { padding: 2rem; }
        .footer-cta h3 { font-size: 1.2rem; }
    }
</style>

<div class="bg-pattern"></div>
<div class="bg-ornament ornament-1"></div>
<div class="bg-ornament ornament-2"></div>

<div class="container-premium">

    {{-- HERO SECTION --}}
    <div class="hero-section">
        <div class="hero-badge">
            <i class="fa-solid fa-store"></i>
            <span>UMKM Desa</span>
        </div>
        <h1 class="hero-title">
            Katalog <span>UMKM</span><br>
            Lumban Silintong
        </h1>
        <p class="hero-subtitle">
            Temukan berbagai produk unggulan dari UMKM Desa Lumban Silintong. 
            Dukung produk lokal dan tingkatkan perekonomian desa.
        </p>
        <div class="stats-row">
            <div class="stat-item">
                <div class="stat-number">{{ $umkms->total() }}</div>
                <div class="stat-label">Total UMKM</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $umkms->where('kategori', 'makanan')->count() }}</div>
                <div class="stat-label">Kuliner</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $umkms->where('kategori', 'kerajinan')->count() }}</div>
                <div class="stat-label">Kerajinan</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">{{ $umkms->where('kategori', 'fashion')->count() }}</div>
                <div class="stat-label">Fashion</div>
            </div>
        </div>
    </div>

    {{-- FILTER & SEARCH --}}
    <div class="filter-section">
        <div class="filter-wrapper">
            <div class="filter-group">
                <button class="filter-btn active" data-filter="all">
                    <i class="fa-solid fa-layer-group"></i> Semua
                </button>
                <button class="filter-btn" data-filter="makanan">
                    <i class="fa-solid fa-utensils"></i> Kuliner
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
                <input type="text" id="search-umkm" class="search-input" placeholder="Cari produk atau usaha...">
            </div>
        </div>
    </div>

    {{-- UMKM GRID --}}
    <div class="umkm-grid" id="umkm-grid">
        @forelse($umkms as $umkm)
        <div class="umkm-card" data-kategori="{{ $umkm->kategori ?? 'umum' }}" data-nama="{{ strtolower($umkm->nama_usaha) }}">
            <div class="card-inner">
                <div class="img-zoom-wrapper">
                    <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=500' }}" alt="{{ $umkm->nama_usaha }}">
                    <div class="img-overlay"></div>
                    <div class="category-badge">
                        @if($umkm->kategori == 'makanan') 🍔 Kuliner
                        @elseif($umkm->kategori == 'kerajinan') 🎨 Kerajinan
                        @elseif($umkm->kategori == 'fashion') 👕 Fashion
                        @elseif($umkm->kategori == 'pertanian') 🌾 Pertanian
                        @else 🏪 UMKM @endif
                    </div>
                    <div class="hover-action">
                        <a href="{{ route('umkm.show', $umkm->id_umkm) }}" class="detail-link">
                            Lihat Detail <i class="fa-solid fa-arrow-right"></i>
                        </a>
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
                        <span>{{ $umkm->alamat_usaha ?? $umkm->alamat ?? 'Lumban Silintong, Toba' }}</span>
                    </div>
                    <p class="umkm-desc">{{ Str::limit($umkm->deskripsi ?? 'Deskripsi belum tersedia', 80) }}</p>
                    <div class="card-footer">
                        <div class="owner-info">
                            <div class="owner-avatar">
                                <i class="fa-regular fa-user"></i>
                            </div>
                            <span class="owner-name">{{ $umkm->pemilik ?? 'Pemilik' }}</span>
                        </div>
                        @if($umkm->no_telepon)
                        <a href="https://wa.me/{{ $umkm->no_telepon }}" class="wa-btn" target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fa-solid fa-store"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada UMKM</h3>
            <p class="text-gray-400 mt-2">Belum ada UMKM yang terdaftar.</p>
        </div>
        @endforelse
    </div>

    {{-- PAGINATION --}}
    @if($umkms->hasPages())
    <div class="pagination-wrapper">
        {{ $umkms->appends(request()->query())->links() }}
    </div>
    @endif

    {{-- FOOTER CTA --}}
    <div class="footer-cta">
        <h3>✨ Mau Daftarkan UMKM Anda?</h3>
        <p>Bergabunglah bersama UMKM lainnya di Desa Lumban Silintong</p>
        <a href="{{ route('login') }}" class="btn-cta">
            Login untuk Mendaftar <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>

    {{-- TUTORIAL SECTION --}}
    <div class="tutorial-section">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman UMKM</h3>
        </div>
        <p class="tutorial-intro">
            Halaman <strong>Katalog UMKM</strong> menampilkan daftar Usaha Mikro Kecil dan Menengah yang terdaftar di Desa Lumban Silintong. 
            Temukan produk unggulan dan dukung ekonomi lokal.
        </p>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>🏷️ Filter Kategori</h4>
                    <p>Gunakan tombol filter untuk menyaring UMKM berdasarkan kategori.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>🔍 Pencarian</h4>
                    <p>Cari UMKM berdasarkan nama usaha menggunakan kolom pencarian.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>📋 Lihat Detail</h4>
                    <p>Klik "Lihat Detail" untuk informasi lengkap produk dan kontak penjual.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>💬 Hubungi Penjual</h4>
                    <p>Gunakan tombol WhatsApp untuk berkomunikasi langsung dengan pemilik UMKM.</p>
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
    
    document.addEventListener('DOMContentLoaded', function() {
        // ============================================
        // ELEMENTS
        // ============================================
        const filterBtns = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.umkm-card');
        const searchInput = document.getElementById('search-umkm');
        const grid = document.querySelector('.umkm-grid');
        
        // ============================================
        // ANIMATED FILTER FUNCTION WITH GSAP
        // ============================================
        async function filterCardsWithAnimation() {
            const activeFilter = document.querySelector('.filter-btn.active')?.dataset.filter || 'all';
            const searchQuery = searchInput ? searchInput.value.toLowerCase() : '';
            
            // 1. ANIMASI HILANG - semua card yang tampil akan fade out dan mengecil
            const visibleCards = Array.from(cards).filter(card => 
                card.style.display !== 'none' && getComputedStyle(card).display !== 'none'
            );
            
            if (visibleCards.length > 0) {
                await new Promise(resolve => {
                    gsap.to(visibleCards, {
                        scale: 0.9,
                        opacity: 0,
                        y: -20,
                        duration: 0.3,
                        stagger: 0.03,
                        ease: "power2.in",
                        onComplete: resolve
                    });
                });
            }
            
            // 2. PROSES FILTER - sembunyikan card yang tidak sesuai
            cards.forEach(card => {
                const kategori = card.dataset.kategori;
                const nama = card.dataset.nama;
                let matchesFilter = (activeFilter === 'all' || kategori === activeFilter);
                let matchesSearch = searchQuery === '' || (nama && nama.includes(searchQuery));
                
                if (matchesFilter && matchesSearch) {
                    card.style.display = 'block';
                    // Set state awal untuk animasi masuk
                    gsap.set(card, { scale: 0.9, opacity: 0, y: 20 });
                } else {
                    card.style.display = 'none';
                }
            });
            
            // 3. ANIMASI MUNCUL - card yang baru muncul akan fade in dan membesar
            const newVisibleCards = Array.from(cards).filter(card => card.style.display !== 'none');
            
            if (newVisibleCards.length > 0) {
                gsap.to(newVisibleCards, {
                    scale: 1,
                    opacity: 1,
                    y: 0,
                    duration: 0.4,
                    stagger: 0.04,
                    delay: 0.05,
                    ease: "back.out(0.5)",
                    overwrite: true
                });
            }
        }
        
        // ============================================
        // FILTER BUTTON CLICK HANDLER
        // ============================================
        if (filterBtns.length > 0) {
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Update active class
                    filterBtns.forEach(b => {
                        b.classList.remove('active');
                        b.classList.remove('bg-gradient-to-r', 'from-emerald-600', 'to-emerald-500', 'text-white', 'shadow-md');
                        b.classList.add('bg-transparent', 'text-gray-600');
                    });
                    this.classList.add('active');
                    this.classList.remove('bg-transparent', 'text-gray-600');
                    this.classList.add('bg-gradient-to-r', 'from-emerald-600', 'to-emerald-500', 'text-white', 'shadow-md');
                    
                    // Animate button click
                    gsap.to(this, {
                        scale: 0.95,
                        duration: 0.1,
                        yoyo: true,
                        repeat: 1,
                        ease: "power2.inOut"
                    });
                    
                    // Run animated filter
                    filterCardsWithAnimation();
                });
            });
        }
        
        // ============================================
        // SEARCH INPUT WITH DEBOUNCE & ANIMATION
        // ============================================
        let searchTimeout;
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    filterCardsWithAnimation();
                }, 300);
            });
        }
        
        // ============================================
        // INITIAL ANIMATION - TAMPILKAN SEMUA CARD DENGAN ANIMASI
        // ============================================
        function initialShowCards() {
            // Sembunyikan semua card dulu
            cards.forEach(card => {
                card.style.display = 'block';
                gsap.set(card, { scale: 0.9, opacity: 0, y: 30 });
            });
            
            // Munculkan dengan animasi stagger
            gsap.to(cards, {
                scale: 1,
                opacity: 1,
                y: 0,
                duration: 0.5,
                stagger: 0.05,
                delay: 0.3,
                ease: "back.out(0.5)",
                overwrite: true
            });
        }
        
        // Jalankan animasi awal
        initialShowCards();
        
        // ============================================
        // GSAP PAGE LOAD ANIMATIONS (Hero, Stats, dll)
        // ============================================
        gsap.from(".hero-badge", {
            y: -30,
            opacity: 0,
            duration: 0.6,
            ease: "back.out(0.5)"
        });
        
        gsap.from(".hero-title", {
            scale: 0.9,
            opacity: 0,
            duration: 0.8,
            delay: 0.1,
            ease: "back.out(0.4)"
        });
        
        gsap.from(".hero-subtitle", {
            y: 30,
            opacity: 0,
            duration: 0.6,
            delay: 0.2,
            ease: "power3.out"
        });
        
        gsap.from(".stat-item", {
            y: 20,
            opacity: 0,
            stagger: 0.08,
            duration: 0.5,
            delay: 0.3,
            ease: "power2.out"
        });
        
        gsap.from(".filter-section", {
            y: 20,
            opacity: 0,
            duration: 0.6,
            delay: 0.45,
            ease: "power2.out"
        });
        
        gsap.from(".footer-cta", {
            y: 30,
            opacity: 0,
            duration: 0.6,
            delay: 0.7,
            ease: "power2.out"
        });
        
        gsap.from(".tutorial-section", {
            y: 20,
            opacity: 0,
            duration: 0.5,
            delay: 0.8,
            ease: "power2.out"
        });
        
        // ============================================
        // SCROLL TRIGGER FOR TUTORIAL ITEMS
        // ============================================
        gsap.utils.toArray(".tutorial-item").forEach(item => {
            gsap.from(item, {
                scrollTrigger: {
                    trigger: ".tutorial-section",
                    start: "top 85%",
                },
                x: -20,
                opacity: 0,
                duration: 0.5,
                stagger: 0.08,
                ease: "power2.out"
            });
        });
        
        // ============================================
        // HOVER ENHANCEMENTS
        // ============================================
        cards.forEach(card => {
            card.addEventListener('mouseenter', () => {
                const link = card.querySelector('.detail-link');
                if (link) {
                    gsap.to(link, {
                        scale: 1.05,
                        duration: 0.3,
                        ease: "back.out(0.5)"
                    });
                }
                // Hover effect tambahan untuk card
                gsap.to(card, {
                    boxShadow: "0 32px 64px -12px rgba(0,0,0,0.12)",
                    duration: 0.3
                });
            });
            
            card.addEventListener('mouseleave', () => {
                const link = card.querySelector('.detail-link');
                if (link) {
                    gsap.to(link, {
                        scale: 1,
                        duration: 0.3,
                        ease: "power2.out"
                    });
                }
                gsap.to(card, {
                    boxShadow: "0 1px 2px rgba(0,0,0,0.02)",
                    duration: 0.3
                });
            });
        });
        
        // ============================================
        // PARALLAX EFFECT FOR ORNAMENTS
        // ============================================
        const ornaments = document.querySelectorAll('.bg-ornament');
        window.addEventListener('mousemove', (e) => {
            const xPos = (e.clientX / window.innerWidth) - 0.5;
            const yPos = (e.clientY / window.innerHeight) - 0.5;
            
            ornaments.forEach(ornament => {
                gsap.to(ornament, {
                    x: xPos * 40,
                    y: yPos * 40,
                    duration: 1.5,
                    ease: "power2.out"
                });
            });
        });
        
        console.log('UMKM Page Loaded - Animasi filter aktif!');
    });
</script>
@endsection