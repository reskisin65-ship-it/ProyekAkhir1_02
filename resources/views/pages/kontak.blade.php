{{-- resources/views/pages/kontak.blade.php --}}
@extends('layouts.app')

@section('title', 'Kontak - Lumban Silintong')

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
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
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
        max-width: 1280px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Hero Section Premium */
    .hero-section {
        text-align: center;
        margin-bottom: 3rem;
        position: relative;
    }

    .hero-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.4rem 1.2rem;
        border-radius: 100px;
        margin-bottom: 1rem;
        backdrop-filter: blur(4px);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { box-shadow: 0 0 0 0 rgba(16,185,129,0.2); }
        50% { box-shadow: 0 0 0 8px rgba(16,185,129,0); }
    }

    .hero-badge i { font-size: 0.7rem; color: var(--primary); }
    .hero-badge span { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em; color: var(--primary-dark); text-transform: uppercase; }

    .hero-title {
        font-size: clamp(2rem, 5vw, 3.2rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
        background: linear-gradient(135deg, var(--dark) 0%, var(--dark) 40%, var(--primary) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-title span {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-subtitle {
        font-size: 0.9rem;
        color: var(--gray);
        margin-top: 0.75rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .hero-divider {
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), transparent);
        margin: 1.2rem auto 0;
    }

    /* Section Title */
    .section-title {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        letter-spacing: -0.02em;
        position: relative;
        display: inline-block;
    }

    .section-title i {
        color: var(--primary);
        margin-right: 0.5rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: -8px;
        left: 0;
        width: 50%;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), transparent);
        border-radius: 10px;
    }

    /* Contact Card Premium */
    .contact-card {
        background: white;
        border-radius: 28px;
        border: 1px solid var(--border);
        transition: var(--transition-bounce);
        overflow: hidden;
        position: relative;
    }

    .contact-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s ease;
        pointer-events: none;
        z-index: 1;
    }

    .contact-card:hover::before {
        left: 100%;
    }

    .contact-card:hover {
        transform: translateY(-8px);
        border-color: var(--primary);
        box-shadow: var(--shadow-xl);
    }

    .contact-header {
        padding: 1.2rem 1.2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        border-bottom: 1px solid var(--border);
        background: linear-gradient(135deg, rgba(16,185,129,0.02), transparent);
    }

    .contact-avatar {
        width: 56px;
        height: 56px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
    }

    .contact-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .contact-card:hover .contact-avatar img {
        transform: scale(1.1);
    }

    .contact-avatar i {
        font-size: 1.8rem;
    }

    .contact-info h4 {
        font-weight: 800;
        font-size: 1rem;
        color: var(--dark);
        margin-bottom: 0.2rem;
    }

    .contact-info p {
        font-size: 0.7rem;
        color: var(--gray);
    }

    .contact-body {
        padding: 1rem 1.2rem;
    }

    .contact-detail {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 0.8rem;
        font-size: 0.75rem;
        color: var(--gray);
        transition: var(--transition);
    }

    .contact-detail:hover {
        transform: translateX(3px);
        color: var(--primary);
    }

    .contact-detail i {
        width: 20px;
        color: var(--primary);
    }

    .whatsapp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        width: 100%;
        padding: 0.75rem;
        background: linear-gradient(135deg, #25D366, #128C7E);
        border-radius: 40px;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: white;
        transition: var(--transition-bounce);
        text-decoration: none;
        margin-top: 0.8rem;
        position: relative;
        overflow: hidden;
    }

    .whatsapp-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: rgba(255,255,255,0.2);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .whatsapp-btn:hover::before {
        width: 200%;
        height: 200%;
    }

    .whatsapp-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.35);
    }

    /* Info Card Premium */
    .info-card {
        background: white;
        border-radius: 24px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        transition: var(--transition-bounce);
        height: 100%;
    }

    .info-card:hover {
        transform: translateY(-6px);
        border-color: var(--primary);
        box-shadow: var(--shadow-lg);
    }

    .info-icon {
        width: 52px;
        height: 52px;
        background: var(--primary-soft);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        transition: var(--transition-bounce);
    }

    .info-card:hover .info-icon {
        transform: scale(1.05);
        background: var(--primary);
    }

    .info-card:hover .info-icon i {
        color: white;
    }

    .info-icon i {
        font-size: 1.4rem;
        color: var(--primary);
        transition: var(--transition);
    }

    /* Social Media Buttons */
    .social-btn {
        transition: var(--transition-bounce);
    }

    .social-btn:hover {
        transform: translateY(-5px) scale(1.08);
        filter: brightness(1.05);
    }

    /* Map Card */
    .map-card {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid var(--border);
        transition: var(--transition-bounce);
    }

    .map-card:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-xl);
    }

    /* Tutorial Section Premium */
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
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
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
        grid-template-columns: repeat(3, 1fr);
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
        animation: pulse-icon 1.5s infinite;
    }

    @keyframes pulse-icon {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.2); }
    }

    .tutorial-footer span {
        font-size: 0.75rem;
        color: #059669;
        line-height: 1.4;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .tutorial-section { padding: 1rem; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .hero-title { font-size: 1.8rem; }
        .grid.md\:grid-cols-2 { grid-template-columns: 1fr; }
        .grid.md\:grid-cols-2.lg\:grid-cols-3 { grid-template-columns: 1fr; }
        .contact-header { flex-direction: column; text-align: center; }
        .contact-detail { justify-content: center; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- HERO SECTION --}}
    <div class="hero-section animate__animated animate__fadeInUp">
        <div class="hero-badge">
            <i class="fa-regular fa-comment-dots"></i>
            <span>Hubungi Kami</span>
        </div>
        <h1 class="hero-title">
            Kontak <span>Kami</span>
        </h1>
        <p class="hero-subtitle">
            Silakan hubungi perangkat desa sesuai dengan bidang dan kebutuhan Anda
        </p>
        <div class="hero-divider"></div>
    </div>

    {{-- DAFTAR KONTAK DARI DATABASE --}}
    <div class="animate__animated animate__fadeInUp" style="animation-delay: 0.05s">
        <h2 class="section-title">
            <i class="fa-solid fa-users"></i> Perangkat Desa
        </h2>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($kontak as $item)
            <div class="contact-card">
                <div class="contact-header">
                    <div class="contact-avatar" style="background: linear-gradient(135deg, {{ $item->warna ?? '#10b981' }}, {{ $item->warna ?? '#059669' }});">
                        @if($item->foto)
                            <img src="{{ asset('storage/'.$item->foto) }}" alt="{{ $item->nama }}">
                        @else
                            <i class="fa-solid fa-user-tie text-white"></i>
                        @endif
                    </div>
                    <div class="contact-info">
                        <h4>{{ $item->jabatan }}</h4>
                        <p>{{ $item->bidang ?? 'Perangkat Desa' }}</p>
                    </div>
                </div>
                <div class="contact-body">
                    <div class="contact-detail">
                        <i class="fa-solid fa-user"></i>
                        <span>{{ $item->nama }}</span>
                    </div>
                    <div class="contact-detail">
                        <i class="fa-solid fa-phone"></i>
                        <span>{{ $item->no_hp }}</span>
                    </div>
                    @if($item->email)
                    <div class="contact-detail">
                        <i class="fa-regular fa-envelope"></i>
                        <span>{{ $item->email }}</span>
                    </div>
                    @endif
                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item->no_hp) }}?text=Halo%20{{ urlencode($item->jabatan) }}%2C%20saya%20ingin%20bertanya..." 
                       target="_blank" class="whatsapp-btn">
                        <i class="fa-brands fa-whatsapp"></i> Chat via WhatsApp
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-regular fa-address-book text-4xl text-gray-400"></i>
                </div>
                <p class="text-gray-400">Belum ada data kontak. Silakan hubungi admin desa.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- INFORMASI KANTOR --}}
    <div class="grid md:grid-cols-2 gap-6 my-10 animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="info-card">
            <div class="info-icon">
                <i class="fa-solid fa-location-dot"></i>
            </div>
            <h3 class="font-bold text-gray-800 mb-2">Alamat Kantor Desa</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                Kantor Kepala Desa Lumban Silintong<br>
                Jl. Danau Toba No. 1, Kec. Balige<br>
                Kabupaten Toba, Sumatera Utara<br>
                Kode Pos: 22312
            </p>
        </div>

        <div class="info-card">
            <div class="info-icon">
                <i class="fa-regular fa-clock"></i>
            </div>
            <h3 class="font-bold text-gray-800 mb-2">Jam Operasional</h3>
            <p class="text-gray-500 text-sm leading-relaxed">
                <strong>Senin - Kamis:</strong> 08:00 - 15:00 WIB<br>
                <strong>Jumat:</strong> 08:00 - 14:00 WIB<br>
                <strong>Sabtu:</strong> 08:00 - 12:00 WIB<br>
                <strong>Minggu & Hari Libur:</strong> Tutup
            </p>
        </div>
    </div>

    {{-- SOSIAL MEDIA --}}
    <div class="grid md:grid-cols-2 gap-6 mb-10 animate__animated animate__fadeInUp" style="animation-delay: 0.15s">
        <div class="info-card">
            <div class="info-icon">
                <i class="fa-solid fa-share-alt"></i>
            </div>
            <h3 class="font-bold text-gray-800 mb-3">Ikuti Kami di Sosial Media</h3>
            <div class="flex gap-3 flex-wrap">
                <a href="#" class="social-btn w-10 h-10 bg-[#1877f2] rounded-xl flex items-center justify-center text-white hover:scale-110 transition"><i class="fa-brands fa-facebook-f"></i></a>
                <a href="#" class="social-btn w-10 h-10 bg-[#1da1f2] rounded-xl flex items-center justify-center text-white hover:scale-110 transition"><i class="fa-brands fa-twitter"></i></a>
                <a href="#" class="social-btn w-10 h-10 bg-[#e4405f] rounded-xl flex items-center justify-center text-white hover:scale-110 transition"><i class="fa-brands fa-instagram"></i></a>
                <a href="#" class="social-btn w-10 h-10 bg-[#25d366] rounded-xl flex items-center justify-center text-white hover:scale-110 transition"><i class="fa-brands fa-whatsapp"></i></a>
                <a href="#" class="social-btn w-10 h-10 bg-[#ff0000] rounded-xl flex items-center justify-center text-white hover:scale-110 transition"><i class="fa-brands fa-youtube"></i></a>
            </div>
        </div>

        <div class="info-card">
            <div class="info-icon">
                <i class="fa-regular fa-envelope"></i>
            </div>
            <h3 class="font-bold text-gray-800 mb-2">Email Resmi Desa</h3>
            <p class="text-gray-500 text-sm">
                halo@lumbansilintong.id<br>
                info@lumbansilintong.id<br>
                pengaduan@lumbansilintong.id
            </p>
        </div>
    </div>

    {{-- PETA LOKASI --}}
    <div class="map-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
        <div class="bg-gradient-to-r from-emerald-50 to-white px-6 py-4 border-b border-gray-100">
            <h2 class="text-xl font-bold text-emerald-800 flex items-center gap-2">
                <i class="fa-solid fa-map text-emerald-500"></i> Peta Lokasi
            </h2>
        </div>
        <div class="h-96">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.668102377317!2d99.0435942!3d2.332309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04306443c683%3A0x868a8600868a86!2sLumban%20Silintong!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <div class="p-4 text-center bg-gray-50">
            <p class="text-gray-500 text-sm">
                <i class="fa-solid fa-location-dot text-emerald-500 mr-1"></i> 
                Kantor Kepala Desa Lumban Silintong, Kecamatan Balige, Kabupaten Toba
            </p>
        </div>
    </div>

    {{-- TUTORIAL SECTION --}}
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.25s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Kontak</h3>
        </div>
        
        <p class="tutorial-intro">
            Halaman <strong>Kontak</strong> menyediakan informasi lengkap untuk menghubungi perangkat 
            Desa Lumban Silintong sesuai dengan bidang dan kebutuhannya.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>👥 Perangkat Desa</h4>
                    <p>Daftar lengkap perangkat desa beserta jabatan dan kontak WhatsApp.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>💬 Chat WhatsApp</h4>
                    <p>Klik tombol "Chat via WhatsApp" untuk terhubung langsung.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>📍 Alamat Kantor</h4>
                    <p>Informasi alamat lengkap kantor kepala desa.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>🕰️ Jam Operasional</h4>
                    <p>Waktu pelayanan kantor desa untuk keperluan administrasi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>🗺️ Peta Lokasi</h4>
                    <p>Gunakan peta untuk mengetahui lokasi persis kantor desa.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>💡 Tips Komunikasi</h4>
                    <p>Sebutkan nama dan keperluan dengan jelas saat menghubungi.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Saat menghubungi perangkat desa melalui WhatsApp, sebutkan nama lengkap, alamat, dan keperluan Anda dengan jelas. Hormati waktu istirahat dan jam operasional.</span>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tutorial Items Interactive
        const tutorialItems = document.querySelectorAll('.tutorial-item');
        
        tutorialItems.forEach(item => {
            item.addEventListener('click', function() {
                this.style.transform = 'scale(0.98)';
                setTimeout(() => { this.style.transform = ''; }, 200);
                
                const title = this.querySelector('.tutorial-text h4').innerText;
                
                if (title.includes('Perangkat')) {
                    document.querySelector('.contact-card')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else if (title.includes('Peta')) {
                    document.querySelector('.map-card')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                } else if (title.includes('Alamat')) {
                    document.querySelector('.info-card')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
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