{{-- resources/views/pages/profil-desa.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Desa Lumban Silintong')

@section('content')
<!-- Google Fonts & Libraries -->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,500;0,600;1,400&family=Plus+Jakarta+Sans:wght@200;300;400;600;700&family=Space+Grotesk:wght@300;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<style>
    :root {
        --primary-dark: #0a1f18;
        --accent-emerald: #10b981;
        --soft-bg: #fcfdfc;
        --gold-muted: #c5a358;
    }

    body { 
        font-family: 'Plus Jakarta Sans', sans-serif; 
        background-color: var(--soft-bg); 
        color: var(--primary-dark);
        overflow-x: hidden;
    }

    .font-serif { font-family: 'Cormorant Garamond', serif; }
    .font-space { font-family: 'Space Grotesk', sans-serif; }

    /* Cegah teks meluap dari card */
    .bg-white p, .glass-card p {
        overflow-wrap: break-word;
        word-break: break-word;
        overflow: hidden;
    }

    /* --- Luxury Elements --- */
    .glass-card {
        background: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.5);
    }

    .text-reveal {
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0% 100%);
    }

    .image-parallax {
        transition: transform 0.8s cubic-bezier(0.165, 0.84, 0.44, 1);
        scale: 1.1;
    }

    /* Gradient Text */
    .text-gradient {
        background: linear-gradient(135deg, #062c1f 0%, #10b981 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Scroll Progress Line */
    .scroll-line {
        position: fixed;
        top: 0; left: 0;
        height: 3px;
        background: var(--accent-emerald);
        z-index: 10000;
        width: 0%;
    }

    /* ============================================
       WHATSAPP CARD - ELEGANT & COMPACT
    ============================================ */
    .stat-wa-card {
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
        position: relative;
        border: 1px solid rgba(16, 185, 129, 0.1);
        background: linear-gradient(135deg, #ffffff, #fafffe);
    }

    .stat-wa-card:hover {
        border-color: #25D366;
        box-shadow: 0 12px 30px rgba(37, 211, 102, 0.15) !important;
        transform: translateY(-6px);
    }

    .stat-wa-card .wa-icon {
        transition: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    .stat-wa-card:hover .wa-icon {
        background: #25D366 !important;
        transform: scale(1.08) rotate(-3deg);
        box-shadow: 0 8px 20px rgba(37, 211, 102, 0.3);
    }

    .stat-wa-card:hover .wa-icon i {
        color: white !important;
    }

    .stat-wa-card:hover .wa-number {
        color: #25D366 !important;
    }

    .stat-wa-card .wa-hint {
        opacity: 0;
        transform: translateY(5px) scale(0.9);
        transition: all 0.3s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    .stat-wa-card:hover .wa-hint {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

    /* Pulse Animation untuk Icon WA */
    @keyframes waPulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .wa-pulse {
        animation: waPulse 2s ease-in-out infinite;
    }

    /* ============================================
       TUTORIAL SECTION
    ============================================ */
    .tutorial-section {
        margin-top: 2rem;
        background: white;
        border-radius: 28px;
        padding: 2rem;
        border: 1px solid #eef2f6;
        transition: all 0.3s ease;
    }
    .tutorial-section:hover {
        border-color: #10b981;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
    }
    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.2rem;
        border-bottom: 1px solid #eef2f6;
        padding-bottom: 0.8rem;
    }
    .tutorial-header i { font-size: 1.5rem; color: #10b981; }
    .tutorial-header h3 { font-size: 1rem; font-weight: 700; margin: 0; color: #0f172a; }
    .tutorial-intro { font-size: 0.85rem; color: #64748b; margin-bottom: 1.5rem; line-height: 1.6; }
    .tutorial-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.2rem; }
    .tutorial-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.8rem;
        border-radius: 16px;
        transition: all 0.3s ease;
        cursor: pointer;
        background: #f8fafc;
    }
    .tutorial-item:hover {
        background: rgba(16, 185, 129, 0.08);
        transform: translateX(5px);
    }
    .tutorial-num {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, #10b981, #059669);
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
    .tutorial-item:hover .tutorial-num { transform: scale(1.1); }
    .tutorial-text h4 { font-size: 0.85rem; font-weight: 700; margin-bottom: 0.25rem; color: #0f172a; }
    .tutorial-text p { font-size: 0.7rem; color: #64748b; line-height: 1.4; }
    .tutorial-footer {
        margin-top: 1rem;
        padding: 0.8rem 1rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
        transition: all 0.3s ease;
    }
    .tutorial-footer:hover { transform: translateY(-2px); box-shadow: 0 4px 12px rgba(16,185,129,0.15); }
    .tutorial-footer i { color: #10b981; font-size: 1rem; }
    .tutorial-footer span { font-size: 0.75rem; color: #059669; line-height: 1.4; }

    /* WA Footer Button */
    .wa-footer-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.8rem 1.8rem;
        background: #25D366;
        color: white;
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(37, 211, 102, 0.3);
    }

    .wa-footer-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 30px rgba(37, 211, 102, 0.4);
        color: white;
    }

    .wa-footer-btn i {
        font-size: 1.4rem;
    }

    /* ============================================
       APARATUR MODAL
    ============================================ */
    .org-section { position: relative; }

    .org-row {
        display: flex;
        justify-content: center;
        align-items: flex-start;
        gap: 2rem;
        flex-wrap: wrap;
        margin-bottom: 2.5rem;
        position: relative;
    }

    .org-row:not(:last-child)::after {
        content: '';
        position: absolute;
        bottom: -2.5rem;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 2.5rem;
        background: linear-gradient(to bottom, #10b981, #d1fae5);
    }

    .org-row.multi-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 50%;
        transform: translate(-50%, -2.5rem);
        width: 2px;
        height: 2.5rem;
        background: linear-gradient(to bottom, #d1fae5, #10b981);
    }

    .aparatur-item {
        position: relative;
        transition: all 0.4s ease;
        width: 180px;
        flex-shrink: 0;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .aparatur-item { width: 140px; }
        .org-row { gap: 1rem; }
    }
    @media (max-width: 480px) {
        .aparatur-item { width: 120px; }
        .org-row { gap: 0.75rem; }
    }

    .aparatur-image-container {
        position: relative;
        aspect-ratio: 4 / 5;
        border-radius: 20px;
        overflow: hidden;
        background: #f1f5f9;
        box-shadow: 0 4px 16px rgba(0,0,0,0.08);
        transition: all 0.4s ease;
    }

    .aparatur-item:hover .aparatur-image-container {
        box-shadow: 0 8px 28px rgba(16,185,129,0.25);
        transform: translateY(-6px);
    }

    .aparatur-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .aparatur-item:hover img { transform: scale(1.06); }

    .aparatur-overlay {
        position: absolute;
        inset: 0;
        background: rgba(6, 44, 31, 0.82);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease;
        padding: 12px;
        text-align: center;
    }

    .aparatur-item:hover .aparatur-overlay { opacity: 1; }
    .hover-content { transform: translateY(8px); transition: transform 0.3s ease; }
    .aparatur-item:hover .hover-content { transform: translateY(0); }

    .bottom-info { padding-top: 0.9rem; text-align: center; }

    .pos-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 22px;
        height: 22px;
        background: #10b981;
        color: white;
        border-radius: 50%;
        font-size: 0.6rem;
        font-weight: 800;
        position: absolute;
        top: 8px;
        right: 8px;
        z-index: 10;
        box-shadow: 0 2px 6px rgba(16,185,129,0.4);
    }

    .aparatur-modal-backdrop {
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.65);
        backdrop-filter: blur(6px);
        z-index: 9000;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 1rem;
        opacity: 0;
        visibility: hidden;
        transition: all 0.3s ease;
    }

    .aparatur-modal-backdrop.active {
        opacity: 1;
        visibility: visible;
    }

    .aparatur-modal {
        background: white;
        border-radius: 32px;
        overflow: hidden;
        max-width: 520px;
        width: 100%;
        box-shadow: 0 32px 80px rgba(0,0,0,0.25);
        transform: scale(0.88) translateY(20px);
        transition: transform 0.35s cubic-bezier(0.34, 1.3, 0.64, 1);
        position: relative;
    }

    .aparatur-modal-backdrop.active .aparatur-modal {
        transform: scale(1) translateY(0);
    }

    .modal-close {
        position: absolute;
        top: 14px;
        right: 14px;
        width: 36px;
        height: 36px;
        background: rgba(255,255,255,0.9);
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        color: #374151;
        z-index: 10;
        transition: all 0.2s;
        box-shadow: 0 2px 8px rgba(0,0,0,0.15);
    }

    .modal-close:hover {
        background: #ef4444;
        color: white;
        transform: scale(1.1);
    }

    .modal-img-wrap {
        position: relative;
        aspect-ratio: 4/3;
        overflow: hidden;
        background: #f1f5f9;
    }

    .modal-img-wrap img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top;
    }

    .modal-img-gradient {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 50%;
        background: linear-gradient(to top, rgba(6,44,31,0.7), transparent);
    }

    .modal-img-name {
        position: absolute;
        bottom: 20px;
        left: 24px;
        right: 60px;
    }

    .modal-body {
        padding: 1.5rem 1.75rem 2rem;
    }

    .modal-jabatan-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        background: #ecfdf5;
        color: #059669;
        border-radius: 100px;
        padding: 0.3rem 1rem;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.06em;
        margin-bottom: 1rem;
    }

    .modal-detail-row {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 0.7rem 0;
        border-bottom: 1px solid #f1f5f9;
    }

    .modal-detail-row:last-child { border-bottom: none; }

    .modal-detail-icon {
        width: 32px;
        height: 32px;
        background: #f0fdf4;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: #10b981;
        font-size: 0.75rem;
    }

    .modal-detail-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94a3b8;
        margin-bottom: 0.15rem;
    }

    .modal-detail-value {
        font-size: 0.85rem;
        font-weight: 600;
        color: #0f172a;
        line-height: 1.5;
    }

    .modal-posisi-chip {
        display: inline-flex;
        align-items: center;
        gap: 0.3rem;
        background: #10b981;
        color: white;
        border-radius: 100px;
        padding: 0.2rem 0.75rem;
        font-size: 0.7rem;
        font-weight: 700;
        margin-bottom: 1rem;
        margin-left: 0.4rem;
    }

    /* ============================================
       RESPONSIVE
    ============================================ */
    @media (max-width: 1024px) { 
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); } 
    }
    @media (max-width: 768px) {
        .tutorial-section { padding: 1rem; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .wa-footer-btn { font-size: 0.75rem; padding: 0.6rem 1.2rem; }
        .stat-wa-card { padding: 1rem !important; }
        .stat-wa-card .wa-number { font-size: 0.9rem !important; }
        .stat-wa-card .wa-icon { width: 2.5rem !important; height: 2.5rem !important; }
        .stat-wa-card .wa-icon i { font-size: 1.1rem !important; }
    }
</style>

<div class="scroll-line"></div>

{{-- 1. HERO SECTION --}}
<section class="min-h-screen flex items-center relative px-6 py-20">
    <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
        <div class="absolute top-[10%] right-[5%] w-96 h-96 bg-emerald-300 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[10%] left-[5%] w-80 h-80 bg-gold-muted rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-7xl mx-auto w-full grid lg:grid-cols-12 gap-12">
        <div class="lg:col-span-8">
            <div class="inline-flex items-center gap-3 px-4 py-2 rounded-full border border-emerald-100">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-ping"></span>
                <span class="text-[10px] font-bold uppercase tracking-[0.2em] text-emerald-700">Profil</span>
            </div>
            
            <h1 class="text-[clamp(3.5rem,8vw,7.5rem)] font-serif leading-[0.85] mb-10 text-reveal" data-aos="fade-up" data-aos-delay="200">
                Profil <br>
                <span class="italic font-light">Desa</span> <br>
                <span class="text-gradient">Lumban Silintong.</span>
            </h1>

            <div class="max-w-xl" data-aos="fade-up" data-aos-delay="400">
                <p class="text-lg text-gray-500 font-light leading-relaxed mb-8">
                    Simfoni harmoni antara kemegahan tebing vulkanik, jernihnya Danau Toba, 
                    dan luhurnya tradisi Batak yang terjaga dalam modernitas.
                </p>
            </div>
        </div>
        
        <div class="lg:col-span-4 hidden lg:block" data-aos="zoom-out" data-aos-delay="600">
            <div class="relative">
                <div class="aspect-[3/4] rounded-[60px] overflow-hidden rotate-3 hover:rotate-0 transition-transform duration-700 shadow-2xl">
                    <img src="{{ asset('images/profil/1.jpeg') }}" class="w-full h-full object-cover">
                </div>
                <div class="absolute -bottom-10 -left-10 glass-card p-8 rounded-3xl shadow-xl border border-white/50" data-aos="fade-up" data-aos-delay="800">
                    <p class="font-serif text-3xl italic">"Mansai Uli"</p>
                    <p class="text-[10px] uppercase tracking-widest text-emerald-600 font-bold">Keindahan yang natural, budaya yang abadi.</p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- 2. STATISTIK DESA - 5 CARD --}}
<section id="explore" class="py-24 px-6 max-w-7xl mx-auto">
    <div class="text-center mb-12">
        <span class="text-emerald-600 font-space text-xs font-bold uppercase tracking-[0.4em] mb-2 inline-block">Data Desa</span>
        <h2 class="text-4xl md:text-5xl font-serif">Statistik <span class="italic text-emerald-600">Desa</span></h2>
        <p class="text-gray-500 mt-2 max-w-2xl mx-auto">Informasi terkini tentang kondisi demografi Desa Lumban Silintong</p>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <!-- Card 1: Tahun Berdiri -->
        <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up">
            <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-calendar-alt text-emerald-600 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-emerald-700">{{ $stat_tahun_berdiri ?? '1920' }}</p>
            <p class="text-sm text-gray-500 mt-1">Tahun Berdiri</p>
        </div>
        
        <!-- Card 2: Total Penduduk -->
        <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-users text-blue-600 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-blue-700">{{ number_format($stat_penduduk ?? 1240) }}</p>
            <p class="text-sm text-gray-500 mt-1">Total Penduduk</p>
        </div>
        
        <!-- Card 3: Kepala Keluarga -->
        <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
            <div class="w-16 h-16 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-house-user text-amber-600 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-amber-700">{{ number_format($stat_kk ?? 0) }}</p>
            <p class="text-sm text-gray-500 mt-1">Kepala Keluarga</p>
        </div>
        
        <!-- Card 4: Luas Wilayah -->
        <div class="bg-white rounded-2xl p-6 text-center shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
            <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-map text-purple-600 text-2xl"></i>
            </div>
            <p class="text-3xl font-bold text-purple-700">{{ $stat_luas ?? '12.5' }} km²</p>
            <p class="text-sm text-gray-500 mt-1">Luas Wilayah</p>
        </div>

        <!-- Card 5: WhatsApp - ELEGANT & COMPACT -->
        <div class="stat-wa-card bg-white rounded-2xl p-4 text-center shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 relative overflow-hidden"
             data-aos="fade-up" data-aos-delay="400"
             onclick="window.open('https://wa.me/{{ $profil->telepon_desa ? preg_replace('/[^0-9]/', '', $profil->telepon_desa) : '62' }}', '_blank')">
            
            <!-- Background Decoration -->
            <div class="absolute -top-10 -right-10 w-28 h-28 bg-green-100 rounded-full opacity-20"></div>
            <div class="absolute -bottom-10 -left-10 w-20 h-20 bg-green-50 rounded-full opacity-15"></div>
            
            <!-- Icon dengan ukuran lebih kecil -->
            <div class="wa-icon w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-2 transition-all duration-300 relative z-10">
                <i class="fa-brands fa-whatsapp text-green-600 text-xl transition-all duration-300"></i>
            </div>
            
            <!-- Nomor dengan ukuran lebih kecil dan format rapi -->
            <p class="wa-number text-base font-bold text-green-700 transition-all duration-300 relative z-10">
                @if($profil->telepon_desa)
                    {{ substr($profil->telepon_desa, 0, 4) }} {{ substr($profil->telepon_desa, 4) }}
                @else
                    Belum Diisi
                @endif
            </p>
            
            <!-- Label dengan ikon -->
            <p class="text-[10px] text-gray-400 mt-0.5 relative z-10 flex items-center justify-center gap-1">
                <i class="fa-regular fa-comment-dots text-green-500 text-[8px]"></i> 
                Hubungi via WhatsApp
            </p>
            
            <!-- Badge Chat -->
            @if($profil->telepon_desa)
            <div class="wa-hint mt-1.5 relative z-10">
                <span class="text-[9px] bg-green-500 text-white px-2.5 py-0.5 rounded-full inline-flex items-center gap-1 shadow-lg shadow-green-200">
                    <i class="fa-solid fa-arrow-right text-[7px]"></i> Klik untuk Chat
                </span>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- 3. SEJARAH DESA --}}
<section class="py-24 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex flex-col items-center mb-16 text-center">
            <span class="text-gold-muted font-space text-xs font-bold uppercase tracking-[0.4em] mb-4" data-aos="fade-up">LUMBAN SILINTONG</span>
            <h2 class="text-4xl md:text-5xl font-serif" data-aos="fade-up" data-aos-delay="100">Sejarah <span class="italic text-emerald-600">Desa</span></h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative" data-aos="fade-right">
                <div class="rounded-3xl overflow-hidden shadow-2xl">
                    <img src="{{ asset('images/profil/2.jpeg') }}" class="image-parallax w-full h-[450px] object-cover">
                </div>
                <div class="absolute -right-12 top-1/2 -translate-y-1/2 hidden xl:block">
                    <p class="text-[10rem] font-serif text-gray-50 opacity-10 select-none">{{ $stat_tahun_berdiri ?? '1920' }}</p>
                </div>
            </div>

            <div data-aos="fade-left">
                @if(isset($profil) && $profil && $profil->sejarah)
                    <p class="text-gray-600 leading-relaxed text-base break-words overflow-hidden">{{ $profil->sejarah }}</p>
                @else
                    <p class="text-gray-600 leading-relaxed text-base first-letter:text-6xl first-letter:font-serif first-letter:mr-3 first-letter:float-left first-letter:text-emerald-700">
                        Lumban Silintong berdiri sebagai gerbang budaya di pesisir Danau Toba. Nama yang diambil dari kedalaman makna spiritual, mencerminkan kejernihan hati penduduknya seperti air danau yang menghidupi mereka.
                    </p>
                    <p class="text-gray-600 leading-relaxed text-base mt-4">
                        Sejak masa kolonial hingga era transformasi digital, desa ini konsisten menjaga keseimbangan antara pembangunan infrastruktur dengan pelestarian situs-situs sejarah marga yang sakral.
                    </p>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- 4. VISI & MISI --}}
<section class="py-24 px-6 bg-emerald-50/30">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <span class="text-emerald-600 font-space text-xs font-bold uppercase tracking-[0.4em] mb-2 inline-block">Vision & Mission</span>
            <h2 class="text-4xl md:text-5xl font-serif">Visi & <span class="italic text-emerald-600">Misi</span></h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-10">
            @if(isset($profil) && $profil && $profil->visi)
            <div class="bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col" data-aos="fade-right">
                <div class="w-20 h-20 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 flex-shrink-0">
                    <i class="fa-solid fa-eye text-emerald-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-serif mb-4 text-emerald-800 flex-shrink-0">Visi</h3>
                <p class="text-gray-600 leading-relaxed text-base italic break-words overflow-hidden">"{{ $profil->visi }}"</p>
            </div>
            @endif

            @if(isset($profil) && $profil && $profil->misi)
            <div class="bg-white rounded-3xl p-10 shadow-xl hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 flex flex-col" data-aos="fade-left">
                <div class="w-20 h-20 bg-emerald-100 rounded-2xl flex items-center justify-center mb-6 flex-shrink-0">
                    <i class="fa-solid fa-flag-checkered text-emerald-600 text-2xl"></i>
                </div>
                <h3 class="text-3xl font-serif mb-4 text-emerald-800 flex-shrink-0">Misi</h3>
                <p class="text-gray-600 leading-relaxed text-base break-words overflow-hidden">{{ $profil->misi }}</p>
            </div>
            @endif
        </div>
    </div>
</section>

{{-- 5. APARATUR DESA --}}
<section class="py-24 px-6 bg-white">
    <div class="max-w-5xl mx-auto">
        <div class="mb-16 border-l-4 border-emerald-500 pl-6">
            <h2 class="text-4xl font-serif text-gray-900 leading-none">Aparatur <span class="italic text-gray-500">Desa</span></h2>
            <p class="text-gray-400 text-sm mt-2 font-light tracking-wide uppercase">Pemerintah Lumban Silintong</p>
        </div>

        @if(isset($aparaturs) && $aparaturs->count() > 0)
        @php
            $grouped = $aparaturs->groupBy('urutan_dalam_kategori')->sortKeys();
        @endphp

        <div class="org-section">
            @foreach($grouped as $posisi => $anggota)
            @php $isFirst = $loop->first; $isMulti = $anggota->count() > 1; @endphp
            <div class="org-row {{ $isMulti ? 'multi-item' : '' }} {{ !$isFirst ? 'has-parent' : '' }}"
                 data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                @foreach($anggota as $a)
                @php
                    $fotoUrl = $a->foto
                        ? asset('storage/'.$a->foto)
                        : 'https://ui-avatars.com/api/?name='.urlencode($a->nama_pengurus).'&background=10b981&color=fff&size=400';
                @endphp
                <div class="aparatur-item group"
                     onclick="openAparaturModal({
                         foto: '{{ $fotoUrl }}',
                         nama: '{{ addslashes($a->nama_pengurus) }}',
                         kategori: '{{ addslashes($a->nama_kategori) }}',
                         icon: '{{ $a->icon_kategori }}',
                         nip: '{{ addslashes($a->nip ?? '') }}',
                         tugas: '{{ addslashes($a->tugas ?? '') }}',
                         posisi: {{ $posisi }}
                     })">

                    <div class="pos-badge">{{ $posisi }}</div>

                    <div class="aparatur-image-container">
                        <img src="{{ $fotoUrl }}" alt="{{ $a->nama_pengurus }}">
                        <div class="aparatur-overlay">
                            <div class="hover-content">
                                <i class="fa-solid fa-expand text-white/80 text-xl mb-2"></i>
                                <p class="text-white text-xs font-semibold">Klik untuk detail</p>
                            </div>
                        </div>
                    </div>

                    <div class="bottom-info">
                        <p class="text-gray-900 font-bold text-sm leading-tight mb-0.5">{{ $a->nama_pengurus }}</p>
                        <p class="text-emerald-600 text-[10px] font-semibold uppercase tracking-wider">{{ $a->nama_kategori }}</p>
                    </div>
                </div>
                @endforeach
            </div>
            @endforeach
        </div>

        @else
        <div class="py-10 text-center text-gray-300 italic border-2 border-dashed border-gray-100 rounded-3xl">
            Data aparatur belum tersedia.
        </div>
        @endif
    </div>
</section>

{{-- MODAL APARATUR --}}
<div class="aparatur-modal-backdrop" id="aparaturModal" onclick="closeAparaturModal(event)">
    <div class="aparatur-modal" id="aparaturModalContent">
        <button class="modal-close" onclick="closeAparaturModalDirect()">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="modal-img-wrap">
            <img id="modalFoto" src="" alt="">
            <div class="modal-img-gradient"></div>
            <div class="modal-img-name">
                <p id="modalNama" class="text-white font-bold text-xl leading-tight"></p>
                <p id="modalKategoriImg" class="text-emerald-300 text-xs font-bold uppercase tracking-widest mt-1"></p>
            </div>
        </div>

        <div class="modal-body">
            <div style="display:flex; align-items:center; flex-wrap:wrap; gap:0.3rem; margin-bottom:1.2rem;">
                <span class="modal-jabatan-badge">
                    <i id="modalIcon" class="fa-solid fa-user"></i>
                    <span id="modalKategori"></span>
                </span>
                <span class="modal-posisi-chip">
                    <i class="fa-solid fa-sort-numeric-up"></i>
                    Posisi <span id="modalPosisi"></span>
                </span>
            </div>

            <div id="modalNipRow" class="modal-detail-row">
                <div class="modal-detail-icon"><i class="fa-regular fa-id-card"></i></div>
                <div>
                    <div class="modal-detail-label">NIP</div>
                    <div class="modal-detail-value" id="modalNip"></div>
                </div>
            </div>

            <div id="modalTugasRow" class="modal-detail-row">
                <div class="modal-detail-icon"><i class="fa-solid fa-list-check"></i></div>
                <div>
                    <div class="modal-detail-label">Tugas & Tanggung Jawab</div>
                    <div class="modal-detail-value" id="modalTugas" style="font-weight:400; color:#374151; font-size:0.8rem;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- 6. WILAYAH & PETA --}}
<section class="py-24 px-6 bg-emerald-50/30">
    <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl flex flex-col lg:flex-row">
            <div class="lg:w-1/3 p-10 flex flex-col justify-center">
                <span class="text-emerald-600 font-bold text-[10px] uppercase tracking-widest mb-4">Location</span>
                <h3 class="text-3xl font-serif mb-6">Wilayah & Peta Desa</h3>
                <div class="space-y-5">
                    <div class="flex gap-4 items-center">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center"><i class="fa-solid fa-location-dot text-emerald-600"></i></div>
                        <div><p class="text-xs text-gray-400">Kecamatan</p><p class="font-semibold">Balige</p></div>
                    </div>
                    <div class="flex gap-4 items-center">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center"><i class="fa-solid fa-building text-emerald-600"></i></div>
                        <div><p class="text-xs text-gray-400">Kabupaten</p><p class="font-semibold">Toba</p></div>
                    </div>
                    <div class="flex gap-4 items-center">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center"><i class="fa-solid fa-flag text-emerald-600"></i></div>
                        <div><p class="text-xs text-gray-400">Provinsi</p><p class="font-semibold">Sumatera Utara</p></div>
                    </div>
                    <div class="flex gap-4 items-center">
                        <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center"><i class="fa-solid fa-water text-emerald-600"></i></div>
                        <div><p class="text-xs text-gray-400">Luas Wilayah</p><p class="font-semibold">{{ $stat_luas ?? '12.5' }} km²</p></div>
                    </div>
                    
                    {{-- TELEPON / WHATSAPP --}}
                    <div class="flex gap-4 items-center cursor-pointer group hover:bg-green-50 p-3 rounded-xl transition-all duration-300"
                         onclick="window.open('https://wa.me/{{ $profil->telepon_desa ? preg_replace('/[^0-9]/', '', $profil->telepon_desa) : '62' }}', '_blank')">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center group-hover:bg-green-500 transition-all duration-300">
                            <i class="fa-brands fa-whatsapp text-green-600 text-xl group-hover:text-white transition-all duration-300"></i>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 group-hover:text-green-600 transition-all duration-300">Hubungi via WhatsApp</p>
                            <p class="font-semibold group-hover:text-green-600 transition-all duration-300">
                                {{ $profil->telepon_desa ?? 'Nomor belum diisi' }}
                                @if($profil->telepon_desa)
                                <span class="text-xs text-green-500 ml-2"><i class="fa-solid fa-arrow-right"></i> Klik untuk chat</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lg:w-2/3 h-[450px] relative">
                @php
                    $mapsEmbedUrl = $profil->maps_embed ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.668102377317!2d99.0435942!3d2.332309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04306443c683%3A0x868a8600868a86!2sLumban%20Silintong!5e0!3m2!1sid!2sid!4v1714574100000!5m2!1sid!2sid';
                    if (str_contains($mapsEmbedUrl, '<iframe')) {
                        preg_match('/src=\"([^\"]+)\"/', $mapsEmbedUrl, $matches);
                        $mapsEmbedUrl = $matches[1] ?? $mapsEmbedUrl;
                    }
                @endphp
                <iframe 
                    src="{{ $mapsEmbedUrl }}" 
                    width="100%" height="100%" style="border:0; filter: contrast(1.1) grayscale(0.3);" allowfullscreen="" loading="lazy">
                </iframe>
            </div>
        </div>
    </div>
</section>

{{-- 7. GALERI DESA --}}
<section class="py-24 px-6 bg-white">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-12 flex-wrap gap-4">
            <div>
                <span class="text-emerald-600 font-space text-xs font-bold uppercase tracking-[0.4em] mb-2 inline-block">Gallery</span>
                <h2 class="text-4xl md:text-5xl font-serif">Galeri <span class="italic text-emerald-600">Kegiatan</span></h2>
                <p class="text-gray-500 mt-1">Dokumentasi kegiatan Desa Lumban Silintong</p>
            </div>
            <a href="{{ route('galeri') }}" class="px-6 py-3 border border-emerald-200 rounded-full text-emerald-600 hover:bg-emerald-600 hover:text-white transition-all duration-300 font-semibold text-sm">
                Lihat Semua <i class="fa-solid fa-arrow-right ml-2"></i>
            </a>
        </div>

        @if(isset($galeris) && count($galeris) > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($galeris as $g)
            <div class="group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 hover:-translate-y-2" data-aos="fade-up">
                <div class="h-52 overflow-hidden">
                    <img src="{{ asset('storage/' . $g->gambar_galeri) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
                </div>
                <div class="p-4 bg-white">
                    <p class="font-semibold text-gray-800">{{ $g->judul_galeri ?? 'Dokumentasi Desa' }}</p>
                    <p class="text-xs text-gray-400 mt-1">{{ $g->created_at->translatedFormat('d F Y') }}</p>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-16 bg-gray-50 rounded-3xl">
            <i class="fa-regular fa-images text-5xl text-gray-300 mb-4"></i>
            <p class="text-gray-400">Belum ada foto kegiatan yang diunggah</p>
        </div>
        @endif
    </div>
</section>

{{-- TUTORIAL SECTION --}}
<div class="max-w-7xl mx-auto px-6 pb-16">
    <div class="tutorial-section" data-aos="fade-up">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Profil Desa</h3>
        </div>
        
        <p class="tutorial-intro">
            Halaman <strong>Profil Desa</strong> menyajikan informasi lengkap tentang demografi, sejarah, 
            visi misi, struktur organisasi, wilayah geografis, dan galeri kegiatan Desa Lumban Silintong.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📊 Statistik Desa</h4>
                    <p>Informasi tahun berdiri, jumlah penduduk, KK, dan luas wilayah dalam card yang menarik.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>📜 Sejarah Desa</h4>
                    <p>Perjalanan panjang dan kearifan lokal Desa Lumban Silintong.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>🎯 Visi & Misi</h4>
                    <p>Tujuan dan arah pembangunan desa yang telah ditetapkan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>👥 Struktur Organisasi</h4>
                    <p>Perangkat desa yang bertugas melayani masyarakat.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>📍 Peta Interaktif</h4>
                    <p>Lokasi geografis desa melalui Google Maps terintegrasi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>📸 Galeri Kegiatan</h4>
                    <p>Dokumentasi kegiatan desa dalam bentuk foto-foto menarik.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">7</div>
                <div class="tutorial-text">
                    <h4>📱 WhatsApp Official</h4>
                    <p>Hubungi perangkat desa melalui WhatsApp untuk informasi dan layanan.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Nikmati pengalaman browsing dengan efek animasi yang muncul saat scroll. Setiap card memiliki efek hover yang menarik untuk pengalaman yang lebih baik. Klik nomor WhatsApp untuk langsung terhubung dengan perangkat desa.</span>
        </div>
    </div>
</div>

{{-- 8. FOOTER --}}
<footer class="bg-[#0a1f18] pt-10 pb-8 px-6 md:pt-16 md:pb-10 text-white">
    <div class="max-w-7xl mx-auto text-center">
        <h2 class="text-xl md:text-3xl font-serif italic mb-6 md:mb-10 leading-relaxed">Membangun Masa Depan <br>Tanpa Melupakan <span class="text-emerald-400">Akar.</span></h2>
        
        {{-- Kontak WA di Footer --}}
        @if($profil->telepon_desa)
        <div class="mb-6">
            <a href="https://wa.me/{{ $profil->telepon_desa ? preg_replace('/[^0-9]/', '', $profil->telepon_desa) : '62' }}" 
               target="_blank"
               class="wa-footer-btn">
                <i class="fa-brands fa-whatsapp"></i>
                <span>Hubungi via WhatsApp</span>
                <span class="text-sm opacity-75">{{ $profil->telepon_desa ?? '-' }}</span>
            </a>
        </div>
        @else
        <div class="mb-6">
            <span class="text-gray-500 text-sm">Nomor WhatsApp belum diisi</span>
        </div>
        @endif
        
        <div class="pt-6 md:pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-[0.3em]">© 2026 Pemerintah Desa Lumban Silintong.</p>
        </div>
    </div>
</footer>

<script>
    AOS.init({ duration: 800, once: true, easing: 'ease-out-expo' });

    // Scroll Progress
    window.addEventListener('scroll', () => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        const scrollLine = document.querySelector(".scroll-line");
        if (scrollLine) scrollLine.style.width = scrolled + "%";
    });

    // Parallax Effect
    window.addEventListener('scroll', () => {
        const parallaxImages = document.querySelectorAll('.image-parallax');
        parallaxImages.forEach(img => {
            const speed = 0.1;
            const rect = img.parentElement.getBoundingClientRect();
            if(rect.top < window.innerHeight && rect.bottom > 0) {
                const shift = (window.innerHeight - rect.top) * speed;
                img.style.transform = `translateY(${shift - 50}px) scale(1.1)`;
            }
        });
    });

    // Tutorial Items Interactive
    document.querySelectorAll('.tutorial-item').forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => { this.style.transform = ''; }, 200);
        });
    });

    // ============================================
    // APARATUR MODAL FUNCTIONS
    // ============================================
    function openAparaturModal(data) {
        const modal = document.getElementById('aparaturModal');

        document.getElementById('modalFoto').src          = data.foto;
        document.getElementById('modalNama').textContent  = data.nama;
        document.getElementById('modalKategoriImg').textContent = data.kategori;
        document.getElementById('modalKategori').textContent    = data.kategori;
        document.getElementById('modalPosisi').textContent      = data.posisi;

        const iconEl = document.getElementById('modalIcon');
        iconEl.className = 'fa-solid ' + (data.icon || 'fa-user');

        // NIP
        const nipRow = document.getElementById('modalNipRow');
        if (data.nip && data.nip.trim() !== '') {
            document.getElementById('modalNip').textContent = data.nip;
            nipRow.style.display = 'flex';
        } else {
            nipRow.style.display = 'none';
        }

        // Tugas
        const tugasRow = document.getElementById('modalTugasRow');
        if (data.tugas && data.tugas.trim() !== '') {
            document.getElementById('modalTugas').textContent = data.tugas;
            tugasRow.style.display = 'flex';
        } else {
            tugasRow.style.display = 'none';
        }

        modal.classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeAparaturModal(e) {
        if (e.target === document.getElementById('aparaturModal')) {
            closeAparaturModalDirect();
        }
    }

    function closeAparaturModalDirect() {
        document.getElementById('aparaturModal').classList.remove('active');
        document.body.style.overflow = '';
    }

    // Tutup dengan ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeAparaturModalDirect();
    });
</script>
@endsection