{{-- resources/views/masyarakat/aspirasi/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Aspirasi - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* ============================================
       DESIGN SYSTEM - CLEAN WHITE
    ============================================ */
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
        --indigo: #4f46e5;
        --indigo-soft: rgba(79, 70, 229, 0.05);
        --dark: #0f172a;
        --dark-soft: #1e293b;
        --gray: #64748b;
        --gray-light: #94a3b8;
        --gray-soft: #f1f5f9;
        --bg: #ffffff;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.04);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.06);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.08);
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
    ::-webkit-scrollbar-track { background: #f1f5f9; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    /* Container Premium */
    .container-premium {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ============================================
       HEADER SECTION - CLEAN
    ============================================ */
    .header-section {
        margin-bottom: 2rem;
    }

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

    .header-title {
        font-size: 2.8rem;
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .header-title span {
        color: var(--primary);
        font-family: 'Instrument Serif', serif;
        font-style: italic;
    }

    .header-subtitle {
        font-size: 0.85rem;
        color: var(--gray);
        max-width: 500px;
        line-height: 1.5;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 1rem;
        background: #fef3c7;
        color: #d97706;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-top: 0.5rem;
    }

    /* ============================================
       FORM CARD - CLEAN WHITE
    ============================================ */
    .form-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 32px;
        overflow: hidden;
        transition: var(--transition);
    }

    .form-card:hover {
        box-shadow: var(--shadow-lg);
    }

    .form-header {
        padding: 1.2rem 1.8rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--border);
    }

    .form-header h2 {
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        color: var(--dark);
    }

    .form-header h2 i { color: var(--primary); }

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
        background: #f0fdf4;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.08);
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
        background: white;
    }

    .input-premium:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-soft);
    }

    textarea.input-premium {
        resize: vertical;
        min-height: 150px;
        line-height: 1.6;
    }

    /* Current File */
    .current-file {
        margin-bottom: 1rem;
        padding: 0.8rem 1rem;
        background: #f8fafc;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        flex-wrap: wrap;
        border: 1px solid var(--border);
    }

    .current-file i { font-size: 1.2rem; color: var(--primary); }
    .current-file span { font-size: 0.8rem; color: var(--gray); }
    .current-file a { font-size: 0.75rem; color: var(--primary); text-decoration: none; font-weight: 600; }
    .current-file a:hover { text-decoration: underline; }

    /* Upload Area */
    .upload-area {
        border: 2px dashed var(--border);
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: var(--transition-bounce);
        background: #f8fafc;
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
        background: #f0fdf4;
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
        background: var(--dark);
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
        background: var(--primary);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
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
        font-size: 0.8rem;
    }

    /* ============================================
       INFO PANEL (RIGHT SIDE TIPS)
    ============================================ */
    .info-panel {
        margin-top: 1.5rem;
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .info-card {
        background: #f8fafc;
        border: 1px solid var(--border);
        border-radius: 20px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        transition: var(--transition);
    }

    .info-card:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-soft);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-icon i { font-size: 1rem; color: var(--primary); }

    .info-content h4 {
        font-size: 0.75rem;
        font-weight: 700;
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
        background: #f8fafc;
        border-radius: 24px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .tutorial-section:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-sm);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i { font-size: 1.2rem; color: var(--primary); }
    .tutorial-header h3 { font-size: 0.85rem; font-weight: 700; margin: 0; }

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
        background: var(--primary);
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
        .kategori-grid { grid-template-columns: repeat(2, 1fr); }
        .info-panel { grid-template-columns: 1fr; }
        .tutorial-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .header-title { font-size: 2rem; }
        .kategori-grid { grid-template-columns: repeat(2, 1fr); }
        .action-buttons { flex-direction: column; }
        .btn-primary, .btn-secondary { justify-content: center; }
    }

    @media (max-width: 480px) {
        .kategori-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="container-premium">

    {{-- Back Button --}}
    <div class="header-section">
        <a href="{{ route('masyarakat.aspirasi.index') }}" class="back-link animate__animated animate__fadeInUp">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Aspirasi Saya
        </a>
        
        <h1 class="header-title animate__animated animate__fadeInUp" style="animation-delay: 0.05s">
            Edit <span>Aspirasi</span>
        </h1>
        <p class="header-subtitle animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
            Perbarui aspirasi Anda agar lebih jelas dan mudah diproses oleh admin desa.
        </p>
        <div class="status-badge animate__animated animate__fadeInUp" style="animation-delay: 0.15s">
            <i class="fa-regular fa-pen-to-square"></i> Mode Penyuntingan Aktif
        </div>
    </div>

    {{-- Error Alert --}}
    @if($errors->any())
    <div class="alert-error animate__animated animate__shakeX">
        <i class="fa-solid fa-circle-exclamation"></i>
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

    {{-- Form Card --}}
    <div class="form-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
        <div class="form-header">
            <h2><i class="fa-regular fa-pen-to-square"></i> Edit Formulir Aspirasi</h2>
        </div>
        
        <div class="form-body">
            <form action="{{ route('masyarakat.aspirasi.update', $aspirasi->id_aspirasi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Kategori --}}
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-tag"></i> Kategori Aspirasi <span class="required">*</span></label>
                    <div class="kategori-grid">
                        <label class="kategori-option">
                            <input type="radio" name="kategori" value="saran" {{ old('kategori', $aspirasi->kategori) == 'saran' ? 'checked' : '' }}>
                            <div class="kategori-card">
                                <i class="fa-regular fa-lightbulb kategori-icon" style="color: #f59e0b;"></i>
                                <div class="kategori-title">💡 Saran</div>
                            </div>
                        </label>
                        <label class="kategori-option">
                            <input type="radio" name="kategori" value="keluhan" {{ old('kategori', $aspirasi->kategori) == 'keluhan' ? 'checked' : '' }}>
                            <div class="kategori-card">
                                <i class="fa-regular fa-face-frown kategori-icon" style="color: #ef4444;"></i>
                                <div class="kategori-title">😞 Keluhan</div>
                            </div>
                        </label>
                        <label class="kategori-option">
                            <input type="radio" name="kategori" value="masukan" {{ old('kategori', $aspirasi->kategori) == 'masukan' ? 'checked' : '' }}>
                            <div class="kategori-card">
                                <i class="fa-regular fa-message kategori-icon" style="color: #3b82f6;"></i>
                                <div class="kategori-title">📝 Masukan</div>
                            </div>
                        </label>
                        <label class="kategori-option">
                            <input type="radio" name="kategori" value="pertanyaan" {{ old('kategori', $aspirasi->kategori) == 'pertanyaan' ? 'checked' : '' }}>
                            <div class="kategori-card">
                                <i class="fa-regular fa-circle-question kategori-icon" style="color: #8b5cf6;"></i>
                                <div class="kategori-title">❓ Pertanyaan</div>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Judul --}}
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-heading"></i> Judul Aspirasi <span class="required">*</span></label>
                    <input type="text" name="judul" value="{{ old('judul', $aspirasi->judul) }}" required class="input-premium" placeholder="Contoh: Usulan Pembangunan Jalan Desa">
                </div>

                {{-- Isi --}}
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-message"></i> Isi Aspirasi <span class="required">*</span></label>
                    <textarea name="isi" rows="6" required class="input-premium" placeholder="Tulis aspirasi, saran, atau keluhan Anda secara detail...">{{ old('isi', $aspirasi->isi_aspirasi) }}</textarea>
                    <div class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                        <i class="fa-regular fa-info-circle"></i> Minimal 10 karakter, semakin detail semakin baik
                    </div>
                </div>

                {{-- Lampiran --}}
                <div class="form-group">
                    <label class="form-label"><i class="fa-solid fa-paperclip"></i> Lampiran (Opsional)</label>
                    
                    @if($aspirasi->lampiran)
                    <div class="current-file">
                        <i class="fa-regular fa-file"></i>
                        <span>{{ basename($aspirasi->lampiran) }}</span>
                        <a href="{{ Storage::url($aspirasi->lampiran) }}" target="_blank">
                            <i class="fa-regular fa-eye"></i> Lihat
                        </a>
                    </div>
                    @endif

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
                        <i class="fa-regular fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Info Panel (Tips Ringkas) --}}
    <div class="info-panel animate__animated animate__fadeInUp" style="animation-delay: 0.25s">
        <div class="info-card">
            <div class="info-icon"><i class="fa-regular fa-clock"></i></div>
            <div class="info-content">
                <h4>Respon Cepat</h4>
                <p>Maksimal 3 hari kerja</p>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i class="fa-regular fa-shield-alt"></i></div>
            <div class="info-content">
                <h4>Identitas Terjaga</h4>
                <p>Data Anda aman</p>
            </div>
        </div>
        <div class="info-card">
            <div class="info-icon"><i class="fa-regular fa-chart-line"></i></div>
            <div class="info-content">
                <h4>Pantau Status</h4>
                <p>Lihat perkembangan</p>
            </div>
        </div>
    </div>

    {{-- Tutorial Section --}}
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Panduan Edit Aspirasi</h3>
        </div>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>Periksa Kategori</h4>
                    <p>Pastikan kategori sesuai dengan isi aspirasi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>Perbaiki Isi</h4>
                    <p>Edit judul dan isi agar lebih jelas.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>Update Lampiran</h4>
                    <p>Upload file baru jika perlu.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>Simpan Perubahan</h4>
                    <p>Klik tombol Simpan Perubahan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">💡</div>
                <div class="tutorial-text">
                    <h4>Tips</h4>
                    <p>Edit hanya jika status masih "Menunggu".</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">⏱️</div>
                <div class="tutorial-text">
                    <h4>Waktu Respons</h4>
                    <p>Diproses dalam 1-3 hari kerja.</p>
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
            uploadArea.style.background = 'rgba(16, 185, 129, 0.05)';
        });
        
        uploadArea.addEventListener('dragleave', () => {
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = '#f8fafc';
        });
        
        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#e2e8f0';
            uploadArea.style.background = '#f8fafc';
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