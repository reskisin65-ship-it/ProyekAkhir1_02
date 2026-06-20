{{-- resources/views/home.blade.php --}}
@extends('layouts.app')

@section('title', 'Beranda - Desa Digital Premium')

@section('content')
<!-- Google Fonts Premium -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&family=Playfair+Display:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

<style>
    /* ============================================
       DESIGN SYSTEM PREMIUM
    ============================================ */
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
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

    /* Scroll Progress Line */
    .scroll-line {
        position: fixed;
        top: 0; left: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--primary-light));
        z-index: 10000;
        width: 0%;
    }

    /* Background Pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
        background-size: 20px 20px;
        opacity: 0.4;
    }

    .container-premium {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ============================================
       HERO SLIDER PREMIUM - ELEGAN
    ============================================ */
    .hero-slider-container {
        position: relative;
        border-radius: 32px;
        overflow: hidden;
        box-shadow: var(--shadow-2xl);
        background: #f5f5f5;
    }
    .hero-slider-wrapper { display: flex; transition: transform 0.8s cubic-bezier(0.65, 0, 0.35, 1); }
    .hero-slide { min-width: 100%; height: 85vh; position: relative; }
    .hero-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: brightness(0.75) contrast(1.05);
        transition: transform 0.5s;
    }
    .hero-content {
        position: absolute;
        inset: 0;
        background: linear-gradient(105deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.35) 50%, rgba(0,0,0,0.1) 100%);
        display: flex;
        flex-direction: column;
        justify-content: center;
        padding-left: 8%;
        padding-right: 40%;
    }

    /* ============================================
       HERO SLIDER - TEKS PUTIH DENGAN SHADOW
    ============================================ */
    .hero-slide .hero-content .hero-badge {
        background: rgba(16, 185, 129, 0.25) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: #ffffff !important;
        text-shadow: 0 1px 8px rgba(0, 0, 0, 0.4) !important;
        font-weight: 700 !important;
        letter-spacing: 0.1em !important;
        padding: 0.4rem 1.4rem !important;
        font-size: 0.75rem !important;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15) !important;
        display: inline-block;
        border-radius: 40px;
        width: fit-content;
        margin-bottom: 1rem;
    }

    .hero-slide .hero-content .hero-title {
        color: #ffffff !important;
        text-shadow: 0 4px 30px rgba(0, 0, 0, 0.6), 0 2px 8px rgba(0, 0, 0, 0.4) !important;
        font-weight: 700 !important;
        font-size: clamp(2.5rem, 6vw, 5rem);
        font-family: 'Playfair Display', serif;
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    .hero-slide .hero-content .hero-subtitle {
        color: rgba(255, 255, 255, 0.95) !important;
        text-shadow: 0 2px 16px rgba(0, 0, 0, 0.5) !important;
        font-weight: 400 !important;
        font-size: 1.05rem !important;
        max-width: 500px;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    .hero-slide .hero-content .hero-buttons .btn-hero-primary {
        background: #ffffff !important;
        color: #059669 !important;
        font-weight: 700 !important;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.25) !important;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    .hero-slide .hero-content .hero-buttons .btn-hero-primary:hover {
        background: #10b981 !important;
        color: #ffffff !important;
        box-shadow: 0 12px 40px rgba(16, 185, 129, 0.4) !important;
        transform: translateY(-3px);
    }

    .hero-slide .hero-content .hero-buttons .btn-hero-secondary {
        background: rgba(255, 255, 255, 0.15) !important;
        backdrop-filter: blur(12px) !important;
        -webkit-backdrop-filter: blur(12px) !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        color: #ffffff !important;
        font-weight: 600 !important;
        text-shadow: 0 1px 8px rgba(0, 0, 0, 0.3) !important;
        padding: 0.8rem 2rem;
        border-radius: 50px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    .hero-slide .hero-content .hero-buttons .btn-hero-secondary:hover {
        background: rgba(255, 255, 255, 0.3) !important;
        border-color: rgba(255, 255, 255, 0.6) !important;
        transform: translateY(-3px);
    }

    .hero-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .slider-nav {
        position: absolute;
        bottom: 2rem;
        right: 2rem;
        display: flex;
        gap: 0.5rem;
        z-index: 10;
    }
    .slider-dot {
        width: 40px;
        height: 3px;
        border-radius: 3px;
        background: rgba(255,255,255,0.4);
        cursor: pointer;
        transition: all 0.3s;
    }
    .slider-dot.active { background: white; width: 60px; }

    /* ============================================
       STATS CARDS PREMIUM
    ============================================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin: 2rem 0;
    }
    .stat-card {
        background: var(--card);
        border-radius: 28px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
        pointer-events: none;
    }
    .stat-card:hover::before { left: 100%; }
    .stat-card:hover {
        transform: translateY(-6px);
        border-color: var(--primary);
        box-shadow: var(--shadow-xl);
    }
    .stat-icon {
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        transition: var(--transition-bounce);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.2);
    }
    .stat-card:hover .stat-icon {
        transform: scale(1.05);
        box-shadow: 0 12px 28px rgba(16, 185, 129, 0.3);
    }
    .stat-icon i { color: white; font-size: 1.5rem; }
    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--dark);
        line-height: 1.2;
        margin-bottom: 0.25rem;
    }
    .stat-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        margin-bottom: 0.5rem;
    }
    .stat-progress {
        margin-top: 0.75rem;
        height: 4px;
        background: var(--gray-soft);
        border-radius: 10px;
        overflow: hidden;
    }
    .stat-progress-bar {
        height: 100%;
        border-radius: 10px;
        transition: width 0.6s ease;
    }

    /* ============================================
       SECTION BADGE & TITLE
    ============================================ */
    .section-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 1rem;
    }
    .section-badge i { font-size: 0.7rem; color: var(--primary); }
    .section-badge span { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; color: var(--primary-dark); text-transform: uppercase; }
    .section-title {
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800;
        letter-spacing: -0.03em;
    }
    .section-title span {
        color: var(--primary);
    }

    /* ============================================
       LAYANAN PUBLIK - BERANIMASI
    ============================================ */
    .service-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        gap: 1.5rem;
        margin: 2rem 0;
    }
    .service-card {
        background: white;
        border-radius: 24px;
        padding: 1.8rem 1rem;
        text-align: center;
        border: 1px solid var(--border);
        transition: var(--transition-bounce);
        text-decoration: none;
        display: block;
        position: relative;
        overflow: hidden;
    }
    .service-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        transform: scaleX(0);
        transform-origin: left;
        transition: transform 0.4s ease;
    }
    .service-card:nth-child(1)::after { background: #10b981; }
    .service-card:nth-child(2)::after { background: #3b82f6; }
    .service-card:nth-child(3)::after { background: #8b5cf6; }
    .service-card:nth-child(4)::after { background: #f59e0b; }
    .service-card:nth-child(5)::after { background: #ef4444; }
    .service-card:hover::after { transform: scaleX(1); }
    .service-card:hover {
        transform: translateY(-12px);
        box-shadow: var(--shadow-xl);
        border-color: transparent;
    }
    .service-icon {
        width: 70px;
        height: 70px;
        background: var(--gray-soft);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        transition: var(--transition-bounce);
    }
    .service-card:nth-child(1):hover .service-icon { background: #10b981; transform: scale(1.1) rotate(5deg); }
    .service-card:nth-child(2):hover .service-icon { background: #3b82f6; transform: scale(1.1) rotate(5deg); }
    .service-card:nth-child(3):hover .service-icon { background: #8b5cf6; transform: scale(1.1) rotate(5deg); }
    .service-card:nth-child(4):hover .service-icon { background: #f59e0b; transform: scale(1.1) rotate(5deg); }
    .service-card:nth-child(5):hover .service-icon { background: #ef4444; transform: scale(1.1) rotate(5deg); }
    .service-icon i { font-size: 2rem; color: var(--gray); transition: var(--transition); }
    .service-card:hover .service-icon i { color: white; }
    .service-title { font-weight: 800; font-size: 1rem; color: var(--dark); margin-bottom: 0.3rem; }
    .service-desc { font-size: 0.7rem; color: var(--gray); }

    /* ============================================
       LAYANAN DIGITAL - LOCKED OVERLAY
    ============================================ */
    .digital-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 2rem;
        max-width: 1000px;
        margin: 0 auto;
    }
    .locked-card {
        position: relative;
        background: white;
        border-radius: 28px;
        overflow: hidden;
        cursor: pointer;
        transition: var(--transition-bounce);
        border: 1px solid var(--border);
    }
    .locked-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary);
    }
    .locked-card .card-content {
        padding: 2rem;
        position: relative;
        z-index: 1;
    }
    .locked-card .card-icon {
        width: 70px;
        height: 70px;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        transition: var(--transition-bounce);
    }
    .locked-card:nth-child(1) .card-icon { background: linear-gradient(135deg, #10b981, #059669); }
    .locked-card:nth-child(2) .card-icon { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .locked-card:hover .card-icon { transform: scale(1.1) rotate(5deg); }
    .locked-card .card-icon i { font-size: 2rem; color: white; }
    .locked-card h3 { font-size: 1.5rem; font-weight: 800; color: var(--dark); margin-bottom: 0.5rem; }
    .locked-card p { color: var(--gray); font-size: 0.85rem; line-height: 1.5; }
    .locked-card .card-arrow {
        margin-top: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--primary);
        font-weight: 600;
        font-size: 0.8rem;
    }
    .locked-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.7);
        backdrop-filter: blur(6px);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.4s ease;
        z-index: 20;
    }
    .locked-card:hover .locked-overlay { opacity: 1; }
    .locked-content {
        background: white;
        backdrop-filter: blur(12px);
        padding: 1rem 1.8rem;
        border-radius: 60px;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        transform: scale(0.9);
        transition: transform 0.3s ease;
        box-shadow: var(--shadow-lg);
    }
    .locked-card:hover .locked-content { transform: scale(1); }
    .locked-content i { font-size: 1.2rem; color: var(--primary); }
    .locked-content span { font-weight: 700; font-size: 0.8rem; color: var(--dark); }

    /* ============================================
       CHART SECTION
    ============================================ */
    .chart-section {
        background: var(--card);
        border-radius: 32px;
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition-bounce);
        margin: 2rem 0;
    }
    .chart-section:hover { box-shadow: var(--shadow-xl); }
    .chart-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border);
        background: linear-gradient(135deg, rgba(16,185,129,0.02), transparent);
    }
    .chart-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 0.5rem;
    }
    .chart-title-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(16,185,129,0.2);
    }
    .chart-title-icon i { color: white; font-size: 1rem; }
    .chart-title h2 { font-size: 1.3rem; font-weight: 800; color: var(--dark); }
    .chart-subtitle { font-size: 0.75rem; color: var(--gray); margin-left: 3.25rem; }
    .chart-type-group {
        display: flex;
        gap: 0.5rem;
        background: var(--gray-soft);
        padding: 0.25rem;
        border-radius: 60px;
    }
    .chart-type-btn {
        padding: 0.5rem 1.2rem;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--gray);
        transition: var(--transition);
        cursor: pointer;
        background: transparent;
        border: none;
    }
    .chart-type-btn i { margin-right: 0.4rem; font-size: 0.7rem; }
    .chart-type-btn:hover { color: var(--primary); }
    .chart-type-btn.active {
        background: white;
        color: var(--primary);
        box-shadow: var(--shadow-sm);
    }
    .category-group {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    .category-btn {
        padding: 0.7rem 1.5rem;
        border-radius: 60px;
        font-size: 0.75rem;
        font-weight: 700;
        transition: var(--transition-bounce);
        cursor: pointer;
        border: 1.5px solid var(--border);
        background: white;
        color: var(--gray);
    }
    .category-btn i { margin-right: 0.5rem; }
    .category-btn:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
    }
    .category-btn.active {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-color: transparent;
        color: white;
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
    }
    .canvas-container {
        padding: 2rem;
        background: linear-gradient(135deg, #fafbfc, #ffffff);
        border-radius: 24px;
        margin: 0 1rem 1rem 1rem;
        position: relative;
        overflow: hidden;
    }
    .canvas-container::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(16,185,129,0.03) 0%, transparent 70%);
        pointer-events: none;
    }
    canvas { max-height: 400px; width: 100%; position: relative; z-index: 1; }
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        padding: 1.5rem 2rem 2rem 2rem;
        border-top: 1px solid var(--border);
        background: var(--bg);
    }
    .info-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem;
        border-radius: 20px;
        transition: var(--transition);
    }
    .info-item:hover {
        background: white;
        transform: translateY(-2px);
    }
    .info-icon {
        width: 40px;
        height: 40px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .info-content p:first-child {
        font-size: 0.6rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        margin-bottom: 0.2rem;
    }
    .info-content p:last-child { font-size: 0.65rem; color: var(--gray); }

    /* ============================================
       NEWS & GALLERY
    ============================================ */
    .news-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.8rem;
    }
    .news-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: var(--transition-bounce);
        cursor: pointer;
    }
    .news-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-xl);
        border-color: var(--primary);
    }
    .news-card .news-img { height: 220px; overflow: hidden; }
    .news-card .news-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .news-card:hover .news-img img { transform: scale(1.1); }
    .news-card .news-content { padding: 1.5rem; }
    .news-category {
        display: inline-block;
        padding: 0.2rem 0.8rem;
        background: var(--primary-soft);
        color: var(--primary-dark);
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
    }
    .news-title {
        font-weight: 800;
        font-size: 1.1rem;
        color: var(--dark);
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }
    .news-card:hover .news-title { color: var(--primary); }
    .news-date {
        font-size: 0.7rem;
        color: var(--gray);
        display: flex;
        align-items: center;
        gap: 0.3rem;
        margin-top: 0.8rem;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }
    .gallery-item {
        position: relative;
        aspect-ratio: 1;
        border-radius: 20px;
        overflow: hidden;
        cursor: pointer;
        transition: var(--transition-bounce);
    }
    .gallery-item:hover {
        transform: scale(1.03);
        box-shadow: var(--shadow-xl);
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    .gallery-item:hover img { transform: scale(1.1); }
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,0.6), transparent);
        display: flex;
        align-items: flex-end;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .gallery-overlay i { color: white; font-size: 1.5rem; }

    /* ============================================
       FAQ SECTION
    ============================================ */
    .faq-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin: 2rem 0;
    }
    .faq-item {
        background: white;
        border-radius: 20px;
        border: 1px solid var(--border);
        transition: var(--transition);
        cursor: pointer;
    }
    .faq-item:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }
    .faq-question {
        padding: 1.2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-weight: 700;
        color: var(--dark);
        cursor: pointer;
    }
    .faq-question i {
        transition: transform 0.3s ease;
        color: var(--primary);
    }
    .faq-item.active .faq-question i {
        transform: rotate(180deg);
    }
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0 1.2rem;
    }
    .faq-item.active .faq-answer {
        max-height: 300px;
        padding: 0 1.2rem 1.2rem 1.2rem;
    }
    .faq-answer p {
        font-size: 0.85rem;
        color: var(--gray);
        line-height: 1.6;
    }

    /* ============================================
       TUTORIAL SECTION PREMIUM
    ============================================ */
    .tutorial-section {
        margin-top: 2.5rem;
        background: white;
        border-radius: 28px;
        padding: 2rem;
        border: 1px solid #eef2f6;
        transition: all 0.3s ease;
    }
    .tutorial-section:hover {
        border-color: #10b981;
        box-shadow: 0 6px 26px rgba(0,0,0,0.07);
    }
    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid #eef2f6;
        padding-bottom: 1rem;
    }
    .tutorial-header i {
        font-size: 1.6rem;
        color: #10b981;
        min-width: 2rem;
        text-align: center;
    }
    .tutorial-header h3 {
        font-size: 1.45rem;
        font-weight: 800;
        margin: 0;
        color: #0f172a;
        line-height: 1.1;
    }
    .tutorial-intro {
        font-size: 1rem;
        color: #475569;
        margin-bottom: 1.75rem;
        line-height: 1.7;
        max-width: 780px;
    }
    .tutorial-content-grid {
        display: grid;
        gap: 1.5rem;
    }
    .tutorial-special-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 0;
    }
    .tutorial-special-card {
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        border-radius: 24px;
        padding: 1.4rem;
        text-align: left;
        border: 1px solid #eef2f6;
        transition: all 0.3s ease;
        cursor: pointer;
        min-height: 230px;
        display: flex;
        flex-direction: column;
    }
    .tutorial-special-card:hover {
        transform: translateY(-5px);
        border-color: #10b981;
        box-shadow: 0 12px 28px rgba(0,0,0,0.08);
    }
    .tutorial-special-icon {
        width: 56px;
        height: 56px;
        background: rgba(16, 185, 129, 0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    .tutorial-special-card:hover .tutorial-special-icon {
        background: #10b981;
    }
    .tutorial-special-card:hover .tutorial-special-icon i {
        color: white;
    }
    .tutorial-special-icon i {
        font-size: 1.4rem;
        color: #10b981;
        transition: all 0.3s ease;
    }
    .tutorial-special-title {
        font-weight: 800;
        font-size: 1rem;
        margin-bottom: 0.75rem;
        color: #0f172a;
    }
    .tutorial-special-desc {
        font-size: 0.95rem;
        color: #475569;
        line-height: 1.7;
        flex-grow: 1;
    }
    .tutorial-general-wrapper {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    .tutorial-general-title {
        font-size: 1.05rem;
        font-weight: 800;
        margin: 0;
        color: #0f172a;
    }
    .tutorial-general-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1rem;
        margin: 0;
    }
    .tutorial-general-item {
        display: flex;
        gap: 0.85rem;
        padding: 1rem 1.1rem;
        border-radius: 18px;
        background: #f8fafc;
        transition: all 0.3s ease;
        align-items: flex-start;
    }
    .tutorial-general-item:hover {
        background: rgba(16, 185, 129, 0.12);
        transform: translateX(3px);
    }
    .tutorial-num {
        width: 34px;
        height: 34px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.85rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }
    .tutorial-general-item:hover .tutorial-num {
        transform: scale(1.05);
    }
    .tutorial-general-text h4 {
        font-size: 0.95rem;
        font-weight: 700;
        margin-bottom: 0.35rem;
        color: #0f172a;
    }
    .tutorial-general-text p {
        font-size: 0.85rem;
        color: #475569;
        line-height: 1.6;
        margin: 0;
    }
    .tutorial-footer {
        margin-top: 1.5rem;
        padding: 1rem 1.25rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 18px;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        flex-wrap: wrap;
        transition: all 0.3s ease;
    }
    .tutorial-footer:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(16,185,129,0.15);
    }
    .tutorial-footer i {
        color: #10b981;
        font-size: 1rem;
    }
    .tutorial-footer span {
        font-size: 0.9rem;
        color: #0f5f34;
        line-height: 1.6;
    }

    /* ============================================
       CTA BANNER & FOOTER
    ============================================ */
    .cta-banner {
        background: linear-gradient(135deg, #064e3b, #0f2b22);
        border-radius: 32px;
        padding: 3rem;
        text-align: center;
        position: relative;
        overflow: hidden;
        margin: 2rem 0;
        transition: var(--transition-bounce);
    }
    .cta-banner:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-2xl);
    }
    .cta-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(16,185,129,0.1) 0%, transparent 70%);
        animation: rotateBg 20s linear infinite;
    }
    @keyframes rotateBg {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    .btn-cta {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.9rem 2rem;
        background: white;
        color: var(--primary-dark);
        border-radius: 60px;
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition-bounce);
        margin-top: 1rem;
    }
    .btn-cta:hover {
        transform: translateY(-3px);
        gap: 1rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        background: var(--primary);
        color: white;
    }
    .footer-premium {
        background: linear-gradient(135deg, #0f172a, #1e293b);
        border-radius: 32px;
        margin-top: 3rem;
        padding: 2rem 2rem 1.5rem;
        position: relative;
        overflow: hidden;
    }
    .footer-premium::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(16,185,129,0.05) 0%, transparent 70%);
        animation: pulseSlow 8s ease-in-out infinite;
    }
    @keyframes pulseSlow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.1); }
    }
    .footer-content {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 2rem;
        margin-bottom: 2rem;
        position: relative;
        z-index: 1;
    }
    .footer-brand h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.5rem;
    }
    .footer-brand p {
        color: rgba(255,255,255,0.6);
        font-size: 0.8rem;
        max-width: 250px;
        line-height: 1.5;
    }
    .footer-links { display: flex; gap: 3rem; flex-wrap: wrap; }
    .footer-links-column h4 {
        color: white;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        letter-spacing: 0.05em;
    }
    .footer-links-column a {
        display: block;
        color: rgba(255,255,255,0.5);
        text-decoration: none;
        font-size: 0.75rem;
        margin-bottom: 0.5rem;
        transition: var(--transition);
    }
    .footer-links-column a:hover {
        color: var(--primary);
        transform: translateX(5px);
    }
    .footer-social { display: flex; gap: 1rem; }
    .footer-social a {
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.1);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        transition: var(--transition-bounce);
    }
    .footer-social a:hover {
        background: var(--primary);
        transform: translateY(-5px) rotate(10deg);
    }
    .footer-bottom {
        text-align: center;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255,255,255,0.1);
        color: rgba(255,255,255,0.4);
        font-size: 0.7rem;
        position: relative;
        z-index: 1;
    }

    /* ============================================
       HERO PROFIL SECTION
    ============================================ */
    .hero-profil-section {
        min-height: 100vh;
        display: flex;
        align-items: center;
        position: relative;
        padding: 5rem 1.5rem;
    }
    .hero-ornaments {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0.1;
        pointer-events: none;
        z-index: 0;
    }
    .hero-ornament-1 {
        position: absolute;
        top: 10%;
        right: 5%;
        width: 24rem;
        height: 24rem;
        background: #10b981;
        border-radius: 50%;
        filter: blur(120px);
        animation: floatOrnament 8s ease-in-out infinite;
    }
    .hero-ornament-2 {
        position: absolute;
        bottom: 10%;
        left: 5%;
        width: 20rem;
        height: 20rem;
        background: #c5a358;
        border-radius: 50%;
        filter: blur(100px);
        animation: floatOrnament 10s ease-in-out infinite reverse;
    }
    @keyframes floatOrnament {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(20px, -20px) scale(1.05); }
    }
    .hero-grid {
        max-width: 1280px;
        margin: 0 auto;
        width: 100%;
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 3rem;
        align-items: center;
        position: relative;
        z-index: 1;
    }
    .hero-left { padding: 1rem; }
    .hero-badge-profil {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 1rem;
        border-radius: 60px;
        border: 1px solid rgba(16, 185, 129, 0.2);
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(4px);
        margin-bottom: 2rem;
    }
    .hero-badge-dot {
        width: 0.5rem;
        height: 0.5rem;
        background: #10b981;
        border-radius: 50%;
        display: inline-block;
        animation: ping 1.5s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    @keyframes ping {
        0%, 100% { opacity: 1; transform: scale(1); }
        75% { opacity: 0.5; transform: scale(1.2); }
    }
    .hero-badge-text {
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #059669;
        margin: 0;
    }
    .hero-title-profil {
        font-size: clamp(3rem, 8vw, 7rem);
        font-family: 'Playfair Display', serif;
        font-weight: 700;
        line-height: 0.85;
        margin-bottom: 2rem;
        letter-spacing: -0.03em;
        color: #121a17;
    }
    .hero-title-italic {
        font-style: italic;
        font-weight: 500;
        color: #121a17;
    }
    .hero-title-gradient {
        background: linear-gradient(135deg, #062c1f 0%, #10b981 80%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    .hero-description-text {
        font-size: 1rem;
        color: #64748b;
        font-weight: 400;
        line-height: 1.7;
        margin-bottom: 2rem;
        max-width: 500px;
    }
    .hero-right { position: relative; }
    .hero-image-container {
        position: relative;
        border-radius: 60px;
        overflow: hidden;
        transform: rotate(3deg);
        transition: transform 0.5s cubic-bezier(0.34, 1.2, 0.64, 1);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }
    .hero-image-container:hover {
        transform: rotate(0deg);
    }
    .hero-image {
        aspect-ratio: 3 / 4;
        width: 100%;
        height: auto;
        object-fit: cover;
        display: block;
        transition: transform 0.7s ease;
    }
    .hero-image-container:hover .hero-image {
        transform: scale(1.05);
    }
    .hero-quote {
        position: absolute;
        bottom: -1.5rem;
        left: -1.5rem;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        padding: 1.5rem 2rem;
        border-radius: 32px;
        box-shadow: 0 20px 35px -10px rgba(0, 0, 0, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: all 0.3s ease;
    }
    .hero-quote:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 40px -12px rgba(0, 0, 0, 0.2);
    }
    .hero-quote-text {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-style: italic;
        color: #0c110f;
        margin-bottom: 0.3rem;
        line-height: 1.2;
    }
    .hero-quote-sub {
        font-size: 0.6rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: #10b981;
        margin: 0;
    }
    .btn-hero {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 60px;
        font-weight: 700;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        border: none;
        cursor: pointer;
    }
    .btn-hero:hover {
        background: linear-gradient(135deg, #059669, #047857);
        gap: 1rem;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 1024px) {
        .container-premium { padding: 1rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .service-grid { grid-template-columns: repeat(3, 1fr); }
        .news-grid { grid-template-columns: 1fr; }
        .gallery-grid { grid-template-columns: repeat(2, 1fr); }
        .faq-grid { grid-template-columns: 1fr; }
        .digital-grid { grid-template-columns: 1fr; }
        .tutorial-special-grid { grid-template-columns: 1fr; }
        .tutorial-general-grid { grid-template-columns: repeat(2, 1fr); }
        .info-grid { grid-template-columns: repeat(2, 1fr); }
        .hero-content { padding: 1rem; text-align: center; }
        .hero-buttons { justify-content: center; }
        .footer-content { flex-direction: column; text-align: center; }
        .footer-links { justify-content: center; }
        .footer-social { justify-content: center; }
        .hero-grid { grid-template-columns: 1fr; gap: 2rem; text-align: center; }
        .hero-left { text-align: center; }
        .hero-description-text { margin-left: auto; margin-right: auto; }
        .hero-badge-profil { justify-content: center; margin-left: auto; margin-right: auto; }
        .hero-title-profil { text-align: center; }
        .hero-right { max-width: 500px; margin: 0 auto; }
        .hero-quote { bottom: -1rem; left: 50%; transform: translateX(-50%); white-space: nowrap; }
        .hero-quote:hover { transform: translateX(-50%) translateY(-5px); }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 0.8rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .service-grid { grid-template-columns: 1fr; }
        .gallery-grid { grid-template-columns: 1fr; }
        .tutorial-general-grid { grid-template-columns: 1fr; }
        .info-grid { grid-template-columns: 1fr; }
        .chart-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .category-group { flex-wrap: wrap; justify-content: center; }
        .canvas-container { padding: 1rem; margin: 0.5rem; }
        .hero-slide { height: 60vh; }
        .hero-slide .hero-content .hero-title { font-size: clamp(2rem, 8vw, 3rem) !important; }
        .hero-slide .hero-content .hero-subtitle { font-size: 0.85rem !important; }
        .hero-slide .hero-content .hero-badge { font-size: 0.6rem !important; padding: 0.3rem 1rem !important; }
        .hero-content { padding-right: 5%; }
        .hero-profil-section { padding: 2rem 1rem; }
        .hero-title-profil { font-size: clamp(2rem, 8vw, 3.5rem); margin-bottom: 1rem; }
        .hero-description-text { font-size: 0.9rem; }
        .hero-image-container { border-radius: 40px; }
        .hero-quote { padding: 0.8rem 1.2rem; white-space: normal; text-align: center; width: 90%; left: 5%; transform: translateX(0); bottom: -0.8rem; }
        .hero-quote-text { font-size: 1rem; }
        .hero-quote-sub { font-size: 0.5rem; }
        .hero-quote:hover { transform: translateY(-5px); }
        .tutorial-section { padding: 1rem; }
        .tutorial-header { flex-direction: column; align-items: flex-start; gap: 0.75rem; }
        .tutorial-header h3 { font-size: 0.85rem; }
        .tutorial-header i { font-size: 1.1rem; }
        .tutorial-special-card { min-height: auto; }
        .tutorial-special-title { font-size: 0.75rem; }
        .tutorial-special-desc { font-size: 0.6rem; }
        .tutorial-general-text h4 { font-size: 0.65rem; }
        .tutorial-general-text p { font-size: 0.55rem; }
        .tutorial-footer span { font-size: 0.65rem; }
        .slider-nav { bottom: 1rem; right: 1rem; }
        .slider-dot { width: 30px; }
        .slider-dot.active { width: 45px; }
    }
</style>

<div class="scroll-line"></div>
<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- ============================================= --}}
    {{-- 1. HERO SLIDER PREMIUM --}}
    {{-- ============================================= --}}
    <section data-aos="fade-up">
        <div class="hero-slider-container" x-data="{ slide: 0, totalSlides: 6 }" x-init="setInterval(() => slide = (slide + 1) % totalSlides, 5500)">
            <div class="hero-slider-wrapper" :style="'transform: translateX(-' + (slide * 100) + '%)'">
                @php
                    $hero = [
                        ['t' => 'Peradaban Digital', 'd' => 'Menyatukan teknologi dengan kearifan lokal Batak Toba.', 'img' => asset('images/login dan register/1.jpeg'), 'badge' => 'Smart Village'],
                        ['t' => 'UMKM Go Digital', 'd' => 'Mendorong ekonomi kreatif warga menuju pasar global.', 'img' => asset('images/login dan register/2.jpeg'), 'badge' => 'Ekonomi Kreatif'],
                        ['t' => 'Danau Toba Lestari', 'd' => 'Menjaga keindahan alam untuk generasi mendatang.', 'img' => asset('images/login dan register/3.jpeg'), 'badge' => 'Ekowisata'],
                        ['t' => 'Layanan Digital', 'd' => 'Akses administrasi desa kini lebih cepat dan transparan.', 'img' => asset('images/login dan register/4.jpeg'), 'badge' => 'E-Government'],
                        ['t' => 'Budaya Batak', 'd' => 'Melestarikan adat istiadat di tengah modernisasi.', 'img' => asset('images/login dan register/5.jpeg'), 'badge' => 'Kearifan Lokal'],
                        ['t' => 'Desa Cerdas', 'd' => 'Bersama membangun desa digital yang berkelanjutan.', 'img' => asset('images/login dan register/1.jpeg'), 'badge' => 'Smart Village'],
                    ];
                @endphp
                @foreach($hero as $h)
                <div class="hero-slide">
                    <img src="{{ $h['img'] }}" alt="{{ $h['t'] }}" loading="lazy">
                    <div class="hero-content">
                        <span class="hero-badge">{{ $h['badge'] }}</span>
                        <h1 class="hero-title">{{ $h['t'] }}</h1>
                        <p class="hero-subtitle">{{ $h['d'] }}</p>
                        <div class="hero-buttons">
                            <a href="#layanan-publik" class="btn-hero-primary">✨ Layanan Publik</a>
                            <a href="#berita" class="btn-hero-secondary">📖 Pelajari →</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="slider-nav">
                @foreach($hero as $index => $h)
                    <div class="slider-dot" :class="slide === {{ $index }} ? 'active' : ''" @click="slide = {{ $index }}"></div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ============================================= --}}
    {{-- 2. HERO PROFIL DESA --}}
    {{-- ============================================= --}}
    <section class="hero-profil-section">
        <div class="hero-ornaments">
            <div class="hero-ornament-1"></div>
            <div class="hero-ornament-2"></div>
        </div>
        <div class="hero-grid">
            <div class="hero-left">
                <div class="hero-badge-profil">
                    <span class="hero-badge-dot"></span>
                    <span class="hero-badge-text">Profil</span>
                </div>
                <h1 class="hero-title-profil" data-aos="fade-up" data-aos-delay="200">
                    Profil <br>
                    <span class="hero-title-italic">Desa</span> <br>
                    <span class="hero-title-gradient">Lumban Silintong.</span>
                </h1>
                <div class="hero-description" data-aos="fade-up" data-aos-delay="400">
                    <p class="hero-description-text">
                        Simfoni harmoni antara kemegahan tebing vulkanik, jernihnya Danau Toba, 
                        dan luhurnya tradisi Batak yang terjaga dalam modernitas.
                    </p>
                    <a href="{{ route('profil-desa') }}" class="btn-hero">
                        Pelajari Lebih Lanjut <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="hero-right" data-aos="zoom-out" data-aos-delay="600">
                <div class="hero-image-container">
                    <img src="{{ asset('images/profil/1.jpeg') }}" alt="Desa Lumban Silintong" class="hero-image">
                </div>
                <div class="hero-quote" data-aos="fade-up" data-aos-delay="800">
                    <p class="hero-quote-text">"Mansai Uli"</p>
                    <p class="hero-quote-sub">Keindahan yang natural, budaya yang abadi.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================= --}}
    {{-- 3. STATISTIK DESA --}}
    {{-- ============================================= --}}
    <section data-aos="fade-up" data-aos-delay="100">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon"><i class="fa-solid fa-users"></i></div>
                <div class="stat-value counter">{{ number_format($stat_penduduk) }}</div>
                <div class="stat-label">Total Penduduk</div>
                <div class="stat-progress">
                    <div class="stat-progress-bar" style="width: 100%; background: linear-gradient(90deg, var(--primary), var(--primary-light));"></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb); box-shadow: 0 8px 20px rgba(59,130,246,0.2);">
                    <i class="fa-solid fa-mars"></i>
                </div>
                <div class="stat-value counter">{{ number_format($penduduk_pria) }}</div>
                <div class="stat-label">Laki-laki</div>
                <div class="stat-progress">
                    <div class="stat-progress-bar" style="width: {{ ($penduduk_pria / max($stat_penduduk, 1)) * 100 }}%; background: linear-gradient(90deg, #3b82f6, #60a5fa);"></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #ec4899, #db2777); box-shadow: 0 8px 20px rgba(236,72,153,0.2);">
                    <i class="fa-solid fa-venus"></i>
                </div>
                <div class="stat-value counter">{{ number_format($penduduk_wanita) }}</div>
                <div class="stat-label">Perempuan</div>
                <div class="stat-progress">
                    <div class="stat-progress-bar" style="width: {{ ($penduduk_wanita / max($stat_penduduk, 1)) * 100 }}%; background: linear-gradient(90deg, #ec4899, #f472b6);"></div>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 8px 20px rgba(245,158,11,0.2);">
                    <i class="fa-solid fa-house-user"></i>
                </div>
                <div class="stat-value counter">{{ number_format($stat_kk) }}</div>
                <div class="stat-label">Kepala Keluarga</div>
                <div class="stat-progress">
                    <div class="stat-progress-bar" style="width: {{ ($stat_kk / max($stat_penduduk, 1)) * 100 }}%; background: linear-gradient(90deg, #f59e0b, #fbbf24);"></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================= --}}
    {{-- 4. CHART VISUALISASI DATA --}}
    {{-- ============================================= --}}
    <section data-aos="fade-up" data-aos-delay="150">
        <div class="chart-section">
            <div class="chart-header">
                <div class="flex flex-wrap justify-between items-center gap-4">
                    <div>
                        <div class="chart-title">
                            <div class="chart-title-icon"><i class="fa-solid fa-chart-simple"></i></div>
                            <h2>Visualisasi Data Penduduk</h2>
                        </div>
                        <p class="chart-subtitle">Pilih kategori dan jenis diagram untuk melihat detail statistik</p>
                    </div>
                    <div class="chart-type-group">
                        <button onclick="changeChartType('bar', this)" class="chart-type-btn active"><i class="fa-solid fa-chart-column"></i> Bar</button>
                        <button onclick="changeChartType('line', this)" class="chart-type-btn"><i class="fa-solid fa-chart-line"></i> Line</button>
                        <button onclick="changeChartType('pie', this)" class="chart-type-btn"><i class="fa-solid fa-chart-pie"></i> Pie</button>
                        <button onclick="changeChartType('doughnut', this)" class="chart-type-btn"><i class="fa-solid fa-circle-notch"></i> Donut</button>
                    </div>
                </div>
            </div>
            <div class="px-6 pt-4">
                <div class="category-group">
                    <button id="btn-penduduk" onclick="loadChartData('penduduk', this)" class="category-btn active"><i class="fa-solid fa-users"></i> Statistik Penduduk</button>
                    <button id="btn-umur" onclick="loadChartData('umur', this)" class="category-btn"><i class="fa-solid fa-chart-line"></i> Kelompok Umur</button>
                </div>
            </div>
            <div class="canvas-container">
                <canvas id="statistikChart"></canvas>
            </div>
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon" style="background: rgba(16,185,129,0.1);"><i class="fa-solid fa-database text-emerald-600"></i></div>
                    <div class="info-content"><p style="color: var(--primary);">DATA REALTIME</p><p>Diperbarui secara otomatis dari database</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon" style="background: rgba(59,130,246,0.1);"><i class="fa-solid fa-chart-simple text-blue-600"></i></div>
                    <div class="info-content"><p style="color: #3b82f6;">INTERAKTIF</p><p>Hover untuk melihat detail lengkap data</p></div>
                </div>
                <div class="info-item">
                    <div class="info-icon" style="background: rgba(139,92,246,0.1);"><i class="fa-solid fa-mobile-alt text-purple-600"></i></div>
                    <div class="info-content"><p style="color: #8b5cf6;">RESPONSIF</p><p>Tampil optimal di semua perangkat</p></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================= --}}
    {{-- 5. LAYANAN PUBLIK --}}
    {{-- ============================================= --}}
    <section id="layanan-publik" data-aos="fade-up" data-aos-delay="200">
        <div class="text-center mb-4">
            <div class="section-badge d-inline-flex"><i class="fa-solid fa-star"></i><span>Akses Mudah</span></div>
            <h2 class="section-title">Layanan <span>Publik</span></h2>
            <p class="text-gray-500 mt-2">Akses berbagai layanan informasi desa secara mudah dan cepat</p>
        </div>
        <div class="service-grid">
            <a href="{{ route('profil-desa') }}" class="service-card"><div class="service-icon"><i class="fa-solid fa-landmark-dome"></i></div><div class="service-title">Profil Desa</div><div class="service-desc">Sejarah & Struktur</div></a>
            <a href="{{ route('berita') }}" class="service-card"><div class="service-icon"><i class="fa-solid fa-newspaper"></i></div><div class="service-title">Berita</div><div class="service-desc">Info & Pengumuman</div></a>
            <a href="{{ route('galeri') }}" class="service-card"><div class="service-icon"><i class="fa-solid fa-photo-film"></i></div><div class="service-title">Galeri</div><div class="service-desc">Dokumentasi</div></a>
            <a href="{{ route('umkm') }}" class="service-card"><div class="service-icon"><i class="fa-solid fa-shop"></i></div><div class="service-title">UMKM</div><div class="service-desc">Produk Unggulan</div></a>
            <a href="{{ route('kontak') }}" class="service-card"><div class="service-icon"><i class="fa-solid fa-envelope"></i></div><div class="service-title">Kontak</div><div class="service-desc">Hubungi Kami</div></a>
        </div>
    </section>

    {{-- ============================================= --}}
    {{-- 6. LAYANAN DIGITAL (LOCKED) --}}
    {{-- ============================================= --}}
    <section data-aos="fade-up" data-aos-delay="250">
        <div class="text-center mb-4">
            <div class="section-badge d-inline-flex"><i class="fa-solid fa-bolt"></i><span>Akses Cepat</span></div>
            <h2 class="section-title">Layanan <span>Digital Desa</span></h2>
            <p class="text-gray-500 mt-2">Akses layanan administrasi online. <span class="text-primary font-semibold">Login terlebih dahulu</span> untuk menggunakan layanan berikut.</p>
        </div>
        <div class="digital-grid">
            <div class="locked-card" onclick="window.location='{{ route('login') }}'">
                <div class="card-content"><div class="card-icon"><i class="fa-solid fa-file-signature"></i></div><h3>Ajukan Surat</h3><p>Domisili, Usaha, Tidak Mampu, Kelahiran, Kematian, dan 12 jenis lainnya.</p><div class="card-arrow"><span>Ajukan Sekarang</span><i class="fa-solid fa-arrow-right"></i></div></div>
                <div class="locked-overlay"><div class="locked-content"><i class="fa-solid fa-lock"></i><span>Login untuk mengakses</span></div></div>
            </div>
            <div class="locked-card" onclick="window.location='{{ route('login') }}'">
                <div class="card-content"><div class="card-icon"><i class="fa-solid fa-comment-dots"></i></div><h3>Aspirasi & Keluhan</h3><p>Sampaikan suara, saran, atau keluhan Anda langsung ke jajaran perangkat desa.</p><div class="card-arrow"><span>Sampaikan Aspirasi</span><i class="fa-solid fa-arrow-right"></i></div></div>
                <div class="locked-overlay"><div class="locked-content"><i class="fa-solid fa-lock"></i><span>Login untuk mengirim</span></div></div>
            </div>
        </div>
    </section>

    {{-- ============================================= --}}
    {{-- 7. BERITA TERKINI --}}
    {{-- ============================================= --}}
    <section id="berita" data-aos="fade-up" data-aos-delay="300">
        <div class="flex justify-between items-end mb-6 flex-wrap gap-4">
            <div><div class="section-badge d-inline-flex"><i class="fa-solid fa-newspaper"></i><span>Update Terkini</span></div><h2 class="section-title" style="font-size: 1.8rem;">📰 Berita <span>Utama</span></h2></div>
            <a href="{{ route('berita') }}" class="text-sm text-primary hover:underline flex items-center gap-1">Lihat Semua <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        @if(isset($beritas) && count($beritas) > 0)
        <div class="news-grid">
            @foreach($beritas->take(4) as $berita)
            <div class="news-card" onclick="window.location='{{ route('berita.show', $berita->slug) }}'">
                <div class="news-img"><img src="{{ $berita->foto ? asset('storage/' . $berita->foto) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=500' }}" loading="lazy"></div>
                <div class="news-content"><span class="news-category">{{ $berita->kategori ?? 'Informasi' }}</span><h4 class="news-title">{{ Str::limit($berita->judul, 50) }}</h4><div class="news-date"><i class="fa-solid fa-calendar"></i> {{ $berita->created_at->translatedFormat('d M Y') }}</div></div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 bg-white rounded-3xl border border-gray-100"><i class="fa-solid fa-newspaper text-5xl text-gray-300 mb-4"></i><p class="text-gray-400">Belum ada berita terbaru</p></div>
        @endif
    </section>

    {{-- ============================================= --}}
    {{-- 8. GALERI --}}
    {{-- ============================================= --}}
    <section id="galeri" data-aos="fade-up" data-aos-delay="350">
        <div class="flex justify-between items-end mb-6 flex-wrap gap-4">
            <div><div class="section-badge d-inline-flex"><i class="fa-solid fa-camera"></i><span>Momen Berharga</span></div><h2 class="section-title" style="font-size: 1.8rem;">📸 Galeri</h2></div>
            <a href="{{ route('galeri') }}" class="text-sm text-primary hover:underline flex items-center gap-1">Lihat Semua <i class="fa-solid fa-arrow-right"></i></a>
        </div>
        @if(isset($galeris) && count($galeris) > 0)
        <div class="gallery-grid">
            @foreach($galeris->take(8) as $g)
            <div class="gallery-item" onclick="window.location='{{ route('galeri.show', $g->id_galeri) }}'">
                <img src="{{ $g->gambar_galeri ? asset('storage/' . $g->gambar_galeri) : 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=300' }}" loading="lazy">
                <div class="gallery-overlay"><i class="fa-solid fa-magnifying-glass-plus"></i></div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-12 bg-white rounded-3xl border border-gray-100"><i class="fa-solid fa-images text-5xl text-gray-300 mb-4"></i><p class="text-gray-400">Belum ada foto kegiatan</p></div>
        @endif
    </section>

    {{-- ============================================= --}}
    {{-- 9. FAQ --}}
    {{-- ============================================= --}}
    <section data-aos="fade-up" data-aos-delay="400">
        <div class="text-center mb-4">
            <div class="section-badge d-inline-flex"><i class="fa-solid fa-circle-question"></i><span>Info & Bantuan</span></div>
            <h2 class="section-title">Pusat <span>Informasi</span></h2>
            <p class="text-gray-500 mt-2">Pertanyaan yang sering diajukan seputar layanan desa</p>
        </div>
        <div class="faq-grid" id="faqContainer">
            @php
                $faqs = [
                    ['q' => '📝 Bagaimana cara mengajukan surat keterangan?', 'a' => 'Login ke akun Anda, lalu pilih menu "Ajukan Surat" di Layanan Digital. Isi formulir dengan data yang benar, upload dokumen pendukung, lalu kirim. Admin akan memproses dalam 1-3 hari kerja. Surat selesai dapat diunduh di halaman Riwayat Pengajuan.'],
                    ['q' => '💬 Bagaimana cara menyampaikan aspirasi?', 'a' => 'Login ke akun Anda, kemudian pilih menu "Aspirasi & Keluhan". Tulis judul dan isi aspirasi, pilih kategori (Saran, Keluhan, Masukan, atau Pertanyaan), lalu kirim. Aspirasi akan ditanggapi oleh admin desa maksimal 3 hari kerja.'],
                    ['q' => '🏪 Bagaimana cara mendaftarkan UMKM?', 'a' => 'Login ke akun Anda, lalu kunjungi halaman UMKM. Klik tombol "Daftarkan Usaha", isi data lengkap usaha Anda (nama usaha, kategori, deskripsi, logo, dll). Admin akan memverifikasi dalam 2x24 jam. Setelah disetujui, UMKM Anda akan tampil di katalog.'],
                    ['q' => '🆔 Merasa password kurang aman??, bagaimana cara mengubahnya?', 'a' => 'Klik "profil saya" di bagian dropdown navbar, masukkan password yang sebelumnya, lalu masukkan password baru anda, dan password otomatis akan berubah.'],
                    ['q' => '⏱️ Berapa lama proses pembuatan surat?', 'a' => 'Proses verifikasi dan penerbitan surat membutuhkan waktu 1-3 hari kerja setelah pengajuan masuk. Anda dapat memantau status pengajuan di menu "Riwayat Pengajuan Surat".'],
                    ['q' => '📱 Apakah bisa mengakses portal dari HP?', 'a' => 'Ya, portal ini responsif dan dapat diakses dengan nyaman dari smartphone, tablet, maupun komputer desktop. Tampilan akan menyesuaikan dengan ukuran layar perangkat Anda.'],
                ];
            @endphp
            @foreach($faqs as $i => $f)
            <div class="faq-item" data-faq-index="{{ $i }}">
                <div class="faq-question">
                    <span>{{ $f['q'] }}</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </div>
                <div class="faq-answer">
                    <p>{{ $f['a'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    {{-- ============================================= --}}
    {{-- 10. TUTORIAL SECTION --}}
    {{-- ============================================= --}}
    <div class="tutorial-section" data-aos="fade-up" data-aos-delay="450">
        <div class="tutorial-header">
            <i class="fa-solid fa-circle-question"></i>
            <h3>📖 Tutorial Layanan Digital Desa</h3>
        </div>
        <p class="tutorial-intro">
            Panduan lengkap menggunakan layanan digital Desa Lumban Silintong. Ikuti langkah berikut untuk pengalaman yang lebih cepat dan jelas.
        </p>
        <div class="tutorial-content-grid">
            <div class="tutorial-special-grid">
                <div class="tutorial-special-card" onclick="window.location='{{ route('login') }}'">
                    <div class="tutorial-special-icon"><i class="fa-solid fa-file-pen"></i></div>
                    <div class="tutorial-special-title">📋 Mengajukan Surat</div>
                    <div class="tutorial-special-desc">Login, pilih menu Ajukan Surat, isi data lengkap, upload dokumen, lalu kirim. Proses selesai dalam 1–3 hari kerja.</div>
                </div>
                <div class="tutorial-special-card" onclick="window.location='{{ route('login') }}'">
                    <div class="tutorial-special-icon"><i class="fa-solid fa-comment-dots"></i></div>
                    <div class="tutorial-special-title">💬 Mengirim Aspirasi</div>
                    <div class="tutorial-special-desc">Login kemudian pilih Aspirasi & Keluhan. Tulis pesan, pilih kategori, dan kirim. Aspirasi ditanggapi maksimal 3 hari kerja.</div>
                </div>
                <div class="tutorial-special-card" onclick="window.location='{{ route('login') }}'">
                    <div class="tutorial-special-icon"><i class="fa-solid fa-store"></i></div>
                    <div class="tutorial-special-title">🏪 Request Akun UMKM</div>
                    <div class="tutorial-special-desc">Login, buka halaman UMKM, klik Daftarkan Usaha, isi data usaha lengkap, dan tunggu verifikasi admin dalam 2x24 jam.</div>
                </div>
            </div>
            <div class="tutorial-general-wrapper">
                <h4 class="tutorial-general-title">Langkah Cepat dan Penting</h4>
                <div class="tutorial-general-grid">
                    <div class="tutorial-general-item">
                        <div class="tutorial-num">1</div>
                        <div class="tutorial-general-text">
                            <h4>🏠 Navigasi Utama</h4>
                            <p>Gunakan menu navbar untuk mengakses semua halaman layanan.</p>
                        </div>
                    </div>
                    <div class="tutorial-general-item">
                        <div class="tutorial-num">2</div>
                        <div class="tutorial-general-text">
                            <h4>📊 Visualisasi Data</h4>
                            <p>Pilih Bar, Line, atau Pie untuk mengubah tampilan grafik dengan mudah.</p>
                        </div>
                    </div>
                    <div class="tutorial-general-item">
                        <div class="tutorial-num">3</div>
                        <div class="tutorial-general-text">
                            <h4>🔐 Login Terlebih Dahulu</h4>
                            <p>Login diperlukan untuk mengajukan surat, aspirasi, dan pendaftaran UMKM.</p>
                        </div>
                    </div>
                    <div class="tutorial-general-item">
                        <div class="tutorial-num">4</div>
                        <div class="tutorial-general-text">
                            <h4>🖱️ Hover Interaktif</h4>
                            <p>Arahkan kursor pada kartu untuk melihat efek animasi dan informasi tambahan.</p>
                        </div>
                    </div>
                    <div class="tutorial-general-item">
                        <div class="tutorial-num">5</div>
                        <div class="tutorial-general-text">
                            <h4>📱 Responsif</h4>
                            <p>Portal dapat diakses dengan baik dari smartphone, tablet, maupun desktop.</p>
                        </div>
                    </div>
                    <div class="tutorial-general-item">
                        <div class="tutorial-num">6</div>
                        <div class="tutorial-general-text">
                            <h4>⏱️ Waktu Proses</h4>
                            <p>Surat 1-3 hari, aspirasi max 3 hari, UMKM 2x24 jam setelah verifikasi.</p>
                        </div>
                    </div>
                    <div class="tutorial-general-item">
                        <div class="tutorial-num">7</div>
                        <div class="tutorial-general-text">
                            <h4>📎 Lampiran Dokumen</h4>
                            <p>Upload berkas pendukung agar permohonan diproses lebih cepat dan tepat.</p>
                        </div>
                    </div>
                    <div class="tutorial-general-item">
                        <div class="tutorial-num">8</div>
                        <div class="tutorial-general-text">
                            <h4>💡 Tips Penting</h4>
                            <p>Pastikan data yang diisi sesuai dokumen asli untuk menghindari penolakan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="tutorial-footer">
            <i class="fa-solid fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Pastikan Anda sudah login terlebih dahulu sebelum menggunakan layanan pengajuan surat, aspirasi, atau pendaftaran UMKM. Data yang diisi harus sesuai dokumen asli untuk menghindari penolakan.</span>
        </div>
    </div>

    {{-- ============================================= --}}
    {{-- 11. CTA BANTUAN --}}
    {{-- ============================================= --}}
    <section data-aos="fade-up" data-aos-delay="500">
        <div class="cta-banner">
            <div class="relative z-10">
                <div class="w-20 h-20 bg-white/10 rounded-full flex items-center justify-center mx-auto mb-4 animate-bounce">
                    <i class="fa-solid fa-headset text-3xl text-white"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">💬 Butuh Bantuan?</h3>
                <p class="text-emerald-100/80 mb-5">Jika mengalami kendala, silakan hubungi admin atau datang ke kantor desa.</p>
                <a href="{{ route('kontak') }}" class="btn-cta">Hubungi Kami <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </section>

</div>

<script>
    // Scroll Progress Bar
    window.addEventListener('scroll', () => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        const scrollLine = document.querySelector(".scroll-line");
        if (scrollLine) scrollLine.style.width = scrolled + "%";
    });

    // AOS Init
    AOS.init({ duration: 600, once: true, offset: 50 });

    // Counter Animation
    document.querySelectorAll('.counter').forEach(counter => {
        const value = parseInt(counter.innerText.replace(/\./g, ''));
        let current = 0;
        const increment = Math.ceil(value / 60);
        const update = () => {
            current += increment;
            if (current < value) {
                counter.innerText = current.toLocaleString();
                requestAnimationFrame(update);
            } else {
                counter.innerText = value.toLocaleString();
            }
        };
        update();
    });

    // FAQ DROPDOWN
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');
        faqItems.forEach(item => {
            const questionDiv = item.querySelector('.faq-question');
            questionDiv.addEventListener('click', function(e) {
                e.stopPropagation();
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
                item.classList.toggle('active');
            });
        });
    });

    // CHART
    Chart.defaults.font.family = "'Plus Jakarta Sans', 'Segoe UI', system-ui, sans-serif";
    Chart.defaults.font.size = 11;
    Chart.defaults.color = '#64748b';

    const chartData = {
        penduduk: {
            labels: ['Laki-laki', 'Perempuan', 'Kepala Keluarga'],
            values: [{{ $penduduk_pria ?? 0 }}, {{ $penduduk_wanita ?? 0 }}, {{ str_replace('.', '', $stat_kk ?? '0') }}],
            colors: ['rgba(59, 130, 246, 0.85)', 'rgba(236, 72, 153, 0.85)', 'rgba(245, 158, 11, 0.85)'],
            borderColors: ['rgb(59, 130, 246)', 'rgb(236, 72, 153)', 'rgb(245, 158, 11)'],
            hoverColors: ['rgba(59, 130, 246, 1)', 'rgba(236, 72, 153, 1)', 'rgba(245, 158, 11, 1)'],
            title: 'Statistik Penduduk'
        },
        umur: {
            labels: ['0-14 tahun', '15-29 tahun', '30-59 tahun', '60+ tahun'],
            values: [{{ $kelompok_umur_0_14 ?? 0 }}, {{ $kelompok_umur_15_29 ?? 0 }}, {{ $kelompok_umur_30_59 ?? 0 }}, {{ $kelompok_umur_60 ?? 0 }}],
            colors: ['rgba(16, 185, 129, 0.85)', 'rgba(59, 130, 246, 0.85)', 'rgba(245, 158, 11, 0.85)', 'rgba(139, 92, 246, 0.85)'],
            borderColors: ['rgb(16, 185, 129)', 'rgb(59, 130, 246)', 'rgb(245, 158, 11)', 'rgb(139, 92, 246)'],
            hoverColors: ['rgba(16, 185, 129, 1)', 'rgba(59, 130, 246, 1)', 'rgba(245, 158, 11, 1)', 'rgba(139, 92, 246, 1)'],
            title: 'Kelompok Umur Penduduk'
        }
    };

    let statistikChart = null;
    let currentChartType = 'bar';
    let currentKategori = 'penduduk';

    function loadChartData(kategori, btnElement = null) {
        currentKategori = kategori;
        const data = chartData[kategori];
        if (!data || !data.labels || !data.values) {
            console.error("Data tidak ditemukan untuk: " + kategori);
            return;
        }
        const canvas = document.getElementById('statistikChart');
        canvas.style.opacity = '0.5';
        setTimeout(() => {
            if (statistikChart) statistikChart.destroy();
            const ctx = canvas.getContext('2d');
            const isPieType = ['pie', 'doughnut'].includes(currentChartType);
            let gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
            gradientFill.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
            gradientFill.addColorStop(0.5, 'rgba(16, 185, 129, 0.1)');
            gradientFill.addColorStop(1, 'rgba(16, 185, 129, 0.02)');
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: true,
                interaction: { mode: 'index', intersect: false },
                plugins: {
                    legend: {
                        position: isPieType ? 'bottom' : 'top',
                        labels: { padding: 15, usePointStyle: true, pointStyle: 'circle', font: { size: 11, weight: '600' }, boxWidth: 8, boxHeight: 8 }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        borderColor: '#10b981',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 11 },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                let value = context.raw;
                                let total = 0;
                                if (isPieType && data.values) total = data.values.reduce((a, b) => a + b, 0);
                                let percentage = total > 0 ? ` (${((value / total) * 100).toFixed(1)}%)` : '';
                                return `${label}: ${value.toLocaleString()} data${percentage}`;
                            }
                        }
                    }
                },
                onHover: function(event, activeElements) { canvas.style.cursor = activeElements.length ? 'pointer' : 'default'; }
            };
            if (!isPieType) {
                commonOptions.scales = {
                    y: { beginAtZero: true, grid: { color: '#e2e8f0', drawBorder: false, lineWidth: 1 }, ticks: { padding: 8, callback: (v) => v.toLocaleString(), font: { size: 10 } }, title: { display: true, text: '📊 Jumlah Data', font: { size: 10, weight: '600' }, color: '#64748b' } },
                    x: { grid: { display: false }, ticks: { font: { size: 11, weight: '600' }, color: '#334155' } }
                };
            }
            if (isPieType) {
                statistikChart = new Chart(ctx, {
                    type: currentChartType,
                    data: { labels: data.labels, datasets: [{ data: data.values, backgroundColor: data.colors, borderWidth: 3, borderColor: '#ffffff', hoverOffset: 15, cutout: currentChartType === 'doughnut' ? '65%' : 0, borderRadius: 10 }] },
                    options: { ...commonOptions, layout: { padding: 20 } }
                });
            } else {
                statistikChart = new Chart(ctx, {
                    type: currentChartType,
                    data: { labels: data.labels, datasets: [{ label: data.title || kategori.toUpperCase(), data: data.values, backgroundColor: currentChartType === 'line' ? gradientFill : data.colors, borderColor: currentChartType === 'line' ? '#10b981' : data.borderColors || data.colors, borderWidth: currentChartType === 'line' ? 3 : 1, borderRadius: currentChartType === 'bar' ? 8 : 0, borderSkipped: false, fill: currentChartType === 'line', tension: 0.4, pointBackgroundColor: '#10b981', pointBorderColor: '#ffffff', pointBorderWidth: 2, pointRadius: currentChartType === 'line' ? 5 : 0, pointHoverRadius: 8, pointHoverBackgroundColor: '#059669', hoverBackgroundColor: currentChartType === 'bar' ? data.hoverColors || data.colors : null, maxBarThickness: 70, barPercentage: 0.7, categoryPercentage: 0.8 }] },
                    options: commonOptions
                });
            }
            canvas.style.opacity = '1';
        }, 200);
        if (btnElement) {
            document.querySelectorAll('.category-btn').forEach(btn => btn.classList.remove('active'));
            btnElement.classList.add('active');
        }
    }

    function changeChartType(type, btnElement) {
        currentChartType = type;
        document.querySelectorAll('.chart-type-btn').forEach(btn => btn.classList.remove('active'));
        btnElement.classList.add('active');
        loadChartData(currentKategori);
    }

    // Load default chart
    document.addEventListener('DOMContentLoaded', function() {
        const defaultBtn = document.getElementById('btn-penduduk');
        if (defaultBtn) loadChartData('penduduk', defaultBtn);
    });
</script>
@endsection