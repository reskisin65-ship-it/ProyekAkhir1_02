@extends('layouts.admin')

@section('title', 'Detail Galeri - Lumban Silintong')

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
        --orange: #f59e0b;
        --red: #ef4444;
    }

    body {
        background: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Container */
    .premium-container {
        max-width: 1200px;
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

    /* Detail Card */
    .detail-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 32px;
        overflow: hidden;
        transition: var(--transition);
    }

    .detail-card:hover {
        box-shadow: 0 20px 40px -12px rgba(0, 0, 0, 0.1);
        background: rgba(255, 255, 255, 0.95);
    }

    /* Image Section */
    .image-section {
        position: relative;
        background: #f1f5f9;
        min-height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .detail-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .image-section:hover .detail-image {
        transform: scale(1.02);
    }

    /* Category Badge Overlay */
    .category-overlay {
        position: absolute;
        top: 1.5rem;
        left: 1.5rem;
        padding: 0.4rem 1rem;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        backdrop-filter: blur(8px);
        background: rgba(0,0,0,0.6);
        color: white;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    /* Info Section */
    .info-section {
        padding: 2rem;
    }

    .info-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1rem;
        line-height: 1.3;
    }

    /* Info Table */
    .info-table {
        width: 100%;
        margin: 1.5rem 0;
    }

    .info-table tr {
        border-bottom: 1px solid #e2e8f0;
    }

    .info-table tr:last-child {
        border-bottom: none;
    }

    .info-table th {
        text-align: left;
        padding: 1rem 0;
        font-weight: 600;
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        width: 35%;
    }

    .info-table td {
        padding: 1rem 0;
        font-size: 0.9rem;
        color: #1e293b;
        font-weight: 500;
    }

    /* Meta Info */
    .meta-info {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid #e2e8f0;
    }

    .meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: #64748b;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
        flex-wrap: wrap;
    }

    .btn-edit {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        background: linear-gradient(135deg, #f59e0b, #d97706);
        color: white;
        border-radius: 24px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(245,158,11,0.25);
    }

    .btn-edit:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(245,158,11,0.35);
        gap: 0.8rem;
    }

    .btn-delete {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.8rem;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: white;
        border-radius: 24px;
        font-weight: 700;
        font-size: 0.85rem;
        border: none;
        cursor: pointer;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(239,68,68,0.25);
    }

    .btn-delete:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(239,68,68,0.35);
        gap: 0.8rem;
    }

    /* Category Color Variants */
    .category-bg-kegiatan { background: linear-gradient(135deg, #3b82f6, #2563eb); }
    .category-bg-pembangunan { background: linear-gradient(135deg, #f59e0b, #d97706); }
    .category-bg-budaya { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
    .category-bg-wisata { background: linear-gradient(135deg, #14b8a6, #0d9488); }
    .category-bg-umkm { background: linear-gradient(135deg, #ec4899, #db2777); }
    .category-bg-alam { background: linear-gradient(135deg, #10b981, #059669); }

    /* Responsive */
    @media (max-width: 900px) {
        .premium-container { padding: 1rem; }
        .detail-card { border-radius: 24px; }
        .image-section { min-height: 300px; }
        .info-section { padding: 1.5rem; }
        .info-title { font-size: 1.2rem; }
        .action-buttons { flex-direction: column; }
        .btn-edit, .btn-delete { justify-content: center; }
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
    <a href="{{ route('admin.galeri.index') }}" class="back-btn fade-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Galeri
    </a>

    <!-- Page Header -->
    <div class="page-header fade-up delay-1">
        <div class="page-badge">DETAIL FOTO</div>
        <h1 class="page-title">Detail <span>Galeri</span></h1>
    </div>

    <!-- Detail Card -->
    <div class="detail-card fade-up delay-2">
        <div class="grid md:grid-cols-2">
            <!-- Image Section -->
            <div class="image-section">
                <img src="{{ asset('storage/' . $galeri->gambar_galeri) }}" 
                     class="detail-image" 
                     alt="{{ $galeri->judul_galeri }}">
                
                <!-- Category Badge Overlay -->
                <div class="category-overlay category-bg-{{ $galeri->kategori }}">
                    <i class="fa-regular fa-folder-open"></i>
                    {{ ucfirst($galeri->kategori) }}
                </div>
            </div>

            <!-- Info Section -->
            <div class="info-section">
                <h1 class="info-title">{{ $galeri->judul_galeri }}</h1>

                <!-- Meta Info -->
                <div class="meta-info">
                    <div class="meta-item">
                        <i class="fa-regular fa-calendar text-emerald-500"></i>
                        <span>{{ $galeri->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa-regular fa-clock text-emerald-500"></i>
                        <span>{{ $galeri->created_at->format('H:i') }} WIB</span>
                    </div>
                    <div class="meta-item">
                        <i class="fa-regular fa-id-card text-emerald-500"></i>
                        <span>ID: {{ $galeri->id_galeri }}</span>
                    </div>
                </div>

                <!-- Info Table -->
                <table class="info-table">
                    <tr>
                        <th><i class="fa-regular fa-heading mr-2"></i> Judul</th>
                        <td>{{ $galeri->judul_galeri }}</td>
                    </tr>
                    <tr>
                        <th><i class="fa-solid fa-tag mr-2"></i> Kategori</th>
                        <td>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold category-bg-{{ $galeri->kategori }} text-white">
                                <i class="fa-regular fa-folder-open text-[10px]"></i>
                                {{ ucfirst($galeri->kategori) }}
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <th><i class="fa-regular fa-calendar-plus mr-2"></i> Tanggal Upload</th>
                        <td>{{ $galeri->created_at->translatedFormat('d F Y, H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <th><i class="fa-regular fa-pen-to-square mr-2"></i> Terakhir Update</th>
                        <td>{{ $galeri->updated_at->translatedFormat('d F Y, H:i') }} WIB</td>
                    </tr>
                    <tr>
                        <th><i class="fa-regular fa-clock mr-2"></i> Waktu Upload</th>
                        <td>{{ $galeri->created_at->diffForHumans() }}</td>
                    </tr>
                </table>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <a href="{{ route('admin.galeri.edit', $galeri->id_galeri) }}" class="btn-edit">
                        <i class="fa-solid fa-pen"></i> Edit Foto
                    </a>
                    <form action="{{ route('admin.galeri.destroy', $galeri->id_galeri) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus foto ini?')" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">
                            <i class="fa-solid fa-trash"></i> Hapus Foto
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection