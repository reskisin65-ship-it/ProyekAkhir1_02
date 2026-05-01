{{-- resources/views/pages/berita-detail.blade.php --}}
@extends('layouts.app')

@section('title', $berita->judul)

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    /* ============================================
       DESIGN SYSTEM - CLEAN WHITE PREMIUM
    ============================================ */
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
        --dark: #0f172a;
        --dark-soft: #1e293b;
        --gray: #64748b;
        --gray-light: #94a3b8;
        --gray-soft: #f1f5f9;
        --bg: #ffffff;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 1px 2px rgba(0,0,0,0.02);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.04);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.06);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.08);
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
    ::-webkit-scrollbar-track { background: #f1f1f1; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--gray-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    /* Progress Bar */
    #scroll-progress {
        position: fixed;
        top: 0;
        left: 0;
        height: 3px;
        background: var(--primary);
        z-index: 1000;
        transition: width 0.1s ease;
        box-shadow: 0 0 8px rgba(16, 185, 129, 0.3);
    }

    /* Container */
    .container-premium {
        max-width: 900px;
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
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 0.05em;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition);
    }
    .breadcrumb-item:hover { color: var(--primary); }
    .breadcrumb-sep { color: var(--gray-light); font-size: 0.6rem; }
    .breadcrumb-current {
        color: var(--primary);
        font-weight: 700;
        max-width: 250px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* Header Section */
    .article-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .category-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 1.2rem;
        border-radius: 60px;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 1rem;
        background: var(--primary-soft);
        color: var(--primary-dark);
    }
    .article-title {
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
        color: var(--dark);
        margin-bottom: 1rem;
    }

    /* Meta Info */
    .meta-wrapper {
        display: flex;
        justify-content: center;
        gap: 1.5rem;
        flex-wrap: wrap;
        padding: 0.8rem 0;
        border-top: 1px solid var(--border);
        border-bottom: 1px solid var(--border);
        margin-bottom: 2rem;
    }
    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.75rem;
        color: var(--gray);
    }
    .meta-item i { color: var(--primary); font-size: 0.8rem; }

    /* Featured Image */
    .featured-wrapper {
        margin-bottom: 2rem;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
    }
    .featured-image img {
        width: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .featured-image:hover img { transform: scale(1.01); }

    /* Article Content */
    .prose-premium {
        font-size: 1rem;
        line-height: 1.8;
        color: #334155;
    }
    .prose-premium p {
        margin-bottom: 1.2rem;
    }
    .prose-premium h2 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 1.5rem 0 1rem;
        color: var(--dark);
    }
    .prose-premium h3 {
        font-size: 1.2rem;
        font-weight: 600;
        margin: 1.2rem 0 0.8rem;
        color: var(--dark);
    }
    .prose-premium blockquote {
        border-left: 3px solid var(--primary);
        padding-left: 1.2rem;
        margin: 1.2rem 0;
        font-style: italic;
        color: #475569;
    }
    .prose-premium ul, .prose-premium ol {
        margin: 0.8rem 0;
        padding-left: 1.5rem;
    }
    .prose-premium li { margin-bottom: 0.3rem; }
    .prose-premium a {
        color: var(--primary);
        text-decoration: none;
        border-bottom: 1px solid transparent;
        transition: var(--transition);
    }
    .prose-premium a:hover { border-bottom-color: var(--primary); }
    .prose-premium img {
        max-width: 100%;
        border-radius: 16px;
        margin: 1rem 0;
    }

    /* Dropcap */
    .dropcap::first-letter {
        font-size: 3.5rem;
        font-weight: 800;
        color: var(--primary);
        float: left;
        line-height: 0.8;
        margin-right: 0.5rem;
        font-family: 'Instrument Serif', serif;
    }

    /* Author Card */
    .author-card {
        background: var(--gray-soft);
        border-radius: 20px;
        padding: 1.2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 2rem;
    }
    .author-avatar {
        width: 48px;
        height: 48px;
        background: var(--primary);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .author-avatar i { font-size: 1.3rem; color: white; }
    .author-info h4 {
        font-weight: 700;
        margin-bottom: 0.2rem;
        font-size: 0.9rem;
    }
    .author-info p {
        font-size: 0.7rem;
        color: var(--gray);
    }
    .print-btn {
        margin-left: auto;
        padding: 0.5rem 1.2rem;
        background: white;
        border: 1px solid var(--border);
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--gray);
        cursor: pointer;
        transition: var(--transition);
    }
    .print-btn:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }

    /* Navigation Prev/Next */
    .nav-articles {
        margin-top: 2.5rem;
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        border-top: 1px solid var(--border);
        padding-top: 2rem;
    }
    .nav-prev, .nav-next {
        text-decoration: none;
        transition: var(--transition-bounce);
    }
    .nav-prev:hover, .nav-next:hover { transform: translateX(-3px); }
    .nav-next:hover { transform: translateX(3px); }
    .nav-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray-light);
        margin-bottom: 0.3rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .nav-title {
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark);
        line-height: 1.4;
    }
    .nav-prev:hover .nav-title { color: var(--primary); }
    .nav-next { text-align: right; }
    .nav-next .nav-label { justify-content: flex-end; }

    /* Related Section - BACKGROUND GELAP */
    .related-section-dark {
        margin-top: 2.5rem;
        background: linear-gradient(135deg, #0f172a, #1e293b);
        border-radius: 28px;
        padding: 2rem;
        transition: var(--transition);
    }
    .related-section-dark:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.2);
    }
    .related-header-dark {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    .related-title-dark {
        font-size: 1.1rem;
        font-weight: 800;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .related-title-dark i { color: var(--primary); font-size: 1.2rem; }
    .related-link-dark {
        font-size: 0.7rem;
        font-weight: 600;
        color: var(--primary-light);
        text-decoration: none;
        transition: var(--transition);
    }
    .related-link-dark:hover { color: white; }
    .related-grid-dark {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }
    .related-card-dark {
        text-decoration: none;
        transition: var(--transition-bounce);
    }
    .related-card-dark:hover {
        transform: translateY(-5px);
    }
    .related-img-dark {
        height: 150px;
        overflow: hidden;
        border-radius: 20px;
        margin-bottom: 0.8rem;
        background: #1e293b;
    }
    .related-img-dark img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }
    .related-card-dark:hover .related-img-dark img {
        transform: scale(1.05);
    }
    .related-card-dark h4 {
        font-size: 0.9rem;
        font-weight: 700;
        color: white;
        margin-bottom: 0.3rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        line-height: 1.4;
        transition: var(--transition);
    }
    .related-card-dark:hover h4 {
        color: var(--primary);
    }
    .related-date-dark {
        font-size: 0.65rem;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    .related-date-dark i { font-size: 0.6rem; }

    /* Tutorial Section */
    .tutorial-section {
        margin-top: 2rem;
        background: var(--gray-soft);
        border-radius: 20px;
        padding: 1.5rem;
        transition: var(--transition);
    }
    .tutorial-section:hover { background: #f8fafc; }
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
    .tutorial-intro {
        font-size: 0.75rem;
        color: var(--gray);
        margin-bottom: 1rem;
        line-height: 1.6;
    }
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
        background: white;
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

    /* Responsive */
    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .nav-articles { grid-template-columns: 1fr; gap: 1rem; }
        .nav-next { text-align: left; }
        .nav-next .nav-label { justify-content: flex-start; }
        .related-grid-dark { grid-template-columns: repeat(2, 1fr); }
        .tutorial-grid { grid-template-columns: 1fr; }
        .meta-wrapper { gap: 1rem; }
        .related-section-dark { padding: 1.2rem; }
    }

    @media (max-width: 480px) {
        .related-grid-dark { grid-template-columns: 1fr; }
        .author-card { flex-direction: column; text-align: center; }
        .print-btn { margin-left: 0; }
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .fade-up { animation: fadeInUp 0.5s ease forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }

    .tutorial-footer {
    margin-top: 1rem;
    padding: 0.7rem 1rem;
    background: #ecfdf5;
    border-radius: 16px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}
.tutorial-footer i { color: var(--primary); font-size: 0.8rem; }
.tutorial-footer span { font-size: 0.7rem; color: #059669; }
</style>

<div id="scroll-progress"></div>

<div class="container-premium">
    
    {{-- Breadcrumb --}}
    <div class="breadcrumb fade-up">
        <a href="{{ route('home') }}" class="breadcrumb-item"><i class="fa-solid fa-home mr-1"></i> Beranda</a>
        <span class="breadcrumb-sep">/</span>
        <a href="{{ route('berita') }}" class="breadcrumb-item">Berita</a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-current">{{ $berita->judul }}</span>
    </div>

    {{-- Header --}}
    <div class="article-header fade-up delay-1">
        <div class="category-badge">
            @if($berita->kategori == 'berita') 📰 Berita
            @elseif($berita->kategori == 'pengumuman') 📢 Pengumuman
            @else 🎉 Kegiatan @endif
        </div>
        <h1 class="article-title">{{ $berita->judul }}</h1>
    </div>

    {{-- Meta Info (Hanya Tanggal & Jumlah Pembaca) --}}
    <div class="meta-wrapper fade-up delay-2">
        <div class="meta-item"><i class="fa-regular fa-calendar"></i> {{ $berita->tanggal_publikasi->translatedFormat('d F Y') }}</div>
        <div class="meta-item"><i class="fa-regular fa-eye"></i> {{ number_format($berita->dibaca) }} pembaca</div>
    </div>

    {{-- Featured Image --}}
    @if($berita->gambar)
    <div class="featured-wrapper fade-up delay-2">
        <div class="featured-image">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}">
        </div>
    </div>
    @endif

    {{-- Article Content --}}
    <div class="prose-premium dropcap fade-up delay-3">
        {!! nl2br(e($berita->isi_berita)) !!}
    </div>

    {{-- Author Card --}}
    <div class="author-card fade-up delay-3">
        <div class="author-avatar">
            <i class="fa-regular fa-user"></i>
        </div>
        <div class="author-info">
            <h4>Admin Desa Lumban Silintong</h4>
            <p><i class="fa-regular fa-envelope"></i> desa@lumbansilintong.id</p>
        </div>
        <button onclick="window.print()" class="print-btn">
            <i class="fa-solid fa-print"></i> Cetak Artikel
        </button>
    </div>

    {{-- Navigation Prev/Next Berita --}}
    <div class="nav-articles fade-up delay-3">
        @if($prevBerita)
        <a href="{{ route('berita.show', $prevBerita->slug) }}" class="nav-prev">
            <div class="nav-label">
                <i class="fa-solid fa-arrow-left"></i> Sebelumnya
            </div>
            <div class="nav-title">{{ Str::limit($prevBerita->judul, 50) }}</div>
        </a>
        @else
        <div></div>
        @endif
        
        @if($nextBerita)
        <a href="{{ route('berita.show', $nextBerita->slug) }}" class="nav-next">
            <div class="nav-label">
                Selanjutnya <i class="fa-solid fa-arrow-right"></i>
            </div>
            <div class="nav-title">{{ Str::limit($nextBerita->judul, 50) }}</div>
        </a>
        @endif
    </div>

    {{-- Related Section - Baca Juga (Background Gelap) --}}
    @if(isset($rekomendasi) && $rekomendasi->count() > 0)
    <div class="related-section-dark fade-up delay-3">
        <div class="related-header-dark">
            <div class="related-title-dark">
                <i class="fa-regular fa-book-open"></i> Baca Juga
            </div>
            <a href="{{ route('berita') }}" class="related-link-dark">Lihat Semua →</a>
        </div>
        <div class="related-grid-dark">
            @foreach($rekomendasi as $item)
            <a href="{{ route('berita.show', $item->slug) }}" class="related-card-dark">
                <div class="related-img-dark">
                    <img src="{{ $item->gambar ? asset('storage/' . $item->gambar) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=400' }}" alt="{{ $item->judul }}">
                </div>
                <h4>{{ $item->judul }}</h4>
                <div class="related-date-dark">
                    <i class="fa-regular fa-calendar"></i> {{ $item->tanggal_publikasi->translatedFormat('d M Y') }}
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
            <h3>📖 Tentang Halaman Detail Berita</h3>
        </div>
        <p class="tutorial-intro">
            Halaman ini menampilkan informasi lengkap dari berita yang Anda pilih. Berikut panduan menggunakan halaman ini:
        </p>
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📰 Membaca Berita</h4>
                    <p>Gulir halaman ke bawah untuk membaca seluruh isi berita. Konten ditampilkan dengan tipografi yang nyaman untuk dibaca.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>📅 Informasi Publikasi</h4>
                    <p>Lihat tanggal berita dipublikasikan dan jumlah pembaca di bagian atas artikel, tepat di bawah judul.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>🖨️ Cetak Artikel</h4>
                    <p>Klik tombol <strong>"Cetak Artikel"</strong> di bagian bawah artikel untuk menyimpan sebagai PDF atau mencetak langsung.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>⏮️ Navigasi Berita</h4>
                    <p>Gunakan tombol <strong>"Sebelumnya"</strong> dan <strong>"Selanjutnya"</strong> untuk berpindah ke artikel lain tanpa harus kembali ke halaman daftar berita.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>📖 Baca Juga</h4>
                    <p>Di bagian <strong>"Baca Juga"</strong> dengan latar gelap, Anda dapat menemukan 3 artikel terbaru lainnya yang mungkin menarik.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>⬆️ Progress Bar</h4>
                    <p>Garis hijau di bagian paling atas halaman menunjukkan sejauh mana Anda telah membaca artikel.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">💡</div>
                <div class="tutorial-text">
                    <h4>Tips Membaca</h4>
                    <p>Klik judul berita di bagian "Baca Juga" untuk langsung membuka artikel tersebut. Semakin banyak Anda membaca, semakin terinformasi!</p>
                </div>
            </div>
        </div>
        <div class="tutorial-footer">
            <i class="fa-regular fa-bell"></i>
            <span>💡 <strong>Info:</strong> Artikel yang sudah Anda baca akan tercatat dalam statistik total pembaca desa.</span>
        </div>
    </div>
</div>

<script>
    // Scroll Progress Bar
    window.addEventListener('scroll', function() {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        document.getElementById('scroll-progress').style.width = scrolled + '%';
    });
</script>
@endsection