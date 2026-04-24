@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-slate-50 pb-20">
    <div class="max-w-5xl mx-auto px-6 pt-16">
        
        {{-- Tombol Kembali --}}
        <a href="{{ route('umkm.dashboard') }}" class="inline-flex items-center gap-2 text-slate-500 hover:text-emerald-600 transition mb-8 font-bold">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Daftar
        </a>

        <div class="bg-white rounded-[3rem] shadow-xl shadow-slate-200/50 overflow-hidden border border-slate-100 mb-12">
            {{-- Bagian Gambar/Logo UMKM --}}
            <div class="relative h-96 w-full bg-slate-200">
                <img src="{{ asset('storage/'.$umkm->logo) }}" class="w-full h-full object-cover" onerror="this.src='https://via.placeholder.com/800x400?text=Logo+UMKM'">
                <div class="absolute bottom-6 left-6">
                    <span class="px-6 py-2 bg-emerald-500 text-white text-xs font-black uppercase rounded-full shadow-lg">
                        {{ $umkm->kategori }}
                    </span>
                </div>
            </div>

            {{-- Bagian Konten UMKM --}}
            <div class="p-10 md:p-16">
                <h1 class="text-4xl md:text-5xl font-black text-emerald-950 mb-6 italic tracking-tighter">
                    {{ $umkm->nama_usaha }}
                </h1>
                
                <div class="prose prose-slate max-w-none">
                    <h3 class="text-emerald-600 font-black uppercase text-sm tracking-widest mb-4">Tentang Usaha</h3>
                    <p class="text-slate-600 text-lg leading-relaxed mb-8">
                        {{ $umkm->deskripsi }}
                    </p>
                </div>

                <hr class="border-slate-100 my-10">

                {{-- Informasi Pemilik/Kontak --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 text-xl">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Pemilik</p>
                            <p class="text-emerald-950 font-black">{{ $umkm->pemilik ?? ($umkm->user->name ?? 'Pemilik UMKM') }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 text-xl">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kontak</p>
                            <p class="text-emerald-950 font-black">{{ $umkm->no_telepon }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================== --}}
        {{-- BAGIAN PRODUK (CRUD) --}}
        {{-- ============================================== --}}
        <div class="mt-16">
            <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-4">
                <div>
                    <h2 class="text-3xl font-black text-emerald-950 italic tracking-tighter">Produk <span class="text-emerald-500">Kami</span></h2>
                    <p class="text-slate-400 font-medium">Temukan produk berkualitas tinggi dari {{ $umkm->nama_usaha }}</p>
                </div>
                
                @auth
                    @if(auth()->id() == $umkm->user_id)
                        {{-- Logika: Hanya bisa tambah produk jika status APPROVED --}}
                        @if($umkm->status == 'approved')
                            <button onclick="document.getElementById('modalTambahProduk').classList.remove('hidden'); document.body.style.overflow = 'hidden';" class="group flex items-center gap-3 px-8 py-4 bg-emerald-600 text-white rounded-2xl font-black shadow-lg shadow-emerald-200 hover:bg-emerald-700 hover:-translate-y-1 transition-all">
                                <i class="fa-solid fa-plus text-xl"></i>
                                <span>TAMBAH PRODUK</span>
                            </button>
                        @else
                            <div class="flex items-center gap-3 px-6 py-4 bg-amber-50 text-amber-600 rounded-2xl font-bold border border-amber-100 italic shadow-sm">
                                <i class="fa-solid fa-circle-exclamation text-xl"></i>
                                <span class="text-sm">Fitur tambah produk tersedia setelah UMKM disetujui Admin.</span>
                            </div>
                        @endif
                    @endif
                @endauth
            </div>

            {{-- Grid Daftar Produk --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($umkm->products as $produk)
                    <div class="bg-white rounded-[2.5rem] p-6 border border-slate-100 shadow-sm hover:shadow-xl transition-all group">
                        <div class="relative h-56 w-full mb-6 overflow-hidden rounded-[2rem]">
                            <img src="{{ asset('storage/'.$produk->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" onerror="this.src='https://via.placeholder.com/400x400?text=Produk'">
                        </div>
                        <h4 class="text-xl font-black text-emerald-950 mb-2">{{ $produk->nama_produk }}</h4>
                        <p class="text-emerald-600 font-black text-lg mb-4">Rp {{ number_format($produk->harga, 0, ',', '.') }}</p>
                        <p class="text-slate-400 text-sm mb-6 line-clamp-2">{{ $produk->deskripsi }}</p>
                        
                        @auth
                            @if(auth()->id() == $umkm->user_id)
                            <form action="{{ route('produk.destroy', $produk->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-full py-3 bg-red-50 text-red-500 font-bold rounded-xl hover:bg-red-500 hover:text-white transition-colors text-xs tracking-widest uppercase">
                                    <i class="fa-solid fa-trash-can mr-2"></i> Hapus Produk
                                </button>
                            </form>
                            @endif
                        @endauth
                    </div>
                @empty
                    <div class="col-span-full py-20 text-center bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                        <div class="text-6xl mb-4">📦</div>
                        <h3 class="text-xl font-black text-slate-300 uppercase italic">Belum Ada Produk</h3>
                        <p class="text-slate-400">Pemilik UMKM belum menambahkan katalog produk.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH PRODUK (FIXED Z-INDEX) --}}
<div id="modalTambahProduk" class="fixed inset-0 bg-emerald-950/60 backdrop-blur-md hidden items-center justify-center z-[9999] p-4 md:p-6 overflow-hidden">
    <div class="bg-white rounded-[3rem] p-8 md:p-12 max-w-xl w-full shadow-2xl relative overflow-y-auto max-h-[90vh] animate-in fade-in zoom-in duration-300">
        
        <div class="flex justify-between items-center mb-8 sticky top-0 bg-white z-10 pb-4 border-b border-slate-50">
            <h3 class="text-2xl md:text-3xl font-black text-emerald-950 italic tracking-tighter">Tambah <span class="text-emerald-500">Produk Baru</span></h3>
            <button onclick="document.getElementById('modalTambahProduk').classList.add('hidden'); document.body.style.overflow = 'auto';" class="text-slate-400 hover:text-red-500 transition text-3xl">
                <i class="fa-solid fa-circle-xmark"></i>
            </button>
        </div>

        <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <input type="hidden" name="umkm_id" value="{{ $umkm->id_umkm }}">

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Nama Produk</label>
                <input type="text" name="nama_produk" class="w-full p-5 bg-slate-50 border-2 border-transparent focus:border-emerald-500 rounded-2xl transition font-medium outline-none" placeholder="Contoh: Kain Tenun Motif Samosir" required>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Harga (Rp)</label>
                <input type="number" name="harga" class="w-full p-5 bg-slate-50 border-2 border-transparent focus:border-emerald-500 rounded-2xl transition font-medium outline-none" placeholder="150000" required>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Deskripsi Produk</label>
                <textarea name="deskripsi" rows="3" class="w-full p-5 bg-slate-50 border-2 border-transparent focus:border-emerald-500 rounded-2xl transition font-medium outline-none" placeholder="Jelaskan detail produk kamu..."></textarea>
            </div>

            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2 ml-4">Foto Produk</label>
                <div class="relative group">
                    <input type="file" name="foto" class="w-full p-4 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl text-sm cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-black file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 transition" required>
                </div>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full py-5 bg-emerald-600 text-white rounded-2xl font-black shadow-xl shadow-emerald-100 hover:bg-emerald-700 hover:-translate-y-1 transition-all uppercase tracking-widest">
                    SIMPAN PRODUK SEKARANG
                </button>
            </div>
        </form>
    </div>
</div>
@endsection