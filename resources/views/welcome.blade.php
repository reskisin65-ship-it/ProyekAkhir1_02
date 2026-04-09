<x-app-layout>
    <section class="relative min-h-screen flex items-center overflow-hidden bg-white">
        <div class="absolute inset-0 z-0 scale-110">
            <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=1920&q=100" class="w-full h-full object-cover brightness-110 grayscale-[20%]">
            <div class="absolute inset-0 bg-gradient-to-r from-white via-white/40 to-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-b from-transparent via-transparent to-white"></div>
        </div>

        <div class="container mx-auto px-6 lg:px-24 relative z-10" data-aos="fade-up">
            <div class="max-w-5xl">
                <span class="inline-flex items-center gap-4 text-emerald-700 font-black uppercase tracking-[0.6em] text-[10px] mb-10">
                    <span class="w-12 h-0.5 bg-emerald-700"></span> Official Portal
                </span>
                <h1 class="text-7xl md:text-[10rem] font-serif italic leading-[0.8] tracking-tighter text-emerald-950 mb-12">
                    Desa <br> <span class="text-emerald-500">Sanctuary.</span>
                </h1>
                <div class="flex flex-col md:flex-row gap-12 items-start md:items-center mt-20">
                    <p class="text-xl md:text-3xl font-light text-slate-600 max-w-xl italic leading-relaxed">
                        "Menghubungkan keasrian alam tradisional dengan ekosistem digital masa depan di tepian Danau Toba."
                    </p>
                    <div class="flex gap-4">
                        <a href="#profil" class="btn-liquid"><span>Jelajahi Profil</span></a>
                        <a href="/login" class="w-16 h-16 rounded-full border-2 border-emerald-900 flex items-center justify-center text-emerald-950 hover:bg-emerald-950 hover:text-white transition-all duration-500">
                            <i class="fa-solid fa-arrow-right -rotate-45 text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-4 opacity-30">
            <span class="text-[8px] font-black uppercase tracking-[0.5em] rotate-90 mb-8">SCROLL</span>
            <div class="w-px h-20 bg-emerald-950"></div>
        </div>
    </section>

    <section id="profil" class="py-32 lg:py-60 px-6 lg:px-[12%] bg-white">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-32 items-center">
            <div class="relative order-2 lg:order-1">
                <div class="rounded-[3rem] lg:rounded-[5rem] overflow-hidden shadow-giant aspect-[4/5] relative z-10" data-aos="reveal-left">
                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=1200" class="w-full h-full object-cover brightness-110 transition duration-700 hover:scale-110">
                </div>
                <div class="absolute -bottom-16 -right-12 w-64 h-80 border-[15px] border-white rounded-[4rem] shadow-2xl z-20 hidden md:block animate-float" data-aos="zoom-in" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=600" class="w-full h-full object-cover rounded-[3rem]">
                </div>
                <div class="absolute -top-10 -left-10 text-[15rem] font-serif text-emerald-50 opacity-[0.03] select-none">DESA</div>
            </div>

            <div class="order-1 lg:order-2" data-aos="fade-left">
                <h5 class="text-[10px] font-black uppercase tracking-[0.6em] text-emerald-500 mb-8 flex items-center gap-4 italic">
                    <span class="w-8 h-px bg-emerald-500"></span> Identity & History
                </h5>
                <h2 class="text-6xl lg:text-[6.5rem] font-serif italic text-emerald-950 leading-[0.9] mb-12 tracking-tighter">
                    Warisan Budaya, <br>Visi Digital.
                </h2>
                <p class="text-2xl text-slate-500 font-light leading-relaxed italic mb-16">
                    Desa Lumban Silintong bukan sekadar titik geografis, melainkan perwujudan harmoni antara manusia dan alam. Berdasarkan Rencana Strategis (Renstra) Institut Teknologi Del, kami bertransformasi menjadi desa percontohan digital di Sumatera Utara.
                </p>
                <div class="grid grid-cols-2 gap-12 border-t border-slate-100 pt-16">
                    <div>
                        <h4 class="text-6xl font-black text-emerald-950 tracking-tighter mb-2">12+</h4>
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Kelompok UMKM Aktif</p>
                    </div>
                    <div>
                        <h4 class="text-6xl font-black text-emerald-900 tracking-tighter mb-2">100%</h4>
                        <p class="text-[9px] font-black uppercase tracking-widest text-slate-400">Transparansi Publik</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-32 px-6 lg:px-[8%] bg-slate-50 rounded-[4rem] lg:rounded-[6rem] mx-4 lg:mx-8">
        <div class="flex flex-col md:flex-row justify-between items-end mb-24 gap-8">
            <div class="max-w-2xl" data-aos="fade-right">
                <h5 class="text-[10px] font-black uppercase tracking-[0.5em] text-emerald-600 mb-6 italic">Economic Catalyst</h5>
                <h2 class="text-6xl lg:text-8xl font-serif italic text-emerald-950 leading-none tracking-tighter">Produk Warga.</h2>
            </div>
            <a href="#" class="btn-liquid border-emerald-900/10" data-aos="fade-left"><span>Eksplorasi Pasar &rarr;</span></a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:h-[900px]">
            <div class="md:col-span-7 bg-white p-12 lg:p-20 rounded-[4rem] flex flex-col justify-between relative overflow-hidden group border border-slate-100 shadow-sm" data-aos="fade-up">
                <div class="relative z-10">
                    <div class="flex gap-3 mb-10">
                        <span class="px-5 py-2 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase border border-emerald-100">Warisan Budaya</span>
                        <span class="px-5 py-2 bg-orange-50 text-orange-600 rounded-full text-[9px] font-black uppercase border border-orange-100">Ekspor</span>
                    </div>
                    <h4 class="text-5xl lg:text-7xl font-bold text-emerald-950 leading-tight tracking-tighter">Ulos & Tenun <br> Silintong</h4>
                    <p class="text-xl text-slate-400 mt-8 max-w-sm font-light italic">Karya tangan para pengrajin lokal yang ditenun dengan teknik turun-temurun menggunakan pewarna alami dari tumbuhan pesisir.</p>
                </div>
                <div class="relative z-10 mt-16">
                    <button class="btn-liquid bg-emerald-950 text-white border-none"><span>Lihat Detail</span></button>
                </div>
                <img src="https://images.unsplash.com/photo-1542838132-92c53300491e?w=800" class="absolute -right-20 -bottom-20 w-[600px] opacity-20 group-hover:opacity-100 group-hover:rotate-6 group-hover:scale-110 transition-all duration-1000 pointer-events-none">
            </div>

            <div class="md:col-span-5 flex flex-col gap-8">
                <div class="flex-1 bg-white p-12 rounded-[3.5rem] border border-slate-100 flex items-center gap-10 group shadow-sm hover:border-emerald-500 transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-32 h-32 lg:w-44 lg:h-44 rounded-[2.5rem] overflow-hidden shrink-0 shadow-xl">
                        <img src="https://images.unsplash.com/photo-1541167760496-162955ed8a9f?w=400" class="w-full h-full object-cover group-hover:scale-125 transition-transform duration-1000">
                    </div>
                    <div>
                        <h5 class="text-3xl font-bold text-emerald-950 tracking-tighter">Kopi Robusta Toba</h5>
                        <p class="text-sm text-slate-400 font-medium mt-3 italic mb-6">Aroma khas pegunungan yang diproses secara tradisional.</p>
                        <div class="text-xl font-black text-emerald-600">IDR 45.000</div>
                    </div>
                </div>

                <div class="flex-1 grid grid-cols-2 gap-8">
                    <div class="bg-emerald-900 rounded-[3.5rem] p-10 flex flex-col justify-center text-white" data-aos="fade-up" data-aos-delay="400">
                        <span class="text-4xl mb-6 opacity-30">🍯</span>
                        <h5 class="text-2xl font-bold leading-tight">Madu Hutan Asli</h5>
                        <p class="text-[9px] font-black uppercase tracking-widest mt-4 text-emerald-400">100% Organik</p>
                    </div>
                    <div class="bg-white rounded-[3.5rem] p-10 flex flex-col justify-center border border-slate-100 shadow-sm" data-aos="fade-up" data-aos-delay="600">
                        <span class="text-4xl mb-6">🌿</span>
                        <h5 class="text-2xl font-bold text-emerald-950 leading-tight">Teh Herbal Lokal</h5>
                        <p class="text-[9px] font-black uppercase tracking-widest mt-4 text-slate-300">Produk Baru</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-32 lg:py-52 px-6 lg:px-[12%] bg-white">
        <div class="text-center mb-32" data-aos="fade-up">
            <h5 class="text-[10px] font-black uppercase tracking-[0.6em] text-emerald-500 mb-8 italic">Center of Information</h5>
            <h2 class="text-6xl lg:text-[7.5rem] font-serif italic text-emerald-950 leading-none tracking-tighter">Warta Desa.</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            @php
                $news = [
                    ['t' => 'Digital', 'h' => 'Peluncuran Kios Layanan Desa Mandiri Digital', 'd' => 'Kini warga dapat mengurus surat keterangan secara mandiri melalui aplikasi...'],
                    ['t' => 'Event', 'h' => 'Festival Pesisir Danau Toba 2026', 'd' => 'Menampilkan berbagai atraksi budaya dan pameran UMKM lokal Lumban Silintong...'],
                    ['t' => 'Eco', 'h' => 'Aksi Penanaman 1000 Bibit Pohon di Hulu Pesisir', 'd' => 'Program keberlanjutan lingkungan untuk menjaga resapan air dan keasrian desa...']
                ];
            @endphp

            @foreach($news as $idx => $n)
            <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="{{ $idx * 200 }}">
                <div class="aspect-[16/10] bg-slate-100 rounded-[2.5rem] mb-10 overflow-hidden relative border border-slate-50">
                    <div class="absolute inset-0 bg-emerald-950/20 opacity-0 group-hover:opacity-100 transition-all duration-700 z-10"></div>
                    <img src="https://images.unsplash.com/photo-1521737604893-d14cc237f11d?w=800" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                    <span class="absolute top-8 left-8 bg-white/90 backdrop-blur rounded-full px-5 py-2 text-[8px] font-black uppercase tracking-widest z-20">{{ $n['t'] }}</span>
                </div>
                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest mb-4 block">April 09, 2026</span>
                <h4 class="text-3xl font-bold text-emerald-950 leading-tight mb-6 group-hover:text-emerald-500 transition-colors">{{ $n['h'] }}</h4>
                <p class="text-slate-400 font-medium italic line-clamp-2 leading-relaxed">{{ $n['d'] }}</p>
                <div class="w-12 h-0.5 bg-emerald-100 mt-10 group-hover:w-full transition-all duration-700"></div>
            </div>
            @endforeach
        </div>
    </section>

    <section class="py-32 bg-emerald-950 text-white overflow-hidden rounded-[4rem] lg:rounded-[6rem] mx-4 lg:mx-8 mb-32">
        <div class="container mx-auto px-10">
            <h2 class="text-6xl lg:text-[8rem] font-serif italic mb-24 text-center tracking-tighter">Sudut Silintong.</h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 lg:h-[700px]">
                <div class="rounded-[2.5rem] overflow-hidden h-full group border border-white/10" data-aos="zoom-in">
                    <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?w=800" class="w-full h-full object-cover group-hover:scale-125 transition duration-1000 grayscale group-hover:grayscale-0">
                </div>
                <div class="rounded-[2.5rem] overflow-hidden h-full md:mt-20 group border border-white/10 shadow-giant" data-aos="zoom-in" data-aos-delay="200">
                    <img src="https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=800" class="w-full h-full object-cover group-hover:scale-125 transition duration-1000 grayscale group-hover:grayscale-0">
                </div>
                <div class="rounded-[2.5rem] overflow-hidden h-full group border border-white/10" data-aos="zoom-in" data-aos-delay="400">
                    <img src="https://images.unsplash.com/photo-1441974231531-c6227db76b6e?w=800" class="w-full h-full object-cover group-hover:scale-125 transition duration-1000 grayscale group-hover:grayscale-0">
                </div>
                <div class="rounded-[2.5rem] overflow-hidden h-full md:mt-20 group border border-white/10 shadow-giant" data-aos="zoom-in" data-aos-delay="600">
                    <img src="https://images.unsplash.com/photo-1501785888041-af3ef285b470?w=800" class="w-full h-full object-cover group-hover:scale-125 transition duration-1000 grayscale group-hover:grayscale-0">
                </div>
            </div>
        </div>
    </section>
</x-app-layout>