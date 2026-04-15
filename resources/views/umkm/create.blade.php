{{-- resources/views/umkm/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Daftar UMKM')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="mb-6">
        <a href="{{ route('umkm') }}" class="text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke UMKM
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-purple-600 to-purple-700 px-8 py-6">
            <h1 class="text-2xl md:text-3xl font-serif italic text-white">📋 Daftar UMKM</h1>
            <p class="text-purple-100 mt-1">Daftarkan usaha Anda untuk dipromosikan di website desa</p>
        </div>

        <div class="p-8">
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 rounded-xl text-red-600 text-sm border-l-4 border-red-500">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('masyarakat.umkm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Usaha *</label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition"
                               placeholder="Contoh: Tenun Ulos Batak">
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
                        <select name="kategori" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                            <option value="">Pilih Kategori</option>
                            <option value="makanan">🍔 Makanan & Minuman</option>
                            <option value="kerajinan">🎨 Kerajinan Tangan</option>
                            <option value="fashion">👕 Fashion & Aksesoris</option>
                            <option value="pertanian">🌾 Pertanian & Perkebunan</option>
                            <option value="jasa">💼 Jasa & Layanan</option>
                            <option value="lainnya">📦 Lainnya</option>
                        </select>
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Pemilik *</label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', Auth::user()->name) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition">
                    </div>

                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon *</label>
                        <input type="tel" name="no_telepon" value="{{ old('no_telepon', Auth::user()->nomor_telepon) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition"
                               placeholder="08123456789">
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alamat Usaha *</label>
                        <textarea name="alamat_usaha" rows="2" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition"
                                  placeholder="Jl. ... RT/RW, Desa Lumban Silintong">{{ old('alamat_usaha') }}</textarea>
                    </div>

                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Usaha *</label>
                        <textarea name="deskripsi" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-purple-500 focus:ring-2 focus:ring-purple-200 transition"
                                  placeholder="Jelaskan tentang usaha Anda, produk yang dijual, keunggulan, dll.">{{ old('deskripsi') }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('umkm') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-xl font-semibold hover:from-purple-500 hover:to-purple-600 transition shadow-md">
                        <i class="fa-regular fa-paper-plane"></i> Daftar UMKM
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="mt-6 bg-purple-50 rounded-xl p-4 border-l-4 border-purple-500">
        <div class="flex items-start gap-3">
            <i class="fa-solid fa-circle-info text-purple-500 text-xl"></i>
            <div>
                <h4 class="font-semibold text-purple-800">Informasi Penting</h4>
                <p class="text-sm text-purple-700 mt-1">Setelah mendaftar, admin akan melakukan verifikasi dalam 1-2 hari kerja. Anda akan mendapat notifikasi setelah disetujui.</p>
            </div>
        </div>
    </div>
</div>
@endsection