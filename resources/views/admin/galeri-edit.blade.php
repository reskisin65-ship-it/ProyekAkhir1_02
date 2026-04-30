@extends('layouts.admin')

@section('title', 'Edit Galeri - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.85);
        --glass-border: rgba(0, 0, 0, 0.06);
        --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.04);
        --accent-gradient: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        --transition: all 0.4s cubic-bezier(0.2, 0.95, 0.4, 1);
        
        --blue: #3b82f6;
        --green: #10b981;
        --purple: #8b5cf6;
        --orange: #f59e0b;
    }

    body {
        background: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Container */
    .premium-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Back Button */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.2rem;
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        color: #1e293b;
        font-size: 0.85rem;
        font-weight: 600;
        transition: var(--transition);
        margin-bottom: 1.5rem;
        text-decoration: none;
    }

    .back-btn i {
        transition: var(--transition);
    }

    .back-btn:hover {
        background: white;
        transform: translateX(-6px);
        border-color: var(--blue);
        box-shadow: 0 8px 20px rgba(59,130,246,0.1);
    }

    .back-btn:hover i {
        transform: translateX(-4px);
        color: var(--blue);
    }

    /* Header */
    .page-header {
        margin-bottom: 1.5rem;
    }

    .page-badge {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .page-title {
        font-family: 'Instrument Serif', serif;
        font-size: 2rem;
        font-weight: 400;
        line-height: 1.2;
        color: #0f172a;
    }

    .page-title span {
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Info Banner */
    .info-banner {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        border-radius: 24px;
        padding: 1rem 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        color: white;
        animation: slideIn 0.5s ease;
    }

    @keyframes slideIn {
        from { opacity: 0; transform: translateY(-20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Form Card */
    .form-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 32px;
        padding: 2rem;
        box-shadow: var(--glass-shadow);
        transition: var(--transition);
    }

    .form-card:hover {
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
    }

    /* Current Image */
    .current-image-container {
        margin-bottom: 1.5rem;
    }

    .current-image-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .current-image-box {
        background: #f1f5f9;
        border-radius: 20px;
        padding: 1rem;
        text-align: center;
        border: 1px solid #e2e8f0;
    }

    .current-image-box img {
        max-width: 100%;
        max-height: 200px;
        border-radius: 16px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
    }

    /* Preview Image */
    .preview-container {
        margin-bottom: 1.5rem;
    }

    .preview-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .preview-box {
        width: 100%;
        min-height: 150px;
        background: #f8fafc;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 2px dashed #cbd5e1;
        transition: var(--transition);
    }

    .preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        max-height: 200px;
    }

    .preview-placeholder {
        text-align: center;
        color: #94a3b8;
        padding: 2rem;
    }

    .preview-placeholder i {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Card Title */
    .card-title {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.8rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .card-title-icon {
        width: 48px;
        height: 48px;
        border-radius: 18px;
        background: rgba(16,185,129,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #10b981;
        font-size: 1.3rem;
    }

    .card-title h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin: 0;
    }

    .card-title p {
        font-size: 0.8rem;
        color: #64748b;
        margin-top: 0.2rem;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: flex;
        align-items: center;
        gap: 0.3rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        margin-bottom: 0.5rem;
    }

    .required-star {
        color: #ef4444;
    }

    /* Input Styles */
    .input-glass {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 500;
        color: #1e293b;
        background: white;
        transition: var(--transition);
        outline: none;
    }

    .input-glass:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }

    .input-glass:hover {
        border-color: #cbd5e1;
    }

    select.input-glass {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1.2rem;
    }

    /* File Input Styling */
    .file-input-wrapper {
        position: relative;
        width: 100%;
    }

    .file-input-wrapper input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }

    .file-input-custom {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 2px dashed #cbd5e1;
        border-radius: 20px;
        background: #f8fafc;
        text-align: center;
        cursor: pointer;
        transition: var(--transition);
    }

    .file-input-custom:hover {
        border-color: var(--blue);
        background: #f1f5f9;
    }

    .file-input-custom i {
        font-size: 1.5rem;
        color: #94a3b8;
        margin-bottom: 0.3rem;
        display: block;
    }

    .file-input-custom p {
        font-size: 0.7rem;
        color: #64748b;
    }

    /* Help Text */
    .help-text {
        font-size: 0.65rem;
        color: #94a3b8;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .btn-cancel {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.8rem 1.5rem;
        background: transparent;
        border: 1.5px solid #e2e8f0;
        border-radius: 24px;
        color: #64748b;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-cancel:hover {
        background: #f8fafc;
        border-color: #cbd5e1;
        transform: translateY(-2px);
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        background: linear-gradient(135deg, #10b981, #059669);
        border: none;
        border-radius: 24px;
        color: white;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(16,185,129,0.35);
        gap: 0.8rem;
    }

    /* Error Message */
    .error-message {
        color: #ef4444;
        font-size: 0.7rem;
        margin-top: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Responsive */
    @media (max-width: 640px) {
        .premium-container { padding: 1rem; }
        .form-card { padding: 1.2rem; }
        .form-actions { flex-direction: column; }
        .btn-cancel, .btn-submit { justify-content: center; }
    }

    /* Animations */
    .fade-up {
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
</style>

<div class="premium-container">
    
    <!-- Back Button -->
    <a href="{{ route('admin.galeri.index') }}" class="back-btn fade-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Galeri
    </a>

    <!-- Page Header -->
    <div class="page-header fade-up delay-1">
        <div class="page-badge">FORM EDIT</div>
        <h1 class="page-title">Edit <span>Foto Galeri</span></h1>
    </div>

    <!-- Info Banner -->
    <div class="info-banner fade-up delay-2">
        <i class="fa-solid fa-pen-to-square text-xl"></i>
        <div>
            <strong>Sedang mengedit:</strong> {{ $galeri->judul_galeri }}
            <span class="text-white/70 text-sm ml-2">| Kategori: {{ ucfirst($galeri->kategori) }}</span>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card fade-up delay-3">
        <div class="card-title">
            <div class="card-title-icon">
                <i class="fa-solid fa-edit"></i>
            </div>
            <div>
                <h1>Form Edit Foto Galeri</h1>
                <p>Perbarui informasi foto galeri</p>
            </div>
        </div>

        <form action="{{ route('admin.galeri.update', $galeri->id_galeri) }}" method="POST" enctype="multipart/form-data" id="galleryForm">
            @csrf
            @method('PUT')

            <!-- Current Image -->
            <div class="current-image-container">
                <div class="current-image-label">
                    <i class="fa-regular fa-image"></i> Foto Saat Ini
                </div>
                <div class="current-image-box">
                    <img src="{{ asset('storage/' . $galeri->gambar_galeri) }}" alt="{{ $galeri->judul_galeri }}">
                </div>
            </div>

            <!-- Preview New Image -->
            <div class="preview-container">
                <div class="preview-label">
                    <i class="fa-regular fa-eye"></i> Preview Foto Baru
                </div>
                <div class="preview-box" id="previewBox">
                    <div class="preview-placeholder">
                        <i class="fa-regular fa-image"></i>
                        <span class="text-xs">Belum memilih foto baru</span>
                        <span class="text-[10px] block mt-1">(Kosongkan jika tidak ingin mengganti)</span>
                    </div>
                </div>
            </div>

            <!-- Judul Galeri -->
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-regular fa-heading"></i> Judul Galeri
                    <span class="required-star">*</span>
                </label>
                <input type="text" name="judul" value="{{ old('judul', $galeri->judul_galeri) }}" required class="input-glass" placeholder="Contoh: Kegiatan Gotong Royong 2024">
                @error('judul')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Kategori -->
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-tag"></i> Kategori
                    <span class="required-star">*</span>
                </label>
                <select name="kategori" required class="input-glass">
                    <option value="">Pilih Kategori</option>
                    <option value="kegiatan" {{ old('kategori', $galeri->kategori) == 'kegiatan' ? 'selected' : '' }}>
                        <i class="fa-regular fa-calendar-check"></i> Kegiatan
                    </option>
                    <option value="pembangunan" {{ old('kategori', $galeri->kategori) == 'pembangunan' ? 'selected' : '' }}>
                        <i class="fa-solid fa-hard-hat"></i> Pembangunan
                    </option>
                    <option value="budaya" {{ old('kategori', $galeri->kategori) == 'budaya' ? 'selected' : '' }}>
                        <i class="fa-solid fa-mask"></i> Budaya
                    </option>
                    <option value="wisata" {{ old('kategori', $galeri->kategori) == 'wisata' ? 'selected' : '' }}>
                        <i class="fa-solid fa-umbrella-beach"></i> Wisata
                    </option>
                    <option value="umkm" {{ old('kategori', $galeri->kategori) == 'umkm' ? 'selected' : '' }}>
                        <i class="fa-solid fa-store"></i> UMKM
                    </option>
                </select>
                @error('kategori')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Foto Upload -->
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-image"></i> Ganti Foto
                </label>
                <div class="file-input-wrapper">
                    <div class="file-input-custom" onclick="document.getElementById('fotoInput').click()">
                        <i class="fa-solid fa-cloud-upload-alt"></i>
                        <p>Klik untuk pilih foto baru atau drag & drop</p>
                        <p class="text-[10px] mt-1">Format: JPG, JPEG, PNG. Maks: 2MB</p>
                        <p class="text-[10px] text-amber-500 mt-1">Kosongkan jika tidak ingin mengganti foto</p>
                    </div>
                    <input type="file" name="foto" id="fotoInput" accept="image/*" style="display: none;" onchange="previewImage(this)">
                </div>
                @error('foto')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Help Text -->
            <div class="help-text">
                <i class="fa-regular fa-lightbulb text-amber-500"></i>
                Pastikan foto memiliki kualitas baik dan mendokumentasikan kegiatan dengan jelas.
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('admin.galeri.index') }}" class="btn-cancel">
                    <i class="fa-solid fa-xmark"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    // Preview Image Function
    function previewImage(input) {
        const previewBox = document.getElementById('previewBox');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewBox.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
            }
            
            reader.readAsDataURL(input.files[0]);
        } else {
            previewBox.innerHTML = `
                <div class="preview-placeholder">
                    <i class="fa-regular fa-image"></i>
                    <span class="text-xs">Belum memilih foto baru</span>
                    <span class="text-[10px] block mt-1">(Kosongkan jika tidak ingin mengganti)</span>
                </div>
            `;
        }
    }

    // Drag & Drop functionality
    const fileInput = document.getElementById('fotoInput');
    const dropZone = document.querySelector('.file-input-custom');
    
    if (dropZone) {
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#3b82f6';
            dropZone.style.background = '#f1f5f9';
        });
        
        dropZone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#cbd5e1';
            dropZone.style.background = '#f8fafc';
        });
        
        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.style.borderColor = '#cbd5e1';
            dropZone.style.background = '#f8fafc';
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                previewImage(fileInput);
            }
        });
    }
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection