<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-12">
            <h2 class="text-4xl font-black text-slate-900 tracking-tight uppercase">Input Data Warga</h2>
            <p class="text-slate-400 font-bold text-[10px] uppercase tracking-[0.3em] mt-2 italic">Pastikan NIK sesuai dengan KTP asli.</p>
        </div>

        <div class="bg-white rounded-[3rem] p-12 shadow-xl border border-slate-100">
            <form action="{{ route('admin.penduduk.store') }}" method="POST" class="space-y-8">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="col-span-1 md:col-span-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Nama Lengkap Sesuai KTP</label>
                        <input type="text" name="nama_lengkap" class="w-full bg-slate-50 border-2 border-slate-100 p-5 rounded-2xl focus:ring-emerald-500 focus:border-emerald-500 font-bold" required>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" name="nik" class="w-full bg-slate-50 border-2 border-slate-100 p-5 rounded-2xl focus:ring-emerald-500 focus:border-emerald-500 font-bold tracking-widest" required>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="w-full bg-slate-50 border-2 border-slate-100 p-5 rounded-2xl focus:ring-emerald-500 focus:border-emerald-500 font-bold uppercase" required>
                    </div>

                    <div>
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full bg-slate-50 border-2 border-slate-100 p-5 rounded-2xl focus:ring-emerald-500 focus:border-emerald-500 font-bold">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2 block">Alamat Tempat Tinggal</label>
                        <textarea name="alamat" rows="3" class="w-full bg-slate-50 border-2 border-slate-100 p-5 rounded-2xl focus:ring-emerald-500 focus:border-emerald-500 font-bold" required></textarea>
                    </div>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full py-5 bg-emerald-950 text-white font-black uppercase tracking-[0.4em] text-xs rounded-2xl hover:bg-emerald-800 transition shadow-xl shadow-emerald-900/10">
                        Simpan ke Database &rarr;
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>