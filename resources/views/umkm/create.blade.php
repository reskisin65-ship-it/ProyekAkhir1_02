{{-- resources/views/umkm/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar UMKM - Desa Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

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

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        color: var(--gray);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1.5rem;
        transition: var(--transition);
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 40px;
        border: 1px solid var(--border);
    }

    .back-button:hover {
        color: var(--primary);
        transform: translateX(-4px);
        border-color: var(--primary);
    }

    /* Main Card */
    .main-card {
        background: var(--card);
        border-radius: 32px;
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        transition: var(--transition-bounce);
    }

    .main-card:hover {
        box-shadow: var(--shadow-xl);
    }

    /* Card Header */
    .card-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        padding: 2rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '📋';
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 7rem;
        opacity: 0.1;
        pointer-events: none;
    }

    .card-header h1 {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.3rem;
        letter-spacing: -0.02em;
    }

    .card-header h1 span {
        color: rgba(255,255,255,0.9);
        font-style: italic;
    }

    .card-header p {
        color: rgba(255,255,255,0.85);
        font-size: 0.85rem;
        margin-top: 0.3rem;
    }

    /* Card Body */
    .card-body {
        padding: 2rem;
    }

    /* Form Styles */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        margin-bottom: 0.6rem;
    }

    .form-label i {
        color: var(--primary);
        font-size: 0.75rem;
    }

    .form-label .required {
        color: #ef4444;
        font-size: 0.65rem;
        margin-left: 0.2rem;
    }

    .form-input, .form-select, .form-textarea {
        width: 100%;
        padding: 0.9rem 1rem;
        background: var(--bg);
        border: 1.5px solid var(--border);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--dark);
        transition: var(--transition);
        outline: none;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-soft);
        background: white;
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    /* Grid Layout */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .full-width {
        grid-column: span 2;
    }

    /* File Upload Styles */
    .upload-area {
        background: var(--bg);
        border: 2px dashed var(--border);
        border-radius: 24px;
        padding: 1.5rem;
        text-align: center;
        transition: var(--transition-bounce);
        cursor: pointer;
    }

    .upload-area:hover {
        border-color: var(--primary);
        background: var(--primary-soft);
        transform: translateY(-2px);
    }

    .upload-icon {
        width: 60px;
        height: 60px;
        background: var(--primary-soft);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        transition: var(--transition);
    }

    .upload-area:hover .upload-icon {
        background: var(--primary);
        transform: scale(1.1);
    }

    .upload-area:hover .upload-icon i {
        color: white;
    }

    .upload-icon i {
        font-size: 1.8rem;
        color: var(--primary);
        transition: var(--transition);
    }

    .upload-title {
        font-weight: 800;
        font-size: 0.8rem;
        color: var(--dark);
        margin-bottom: 0.3rem;
    }

    .upload-hint {
        font-size: 0.65rem;
        color: var(--gray);
        margin-top: 0.5rem;
    }

    .file-input {
        display: none;
    }

    .file-name {
        margin-top: 0.8rem;
        font-size: 0.7rem;
        color: var(--primary);
        font-weight: 600;
        word-break: break-all;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.8rem;
        background: white;
        border: 1.5px solid var(--border);
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition);
        cursor: pointer;
    }

    .btn-cancel:hover {
        border-color: var(--gray);
        color: var(--dark);
        transform: translateY(-2px);
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 2rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: white;
        transition: var(--transition-bounce);
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    /* Alert Styles */
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

    /* Info Card */
    .info-card {
        margin-top: 1.5rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 24px;
        padding: 1.2rem 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: var(--transition);
    }

    .info-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--shadow-md);
    }

    .info-icon {
        width: 44px;
        height: 44px;
        background: white;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .info-icon i {
        font-size: 1.2rem;
        color: var(--primary);
    }

    .info-content h4 {
        font-size: 0.8rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--primary-dark);
        margin-bottom: 0.2rem;
    }

    .info-content p {
        font-size: 0.75rem;
        color: #065f46;
        line-height: 1.5;
    }

    /* Tutorial Section */
    .tutorial-section {
        margin-top: 2rem;
        background: linear-gradient(135deg, var(--card), #ffffff);
        border-radius: 28px;
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
    .tutorial-header h3 { font-size: 0.95rem; font-weight: 700; margin: 0; }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.8rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.6rem;
        padding: 0.6rem;
        border-radius: 16px;
        transition: var(--transition);
        cursor: pointer;
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
        font-weight: 800;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    .tutorial-text h4 { font-size: 0.75rem; font-weight: 700; margin-bottom: 0.1rem; }
    .tutorial-text p { font-size: 0.65rem; color: var(--gray); }

    .tutorial-footer {
        margin-top: 0.8rem;
        padding: 0.7rem 0.9rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        color: #059669;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .form-grid { grid-template-columns: 1fr; gap: 1rem; }
        .full-width { grid-column: span 1; }
        .card-header { padding: 1.2rem 1.5rem; }
        .card-header h1 { font-size: 1.4rem; }
        .card-body { padding: 1.5rem; }
        .action-buttons { flex-direction: column-reverse; }
        .btn-cancel, .btn-submit { justify-content: center; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .info-card { flex-direction: column; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- Back Button --}}
    <a href="{{ route('umkm.index') }}" class="back-button animate__animated animate__fadeIn">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Pusat UMKM
    </a>

    {{-- Alert Messages --}}
    @if($errors->any())
    <div class="alert-premium alert-error animate__animated animate__fadeInUp">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <div>
                <span class="font-bold">Terjadi kesalahan!</span>
                <ul class="list-disc list-inside text-xs mt-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="alert-close" onclick="this.parentElement.remove()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    @endif

    {{-- Main Form Card --}}
    <div class="main-card animate__animated animate__fadeInUp">
        <div class="card-header">
            <h1>Daftar <span>UMKM Baru</span></h1>
            <p>Lengkapi data di bawah untuk mempromosikan usaha Anda di website desa.</p>
        </div>

        <div class="card-body">
            <form action="{{ route('masyarakat.umkm.store') }}" method="POST" enctype="multipart/form-data" id="registerForm">
                @csrf

                <div class="form-grid">
                    {{-- Nama Usaha --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-store"></i> Nama Usaha
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" required
                               class="form-input @error('nama_usaha') is-invalid @enderror"
                               placeholder="Contoh: Keripik Singkong Renyah"
                               id="nama_usaha">
                        @error('nama_usaha')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-tag"></i> Kategori Usaha
                            <span class="required">*</span>
                        </label>
                        <select name="kategori" required class="form-select @error('kategori') is-invalid @enderror" id="kategori">
                            <option value="">Pilih Kategori</option>
                            <option value="Makanan" {{ old('kategori') == 'Makanan' ? 'selected' : '' }}>🍔 Makanan & Minuman</option>
                            <option value="Kerajinan" {{ old('kategori') == 'Kerajinan' ? 'selected' : '' }}>🎨 Kerajinan Tangan</option>
                            <option value="Fashion" {{ old('kategori') == 'Fashion' ? 'selected' : '' }}>👕 Fashion & Aksesoris</option>
                            <option value="Pertanian" {{ old('kategori') == 'Pertanian' ? 'selected' : '' }}>🌾 Pertanian & Perkebunan</option>
                            <option value="Jasa" {{ old('kategori') == 'Jasa' ? 'selected' : '' }}>💼 Jasa & Layanan</option>
                            <option value="Lainnya" {{ old('kategori') == 'Lainnya' ? 'selected' : '' }}>📦 Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Pemilik --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-user"></i> Nama Pemilik
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', Auth::user()->name) }}" required
                               class="form-input @error('pemilik') is-invalid @enderror"
                               id="pemilik">
                        @error('pemilik')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- No Telepon --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-brands fa-whatsapp"></i> WhatsApp / No. Telepon
                            <span class="required">*</span>
                        </label>
                        <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" required
                               class="form-input @error('no_telepon') is-invalid @enderror"
                               placeholder="08123456xxx"
                               id="no_telepon">
                        @error('no_telepon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat --}}
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fa-solid fa-location-dot"></i> Alamat Lengkap Usaha
                            <span class="required">*</span>
                        </label>
                        <textarea name="alamat_usaha" rows="2" required
                                  class="form-textarea @error('alamat_usaha') is-invalid @enderror"
                                  placeholder="Jl. Raya No.123, Desa Lumban Silintong"
                                  id="alamat_usaha">{{ old('alamat_usaha') }}</textarea>
                        @error('alamat_usaha')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fa-solid fa-align-left"></i> Tentang Usaha / Deskripsi Produk
                            <span class="required">*</span>
                        </label>
                        <textarea name="deskripsi" rows="4" required
                                  class="form-textarea @error('deskripsi') is-invalid @enderror"
                                  placeholder="Ceritakan keunggulan produk atau usaha Anda agar orang tertarik membeli."
                                  id="deskripsi">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-400 mt-1">* Tulis deskripsi yang menarik dan informatif</p>
                    </div>

                    {{-- Logo Usaha --}}
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fa-solid fa-image"></i> Logo Usaha
                            <span class="required">*</span>
                        </label>
                        <div class="upload-area" onclick="document.getElementById('logo_input').click()">
                            <div class="upload-icon">
                                <i class="fa-solid fa-cloud-arrow-up"></i>
                            </div>
                            <div class="upload-title">Klik untuk upload logo</div>
                            <div class="upload-hint">Format: JPG, PNG. Maks: 2MB</div>
                            <input type="file" name="logo" id="logo_input" required accept="image/*" class="file-input" onchange="updateFileName('logo_input', 'logo_name')">
                            <div id="logo_name" class="file-name"></div>
                        </div>
                        @error('logo')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Bukti Usaha (Opsional) --}}
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fa-solid fa-file-image"></i> Unggah Bukti Usaha
                            <span class="text-gray-400 text-xs ml-1">(Opsional)</span>
                        </label>
                        <div class="upload-area" onclick="document.getElementById('bukti_input').click()" style="border-color: var(--border);">
                            <div class="upload-icon" style="background: #f1f5f9;">
                                <i class="fa-solid fa-folder-open" style="color: var(--gray);"></i>
                            </div>
                            <div class="upload-title">Klik untuk upload bukti usaha</div>
                            <div class="upload-hint">Format: JPG, PNG. Maks: 2MB (Foto tempat usaha/produk)</div>
                            <input type="file" name="bukti_usaha" id="bukti_input" accept="image/*" class="file-input" onchange="updateFileName('bukti_input', 'bukti_name')">
                            <div id="bukti_name" class="file-name"></div>
                        </div>
                        @error('bukti_usaha')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <a href="{{ route('umkm.index') }}" class="btn-cancel">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fa-solid fa-paper-plane"></i> Kirim Pendaftaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Info Card --}}
    <div class="info-card animate__animated animate__fadeInUp">
        <div class="info-icon">
            <i class="fa-solid fa-circle-info"></i>
        </div>
        <div class="info-content">
            <h4>Proses Verifikasi</h4>
            <p>Setelah dikirim, Admin Desa akan meninjau data Anda dalam waktu maksimal 2x24 jam. Anda dapat memantau status pendaftaran di halaman UMKM. Pastikan data yang Anda masukkan akurat dan lengkap.</p>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- TUTORIAL SECTION PREMIUM --}}
    {{-- ============================================== --}}
    <div class="tutorial-section animate__animated animate__fadeInUp">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Panduan Pendaftaran UMKM</h3>
        </div>
        
        <p class="tutorial-intro" style="font-size: 0.8rem; color: var(--gray); margin-bottom: 1rem; line-height: 1.5;">
            Halaman <strong>Pendaftaran UMKM</strong> digunakan untuk mendaftarkan usaha Anda ke dalam portal UMKM Desa Lumban Silintong.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📝 Isi Data Usaha</h4>
                    <p>Lengkapi semua informasi tentang usaha Anda dengan benar dan lengkap.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>🏷️ Pilih Kategori</h4>
                    <p>Pilih kategori usaha yang sesuai dengan bisnis Anda (Makanan, Kerajinan, Fashion, dll).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>🖼️ Upload Logo Usaha</h4>
                    <p>Upload logo usaha yang mewakili brand Anda (wajib).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>📸 Upload Bukti Usaha</h4>
                    <p>Upload foto tempat usaha atau produk sebagai bukti pendukung (opsional).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>⏳ Proses Verifikasi</h4>
                    <p>Setelah submit, admin akan memverifikasi data Anda dalam 2x24 jam.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>✅ Selesai</h4>
                    <p>Setelah disetujui, UMKM Anda akan tampil di halaman Pusat UMKM.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips:</strong> Pastikan data yang Anda masukkan akurat dan lengkap untuk mempercepat proses verifikasi.</span>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File name display function
        window.updateFileName = function(inputId, displayId) {
            const input = document.getElementById(inputId);
            const display = document.getElementById(displayId);
            if (input.files && input.files[0]) {
                display.innerHTML = `<i class="fa-solid fa-check-circle"></i> ${input.files[0].name}`;
                display.style.color = '#10b981';
            } else {
                display.innerHTML = '';
            }
        };

        // Form validation sebelum submit
        const form = document.getElementById('registerForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');
                
                // Reset previous errors
                document.querySelectorAll('.error-message').forEach(msg => msg.remove());
                document.querySelectorAll('.is-invalid').forEach(field => {
                    field.classList.remove('is-invalid');
                    field.style.borderColor = '';
                });
                
                requiredFields.forEach(field => {
                    if (field.type === 'file') {
                        if (!field.files || field.files.length === 0) {
                            isValid = false;
                            field.classList.add('is-invalid');
                            field.style.borderColor = '#ef4444';
                            
                            let errorMsg = document.createElement('p');
                            errorMsg.className = 'error-message';
                            errorMsg.style.cssText = 'color: #ef4444; font-size: 0.7rem; margin-top: 0.3rem;';
                            errorMsg.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> File wajib diupload';
                            field.parentElement.appendChild(errorMsg);
                        }
                    } else if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('is-invalid');
                        field.style.borderColor = '#ef4444';
                        
                        let errorMsg = document.createElement('p');
                        errorMsg.className = 'error-message';
                        errorMsg.style.cssText = 'color: #ef4444; font-size: 0.7rem; margin-top: 0.3rem;';
                        errorMsg.innerHTML = '<i class="fa-solid fa-circle-exclamation"></i> Field ini wajib diisi';
                        field.parentElement.appendChild(errorMsg);
                        
                        // Remove error on input
                        field.addEventListener('input', function() {
                            this.classList.remove('is-invalid');
                            this.style.borderColor = '';
                            const msg = this.parentElement.querySelector('.error-message');
                            if (msg) msg.remove();
                        });
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = form.querySelector('.is-invalid');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                        showToast('⚠️ Mohon lengkapi semua field yang wajib diisi', 'error');
                    }
                } else {
                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Mengirim...';
                }
            });
        }
        
        // Interactive tutorial items
        const tutorialItems = document.querySelectorAll('.tutorial-item');
        
        tutorialItems.forEach(item => {
            item.addEventListener('click', function() {
                // Add click feedback
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
                
                const title = this.querySelector('.tutorial-text h4').innerText;
                const description = this.querySelector('.tutorial-text p').innerText;
                
                // Highlight related form field
                if (title.includes('Isi Data')) {
                    const namaField = document.getElementById('nama_usaha');
                    if (namaField) {
                        namaField.focus();
                        highlightField(namaField);
                    }
                } else if (title.includes('Pilih Kategori')) {
                    const kategoriField = document.getElementById('kategori');
                    if (kategoriField) {
                        kategoriField.focus();
                        highlightField(kategoriField);
                    }
                } else if (title.includes('Upload Logo')) {
                    const logoArea = document.querySelector('.upload-area');
                    if (logoArea) {
                        logoArea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        highlightField(logoArea);
                    }
                }
                
                showToast(`💡 ${title} - ${description.substring(0, 60)}...`, 'info');
            });
        });
        
        function highlightField(element) {
            element.style.transition = 'all 0.3s ease';
            element.style.boxShadow = '0 0 0 3px rgba(16,185,129,0.2)';
            setTimeout(() => {
                element.style.boxShadow = '';
            }, 2000);
        }
        
        // Toast notification function
        function showToast(message, type = 'info') {
            const existingToast = document.querySelector('.custom-toast');
            if (existingToast) existingToast.remove();
            
            const toast = document.createElement('div');
            toast.className = 'custom-toast';
            const bgColor = type === 'error' ? '#ef4444' : '#10b981';
            toast.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: ${bgColor};
                color: white;
                padding: 10px 16px;
                border-radius: 40px;
                font-size: 0.75rem;
                font-weight: 500;
                z-index: 9999;
                display: flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                animation: slideInRight 0.3s ease;
                font-family: 'Plus Jakarta Sans', sans-serif;
                max-width: 320px;
            `;
            toast.innerHTML = `<i class="fa-regular fa-${type === 'error' ? 'circle-xmark' : 'lightbulb'}"></i> ${message}`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        
        // Auto close alerts after 4 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert-premium').forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 4000);
        
        // Scroll animation for tutorial section
        const tutorialSection = document.querySelector('.tutorial-section');
        if (tutorialSection) {
            tutorialSection.style.opacity = '0';
            tutorialSection.style.transform = 'translateY(20px)';
            tutorialSection.style.transition = 'all 0.6s ease';
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            observer.observe(tutorialSection);
        }
        
        // Character counter for description
        const descField = document.getElementById('deskripsi');
        if (descField) {
            const counter = document.createElement('div');
            counter.className = 'text-right text-xs text-gray-400 mt-1';
            counter.id = 'descCounter';
            descField.parentElement.appendChild(counter);
            
            function updateCounter() {
                const length = descField.value.length;
                counter.innerHTML = `${length} karakter`;
            }
            
            descField.addEventListener('input', updateCounter);
            updateCounter();
        }
    });
</script>

<style>
    /* Additional styles */
    .is-invalid {
        border-color: #ef4444 !important;
    }
    
    .error-message {
        animation: fadeIn 0.3s ease;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-5px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100px);
        }
    }
    
    /* Smooth transitions */
    .form-input, .form-select, .form-textarea {
        transition: all 0.3s ease;
    }
    
    /* Disabled button */
    .btn-submit:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }
    
    /* File input styling */
    .file-input {
        display: none;
    }
    
    .file-name {
        transition: all 0.3s ease;
    }
</style>
@endsection