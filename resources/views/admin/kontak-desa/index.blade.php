{{-- resources/views/admin/kontak-desa/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Kontak Desa')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
    /* ============================================
       DESIGN SYSTEM PREMIUM
    ============================================ */
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
        --dark: #0f172a;
        --gray: #64748b;
        --gray-light: #94a3b8;
        --gray-soft: #f1f5f9;
        --bg: #fafbfc;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.03);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.05);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.08);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.1);
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--dark);
        -webkit-font-smoothing: antialiased;
    }

    /* Background Pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        opacity: 0.3;
    }

    /* Container Premium */
    .container-premium {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Header Section */
    .header-section {
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .header-title h1 {
        font-size: 1.8rem;
        font-weight: 800;
        letter-spacing: -0.03em;
        color: var(--dark);
    }

    .header-title h1 span {
        color: var(--primary);
    }

    .header-title p {
        font-size: 0.8rem;
        color: var(--gray);
        margin-top: 0.3rem;
    }

    .btn-premium {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.7rem 1.5rem;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 60px;
        font-size: 0.75rem;
        font-weight: 700;
        text-decoration: none;
        transition: var(--transition-bounce);
        box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .btn-premium:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    /* Alert Premium */
    .alert-premium {
        margin-bottom: 1.5rem;
        padding: 1rem 1.2rem;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        animation: slideInRight 0.4s ease;
    }

    @keyframes slideInRight {
        from { opacity: 0; transform: translateX(30px); }
        to { opacity: 1; transform: translateX(0); }
    }

    .alert-success {
        background: #ecfdf5;
        border-left: 3px solid var(--primary);
        color: #059669;
    }

    /* Table Card */
    .table-card {
        background: var(--card);
        border-radius: 28px;
        border: 1px solid var(--border);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition-bounce);
    }

    .table-card:hover {
        box-shadow: var(--shadow-xl);
    }

    .table-header {
        padding: 1.2rem 1.5rem;
        background: linear-gradient(135deg, rgba(16,185,129,0.03), transparent);
        border-bottom: 1px solid var(--border);
    }

    .table-header h3 {
        font-size: 1rem;
        font-weight: 800;
        color: var(--dark);
    }

    .data-table {
        width: 100%;
    }

    .data-table th {
        padding: 1rem 1rem;
        text-align: left;
        font-size: 0.7rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        border-bottom: 1px solid var(--border);
    }

    .data-table td {
        padding: 1rem 1rem;
        font-size: 0.85rem;
        border-bottom: 1px solid var(--border);
        transition: var(--transition);
    }

    .data-table tr:hover {
        background: var(--primary-soft);
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        padding: 0.25rem 0.8rem;
        border-radius: 40px;
        font-size: 0.65rem;
        font-weight: 700;
    }

    .status-active {
        background: #d1fae5;
        color: #059669;
    }

    .status-inactive {
        background: #fee2e2;
        color: #dc2626;
    }

    /* Action Buttons */
    .action-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 10px;
        transition: var(--transition-bounce);
    }

    .action-edit {
        background: #dbeafe;
        color: #2563eb;
    }

    .action-edit:hover {
        background: #2563eb;
        color: white;
        transform: translateY(-2px);
    }

    .action-delete {
        background: #fee2e2;
        color: #dc2626;
    }

    .action-delete:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
    }

    .action-toggle {
        background: #fef3c7;
        color: #d97706;
    }

    .action-toggle:hover {
        background: #d97706;
        color: white;
        transform: translateY(-2px);
    }

    /* Avatar */
    .avatar {
        width: 40px;
        height: 40px;
        border-radius: 14px;
        object-fit: cover;
        box-shadow: var(--shadow-sm);
    }

    .avatar-placeholder {
        width: 40px;
        height: 40px;
        border-radius: 14px;
        background: var(--gray-soft);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Pagination */
    .pagination-wrapper {
        margin-top: 1.5rem;
        padding: 1rem;
        background: var(--gray-soft);
        border-radius: 20px;
    }

    /* Tutorial Section */
    .tutorial-section {
        margin-top: 2.5rem;
        background: linear-gradient(135deg, var(--card), #ffffff);
        border-radius: 28px;
        padding: 1.8rem;
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .tutorial-section:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.2rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .tutorial-header h3 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        color: var(--dark);
    }

    .tutorial-intro {
        font-size: 0.85rem;
        color: var(--gray);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.2rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.8rem;
        border-radius: 16px;
        transition: var(--transition);
        cursor: pointer;
        background: var(--gray-soft);
    }

    .tutorial-item:hover {
        background: var(--primary-soft);
        transform: translateX(5px);
    }

    .tutorial-num {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.85rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .tutorial-item:hover .tutorial-num {
        transform: scale(1.1);
    }

    .tutorial-text h4 {
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--dark);
    }

    .tutorial-text p {
        font-size: 0.7rem;
        color: var(--gray);
        line-height: 1.4;
    }

    .tutorial-footer {
        margin-top: 1rem;
        padding: 0.8rem 1rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
        transition: var(--transition);
    }

    .tutorial-footer:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .tutorial-footer i {
        color: var(--primary);
        font-size: 1rem;
    }

    .tutorial-footer span {
        font-size: 0.75rem;
        color: #059669;
        line-height: 1.4;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .tutorial-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .container-premium {
            padding: 1rem;
        }
        .header-section {
            flex-direction: column;
            align-items: flex-start;
        }
        .tutorial-section {
            padding: 1rem;
        }
        .tutorial-grid {
            grid-template-columns: 1fr;
        }
        .data-table th, .data-table td {
            padding: 0.75rem;
            font-size: 0.75rem;
        }
        .action-btn {
            width: 28px;
            height: 28px;
        }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- HEADER SECTION --}}
    <div class="header-section animate__animated animate__fadeInUp">
        <div class="header-title">
            <h1>📞 <span>Kelola Kontak</span> Desa</h1>
            <p>Kelola daftar kontak perangkat desa yang akan ditampilkan di halaman publik</p>
        </div>
        <a href="{{ route('admin.kontak-desa.create') }}" class="btn-premium">
            <i class="fa-solid fa-plus"></i> Tambah Kontak
        </a>
    </div>

    {{-- ALERT SUCCESS --}}
    @if(session('success'))
    <div class="alert-premium alert-success animate__animated animate__fadeInUp">
        <div class="flex items-center gap-2">
            <i class="fa-solid fa-circle-check"></i>
            <span>{{ session('success') }}</span>
        </div>
        <div class="alert-close cursor-pointer opacity-60 hover:opacity-100 p-1" onclick="this.parentElement.remove()">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    @endif

    {{-- TABLE CARD --}}
    <div class="table-card animate__animated animate__fadeInUp" style="animation-delay: 0.05s">
        <div class="table-header">
            <h3><i class="fa-solid fa-list-ul text-emerald-500 mr-2"></i> Daftar Kontak Perangkat Desa</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Foto</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>No HP</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kontak as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }} </td>
                        <td>
                            @if($item->foto)
                                <img src="{{ asset('storage/'.$item->foto) }}" class="avatar" alt="{{ $item->nama }}">
                            @else
                                <div class="avatar-placeholder">
                                    <i class="fa-solid fa-user text-gray-400 text-sm"></i>
                                </div>
                            @endif
                        </td>
                        <td class="font-semibold">{{ $item->nama }}</td>
                        <td>{{ $item->jabatan }}</td>
                        <td>{{ $item->no_hp }}</td>
                        <td>
                            <span class="status-badge {{ $item->is_active ? 'status-active' : 'status-inactive' }}">
                                <i class="fa-solid {{ $item->is_active ? 'fa-circle-check' : 'fa-circle-xmark' }} text-xs"></i>
                                {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td>
                            <div class="flex gap-1">
                                <a href="{{ route('admin.kontak-desa.edit', $item->id) }}" class="action-btn action-edit" title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </a>
                                <form action="{{ route('admin.kontak-desa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kontak ini?')" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="action-btn action-delete" title="Hapus">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                                <a href="{{ route('admin.kontak-desa.toggle-status', $item->id) }}" class="action-btn action-toggle" title="{{ $item->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="fa-solid {{ $item->is_active ? 'fa-eye-slash' : 'fa-eye' }} text-xs"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-12">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fa-regular fa-address-book text-3xl text-gray-400"></i>
                            </div>
                            <p class="text-gray-400">Belum ada data kontak</p>
                            <a href="{{ route('admin.kontak-desa.create') }}" class="inline-block mt-3 text-emerald-600 hover:underline text-sm">Tambah kontak pertama →</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($kontak->hasPages())
        <div class="pagination-wrapper">
            {{ $kontak->links() }}
        </div>
        @endif
    </div>

    {{-- TUTORIAL SECTION --}}
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Kelola Kontak Desa</h3>
        </div>
        
        <p class="tutorial-intro">
            Halaman <strong>Kelola Kontak Desa</strong> digunakan untuk mengelola data kontak perangkat desa 
            yang akan ditampilkan di halaman publik. Berikut panduan penggunaannya:
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>➕ Tambah Kontak</h4>
                    <p>Klik tombol "Tambah Kontak" untuk menambahkan data perangkat desa baru.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>✏️ Edit Kontak</h4>
                    <p>Klik ikon pensil untuk mengedit data kontak (nama, jabatan, no HP, dll).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>🗑️ Hapus Kontak</h4>
                    <p>Klik ikon tempat sampah untuk menghapus kontak dari database.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>👁️ Toggle Status</h4>
                    <p>Klik ikon mata untuk mengaktifkan atau menonaktifkan tampil di publik.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>🖼️ Upload Foto</h4>
                    <p>Setiap kontak dapat dilengkapi foto untuk tampilan lebih profesional.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>📊 Data Realtime</h4>
                    <p>Perubahan data akan langsung tampil di halaman kontak publik.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">7</div>
                <div class="tutorial-text">
                    <h4>🔍 Urutan Tampil</h4>
                    <p>Atur urutan tampil dengan mengisi kolom urutan (semakin kecil, semakin atas).</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">8</div>
                <div class="tutorial-text">
                    <h4>💡 Tips Pengelolaan</h4>
                    <p>Pastikan nomor WhatsApp valid agar masyarakat bisa menghubungi.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Pastikan nomor WhatsApp yang dimasukkan valid dan aktif. Gunakan fitur "Toggle Status" untuk menyembunyikan kontak yang tidak aktif tanpa menghapus data.</span>
        </div>
    </div>

</div>

<script>
    // Auto close alert after 4 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert-premium').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateX(20px)';
            setTimeout(() => alert.remove(), 300);
        });
    }, 4000);

    // Tutorial Items Interactive
    document.querySelectorAll('.tutorial-item').forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => { this.style.transform = ''; }, 200);
        });
    });

    // Scroll animation for tutorial section
    const tutorialSection = document.querySelector('.tutorial-section');
    if (tutorialSection) {
        tutorialSection.style.opacity = '0';
        tutorialSection.style.transform = 'translateY(20px)';
        tutorialSection.style.transition = 'all 0.6s ease';
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, { threshold: 0.1 });
        
        observer.observe(tutorialSection);
    }
</script>
@endsection