{{-- resources/views/masyarakat/keuangan/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Transaksi - Keuangan Desa')

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

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--gray-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

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
        max-width: 900px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Back Button */
    .back-button {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        color: var(--gray);
        text-decoration: none;
        font-weight: 600;
        margin-bottom: 1.5rem;
        transition: var(--transition);
        background: white;
        padding: 0.5rem 1rem;
        border-radius: 40px;
        border: 1px solid var(--border);
    }

    .back-button:hover {
        color: var(--primary);
        transform: translateX(-4px);
        border-color: var(--primary);
    }

    /* Main Card */
    .main-card {
        background: var(--card);
        border-radius: 32px;
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        transition: var(--transition-bounce);
    }

    .main-card:hover {
        box-shadow: var(--shadow-xl);
    }

    /* Card Header */
    .card-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .card-header::before {
        content: '💰';
        position: absolute;
        bottom: -20px;
        right: -20px;
        font-size: 7rem;
        opacity: 0.1;
        pointer-events: none;
    }

    .card-header-content {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .card-header-icon {
        width: 56px;
        height: 56px;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(8px);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card-header-icon i {
        color: white;
        font-size: 1.8rem;
    }

    .card-header-text h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: white;
        margin-bottom: 0.2rem;
        letter-spacing: -0.02em;
    }

    .card-header-text p {
        color: rgba(255,255,255,0.85);
        font-size: 0.8rem;
    }

    /* Card Body */
    .card-body {
        padding: 2rem;
    }

    /* Detail Items */
    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem 0;
        border-bottom: 1px solid var(--border);
        transition: var(--transition);
    }

    .detail-item:hover {
        background: var(--primary-soft);
        transform: translateX(5px);
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-radius: 16px;
    }

    .detail-label {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .detail-label i {
        width: 32px;
        color: var(--primary);
        font-size: 1rem;
    }

    .detail-label span {
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--gray);
    }

    .detail-value {
        font-weight: 700;
        color: var(--dark);
        text-align: right;
    }

    .detail-value.amount-income {
        color: var(--primary);
        font-size: 1.3rem;
    }

    .detail-value.amount-expense {
        color: #ef4444;
        font-size: 1.3rem;
    }

    /* Status Badge */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 1rem;
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 700;
        background: #d1fae5;
        color: #059669;
    }

    /* Bukti Foto */
    .proof-section {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .proof-title {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1rem;
    }

    .proof-title i {
        color: var(--primary);
    }

    .proof-title span {
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--gray);
    }

    .proof-image {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-md);
        transition: var(--transition-bounce);
        cursor: pointer;
    }

    .proof-image:hover {
        transform: scale(1.02);
        box-shadow: var(--shadow-xl);
    }

    .proof-image img {
        width: 100%;
        max-height: 300px;
        object-fit: cover;
    }

    /* Tutorial Section */
    .tutorial-section {
        margin-top: 2rem;
        background: linear-gradient(135deg, var(--card), #ffffff);
        border-radius: 28px;
        padding: 1.5rem;
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
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i {
        font-size: 1.3rem;
        color: var(--primary);
    }

    .tutorial-header h3 {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        color: var(--dark);
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.8rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.6rem;
        padding: 0.6rem;
        border-radius: 16px;
        transition: var(--transition);
        cursor: pointer;
        background: var(--gray-soft);
    }

    .tutorial-item:hover {
        background: var(--primary-soft);
        transform: translateX(3px);
    }

    .tutorial-num {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.7rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .tutorial-item:hover .tutorial-num {
        transform: scale(1.1);
    }

    .tutorial-text h4 {
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 0.1rem;
        color: var(--dark);
    }

    .tutorial-text p {
        font-size: 0.65rem;
        color: var(--gray);
        line-height: 1.4;
    }

    .tutorial-footer {
        margin-top: 0.8rem;
        padding: 0.7rem 0.9rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        color: #059669;
    }

    /* Modal Image */
    .image-modal {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.9);
        z-index: 10000;
        display: none;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .image-modal img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
        border-radius: 20px;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .card-header { padding: 1.2rem 1.5rem; }
        .card-header-text h1 { font-size: 1.4rem; }
        .card-body { padding: 1.5rem; }
        .detail-item { flex-direction: column; align-items: flex-start; gap: 0.5rem; }
        .detail-value { text-align: left; }
        .detail-value.amount-income,
        .detail-value.amount-expense { font-size: 1.1rem; }
        .tutorial-grid { grid-template-columns: 1fr; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- Back Button --}}
    <a href="{{ route('masyarakat.keuangan.index', request()->query()) }}" class="back-button animate__animated animate__fadeIn">
        <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar Transaksi
    </a>

    {{-- Main Card --}}
    <div class="main-card animate__animated animate__fadeInUp">
        <div class="card-header">
            <div class="card-header-content">
                <div class="card-header-icon">
                    <i class="fa-solid fa-receipt"></i>
                </div>
                <div class="card-header-text">
                    <h1>Detail Transaksi</h1>
                    <p>Informasi lengkap transaksi keuangan desa</p>
                </div>
            </div>
        </div>

        <div class="card-body">
            {{-- Tanggal --}}
            <div class="detail-item">
                <div class="detail-label">
                    <i class="fa-regular fa-calendar"></i>
                    <span>Tanggal Transaksi</span>
                </div>
                <div class="detail-value">
                    {{ \Carbon\Carbon::parse($transaksi->tanggal)->translatedFormat('d F Y') }}
                </div>
            </div>

            {{-- Jenis Transaksi --}}
            <div class="detail-item">
                <div class="detail-label">
                    <i class="fa-solid fa-tag"></i>
                    <span>Jenis Transaksi</span>
                </div>
                <div class="detail-value">
                    <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $transaksi->jenis == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                        {{ $transaksi->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                    </span>
                </div>
            </div>

            {{-- Kategori --}}
            <div class="detail-item">
                <div class="detail-label">
                    <i class="fa-solid fa-folder"></i>
                    <span>Kategori</span>
                </div>
                <div class="detail-value">
                    {{ $transaksi->kategori->nama_kategori }}
                </div>
            </div>

            {{-- Deskripsi --}}
            <div class="detail-item">
                <div class="detail-label">
                    <i class="fa-regular fa-file-lines"></i>
                    <span>Deskripsi</span>
                </div>
                <div class="detail-value">
                    {{ $transaksi->deskripsi }}
                </div>
            </div>

            {{-- Jumlah --}}
            <div class="detail-item">
                <div class="detail-label">
                    <i class="fa-solid fa-money-bill-wave"></i>
                    <span>Jumlah</span>
                </div>
                <div class="detail-value {{ $transaksi->jenis == 'pemasukan' ? 'amount-income' : 'amount-expense' }}">
                    Rp {{ number_format($transaksi->jumlah, 0, ',', '.') }}
                </div>
            </div>

            {{-- Status --}}
            <div class="detail-item">
                <div class="detail-label">
                    <i class="fa-regular fa-circle-check"></i>
                    <span>Status</span>
                </div>
                <div class="detail-value">
                    <span class="status-badge">
                        <i class="fa-regular fa-circle-check"></i> Disetujui
                    </span>
                </div>
            </div>

            {{-- Bukti Transaksi --}}
            @if($transaksi->bukti_foto)
            <div class="proof-section">
                <div class="proof-title">
                    <i class="fa-solid fa-camera"></i>
                    <span>Bukti Transaksi</span>
                </div>
                <div class="proof-image" onclick="openImageModal('{{ asset('storage/' . $transaksi->bukti_foto) }}')">
                    <img src="{{ asset('storage/' . $transaksi->bukti_foto) }}" alt="Bukti Transaksi">
                </div>
                <p class="text-xs text-gray-400 mt-2 text-center">* Klik gambar untuk memperbesar</p>
            </div>
            @endif
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- TUTORIAL SECTION PREMIUM --}}
    {{-- ============================================== --}}
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Detail Transaksi</h3>
        </div>
        
        <p class="tutorial-intro" style="font-size: 0.8rem; color: var(--gray); margin-bottom: 1rem; line-height: 1.5;">
            Halaman <strong>Detail Transaksi</strong> menampilkan informasi lengkap tentang setiap transaksi 
            keuangan desa, termasuk tanggal, jenis, kategori, deskripsi, jumlah, dan bukti transaksi.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📋 Informasi Lengkap</h4>
                    <p>Lihat detail lengkap transaksi termasuk tanggal, jenis, kategori, dan deskripsi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>💰 Nominal Transaksi</h4>
                    <p>Pemasukan ditampilkan hijau, pengeluaran merah untuk mudah dibedakan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>✅ Status Transaksi</h4>
                    <p>Status transaksi selalu "Disetujui" karena data telah terverifikasi admin.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>🖼️ Bukti Transaksi</h4>
                    <p>Klik pada gambar bukti untuk memperbesar tampilan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>🔙 Navigasi Kembali</h4>
                    <p>Gunakan tombol kembali untuk ke halaman daftar transaksi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>🎨 Efek Hover</h4>
                    <p>Arahkan kursor ke item detail untuk efek highlight interaktif.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Data keuangan yang ditampilkan telah diverifikasi oleh admin desa. Klik pada gambar bukti transaksi untuk melihat lebih jelas.</span>
        </div>
    </div>

</div>

{{-- Modal untuk memperbesar gambar --}}
<div id="imageModal" class="image-modal" onclick="closeImageModal()">
    <img id="modalImage" src="" alt="Bukti Transaksi">
</div>

<script>
    // Image Modal Functions
    function openImageModal(imageSrc) {
        const modal = document.getElementById('imageModal');
        const modalImage = document.getElementById('modalImage');
        modal.style.display = 'flex';
        modalImage.src = imageSrc;
        document.body.style.overflow = 'hidden';
    }

    function closeImageModal() {
        const modal = document.getElementById('imageModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
    }

    // Close modal with ESC key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('imageModal');
            if (modal.style.display === 'flex') {
                closeImageModal();
            }
        }
    });

    // Tutorial Items Interactive
    document.addEventListener('DOMContentLoaded', function() {
        const tutorialItems = document.querySelectorAll('.tutorial-item');
        
        tutorialItems.forEach(item => {
            item.addEventListener('click', function() {
                // Add click feedback
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
                
                const title = this.querySelector('.tutorial-text h4').innerText;
                
                // Highlight related element based on tutorial
                if (title.includes('Informasi')) {
                    const detailItems = document.querySelectorAll('.detail-item');
                    detailItems.forEach(el => {
                        el.style.backgroundColor = 'rgba(16,185,129,0.05)';
                        setTimeout(() => {
                            el.style.backgroundColor = '';
                        }, 1500);
                    });
                } else if (title.includes('Nominal')) {
                    const amountElement = document.querySelector('.amount-income, .amount-expense');
                    if (amountElement) {
                        amountElement.style.transform = 'scale(1.05)';
                        setTimeout(() => {
                            amountElement.style.transform = '';
                        }, 500);
                    }
                } else if (title.includes('Status')) {
                    const statusElement = document.querySelector('.status-badge');
                    if (statusElement) {
                        statusElement.style.transform = 'scale(1.05)';
                        setTimeout(() => {
                            statusElement.style.transform = '';
                        }, 500);
                    }
                } else if (title.includes('Bukti')) {
                    const proofImage = document.querySelector('.proof-image');
                    if (proofImage) {
                        proofImage.style.transform = 'scale(1.02)';
                        proofImage.style.boxShadow = '0 0 0 3px rgba(16,185,129,0.3)';
                        setTimeout(() => {
                            proofImage.style.transform = '';
                            proofImage.style.boxShadow = '';
                        }, 1000);
                    }
                } else if (title.includes('Kembali')) {
                    const backButton = document.querySelector('.back-button');
                    if (backButton) {
                        backButton.style.transform = 'translateX(-4px)';
                        setTimeout(() => {
                            backButton.style.transform = '';
                        }, 300);
                    }
                }
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
    });
</script>
@endsection