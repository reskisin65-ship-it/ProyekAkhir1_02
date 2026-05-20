{{-- resources/views/layouts/navigation_desa.blade.php --}}
<nav class="nav-top" :class="{ 'nav-scrolled': scrolled }" x-data="{}">
    <div class="w-full flex justify-between items-center">
        {{-- Logo --}}
            <div class="w-12 h-12 bg-emerald-950 rounded-2xl flex items-center justify-center text-white shadow-lg rotate-3 group-hover:rotate-0 transition-all duration-500">
                <span class="text-xl font-black">LS</span>
            </div>
            <div class="hidden md:block">
                <span class="text-xl font-serif italic text-emerald-950 leading-tight">Lumban Silintong</span>
            </div>


        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center gap-6">
            <div class="flex items-center gap-2 text-sm font-semibold">
                
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: ADMIN --}}
                {{-- ============================================= --}}
                @auth
                    @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        
                        {{-- Dropdown Kependudukan --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Kependudukan</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('admin.penduduk.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Data Penduduk</a>
                                <a href="{{ route('admin.pengurus.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Pengurus Desa</a>
                            </div>
                        </div>

                        {{-- Dropdown Layanan --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Layanan</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('admin.pengajuan-surat.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Pengajuan Surat</a>
                                <a href="{{ route('admin.aspirasi.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Aspirasi Warga</a>
                            </div>
                        </div>

                        {{-- Dropdown Informasi --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Informasi</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('admin.berita.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Berita Desa</a>
                                <a href="{{ route('admin.galeri.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Galeri Kegiatan</a>
                                <a href="{{ route('admin.profil-desa.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">🏛️ Profil Desa</a>
                                <a href="{{ route('admin.kontak-desa.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">📞 Kontak Desa</a>
                            </div>
                        </div>

                        {{-- Dropdown Ekonomi & Data --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Ekonomi & Data</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('admin.umkm.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Kelola UMKM</a>
                                <a href="{{ route('admin.statistik.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Statistik Desa</a>
                                <a href="{{ route('admin.keuangan.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">💰 Keuangan Desa</a>
                            </div>
                        </div>
                        
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: UMKM --}}
                {{-- ============================================= --}}
                    @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
                        @php $currentUmkmId = optional(Auth::user()->umkm)->id_umkm; @endphp
                        <a href="{{ route('masyarakat.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        
                        {{-- Dropdown Layanan Surat --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Layanan Surat</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('masyarakat.surat.create') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Ajukan Surat</a>
                                <a href="{{ route('masyarakat.surat.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Riwayat Surat</a>
                            </div>
                        </div>

                        {{-- Dropdown Informasi --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Informasi</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('berita') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Berita Desa</a>
                                <a href="{{ route('galeri') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Galeri Kegiatan</a>
                                <a href="{{ route('profil-desa') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">🏛️ Profil Desa</a>
                                <a href="{{ route('kontak') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Hubungi Kami</a>
                            </div>
                        </div>

                        {{-- Dropdown UMKM & Keuangan --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>UMKM & Keuangan</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ $currentUmkmId ? route('umkm.show', $currentUmkmId) : route('umkm') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Kelola Produk</a>
                                <a href="{{ route('umkm') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">UMKM Lainnya</a>
                                <a href="{{ route('statistik.publik') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Statistik Desa</a>
                                <a href="{{ route('masyarakat.keuangan.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">💰 Keuangan Desa</a>
                            </div>
                        </div>

                        <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Aspirasi Saya</a>
                        
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: MASYARAKAT --}}
                {{-- ============================================= --}}
                    @else
                        <a href="{{ route('masyarakat.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        
                        {{-- Dropdown Layanan Surat --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Layanan Surat</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('masyarakat.surat.create') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Ajukan Surat</a>
                                <a href="{{ route('masyarakat.surat.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Riwayat Surat</a>
                            </div>
                        </div>

                        {{-- Dropdown Informasi --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Informasi</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('berita') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Berita Desa</a>
                                <a href="{{ route('galeri') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Galeri Kegiatan</a>
                                <a href="{{ route('profil-desa') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">🏛️ Profil Desa</a>
                                <a href="{{ route('kontak') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Hubungi Kami</a>
                            </div>
                        </div>

                        {{-- Dropdown Ekonomi & Statistik --}}
                        <div class="relative" x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false">
                            <button class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50 flex items-center gap-1.5">
                                <span>Ekonomi & Statistik</span>
                                <i class="fa-solid fa-chevron-down text-[9px] transition-transform duration-200" :class="{ 'rotate-180': open }"></i>
                            </button>
                            <div x-show="open" x-cloak
                                 x-transition:enter="transition ease-out duration-150"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-100"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute top-full left-0 mt-1 w-48 bg-white/95 backdrop-blur-md rounded-2xl shadow-xl border border-emerald-100 py-1.5 z-[2000]"
                                 style="display: none;">
                                <a href="{{ route('umkm') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Pasar UMKM</a>
                                <a href="{{ route('statistik.publik') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">Statistik Desa</a>
                                <a href="{{ route('masyarakat.keuangan.index') }}" class="block px-4 py-2.5 text-sm text-emerald-950/80 hover:text-emerald-600 hover:bg-emerald-50 transition font-medium">💰 Keuangan Desa</a>
                            </div>
                        </div>

                        <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Aspirasi Saya</a>
                    @endif
                @else
                    {{-- ============================================= --}}
                    {{-- MENU UNTUK GUEST (BELUM LOGIN) --}}
                    {{-- ============================================= --}}
                    <a href="{{ route('home') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Beranda</a>
                    <a href="{{ route('profil-desa') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">🏛️ Profil Desa</a>
                    <a href="{{ route('berita') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Berita</a>
                    <a href="{{ route('galeri') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Galeri</a>
                    <a href="{{ route('umkm') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">UMKM</a>
                    <a href="{{ route('kontak') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Kontak</a>
                    <a href="{{ route('statistik.publik') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Statistik Desa</a>
                @endauth
            </div>
        </div>
            
            {{-- Tombol Auth & Notifikasi --}}
            <div class="flex gap-3">
                @auth
                    {{-- ============================================= --}}
                    {{-- NOTIFICATION BELL LANGSUNG DI SINI --}}
                    {{-- ============================================= --}}
                    <div class="relative" x-data="{ 
                        open: false, 
                        notif: [], 
                        total: 0,
                        ambil() {
                            fetch('{{ route("notifikasi.ambil") }}')
                                .then(res => res.json())
                                .then(data => {
                                    this.notif = data.data;
                                    this.total = data.total;
                                })
                                .catch(err => console.error('Error ambil notif:', err));
                        },
                        baca(id) {
                            fetch('{{ route("notifikasi.baca") }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Content-Type': 'application/json'
                                },
                                body: JSON.stringify({ id: id })
                            }).then(() => this.ambil());
                        },
                        bacaSemua() {
                            fetch('{{ route("notifikasi.baca-semua") }}', {
                                method: 'POST',
                                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
                            }).then(() => this.ambil());
                        }
                    }" x-init="ambil(); setInterval(() => ambil(), 30000)">
                        
                        <button @click="open = !open" class="relative w-10 h-10 rounded-full bg-emerald-50 hover:bg-emerald-100 transition flex items-center justify-center">
                            <i class="fa-regular fa-bell text-emerald-600 text-xl"></i>
                            
                            {{-- BADGE MERAH DENGAN ANGKA --}}
                            <span x-show="total > 0" 
                                  x-cloak 
                                  class="absolute -top-1 -right-1 bg-red-500 text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1 shadow-md">
                                <span x-text="total > 99 ? '99+' : total"></span>
                            </span>
                        </button>
                        
                        {{-- Dropdown Notifikasi --}}
                        <div x-show="open" @click.away="open = false" x-cloak
                             class="absolute top-full right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-gray-100 overflow-hidden z-50"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 scale-95"
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95">
                            
                            <div class="flex justify-between items-center px-4 py-3 border-b border-gray-100 bg-gray-50">
                                <h3 class="font-semibold text-gray-800">🔔 Notifikasi</h3>
                                <a href="{{ route('notifikasi.index') }}" class="text-xs text-emerald-600 hover:text-emerald-700">Lihat semua</a>
                            </div>
                            
                            <div class="max-h-96 overflow-y-auto">
                                <template x-for="item in notif" :key="item.id">
                                    <a :href="item.link" @click="baca(item.id)" 
                                       class="block px-4 py-3 border-b border-gray-50 hover:bg-gray-50 transition"
                                       :class="!item.dibaca ? 'bg-emerald-50/30' : ''">
                                        <div class="flex gap-3">
                                            <div class="flex-shrink-0">
                                                <div class="w-8 h-8 rounded-full flex items-center justify-center"
                                                     :class="{
                                                         'bg-emerald-100': item.jenis == 'pengajuan_surat',
                                                         'bg-blue-100': item.jenis == 'aspirasi',
                                                         'bg-amber-100': item.jenis == 'umkm',
                                                         'bg-gray-100': true
                                                     }">
                                                    <i class="text-sm" :class="{
                                                        'fa-regular fa-file-lines text-emerald-600': item.jenis == 'pengajuan_surat',
                                                        'fa-regular fa-comment-dots text-blue-600': item.jenis == 'aspirasi',
                                                        'fa-solid fa-store text-amber-600': item.jenis == 'umkm',
                                                        'fa-regular fa-bell text-gray-600': true
                                                    }"></i>
                                                </div>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-800 truncate" x-text="item.judul"></p>
                                                <p class="text-xs text-gray-500 truncate" x-text="item.pesan"></p>
                                                <p class="text-[10px] text-gray-400 mt-1" x-text="item.waktu"></p>
                                            </div>
                                            <div x-show="!item.dibaca" class="flex-shrink-0">
                                                <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                                            </div>
                                        </div>
                                    </a>
                                </template>
                                
                                <div x-show="notif.length === 0" class="px-4 py-8 text-center">
                                    <i class="fa-regular fa-bell-slash text-3xl text-gray-300 mb-2 block"></i>
                                    <p class="text-sm text-gray-400">Tidak ada notifikasi</p>
                                </div>
                            </div>
                            
                            <div x-show="notif.length > 0" class="border-t border-gray-100 p-2 text-center">
                                <button @click="bacaSemua()" class="text-xs text-emerald-600 hover:text-emerald-700 w-full py-1">
                                    ✓ Tandai semua dibaca
                                </button>
                            </div>
                        </div>
                    </div>
                    
                                        {{-- User Menu dengan Desain Premium --}}
                    <div class="flex items-center gap-3 relative" x-data="{ userMenu: false }">
                        <button @click="userMenu = !userMenu" 
                                class="flex items-center gap-3 px-4 py-2 rounded-full bg-gradient-to-r from-sky-500 to-blue-500 hover:from-sky-600 hover:to-blue-600 transition-all duration-300 hover:scale-105 shadow-lg shadow-sky-200/50 group">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-white text-sm font-bold backdrop-blur-sm">
                                {{ substr(Auth::user()->name, 0, 1) }}
                            </div>
                            <span class="text-sm font-semibold text-white">{{ Auth::user()->name }}</span>
                            <i class="fa-solid fa-chevron-down text-[10px] text-white/80 transition-transform duration-300 group-hover:rotate-180"></i>
                        </button>
                        
                        {{-- Dropdown Menu --}}
                        <div x-show="userMenu" 
                            @click.away="userMenu = false" 
                            x-cloak 
                            class="absolute top-full right-0 mt-3 w-80 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 overflow-hidden z-50 max-h-[85vh] flex flex-col"
                            x-transition:enter="transition-all duration-300 ease-out"
                            x-transition:enter-start="opacity-0 -translate-y-5 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition-all duration-200 ease-in"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 -translate-y-5 scale-95">
                            
                            {{-- Header Profil --}}
                            <div class="bg-gradient-to-r from-sky-500 via-sky-400 to-blue-500 px-5 py-5 text-white flex-shrink-0">
                                <div class="flex items-center gap-4">
                                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center text-2xl font-bold backdrop-blur-sm shadow-inner">
                                        {{ substr(Auth::user()->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-lg">{{ Auth::user()->name }}</h4>
                                        <p class="text-xs text-white/80">{{ Auth::user()->email }}</p>
                                        <span class="inline-block mt-2 px-3 py-1 rounded-full text-[9px] font-bold uppercase
                                            @if(Auth::user()->role->nama_role == 'admin') bg-red-500/30 text-white
                                            @elseif(Auth::user()->role->nama_role == 'umkm') bg-amber-500/30 text-white
                                            @else bg-emerald-500/30 text-white @endif">
                                            {{ Auth::user()->role->nama_role }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            {{-- Menu Items --}}
                            <div class="py-2 overflow-y-auto max-h-[45vh] no-scrollbar flex-1">
                                @if(Auth::user()->role->nama_role == 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-chart-line w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Dashboard</span>
                                    </a>
                                    <a href="{{ route('admin.pengajuan-surat.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-envelope w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Pengajuan Surat</span>
                                    </a>
                                    <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-users w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Data Penduduk</span>
                                    </a>
                                    <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-newspaper w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Berita</span>
                                    </a>
                                    <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-photo-film w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Galeri</span>
                                    </a>
                                    <a href="{{ route('admin.aspirasi.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-comment-dots w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Aspirasi</span>
                                    </a>
                                    <a href="{{ route('admin.umkm.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-store w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">UMKM</span>
                                    </a>
                                    <a href="{{ route('admin.pengurus.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-user-tie w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Pengurus</span>
                                    </a>
                                    <a href="{{ route('admin.statistik.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-chart-simple w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Statistik</span>
                                    </a>
                                    <a href="{{ route('admin.keuangan.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-coins w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Keuangan</span>
                                    </a>
                                    <a href="{{ route('admin.profil-desa.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-building w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Profil Desa</span>
                                    </a>
                                    <a href="{{ route('admin.kontak-desa.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-address-book w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Kontak Desa</span>
                                    </a>
                                    <a href="{{ route('notifikasi.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-regular fa-bell w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Notifikasi</span>
                                    </a>
                                @elseif(Auth::user()->role->nama_role == 'umkm')
                                    @php $currentUmkmId = optional(Auth::user()->umkm)->id_umkm; @endphp
                                    <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-chart-line w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Dashboard</span>
                                    </a>
                                    <a href="{{ route('masyarakat.surat.create') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-file-signature w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Ajukan Surat</span>
                                    </a>
                                    <a href="{{ route('masyarakat.surat.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-envelope w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Riwayat Surat</span>
                                    </a>
                                    <a href="{{ route('masyarakat.aspirasi.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-comment-dots w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Aspirasi Saya</span>
                                    </a>
                                    <div class="border-t border-sky-50 my-2"></div>
                                    <a href="{{ route('berita') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-newspaper w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Berita</span>
                                    </a>
                                    <a href="{{ route('galeri') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-photo-film w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Galeri</span>
                                    </a>
                                    <a href="{{ route('umkm') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-store w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">UMKM Lainnya</span>
                                    </a>
                                    <a href="{{ route('statistik.publik') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-chart-simple w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Statistik Desa</span>
                                    </a>
                                    <a href="{{ route('masyarakat.keuangan.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-coins w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Keuangan</span>
                                    </a>
                                    <a href="{{ route('profil-desa') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-landmark-dome w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Profil Desa</span>
                                    </a>
                                    <a href="{{ $currentUmkmId ? route('umkm.show', $currentUmkmId) : route('umkm') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-boxes-stacked w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Kelola Produk</span>
                                    </a>
                                    <a href="{{ route('notifikasi.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-regular fa-bell w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Notifikasi</span>
                                    </a>
                                @else
                                    <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-chart-line w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Dashboard</span>
                                    </a>
                                    <a href="{{ route('masyarakat.surat.create') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-file-signature w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Ajukan Surat</span>
                                    </a>
                                    <a href="{{ route('masyarakat.surat.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-envelope w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Riwayat Surat</span>
                                    </a>
                                    <a href="{{ route('masyarakat.aspirasi.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-comment-dots w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Aspirasi Saya</span>
                                    </a>
                                    <a href="{{ route('masyarakat.keuangan.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-coins w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Keuangan</span>
                                    </a>
                                    <a href="{{ route('profil-desa') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-landmark-dome w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Profil Desa</span>
                                    </a>
                                    <a href="{{ route('notifikasi.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-regular fa-bell w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Notifikasi</span>
                                    </a>
                                @endif
                            </div>
                            
                            {{-- Divider --}}
                            <div class="border-t border-gray-100 my-1"></div>
                            
                            {{-- Logout Button --}}
                            <div class="p-3">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-gradient-to-r from-red-500 to-rose-500 hover:from-red-600 hover:to-rose-600 text-white rounded-xl font-bold transition-all duration-300 hover:scale-105 shadow-lg">
                                        <i class="fa-solid fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('register') }}" class="btn-nav-register px-4 py-2 rounded-full text-white text-sm font-semibold transition-all duration-300 flex items-center gap-1.5 shadow-md">
                        <i class="fa-regular fa-user-plus mr-1"></i> Daftar
                    </a>
                    <a href="{{ route('login') }}" class="btn-nav-login px-4 py-2 rounded-full border-2 text-sm font-semibold transition-all duration-300 flex items-center gap-1.5">
                        <i class="fa-solid fa-sign-in-alt mr-1"></i> Masuk
                    </a>
                @endauth
            </div>
        </div>

    </div>
</nav>

<style>
    .nav-top {
        position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
        width: 90%; max-width: 1400px; height: 80px;
        background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 50px;
        z-index: 1000; display: flex; align-items: center; padding: 0 40px;
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .nav-scrolled { top: 10px; width: 95%; height: 70px; background: rgba(255, 255, 255, 0.98); box-shadow: 0 15px 40px rgba(0,0,0,0.08); }
    
    @media (min-width: 1025px) {
        .nav-top {
            left: 120px;
            right: 30px;
            width: auto;
            transform: none;
            max-width: none;
        }
        .nav-scrolled {
            top: 10px;
            left: 120px;
            right: 30px;
            width: auto;
        }
    }
    
    [x-cloak] { display: none !important; }
    
    /* Hide scrollbar utility */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    /* Custom Scrollbar untuk Mobile Menu */
    .custom-scroll::-webkit-scrollbar {
        width: 3px;
    }
    .custom-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }
    .custom-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    
    /* Premium Hover Animation for Desktop Navbar Dropdowns */
    .nav-top a.group {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
    }
    .nav-top a.group:hover {
        transform: translateX(4px) scale(1.015);
        box-shadow: 0 4px 12px rgba(6, 78, 59, 0.04);
        background-color: rgba(16, 185, 129, 0.05) !important; /* Soft emerald overlay */
    }
    
    /* Main Navbar Category Triggers Hover */
    .nav-top button.group {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
    }
    .nav-top button.group:hover {
        color: #10b981 !important; /* Soft green */
        transform: translateY(-1px);
    }
    
    /* User Profile Dropdown Links Hover */
    div[x-show="userMenu"] a.group {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1) !important;
    }
    div[x-show="userMenu"] a.group:hover {
        background: rgba(56, 189, 248, 0.08) !important; /* sky-100 soft */
        color: #0284c7 !important; /* sky-600 */
        padding-left: 24px !important; /* Smooth right slide! */
    }
    div[x-show="userMenu"] a.group:hover i {
        color: #0284c7 !important;
        transform: scale(1.15) rotate(5deg) !important;
    }
    
    /* Active Link State for Navbar */
    .nav-top a.active, .nav-top button.active {
        color: #059669 !important; /* emerald-600 */
        background-color: rgba(16, 185, 129, 0.08) !important;
        font-weight: 700 !important;
    }
    
    /* Premium Hover for Register (Daftar) Button */
    .btn-nav-register {
        background: linear-gradient(135deg, #10b981, #059669);
        border: 1px solid rgba(255,255,255,0.1);
        position: relative;
        overflow: hidden;
    }
    .btn-nav-register::before {
        content: '';
        position: absolute;
        top: 0; left: -100%;
        width: 100%; height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.25), transparent);
        transition: 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .btn-nav-register:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.3) !important;
        background: linear-gradient(135deg, #34d399, #10b981);
    }
    .btn-nav-register:hover::before {
        left: 100%;
    }
    .btn-nav-register:hover i {
        transform: scale(1.15) rotate(-10deg);
        transition: 0.3s;
    }
    
    /* Premium Hover for Login (Masuk) Button */
    .btn-nav-login {
        border-color: #10b981 !important;
        color: #10b981 !important;
        background: transparent;
        position: relative;
        overflow: hidden;
    }
    .btn-nav-login:hover {
        color: #fff !important;
        border-color: #10b981 !important;
        background: #10b981 !important;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2) !important;
    }
    .btn-nav-login:hover i {
        transform: scale(1.15) translateX(2px);
        transition: 0.3s;
    }
</style>