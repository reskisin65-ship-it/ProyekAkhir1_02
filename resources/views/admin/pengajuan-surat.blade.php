{{-- resources/views/admin/pengajuan-surat.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Pengajuan Surat')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📋 Kelola Pengajuan Surat</h1>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">No</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Pemohon</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Jenis Surat</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">NIK</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Status</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Tgl Pengajuan</th>
                        <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pengajuan as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm">{{ $index + 1 }}</td>
                        <td class="px-4 py-3 text-sm font-medium">{{ $item->nama_lengkap }}</td>
                        <td class="px-4 py-3 text-sm">{{ $item->jenis_surat }}</td>
                        <td class="px-4 py-3 text-sm font-mono">{{ $item->nik }}</td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($item->status == 'diproses') bg-blue-100 text-blue-700
                                @elseif($item->status == 'selesai') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">{{ $item->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-sm">
                            <div class="flex gap-2">
                                <button onclick="openModal({{ $item->id_surat }})" class="text-blue-600 hover:text-blue-700">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                @if($item->status == 'menunggu')
                                <form action="{{ route('admin.pengajuan-surat.approve', $item->id_surat) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-700">
                                        <i class="fa-solid fa-check"></i>
                                    </button>
                                </form>
                                <button onclick="openRejectModal({{ $item->id_surat }})" class="text-red-600 hover:text-red-700">
                                    <i class="fa-solid fa-times"></i>
                                </button>
                                @endif
                                @if($item->status == 'diproses')
                                <form action="{{ route('admin.pengajuan-surat.complete', $item->id_surat) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-green-600 hover:text-green-700">
                                        <i class="fa-solid fa-check-double"></i> Selesaikan
                                    </button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-400">Belum ada pengajuan surat</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Detail -->
<div id="detailModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-2xl w-full mx-4 max-h-[80vh] overflow-y-auto">
        <div class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold">Detail Pengajuan Surat</h2>
                <button onclick="closeModal()" class="text-gray-400 hover:text-gray-600">
                    <i class="fa-solid fa-times text-xl"></i>
                </button>
            </div>
            <div id="modalContent" class="space-y-3 text-sm"></div>
        </div>
    </div>
</div>

<!-- Modal Reject -->
<div id="rejectModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-md w-full mx-4">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-4">Tolak Pengajuan</h2>
            <form id="rejectForm" method="POST">
                @csrf
                <textarea name="catatan" rows="4" class="w-full px-3 py-2 border rounded-lg" placeholder="Alasan penolakan..."></textarea>
                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeRejectModal()" class="px-4 py-2 border rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        fetch(`/admin/pengajuan-surat/${id}`)
            .then(res => res.json())
            .then(data => {
                document.getElementById('modalContent').innerHTML = `
                    <p><strong>Nama Lengkap:</strong> ${data.nama_lengkap}</p>
                    <p><strong>NIK:</strong> ${data.nik}</p>
                    <p><strong>Tempat, Tanggal Lahir:</strong> ${data.tempat_lahir}, ${data.tanggal_lahir}</p>
                    <p><strong>Nomor Telepon:</strong> ${data.nomor_telepon}</p>
                    <p><strong>Jenis Surat:</strong> ${data.jenis_surat}</p>
                    <p><strong>Keperluan:</strong> ${data.keperluan}</p>
                    <p><strong>Status:</strong> ${data.status}</p>
                    <p><strong>Tanggal Pengajuan:</strong> ${data.created_at}</p>
                `;
                document.getElementById('detailModal').classList.add('flex');
                document.getElementById('detailModal').classList.remove('hidden');
            });
    }
    function closeModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.getElementById('detailModal').classList.remove('flex');
    }
    function openRejectModal(id) {
        document.getElementById('rejectForm').action = `/admin/pengajuan-surat/${id}/reject`;
        document.getElementById('rejectModal').classList.add('flex');
        document.getElementById('rejectModal').classList.remove('hidden');
    }
    function closeRejectModal() {
        document.getElementById('rejectModal').classList.add('hidden');
        document.getElementById('rejectModal').classList.remove('flex');
    }
</script>
@endsection