{{-- resources/views/pages/galeri-detail.blade.php --}}
@extends('layouts.app')

@section('title', $galeri->judul_galeri . ' - Galeri Lumban Silintong')

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
        --gray: #64748b;
        --gray-light: #94a3b8;
        --bg: #ffffff;
        --border: #eef2f6;
        --shadow-md: 0 4px 16px rgba(0,0,0,0.04);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.08);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.12);
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f8fafc;
        color: var(--dark);
    }

    .container-premium {
        max-width: 1100px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1.2rem;
        background: white;
        border: 1px solid var(--border);
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition-bounce);
        margin-bottom: 1.5rem;
    }

    .back-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(-4px);
    }

    /* Header */
    .header-section {
        margin-bottom: 2rem;
        text-align: center;
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

    .header-title {
        font-size: clamp(1.5rem, 4vw, 2.2rem);
        font-weight: 800;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .header-meta {
        font-size: 0.75rem;
        color: var(--gray);
        display: flex;
        justify-content: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    /* Featured Image */
    .featured-image {
        border-radius: 28px;
        overflow: hidden;
        margin-bottom: 2rem;
        box-shadow: var(--shadow-xl);
    }

    .featured-image img {
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s;
    }

    .featured-image:hover img {
        transform: scale(1.02);
    }

    /* Description */
    .description-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        margin-bottom: 2rem;
    }

    .description-card h3 {
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 0.8rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .description-card h3 i {
        color: var(--primary);
    }

    .description-text {
        font-size: 0.9rem;
        line-height: 1.7;
        color: var(--gray);
    }

    /* Related Section */
    .related-section {
        margin-top: 2rem;
        border-top: 1px solid var(--border);
        padding-top: 2rem;
    }

    .related-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .related-title {
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .related-title i { color: var(--primary); }

    .related-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
    }

    .related-card {
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .related-card:hover {
        transform: translateY(-4px);
    }

    .related-img {
        width: 100%;
        aspect-ratio: 1 / 1;
        border-radius: 16px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }

    .related-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s;
    }

    .related-card:hover .related-img img {
        transform: scale(1.05);
    }

    .related-card h4 {
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.2rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .related-date {
        font-size: 0.6rem;
        color: var(--gray);
    }

    /* Tutorial */
    .tutorial-section {
        margin-top: 2rem;
        background: white;
        border-radius: 24px;
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
        grid-template-columns: repeat(3, 1fr);
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
        background: var(--primary);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.7rem;
        flex-shrink: 0;
    }

    .tutorial-text h4 { font-size: 0.7rem; font-weight: 700; margin-bottom: 0.2rem; }
    .tutorial-text p { font-size: 0.6rem; color: var(--gray); line-height: 1.4; }

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
        .related-grid { grid-template-columns: repeat(2, 1fr); }
        .tutorial-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .related-grid { grid-template-columns: 1fr; }
        .header-title { font-size: 1.5rem; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeInUp 0.5s ease forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
</style>

<div class="container-premium">

    {{-- Back Button --}}
    <a href="{{ route('galeri') }}" class="back-link fade-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Galeri
    </a>

    {{-- Header --}}
    <div class="header-section fade-up delay-1">
        <div class="category-badge">
            @if($galeri->kategori == 'kegiatan') 📅 Kegiatan
            @elseif($galeri->kategori == 'pembangunan') 🏗️ Pembangunan
            @elseif($galeri->kategori == 'budaya') 🎭 Budaya
            @elseif($galeri->kategori == 'wisata') 🌲 Wisata
            @else 🏪 UMKM @endif
        </div>
        <h1 class="header-title">{{ $galeri->judul_galeri }}</h1>
        <div class="header-meta">
            <span><i class="fa-regular fa-calendar"></i> {{ $galeri->created_at->translatedFormat('d F Y') }}</span>
        </div>
    </div>

    {{-- Featured Image --}}
    <div class="featured-image fade-up delay-2">
        <img src="{{ asset('storage/' . $galeri->gambar_galeri) }}" alt="{{ $galeri->judul_galeri }}">
    </div>

    {{-- Description --}}
    @if($galeri->deskripsi)
    <div class="description-card fade-up delay-2">
        <h3><i class="fa-regular fa-file-lines"></i> Deskripsi</h3>
        <div class="description-text">
            {{ $galeri->deskripsi }}
        </div>
    </div>
    @endif

    {{-- Related Gallery --}}
    @if($rekomendasi->count() > 0)
    <div class="related-section fade-up delay-3">
        <div class="related-header">
            <div class="related-title">
                <i class="fa-regular fa-images"></i> Galeri Lainnya
            </div>
            <a href="{{ route('galeri') }}" class="related-link" style="font-size: 0.7rem; color: var(--primary); text-decoration: none;">Lihat Semua →</a>
        </div>
        <div class="related-grid">
            @foreach($rekomendasi as $item)
            <a href="{{ route('galeri.show', $item->id) }}" class="related-card">
                <div class="related-img">
                    <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="{{ $item->judul_galeri }}">
                </div>
                <h4>{{ Str::limit($item->judul_galeri, 35) }}</h4>
                <div class="related-date">
                    <i class="fa-regular fa-calendar"></i> {{ $item->created_at->translatedFormat('d M Y') }}
                </div>
            </a>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Tutorial Section --}}
    <div class="tutorial-section fade-up delay-3">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Detail Galeri</h3>
        </div>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>🖼️ Lihat Foto</h4>
                    <p>Foto ditampilkan dalam ukuran besar untuk melihat detail dokumentasi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>📝 Deskripsi</h4>
                    <p>Baca deskripsi singkat tentang foto tersebut jika tersedia.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>📸 Galeri Lainnya</h4>
                    <p>Jelajahi foto lain yang mungkin menarik di bagian bawah halaman.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">💡</div>
                <div class="tutorial-text">
                    <h4>Tips</h4>
                    <p>Klik "Kembali ke Galeri" untuk melihat semua dokumentasi desa.</p>
                </div>
            </div>
        </div>
        <div class="tutorial-footer">
            <i class="fa-regular fa-bell"></i>
            <span>💡 Dokumentasi ini adalah bukti nyata kemajuan dan kekayaan budaya Desa Lumban Silintong.</span>
        </div>
    </div>
</div>
@endsection