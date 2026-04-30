{{-- resources/views/admin/pengurus-kategori.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Kategori Pengurus - Lumban Silintong')

@section('content')
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
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* ============================================
       BACK BUTTON
    ============================================ */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1rem;
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 60px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--gray);
        text-decoration: none;
        transition: var(--transition-bounce);
        margin-bottom: 2rem;
    }

    .back-link:hover {
        border-color: var(--primary);
        color: var(--primary);
        transform: translateX(-4px);
        background: var(--primary-soft);
    }

    /* ============================================
       HEADER SECTION
    ============================================ */
    .header-section {
        margin-bottom: 2rem;
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
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
    }

    .header-title span { color: var(--primary); font-family: 'Instrument Serif', serif; font-style: italic; font-weight: 400; }

    .header-subtitle {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
    }

    /* ============================================
       CARD PREMIUM
    ============================================ */
    .card-premium {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 28px;
        overflow: hidden;
        transition: var(--transition);
        margin-bottom: 1.5rem;
    }

    .card-premium:hover {
        box-shadow: var(--shadow-md);
    }

    .card-header {
        padding: 1.2rem 1.5rem;
        background: linear-gradient(135deg, var(--gray-soft), var(--card));
        border-bottom: 1px solid var(--border);
    }

    .card-header h2 {
        font-size: 1rem;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-header h2 i { color: var(--primary); font-size: 1.1rem; }

    .card-body {
        padding: 1.5rem;
    }

    /* ============================================
       KATEGORI LIST
    ============================================ */
    .kategori-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .kategori-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 0.9rem 1.2rem;
        background: var(--gray-soft);
        border: 1px solid var(--border);
        border-radius: 20px;
        transition: var(--transition-bounce);
    }

    .kategori-item:hover {
        transform: translateX(4px);
        border-color: var(--primary);
        background: white;
        box-shadow: var(--shadow-sm);
    }

    .kategori-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .kategori-icon {
        width: 40px;
        height: 40px;
        border-radius: 14px;
        background: var(--primary-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
    }

    .kategori-item:hover .kategori-icon {
        background: var(--primary);
        transform: scale(1.05);
    }

    .kategori-item:hover .kategori-icon i {
        color: white;
    }

    .kategori-icon i { font-size: 1rem; color: var(--primary); transition: var(--transition); }

    .kategori-detail {
        display: flex;
        flex-direction: column;
        gap: 0.2rem;
    }

    .kategori-nama {
        font-weight: 700;
        font-size: 0.9rem;
        color: var(--dark);
    }

    .kategori-key {
        font-size: 0.65rem;
        font-family: monospace;
        color: var(--gray);
    }

    .kategori-level {
        font-size: 0.65rem;
        padding: 0.2rem 0.6rem;
        background: white;
        border-radius: 40px;
        color: var(--gray);
        font-weight: 600;
    }

    .badge-default {
        font-size: 0.6rem;
        padding: 0.2rem 0.6rem;
        background: #e2e8f0;
        border-radius: 40px;
        color: var(--gray);
        font-weight: 600;
    }

    .btn-delete-kategori {
        width: 34px;
        height: 34px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        border: 1px solid var(--border);
        color: var(--gray);
        cursor: pointer;
        transition: var(--transition-bounce);
    }

    .btn-delete-kategori:hover {
        background: #fee2e2;
        color: #ef4444;
        border-color: #fecaca;
        transform: scale(1.05);
    }

    /* ============================================
       FORM PREMIUM
    ============================================ */
    .form-premium {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 2px dashed var(--border);
    }

    .form-title {
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--dark);
    }

    .form-title i { color: var(--primary); }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1.2rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.4rem;
    }

    .form-group label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--gray);
    }

    .form-control {
        padding: 0.7rem 1rem;
        border: 1px solid var(--border);
        border-radius: 14px;
        font-size: 0.85rem;
        transition: var(--transition);
        font-family: inherit;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px var(--primary-soft);
    }

    select.form-control {
        cursor: pointer;
        background: white;
    }

    .btn-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.7rem 1.5rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition-bounce);
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.25);
    }

    /* ============================================
       TIPS PREMIUM
    ============================================ */
    .tips-premium {
        background: linear-gradient(135deg, #eff6ff, #dbeafe);
        border-radius: 20px;
        padding: 1rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        transition: var(--transition);
    }

    .tips-premium:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .tips-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .tips-icon i { font-size: 1.2rem; color: #2563eb; }

    .tips-content p {
        font-size: 0.75rem;
        color: #1e40af;
        line-height: 1.4;
    }

    .tips-content p i { margin-right: 0.3rem; }

    /* Animations */
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-up { animation: fadeUp 0.5s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .delay-1 { animation-delay: 0.05s; }
    .delay-2 { animation-delay: 0.1s; }
    .delay-3 { animation-delay: 0.15s; }
    .delay-4 { animation-delay: 0.2s; }

    /* Responsive */
    @media (max-width: 640px) {
        .container-premium { padding: 1rem; }
        .form-grid { grid-template-columns: 1fr; }
        .kategori-info { flex-wrap: wrap; }
        .tips-premium { flex-direction: column; text-align: center; }
        .card-header h2 { font-size: 0.9rem; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">

    {{-- Back Button --}}
    <a href="{{ route('admin.pengurus.index') }}" class="back-link animate-up">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Pengurus
    </a>

    {{-- Header --}}
    <div class="header-section animate-up delay-1">
        <div class="header-badge">
            <i class="fa-solid fa-crown"></i>
            <span>Kategori Management</span>
        </div>
        <h1 class="header-title">
            Kelola<br>
            <span>Kategori Jabatan</span>
        </h1>
        <p class="header-subtitle">
            Atur dan kelola kategori jabatan untuk struktur perangkat desa.
        </p>
    </div>

    {{-- Alert Messages --}}
    @if(session('success'))
    <div class="alert-premium animate-up delay-1" style="margin-bottom: 1.5rem; padding: 0.85rem 1.2rem; background: #ecfdf5; border-left: 3px solid var(--primary); border-radius: 16px; display: flex; align-items: center; justify-content: space-between;">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check" style="color: var(--primary);"></i><span style="color: #059669;">{{ session('success') }}</span></div>
        <div onclick="this.parentElement.remove()" style="cursor: pointer; opacity: 0.6;"><i class="fa-solid fa-xmark"></i></div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-premium animate-up delay-1" style="margin-bottom: 1.5rem; padding: 0.85rem 1.2rem; background: #fef2f2; border-left: 3px solid #ef4444; border-radius: 16px; display: flex; align-items: center; justify-content: space-between;">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-exclamation" style="color: #ef4444;"></i><span style="color: #dc2626;">{{ session('error') }}</span></div>
        <div onclick="this.parentElement.remove()" style="cursor: pointer; opacity: 0.6;"><i class="fa-solid fa-xmark"></i></div>
    </div>
    @endif

    {{-- Default Kategori Card --}}
    <div class="card-premium animate-up delay-2">
        <div class="card-header">
            <h2>
                <i class="fa-solid fa-lock"></i>
                Kategori Default
                <span class="badge-default" style="margin-left: 0.5rem;">Tidak dapat dihapus</span>
            </h2>
        </div>
        <div class="card-body">
            <div class="kategori-list">
                @foreach($hierarki as $key => $kat)
                    @if(($kat['is_default'] ?? false) && $key !== 'lainnya')
                    <div class="kategori-item">
                        <div class="kategori-info">
                            <div class="kategori-icon">
                                <i class="fa-solid {{ $kat['icon'] }}"></i>
                            </div>
                            <div class="kategori-detail">
                                <span class="kategori-nama">{{ $kat['nama'] }}</span>
                                <span class="kategori-key">{{ $key }}</span>
                            </div>
                            <span class="kategori-level">
                                <i class="fa-solid fa-chart-simple"></i> Level {{ $kat['level'] }}
                            </span>
                        </div>
                        <span class="badge-default">
                            <i class="fa-solid fa-ban"></i> Default
                        </span>
                    </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    {{-- Custom Kategori Card --}}
    <div class="card-premium animate-up delay-3">
        <div class="card-header">
            <h2>
                <i class="fa-solid fa-plus-circle"></i>
                Kategori Tambahan
            </h2>
        </div>
        <div class="card-body">
            @php
                $customKategori = [];
                foreach($hierarki as $key => $kat) {
                    if(!($kat['is_default'] ?? false) && $key !== 'lainnya') $customKategori[$key] = $kat;
                }
            @endphp
            
            @if(count($customKategori) > 0)
                <div class="kategori-list" style="margin-bottom: 1.5rem;">
                    @foreach($customKategori as $key => $kat)
                    <div class="kategori-item">
                        <div class="kategori-info">
                            <div class="kategori-icon" style="background: #f3e8ff;">
                                <i class="fa-solid {{ $kat['icon'] }}" style="color: #7c3aed;"></i>
                            </div>
                            <div class="kategori-detail">
                                <span class="kategori-nama">{{ $kat['nama'] }}</span>
                                <span class="kategori-key">{{ $key }}</span>
                            </div>
                            <span class="kategori-level">
                                <i class="fa-solid fa-chart-simple"></i> Level {{ $kat['level'] }}
                            </span>
                        </div>
                        <form action="{{ route('admin.pengurus.kategori.destroy', $key) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini? Data pengurus dengan kategori ini akan kehilangan kategorinya.')" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete-kategori" title="Hapus Kategori">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                    @endforeach
                </div>
            @else
                <div style="text-align: center; padding: 2rem; background: var(--gray-soft); border-radius: 20px; margin-bottom: 1.5rem;">
                    <i class="fa-solid fa-folder-open" style="font-size: 2rem; color: var(--gray-light); margin-bottom: 0.5rem; display: block;"></i>
                    <p style="color: var(--gray); font-size: 0.8rem;">Belum ada kategori tambahan</p>
                </div>
            @endif

            {{-- Form Tambah Kategori --}}
            <div class="form-premium">
                <div class="form-title">
                    <i class="fa-solid fa-plus-circle"></i>
                    Tambah Kategori Baru
                </div>
                <form action="{{ route('admin.pengurus.kategori.store') }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <div class="form-group">
                            <label><i class="fa-regular fa-key"></i> Key Identifier</label>
                            <input type="text" name="key" class="form-control" placeholder="contoh: bpd, lpmd, linmas" required>
                            <small style="font-size: 0.6rem; color: var(--gray-light);">Huruf kecil, tanpa spasi</small>
                        </div>
                        <div class="form-group">
                            <label><i class="fa-regular fa-tag"></i> Nama Kategori</label>
                            <input type="text" name="nama" class="form-control" placeholder="Contoh: BPD, LPMD, Linmas" required>
                        </div>
                        <div class="form-group">
                            <label><i class="fa-regular fa-icons"></i> Icon (FontAwesome)</label>
                            <input type="text" name="icon" class="form-control" placeholder="fa-building, fa-handshake" value="fa-solid fa-tag">
                        </div>
                        <div class="form-group">
                            <label><i class="fa-regular fa-palette"></i> Warna</label>
                            <select name="color" class="form-control">
                                <option value="gray">Gray (Abu-abu)</option>
                                <option value="amber">Amber (Kuning)</option>
                                <option value="blue">Blue (Biru)</option>
                                <option value="green">Green (Hijau)</option>
                                <option value="purple">Purple (Ungu)</option>
                                <option value="pink">Pink (Merah Muda)</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="btn-submit">
                        <i class="fa-solid fa-plus"></i> Tambah Kategori
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Tips Card --}}
    <div class="tips-premium animate-up delay-4">
        <div class="tips-icon">
            <i class="fa-regular fa-lightbulb"></i>
        </div>
        <div class="tips-content">
            <p><i class="fa-solid fa-info-circle"></i> Kategori custom akan muncul secara otomatis di bagian bawah hierarki setelah Kepala Dusun.</p>
            <p style="font-size: 0.7rem; margin-top: 0.3rem;"><i class="fa-regular fa-clock"></i> Perubahan akan langsung terlihat di halaman pengurus.</p>
        </div>
    </div>
</div>

<script>
    // Auto close alerts after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert-premium').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(20px)';
            setTimeout(() => alert.remove(), 300);
        });
    }, 4000);
</script>
@endsection