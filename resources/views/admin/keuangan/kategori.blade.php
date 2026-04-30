{{-- resources/views/admin/keuangan/kategori.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manajemen Kategori - Keuangan Desa')

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
        --accent-red: #ef4444;
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

    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    .dashboard-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 2rem;
    }

    /* Editorial Header */
    .editorial-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 2rem;
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

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.5rem 1.2rem;
        background: white;
        border: 1px solid var(--border-color);
        border-radius: 40px;
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-mute);
        text-decoration: none;
        transition: all 0.3s;
    }

    .back-link:hover {
        border-color: var(--accent-primary);
        color: var(--accent-primary);
        transform: translateX(-4px);
    }

    /* Grid Layout */
    .kategori-grid {
        display: grid;
        grid-template-columns: 1fr 1.5fr;
        gap: 1.5rem;
    }

    /* Form Card */
    .form-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
        transition: all 0.4s;
    }

    .form-card:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .form-header {
        background: linear-gradient(135deg, var(--system-bg), var(--system-bg));
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
    }

    .form-header h2 {
        font-size: 1rem;
        font-weight: 700;
        color: white;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-body {
        padding: 1.5rem;
    }

    /* List Card */
    .list-card {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 28px;
        overflow: hidden;
        transition: all 0.4s;
    }

    .list-card:hover {
        box-shadow: 0 20px 35px -12px rgba(0,0,0,0.08);
    }

    .list-header {
        background: #f8fafc;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .list-header h2 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-main);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .list-header span {
        font-size: 0.7rem;
        padding: 0.2rem 0.6rem;
        background: var(--accent-primary);
        color: white;
        border-radius: 40px;
    }

    /* Form Group */
    .form-group {
        margin-bottom: 1.2rem;
    }

    .form-label {
        display: block;
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--text-mute);
        margin-bottom: 0.4rem;
    }

    .form-label i {
        color: var(--accent-primary);
        margin-right: 0.3rem;
    }

    .form-control {
        width: 100%;
        padding: 0.7rem 1rem;
        border: 1.5px solid var(--border-color);
        border-radius: 14px;
        font-size: 0.85rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--accent-primary);
        box-shadow: 0 0 0 3px rgba(16,185,129,0.1);
    }

    select.form-control {
        cursor: pointer;
        background: white;
    }

    input[type="color"].form-control {
        padding: 0.3rem;
        height: 42px;
    }

    /* Button */
    .btn-primary {
        width: 100%;
        padding: 0.7rem 1rem;
        background: linear-gradient(135deg, var(--accent-primary), var(--accent-primary));
        color: white;
        border: none;
        border-radius: 14px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16,185,129,0.3);
    }

    /* Kategori Item */
    .kategori-list {
        max-height: 500px;
        overflow-y: auto;
    }

    .kategori-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 1rem 1.5rem;
        border-bottom: 1px solid var(--border-color);
        transition: all 0.3s;
    }

    .kategori-item:hover {
        background: #fafafa;
    }

    .kategori-item:last-child {
        border-bottom: none;
    }

    .kategori-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .kategori-icon {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s;
    }

    .kategori-item:hover .kategori-icon {
        transform: scale(1.05);
    }

    .kategori-detail h4 {
        font-weight: 700;
        font-size: 0.9rem;
        margin-bottom: 0.2rem;
    }

    .kategori-badge {
        font-size: 0.6rem;
        padding: 0.2rem 0.6rem;
        border-radius: 40px;
        font-weight: 600;
    }

    .badge-pemasukan {
        background: #d1fae5;
        color: #059669;
    }

    .badge-pengeluaran {
        background: #fee2e2;
        color: #dc2626;
    }

    /* Action Buttons */
    .action-deck {
        display: flex;
        gap: 0.5rem;
        opacity: 0.6;
        transition: all 0.3s;
    }

    .kategori-item:hover .action-deck {
        opacity: 1;
    }

    .deck-btn {
        width: 34px;
        height: 34px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
        color: var(--text-mute);
        background: white;
        cursor: pointer;
        text-decoration: none;
    }

    .deck-btn:hover {
        background: var(--system-bg);
        color: white;
        border-color: var(--system-bg);
    }

    .btn-edit:hover { background: var(--accent-blue); border-color: var(--accent-blue); }
    .btn-delete:hover { background: var(--accent-red); border-color: var(--accent-red); }

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

    /* Empty State */
    .void-container {
        padding: 3rem 0;
        text-align: center;
    }

    .void-icon {
        width: 70px;
        height: 70px;
        background: #f1f5f9;
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
    }

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

    /* Responsive */
    @media (max-width: 1024px) {
        .dashboard-wrapper { padding: 1rem; }
        .kategori-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 640px) {
        .editorial-header { flex-direction: column; align-items: flex-start; gap: 1rem; }
        .brand-title { font-size: 2rem; }
        .kategori-info { flex-wrap: wrap; }
    }

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

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Header --}}
    <header class="editorial-header fade-up">
        <div>
            <h1 class="brand-title font-display">Manajemen<br><span style="color: var(--accent-primary);">Kategori</span>.</h1>
            <p class="brand-subtitle">
                Kelola kategori pemasukan dan pengeluaran keuangan desa.
            </p>
        </div>
        <a href="{{ route('admin.keuangan.index') }}" class="back-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Keuangan
        </a>
    </header>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert-node alert-success fade-up delay-1">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-check"></i><span>{{ session('success') }}</span></div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert-node alert-error fade-up delay-1">
        <div class="flex items-center gap-2"><i class="fa-solid fa-circle-exclamation"></i><span>{{ session('error') }}</span></div>
        <button onclick="this.parentElement.remove()" class="opacity-50 hover:opacity-100"><i class="fa-solid fa-xmark"></i></button>
    </div>
    @endif

    {{-- Grid --}}
    <div class="kategori-grid">
        
        {{-- Form Tambah Kategori --}}
        <div class="form-card fade-up delay-2">
            <div class="form-header">
                <h2><i class="fa-solid fa-plus-circle"></i> Tambah Kategori Baru</h2>
            </div>
            <div class="form-body">
                <form action="{{ route('admin.keuangan.kategori.store') }}" method="POST">
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-tag"></i> Nama Kategori</label>
                        <input type="text" name="nama_kategori" required class="form-control" placeholder="Contoh: Pembangunan, Renovasi">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-chart-simple"></i> Jenis</label>
                        <select name="jenis" required class="form-control">
                            <option value="pemasukan">💰 Pemasukan</option>
                            <option value="pengeluaran">💸 Pengeluaran</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-icons"></i> Icon (Font Awesome)</label>
                        <input type="text" name="icon" value="fa-solid fa-tag" class="form-control" placeholder="fa-solid fa-building">
                        <p class="text-xs text-gray-400 mt-1">Contoh: fa-solid fa-building, fa-solid fa-store</p>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-regular fa-palette"></i> Warna</label>
                        <input type="color" name="warna" value="#10b981" class="form-control">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label"><i class="fa-solid fa-sort-numeric-down"></i> Urutan</label>
                        <input type="number" name="urutan" value="0" class="form-control">
                    </div>
                    
                    <button type="submit" class="btn-primary">
                        <i class="fa-solid fa-save"></i> Simpan Kategori
                    </button>
                </form>
            </div>
        </div>

        {{-- Daftar Kategori --}}
        <div class="list-card fade-up delay-3">
            <div class="list-header">
                <h2><i class="fa-solid fa-list"></i> Daftar Kategori</h2>
                <span>{{ $kategoris->count() }} Kategori</span>
            </div>
            
            <div class="kategori-list">
                @forelse($kategoris as $k)
                <div class="kategori-item">
                    <div class="kategori-info">
                        <div class="kategori-icon" style="background: {{ $k->warna }}20; color: {{ $k->warna }}">
                            <i class="{{ $k->icon }}"></i>
                        </div>
                        <div class="kategori-detail">
                            <h4>{{ $k->nama_kategori }}</h4>
                            <span class="kategori-badge {{ $k->jenis == 'pemasukan' ? 'badge-pemasukan' : 'badge-pengeluaran' }}">
                                {{ $k->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                            </span>
                        </div>
                    </div>
                    <div class="action-deck">
                        <button onclick="openEditModal({{ $k->id_kategori }}, '{{ $k->nama_kategori }}', '{{ $k->jenis }}', '{{ $k->icon }}', '{{ $k->warna }}', {{ $k->urutan }})" 
                                class="deck-btn btn-edit" title="Edit">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <form action="{{ route('admin.keuangan.kategori.destroy', $k->id_kategori) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="deck-btn btn-delete" title="Hapus">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
                @empty
                <div class="void-container">
                    <div class="void-icon">
                        <i class="fa-regular fa-folder-open text-2xl text-gray-400"></i>
                    </div>
                    <p class="text-gray-400 text-sm">Belum ada kategori</p>
                    <p class="text-xs text-gray-300 mt-1">Silakan tambah kategori baru</p>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Kategori --}}
