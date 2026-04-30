@extends('layouts.admin')

@section('title', 'Edit Data Penduduk - Lumban Silintong')

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
    }

    body {
        background: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Container */
    .premium-container {
        max-width: 900px;
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

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.2rem;
    }

    .form-field {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .form-field-full {
        grid-column: span 2;
    }

    .form-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .form-label i {
        font-size: 0.7rem;
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

    textarea.input-glass {
        resize: vertical;
        min-height: 80px;
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

    /* Responsive */
    @media (max-width: 768px) {
        .premium-container { padding: 1rem; }
        .form-card { padding: 1.2rem; }
        .form-grid { grid-template-columns: 1fr; gap: 1rem; }
        .form-field-full { grid-column: span 1; }
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
    <a href="{{ route('admin.penduduk.index') }}" class="back-btn fade-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Penduduk
    </a>

    <!-- Page Header -->
    <div class="page-header fade-up delay-1">
        <div class="page-badge">FORM EDIT</div>
        <h1 class="page-title">Edit <span>Data Penduduk</span></h1>
    </div>

    <!-- Info Banner -->
    <div class="info-banner fade-up delay-2">
        <i class="fa-solid fa-pen-to-square text-xl"></i>
        <div>
            <strong>Sedang mengedit data:</strong> {{ $penduduk->nama_lengkap }}
            <span class="text-white/70 text-sm ml-2">| NIK: {{ $penduduk->nik }}</span>
        </div>
    </div>

    <!-- Form Card -->
    <div class="form-card fade-up delay-3">
        <div class="card-title">
            <div class="card-title-icon">
                <i class="fa-regular fa-id-card"></i>
            </div>
            <div>
                <h1>Form Edit Data Penduduk</h1>
                <p>Perbarui informasi kependudukan dengan akurat</p>
            </div>
        </div>

        <form action="{{ route('admin.penduduk.update', $penduduk->id_penduduk) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-grid">
                <!-- NIK -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-regular fa-id-card"></i> NIK
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="nik" value="{{ old('nik', $penduduk->nik) }}" required class="input-glass" maxlength="16" pattern="[0-9]{16}" title="NIK harus 16 digit angka">
                </div>

                <!-- Nama Lengkap -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-regular fa-user"></i> Nama Lengkap
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $penduduk->nama_lengkap) }}" required class="input-glass">
                </div>

                <!-- Jenis Kelamin -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-venus-mars"></i> Jenis Kelamin
                        <span class="required-star">*</span>
                    </label>
                    <select name="jenis_kelamin" required class="input-glass">
                        <option value="L" {{ $penduduk->jenis_kelamin == 'L' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="P" {{ $penduduk->jenis_kelamin == 'P' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                <!-- Tempat Lahir -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-location-dot"></i> Tempat Lahir
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $penduduk->tempat_lahir) }}" required class="input-glass">
                </div>

                <!-- Tanggal Lahir -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-regular fa-calendar"></i> Tanggal Lahir
                        <span class="required-star">*</span>
                    </label>
                    <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $penduduk->tanggal_lahir->format('Y-m-d')) }}" required class="input-glass">
                </div>

                <!-- Agama -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-church"></i> Agama
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="agama" value="{{ old('agama', $penduduk->agama) }}" required class="input-glass" placeholder="Islam, Kristen, Hindu, Budha, dll">
                </div>

                <!-- Pendidikan -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-graduation-cap"></i> Pendidikan
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="pendidikan" value="{{ old('pendidikan', $penduduk->pendidikan) }}" required class="input-glass" placeholder="SD, SMP, SMA, S1, dll">
                </div>

                <!-- Pekerjaan -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-briefcase"></i> Pekerjaan
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="pekerjaan" value="{{ old('pekerjaan', $penduduk->pekerjaan) }}" required class="input-glass">
                </div>

                <!-- Status Perkawinan -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-ring"></i> Status Perkawinan
                        <span class="required-star">*</span>
                    </label>
                    <select name="status_perkawinan" required class="input-glass">
                        <option value="Kawin" {{ $penduduk->status_perkawinan == 'Kawin' ? 'selected' : '' }}>Kawin</option>
                        <option value="Belum Kawin" {{ $penduduk->status_perkawinan == 'Belum Kawin' ? 'selected' : '' }}>Belum Kawin</option>
                        <option value="Cerai Hidup" {{ $penduduk->status_perkawinan == 'Cerai Hidup' ? 'selected' : '' }}>Cerai Hidup</option>
                        <option value="Cerai Mati" {{ $penduduk->status_perkawinan == 'Cerai Mati' ? 'selected' : '' }}>Cerai Mati</option>
                    </select>
                </div>

                <!-- Status Keluarga -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-people-group"></i> Status Keluarga
                        <span class="required-star">*</span>
                    </label>
                    <select name="status_keluarga" required class="input-glass">
                        <option value="Kepala Keluarga" {{ $penduduk->status_keluarga == 'Kepala Keluarga' ? 'selected' : '' }}>Kepala Keluarga</option>
                        <option value="Istri" {{ $penduduk->status_keluarga == 'Istri' ? 'selected' : '' }}>Istri</option>
                        <option value="Anak" {{ $penduduk->status_keluarga == 'Anak' ? 'selected' : '' }}>Anak</option>
                        <option value="Lainnya" {{ $penduduk->status_keluarga == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                </div>

                <!-- RT/RW -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-house"></i> RT/RW
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="rt_rw" value="{{ old('rt_rw', $penduduk->rt_rw) }}" required class="input-glass" placeholder="Contoh: 001/002">
                </div>

                <!-- Kelurahan/Desa -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-village"></i> Kelurahan/Desa
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="kelurahan_desa" value="{{ old('kelurahan_desa', $penduduk->kelurahan_desa) }}" required class="input-glass">
                </div>

                <!-- Kecamatan -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-map"></i> Kecamatan
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="kecamatan" value="{{ old('kecamatan', $penduduk->kecamatan) }}" required class="input-glass">
                </div>

                <!-- Kabupaten/Kota -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-city"></i> Kabupaten/Kota
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="kabupaten_kota" value="{{ old('kabupaten_kota', $penduduk->kabupaten_kota) }}" required class="input-glass">
                </div>

                <!-- Provinsi -->
                <div class="form-field">
                    <label class="form-label">
                        <i class="fa-solid fa-map-location-dot"></i> Provinsi
                        <span class="required-star">*</span>
                    </label>
                    <input type="text" name="provinsi" value="{{ old('provinsi', $penduduk->provinsi) }}" required class="input-glass">
                </div>

                <!-- Alamat Lengkap -->
                <div class="form-field form-field-full">
                    <label class="form-label">
                        <i class="fa-solid fa-location-dot"></i> Alamat Lengkap
                        <span class="required-star">*</span>
                    </label>
                    <textarea name="alamat" rows="3" required class="input-glass">{{ old('alamat', $penduduk->alamat) }}</textarea>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <a href="{{ route('admin.penduduk.index') }}" class="btn-cancel">
                    <i class="fa-solid fa-xmark"></i> Batal
                </a>
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-save"></i> Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection