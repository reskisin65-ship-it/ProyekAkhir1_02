{{-- resources/views/admin/aspirasi.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Aspirasi')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">💬 Kelola Aspirasi</h1>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($aspirasi as $item)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-4 border-b">
                <div class="flex justify-between items-start">
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        @if($item->kategori == 'saran') bg-green-100 text-green-700
                        @elseif($item->kategori == 'keluhan') bg-red-100 text-red-700
                        @elseif($item->kategori == 'masukan') bg-blue-100 text-blue-700
                        @else bg-purple-100 text-purple-700 @endif">
                        {{ ucfirst($item->kategori) }}
                    </span>
                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                        @if($item->status == 'baru') bg-yellow-100 text-yellow-700
                        @elseif($item->status == 'diproses') bg-blue-100 text-blue-700
                        @else bg-green-100 text-green-700 @endif">
                        {{ ucfirst($item->status) }}
                    </span>
                </div>
                <h3 class="font-semibold text-gray-800 mt-2">{{ $item->judul }}</h3>
                <p class="text-xs text-gray-400 mt-1">Dari: {{ $item->user->name ?? 'Anonymous' }} | {{ $item->created_at->format('d M Y') }}</p>
            </div>
            <div class="p-4">
                <p class="text-sm text-gray-600 line-clamp-3">{{ $item->isi }}</p>
                @if($item->respon)
                <div class="mt-3 p-2 bg-gray-50 rounded-lg">
                    <p class="text-xs font-semibold text-gray-500">Respon Admin:</p>
                    <p class="text-sm text-gray-600">{{ $item->respon }}</p>
                </div>
                @endif
                <div class="flex gap-2 mt-3">
                    @if($item->status == 'baru')
                    <form action="{{ route('admin.aspirasi.status', $item->id_aspirasi) }}" method="POST">
                        @csrf
                        <button type="submit" class="px-3 py-1 bg-blue-600 text-white rounded-lg text-xs">Proses</button>
                    </form>
                    @endif
                    <button onclick="openRespondModal({{ $item->id_aspirasi }}, '{{ $item->judul }}')" class="px-3 py-1 bg-emerald-600 text-white rounded-lg text-xs">Tanggapi</button>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">Belum ada aspirasi</div>
        @endforelse
    </div>
</div>

<!-- Modal Respon -->
<div id="respondModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
    <div class="bg-white rounded-xl max-w-md w-full mx-4">
        <div class="p-6">
            <h2 class="text-xl font-bold mb-2">Tanggapi Aspirasi</h2>
            <p id="aspirasiJudul" class="text-sm text-gray-500 mb-4"></p>
            <form id="respondForm" method="POST">
                @csrf
                <textarea name="respon" rows="4" class="w-full px-3 py-2 border rounded-lg" placeholder="Tulis tanggapan Anda..." required></textarea>
                <div class="flex justify-end gap-3 mt-4">
                    <button type="button" onclick="closeRespondModal()" class="px-4 py-2 border rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-600 text-white rounded-lg">Kirim Tanggapan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openRespondModal(id, judul) {
        document.getElementById('respondForm').action = `/admin/aspirasi/${id}/respond`;
        document.getElementById('aspirasiJudul').innerHTML = `<strong>${judul}</strong>`;
        document.getElementById('respondModal').classList.add('flex');
        document.getElementById('respondModal').classList.remove('hidden');
    }
    function closeRespondModal() {
        document.getElementById('respondModal').classList.add('hidden');
        document.getElementById('respondModal').classList.remove('flex');
    }
</script>
@endsection