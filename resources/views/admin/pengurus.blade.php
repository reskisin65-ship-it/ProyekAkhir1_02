{{-- resources/views/admin/pengurus.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Pengurus Desa - Lumban Silintong')

@section('content')
<!-- Fonts & Library -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
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
        --bg: #fafbfc;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-xs: 0 1px 2px rgba(0,0,0,0.02);
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.03);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.05);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.08);
        --transition: all 0.25s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.35s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--dark);
        -webkit-font-smoothing: antialiased;
    }

    /* Custom Scroll */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--gray-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

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
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ============================================
       HEADER SECTION
    ============================================ */
    .header-section {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        margin-bottom: 2.5rem;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .header-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 0.75rem;
    }

    .header-badge i { font-size: 0.65rem; color: var(--primary); }
    .header-badge span { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em; color: var(--primary-dark); text-transform: uppercase; }

    .header-title {
        font-size: clamp(2rem, 4vw, 3rem);
        font-weight: 800;
        line-height: 1.1;
        letter-spacing: -0.03em;
    }

    .header-title span { color: var(--primary); font-family: 'Instrument Serif', serif; font-style: italic; font-weight: 400; }

    /* ============================================
       BUTTONS
    ============================================ */
    .btn-group { display: flex; gap: 0.75rem; }
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.4rem;
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        text-decoration: none;
        transition: var(--transition-bounce);
        cursor: pointer;
        border: none;
    }
    .btn-primary {
        background: linear-gradient(135deg, var(--dark), var(--dark-soft));
        color: white;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
    }
    .btn-outline {
        background: transparent;
        color: var(--gray);
        border: 1px solid var(--border);
    }
    .btn-outline:hover {
        border-color: var(--primary);
        color: var(--primary);
        background: var(--primary-soft);
        transform: translateY(-2px);
    }

    /* ============================================
       FILTER DROPDOWN - RAPI & ELEGAN
    ============================================ */
    .filter-container {
        margin-bottom: 2rem;
        position: relative;
        z-index: 50;
    }

    /* Desktop Filter */
    .filter-desktop {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .filter-pill {
        padding: 0.5rem 1.3rem;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 60px;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition);
        white-space: nowrap;
    }

    .filter-pill i { margin-right: 0.4rem; font-size: 0.7rem; }

    .filter-pill:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateY(-1px);
        background: var(--primary-soft);
    }

    .filter-pill.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.2);
    }

    /* Mobile Filter Dropdown - Premium */
    .filter-mobile { display: none; position: relative; }

    .filter-dropdown-trigger {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.8rem 1.2rem;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--dark);
        cursor: pointer;
        transition: var(--transition);
    }

    .filter-dropdown-trigger:hover {
        border-color: var(--primary);
        background: var(--primary-soft);
    }

    .filter-dropdown-trigger i:first-child { color: var(--primary); margin-right: 0.5rem; }
    .filter-dropdown-trigger i:last-child { transition: transform 0.3s; color: var(--gray); }

    .filter-dropdown-trigger.open i:last-child { transform: rotate(180deg); }

    .filter-dropdown-menu {
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        right: 0;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 20px;
        max-height: 320px;
        overflow-y: auto;
        opacity: 0;
        visibility: hidden;
        transform: translateY(-10px);
        transition: all 0.25s cubic-bezier(0.16, 1, 0.3, 1);
        box-shadow: var(--shadow-lg);
        z-index: 100;
    }

    .filter-dropdown-menu.show {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .filter-dropdown-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.8rem 1.2rem;
        text-decoration: none;
        font-size: 0.85rem;
        color: var(--gray);
        transition: var(--transition);
        border-bottom: 1px solid var(--border);
    }

    .filter-dropdown-item:last-child { border-bottom: none; }

    .filter-dropdown-item i { width: 20px; color: var(--gray-light); transition: var(--transition); }

    .filter-dropdown-item:hover {
        background: var(--primary-soft);
        color: var(--primary);
        padding-left: 1.5rem;
    }

    .filter-dropdown-item:hover i { color: var(--primary); }

    .filter-dropdown-item.active {
        background: var(--primary);
        color: white;
    }

    .filter-dropdown-item.active i { color: white; }

    /* ============================================
       ALERT
    ============================================ */
    .alert {
        margin-bottom: 1.5rem;
        padding: 0.85rem 1.2rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: slideIn 0.35s ease;
    }
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(24px); }
        to { opacity: 1; transform: translateX(0); }
    }
    .alert-success { background: #ecfdf5; border-left: 3px solid var(--primary); color: #059669; }
    .alert-error { background: #fef2f2; border-left: 3px solid #ef4444; color: #dc2626; }
    .alert-close { cursor: pointer; opacity: 0.6; transition: 0.2s; padding: 0.25rem; border-radius: 10px; }
    .alert-close:hover { opacity: 1; background: rgba(0,0,0,0.05); }

    /* ============================================
       TABLE PREMIUM
    ============================================ */
    .table-wrapper {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 24px;
        overflow: hidden;
        transition: var(--transition);
    }

    .table-wrapper:hover { box-shadow: var(--shadow-md); }

    .table-responsive { overflow-x: auto; -webkit-overflow-scrolling: touch; }

    .table-custom {
        width: 100%;
        border-collapse: collapse;
        min-width: 680px;
    }

    .table-custom th {
        text-align: left;
        padding: 1rem 1.2rem;
        font-size: 0.65rem;
        font-weight: 700;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--gray);
        background: var(--gray-soft);
        border-bottom: 1px solid var(--border);
    }

    .table-custom td {
        padding: 1rem 1.2rem;
        border-bottom: 1px solid var(--border);
        transition: var(--transition);
    }

    .table-custom tr:last-child td { border-bottom: none; }
    .table-custom tbody tr { transition: var(--transition-bounce); }
    .table-custom tbody tr:hover { background: var(--primary-soft); }
    .table-custom tbody tr:hover td:first-child { border-radius: 12px 0 0 12px; }
    .table-custom tbody tr:hover td:last-child { border-radius: 0 12px 12px 0; }

    /* Member Cell */
    .member-cell { display: flex; align-items: center; gap: 1rem; }
    .member-avatar {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        object-fit: cover;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
        transition: var(--transition-bounce);
    }
    .member-avatar-placeholder {
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: linear-gradient(135deg, #e2e8f0, #cbd5e1);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .member-avatar-placeholder i { font-size: 1.2rem; color: var(--gray); }
    tr:hover .member-avatar { transform: scale(1.03) rotate(-1deg); border: 2px solid var(--primary); }
    tr:hover .member-avatar-placeholder { background: var(--primary); }
    tr:hover .member-avatar-placeholder i { color: white; }

    .member-name { font-weight: 700; font-size: 0.85rem; margin-bottom: 0.2rem; }
    .member-nip { font-size: 0.65rem; color: var(--gray); font-family: monospace; }

    /* Badge Kategori - Tanpa Lainnya */
    .badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.3rem 1rem;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 700;
        transition: var(--transition);
    }
    tr:hover .badge { transform: scale(1.02); }
    .badge-primary { background: #ecfdf5; color: #059669; }
    .badge-blue { background: #eff6ff; color: #2563eb; }
    .badge-purple { background: #f3e8ff; color: #7c3aed; }
    .badge-orange { background: #ffedd5; color: #ea580c; }
    .badge-custom { background: #f1f5f9; color: #475569; }

    /* Jabatan */
    .jabatan-text { font-weight: 600; font-size: 0.8rem; margin-bottom: 0.2rem; }
    .tugas-text { font-size: 0.65rem; color: var(--gray); display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; max-width: 220px; }

    /* Level Indicator */
    .level-rank { font-size: 0.65rem; font-weight: 600; color: var(--gray); margin-bottom: 0.3rem; }
    .level-bars { display: flex; gap: 0.2rem; }
    .level-bar {
        width: 22px;
        height: 3px;
        background: #e2e8f0;
        border-radius: 4px;
        transition: var(--transition);
    }
    .level-bar.active { background: linear-gradient(90deg, var(--primary), var(--primary-dark)); }
    tr:hover .level-bar.active { transform: scaleX(1.05); }

    /* Action Buttons */
    .action-group { display: flex; gap: 0.5rem; justify-content: flex-end; }
    .btn-icon {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: var(--gray-soft);
        border: 1px solid var(--border);
        color: var(--gray);
        transition: var(--transition-bounce);
        cursor: pointer;
        text-decoration: none;
    }
    .btn-icon:hover { transform: translateY(-2px) scale(1.02); }
    .btn-edit:hover { background: #3b82f6; color: white; border-color: #3b82f6; box-shadow: 0 4px 10px rgba(59,130,246,0.2); }
    .btn-delete:hover { background: #ef4444; color: white; border-color: #ef4444; box-shadow: 0 4px 10px rgba(239,68,68,0.2); }

    /* Empty State */
    .empty-state { text-align: center; padding: 3rem; }
    .empty-icon {
        width: 70px;
        height: 70px;
        background: var(--gray-soft);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        transition: var(--transition);
    }
    .empty-icon i { font-size: 2rem; color: var(--gray-light); }

    /* Pagination */
    .pagination-wrapper { margin-top: 1.8rem; display: flex; justify-content: center; }
    .pagination { display: flex; gap: 0.3rem; flex-wrap: wrap; justify-content: center; }
    .pagination .page-link {
        padding: 0.45rem 1rem;
        border-radius: 14px;
        background: var(--card);
        border: 1px solid var(--border);
        color: var(--gray);
        font-size: 0.75rem;
        font-weight: 500;
        text-decoration: none;
        transition: var(--transition);
    }
    .pagination .active .page-link {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
    .pagination .page-link:hover {
        background: var(--primary);
        color: white;
        transform: translateY(-1px);
    }

    /* Footer - Dark Elegant */
    .footer-info {
        margin-top: 2rem;
        padding: 1.2rem 2rem;
        background: linear-gradient(135deg, var(--dark), var(--dark-soft));
        border-radius: 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
        transition: var(--transition);
    }
    .footer-info:hover {
        box-shadow: var(--shadow-lg);
        transform: translateY(-2px);
    }
    .footer-info p {
        font-size: 0.75rem;
        color: var(--gray-light);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .footer-info p i {
        color: var(--primary);
        font-size: 0.9rem;
    }
    .footer-info a {
        font-size: 0.8rem;
        font-weight: 600;
        color: white;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1.2rem;
        background: rgba(255,255,255,0.08);
        border-radius: 100px;
        transition: var(--transition-bounce);
    }
    .footer-info a:hover {
        background: var(--primary);
        gap: 0.8rem;
        transform: translateX(-4px);
    }

    /* Animations */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-up { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }

    /* Responsive */
    @media (min-width: 769px) {
        .filter-mobile { display: none; }
        .filter-desktop { display: flex; }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .header-section { flex-direction: column; align-items: flex-start; }
        .btn-group { width: 100%; justify-content: flex-start; }
        .filter-desktop { display: none; }
        .filter-mobile { display: block; }
        .filter-dropdown-menu { max-height: 280px; }
        .footer-info { flex-direction: column; text-align: center; }
        .footer-info p { text-align: center; }
    }

    @media (max-width: 480px) {
        .btn { padding: 0.5rem 1.1rem; font-size: 0.75rem; }
        .member-avatar, .member-avatar-placeholder { width: 38px; height: 38px; border-radius: 12px; }
        .member-name { font-size: 0.8rem; }
        .badge { padding: 0.2rem 0.8rem; font-size: 0.65rem; }
        .jabatan-text { font-size: 0.75rem; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- HEADER --}}
    <div class="header-section animate-up">
        <div>
            <div class="header-badge">
                <i class="fa-solid fa-crown"></i>
                <span>Village Administration</span>
            </div>
            <h1 class="header-title">
                Struktur<br>
                <span>Pengurus Desa</span>
            </h1>
        </div>
        <div class="btn-group">
            <a href="{{ route('admin.pengurus.kategori') }}" class="btn btn-outline">
                <i class="fa-solid fa-tags"></i> Kategori
            </a>
            <a href="{{ route('admin.pengurus.create') }}" class="btn btn-primary">
                <i class="fa-solid fa-plus"></i> Tambah
            </a>
        </div>
    </div>

    {{-- FILTER SECTION - HILANGKAN KATEGORI LAINNYA --}}
    <div class="filter-container animate-up delay-1">
        {{-- Desktop Filter --}}
        <div class="filter-desktop">
            <a href="{{ route('admin.pengurus.index', ['kategori' => 'semua']) }}" 
               class="filter-pill {{ request('kategori', 'semua') == 'semua' ? 'active' : '' }}">
                <i class="fa-solid fa-layer-group"></i> Semua Jabatan
            </a>
            @foreach($hierarki as $key => $kat)
                @if($key !== 'lainnya')
                <a href="{{ route('admin.pengurus.index', ['kategori' => $key]) }}" 
                   class="filter-pill {{ request('kategori') == $key ? 'active' : '' }}">
                    <i class="fa-solid {{ $kat['icon'] }}"></i> {{ $kat['nama'] }}
                    @if(!$kat['is_default'])<span style="font-size: 0.55rem; margin-left: 0.3rem; opacity: 0.7;">custom</span>@endif
                </a>
                @endif
            @endforeach
        </div>

        {{-- Mobile Filter Dropdown --}}
        <div class="filter-mobile">
            <div class="filter-dropdown-trigger" id="filterTrigger">
                <span>
                    <i class="fa-solid fa-filter"></i>
                    @php
                        $selectedKategori = request('kategori', 'semua');
                        $selectedLabel = 'Semua Jabatan';
                        foreach($hierarki as $key => $kat) {
                            if ($selectedKategori == $key) $selectedLabel = $kat['nama'];
                        }
                    @endphp
                    {{ $selectedLabel }}
                </span>
                <i class="fa-solid fa-chevron-down"></i>
            </div>
            <div class="filter-dropdown-menu" id="filterMenu">
                <a href="{{ route('admin.pengurus.index', ['kategori' => 'semua']) }}" 
                   class="filter-dropdown-item {{ request('kategori', 'semua') == 'semua' ? 'active' : '' }}">
                    <i class="fa-solid fa-layer-group"></i> Semua Jabatan
                </a>
                @foreach($hierarki as $key => $kat)
                    @if($key !== 'lainnya')
                    <a href="{{ route('admin.pengurus.index', ['kategori' => $key]) }}" 
                       class="filter-dropdown-item {{ request('kategori') == $key ? 'active' : '' }}">
                        <i class="fa-solid {{ $kat['icon'] }}"></i> {{ $kat['nama'] }}
                        @if(!$kat['is_default'])<span style="font-size: 0.55rem; margin-left: 0.3rem; opacity: 0.7;">custom</span>@endif
                    </a>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- ALERT --}}
    @if(session('success'))
    <div class="alert alert-success animate-up delay-1">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check"></i><span>{{ session('success') }}</span></div>
        <div class="alert-close" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-error animate-up delay-1">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-exclamation"></i><span>{{ session('error') }}</span></div>
        <div class="alert-close" onclick="this.parentElement.remove()"><i class="fa-solid fa-xmark"></i></div>
    </div>
    @endif

    {{-- TABLE --}}
    <div class="table-wrapper animate-up delay-2">
        <div class="table-responsive">
            <table class="table-custom">
                <thead>
                    <tr>
                        <th>Personel</th>
                        <th>Kategori</th>
                        <th>Jabatan</th>
                        <th>Hierarki</th>
                        <th style="text-align: right">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengurus as $item)
                    @if($item->kategori_jabatan !== 'lainnya')
                    <tr>
                        <td>
                            <div class="member-cell">
                                @if($item->foto)
                                    <img src="{{ asset('storage/' . $item->foto) }}" class="member-avatar">
                                @else
                                    <div class="member-avatar-placeholder">
                                        <i class="fa-solid fa-user"></i>
                                    </div>
                                @endif
                                <div>
                                    <div class="member-name">{{ $item->nama_pengurus }}</div>
                                    <div class="member-nip">{{ $item->nip ?? '—' }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge 
                                @if($item->kategori_jabatan == 'kepala_desa') badge-primary
                                @elseif($item->kategori_jabatan == 'sekretaris_desa') badge-blue
                                @elseif($item->kategori_jabatan == 'kepala_urusan') badge-purple
                                @elseif($item->kategori_jabatan == 'kepala_seksi') badge-primary
                                @elseif($item->kategori_jabatan == 'kepala_dusun') badge-orange
                                @else badge-custom @endif">
                                <i class="fa-solid {{ $item->icon_kategori }}"></i> {{ $item->nama_kategori }}
                            </span>
                        </td>
                        <td>
                            <div class="jabatan-text">{{ $item->jabatan }}</div>
                            @if($item->tugas)
                            <div class="tugas-text">{{ Str::limit($item->tugas, 55) }}</div>
                            @endif
                        </td>
                        <td>
                            <div class="level-rank">Urutan #{{ $item->urutan_dalam_kategori }}</div>
                            <div class="level-bars">
                                @php
                                    $activeBars = 6 - min($item->level_kategori ?? 99, 5);
                                    if ($activeBars < 1) $activeBars = 1;
                                    if ($activeBars > 5) $activeBars = 5;
                                @endphp
                                @for($i = 1; $i <= 5; $i++)
                                    <div class="level-bar {{ $i <= $activeBars ? 'active' : '' }}"></div>
                                @endfor
                            </div>
                        </td>
                        <td style="text-align: right">
                            <div class="action-group">
                                <a href="{{ route('admin.pengurus.edit', $item->id_pengurus) }}" class="btn-icon btn-edit" title="Edit">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <form action="{{ route('admin.pengurus.destroy', $item->id_pengurus) }}" method="POST" onsubmit="return confirm('Yakin hapus data ini?')" style="display:inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <div class="empty-icon"><i class="fa-solid fa-users-slash"></i></div>
                            <div class="font-semibold text-gray">Belum Ada Data Pengurus</div>
                            <div class="text-xs text-gray-light mt-1">Silakan tambah data perangkat desa</div>
                            <a href="{{ route('admin.pengurus.create') }}" class="btn btn-primary mt-3" style="display: inline-flex;">
                                <i class="fa-solid fa-plus"></i> Tambah Sekarang
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- PAGINATION --}}
    @if($pengurus->hasPages())
    <div class="pagination-wrapper animate-up delay-3">
        {{ $pengurus->appends(request()->query())->links() }}
    </div>
    @endif

    {{-- FOOTER - DARK ELEGANT --}}
    <div class="footer-info animate-up delay-3">
        <p>
            <i class="fa-regular fa-lightbulb"></i> 
            Hierarki otomatis: Kepala Desa → Sekretaris Desa → Kepala Urusan/Kepala Seksi → Kepala Dusun
        </p>
        <a href="{{ route('admin.profil-desa.index') }}">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Profil Desa
        </a>
    </div>
</div>

<script>
    (function() {
        // Mobile Filter Dropdown
        const trigger = document.getElementById('filterTrigger');
        const menu = document.getElementById('filterMenu');
        
        if (trigger && menu) {
            trigger.addEventListener('click', (e) => {
                e.stopPropagation();
                const isOpen = menu.classList.contains('show');
                menu.classList.toggle('show');
                trigger.classList.toggle('open');
            });
            
            // Close when clicking outside
            document.addEventListener('click', (e) => {
                if (!trigger.contains(e.target) && !menu.contains(e.target)) {
                    menu.classList.remove('show');
                    trigger.classList.remove('open');
                }
            });
            
            // Close after selecting an item
            menu.querySelectorAll('.filter-dropdown-item').forEach(item => {
                item.addEventListener('click', () => {
                    menu.classList.remove('show');
                    trigger.classList.remove('open');
                });
            });
        }
        
        // Auto close alerts after 4 seconds
        setTimeout(() => {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateX(20px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 4000);
    })();
</script>
@endsection