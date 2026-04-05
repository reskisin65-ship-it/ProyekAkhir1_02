<x-app-layout>
    <div class="max-w-[1000px] mx-auto px-10 py-20">
        <h1 class="text-8xl font-serif italic text-emerald-950 mb-16 text-center">Buat Berita Baru.</h1>
        
        <div class="bg-white/40 backdrop-blur-3xl p-16 rounded-[5rem] border-8 border-white shadow-giant">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-12">
                    <div>
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Judul Berita</label>
                        <input type="text" name="judul" class="w-full bg-white border-4 border-emerald-100 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 transition shadow-inner" placeholder="Masukkan judul..." required>
                    </div>

                    <div>
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Kategori</label>
                        <select name="kategori" class="w-full bg-white border-4 border-emerald-100 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 transition shadow-inner">
                            <option value="Kegiatan">Kegiatan Desa</option>
                            <option value="Pembangunan">Pembangunan</option>
                            <option value="Pengumuman">Pengumuman</option>
                        </select>
                    </div>

                    <div>
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Konten Berita</label>
                        <textarea name="isi_berita" rows="8" class="w-full bg-white border-4 border-emerald-100 p-8 rounded-[2.5rem] text-2xl focus:border-emerald-500 transition shadow-inner" placeholder="Tuliskan isi berita..." required></textarea>
                    </div>

                    <div>
                        <label class="text-2xl font-black text-emerald-900 block mb-4 uppercase tracking-widest">Upload Foto HD</label>
                        <input type="file" name="foto" class="w-full bg-emerald-50 border-4 border-dashed border-emerald-200 p-12 rounded-[2.5rem] text-xl file:hidden cursor-pointer" required>
                    </div>

                    <button type="submit" class="w-full py-10 bg-emerald-950 text-white text-3xl font-black rounded-full hover:bg-emerald-600 transition shadow-giant">PUBLIKASIKAN SEKARANG</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>