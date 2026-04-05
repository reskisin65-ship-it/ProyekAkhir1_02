<x-admin-layout>
    <div class="max-w-4xl mx-auto">
        <div class="mb-10 text-center">
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">REGISTRASI WARGA</h1>
            <p class="text-slate-500 font-medium mt-1">Lengkapi data identitas resmi penduduk Desa Lumban Silintong.</p>
        </div>

        <div class="bg-white rounded-[3rem] shadow-xl border border-slate-100 p-12">
            <form action="{{ route('admin.penduduk.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Pilih Akun User (Masyarakat)</label>
                        <select name="user_id" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Nomor NIK</label>
                        <input type="text" name="nik" placeholder="16 digit NIK..." class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" placeholder="Nama sesuai KTP..." class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Tanggal Lahir</label>
                        <input type="date" name="tgl_lahir" class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-3">Alamat Lengkap</label>
                        <textarea name="alamat" rows="3" placeholder="Alamat detail di desa..." class="w-full bg-slate-50 border-none rounded-2xl p-4 font-bold text-slate-700 focus:ring-2 focus:ring-emerald-500"></textarea>
                    </div>
                </div>

                <div class="mt-12 flex gap-4">
                    <button type="submit" class="flex-1 bg-emerald-900 text-white py-5 rounded-2xl font-black uppercase text-xs tracking-widest shadow-lg hover:bg-black transition-all">Simpan Data Warga</button>
                    <a href="{{ route('admin.penduduk.index') }}" class="flex-1 bg-slate-100 text-slate-400 text-center py-5 rounded-2xl font-black uppercase text-xs tracking-widest hover:bg-slate-200 transition-all">Batal</a>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>