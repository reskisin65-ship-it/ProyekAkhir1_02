@extends('layouts.admin')

@section('title', 'Kelola Aspirasi - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --system-bg: #0a0a0a;
        --card-bg: #ffffff;
        --accent-primary: #10b981;
        --accent-yellow: #f59e0b;
        --accent-blue: #3b82f6;
        --accent-purple: #8b5cf6;
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

    .font-display { font-family: 'Instrument Sans', sans-serif; }

    /* Background Pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    /* Premium Container */
    .dashboard-wrapper {
        max-width: 1440px;
        margin: 0 auto;
        padding: 2rem 2rem;
    }

    /* Ultra-Nav */
    .editorial-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 3rem;
    }

    .brand-title {
        font-size: 3rem;
        font-weight: 800;
        line-height: 0.9;
        letter-spacing: -0.05em;
        color: var(--system-bg);
    }

    .brand-subtitle {
        font-size: 0.9rem;
        color: var(--text-mute);
        margin-top: 1rem;
        max-width: 450px;
        line-height: 1.6;
    }

    /* Stats Grid */
    .stats-architecture {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-node {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 24px;
        padding: 1.2rem;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .stat-node:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
        border-color: var(--accent-primary);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.2rem;
    }

    .stat-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
    }

    /* Filter Pills */
    .filter-architecture {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .filter-pill {
        padding: 0.5rem 1.2rem;
        border-radius: 40px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        background: white;
        border: 1px solid var(--border-color);
        color: var(--text-mute);
        transition: all 0.3s;
        text-decoration: none;
    }

    .filter-pill:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
    }

    .filter-pill.active {
        background: var(--system-bg);
        color: white;
        border-color: var(--system-bg);
    }

    /* Alert */
    .alert-node {
        margin-bottom: 1.5rem;
        padding: 1rem 1.2rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .alert-success {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        color: #059669;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
    }

    /* Table Architecture */
    .table-architecture {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
    }

    .aspiration-node {
        display: grid;
        grid-template-columns: 70px 1.5fr 0.8fr 1.8fr 1fr 1fr 1fr;
        align-items: center;
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.4s;
        cursor: pointer;
    }

    .aspiration-node:hover {
        background: #fafafa;
        transform: translateX(4px);
    }

    .aspiration-node:last-child {
        border-bottom: none;
    }

    /* Table Header */
    .table-header {
        display: grid;
        grid-template-columns: 70px 1.5fr 0.8fr 1.8fr 1fr 1fr 1fr;
        padding: 1rem 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid var(--border-color);
        font-size: 0.65rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        color: var(--text-mute);
    }

    /* User Avatar */
    .user-avatar {
        width: 40px;
        height: 40px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--accent-primary), #059669);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
    }

    /* Category Pills */
    .category-pill {
        padding: 0.25rem 0.8rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        width: fit-content;
    }

    .cat-saran { background: #d1fae5; color: #059669; }
    .cat-keluhan { background: #fee2e2; color: #dc2626; }
    .cat-masukan { background: #dbeafe; color: #2563eb; }
    .cat-pertanyaan { background: #f3e8ff; color: #9333ea; }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.65rem;
        font-weight: 700;
    }

    .status-baru { background: #fef3c7; color: #d97706; }
    .status-diproses { background: #dbeafe; color: #2563eb; }
    .status-selesai { background: #d1fae5; color: #059669; }

    /* Action Buttons */
    .action-deck {
        display: flex;
        gap: 0.5rem;
        opacity: 0.7;
        transition: all 0.3s;
    }

    .aspiration-node:hover .action-deck {
        opacity: 1;
    }

    .deck-btn {
        width: 36px;
        height: 36px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
        color: var(--text-mute);
        background: white;
        cursor: pointer;
    }

    .deck-btn:hover {
        background: var(--system-bg);
        color: white;
        border-color: var(--system-bg);
    }

    .btn-respon { background: var(--accent-primary); color: white; border-color: var(--accent-primary); }
    .btn-respon:hover { background: #059669; }

    /* Modal */
    .modal-overlay {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.5);
        backdrop-filter: blur(4px);
        z-index: 1000;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .modal-container {
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

    /* Empty State */
    .void-container {
        padding: 5rem 0;
        text-align: center;
        border: 2px dashed #e5e5e5;
        border-radius: 40px;
    }

    /* Pagination */
    .pagination-container {
        margin-top: 1.5rem;
        display: flex;
        justify-content: center;
    }

    .pagination {
        display: flex;
        gap: 0.3rem;
        flex-wrap: wrap;
    }

    .pagination .page-item .page-link {
        padding: 0.5rem 1rem;
        border-radius: 14px;
        background: white;
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s;
        border: 1px solid #e2e8f0;
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background: var(--system-bg);
        color: white;
        border-color: transparent;
    }

    .pagination .page-item .page-link:hover {
        background: var(--accent-primary);
        color: white;
        transform: translateY(-2px);
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .aspiration-node, .table-header {
            grid-template-columns: 60px 1.2fr 0.7fr 1.5fr 0.9fr 0.9fr 0.9fr;
            gap: 0.5rem;
        }
    }

    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1rem; }
        .stats-architecture { grid-template-columns: repeat(2, 1fr); }
        .table-architecture { overflow-x: auto; }
        .aspiration-node, .table-header { min-width: 900px; }
    }

    @media (max-width: 640px) {
        .stats-architecture { grid-template-columns: 1fr; }
        .editorial-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .brand-title { font-size: 2rem; }
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
</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Main Editorial Nav --}}
    <header class="editorial-header fade-up">
        <div>
            <h1 class="brand-title font-display">Kelola<br><span style="color: var(--accent-primary);">Aspirasi</span>.</h1>
            <p class="brand-subtitle">
                Kelola dan tanggapi aspirasi dari masyarakat dengan presisi.
            </p>
        </div>
    </header>

    {{-- Statistics Architecture --}}
    <div class="stats-architecture fade-up" style="animation-delay: 0.05s">
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-solid fa-list-check text-emerald-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $statistik['total'] }}</div>
            <div class="stat-label">Total Aspirasi</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(245,158,11,0.1);">
                <i class="fa-regular fa-clock text-yellow-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $statistik['baru'] }}</div>
            <div class="stat-label">Baru</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1);">
                <i class="fa-solid fa-spinner fa-spin text-blue-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $statistik['diproses'] }}</div>
            <div class="stat-label">Diproses</div>
        </div>
        <div class="stat-node">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-regular fa-circle-check text-emerald-600 text-xl"></i>
            </div>
            <div class="stat-value">{{ $statistik['selesai'] }}</div>
            <div class="stat-label">Selesai</div>
        </div>
    </div>

    {{-- Filter Pills --}}
    <div class="filter-architecture fade-up" style="animation-delay: 0.1s">
        <a href="{{ route('admin.aspirasi.index', ['status' => 'all']) }}" 
           class="filter-pill {{ request('status', 'all') == 'all' ? 'active' : '' }}">
            Semua
        </a>
        <a href="{{ route('admin.aspirasi.index', ['status' => 'baru']) }}" 
           class="filter-pill {{ request('status') == 'baru' ? 'active' : '' }}">
            Baru
        </a>
        <a href="{{ route('admin.aspirasi.index', ['status' => 'diproses']) }}" 
           class="filter-pill {{ request('status') == 'diproses' ? 'active' : '' }}">
            Diproses
        </a>
        <a href="{{ route('admin.aspirasi.index', ['status' => 'selesai']) }}" 
           class="filter-pill {{ request('status') == 'selesai' ? 'active' : '' }}">
            Selesai
        </a>
    </div>

    {{-- Alerts --}}
    @if(session('success'))
    <div class="alert-node alert-success fade-up" style="animation-delay: 0.15s">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-node alert-error fade-up" style="animation-delay: 0.15s">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-exclamation"></i>
            <span>{{ session('error') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100">
            <i class="fa-solid fa-xmark"></i>
        </button>
    </div>
    @endif

    {{-- Table Architecture --}}
    <div class="table-architecture fade-up" style="animation-delay: 0.2s">
        <!-- Table Header -->
        <div class="table-header">
            <div>No</div>
            <div>Pengirim</div>
            <div>Kategori</div>
            <div>Judul / Isi</div>
            <div>Tanggal</div>
            <div>Status</div>
            <div>Aksi</div>
        </div>

        <!-- Data Rows -->
        @forelse($aspirasi as $index => $a)
        <div class="aspiration-node" style="animation-delay: {{ 0.05 * $loop->index }}s">
            <div class="text-sm text-gray-500 font-medium">{{ $aspirasi->firstItem() + $index }}</div>
            
            <div class="flex items-center gap-3">
                <div class="user-avatar">
                    {{ substr($a->user->name ?? 'W', 0, 1) }}
                </div>
                <div>
                    <div class="font-medium text-gray-800">{{ $a->user->name ?? 'Warga' }}</div>
                    <div class="text-xs text-gray-400">{{ $a->user->email ?? '-' }}</div>
                </div>
            </div>
            
            <div>
                <span class="category-pill 
                    @if($a->kategori == 'saran') cat-saran
                    @elseif($a->kategori == 'keluhan') cat-keluhan
                    @elseif($a->kategori == 'masukan') cat-masukan
                    @else cat-pertanyaan @endif">
                    @if($a->kategori == 'saran') 💡 Saran
                    @elseif($a->kategori == 'keluhan') 😞 Keluhan
                    @elseif($a->kategori == 'masukan') 📝 Masukan
                    @else ❓ Pertanyaan @endif
                </span>
            </div>
            
            <div>
                <p class="font-medium text-gray-800 line-clamp-1">{{ Str::limit($a->judul, 35) }}</p>
                <p class="text-xs text-gray-400 mt-1 line-clamp-1">{{ Str::limit($a->isi, 45) }}</p>
            </div>
            
            <div class="text-sm text-gray-500">
                {{ $a->created_at->translatedFormat('d M Y') }}<br>
                <span class="text-xs">{{ $a->created_at->format('H:i') }} WIB</span>
            </div>
            
            <div>
                <span class="status-badge status-{{ $a->status }}">
                    @if($a->status == 'baru') <i class="fa-regular fa-clock"></i> Baru
                    @elseif($a->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Diproses
                    @else <i class="fa-regular fa-circle-check"></i> Selesai @endif
                </span>
            </div>
            
            <div class="action-deck">
            <!-- Tombol Lihat Detail -->
            <a href="{{ route('admin.aspirasi.show', $a->id_aspirasi) }}" 
            class="deck-btn" title="Lihat Detail">
                <i class="fa-regular fa-eye"></i>
            </a>
            
            @if($a->status != 'selesai')
            <button onclick="openResponModal({{ $a->id_aspirasi }}, '{{ addslashes($a->judul) }}')" 
                    class="deck-btn btn-respon" title="Beri Respon">
                <i class="fa-regular fa-reply"></i>
            </button>
            @endif
            
            @if($a->status == 'baru')
            <a href="{{ route('admin.aspirasi.status', $a->id_aspirasi) }}" 
            class="deck-btn" title="Proses"
            onclick="return confirm('Ubah status menjadi diproses?')">
                <i class="fa-solid fa-play"></i>
            </a>
            @endif
            
            <form action="{{ route('admin.aspirasi.destroy', $a->id_aspirasi) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="deck-btn hover:!bg-red-600" title="Hapus">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
        </div>
        @empty
        <div class="void-container">
            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-regular fa-comment-dots text-3xl text-gray-400"></i>
            </div>
            <h3 class="text-xl font-medium text-gray-400">Belum Ada Aspirasi</h3>
            <p class="text-gray-400 mt-2">Belum ada aspirasi yang masuk dari masyarakat</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    @if($aspirasi->hasPages())
    <div class="pagination-container">
        {{ $aspirasi->appends(request()->query())->links() }}
    </div>
    @endif
</div>

{{-- Modal Respon --}}
<div id="responModal" class="modal-overlay">
    <div class="modal-container">
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
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeResponModal();
        }
    });
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('responModal');
        if (event.target === modal) {
            closeResponModal();
        }
    }
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection