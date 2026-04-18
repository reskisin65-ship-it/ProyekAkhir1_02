{{-- resources/views/masyarakat/surat/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Pengajuan Surat')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Back Button --}}
    <div class="mb-6">
        <a href="{{ route('masyarakat.surat.index') }}" class="text-emerald-600 hover:text-emerald-700 inline-flex items-center gap-2 group">
            <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali ke Riwayat
        </a>
    </div>

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
        <div class="bg-gradient-to-r from-amber-500 to-amber-600 px-8 py-6">
            <h1 class="text-2xl md:text-3xl font-serif italic text-white">✏️ Edit Pengajuan Surat</h1>
            <p class="text-amber-100 mt-1 text-sm">Perbarui data pengajuan surat Anda</p>
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

            <form action="{{ route('masyarakat.surat.update', $surat->id_surat) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid md:grid-cols-2 gap-6">
                    {{-- Jenis Surat --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-file-alt text-emerald-500 mr-1"></i> Jenis Surat <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis_surat" required class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                            <option value="">Pilih Jenis Surat</option>
                            <option value="domisili" {{ $surat->jenis_surat == 'domisili' ? 'selected' : '' }}>📄 Surat Keterangan Domisili</option>
                            <option value="keterangan_usaha" {{ $surat->jenis_surat == 'keterangan_usaha' ? 'selected' : '' }}>📄 Surat Keterangan Usaha</option>
                            <option value="keterangan_tidak_mampu" {{ $surat->jenis_surat == 'keterangan_tidak_mampu' ? 'selected' : '' }}>📄 Surat Keterangan Tidak Mampu</option>
                            <option value="kelahiran" {{ $surat->jenis_surat == 'kelahiran' ? 'selected' : '' }}>📄 Surat Keterangan Kelahiran</option>
                            <option value="kematian" {{ $surat->jenis_surat == 'kematian' ? 'selected' : '' }}>📄 Surat Keterangan Kematian</option>
                            <option value="pindah" {{ $surat->jenis_surat == 'pindah' ? 'selected' : '' }}>📄 Surat Keterangan Pindah</option>
                        </select>
                    </div>

                    {{-- Nama Lengkap --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-user text-emerald-500 mr-1"></i> Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap', $surat->nama_lengkap) }}" required 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                    </div>

                    {{-- NIK --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-id-card text-emerald-500 mr-1"></i> NIK <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nik" value="{{ old('nik', $surat->nik) }}" required maxlength="16"
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition"
                               placeholder="16 digit angka">
                    </div>

                    {{-- Tempat Lahir --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-location-dot text-emerald-500 mr-1"></i> Tempat Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir', $surat->tempat_lahir) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                    </div>

                    {{-- Tanggal Lahir --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-calendar text-emerald-500 mr-1"></i> Tanggal Lahir <span class="text-red-500">*</span>
                        </label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', $surat->tanggal_lahir->format('Y-m-d')) }}" required
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition">
                    </div>

                    {{-- Nomor Telepon --}}
                    <div class="col-span-2 md:col-span-1">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-phone text-emerald-500 mr-1"></i> Nomor Telepon <span class="text-red-500">*</span>
                        </label>
                        <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon', $surat->nomor_telepon) }}" required
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
                                  placeholder="Jelaskan keperluan pengajuan surat...">{{ old('keperluan', $surat->keperluan) }}</textarea>
                    </div>

                    {{-- Berkas Pendukung --}}
                    <div class="col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-paperclip text-emerald-500 mr-1"></i> Berkas Pendukung (Opsional)
                        </label>
                        @if($surat->berkas_pendukung)
                        <div class="mb-2 p-2 bg-gray-50 rounded-lg flex items-center gap-2">
                            <i class="fa-solid fa-file-pdf text-red-500"></i>
                            <span class="text-sm text-gray-600">Berkas saat ini: {{ basename($surat->berkas_pendukung) }}</span>
                            <a href="{{ Storage::url($surat->berkas_pendukung) }}" target="_blank" class="text-blue-500 text-sm hover:underline">Lihat</a>
                        </div>
                        @endif
                        <input type="file" name="berkas_pendukung" 
                               class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                        <p class="text-xs text-gray-400 mt-1">Format: PDF, JPG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah berkas.</p>
                    </div>
                </div>

                {{-- Submit Button --}}
                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('masyarakat.surat.index') }}" class="px-6 py-3 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-xl font-semibold hover:from-amber-600 hover:to-amber-700 transition shadow-md hover:shadow-lg flex items-center gap-2">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
