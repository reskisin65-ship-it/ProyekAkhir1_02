{{-- resources/views/admin/pengajuan-surat-show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Detail Pengajuan Surat')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('admin.pengajuan-surat.index') }}" class="text-gray-500 hover:text-gray-700">
            ← Kembali
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Detail Pengajuan Surat</h1>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-lg border-l-4 border-red-500">
        {{ session('error') }}
    </div>
    @endif

    <div class="grid md:grid-cols-3 gap-6">
        {{-- Informasi Utama --}}
        <div class="md:col-span-2">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-4">
                    <div class="flex justify-between items-center">
                        <h2 class="text-xl font-semibold text-white">{{ $pengajuan->jenis_surat }}</h2>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            @if($pengajuan->status == 'menunggu') bg-yellow-500 text-white
                            @elseif($pengajuan->status == 'diproses') bg-blue-500 text-white
                            @elseif($pengajuan->status == 'selesai') bg-green-500 text-white
                            @else bg-red-500 text-white @endif">
                            @if($pengajuan->status == 'menunggu') ⏳ Menunggu
                            @elseif($pengajuan->status == 'diproses') 🔄 Diproses
                            @elseif($pengajuan->status == 'selesai') ✅ Selesai
                            @else ❌ Ditolak @endif
                        </span>
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">👤 Informasi Pemohon</h3>
                            <table class="w-full text-sm">
                                <tr class="border-b"><th class="text-left py-2 w-32">Nama</th><td class="py-2">{{ $pengajuan->user->name ?? '-' }}</td></tr>
                                <tr class="border-b"><th class="text-left py-2">Email</th><td class="py-2">{{ $pengajuan->user->email ?? '-' }}</td></tr>
                                <tr class="border-b"><th class="text-left py-2">Telepon</th><td class="py-2">{{ $pengajuan->user->nomor_telepon ?? '-' }}</td></tr>
                                <tr class="border-b"><th class="text-left py-2">NIK</th><td class="py-2">{{ $pengajuan->nik }}</td></tr>
                                <tr class="border-b"><th class="text-left py-2">Tanggal</th><td class="py-2">{{ $pengajuan->created_at->translatedFormat('d F Y, H:i') }}</td></tr>
                            </table>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">📄 Informasi Surat</h3>
                            <table class="w-full text-sm">
                                <tr class="border-b"><th class="text-left py-2 w-32">Jenis Surat</th><td class="py-2">{{ $pengajuan->jenis_surat }}</td></tr>
                                <tr class="border-b"><th class="text-left py-2">Keperluan</th><td class="py-2">{{ $pengajuan->keperluan }}</td></tr>
                                @if($pengajuan->keterangan)
                                <tr class="border-b"><th class="text-left py-2 align-top">Keterangan</th><td class="py-2">{{ $pengajuan->keterangan }}</td></tr>
                                @endif
                                @if($pengajuan->berkas_pendukung)
                                <tr class="border-b"><th class="text-left py-2 align-top">File Pendukung</th>
                                    <td class="py-2"><a href="{{ route('admin.pengajuan-surat.download-pendukung', $pengajuan->id_surat) }}" class="text-emerald-600 hover:underline">Download File</a></td>
                                </tr>
                                @endif
                            </table>
                        </div>
                    </div>

                    @if($pengajuan->catatan_penolakan)
                    <div class="mt-6 p-4 bg-red-50 rounded-lg border-l-4 border-red-500">
                        <p class="text-sm font-semibold text-red-700">⚠️ Catatan Penolakan</p>
                        <p class="text-sm text-red-600 mt-1">{{ $pengajuan->catatan_penolakan }}</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Sidebar Tindakan --}}
        <div class="md:col-span-1">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">⚡ Tindakan</h3>
                
                @if($pengajuan->status == 'menunggu')
                <form action="{{ route('admin.pengajuan-surat.approve', $pengajuan->id_surat) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="w-full px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition">
                        ✓ Terima & Proses
                    </button>
                </form>
                <button onclick="openTolakModal()" class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition mb-3">
                    ✗ Tolak Pengajuan
                </button>
                @endif
                
                @if($pengajuan->status == 'diproses')
                <button onclick="openUploadModal()" class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition mb-3">
                    📎 Upload Surat Selesai
                </button>
                @endif
                
                @if($pengajuan->status == 'selesai' && $pengajuan->file_surat)
                <a href="{{ route('admin.pengajuan-surat.download-surat', $pengajuan->id_surat) }}" class="w-full px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600 transition flex items-center justify-center gap-2 mb-3">
                    <i class="fa-solid fa-download"></i> Download Surat PDF
                </a>
                @endif

                <div class="border-t border-gray-100 my-4"></div>

                <h4 class="font-semibold text-gray-700 mb-3">📊 Status Perkembangan</h4>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full flex items-center justify-center {{ in_array($pengajuan->status, ['menunggu', 'diproses', 'selesai']) ? 'bg-green-500 text-white' : 'bg-gray-200 text-gray-400' }}">
                            <i class="fa-regular fa-paper-plane text-sm"></i>
                        </div>
                        <div><p class="font-medium text-sm">Pengajuan Dikirim</p><p class="text-xs text-gray-400">{{ $pengajuan->created_at->translatedFormat('d M Y, H:i') }}</p></div>
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
                        <div><p class="font-medium text-sm">Surat Selesai</p><p class="text-xs text-gray-400">{{ $pengajuan->file_surat ? 'File sudah diunggah' : 'Belum ada file' }}</p></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Tolak --}}
<div id="tolakModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Tolak Pengajuan</h3>
            <button onclick="closeTolakModal()" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-times text-xl"></i></button>
        </div>
        <form action="{{ route('admin.pengajuan-surat.reject', $pengajuan->id_surat) }}" method="POST">
            @csrf
            <textarea name="catatan" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Alasan penolakan..." required></textarea>
            <div class="flex gap-3 mt-4">
                <button type="submit" class="flex-1 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700">Tolak</button>
                <button type="button" onclick="closeTolakModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Upload --}}
<div id="uploadModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-md w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">Upload Surat Selesai</h3>
            <button onclick="closeUploadModal()" class="text-gray-400 hover:text-gray-600"><i class="fa-solid fa-times text-xl"></i></button>
        </div>
        <form action="{{ route('admin.pengajuan-surat.complete', $pengajuan->id_surat) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-medium mb-2">File Surat (PDF)</label>
                <input type="file" name="file_surat" accept=".pdf" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" required>
                <p class="text-gray-400 text-sm mt-1">Maksimal 2MB, format PDF</p>
            </div>
            <div class="flex gap-3 mt-4">
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Upload</button>
                <button type="button" onclick="closeUploadModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openTolakModal() { document.getElementById('tolakModal').classList.remove('hidden'); document.getElementById('tolakModal').classList.add('flex'); }
    function closeTolakModal() { document.getElementById('tolakModal').classList.add('hidden'); document.getElementById('tolakModal').classList.remove('flex'); }
    function openUploadModal() { document.getElementById('uploadModal').classList.remove('hidden'); document.getElementById('uploadModal').classList.add('flex'); }
    function closeUploadModal() { document.getElementById('uploadModal').classList.add('hidden'); document.getElementById('uploadModal').classList.remove('flex'); }
</script>
@endsection