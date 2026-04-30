@extends('layouts.app')

@section('title', 'Panel Admin - Lumban Silintong')

@section('content')
<!-- High-End Typography -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;700;800&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@100;300&display=swap" rel="stylesheet">

<style>
    :root {
        --bg-color: #f8fafc;
        --line-color: #e2e8f0;
        --text-primary: #0f172a;
        --text-secondary: #64748b;
        --transition: all 0.5s cubic-bezier(0.23, 1, 0.32, 1);
        
        --blue: #3b82f6;
        --orange: #f59e0b;
        --green: #10b981;
        --purple: #8b5cf6;
        --pink: #ec4899;
        --cyan: #06b6d4;
        --teal: #14b8a6;
    }

    .dashboard-container {
        background-color: var(--bg-color);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-primary);
        min-height: 100vh;
        background-image: 
            radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.02) 0px, transparent 50%),
            radial-gradient(at 100% 100%, rgba(139, 92, 246, 0.02) 0px, transparent 50%);
    }

    .dashboard-wrapper {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Hairline Grid */
    .hairline-grid {
        position: fixed;
        inset: 0;
        background-image: 
            linear-gradient(to right, var(--line-color) 0.5px, transparent 0.5px),
            linear-gradient(to bottom, var(--line-color) 0.5px, transparent 0.5px);
        background-size: 60px 60px;
        pointer-events: none;
        z-index: 0;
        opacity: 0.3;
    }

    /* Header Premium */
    .master-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 3rem;
        position: relative;
        z-index: 2;
        flex-wrap: wrap;
        gap: 2rem;
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        border-radius: 32px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0,0,0,0.02);
        border: 1px solid var(--line-color);
    }

    .header-left {
        flex: 1;
    }

    .section-tag {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        color: var(--blue);
        margin-bottom: 1.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(59,130,246,0.08);
        padding: 0.3rem 1rem 0.3rem 0.8rem;
        border-radius: 0 20px 20px 0;
    }

    .header-title-large {
        margin-bottom: 1rem;
    }

    .main-title {
        font-family: 'Instrument Serif', serif;
        font-size: clamp(3rem, 8vw, 5rem);
        font-weight: 400;
        line-height: 1;
        color: var(--text-primary);
        letter-spacing: -0.03em;
    }

    .sub-title {
        font-family: 'Instrument Serif', serif;
        font-size: clamp(3rem, 8vw, 5rem);
        font-weight: 400;
        line-height: 1;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin-top: -0.2rem;
    }

    .sub-title .dot {
        color: var(--blue);
        -webkit-text-fill-color: var(--blue);
    }

    .header-desc p {
        font-size: 0.85rem;
        color: var(--text-secondary);
        margin-bottom: 0.8rem;
        letter-spacing: -0.01em;
    }

    .header-stats-badge {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .badge-item {
        font-size: 0.7rem;
        color: var(--text-secondary);
        background: #f1f5f9;
        padding: 0.3rem 0.8rem;
        border-radius: 30px;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
    }

    .badge-item i {
        font-size: 0.65rem;
        color: var(--green);
    }

    /* Clock Premium */
    .header-right {
        flex-shrink: 0;
    }

    .system-clock-premium {
        display: flex;
        align-items: center;
        gap: 1rem;
        background: linear-gradient(135deg, #f1f5f9, #ffffff);
        padding: 1rem 1.8rem;
        border-radius: 28px;
        border: 1px solid var(--line-color);
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
    }

    .clock-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem;
    }

    .clock-info {
        text-align: right;
    }

    .clock-time {
        font-family: 'JetBrains Mono', monospace;
        font-size: 1.8rem;
        font-weight: 700;
        letter-spacing: -0.02em;
        color: var(--text-primary);
        line-height: 1;
    }

    .clock-date {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-secondary);
        margin-top: 0.2rem;
    }

    .clock-greeting {
        font-size: 0.7rem;
        color: var(--text-secondary);
        margin-top: 0.3rem;
    }

    .clock-greeting strong {
        color: var(--blue);
        font-weight: 700;
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1.5rem;
        margin-bottom: 3rem;
        position: relative;
        z-index: 2;
    }

    .stat-card {
        background: white;
        border-radius: 28px;
        padding: 1.5rem;
        transition: var(--transition);
        border: 1px solid var(--line-color);
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px rgba(0,0,0,0.05);
        border-color: transparent;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
    }

    .stat-info h3 {
        font-size: 1.8rem;
        font-weight: 800;
        letter-spacing: -0.03em;
        line-height: 1;
    }

    .stat-info p {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--text-secondary);
        margin-top: 0.3rem;
    }

    /* Section Title */
    .section-title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 2rem 0 1.2rem;
    }

    .section-title h2 {
        font-family: 'Instrument Serif', serif;
        font-size: 1.5rem;
        font-weight: 400;
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .section-title a {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-secondary);
        text-decoration: none;
        transition: var(--transition);
    }

    .section-title a:hover {
        color: var(--blue);
        gap: 0.5rem;
    }

    /* 2 Column Layout */
    .two-columns {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.8rem;
        position: relative;
        z-index: 2;
    }

    /* Content Cards */
    .content-card {
        background: white;
        border-radius: 24px;
        border: 1px solid var(--line-color);
        overflow: hidden;
        transition: var(--transition);
    }

    .content-card:hover {
        box-shadow: 0 10px 30px rgba(0,0,0,0.04);
    }

    .card-header {
        padding: 1rem 1.2rem;
        border-bottom: 1px solid var(--line-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        font-size: 0.9rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-body {
        padding: 1rem;
    }

    /* List Items */
    .list-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 0;
        border-bottom: 1px solid var(--line-color);
    }

    .list-item:last-child {
        border-bottom: none;
    }

    .item-info h4 {
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.2rem;
    }

    .item-info p {
        font-size: 0.65rem;
        color: var(--text-secondary);
        display: flex;
        gap: 0.8rem;
    }

    /* Badges */
    .badge {
        font-size: 0.6rem;
        padding: 0.2rem 0.7rem;
        border-radius: 30px;
        font-weight: 700;
        text-transform: uppercase;
    }

    .badge-menunggu { background: #fed7aa; color: #ea580c; }
    .badge-diproses { background: #dbeafe; color: #2563eb; }
    .badge-selesai { background: #d1fae5; color: #059669; }
    .badge-ditolak { background: #fee2e2; color: #dc2626; }
    .badge-baru { background: #e9d5ff; color: #7c3aed; }

    /* Gallery Grid */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.8rem;
    }

    .gallery-item {
        aspect-ratio: 1;
        border-radius: 14px;
        overflow: hidden;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        cursor: pointer;
        transition: var(--transition);
    }

    .gallery-item:hover {
        transform: scale(1.02);
    }

    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Berita Item */
    .berita-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.8rem 0;
        border-bottom: 1px solid var(--line-color);
    }

    .berita-item:last-child {
        border-bottom: none;
    }

    .berita-img {
        width: 60px;
        height: 60px;
        border-radius: 14px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .berita-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .berita-content h4 {
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
    }

    .berita-content p {
        font-size: 0.6rem;
        color: var(--text-secondary);
    }

    /* Pengurus Grid */
    .pengurus-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.8rem;
    }

    .pengurus-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem;
        background: #f8fafc;
        border-radius: 16px;
        transition: var(--transition);
        cursor: pointer;
    }

    .pengurus-item:hover {
        background: #f1f5f9;
        transform: translateX(3px);
    }

    .pengurus-avatar {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, var(--teal), var(--cyan));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
    }

    .pengurus-info h4 {
        font-size: 0.75rem;
        font-weight: 700;
    }

    .pengurus-info p {
        font-size: 0.6rem;
        color: var(--text-secondary);
    }

    /* UMKM Grid */
    .umkm-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0.8rem;
    }

    .umkm-item {
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem;
        background: #fffbeb;
        border-radius: 16px;
        transition: var(--transition);
        cursor: pointer;
    }

    .umkm-item:hover {
        background: #fef3c7;
        transform: translateX(3px);
    }

    /* Floating Button */
    .fab {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        cursor: pointer;
        transition: var(--transition);
        z-index: 100;
        box-shadow: 0 10px 25px rgba(59, 130, 246, 0.3);
    }

    .fab:hover {
        transform: scale(1.1) rotate(90deg);
    }

    /* Footer */
    .zen-footer {
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid var(--line-color);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        position: relative;
        z-index: 2;
    }

    /* Animations */
    .reveal-up {
        animation: revealUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes revealUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1.5rem; }
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .two-columns { grid-template-columns: 1fr; gap: 1.5rem; }
        .master-header { flex-direction: column; align-items: flex-start; }
    }

    @media (max-width: 640px) {
        .stats-grid { grid-template-columns: 1fr; }
    }

    .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
</style>

<div class="dashboard-container">
    <div class="hairline-grid"></div>

    <div class="dashboard-wrapper">
        
        <!-- Floating Action Button -->
        <div class="fab" onclick="window.location.href='{{ route('admin.pengajuan-surat.index') }}'" title="Tambah Pengajuan Baru">
            <i class="fa-solid fa-plus"></i>
        </div>

        <!-- Header Section -->
        <header class="master-header reveal-up">
            <div class="header-left">
                <div class="section-tag">
                    <i class="fa-regular fa-gem mr-2"></i> PANEL ADMIN
                </div>
                <div class="header-title-large">
                    <h1 class="main-title">Lumban</h1>
                    <h1 class="sub-title">Silintong<span class="dot">.</span></h1>
                </div>
                <div class="header-desc">
                    <p>Dasbor Eksekutif & Pusat Kendali</p>
                    <div class="header-stats-badge">
                        <span class="badge-item"><i class="fa-regular fa-circle-check"></i> Sistem Online</span>
                        <span class="badge-item"><i class="fa-regular fa-shield"></i> Koneksi Aman</span>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <div class="system-clock-premium">
                    <div class="clock-icon">
                        <i class="fa-regular fa-clock"></i>
                    </div>
                    <div class="clock-info">
                        <div class="clock-time" id="realtime-clock">{{ \Carbon\Carbon::now()->format('H:i') }}</div>
                        <div class="clock-date">{{ \Carbon\Carbon::now()->translatedFormat('l, d F Y') }}</div>
                        <div class="clock-greeting">Selamat datang, <strong>{{ Auth::user()->name ?? 'Administrator' }}</strong></div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Statistics Cards -->
        <div class="stats-grid reveal-up" style="animation-delay: 0.05s">
            <div class="stat-card" onclick="window.location.href='{{ route('admin.penduduk.index') }}'">
                <div class="stat-icon" style="background: rgba(59,130,246,0.1); color: var(--blue);"><i class="fa-solid fa-users"></i></div>
                <div class="stat-info">
                    <h3>{{ number_format($totalPenduduk ?? 0) }}</h3>
                    <p>Total Penduduk</p>
                </div>
            </div>
            <div class="stat-card" onclick="window.location.href='{{ route('admin.umkm.index') }}'">
                <div class="stat-icon" style="background: rgba(245,158,11,0.1); color: var(--orange);"><i class="fa-solid fa-store"></i></div>
                <div class="stat-info">
                    <h3>{{ number_format($totalUmkm ?? 0) }}</h3>
                    <p>UMKM Terdaftar</p>
                </div>
            </div>
            <div class="stat-card" onclick="window.location.href='{{ route('admin.pengajuan-surat.index') }}'">
                <div class="stat-icon" style="background: rgba(16,185,129,0.1); color: var(--green);"><i class="fa-regular fa-file-lines"></i></div>
                <div class="stat-info">
                    <h3>{{ number_format($totalSurat ?? 0) }}</h3>
                    <p>Pengajuan Surat</p>
                </div>
            </div>
            <div class="stat-card" onclick="window.location.href='{{ route('admin.aspirasi.index') }}'">
                <div class="stat-icon" style="background: rgba(139,92,246,0.1); color: var(--purple);"><i class="fa-solid fa-message"></i></div>
                <div class="stat-info">
                    <h3>{{ number_format($totalAspirasi ?? 0) }}</h3>
                    <p>Aspirasi Warga</p>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="two-columns">
            
            <!-- LEFT COLUMN -->
            <div class="reveal-up" style="animation-delay: 0.1s">
                
                <!-- Pengajuan Surat -->
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fa-regular fa-file-lines" style="color: var(--green);"></i> Pengajuan Surat Terbaru</h3>
                        <a href="{{ route('admin.pengajuan-surat.index') }}">Lihat Semua →</a>
                    </div>
                    <div class="card-body">
                        @forelse($pengajuanTerbaru->take(5) as $item)
                        <div class="list-item">
                            <div class="item-info">
                                <h4>{{ $item->jenis_surat }}</h4>
                                <p><i class="fa-regular fa-user"></i> {{ $item->user->name ?? 'User' }} • <i class="fa-regular fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="badge badge-{{ $item->status }}">{{ $item->status }}</span>
                        </div>
                        @empty
                        <p class="text-center py-8 text-gray-400">Belum ada pengajuan surat</p>
                        @endforelse
                    </div>
                </div>

                <!-- Berita -->
                <div class="content-card" style="margin-top: 1.5rem;">
                    <div class="card-header">
                        <h3><i class="fa-regular fa-newspaper" style="color: var(--blue);"></i> Berita Terbaru</h3>
                        <a href="{{ route('admin.berita.index') }}">Lihat Semua →</a>
                    </div>
                    <div class="card-body">
                        @php
                            $beritaItems = App\Models\Berita::orderBy('created_at', 'desc')->take(4)->get();
                        @endphp
                        @forelse($beritaItems as $item)
                        <div class="berita-item">
                            <div class="berita-img">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}">
                                @else
                                    <i class="fa-regular fa-image"></i>
                                @endif
                            </div>
                            <div class="berita-content">
                                <h4 class="line-clamp-1">{{ $item->judul }}</h4>
                                <p>{{ $item->created_at->format('d M Y') }} • {{ $item->kategori }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8">
                            <i class="fa-regular fa-newspaper text-4xl text-gray-300 mb-2 block"></i>
                            <p class="text-gray-400">Belum ada berita</p>
                        </div>
                        @endforelse
                    </div>
                </div>

                <!-- Galeri -->
                <div class="content-card" style="margin-top: 1.5rem;">
                    <div class="card-header">
                        <h3><i class="fa-regular fa-image" style="color: var(--pink);"></i> Galeri Terbaru</h3>
                        <a href="{{ route('admin.galeri.index') }}">Lihat Semua →</a>
                    </div>
                    <div class="card-body">
                        @php
                            $galeriItems = App\Models\Galeri::latest()->take(6)->get();
                        @endphp
                        @if($galeriItems->count() > 0)
                        <div class="gallery-grid">
                            @foreach($galeriItems as $item)
                            <div class="gallery-item" onclick="window.location.href='{{ route('admin.galeri.index') }}'">
                                @if($item->gambar_galeri)
                                    <img src="{{ asset('storage/' . $item->gambar_galeri) }}" alt="Galeri">
                                @else
                                    <i class="fa-regular fa-image"></i>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-center py-8 text-gray-400">Belum ada galeri</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN -->
            <div class="reveal-up" style="animation-delay: 0.15s">
                
                <!-- Aspirasi -->
                <div class="content-card">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-message" style="color: var(--purple);"></i> Aspirasi Terbaru</h3>
                        <a href="{{ route('admin.aspirasi.index') }}">Lihat Semua →</a>
                    </div>
                    <div class="card-body">
                        @forelse($aspirasiTerbaru->take(4) as $item)
                        <div class="list-item">
                            <div class="item-info">
                                <h4 class="line-clamp-1">{{ $item->judul }}</h4>
                                <p><i class="fa-regular fa-user"></i> {{ $item->user->name ?? 'Anonim' }} • <i class="fa-regular fa-clock"></i> {{ $item->created_at->diffForHumans() }}</p>
                            </div>
                            <span class="badge badge-baru">Baru</span>
                        </div>
                        @empty
                        <p class="text-center py-8 text-gray-400">Belum ada aspirasi</p>
                        @endforelse
                    </div>
                </div>

                <!-- UMKM -->
                <div class="content-card" style="margin-top: 1.5rem;">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-store" style="color: var(--orange);"></i> UMKM Terbaru</h3>
                        <a href="{{ route('admin.umkm.index') }}">Lihat Semua →</a>
                    </div>
                    <div class="card-body">
                        @if($umkmTerbaru->count() > 0)
                        <div class="umkm-grid">
                            @foreach($umkmTerbaru->take(4) as $item)
                            <div class="umkm-item" onclick="window.location.href='{{ route('admin.umkm.index') }}'">
                                <div class="pengurus-avatar" style="background: linear-gradient(135deg, #f59e0b, #fb923c);">
                                    <i class="fa-solid fa-store text-sm"></i>
                                </div>
                                <div class="pengurus-info">
                                    <h4 class="line-clamp-1">{{ $item->nama_usaha }}</h4>
                                    <p>{{ $item->kategori }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-center py-8 text-gray-400">Belum ada UMKM</p>
                        @endif
                    </div>
                </div>

                <!-- Pengurus Desa -->
                <div class="content-card" style="margin-top: 1.5rem;">
                    <div class="card-header">
                        <h3><i class="fa-solid fa-user-tie" style="color: var(--teal);"></i> Pengurus Desa</h3>
                        <a href="{{ route('admin.pengurus.index') }}">Lihat Semua →</a>
                    </div>
                    <div class="card-body">
                        @php
                            $pengurusItems = App\Models\DataPengurus::latest()->take(4)->get();
                        @endphp
                        @if($pengurusItems->count() > 0)
                        <div class="pengurus-grid">
                            @foreach($pengurusItems as $item)
                            <div class="pengurus-item" onclick="window.location.href='{{ route('admin.pengurus.index') }}'">
                                <div class="pengurus-avatar">{{ substr($item->nama_pengurus, 0, 1) }}</div>
                                <div class="pengurus-info">
                                    <h4 class="line-clamp-1">{{ $item->nama_pengurus }}</h4>
                                    <p>{{ $item->jabatan }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <p class="text-center py-8 text-gray-400">Belum ada data pengurus</p>
                        @endif
                    </div>
                </div>

                <!-- Statistik Keuangan -->
                <div class="content-card" style="margin-top: 1.5rem; background: linear-gradient(135deg, #064e3b, #0d9488); color: white;">
                    <div class="card-header" style="border-bottom-color: rgba(255,255,255,0.1);">
                        <h3 style="color: white;"><i class="fa-solid fa-coins"></i> Statistik Keuangan</h3>
                        <a href="{{ route('admin.keuangan.index') }}" style="color: rgba(255,255,255,0.7);">Kelola →</a>
                    </div>
                    <div class="card-body">
                        @php
                            $totalPemasukan = App\Models\TransaksiKeuangan::where('jenis', 'pemasukan')->sum('jumlah') ?? 0;
                            $totalPengeluaran = App\Models\TransaksiKeuangan::where('jenis', 'pengeluaran')->sum('jumlah') ?? 0;
                            $saldoAkhir = $totalPemasukan - $totalPengeluaran;
                            $bulanIni = App\Models\TransaksiKeuangan::whereMonth('created_at', date('m'))->count();
                        @endphp
                        
                        <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                            <div style="flex: 1; text-align: center; padding: 0.5rem; background: rgba(255,255,255,0.1); border-radius: 16px;">
                                <div style="font-size: 0.55rem; opacity: 0.7;">PEMASUKAN</div>
                                <div style="font-size: 1rem; font-weight: 800;">Rp {{ number_format($totalPemasukan) }}</div>
                            </div>
                            <div style="flex: 1; text-align: center; padding: 0.5rem; background: rgba(255,255,255,0.1); border-radius: 16px;">
                                <div style="font-size: 0.55rem; opacity: 0.7;">PENGELUARAN</div>
                                <div style="font-size: 1rem; font-weight: 800;">Rp {{ number_format($totalPengeluaran) }}</div>
                            </div>
                        </div>
                        
                        <div style="background: rgba(255,255,255,0.08); border-radius: 12px; padding: 0.8rem; margin-bottom: 0.8rem;">
                            <div style="display: flex; justify-content: space-between; margin-bottom: 0.3rem;">
                                <span style="font-size: 0.7rem;"><i class="fa-solid fa-wallet"></i> Saldo Akhir</span>
                                <span style="font-size: 1rem; font-weight: 800; color: #fbbf24;">Rp {{ number_format($saldoAkhir) }}</span>
                            </div>
                            @php
                                $percentage = $totalPemasukan > 0 ? ($totalPengeluaran / $totalPemasukan) * 100 : 0;
                            @endphp
                            <div style="background: rgba(255,255,255,0.2); border-radius: 10px; height: 4px;">
                                <div style="background: #fbbf24; width: {{ min($percentage, 100) }}%; height: 4px; border-radius: 10px;"></div>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 0.5rem; margin-top: 0.5rem;">
                            <a href="{{ route('admin.keuangan.create') }}" style="flex: 1; text-align: center; background: rgba(255,255,255,0.1); padding: 0.4rem; border-radius: 12px; font-size: 0.6rem; text-decoration: none; color: white;">
                                <i class="fa-solid fa-plus"></i> Tambah Transaksi
                            </a>
                            <a href="{{ route('admin.keuangan.laporan') }}" style="flex: 1; text-align: center; background: rgba(255,255,255,0.1); padding: 0.4rem; border-radius: 12px; font-size: 0.6rem; text-decoration: none; color: white;">
                                <i class="fa-solid fa-chart-line"></i> Lihat Laporan
                            </a>
                        </div>
                        
                        <div style="font-size: 0.55rem; opacity: 0.6; margin-top: 0.8rem; text-align: center;">
                            <i class="fa-regular fa-calendar"></i> Transaksi bulan ini: {{ $bulanIni }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="zen-footer reveal-up" style="animation-delay: 0.2s">
            <div style="font-family: 'Instrument Serif', serif; font-size: 1rem;">Lumban Silintong.</div>
            <div style="font-size: 0.65rem; color: var(--text-secondary);">© 2026 Infrastruktur Digital Desa</div>
        </footer>

    </div>
</div>

<script>
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const clockEl = document.getElementById('realtime-clock');
        if(clockEl) clockEl.textContent = `${hours}:${minutes}`;
    }
    setInterval(updateClock, 1000);
    updateClock();
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection