{{-- 
    File: resources/views/masyarakat/surat/edit.blade.php
    Theme: The Sovereign Glass (v2.0) - Indonesian Version
--}}

@extends('layouts.app')

@section('title', 'Edit Pengajuan Surat - SM-' . $pengajuan->id_surat)

@section('content')

<!-- EXTERNAL ASSETS -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    /* =========================================
       1. DESIGN TOKENS (ELEGANT & CLEAN)
    ========================================= */
    :root {
        --canvas-bg: #fdfdfd;
        --accent-primary: #0f172a;
        --accent-secondary: #1e293b;
        --emerald-luxe: #059669;
        --emerald-light: #10b981;
        --glass-white: rgba(255, 255, 255, 0.65);
        --glass-border: rgba(255, 255, 255, 0.8);
        --shadow-soft: 0 4px 20px -1px rgba(0, 0, 0, 0.03);
        --shadow-deep: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        --font-main: 'Inter', sans-serif;
        --font-heading: 'Plus Jakarta Sans', sans-serif;
        --font-serif: 'Instrument Serif', serif;
        --transition-fluid: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* =========================================
       2. GLOBAL RESET & BASE
    ========================================= */
    body {
        font-family: var(--font-main);
        background-color: var(--canvas-bg);
        color: var(--accent-primary);
        overflow-x: hidden;
        -webkit-font-smoothing: antialiased;
    }

    /* Subtle Background Ornaments */
    .bg-ornament {
        position: fixed;
        width: 60vw;
        height: 60vw;
        border-radius: 50%;
        z-index: -1;
        filter: blur(80px);
        opacity: 0.3;
    }
    .ornament-1 { top: -20%; right: -10%; background: radial-gradient(circle, rgba(5, 150, 105, 0.3) 0%, transparent 70%); }
    .ornament-2 { bottom: -20%; left: -10%; background: radial-gradient(circle, rgba(15, 23, 42, 0.2) 0%, transparent 70%); }

    /* =========================================
       3. STRUCTURE & LAYOUT
    ========================================= */
    .page-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 5rem 2rem;
        position: relative;
    }

    /* =========================================
       4. NAVIGATION & BREADCRUMBS
    ========================================= */
    .nav-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 4rem;
        animation: fadeInDown 0.8s ease-out;
    }

    .back-link {
        display: flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
        color: var(--accent-primary);
        font-weight: 500;
        font-size: 0.9rem;
        padding: 10px 20px;
        border-radius: 100px;
        background: white;
        box-shadow: var(--shadow-soft);
        border: 1px solid rgba(0,0,0,0.05);
        transition: var(--transition-fluid);
    }

    .back-link:hover {
        transform: translateX(-8px);
        background: var(--accent-primary);
        color: white;
    }

    .status-pill {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        font-weight: 700;
        padding: 8px 16px;
        background: rgba(15, 23, 42, 0.05);
        border-radius: 50px;
        color: var(--accent-secondary);
    }

    /* =========================================
       5. MAIN CANVAS (THE FORM CARD)
    ========================================= */
    .main-canvas {
        background: var(--glass-white);
        backdrop-filter: blur(40px) saturate(180%);
        -webkit-backdrop-filter: blur(40px);
        border: 1px solid var(--glass-border);
        border-radius: 48px;
        box-shadow: var(--shadow-deep);
        position: relative;
        overflow: hidden;
        animation: fadeInUp 1s cubic-bezier(0.16, 1, 0.3, 1);
    }

    /* Canvas Decor Line */
    .main-canvas::before {
        content: "";
        position: absolute;
        top: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 120px;
        height: 4px;
        background: var(--emerald-luxe);
        border-radius: 0 0 10px 10px;
    }

    .canvas-hero {
        padding: 5rem 5rem 3rem 5rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        border-bottom: 1px solid rgba(0,0,0,0.04);
    }

    .hero-title-area h2 {
        font-family: var(--font-serif);
        font-size: 4rem;
        line-height: 0.9;
        font-weight: 400;
        margin-bottom: 1.5rem;
        font-style: italic;
    }

    .hero-title-area h2 .highlight {
        color: var(--emerald-luxe);
    }

    .hero-title-area p {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 400px;
        line-height: 1.6;
    }

    .step-indicator {
        text-align: right;
    }

    .step-number {
        font-family: var(--font-serif);
        font-size: 3rem;
        color: var(--emerald-luxe);
        opacity: 0.5;
        display: block;
    }

    /* =========================================
       6. FORM ELEMENTS & TYPOGRAPHY
    ========================================= */
    .form-content {
        padding: 5rem;
    }

    .section-label {
        font-family: var(--font-heading);
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: var(--emerald-luxe);
        margin-bottom: 3rem;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .section-label::after {
        content: "";
        height: 1px;
        flex-grow: 1;
        background: linear-gradient(to right, #e2e8f0, transparent);
    }

    .grid-form {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 3rem 4rem;
    }

    .full-width { grid-column: span 2; }

    .input-group {
        position: relative;
        display: flex;
        flex-direction: column;
    }

    .input-label {
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: var(--accent-secondary);
        padding-left: 4px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .input-label i {
        color: var(--emerald-luxe);
        font-size: 0.9rem;
    }

    .input-label .required {
        color: #ef4444;
        font-size: 0.7rem;
    }

    .glass-input {
        width: 100%;
        padding: 18px 24px;
        background: rgba(255, 255, 255, 0.8);
        border: 1px solid #e2e8f0;
        border-radius: 20px;
        font-size: 1rem;
        font-family: var(--font-main);
        color: var(--accent-primary);
        transition: var(--transition-fluid);
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.01);
    }

    .glass-input:focus {
        outline: none;
        border-color: var(--emerald-luxe);
        background: white;
        box-shadow: 0 15px 30px -10px rgba(0, 0, 0, 0.05);
        transform: translateY(-2px);
    }

    .glass-input::placeholder {
        color: #cbd5e1;
    }

    select.glass-input {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%230f172a'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 24px center;
        background-size: 18px;
    }

    textarea.glass-input {
        resize: vertical;
        min-height: 120px;
    }

    /* =========================================
       7. FILE UPLOAD (PREMIUM)
    ========================================= */
    .upload-vault {
        position: relative;
        border: 2px dashed #e2e8f0;
        border-radius: 32px;
        padding: 4rem 2rem;
        text-align: center;
        transition: var(--transition-fluid);
        background: rgba(248, 250, 252, 0.4);
        cursor: pointer;
        overflow: hidden;
    }

    .upload-vault:hover {
        border-color: var(--emerald-luxe);
        background: white;
    }

    .upload-vault i {
        font-size: 2.5rem;
        color: var(--emerald-luxe);
        margin-bottom: 1.5rem;
        display: block;
    }

    .upload-text-main {
        font-weight: 700;
        font-size: 1rem;
        display: block;
        margin-bottom: 5px;
    }

    .upload-text-sub {
        font-size: 0.8rem;
        color: #94a3b8;
    }

    .current-file-badge {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: white;
        padding: 10px 20px;
        border-radius: 100px;
        box-shadow: var(--shadow-soft);
        margin-top: 1.5rem;
        border: 1px solid #f1f5f9;
    }

    .current-file-badge i {
        color: var(--emerald-luxe);
        margin: 0;
        font-size: 1rem;
    }

    /* =========================================
       8. BUTTONS & ACTIONS
    ========================================= */
    .action-bar {
        margin-top: 5rem;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 2rem;
    }

    .btn-lux {
        position: relative;
        padding: 20px 48px;
        border-radius: 100px;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: var(--transition-fluid);
        border: none;
        display: flex;
        align-items: center;
        gap: 15px;
        overflow: hidden;
    }

    .btn-lux-primary {
        background: var(--accent-primary);
        color: white;
        box-shadow: 0 20px 40px -10px rgba(15, 23, 42, 0.3);
    }

    .btn-lux-primary:hover {
        transform: translateY(-5px);
        box-shadow: 0 30px 60px -12px rgba(15, 23, 42, 0.4);
        background: var(--emerald-luxe);
    }

    .btn-lux-secondary {
        background: transparent;
        color: var(--accent-primary);
        border: 1px solid #e2e8f0;
    }

    .btn-lux-secondary:hover {
        background: #f8fafc;
        border-color: var(--emerald-luxe);
        color: var(--emerald-luxe);
    }

    /* =========================================
       9. ALERT MESSAGES
    ========================================= */
    .alert-lux {
        border-radius: 24px;
        padding: 20px 30px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 15px;
        border: 1px solid transparent;
        animation: slideInRight 0.5s ease-out;
    }

    .alert-lux-error {
        background: #fef2f2;
        border-color: #fee2e2;
        color: #b91c1c;
    }

    .alert-lux-success {
        background: #ecfdf5;
        border-color: #d1fae5;
        color: #059669;
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* =========================================
       10. TUTORIAL SECTION
    ========================================= */
    .tutorial-section {
        margin-top: 3rem;
        background: #f8fafc;
        border-radius: 28px;
        padding: 2rem;
        border: 1px solid #e2e8f0;
        transition: var(--transition-fluid);
    }

    .tutorial-section:hover {
        background: white;
        border-color: var(--emerald-luxe);
        box-shadow: var(--shadow-soft);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 1.5rem;
    }

    .tutorial-header i {
        font-size: 1.8rem;
        color: var(--emerald-luxe);
    }

    .tutorial-header h3 {
        font-size: 1.2rem;
        font-weight: 700;
        margin: 0;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .tutorial-card {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        border-radius: 20px;
        transition: var(--transition-fluid);
    }

    .tutorial-card:hover {
        background: rgba(5, 150, 105, 0.05);
        transform: translateX(5px);
    }

    .tutorial-number {
        width: 36px;
        height: 36px;
        background: var(--emerald-luxe);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .tutorial-content h4 {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 0.3rem;
    }

    .tutorial-content p {
        font-size: 0.75rem;
        color: #64748b;
        line-height: 1.5;
    }

    /* =========================================
       11. RESPONSIVE QUERIES
    ========================================= */
    @media (max-width: 992px) {
        .canvas-hero { padding: 3rem; flex-direction: column; align-items: flex-start; gap: 2rem; }
        .hero-title-area h2 { font-size: 3rem; }
        .form-content { padding: 3rem; }
        .grid-form { grid-template-columns: 1fr; gap: 2rem; }
        .full-width { grid-column: span 1; }
        .action-bar { flex-direction: column-reverse; }
        .btn-lux { width: 100%; justify-content: center; }
        .tutorial-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .page-container { padding: 2rem 1rem; }
        .hero-title-area h2 { font-size: 2.2rem; }
        .step-number { font-size: 2rem; }
        .canvas-hero { padding: 1.5rem; }
        .form-content { padding: 1.5rem; }
        .glass-input { padding: 14px 18px; }
    }

    /* Animations */
    @keyframes fadeInDown {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .hidden { display: none; }
</style>

<div class="bg-ornament ornament-1"></div>
<div class="bg-ornament ornament-2"></div>

<div class="page-container">
    
    <!-- Header Navigation -->
    <header class="nav-header">
        <a href="{{ route('masyarakat.surat.index') }}" class="back-link">
            <i class="fa-solid fa-chevron-left"></i>
            <span>Kembali ke Portal</span>
        </a>
        <div class="status-pill">
            <i class="fa-solid fa-circle-dot fa-xs mr-2 text-emerald-500"></i>
            Mode Edit
        </div>
    </header>

    <main class="main-canvas">
        <!-- Hero Section -->
        <section class="canvas-hero">
            <div class="hero-title-area">
                <span class="text-xs font-bold uppercase tracking-widest text-emerald-600 mb-4 block">
                    <i class="fa-regular fa-pen-to-square mr-1"></i> Proses Perbaikan
                </span>
                <h2>Perbarui <br><span class="highlight">Pengajuan</span> Anda.</h2>
                <p>Pastikan setiap detail akurat untuk pengalaman administrasi yang lancar.</p>
            </div>
            <div class="step-indicator">
                <span class="step-number">01</span>
                <span class="text-xs font-bold text-slate-400">SM-{{ str_pad($pengajuan->id_surat, 5, '0', STR_PAD_LEFT) }}</span>
            </div>
        </section>

        <!-- Form Section -->
        <div class="form-content">
            @if ($errors->any())
                <div class="alert-lux alert-lux-error">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <div>
                        <ul class="text-sm m-0 p-0 list-disc pl-4">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <form action="{{ route('masyarakat.surat.update', $pengajuan->id_surat) }}" method="POST" enctype="multipart/form-data" id="luxForm">
                @csrf
                @method('PUT')

                <div class="section-label">
                    <i class="fa-regular fa-id-card"></i> Identitas & Konteks
                </div>
                
                <div class="grid-form">
                    <!-- Jenis Surat -->
                    <div class="input-group">
                        <label class="input-label"><i class="fa-regular fa-file-alt"></i> Jenis Dokumen <span class="required">*</span></label>
                        <select name="jenis_surat" class="glass-input" required>
                            <option value="Surat Keterangan Domisili" {{ $pengajuan->jenis_surat == 'Surat Keterangan Domisili' ? 'selected' : '' }}>📄 Surat Keterangan Domisili</option>
                            <option value="Surat Keterangan Usaha" {{ $pengajuan->jenis_surat == 'Surat Keterangan Usaha' ? 'selected' : '' }}>🏪 Surat Keterangan Usaha</option>
                            <option value="Surat Keterangan Tidak Mampu" {{ $pengajuan->jenis_surat == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>📑 Surat Keterangan Tidak Mampu</option>
                            <option value="Surat Keterangan Kelahiran" {{ $pengajuan->jenis_surat == 'Surat Keterangan Kelahiran' ? 'selected' : '' }}>👶 Surat Keterangan Kelahiran</option>
                            <option value="Surat Keterangan Kematian" {{ $pengajuan->jenis_surat == 'Surat Keterangan Kematian' ? 'selected' : '' }}>⚰️ Surat Keterangan Kematian</option>
                            <option value="Surat Pengantar SKCK" {{ $pengajuan->jenis_surat == 'Surat Pengantar SKCK' ? 'selected' : '' }}>🛂 Surat Pengantar SKCK</option>
                        </select>
                    </div>

                    <!-- Nama Lengkap -->
                    <div class="input-group">
                        <label class="input-label"><i class="fa-regular fa-user"></i> Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $pengajuan->nama_lengkap) }}" class="glass-input" placeholder="Contoh: Jonathan Wick" required>
                    </div>

                    <!-- NIK -->
                    <div class="input-group">
                        <label class="input-label"><i class="fa-regular fa-id-card"></i> NIK <span class="required">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik', $pengajuan->nik) }}" class="glass-input" placeholder="16 digit angka" maxlength="16" required>
                        <span class="text-xs text-slate-400 mt-1">Nomor Induk Kependudukan (sesuai KTP)</span>
                    </div>

                    <!-- Nomor Telepon -->
                    <div class="input-group">
                        <label class="input-label"><i class="fa-regular fa-phone"></i> Nomor Telepon <span class="required">*</span></label>
                        <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon', $pengajuan->nomor_telepon) }}" class="glass-input" placeholder="+62 812-3456-7890" required>
                    </div>

                    <!-- Tempat Lahir -->
                    <div class="input-group">
                        <label class="input-label"><i class="fa-regular fa-location-dot"></i> Tempat Lahir <span class="required">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $pengajuan->tempat_lahir) }}" class="glass-input" placeholder="Contoh: Jakarta" required>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div class="input-group">
                        <label class="input-label"><i class="fa-regular fa-calendar"></i> Tanggal Lahir <span class="required">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $pengajuan->tanggal_lahir) }}" class="glass-input" required>
                    </div>

                    <!-- Keperluan -->
                    <div class="input-group full-width">
                        <label class="input-label"><i class="fa-regular fa-bullhorn"></i> Keperluan / Tujuan <span class="required">*</span></label>
                        <textarea name="keperluan" rows="3" class="glass-input" placeholder="Jelaskan secara detail keperluan pengajuan surat ini..." required>{{ old('keperluan', $pengajuan->keperluan) }}</textarea>
                    </div>

                    <!-- Keterangan Tambahan -->
                    <div class="input-group full-width">
                        <label class="input-label"><i class="fa-regular fa-note-sticky"></i> Keterangan Tambahan <span class="text-xs text-slate-400 ml-1">(Opsional)</span></label>
                        <textarea name="keterangan" rows="2" class="glass-input" placeholder="Informasi tambahan jika ada...">{{ old('keterangan', $pengajuan->keterangan) }}</textarea>
                    </div>
                </div>

                <div class="section-label" style="margin-top: 5rem;">
                    <i class="fa-regular fa-paperclip"></i> Dokumen Pendukung
                </div>

                <div class="grid-form">
                    <div class="input-group full-width">
                        <label class="input-label"><i class="fa-regular fa-file-pdf"></i> File Pendukung <span class="text-xs text-slate-400 ml-1">(Opsional, maks 2MB)</span></label>
                        
                        <div class="upload-vault" id="dropZone">
                            <input type="file" name="file_pendukung" id="fileInput" hidden accept=".pdf,.jpg,.jpeg,.png">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span class="upload-text-main">Klik atau tarik file ke sini</span>
                            <span class="upload-text-sub">Format yang didukung: PDF, JPG, PNG (Maks. 2MB)</span>
                            
                            @if($pengajuan->file_pendukung)
                                <div class="current-file-badge">
                                    <i class="fa-solid fa-file-shield"></i>
                                    <span class="text-xs font-semibold text-slate-700">File saat ini: {{ basename($pengajuan->file_pendukung) }}</span>
                                </div>
                            @endif
                        </div>

                        <div id="fileStatus" class="hidden mt-4 animate__animated animate__fadeIn">
                            <div class="flex items-center justify-center gap-3 text-emerald-600 font-bold">
                                <i class="fa-solid fa-check-circle"></i>
                                <span id="fileName">File siap diupload</span>
                                <button type="button" id="removeFile" class="text-slate-400 hover:text-red-500 ml-4 transition-colors">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="action-bar">
                    <a href="{{ route('masyarakat.surat.index') }}" class="btn-lux btn-lux-secondary">
                        <i class="fa-solid fa-times"></i> Batalkan
                    </a>
                    <button type="submit" class="btn-lux btn-lux-primary">
                        <span>Simpan Perubahan</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </div>
            </form>
        </div>
    </main>

    <!-- Tutorial Section -->
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>Panduan Pengisian Formulir</h3>
        </div>
        <div class="tutorial-grid">
            <div class="tutorial-card">
                <div class="tutorial-number">1</div>
                <div class="tutorial-content">
                    <h4>📋 Pilih Jenis Surat</h4>
                    <p>Pilih jenis surat yang sesuai dengan kebutuhan Anda. Pastikan memilih kategori yang tepat agar proses verifikasi lebih cepat.</p>
                </div>
            </div>
            <div class="tutorial-card">
                <div class="tutorial-number">2</div>
                <div class="tutorial-content">
                    <h4>🆔 Isi Data Diri dengan Benar</h4>
                    <p>Masukkan NIK, nama lengkap, dan nomor telepon yang aktif. Pastikan data sesuai dengan KTP untuk menghindari penolakan.</p>
                </div>
            </div>
            <div class="tutorial-card">
                <div class="tutorial-number">3</div>
                <div class="tutorial-content">
                    <h4>📝 Jelaskan Keperluan</h4>
                    <p>Tuliskan tujuan pengajuan surat secara jelas dan detail. Semakin jelas keperluan, semakin cepat prosesnya.</p>
                </div>
            </div>
            <div class="tutorial-card">
                <div class="tutorial-number">4</div>
                <div class="tutorial-content">
                    <h4>📎 Lampirkan Dokumen Pendukung</h4>
                    <p>Upload file pendukung seperti KTP, KK, atau dokumen lain jika diperlukan. Format yang didukung: PDF, JPG, PNG (maks 2MB).</p>
                </div>
            </div>
            <div class="tutorial-card">
                <div class="tutorial-number">5</div>
                <div class="tutorial-content">
                    <h4>✅ Simpan & Pantau Status</h4>
                    <p>Setelah mengisi semua data, klik "Simpan Perubahan". Anda dapat memantau status pengajuan di halaman "Riwayat Pengajuan".</p>
                </div>
            </div>
            <div class="tutorial-card">
                <div class="tutorial-number">💡</div>
                <div class="tutorial-content">
                    <h4>Tips Penting</h4>
                    <p>Pengajuan hanya dapat diedit selama status masih <strong>"Menunggu"</strong>. Setelah diproses, data tidak dapat diubah.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Branding -->
    <footer style="margin-top: 3rem; text-align: center; opacity: 0.4;">
        <p class="text-xs font-bold tracking-widest text-slate-500">
            <i class="fa-regular fa-copyright"></i> 2026 DIGITAL GOV ECOSYSTEM — DESA LUMBAN SILINTONG
        </p>
    </footer>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script>
    // Initial Animations using GSAP
    window.addEventListener('DOMContentLoaded', () => {
        gsap.from(".input-group", {
            duration: 0.8,
            y: 30,
            opacity: 0,
            stagger: 0.08,
            ease: "expo.out",
            delay: 0.4
        });

        gsap.from(".section-label", {
            duration: 1,
            width: 0,
            opacity: 0,
            ease: "power4.out",
            delay: 0.2
        });
    });

    // Premium File Upload Logic
    const fileInput = document.getElementById('fileInput');
    const dropZone = document.getElementById('dropZone');
    const fileStatus = document.getElementById('fileStatus');
    const fileName = document.getElementById('fileName');
    const removeFileBtn = document.getElementById('removeFile');

    if (dropZone) {
        dropZone.addEventListener('click', () => fileInput.click());

        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#059669';
            dropZone.style.background = 'white';
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.style.borderColor = '#e2e8f0';
            dropZone.style.background = 'rgba(248, 250, 252, 0.4)';
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
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
            fileName.innerHTML = file.name;
            fileStatus.classList.remove('hidden');
            dropZone.style.display = 'none';
            
            gsap.to(fileStatus, { x: 10, repeat: 3, yoyo: true, duration: 0.05 });
        }
    }

    if (removeFileBtn) {
        removeFileBtn.addEventListener('click', () => {
            fileInput.value = '';
            fileStatus.classList.add('hidden');
            dropZone.style.display = 'block';
            gsap.from(dropZone, { scale: 0.95, opacity: 0, duration: 0.4 });
        });
    }

    // Magnetic Button Effect
    const btnPrimary = document.querySelector('.btn-lux-primary');
    if (btnPrimary) {
        btnPrimary.addEventListener('mousemove', (e) => {
            const rect = btnPrimary.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            const centerX = rect.width / 2;
            const centerY = rect.height / 2;
            const deltaX = (x - centerX) / 8;
            const deltaY = (y - centerY) / 8;
            
            btnPrimary.style.transform = `translate(${deltaX}px, ${deltaY}px)`;
        });

        btnPrimary.addEventListener('mouseleave', () => {
            btnPrimary.style.transform = `translate(0, 0)`;
        });
    }

    // Form Submission
    const luxForm = document.getElementById('luxForm');
    if (luxForm) {
        luxForm.addEventListener('submit', function(e) {
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> Memproses...';
            btn.style.opacity = '0.7';
            btn.style.pointerEvents = 'none';
        });
    }
</script>

@endsection