@extends('layouts.app')

@section('title', 'Edit Produk - ' . $produk->nama_produk)

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
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

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        opacity: 0.3;
    }

    .edit-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        background: white;
        border: 1px solid var(--border);
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray);
        text-decoration: none;
        transition: all 0.3s;
        margin-bottom: 2rem;
    }

    .back-button:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(-4px);
    }

    /* Header */
    .edit-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .edit-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 0.75rem;
    }

    .edit-badge i {
        font-size: 0.65rem;
        color: var(--primary);
    }

    .edit-badge span {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        color: var(--primary-dark);
        text-transform: uppercase;
    }

    .edit-title {
        font-size: clamp(1.5rem, 4vw, 2.2rem);
        font-weight: 800;
        letter-spacing: -0.03em;
        color: var(--dark);
    }

    .edit-title span {
        color: var(--primary);
    }

    .edit-subtitle {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
    }

    /* Form Card */
    .form-card {
        background: white;
        border-radius: 32px;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .form-card:hover {
        box-shadow: 0 24px 48px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    .form-header {
        background: linear-gradient(135deg, #fafbfc, #ffffff);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-header i {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .form-header h3 {
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
    }

    .form-body {
        padding: 2rem;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1.75rem;
    }

    .form-label {
        display: block;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        margin-bottom: 0.5rem;
    }

    .form-label i {
        margin-right: 0.4rem;
        color: var(--primary);
        font-size: 0.65rem;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 0.25rem;
    }

    .form-control {
        width: 100%;
        padding: 0.9rem 1.2rem;
        border: 2px solid var(--border);
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        transition: var(--transition);
        background: white;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    /* Current Photo */
    .current-photo {
        background: var(--gray-soft);
        border-radius: 20px;
        padding: 1rem;
        text-align: center;
        margin-bottom: 1rem;
    }

    .current-photo-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--gray);
        margin-bottom: 0.5rem;
        display: block;
    }

    .current-photo img {
        max-height: 150px;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
    }

    /* File Upload */
    .file-upload {
        position: relative;
        display: inline-block;
        width: 100%;
    }

    .file-upload input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
        z-index: 10;
    }

    .file-upload-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.9rem 1.2rem;
        border: 2px dashed var(--border);
        border-radius: 20px;
        background: var(--gray-soft);
        cursor: pointer;
        transition: var(--transition);
    }

    .file-upload-label:hover {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .file-upload-label i {
        font-size: 1.2rem;
        color: var(--primary);
    }

    .file-upload-label span {
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--gray);
    }

    /* Action Buttons */
    .form-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .btn-cancel {
        padding: 0.8rem 1.8rem;
        background: white;
        border: 2px solid var(--border);
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 700;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition);
    }

    .btn-cancel:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
    }

    .btn-submit {
        padding: 0.8rem 2rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 700;
        color: white;
        cursor: pointer;
        transition: var(--transition);
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-submit i {
        transition: transform 0.3s;
    }

    .btn-submit:hover i {
        transform: translateX(3px);
    }

    /* Error */
    .error-feedback {
        font-size: 0.7rem;
        color: #ef4444;
        margin-top: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .is-invalid {
        border-color: #ef4444 !important;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .edit-wrapper { padding: 1rem; }
        .form-body { padding: 1.5rem; }
        .form-actions { flex-direction: column; }
        .btn-cancel, .btn-submit { text-align: center; justify-content: center; }
    }

    /* Animation */
    .fade-up {
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="bg-pattern"></div>

<div class="edit-wrapper">
    
    {{-- Back Button --}}
    <div class="fade-up">
        <a href="{{ route('umkm.produk.index') }}" class="back-button">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar Produk
        </a>
    </div>

    {{-- Header --}}
    <div class="edit-header fade-up" style="animation-delay: 0.05s">
        <div class="edit-badge">
            <i class="fa-solid fa-pen"></i>
            <span>Form Edit Produk</span>
        </div>
        <h1 class="edit-title">
            Edit <span>Produk</span>
        </h1>
        <p class="edit-subtitle">
            Perbarui informasi produk UMKM Anda
        </p>
    </div>

    {{-- Form Card --}}
    <div class="form-card fade-up" style="animation-delay: 0.1s">
        <div class="form-header">
            <i class="fa-solid fa-box"></i>
            <h3>Informasi Produk</h3>
        </div>
        
        <div class="form-body">
            @if(session('error'))
                <div class="error-feedback mb-3" style="padding: 0.75rem 1rem; background: #fef2f2; border-radius: 12px;">
                    <i class="fa-solid fa-circle-exclamation"></i> {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="error-feedback mb-3" style="padding: 0.75rem 1rem; background: #fef2f2; border-radius: 12px;">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul style="margin: 0.5rem 0 0 1rem; padding: 0;">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('umkm.produk.update', $produk->id_produk) }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Nama Produk --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-tag"></i> Nama Produk
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="nama_produk" 
                           class="form-control @error('nama_produk') is-invalid @enderror" 
                           value="{{ old('nama_produk', $produk->nama_produk) }}" 
                           required placeholder="Masukkan nama produk">
                    @error('nama_produk')
                        <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Harga --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-money-bill-wave"></i> Harga (Rp)
                        <span class="required">*</span>
                    </label>
                    <input type="number" name="harga" 
                           class="form-control @error('harga') is-invalid @enderror" 
                           value="{{ old('harga', $produk->harga) }}" 
                           required min="0" placeholder="0">
                    @error('harga')
                        <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-align-left"></i> Deskripsi
                    </label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" 
                              rows="4" placeholder="Deskripsikan produk Anda...">{{ old('deskripsi', $produk->deskripsi) }}</textarea>
                    @error('deskripsi')
                        <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Foto Saat Ini --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-image"></i> Foto Produk Saat Ini
                    </label>
                    <div class="current-photo">
                        @if($produk->foto_produk)
                            <div class="current-photo-label">
                                <i class="fa-regular fa-image"></i> Preview
                            </div>
                            <img src="{{ Storage::url($produk->foto_produk) }}" alt="Foto Produk">
                        @else
                            <p class="text-muted" style="margin: 0;">
                                <i class="fa-regular fa-folder-open"></i> Belum ada foto
                            </p>
                        @endif
                    </div>
                </div>

                {{-- Ganti Foto --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-upload"></i> Ganti Foto (Opsional)
                    </label>
                    <div class="file-upload">
                        <input type="file" name="foto_produk" id="foto_produk" accept="image/*" onchange="updateFileName(this)">
                        <div class="file-upload-label">
                            <i class="fa-solid fa-cloud-upload-alt"></i>
                            <span id="fileNameDisplay">Pilih file foto baru...</span>
                        </div>
                    </div>
                    <small class="text-muted" style="display: block; margin-top: 0.5rem; font-size: 0.65rem;">
                        <i class="fa-regular fa-circle-info"></i> Format: JPG, PNG, JPEG. Maks: 2MB
                    </small>
                    @error('foto_produk')
                        <div class="error-feedback"><i class="fa-solid fa-circle-exclamation"></i> {{ $message }}</div>
                    @enderror
                </div>

                {{-- Action Buttons --}}
                <div class="form-actions">
                    <a href="{{ route('umkm.produk.index') }}" class="btn-cancel">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-check"></i> Perbarui Produk
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    function updateFileName(input) {
        const display = document.getElementById('fileNameDisplay');
        if (input.files.length > 0) {
            display.innerHTML = '<i class="fa-solid fa-check-circle"></i> ' + input.files[0].name;
            display.style.color = '#10b981';
        } else {
            display.innerHTML = 'Pilih file foto baru...';
            display.style.color = '';
        }
    }
</script>
@endsection