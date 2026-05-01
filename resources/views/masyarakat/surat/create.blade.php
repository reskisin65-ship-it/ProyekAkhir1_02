{{-- resources/views/masyarakat/surat/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Ajukan Surat - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --system-bg: #0a0a0a;
        --card-bg: #ffffff;
        --accent-primary: #10b981;
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

    /* Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    /* Info Card */
    .info-card {
        margin-top: 1.5rem;
        padding: 1rem;
        background: #f8fafc;
        border-left: 3px solid var(--accent-primary);
        border-radius: 16px;
    }

    .info-card h4 {
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .info-card ul {
        font-size: 0.7rem;
        color: var(--text-mute);
        list-style: none;
        padding-left: 1.2rem;
    }

    .info-card li {
        margin-bottom: 0.2rem;
        position: relative;
    }

    .info-card li::before {
        content: '•';
        position: absolute;
        left: -0.8rem;
        color: var(--accent-primary);
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
    @media (max-width: 768px) {
        .dashboard-wrapper { padding: 1rem; }
        .form-body { padding: 1.2rem; }
        .form-header { padding: 1rem 1.2rem; }
        .form-header h1 { font-size: 1.2rem; }
        .form-grid { grid-template-columns: 1fr; }
        .action-buttons { flex-direction: column; }
        .btn-primary, .btn-secondary { justify-content: center; }
    }
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Back Button --}}
    <a href="{{ route('masyarakat.surat.index') }}" class="back-link animate-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Riwayat Surat
    </a>

    {{-- Form Card --}}
    <div class="form-card animate-up delay-1">
        <div class="form-header">
            <h1>
                <i class="fa-solid fa-file-pen"></i>
                Ajukan Surat Baru
            </h1>
            <p>Isi formulir pengajuan surat dengan data yang benar</p>
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

            <form action="{{ route('masyarakat.surat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                {{-- Jenis Surat --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-file"></i> Jenis Surat <span class="required">*</span>
                    </label>
                    <select name="jenis_surat" class="form-control" required>
                        <option value="">Pilih Jenis Surat</option>
                        <option value="Surat Keterangan Domisili" {{ old('jenis_surat') == 'Surat Keterangan Domisili' ? 'selected' : '' }}>📄 Surat Keterangan Domisili</option>
                        <option value="Surat Keterangan Usaha" {{ old('jenis_surat') == 'Surat Keterangan Usaha' ? 'selected' : '' }}>🏪 Surat Keterangan Usaha</option>
                        <option value="Surat Keterangan Tidak Mampu" {{ old('jenis_surat') == 'Surat Keterangan Tidak Mampu' ? 'selected' : '' }}>📑 Surat Keterangan Tidak Mampu</option>
                        <option value="Surat Keterangan Kelahiran" {{ old('jenis_surat') == 'Surat Keterangan Kelahiran' ? 'selected' : '' }}>👶 Surat Keterangan Kelahiran</option>
                        <option value="Surat Keterangan Kematian" {{ old('jenis_surat') == 'Surat Keterangan Kematian' ? 'selected' : '' }}>⚰️ Surat Keterangan Kematian</option>
                        <option value="Surat Pengantar SKCK" {{ old('jenis_surat') == 'Surat Pengantar SKCK' ? 'selected' : '' }}>🛂 Surat Pengantar SKCK</option>
                    </select>
                </div>
                
                {{-- Data Diri Grid --}}
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-user"></i> Nama Lengkap <span class="required">*</span></label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->name ?? '') }}" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-id-card"></i> NIK <span class="required">*</span></label>
                        <input type="text" name="nik" value="{{ old('nik') }}" class="form-control" maxlength="16" required>
                        <p class="text-xs text-gray-400 mt-1">16 digit angka (sesuai KTP)</p>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-location-dot"></i> Tempat Lahir <span class="required">*</span></label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-calendar"></i> Tanggal Lahir <span class="required">*</span></label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-phone"></i> Nomor Telepon <span class="required">*</span></label>
                        <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon', Auth::user()->nomor_telepon ?? '') }}" class="form-control" required>
                    </div>
                </div>
                
                {{-- Keperluan --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-bullhorn"></i> Keperluan <span class="required">*</span>
                    </label>
                    <textarea name="keperluan" rows="3" class="form-control" placeholder="Contoh: Untuk melamar pekerjaan di PT. Maju Bersama" required>{{ old('keperluan') }}</textarea>
                </div>
                
                {{-- Keterangan Tambahan --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-note-sticky"></i> Keterangan Tambahan
                    </label>
                    <textarea name="keterangan" rows="2" class="form-control" placeholder="Informasi tambahan jika diperlukan">{{ old('keterangan') }}</textarea>
                </div>
                
                {{-- File Pendukung --}}
                <div class="form-group">
                    <label class="form-label">
                        <i class="fa-regular fa-paperclip"></i> File Pendukung
                    </label>
                    <input type="file" name="berkas_pendukung" accept=".jpg,.jpeg,.png,.pdf" class="form-control">
                    <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG, PDF. Maks: 2MB</p>
                </div>
                
                {{-- Action Buttons --}}
                <div class="action-buttons">
                    <a href="{{ route('masyarakat.surat.index') }}" class="btn-secondary">
                        <i class="fa-solid fa-times"></i> Batal
                    </a>
                    <button type="submit" class="btn-primary">
                        <i class="fa-regular fa-paper-plane"></i> Kirim Pengajuan
                    </button>
                </div>
            </form>

            {{-- ============================================ --}}
{{-- TUTORIAL - Halaman Tambah Pengajuan Surat --}}
{{-- ============================================ --}}
<div class="tutorial-section animate-up delay-4" style="margin-top: 2rem; background: linear-gradient(135deg, #f8fafc, #ffffff); border-radius: 24px; padding: 1.8rem; border: 1px solid var(--border-color); transition: all 0.3s;">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 0.8rem;">
        <i class="fa-regular fa-circle-question" style="font-size: 1.5rem; color: var(--accent-primary);"></i>
        <h3 style="font-size: 1rem; font-weight: 700; margin: 0; color: var(--accent-primary);">📋 Tentang Halaman Ini</h3>
    </div>
    
    <p style="font-size: 0.85rem; color: #475569; margin-bottom: 1.2rem; line-height: 1.6;">
        Halaman <strong>Tambah Pengajuan Surat</strong> digunakan untuk mengajukan surat keterangan secara online. 
        Isi formulir di bawah dengan data yang <strong>benar dan sesuai dokumen asli</strong>. Pengajuan yang tidak sesuai akan ditolak.
    </p>
    
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); gap: 1rem; margin-bottom: 1.2rem;">
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span style="font-weight: 800; color: var(--accent-primary);">1</span>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">📋 Pilih Jenis Surat</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Pilih jenis surat yang sesuai dengan kebutuhan Anda (Domisili, Usaha, SKCK, Kelahiran, Kematian, dll).</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span style="font-weight: 800; color: var(--accent-primary);">2</span>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">🆔 Isi Data Diri</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Masukkan NIK (16 digit), nama lengkap, tempat lahir, tanggal lahir, dan nomor telepon aktif.</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span style="font-weight: 800; color: var(--accent-primary);">3</span>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">📝 Jelaskan Keperluan</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Tuliskan tujuan pengajuan surat secara jelas dan detail (contoh: untuk melamar pekerjaan, keperluan administrasi, dll).</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #ecfdf5; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <span style="font-weight: 800; color: var(--accent-primary);">4</span>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">📎 Upload Dokumen</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Lampirkan file pendukung seperti scan KTP, KK, atau dokumen lain (format PDF/JPG/PNG, maks 2MB).</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #fef3c7; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-regular fa-lightbulb" style="font-size: 0.8rem; color: #d97706;"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">💡 Tips Penting</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Pastikan semua data sesuai dengan KTP/dokumen asli untuk menghindari penolakan dari admin.</p>
            </div>
        </div>
        <div style="display: flex; gap: 0.8rem; padding: 0.6rem; border-radius: 16px; transition: all 0.2s;">
            <div style="width: 32px; height: 32px; background: #dbeafe; border-radius: 10px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                <i class="fa-regular fa-bell" style="font-size: 0.8rem; color: #2563eb;"></i>
            </div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.8rem; margin-bottom: 0.2rem;">⏱️ Waktu Proses</h4>
                <p style="font-size: 0.7rem; color: #64748b;">Pengajuan akan diproses dalam 1-3 hari kerja. Pantau status di halaman "Riwayat Pengajuan".</p>
            </div>
        </div>
    </div>
    
    <div style="background: #ecfdf5; border-radius: 16px; padding: 0.8rem 1rem;">
        <p style="font-size: 0.7rem; color: #059669; margin: 0; display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap;">
            <i class="fa-regular fa-circle-check"></i>
            <span><strong>✅ Langkah terakhir:</strong> Klik tombol <strong>"Kirim Pengajuan"</strong> setelah semua data terisi dengan benar.</span>
        </p>
    </div>
</div>

<style>
    .tutorial-section > div > div:hover {
        background: rgba(5, 150, 105, 0.05);
        transform: translateX(4px);
    }
</style>
        </div>
    </div>
</div>
@endsection