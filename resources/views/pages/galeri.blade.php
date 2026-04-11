{{-- resources/views/pages/galeri.blade.php --}}
@extends('layouts.app')

@section('title', 'Galeri - Lumban Silintong')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-serif italic text-emerald-900 mb-4">📸 Galeri Kegiatan</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto rounded-full"></div>
        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Dokumentasi momen berharga dalam kegiatan pembangunan, budaya, dan keseharian masyarakat Desa Lumban Silintong</p>
    </div>

    {{-- Filter Kategori --}}
    <div class="flex flex-wrap justify-center gap-3 mb-12">
        <button data-filter="all" class="filter-btn active px-5 py-2 rounded-full text-sm font-semibold transition-all bg-emerald-600 text-white shadow-md">
            <i class="fa-regular fa-layer-group mr-1"></i> Semua
        </button>
        <button data-filter="kegiatan" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">
            <i class="fa-regular fa-calendar-check mr-1"></i> Kegiatan
        </button>
        <button data-filter="pembangunan" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">
            <i class="fa-solid fa-hard-hat mr-1"></i> Pembangunan
        </button>
        <button data-filter="budaya" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">
            <i class="fa-solid fa-drumstick-bite mr-1"></i> Budaya
        </button>
        <button data-filter="wisata" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">
            <i class="fa-solid fa-tree mr-1"></i> Wisata
        </button>
    </div>

    {{-- Galeri Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="galeri-grid">
        @forelse($galeris as $galeri)
        <div class="galeri-item group relative rounded-xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer" data-kategori="{{ $galeri->kategori }}">
            <div class="aspect-square overflow-hidden">
                <img src="{{ $galeri->foto ?? 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=500' }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition duration-700">
            </div>
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition duration-300 flex items-end p-4">
                <div class="text-white">
                    <span class="inline-block px-2 py-1 bg-emerald-500 rounded-full text-[10px] font-bold mb-2">
                        {{ ucfirst($galeri->kategori) }}
                    </span>
                    <h4 class="font-bold text-sm line-clamp-2">{{ $galeri->judul_galeri ?? $galeri->judul ?? 'Dokumentasi' }}</h4>
                    <p class="text-xs text-gray-200 mt-1">{{ $galeri->created_at->format('d M Y') }}</p>
                </div>
            </div>
            @if($galeri->deskripsi)
            <div class="absolute bottom-0 left-0 right-0 bg-white/90 backdrop-blur p-2 text-center text-xs text-gray-600 translate-y-full group-hover:translate-y-0 transition duration-300">
                {{ Str::limit($galeri->deskripsi, 60) }}
            </div>
            @endif
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <i class="fa-regular fa-images text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-serif italic text-gray-400">Belum Ada Galeri</h3>
            <p class="text-sm text-gray-400 mt-2">Belum ada dokumentasi foto yang diunggah.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12 flex justify-center">
        {{ $galeris->links() }}
    </div>
</div>

{{-- Lightbox Modal --}}
<div id="lightbox" class="fixed inset-0 bg-black/90 z-50 hidden items-center justify-center p-4" onclick="closeLightbox()">
    <div class="relative max-w-5xl w-full" onclick="event.stopPropagation()">
        <button onclick="closeLightbox()" class="absolute -top-12 right-0 text-white text-3xl hover:text-emerald-400 transition">
            <i class="fa-solid fa-circle-xmark"></i>
        </button>
        <img id="lightbox-img" src="" class="w-full h-auto rounded-2xl shadow-2xl">
        <div id="lightbox-caption" class="text-center text-white mt-4 text-sm"></div>
    </div>
</div>

<style>
    .filter-btn.active {
        background-color: #10b981;
        color: white;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .aspect-square {
        aspect-ratio: 1 / 1;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<script>
    // Filter Galeri
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('active');
                b.classList.add('bg-gray-100', 'text-gray-600');
                b.classList.remove('bg-emerald-600', 'text-white', 'shadow-md');
            });
            this.classList.add('active');
            this.classList.remove('bg-gray-100', 'text-gray-600');
            this.classList.add('bg-emerald-600', 'text-white', 'shadow-md');
            
            const filter = this.dataset.filter;
            document.querySelectorAll('.galeri-item').forEach(item => {
                if (filter === 'all' || item.dataset.kategori === filter) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });
    
    // Lightbox
    function openLightbox(imgSrc, caption) {
        const lightbox = document.getElementById('lightbox');
        const lightboxImg = document.getElementById('lightbox-img');
        const lightboxCaption = document.getElementById('lightbox-caption');
        lightboxImg.src = imgSrc;
        lightboxCaption.textContent = caption || '';
        lightbox.classList.remove('hidden');
        lightbox.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function closeLightbox() {
        const lightbox = document.getElementById('lightbox');
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    }
    
    // Klik gambar untuk buka lightbox
    document.querySelectorAll('.galeri-item').forEach(item => {
        item.addEventListener('click', function() {
            const img = this.querySelector('img');
            const caption = this.querySelector('h4')?.textContent || '';
            if (img) openLightbox(img.src, caption);
        });
    });
    
    // Tombol ESC untuk tutup lightbox
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeLightbox();
    });
</script>
@endsection