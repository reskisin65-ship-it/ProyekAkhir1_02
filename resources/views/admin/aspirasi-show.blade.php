{{-- resources/views/admin/aspirasi-show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Aspirasi - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">

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

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    .dashboard-wrapper {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Back Button */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.6rem 1.2rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 24px;
        color: #1e293b;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s;
        text-decoration: none;
        margin-bottom: 1.5rem;
    }

    .back-btn:hover {
        transform: translateX(-6px);
        border-color: var(--accent-primary);
        color: var(--accent-primary);
    }

    /* Detail Card */
    .detail-card {
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 32px;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #0a0a0a, #1a1a1a);
        padding: 1.5rem 2rem;
        color: white;
    }

    .card-header h1 {
        font-family: 'Instrument Sans', sans-serif;
        font-size: 1.5rem;
        font-weight: 700;
    }

    .card-body {
        padding: 2rem;
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .info-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
    }

    .info-value {
        font-size: 0.9rem;
        font-weight: 600;
        color: var(--text-main);
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

    /* Aspirasi Content */
    .aspirasi-content {
        background: #f8fafc;
        border-radius: 20px;
        padding: 1.2rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .aspirasi-content p {
        font-size: 0.9rem;
        line-height: 1.6;
        color: var(--text-main);
    }

    /* Response Section */
    .response-section {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 20px;
        padding: 1.2rem;
        border-left: 4px solid var(--accent-primary);
        margin-top: 1.5rem;
    }

    .response-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #059669;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border-color);
    }

    .btn-primary {
        padding: 0.7rem 1.5rem;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 24px;
        font-weight: 700;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        border: none;
        cursor: pointer;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(16,185,129,0.3);
    }

    .btn-secondary {
        padding: 0.7rem 1.5rem;
        background: transparent;
        border: 1.5px solid var(--border-color);
        color: var(--text-mute);
        border-radius: 24px;
        font-weight: 600;
        font-size: 0.8rem;
        text-decoration: none;
        transition: all 0.3s;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-secondary:hover {
        border-color: #ef4444;
        color: #ef4444;
    }

    @media (max-width: 768px) {
        .dashboard-wrapper { padding: 1rem; }
        .info-grid { grid-template-columns: 1fr; }
        .full-width { grid-column: span 1; }
        .action-buttons { flex-direction: column; }
        .btn-primary, .btn-secondary { justify-content: center; }
    }

    .fade-up {
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .aspirasi-content p {
    font-size: 0.9rem;
    line-height: 1.6;
    color: var(--text-main);
    word-wrap: break-word;      /* Memutus kata panjang */
    overflow-wrap: break-word;  /* Modern */
    white-space: normal;        /* Pastikan wrapping */
    max-width: 100%;            /* Mencegah overflow */
}

.aspirasi-content {
    overflow-x: auto;     /* optional: scroll horizontal jika terpaksa */
}
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    <!-- Back Button -->
    <a href="{{ route('admin.aspirasi.index') }}" class="back-btn fade-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Aspirasi
    </a>

    <!-- Detail Card -->
    <div class="detail-card fade-up" style="animation-delay: 0.1s">
        <div class="card-header">
            <h1>
                <i class="fa-regular fa-message mr-2"></i> 
                Detail Aspirasi
            </h1>
            <p class="text-white/60 text-sm mt-1">ID: #{{ $aspirasi->id_aspirasi }}</p>
        </div>
        
        <div class="card-body">
            <!-- Info Grid -->
            <div class="info-grid">
                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-regular fa-user"></i> Pengirim
                    </div>
                    <div class="info-value">
                        {{ $aspirasi->user->name ?? 'Warga' }}
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-regular fa-envelope"></i> Email
                    </div>
                    <div class="info-value">
                        {{ $aspirasi->user->email ?? '-' }}
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-tag"></i> Kategori
                    </div>
                    <div class="info-value">
                        <span class="category-pill 
                            @if($aspirasi->kategori == 'saran') cat-saran
                            @elseif($aspirasi->kategori == 'keluhan') cat-keluhan
                            @elseif($aspirasi->kategori == 'masukan') cat-masukan
                            @else cat-pertanyaan @endif"
                            style="display: inline-block; padding: 0.2rem 0.8rem; border-radius: 20px; font-size: 0.7rem; font-weight: 700;">
                            @if($aspirasi->kategori == 'saran') 💡 Saran
                            @elseif($aspirasi->kategori == 'keluhan') 😞 Keluhan
                            @elseif($aspirasi->kategori == 'masukan') 📝 Masukan
                            @else ❓ Pertanyaan @endif
                        </span>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-regular fa-calendar"></i> Tanggal
                    </div>
                    <div class="info-value">
                        {{ $aspirasi->created_at->translatedFormat('d F Y, H:i') }} WIB
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-label">
                        <i class="fa-solid fa-chart-line"></i> Status
                    </div>
                    <div class="info-value">
                        <span class="status-badge status-{{ $aspirasi->status }}" style="display: inline-flex; align-items: center; gap: 0.3rem; padding: 0.2rem 0.8rem;">
                            @if($aspirasi->status == 'baru') <i class="fa-regular fa-clock"></i> Baru
                            @elseif($aspirasi->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Diproses
                            @else <i class="fa-regular fa-circle-check"></i> Selesai @endif
                        </span>
                    </div>
                </div>
                
                <div class="info-item full-width">
                    <div class="info-label">
                        <i class="fa-regular fa-heading"></i> Judul
                    </div>
                    <div class="info-value">
                        {{ $aspirasi->judul }}
                    </div>
                </div>
            </div>
            
            <!-- Aspirasi Content -->
            <div class="aspirasi-content">
                <div class="info-label mb-2">
                    <i class="fa-regular fa-message"></i> Isi Aspirasi
                </div>
                <p>{{ $aspirasi->isi_aspirasi }}</p>
            </div>
            
            <!-- Response Section -->
            @if($aspirasi->respon_admin)
            <div class="response-section">
                <div class="response-label">
                    <i class="fa-regular fa-reply-all"></i> Respon Admin
                </div>
                <p>{{ $aspirasi->respon_admin }}</p>
                <div class="text-right text-xs text-emerald-600 mt-2">
                    <i class="fa-regular fa-clock"></i> Direspon: {{ $aspirasi->updated_at->translatedFormat('d F Y, H:i') }}
                </div>
            </div>
            @endif
            
            <!-- Action Buttons -->
            <div class="action-buttons">
                @if($aspirasi->status != 'selesai')
                <button onclick="openResponModal({{ $aspirasi->id_aspirasi }}, '{{ addslashes($aspirasi->judul) }}')" 
                        class="btn-primary">
                    <i class="fa-regular fa-reply"></i> Beri Respon
                </button>
                @endif
                
                @if($aspirasi->status == 'baru')
                <a href="{{ route('admin.aspirasi.status', $aspirasi->id_aspirasi) }}" 
                   class="btn-primary" style="background: linear-gradient(135deg, #3b82f6, #2563eb);"
                   onclick="return confirm('Ubah status menjadi diproses?')">
                    <i class="fa-solid fa-play"></i> Proses
                </a>
                @endif
                
                <form action="{{ route('admin.aspirasi.destroy', $aspirasi->id_aspirasi) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-secondary">
                        <i class="fa-solid fa-trash"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Respon -->
<div id="responModal" class="modal-overlay" style="display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.5); backdrop-filter: blur(4px); z-index: 1000; align-items: center; justify-content: center;">
    <div class="modal-container" style="background: white; border-radius: 32px; max-width: 500px; width: 90%; overflow: hidden;">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white">
                    <i class="fa-regular fa-reply mr-2"></i> Beri Respon
                </h3>
                <button onclick="closeResponModal()" class="text-white/80 hover:text-white">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>
        </div>
        
        <form id="formRespon" method="POST" class="p-6">
            @csrf
            <div class="mb-4">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-regular fa-message text-emerald-500 mr-1"></i> Aspirasi:
                </label>
                <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                    <p class="text-gray-700 text-sm" id="aspirasiJudul"></p>
                </div>
            </div>
            
            <div class="mb-5">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fa-regular fa-reply-all text-emerald-500 mr-1"></i> Respon / Tanggapan:
                </label>
                <textarea name="respon" rows="5" required
                          class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition resize-none"
                          placeholder="Tulis tanggapan untuk aspirasi warga..."></textarea>
                <p class="text-xs text-gray-400 mt-1">Respon akan langsung terlihat oleh masyarakat</p>
            </div>
            
            <div class="flex gap-3 justify-end">
                <button type="button" onclick="closeResponModal()" 
                        class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                    Batal
                </button>
                <button type="submit" 
                        class="px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold hover:from-emerald-600 hover:to-emerald-700 transition shadow-md flex items-center gap-2">
                    <i class="fa-regular fa-paper-plane"></i> Kirim Respon
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openResponModal(id, judul) {
        const modal = document.getElementById('responModal');
        const form = document.getElementById('formRespon');
        const judulEl = document.getElementById('aspirasiJudul');
        
        judulEl.innerHTML = judul;
        form.action = `/admin/aspirasi/${id}/respond`;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeResponModal() {
        const modal = document.getElementById('responModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeResponModal();
        }
    });
    
    window.onclick = function(event) {
        const modal = document.getElementById('responModal');
        if (event.target === modal) {
            closeResponModal();
        }
    }
</script>

<style>
    .category-pill {
        display: inline-block;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    .cat-saran { background: #d1fae5; color: #059669; }
    .cat-keluhan { background: #fee2e2; color: #dc2626; }
    .cat-masukan { background: #dbeafe; color: #2563eb; }
    .cat-pertanyaan { background: #f3e8ff; color: #9333ea; }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.2rem 0.8rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
    }
    .status-baru { background: #fef3c7; color: #d97706; }
    .status-diproses { background: #dbeafe; color: #2563eb; }
    .status-selesai { background: #d1fae5; color: #059669; }
    
    .modal-overlay {
        display: none;
    }
</style>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection