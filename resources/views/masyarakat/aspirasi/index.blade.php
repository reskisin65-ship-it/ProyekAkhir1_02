{{-- resources/views/masyarakat/aspirasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Aspirasi Saya - Lumban Silintong')

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
        --primary-soft-hover: rgba(16, 185, 129, 0.15);
        --dark: #0f172a;
        --dark-soft: #1e293b;
        --gray: #64748b;
        --gray-light: #94a3b8;
        --gray-soft: #f1f5f9;
        --bg: #fafbfc;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.03);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.05);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.08);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.1);
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
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
        margin-bottom: 2.5rem;
        position: relative;
    }

    .header-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 0.75rem;
    }

    .header-badge i { font-size: 0.65rem; color: var(--primary); }
    .header-badge span { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em; color: var(--primary-dark); text-transform: uppercase; }

    .header-title {
        font-size: clamp(1.8rem, 5vw, 2.8rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
    }

    .header-title span {
        color: var(--primary);
        font-family: 'Instrument Serif', serif;
        font-style: italic;
    }

    .header-subtitle {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
        max-width: 500px;
        line-height: 1.6;
    }

    /* Button Premium */
    .btn-premium {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.7rem 1.6rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition-bounce);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
        cursor: pointer;
    }

    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    /* ============================================
       STATISTICS CARDS PREMIUM
    ============================================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 24px;
        padding: 1.2rem;
        text-align: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
    }

    .stat-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
    }

    .stat-card:hover::after {
        transform: scaleX(1);
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        background: var(--primary-soft);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.8rem;
        transition: var(--transition-bounce);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.1);
        background: var(--primary);
    }

    .stat-card:hover .stat-icon i {
        color: white;
    }

    .stat-icon i { font-size: 1.4rem; color: var(--primary); transition: var(--transition); }
    .stat-value { font-size: 1.8rem; font-weight: 800; line-height: 1.2; color: var(--dark); }
    .stat-label { font-size: 0.6rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--gray); margin-top: 0.3rem; }

    /* ============================================
       FILTER BUTTONS PREMIUM
    ============================================ */
    .filter-container {
        margin-bottom: 2rem;
    }

    .filter-group {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
    }

    .filter-btn {
        padding: 0.5rem 1.3rem;
        background: white;
        border: 1px solid var(--border);
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 700;
        color: var(--gray);
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
        background: var(--primary);
        transition: width 0.3s;
    }

    .filter-btn:hover::before {
        width: 100%;
    }

    .filter-btn i { font-size: 0.7rem; }

    .filter-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-1px);
    }

    .filter-btn.active {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-color: transparent;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
    }

    /* ============================================
       ALERT PREMIUM
    ============================================ */
    .alert-premium {
        margin-bottom: 1.5rem;
        padding: 1rem 1.2rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: slideInRight 0.4s ease;
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .alert-success {
        background: #ecfdf5;
        border-left: 3px solid var(--primary);
        color: #059669;
    }

    .alert-error {
        background: #fef2f2;
        border-left: 3px solid #ef4444;
        color: #dc2626;
    }

    .alert-close {
        cursor: pointer;
        opacity: 0.6;
        transition: var(--transition);
        padding: 0.25rem;
        border-radius: 10px;
    }

    .alert-close:hover { opacity: 1; background: rgba(0,0,0,0.05); }

    /* ============================================
       ASPIRASI CARDS PREMIUM
    ============================================ */
    .aspirasi-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .aspirasi-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 28px;
        overflow: hidden;
        transition: var(--transition-bounce);
        position: relative;
        animation: fadeUp 0.5s ease forwards;
        opacity: 0;
    }

    .aspirasi-card:nth-child(1) { animation-delay: 0.05s; }
    .aspirasi-card:nth-child(2) { animation-delay: 0.1s; }
    .aspirasi-card:nth-child(3) { animation-delay: 0.15s; }
    .aspirasi-card:nth-child(4) { animation-delay: 0.2s; }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .aspirasi-card:hover {
        transform: translateY(-6px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary);
    }

    /* Card Header */
    .card-header {
        padding: 1.2rem 1.2rem 0.8rem 1.2rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        flex-wrap: wrap;
        gap: 0.8rem;
    }

    .user-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .user-avatar {
        width: 44px;
        height: 44px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
    }

    .aspirasi-card:hover .user-avatar {
        transform: scale(1.05);
    }

    .user-avatar i { color: white; font-size: 1.1rem; }

    .user-name {
        font-weight: 700;
        font-size: 0.85rem;
        color: var(--dark);
    }

    .user-date {
        font-size: 0.6rem;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 0.2rem;
        margin-top: 0.2rem;
    }

    /* Category Badge */
    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.9rem;
        border-radius: 40px;
        font-size: 0.6rem;
        font-weight: 700;
        transition: var(--transition-bounce);
    }

    .aspirasi-card:hover .category-badge {
        transform: scale(1.02);
    }

    .badge-saran { background: #d1fae5; color: #059669; }
    .badge-keluhan { background: #fee2e2; color: #dc2626; }
    .badge-masukan { background: #dbeafe; color: #2563eb; }
    .badge-pertanyaan { background: #f3e8ff; color: #9333ea; }

    /* Card Body */
    .card-body {
        padding: 0 1.2rem 0.8rem 1.2rem;
    }

    .aspirasi-title {
        font-weight: 800;
        font-size: 1rem;
        margin-bottom: 0.4rem;
        color: var(--dark);
        transition: var(--transition);
    }

    .aspirasi-card:hover .aspirasi-title {
        color: var(--primary);
    }

    .aspirasi-content {
        font-size: 0.8rem;
        color: var(--gray);
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 1rem;
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 700;
        margin: 0 1.2rem 0.8rem 1.2rem;
        transition: var(--transition-bounce);
    }

    .aspirasi-card:hover .status-badge {
        transform: scale(1.02);
    }

    .status-baru { background: #fef3c7; color: #d97706; }
    .status-diproses { background: #dbeafe; color: #2563eb; }
    .status-selesai { background: #d1fae5; color: #059669; }

    /* Response Card */
    .response-card {
        margin: 0 1.2rem 1rem 1.2rem;
        padding: 0.8rem 1rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 18px;
        border-left: 3px solid var(--primary);
        transition: var(--transition-bounce);
    }

    .response-card:hover {
        transform: translateX(4px);
    }

    .response-header {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        margin-bottom: 0.3rem;
    }

    .response-header i { color: var(--primary); font-size: 0.7rem; }
    .response-header span { font-size: 0.6rem; font-weight: 700; color: var(--primary-dark); letter-spacing: 0.02em; }

    .response-text {
        font-size: 0.75rem;
        color: var(--dark);
        line-height: 1.4;
    }

    /* Proses Card */
    .proses-card {
        margin: 0 1.2rem 1rem 1.2rem;
        padding: 0.8rem 1rem;
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border-radius: 18px;
        border-left: 3px solid #3b82f6;
    }

    .pending-card {
        margin: 0 1.2rem 1rem 1.2rem;
        padding: 0.8rem 1rem;
        background: linear-gradient(135deg, #fef3c7, #fde68a);
        border-radius: 18px;
        border-left: 3px solid #d97706;
    }

    /* Card Footer */
    .card-footer {
        padding: 0.8rem 1.2rem;
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        border-top: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .footer-note {
        font-size: 0.6rem;
        color: var(--gray-light);
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid var(--border);
        color: var(--gray);
        transition: var(--transition-bounce);
        cursor: pointer;
        text-decoration: none;
    }

    .action-btn:hover {
        transform: translateY(-2px) scale(1.05);
    }

    .btn-view:hover { background: var(--primary); color: white; border-color: var(--primary); box-shadow: 0 4px 12px rgba(16,185,129,0.2); }
    .btn-edit:hover { background: #3b82f6; color: white; border-color: #3b82f6; }
    .btn-delete:hover { background: #ef4444; color: white; border-color: #ef4444; }

    /* ============================================
       EMPTY STATE PREMIUM
    ============================================ */
    .empty-state {
        grid-column: span 2;
        text-align: center;
        padding: 3rem;
        background: var(--card);
        border-radius: 32px;
        border: 1px solid var(--border);
        animation: fadeUp 0.5s ease;
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
        transition: var(--transition-bounce);
    }

    .empty-icon i { font-size: 2.2rem; color: var(--gray-light); }

    /* ============================================
       PAGINATION PREMIUM
    ============================================ */
    .pagination-wrapper {
        margin-top: 2rem;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 0.4rem;
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
       TUTORIAL SECTION PREMIUM
    ============================================ */
    .tutorial-section {
        margin-top: 2.5rem;
        background: linear-gradient(135deg, var(--card), #ffffff);
        border-radius: 28px;
        padding: 1.8rem;
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .tutorial-section:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.2rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i { font-size: 1.5rem; color: var(--primary); }
    .tutorial-header h3 { font-size: 1rem; font-weight: 700; margin: 0; }

    .tutorial-intro {
        font-size: 0.8rem;
        color: var(--gray);
        margin-bottom: 1.2rem;
        line-height: 1.5;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
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
    .tutorial-text p { font-size: 0.7rem; color: var(--gray); line-height: 1.4; }

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

    .tutorial-footer i { color: var(--primary); font-size: 0.8rem; }
    .tutorial-footer span { font-size: 0.7rem; color: #059669; }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 1024px) {
        .container-premium { padding: 1rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 0.8rem; }
        .aspirasi-grid { grid-template-columns: 1fr; gap: 1rem; }
        .empty-state { grid-column: span 1; }
        .tutorial-grid { grid-template-columns: 1fr; gap: 0.5rem; }
    }

    @media (max-width: 768px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .filter-group { justify-content: center; }
        .filter-btn { padding: 0.4rem 1rem; font-size: 0.7rem; }
        .stat-value { font-size: 1.4rem; }
        .stat-icon { width: 44px; height: 44px; }
        .tutorial-header { flex-wrap: wrap; }
    }

    @media (max-width: 480px) {
        .stats-grid { grid-template-columns: 1fr; }
        .card-header { flex-direction: column; align-items: flex-start; }
        .action-buttons { justify-content: flex-end; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- ============================================ --}}
    {{-- HEADER SECTION --}}
    {{-- ============================================ --}}
    <div class="header-section animate__animated animate__fadeInUp">
        <div class="header-badge">
            <i class="fa-regular fa-comment-dots"></i>
            <span>Partisipasi Masyarakat</span>
        </div>
        <h1 class="header-title">
            Aspirasi<br>
            <span>Saya</span>
        </h1>
        <p class="header-subtitle">
            Lihat dan pantau semua aspirasi, saran, keluhan, atau pertanyaan yang telah Anda kirimkan ke Desa Lumban Silintong.
        </p>
        <div class="mt-4">
            <a href="{{ route('masyarakat.aspirasi.create') }}" class="btn-premium">
                <i class="fa-solid fa-pen-to-square"></i> Kirim Aspirasi Baru
            </a>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- STATISTICS CARDS --}}
    {{-- ============================================ --}}
    <div class="stats-grid animate__animated animate__fadeInUp" style="animation-delay: 0.05s">
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-regular fa-message"></i></div>
            <div class="stat-value" id="total-count">{{ $aspirasi->total() }}</div>
            <div class="stat-label">Total Aspirasi</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-regular fa-clock"></i></div>
            <div class="stat-value" id="menunggu-count">{{ $aspirasi->where('status', 'baru')->count() }}</div>
            <div class="stat-label">Menunggu</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-solid fa-spinner fa-spin"></i></div>
            <div class="stat-value" id="diproses-count">{{ $aspirasi->where('status', 'diproses')->count() }}</div>
            <div class="stat-label">Diproses</div>
        </div>
        <div class="stat-card">
            <div class="stat-icon"><i class="fa-regular fa-circle-check"></i></div>
            <div class="stat-value" id="selesai-count">{{ $aspirasi->where('status', 'selesai')->count() }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- FILTER BUTTONS --}}
    {{-- ============================================ --}}
    <div class="filter-container animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="filter-group">
            <button class="filter-btn active" data-filter="all">
                <i class="fa-solid fa-layer-group"></i> Semua
            </button>
            <button class="filter-btn" data-filter="saran">
                <i class="fa-regular fa-lightbulb"></i> Saran
            </button>
            <button class="filter-btn" data-filter="keluhan">
                <i class="fa-regular fa-face-frown"></i> Keluhan
            </button>
            <button class="filter-btn" data-filter="masukan">
                <i class="fa-regular fa-message"></i> Masukan
            </button>
            <button class="filter-btn" data-filter="pertanyaan">
                <i class="fa-regular fa-circle-question"></i> Pertanyaan
            </button>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- ALERT MESSAGES --}}
    {{-- ============================================ --}}
    @if(session('success'))
    <div class="alert-premium alert-success animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check"></i><span>{{ session('success') }}</span></div>
        <div class="alert-close" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-premium alert-error animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-exclamation"></i><span>{{ session('error') }}</span></div>
        <div class="alert-close" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></div>
    </div>
    @endif

    {{-- ============================================ --}}
    {{-- ASPIRASI CARDS GRID --}}
    {{-- ============================================ --}}
    <div id="aspirasi-container" class="aspirasi-grid">
        @forelse($aspirasi as $item)
        <div class="aspirasi-card" data-kategori="{{ $item->kategori }}" data-status="{{ $item->status }}">
            {{-- Card Header --}}
            <div class="card-header">
                <div class="user-info">
                    <div class="user-avatar">
                        <i class="fa-regular fa-user"></i>
                    </div>
                    <div>
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-date">
                            <i class="fa-regular fa-calendar"></i>
                            {{ $item->created_at->translatedFormat('d M Y, H:i') }}
                        </div>
                    </div>
                </div>
                <span class="category-badge 
                    @if($item->kategori == 'saran') badge-saran
                    @elseif($item->kategori == 'keluhan') badge-keluhan
                    @elseif($item->kategori == 'masukan') badge-masukan
                    @else badge-pertanyaan @endif">
                    @if($item->kategori == 'saran') 💡 Saran
                    @elseif($item->kategori == 'keluhan') 😞 Keluhan
                    @elseif($item->kategori == 'masukan') 📝 Masukan
                    @else ❓ Pertanyaan @endif
                </span>
            </div>

            {{-- Card Body --}}
            <div class="card-body">
                <h3 class="aspirasi-title">{{ $item->judul }}</h3>
                <p class="aspirasi-content">{{ Str::limit($item->isi_aspirasi, 100) }}</p>
            </div>

            {{-- Status Badge --}}
            <div class="status-badge 
                @if($item->status == 'baru') status-baru
                @elseif($item->status == 'diproses') status-diproses
                @else status-selesai @endif">
                @if($item->status == 'baru') <i class="fa-regular fa-clock"></i> Menunggu Tanggapan
                @elseif($item->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Sedang Diproses
                @else <i class="fa-regular fa-circle-check"></i> Selesai Ditanggapi @endif
            </div>

            {{-- Response Admin / Status Card --}}
            @if($item->respon_admin && $item->respon_admin != '')
            <div class="response-card">
                <div class="response-header">
                    <i class="fa-solid fa-headset"></i>
                    <span>Tanggapan Admin Desa</span>
                </div>
                <p class="response-text">{{ Str::limit($item->respon_admin, 80) }}</p>
            </div>
            @elseif($item->status == 'diproses')
            <div class="proses-card">
                <div class="response-header">
                    <i class="fa-solid fa-spinner fa-spin"></i>
                    <span>Status Proses</span>
                </div>
                <p class="response-text">Aspirasi Anda sedang diproses oleh admin desa. Mohon tunggu tanggapan dalam 1-3 hari kerja.</p>
            </div>
            @elseif($item->status == 'baru')
            <div class="pending-card">
                <div class="response-header">
                    <i class="fa-regular fa-bell"></i>
                    <span>Menunggu Tanggapan</span>
                </div>
                <p class="response-text">Aspirasi Anda telah terkirim dan akan segera ditanggapi oleh admin desa.</p>
            </div>
            @endif

            {{-- Card Footer --}}
            <div class="card-footer">
                <div class="footer-note">
                    <i class="fa-regular fa-heart"></i> Terima kasih atas aspirasinya
                </div>
                <div class="action-buttons">
                    @if($item->status == 'baru')
                    <a href="{{ route('masyarakat.aspirasi.edit', $item->id_aspirasi) }}" class="action-btn btn-edit" title="Edit">
                        <i class="fa-solid fa-pen"></i>
                    </a>
                    <form action="{{ route('masyarakat.aspirasi.destroy', $item->id_aspirasi) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin membatalkan aspirasi ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="action-btn btn-delete" title="Hapus">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </form>
                    @endif
                    <a href="{{ route('masyarakat.aspirasi.show', $item->id_aspirasi) }}" class="action-btn btn-view" title="Detail">
                        <i class="fa-solid fa-eye"></i>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="empty-state">
            <div class="empty-icon">
                <i class="fa-regular fa-comment-dots"></i>
            </div>
            <h3 class="text-lg font-semibold text-gray-400">Belum Ada Aspirasi</h3>
            <p class="text-sm text-gray-400 mt-1">Sampaikan aspirasi, saran, atau keluhan Anda untuk kemajuan desa Lumban Silintong.</p>
            <a href="{{ route('masyarakat.aspirasi.create') }}" class="btn-premium mt-4" style="display: inline-flex;">
                <i class="fa-solid fa-pen-to-square"></i> Kirim Aspirasi Sekarang
            </a>
        </div>
        @endforelse
    </div>

    {{-- ============================================ --}}
    {{-- PAGINATION --}}
    {{-- ============================================ --}}
    @if($aspirasi->hasPages())
    <div class="pagination-wrapper">
        {{ $aspirasi->appends(request()->query())->links() }}
    </div>
    @endif

    {{-- ============================================ --}}
    {{-- TUTORIAL SECTION PREMIUM --}}
    {{-- ============================================ --}}
    <div class="tutorial-section">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Ini</h3>
        </div>
        
        <p class="tutorial-intro">
            Halaman <strong>Aspirasi Saya</strong> menampilkan semua aspirasi, saran, keluhan, atau pertanyaan yang pernah Anda kirimkan. 
            Anda dapat memantau status dan tanggapan dari admin desa di sini.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📝 Kirim Aspirasi Baru</h4>
                    <p>Klik tombol "Kirim Aspirasi Baru" untuk menyampaikan aspirasi, saran, atau keluhan Anda.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>🏷️ Filter Kategori</h4>
                    <p>Gunakan tombol filter di atas untuk melihat aspirasi berdasarkan kategori tertentu.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>👀 Lihat Detail</h4>
                    <p>Klik ikon mata 👁️ untuk melihat detail lengkap aspirasi dan tanggapan admin.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>✏️ Edit / Batalkan</h4>
                    <p>Jika status masih <strong>"Menunggu"</strong>, Anda dapat mengedit atau membatalkan aspirasi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>📊 Pantau Status</h4>
                    <p>Status aspirasi akan berubah dari Menunggu → Diproses → Selesai. Anda akan mendapat notifikasi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">💡</div>
                <div class="tutorial-text">
                    <h4>Tips Penting</h4>
                    <p>Sampaikan aspirasi dengan jelas, sopan, dan konstruktif agar dapat ditindaklanjuti dengan baik.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-clock"></i>
            <span>⏱️ <strong>Waktu Respons:</strong> Aspirasi akan ditanggapi maksimal 3 hari kerja setelah dikirim.</span>
        </div>
    </div>
</div>

<script>
    // Filter Aspirasi by Kategori
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const filterValue = this.dataset.filter;
            
            // Update active class pada button
            document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Filter cards
            const cards = document.querySelectorAll('#aspirasi-container .aspirasi-card');
            let visibleCount = 0;
            let menungguCount = 0;
            let diprosesCount = 0;
            let selesaiCount = 0;
            
            cards.forEach(card => {
                if (filterValue === 'all' || card.dataset.kategori === filterValue) {
                    card.style.display = '';
                    visibleCount++;
                    const statusCard = card.dataset.status;
                    if (statusCard === 'baru') menungguCount++;
                    else if (statusCard === 'diproses') diprosesCount++;
                    else if (statusCard === 'selesai') selesaiCount++;
                } else {
                    card.style.display = 'none';
                }
            });
            
            // Update statistik
            document.getElementById('total-count').innerText = visibleCount;
            document.getElementById('menunggu-count').innerText = menungguCount;
            document.getElementById('diproses-count').innerText = diprosesCount;
            document.getElementById('selesai-count').innerText = selesaiCount;
        });
    });
    
    // Auto close alerts after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert-premium').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(20px)';
            setTimeout(() => alert.remove(), 300);
        });
    }, 4000);
</script>
@endsection