{{-- resources/views/admin/kontak-desa/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Kontak - Admin')

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
        background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        opacity: 0.3;
    }

    /* Container Premium */
    .container-premium {
        max-width: 800px;
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
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition-bounce);
    }

    .main-card:hover {
        box-shadow: var(--shadow-xl);
    }

    /* Card Header */
    .card-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        padding: 1.5rem 2rem;
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
        font-size: 1.5rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.2rem;
    }

    .card-header p {
        color: rgba(255,255,255,0.85);
        font-size: 0.8rem;
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
        margin-left: 0.2rem;
    }

    .form-input {
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

    .form-input:focus {
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-soft);
        background: white;
    }

    select.form-input {
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 1rem;
    }

    /* File Upload Area */
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

    /* Current Photo */
    .current-photo {
        background: var(--gray-soft);
        border-radius: 20px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .current-photo img {
        width: 60px;
        height: 60px;
        border-radius: 16px;
        object-fit: cover;
        box-shadow: var(--shadow-sm);
    }

    .current-photo p {
        font-size: 0.75rem;
        color: var(--gray);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .btn-submit {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        padding: 0.9rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: white;
        transition: var(--transition-bounce);
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .btn-cancel {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        padding: 0.9rem;
        background: white;
        border: 1.5px solid var(--border);
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .btn-cancel:hover {
        border-color: var(--gray);
        color: var(--dark);
        transform: translateY(-3px);
    }

    /* Alert */
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

    .alert-success {
        background: #ecfdf5;
        border-left: 3px solid var(--primary);
        color: #059669;
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

    .tutorial-header i {
        font-size: 1.3rem;
        color: var(--primary);
    }

    .tutorial-header h3 {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        color: var(--dark);
    }

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
        background: var(--gray-soft);
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
        transition: transform 0.3s ease;
    }

    .tutorial-item:hover .tutorial-num {
        transform: scale(1.1);
    }

    .tutorial-text h4 {
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 0.1rem;
        color: var(--dark);
    }

    .tutorial-text p {
        font-size: 0.65rem;
        color: var(--gray);
        line-height: 1.4;
    }

    .tutorial-footer {
        margin-top: 0.8rem;
        padding: 0.6rem 0.8rem;
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
        .card-header { padding: 1rem 1.5rem; }
        .card-header h1 { font-size: 1.3rem; }
        .card-body { padding: 1.5rem; }
        .action-buttons { flex-direction: column; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .current-photo { flex-direction: column; text-align: center; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- Back Button --}}
    <a href="{{ route('admin.kontak-desa.index') }}" class="back-button animate__animated animate__fadeIn">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Kontak
    </a>

    {{-- Alert Errors --}}
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

    {{-- Main Card --}}
    <div class="main-card animate__animated animate__fadeInUp">
        <div class="card-header">
            <h1>✏️ Edit Kontak</h1>
            <p>Perbarui data kontak perangkat desa</p>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.kontak-desa.update', $kontak->id) }}" method="POST" enctype="multipart/form-data" id="contactForm">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-user"></i> Nama Lengkap
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="nama" required class="form-input" placeholder="Contoh: Jonatan Sitorus, S.Sos" value="{{ old('nama', $kontak->nama) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-briefcase"></i> Jabatan
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="jabatan" required class="form-input" placeholder="Contoh: Kepala Desa" value="{{ old('jabatan', $kontak->jabatan) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-tag"></i> Bidang Tugas
                    </label>
                    <input type="text" name="bidang" class="form-input" placeholder="Contoh: Pimpinan tertinggi desa" value="{{ old('bidang', $kontak->bidang) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-brands fa-whatsapp"></i> Nomor WhatsApp
                        <span class="required">*</span>
                    </label>
                    <input type="text" name="no_hp" required class="form-input" placeholder="6281234567890" value="{{ old('no_hp', $kontak->no_hp) }}">
                    <p class="text-xs text-gray-400 mt-1">Gunakan format 628xxxxxxxxx (tanpa tanda + atau 0 di depan)</p>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-envelope"></i> Email
                    </label>
                    <input type="email" name="email" class="form-input" placeholder="contoh@email.com" value="{{ old('email', $kontak->email) }}">
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-arrow-up-wide-short"></i> Urutan Tampil
                    </label>
                    <input type="number" name="urutan" value="{{ old('urutan', $kontak->urutan) }}" class="form-input" placeholder="0">
                    <p class="text-xs text-gray-400 mt-1">Semakin kecil angka, semakin atas tampilannya di halaman publik</p>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-solid fa-toggle-on"></i> Status
                    </label>
                    <select name="is_active" class="form-input">
                        <option value="1" {{ $kontak->is_active ? 'selected' : '' }}>✅ Aktif - Tampil di Halaman Publik</option>
                        <option value="0" {{ !$kontak->is_active ? 'selected' : '' }}>⏸️ Tidak Aktif - Tersembunyi</option>
                    </select>
                </div>

                {{-- Current Photo --}}
                @if($kontak->foto)
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-image"></i> Foto Saat Ini
                    </label>
                    <div class="current-photo">
                        <img src="{{ asset('storage/'.$kontak->foto) }}" alt="{{ $kontak->nama }}">
                        <div>
                            <p><i class="fa-regular fa-circle-check text-emerald-500"></i> Foto sudah terupload</p>
                            <p class="text-xs">Upload foto baru jika ingin mengganti</p>
                        </div>
                    </div>
                </div>
                @endif

                {{-- Upload New Photo --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-image"></i> Ganti Foto (Opsional)
                    </label>
                    <div class="upload-area" onclick="document.getElementById('foto_input').click()">
                        <div class="upload-icon">
                            <i class="fa-solid fa-cloud-arrow-up"></i>
                        </div>
                        <div class="upload-title">Klik untuk upload foto baru</div>
                        <div class="upload-hint">Format: JPG, PNG. Maks: 2MB</div>
                        <input type="file" name="foto" id="foto_input" accept="image/*" class="file-input" onchange="updateFileName()">
                        <div id="file_name" class="file-name"></div>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="{{ route('admin.kontak-desa.index') }}" class="btn-cancel">
                        <i class="fa-solid fa-xmark"></i> Batal
                    </a>
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="fa-regular fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tutorial Section --}}
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Panduan Mengedit Kontak</h3>
        </div>
        
        <p class="tutorial-intro">
            Halaman ini digunakan untuk mengedit data kontak perangkat desa yang sudah ada. 
            Perubahan akan langsung tampil di halaman kontak publik.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📝 Edit Data</h4>
                    <p>Perbarui nama, jabatan, atau bidang tugas jika diperlukan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>📱 Update Nomor</h4>
                    <p>Pastikan nomor WhatsApp selalu valid dan aktif.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>🖼️ Ganti Foto</h4>
                    <p>Upload foto baru untuk mengganti foto lama (opsional).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>🔘 Atur Status</h4>
                    <p>Gunakan status "Aktif" atau "Tidak Aktif" untuk kontrol tampil.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>💾 Simpan</h4>
                    <p>Klik tombol "Simpan Perubahan" untuk menyimpan data.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>💡 Tips</h4>
                    <p>Periksa kembali data sebelum menyimpan.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Setiap perubahan data akan langsung terlihat di halaman kontak publik. Pastikan data yang diupdate sudah benar.</span>
        </div>
    </div>

</div>

<script>
    // File name display function
    function updateFileName() {
        const input = document.getElementById('foto_input');
        const display = document.getElementById('file_name');
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const fileSize = (input.files[0].size / 1024).toFixed(2);
            display.innerHTML = `<i class="fa-regular fa-circle-check"></i> File baru: ${fileName} (${fileSize} KB)`;
            display.style.color = '#10b981';
        } else {
            display.innerHTML = '';
        }
    }

    // Form validation before submit
    const form = document.getElementById('contactForm');
    const submitBtn = document.getElementById('submitBtn');

    if (form) {
        form.addEventListener('submit', function(e) {
            let isValid = true;
            const requiredFields = form.querySelectorAll('[required]');
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = '#ef4444';
                    
                    let errorMsg = field.parentElement.querySelector('.error-message');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'error-message';
                        errorMsg.style.cssText = 'color: #ef4444; font-size: 0.7rem; margin-top: 0.3rem;';
                        errorMsg.innerHTML = '<i class="fa-solid fa-circle-exclamation mr-1"></i> Field ini wajib diisi';
                        field.parentElement.appendChild(errorMsg);
                    }
                    
                    field.addEventListener('input', function() {
                        this.style.borderColor = '';
                        const msg = this.parentElement.querySelector('.error-message');
                        if (msg) msg.remove();
                    });
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                const firstError = form.querySelector('[style*="border-color: rgb(239, 68, 68)"]');
                if (firstError) firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Menyimpan...';
            }
        });
    }

    // Auto close alerts after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert-premium').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(20px)';
            setTimeout(() => alert.remove(), 300);
        });
    }, 4000);

    // Tutorial items interactive
    document.querySelectorAll('.tutorial-item').forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => { this.style.transform = ''; }, 200);
        });
    });
</script>
@endsection