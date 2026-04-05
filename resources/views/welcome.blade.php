<x-app-layout>
    <!-- 1. HERO SLIDER (6 IMAGES - BIG FONT) -->
    <section class="slider-wrapper">
        <div id="slide-container">
            @php
                $slides = [
                    ['n' => 'Ekonomi Kita', 'd' => 'Dukungan penuh untuk pertumbuhan UMKM Warga.', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920'],
                    ['n' => 'Silintong', 'd' => 'Gerbang Digital Desa Botanic Pesisir Danau Toba.', 'img' => 'https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=1920'],
                    ['n' => 'Administrasi', 'd' => 'Layanan Publik Cepat, Mandiri, dan Transparan.', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1920'],
                    ['n' => 'Wisata Toba', 'd' => 'Keindahan Warisan Alam Nusantara.', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=1920'],
                    ['n' => 'Warta Digital', 'd' => 'Update informasi kegiatan masyarakat desa.', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1920'],
                    ['n' => 'Aspirasi Warga', 'd' => 'Suarakan pendapat Anda untuk pembangunan desa.', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1920'],
                ];
            @endphp
            @foreach($slides as $s)
            <div class="item shadow-giant" style="background-image: url('{{ $s['img'] }}');">
                <div class="slide-content">
                    <div class="name">{{ $s['n'] }}</div>
                    <div class="des">{{ $s['d'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="absolute bottom-20 left-1/2 -translate-x-1/2 flex gap-12 z-50">
            <button id="prev" class="w-24 h-24 bg-white/20 border-4 border-white text-white rounded-full text-5xl backdrop-blur-xl">←</button>
            <button id="next" class="w-24 h-24 bg-white/20 border-4 border-white text-white rounded-full text-5xl backdrop-blur-xl">→</button>
        </div>
    </section>

    <!-- 2. GIANT STATISTIK HD -->
    <section class="w-full px-[5%] py-40">
        <div class="bg-white rounded-[10rem] p-32 shadow-giant flex flex-col xl:flex-row gap-32 items-center border-b-[40px] border-emerald-950">
            <div class="w-full xl:w-2/5" data-aos="fade-right">
                <h2 class="text-[12rem] font-serif italic text-emerald-950 leading-none mb-16">Statistik.</h2>
                <div class="p-20 bg-emerald-50 rounded-[5rem] flex items-center justify-between border-8 border-white shadow-2xl">
                    <div><h4 class="text-[9rem] font-black text-emerald-950 leading-none tracking-tighter">2.8k</h4><p class="text-3xl font-black uppercase text-emerald-600 tracking-widest mt-6">Jiwa Terdaftar</p></div>
                </div>
            </div>
            <div class="w-full xl:w-3/5 h-[800px] relative p-12 bg-slate-50/50 rounded-[8rem] border-4 border-white shadow-inner">
                <canvas id="villageChartHD"></canvas>
            </div>
        </div>
    </section>

    <!-- 3. MODUL LAYANAN (GLASS ZOOM ORIGINAL) -->
    <section class="w-full px-[5%] section-gap grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-10">
        @php
            $mods = [
                ['t' => 'Profil', 'i' => '🏢', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=800'],
                ['t' => 'UMKM', 'i' => '🛍️', 'img' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=800'],
                ['t' => 'Galeri', 'i' => '📸', 'img' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=800'],
                ['t' => 'Aspirasi', 'i' => '🗣️', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=800'],
                ['t' => 'Kontak', 'i' => '📞', 'img' => 'https://images.unsplash.com/photo-1523966211575-eb4a01e7dd51?w=800'],
            ];
        @endphp
        @foreach($mods as $m)
        <div class="glass-module shadow-2xl group cursor-pointer h-[700px]">
            <div class="blur-screen flex flex-col items-center justify-center p-8 text-white gap-10">
                <span class="text-[12rem]">{{ $m['i'] }}</span>
                <h4 class="text-5xl font-black text-center uppercase tracking-tighter">{{ $m['t'] }}</h4>
            </div>
            <img src="{{ $m['img'] }}" class="w-full h-full object-cover">
        </div>
        @endforeach
    </section>

    <!-- 4. BERITA & PENGUMUMAN (RAPI SEPARATED) -->
    <section class="w-full px-[5%] section-gap bg-white py-60 rounded-[15rem]">
        <h2 class="text-[12rem] font-serif italic text-emerald-950 border-b-[20px] border-emerald-900 pb-12 mb-40 inline-block leading-none">Berita.</h2>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-24 mb-60">
            @for($i=1; $i<=3; $i++)
            <div class="group cursor-pointer bg-slate-50 rounded-[7rem] overflow-hidden border-2 border-slate-100 hover:bg-emerald-950 transition duration-1000 shadow-sm">
                <div class="h-[500px] overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                </div>
                <div class="p-24 group-hover:text-white transition duration-1000">
                    <span class="text-emerald-500 font-black text-3xl uppercase tracking-widest italic">Update Desa</span>
                    <h4 class="text-7xl font-bold mt-10 leading-tight">Digitalisasi Desa Lumban Silintong Dimulai.</h4>
                </div>
            </div>
            @endfor
        </div>

        <h2 class="text-[12rem] font-serif italic text-emerald-950 mb-40 text-center mt-60" data-aos="fade-up">Pengumuman.</h2>
        <div class="space-y-24">
            @for($i=1; $i<=3; $i++)
            <div class="bg-white/40 backdrop-blur-3xl p-32 rounded-[7rem] border-8 border-white hover:bg-emerald-950 hover:text-white transition duration-1000 group cursor-pointer shadow-giant flex justify-between items-center">
                <div class="flex items-center gap-20">
                    <span class="text-[10rem] opacity-20 group-hover:opacity-100 transition duration-700">🔔</span>
                    <div>
                        <span class="bg-emerald-500 text-white px-10 py-4 bg-emerald-600 rounded-full font-black text-2xl uppercase italic">Resmi</span>
                        <h4 class="text-7xl font-bold mt-12 leading-tight uppercase tracking-tighter">Musrenbang TA 2026.</h4>
                    </div>
                </div>
                <p class="text-5xl italic opacity-50 font-medium text-right min-w-[400px]">20 Maret</p>
            </div>
            @endfor
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Slider Logic with Clickable Preview
            const container = document.getElementById('slide-container');
            const moveNext = () => { let items = document.querySelectorAll('.item'); container.appendChild(items[0]); }
            document.getElementById('next').onclick = moveNext;
            document.getElementById('prev').onclick = () => { container.prepend(document.querySelectorAll('.item')[5]); }
            setInterval(moveNext, 12000);

            document.addEventListener('click', (e) => {
                const clicked = e.target.closest('.item');
                if(clicked && clicked !== document.querySelectorAll('.item')[1]) moveNext();
            });

            // HD Bar Chart Colorful
            const ctx = document.getElementById('villageChartHD').getContext('2d');
            const g = ctx.createLinearGradient(0, 0, 0, 900);
            g.addColorStop(0, '#064e3b'); g.addColorStop(0.5, '#10b981'); g.addColorStop(1, '#a7f3d0');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jiwa', 'Pria', 'Wanita', 'Pekerja', 'Lansia', 'KK'],
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
                        x: { grid: { display: false }, ticks: { font: { weight: 'black', size: 32 }, color: '#064e3b', padding: 50 } }
                    }
                }
            });
        });
    </script>
</x-app-layout>