<x-admin-layout>
    <div class="mb-16">
        <h1 class="text-6xl font-black text-emerald-950 tracking-tighter uppercase leading-none">Dashboard</h1>
        <p class="text-xl text-slate-400 font-medium mt-4 italic">Selamat datang kembali di pusat kendali data desa.</p>
    </div>

    <!-- Stats Grid Raksasa -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-10 mb-16">
        <!-- Card 1 -->
        <div class="bg-white p-10 rounded-[4rem] shadow-xl shadow-slate-200/50 border border-white flex flex-col justify-between h-72 group hover:bg-emerald-950 transition duration-500">
            <div class="flex justify-between items-start">
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center text-3xl group-hover:bg-emerald-800 transition">👥</div>
                <span class="text-xs font-black text-emerald-500 uppercase tracking-widest">+2.3%</span>
            </div>
            <div>
                <h3 class="text-6xl font-black text-emerald-950 group-hover:text-white tracking-tighter">{{ $stats['total_warga'] }}</h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Total Penduduk</p>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white p-10 rounded-[4rem] shadow-xl shadow-slate-200/50 border border-white flex flex-col justify-between h-72 group hover:bg-emerald-950 transition duration-500">
            <div class="flex justify-between items-start">
                <div class="w-16 h-16 bg-amber-50 rounded-2xl flex items-center justify-center text-3xl group-hover:bg-amber-800 transition">✉️</div>
                <span class="text-xs font-black text-amber-500 uppercase tracking-widest">Pending</span>
            </div>
            <div>
                <h3 class="text-6xl font-black text-emerald-950 group-hover:text-white tracking-tighter">{{ $stats['surat_pending'] }}</h3>
                <p class="text-sm font-bold text-slate-400 uppercase tracking-[0.2em] mt-2">Layanan Surat</p>
            </div>
        </div>

        <!-- Tambahkan card lain jika perlu ... -->
    </div>
</x-admin-layout>