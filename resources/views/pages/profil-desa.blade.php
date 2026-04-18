{{-- resources/views/pages/profil-desa.blade.php --}}
@extends('layouts.app')

@section('title', 'Profil Desa Lumban Silintong')

@section('content')
{{-- HERO SECTION dengan Parallax Effect --}}
<section class="relative h-[60vh] min-h-[500px] overflow-hidden">
    <div class="absolute inset-0 parallax-bg">
        @if(isset($profil) && $profil && $profil->foto_kantor)
            <img src="{{ $profil->foto_kantor }}" class="w-full h-full object-cover">
        @else
            <img src="https://images.unsplash.com/photo-1582407947304-fd86f028f716?w=1600" class="w-full h-full object-cover">
        @endif
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-950/90 via-emerald-900/70 to-emerald-800/50"></div>
    </div>
    <div class="absolute inset-0 flex items-center justify-center text-center">
        <div class="max-w-4xl mx-auto px-4" data-aos="fade-up" data-aos-duration="1000">
            <div class="inline-block px-4 py-1.5 bg-white/20 backdrop-blur-md rounded-full text-white text-xs font-bold uppercase tracking-wider mb-5 border border-white/30">
                <i class="fa-regular fa-building mr-2"></i> Profil Desa
            </div>
            <h1 class="text-5xl md:text-7xl font-serif italic text-white mb-5 leading-tight">Lumban Silintong</h1>
            <div class="w-24 h-1 bg-emerald-400 mx-auto rounded-full"></div>
            <p class="text-white/80 text-lg md:text-xl mt-6 max-w-2xl mx-auto">Desa Digital yang Modern, Transparan, dan Berbudaya</p>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 right-0">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 120" class="w-full">
            <path fill="#fafaf8" fill-opacity="1" d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

