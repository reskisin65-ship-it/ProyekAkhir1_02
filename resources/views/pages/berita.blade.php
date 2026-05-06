{{-- resources/views/pages/berita.blade.php --}}
@extends('layouts.app')

@section('title', 'Berita & Pengumuman - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* ============================================
       DESIGN SYSTEM PREMIUM
    ============================================ */
    :root {
        --system-bg: #0a0a0a;
        --card-bg: #ffffff;
        --accent-primary: #10b981;
        --accent-primary-dark: #059669;
        --accent-orange: #f97316;
        --accent-orange-dark: #ea580c;
        --accent-blue: #3b82f6;
        --text-main: #171717;
        --text-mute: #737373;
        --border-color: #f1f1f1;
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.04);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.06);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.08);
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #fafafa;
        color: var(--text-main);
        letter-spacing: -0.02em;
    }

    .font-display { font-family: 'Instrument Sans', sans-serif; }

    /* Background Pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    /* Premium Container */
    .dashboard-wrapper {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 2rem;
    }

    /* ============================================
       HEADER SECTION
    ============================================ */
    .editorial-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 3rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .brand-title {
        font-size: 4rem;
        font-weight: 800;
        line-height: 0.9;
        letter-spacing: -0.05em;
        color: var(--system-bg);
    }

    .brand-title span {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary-dark));
        background-clip: text;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .brand-subtitle {
        font-size: 0.9rem;
        color: var(--text-mute);
        margin-top: 1rem;
        max-width: 450px;
        line-height: 1.6;
    }

    /* ============================================
       STATISTICS PREMIUM CARDS
    ============================================ */
    .stats-premium-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        margin-bottom: 2rem;
        justify-content: flex-start;
    }

    .stat-premium-card {
        flex: 1;
        min-width: 180px;
        background: #ffffff;
        border: 1px solid var(--border-color);
        border-radius: 28px;
        padding: 1.2rem 1.5rem;
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        box-shadow: var(--shadow-sm);
        position: relative;
        overflow: hidden;
    }

    .stat-premium-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
        border-color: var(--accent-primary);
    }

    .card-shimmer {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.4), transparent);
        transition: 0.5s;
        z-index: 0;
    }

    .stat-premium-card:hover .card-shimmer {
        left: 100%;
    }

    .card-inner {
        display: flex;
        align-items: center;
        gap: 1rem;
        position: relative;
        z-index: 1;
    }

    .icon-box {
        width: 56px;
        height: 56px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .icon-box.emerald { background: #ecfdf5; color: #10b981; }
    .icon-box.blue { background: #eff6ff; color: #3b82f6; }
    .icon-box.amber { background: #fffbeb; color: #f59e0b; }

    .stat-data { flex: 1; }

    .stat-value-container {
        display: flex;
        align-items: baseline;
        gap: 2px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        line-height: 1.2;
    }

    .stat-name {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
        margin-top: 0.2rem;
    }

    .card-progress-bar {
        margin-top: 1rem;
        height: 4px;
        background: #f1f5f9;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease;
    }

    .progress-fill.emerald { background: #10b981; }
    .progress-fill.blue { background: #3b82f6; }
    .progress-fill.amber { background: #f59e0b; }

    /* ============================================
       FEATURED BERITA
    ============================================ */
    .featured-section {
        margin-bottom: 2.5rem;
    }

    .featured-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
        transition: var(--transition-bounce);
        cursor: pointer;
    }

    .featured-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-xl);
        border-color: var(--accent-primary);
    }

    .featured-inner {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 0;
    }

    .featured-image {
        height: 300px;
        overflow: hidden;
        position: relative;
    }

    .featured-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .featured-card:hover .featured-image img {
        transform: scale(1.05);
    }

    .featured-overlay {
        position: absolute;
        top: 1rem;
        left: 1rem;
    }

    .featured-category {
        padding: 0.3rem 1rem;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary-dark));
        color: white;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .featured-content {
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .featured-meta {
        display: flex;
        gap: 1rem;
        margin-bottom: 0.8rem;
        font-size: 0.7rem;
        color: var(--text-mute);
    }

    .featured-meta i { margin-right: 0.3rem; }

    .featured-content h2 {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        line-height: 1.35;
    }

    .featured-content h2 a {
        color: var(--text-main);
        text-decoration: none;
        transition: var(--transition);
    }

    .featured-content h2 a:hover {
        color: var(--accent-primary);
    }

    .featured-excerpt {
        font-size: 0.85rem;
        color: var(--text-mute);
        line-height: 1.6;
        margin-bottom: 1.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .featured-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--accent-primary);
        text-decoration: none;
        transition: var(--transition);
    }

    .featured-link:hover { gap: 0.8rem; }

    /* ============================================
       FILTER BUTTONS
    ============================================ */
    .filter-container {
        margin-bottom: 2rem;
    }

    .filter-group {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        justify-content: flex-start;
    }

    .filter-btn {
        padding: 0.5rem 1.3rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 60px;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--text-mute);
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
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
        background: var(--accent-primary);
        transition: width 0.3s;
    }

    .filter-btn:hover::before { width: 100%; }
    .filter-btn:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateY(-2px);
    }

    .filter-btn.active {
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary-dark));
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
    }

    .filter-btn.active::before { background: white; }

    /* ============================================
       BERITA GRID & SIDEBAR
    ============================================ */
    .sidebar-grid {
        display: grid;
        grid-template-columns: 1fr 360px;
        gap: 2rem;
        margin-top: 1rem;
    }

    .sidebar-sticky {
        position: sticky;
        top: 2rem;
        align-self: start;
    }

    .berita-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .berita-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        overflow: hidden;
        transition: var(--transition-bounce);
    }

    .berita-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-xl);
        border-color: var(--accent-primary);
    }

    .berita-image {
        height: 180px;
        overflow: hidden;
        position: relative;
    }

    .berita-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .berita-card:hover .berita-image img { transform: scale(1.05); }

    .berita-category {
        position: absolute;
        top: 0.8rem;
        left: 0.8rem;
        padding: 0.2rem 0.7rem;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary-dark));
        color: white;
        border-radius: 40px;
        font-size: 0.6rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .berita-content { padding: 1rem; }

    .berita-meta {
        display: flex;
        gap: 1rem;
        margin-bottom: 0.5rem;
        font-size: 0.6rem;
        color: var(--text-mute);
    }

    .berita-meta i { margin-right: 0.2rem; }

    .berita-title {
        font-size: 0.9rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .berita-title a {
        color: var(--text-main);
        text-decoration: none;
        transition: var(--transition);
    }

    .berita-title a:hover { color: var(--accent-primary); }

    .berita-excerpt {
        font-size: 0.7rem;
        color: var(--text-mute);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        margin-bottom: 0.8rem;
    }

    .berita-link {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--accent-primary);
        text-decoration: none;
        transition: var(--transition);
    }

    .berita-link:hover { gap: 0.5rem; }

    /* ============================================
       EMPTY STATE - DIPERBAIKI
    ============================================ */
    .void-container {
        grid-column: span 2;
        text-align: center;
        padding: 3rem 2rem;
        background: white;
        border: 2px dashed #e5e7eb;
        border-radius: 32px;
        width: 100%;
    }

    .void-icon {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .void-icon i { font-size: 2.5rem; color: #94a3b8; }

    /* Sidebar tidak terpengaruh empty state */
    .berita-grid:has(.void-container) {
        display: block;
    }
    
    .berita-grid:has(.void-container) .void-container {
        display: block;
    }

    /* ============================================
       TRENDING CARD PREMIUM
    ============================================ */
    .premium-trending-card {
        background: linear-gradient(135deg, #1e293b, #0f172a);
        border-radius: 28px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        color: white;
        border: 1px solid rgba(255,255,255,0.08);
        transition: var(--transition-bounce);
    }

    .premium-trending-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
    }

    .trending-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid rgba(255,255,255,0.1);
    }

    .header-icon-box {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #f59e0b, #ea580c);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .header-text h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
    }

    .header-text p {
        font-size: 0.7rem;
        color: #94a3b8;
        margin: 0;
    }

    .trending-list {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .trending-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.8rem;
        border-radius: 18px;
        text-decoration: none;
        transition: var(--transition);
        color: white;
    }

    .trending-item:hover {
        background: rgba(255,255,255,0.08);
        transform: translateX(5px);
    }

    .item-number-box .number-outline {
        font-size: 1.5rem;
        font-weight: 900;
        color: transparent;
        -webkit-text-stroke: 1px rgba(255,255,255,0.3);
    }

    .trending-info { flex: 1; }

    .item-title {
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .item-meta {
        display: flex;
        gap: 0.8rem;
        font-size: 0.65rem;
        color: #94a3b8;
    }

    .arrow-circle {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        border: 1px solid rgba(255,255,255,0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: var(--transition);
    }

    .trending-item:hover .arrow-circle {
        opacity: 1;
        background: #f59e0b;
        border-color: #f59e0b;
    }

    /* ============================================
       LATEST CARD PREMIUM
    ============================================ */
    .elegant-latest-card {
        background: white;
        border-radius: 28px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        transition: var(--transition-bounce);
    }

    .elegant-latest-card:hover {
        transform: translateY(-4px);
        box-shadow: var(--shadow-xl);
        border-color: var(--accent-primary);
    }

    .latest-header-premium {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.8rem;
        border-bottom: 1px solid var(--border-color);
    }

    .icon-circle-glow {
        width: 50px;
        height: 50px;
        background: #ecfdf5;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #10b981;
    }

    .header-titles .top-label {
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 2px;
        color: #94a3b8;
        display: block;
        margin-bottom: 2px;
    }

    .header-titles h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
        color: #1e293b;
    }

    .feed-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.8rem;
        border-radius: 18px;
        text-decoration: none;
        transition: var(--transition);
        margin-bottom: 0.5rem;
    }

    .feed-item:hover {
        background: #f8fafc;
        transform: translateX(5px);
    }

    .thumb-wrapper {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        overflow: hidden;
        flex-shrink: 0;
        background: #f1f5f9;
        position: relative;
    }

    .thumb-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .feed-info { flex: 1; }

    .feed-title {
        font-size: 0.8rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .feed-meta {
        font-size: 0.6rem;
        color: #94a3b8;
    }

    .hover-indicator {
        width: 28px;
        height: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #cbd5e1;
        transition: var(--transition);
    }

    .feed-item:hover .hover-indicator {
        color: #10b981;
        transform: translateX(3px);
    }

    .card-action-area {
        margin-top: 1.2rem;
        text-align: center;
        padding-top: 0.8rem;
        border-top: 1px solid var(--border-color);
    }

    .btn-modern-link {
        text-decoration: none;
        color: #64748b;
        font-size: 0.75rem;
        font-weight: 700;
        transition: var(--transition);
    }

    .btn-modern-link:hover { color: #10b981; }

    /* ============================================
       PAGINATION
    ============================================ */
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
        border-radius: 12px;
        background: white;
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        transition: var(--transition);
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

    /* ============================================
       TUTORIAL SECTION
    ============================================ */
    .tutorial-section {
        margin-top: 2.5rem;
        background: white;
        border-radius: 28px;
        padding: 1.5rem;
        border: 1px solid var(--border-color);
        transition: var(--transition);
    }

    .tutorial-section:hover {
        border-color: var(--accent-primary);
        box-shadow: var(--shadow-lg);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i { font-size: 1.3rem; color: var(--accent-primary); }
    .tutorial-header h3 { font-size: 0.9rem; font-weight: 700; margin: 0; }

    .tutorial-intro {
        font-size: 0.8rem;
        color: var(--text-mute);
        margin-bottom: 1.2rem;
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
        background: rgba(16,185,129,0.06);
        transform: translateX(3px);
    }

    .tutorial-num {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary-dark));
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    .tutorial-text h4 { font-size: 0.75rem; font-weight: 700; margin-bottom: 0.2rem; }
    .tutorial-text p { font-size: 0.65rem; color: var(--text-mute); line-height: 1.4; }

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

    .tutorial-footer i { color: var(--accent-primary); }
    .tutorial-footer span { font-size: 0.7rem; color: #059669; }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1rem; }
        .sidebar-grid { grid-template-columns: 1fr; }
        .sidebar-sticky { position: static; }
        .berita-grid { grid-template-columns: repeat(2, 1fr); }
        .stats-premium-grid { flex-direction: column; }
        .stat-premium-card { min-width: auto; }
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .editorial-header { flex-direction: column; align-items: flex-start; }
        .brand-title { font-size: 2.8rem; }
        .berita-grid { grid-template-columns: 1fr; }
        .featured-inner { grid-template-columns: 1fr; }
        .featured-image { height: 200px; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .filter-group { justify-content: center; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .fade-up { animation: fadeInUp 0.6s ease forwards; opacity: 0; }
    .fade-right { animation: fadeInRight 0.6s ease forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.2s; }
    .delay-5 { animation-delay: 0.25s; }
    .delay-6 { animation-delay: 0.3s; }
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- HEADER --}}
    <header class="editorial-header fade-up">
        <div>
            <h1 class="brand-title font-display">Berita<br><span>Desa</span>.</h1>
            <p class="brand-subtitle">
                Informasi terkini dan pengumuman resmi dari Desa Lumban Silintong. 
            </p>
        </div>
    </header>

    {{-- STATISTIK PREMIUM --}}
    <div class="stats-premium-grid fade-up delay-1">
        <div class="stat-premium-card">
            <div class="card-shimmer"></div>
            <div class="card-inner">
                <div class="icon-box emerald"><i class="fa-regular fa-newspaper"></i></div>
                <div class="stat-data">
                    <div class="stat-value-container">
                        <h2 class="stat-number" data-target="{{ $beritas->total() }}">0</h2>
                    </div>
                    <p class="stat-name">Jumlah Berita</p>
                </div>
            </div>
            <div class="card-progress-bar"><div class="progress-fill emerald" style="width: 70%"></div></div>
        </div>

        <div class="stat-premium-card">
            <div class="card-shimmer"></div>
            <div class="card-inner">
                <div class="icon-box blue"><i class="fa-regular fa-eye"></i></div>
                <div class="stat-data">
                    <div class="stat-value-container">
                        <h2 class="stat-number" data-target="{{ $beritas->sum('dibaca') }}">0</h2>
                    </div>
                    <p class="stat-name">Total Interaksi</p>
                </div>
            </div>
            <div class="card-progress-bar"><div class="progress-fill blue" style="width: 85%"></div></div>
        </div>

        <div class="stat-premium-card">
            <div class="card-shimmer"></div>
            <div class="card-inner">
                <div class="icon-box amber"><i class="fa-regular fa-calendar-check"></i></div>
                <div class="stat-data">
                    <div class="stat-value-container">
                        <h2 class="stat-number" data-target="{{ $beritas->where('kategori', 'kegiatan')->count() }}">0</h2>
                    </div>
                    <p class="stat-name">Total Kegiatan</p>
                </div>
            </div>
            <div class="card-progress-bar"><div class="progress-fill amber" style="width: 60%"></div></div>
        </div>
    </div>

    {{-- FEATURED BERITA --}}
    @if(isset($beritaUtama) && $beritaUtama)
    <div class="featured-section fade-up delay-2">
        <div class="featured-card">
            <div class="featured-inner">
                <div class="featured-image">
                    <img src="{{ $beritaUtama->gambar ? asset('storage/' . $beritaUtama->gambar) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=800' }}" alt="{{ $beritaUtama->judul }}">
                    <div class="featured-overlay">
                        <span class="featured-category">{{ ucfirst($beritaUtama->kategori) }}</span>
                    </div>
                </div>
                <div class="featured-content">
                    <div class="featured-meta">
                        <span><i class="fa-regular fa-calendar"></i> {{ $beritaUtama->tanggal_publikasi->format('d M Y') }}</span>
                        <span><i class="fa-regular fa-eye"></i> {{ number_format($beritaUtama->dibaca) }} dibaca</span>
                    </div>
                    <h2><a href="{{ route('berita.show', $beritaUtama->slug) }}">{{ $beritaUtama->judul }}</a></h2>
                    <p class="featured-excerpt">{{ Str::limit(strip_tags($beritaUtama->isi_berita), 120) }}</p>
                    <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="featured-link">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- FILTER BUTTONS --}}
    <div class="filter-container fade-up delay-3">
        <div class="filter-group">
            <button class="filter-btn active" data-filter="all">Semua</button>
            <button class="filter-btn" data-filter="berita">📰 Berita</button>
            <button class="filter-btn" data-filter="pengumuman">📢 Pengumuman</button>
            <button class="filter-btn" data-filter="kegiatan">🎉 Kegiatan</button>
        </div>
    </div>

    {{-- MAIN CONTENT + SIDEBAR --}}
    <div class="sidebar-grid">
        
        {{-- LEFT: Berita Grid --}}
        <div class="fade-up delay-4">
            <div class="berita-grid" id="berita-grid">
                @forelse($beritas as $berita)
                <div class="berita-card" data-kategori="{{ $berita->kategori }}">
                    <div class="berita-image">
                        <img src="{{ $berita->gambar ? asset('storage/' . $berita->gambar) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=400' }}" alt="{{ $berita->judul }}">
                        <span class="berita-category">{{ ucfirst($berita->kategori) }}</span>
                    </div>
                    <div class="berita-content">
                        <div class="berita-meta">
                            <span><i class="fa-regular fa-calendar"></i> {{ $berita->tanggal_publikasi->format('d M Y') }}</span>
                            <span><i class="fa-regular fa-eye"></i> {{ number_format($berita->dibaca) }}</span>
                        </div>
                        <h3 class="berita-title"><a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a></h3>
                        <p class="berita-excerpt">{{ Str::limit(strip_tags($berita->isi_berita), 80) }}</p>
                        <a href="{{ route('berita.show', $berita->slug) }}" class="berita-link">
                            Baca <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
                @empty
                <div class="void-container">
                    <div class="void-icon">
                        <i class="fa-regular fa-newspaper"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-400">Belum Ada Berita</h3>
                    <p class="text-sm text-gray-400 mt-1">Belum ada berita yang dipublikasikan.</p>
                </div>
                @endforelse
            </div>

            {{-- Pagination --}}
            @if($beritas->hasPages() && $beritas->total() > 0)
            <div class="pagination-container">
                {{ $beritas->appends(request()->query())->links() }}
            </div>
            @endif
        </div>

        {{-- RIGHT: Sidebar Sticky --}}
        <div class="sidebar-sticky fade-right delay-5">
            
            {{-- TRENDING CARD --}}
            <div class="premium-trending-card">
                <div class="trending-header">
                    <div class="header-icon-box">
                        <i class="fa-solid fa-fire-flame-curved"></i>
                    </div>
                    <div class="header-text">
                        <h3>Artikel Terpopuler</h3>
                        <p>Informasi paling banyak disorot</p>
                    </div>
                </div>

                <div class="trending-list">
                @php 
                    $trending = $beritas->sortByDesc('dibaca')->take(5)->values();
                @endphp
                @foreach($trending as $index => $item)
                <a href="{{ route('berita.show', $item->slug) }}" class="trending-item">
                    <div class="item-number-box">
                        <span class="number-outline">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="trending-info">
                        <h4 class="item-title">{{ Str::limit($item->judul, 45) }}</h4>
                        <div class="item-meta">
                            <span><i class="fa-regular fa-eye"></i> {{ number_format($item->dibaca) }}</span>
                            <span>•</span>
                            <span>{{ $item->kategori }}</span>
                        </div>
                    </div>
                    <div class="arrow-circle">
                        <i class="fa-solid fa-arrow-right-long"></i>
                    </div>
                </a>
                @endforeach
                </div>
            </div>

            {{-- LATEST CARD --}}
            <div class="elegant-latest-card">
                <div class="latest-header-premium">
                    <div class="icon-circle-glow">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div class="header-titles">
                        <span class="top-label">BERITA TERKINI</span>
                        <h3>Update <span class="text-emerald-500">Desa</span></h3>
                    </div>
                </div>

                <div class="latest-feed">
                    @php $latest = $beritas->sortByDesc('created_at')->take(5); @endphp
                    @foreach($latest as $item)
                    <a href="{{ route('berita.show', $item->slug) }}" class="feed-item">
                        <div class="thumb-wrapper">
                            @if($item->gambar)
                                <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->judul }}">
                            @else
                                <div class="flex items-center justify-center h-full">
                                    <i class="fa-regular fa-image text-gray-300 text-xl"></i>
                                </div>
                            @endif
                        </div>
                        <div class="feed-info">
                            <h4 class="feed-title">{{ Str::limit($item->judul, 42) }}</h4>
                            <div class="feed-meta">
                                <i class="fa-regular fa-calendar"></i> {{ $item->created_at->translatedFormat('d M Y') }}
                            </div>
                        </div>
                        <div class="hover-indicator">
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </a>
                    @endforeach
                </div>

                <div class="card-action-area">
                    <a href="{{ route('berita') }}" class="btn-modern-link">
                        Lihat Seluruh Berita <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- TUTORIAL SECTION --}}
    <div class="tutorial-section fade-up delay-6">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Berita</h3>
        </div>
        <p class="tutorial-intro">
            Halaman <strong>Berita & Pengumuman</strong> menyajikan informasi terkini seputar kegiatan, pembangunan, 
            dan pengumuman resmi Desa Lumban Silintong.
        </p>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>🏷️ Filter Kategori</h4>
                    <p>Gunakan tombol filter untuk menyaring artikel berdasarkan kategori.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>📰 Baca Berita</h4>
                    <p>Klik judul berita atau gambar untuk membaca detail artikel.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>🔥 Terpopuler & Terbaru</h4>
                    <p>Lihat berita paling banyak dibaca dan terbaru di sidebar.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>📊 Statistik</h4>
                    <p>Pantau total berita, pembaca, dan kegiatan yang telah dipublikasikan.</p>
                </div>
            </div>
        </div>
        <div class="tutorial-footer">
            <i class="fa-regular fa-bell"></i>
            <span>💡 <strong>Tips:</strong> Gunakan filter untuk menemukan berita sesuai kategori yang Anda inginkan.</span>
        </div>
    </div>
</div>

<script>
    // Filter Kategori
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            const filter = this.dataset.filter;
            document.querySelectorAll('.berita-card').forEach(card => {
                if (filter === 'all' || card.dataset.kategori === filter) {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    // Counter Animation
    document.addEventListener("DOMContentLoaded", () => {
        const counters = document.querySelectorAll('.stat-number');
        
        const animateCounter = (el) => {
            const target = parseInt(el.getAttribute('data-target'));
            if (isNaN(target)) return;
            
            let current = 0;
            const increment = target / 50;
            
            const update = () => {
                current += increment;
                if (current < target) {
                    el.innerText = Math.floor(current).toLocaleString();
                    requestAnimationFrame(update);
                } else {
                    el.innerText = target.toLocaleString();
                }
            };
            update();
        };

        counters.forEach(counter => animateCounter(counter));
    });
</script>
@endsection