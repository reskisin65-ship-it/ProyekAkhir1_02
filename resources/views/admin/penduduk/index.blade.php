@extends('layouts.admin')

@section('title', 'Kelola Data Penduduk - Lumban Silintong')

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
        --teal: #14b8a6;
        --orange: #f59e0b;
    }

    body {
        background: #ffffff;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Container */
    .premium-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Header Section */
    .header-section {
        margin-bottom: 2rem;
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
        font-size: 2.5rem;
        font-weight: 400;
        line-height: 1.2;
        color: #0f172a;
    }

    .page-title span {
        background: var(--accent-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Add Button */
    .btn-add {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.8rem 1.5rem;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 24px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        transition: var(--transition);
        box-shadow: 0 4px 12px rgba(16,185,129,0.25);
    }

    .btn-add:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(16,185,129,0.35);
        gap: 0.8rem;
    }

    /* Alert */
    .alert-glass {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem 1.2rem;
        border-radius: 24px;
        margin-bottom: 1.5rem;
        backdrop-filter: blur(16px);
        animation: slideIn 0.4s ease;
    }

    .alert-success { background: rgba(16,185,129,0.08); border: 1px solid rgba(16,185,129,0.15); }

    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }

    /* Stats Mini Cards */
    .stats-mini {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .stat-mini-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 20px;
        padding: 0.8rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: var(--transition);
        cursor: pointer;
    }

    .stat-mini-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--glass-shadow);
        background: white;
    }

    .stat-mini-icon {
        width: 40px;
        height: 40px;
        border-radius: 16px;
        background: rgba(59,130,246,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--blue);
    }

    .stat-mini-info h4 {
        font-size: 1.5rem;
        font-weight: 800;
        line-height: 1;
        color: #0f172a;
    }

    .stat-mini-info p {
        font-size: 0.7rem;
        color: #64748b;
        font-weight: 500;
    }

    /* Table Container Premium */
    .table-premium {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 28px;
        overflow: hidden;
        box-shadow: var(--glass-shadow);
    }

    .table-header {
        padding: 1rem 1.2rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .table-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .table-title i {
        font-size: 1.2rem;
        color: var(--blue);
    }

    .table-title h3 {
        font-weight: 700;
        font-size: 1rem;
        color: #1e293b;
    }

    /* Search Box */
    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        padding: 0.4rem 0.8rem;
        border-radius: 24px;
        border: 1px solid #e2e8f0;
        transition: var(--transition);
    }

    .search-box:hover {
        border-color: var(--blue);
        box-shadow: 0 2px 8px rgba(59,130,246,0.1);
    }

    .search-box input {
        border: none;
        outline: none;
        padding: 0.4rem;
        font-size: 0.8rem;
        width: 200px;
    }

    .search-box button {
        background: none;
        border: none;
        cursor: pointer;
        color: #94a3b8;
        transition: var(--transition);
    }

    .search-box button:hover {
        color: var(--blue);
    }

    /* Table Styling */
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead th {
        text-align: left;
        padding: 1rem 1rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #64748b;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }

    .data-table tbody tr {
        transition: var(--transition);
        cursor: pointer;
    }

    .data-table tbody tr:hover {
        background: rgba(59,130,246,0.04);
        transform: scale(1.002);
    }

    .data-table td {
        padding: 1rem 1rem;
        font-size: 0.85rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    /* NIK Style */
    .nik-code {
        font-family: 'JetBrains Mono', monospace;
        font-size: 0.75rem;
        background: #f1f5f9;
        padding: 0.2rem 0.5rem;
        border-radius: 10px;
        display: inline-block;
    }

    /* Avatar for Name */
    .name-cell {
        display: flex;
        align-items: center;
        gap: 0.6rem;
    }

    .avatar {
        width: 32px;
        height: 32px;
        border-radius: 14px;
        background: linear-gradient(135deg, var(--blue), var(--purple));
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 0.8rem;
    }

    /* Status Badge */
    .status-badge-table {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.7rem;
        border-radius: 20px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .status-kk { background: #d1fae5; color: #059669; }
    .status-istri { background: #fce7f3; color: #db2777; }
    .status-anak { background: #dbeafe; color: #2563eb; }
    .status-lain { background: #fef3c7; color: #d97706; }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 0.8rem;
    }

    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
    }

    .btn-edit {
        background: rgba(59,130,246,0.1);
        color: #3b82f6;
    }

    .btn-edit:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: rgba(239,68,68,0.1);
        color: #ef4444;
        border: none;
        cursor: pointer;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
    }

    /* Pagination */
    .pagination-container {
        padding: 1rem 1.2rem;
        border-top: 1px solid rgba(0, 0, 0, 0.05);
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
        transition: var(--transition);
        border: 1px solid #e2e8f0;
        text-decoration: none;
    }

    .pagination .page-item.active .page-link {
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: white;
        border-color: transparent;
    }

    .pagination .page-item .page-link:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 3rem;
    }

    .empty-icon {
        width: 80px;
        height: 80px;
        background: #f1f5f9;
        border-radius: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .premium-container { padding: 1rem; }
        .stats-mini { flex-wrap: wrap; }
        .data-table { min-width: 900px; }
        .table-premium { overflow-x: auto; }
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
    .delay-4 { animation-delay: 0.2s; }
</style>

<div class="premium-container">
    
    <!-- Header Section -->
    <div class="header-section fade-up">
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <div class="page-badge">DATABASE KEPENDUDUKAN</div>
                <h1 class="page-title">Data <span>Penduduk</span></h1>
                <p class="text-slate-400 mt-1 text-sm">Kelola dan pantau data kependudukan Desa Lumban Silintong</p>
            </div>
            <a href="{{ route('admin.penduduk.create') }}" class="btn-add">
                <i class="fa-solid fa-plus"></i> Tambah Data Penduduk
            </a>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
    <div class="alert-glass alert-success fade-up delay-1">
        <div class="w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center text-white">
            <i class="fa-solid fa-check text-sm"></i>
        </div>
        <p class="text-emerald-700 font-medium">{{ session('success') }}</p>
    </div>
    @endif

    <!-- Stats Mini Cards -->
    <div class="stats-mini fade-up delay-2">
        <div class="stat-mini-card">
            <div class="stat-mini-icon">
                <i class="fa-solid fa-users"></i>
            </div>
            <div class="stat-mini-info">
                <h4>{{ $penduduk->total() }}</h4>
                <p>Total Penduduk</p>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon" style="background: rgba(16,185,129,0.1); color: #10b981;">
                <i class="fa-solid fa-venus-mars"></i>
            </div>
            <div class="stat-mini-info">
                <h4>{{ $penduduk->where('jenis_kelamin', 'L')->count() }} / {{ $penduduk->where('jenis_kelamin', 'P')->count() }}</h4>
                <p>Laki-laki / Perempuan</p>
            </div>
        </div>
        <div class="stat-mini-card">
            <div class="stat-mini-icon" style="background: rgba(245,158,11,0.1); color: #f59e0b;">
                <i class="fa-solid fa-house-chimney"></i>
            </div>
            <div class="stat-mini-info">
                <h4>{{ $penduduk->where('status_keluarga', 'Kepala Keluarga')->count() }}</h4>
                <p>Kepala Keluarga</p>
            </div>
        </div>
    </div>

    <!-- Table Container -->
    <div class="table-premium fade-up delay-3">
        <div class="table-header">
            <div class="table-title">
                <i class="fa-solid fa-table-list"></i>
                <h3>Daftar Penduduk</h3>
            </div>
            <div class="search-box">
                <i class="fa-solid fa-search"></i>
                <input type="text" id="searchInput" placeholder="Cari nama atau NIK...">
                <button onclick="searchTable()"><i class="fa-solid fa-arrow-right"></i></button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="data-table" id="dataTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>JK</th>
                        <th>Tempat, Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($penduduk as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration + ($penduduk->currentPage() - 1) * $penduduk->perPage() }}</td>
                        <td><span class="nik-code">{{ $item->nik }}</span></td>
                        <td>
                            <div class="name-cell">
                                <div class="avatar">{{ substr($item->nama_lengkap, 0, 1) }}</div>
                                <span class="font-semibold">{{ $item->nama_lengkap }}</span>
                            </div>
                        </td>
                        <td>{{ $item->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                        <td>{{ $item->tempat_lahir }}, {{ \Carbon\Carbon::parse($item->tanggal_lahir)->format('d/m/Y') }}</td>
                        <td>{{ Str::limit($item->alamat, 35) }}</td>
                        <td>
                            <span class="status-badge-table status-{{ strtolower(str_replace(' ', '-', $item->status_keluarga)) }}">
                                <i class="fa-regular fa-circle-user"></i>
                                {{ $item->status_keluarga }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.penduduk.edit', $item->id_penduduk) }}" class="btn-action btn-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.penduduk.destroy', $item->id_penduduk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="empty-state">
                            <div class="empty-icon">
                                <i class="fa-regular fa-folder-open text-3xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-400">Belum ada data penduduk</p>
                            <a href="{{ route('admin.penduduk.create') }}" class="inline-block mt-3 text-emerald-600 hover:text-emerald-700">+ Tambah data</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($penduduk->hasPages())
        <div class="pagination-container">
            {{ $penduduk->links() }}
        </div>
        @endif
    </div>
</div>

<script>
    // Search Function
    function searchTable() {
        const input = document.getElementById('searchInput');
        const filter = input.value.toLowerCase();
        const table = document.getElementById('dataTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) {
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 1; j < cells.length - 1; j++) {
                const cellText = cells[j].innerText.toLowerCase();
                if (cellText.indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
            rows[i].style.display = found ? '' : 'none';
        }
    }

    // Real-time search on input
    document.getElementById('searchInput').addEventListener('keyup', function() {
        searchTable();
    });

    // Row hover animation
    document.querySelectorAll('.data-table tbody tr').forEach(row => {
        row.addEventListener('mouseenter', () => {
            row.style.transition = 'all 0.3s ease';
        });
    });
</script>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection