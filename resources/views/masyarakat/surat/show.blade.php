{{-- resources/views/masyarakat/surat/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Pengajuan - Premium Interface')

@section('content')
<!-- Fonts & Library -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --glass-white: rgba(255, 255, 255, 0.75);
        --glass-border: rgba(255, 255, 255, 0.4);
        --primary-gradient: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        --accent-emerald: #10b981;
        --accent-red: #f43f5e;
        --text-slate: #475569;
        --text-dark: #0f172a;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f8fafc;
        background-image: 
            radial-gradient(at 0% 0%, rgba(16, 185, 129, 0.05) 0px, transparent 50%),
            radial-gradient(at 100% 0%, rgba(59, 130, 246, 0.05) 0px, transparent 50%);
        min-height: 100vh;
        color: var(--text-dark);
    }

    /* Container Spacing */
    .premium-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 3rem 1.5rem;
    }

    /* Elegant Back Link */
    .back-nav {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        padding: 10px 20px;
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 100px;
        color: var(--text-slate);
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        margin-bottom: 2.5rem;
        box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
    }

    .back-nav:hover {
        transform: translateX(-8px);
        background: var(--primary-gradient);
        color: white;
        border-color: transparent;
        box-shadow: 0 10px 20px -5px rgba(15, 23, 42, 0.2);
    }

    /* The Main Masterpiece: Glass Card */
    .master-glass-card {
        background: var(--glass-white);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--glass-border);
        border-radius: 40px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        position: relative;
    }

    /* Animated Glow Backdrop */
    .master-glass-card::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.03) 0%, transparent 70%);
        pointer-events: none;
        z-index: 0;
    }

    /* Header Section */
    .premium-header {
        background: var(--primary-gradient);
        padding: 3rem;
        position: relative;
        z-index: 1;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom-left-radius: 40px;
        border-bottom-right-radius: 40px;
    }

    .header-title-group h2 {
        color: white;
        font-family: 'Outfit', sans-serif;
        font-size: 1.75rem;
        font-weight: 700;
        letter-spacing: -0.03em;
        margin-bottom: 8px;
    }

    .header-subtitle {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Status Badge Floating */
    .badge-float {
        padding: 12px 24px;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        display: flex;
        align-items: center;
        gap: 10px;
        backdrop-filter: blur(10px);
    }

    .status-menunggu { background: rgba(245, 158, 11, 0.2); color: #fbbf24; border: 1px solid rgba(245, 158, 11, 0.3); }
    .status-diproses { background: rgba(59, 130, 246, 0.2); color: #60a5fa; border: 1px solid rgba(59, 130, 246, 0.3); }
    .status-selesai { background: rgba(16, 185, 129, 0.2); color: #34d399; border: 1px solid rgba(16, 185, 129, 0.3); }
    .status-ditolak { background: rgba(244, 63, 94, 0.2); color: #fb7185; border: 1px solid rgba(244, 63, 94, 0.3); }

    /* Content Styling */
    .content-grid {
        padding: 3rem;
        display: grid;
        grid-template-columns: 1.2fr 0.8fr;
        gap: 4rem;
        position: relative;
        z-index: 1;
    }

    .info-group { margin-bottom: 2.5rem; }

    .group-label {
        font-size: 0.7rem;
        font-weight: 800;
        color: var(--accent-emerald);
        text-transform: uppercase;
        letter-spacing: 0.15em;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .group-label::after {
        content: '';
        height: 1px;
        flex: 1;
        background: linear-gradient(to right, rgba(16, 185, 129, 0.2), transparent);
    }

    .data-row {
        display: grid;
        grid-template-columns: 160px 1fr;
        padding: 12px 0;
        border-bottom: 1px solid rgba(0,0,0,0.03);
        transition: all 0.3s;
    }

    .data-row:hover {
        background: rgba(16, 185, 129, 0.02);
        padding-left: 10px;
        border-radius: 8px;
    }

    .data-key { font-size: 0.85rem; color: var(--text-slate); font-weight: 500; }
    .data-value { font-size: 0.9rem; color: var(--text-dark); font-weight: 600; }

    /* Timeline Professional */
    .pro-timeline {
        position: relative;
        padding-left: 35px;
    }

    .pro-timeline::before {
        content: '';
        position: absolute;
        left: 7px;
        top: 0;
        height: 100%;
        width: 2px;
        background: #f1f5f9;
    }

    .step-item {
        position: relative;
        margin-bottom: 2.5rem;
    }

    .step-marker {
        position: absolute;
        left: -35px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: white;
        border: 3px solid #e2e8f0;
        z-index: 2;
        transition: all 0.5s;
    }

    .step-item.active .step-marker {
        border-color: var(--accent-emerald);
        background: var(--accent-emerald);
        box-shadow: 0 0 0 5px rgba(16, 185, 129, 0.15);
        transform: scale(1.2);
    }

    .step-content h4 { font-size: 0.9rem; font-weight: 700; margin-bottom: 4px; }
    .step-content p { font-size: 0.75rem; color: var(--text-slate); line-height: 1.5; }

    /* Action Buttons */
    .btn-premium-download {
        background: var(--primary-gradient);
        color: white !important;
        padding: 16px 32px;
        border-radius: 20px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 15px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 0 20px 30px -10px rgba(15, 23, 42, 0.3);
    }

    .btn-premium-download:hover {
        transform: translateY(-5px) scale(1.02);
        box-shadow: 0 25px 40px -10px rgba(15, 23, 42, 0.4);
    }

    /* File Link Hover */
    .glass-file-link {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 6px 16px;
        background: rgba(16, 185, 129, 0.1);
        color: var(--accent-emerald);
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 600;
        transition: all 0.3s;
    }

    .glass-file-link:hover {
        background: var(--accent-emerald);
        color: white;
        text-decoration: none;
    }

    /* Animations */
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-flow > * {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }

    @media (max-width: 992px) {
        .content-grid { grid-template-columns: 1fr; gap: 3rem; padding: 2rem; }
        .premium-header { padding: 2rem; flex-direction: column; align-items: flex-start; gap: 1.5rem; }
        .data-row { grid-template-columns: 1fr; }
    }
    /* Force wrap untuk semua teks */
    body, .container, .wrapper, main, section, div, p, span, h1, h2, h3, h4 {
        max-width: 100%;
        overflow-wrap: break-word;
        word-wrap: break-word;
        word-break: break-word;
    }

    /* Perbaikan untuk preview gambar */
    .current-photo img, .preview-image {
        max-width: 100%;
        height: auto;
    }
        
</style>

<div class="premium-wrapper">
    <!-- Breadcrumb Nav -->
    <a href="{{ route('masyarakat.surat.index') }}" class="back-nav animate-flow delay-1">
        <i class="fa-solid fa-chevron-left"></i>
        <span>Dashboard Pengajuan</span>
    </a>

    <!-- Main Card -->
    <div class="master-glass-card animate-flow delay-2">
        <!-- Card Header -->
        <div class="premium-header">
            <div class="header-title-group">
                <div class="header-subtitle uppercase tracking-widest font-bold">
                    ID Transaksi: #{{ str_pad($pengajuan->id_surat, 5, '0', STR_PAD_LEFT) }}
                </div>
                <h2>{{ $pengajuan->jenis_surat }}</h2>
                <div class="header-subtitle">
                    <i class="fa-regular fa-calendar-check"></i>
                    Diajukan pada {{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}
                </div>
            </div>

            <div class="badge-float status-{{ $pengajuan->status }}">
                @if($pengajuan->status == 'menunggu') 
                    <i class="fa-solid fa-hourglass-start animate-pulse"></i> Menunggu
                @elseif($pengajuan->status == 'diproses') 
                    <i class="fa-solid fa-spinner fa-spin"></i> Sedang Diproses
                @elseif($pengajuan->status == 'selesai') 
                    <i class="fa-solid fa-circle-check"></i> Selesai
                @else 
                    <i class="fa-solid fa-circle-xmark"></i> Pengajuan Ditolak
                @endif
            </div>
        </div>

        <!-- Card Content -->
        <div class="content-grid">
            <!-- Left Side: Data -->
            <div class="info-section">
                <div class="info-group">
                    <div class="group-label">
                        <i class="fa-solid fa-user-gear"></i> Informasi Pemohon
                    </div>
                    <div class="data-row">
                        <div class="data-key">Nama Lengkap</div>
                        <div class="data-value">{{ $pengajuan->nama_lengkap ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">Nomor NIK</div>
                        <div class="data-value">{{ $pengajuan->nik ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">Kontak</div>
                        <div class="data-value">{{ $pengajuan->nomor_telepon ?? '-' }}</div>
                    </div>
                    <div class="data-row">
                        <div class="data-key">Tempat, Tgl Lahir</div>
                        <div class="data-value">{{ $pengajuan->tempat_lahir ?? '-' }}, {{ $pengajuan->tanggal_lahir ? \Carbon\Carbon::parse($pengajuan->tanggal_lahir)->translatedFormat('d F Y') : '-' }}</div>
                    </div>
                </div>

                <div class="info-group">
                    <div class="group-label">
                        <i class="fa-solid fa-file-invoice"></i> Detail Keperluan
                    </div>
                    <div class="data-row">
                        <div class="data-key">Perihal</div>
                        <div class="data-value">{{ $pengajuan->keperluan ?? '-' }}</div>
                    </div>
                    @if($pengajuan->file_pendukung)
                    <div class="data-row">
                        <div class="data-key">Dokumen Lampiran</div>
                        <div class="data-value">
                            <a href="{{ Storage::url($pengajuan->file_pendukung) }}" target="_blank" class="glass-file-link">
                                <i class="fa-regular fa-file-pdf"></i> Tinjau Berkas
                            </a>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Right Side: Status Timeline -->
            <div class="status-section">
                <div class="group-label">
                    <i class="fa-solid fa-arrow-up-right-dots"></i> Progress Pengajuan
                </div>
                
                <div class="pro-timeline">
                    <!-- Step 1 -->
                    <div class="step-item {{ in_array($pengajuan->status, ['menunggu', 'diproses', 'selesai']) ? 'active' : '' }}">
                        <div class="step-marker"></div>
                        <div class="step-content">
                            <h4>Pengajuan Berhasil Dikirim</h4>
                            <p>Sistem telah menerima berkas pengajuan Anda dan menunggu antrean verifikasi admin.</p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="step-item {{ in_array($pengajuan->status, ['diproses', 'selesai']) ? 'active' : '' }}">
                        <div class="step-marker"></div>
                        <div class="step-content">
                            <h4>Verifikasi Dokumen</h4>
                            <p>
                                @if($pengajuan->status == 'diproses')
                                    Admin sedang memeriksa kelengkapan data dan memproses draf surat Anda.
                                @else
                                    Tahap verifikasi data pemohon.
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="step-item {{ in_array($pengajuan->status, ['selesai', 'ditolak']) ? 'active' : '' }}">
                        <div class="step-marker"></div>
                        <div class="step-content">
                            @if($pengajuan->status == 'ditolak')
                                <h4 style="color: var(--accent-red)">Pengajuan Ditolak</h4>
                                <div style="background: rgba(244, 63, 94, 0.05); padding: 12px; border-radius: 12px; border: 1px dashed var(--accent-red); margin-top: 8px;">
                                    <p style="color: var(--accent-red); font-weight: 600;">Catatan Admin:</p>
                                    <p>{{ $pengajuan->catatan_penolakan ?? 'Data tidak sesuai atau kurang lengkap.' }}</p>
                                </div>
                            @else
                                <h4>Selesai & Penerbitan Surat</h4>
                                <p>Surat telah ditandatangani secara digital/fisik dan siap untuk Anda gunakan.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Final Action -->
                @if($pengajuan->status == 'selesai' && $pengajuan->file_surat)
                <div class="mt-10 pt-6 border-t border-slate-100">
                    <a href="{{ route('masyarakat.surat.download', $pengajuan->id_surat) }}" class="btn-premium-download">
                        <span>UNDUH SURAT RESMI (PDF)</span>
                        <i class="fa-solid fa-download"></i>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Tutorial Section - Detail Pengajuan --}}
<div class="tutorial-section animate__animated animate__fadeInUp" style="margin-top: 2rem; background: #f8fafc; border-radius: 28px; padding: 2rem; border: 1px solid #e2e8f0; transition: all 0.3s;">
    <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 1.5rem;">
        <i class="fa-regular fa-circle-question" style="font-size: 1.8rem; color: #059669;"></i>
        <h3 style="font-size: 1.2rem; font-weight: 700; margin: 0;">📖 Informasi & Langkah Selanjutnya</h3>
    </div>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1.2rem;">
        <div style="display: flex; gap: 1rem; padding: 0.8rem; border-radius: 20px; transition: all 0.3s;">
            <div style="width: 36px; height: 36px; background: #059669; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; flex-shrink: 0;">📌</div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.9rem; margin-bottom: 0.3rem;">Status Pengajuan</h4>
                <p style="font-size: 0.75rem; color: #64748b; line-height: 1.5;">Cek status terbaru pengajuan Anda di bagian atas halaman. Status akan berubah dari <strong>Menunggu</strong> → <strong>Diproses</strong> → <strong>Selesai/Ditolak</strong>.</p>
            </div>
        </div>
        <div style="display: flex; gap: 1rem; padding: 0.8rem; border-radius: 20px; transition: all 0.3s;">
            <div style="width: 36px; height: 36px; background: #059669; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; flex-shrink: 0;">✏️</div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.9rem; margin-bottom: 0.3rem;">Edit Pengajuan</h4>
                <p style="font-size: 0.75rem; color: #64748b; line-height: 1.5;">Jika status masih <strong>Menunggu</strong>, Anda dapat mengedit data pengajuan dengan mengklik tombol Edit.</p>
            </div>
        </div>
        <div style="display: flex; gap: 1rem; padding: 0.8rem; border-radius: 20px; transition: all 0.3s;">
            <div style="width: 36px; height: 36px; background: #059669; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; flex-shrink: 0;">📥</div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.9rem; margin-bottom: 0.3rem;">Unduh Surat</h4>
                <p style="font-size: 0.75rem; color: #64748b; line-height: 1.5;">Jika status <strong>Selesai</strong>, Anda dapat mengunduh surat digital yang sudah diterbitkan oleh admin desa.</p>
            </div>
        </div>
        <div style="display: flex; gap: 1rem; padding: 0.8rem; border-radius: 20px; transition: all 0.3s;">
            <div style="width: 36px; height: 36px; background: #f59e0b; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; flex-shrink: 0;">⚠️</div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.9rem; margin-bottom: 0.3rem;">Jika Ditolak</h4>
                <p style="font-size: 0.75rem; color: #64748b; line-height: 1.5;">Baca catatan penolakan dari admin, perbaiki kekurangan, lalu ajukan surat baru dengan data yang benar.</p>
            </div>
        </div>
        <div style="display: flex; gap: 1rem; padding: 0.8rem; border-radius: 20px; transition: all 0.3s;">
            <div style="width: 36px; height: 36px; background: #059669; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; flex-shrink: 0;">💬</div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.9rem; margin-bottom: 0.3rem;">Butuh Bantuan?</h4>
                <p style="font-size: 0.75rem; color: #64748b; line-height: 1.5;">Hubungi kantor desa melalui kontak yang tersedia jika ada pertanyaan lebih lanjut.</p>
            </div>
        </div>
        <div style="display: flex; gap: 1rem; padding: 0.8rem; border-radius: 20px; transition: all 0.3s;">
            <div style="width: 36px; height: 36px; background: #059669; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800; flex-shrink: 0;">⏱️</div>
            <div>
                <h4 style="font-weight: 700; font-size: 0.9rem; margin-bottom: 0.3rem;">Waktu Proses</h4>
                <p style="font-size: 0.75rem; color: #64748b; line-height: 1.5;">Proses verifikasi dan penerbitan surat membutuhkan waktu 1-3 hari kerja setelah pengajuan masuk.</p>
            </div>
        </div>
    </div>
</div>

<style>
    .tutorial-section:hover {
        background: white;
        border-color: #059669;
        box-shadow: 0 4px 20px -1px rgba(0, 0, 0, 0.05);
    }
    .tutorial-section > div > div:hover {
        background: rgba(5, 150, 105, 0.05);
        transform: translateX(5px);
    }
</style>

    <!-- Footer Note -->
    <div class="text-center mt-10 animate-flow" style="animation-delay: 0.5s">
        <p class="text-slate-400 text-xs font-medium">
            <i class="fa-solid fa-shield-halved text-emerald-500 mr-2"></i> 
            Sistem Pelayanan Desa Terintegrasi - Dokumen ini memiliki kekuatan hukum yang sah.
        </p>
    </div>
</div>

<script>
    // Smooth appearance logic
    document.addEventListener('DOMContentLoaded', () => {
        console.log('Premium UI Initialized');
    });
</script>
@endsection