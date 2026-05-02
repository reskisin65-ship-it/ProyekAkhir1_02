{{-- resources/views/pages/statistik.blade.php --}}
@extends('layouts.app')

@section('title', 'Statistik Desa - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

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
        background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        opacity: 0.3;
    }

    /* Container Premium */
    .container-premium {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ============================================
       HERO SECTION PREMIUM
    ============================================ */
    .hero-section {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.4rem 1.2rem;
        border-radius: 100px;
        margin-bottom: 1rem;
        backdrop-filter: blur(4px);
    }

    .hero-badge i { font-size: 0.7rem; color: var(--primary); }
    .hero-badge span { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; color: var(--primary-dark); text-transform: uppercase; }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.5rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
        background: linear-gradient(135deg, var(--dark) 0%, var(--dark) 40%, var(--primary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-title span {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 0.9rem;
        color: var(--gray);
        margin-top: 0.75rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* ============================================
       STATS GRID PREMIUM
    ============================================ */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 2.5rem;
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

    .stat-card:hover::before {
        left: 100%;
    }

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
       CHART SECTION PREMIUM
    ============================================ */
    .chart-section {
        background: var(--card);
        border-radius: 32px;
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition-bounce);
    }

    .chart-section:hover {
        box-shadow: var(--shadow-xl);
    }

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

    .chart-title h2 {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--dark);
    }

    .chart-subtitle {
        font-size: 0.75rem;
        color: var(--gray);
        margin-left: 3.25rem;
    }

    /* Chart Type Buttons */
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

    .chart-type-btn:hover {
        color: var(--primary);
    }

    .chart-type-btn.active {
        background: white;
        color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    /* Category Buttons */
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

    /* Canvas Container */
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

    canvas {
        max-height: 400px;
        width: 100%;
        position: relative;
        z-index: 1;
    }

    /* Info Cards */
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

    .info-content p:last-child {
        font-size: 0.65rem;
        color: var(--gray);
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

    .tutorial-header i {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .tutorial-header h3 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        color: var(--dark);
    }

    .tutorial-intro {
        font-size: 0.85rem;
        color: var(--gray);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 1.2rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.8rem;
        border-radius: 16px;
        transition: var(--transition);
        cursor: pointer;
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
        font-size: 0.85rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .tutorial-item:hover .tutorial-num {
        transform: scale(1.1);
    }

    .tutorial-text h4 {
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--dark);
    }

    .tutorial-text p {
        font-size: 0.75rem;
        color: var(--gray);
        line-height: 1.4;
    }

    .tutorial-footer {
        margin-top: 1rem;
        padding: 0.8rem 1rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
        transition: var(--transition);
    }

    .tutorial-footer:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .tutorial-footer i {
        color: var(--primary);
        font-size: 1rem;
    }

    .tutorial-footer span {
        font-size: 0.75rem;
        color: #059669;
        line-height: 1.4;
    }

    /* Footer */
    .footer-info {
        margin-top: 2rem;
        text-align: center;
        padding: 1rem;
        background: rgba(255,255,255,0.5);
        border-radius: 60px;
        backdrop-filter: blur(4px);
    }

    /* Animations */
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }

    @keyframes pulse-glow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.05); }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); gap: 1rem; }
        .info-grid { grid-template-columns: repeat(2, 1fr); }
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .chart-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .chart-type-group { align-self: flex-start; }
        .category-group { flex-wrap: wrap; justify-content: center; }
        .category-btn { padding: 0.5rem 1rem; font-size: 0.7rem; }
        .canvas-container { padding: 1rem; margin: 0 0.5rem 0.5rem 0.5rem; }
        .info-grid { grid-template-columns: 1fr; gap: 0.5rem; padding: 1rem; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .tutorial-section { padding: 1rem; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- ============================================ --}}
    {{-- HERO SECTION PREMIUM --}}
    {{-- ============================================ --}}
    <div class="hero-section animate__animated animate__fadeInUp">
        <div class="hero-badge">
            <i class="fa-solid fa-chart-line"></i>
            <span>Informasi Publik</span>
        </div>
        <h1 class="hero-title">
            Statistik <span>Desa</span>
        </h1>
        <p class="hero-subtitle">
            Visualisasi data dan informasi demografi terkini Desa Lumban Silintong
        </p>
    </div>

    {{-- ============================================ --}}
    {{-- STATISTICS CARDS PREMIUM --}}
    {{-- ============================================ --}}
    <div class="stats-grid animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        {{-- Card 1 - Total Penduduk --}}
        <div class="stat-card">
            <div class="stat-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-value counter">{{ number_format($statistics['total_penduduk'] ?? 0) }}</div>
            <div class="stat-label">Total Penduduk</div>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: 100%; background: linear-gradient(90deg, var(--primary), var(--primary-light));"></div>
            </div>
        </div>

        {{-- Card 2 - Laki-laki --}}
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #3b82f6, #2563eb); box-shadow: 0 8px 20px rgba(59,130,246,0.2);">
                <i class="fa-solid fa-mars"></i>
            </div>
            <div class="stat-value counter">{{ number_format($statistics['penduduk_pria'] ?? 0) }}</div>
            <div class="stat-label">Laki-laki</div>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: {{ ($statistics['penduduk_pria'] / max($statistics['total_penduduk'], 1)) * 100 }}%; background: linear-gradient(90deg, #3b82f6, #60a5fa);"></div>
            </div>
        </div>

        {{-- Card 3 - Perempuan --}}
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #ec4899, #db2777); box-shadow: 0 8px 20px rgba(236,72,153,0.2);">
                <i class="fa-solid fa-venus"></i>
            </div>
            <div class="stat-value counter">{{ number_format($statistics['penduduk_wanita'] ?? 0) }}</div>
            <div class="stat-label">Perempuan</div>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: {{ ($statistics['penduduk_wanita'] / max($statistics['total_penduduk'], 1)) * 100 }}%; background: linear-gradient(90deg, #ec4899, #f472b6);"></div>
            </div>
        </div>

        {{-- Card 4 - Kepala Keluarga --}}
        <div class="stat-card">
            <div class="stat-icon" style="background: linear-gradient(135deg, #f59e0b, #d97706); box-shadow: 0 8px 20px rgba(245,158,11,0.2);">
                <i class="fa-solid fa-house-user"></i>
            </div>
            <div class="stat-value counter">{{ number_format($statistics['total_kk'] ?? 0) }}</div>
            <div class="stat-label">Kepala Keluarga</div>
            <div class="stat-progress">
                <div class="stat-progress-bar" style="width: {{ ($statistics['total_kk'] / max($statistics['total_penduduk'], 1)) * 100 }}%; background: linear-gradient(90deg, #f59e0b, #fbbf24);"></div>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- CHART SECTION PREMIUM --}}
    {{-- ============================================ --}}
    <div class="chart-section animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
        <div class="chart-header">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <div>
                    <div class="chart-title">
                        <div class="chart-title-icon">
                            <i class="fa-solid fa-chart-simple"></i>
                        </div>
                        <h2>Visualisasi Data</h2>
                    </div>
                    <p class="chart-subtitle">Pilih kategori dan jenis diagram untuk melihat detail statistik</p>
                </div>
                
                {{-- Tipe Chart Premium --}}
                <div class="chart-type-group">
                    <button onclick="changeChartType('bar', this)" class="chart-type-btn active">
                        <i class="fa-solid fa-chart-column"></i> Bar
                    </button>
                    <button onclick="changeChartType('line', this)" class="chart-type-btn">
                        <i class="fa-solid fa-chart-line"></i> Line
                    </button>
                    <button onclick="changeChartType('pie', this)" class="chart-type-btn">
                        <i class="fa-solid fa-chart-pie"></i> Pie
                    </button>
                    <button onclick="changeChartType('doughnut', this)" class="chart-type-btn">
                        <i class="fa-solid fa-circle-notch"></i> Donut
                    </button>
                </div>
            </div>
        </div>

        {{-- Kategori Premium --}}
        <div class="px-6 pt-4">
            <div class="category-group">
                <button id="btn-penduduk" onclick="loadChartData('penduduk', this)" class="category-btn active">
                    <i class="fa-solid fa-users"></i> Statistik Penduduk
                </button>
                <button id="btn-umur" onclick="loadChartData('umur', this)" class="category-btn">
                    <i class="fa-solid fa-chart-line"></i> Kelompok Umur
                </button>
            </div>
        </div>

        {{-- Canvas Chart Premium --}}
        <div class="canvas-container">
            <canvas id="statistikChart"></canvas>
        </div>

        {{-- Informasi Tambahan --}}
        <div class="info-grid">
            <div class="info-item">
                <div class="info-icon" style="background: rgba(16,185,129,0.1);">
                    <i class="fa-solid fa-database text-emerald-600"></i>
                </div>
                <div class="info-content">
                    <p style="color: var(--primary);">DATA REALTIME</p>
                    <p>Diperbarui secara otomatis dari database</p>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon" style="background: rgba(59,130,246,0.1);">
                    <i class="fa-solid fa-chart-simple text-blue-600"></i>
                </div>
                <div class="info-content">
                    <p style="color: #3b82f6;">INTERAKTIF</p>
                    <p>Hover untuk melihat detail lengkap data</p>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon" style="background: rgba(139,92,246,0.1);">
                    <i class="fa-solid fa-mobile-alt text-purple-600"></i>
                </div>
                <div class="info-content">
                    <p style="color: #8b5cf6;">RESPONSIF</p>
                    <p>Tampil optimal di semua perangkat</p>
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- TUTORIAL SECTION PREMIUM --}}
    {{-- ============================================== --}}
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Statistik Desa</h3>
        </div>
        
        <p class="tutorial-intro">
            Halaman <strong>Statistik Desa</strong> menyajikan informasi lengkap tentang data demografi 
            dan visualisasi penduduk Desa Lumban Silintong.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📊 Kartu Statistik</h4>
                    <p>Menampilkan data ringkas total penduduk, jumlah laki-laki, perempuan, dan kepala keluarga.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>🎨 Pilih Jenis Grafik</h4>
                    <p>Gunakan tombol Bar, Line, Pie, atau Donut untuk mengubah tampilan visualisasi data.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>🏷️ Filter Kategori</h4>
                    <p>Pilih kategori "Statistik Penduduk" atau "Kelompok Umur" untuk melihat data spesifik.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>🖱️ Hover Interaktif</h4>
                    <p>Arahkan kursor ke grafik untuk melihat detail nilai data secara presisi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>📱 Tampilan Responsif</h4>
                    <p>Grafik menyesuaikan dengan ukuran layar perangkat Anda.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>🔄 Data Realtime</h4>
                    <p>Data yang ditampilkan selalu diperbarui dari database desa.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Gunakan jenis grafik yang berbeda untuk mendapatkan perspektif yang berbeda dari data yang sama. Bar Chart cocok untuk perbandingan, Pie Chart untuk proporsi.</span>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- FOOTER INFO --}}
    {{-- ============================================ --}}
    <div class="footer-info animate__animated animate__fadeInUp" style="animation-delay: 0.4s">
        <div class="flex flex-wrap items-center justify-center gap-3 text-xs text-slate-400">
            <span><i class="fa-regular fa-clock mr-1"></i> Data terakhir: {{ now()->format('d F Y H:i:s') }}</span>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <span><i class="fa-solid fa-chart-line mr-1"></i> Sumber: Database Desa</span>
            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
            <span><i class="fa-solid fa-shield-alt mr-1"></i> Data terverifikasi</span>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart.js sebagai object global dengan konfigurasi premium
    Chart.defaults.font.family = "'Plus Jakarta Sans', 'Segoe UI', system-ui, sans-serif";
    Chart.defaults.font.size = 11;
    Chart.defaults.color = '#64748b';

    const chartData = @json($chartData);
    let statistikChart = null;
    let currentChartType = 'bar';
    let currentKategori = 'penduduk';

    // Fungsi load chart data
    function loadChartData(kategori, btnElement = null) {
        currentKategori = kategori;
        const data = chartData[kategori];
        
        if (!data || !data.labels || !data.values) {
            console.error("Data tidak ditemukan untuk: " + kategori);
            return;
        }
        
        // Efek loading
        const canvas = document.getElementById('statistikChart');
        canvas.style.opacity = '0.5';
        
        setTimeout(() => {
            if (statistikChart) statistikChart.destroy();
            
            const ctx = canvas.getContext('2d');
            const isPieType = ['pie', 'doughnut'].includes(currentChartType);
            
            // Gradient untuk line chart
            let gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
            gradientFill.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
            gradientFill.addColorStop(0.5, 'rgba(16, 185, 129, 0.1)');
            gradientFill.addColorStop(1, 'rgba(16, 185, 129, 0.02)');
            
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: isPieType ? 'bottom' : 'top',
                        labels: {
                            padding: 15,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 11, weight: '600' },
                            boxWidth: 8,
                            boxHeight: 8
                        }
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
                                if (isPieType && data.values) {
                                    total = data.values.reduce((a, b) => a + b, 0);
                                }
                                let percentage = total > 0 ? ` (${((value / total) * 100).toFixed(1)}%)` : '';
                                return `${label}: ${value.toLocaleString()} data${percentage}`;
                            }
                        }
                    }
                },
                onHover: function(event, activeElements) {
                    canvas.style.cursor = activeElements.length ? 'pointer' : 'default';
                }
            };
            
            if (!isPieType) {
                commonOptions.scales = {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#e2e8f0', drawBorder: false, lineWidth: 1 },
                        ticks: { padding: 8, callback: (v) => v.toLocaleString(), font: { size: 10 } },
                        title: { display: true, text: '📊 Jumlah Data', font: { size: 10, weight: '600' }, color: '#64748b' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { size: 11, weight: '600' }, color: '#334155' }
                    }
                };
            }
            
            if (isPieType) {
                statistikChart = new Chart(ctx, {
                    type: currentChartType,
                    data: {
                        labels: data.labels,
                        datasets: [{
                            data: data.values,
                            backgroundColor: data.colors,
                            borderWidth: 3,
                            borderColor: '#ffffff',
                            hoverOffset: 15,
                            cutout: currentChartType === 'doughnut' ? '65%' : 0,
                            borderRadius: 10
                        }]
                    },
                    options: { ...commonOptions, layout: { padding: 20 } }
                });
            } else {
                statistikChart = new Chart(ctx, {
                    type: currentChartType,
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: data.title || kategori.toUpperCase(),
                            data: data.values,
                            backgroundColor: currentChartType === 'line' ? gradientFill : data.colors,
                            borderColor: currentChartType === 'line' ? '#10b981' : data.borderColors || data.colors,
                            borderWidth: currentChartType === 'line' ? 3 : 1,
                            borderRadius: currentChartType === 'bar' ? 8 : 0,
                            borderSkipped: false,
                            fill: currentChartType === 'line',
                            tension: 0.4,
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: currentChartType === 'line' ? 5 : 0,
                            pointHoverRadius: 8,
                            pointHoverBackgroundColor: '#059669',
                            hoverBackgroundColor: currentChartType === 'bar' ? data.hoverColors || data.colors : null,
                            maxBarThickness: 70,
                            barPercentage: 0.7,
                            categoryPercentage: 0.8
                        }]
                    },
                    options: commonOptions
                });
            }
            
            canvas.style.opacity = '1';
        }, 200);
        
        // Update active button
        if (btnElement) {
            document.querySelectorAll('.category-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            btnElement.classList.add('active');
        }
    }

    // Ubah tipe chart
    function changeChartType(type, btnElement) {
        currentChartType = type;
        
        document.querySelectorAll('.chart-type-btn').forEach(btn => {
            btn.classList.remove('active');
        });
        btnElement.classList.add('active');
        
        loadChartData(currentKategori);
    }

    // Counter animation
    document.addEventListener('DOMContentLoaded', function() {
        const counters = document.querySelectorAll('.counter');
        counters.forEach(counter => {
            const value = parseInt(counter.innerText.replace(/\./g, ''));
            let current = 0;
            const increment = Math.ceil(value / 50);
            const updateCounter = () => {
                current += increment;
                if (current < value) {
                    counter.innerText = current.toLocaleString();
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.innerText = value.toLocaleString();
                }
            };
            updateCounter();
        });
        
        // Load default chart
        const defaultBtn = document.getElementById('btn-penduduk');
        loadChartData('penduduk', defaultBtn);
        
        // Interactive tutorial items
        const tutorialItems = document.querySelectorAll('.tutorial-item');
        tutorialItems.forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
                const title = this.querySelector('.tutorial-text h4').innerText;
                console.log(`Tutorial clicked: ${title}`);
            });
        });
        
        // Add animation to tutorial section on scroll
        const tutorialSection = document.querySelector('.tutorial-section');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        if (tutorialSection) {
            tutorialSection.style.opacity = '0';
            tutorialSection.style.transform = 'translateY(20px)';
            tutorialSection.style.transition = 'all 0.6s ease';
            observer.observe(tutorialSection);
        }
    });
</script>
@endsection