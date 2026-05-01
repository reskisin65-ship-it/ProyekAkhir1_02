{{-- resources/views/masyarakat/aspirasi/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Sampaikan Aspirasi - Lumban Silintong')

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
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ============================================
       HERO SECTION PREMIUM
    ============================================ */
    .hero-section {
        position: relative;
        margin-bottom: 2rem;
        background: linear-gradient(135deg, var(--dark), var(--dark-soft));
        border-radius: 32px;
        overflow: hidden;
        box-shadow: var(--shadow-xl);
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="rgba(255,255,255,0.03)" d="M100 0L120 80L200 100L120 120L100 200L80 120L0 100L80 80Z"/></svg>') repeat;
        opacity: 0.3;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        padding: 2rem 2.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .hero-text {
        flex: 1;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.1);
        backdrop-filter: blur(4px);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 1rem;
    }

    .hero-badge i { font-size: 0.7rem; color: var(--primary-light); }
    .hero-badge span { font-size: 0.7rem; font-weight: 600; color: white; letter-spacing: 0.05em; }

    .hero-title {
        font-size: clamp(1.8rem, 5vw, 2.5rem);
        font-weight: 800;
        line-height: 1.2;
        color: white;
        margin-bottom: 0.5rem;
    }

    .hero-title span {
        color: var(--primary-light);
        font-family: 'Instrument Serif', serif;
        font-style: italic;
    }

    .hero-subtitle {
        font-size: 0.85rem;
        color: rgba(255,255,255,0.7);
        max-width: 450px;
        line-height: 1.5;
    }

    .hero-stats {
        display: flex;
        gap: 1.5rem;
        margin-top: 1.2rem;
    }

    .hero-stat {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        color: rgba(255,255,255,0.6);
    }

    .hero-stat i { font-size: 0.8rem; color: var(--primary-light); }

    .hero-icon {
        width: 100px;
        height: 100px;
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(8px);
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: float 4s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }

    .hero-icon i { font-size: 3rem; color: var(--primary-light); }

    /* ============================================
       BACK BUTTON
    ============================================ */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1.2rem;
        background: white;
        border: 1px solid var(--border);
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition-bounce);
        margin-bottom: 1.5rem;
    }

    .back-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(-4px);
    }

    /* ============================================
       FORM CARD PREMIUM
    ============================================ */
    .form-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 32px;
        overflow: hidden;
        transition: var(--transition);
    }

    .form-card:hover {
        box-shadow: var(--shadow-xl);
    }

    .form-header {
        padding: 1.2rem 1.8rem;
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        border-bottom: 1px solid var(--border);
    }

    .form-header h2 {
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .form-header h2 i { color: var(--primary); font-size: 1.1rem; }

    .form-body {
        padding: 1.8rem;
    }

    /* ============================================
       FORM ELEMENTS
    ============================================ */
    .form-group {
        margin-bottom: 1.8rem;
    }

    .form-label {
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        margin-bottom: 0.75rem;
    }

    .form-label i {
        color: var(--primary);
        margin-right: 0.3rem;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 0.2rem;
    }

    /* Kategori Grid */
    .kategori-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .kategori-option {
        cursor: pointer;
    }

    .kategori-option input {
        display: none;
    }

    .kategori-card {
        padding: 1rem;
        border: 1.5px solid var(--border);
        border-radius: 20px;
        text-align: center;
        transition: var(--transition-bounce);
        background: white;
    }

    .kategori-option input:checked + .kategori-card {
        border-color: var(--primary);
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        transform: translateY(-3px);
        box-shadow: var(--shadow-sm);
    }

    .kategori-card:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .kategori-icon {
        font-size: 1.8rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    .kategori-title {
        font-weight: 700;
        font-size: 0.8rem;
        margin-bottom: 0.2rem;
    }

    .kategori-desc {
        font-size: 0.6rem;
        color: var(--gray);
    }

    /* Input Fields */
    .input-premium {
        width: 100%;
        padding: 0.9rem 1.2rem;
        border: 1.5px solid var(--border);
        border-radius: 20px;
        font-size: 0.9rem;
        transition: var(--transition);
        font-family: inherit;
    }

    .input-premium:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-soft);
    }

    textarea.input-premium {
        resize: vertical;
        min-height: 150px;
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed var(--border);
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition-bounce);
        background: var(--gray-soft);
    }

    .upload-area:hover {
        border-color: var(--primary);
        background: var(--primary-soft);
        transform: translateY(-2px);
    }

    .upload-area i { font-size: 2rem; color: var(--gray-light); transition: var(--transition); }
    .upload-area:hover i { color: var(--primary); }

    .upload-text-main {
        font-weight: 600;
        font-size: 0.85rem;
        display: block;
        margin-top: 0.5rem;
    }

    .upload-text-sub {
        font-size: 0.7rem;
        color: var(--gray);
        margin-top: 0.2rem;
    }

    .file-preview {
        display: none;
        margin-top: 0.8rem;
        padding: 0.5rem 1rem;
        background: #ecfdf5;
        border-radius: 40px;
        font-size: 0.75rem;
        color: var(--primary-dark);
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
    }

    /* ============================================
       ACTION BUTTONS
    ============================================ */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .btn-primary {
        padding: 0.8rem 2rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        border-radius: 60px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        cursor: pointer;
        transition: var(--transition-bounce);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-secondary {
        padding: 0.8rem 2rem;
        background: transparent;
        border: 1.5px solid var(--border);
        color: var(--gray);
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .btn-secondary:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
        background: var(--primary-soft);
    }

    /* ============================================
       ALERT ERROR
    ============================================ */
    .alert-error {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #fef2f2;
        border-left: 3px solid #ef4444;
        border-radius: 16px;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        color: #dc2626;
    }

    /* ============================================
       INFO CARDS
    ============================================ */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .info-card {
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        transition: var(--transition-bounce);
    }

    .info-card:hover {
        transform: translateY(-3px);
        border-color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    .info-icon {
        width: 44px;
        height: 44px;
        background: var(--primary-soft);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-icon i { font-size: 1.2rem; color: var(--primary); }

    .info-content h4 {
        font-weight: 700;
        font-size: 0.8rem;
        margin-bottom: 0.2rem;
    }

    .info-content p {
        font-size: 0.65rem;
        color: var(--gray);
    }

    /* ============================================
       TUTORIAL SECTION
    ============================================ */
    .tutorial-section {
        margin-top: 2rem;
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        border-radius: 24px;
        padding: 1.5rem;
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
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i { font-size: 1.3rem; color: var(--primary); }
    .tutorial-header h3 { font-size: 0.9rem; font-weight: 700; margin: 0; }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.5rem;
        border-radius: 12px;
        transition: var(--transition);
    }

    .tutorial-item:hover {
        background: var(--primary-soft);
        transform: translateX(3px);
    }

    .tutorial-num {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    .tutorial-text h4 { font-size: 0.75rem; font-weight: 700; margin-bottom: 0.2rem; }
    .tutorial-text p { font-size: 0.65rem; color: var(--gray); line-height: 1.4; }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 1024px) {
        .container-premium { padding: 1rem; }
        .hero-content { padding: 1.5rem; }
        .kategori-grid { grid-template-columns: repeat(2, 1fr); }
        .info-grid { grid-template-columns: 1fr; }
        .tutorial-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .hero-content { flex-direction: column; text-align: center; }
        .hero-stats { justify-content: center; }
        .kategori-grid { grid-template-columns: repeat(2, 1fr); }
        .action-buttons { flex-direction: column; }
        .btn-primary, .btn-secondary { justify-content: center; }
    }

    @media (max-width: 480px) {
        .kategori-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- ============================================ --}}
    {{-- HERO SECTION PREMIUM --}}
    {{-- ============================================ --}}
    <div class="hero-section animate__animated animate__fadeInUp">
        <div class="hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <i class="fa-regular fa-comment-dots"></i>
                    <span>Suara Anda Didengar</span>
                </div>
                <h1 class="hero-title">Sampaikan <span>Aspirasi</span></h1>
                <p class="hero-subtitle">Setiap suara, saran, dan keluhan Anda adalah bahan bakar untuk kemajuan desa Lumban Silintong.</p>
                <div class="hero-stats">
                    <div class="hero-stat"><i class="fa-regular fa-clock"></i> <span>Ditanggapi maksimal 3 hari kerja</span></div>
                    <div class="hero-stat"><i class="fa-regular fa-lock"></i> <span>Identitas Anda aman</span></div>
                </div>
            </div>
            <div class="hero-icon">
                <i class="fa-regular fa-paper-plane"></i>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- BACK BUTTON --}}
    {{-- ============================================ --}}
    <a href="{{ route('masyarakat.aspirasi.index') }}" class="back-link animate__animated animate__fadeInUp" style="animation-delay: 0.05s">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Aspirasi Saya
    </a>

    {{-- ============================================ --}}
    {{-- FORM CARD PREMIUM --}}
    {{-- ============================================ --}}
    <div class="form-card animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="form-header">
            <h2><i class="fa-regular fa-pen-to-square"></i> Formulir Aspirasi</h2>
        </div>
        
        <div class="form-body">
            @if($errors->any())
            <div class="alert-error">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 1.1rem;"></i>
                <div>
                    <strong>Terjadi kesalahan:</strong>
                    <ul style="margin-left: 1rem; margin-top: 0.3rem;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('masyarakat.aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Kategori Aspirasi --}}
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-tag"></i> Kategori Aspirasi <span class="required">*</span></label>
                    <div class="kategori-grid">
                        <label class="kategori-option">
                            <input type="radio" name="kategori" value="saran" {{ old('kategori') == 'saran' ? 'checked' : '' }} required>
                            <div class="kategori-card">
                                <i class="fa-regular fa-lightbulb kategori-icon" style="color: #f59e0b;"></i>
                                <div class="kategori-title">💡 Saran</div>
                                <div class="kategori-desc">Ide untuk kemajuan</div>
                            </div>
                        </label>
                        <label class="kategori-option">
                            <input type="radio" name="kategori" value="keluhan" {{ old('kategori') == 'keluhan' ? 'checked' : '' }}>
                            <div class="kategori-card">
                                <i class="fa-regular fa-face-frown kategori-icon" style="color: #ef4444;"></i>
                                <div class="kategori-title">😞 Keluhan</div>
                                <div class="kategori-desc">Masalah yang dihadapi</div>
                            </div>
                        </label>
                        <label class="kategori-option">
                            <input type="radio" name="kategori" value="masukan" {{ old('kategori') == 'masukan' ? 'checked' : '' }}>
                            <div class="kategori-card">
                                <i class="fa-regular fa-message kategori-icon" style="color: #3b82f6;"></i>
                                <div class="kategori-title">📝 Masukan</div>
                                <div class="kategori-desc">Saran konstruktif</div>
                            </div>
                        </label>
                        <label class="kategori-option">
                            <input type="radio" name="kategori" value="pertanyaan" {{ old('kategori') == 'pertanyaan' ? 'checked' : '' }}>
                            <div class="kategori-card">
                                <i class="fa-regular fa-circle-question kategori-icon" style="color: #8b5cf6;"></i>
                                <div class="kategori-title">❓ Pertanyaan</div>
                                <div class="kategori-desc">Info yang dibutuhkan</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Judul Aspirasi --}}
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-heading"></i> Judul Aspirasi <span class="required">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul') }}" required class="input-premium" placeholder="Contoh: Usulan Pembangunan Jalan Desa">
                </div>

                {{-- Isi Aspirasi --}}
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-message"></i> Isi Aspirasi <span class="required">*</span></label>
                    <textarea name="isi" rows="6" required class="input-premium" placeholder="Tulis aspirasi, saran, atau keluhan Anda secara detail dan jelas...">{{ old('isi') }}</textarea>
                    <div class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                        <i class="fa-regular fa-info-circle"></i> Minimal 10 karakter, semakin detail semakin baik
                    </div>
                </div>

                {{-- Lampiran --}}
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-paperclip"></i> Lampiran (Opsional)</label>
                    <div class="upload-area" id="uploadArea">
                        <input type="file" name="lampiran" id="fileInput" accept=".jpg,.jpeg,.png,.pdf" style="display: none;">
                        <i class="fa-solid fa-cloud-arrow-up"></i>
                        <span class="upload-text-main">Klik atau tarik file ke sini</span>
                        <span class="upload-text-sub">Format: PDF, JPG, PNG (Maks. 2MB)</span>
                    </div>
                    <div id="filePreview" class="file-preview">
                        <i class="fa-regular fa-file"></i>
                        <span id="fileName"></span>
                        <button type="button" id="removeFile" style="background: none; border: none; cursor: pointer; margin-left: auto; color: #dc2626;">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <a href="{{ route('masyarakat.aspirasi.index') }}" class="btn-secondary">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fa-regular fa-paper-plane"></i> Kirim Aspirasi
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- INFO CARDS --}}
    {{-- ============================================ --}}
    <div class="info-grid animate__animated animate__fadeInUp" style="animation-delay: 0.15s">
        <div class="info-card">
            <div class="info-icon"><i class="fa-solid fa-bolt"></i></div>
            <div class="info-content">
                <h4>Respon Cepat</h4>
                <p>Ditanggapi maksimal 3 hari kerja</p>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i class="fa-solid fa-shield-alt"></i></div>
            <div class="info-content">
                <h4>Identitas Terjaga</h4>
                <p>Privasi Anda sepenuhnya aman</p>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i class="fa-solid fa-chart-line"></i></div>
            <div class="info-content">
                <h4>Pantau Status</h4>
                <p>Cek perkembangan aspirasi Anda</p>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- TUTORIAL SECTION --}}
    {{-- ============================================ --}}
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Panduan Pengisian Aspirasi</h3>
        </div>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>Pilih Kategori</h4>
                    <p>Pilih jenis aspirasi yang sesuai (Saran, Keluhan, Masukan, atau Pertanyaan).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>Tulis Judul & Isi</h4>
                    <p>Buat judul yang menarik dan jelaskan aspirasi Anda secara detail.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>Lampiran (Opsional)</h4>
                    <p>Upload file pendukung jika diperlukan untuk memperkuat aspirasi Anda.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>Kirim & Pantau</h4>
                    <p>Klik "Kirim Aspirasi" dan pantau statusnya di halaman Aspirasi Saya.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">💡</div>
                <div class="tutorial-text">
                    <h4>Tips Penting</h4>
                    <p>Sampaikan aspirasi dengan jelas, sopan, dan konstruktif agar dapat ditindaklanjuti.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">⏱️</div>
                <div class="tutorial-text">
                    <h4>Waktu Respons</h4>
                    <p>Aspirasi akan ditanggapi maksimal 3 hari kerja setelah dikirim.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // File upload preview
    const fileInput = document.getElementById('fileInput');
    const uploadArea = document.getElementById('uploadArea');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const removeFile = document.getElementById('removeFile');

    if (uploadArea) {
        uploadArea.addEventListener('click', () => fileInput.click());
        
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#10b981';
            uploadArea.style.background = 'rgba(16, 185, 129, 0.08)';
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = '#f1f5f9';
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = '#f1f5f9';
            fileInput.files = e.dataTransfer.files;
            handleFileSelect();
        });
    }

    if (fileInput) {
        fileInput.addEventListener('change', handleFileSelect);
    }

    function handleFileSelect() {
        if (fileInput.files.length > 0) {
            const file = fileInput.files[0];
            fileName.textContent = file.name;
            filePreview.style.display = 'flex';
            uploadArea.style.display = 'none';
        }
    }

    if (removeFile) {
        removeFile.addEventListener('click', () => {
            fileInput.value = '';
            filePreview.style.display = 'none';
            uploadArea.style.display = 'block';
        });
    }
</script>
@endsection