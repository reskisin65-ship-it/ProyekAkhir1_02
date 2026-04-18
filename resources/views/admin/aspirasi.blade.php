{{-- resources/views/admin/aspirasi.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Aspirasi')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">💬 Kelola Aspirasi</h1>
        <p class="text-gray-500">Kelola dan tanggapi aspirasi dari masyarakat</p>
    </div>

    @if(session('success'))
    <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
        {{ session('success') }}
    </div>
    @endif

    {{-- Statistik Cards --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <a href="{{ route('admin.aspirasi.index', ['status' => 'all']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'all' || !request('status') ? 'ring-2 ring-emerald-500' : '' }}">
            <p class="text-gray-400 text-sm">Total</p>
            <p class="text-2xl font-bold text-gray-800">{{ $statistik['total'] }}</p>
        </a>
        <a href="{{ route('admin.aspirasi.index', ['status' => 'baru']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'baru' ? 'ring-2 ring-red-500' : '' }}">
            <p class="text-red-500 text-sm">Baru</p>
            <p class="text-2xl font-bold text-red-600">{{ $statistik['baru'] }}</p>
        </a>
        <a href="{{ route('admin.aspirasi.index', ['status' => 'diproses']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'diproses' ? 'ring-2 ring-yellow-500' : '' }}">
            <p class="text-yellow-500 text-sm">Diproses</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $statistik['diproses'] }}</p>
        </a>
        <a href="{{ route('admin.aspirasi.index', ['status' => 'selesai']) }}" 
           class="bg-white rounded-xl p-4 shadow-sm hover:shadow-md transition {{ request('status') == 'selesai' ? 'ring-2 ring-green-500' : '' }}">
            <p class="text-green-500 text-sm">Selesai</p>
            <p class="text-2xl font-bold text-green-600">{{ $statistik['selesai'] }}</p>
        </a>
    </div>

    {{-- List Aspirasi --}}
    <div class="space-y-4">
        @forelse($aspirasi as $item)
        <div class="bg-white rounded-xl shadow-sm border-l-4 
            @if($item->status == 'baru') border-red-500
            @elseif($item->status == 'diproses') border-yellow-500
            @else border-green-500 @endif">
            <div class="p-5">
                <div class="flex justify-between items-start">
                    <div class="flex-1">
                        <div class="flex items-center gap-3 mb-2">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ substr($item->user->name ?? 'U', 0, 1) }}
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800">{{ $item->judul }}</h3>
                                <p class="text-xs text-gray-400">
                                    {{ $item->user->name ?? 'Anonim' }} • 
                                    {{ $item->kategori }} • 
                                    {{ $item->created_at->translatedFormat('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>
                        <p class="text-gray-600 mt-2">{{ $item->isi_aspirasi }}</p>
                        
                        @if($item->respon)
                        <div class="mt-3 p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-emerald-600 font-semibold">📝 Respon Admin:</p>
                            <p class="text-sm text-gray-600">{{ $item->respon }}</p>
                        </div>
                        @endif
                    </div>
                    
                    <div class="flex flex-col items-end gap-2 ml-4">
                        <span class="px-2 py-1 rounded-full text-xs font-semibold
                            @if($item->status == 'baru') bg-red-100 text-red-700
                            @elseif($item->status == 'diproses') bg-yellow-100 text-yellow-700
                            @else bg-green-100 text-green-700 @endif">
                            @if($item->status == 'baru') 🆕 Baru
                            @elseif($item->status == 'diproses') ⏳ Diproses
                            @else ✅ Selesai @endif
                        </span>
                        
                        <div class="flex gap-2">
                            @if($item->status == 'baru')
                            <form action="{{ route('admin.aspirasi.status', $item->id_aspirasi) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 bg-yellow-500 text-white text-xs rounded-lg hover:bg-yellow-600">
                                    Proses
                                </button>
                            </form>
                            @endif
                            
                            @if($item->status != 'selesai')
                            <button onclick="openResponModal({{ $item->id_aspirasi }}, '{{ addslashes($item->judul) }}')" 
                                    class="px-3 py-1 bg-emerald-500 text-white text-xs rounded-lg hover:bg-emerald-600">
                                Respon
                            </button>
                            @endif
                            
                            <form action="{{ route('admin.aspirasi.destroy', $item->id_aspirasi) }}" method="POST" onsubmit="return confirm('Yakin hapus aspirasi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-500 text-white text-xs rounded-lg hover:bg-red-600">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-xl shadow-md p-12 text-center">
            <i class="fa-regular fa-comment-dots text-5xl text-gray-300 mb-3"></i>
            <p class="text-gray-400">Belum ada aspirasi yang masuk</p>
        </div>
        @endforelse
    </div>

    <div class="mt-6">
        {{ $aspirasi->links() }}
    </div>
</div>

{{-- Modal Respon --}}
<div id="responModal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-lg w-full p-6">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold text-gray-800">📝 Beri Respon</h3>
            <button onclick="closeResponModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-times text-xl"></i>
            </button>
        </div>
        <form id="responForm" method="POST">
            @csrf
            <p class="text-sm text-gray-500 mb-3">Aspirasi: <span id="aspirasiJudul" class="font-semibold text-emerald-700"></span></p>
            <textarea name="respon" rows="5" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-emerald-500" placeholder="Tulis respon Anda..." required></textarea>
            <div class="flex gap-3 mt-4">
                <button type="submit" class="flex-1 px-4 py-2 bg-emerald-600 text-white rounded-lg hover:bg-emerald-700">Kirim Respon</button>
                <button type="button" onclick="closeResponModal()" class="px-4 py-2 bg-gray-400 text-white rounded-lg hover:bg-gray-500">Batal</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openResponModal(id, judul) {
        document.getElementById('responModal').classList.remove('hidden');
        document.getElementById('responModal').classList.add('flex');
        document.getElementById('aspirasiJudul').textContent = judul;
        document.getElementById('responForm').action = '/admin/aspirasi/' + id + '/respond';
    }
    function closeResponModal() {
        document.getElementById('responModal').classList.add('hidden');
        document.getElementById('responModal').classList.remove('flex');
    }
</script>
@endsection