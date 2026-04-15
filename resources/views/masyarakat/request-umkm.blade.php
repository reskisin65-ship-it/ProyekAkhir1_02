{{-- resources/views/masyarakat/request-umkm.blade.php --}}
@extends('layouts.app')

@section('title', 'Request Akun UMKM')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl md:text-4xl font-serif italic text-emerald-800">🏪 Request Akun UMKM</h1>
        <p class="text-gray-500 mt-2">Daftarkan usaha Anda untuk dipromosikan di website desa</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl flex items-center gap-3 border-l-4 border-emerald-500">
        <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
        <span>{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl flex items-center gap-3 border-l-4 border-red-500">
        <i class="fa-solid fa-circle-exclamation text-red-500 text-xl"></i>
        <span>{{ session('error') }}</span>
    </div>
    @endif

    {{-- Info Box --}}
    <div class="mb-6 bg-blue-50 rounded-xl p-4 border-l-4 border-blue-500">
        <div class="flex items-start gap-3">
            <i class="fa-solid fa-circle-info text-blue-500 text-xl"></i>
            <div>
                <h4 class="font-semibold text-blue-800">Informasi Penting</h4>
                <p class="text-sm text-blue-700 mt-1">Setelah mengirimkan request, admin akan melakukan verifikasi dalam 1-2 hari kerja. Jika disetujui, akun Anda akan mendapatkan akses sebagai Pengelola UMKM.</p>
            </div>
        </div>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-6">
            <h2 class="text-2xl font-serif italic text-white">📋 Form Pendaftaran UMKM</h2>
            <p class="text-emerald-100 mt-1 text-sm">Isi data usaha Anda dengan lengkap</p>
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

            <form action="{{ route('masyarakat.request-umkm.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Nama Usaha --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-store text-emerald-500 mr-1"></i> Nama Usaha <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_usaha" value="{{ old('nama_usaha') }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                               placeholder="Contoh: Tenun Ulos Batak">
                    </div>

                    {{-- Kategori --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-tag text-emerald-500 mr-1"></i> Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="kategori" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                            <option value="">Pilih Kategori</option>
                            <option value="makanan">🍔 Makanan & Minuman</option>
                            <option value="kerajinan">🎨 Kerajinan Tangan</option>
                            <option value="fashion">👕 Fashion & Aksesoris</option>
                            <option value="pertanian">🌾 Pertanian & Perkebunan</option>
                            <option value="jasa">💼 Jasa & Layanan</option>
                            <option value="lainnya">📦 Lainnya</option>
                        </select>
                    </div>

                    {{-- Pemilik --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-user text-emerald-500 mr-1"></i> Nama Pemilik <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="pemilik" value="{{ old('pemilik', Auth::user()->name) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-phone text-emerald-500 mr-1"></i> Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="no_telepon" value="{{ old('no_telepon', Auth::user()->nomor_telepon) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                               placeholder="08123456789">
                    </div>

                    {{-- Alamat Usaha --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-location-dot text-emerald-500 mr-1"></i> Alamat Usaha <span class="text-red-500">*</span>
                        </label>
                        <textarea name="alamat_usaha" rows="2" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                                  placeholder="Jl. ... RT/RW, Desa Lumban Silintong">{{ old('alamat_usaha') }}</textarea>
                    </div>

                    {{-- Deskripsi --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-align-left text-emerald-500 mr-1"></i> Deskripsi Usaha <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                                  placeholder="Jelaskan tentang usaha Anda, produk yang dijual, keunggulan, dll.">{{ old('deskripsi') }}</textarea>
                    </div>

                    {{-- Bukti Usaha --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-image text-emerald-500 mr-1"></i> Foto/Logo Usaha (Opsional)
                        </label>
                        <input type="file" name="bukti_usaha" accept="image/*"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="text-xs text-gray-400 mt-1">Format: JPG, PNG. Maksimal 2MB</p>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('masyarakat.dashboard') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:from-emerald-500 hover:to-emerald-600 transition shadow-md hover:shadow-lg flex items-center gap-2">
                        <i class="fa-regular fa-paper-plane"></i> Kirim Request
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection