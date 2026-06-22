@extends('layouts.admin')

@section('title', 'Detail Data Penduduk - Lumban Silintong')

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
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .info-label {
        font-size: 0.75rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .info-value {
        font-size: 1.05rem;
        font-weight: 600;
        color: #0f172a;
    }

    .info-value.mono {
        font-family: 'JetBrains Mono', monospace;
        color: #3b82f6;
        background: #eff6ff;
        padding: 0.3rem 0.6rem;
        border-radius: 6px;
        display: inline-block;
        width: fit-content;
        font-size: 0.95rem;
    }

    /* Layout for Identity */
    .identity-wrapper {
        display: flex;
        gap: 2.5rem;
        align-items: flex-start;
        flex-wrap: wrap;
    }

    .identity-details {
        flex: 1;
        min-width: 300px;
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
        min-width: 800px;
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
    <a href="{{ route('admin.penduduk.index') }}" style="display:inline-flex;align-items:center;gap:0.6rem;padding:0.6rem 1.2rem;background:rgba(255,255,255,0.85);backdrop-filter:blur(16px);border:1px solid rgba(0,0,0,0.06);border-radius:24px;color:#1e293b;font-size:0.85rem;font-weight:600;transition:var(--transition);margin-bottom:1.5rem;text-decoration:none;" class="fade-up"
        onmouseover="this.style.transform='translateX(-6px)';this.style.borderColor='#3b82f6';this.style.boxShadow='0 8px 20px rgba(59,130,246,0.1)'"
        onmouseout="this.style.transform='';this.style.borderColor='rgba(0,0,0,0.06)';this.style.boxShadow=''">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Data Penduduk
    </a>

    <!-- Header Section -->
    <div class="header-section fade-up delay-1">
        <div>
            <div class="page-badge">DETAIL PENDUDUK</div>
            <h1 class="page-title">Informasi <span>Individu</span></h1>
        </div>
        <div>
            <a href="{{ route('admin.penduduk.edit', $penduduk->id_penduduk) }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.6rem 1.5rem;background:#3b82f6;color:white;border-radius:20px;font-weight:600;font-size:0.85rem;text-decoration:none;transition:var(--transition);"
                onmouseover="this.style.background='#2563eb';"
                onmouseout="this.style.background='#3b82f6';">
                <i class="fa-solid fa-pen"></i> Edit Data Penduduk
            </a>
        </div>
    </div>

    <!-- Identity Card -->
    <div class="premium-card fade-up delay-1">
        <h2 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-user text-blue-500"></i> Identitas Diri
        </h2>
        
        <div class="identity-wrapper">
            <div class="identity-details">
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nomor Induk Kependudukan (NIK)</span>
                        <span class="info-value mono">{{ $penduduk->nik }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Nomor Kartu Keluarga (KK)</span>
                        <span class="info-value mono" style="background: #e0f2fe; color: #0369a1;">{{ $penduduk->no_kk ?? 'Belum diisi' }}</span>
                    </div>
                    
                    <!-- Line Break visually using flex order or just let grid flow -->
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label">Nama Lengkap</span>
                        <span class="info-value" style="font-size: 1.4rem;">{{ $penduduk->nama_lengkap }}</span>
                    </div>

                    <div class="info-item">
                        <span class="info-label">Jenis Kelamin</span>
                        <span class="info-value">{{ $penduduk->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Tempat, Tanggal Lahir</span>
                        <span class="info-value">{{ $penduduk->tempat_lahir }}, {{ \Carbon\Carbon::parse($penduduk->tanggal_lahir)->translatedFormat('d F Y') }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Agama</span>
                        <span class="info-value">{{ $penduduk->agama }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Pendidikan</span>
                        <span class="info-value">{{ $penduduk->pendidikan }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Pekerjaan</span>
                        <span class="info-value">{{ $penduduk->pekerjaan }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status Perkawinan</span>
                        <span class="info-value">{{ $penduduk->status_perkawinan }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Status Dalam Keluarga</span>
                        <span class="info-value">
                            <span class="status-badge status-{{ strtolower(str_replace(' ', '-', $penduduk->status_keluarga)) }}">
                                {{ $penduduk->status_keluarga }}
                            </span>
                        </span>
                    </div>
                </div>

                <hr style="border: 0; border-top: 1px solid #e2e8f0; margin: 2rem 0;">

                <div class="info-grid">
                    <div class="info-item" style="grid-column: 1 / -1;">
                        <span class="info-label"><i class="fa-solid fa-location-dot"></i> Alamat Lengkap</span>
                        <span class="info-value">{{ $penduduk->alamat }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kelurahan / Desa</span>
                        <span class="info-value">{{ $penduduk->kelurahan_desa }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kecamatan</span>
                        <span class="info-value">{{ $penduduk->kecamatan }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Kabupaten / Kota</span>
                        <span class="info-value">{{ $penduduk->kabupaten_kota }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Provinsi</span>
                        <span class="info-value">{{ $penduduk->provinsi }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="premium-card fade-up delay-2">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2 style="font-size: 1.25rem; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 0.5rem;">
                <i class="fa-solid fa-users text-purple-500"></i> Anggota Keluarga
            </h2>
            @if(!empty($penduduk->no_kk))
            <a href="{{ route('admin.keluarga.show', $penduduk->no_kk) }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.6rem 1.2rem;background:rgba(139,92,246,0.1);color:#8b5cf6;border-radius:20px;font-weight:600;font-size:0.8rem;text-decoration:none;transition:var(--transition);"
                onmouseover="this.style.background='#8b5cf6'; this.style.color='white';"
                onmouseout="this.style.background='rgba(139,92,246,0.1)'; this.style.color='#8b5cf6';">
                Lihat Detail Keluarga <i class="fa-solid fa-arrow-right"></i>
            </a>
            @endif
        </div>

        @if(empty($penduduk->no_kk))
            <div style="text-align: center; padding: 2rem; background: #f8fafc; border-radius: 16px; border: 1px dashed #cbd5e1;">
                <i class="fa-solid fa-circle-exclamation" style="font-size: 2rem; color: #94a3b8; margin-bottom: 1rem;"></i>
                <p style="color: #64748b; font-weight: 500;">Nomor KK belum diisi, sehingga tidak dapat memuat anggota keluarga.</p>
            </div>
        @elseif($keluarga->isEmpty())
            <div style="text-align: center; padding: 2rem; background: #f8fafc; border-radius: 16px; border: 1px dashed #cbd5e1;">
                <i class="fa-solid fa-user-minus" style="font-size: 2rem; color: #94a3b8; margin-bottom: 1rem;"></i>
                <p style="color: #64748b; font-weight: 500;">Tidak ada anggota keluarga lain yang terdaftar dengan Nomor KK ini.</p>
            </div>
        @else
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>Status Hubungan</th>
                            <th>Jenis Kelamin</th>
                            <th>Usia</th>
                            <th style="text-align: center;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($keluarga as $member)
                            <tr style="{{ $member->id_penduduk == $penduduk->id_penduduk ? 'background: rgba(59,130,246,0.05); border-left: 3px solid #3b82f6;' : '' }}">
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
                                <td>{{ \Carbon\Carbon::parse($member->tanggal_lahir)->age }} Tahun</td>
                                <td>
                                    <div style="display: flex; gap: 0.4rem; justify-content: center;">
                                        <a href="{{ route('admin.penduduk.show', $member->id_penduduk) }}" style="width: 32px; height: 32px; border-radius: 10px; display: inline-flex; align-items: center; justify-content: center; background: rgba(16,185,129,0.1); color: #10b981; transition: 0.3s;" title="Detail"
                                            onmouseover="this.style.background='#10b981'; this.style.color='white';"
                                            onmouseout="this.style.background='rgba(16,185,129,0.1)'; this.style.color='#10b981';">
                                            <i class="fa-solid fa-eye" style="font-size: 0.8rem;"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection
