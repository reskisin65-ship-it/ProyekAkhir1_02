@extends('layouts.admin')

@section('title', 'Detail Data Keluarga - Lumban Silintong')

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
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
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

    /* Card Premium */
    .premium-card {
        background: var(--glass-bg);
        backdrop-filter: blur(16px);
        border: 1px solid var(--glass-border);
        border-radius: 24px;
        box-shadow: var(--glass-shadow);
        padding: 2rem;
        margin-bottom: 2rem;
        transition: var(--transition);
    }

    .premium-card:hover {
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.08);
    }

    /* Info Grid */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-value {
        font-size: 1rem;
        font-weight: 600;
        color: #0f172a;
    }

    .info-value.mono {
        font-family: 'JetBrains Mono', monospace;
        color: #3b82f6;
        background: #eff6ff;
        padding: 0.2rem 0.5rem;
        border-radius: 6px;
        display: inline-block;
        width: fit-content;
    }

    /* Table Styling */
    .table-container {
        overflow-x: auto;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }

    .data-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 1000px;
    }

    .data-table thead {
        background: #f8fafc;
    }

    .data-table th {
        text-align: left;
        padding: 1rem;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: #64748b;
        border-bottom: 1px solid #e2e8f0;
        white-space: nowrap;
    }

    .data-table td {
        padding: 1rem;
        font-size: 0.85rem;
        color: #334155;
        border-bottom: 1px solid #f1f5f9;
        vertical-align: middle;
    }

    .data-table tbody tr {
        transition: var(--transition);
    }

    .data-table tbody tr:hover {
        background: rgba(59,130,246,0.03);
    }

    .data-table tbody tr:last-child td {
        border-bottom: none;
    }

    /* Badges */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.6rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-kepala-keluarga { background: #d1fae5; color: #059669; }
    .status-istri { background: #fce7f3; color: #db2777; }
    .status-anak { background: #dbeafe; color: #2563eb; }
    .status-anggota-keluarga { background: #fef3c7; color: #d97706; }
    .status-lainnya { background: #f1f5f9; color: #64748b; }

    /* Action Buttons */
    .btn-action {
        width: 32px;
        height: 32px;
        border-radius: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        text-decoration: none;
        font-size: 0.8rem;
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

    /* Animations */
    .fade-up {
        animation: fadeUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
</style>

<div class="premium-container">
    
    <!-- Back Button -->
    <a href="{{ route('admin.keluarga.index') }}" style="display:inline-flex;align-items:center;gap:0.6rem;padding:0.6rem 1.2rem;background:rgba(255,255,255,0.85);backdrop-filter:blur(16px);border:1px solid rgba(0,0,0,0.06);border-radius:24px;color:#1e293b;font-size:0.85rem;font-weight:600;transition:var(--transition);margin-bottom:1.5rem;text-decoration:none;" class="fade-up"
        onmouseover="this.style.transform='translateX(-6px)';this.style.borderColor='#3b82f6';this.style.boxShadow='0 8px 20px rgba(59,130,246,0.1)'"
        onmouseout="this.style.transform='';this.style.borderColor='rgba(0,0,0,0.06)';this.style.boxShadow=''">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Data Keluarga
    </a>

    <!-- Header Section -->
    <div class="header-section fade-up delay-1">
        <div>
            <div class="page-badge">DETAIL KELUARGA</div>
            <h1 class="page-title">Informasi <span>Keluarga</span></h1>
        </div>
    </div>

    <!-- Info Card -->
    <div class="premium-card fade-up delay-1">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-id-card text-blue-500"></i> Informasi Kepala Keluarga
        </h2>
        <div class="info-grid">
            <div class="info-item">
                <span class="info-label">Nomor Kartu Keluarga (KK)</span>
                <span class="info-value mono">{{ $no_kk }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Kepala Keluarga</span>
                <span class="info-value">{{ $head ? $head->nama_lengkap : '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Alamat Lengkap</span>
                <span class="info-value">{{ $head ? $head->alamat : '-' }}</span>
            </div>
            <div class="info-item">
                <span class="info-label">Jumlah Anggota Keluarga</span>
                <span class="info-value">
                    <span style="background: #f0fdf4; color: #16a34a; padding: 0.2rem 0.6rem; border-radius: 20px; font-weight: 700;">
                        <i class="fa-solid fa-users"></i> {{ $sortedMembers->count() }} Orang
                    </span>
                </span>
            </div>
        </div>
    </div>

    <!-- Members List Card -->
    <div class="premium-card fade-up delay-2">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-list-ul text-purple-500"></i> Daftar Anggota Keluarga
            </h2>
            <a href="{{ route('admin.penduduk.create') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.6rem 1.2rem;background:#10b981;color:white;border-radius:20px;font-weight:600;font-size:0.8rem;text-decoration:none;transition:var(--transition);"
                onmouseover="this.style.background='#059669';"
                onmouseout="this.style.background='#10b981';">
                <i class="fa-solid fa-plus"></i> Tambah Anggota
            </a>
        </div>

        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>NIK</th>
                        <th>Nama Lengkap</th>
                        <th>Status Hubungan</th>
                        <th>Jenis Kelamin</th>
                        <th>Tempat, Tanggal Lahir</th>
                        <th>Agama</th>
                        <th>Pendidikan</th>
                        <th>Pekerjaan</th>
                        <th>Status Perkawinan</th>
                        <th style="text-align: center;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sortedMembers as $member)
                        <tr>
                            <td>
                                <span style="font-family: 'JetBrains Mono', monospace; font-size: 0.8rem; color: #475569; background: #f1f5f9; padding: 0.2rem 0.4rem; border-radius: 4px;">
                                    {{ $member->nik }}
                                </span>
                            </td>
                            <td>
                                <div style="font-weight: 600; color: #0f172a;">{{ $member->nama_lengkap }}</div>
                            </td>
                            <td>
                                <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $member->status_keluarga)) }}">
                                    {{ $member->status_keluarga }}
                                </span>
                            </td>
                            <td>{{ $member->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $member->tempat_lahir }}, {{ \Carbon\Carbon::parse($member->tanggal_lahir)->translatedFormat('d M Y') }}</td>
                            <td>{{ $member->agama }}</td>
                            <td>{{ $member->pendidikan }}</td>
                            <td>{{ $member->pekerjaan }}</td>
                            <td>{{ $member->status_perkawinan }}</td>
                            <td>
                                <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                    <a href="{{ route('admin.penduduk.edit', $member->id_penduduk) }}" class="btn-action btn-edit" title="Edit">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                    <form action="{{ route('admin.penduduk.destroy', $member->id_penduduk) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data penduduk ini?')" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Hapus">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