{{-- ============================================= --}}
{{-- BREADCRUMB --}}
{{-- ============================================= --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8">
    <div class="flex items-center gap-2 text-sm text-gray-500">
        <a href="{{ route('home') }}" class="hover:text-emerald-600 transition"><i class="fa-solid fa-house mr-1"></i> Beranda</a>
        <i class="fa-solid fa-chevron-right text-xs text-gray-400"></i>
        <span class="text-emerald-600 font-medium">Profil Desa</span>
    </div>
</div>

{{-- ============================================= --}}
{{-- MAIN CONTENT DENGAN SIDEBAR MENU --}}
{{-- ============================================= --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="grid lg:grid-cols-4 gap-8">
        
        {{-- SIDEBAR MENU KIRI (Sticky) --}}
        <div class="lg:col-span-1">
            <div class="sticky top-24 bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-5 py-4">
                    <h3 class="text-white font-bold flex items-center gap-2">
                        <i class="fa-regular fa-compass"></i> Menu Navigasi
                    </h3>
                </div>
                <div class="p-3 space-y-1">
                    <a href="#sejarah" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-clock text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Sejarah Desa</span>
                    </a>
                    <a href="#visi-misi" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-compass text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Visi & Misi</span>
                    </a>
                    <a href="#struktur" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-users text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Struktur Organisasi</span>
                    </a>
                    <a href="#wilayah" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-map text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Wilayah & Peta</span>
                    </a>
                    <a href="#statistik" class="menu-link flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 transition-all duration-300 group">
                        <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center group-hover:bg-emerald-500 transition">
                            <i class="fa-regular fa-chart-line text-emerald-600 group-hover:text-white text-sm"></i>
                        </div>
                        <span class="font-medium">Statistik Desa</span>
                    </a>
                </div>
            </div>
        </div>

        {{-- KONTEN UTAMA --}}
        <div class="lg:col-span-3 space-y-12">
            
            {{-- SEJARAH DESA --}}
            <section id="sejarah" class="scroll-mt-24 bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100" data-aos="fade-up">
                <div class="relative h-64 overflow-hidden">
                    @if(isset($profil) && $profil && $profil->foto_kegiatan)
                        <img src="{{ $profil->foto_kegiatan }}" class="w-full h-full object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1200" class="w-full h-full object-cover">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/70 to-transparent flex items-center">
                        <div class="px-8">
                            <span class="inline-block px-3 py-1 bg-white/20 backdrop-blur rounded-full text-white text-xs font-bold mb-3">📜 Tradisi & Sejarah</span>
                            <h2 class="text-3xl md:text-4xl font-serif italic text-white">Sejarah Desa</h2>
                        </div>
                    </div>
                </div>
                <div class="p-8">
                    @if(isset($profil) && $profil && $profil->sejarah)
                        <p class="text-gray-600 leading-loose mb-5">{{ $profil->sejarah }}</p>
                        <div class="mt-6 grid grid-cols-3 gap-4 pt-4 border-t border-gray-100">
                            <div class="text-center">
                                <p class="text-2xl font-bold text-emerald-700">{{ $stat_tahun_berdiri ?? '-' }}</p>
                                <p class="text-xs text-gray-400">Tahun Berdiri</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-emerald-700">{{ $stat_penduduk ?? '-' }}</p>
                                <p class="text-xs text-gray-400">Total Penduduk</p>
                            </div>
                            <div class="text-center">
                                <p class="text-2xl font-bold text-emerald-700">{{ $stat_dusun ?? '-' }}</p>
                                <p class="text-xs text-gray-400">Jumlah Dusun</p>
                            </div>
                        </div>
                    @else
                        <div class="empty-state py-16 text-center">
                            <i class="fa-regular fa-clock text-5xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-serif italic text-gray-400">Sejarah Desa Belum Tersedia</h3>
                            <p class="text-sm text-gray-400 mt-2">Informasi sejarah desa akan segera diupdate oleh admin.</p>
                        </div>
                    @endif
                </div>
            </section>

            {{-- VISI & MISI --}}
            <section id="visi-misi" class="scroll-mt-24" data-aos="fade-up" data-aos-delay="100">
                @if((isset($profil) && $profil && $profil->visi) || (isset($profil) && $profil && $profil->misi))
                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Visi Card --}}
                        @if(isset($profil) && $profil && $profil->visi)
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-2xl p-8 shadow-xl text-white transform hover:scale-105 transition duration-500">
                            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mb-5 backdrop-blur">
                                <i class="fa-solid fa-eye text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-serif italic mb-4">Visi</h3>
                            <p class="text-emerald-100 leading-relaxed italic">"{{ $profil->visi }}"</p>
                            <div class="mt-6 w-16 h-0.5 bg-white/30 rounded-full"></div>
                        </div>
                        @endif

                        {{-- Misi Card --}}
                        @if(isset($profil) && $profil && $profil->misi)
                        <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100 transform hover:scale-105 transition duration-500">
                            <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center mb-5 shadow-lg">
                                <i class="fa-solid fa-flag-checkered text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-serif italic text-emerald-800 mb-4">Misi</h3>
                            <ul class="space-y-3">
                                @foreach(explode("\n", $profil->misi) as $misi)
                                    @if(trim($misi))
                                    <li class="flex items-start gap-3">
                                        <i class="fa-solid fa-check-circle text-emerald-500 mt-1 text-sm"></i>
                                        <span class="text-gray-600 text-sm">{{ trim($misi) }}</span>
                                    </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                @else
                    <div class="empty-state py-16 text-center bg-white rounded-2xl shadow-sm">
                        <i class="fa-regular fa-compass text-5xl text-gray-300 mb-4"></i>
                        <h3 class="text-xl font-serif italic text-gray-400">Visi & Misi Belum Tersedia</h3>
                        <p class="text-sm text-gray-400 mt-2">Visi dan misi desa akan segera diupdate oleh admin.</p>
                    </div>
                @endif
            </section>

            {{-- STRUKTUR ORGANISASI --}}
            <section id="struktur" class="scroll-mt-24" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-6 border-b border-gray-100">
                        <h2 class="text-2xl font-serif italic text-emerald-800 flex items-center gap-2">
                            <i class="fa-solid fa-users text-emerald-500"></i> Struktur Organisasi
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">Perangkat Desa Lumban Silintong</p>
                    </div>
                    <div class="p-8">
                        @if(isset($aparaturs) && count($aparaturs) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
                                @foreach($aparaturs as $index => $a)
                                <div class="text-center group cursor-pointer">
                                    <div class="relative">
                                        <div class="w-28 h-28 mx-auto rounded-full overflow-hidden shadow-lg group-hover:shadow-xl transition-all duration-300">
                                            <img src="{{ $a->foto }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-500" onerror="this.src='https://randomuser.me/api/portraits/lego/{{ $index+1 }}.jpg'">
                                        </div>
                                        @if($index == 0)
                                        <div class="absolute -bottom-2 left-1/2 -translate-x-1/2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center shadow-md">
                                            <i class="fa-solid fa-crown text-white text-xs"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <h4 class="font-bold text-emerald-800 mt-4">{{ $a->nama }}</h4>
                                    <p class="text-[10px] font-black uppercase text-emerald-500 tracking-wider">{{ $a->jabatan }}</p>
                                </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state py-16 text-center">
                                <i class="fa-solid fa-users-slash text-5xl text-gray-300 mb-4"></i>
                                <h3 class="text-xl font-serif italic text-gray-400">Struktur Organisasi Belum Tersedia</h3>
                                <p class="text-sm text-gray-400 mt-2">Data perangkat desa akan segera diupdate oleh admin.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </section>

            {{-- WILAYAH & PETA --}}
            <section id="wilayah" class="scroll-mt-24" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-100">
                    <div class="bg-gradient-to-r from-emerald-50 to-white px-8 py-6 border-b border-gray-100">
                        <h2 class="text-2xl font-serif italic text-emerald-800 flex items-center gap-2">
                            <i class="fa-solid fa-map text-emerald-500"></i> Wilayah & Peta
                        </h2>
                        <p class="text-gray-500 text-sm mt-1">Lokasi geografis Desa Lumban Silintong</p>
                    </div>
                    <div class="p-8">
                        <div class="rounded-xl overflow-hidden shadow-lg h-96">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.668102377317!2d99.0435942!3d2.332309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04306443c683%3A0x868a8600868a86!2sLumban%20Silintong!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                        </div>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-6">
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl">
                                <i class="fa-solid fa-location-dot text-emerald-500 text-xl"></i>
                                <div>
                                    <p class="text-[10px] text-gray-400">Kecamatan</p>
                                    <p class="font-semibold text-emerald-800 text-sm">Balige</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl">
                                <i class="fa-solid fa-building text-emerald-500 text-xl"></i>
                                <div>
                                    <p class="text-[10px] text-gray-400">Kabupaten</p>
                                    <p class="font-semibold text-emerald-800 text-sm">Toba</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl">
                                <i class="fa-solid fa-flag text-emerald-500 text-xl"></i>
                                <div>
                                    <p class="text-[10px] text-gray-400">Provinsi</p>
                                    <p class="font-semibold text-emerald-800 text-sm">Sumatera Utara</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-3 bg-emerald-50 rounded-xl">
                                <i class="fa-solid fa-water text-emerald-500 text-xl"></i>
                                <div>
                                    <p class="text-[10px] text-gray-400">Luas Wilayah</p>
                                    <p class="font-semibold text-emerald-800 text-sm">{{ $stat_luas ?? '12.5' }} km²</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{-- STATISTIK DESA --}}
            <section id="statistik" class="scroll-mt-24" data-aos="fade-up" data-aos-delay="400">
                <div class="bg-gradient-to-br from-emerald-900 to-emerald-800 rounded-2xl p-8 shadow-xl text-white">
                    <div class="text-center mb-8">
                        <h2 class="text-2xl font-serif italic">📊 Statistik Desa</h2>
                        <div class="w-16 h-0.5 bg-emerald-400 mx-auto mt-3 rounded-full"></div>
                        <p class="text-emerald-200 text-sm mt-3">Data kependudukan terkini Desa Lumban Silintong</p>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        <div class="text-center p-4 bg-white/10 rounded-2xl backdrop-blur hover:bg-white/20 transition">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-users text-white text-xl"></i>
                            </div>
                            <p class="text-3xl font-bold">{{ $stat_penduduk ?? '-' }}</p>
                            <p class="text-xs text-emerald-200 mt-1">Total Penduduk</p>
                        </div>
                        <div class="text-center p-4 bg-white/10 rounded-2xl backdrop-blur hover:bg-white/20 transition">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-house-user text-white text-xl"></i>
                            </div>
                            <p class="text-3xl font-bold">{{ $stat_kk ?? '-' }}</p>
                            <p class="text-xs text-emerald-200 mt-1">Kepala Keluarga</p>
                        </div>
                        <div class="text-center p-4 bg-white/10 rounded-2xl backdrop-blur hover:bg-white/20 transition">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-store text-white text-xl"></i>
                            </div>
                            <p class="text-3xl font-bold">{{ $stat_umkm_count ?? '-' }}</p>
                            <p class="text-xs text-emerald-200 mt-1">UMKM Aktif</p>
                        </div>
                        <div class="text-center p-4 bg-white/10 rounded-2xl backdrop-blur hover:bg-white/20 transition">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mx-auto mb-3">
                                <i class="fa-solid fa-chart-line text-white text-xl"></i>
                            </div>
                            <p class="text-3xl font-bold">{{ $stat_dusun ?? '-' }}</p>
                            <p class="text-xs text-emerald-200 mt-1">Jumlah Dusun</p>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>

<style>
    .parallax-bg {
        transform: translateZ(0);
        will-change: transform;
    }
    .menu-link.active {
        background-color: #ecfdf5;
        color: #064e3b;
        font-weight: 600;
    }
    .menu-link.active .w-8 {
        background-color: #10b981;
    }
    .menu-link.active .w-8 i {
        color: white;
    }
    .empty-state {
        background: #fcfcfc;
        border: 2px dashed #e2e8f0;
        border-radius: 24px;
    }
    html {
        scroll-behavior: smooth;
    }
</style>

<script>
    // Smooth scroll dan active menu
    document.querySelectorAll('.menu-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const target = document.querySelector(targetId);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Update active menu saat scroll
    window.addEventListener('scroll', function() {
        const sections = ['sejarah', 'visi-misi', 'struktur', 'wilayah', 'statistik'];
        let current = '';
        for (let section of sections) {
            const element = document.getElementById(section);
            if (element) {
                const rect = element.getBoundingClientRect();
                if (rect.top <= 200 && rect.bottom >= 200) {
                    current = section;
                    break;
                }
            }
        }
        if (current) {
            document.querySelectorAll('.menu-link').forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + current) {
                    link.classList.add('active');
                }
            });
        }
    });
</script>
@endsection
