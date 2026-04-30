{{-- resources/views/admin/keuangan/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Transaksi - Keuangan Desa')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --system-bg: #0a0a0a;
        --card-bg: #ffffff;
        --accent-primary: #10b981;
        --accent-yellow: #f59e0b;
        --accent-blue: #3b82f6;
        --accent-purple: #8b5cf6;
        --accent-red: #ef4444;
        --text-main: #171717;
        --text-mute: #737373;
        --border-color: #f1f1f1;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #fafafa;
        color: var(--text-main);
        letter-spacing: -0.02em;
    }

    .font-display { font-family: 'Instrument Sans', sans-serif; }

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    .dashboard-wrapper {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 2rem;
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1.2rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-mute);
        text-decoration: none;
        transition: all 0.3s;
        margin-bottom: 2rem;
    }

    .back-link:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateX(-4px);
    }

    /* Form Card */
    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 32px;
        overflow: hidden;
        transition: all 0.4s;
    }

    .form-card:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .form-header {
        background: linear-gradient(135deg, var(--system-bg), var(--system-bg));
        padding: 1.5rem 2rem;
        color: white;
    }

    .form-header h1 {
        font-size: 1.4rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .form-header p {
        color: rgba(255,255,255,0.6);
        font-size: 0.8rem;
        margin-top: 0.3rem;
    }

    .form-body {
        padding: 2rem;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
        margin-bottom: 0.5rem;
    }

    .form-label i {
        color: var(--accent-primary);
        margin-right: 0.3rem;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 0.2rem;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1.5px solid var(--border-color);
        border-radius: 16px;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 4px rgba(16,185,129,0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    select.form-control {
        cursor: pointer;
        background: white;
    }

    /* Radio Jenis Transaksi */
    .radio-group {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .radio-option {
        cursor: pointer;
    }

    .radio-option input {
        display: none;
    }

    .radio-card {
        padding: 1rem;
        border: 1.5px solid var(--border-color);
        border-radius: 20px;
        text-align: center;
        transition: all 0.3s;
        background: white;
    }

    .radio-option input:checked + .radio-card {
        border-color: var(--accent-primary);
        background: #ecfdf5;
    }

    .radio-card i {
        font-size: 2rem;
        display: block;
        margin-bottom: 0.5rem;
    }

    .radio-card .text-pemasukan { color: #059669; }
    .radio-card .text-pengeluaran { color: #dc2626; }

    .radio-card .title {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
    }

    .radio-card .desc {
        font-size: 0.65rem;
        color: var(--text-mute);
    }

    .radio-option:hover .radio-card {
        border-color: var(--accent-primary);
        transform: translateY(-2px);
    }

    /* Amount Input */
    .amount-input {
        position: relative;
    }

    .amount-prefix {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-mute);
        font-weight: 600;
        font-size: 0.9rem;
    }

    .amount-input input {
        padding-left: 3rem;
    }

    /* Upload Area */
    .upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 20px;
        padding: 1.5rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.3s;
        background: #fafafa;
    }

    .upload-area:hover {
        border-color: var(--accent-primary);
        background: #ecfdf5;
        transform: translateY(-2px);
    }

    .upload-area i {
        color: var(--gray-light);
        transition: all 0.3s;
    }

    .upload-area:hover i {
        color: var(--accent-primary);
    }

    .current-photo {
        margin-bottom: 1rem;
        padding: 0.5rem;
        background: #f1f5f9;
        border-radius: 16px;
        text-align: center;
    }

    .current-photo img {
        max-height: 100px;
        border-radius: 12px;
        margin-bottom: 0.3rem;
    }

    .current-photo p {
        font-size: 0.65rem;
        color: var(--text-mute);
    }

    .preview-container {
        display: none;
        margin-top: 1rem;
        text-align: center;
    }

    .preview-image {
        max-width: 150px;
        max-height: 150px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        border: 3px solid white;
    }

    .btn-remove {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        margin-top: 0.5rem;
        padding: 0.3rem 0.8rem;
        background: #fef2f2;
        border: none;
        border-radius: 40px;
        font-size: 0.7rem;
        color: #ef4444;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-remove:hover {
        background: #ef4444;
        color: white;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .btn-primary {
        padding: 0.75rem 1.8rem;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary));
        color: white;
        border: none;
        border-radius: 60px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16,185,129,0.3);
    }

    .btn-secondary {
        padding: 0.75rem 1.8rem;
        background: transparent;
        border: 1.5px solid var(--border-color);
        color: var(--text-mute);
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        text-decoration: none;
        transition: all 0.3s;
    }

    .btn-secondary:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateY(-2px);
        background: #ecfdf5;
    }

    /* Alert Error */
    .alert-error {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #fef2f2;
        border-left: 3px solid #ef4444;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        color: #dc2626;
    }

    /* Animations */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-up { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }

    /* Responsive */
    @media (max-width: 640px) {
        .dashboard-wrapper { padding: 1rem; }
        .form-body { padding: 1.2rem; }
        .form-header { padding: 1rem 1.2rem; }
        .form-header h1 { font-size: 1.2rem; }
        .radio-group { grid-template-columns: 1fr; }
        .action-buttons { flex-direction: column; }
        .btn-primary, .btn-secondary { justify-content: center; }
    }
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Back Button --}}
    <a href="{{ route('admin.keuangan.index') }}" class="back-link animate-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Keuangan
    </a>

    {{-- Form Card --}}
    <div class="form-card animate-up delay-1">
        <div class="form-header">
            <h1>
                <i class="fa-solid fa-pen"></i>
                Edit Transaksi
            </h1>
            <p>Perbarui data pemasukan atau pengeluaran desa</p>
        </div>
        
        <div class="form-body">
            {{-- Error Alert --}}
            @if($errors->any())
            <div class="alert-error">
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

            <form action="{{ route('admin.keuangan.update', $transaksi->id_transaksi) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                {{-- Tanggal --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-calendar"></i> Tanggal Transaksi <span class="required">*</span>
                    </label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', $transaksi->tanggal) }}" required class="form-control">
                </div>
                
                {{-- Jenis Transaksi --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-tag"></i> Jenis Transaksi <span class="required">*</span>
                    </label>
                    <div class="radio-group">
                        <label class="radio-option">
                            <input type="radio" name="jenis" value="pemasukan" {{ $transaksi->jenis == 'pemasukan' ? 'checked' : '' }} required>
                            <div class="radio-card">
                                <i class="fa-solid fa-money-bill-trend-up text-pemasukan"></i>
                                <div class="title">💰 Pemasukan</div>
                                <div class="desc">Dana masuk ke kas desa</div>
                            </div>
                        </label>
                        <label class="radio-option">
                            <input type="radio" name="jenis" value="pengeluaran" {{ $transaksi->jenis == 'pengeluaran' ? 'checked' : '' }} required>
                            <div class="radio-card">
                                <i class="fa-solid fa-money-bill-trend-down text-pengeluaran"></i>
                                <div class="title">💸 Pengeluaran</div>
                                <div class="desc">Dana keluar dari kas desa</div>
                            </div>
                        </label>
                    </div>
                </div>
                
                {{-- Kategori --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-list"></i> Kategori <span class="required">*</span>
                    </label>
                    <select name="id_kategori" required class="form-control">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $k)
                            <option value="{{ $k->id_kategori }}" {{ $transaksi->id_kategori == $k->id_kategori ? 'selected' : '' }}>
                                {{ $k->nama_kategori }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                {{-- Deskripsi --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-align-left"></i> Deskripsi <span class="required">*</span>
                    </label>
                    <textarea name="deskripsi" rows="3" required class="form-control" placeholder="Contoh: Pembangunan jalan desa, Pembayaran gaji perangkat desa, dll">{{ old('deskripsi', $transaksi->deskripsi) }}</textarea>
                </div>
                
                {{-- Jumlah --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-money-bill"></i> Jumlah (Rp) <span class="required">*</span>
                    </label>
                    <div class="amount-input">
                        <span class="amount-prefix">Rp</span>
                        <input type="number" name="jumlah" step="1000" value="{{ old('jumlah', $transaksi->jumlah) }}" required class="form-control" placeholder="0">
                    </div>
                </div>
                
                {{-- Bukti Foto --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-camera"></i> Bukti Transaksi
                    </label>
                    
                    @if($transaksi->bukti_foto)
                    <div class="current-photo">
                        <img src="{{ asset('storage/' . $transaksi->bukti_foto) }}" alt="Current Photo">
                        <p>Foto bukti saat ini</p>
                    </div>
                    @endif
                    
                    <div class="upload-area" id="uploadArea">
                        <input type="file" name="bukti_foto" id="fotoInput" accept="image/jpeg,image/png,image/jpg" style="display: none;">
                        <i class="fa-solid fa-cloud-arrow-up fa-2x" style="margin-bottom: 0.5rem; display: block;"></i>
                        <p class="text-sm text-gray-500">{{ $transaksi->bukti_foto ? 'Klik untuk ganti foto' : 'Klik atau drag & drop untuk upload foto' }}</p>
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG (Maks. 2MB)</p>
                    </div>
                    <div class="preview-container" id="previewContainer">
                        <img id="previewImage" class="preview-image" alt="Preview">
                        <div>
                            <button type="button" class="btn-remove" id="removeImage">
                                <i class="fa-solid fa-trash"></i> Hapus Pilihan
                            </button>
                        </div>
                    </div>
                </div>
                
                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <a href="{{ route('admin.keuangan.index') }}" class="btn-secondary">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fa-regular fa-floppy-disk"></i> Update Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        // Preview foto
        const fotoInput = document.getElementById('fotoInput');
        const uploadArea = document.getElementById('uploadArea');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const removeImage = document.getElementById('removeImage');
        
        if (uploadArea) {
            uploadArea.addEventListener('click', () => {
                fotoInput.click();
            });
            
            uploadArea.addEventListener('dragover', (e) => {
                e.preventDefault();
                uploadArea.classList.add('border-primary', 'bg-primary-soft');
            });
            
            uploadArea.addEventListener('dragleave', () => {
                uploadArea.classList.remove('border-primary', 'bg-primary-soft');
            });
            
            uploadArea.addEventListener('drop', (e) => {
                e.preventDefault();
                uploadArea.classList.remove('border-primary', 'bg-primary-soft');
                const file = e.dataTransfer.files[0];
                if (file && file.type.startsWith('image/')) {
                    fotoInput.files = e.dataTransfer.files;
                    previewFile(file);
                }
            });
        }
        
        if (fotoInput) {
            fotoInput.addEventListener('change', (e) => {
                if (e.target.files.length > 0) {
                    previewFile(e.target.files[0]);
                }
            });
        }
        
        function previewFile(file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                previewImage.src = event.target.result;
                previewContainer.style.display = 'block';
                uploadArea.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
        
        if (removeImage) {
            removeImage.addEventListener('click', () => {
                fotoInput.value = '';
                previewContainer.style.display = 'none';
                uploadArea.style.display = 'block';
            });
        }
    })();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection