{{-- resources/views/admin/umkm.blade.php --}}
@extends('layouts.admin')
@section('title', 'Kelola UMKM')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-serif italic text-emerald-800">🏪 Kelola UMKM</h1>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-xl border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama Usaha</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Pemilik</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal Daftar</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($umkms as $index => $umkm)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 font-medium text-gray-800">{{ $umkm->nama_usaha }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $umkm->pemilik ?? $umkm->user->name ?? '-' }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ ucfirst($umkm->kategori) }}</td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-semibold
                                @if($umkm->status == 'pending') bg-yellow-100 text-yellow-700
                                @elseif($umkm->status == 'approved') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                @if($umkm->status == 'pending') Menunggu
                                @elseif($umkm->status == 'approved') Disetujui
                                @else Ditolak @endif
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $umkm->created_at->translatedFormat('d M Y') }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                @if($umkm->status == 'pending')
                                <form action="{{ route('admin.umkm.approve', $umkm->id_umkm) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded-lg text-sm hover:bg-green-700">Setujui</button>
                                </form>
                                <form action="{{ route('admin.umkm.reject', $umkm->id_umkm) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 bg-red-600 text-white rounded-lg text-sm hover:bg-red-700">Tolak</button>
                                </form>
                                @endif
                                <form action="{{ route('admin.umkm.destroy', $umkm->id_umkm) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus UMKM ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-gray-600 text-white rounded-lg text-sm hover:bg-gray-700">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                            <i class="fa-solid fa-store text-4xl mb-2 block"></i>
                            Belum ada UMKM yang terdaftar
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