<div id="editModal" class="modal-overlay">
    <div class="modal-container">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
            <div class="flex items-center justify-between">
                <h3 class="text-xl font-bold text-white"><i class="fa-solid fa-pen"></i> Edit Kategori</h3>
                <button onclick="closeEditModal()" class="text-white/80 hover:text-white"><i class="fa-solid fa-times text-xl"></i></button>
            </div>
        </div>
        <form id="editForm" method="POST" class="p-6">
            @csrf
            @method('PUT')
            <div class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori</label>
                    <input type="text" name="nama_kategori" id="edit_nama" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis</label>
                    <select name="jenis" id="edit_jenis" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                        <option value="pemasukan">💰 Pemasukan</option>
                        <option value="pengeluaran">💸 Pengeluaran</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Icon</label>
                    <input type="text" name="icon" id="edit_icon" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Warna</label>
                    <input type="color" name="warna" id="edit_warna" class="w-full h-10 rounded-lg border border-gray-200 cursor-pointer">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Urutan</label>
                    <input type="number" name="urutan" id="edit_urutan" class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                </div>
            </div>
            <div class="flex gap-3 justify-end mt-6">
                <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-lg">Batal</button>
                <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">Simpan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditModal(id, nama, jenis, icon, warna, urutan) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_jenis').value = jenis;
        document.getElementById('edit_icon').value = icon;
        document.getElementById('edit_warna').value = warna;
        document.getElementById('edit_urutan').value = urutan;
        
        form.action = '/admin/keuangan/kategori/' + id;
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
    }
    
    function closeEditModal() {
        document.getElementById('editModal').style.display = 'none';
        document.body.style.overflow = 'auto';
    }
    
    // Close modal on ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeEditModal();
        }
    });
    
    // Close modal when clicking outside
    window.onclick = function(event) {
        const modal = document.getElementById('editModal');
        if (event.target === modal) {
            closeEditModal();
        }
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection