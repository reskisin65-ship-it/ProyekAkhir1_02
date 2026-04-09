{{-- resources/views/layouts/navigation_magic_sidebar.blade.php --}}
@php
    $menus = [
        ['id' => 'home', 'icon' => 'fa-house', 'url' => '/', 'label' => 'Beranda', 'desc' => 'Pusat informasi utama desa.'],
        ['id' => 'profil', 'icon' => 'fa-landmark-dome', 'url' => '#profil', 'label' => 'Profil Desa', 'desc' => 'Visi, misi, dan sejarah.'],
        ['id' => 'berita', 'icon' => 'fa-newspaper', 'url' => '#berita', 'label' => 'Warta Desa', 'desc' => 'Update berita & pengumuman.'],
        ['id' => 'umkm', 'icon' => 'fa-shop', 'url' => '#umkm', 'label' => 'Pasar UMKM', 'desc' => 'Produk unggulan lokal.'],
        ['id' => 'layanan', 'icon' => 'fa-fingerprint', 'url' => '#layanan', 'label' => 'Layanan', 'desc' => 'Surat digital & aspirasi.'],
        ['id' => 'galeri', 'icon' => 'fa-photo-film', 'url' => '#galeri', 'label' => 'Galeri', 'desc' => 'Dokumentasi kegiatan.'],
        ['id' => 'peta', 'icon' => 'fa-map-location-dot', 'url' => '#peta', 'label' => 'Geografis', 'desc' => 'Peta wilayah desa.'],
    ];
@endphp

{{-- Desktop Magic Sidebar --}}
<aside class="magic-sidebar">
    @foreach($menus as $m)
        <a href="{{ $m['url'] }}" 
           class="side-item group" 
           @click="activeTab = '{{ $m['id'] }}'" 
           :class="{ 'active': activeTab === '{{ $m['id'] }}' }">
            <i class="fa-solid {{ $m['icon'] }} text-xl"></i>
            <div class="info-box">
                <span class="text-[9px] font-black uppercase text-emerald-500 tracking-[0.3em]">Menu Akses</span>
                <h5 class="text-2xl font-serif italic text-emerald-950 mt-1">{{ $m['label'] }}</h5>
                <p class="text-xs text-gray-400 mt-2 leading-relaxed">{{ $m['desc'] }}</p>
                <div class="absolute -left-2 top-1/2 transform -translate-y-1/2 w-4 h-4 bg-white rotate-45"></div>
            </div>
        </a>
    @endforeach
</aside>

{{-- Mobile Bottom Navigation (muncul hanya di layar < 1024px) --}}
<div class="mobile-nav">
    @foreach(array_slice($menus, 0, 5) as $m)
        <a href="{{ $m['url'] }}" class="text-white/50 hover:text-emerald-400 text-2xl transition-all duration-300 hover:scale-110">
            <i class="fa-solid {{ $m['icon'] }}"></i>
        </a>
    @endforeach
    <a href="/login" class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-2xl flex items-center justify-center text-white shadow-lg hover:scale-110 transition duration-300">
        <i class="fa-solid fa-user-lock text-sm"></i>
    </a>
</div>

<style>
    .magic-sidebar {
        position: fixed; 
        left: 30px; 
        top: 50%; 
        transform: translateY(-50%);
        width: 80px; 
        background: linear-gradient(145deg, rgba(6, 78, 59, 0.95), rgba(2, 44, 34, 0.95));
        backdrop-filter: blur(16px);
        border-radius: 45px; 
        z-index: 1100; 
        display: flex; 
        flex-direction: column; 
        align-items: center; 
        justify-content: center; 
        gap: 18px;
        padding: 25px 0;
        box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.15);
    }
    
    .side-item {
        position: relative; 
        width: 52px; 
        height: 52px; 
        display: flex;
        align-items: center; 
        justify-content: center; 
        border-radius: 24px;
        color: rgba(255, 255, 255, 0.5); 
        font-size: 22px; 
        transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
    }
    
    .side-item:hover, .side-item.active { 
        color: #fff; 
        background: rgba(255, 255, 255, 0.18); 
        transform: translateY(-4px) scale(1.05);
    }
    
    .side-item.active { 
        color: var(--emerald-500); 
        background: #fff; 
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }
    
    .info-box {
        position: absolute; 
        left: 80px; 
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(8px);
        padding: 18px 24px;
        border-radius: 28px; 
        box-shadow: 20px 25px 45px rgba(0, 0, 0, 0.12);
        opacity: 0; 
        visibility: hidden; 
        transform: translateX(-12px); 
        transition: all 0.35s ease;
        min-width: 280px; 
        border: 1px solid rgba(0, 0, 0, 0.04);
        color: var(--emerald-950);
        pointer-events: none;
    }
    
    .side-item:hover .info-box { 
        opacity: 1; 
        visibility: visible; 
        transform: translateX(0);
        pointer-events: auto;
    }
    
    .mobile-nav {
        position: fixed; 
        bottom: 20px; 
        left: 50%; 
        transform: translateX(-50%);
        width: 90%; 
        height: 72px; 
        background: rgba(6, 78, 59, 0.96);
        backdrop-filter: blur(20px);
        border-radius: 32px; 
        z-index: 1100; 
        display: none;
        align-items: center; 
        justify-content: space-around; 
        padding: 0 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    @media (max-width: 1024px) {
        .magic-sidebar { display: none; }
        .mobile-nav { display: flex; }
    }
</style>