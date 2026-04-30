{{-- resources/views/umkm/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar UMKM')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-6">
        <a href="{{ route('umkm') }}" class="text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-2 font-bold">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke UMKM
        </a>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-100">
        <div class="bg-gradient-to-r from-emerald-800 to-emerald-950 px-10 py-10 text-white relative overflow-hidden">
            <div class="relative z-10">
                <h1 class="text-3xl font-black italic tracking-tighter uppercase">📋 Daftar <span class="text-emerald-400">UMKM Baru</span></h1>
                <p class="text-emerald-100 mt-2 font-medium">Lengkapi data di bawah untuk mempromosikan usaha Anda di website desa.</p>
            </div>
            <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-700 rounded-full blur-3xl opacity-50"></div>
        </div>

        <div class="p-10">
            @if($errors->any())
            <div class="mb-8 p-6 bg-red-50 rounded-2xl text-red-600 text-sm border border-red-100">
                <div class="flex items-center gap-3 mb-2 font-black uppercase text-xs tracking-widest">
                    <i class="fa-solid fa-circle-exclamation text-lg"></i>
                    <span>Ada kesalahan pengisian:</span>
                </div>
                <ul class="list-disc list-inside space-y-1 ml-4 font-medium">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('masyarakat.umkm.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                @csrf

                <div class="grid md:grid-cols-2 gap-8">
                    {{-- Nama Usaha --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Nama Usaha *</label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" required
                               class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition"
                               placeholder="Contoh: Keripik Singkong Renyah">
                    </div>

                    {{-- Kategori --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Kategori Usaha *</label>
                        <select name="kategori" required class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition">
                            <option value="">Pilih Kategori</option>
                            <option value="Makanan">🍔 Makanan & Minuman</option>
                            <option value="Kerajinan">🎨 Kerajinan Tangan</option>
                            <option value="Fashion">👕 Fashion & Aksesoris</option>
                            <option value="Pertanian">🌾 Pertanian & Perkebunan</option>
                            <option value="Jasa">💼 Jasa & Layanan</option>
                            <option value="Lainnya">📦 Lainnya</option>
                        </select>
                    </div>

                    {{-- Nama Pemilik --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Nama Pemilik *</label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', Auth::user()->name) }}" required
                               class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition">
                    </div>

                    {{-- No Telepon --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">WhatsApp / No. Telepon *</label>
                        <input type="tel" name="no_telepon" value="{{ old('no_telepon') }}" required
                               class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition"
                               placeholder="08123456xxx">
                    </div>

                    {{-- Alamat --}}
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Alamat Lengkap Usaha *</label>
                        <textarea name="alamat_usaha" rows="2" required
                                  class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition"
                                  placeholder="Jl. Raya No.123, Desa Lumban Silintong">{{ old('alamat_usaha') }}</textarea>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Tentang Usaha / Deskripsi Produk *</label>
                        <textarea name="deskripsi" rows="4" required
                                  class="w-full px-6 py-4 rounded-2xl bg-slate-50 border-none focus:ring-2 focus:ring-emerald-500 font-bold text-slate-700 transition"
                                  placeholder="Ceritakan keunggulan produk atau usaha Anda agar orang tertarik membeli.">{{ old('deskripsi') }}</textarea>
                    </div>

                    {{-- INPUT LOGO USAHA (WAJIB) --}}
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Logo Usaha *</label>
                        <div class="bg-emerald-50 border-2 border-dashed border-emerald-200 rounded-2xl p-8 text-center group hover:border-emerald-500 transition-all">
                            <i class="fa-solid fa-image text-4xl text-emerald-300 mb-4 group-hover:text-emerald-500 transition"></i>
                            <input type="file" name="logo" required accept="image/*"
                                   class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-emerald-600 file:text-white hover:file:bg-emerald-700 cursor-pointer">
                            <p class="text-[10px] text-emerald-600 mt-4 font-bold uppercase tracking-widest italic">Format: JPG, PNG. Maks: 2MB (Logo/Icon Usaha)</p>
                        </div>
                    </div>

                    {{-- INPUT BUKTI USAHA (OPSIONAL) --}}
                    <div class="col-span-2">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Unggah Bukti Usaha (Opsional)</label>
                        <div class="bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl p-8 text-center group hover:border-emerald-500 transition-all">
                            <i class="fa-solid fa-cloud-arrow-up text-4xl text-slate-300 mb-4 group-hover:text-emerald-500 transition"></i>
                            <input type="file" name="bukti_usaha" accept="image/*"
                                   class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-black file:bg-slate-600 file:text-white hover:file:bg-slate-700 cursor-pointer">
                            <p class="text-[10px] text-slate-400 mt-4 font-bold uppercase tracking-widest italic">Format: JPG, PNG. Maks: 2MB (Foto tempat usaha/Produk)</p>
                        </div>
                    </div>
                </div>

                <div class="mt-12 flex gap-4 justify-end border-t border-slate-50 pt-10">
                    <a href="{{ route('umkm') }}" class="px-8 py-4 text-slate-400 font-black text-xs uppercase tracking-widest hover:text-slate-600 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-10 py-5 bg-emerald-600 text-white rounded-[2rem] font-black uppercase tracking-widest hover:bg-emerald-700 transition shadow-xl shadow-emerald-100 flex items-center gap-3">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>Kirim Pendaftaran</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-8 bg-white rounded-[2rem] p-8 border border-slate-100 flex items-start gap-6 shadow-sm">
        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center flex-shrink-0 text-emerald-600 text-xl">
            <i class="fa-solid fa-circle-info"></i>
        </div>
        <div>
            <h4 class="font-black text-emerald-950 uppercase text-xs tracking-widest mb-1 italic">Proses Verifikasi</h4>
            <p class="text-sm text-slate-500 leading-relaxed font-medium">Setelah dikirim, Admin Desa akan meninjau data Anda dalam waktu maksimal 2x24 jam. Anda dapat memantau status pendaftaran di halaman UMKM.</p>
        </div>
    </div>
</div>
@endsection