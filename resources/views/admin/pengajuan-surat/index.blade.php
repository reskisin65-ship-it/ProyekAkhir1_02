@extends('layouts.admin')

@section('title', 'Kelola Pengajuan Surat - Lumban Silintong')

@section('content')
<!-- Import Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&family=JetBrains+Mono:wght@300;400&display=swap" rel="stylesheet">

<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(255, 255, 255, 0.4);
        --accent-gradient: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        --text-main: #1e293b;
        --transition-gentle: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        
        --blue: #3b82f6;
        --orange: #f59e0b;
        --green: #10b981;
        --purple: #8b5cf6;
        --red: #ef4444;
    }

    /* --- Hero Section & Typography --- */
    .hero-title {
        font-family: 'Instrument Serif', serif;
        font-size: 3rem;
        line-height: 1;
        letter-spacing: -0.02em;
    }

    .hero-subtitle {
        font-family: 'Plus Jakarta Sans';
        letter-spacing: 0.1em;
        text-transform: uppercase;
        font-size: 0.7rem;
        font-weight: 700;
        color: var(--blue);
    }

    /* --- Statistics Card: The Bento Box --- */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1.2rem;
        margin-bottom: 2rem;
    }

    .stat-card-premium {
        position: relative;
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        padding: 1.5rem;
        transition: var(--transition-gentle);
        overflow: hidden;
        cursor: pointer;
        text-decoration: none;
        display: block;
    }

    .stat-card-premium:hover {
        transform: translateY(-6px);
        background: white;
        box-shadow: 0 25px 40px -12px rgba(0,0,0,0.08);
    }

    .stat-card-premium.active {
        border: 2px solid var(--blue);
        background: white;
    }

    /* Custom Grid Spanning */
    .span-4 { grid-column: span 4; }
    .span-8 { grid-column: span 8; }
    .span-3 { grid-column: span 3; }
    .span-2 { grid-column: span 2; }

    .stat-icon-new {
        width: 48px;
        height: 48px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        margin-bottom: 1rem;
        transition: var(--transition-gentle);
    }

    .stat-card-premium:hover .stat-icon-new {
        transform: scale(1.05);
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.2rem;
    }

    .stat-label {
        font-size: 0.7rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
    }

    /* --- Table Styling --- */
    .table-premium-container {
        background: var(--glass-bg);
        backdrop-filter: blur(12px);
        border-radius: 28px;
        border: 1px solid var(--glass-border);
        padding: 1.2rem;
        box-shadow: 0 4px 24px -1px rgba(0,0,0,0.03);
    }

    .premium-table {
        width: 100%;
        border-spacing: 0 0.6rem;
        border-collapse: separate;
    }

    .premium-table thead th {
        padding: 1rem 1.2rem;
        font-weight: 700;
        color: #94a3b8;
        text-transform: uppercase;
        font-size: 0.65rem;
        letter-spacing: 0.1em;
        text-align: left;
    }

    .premium-table tbody tr {
        transition: var(--transition-gentle);
    }

    .premium-table tbody tr td {
        background: white;
        padding: 1rem 1.2rem;
        border: none;
        transition: var(--transition-gentle);
        vertical-align: middle;
    }

    .premium-table tbody tr td:first-child { border-radius: 20px 0 0 20px; }
    .premium-table tbody tr td:last-child { border-radius: 0 20px 20px 0; }

    .premium-table tbody tr:hover td {
        background: #f8fafc;
        transform: scale(1.002);
    }

    /* User Avatar */
    .user-avatar-sm {
        width: 40px;
        height: 40px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.9rem;
    }

    /* Status Badge Refined */
    .badge-refined {
        padding: 0.3rem 0.9rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.65rem;
        text-transform: uppercase;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .badge-menunggu { background: #fef3c7; color: #d97706; }
    .badge-diproses { background: #dbeafe; color: #2563eb; }
    .badge-selesai { background: #d1fae5; color: #059669; }
    .badge-ditolak { background: #fee2e2; color: #dc2626; }

    /* Action Button */
    .action-btn {
        width: 36px;
        height: 36px;
        border-radius: 12px;
        background: #f1f5f9;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-gentle);
        color: #64748b;
    }

    .action-btn:hover {
        background: var(--blue);
        color: white;
        transform: translateX(3px);
    }

    /* Success Message */
    .alert-success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: 20px;
        padding: 1rem 1.2rem;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.8rem;
        backdrop-filter: blur(4px);
    }

    /* Pagination */
    .pagination {
        display: flex;
        gap: 0.3rem;
        justify-content: center;
        margin-top: 1.5rem;
    }

    .pagination .page-item .page-link {
        padding: 0.5rem 1rem;
        border-radius: 12px;
        background: white;
        color: #64748b;
        font-size: 0.8rem;
        font-weight: 500;
        transition: var(--transition-gentle);
        border: 1px solid #e2e8f0;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, var(--blue), var(--purple));
        color: white;
        border-color: transparent;
    }

    .pagination .page-item .page-link:hover {
        background: var(--blue);
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
        background: white;
        border-radius: 24px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-grid { gap: 1rem; }
        .span-4 { grid-column: span 12; }
        .span-8 { grid-column: span 12; }
        .premium-table { min-width: 800px; }
        .table-premium-container { overflow-x: auto; }
    }

    /* Animations */
    @keyframes reveal {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .reveal-item {
        animation: reveal 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
    }

    .stagger-1 { animation-delay: 0.05s; }
    .stagger-2 { animation-delay: 0.1s; }
    .stagger-3 { animation-delay: 0.15s; }
    .stagger-4 { animation-delay: 0.2s; }
</style>

<div class="max-w-7xl mx-auto px-6 py-8">
    
    <!-- Pro Header Section -->
    <header class="mb-8 reveal-item">
        <div class="flex justify-between items-end flex-wrap gap-4">
            <div>
                <span class="hero-subtitle">PANEL ADMIN</span>
                <h1 class="hero-title mt-2">Kelola <span class="italic text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">Pengajuan Surat</span></h1>
                <p class="text-slate-400 mt-2 text-sm">Monitoring dan pemrosesan permohonan surat masyarakat dengan presisi</p>
            </div>
            <div class="text-right pb-2">
                <div class="text-xs font-mono text-slate-400 uppercase tracking-widest">Waktu Server</div>
                <div class="text-xl font-bold text-slate-800">{{ now()->format('H:i') }} <span class="text-slate-400 text-sm font-normal">WIB</span></div>
                <div class="text-xs text-slate-400">{{ now()->translatedFormat('l, d F Y') }}</div>
            </div>
        </div>
    </header>

    <!-- Success Message -->
    @if(session('success'))
    <div class="alert-success reveal-item">
        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
            <i class="fa-solid fa-check text-sm"></i>
        </div>
        <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Statistics Bento Grid -->
    <div class="stats-grid">
        <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'all']) }}" 
           class="stat-card-premium span-4 reveal-item stagger-1 {{ (!request('status') || request('status') == 'all') ? 'active' : '' }}">
            <div class="stat-icon-new" style="background: rgba(139,92,246,0.1); color: var(--purple);">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div class="stat-value">{{ $statistik['total'] }}</div>
            <div class="stat-label">Total Pengajuan</div>
        </a>

        <div class="span-8">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'menunggu']) }}" 
                   class="stat-card-premium reveal-item stagger-2 {{ request('status') == 'menunggu' ? 'active' : '' }}">
                    <div class="flex items-center gap-3">
                        <div class="stat-icon-new mb-0" style="background: rgba(245,158,11,0.1); color: var(--orange); width: 40px; height: 40px;">
                            <i class="fa-regular fa-clock"></i>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-slate-900">{{ $statistik['menunggu'] }}</div>
                            <div class="text-xs font-semibold text-amber-600 uppercase">Menunggu</div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'diproses']) }}" 
                   class="stat-card-premium reveal-item stagger-3 {{ request('status') == 'diproses' ? 'active' : '' }}">
                    <div class="flex items-center gap-3">
                        <div class="stat-icon-new mb-0" style="background: rgba(59,130,246,0.1); color: var(--blue); width: 40px; height: 40px;">
                            <i class="fa-solid fa-spinner"></i>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-slate-900">{{ $statistik['diproses'] }}</div>
                            <div class="text-xs font-semibold text-blue-600 uppercase">Diproses</div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'selesai']) }}" 
                   class="stat-card-premium reveal-item stagger-4 {{ request('status') == 'selesai' ? 'active' : '' }}">
                    <div class="flex items-center gap-3">
                        <div class="stat-icon-new mb-0" style="background: rgba(16,185,129,0.1); color: var(--green); width: 40px; height: 40px;">
                            <i class="fa-regular fa-circle-check"></i>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-slate-900">{{ $statistik['selesai'] }}</div>
                            <div class="text-xs font-semibold text-emerald-600 uppercase">Selesai</div>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'ditolak']) }}" 
                   class="stat-card-premium reveal-item stagger-4 {{ request('status') == 'ditolak' ? 'active' : '' }}" style="animation-delay: 0.25s">
                    <div class="flex items-center gap-3">
                        <div class="stat-icon-new mb-0" style="background: rgba(239,68,68,0.1); color: var(--red); width: 40px; height: 40px;">
                            <i class="fa-regular fa-circle-xmark"></i>
                        </div>
                        <div>
                            <div class="text-xl font-bold text-slate-900">{{ $statistik['ditolak'] }}</div>
                            <div class="text-xs font-semibold text-rose-600 uppercase">Ditolak</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="table-premium-container reveal-item stagger-4">
        <div class="flex justify-between items-center mb-6 px-2">
            <h3 class="text-lg font-bold text-slate-800">📋 Daftar Pengajuan Terbaru</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="premium-table">
                <thead>
                    <tr>
                        <th>Pemohon</th>
                        <th>Jenis Surat</th>
                        <th>NIK</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                        <th class="text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengajuan as $item)
                    <tr>
                        <td>
                            <div class="flex items-center gap-3">
                                <div class="user-avatar-sm">
                                    {{ substr($item->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-semibold text-slate-800">{{ $item->user->name ?? 'Anonim' }}</div>
                                    <div class="text-xs text-slate-400">{{ $item->user->email ?? '-' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="font-medium text-slate-700">{{ $item->jenis_surat }}</span>
                        </td>
                        <td>
                            <code class="text-xs bg-slate-100 px-2 py-1 rounded-md text-slate-600 font-mono">{{ $item->nik }}</code>
                        </td>
                        <td>
                            <div class="text-sm text-slate-700">{{ $item->created_at->translatedFormat('d M Y') }}</div>
                            <div class="text-[10px] text-slate-400">{{ $item->created_at->format('H:i') }} WIB</div>
                        </td>
                        <td>
                            <span class="badge-refined badge-{{ $item->status }}">
                                @if($item->status == 'menunggu') <i class="fa-regular fa-clock"></i>
                                @elseif($item->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i>
                                @elseif($item->status == 'selesai') <i class="fa-regular fa-circle-check"></i>
                                @else <i class="fa-regular fa-circle-xmark"></i> @endif
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.pengajuan-surat.show', $item->id_surat) }}" 
                               class="action-btn" title="Lihat Detail">
                                <i class="fa-solid fa-arrow-right-long"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-16">
                            <div class="empty-state">
                                <div class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fa-regular fa-file-lines text-2xl text-slate-400"></i>
                                </div>
                                <p class="text-slate-500 font-medium">Belum ada pengajuan surat</p>
                                <p class="text-sm text-slate-400 mt-1">Belum ada pengajuan surat dari masyarakat</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($pengajuan->hasPages())
        <div class="mt-6">
            {{ $pengajuan->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const items = document.querySelectorAll('.reveal-item');
        items.forEach((item, index) => {
            item.style.opacity = '1';
        });
    });
</script>

@endsection