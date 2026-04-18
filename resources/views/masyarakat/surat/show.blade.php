{{-- resources/views/masyarakat/surat/show.blade.php --}}
@extends('layouts.app')

@section('title', 'Detail Pengajuan Surat')

@section('content')
<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('masyarakat.surat.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Pengajuan Surat</h1>
    </div>

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-lg border-l-4 border-red-500">
        {{ session('error') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
            <div class="flex justify-between items-center">
                <h2 class="text-xl font-semibold text-white">{{ $pengajuan->jenis_surat }}</h2>
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    @if($pengajuan->status == 'menunggu') bg-yellow-500 text-white
                    @elseif($pengajuan->status == 'diproses') bg-blue-500 text-white
                    @elseif($pengajuan->status == 'selesai') bg-green-500 text-white
                    @else bg-red-500 text-white @endif">
                    @if($pengajuan->status == 'menunggu') ⏳ Menunggu Verifikasi
                    @elseif($pengajuan->status == 'diproses') 🔄 Sedang Diproses
                    @elseif($pengajuan->status == 'selesai') ✅ Selesai
                    @else ❌ Ditolak @endif
                </span>
            </div>
        </div>

        <div class="p-6">
            <div class="grid md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📋 Informasi Pengajuan</h3>
                    <table class="w-full text-sm">
                        <tr class="border-b"><th class="text-left py-2 w-32">No. Pengajuan</th><td class="py-2">#{{ $pengajuan->id_surat }}</td></tr>
                        <tr class="border-b"><th class="text-left py-2">Tanggal</th><td class="py-2">{{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}</td></tr>
                        <tr class="border-b"><th class="text-left py-2">Jenis Surat</th><td class="py-2">{{ $pengajuan->jenis_surat }}</td></tr>
                        <tr class="border-b"><th class="text-left py-2">NIK</th><td class="py-2">{{ $pengajuan->nik }}</td></tr>
                        <tr class="border-b"><th class="text-left py-2 align-top">Keperluan</th><td class="py-2">{{ $pengajuan->keperluan }}</td></tr>
                        @if($pengajuan->keterangan)
                        <tr class="border-b"><th class="text-left py-2 align-top">Keterangan</th><td class="py-2">{{ $pengajuan->keterangan }}</td></tr>
                        @endif
                        @if($pengajuan->file_pendukung)
                        <tr class="border-b"><th class="text-left py-2 align-top">File Pendukung</th>
                            <td class="py-2"><a href="{{ Storage::url($pengajuan->file_pendukung) }}" target="_blank" class="text-emerald-600 hover:underline">Lihat File</a></td>
                        </tr>
                        @endif
                    </table>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📊 Status Perkembangan</h3>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ in_array($pengajuan->status, ['menunggu', 'diproses', 'selesai']) ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                                <i class="fa-regular fa-paper-plane text-sm"></i>
                            </div>
                            <div><p class="font-medium text-sm">Pengajuan Dikirim</p><p class="text-xs text-gray-400">{{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}</p></div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ in_array($pengajuan->status, ['diproses', 'selesai']) ? 'bg-blue-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                                <i class="fa-regular fa-clock text-sm"></i>
                            </div>
                            <div><p class="font-medium text-sm">Diproses Admin</p><p class="text-xs text-gray-400">{{ $pengajuan->status == 'diproses' ? 'Sedang diproses' : ($pengajuan->status == 'selesai' ? 'Selesai diproses' : 'Belum diproses') }}</p></div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center {{ $pengajuan->status == 'selesai' ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                                <i class="fa-regular fa-circle-check text-sm"></i>
                            </div>
                            <div><p class="font-medium text-sm">Surat Selesai</p><p class="text-xs text-gray-400">{{ $pengajuan->file_surat ? 'Surat sudah siap diunduh' : 'Menunggu upload surat' }}</p></div>
                        </div>
                    </div>

                    @if($pengajuan->catatan_penolakan)
                    <div class="mt-6 p-4 bg-red-50 rounded-lg border-l-4 border-red-500">
                        <p class="text-sm font-semibold text-red-700">⚠️ Catatan Penolakan</p>
                        <p class="text-sm text-red-600 mt-1">{{ $pengajuan->catatan_penolakan }}</p>
                    </div>
                    @endif

                    @if($pengajuan->status == 'selesai' && $pengajuan->file_surat)
                    <div class="mt-6">
                        <a href="{{ route('masyarakat.surat.download', $pengajuan->id_surat) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">
                            <i class="fa-solid fa-download"></i> Unduh Surat PDF
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
