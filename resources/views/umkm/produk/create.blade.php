@extends('layouts.app')

@section('title', 'Tambah Produk - ' . ($umkm->nama_usaha ?? 'UMKM'))

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

    .create-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

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

    .create-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .create-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 0.75rem;
    }

    .create-badge i {
        font-size: 0.65rem;
        color: var(--primary);
    }

    .create-badge span {
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        color: var(--primary-dark);
        text-transform: uppercase;
    }

    .create-title {
        font-size: clamp(1.5rem, 4vw, 2.2rem);
        font-weight: 800;
        letter-spacing: -0.03em;
        color: var(--dark);
    }

    .create-title span {
        color: var(--primary);
    }

    .create-subtitle {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
    }

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

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    @media (max-width: 768px) {
        .create-wrapper { padding: 1rem; }
        .form-body { padding: 1.5rem; }
        .form-grid { grid-template-columns: 1fr; }
        .form-actions { flex-direction: column; }
        .btn-cancel, .btn-submit { text-align: center; justify-content: center; }
    }

    .fade-up {
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .umkm-selector {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border: 1px solid #93c5fd;
        border-radius: 20px;
        padding: 1rem 1.2rem;
        margin-bottom: 1.5rem;
    }

    .umkm-selector-label {
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #1e40af;
        margin-bottom: 0.5rem;
        display: block;
    }

    .umkm-selector select {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 2px solid #93c5fd;
        border-radius: 16px;
        background: white;
        color: var(--dark);
        font-weight: 500;
    }
</style>

<div class="bg-pattern"></div>

<div class="create-wrapper">
    
    {{-- Back Button --}}
    <div class="fade-up">
        <a href="{{ route('umkm.produk.index') }}" class="back-button">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar Produk
        </a>
    </div>

    {{-- Header --}}
    <div class="create-header fade-up" style="animation-delay: 0.05s">
        <div class="create-badge">
            <i class="fa-solid fa-plus-circle"></i>
            <span>Tambah Produk Baru</span>
        </div>
        <h1 class="create-title">
            Tambah <span>Produk</span>
        </h1>
        <p class="create-subtitle">
            Tambahkan produk baru dari UMKM Anda
        </p>
    </div>

    {{-- Form Card --}}
    <div class="form-card fade-up" style="animation-delay: 0.1s">
        <div class="form-header">
            <i class="fa-solid fa-box"></i>
            <h3>Informasi Produk</h3>
        </div>

        <div class="form-body">
            {{-- UMKM Selector (jika ada multiple UMKMs) --}}
            @if(isset($umkms) && $umkms->count() > 1)
            <div class="umkm-selector">
                <label class="umkm-selector-label">
                    <i class="fa-solid fa-store mr-1"></i> Pilih UMKM
                </label>
                <select onchange="window.location.href = '{{ route('umkm.produk.create') }}/' + this.value" required>
                    <option value="">-- Pilih UMKM --</option>
                    @foreach($umkms as $u)
                        <option value="{{ $u->id_umkm }}" {{ $u->id_umkm == $umkm->id_umkm ? 'selected' : '' }}>
                            {{ $u->nama_usaha }} 
                            @if($u->status == 'approved')
                                ✓ Aktif
                            @endif
                        </option>
                    @endforeach
                </select>
            </div>
            @endif

            <form action="{{ route('umkm.produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <input type="hidden" name="umkm_id" value="{{ $umkm->id_umkm }}">

                <div class="form-grid">
                    {{-- Nama Produk --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-tag"></i> Nama Produk
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_produk" value="{{ old('nama_produk') }}" required
                               class="form-control @error('nama_produk') is-invalid @enderror"
                               placeholder="Masukkan nama produk">
                        @error('nama_produk')
                            <p class="error-feedback">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Harga --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-money-bill"></i> Harga (Rp)
                            <span class="required">*</span>
                        </label>
                        <input type="number" name="harga" value="{{ old('harga') }}" min="0" required
                               class="form-control @error('harga') is-invalid @enderror"
                               placeholder="0">
                        @error('harga')
                            <p class="error-feedback">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Deskripsi --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-align-left"></i> Deskripsi
                    </label>
                    <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                              placeholder="Tuliskan deskripsi produk Anda (opsional)">{{ old('deskripsi') }}</textarea>
                    @error('deskripsi')
                        <p class="error-feedback">
                            <i class="fa-solid fa-circle-exclamation"></i>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Foto Produk --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-image"></i> Foto Produk
                        <span class="required">*</span>
                    </label>
                    <div class="file-upload">
                        <input type="file" name="foto_produk" id="foto_produk" accept="image/jpeg,image/jpg,image/png" required>
                        <label for="foto_produk" class="file-upload-label">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                            <span id="file-name">Pilih foto produk atau drag & drop (Maks: 2MB)</span>
                        </label>
                        @error('foto_produk')
                            <p class="error-feedback">
                                <i class="fa-solid fa-circle-exclamation"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="form-actions">
                    <a href="{{ route('umkm.produk.index') }}" class="btn-cancel">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-check"></i> Tambahkan Produk
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

<script>
    // File input feedback
    const fileInput = document.getElementById('foto_produk');
    const fileName = document.getElementById('file-name');

    if (fileInput) {
        fileInput.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                fileName.textContent = this.files[0].name;
            }
        });

        // Drag & drop
        const label = document.querySelector('.file-upload-label');
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            label.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            label.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            label.addEventListener(eventName, unhighlight, false);
        });

        function highlight(e) {
            label.style.borderColor = '#10b981';
            label.style.backgroundColor = 'rgba(16, 185, 129, 0.08)';
        }

        function unhighlight(e) {
            label.style.borderColor = '#cbd5e1';
            label.style.backgroundColor = '#f1f5f9';
        }

        label.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            
            if (files && files[0]) {
                fileName.textContent = files[0].name;
            }
        }
    }

    // Add animation on load
    document.querySelectorAll('.fade-up').forEach((el, i) => {
        el.style.animationDelay = (i * 0.05) + 's';
    });
</script>

@endsection
