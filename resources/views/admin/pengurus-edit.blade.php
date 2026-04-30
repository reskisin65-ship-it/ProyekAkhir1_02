{{-- resources/views/admin/pengurus-edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Pengurus Desa - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
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
        --transition: all 0.25s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.35s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--dark);
        -webkit-font-smoothing: antialiased;
    }

    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--gray-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
        background-size: 20px 20px;
        opacity: 0.4;
    }

    .container-premium {
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1.2rem;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition-bounce);
        margin-bottom: 2rem;
    }

    .back-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(-4px);
        background: var(--primary-soft);
    }

    /* Form Card */
    .form-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 32px;
        overflow: hidden;
        transition: var(--transition);
    }

    .form-card:hover {
        box-shadow: var(--shadow-md);
    }

    .form-header {
        background: linear-gradient(135deg, var(--dark), var(--dark-soft));
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
        color: var(--gray);
        margin-bottom: 0.5rem;
    }

    .form-label i {
        color: var(--primary);
        margin-right: 0.3rem;
    }

    .form-label .required {
        color: #ef4444;
        margin-left: 0.2rem;
    }

    .form-control {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 16px;
        font-size: 0.9rem;
        font-family: inherit;
        transition: var(--transition);
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 4px var(--primary-soft);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 100px;
    }

    /* Kategori Options - Radio Premium */
    .kategori-options {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(180px, 1fr));
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .kategori-option {
        position: relative;
    }

    .kategori-option input {
        position: absolute;
        opacity: 0;
        width: 0;
        height: 0;
    }

    .kategori-option label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.8rem 1rem;
        border: 1.5px solid var(--border);
        border-radius: 20px;
        cursor: pointer;
        transition: var(--transition-bounce);
        font-size: 0.85rem;
        font-weight: 600;
        background: white;
        color: var(--dark);
    }

    .kategori-option input:checked + label {
        border-color: var(--primary);
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        color: var(--primary-dark);
        transform: scale(1.02);
        box-shadow: var(--shadow-sm);
    }

    .kategori-option label:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
        background: var(--primary-soft);
    }

    .kategori-icon {
        width: 32px;
        height: 32px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .kategori-option input:checked + label .kategori-icon {
        transform: scale(1.05);
    }

    .custom-badge {
        font-size: 0.55rem;
        background: #e2e8f0;
        padding: 0.15rem 0.5rem;
        border-radius: 20px;
        margin-left: 0.3rem;
        color: var(--gray);
        font-weight: 500;
    }

    /* Current Photo */
    .current-photo {
        margin-bottom: 1rem;
        padding: 1rem;
        background: var(--gray-soft);
        border-radius: 16px;
        text-align: center;
    }

    .current-photo img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 16px;
        box-shadow: var(--shadow-sm);
        border: 2px solid white;
    }

    .current-photo p {
        font-size: 0.7rem;
        color: var(--gray);
        margin-top: 0.3rem;
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

    .upload-area i {
        color: var(--gray-light);
        transition: var(--transition);
    }

    .upload-area:hover i {
        color: var(--primary);
    }

    .preview-container {
        display: none;
        margin-top: 1rem;
        text-align: center;
    }

    .preview-image {
        width: 110px;
        height: 110px;
        object-fit: cover;
        border-radius: 20px;
        box-shadow: var(--shadow-md);
        border: 3px solid white;
    }

    .btn-remove {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        margin-top: 0.5rem;
        padding: 0.3rem 0.9rem;
        background: #fef2f2;
        border: none;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        color: #ef4444;
        cursor: pointer;
        transition: var(--transition);
    }

    .btn-remove:hover {
        background: #ef4444;
        color: white;
    }

    /* Info Text */
    .info-text {
        font-size: 0.65rem;
        color: var(--gray-light);
        margin-top: 0.4rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .info-text i {
        font-size: 0.6rem;
        color: var(--primary);
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

    .btn-primary {
        padding: 0.75rem 1.8rem;
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
        padding: 0.75rem 1.8rem;
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
        .container-premium { padding: 1rem; }
        .form-body { padding: 1.2rem; }
        .form-header { padding: 1rem 1.2rem; }
        .form-header h1 { font-size: 1.2rem; }
        .kategori-options { grid-template-columns: 1fr; }
        .action-buttons { flex-direction: column; }
        .btn-primary, .btn-secondary { justify-content: center; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- Back Button --}}
    <a href="{{ route('admin.pengurus.index') }}" class="back-link animate-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Pengurus
    </a>

    {{-- Form Card --}}
    <div class="form-card animate-up delay-1">
        <div class="form-header">
            <h1>
                <i class="fa-solid fa-pen"></i>
                Edit Pengurus Desa
            </h1>
            <p>Perbarui data perangkat desa dengan hierarki jabatan otomatis</p>
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

            <form action="{{ route('admin.pengurus.update', $pengurus->id_pengurus) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                {{-- Nama Lengkap --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-user"></i> Nama Lengkap <span class="required">*</span>
                    </label>
                    <input type="text" name="nama_pengurus" value="{{ old('nama_pengurus', $pengurus->nama_pengurus) }}" required
                           class="form-control" placeholder="Masukkan nama lengkap">
                </div>
                
                {{-- NIP --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-id-card"></i> NIP
                    </label>
                    <input type="text" name="nip" value="{{ old('nip', $pengurus->nip) }}"
                           class="form-control" placeholder="Nomor Induk Pegawai (Opsional)">
                </div>
                
                {{-- Kategori Jabatan (Hierarki Otomatis) --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-layer-group"></i> Kategori Jabatan <span class="required">*</span>
                    </label>
                    <div class="kategori-options">
                        @foreach($hierarki as $key => $kat)
                            @if($key !== 'lainnya')
                            <div class="kategori-option">
                                <input type="radio" name="kategori_jabatan" id="kat_{{ $key }}" 
                                       value="{{ $key }}" 
                                       {{ old('kategori_jabatan', $pengurus->kategori_jabatan) == $key ? 'checked' : '' }}>
                                <label for="kat_{{ $key }}">
                                    <div class="kategori-icon" style="background: 
                                        @if($kat['color'] == 'amber') #fef3c7
                                        @elseif($kat['color'] == 'blue') #dbeafe
                                        @elseif($kat['color'] == 'purple') #f3e8ff
                                        @elseif($kat['color'] == 'green') #d1fae5
                                        @elseif($kat['color'] == 'orange') #ffedd5
                                        @else #f3f4f6 @endif">
                                        <i class="fa-solid {{ $kat['icon'] }}" style="color: 
                                            @if($kat['color'] == 'amber') #d97706
                                            @elseif($kat['color'] == 'blue') #2563eb
                                            @elseif($kat['color'] == 'purple') #7c3aed
                                            @elseif($kat['color'] == 'green') #059669
                                            @elseif($kat['color'] == 'orange') #ea580c
                                            @else #475569 @endif"></i>
                                    </div>
                                    <span>{{ $kat['nama'] }}</span>
                                    @if(!($kat['is_default'] ?? false))
                                        <span class="custom-badge">Custom</span>
                                    @endif
                                </label>
                            </div>
                            @endif
                        @endforeach
                    </div>
                </div>
                
                {{-- Jabatan Spesifik --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-briefcase"></i> Jabatan Spesifik <span class="required">*</span>
                    </label>
                    <input type="text" name="jabatan" value="{{ old('jabatan', $pengurus->jabatan) }}" required
                           class="form-control" placeholder="Contoh: Kepala Desa, Sekretaris Desa, Kasi Pemerintahan">
                    <div class="info-text">
                        <i class="fa-regular fa-message"></i>
                        Nama jabatan yang akan ditampilkan (bisa lebih spesifik dari kategori)
                    </div>
                </div>
                
                {{-- Tugas & Tanggung Jawab --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-bell"></i> Tugas & Tanggung Jawab
                    </label>
                    <textarea name="tugas" class="form-control" 
                              placeholder="Deskripsikan tugas dan tanggung jawab...">{{ old('tugas', $pengurus->tugas) }}</textarea>
                </div>
                
                {{-- Foto --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-image"></i> Foto
                    </label>
                    
                    {{-- Current Photo --}}
                    @if($pengurus->foto)
                    <div class="current-photo">
                        <img src="{{ asset('storage/' . $pengurus->foto) }}" alt="Current Photo">
                        <p>Foto saat ini</p>
                    </div>
                    @endif
                    
                    <div class="upload-area" id="uploadArea">
                        <input type="file" name="foto" id="fotoInput" class="hidden" accept="image/jpeg,image/png,image/jpg" style="display: none;">
                        <i class="fa-solid fa-cloud-arrow-up fa-2x" style="margin-bottom: 0.5rem; display: block;"></i>
                        <p style="font-size: 0.8rem; color: var(--gray);">
                            {{ $pengurus->foto ? 'Klik untuk ganti foto' : 'Klik atau drag & drop untuk upload foto' }}
                        </p>
                        <p style="font-size: 0.65rem; color: var(--gray-light); margin-top: 0.3rem;">Format: JPG, PNG (Maks. 2MB)</p>
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
                    <a href="{{ route('admin.pengurus.index') }}" class="btn-secondary">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fa-regular fa-floppy-disk"></i> Update Pengurus
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    (function() {
        // Preview foto baru
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
@endsection