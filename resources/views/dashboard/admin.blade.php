<x-admin-layout>
    <!-- Header sesuai UI -->
    <div class="mb-12 flex justify-between items-end">
        <div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">RINGKASAN AKTIVITAS</h2>
            <p class="text-slate-400 font-bold text-xs mt-2 uppercase tracking-[0.2em]">Data Terpusat Desa Lumban Silintong</p>
        </div>
        <div class="flex gap-4">
            <div class="bg-white px-6 py-3 rounded-2xl border border-slate-200 font-bold text-sm">
                <span class="text-slate-400">Hari ini:</span> {{ date('d F Y') }}
            </div>
        </div>
    </div>

    <!-- STATS GRID (SESUAI GAMBAR 3.65) -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-16">
        <div class="bg-emerald-950 p-10 rounded-[3.5rem] text-white shadow-2xl relative overflow-hidden group">
            <p class="text-emerald-400 font-black text-[10px] uppercase tracking-widest">Total Penduduk</p>
            <h3 class="text-6xl font-black mt-4">2.847</h3>
            <div class="mt-4 flex items-center gap-2 text-emerald-300 text-xs font-bold">
                <i class="fa-solid fa-arrow-trend-up"></i> +2.3% Sensus Terbaru
            </div>
            <i class="fa-solid fa-users absolute -right-5 -bottom-5 text-9xl opacity-5 group-hover:scale-110 transition duration-700"></i>
        </div>

        <div class="bg-white p-10 rounded-[3.5rem] border-2 border-slate-100 shadow-sm hover:border-emerald-500 transition-all duration-500 group">
            <p class="text-slate-400 font-black text-[10px] uppercase tracking-widest">Layanan Surat</p>
            <h3 class="text-6xl font-black mt-4 text-slate-900">14</h3>
            <div class="mt-4 text-amber-500 text-xs font-bold uppercase italic">Perlu Verifikasi</div>
            <i class="fa-solid fa-file-lines absolute -right-5 -bottom-5 text-9xl text-slate-50 opacity-0 group-hover:opacity-100 transition duration-700"></i>
        </div>

        <div class="bg-white p-10 rounded-[3.5rem] border-2 border-slate-100 shadow-sm hover:border-indigo-500 transition-all duration-500 group">
            <p class="text-slate-400 font-black text-[10px] uppercase tracking-widest">UMKM Terdaftar</p>
            <h3 class="text-6xl font-black mt-4 text-slate-900">48</h3>
            <div class="mt-4 text-indigo-500 text-xs font-bold uppercase tracking-widest italic">Sektor Aktif</div>
            <i class="fa-solid fa-shop absolute -right-5 -bottom-5 text-9xl text-slate-50 opacity-0 group-hover:opacity-100 transition duration-700"></i>
        </div>

        <div class="bg-white p-10 rounded-[3.5rem] border-2 border-slate-100 shadow-sm hover:border-rose-500 transition-all duration-500 group">
            <p class="text-slate-400 font-black text-[10px] uppercase tracking-widest">Aspirasi Masuk</p>
            <h3 class="text-6xl font-black mt-4 text-slate-900">08</h3>
            <div class="mt-4 text-rose-500 text-xs font-bold uppercase tracking-widest italic">Belum Dibaca</div>
            <i class="fa-solid fa-bullhorn absolute -right-5 -bottom-5 text-9xl text-slate-50 opacity-0 group-hover:opacity-100 transition duration-700"></i>
        </div>
    </div>

    <!-- MAIN SECTION: ANTREAN SURAT (GAMBAR 3.66) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        <div class="lg:col-span-8 bg-white rounded-[4rem] shadow-sm border border-slate-100 p-12">
            <div class="flex justify-between items-center mb-10">
                <h4 class="text-2xl font-black text-slate-900">VERIFIKASI SURAT TERBARU</h4>
                <a href="#" class="text-emerald-700 font-black text-xs border-b-2 border-emerald-700 pb-1">LIHAT SEMUA ANTREAN</a>
            </div>

            <div class="space-y-6">
                @forelse($recentSurats ?? [] as $surat)
                <div class="flex items-center justify-between p-8 bg-slate-50 rounded-[2.5rem] border border-slate-100 group hover:bg-white hover:shadow-xl hover:border-emerald-200 transition-all duration-500">
                    <div class="flex items-center gap-6">
                        <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-2xl shadow-sm group-hover:bg-emerald-900 group-hover:text-white transition">📄</div>
                        <div>
                            <h5 class="text-lg font-black text-slate-800">{{ $surat->user->name }}</h5>
                            <p class="text-xs font-bold text-slate-400">Jenis: <span class="text-emerald-600">{{ $surat->jenis_surat }}</span></p>
                        </div>
                    </div>
                    <div class="text-right">
                        <span class="px-5 py-2 bg-amber-100 text-amber-600 rounded-full font-black text-[10px] uppercase tracking-widest">Menunggu</span>
                        <p class="text-[10px] text-slate-300 font-bold mt-2">{{ $surat->created_at->format('d M, H:i') }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-20">
                    <div class="text-6xl mb-4">📭</div>
                    <p class="text-slate-400 font-bold italic">Tidak ada antrean surat saat ini.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar Dashboard -->
        <div class="lg:col-span-4 space-y-10">
            <div class="bg-emerald-900 rounded-[4rem] p-12 text-white shadow-giant relative overflow-hidden group">
                <h4 class="text-3xl font-black leading-tight italic">Efisien & <br>Transparan.</h4>
                <p class="mt-6 text-emerald-100/60 font-medium text-sm">Pastikan setiap layanan masyarakat diproses dalam waktu kurang dari 24 jam.</p>
                <div class="mt-10 h-2 bg-emerald-800 rounded-full overflow-hidden">
                    <div class="w-2/3 h-full bg-emerald-400"></div>
                </div>
                <p class="text-[10px] font-black mt-4 text-emerald-400 uppercase tracking-widest">Target Layanan Tercapai: 65%</p>
            </div>

            <div class="bg-white rounded-[4rem] shadow-sm border border-slate-100 p-12">
                <h4 class="text-xl font-black text-slate-900 mb-10 border-b border-slate-50 pb-6">WARTA TERKINI</h4>
                <div class="space-y-8">
                    @forelse($recentBeritas ?? [] as $berita)
                    <div class="flex gap-5 group cursor-pointer">
                        <img src="{{ asset('storage/' . $berita->foto) }}" class="w-20 h-20 rounded-2xl object-cover shadow-md group-hover:scale-110 transition">
                        <div>
                            <span class="text-[9px] font-black text-emerald-600 uppercase tracking-widest">{{ $berita->kategori }}</span>
                            <h6 class="text-sm font-bold text-slate-800 leading-snug mt-1 line-clamp-2">{{ $berita->judul }}</h6>
                        </div>
                    </div>
                    @empty
                    <p class="text-xs text-slate-300 italic">Belum ada berita yang diposting.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>