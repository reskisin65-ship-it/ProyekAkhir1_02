@extends('layouts.admin')

@section('title', 'Detail Pengajuan Surat - Lumban Silintong')

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
        --orange: #f59e0b;
        --green: #10b981;
        --purple: #8b5cf6;
        --red: #ef4444;
        --teal: #14b8a6;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Glass Container */
    .glass-container {
        max-width: 1300px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Glass Card Base - Putih Bersih */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 32px;
        box-shadow: var(--glass-shadow);
        transition: var(--transition);
    }

    .glass-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
    }

    /* Back Button */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.7rem 1.2rem;
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        color: #1e293b;
        font-size: 0.85rem;
        font-weight: 600;
        transition: var(--transition);
        margin-bottom: 1.8rem;
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
        margin-bottom: 2rem;
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
        font-size: 2.5rem;
        font-weight: 400;
        line-height: 1.2;
        color: #0f172a;
    }

    .page-title span {
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.2rem;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        backdrop-filter: blur(8px);
    }

    .status-menunggu { background: rgba(245,158,11,0.1); color: #d97706; border: 1px solid rgba(245,158,11,0.2); }
    .status-diproses { background: rgba(59,130,246,0.1); color: #2563eb; border: 1px solid rgba(59,130,246,0.2); }
    .status-selesai { background: rgba(16,185,129,0.1); color: #059669; border: 1px solid rgba(16,185,129,0.2); }
    .status-ditolak { background: rgba(239,68,68,0.1); color: #dc2626; border: 1px solid rgba(239,68,68,0.2); }

    /* Alert */
    .alert-glass {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.2rem;
        border-radius: 24px;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(16px);
        animation: slideIn 0.4s ease;
    }

    .alert-success { background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.15); }
    .alert-error { background: rgba(239,68,68,0.08); border: 1px solid rgba(239,68,68,0.15); }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* 2 Column Layout */
    .two-columns {
        display: grid;
        grid-template-columns: 1.6fr 1fr;
        gap: 1.5rem;
    }

    /* Card Header */
    .card-header {
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .card-header-icon {
        width: 40px;
        height: 40px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(59,130,246,0.08);
    }

    .card-header h3 {
        font-size: 1rem;
        font-weight: 700;
        color: #1e293b;
    }

    /* Info Grid */
    .info-grid {
        padding: 1.2rem 1.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .info-label {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94a3b8;
        font-weight: 600;
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: #1e293b;
        word-break: break-word;
    }

    .info-value code {
        background: #f1f5f9;
        padding: 0.2rem 0.5rem;
        border-radius: 10px;
        font-size: 0.8rem;
        font-family: monospace;
    }

    .full-width {
        grid-column: span 2;
    }

    /* Download Link */
    .download-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--green);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.85rem;
        transition: var(--transition);
    }

    .download-link:hover {
        gap: 0.8rem;
        color: #059669;
    }

    /* Rejection Note */
    .rejection-note {
        margin: 1rem 1.5rem 1.5rem;
        padding: 1rem;
        background: rgba(239,68,68,0.05);
        border-radius: 20px;
        border-left: 4px solid #ef4444;
    }

    /* Action Buttons */
    .action-buttons {
        padding: 1.2rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }

    .btn-glass {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.6rem;
        width: 100%;
        padding: 0.9rem;
        border-radius: 24px;
        font-weight: 700;
        font-size: 0.85rem;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        transition: var(--transition);
        cursor: pointer;
        border: none;
    }

    .btn-success { background: linear-gradient(135deg, #10b981, #059669); color: white; box-shadow: 0 4px 12px rgba(16,185,129,0.2); }
    .btn-success:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(16,185,129,0.3); gap: 0.9rem; }

    .btn-danger { background: linear-gradient(135deg, #ef4444, #dc2626); color: white; box-shadow: 0 4px 12px rgba(239,68,68,0.2); }
    .btn-danger:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(239,68,68,0.3); gap: 0.9rem; }

    .btn-primary { background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; box-shadow: 0 4px 12px rgba(59,130,246,0.2); }
    .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 10px 25px rgba(59,130,246,0.3); gap: 0.9rem; }

    .btn-outline-glass {
        background: transparent;
        border: 1.5px solid #e2e8f0;
        color: #64748b;
    }

    .btn-outline-glass:hover {
        background: white;
        border-color: var(--blue);
        color: var(--blue);
        transform: translateY(-3px);
    }

    /* Timeline */
    .timeline {
        padding: 1.2rem 1.5rem 1.5rem;
    }

    .timeline-step {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.2rem;
        position: relative;
    }

    .timeline-step:not(:last-child)::before {
        content: '';
        position: absolute;
        left: 18px;
        top: 40px;
        width: 2px;
        height: calc(100% - 20px);
        background: linear-gradient(to bottom, #e2e8f0, transparent);
    }

    .timeline-icon {
        width: 38px;
        height: 38px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: var(--transition);
    }

    .timeline-icon.active { background: linear-gradient(135deg, var(--green), #059669); color: white; box-shadow: 0 4px 12px rgba(16,185,129,0.2); }
    .timeline-icon.inactive { background: #f1f5f9; color: #cbd5e1; }

    .timeline-content h4 { font-weight: 700; font-size: 0.85rem; margin-bottom: 0.2rem; color: #1e293b; }
    .timeline-content p { font-size: 0.7rem; color: #94a3b8; }

    /* Modal Glass - Putih */
    .modal-glass {
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    .modal-content {
        background: white;
        border-radius: 40px;
        max-width: 480px;
        width: 90%;
        padding: 1.8rem;
        border: 1px solid rgba(0,0,0,0.05);
        animation: modalSlide 0.4s ease;
        box-shadow: 0 25px 50px -12px rgba(0,0,0,0.15);
    }

    @keyframes modalSlide {
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    /* File Input */
    .file-input-glass {
        width: 100%;
        padding: 0.8rem;
        border: 2px dashed #e2e8f0;
        border-radius: 20px;
        background: #f8fafc;
        transition: var(--transition);
    }

    .file-input-glass:focus {
        border-color: var(--blue);
        outline: none;
        background: white;
    }

    /* Responsive */
    @media (max-width: 900px) {
        .two-columns { grid-template-columns: 1fr; }
        .glass-container { padding: 1rem; }
        .info-grid { grid-template-columns: 1fr; }
        .full-width { grid-column: span 1; }
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
    .delay-4 { animation-delay: 0.2s; }
</style>

<div class="glass-container">
    
    <!-- Back Button -->
    <a href="{{ route('admin.pengajuan-surat.index') }}" class="back-btn fade-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
    </a>

    <!-- Page Header -->
    <div class="page-header fade-up delay-1">
        <div class="flex justify-between items-start flex-wrap gap-4">
            <div>
                <div class="page-badge">DETAIL PENGAJUAN</div>
                <h1 class="page-title">Informasi <span>Surat</span></h1>
            </div>
            <div class="status-badge status-{{ $pengajuan->status }}">
                @if($pengajuan->status == 'menunggu') <i class="fa-regular fa-clock"></i>
                @elseif($pengajuan->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i>
                @elseif($pengajuan->status == 'selesai') <i class="fa-regular fa-circle-check"></i>
                @else <i class="fa-regular fa-circle-xmark"></i> @endif
                {{ ucfirst($pengajuan->status) }}
            </div>
        </div>
    </div>

    <!-- Alerts -->
    @if(session('success'))
    <div class="alert-glass alert-success fade-up delay-2">
        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
            <i class="fa-solid fa-check text-sm"></i>
        </div>
        <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-glass alert-error fade-up delay-2">
        <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center text-white">
            <i class="fa-solid fa-xmark text-sm"></i>
        </div>
        <p class="text-red-700 font-medium">{{ session('error') }}</p>
    </div>
    @endif

    <!-- Main Content -->
    <div class="two-columns">
        
        <!-- LEFT COLUMN -->
        <div class="fade-up delay-3">
            <!-- Informasi Pemohon -->
            <div class="glass-card">
                <div class="card-header">
                    <div class="card-header-icon" style="background: rgba(59,130,246,0.1);">
                        <i class="fa-regular fa-user" style="color: #3b82f6;"></i>
                    </div>
                    <h3>Informasi Pemohon</h3>
                </div>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value">{{ $pengajuan->user->name ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Email</span>
                        <span class="info-value">{{ $pengajuan->user->email ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nomor Telepon</span>
                        <span class="info-value">{{ $pengajuan->user->nomor_telepon ?? '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">NIK</span>
                        <span class="info-value"><code>{{ $pengajuan->nik }}</code></span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Lahir</span>
                        <span class="info-value">{{ $pengajuan->tanggal_lahir ? \Carbon\Carbon::parse($pengajuan->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tanggal Pengajuan</span>
                        <span class="info-value">{{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}</span>
                    </div>
                    <div class="info-item full-width">
                        <span class="info-label">Alamat</span>
                        <span class="info-value">{{ $pengajuan->alamat ?? '-' }}</span>
                    </div>
                </div>
            </div>

            <!-- Informasi Surat -->
            <div class="glass-card" style="margin-top: 1.5rem;">
                <div class="card-header">
                    <div class="card-header-icon" style="background: rgba(16,185,129,0.1);">
                        <i class="fa-regular fa-file-lines" style="color: #10b981;"></i>
                    </div>
                    <h3>Informasi Surat</h3>
                </div>
                <div class="info-grid">
                    <div class="info-item full-width">
                        <span class="info-label">Jenis Surat</span>
                        <span class="info-value font-semibold">{{ $pengajuan->jenis_surat }}</span>
                    </div>
                    <div class="info-item full-width">
                        <span class="info-label">Keperluan</span>
                        <span class="info-value">{{ $pengajuan->keperluan }}</span>
                    </div>
                    @if($pengajuan->keterangan)
                    <div class="info-item full-width">
                        <span class="info-label">Keterangan</span>
                        <span class="info-value">{{ $pengajuan->keterangan }}</span>
                    </div>
                    @endif
                    @if($pengajuan->berkas_pendukung)
                    <div class="info-item full-width">
                        <span class="info-label">Berkas Pendukung</span>
                        <span class="info-value">
                            <a href="{{ route('admin.pengajuan-surat.download-pendukung', $pengajuan->id_surat) }}" class="download-link">
                                <i class="fa-solid fa-download"></i> Download File
                            </a>
                        </span>
                    </div>
                    @endif
                </div>

                @if($pengajuan->catatan_penolakan)
                <div class="rejection-note">
                    <div class="flex items-center gap-2 mb-2">
                        <i class="fa-solid fa-circle-exclamation text-red-500"></i>
                        <span class="text-sm font-semibold text-red-700">Catatan Penolakan</span>
                    </div>
                    <p class="text-sm text-red-600">{{ $pengajuan->catatan_penolakan }}</p>
                </div>
                @endif
            </div>
        </div>

        <!-- RIGHT COLUMN -->
        <div class="fade-up delay-4">
            <!-- Action Buttons -->
            <div class="glass-card">
                <div class="card-header">
                    <div class="card-header-icon" style="background: rgba(139,92,246,0.1);">
                        <i class="fa-solid fa-bolt" style="color: #8b5cf6;"></i>
                    </div>
                    <h3>Tindakan</h3>
                </div>
                <div class="action-buttons">
                    @if($pengajuan->status == 'menunggu')
                    <form action="{{ route('admin.pengajuan-surat.approve', $pengajuan->id_surat) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-glass btn-success">
                            <i class="fa-regular fa-circle-check"></i> Terima & Proses
                        </button>
                    </form>
                    <button onclick="openTolakModal()" class="btn-glass btn-danger">
                        <i class="fa-regular fa-circle-xmark"></i> Tolak Pengajuan
                    </button>
                    @endif
                    
                    @if($pengajuan->status == 'diproses')
                    <button onclick="openUploadModal()" class="btn-glass btn-primary">
                        <i class="fa-solid fa-upload"></i> Upload Surat Selesai
                    </button>
                    @endif
                    
                    @if($pengajuan->status == 'selesai' && $pengajuan->file_surat)
                    <a href="{{ route('admin.pengajuan-surat.download-surat', $pengajuan->id_surat) }}" class="btn-glass btn-success">
                        <i class="fa-solid fa-download"></i> Download Surat PDF
                    </a>
                    @endif

                    <a href="{{ route('admin.pengajuan-surat.index') }}" class="btn-glass btn-outline-glass">
                        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
            </div>

            <!-- Timeline Status -->
            <div class="glass-card" style="margin-top: 1.5rem;">
                <div class="card-header">
                    <div class="card-header-icon" style="background: rgba(245,158,11,0.1);">
                        <i class="fa-regular fa-calendar" style="color: #f59e0b;"></i>
                    </div>
                    <h3>Status Perkembangan</h3>
                </div>
                <div class="timeline">
                    <div class="timeline-step">
                        <div class="timeline-icon {{ in_array($pengajuan->status, ['menunggu', 'diproses', 'selesai']) ? 'active' : 'inactive' }}">
                            <i class="fa-regular fa-paper-plane text-sm"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Pengajuan Dikirim</h4>
                            <p>{{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-icon {{ in_array($pengajuan->status, ['diproses', 'selesai']) ? 'active' : 'inactive' }}">
                            <i class="fa-regular fa-clock text-sm"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Diproses Admin</h4>
                            <p>{{ $pengajuan->status == 'diproses' ? 'Sedang diproses' : ($pengajuan->status == 'selesai' ? 'Selesai diproses' : 'Belum diproses') }}</p>
                        </div>
                    </div>
                    <div class="timeline-step">
                        <div class="timeline-icon {{ $pengajuan->status == 'selesai' ? 'active' : 'inactive' }}">
                            <i class="fa-regular fa-circle-check text-sm"></i>
                        </div>
                        <div class="timeline-content">
                            <h4>Surat Selesai</h4>
                            <p>{{ $pengajuan->file_surat ? 'File sudah diunggah' : 'Belum ada file' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tolak -->
<div id="tolakModal" class="modal-glass">
    <div class="modal-content">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fa-regular fa-circle-xmark text-red-500 text-lg"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800">Tolak Pengajuan</h3>
            </div>
            <button onclick="closeTolakModal()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                <i class="fa-solid fa-times text-gray-500"></i>
            </button>
        </div>
        <form action="{{ route('admin.pengajuan-surat.reject', $pengajuan->id_surat) }}" method="POST">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan</label>
                <textarea name="catatan" rows="4" class="w-full border border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent transition" placeholder="Masukkan alasan penolakan..." required></textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 btn-glass btn-danger">Tolak</button>
                <button type="button" onclick="closeTolakModal()" class="flex-1 btn-glass btn-outline-glass">Batal</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Upload -->
<div id="uploadModal" class="modal-glass">
    <div class="modal-content">
        <div class="flex justify-between items-center mb-5">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                    <i class="fa-solid fa-upload text-emerald-500 text-lg"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800">Upload Surat Selesai</h3>
            </div>
            <button onclick="closeUploadModal()" class="w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 transition">
                <i class="fa-solid fa-times text-gray-500"></i>
            </button>
        </div>
        <form action="{{ route('admin.pengajuan-surat.complete', $pengajuan->id_surat) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">File Surat (PDF)</label>
                <input type="file" name="file_surat" accept=".pdf" class="file-input-glass" required>
                <p class="text-xs text-gray-400 mt-2">Maksimal 2MB, format PDF</p>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 btn-glass btn-primary">Upload</button>
                <button type="button" onclick="closeUploadModal()" class="flex-1 btn-glass btn-outline-glass">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTolakModal() {
        document.getElementById('tolakModal').style.display = 'flex';
    }
    function closeTolakModal() {
        document.getElementById('tolakModal').style.display = 'none';
    }
    function openUploadModal() {
        document.getElementById('uploadModal').style.display = 'flex';
    }
    function closeUploadModal() {
        document.getElementById('uploadModal').style.display = 'none';
    }
    // Close modal when clicking outside
    window.onclick = function(event) {
        const tolakModal = document.getElementById('tolakModal');
        const uploadModal = document.getElementById('uploadModal');
        if (event.target === tolakModal) closeTolakModal();
        if (event.target === uploadModal) closeUploadModal();
    }
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection