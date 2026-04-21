{{-- resources/views/admin/aspirasi.blade.php --}}
@extends('layouts.app')

@section('title', 'Kelola Aspirasi - Admin')

@section('content')
<style>
    .modal-transition {
        transition: all 0.3s ease;
    }
    .response-card {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-left: 4px solid #10b981;
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="relative mb-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-3xl md:text-4xl font-serif italic text-emerald-800">📋 Kelola Aspirasi</h1>
                    <p class="text-gray-500 mt-1">Kelola dan tanggapi aspirasi dari masyarakat</p>
                </div>
            </div>
            <div class="w-20 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 rounded-full mt-3"></div>
        </div>

        {{-- Statistik Cards --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-5 mb-8">
            <div class="bg-white rounded-2xl p-5 text-center shadow-md border border-gray-100">
                <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-list-check text-emerald-600 text-xl"></i>
                </div>
                <p class="text-2xl font-bold text-emerald-700">{{ $statistik['total'] }}</p>
                <p class="text-xs text-gray-500">Total Aspirasi</p>
            </div>
            <div class="bg-white rounded-2xl p-5 text-center shadow-md border border-gray-100">
                <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fa-regular fa-clock text-yellow-600 text-xl"></i>
                </div>
                <p class="text-2xl font-bold text-yellow-600">{{ $statistik['baru'] }}</p>
                <p class="text-xs text-gray-500">Baru</p>
            </div>
            <div class="bg-white rounded-2xl p-5 text-center shadow-md border border-gray-100">
                <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fa-solid fa-spinner fa-spin text-blue-600 text-xl"></i>
                </div>
                <p class="text-2xl font-bold text-blue-600">{{ $statistik['diproses'] }}</p>
                <p class="text-xs text-gray-500">Diproses</p>
            </div>
            <div class="bg-white rounded-2xl p-5 text-center shadow-md border border-gray-100">
                <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-3">
                    <i class="fa-regular fa-circle-check text-green-600 text-xl"></i>
                </div>
                <p class="text-2xl font-bold text-green-600">{{ $statistik['selesai'] }}</p>
                <p class="text-xs text-gray-500">Selesai</p>
            </div>
        </div>

        {{-- Filter Status --}}
        <div class="mb-6 flex flex-wrap gap-2">
            <a href="{{ route('admin.aspirasi.index', ['status' => 'all']) }}" 
               class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status', 'all') == 'all' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                Semua
            </a>
            <a href="{{ route('admin.aspirasi.index', ['status' => 'baru']) }}" 
               class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') == 'baru' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                Baru
            </a>
            <a href="{{ route('admin.aspirasi.index', ['status' => 'diproses']) }}" 
               class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') == 'diproses' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                Diproses
            </a>
            <a href="{{ route('admin.aspirasi.index', ['status' => 'selesai']) }}" 
               class="px-4 py-2 rounded-xl text-sm font-semibold transition-all {{ request('status') == 'selesai' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-50' }}">
                Selesai
            </a>
        </div>

        {{-- Alert Messages --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-xl border-l-4 border-green-500">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-check"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl border-l-4 border-red-500">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-circle-exclamation"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
        @endif

        {{-- Tabel Aspirasi --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gradient-to-r from-emerald-50 to-white border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase">No</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase">Pengirim</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase">Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase">Judul</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase">Tanggal</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-emerald-700 uppercase">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($aspirasi as $index => $a)
                        <tr class="hover:bg-emerald-50/30 transition">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $aspirasi->firstItem() + $index }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-emerald-500 to-emerald-600 flex items-center justify-center text-white text-xs font-bold">
                                        {{ substr($a->user->name ?? 'W', 0, 1) }}
                                    </div>
                                    <span class="font-medium text-gray-800">{{ $a->user->name ?? 'Warga' }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-semibold
                                    @if($a->kategori == 'saran') bg-green-100 text-green-700
                                    @elseif($a->kategori == 'keluhan') bg-red-100 text-red-700
                                    @elseif($a->kategori == 'masukan') bg-blue-100 text-blue-700
                                    @else bg-purple-100 text-purple-700 @endif">
                                    @if($a->kategori == 'saran') 💡 Saran
                                    @elseif($a->kategori == 'keluhan') 😞 Keluhan
                                    @elseif($a->kategori == 'masukan') 📝 Masukan
                                    @else ❓ Pertanyaan @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800">{{ Str::limit($a->judul, 40) }}</p>
                                <p class="text-xs text-gray-400 mt-1">{{ Str::limit($a->isi_aspirasi, 50) }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $a->created_at->translatedFormat('d F Y, H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold flex items-center gap-1 w-fit
                                    @if($a->status == 'baru') bg-yellow-100 text-yellow-700
                                    @elseif($a->status == 'diproses') bg-blue-100 text-blue-700
                                    @else bg-green-100 text-green-700 @endif">
                                    @if($a->status == 'baru') <i class="fa-regular fa-clock"></i> Baru
                                    @elseif($a->status == 'diproses') <i class="fa-solid fa-spinner fa-spin"></i> Diproses
                                    @else <i class="fa-regular fa-circle-check"></i> Selesai @endif
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-2">
                                    @if($a->status == 'baru')
                                    <button onclick="openResponModal({{ $a->id_aspirasi }}, '{{ addslashes($a->judul) }}')" 
                                            class="px-3 py-1.5 bg-emerald-500 text-white rounded-lg text-xs font-semibold hover:bg-emerald-600 transition">
                                        <i class="fa-regular fa-reply mr-1"></i> Respon
                                    </button>
                                    <a href="{{ route('admin.aspirasi.status', $a->id_aspirasi) }}" 
                                       class="px-3 py-1.5 bg-blue-500 text-white rounded-lg text-xs font-semibold hover:bg-blue-600 transition"
                                       onclick="return confirm('Ubah status menjadi diproses?')">
                                        <i class="fa-solid fa-play mr-1"></i> Proses
                                    </a>
                                    @elseif($a->status == 'diproses')
                                    <button onclick="openResponModal({{ $a->id_aspirasi }}, '{{ addslashes($a->judul) }}')" 
                                            class="px-3 py-1.5 bg-emerald-500 text-white rounded-lg text-xs font-semibold hover:bg-emerald-600 transition">
                                        <i class="fa-regular fa-reply mr-1"></i> Respon
                                    </button>
                                    @endif
                                    
                                    <form action="{{ route('admin.aspirasi.destroy', $a->id_aspirasi) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 bg-red-500 text-white rounded-lg text-xs font-semibold hover:bg-red-600 transition">
                                            <i class="fa-solid fa-trash mr-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-gray-400">
                                <i class="fa-regular fa-comment-dots text-4xl mb-3 block"></i>
                                <p>Belum ada aspirasi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        {{-- Pagination --}}
        <div class="mt-6">
            {{ $aspirasi->appends(request()->query())->links() }}
        </div>
    </div>
</div>

{{-- Modal Respon --}}
<div id="responModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black/50 transition-opacity" onclick="closeResponModal()"></div>
        
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-auto z-10 transform transition-all">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4 rounded-t-2xl">
                <div class="flex items-center justify-between">
                    <h3 class="text-xl font-bold text-white">
                        <i class="fa-regular fa-reply mr-2"></i> Beri Respon
                    </h3>
                    <button onclick="closeResponModal()" class="text-white/80 hover:text-white">
                        <i class="fa-solid fa-times text-xl"></i>
                    </button>
                </div>
            </div>
            
            <form id="formRespon" method="POST" class="p-6">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fa-regular fa-message text-emerald-500 mr-1"></i> Aspirasi:
                    </label>
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                        <p class="text-gray-700 text-sm" id="aspirasiJudul"></p>
                    </div>
                </div>
                
                <div class="mb-5">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fa-regular fa-reply-all text-emerald-500 mr-1"></i> Respon / Tanggapan:
                    </label>
                    <textarea name="respon" rows="5" required
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition resize-none"
                              placeholder="Tulis tanggapan untuk aspirasi warga..."></textarea>
                    <p class="text-xs text-gray-400 mt-1">Respon akan langsung terlihat oleh masyarakat</p>
                </div>
                
                <div class="flex gap-3 justify-end">
                    <button type="button" onclick="closeResponModal()" 
                            class="px-5 py-2.5 border border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-5 py-2.5 bg-gradient-to-r from-emerald-500 to-emerald-600 text-white rounded-xl font-semibold hover:from-emerald-600 hover:to-emerald-700 transition shadow-md flex items-center gap-2">
                        <i class="fa-regular fa-paper-plane"></i> Kirim Respon
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openResponModal(id, judul) {
        const modal = document.getElementById('responModal');
        const form = document.getElementById('formRespon');
        const judulEl = document.getElementById('aspirasiJudul');
        
        judulEl.innerHTML = judul;
        form.action = `/admin/aspirasi/${id}/respond`;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeResponModal() {
        const modal = document.getElementById('responModal');
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeResponModal();
        }
    });
</script>
@endsection