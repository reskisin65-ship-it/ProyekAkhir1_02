@extends('layouts.admin')

@section('title', 'Detail Transaksi - Keuangan Desa Lumban Silintong')

@section('content')
<style>
    /* ISOLATED SCOPE - ONLY FOR THIS PAGE */
    .keuangan-detail-page {
        --system-bg: #0a0a0a;
        --card-bg: #ffffff;
        --accent-primary: #10b981;
        --accent-yellow: #f59e0b;
        --accent-blue: #3b82f6;
        --accent-purple: #8b5cf6;
        --accent-red: #ef4444;
        --accent-orange: #f97316;
        --text-main: #171717;
        --text-mute: #737373;
        --border-color: #e5e7eb;
    }

    .keuangan-detail-page {
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-main);
        letter-spacing: -0.02em;
    }

    .keuangan-detail-page .font-display { font-family: 'Instrument Sans', sans-serif; }

    .keuangan-detail-page .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    .keuangan-detail-page .detail-wrapper {
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem;
    }

    .keuangan-detail-page .detail-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .keuangan-detail-page .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-mute);
        text-decoration: none;
        transition: all 0.3s;
    }

    .keuangan-detail-page .back-button:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateX(-4px);
    }

    .keuangan-detail-page .brand-title {
        font-size: 2rem;
        font-weight: 800;
        letter-spacing: -0.05em;
        color: var(--system-bg);
    }

    .keuangan-detail-page .brand-title span {
        color: var(--accent-primary);
    }

    .keuangan-detail-page .status-banner {
        padding: 1rem 1.5rem;
        border-radius: 20px;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .keuangan-detail-page .status-banner-pending {
        background: linear-gradient(135deg, #fef3c7, #fffbeb);
        border-left: 4px solid #f59e0b;
    }

    .keuangan-detail-page .status-banner-approved {
        background: linear-gradient(135deg, #d1fae5, #ecfdf5);
        border-left: 4px solid #10b981;
    }

    .keuangan-detail-page .status-banner-rejected {
        background: linear-gradient(135deg, #fee2e2, #fef2f2);
        border-left: 4px solid #ef4444;
    }

    .keuangan-detail-page .status-label {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .keuangan-detail-page .status-label-pending {
        background: #fef3c7;
        color: #d97706;
    }

    .keuangan-detail-page .status-label-approved {
        background: #d1fae5;
        color: #059669;
    }

    .keuangan-detail-page .status-label-rejected {
        background: #fee2e2;
        color: #dc2626;
    }

    .keuangan-detail-page .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .keuangan-detail-page .info-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
        transition: all 0.4s;
    }

    .keuangan-detail-page .info-card:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
        transform: translateY(-2px);
    }

    .keuangan-detail-page .card-header {
        padding: 1.25rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .keuangan-detail-page .card-header i {
        font-size: 1.25rem;
        color: var(--accent-primary);
    }

    .keuangan-detail-page .card-header h3 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
    }

    .keuangan-detail-page .card-body {
        padding: 1.5rem;
    }

    .keuangan-detail-page .detail-table {
        width: 100%;
    }

    .keuangan-detail-page .detail-row {
        display: flex;
        padding: 0.75rem 0;
        border-bottom: 1px solid var(--border-color);
    }

    .keuangan-detail-page .detail-row:last-child {
        border-bottom: none;
    }

    .keuangan-detail-page .detail-label {
        width: 35%;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-mute);
    }

    .keuangan-detail-page .detail-value {
        width: 65%;
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--text-main);
    }

    .keuangan-detail-page .detail-value-amount {
        font-size: 1.1rem;
        font-weight: 800;
    }

    .keuangan-detail-page .detail-value-amount.pemasukan {
        color: #059669;
    }

    .keuangan-detail-page .detail-value-amount.pengeluaran {
        color: #dc2626;
    }

    .keuangan-detail-page .badge-custom {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .keuangan-detail-page .badge-pemasukan {
        background: #d1fae5;
        color: #059669;
    }

    .keuangan-detail-page .badge-pengeluaran {
        background: #fee2e2;
        color: #dc2626;
    }

    .keuangan-detail-page .image-container {
        background: #f8fafc;
        border-radius: 20px;
        overflow: hidden;
        text-align: center;
    }

    .keuangan-detail-page .image-container img {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
        transition: transform 0.3s;
    }

    .keuangan-detail-page .image-container img:hover {
        transform: scale(1.02);
    }

    .keuangan-detail-page .image-actions {
        display: flex;
        gap: 0.75rem;
        justify-content: center;
        margin-top: 1rem;
    }

    .keuangan-detail-page .image-btn {
        padding: 0.5rem 1rem;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .keuangan-detail-page .image-btn-primary {
        background: var(--accent-blue);
        color: white;
    }

    .keuangan-detail-page .image-btn-primary:hover {
        background: #2563eb;
        transform: translateY(-2px);
    }

    .keuangan-detail-page .image-btn-secondary {
        background: var(--system-bg);
        color: white;
    }

    .keuangan-detail-page .image-btn-secondary:hover {
        background: var(--accent-primary);
        transform: translateY(-2px);
    }

    .keuangan-detail-page .no-image {
        padding: 3rem;
        text-align: center;
        color: var(--text-mute);
    }

    .keuangan-detail-page .no-image i {
        font-size: 3rem;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .keuangan-detail-page .catatan-card {
        background: linear-gradient(135deg, #fef3c7, #fffbeb);
        border: 1px solid #fde68a;
        border-radius: 20px;
        padding: 1rem 1.25rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
    }

    .keuangan-detail-page .catatan-card i {
        color: #d97706;
        font-size: 1.25rem;
    }

    .keuangan-detail-page .catatan-card p {
        margin: 0;
        font-size: 0.85rem;
        color: #92400e;
        line-height: 1.5;
    }

    .keuangan-detail-page .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .keuangan-detail-page .btn-action {
        padding: 0.75rem 1.5rem;
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 700;
        border: none;
        cursor: pointer;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .keuangan-detail-page .btn-approve {
        background: #10b981;
        color: white;
    }

    .keuangan-detail-page .btn-approve:hover {
        background: #059669;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -6px rgba(16,185,129,0.4);
    }

    .keuangan-detail-page .btn-reject {
        background: #ef4444;
        color: white;
    }

    .keuangan-detail-page .btn-reject:hover {
        background: #dc2626;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -6px rgba(239,68,68,0.4);
    }

    .keuangan-detail-page .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .keuangan-detail-page .modal-container {
        background: white;
        border-radius: 32px;
        max-width: 500px;
        width: 90%;
        animation: modalSlide 0.3s ease;
        overflow: hidden;
    }

    @keyframes modalSlide {
        from { opacity: 0; transform: scale(0.95) translateY(20px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .keuangan-detail-page .bg-gradient-emerald {
        background: linear-gradient(135deg, #059669, #047857);
    }

    .keuangan-detail-page .bg-gradient-red {
        background: linear-gradient(135deg, #dc2626, #b91c1c);
    }

    @media (max-width: 768px) {
        .keuangan-detail-page .detail-wrapper { padding: 1rem; }
        .keuangan-detail-page .detail-grid { grid-template-columns: 1fr; }
        .keuangan-detail-page .brand-title { font-size: 1.5rem; }
        .keuangan-detail-page .detail-header { flex-direction: column; align-items: flex-start; }
        .keuangan-detail-page .action-buttons { flex-direction: column; }
        .keuangan-detail-page .btn-action { justify-content: center; }
    }

    .keuangan-detail-page .fade-up {
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .keuangan-detail-page .text-muted { color: var(--text-mute); }
    .keuangan-detail-page .text-sm { font-size: 0.875rem; }
    .keuangan-detail-page .text-xs { font-size: 0.75rem; }
    .keuangan-detail-page .font-semibold { font-weight: 600; }
    .keuangan-detail-page .mt-1 { margin-top: 0.25rem; }
    .keuangan-detail-page .mt-2 { margin-top: 0.5rem; }
    .keuangan-detail-page .mb-1 { margin-bottom: 0.25rem; }
    .keuangan-detail-page .flex { display: flex; }
    .keuangan-detail-page .items-center { align-items: center; }
    .keuangan-detail-page .gap-2 { gap: 0.5rem; }
    .keuangan-detail-page .justify-between { justify-content: space-between; }
</style>

<div class="keuangan-detail-page">
    <div class="bg-pattern"></div>

    <div class="detail-wrapper">
        
        {{-- Header --}}
        <div class="detail-header fade-up">
            <a href="{{ route('admin.keuangan.index') }}" class="back-button">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
            </a>
            <div>
                <h1 class="brand-title font-display">Detail <span>Transaksi</span></h1>
                <p class="text-muted text-sm mt-1">Informasi lengkap transaksi keuangan desa</p>
            </div>
        </div>

        {{-- Main Grid --}}
        <div class="detail-grid fade-up" style="animation-delay: 0.05s">
            
            {{-- Informasi Transaksi --}}
            <div class="info-card">
                <div class="card-header">
                    <i class="fa-solid fa-receipt"></i>
                    <h3>Informasi Transaksi</h3>
                </div>
                <div class="card-body">
                    <div class="detail-table">
                        <div class="detail-row">
                            <div class="detail-label"><i class="fa-regular fa-calendar"></i> Tanggal</div>
                            <div class="detail-value">{{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fa-solid fa-tag"></i> Jenis</div>
                            <div class="detail-value">
                                <span class="badge-custom {{ $transaksi->jenis == 'pemasukan' ? 'badge-pemasukan' : 'badge-pengeluaran' }}">
                                    <i class="fa-solid fa-{{ $transaksi->jenis == 'pemasukan' ? 'arrow-trend-up' : 'arrow-trend-down' }}"></i>
                                    {{ ucfirst($transaksi->jenis) }}
                                </span>
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fa-solid fa-folder"></i> Kategori</div>
                            <div class="detail-value">{{ $transaksi->kategori->nama_kategori ?? '-' }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fa-solid fa-money-bill-wave"></i> Jumlah</div>
                            <div class="detail-value detail-value-amount {{ $transaksi->jenis }}">
                                Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fa-solid fa-align-left"></i> Deskripsi</div>
                            <div class="detail-value">{{ $transaksi->deskripsi }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Informasi Pengguna --}}
            <div class="info-card">
                <div class="card-header">
                    <i class="fa-solid fa-user"></i>
                    <h3>Informasi Pengguna</h3>
                </div>
                <div class="card-body">
                    <div class="detail-table">
                        <div class="detail-row">
                            <div class="detail-label"><i class="fa-solid fa-user"></i> Dibuat oleh</div>
                            <div class="detail-value">{{ $transaksi->creator->name ?? '-' }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fa-regular fa-clock"></i> Tanggal dibuat</div>
                            <div class="detail-value">{{ $transaksi->created_at->translatedFormat('d F Y H:i:s') }}</div>
                        </div>
                        <div class="detail-row">
                            <div class="detail-label"><i class="fa-regular fa-clock"></i> Terakhir diubah</div>
                            <div class="detail-value">{{ $transaksi->updated_at->translatedFormat('d F Y H:i:s') }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Bukti Transaksi --}}
        <div class="info-card fade-up" style="animation-delay: 0.1s">
            <div class="card-header">
                <i class="fa-solid fa-camera"></i>
                <h3>Bukti Transaksi</h3>
            </div>
            <div class="card-body">
                @if($transaksi->bukti_foto)
                    <div class="image-container">
                        <img src="{{ Storage::url($transaksi->bukti_foto) }}" alt="Bukti Transaksi">
                    </div>
                    <div class="image-actions">
                        <a href="{{ Storage::url($transaksi->bukti_foto) }}" target="_blank" class="image-btn image-btn-primary">
                            <i class="fa-solid fa-eye"></i> Lihat Full
                        </a>
                        <a href="{{ Storage::url($transaksi->bukti_foto) }}" download class="image-btn image-btn-secondary">
                            <i class="fa-solid fa-download"></i> Download Bukti
                        </a>
                    </div>
                @else
                    <div class="no-image">
                        <i class="fa-regular fa-image"></i>
                        <p>Tidak ada bukti foto yang dilampirkan</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection