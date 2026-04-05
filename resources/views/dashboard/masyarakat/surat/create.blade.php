<x-app-layout>
    <div class="max-w-[1200px] mx-auto px-10 py-20">
        <div class="mb-16">
            <a href="{{ route('masyarakat.dashboard') }}" class="text-xl font-black text-emerald-600 uppercase tracking-widest hover:text-emerald-950 transition">&larr; Dashboard</a>
            <h1 class="text-8xl font-serif italic text-emerald-950 mt-6 leading-none">Form Pengajuan Surat.</h1>
        </div>

        <div class="bg-white/40 backdrop-blur-3xl p-20 rounded-[6rem] border-8 border-white shadow-giant">
            <form action="{{ route('masyarakat.surat.store') }}" method="POST" enctype="multipart/form-data" class="space-y-16">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Jenis Surat -->
                    <div class="md:col-span-2">
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Jenis Surat</label>
                        <select name="jenis_surat" class="w-full bg-white border-4 border-emerald-50 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 shadow-inner transition" required>
                            <option value="Surat Keterangan Domisili">Surat Keterangan Domisili</option>
                            <option value="Surat Keterangan Tidak Mampu">Surat Keterangan Tidak Mampu</option>
                            <option value="Surat Keterangan Usaha">Surat Keterangan Usaha</option>
                            <option value="Surat Pindah">Surat Pindah</option>
                            <option value="Surat Kematian">Surat Kematian</option>
                        </select>
                    </div>

                    <!-- Nama Lengkap (Auto-fill dari User) -->
                    <div>
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ Auth::user()->name }}" class="w-full bg-slate-50 border-4 border-emerald-50 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 shadow-inner" readonly>
                    </div>

                    <!-- NIK (Auto-fill dari Data Penduduk) -->
                    <div>
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">NIK</label>
                        <input type="text" name="nik" value="{{ Auth::user()->penduduk->nik ?? '' }}" class="w-full bg-slate-50 border-4 border-emerald-50 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 shadow-inner" readonly>
                    </div>

                    <!-- Tanggal Lahir -->
                    <div>
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Tanggal Lahir</label>
                        <input type="text" value="{{ Auth::user()->penduduk->tgl_lahir ?? '' }}" class="w-full bg-slate-50 border-4 border-emerald-50 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 shadow-inner" readonly>
                    </div>

                    <!-- No Telepon -->
                    <div>
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">No. Telepon</label>
                        <input type="text" value="{{ Auth::user()->nomor_telepon }}" class="w-full bg-slate-50 border-4 border-emerald-50 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 shadow-inner" readonly>
                    </div>

                    <!-- Keperluan -->
                    <div class="md:col-span-2">
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Keperluan</label>
                        <textarea name="keperluan" rows="4" class="w-full bg-white border-4 border-emerald-50 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 shadow-inner transition" placeholder="Contoh: Untuk melamar pekerjaan..." required></textarea>
                    </div>

                    <!-- Upload Berkas -->
                    <div class="md:col-span-2">
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Lampiran Pendukung (KTP/KK)</label>
                        <div class="w-full bg-emerald-50/50 border-4 border-dashed border-emerald-200 p-16 rounded-[4rem] text-center group hover:bg-emerald-100 transition duration-500">
                            <input type="file" name="nama_berkas" id="file_upload" class="hidden">
                            <label for="file_upload" class="cursor-pointer">
                                <span class="text-8xl block mb-6 group-hover:scale-110 transition duration-500">📂</span>
                                <p class="text-3xl font-black text-emerald-800 uppercase tracking-tighter">Klik untuk Upload Berkas HD</p>
                                <p class="text-xl text-emerald-600/50 mt-4 italic font-medium">Format: PDF, JPG, PNG (Max 2MB)</p>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full py-12 bg-emerald-950 text-white text-4xl font-black rounded-full hover:bg-emerald-600 transition shadow-giant mt-10">KIRIM PERMOHONAN</button>
            </form>
        </div>
    </div>
</x-app-layout>