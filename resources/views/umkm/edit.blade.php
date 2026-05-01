{{-- resources/views/umkm/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit UMKM - ' . $umkm->nama_usaha)

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
        max-width: 900px;
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
        padding: 1.8rem 2rem;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '✏️';
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 6rem;
        opacity: 0.1;
        pointer-events: none;
    }

    .card-header h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.3rem;
        letter-spacing: -0.02em;
    }

    .card-header p {
        color: rgba(255,255,255,0.8);
        font-size: 0.85rem;
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
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--gray);
        margin-bottom: 0.5rem;
    }

    .form-label i {
        color: var(--primary);
        font-size: 0.8rem;
    }

    .form-label .required {
        color: #ef4444;
        font-size: 0.7rem;
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

    .form-input.readonly {
        background: #f1f5f9;
        color: var(--gray);
        cursor: not-allowed;
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
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
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
        gap: 0.5rem;
        padding: 0.8rem 2rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: white;
        transition: var(--transition-bounce);
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    /* Image Preview */
    .image-preview {
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .current-image {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: var(--primary-soft);
        border-radius: 40px;
        font-size: 0.7rem;
        color: var(--primary-dark);
    }

    .current-image img {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        object-fit: cover;
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

    .alert-success {
        background: #ecfdf5;
        border-left: 3px solid var(--primary);
        color: #059669;
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
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- Back Button --}}
    <a href="{{ route('umkm.index') }}" class="back-button animate__animated animate__fadeIn">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Pusat UMKM
    </a>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="alert-premium alert-success animate__animated animate__fadeInUp">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        <div class="alert-close" onclick="this.parentElement.remove()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    @endif

    @if($errors->any())
    <div class="alert-premium alert-error animate__animated animate__fadeInUp">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>Terjadi kesalahan. Silakan periksa kembali form Anda.</span>
        </div>
        <div class="alert-close" onclick="this.parentElement.remove()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    @endif

    {{-- Main Form Card --}}
    <div class="main-card animate__animated animate__fadeInUp">
        <div class="card-header">
            <h1>✏️ Edit UMKM</h1>
            <p>Perbarui data usaha Anda dengan informasi terbaru</p>
        </div>

        <div class="card-body">
            <form action="{{ route('umkm.update', $umkm->id_umkm) }}" method="POST" enctype="multipart/form-data" id="editForm">
                @csrf
                @method('PUT')

                <div class="form-grid">
                    {{-- Nama Usaha --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-store"></i> Nama Usaha
                            <span class="required">*</span>
                        </label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha', $umkm->nama_usaha) }}" required
                               class="form-input @error('nama_usaha') is-invalid @enderror"
                               placeholder="Masukkan nama usaha Anda">
                        @error('nama_usaha')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Kategori --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-tag"></i> Kategori
                            <span class="required">*</span>
                        </label>
                        <select name="kategori" class="form-select @error('kategori') is-invalid @enderror">
                            <option value="makanan" {{ $umkm->kategori == 'makanan' ? 'selected' : '' }}>🍔 Makanan & Kuliner</option>
                            <option value="kerajinan" {{ $umkm->kategori == 'kerajinan' ? 'selected' : '' }}>🎨 Kerajinan Tangan</option>
                            <option value="fashion" {{ $umkm->kategori == 'fashion' ? 'selected' : '' }}>👕 Fashion & Busana</option>
                            <option value="pertanian" {{ $umkm->kategori == 'pertanian' ? 'selected' : '' }}>🌾 Pertanian & Perkebunan</option>
                            <option value="jasa" {{ $umkm->kategori == 'jasa' ? 'selected' : '' }}>💼 Jasa & Layanan</option>
                            <option value="lainnya" {{ $umkm->kategori == 'lainnya' ? 'selected' : '' }}>📦 Lainnya</option>
                        </select>
                        @error('kategori')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Nama Pemilik (Readonly) --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-solid fa-user"></i> Nama Pemilik
                        </label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', $umkm->pemilik) }}" 
                               class="form-input readonly" readonly>
                        <p class="text-xs text-gray-400 mt-1">* Tidak dapat diubah</p>
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="form-group">
                        <label class="form-label">
                            <i class="fa-brands fa-whatsapp"></i> Nomor Telepon
                            <span class="required">*</span>
                        </label>
                        <input type="tel" name="no_telepon" value="{{ old('no_telepon', $umkm->no_telepon) }}" required
                               class="form-input @error('no_telepon') is-invalid @enderror"
                               placeholder="Contoh: 08123456789">
                        @error('no_telepon')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Alamat Usaha --}}
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fa-solid fa-location-dot"></i> Alamat Usaha
                            <span class="required">*</span>
                        </label>
                        <textarea name="alamat_usaha" rows="2" required
                                  class="form-textarea @error('alamat_usaha') is-invalid @enderror"
                                  placeholder="Masukkan alamat lengkap usaha Anda">{{ old('alamat_usaha', $umkm->alamat_usaha) }}</textarea>
                        @error('alamat_usaha')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Deskripsi Usaha --}}
                    <div class="form-group full-width">
                        <label class="form-label">
                            <i class="fa-solid fa-align-left"></i> Deskripsi Usaha
                            <span class="required">*</span>
                        </label>
                        <textarea name="deskripsi" rows="5" required
                                  class="form-textarea @error('deskripsi') is-invalid @enderror"
                                  placeholder="Ceritakan tentang usaha Anda, produk unggulan, keistimewaan, dll.">{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-400 mt-1">* Tulis deskripsi yang menarik untuk menarik minat pelanggan</p>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <a href="{{ route('umkm.index') }}" class="btn-cancel">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- TUTORIAL SECTION PREMIUM --}}
    {{-- ============================================== --}}
    <div class="tutorial-section animate__animated animate__fadeInUp">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Panduan Mengedit UMKM</h3>
        </div>
        
        <p class="tutorial-intro" style="font-size: 0.8rem; color: var(--gray); margin-bottom: 1rem; line-height: 1.5;">
            Halaman <strong>Edit UMKM</strong> memungkinkan Anda untuk memperbarui informasi usaha Anda 
            agar tetap relevan dan menarik bagi pelanggan.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📝 Update Informasi Dasar</h4>
                    <p>Perbarui nama usaha, kategori, dan deskripsi untuk mencerminkan bisnis terkini.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>📍 Perbarui Lokasi</h4>
                    <p>Pastikan alamat usaha Anda selalu terbaru agar pelanggan mudah menemukan lokasi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>📞 Update Kontak</h4>
                    <p>Perbarui nomor telepon/WhatsApp agar pelanggan dapat menghubungi Anda.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>💡 Tips Deskripsi</h4>
                    <p>Tulis deskripsi yang menarik, informatif, dan menunjukkan keunikan produk Anda.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>🖼️ Foto Usaha</h4>
                    <p>Gambar logo yang menarik akan meningkatkan kepercayaan pelanggan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>✅ Simpan Perubahan</h4>
                    <p>Jangan lupa klik tombol "Simpan Perubahan" agar data Anda tersimpan.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Update informasi usaha secara berkala agar pelanggan selalu mendapatkan informasi terbaru tentang bisnis Anda.</span>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Form validation before submit
        const form = document.getElementById('editForm');
        const submitBtn = document.getElementById('submitBtn');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                let isValid = true;
                const requiredFields = form.querySelectorAll('[required]');
                
                requiredFields.forEach(field => {
                    if (!field.value.trim()) {
                        isValid = false;
                        field.classList.add('error');
                        field.style.borderColor = '#ef4444';
                        
                        // Add error message if not exists
                        let errorMsg = field.parentElement.querySelector('.error-message');
                        if (!errorMsg) {
                            errorMsg = document.createElement('p');
                            errorMsg.className = 'error-message';
                            errorMsg.style.cssText = 'color: #ef4444; font-size: 0.7rem; margin-top: 0.3rem;';
                            errorMsg.innerText = 'Field ini wajib diisi';
                            field.parentElement.appendChild(errorMsg);
                        }
                        
                        // Remove error on input
                        field.addEventListener('input', function() {
                            this.classList.remove('error');
                            this.style.borderColor = '';
                            const msg = this.parentElement.querySelector('.error-message');
                            if (msg) msg.remove();
                        });
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    // Scroll to first error
                    const firstError = form.querySelector('.error');
                    if (firstError) {
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        firstError.focus();
                    }
                    
                    // Show toast error
                    showToast('⚠️ Mohon lengkapi semua field yang wajib diisi', 'error');
                } else {
                    // Show loading state
                    submitBtn.disabled = true;
                    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
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
                if (title.includes('Informasi Dasar')) {
                    const namaField = document.querySelector('input[name="nama_usaha"]');
                    if (namaField) {
                        namaField.focus();
                        namaField.style.boxShadow = '0 0 0 3px rgba(16,185,129,0.2)';
                        setTimeout(() => {
                            namaField.style.boxShadow = '';
                        }, 2000);
                    }
                } else if (title.includes('Lokasi')) {
                    const alamatField = document.querySelector('textarea[name="alamat_usaha"]');
                    if (alamatField) {
                        alamatField.focus();
                        alamatField.style.boxShadow = '0 0 0 3px rgba(16,185,129,0.2)';
                        setTimeout(() => {
                            alamatField.style.boxShadow = '';
                        }, 2000);
                    }
                } else if (title.includes('Kontak')) {
                    const telpField = document.querySelector('input[name="no_telepon"]');
                    if (telpField) {
                        telpField.focus();
                        telpField.style.boxShadow = '0 0 0 3px rgba(16,185,129,0.2)';
                        setTimeout(() => {
                            telpField.style.boxShadow = '';
                        }, 2000);
                    }
                } else if (title.includes('Deskripsi')) {
                    const descField = document.querySelector('textarea[name="deskripsi"]');
                    if (descField) {
                        descField.focus();
                        descField.style.boxShadow = '0 0 0 3px rgba(16,185,129,0.2)';
                        setTimeout(() => {
                            descField.style.boxShadow = '';
                        }, 2000);
                    }
                }
                
                showToast(`💡 ${title} - ${description.substring(0, 60)}...`, 'info');
            });
        });
        
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
        
        // Auto close alerts
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
    });
</script>

<style>
    /* Additional styles for form validation */
    .is-invalid {
        border-color: #ef4444 !important;
    }
    
    .error {
        border-color: #ef4444 !important;
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
    
    /* Smooth transitions for form inputs */
    .form-input, .form-select, .form-textarea {
        transition: all 0.3s ease;
    }
    
    /* Disabled button style */
    .btn-submit:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }
</style>
@endsection