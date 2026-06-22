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

            <!-- Unified Photo Grid -->
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-solid fa-images"></i> Manajemen Foto Galeri
                </label>
                <div class="help-text mb-3" style="font-size: 0.75rem;">
                    Kelola foto-foto di dalam galeri ini. Anda dapat menghapus foto yang sudah ada, menggantinya dengan foto baru, atau menambahkan foto lainnya ke dalam daftar.
                </div>
                
                <input type="hidden" name="deleted_fotos" id="deletedFotosInput" value="">
                <div id="replaceInputsContainer"></div>
                
                <div class="preview-box unified-grid-box" id="previewBox" style="max-height: 350px; overflow-y: auto; padding: 15px; border: 2px dashed #cbd5e1; border-radius: 20px; background: #f8fafc;">
                    <!-- JS will render everything here -->
                </div>
            </div>
            
            <!-- Hidden Input for New Files -->
            <input type="file" name="fotos[]" id="fotoInput" accept="image/*" multiple style="display: none;" onchange="addNewFiles(this)">

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
                    <option value="kegiatan" {{ old('kategori', $galeri->kategori) == 'kegiatan' ? 'selected' : '' }}>Kegiatan</option>
                    <option value="pembangunan" {{ old('kategori', $galeri->kategori) == 'pembangunan' ? 'selected' : '' }}>Pembangunan</option>
                    <option value="budaya" {{ old('kategori', $galeri->kategori) == 'budaya' ? 'selected' : '' }}>Budaya</option>
                    <option value="wisata" {{ old('kategori', $galeri->kategori) == 'wisata' ? 'selected' : '' }}>Wisata</option>
                    <option value="umkm" {{ old('kategori', $galeri->kategori) == 'umkm' ? 'selected' : '' }}>UMKM</option>
                </select>
                @error('kategori')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation text-xs"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <!-- Deskripsi Opsional -->
            <div class="form-group">
                <label class="form-label">
                    <i class="fa-regular fa-note-sticky"></i> Deskripsi Foto (Opsional)
                </label>
                <textarea name="deskripsi" class="input-glass h-28" placeholder="Tuliskan detail gambar, konteks, lokasi, atau latar belakang acara...">{{ old('deskripsi', $galeri->deskripsi) }}</textarea>
                @error('deskripsi')
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

