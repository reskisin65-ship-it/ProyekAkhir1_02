<x-app-layout>
    <!-- HERO SLIDER (6 IMAGES - CLICKABLE PREVIEW) -->
    <section class="slider-wrapper">
        <div id="slide-container">
            @php
                $slides = [
                    ['n' => 'Silintong', 'd' => 'Gerbang Digital Desa Botanic Pesisir Danau Toba.', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920'],
                    ['n' => 'Layanan Publik', 'd' => 'Pengurusan Administrasi Mandiri, Cepat, dan Transparan.', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1920'],
                    ['n' => 'Ekonomi Kita', 'd' => 'Dukungan penuh untuk pertumbuhan UMKM Warga.', 'img' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?w=1920'],
                    ['n' => 'Pesona Alam', 'd' => 'Keindahan Warisan Tepi Danau yang Terjaga.', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=1920'],
                    ['n' => 'Warta Desa', 'd' => 'Update informasi dan kegiatan masyarakat terkini.', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1920'],
                    ['n' => 'Aspirasi', 'd' => 'Suarakan pendapat Anda untuk kemajuan desa.', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1920'],
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
        <!-- Slider Navigation -->
        <div class="absolute bottom-20 left-1/2 -translate-x-1/2 flex gap-12 z-50">
            <button id="prev" class="w-24 h-24 bg-white/20 border-2 border-white text-white rounded-full text-4xl backdrop-blur-xl hover:bg-white hover:text-black transition-all">←</button>
            <button id="next" class="w-24 h-24 bg-white/20 border-2 border-white text-white rounded-full text-4xl backdrop-blur-xl hover:bg-white hover:text-black transition-all">→</button>
        </div>
    </section>

    <!-- STATISTIK RAKSASA (PRO VERSION) -->
    <section class="w-full px-[5%] section-gap">
        <div class="bg-white rounded-[8rem] p-32 shadow-2xl flex flex-col xl:flex-row gap-24 items-center border-b-[30px] border-emerald-950">
            <div class="w-full xl:w-2/5">
                <span class="text-emerald-600 font-black uppercase tracking-[1em] text-sm mb-10 block italic">Update Sensus 2025</span>
                <h2 class="text-9xl font-serif italic text-emerald-950 leading-none mb-16">Statistik.</h2>
                <div class="grid grid-cols-1 gap-10">
                    <div class="p-14 bg-emerald-50 rounded-[4rem] flex items-center justify-between border-4 border-white">
                        <div><h4 class="text-8xl font-black text-emerald-950 tracking-tighter">2.847</h4><p class="text-2xl font-bold uppercase text-emerald-600 tracking-widest">JIWA TERDATA</p></div>
                        <div class="text-7xl">👥</div>
                    </div>
                    <div class="p-14 bg-emerald-950 rounded-[4rem] flex items-center justify-between text-white">
                        <div><h4 class="text-8xl font-black tracking-tighter">48</h4><p class="text-2xl font-bold uppercase tracking-widest text-emerald-400">UMKM AKTIF</p></div>
                        <div class="text-7xl">🛍️</div>
                    </div>
                </div>
            </div>
            <div class="w-full xl:w-3/5 h-[800px] bg-slate-50/50 rounded-[6rem] p-12 shadow-inner border border-white">
                <canvas id="villageChartHD"></canvas>
            </div>
        </div>
    </section>

    <!-- GIANT LAYANAN SURAT -->
    <section class="w-full px-[5%] section-gap" data-aos="fade-up">
        <div class="bg-emerald-950 rounded-[8rem] p-48 text-center relative overflow-hidden group shadow-giant">
            <h2 class="text-[12rem] font-serif italic text-emerald-400 leading-none tracking-tighter mb-12">Layanan Surat</h2>
            <p class="text-5xl text-emerald-100/40 italic mb-24">Birokrasi digital mandiri dalam satu genggaman.</p>
            <a href="{{ route('register') }}" class="px-40 py-12 bg-emerald-400 text-emerald-950 font-black text-4xl rounded-full hover:scale-110 transition shadow-2xl">MULAI AJUKAN &rarr;</a>
            <div class="absolute -right-80 -top-80 w-[1200px] h-[1200px] bg-emerald-500/10 rounded-full blur-[250px]"></div>
        </div>
    </section>

    <!-- 5 MODUL LAYANAN (GLASS HD) -->
    <section class="w-full px-[5%] section-gap grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
        @php
            $mods = [
                ['t' => 'Profil Desa', 'i' => '🏢', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=800'],
                ['t' => 'UMKM Desa', 'i' => '🛍️', 'img' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800'],
                ['t' => 'Galeri Wisata', 'i' => '📸', 'img' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800'],
                ['t' => 'Aspirasi', 'i' => '🗣️', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800'],
                ['t' => 'Kontak Admin', 'i' => '📞', 'img' => 'https://images.unsplash.com/photo-1523966211575-eb4a01e7dd51?w=800'],
            ];
        @endphp
        @foreach($mods as $m)
        <div class="glass-module shadow-2xl group cursor-pointer" data-aos="zoom-in">
            <div class="blur-screen flex flex-col items-center justify-center p-8 text-white gap-10">
                <span class="text-8xl">{{ $m['i'] }}</span>
                <h4 class="text-3xl font-black text-center uppercase tracking-tighter">{{ $m['t'] }}</h4>
            </div>
            <img src="{{ $m['img'] }}" class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-[4000ms]">
        </div>
        @endforeach
    </section>

    <!-- SECTION BERITA (GRID KARTU) -->
    <section class="w-full px-[5%] section-gap bg-white py-48 rounded-[12rem]">
        <div class="flex justify-between items-end mb-32 border-b-8 border-emerald-950 pb-10">
            <h2 class="text-9xl font-serif italic text-emerald-950 leading-none">Berita.</h2>
            <a href="#" class="text-3xl font-black text-emerald-600 uppercase border-b-4 border-emerald-400 pb-2 transition-all hover:text-emerald-950">Lihat Semua</a>
        </div>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-16">
            @for($i=1; $i<=3; $i++)
            <div class="group cursor-pointer bg-slate-50 rounded-[6rem] overflow-hidden border-2 border-slate-100 hover:bg-emerald-950 transition duration-1000 shadow-sm hover:shadow-2xl">
                <div class="h-[450px] overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                </div>
                <div class="p-20 group-hover:text-white transition duration-1000">
                    <span class="text-emerald-500 font-black text-xl uppercase tracking-widest">Update • 2026</span>
                    <h4 class="text-6xl font-bold mt-10 leading-tight">Masa Depan Digital Lumban Silintong Dimulai.</h4>
                </div>
            </div>
            @endfor
        </div>
    </section>

    <!-- SECTION PENGUMUMAN (VERTIKAL BERJARAK) -->
    <section class="w-full px-[5%] section-gap pb-60">
        <h2 class="text-9xl font-serif italic text-emerald-950 mb-32 text-center">Pengumuman.</h2>
        <div class="space-y-16">
            @for($i=1; $i<=3; $i++)
            <div class="bg-white/40 backdrop-blur-3xl p-24 rounded-[6rem] border-8 border-white hover:bg-emerald-950 hover:text-white transition duration-1000 group cursor-pointer shadow-xl flex justify-between items-center gap-20" data-aos="fade-up">
                <div class="flex items-center gap-16">
                    <span class="text-8xl opacity-10">🔔</span>
                    <div>
                        <span class="bg-emerald-500 text-white px-10 py-4 bg-emerald-600 rounded-full font-black text-xl uppercase tracking-widest">Penting</span>
                        <h4 class="text-6xl font-bold mt-12 leading-tight">Rapat Kerja Tahunan Musrenbang Desa Lumban Silintong.</h4>
                    </div>
                </div>
                <p class="text-4xl italic opacity-50 font-medium text-right min-w-[350px]">Maret 20, 2026</p>
            </div>
            @endfor
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Slider Logic Clickable Preview
            const wrapper = document.getElementById('slide-container');
            const moveNext = () => { let items = document.querySelectorAll('.item'); wrapper.appendChild(items[0]); }
            const movePrev = () => { let items = document.querySelectorAll('.item'); wrapper.prepend(items[items.length - 1]); }
            document.getElementById('next').onclick = moveNext;
            document.getElementById('prev').onclick = movePrev;
            setInterval(moveNext, 12000);

            document.addEventListener('click', (e) => {
                if(e.target.closest('.item') && e.target.closest('.item') !== document.querySelectorAll('.item')[1]) moveNext();
            });

            // HD Bar Chart Colorful
            const ctx = document.getElementById('villageChartHD').getContext('2d');
            const g = ctx.createLinearGradient(0, 0, 0, 800);
            g.addColorStop(0, '#064e3b'); g.addColorStop(0.5, '#10b981'); g.addColorStop(1, '#a7f3d0');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Warga', 'Pria', 'Wanita', 'Pekerja', 'Lansia', 'KK'],
                    datasets: [{
                        data: [2847, 1380, 1467, 1420, 312, 724],
                        backgroundColor: g,
                        borderRadius: 80, barThickness: 100,
                    }]
                },
                options: {
                    responsive: true, maintainAspectRatio: false,
                    plugins: { legend: { display: false } },
                    scales: {
                        y: { display: false },
                        x: { grid: { display: false }, ticks: { font: { weight: 'black', size: 24 }, color: '#064e3b', padding: 30 } }
                    }
                }
            });
        });
    </script>
</x-app-layout> 