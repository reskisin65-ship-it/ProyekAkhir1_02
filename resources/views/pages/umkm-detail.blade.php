{{-- resources/views/pages/umkm-detail.blade.php --}}
@extends('layouts.app')

@section('title', $umkm->nama_usaha . ' - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

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
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.04);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.06);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.08);
        --shadow-2xl: 0 32px 64px rgba(0,0,0,0.12);
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        --transition-slow: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        color: var(--dark);
        -webkit-font-smoothing: antialiased;
    }

    /* Background Pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e2e8f0 0.5px, transparent 0.5px);
        background-size: 20px 20px;
        opacity: 0.4;
    }

    /* Container */
    .container-premium {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Breadcrumb */
    .breadcrumb {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 2rem;
    }
    .breadcrumb-item {
        font-size: 0.75rem;
        font-weight: 500;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition);
    }
    .breadcrumb-item:hover { color: var(--primary); }
    .breadcrumb-sep { color: var(--gray-light); font-size: 0.7rem; }
    .breadcrumb-current {
        color: var(--primary);
        font-weight: 600;
    }

    /* Main Grid */
    .detail-grid {
        display: grid;
        grid-template-columns: 1fr 1.2fr;
        gap: 2.5rem;
        background: white;
        border-radius: 32px;
        border: 1px solid var(--border);
        overflow: hidden;
        transition: var(--transition-bounce);
        box-shadow: var(--shadow-sm);
    }

    .detail-grid:hover {
        box-shadow: var(--shadow-xl);
    }

    /* Image Section */
    .image-section {
        background: linear-gradient(135deg, #f8fafc, #ffffff);
        padding: 1.5rem;
    }

    .image-wrapper {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition-slow);
    }

    .image-wrapper:hover {
        box-shadow: var(--shadow-xl);
        transform: scale(1.01);
    }

    .image-wrapper img {
        width: 100%;
        height: 400px;
        object-fit: cover;
        transition: transform 0.7s ease;
    }

    .image-wrapper:hover img {
        transform: scale(1.03);
    }

    /* Info Section */
    .info-section {
        padding: 1.5rem 1.5rem 1.5rem 0;
    }

    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 1rem;
        background: var(--primary-soft);
        color: var(--primary-dark);
        border-radius: 60px;
        font-size: 0.7rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .umkm-title {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1.2;
        color: var(--dark);
        margin-bottom: 1rem;
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.5rem 0;
        border-bottom: 1px solid var(--border);
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: var(--primary-soft);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .info-icon i { font-size: 1.1rem; color: var(--primary); }

    .info-label {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--gray);
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 500;
        color: var(--dark);
    }

    .description-section {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 2px solid var(--border);
    }

    .description-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .description-title i { color: var(--primary); }

    .description-text {
        font-size: 0.9rem;
        line-height: 1.6;
        color: var(--gray);
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }

    .btn-wa {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.5rem;
        background: #25d366;
        color: white;
        border: none;
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .btn-wa:hover {
        transform: translateY(-2px);
        filter: brightness(1.05);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
    }

    .btn-back {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.5rem;
        background: white;
        border: 1.5px solid var(--border);
        color: var(--gray);
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .btn-back:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-2px);
        background: var(--primary-soft);
    }

    /* Products Section */
    .products-section {
        margin-top: 3rem;
        background: white;
        border-radius: 32px;
        border: 1px solid var(--border);
        padding: 2rem;
        transition: var(--transition-bounce);
    }

    .products-section:hover {
        box-shadow: var(--shadow-lg);
    }

    .products-header {
        text-align: center;
        margin-bottom: 2rem;
    }

    .products-header h2 {
        font-size: 1.6rem;
        font-weight: 700;
        color: var(--dark);
        font-family: 'Instrument Serif', serif;
        font-style: italic;
    }

    .products-header p {
        font-size: 0.8rem;
        color: var(--gray);
        margin-top: 0.3rem;
    }

    .products-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .product-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 24px;
        overflow: hidden;
        transition: var(--transition-bounce);
    }

    .product-card:hover {
        transform: translateY(-5px);
        border-color: var(--primary);
        box-shadow: var(--shadow-xl);
    }

    .product-image {
        height: 180px;
        overflow: hidden;
    }

    .product-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .product-card:hover .product-image img {
        transform: scale(1.05);
    }

    .product-content {
        padding: 1rem;
    }

    .product-title {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.3rem;
        color: var(--dark);
    }

    .product-desc {
        font-size: 0.7rem;
        color: var(--gray);
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 0.5rem;
    }

    .product-price {
        font-size: 0.9rem;
        font-weight: 800;
        color: var(--primary);
    }

    .product-stock {
        font-size: 0.6rem;
        color: var(--gray-light);
    }

    /* Empty Products */
    .empty-products {
        text-align: center;
        padding: 3rem;
        background: var(--gray-soft);
        border-radius: 24px;
    }

    .empty-products i {
        font-size: 3rem;
        color: var(--gray-light);
        margin-bottom: 0.5rem;
        display: block;
    }

    .empty-products p {
        color: var(--gray);
    }

    /* Tutorial Section */
    .tutorial-section {
        margin-top: 2rem;
        background: white;
        border-radius: 28px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .tutorial-section:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.6rem;
    }

    .tutorial-header i { font-size: 1.2rem; color: var(--primary); }
    .tutorial-header h3 { font-size: 0.85rem; font-weight: 700; margin: 0; }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.5rem;
        border-radius: 12px;
        transition: var(--transition);
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

    .tutorial-text h4 { font-size: 0.75rem; font-weight: 700; margin-bottom: 0.2rem; }
    .tutorial-text p { font-size: 0.65rem; color: var(--gray); line-height: 1.4; }

    .tutorial-footer {
        margin-top: 1rem;
        padding: 0.6rem 1rem;
        background: #ecfdf5;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .detail-grid { grid-template-columns: 1fr; gap: 1.5rem; }
        .info-section { padding: 1.5rem; }
        .products-grid { grid-template-columns: repeat(2, 1fr); }
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .image-wrapper img { height: 280px; }
        .products-grid { grid-template-columns: 1fr; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .action-buttons { flex-direction: column; }
        .btn-wa, .btn-back { justify-content: center; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeInUp 0.5s ease forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- Breadcrumb --}}
    <div class="breadcrumb fade-up">
        <a href="{{ route('home') }}" class="breadcrumb-item"><i class="fa-solid fa-home mr-1"></i> Beranda</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('umkm') }}" class="breadcrumb-item">UMKM</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-current">{{ $umkm->nama_usaha }}</span>
    </div>

    {{-- Main Detail Card --}}
    <div class="detail-grid fade-up delay-1">
        
        {{-- Left: Image --}}
        <div class="image-section">
            <div class="image-wrapper">
                <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=600' }}" alt="{{ $umkm->nama_usaha }}">
            </div>
        </div>

        {{-- Right: Info --}}
        <div class="info-section">
            <div class="category-badge">
                <i class="fa-regular fa-tag"></i>
                @if($umkm->kategori == 'makanan') 🍔 Kuliner
                @elseif($umkm->kategori == 'kerajinan') 🎨 Kerajinan
                @elseif($umkm->kategori == 'fashion') 👕 Fashion
                @elseif($umkm->kategori == 'pertanian') 🌾 Pertanian
                @else 🏪 UMKM @endif
            </div>
            <h1 class="umkm-title">{{ $umkm->nama_usaha }}</h1>
            
            <div class="info-list">
                <div class="info-item">
                    <div class="info-icon"><i class="fa-regular fa-user"></i></div>
                    <div>
                        <div class="info-label">Pemilik</div>
                        <div class="info-value">{{ $umkm->pemilik ?? $umkm->user->name ?? 'Pengelola' }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-location-dot"></i></div>
                    <div>
                        <div class="info-label">Alamat</div>
                        <div class="info-value">{{ $umkm->alamat_usaha ?? $umkm->alamat ?? 'Alamat tidak tersedia' }}</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon"><i class="fa-solid fa-phone"></i></div>
                    <div>
                        <div class="info-label">Kontak</div>
                        <div class="info-value">{{ $umkm->no_telepon ?? $umkm->nomor_telepon ?? '-' }}</div>
                    </div>
                </div>
            </div>

            <div class="description-section">
                <div class="description-title">
                    <i class="fa-regular fa-file-lines"></i> Tentang Usaha
                </div>
                <p class="description-text">
                    {{ $umkm->deskripsi ?? 'Deskripsi belum tersedia.' }}
                </p>
            </div>

            <div class="action-buttons">
                @if($umkm->no_telepon ?? $umkm->nomor_telepon)
                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $umkm->no_telepon ?? $umkm->nomor_telepon) }}" 
                   target="_blank" class="btn-wa">
                    <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
                </a>
                @endif
                <a href="{{ route('umkm') }}" class="btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>

    {{-- Products Section --}}
    @if(isset($produk) && $produk->count() > 0)
    <div class="products-section fade-up delay-2">
        <div class="products-header">
            <h2>📦 Produk Unggulan</h2>
            <p>Daftar produk yang tersedia dari {{ $umkm->nama_usaha }}</p>
        </div>
        <div class="products-grid">
            @foreach($produk as $item)
            <div class="product-card">
                <div class="product-image">
                    <img src="{{ $item->foto ?? $item->foto_produk ?? 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=400' }}" alt="{{ $item->nama_produk }}">
                </div>
                <div class="product-content">
                    <h4 class="product-title">{{ $item->nama_produk }}</h4>
                    @if($item->deskripsi)
                    <p class="product-desc">{{ Str::limit($item->deskripsi, 60) }}</p>
                    @endif
                    <div class="product-footer">
                        <span class="product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</span>
                        <span class="product-stock"><i class="fa-regular fa-box"></i> Stok: {{ $item->stok ?? 'Tersedia' }}</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="products-section fade-up delay-2" style="text-align: center; padding: 2rem;">
        <i class="fa-regular fa-box-open" style="font-size: 3rem; color: var(--gray-light);"></i>
        <h3 style="margin-top: 0.5rem; color: var(--gray);">Belum Ada Produk</h3>
        <p style="color: var(--gray-light); font-size: 0.8rem;">Belum ada produk yang ditambahkan untuk UMKM ini.</p>
    </div>
    @endif

    {{-- Tutorial Section --}}
    <div class="tutorial-section fade-up delay-3">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Detail UMKM</h3>
        </div>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📋 Informasi Usaha</h4>
                    <p>Lihat detail lengkap UMKM termasuk pemilik, alamat, dan kontak.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>📦 Produk</h4>
                    <p>Jelajahi koleksi produk yang ditawarkan oleh UMKM ini.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>💬 Hubungi Penjual</h4>
                    <p>Gunakan tombol WhatsApp untuk berkomunikasi langsung dengan pemilik UMKM.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>📍 Lokasi</h4>
                    <p>Lihat alamat lengkap UMKM untuk kunjungan langsung.</p>
                </div>
            </div>
        </div>
        <div class="tutorial-footer">
            <i class="fa-regular fa-bell"></i>
            <span>💡 <strong>Tips:</strong> Klik tombol WhatsApp untuk langsung terhubung dengan penjual.</span>
        </div>
    </div>
</div>
@endsection