<style>
    .photo-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
    }
    .photo-item {
        position: relative;
        width: 110px;
        height: 110px;
        border-radius: 12px;
        overflow: hidden;
        border: 2px solid #e2e8f0;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
        flex-shrink: 0;
    }
    .photo-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s;
    }
    .photo-item:hover img {
        transform: scale(1.05);
    }
    .photo-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0,0,0,0.55);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 6px;
        opacity: 0;
        transition: opacity 0.3s;
    }
    .photo-item:hover .photo-overlay {
        opacity: 1;
    }
    .photo-btn {
        background: white;
        border: none;
        border-radius: 6px;
        padding: 4px 10px;
        font-size: 0.65rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 4px;
        transition: all 0.2s;
    }
    .photo-btn:hover { transform: scale(1.08); }
    .photo-btn.replace { color: #3b82f6; }
    .photo-btn.remove { color: #ef4444; }
    .photo-add-btn {
        width: 110px;
        height: 110px;
        border-radius: 12px;
        border: 2px dashed #cbd5e1;
        background: #f8fafc;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s;
        flex-shrink: 0;
        gap: 4px;
    }
    .photo-add-btn:hover {
        border-color: #3b82f6;
        background: #eff6ff;
    }
    .photo-add-btn i {
        font-size: 1.5rem;
        color: #94a3b8;
        transition: color 0.3s;
    }
    .photo-add-btn:hover i {
        color: #3b82f6;
    }
    .photo-add-btn span {
        font-size: 0.6rem;
        color: #94a3b8;
        font-weight: 600;
    }
</style>

<script>
    // ===== STATE =====
    // Existing photos from DB (mutable: can be marked as deleted or replaced)
    let existingPhotos = @json($galeri->fotos->map(function($f) {
        return ['id' => $f->id_galeri_foto, 'url' => asset('storage/' . $f->foto_path)];
    })->values());

    let deletedExistingIds = [];         // IDs of existing photos the user clicked "Hapus"
    let replacedExisting = {};           // { id: File } - existing photos the user clicked "Ganti"
    let newFiles = new DataTransfer();   // Brand-new files the user added

    // ===== RENDER =====
    function renderGrid() {
        const box = document.getElementById('previewBox');
        let html = '<div class="photo-grid">';

        // 1) Existing photos (that haven't been deleted)
        existingPhotos.forEach(photo => {
            if (deletedExistingIds.includes(photo.id)) return;
            const imgSrc = replacedExisting[photo.id]
                ? URL.createObjectURL(replacedExisting[photo.id])
                : photo.url;
            html += `
                <div class="photo-item">
                    <img src="${imgSrc}" alt="Foto">
                    <div class="photo-overlay">
                        <button type="button" class="photo-btn replace" onclick="replaceExisting(${photo.id})">
                            <i class="fa-solid fa-pen"></i> Ganti
                        </button>
                        <button type="button" class="photo-btn remove" onclick="deleteExisting(${photo.id})">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
        });

        // 2) New files
        Array.from(newFiles.files).forEach((file, index) => {
            const objectUrl = URL.createObjectURL(file);
            html += `
                <div class="photo-item">
                    <img src="${objectUrl}" alt="Foto Baru">
                    <div class="photo-overlay">
                        <button type="button" class="photo-btn replace" onclick="replaceNewFile(${index})">
                            <i class="fa-solid fa-pen"></i> Ganti
                        </button>
                        <button type="button" class="photo-btn remove" onclick="removeNewFile(${index})">
                            <i class="fa-solid fa-trash"></i> Hapus
                        </button>
                    </div>
                </div>
            `;
        });

        // 3) The "+" add button (always last)
        html += `
            <div class="photo-add-btn" onclick="document.getElementById('fotoInput').click()">
                <i class="fa-solid fa-plus"></i>
                <span>Tambah</span>
            </div>
        `;

        html += '</div>';
        box.innerHTML = html;

        // Sync hidden inputs
        syncFormInputs();
    }

    // ===== SYNC FORM INPUTS =====
    function syncFormInputs() {
        // deleted_fotos hidden input
        document.getElementById('deletedFotosInput').value = deletedExistingIds.join(',');

        // replace_fotos[] file inputs
        const container = document.getElementById('replaceInputsContainer');
        container.innerHTML = '';
        for (const [id, file] of Object.entries(replacedExisting)) {
            const dt = new DataTransfer();
            dt.items.add(file);
            const inp = document.createElement('input');
            inp.type = 'file';
            inp.name = `replace_fotos[${id}]`;
            inp.style.display = 'none';
            inp.files = dt.files;
            container.appendChild(inp);
        }

        // fotos[] (new files)
        const fotoInput = document.getElementById('fotoInput');
        fotoInput.files = newFiles.files;
    }

    // ===== EXISTING PHOTO ACTIONS =====
    function deleteExisting(id) {
        deletedExistingIds.push(id);
        renderGrid();
    }

    function replaceExisting(id) {
        const inp = document.createElement('input');
        inp.type = 'file';
        inp.accept = 'image/*';
        inp.onchange = function(e) {
            if (e.target.files && e.target.files[0]) {
                replacedExisting[id] = e.target.files[0];
                renderGrid();
            }
        };
        inp.click();
    }

    // ===== NEW FILE ACTIONS =====
    function addNewFiles(input) {
        if (input.files && input.files.length > 0) {
            Array.from(input.files).forEach(f => newFiles.items.add(f));
            input.value = '';
            renderGrid();
        }
    }

    function removeNewFile(index) {
        const updated = new DataTransfer();
        Array.from(newFiles.files).forEach((f, i) => { if (i !== index) updated.items.add(f); });
        newFiles = updated;
        renderGrid();
    }

    function replaceNewFile(index) {
        const inp = document.createElement('input');
        inp.type = 'file';
        inp.accept = 'image/*';
        inp.onchange = function(e) {
            if (e.target.files && e.target.files[0]) {
                const updated = new DataTransfer();
                Array.from(newFiles.files).forEach((f, i) => {
                    updated.items.add(i === index ? e.target.files[0] : f);
                });
                newFiles = updated;
                renderGrid();
            }
        };
        inp.click();
    }

    // ===== DRAG & DROP on the grid box =====
    const gridBox = document.getElementById('previewBox');
    if (gridBox) {
        gridBox.addEventListener('dragover', e => { e.preventDefault(); gridBox.style.borderColor = '#3b82f6'; });
        gridBox.addEventListener('dragleave', e => { e.preventDefault(); gridBox.style.borderColor = '#cbd5e1'; });
        gridBox.addEventListener('drop', e => {
            e.preventDefault();
            gridBox.style.borderColor = '#cbd5e1';
            if (e.dataTransfer.files.length > 0) {
                Array.from(e.dataTransfer.files).forEach(f => newFiles.items.add(f));
                renderGrid();
            }
        });
    }

    // ===== INITIAL RENDER =====
    document.addEventListener('DOMContentLoaded', renderGrid);
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection