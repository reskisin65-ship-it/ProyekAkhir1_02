{{-- resources/views/admin/pengurus.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Pengurus Desa')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">👥 Kelola Pengurus Desa</h1>
        <a href="{{ route('admin.pengurus.create') }}" class="px-4 py-2 bg-emerald-600 text-white rounded-lg text-sm hover:bg-emerald-700">
            + Tambah Pengurus
        </a>
    </div>

    @if(session('success'))
    <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-5">
        @forelse($pengurus as $item)
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="flex p-4 gap-4">
                <div class="w-20 h-20 rounded-full overflow-hidden bg-gray-100 flex-shrink-0">
                    @if($item->foto)
                        <img src="{{ Storage::url($item->foto) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-emerald-100">
                            <i class="fa-solid fa-user text-emerald-500 text-2xl"></i>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <h3 class="font-semibold text-gray-800">{{ $item->nama }}</h3>
                    <p class="text-sm text-emerald-600">{{ $item->jabatan }}</p>
                    @if($item->nip)
                        <p class="text-xs text-gray-400 mt-1">NIP: {{ $item->nip }}</p>
                    @endif
                    <div class="flex gap-2 mt-2">
                        <a href="{{ route('admin.pengurus.edit', $item->id_pengurus) }}" class="text-blue-500 text-sm hover:text-blue-700">Edit</a>
                        <form action="{{ route('admin.pengurus.destroy', $item->id_pengurus) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 text-sm hover:text-red-700">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-12 text-gray-400">
            Belum ada data pengurus desa
        </div>
        @endforelse
    </div>
</div>
@endsection