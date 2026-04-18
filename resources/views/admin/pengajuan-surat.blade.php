{{-- resources/views/admin/pengajuan-surat.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Pengajuan Surat')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📋 Kelola Pengajuan Surat</h1>
        <p class="text-gray-500">Kelola dan proses pengajuan surat dari masyarakat</p>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'all']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'all' || !request('status') ? 'ring-2 ring-emerald-500' : '' }}">
            <p class="text-gray-400 text-sm">Total</p>
            <p class="text-2xl font-bold text-gray-800">{{ $statistik['total'] }}</p>
        </a>
        <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'menunggu']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'menunggu' ? 'ring-2 ring-yellow-500' : '' }}">
            <p class="text-yellow-500 text-sm">Menunggu</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $statistik['menunggu'] }}</p>
        </a>
        <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'diproses']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'diproses' ? 'ring-2 ring-blue-500' : '' }}">
            <p class="text-blue-500 text-sm">Diproses</p>
            <p class="text-2xl font-bold text-blue-600">{{ $statistik['diproses'] }}</p>
        </a>
        <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'selesai']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'selesai' ? 'ring-2 ring-green-500' : '' }}">
            <p class="text-green-500 text-sm">Selesai</p>
            <p class="text-2xl font-bold text-green-600">{{ $statistik['selesai'] }}</p>
        </a>
        <a href="{{ route('admin.pengajuan-surat.index', ['status' => 'ditolak']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'ditolak' ? 'ring-2 ring-red-500' : '' }}">
            <p class="text-red-500 text-sm">Ditolak</p>
            <p class="text-2xl font-bold text-red-600">{{ $statistik['ditolak'] }}</p>
        </a>
    </div>

    {{-- Tabel Pengajuan Surat --}}
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Pemohon</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Jenis Surat</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($pengajuan as $index => $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($item->user->name ?? 'U', 0, 1) }}
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">{{ $item->user->name ?? 'Anonim' }}</p>
                                    <p class="text-xs text-gray-400">{{ $item->user->email ?? '-' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-700">{{ $item->jenis_surat }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->nik }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->created_at->translatedFormat('d M Y, H:i') }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($item->status == 'menunggu') bg-yellow-100 text-yellow-700
                                @elseif($item->status == 'diproses') bg-blue-100 text-blue-700
                                @elseif($item->status == 'selesai') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                @if($item->status == 'menunggu') ⏳ Menunggu
                                @elseif($item->status == 'diproses') 🔄 Diproses
                                @elseif($item->status == 'selesai') ✅ Selesai
                                @else ❌ Ditolak @endif
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <a href="{{ route('admin.pengajuan-surat.show', $item->id_surat) }}" 
                               class="text-emerald-600 hover:text-emerald-800 transition">
                                <i class="fa-solid fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <i class="fa-regular fa-file-lines text-4xl mb-2 block"></i>
                            Belum ada pengajuan surat
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-6">
        {{ $pengajuan->links() }}
    </div>
</div>
@endsection