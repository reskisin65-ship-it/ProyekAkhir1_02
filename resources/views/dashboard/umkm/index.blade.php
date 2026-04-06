<x-umkm-layout>
    <div class="mb-16">
        <h1 class="text-6xl font-black text-emerald-950 tracking-tighter uppercase leading-none">Dashboard Bisnis</h1>
        <p class="text-xl text-slate-400 font-medium mt-4 italic">Pantau performa usaha Anda di Desa Lumban Silintong.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
        <!-- Card Info Toko -->
        <div class="md:col-span-2 bg-emerald-950 p-12 rounded-[4rem] text-white shadow-2xl relative overflow-hidden group">
            <div class="relative z-10">
                <span class="text-emerald-400 font-black uppercase text-xs tracking-widest">Nama Usaha Anda</span>
                <h3 class="text-7xl font-serif italic mt-6 leading-none">{{ $umkm->nama_usaha }}</h3>
                <div class="mt-10 flex gap-6">
                    <div class="bg-white/10 px-6 py-3 rounded-full border border-white/20 text-sm font-bold uppercase tracking-widest">
                        {{ $umkm->kategori }}
                    </div>
                </div>
            </div>
            <i class="fa-solid fa-store absolute -right-10 -bottom-10 text-[18rem] opacity-5 group-hover:scale-110 transition duration-1000"></i>
        </div>

        <!-- Card Total Produk -->
        <div class="bg-white p-12 rounded-[4rem] border-2 border-slate-100 shadow-sm flex flex-col justify-between group hover:border-emerald-500 transition duration-500">
            <div>
                <p class="text-slate-400 font-black text-[10px] uppercase tracking-widest">Total Produk</p>
                <h3 class="text-8xl font-black text-emerald-950 mt-4 tracking-tighter">{{ $produkCount }}</h3>
            </div>
            <a href="#" class="text-emerald-600 font-black text-xs uppercase tracking-widest border-b-2 border-emerald-600 pb-1 self-start hover:text-emerald-900">Kelola Katalog &rarr;</a>
        </div>
    </div>
</x-umkm-layout>