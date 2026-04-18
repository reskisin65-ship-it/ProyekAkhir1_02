{{-- resources/views/masyarakat/surat/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Ajukan Surat')

@section('content')
<div class="max-w-3xl mx-auto px-4 py-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('masyarakat.surat.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">📝 Ajukan Surat Baru</h1>
    </div>

    <div class="bg-white rounded-xl shadow-md p-6">
        <form action="{{ route('masyarakat.surat.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Jenis Surat <span class="text-red-500">*</span></label>
                <select name="jenis_surat" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                    <option value="">Pilih Jenis Surat</option>
                    <option value="Surat Keterangan Domisili">📄 Surat Keterangan Domisili</option>
                    <option value="Surat Keterangan Usaha">🏪 Surat Keterangan Usaha</option>
                    <option value="Surat Keterangan Tidak Mampu">📑 Surat Keterangan Tidak Mampu</option>
                    <option value="Surat Keterangan Kelahiran">👶 Surat Keterangan Kelahiran</option>
                    <option value="Surat Keterangan Kematian">⚰️ Surat Keterangan Kematian</option>
                    <option value="Surat Pengantar SKCK">🛂 Surat Pengantar SKCK</option>
                </select>
                @error('jenis_surat') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_lengkap" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" value="{{ old('nama_lengkap', Auth::user()->name ?? '') }}" required>
                    @error('nama_lengkap') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">NIK <span class="text-red-500">*</span></label>
                    <input type="text" name="nik" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" value="{{ old('nik') }}" maxlength="16" required>
                    <p class="text-gray-400 text-sm mt-1">16 digit angka (sesuai KTP)</p>
                    @error('nik') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Tempat Lahir <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat_lahir" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" value="{{ old('tempat_lahir') }}" required>
                    @error('tempat_lahir') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Tanggal Lahir <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" value="{{ old('tanggal_lahir') }}" required>
                    @error('tanggal_lahir') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Nomor Telepon <span class="text-red-500">*</span></label>
                    <input type="tel" name="nomor_telepon" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" value="{{ old('nomor_telepon', Auth::user()->nomor_telepon ?? '') }}" required>
                    @error('nomor_telepon') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Keperluan <span class="text-red-500">*</span></label>
                <textarea name="keperluan" rows="3" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Contoh: Untuk melamar pekerjaan di PT. Maju Bersama" required>{{ old('keperluan') }}</textarea>
                @error('keperluan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">Keterangan Tambahan (Opsional)</label>
                <textarea name="keterangan" rows="2" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">{{ old('keterangan') }}</textarea>
                @error('keterangan') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">File Pendukung (Opsional)</label>
                <input type="file" name="berkas_pendukung" accept=".jpg,.jpeg,.png,.pdf" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                <p class="text-gray-400 text-sm mt-1">Format: JPG, PNG, PDF. Maks: 2MB</p>
                @error('berkas_pendukung') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex gap-3">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Kirim Pengajuan</button>
                <a href="{{ route('masyarakat.surat.index') }}" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</a>
            </div>
        </form>
    </div>

    <div class="mt-6 bg-blue-50 rounded-lg p-4 border-l-4 border-blue-500">
        <h4 class="font-semibold text-blue-800 mb-2">ℹ️ Informasi</h4>
        <ul class="text-sm text-blue-700 space-y-1">
            <li>• Pengajuan akan diproses dalam 1-3 hari kerja</li>
            <li>• Pastikan data yang diisi sesuai dengan dokumen asli</li>
            <li>• Status pengajuan dapat dipantau di halaman Riwayat Surat</li>
        </ul>
    </div>
</div>
@endsection