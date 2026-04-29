{{-- resources/views/layouts/navigation_desa.blade.php --}}
<nav class="nav-top" :class="{ 'nav-scrolled': scrolled }" x-data="{ mobileMenuOpen: false }">
    <div class="w-full flex justify-between items-center">
        {{-- Logo --}}
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-12 h-12 bg-emerald-950 rounded-2xl flex items-center justify-center text-white shadow-lg rotate-3 group-hover:rotate-0 transition-all duration-500">
                <span class="text-xl font-black">LS</span>
            </div>
            <div class="hidden md:block">
                <span class="text-xl font-serif italic text-emerald-950 leading-tight">Lumban Silintong</span>
            </div>
        </a>

        {{-- Desktop Menu --}}
        <div class="hidden lg:flex items-center gap-8">
            <div class="flex gap-4 text-sm font-medium">
                
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: ADMIN --}}
                {{-- ============================================= --}}
                @auth
                    @if(Auth::user()->role && Auth::user()->role->nama_role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        <a href="{{ route('admin.pengajuan-surat.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Pengajuan Surat</a>
                        <a href="{{ route('admin.penduduk.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Data Penduduk</a>
                        <a href="{{ route('admin.berita.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Berita</a>
                        <a href="{{ route('admin.galeri.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Galeri</a>
                        <a href="{{ route('admin.aspirasi.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Aspirasi</a>
                        <a href="{{ route('admin.umkm.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">UMKM</a>
                        <a href="{{ route('admin.pengurus.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Pengurus</a>
                        <a href="{{ route('admin.statistik.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Statistik</a>
                        <a href="{{ route('admin.keuangan.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">💰 Keuangan</a>
                        <a href="{{ route('admin.profil-desa.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">🏛️ Profil Desa</a>
                        
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: UMKM --}}
                {{-- ============================================= --}}
                    @elseif(Auth::user()->role && Auth::user()->role->nama_role == 'umkm')
                        <a href="{{ route('masyarakat.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        <a href="{{ route('masyarakat.surat.create') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Ajukan Surat</a>
                        <a href="{{ route('masyarakat.surat.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Riwayat Surat</a>
                        <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Aspirasi Saya</a>
                        <a href="{{ route('berita') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Berita</a>
                        <a href="{{ route('galeri') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Galeri</a>
                        <a href="{{ route('umkm') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">UMKM</a>
                        <a href="{{ route('statistik.publik') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Statistik Desa</a>
                        <a href="{{ route('masyarakat.keuangan.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">💰 Keuangan</a>
                        <a href="{{ route('profil-desa') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">🏛️ Profil Desa</a>
                        
                {{-- ============================================= --}}
                {{-- MENU UNTUK ROLE: MASYARAKAT --}}
                {{-- ============================================= --}}
                    @else
                        <a href="{{ route('masyarakat.dashboard') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Dashboard</a>
                        <a href="{{ route('masyarakat.surat.create') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Ajukan Surat</a>
                        <a href="{{ route('masyarakat.surat.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Riwayat Surat</a>
                        <a href="{{ route('masyarakat.aspirasi.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Aspirasi Saya</a>
                        <a href="{{ route('berita') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Berita</a>
                        <a href="{{ route('galeri') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Galeri</a>
                        <a href="{{ route('umkm') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">UMKM</a>
                        <a href="{{ route('statistik.publik') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">Statistik Desa</a>
                        <a href="{{ route('masyarakat.keuangan.index') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">💰 Keuangan</a>
                        <a href="{{ route('profil-desa') }}" class="text-emerald-950/70 hover:text-emerald-600 transition px-3 py-2 rounded-lg hover:bg-emerald-50">🏛️ Profil Desa</a>
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
                            class="absolute top-full right-0 mt-3 w-80 bg-white/95 backdrop-blur-xl rounded-2xl shadow-2xl border border-white/20 overflow-hidden z-50"
                            x-transition:enter="transition-all duration-300 ease-out"
                            x-transition:enter-start="opacity-0 -translate-y-5 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition-all duration-200 ease-in"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 -translate-y-5 scale-95">
                            
                            {{-- Header Profil --}}
                            <div class="bg-gradient-to-r from-sky-500 via-sky-400 to-blue-500 px-5 py-5 text-white">
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
                            <div class="py-2">
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
                                    <a href="{{ route('notifikasi.index') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-regular fa-bell w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">Notifikasi</span>
                                    </a>
                                @elseif(Auth::user()->role->nama_role == 'umkm')
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
                                    <a href="{{ route('umkm.dashboard') }}" class="flex items-center gap-3 px-5 py-3 hover:bg-sky-50 transition-all duration-200 group">
                                        <i class="fa-solid fa-store w-5 text-sky-500 group-hover:scale-110 transition"></i>
                                        <span class="text-gray-700 font-medium">UMKM</span>
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
                    <a href="{{ route('register') }}" class="px-4 py-2 rounded-full bg-emerald-500 text-white text-sm font-medium hover:bg-emerald-600 transition shadow-md">
                        <i class="fa-regular fa-user-plus mr-1"></i> Daftar
                    </a>
                    <a href="{{ route('login') }}" class="px-4 py-2 rounded-full border-2 border-emerald-500 text-emerald-600 text-sm font-medium hover:bg-emerald-50 transition">
                        <i class="fa-solid fa-sign-in-alt mr-1"></i> Masuk
                    </a>
                @endauth
            </div>
        </div>

        {{-- Mobile Menu Button --}}
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
            <i class="fa-solid text-emerald-700" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
        </button>
    </div>

    {{-- Mobile Menu Dropdown - Simpel Minimalis Estetik --}}
<div x-show="mobileMenuOpen" 
     x-collapse 
     class="lg:hidden absolute top-full left-0 right-0 mt-3 mx-4 overflow-hidden z-50"
     x-transition:enter="transition-all duration-300 ease-out"
     x-transition:enter-start="opacity-0 -translate-y-4"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition-all duration-200 ease-in"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-4">
    
    <div class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
        
        <div class="max-h-[70vh] overflow-y-auto">
            
            @auth
                {{-- Header Profil --}}
                <div class="px-5 pt-5 pb-4 border-b border-gray-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center text-white font-bold shadow-md">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-400">
                                @if(Auth::user()->role->nama_role == 'admin') Administrator
                                @elseif(Auth::user()->role->nama_role == 'umkm') Pelaku UMKM
                                @else Warga Desa @endif
                            </p>
                        </div>
                    </div>
                </div>
                
                {{-- Menu Items --}}
                <div class="py-2">
                    @if(Auth::user()->role->nama_role == 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-chart-line w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Dashboard</span>
                        </a>
                        <a href="{{ route('admin.pengajuan-surat.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-envelope w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Pengajuan Surat</span>
                        </a>
                        <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-users w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Data Penduduk</span>
                        </a>
                        <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-newspaper w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Berita</span>
                        </a>
                        <a href="{{ route('admin.galeri.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-photo-film w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Galeri</span>
                        </a>
                        <a href="{{ route('admin.aspirasi.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-comment-dots w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Aspirasi</span>
                        </a>
                        <a href="{{ route('admin.umkm.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-store w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">UMKM</span>
                        </a>
                        <div class="h-px bg-gray-100 my-2 mx-5"></div>
                        <a href="{{ route('admin.statistik.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-chart-simple w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Statistik</span>
                        </a>
                        <a href="{{ route('admin.keuangan.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-coins w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Keuangan</span>
                        </a>
                        <a href="{{ route('admin.profil-desa.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-building w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Profil Desa</span>
                        </a>
                        <a href="{{ route('notifikasi.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-regular fa-bell w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Notifikasi</span>
                        </a>
                    @else
                        <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-chart-line w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Dashboard</span>
                        </a>
                        <a href="{{ route('masyarakat.surat.create') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-file-signature w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Ajukan Surat</span>
                        </a>
                        <a href="{{ route('masyarakat.surat.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-envelope w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Riwayat Surat</span>
                        </a>
                        <a href="{{ route('masyarakat.aspirasi.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-comment-dots w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Aspirasi Saya</span>
                        </a>
                        <div class="h-px bg-gray-100 my-2 mx-5"></div>
                        <a href="{{ route('berita') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-newspaper w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Berita</span>
                        </a>
                        <a href="{{ route('galeri') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-photo-film w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Galeri</span>
                        </a>
                        <a href="{{ route('umkm') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-store w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">UMKM</span>
                        </a>
                        <a href="{{ route('statistik.publik') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-chart-simple w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Statistik Desa</span>
                        </a>
                        <a href="{{ route('masyarakat.keuangan.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-coins w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Keuangan</span>
                        </a>
                        <a href="{{ route('profil-desa') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-solid fa-landmark-dome w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Profil Desa</span>
                        </a>
                        <a href="{{ route('notifikasi.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                            <i class="fa-regular fa-bell w-5 group-hover:scale-110 transition"></i>
                            <span class="text-sm">Notifikasi</span>
                        </a>
                    @endif
                </div>
                
                {{-- Logout Button --}}
                <div class="p-4 border-t border-gray-100">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-red-500 hover:bg-red-600 text-white rounded-xl text-sm font-medium transition-all duration-200">
                            <i class="fa-solid fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </div>
                
            @else
                {{-- Guest Menu --}}
                <div class="p-5 text-center border-b border-gray-100">
                    <i class="fa-regular fa-user text-3xl text-gray-300 mb-2 block"></i>
                    <p class="text-gray-600 text-sm">Selamat Datang</p>
                    <p class="text-gray-400 text-xs mt-1">Silakan login untuk mengakses layanan</p>
                </div>
                
                <div class="py-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                        <i class="fa-solid fa-house w-5 group-hover:scale-110 transition"></i>
                        <span class="text-sm">Beranda</span>
                    </a>
                    <a href="{{ route('profil-desa') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                        <i class="fa-solid fa-landmark-dome w-5 group-hover:scale-110 transition"></i>
                        <span class="text-sm">Profil Desa</span>
                    </a>
                    <a href="{{ route('berita') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                        <i class="fa-solid fa-newspaper w-5 group-hover:scale-110 transition"></i>
                        <span class="text-sm">Berita</span>
                    </a>
                    <a href="{{ route('galeri') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                        <i class="fa-solid fa-photo-film w-5 group-hover:scale-110 transition"></i>
                        <span class="text-sm">Galeri</span>
                    </a>
                    <a href="{{ route('umkm') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                        <i class="fa-solid fa-store w-5 group-hover:scale-110 transition"></i>
                        <span class="text-sm">UMKM</span>
                    </a>
                    <a href="{{ route('kontak') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                        <i class="fa-solid fa-envelope w-5 group-hover:scale-110 transition"></i>
                        <span class="text-sm">Kontak</span>
                    </a>
                    <a href="{{ route('statistik.publik') }}" class="flex items-center gap-3 px-5 py-3 text-gray-600 hover:bg-gray-50 hover:text-emerald-600 transition-all duration-200 group">
                        <i class="fa-solid fa-chart-simple w-5 group-hover:scale-110 transition"></i>
                        <span class="text-sm">Statistik Desa</span>
                    </a>
                </div>
                
                <div class="p-4 border-t border-gray-100 flex gap-3">
                    <a href="{{ route('register') }}" class="flex-1 text-center px-4 py-3 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl text-sm font-medium transition-all duration-200">
                        Daftar
                    </a>
                    <a href="{{ route('login') }}" class="flex-1 text-center px-4 py-3 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-medium transition-all duration-200">
                        Login
                    </a>
                </div>
            @endauth
        </div>
    </div>
</div>
</nav>

<style>
    .nav-top {
        position: fixed; top: 20px; left: 50%; transform: translateX(-50%);
        width: 80%; max-width: 4200px; height: 80px;
        background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.5); border-radius: 50px;
        z-index: 1000; display: flex; align-items: center; padding: 0 40px;
        transition: 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .nav-scrolled { top: 10px; width: 85%; height: 70px; background: rgba(255, 255, 255, 0.98); box-shadow: 0 15px 40px rgba(0,0,0,0.08); }
    [x-cloak] { display: none !important; }
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
</style>