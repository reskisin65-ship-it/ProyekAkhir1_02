{{-- resources/views/masyarakat/surat/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Ajukan Surat')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('masyarakat.surat.index') }}" class="text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-2 group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-6">
            <h1 class="text-2xl md:text-3xl font-serif italic text-white">📝 Form Pengajuan Surat</h1>
            <p class="text-emerald-100 mt-1 text-sm">Isi data dengan lengkap dan benar</p>
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

            <form action="{{ route('masyarakat.surat.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Jenis Surat --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-file-alt text-emerald-500 mr-1"></i> Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_surat" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                            <option value="">Pilih Jenis Surat</option>
                            <option value="domisili">📄 Surat Keterangan Domisili</option>
                            <option value="keterangan_usaha">📄 Surat Keterangan Usaha</option>
                            <option value="keterangan_tidak_mampu">📄 Surat Keterangan Tidak Mampu</option>
                            <option value="kelahiran">📄 Surat Keterangan Kelahiran</option>
                            <option value="kematian">📄 Surat Keterangan Kematian</option>
                            <option value="pindah">📄 Surat Keterangan Pindah</option>
                        </select>
                    </div>

                    {{-- Nama Lengkap --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-user text-emerald-500 mr-1"></i> Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', Auth::user()->name) }}" required 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                    </div>

                    {{-- NIK --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-id-card text-emerald-500 mr-1"></i> NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nik" value="{{ old('nik') }}" required maxlength="16"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                               placeholder="16 digit angka">
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-location-dot text-emerald-500 mr-1"></i> Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-calendar text-emerald-500 mr-1"></i> Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-phone text-emerald-500 mr-1"></i> Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon', Auth::user()->nomor_telepon) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                               placeholder="08123456789">
                    </div>

                    {{-- Keperluan --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-clipboard-list text-emerald-500 mr-1"></i> Keperluan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="keperluan" rows="4" required
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                                  placeholder="Jelaskan keperluan pengajuan surat...">{{ old('keperluan') }}</textarea>
                    </div>

                    {{-- Berkas Pendukung --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-paperclip text-emerald-500 mr-1"></i> Berkas Pendukung (Opsional)
                        </label>
                        <input type="file" name="berkas_pendukung" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="text-xs text-gray-400 mt-1">Format: PDF, JPG, PNG. Maksimal 2MB</p>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('masyarakat.surat.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:from-emerald-500 hover:to-emerald-600 transition shadow-md hover:shadow-lg flex items-center gap-2">
                        <i class="fa-regular fa-paper-plane"></i> Kirim Pengajuan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Info Box --}}
    <div class="mt-6 bg-blue-50 rounded-xl p-4 border-l-4 border-blue-500">
        <div class="flex items-start gap-3">
            <i class="fa-solid fa-circle-info text-blue-500 text-xl"></i>
            <div>
                <h4 class="font-semibold text-blue-800">Informasi Penting</h4>
                <p class="text-sm text-blue-700 mt-1">Pengajuan surat akan diproses dalam waktu 1x24 jam setelah diverifikasi oleh petugas desa. Pastikan data yang Anda masukkan sudah benar.</p>
            </div>
        </div>
    </div>
</div>
@endsection