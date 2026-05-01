{{-- resources/views/umkm/status.blade.php --}}
@extends('layouts.app')

@section('title', 'Status Pengajuan UMKM')

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

    .card-header {
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .card-header.bg-pending {
        background: linear-gradient(135deg, #d97706, #b45309);
    }

    .card-header.bg-approved {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
    }

    .card-header.bg-rejected {
        background: linear-gradient(135deg, #dc2626, #991b1b);
    }

    .card-header h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.3rem;
        letter-spacing: -0.02em;
    }

    .card-header p {
        color: rgba(255,255,255,0.85);
        font-size: 0.85rem;
    }

    .card-header::before {
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 7rem;
        opacity: 0.1;
        pointer-events: none;
    }

    .card-header.bg-pending::before { content: '⏳'; }
    .card-header.bg-approved::before { content: '✓'; }
    .card-header.bg-rejected::before { content: '✗'; }

    .card-body {
        padding: 2rem;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1.2rem;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
    }

    .status-pending {
        background: #fef3c7;
        color: #d97706;
    }

    .status-approved {
        background: #d1fae5;
        color: #059669;
    }

    .status-rejected {
        background: #fee2e2;
        color: #dc2626;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin: 1rem 0;
    }

    .info-item {
        padding: 1rem;
        background: var(--bg);
        border-radius: 20px;
        transition: var(--transition);
    }

    .info-item:hover {
        background: var(--primary-soft);
        transform: translateY(-2px);
    }

    .info-label {
        font-size: 0.6rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    .info-label i {
        color: var(--primary);
        font-size: 0.7rem;
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 700;
        color: var(--dark);
        word-break: break-word;
    }

    .alert-card {
        margin-top: 1.5rem;
        padding: 1.2rem;
        border-radius: 24px;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        transition: var(--transition);
    }

    .alert-pending {
        background: linear-gradient(135deg, #fffbeb, #fef3c7);
        border-left: 4px solid #d97706;
    }

    .alert-approved {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-left: 4px solid #059669;
    }

    .alert-rejected {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border-left: 4px solid #dc2626;
    }

    .alert-icon {
        width: 48px;
        height: 48px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .alert-pending .alert-icon { background: #d97706; }
    .alert-approved .alert-icon { background: #059669; }
    .alert-rejected .alert-icon { background: #dc2626; }

    .alert-icon i { color: white; font-size: 1.2rem; }
    .alert-content h4 { font-size: 0.9rem; font-weight: 800; margin-bottom: 0.2rem; }
    .alert-content p { font-size: 0.75rem; color: var(--gray); line-height: 1.5; }

    .action-button {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border: none;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: white;
        text-decoration: none;
        transition: var(--transition-bounce);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .action-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    .action-button-outline {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        background: white;
        border: 2px solid var(--primary);
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--primary);
        text-decoration: none;
        transition: var(--transition-bounce);
        cursor: pointer;
    }

    .action-button-outline:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-2px);
    }

    .action-button-danger {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        background: white;
        border: 2px solid #dc2626;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #dc2626;
        text-decoration: none;
        transition: var(--transition-bounce);
        cursor: pointer;
    }

    .action-button-danger:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
    }

    .action-group {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 1.5rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: var(--card);
        border-radius: 32px;
        border: 1px solid var(--border);
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: var(--gray-soft);
        border-radius: 28px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    .empty-icon i { font-size: 2.2rem; color: var(--gray-light); }

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

    .timeline-steps {
        display: flex;
        justify-content: space-between;
        margin: 1.5rem 0;
        position: relative;
    }

    .timeline-steps::before {
        content: '';
        position: absolute;
        top: 20px;
        left: 10%;
        right: 10%;
        height: 2px;
        background: var(--border);
        z-index: 0;
    }

    .step {
        text-align: center;
        flex: 1;
        position: relative;
        z-index: 1;
    }

    .step-icon {
        width: 40px;
        height: 40px;
        background: white;
        border: 2px solid var(--border);
        border-radius: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 0.5rem;
        transition: var(--transition);
    }

    .step.active .step-icon {
        background: var(--primary);
        border-color: var(--primary);
    }

    .step.active .step-icon i { color: white; }
    .step.completed .step-icon {
        background: var(--primary);
        border-color: var(--primary);
    }
    .step.completed .step-icon i { color: white; }
    .step-icon i { font-size: 1rem; color: var(--gray-light); }
    .step-label { font-size: 0.6rem; font-weight: 700; color: var(--gray); }
    .step.active .step-label { color: var(--primary); }

    /* Modal */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 9999;
        display: none;
        align-items: center;
        justify-content: center;
        padding: 1rem;
    }

    .modal-container {
        background: white;
        border-radius: 32px;
        max-width: 400px;
        width: 100%;
        overflow: hidden;
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }

    .modal-header {
        padding: 1.5rem;
        background: linear-gradient(135deg, #dc2626, #991b1b);
        color: white;
    }

    .modal-body {
        padding: 1.5rem;
        text-align: center;
    }

    .modal-footer {
        padding: 1rem 1.5rem 1.5rem;
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
    }

    .btn-modal-cancel {
        padding: 0.6rem 1.5rem;
        background: #f1f5f9;
        border: none;
        border-radius: 40px;
        font-weight: 700;
        cursor: pointer;
    }

    .btn-modal-confirm {
        padding: 0.6rem 1.5rem;
        background: #dc2626;
        color: white;
        border: none;
        border-radius: 40px;
        font-weight: 700;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .info-grid { grid-template-columns: 1fr; gap: 0.8rem; }
        .card-header { padding: 1.2rem 1.5rem; }
        .card-header h1 { font-size: 1.4rem; }
        .card-body { padding: 1.5rem; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .timeline-steps { flex-direction: column; gap: 1rem; }
        .timeline-steps::before { display: none; }
        .step { display: flex; align-items: center; gap: 1rem; text-align: left; }
        .step-icon { margin: 0; }
        .action-group { flex-direction: column; }
        .action-button, .action-button-outline, .action-button-danger { justify-content: center; }
    }

    .full-width { grid-column: span 2; }
    @media (max-width: 768px) { .full-width { grid-column: span 1; } }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- Back Button --}}
    <a href="{{ route('umkm.index') }}" class="back-button animate__animated animate__fadeIn">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Pusat UMKM
    </a>

    {{-- Alert Success --}}
@if(session('success'))
<div class="mb-4 p-4 bg-green-50 border-l-4 border-green-500 rounded-xl animate__animated animate__fadeInUp">
    <div class="flex items-center gap-3">
        <i class="fa-solid fa-circle-check text-green-500 text-lg"></i>
        <p class="text-green-700 font-medium">{{ session('success') }}</p>
    </div>
</div>
@endif

{{-- Alert Error --}}
@if(session('error'))
<div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl animate__animated animate__fadeInUp">
    <div class="flex items-center gap-3">
        <i class="fa-solid fa-circle-exclamation text-red-500 text-lg"></i>
        <p class="text-red-700 font-medium">{{ session('error') }}</p>
    </div>
</div>
@endif

    @if(isset($umkm) && $umkm)
    <div class="main-card animate__animated animate__fadeInUp">
        {{-- Card Header berdasarkan status --}}
        <div class="card-header 
            @if($umkm->status == 'pending') bg-pending
            @elseif($umkm->status == 'approved') bg-approved
            @else bg-rejected @endif">
            <h1>
                @if($umkm->status == 'pending') ⏳ Status Pengajuan
                @elseif($umkm->status == 'approved') ✓ Pengajuan Disetujui
                @else ✗ Pengajuan Ditolak @endif
            </h1>
            <p>Diajukan pada: {{ $umkm->created_at->translatedFormat('d F Y, H:i') }}</p>
        </div>

        <div class="card-body">
            {{-- Status Badge --}}
            <div class="flex justify-between items-center flex-wrap gap-3 mb-6">
                <span class="status-badge 
                    @if($umkm->status == 'pending') status-pending
                    @elseif($umkm->status == 'approved') status-approved
                    @else status-rejected @endif">
                    @if($umkm->status == 'pending') 
                        <i class="fa-solid fa-spinner fa-pulse"></i> Menunggu Verifikasi Admin
                    @elseif($umkm->status == 'approved') 
                        <i class="fa-regular fa-circle-check"></i> Disetujui - UMKM Aktif
                    @else 
                        <i class="fa-regular fa-circle-xmark"></i> Ditolak
                    @endif
                </span>
                
                @if($umkm->status == 'approved')
                <a href="{{ route('umkm.show', $umkm->id_umkm) }}" class="action-button">
                    <i class="fa-solid fa-store"></i> Kelola UMKM
                </a>
                @endif
            </div>

            {{-- Timeline Steps --}}
            <div class="timeline-steps">
                <div class="step {{ $umkm->status == 'pending' ? 'active' : 'completed' }}">
                    <div class="step-icon"><i class="fa-regular fa-paper-plane"></i></div>
                    <div class="step-label">Pengajuan</div>
                </div>
                <div class="step {{ $umkm->status == 'pending' ? 'active' : ($umkm->status == 'approved' ? 'completed' : '') }}">
                    <div class="step-icon"><i class="fa-regular fa-clock"></i></div>
                    <div class="step-label">Verifikasi</div>
                </div>
                <div class="step {{ $umkm->status == 'approved' ? 'completed' : '' }}">
                    <div class="step-icon"><i class="fa-regular fa-circle-check"></i></div>
                    <div class="step-label">Aktif</div>
                </div>
            </div>

            {{-- Informasi UMKM --}}
            <h3 class="text-sm font-black text-slate-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-store text-emerald-500"></i> Detail Informasi Usaha
            </h3>
            
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label"><i class="fa-solid fa-tag"></i> Nama Usaha</div>
                    <div class="info-value">{{ $umkm->nama_usaha }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fa-solid fa-layer-group"></i> Kategori</div>
                    <div class="info-value">{{ ucfirst($umkm->kategori) }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fa-solid fa-user"></i> Pemilik</div>
                    <div class="info-value">{{ $umkm->pemilik }}</div>
                </div>
                <div class="info-item">
                    <div class="info-label"><i class="fa-brands fa-whatsapp"></i> Nomor Telepon</div>
                    <div class="info-value">{{ $umkm->no_telepon }}</div>
                </div>
                <div class="info-item full-width">
                    <div class="info-label"><i class="fa-solid fa-location-dot"></i> Alamat Usaha</div>
                    <div class="info-value">{{ $umkm->alamat_usaha }}</div>
                </div>
                <div class="info-item full-width">
                    <div class="info-label"><i class="fa-solid fa-align-left"></i> Deskripsi</div>
                    <div class="info-value">{{ $umkm->deskripsi }}</div>
                </div>
            </div>

            {{-- Alert Card berdasarkan status --}}
            <div class="alert-card 
                @if($umkm->status == 'pending') alert-pending
                @elseif($umkm->status == 'approved') alert-approved
                @else alert-rejected @endif">
                <div class="alert-icon">
                    @if($umkm->status == 'pending')
                        <i class="fa-regular fa-clock"></i>
                    @elseif($umkm->status == 'approved')
                        <i class="fa-regular fa-circle-check"></i>
                    @else
                        <i class="fa-regular fa-circle-xmark"></i>
                    @endif
                </div>
                <div class="alert-content">
                    @if($umkm->status == 'pending')
                        <h4>Menunggu Verifikasi Admin</h4>
                        <p>Pengajuan UMKM Anda sedang dalam proses verifikasi oleh admin desa. Mohon tunggu maksimal 2x24 jam. Anda akan menerima notifikasi setelah status berubah.</p>
                    @elseif($umkm->status == 'approved')
                        <h4>Selamat! UMKM Anda Telah Aktif 🎉</h4>
                        <p>Akun UMKM Anda sudah disetujui dan aktif. Sekarang Anda dapat mengelola toko, menambahkan produk, dan mulai berjualan di portal desa.</p>
                    @else
                        <h4>Pengajuan Ditolak</h4>
                        <p>Maaf, pengajuan UMKM Anda belum dapat disetujui. Silakan hubungi admin desa untuk informasi lebih lanjut atau perbaiki data yang diperlukan.</p>
                    @endif
                </div>
            </div>

            {{-- Tombol Edit & Batalkan (Hanya untuk status pending) --}}
            @if($umkm->status == 'pending')
            <div class="action-group">
                <a href="{{ route('umkm.edit', $umkm->id_umkm) }}" class="action-button-outline">
                    <i class="fa-solid fa-pen"></i> Edit Pengajuan
                </a>
                <button onclick="openCancelModal()" class="action-button-danger">
                    <i class="fa-solid fa-ban"></i> Batalkan Pengajuan
                </button>
            </div>
            @endif

            {{-- Tombol Tambahan untuk Pending --}}
            @if($umkm->status == 'pending')
            <div class="mt-4 text-center">
                <p class="text-xs text-gray-400 mb-3">Butuh bantuan? Hubungi admin desa</p>
                <a href="https://wa.me/6281234567890?text=Halo%20Admin%2C%20saya%20ingin%20menanyakan%20status%20pengajuan%20UMKM%20{{ urlencode($umkm->nama_usaha) }}" 
                   target="_blank"
                   class="inline-flex items-center gap-2 text-sm text-emerald-600 hover:text-emerald-700 transition">
                    <i class="fa-brands fa-whatsapp"></i> Hubungi Admin via WhatsApp
                </a>
            </div>
            @endif
        </div>
    </div>

    {{-- Tutorial Section --}}
    <div class="tutorial-section animate__animated animate__fadeInUp">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Status Pengajuan UMKM</h3>
        </div>
        
        <p class="tutorial-intro" style="font-size: 0.8rem; color: var(--gray); margin-bottom: 1rem; line-height: 1.5;">
            Halaman ini menampilkan status pengajuan UMKM Anda. Berikut adalah penjelasan tentang setiap status:
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>⏳ Menunggu Verifikasi</h4>
                    <p>Pengajuan Anda telah terkirim dan sedang diproses oleh admin desa.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>✓ Disetujui</h4>
                    <p>UMKM Anda telah aktif. Klik "Kelola UMKM" untuk mengelola produk.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>✗ Ditolak</h4>
                    <p>Hubungi admin untuk mengetahui alasan dan perbaiki data yang diperlukan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>📋 Timeline</h4>
                    <p>Lihat progress pengajuan Anda melalui timeline di atas.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>✏️ Edit Pengajuan</h4>
                    <p>Jika status masih "Menunggu", Anda dapat mengedit data pengajuan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>🗑️ Batalkan Pengajuan</h4>
                    <p>Jika ingin membatalkan pengajuan, klik tombol "Batalkan Pengajuan".</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips:</strong> Pastikan data yang Anda masukkan lengkap dan akurat untuk mempercepat proses verifikasi.</span>
        </div>
    </div>

    @else
    {{-- Empty State --}}
    <div class="empty-state animate__animated animate__fadeInUp">
        <div class="empty-icon">
            <i class="fa-regular fa-store"></i>
        </div>
        <h3 class="text-lg font-semibold text-gray-400 mb-2">Belum Ada Pengajuan UMKM</h3>
        <p class="text-sm text-gray-400 mb-4">Anda belum mendaftarkan UMKM. Ayo daftarkan usaha Anda sekarang!</p>
        <a href="{{ route('masyarakat.umkm.create') }}" class="action-button">
            <i class="fa-solid fa-plus"></i> Daftar UMKM Sekarang
        </a>
    </div>
    @endif

</div>

{{-- Modal Konfirmasi Batalkan Pengajuan --}}
<div id="cancelModal" class="modal-overlay">
    <div class="modal-container">
        <div class="modal-header">
            <h3 class="text-xl font-bold">Batalkan Pengajuan</h3>
        </div>
        <div class="modal-body">
            <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-circle-exclamation text-red-500 text-2xl"></i>
            </div>
            <p class="text-gray-600">Apakah Anda yakin ingin membatalkan pengajuan UMKM ini?</p>
            <p class="text-gray-400 text-sm mt-2">Data yang sudah diisi tidak dapat dikembalikan.</p>
        </div>
        <div class="modal-footer">
            <button onclick="closeCancelModal()" class="btn-modal-cancel">
                <i class="fa-solid fa-times"></i> Batal
            </button>
            <form action="{{ route('umkm.destroy', $umkm->id_umkm ?? 0) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-modal-confirm">
                    <i class="fa-solid fa-trash"></i> Ya, Batalkan
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    function openCancelModal() {
        const modal = document.getElementById('cancelModal');
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }

    function closeCancelModal() {
        const modal = document.getElementById('cancelModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('cancelModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeCancelModal();
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Interactive tutorial items
        const tutorialItems = document.querySelectorAll('.tutorial-item');
        
        tutorialItems.forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => { this.style.transform = ''; }, 200);
                const title = this.querySelector('.tutorial-text h4').innerText;
                showToast(`💡 ${title} - Klik pada area terkait untuk informasi lebih lanjut`, 'info');
            });
        });
        
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
                z-index: 10000;
                display: flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                animation: slideInRight 0.3s ease;
                font-family: 'Plus Jakarta Sans', sans-serif;
                max-width: 320px;
            `;
            toast.innerHTML = `<i class="fa-regular fa-lightbulb"></i> ${message}`;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        
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
    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(100px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes slideOutRight {
        from { opacity: 1; transform: translateX(0); }
        to { opacity: 0; transform: translateX(100px); }
    }
</style>
@endsection