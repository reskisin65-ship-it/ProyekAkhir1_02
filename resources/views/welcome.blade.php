<x-app-layout>
    <style>
        /* Gambar 1: Slider Typography */
        .slide-content { position: absolute; top: 40%; left: 8%; width: 55%; color: white; display: none; z-index: 20; }
        .item:nth-child(2) .slide-content { display: block; }
        .slide-content .name { font-size: 13rem; font-family: 'Playfair Display'; font-style: italic; font-weight: 800; line-height: 0.85; animation: slideUp 1s forwards; }
        .slide-content .des { font-size: 3rem; margin-top: 40px; font-weight: 300; animation: slideUp 1s 0.2s forwards; opacity: 0; }
        @keyframes slideUp { from { opacity: 0; transform: translateY(80px); } to { opacity: 1; transform: translateY(0); } }

        /* ML1: Modul Layanan original glass effect */
        .glass-module { position: relative; border-radius: 6rem; overflow: hidden; border: 4px solid rgba(255, 255, 255, 0.6); height: 750px; background: rgba(255, 255, 255, 0.1); }
        .blur-screen { position: absolute; inset: 0; backdrop-filter: blur(45px); z-index: 10; transition: 1.2s cubic-bezier(0.4, 0, 0.2, 1); }
        .glass-module:hover .blur-screen { backdrop-filter: blur(0px); background: rgba(0,0,0,0.3); }
        .glass-module:hover img { transform: scale(1.15); transition: 1.5s ease; }

        /* Efek Gembok untuk Guest */
        .lock-overlay {
            position: absolute; top: 30px; right: 30px;
            width: 80px; height: 80px; background: rgba(0,0,0,0.5);
            backdrop-filter: blur(10px); border-radius: 20px;
            display: flex; align-items: center; justify-content: center;
            color: #fbbf24; font-size: 30px; z-index: 30;
        }
    </style>

    <!-- 1. GAMBAR 1: CINEMATIC PERSPECTIVE SLIDER -->
    <section class="slider-wrapper !mt-[-180px]">
        <div id="slide-container">
            @php
                $slides = [
                    ['n' => 'Silintong', 'd' => 'Gerbang Digital Desa Botanic Pesisir Danau Toba.', 'img' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920'],
                    ['n' => 'Administrasi', 'd' => 'Layanan Publik Cepat, Mandiri, dan Transparan.', 'img' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1920'],
                    ['n' => 'Ekonomi Kita', 'd' => 'Dukungan penuh untuk pertumbuhan UMKM Warga.', 'img' => 'https://images.unsplash.com/photo-1470770841072-f978cf4d019e?w=1920'],
                    ['n' => 'Wisata Toba', 'd' => 'Keindahan Warisan Alam yang Terjaga Kelestariannya.', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=1920'],
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
            <button id="prev" class="w-24 h-24 bg-white/20 border-2 border-white text-white rounded-full text-5xl hover:bg-white hover:text-black transition">←</button>
            <button id="next" class="w-24 h-24 bg-white/20 border-2 border-white text-white rounded-full text-5xl hover:bg-white hover:text-black transition">→</button>
        </div>
    </section>

    <!-- 2. STATISTIK PRO -->
    <section class="w-full px-[5%] py-40">
        <div class="bg-white rounded-[10rem] p-32 shadow-giant flex flex-col xl:flex-row gap-32 items-center border-b-[40px] border-emerald-950">
            <div class="w-full xl:w-2/5">
                <h2 class="text-[12rem] font-serif italic text-emerald-950 leading-none mb-16">Statistik.</h2>
                <div class="p-16 bg-emerald-50 rounded-[5rem] flex items-center justify-between border-8 border-white shadow-2xl">
                    <div>
                        <h4 class="text-9xl font-black text-emerald-950 tracking-tighter">{{ $about->jumlah_penduduk ?? '2.8k' }}</h4>
                        <p class="text-3xl font-black uppercase text-emerald-600 tracking-widest mt-6">Jiwa Terdaftar</p>
                    </div>
                    <div class="text-7xl">👥</div>
                </div>
            </div>
            <div class="w-full xl:w-3/5 h-[800px] relative p-12 bg-slate-50/50 rounded-[8rem] border-4 border-white shadow-inner">
                <canvas id="villageChartProHD"></canvas>
            </div>
        </div>
    </section>

    <!-- 3. PANEL LAYANAN (DENGAN PROTEKSI LOGIN) -->
    <section class="w-full px-[5%] mt-40">
        <div class="bg-emerald-900 rounded-[10rem] p-32 md:p-40 shadow-giant relative overflow-hidden">
            <div class="relative z-20">
                
                @auth
                    <!-- Tampilan Jika Sudah Login -->
                    <div class="flex flex-col md:flex-row justify-between items-center mb-32 gap-12">
                        <div class="text-center md:text-left">
                            <span class="text-emerald-300 font-black uppercase tracking-[0.6em] text-2xl italic">Selamat Datang Kembali,</span>
                            <h1 class="text-[14rem] font-serif italic text-white leading-none mt-8">{{ Auth::user()->name }}</h1>
                        </div>
                        <div class="w-72 h-72 rounded-[4rem] bg-white/10 backdrop-blur-3xl border-[12px] border-emerald-500/30 overflow-hidden shadow-giant">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=10b981&color=fff&size=300" class="w-full h-full object-cover">
                        </div>
                    </div>
                @else
                    <!-- Tampilan Jika Guest (Identik tapi menyapa Pengunjung) -->
                    <div class="mb-32 text-center md:text-left">
                        <span class="text-emerald-300 font-black uppercase tracking-[0.6em] text-2xl italic">Layanan Publik Digital,</span>
                        <h1 class="text-[14rem] font-serif italic text-white leading-none mt-8">Lumban Silintong</h1>
                    </div>
                @endauth

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-20">
                    <!-- Tombol Ajukan Surat (Gated) -->
                    <a href="{{ auth()->check() ? route('masyarakat.surat.create') : route('login') }}" class="block p-28 bg-emerald-400 rounded-[7rem] text-emerald-950 hover:scale-105 transition-all duration-700 shadow-giant group relative overflow-hidden btn-liquid">
                        @guest <div class="lock-overlay"><i class="fa-solid fa-lock"></i></div> @endguest
                        <span>
                            <h2 class="text-9xl font-serif italic font-bold leading-none">Ajukan <br>Surat &rarr;</h2>
                            <p class="text-3xl mt-10 font-medium opacity-60">Mulai permohonan dokumen administrasi baru.</p>
                        </span>
                    </a>

                    <!-- Card Status / Aspirasi (Gated) -->
                    <a href="{{ auth()->check() ? '#' : route('login') }}" class="bg-white/5 backdrop-blur-xl rounded-[7rem] p-24 border-4 border-emerald-500/20 flex flex-col justify-center text-center relative overflow-hidden group hover:bg-white/20 transition duration-700">
                        @guest <div class="lock-overlay"><i class="fa-solid fa-lock"></i></div> @endguest
                        <h3 class="text-7xl font-serif italic text-emerald-300 mb-8">Kirim Aspirasi</h3>
                        <p class="text-4xl text-white font-light italic leading-relaxed">Suarakan masukan Anda untuk pembangunan desa yang lebih baik.</p>
                        <div class="mt-12 btn-liquid border-white/20 px-12 py-6 rounded-full inline-block text-white font-black text-2xl uppercase">
                             <span>Sampaikan Aspirasi</span>
                        </div>
                    </a>
                </div>
            </div>
            <div class="absolute -left-[30rem] -top-[30rem] w-[1200px] h-[1200px] bg-emerald-500/10 rounded-full blur-[250px]"></div>
        </div>
    </section>

    <!-- 4. ML1: MODUL LAYANAN GLASS ZOOM (LENGKAP 6 MENU) -->
    <section class="w-full px-[5%] section-gap">
        <h3 class="text-[10rem] font-serif italic text-emerald-950 mb-32 text-center">Modul Desa.</h3>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-20">
            @php
                $srv = [
                    ['t' => 'Profil Desa', 'i' => '🏢', 'img' => 'https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=1200'],
                    ['t' => 'Produk UMKM', 'i' => '🛍️', 'img' => 'https://images.unsplash.com/photo-1542838132-92c53300491e?w=1200'],
                    ['t' => 'Galeri Wisata', 'i' => '📸', 'img' => 'https://images.unsplash.com/photo-1476514525535-07fb3b4ae5f1?w=1200'],
                    ['t' => 'Aspirasi Warga', 'i' => '🗣️', 'img' => 'https://images.unsplash.com/photo-1450101499163-c8848c66ca85?w=1200'],
                    ['t' => 'Info Desa', 'i' => '📰', 'img' => 'https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=1200'],
                    ['t' => 'Kontak Admin', 'i' => '📞', 'img' => 'https://images.unsplash.com/photo-1523966211575-eb4a01e7dd51?w=1200'],
                ];
            @endphp
            @foreach($srv as $m)
            <div class="glass-module shadow-giant group cursor-pointer" data-aos="zoom-in">
                <div class="blur-screen flex flex-col items-center justify-center p-12 text-white gap-20">
                    <span class="text-[15rem] transform group-hover:scale-125 transition duration-1000">{{ $m['i'] }}</span>
                    <h4 class="text-7xl font-black text-center uppercase tracking-tighter group-hover:tracking-[0.2em] transition-all duration-700 leading-none">{{ $m['t'] }}</h4>
                </div>
                <img src="{{ $m['img'] }}" class="w-full h-full object-cover">
            </div>
            @endforeach
        </div>
    </section>

    <!-- 5. BERITA & PENGUMUMAN (SEPARATED) -->
    <section class="w-full px-[5%] section-gap bg-white py-60 rounded-[15rem]">
        <h2 class="text-[12rem] font-serif italic text-emerald-950 border-b-[20px] border-emerald-900 pb-12 mb-40 inline-block leading-none">Berita.</h2>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-24 mb-60">
            @forelse($beritas as $b)
            <div class="group cursor-pointer bg-slate-50 rounded-[7rem] overflow-hidden border-2 border-slate-100 hover:bg-emerald-950 transition duration-1000">
                <div class="h-[600px] overflow-hidden relative">
                    <img src="{{ asset('storage/' . $b->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-1000">
                </div>
                <div class="p-24 group-hover:text-white transition duration-1000">
                    <span class="text-emerald-500 font-black text-3xl uppercase tracking-[0.4em]">{{ $b->kategori }}</span>
                    <h4 class="text-7xl font-bold mt-12 leading-tight">{{ $b->judul }}</h4>
                </div>
            </div>
            @empty
                <p class="text-5xl text-gray-300 italic">Belum ada berita terbaru.</p>
            @endforelse
        </div>

        <h2 class="text-[12rem] font-serif italic text-emerald-950 mb-40 text-center mt-60">Pengumuman.</h2>
        <div class="space-y-24">
            @foreach($beritas->where('kategori', 'Pengumuman') as $p)
            <div class="bg-white/40 backdrop-blur-3xl p-32 rounded-[7rem] border-8 border-white hover:bg-emerald-950 hover:text-white transition duration-1000 group cursor-pointer flex justify-between items-center shadow-2xl">
                <div class="flex items-center gap-20">
                    <span class="text-[10rem] opacity-20 group-hover:opacity-100 transition duration-700">🔔</span>
                    <div>
                        <span class="bg-emerald-500 text-white px-10 py-4 bg-emerald-600 rounded-full font-black text-2xl uppercase">Resmi</span>
                        <h4 class="text-7xl font-bold mt-12 leading-tight uppercase tracking-tighter">{{ $p->judul }}</h4>
                    </div>
                </div>
                <p class="text-5xl italic opacity-50 font-medium text-right min-w-[400px]">{{ $p->created_at->format('d/m/Y') }}</p>
            </div>
            @endforeach
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Slider Perspective Logic
            const container = document.getElementById('slide-container');
            const moveNext = () => { let items = document.querySelectorAll('.item'); container.appendChild(items[0]); }
            document.getElementById('next').onclick = moveNext;
            document.getElementById('prev').onclick = () => { container.prepend(document.querySelectorAll('.item')[5]); }
            setInterval(moveNext, 12000);

            document.addEventListener('click', (e) => {
                const clicked = e.target.closest('.item');
                if(clicked && clicked !== document.querySelectorAll('.item')[1]) moveNext();
            });

            // HD Bar Chart
            const ctx = document.getElementById('villageChartProHD').getContext('2d');
            const g = ctx.createLinearGradient(0, 0, 0, 900);
            g.addColorStop(0, '#064e3b'); g.addColorStop(0.5, '#10b981'); g.addColorStop(1, '#a7f3d0');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['Jiwa', 'Pria', 'Wanita', 'Pekerja', 'Lansia', 'KK'],
                    datasets: [{
                        data: [{{ $about->jumlah_penduduk ?? 2847 }}, 1380, 1467, 1420, 312, 724],
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