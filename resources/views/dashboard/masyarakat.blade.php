<x-app-layout>
    <!-- 1. HERO CINEMATIC SLIDER (TOP) -->
    <section class="slider-wrapper !mt-[-180px]">
        <div id="slide-container">
            @php
                $slides = [
                    ['n' => 'Lumban Silintong', 'd' => 'Gerbang Digital Desa Botanic Pesisir Danau Toba.', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920'],
                    ['n' => 'Administrasi', 'd' => 'Layanan Publik Cepat, Mandiri, dan Transparan.', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1920'],
                    ['n' => 'Ekonomi Kita', 'd' => 'Dukungan penuh untuk pertumbuhan UMKM Warga.', 'img' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?w=1920'],
                    ['n' => 'Wisata Toba', 'd' => 'Keindahan Warisan Alam yang Terjaga Kelestariannya.', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=1920'],
                    ['n' => 'Warta Digital', 'd' => 'Update informasi dan kegiatan masyarakat desa.', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1920'],
                    ['n' => 'Aspirasi Warga', 'd' => 'Suarakan pendapat Anda untuk pembangunan desa.', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1920'],
                ];
            @endphp
            @foreach($slides as $s)
            <div class="item shadow-2xl" style="background-image: url('{{ $s['img'] }}');">
                <div class="slide-content">
                    <div class="name">{{ $s['n'] }}</div>
                    <div class="des">{{ $s['d'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="absolute bottom-20 left-1/2 -translate-x-1/2 flex gap-12 z-50">
            <button id="prev" class="w-28 h-28 bg-white/20 border-4 border-white text-white rounded-full text-5xl backdrop-blur-xl hover:bg-white hover:text-black transition-all">←</button>
            <button id="next" class="w-28 h-28 bg-white/20 border-4 border-white text-white rounded-full text-5xl backdrop-blur-xl hover:bg-white hover:text-black transition-all">→</button>
        </div>
    </section>

    <!-- 2. GIANT STATISTIK -->
    <section class="w-full px-[5%] section-gap" data-aos="fade-up">
        <div class="bg-white rounded-[8rem] p-32 md:p-48 shadow-giant flex flex-col xl:flex-row gap-32 items-center border-b-[40px] border-emerald-950">
            <div class="w-full xl:w-2/5 text-center xl:text-left">
                <span class="text-emerald-600 font-black uppercase tracking-[1.2em] text-2xl mb-12 block italic">Sensus Real-time 2026</span>
                <h2 class="text-[15rem] font-serif italic text-emerald-950 leading-none tracking-tighter">Statistik.</h2>
                <div class="grid grid-cols-1 gap-12 mt-20">
                    <div class="p-20 bg-emerald-50 rounded-[6rem] text-center border-8 border-white shadow-2xl hover:bg-emerald-950 hover:text-white transition duration-500 group">
                        <h4 class="text-[10rem] font-black tracking-tighter leading-none">{{ $about->jumlah_penduduk ?? '2.8k' }}</h4>
                        <p class="text-3xl font-black uppercase tracking-[0.4em] mt-6 group-hover:text-emerald-400 transition">Jiwa Terdaftar</p>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-3/5 h-[1000px] relative p-12 bg-slate-50/50 rounded-[8rem] border-4 border-white shadow-inner">
                <canvas id="villageChartProHD"></canvas>
            </div>
        </div>
    </section>

    <!-- 3. PANEL UTAMA MASYARAKAT (PANJANG SETARA STATISTIK) -->
    <section class="w-full px-[5%] mt-40" data-aos="zoom-in">
        <div class="bg-emerald-900 rounded-[10rem] p-32 md:p-40 shadow-giant relative overflow-hidden">
            <div class="relative z-20">
                <!-- Greeting & Avatar -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-32 gap-12">
                    <div class="text-center md:text-left">
                        <span class="text-emerald-300 font-black uppercase tracking-[0.6em] text-2xl italic">Selamat Datang Kembali,</span>
                        <h1 class="text-[14rem] font-serif italic text-white leading-none mt-8">{{ Auth::user()->name }}</h1>
                        <p class="text-5xl text-emerald-100/40 mt-10 font-medium tracking-tight uppercase">NIK: {{ Auth::user()->penduduk->nik ?? '123456789012' }}</p>
                    </div>
                    <div class="w-72 h-72 rounded-[4rem] bg-white/10 backdrop-blur-3xl border-[12px] border-emerald-500/30 shadow-giant overflow-hidden">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=10b981&color=fff&size=300" class="w-full h-full object-cover">
                    </div>
                </div>

                <!-- Konten Surat (Full Width Grid) -->
                <div class="grid grid-cols-1 xl:grid-cols-2 gap-20">
                    <!-- Tombol Ajukan -->
                    <a href="{{ route('masyarakat.surat.create') }}" class="block p-28 bg-emerald-400 rounded-[7rem] text-emerald-950 hover:scale-105 transition-all duration-700 shadow-giant group">
                        <h2 class="text-9xl font-serif italic font-bold leading-none">Ajukan <br>Surat &rarr;</h2>
                        <p class="text-3xl mt-10 font-medium opacity-60">Mulai permohonan dokumen administrasi baru.</p>
                    </a>

                    <!-- Card Status Terakhir (Besar) -->
                    <div class="bg-white/5 backdrop-blur-xl rounded-[7rem] p-24 border-4 border-emerald-500/20 flex flex-col justify-center text-center relative overflow-hidden group">
                        <h3 class="text-6xl font-serif italic text-emerald-300 mb-12">Status Surat Terakhir</h3>
                        
                        @if($recentSurats->count() > 0)
                            <div class="inline-block px-16 py-8 bg-white text-emerald-950 rounded-full text-4xl font-black uppercase tracking-[0.2em] shadow-giant mb-10">
                                {{ $recentSurats->first()->status }}
                            </div>
                            <p class="text-4xl text-white font-light italic leading-relaxed mb-12">"{{ $recentSurats->first()->jenis_surat }}"</p>
                            
                            <!-- Link Klik Kelola Semua Surat -->
                            <a href="{{ route('masyarakat.surat.index') }}" class="mt-8 text-3xl font-black text-emerald-400 border-b-4 border-emerald-400 inline-block hover:text-white hover:border-white transition-all">
                                Kelola Semua Surat &rarr;
                            </a>
                        @else
                            <p class="text-4xl text-white/30 italic">Belum ada riwayat pengajuan.</p>
                        @endif
                        <span class="absolute -right-10 -bottom-10 text-[25rem] opacity-5 pointer-events-none">📑</span>
                    </div>
                </div>
            </div>
            <!-- Glow background -->
            <div class="absolute -left-[30rem] -top-[30rem] w-[1200px] h-[1200px] bg-emerald-500/10 rounded-full blur-[250px]"></div>
        </div>
    </section>

    <!-- 4. PANEL ASPIRASI (TERPISAH & PANJANG) -->
    <section class="w-full px-[5%] mt-20" data-aos="fade-up">
        <div class="bg-white/40 backdrop-blur-3xl rounded-[8rem] p-32 border-8 border-white shadow-giant flex flex-col md:flex-row justify-between items-center group cursor-pointer hover:bg-white transition-all duration-1000">
            <div class="flex items-center gap-16">
                <span class="text-[12rem] group-hover:scale-110 transition duration-700">🗣️</span>
                <div>
                    <h2 class="text-9xl font-serif italic text-emerald-950 leading-none">Aspirasi Warga</h2>
                    <p class="text-4xl text-slate-400 mt-6 font-light">Sampaikan saran atau pengaduan pembangunan desa secara langsung.</p>
                </div>
            </div>
            <a href="#" class="px-24 py-10 bg-emerald-950 text-white font-black text-3xl rounded-full hover:bg-emerald-600 transition-all shadow-giant">KIRIM PESAN</a>
        </div>
    </section>

    <!-- 5. MODUL DESA (5 LAYANAN) -->
    <section class="w-full px-[5%] section-gap grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
        @php
            $mods = [
                ['t' => 'Profil', 'i' => '🏢', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=800'],
                ['t' => 'UMKM', 'i' => '🛍️', 'img' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800'],
                ['t' => 'Galeri', 'i' => '📸', 'img' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800'],
                ['t' => 'Warta', 'i' => '📰', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800'],
                ['t' => 'Kontak', 'i' => '📞', 'img' => 'https://images.unsplash.com/photo-1523966211575-eb4a01e7dd51?w=800'],
            ];
        @endphp
        @foreach($mods as $m)
        <div class="glass-module shadow-2xl group cursor-pointer h-[650px]">
            <div class="blur-screen flex flex-col items-center justify-center p-8 text-white gap-10">
                <span class="text-8xl">{{ $m['i'] }}</span>
                <h4 class="text-4xl font-black text-center uppercase tracking-tighter leading-tight">{{ $m['t'] }}</h4>
            </div>
            <img src="{{ $m['img'] }}" class="w-full h-full object-cover">
        </div>
        @endforeach
    </section>

    <!-- 6. SECTION BERITA -->
    <section class="w-full px-[5%] section-gap bg-white py-60 rounded-[15rem]">
        <div class="flex justify-between items-end mb-40 border-b-[20px] border-emerald-950 pb-12">
            <h2 class="text-[12rem] font-serif italic text-emerald-950 leading-none">Berita.</h2>
            <a href="#" class="text-4xl font-black uppercase text-emerald-600 border-b-8 border-emerald-400 pb-4 transition-all hover:text-emerald-950">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-24">
            @forelse($beritas as $b)
            <div class="group cursor-pointer bg-slate-50 rounded-[7rem] overflow-hidden border-2 border-slate-100 hover:bg-emerald-950 transition duration-1000 shadow-giant">
                <div class="h-[550px] overflow-hidden relative">
                    <img src="{{ asset('storage/' . $b->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-[2000ms]">
                </div>
                <div class="p-24 group-hover:text-white transition duration-1000">
                    <span class="text-emerald-500 font-black text-3xl uppercase tracking-[0.4em]">{{ $b->kategori }}</span>
                    <h4 class="text-7xl font-bold mt-12 leading-[1.1]">{{ $b->judul }}</h4>
                </div>
            </div>
            @empty
                <p class="text-5xl text-gray-300 italic">Belum ada berita.</p>
            @endforelse
        </div>
    </section>

    <!-- 7. SECTION PENGUMUMAN -->
    <section class="w-full px-[5%] section-gap pb-60">
        <h2 class="text-[12rem] font-serif italic text-emerald-950 mb-40 text-center">Pengumuman.</h2>
        <div class="grid grid-cols-1 gap-20">
            @foreach($beritas->where('kategori', 'Pengumuman') as $p)
            <div class="bg-white/40 backdrop-blur-3xl p-32 rounded-[7rem] border-8 border-white hover:bg-emerald-950 hover:text-white transition duration-1000 group cursor-pointer shadow-2xl flex justify-between items-center" data-aos="fade-up">
                <div class="flex items-center gap-20">
                    <span class="text-9xl opacity-20">🔔</span>
                    <div>
                        <span class="bg-emerald-500 text-white px-12 py-5 bg-emerald-600 rounded-full font-black text-2xl uppercase tracking-widest">Resmi</span>
                        <h4 class="text-7xl font-bold mt-12 leading-tight uppercase">{{ $p->judul }}</h4>
                    </div>
                </div>
                <p class="text-5xl italic opacity-50 font-medium text-right min-w-[450px]">{{ $p->created_at->format('d/m/Y') }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Slider Logic Cinematic Smooth
            const container = document.getElementById('slide-container');
            const moveNext = () => { let items = document.querySelectorAll('.item'); container.appendChild(items[0]); }
            const movePrev = () => { let items = document.querySelectorAll('.item'); wrapper.prepend(items[items.length - 1]); }
            document.getElementById('next').onclick = moveNext;
            document.getElementById('prev').onclick = movePrev;
            setInterval(moveNext, 12000);

            // Click Preview
            document.addEventListener('click', (e) => {
                if(e.target.closest('.item') && e.target.closest('.item') !== document.querySelectorAll('.item')[1]) moveNext();
            });

            // HD Bar Chart
            const ctx = document.getElementById('villageChartProHD').getContext('2d');
            const g = ctx.createLinearGradient(0, 0, 0, 900);
            g.addColorStop(0, '#064e3b'); g.addColorStop(0.5, '#10b981'); g.addColorStop(1, '#a7f3d0');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Warga', 'Pria', 'Wanita', 'Pekerja', 'Lansia', 'KK'],
                    datasets: [{
                        data: [2847, 1380, 1467, 1420, 312, 724],
                        backgroundColor: g,
                        borderRadius: 100, barThickness: 130,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { display: false },
                        x: { 
                            grid: { display: false },
                            ticks: { font: { weight: 'black', size: 36 }, color: '#064e3b', padding: 50 }
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>