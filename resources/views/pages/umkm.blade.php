{{-- resources/views/pages/umkm.blade.php --}}
@extends('layouts.app')

@section('title', 'UMKM - Lumban Silintong')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-serif italic text-emerald-900 mb-4">🛍️ UMKM Desa Lumban Silintong</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto rounded-full"></div>
        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Dukung produk lokal! Temukan berbagai produk unggulan dari UMKM Desa Lumban Silintong</p>
    </div>

    {{-- Search & Filter --}}
    <div class="flex flex-col md:flex-row justify-between items-center gap-4 mb-10">
        <div class="flex flex-wrap gap-3">
            <button data-filter="all" class="filter-btn active px-5 py-2 rounded-full text-sm font-semibold transition-all bg-emerald-600 text-white shadow-md">Semua</button>
            <button data-filter="makanan" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">🍔 Makanan</button>
            <button data-filter="kerajinan" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">🎨 Kerajinan</button>
            <button data-filter="fashion" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">👕 Fashion</button>
            <button data-filter="pertanian" class="filter-btn px-5 py-2 rounded-full text-sm font-semibold transition-all bg-gray-100 text-gray-600 hover:bg-emerald-100">🌾 Pertanian</button>
        </div>
        <div class="relative w-full md:w-64">
            <i class="fa-solid fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
            <input type="text" id="search-umkm" placeholder="Cari UMKM..." class="w-full pl-10 pr-4 py-2 rounded-full border border-gray-200 focus:outline-none focus:border-emerald-500 text-sm">
        </div>
    </div>

    {{-- UMKM Grid --}}
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8" id="umkm-grid">
        @forelse($umkms as $umkm)
        <div class="umkm-card bg-white rounded-2xl overflow-hidden shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 border border-gray-100" 
             data-kategori="{{ $umkm->kategori ?? 'umum' }}" 
             data-nama="{{ strtolower($umkm->nama_usaha) }}">
            <div class="relative h-56 overflow-hidden">
                <img src="{{ $umkm->logo ? asset('storage/' . $umkm->logo) : 'https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=500' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-700" alt="{{ $umkm->nama_usaha }}">
                <div class="absolute top-4 right-4">
                    <span class="inline-block px-3 py-1 rounded-full text-[10px] font-bold bg-white/90 text-emerald-700 shadow-sm">{{ ucfirst($umkm->kategori ?? 'Umum') }}</span>
                </div>
            </div>
            <div class="p-5">
                <h3 class="text-xl font-serif italic text-emerald-800 mb-2 line-clamp-1">{{ $umkm->nama_usaha }}</h3>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                    <i class="fa-solid fa-user text-emerald-500 text-xs"></i>
                    <span>{{ $umkm->pemilik ?? $umkm->user->name ?? 'Pengelola' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                    <i class="fa-solid fa-location-dot text-emerald-500 text-xs"></i>
                    <span class="line-clamp-1">{{ $umkm->alamat_usaha ?? $umkm->alamat ?? 'Alamat tidak tersedia' }}</span>
                </div>
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                    <i class="fa-solid fa-phone text-emerald-500 text-xs"></i>
                    <span>{{ $umkm->no_telepon ?? $umkm->nomor_telepon ?? '-' }}</span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed line-clamp-2 mb-4">{{ Str::limit($umkm->deskripsi ?? 'Deskripsi belum tersedia', 80) }}</p>
                <a href="{{ route('umkm.show', $umkm->id_umkm) }}" class="inline-flex items-center gap-2 text-emerald-600 text-sm font-semibold hover:gap-3 transition-all">
                    Lihat Detail <i class="fa-solid fa-arrow-right text-xs"></i>
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <i class="fa-solid fa-store text-6xl text-gray-300 mb-4"></i>
            <h3 class="text-xl font-serif italic text-gray-400">Belum Ada UMKM</h3>
            <p class="text-sm text-gray-400 mt-2">Belum ada UMKM yang terdaftar.</p>
        </div>
        @endforelse
    </div>

    {{-- Pagination --}}
    <div class="mt-12 flex justify-center">
        {{ $umkms->links() }}
    </div>
</div>

<style>
    .filter-btn.active { background-color: #10b981; color: white; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); }
    .line-clamp-1 { display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
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
            document.querySelectorAll('.umkm-card').forEach(card => {
                if (filter === 'all' || card.dataset.kategori === filter) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
    
    document.getElementById('search-umkm')?.addEventListener('keyup', function() {
        const search = this.value.toLowerCase();
        document.querySelectorAll('.umkm-card').forEach(card => {
            const nama = card.dataset.nama;
            if (nama && nama.includes(search)) {
                card.style.display = 'block';
            } else if (search === '') {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>
@endsection