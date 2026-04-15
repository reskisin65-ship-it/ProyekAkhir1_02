{{-- resources/views/pages/berita.blade.php --}}
@extends('layouts.app')

@section('title', 'Berita & Pengumuman')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-serif italic text-emerald-900 mb-4">📰 Berita & Pengumuman</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto rounded-full"></div>
        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Informasi terkini seputar kegiatan, pembangunan, dan pengumuman resmi Desa Lumban Silintong</p>
    </div>

    {{-- Filter Kategori --}}
    <div class="flex flex-wrap justify-center gap-3 mb-12">
        <button data-filter="all" class="filter-btn active px-5 py-2 rounded-full text-sm font-semibold transition-all bg-emerald-600 text-white shadow-md">Semua</button>
        <button data-filter="berita" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">Berita</button>
        <button data-filter="pengumuman" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">Pengumuman</button>
        <button data-filter="kegiatan" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">Kegiatan</button>
    </div>

    {{-- Featured Berita --}}
    @if(isset($beritaUtama) && $beritaUtama)
    <div class="mb-16">
        <div class="relative rounded-2xl overflow-hidden h-[450px] group shadow-xl">
            <img src="{{ $beritaUtama->gambar ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=1200' }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-700">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent flex items-end">
                <div class="p-8 text-white">
                    <span class="inline-block px-3 py-1 bg-emerald-500 rounded-full text-[10px] font-bold mb-3">
                        {{ ucfirst($beritaUtama->kategori) }}
                    </span>
                    <h2 class="text-3xl md:text-4xl font-serif italic mb-2">{{ $beritaUtama->judul }}</h2>
                    <p class="text-gray-200 mb-4 max-w-2xl line-clamp-2">{{ $beritaUtama->ringkasan }}</p>
                    <a href="{{ route('berita.show', $beritaUtama->slug) }}" class="inline-flex items-center gap-2 px-5 py-2 bg-white/20 backdrop-blur rounded-full text-sm font-semibold hover:bg-white/30 transition">
                        Baca Selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif

    {{-- Grid Berita --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="berita-grid">
        @forelse($beritas as $berita)
        <div class="berita-card bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-500 hover:-translate-y-2 border border-gray-100" data-kategori="{{ $berita->kategori }}">
            <div class="relative h-52 overflow-hidden">
                <img src="{{ $berita->gambar ?? 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=500' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                <div class="absolute top-3 left-3">
                    <span class="inline-block px-3 py-1 rounded-full text-[9px] font-bold 
                        @if($berita->kategori == 'berita') bg-blue-500 text-white
                        @elseif($berita->kategori == 'pengumuman') bg-amber-500 text-white
                        @else bg-emerald-500 text-white @endif">
                        @if($berita->kategori == 'berita') 📰 Berita
                        @elseif($berita->kategori == 'pengumuman') 📢 Pengumuman
                        @else 🎉 Kegiatan @endif
                    </span>
                </div>
            </div>
            <div class="p-5">
                <div class="flex items-center gap-3 text-xs text-gray-400 mb-2">
                    <span><i class="fa-regular fa-calendar mr-1"></i> {{ $berita->tanggal_publikasi->format('d M Y') }}</span>
                    <span><i class="fa-regular fa-eye mr-1"></i> {{ number_format($berita->dibaca) }} dibaca</span>
                </div>
                <h3 class="text-xl font-serif italic text-emerald-800 mb-2 line-clamp-2 hover:text-emerald-600 transition">
                    <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                </h3>
                <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-4">{{ $berita->ringkasan }}</p>
                <a href="{{ route('berita.show', $berita->slug) }}" class="inline-flex items-center gap-1 text-emerald-600 text-sm font-semibold hover:gap-2 transition-all">
                    Baca Selengkapnya <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-3 text-center py-20">
            <i class="fa-regular fa-newspaper text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-serif italic text-gray-400">Belum Ada Berita</h3>
            <p class="text-sm text-gray-400 mt-2">Belum ada berita atau pengumuman yang dipublikasikan.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12 flex justify-center">
        {{ $beritas->links() }}
    </div>
</div>

<style>
    .filter-btn.active { background-color: #10b981; color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }
</style>

<script>
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
            document.querySelectorAll('.berita-card').forEach(card => {
                if (filter === 'all' || card.dataset.kategori === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endsection