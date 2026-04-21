{{-- resources/views/admin/keuangan/kategori.blade.php --}}
@extends('layouts.app')

@section('title', 'Manajemen Kategori - Keuangan Desa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-serif italic text-emerald-800">🏷️ Manajemen Kategori</h1>
                <p class="text-gray-500 mt-1">Kelola kategori pemasukan dan pengeluaran desa</p>
            </div>
            <a href="{{ route('admin.keuangan.index') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Keuangan
            </a>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Form Tambah Kategori --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-plus-circle text-emerald-500"></i> Tambah Kategori Baru
                </h2>
                
                <form action="{{ route('admin.keuangan.kategori.store') }}" method="POST">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori</label>
                            <input type="text" name="nama_kategori" required
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis</label>
                            <select name="jenis" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                                <option value="pemasukan">💰 Pemasukan</option>
                                <option value="pengeluaran">💸 Pengeluaran</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Icon (Font Awesome)</label>
                            <input type="text" name="icon" value="fa-solid fa-tag"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                            <p class="text-xs text-gray-400 mt-1">Contoh: fa-solid fa-building, fa-solid fa-store</p>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Warna</label>
                            <input type="color" name="warna" value="#10b981"
                                   class="w-full h-10 rounded-lg border border-gray-200 cursor-pointer">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">Urutan</label>
                            <input type="number" name="urutan" value="0"
                                   class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                        </div>
                        
                        <button type="submit" class="w-full py-2 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-lg font-semibold hover:shadow-lg transition">
                            <i class="fa-solid fa-save mr-2"></i> Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>
            
            {{-- Daftar Kategori --}}
            <div class="bg-white rounded-2xl shadow-xl p-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fa-solid fa-list"></i> Daftar Kategori
                </h2>
                
                @if(session('success'))
                <div class="mb-4 p-3 bg-green-50 text-green-700 rounded-lg border-l-4 border-green-500">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(session('error'))
                <div class="mb-4 p-3 bg-red-50 text-red-700 rounded-lg border-l-4 border-red-500">
                    {{ session('error') }}
                </div>
                @endif
                
                <div class="space-y-4 max-h-96 overflow-y-auto">
                    @foreach($kategoris as $k)
                    <div class="border border-gray-100 rounded-xl p-4 hover:shadow-md transition">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-lg flex items-center justify-center" style="background: {{ $k->warna }}20; color: {{ $k->warna }}">
                                    <i class="{{ $k->icon }}"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">{{ $k->nama_kategori }}</h3>
                                    <span class="text-xs px-2 py-0.5 rounded-full {{ $k->jenis == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                        {{ $k->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex gap-2">
                                <button onclick="openEditModal({{ $k->id_kategori }}, '{{ $k->nama_kategori }}', '{{ $k->jenis }}', '{{ $k->icon }}', '{{ $k->warna }}', {{ $k->urutan }})"
                                        class="text-blue-600 hover:text-blue-700">
                                    <i class="fa-solid fa-edit"></i>
                                </button>
                                <form action="{{ route('admin.keuangan.kategori.destroy', $k->id_kategori) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-700">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Edit Kategori --}}
<div id="editModal" class="fixed inset-0 z-50 hidden overflow-y-auto">
    <div class="flex items-center justify-center min-h-screen px-4 py-8">
        <div class="fixed inset-0 bg-black/50" onclick="closeEditModal()"></div>
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full">
            <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-6 py-4 rounded-t-2xl">
                <h3 class="text-xl font-bold text-white">Edit Kategori</h3>
            </div>
            <form id="editForm" method="POST" class="p-6">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="edit_nama" required
                               class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Jenis</label>
                        <select name="jenis" id="edit_jenis" required class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                            <option value="pemasukan">💰 Pemasukan</option>
                            <option value="pengeluaran">💸 Pengeluaran</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Icon</label>
                        <input type="text" name="icon" id="edit_icon"
                               class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Warna</label>
                        <input type="color" name="warna" id="edit_warna"
                               class="w-full h-10 rounded-lg border border-gray-200 cursor-pointer">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Urutan</label>
                        <input type="number" name="urutan" id="edit_urutan"
                               class="w-full px-4 py-2 rounded-lg border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100">
                    </div>
                </div>
                
                <div class="flex gap-3 justify-end mt-6">
                    <button type="button" onclick="closeEditModal()" class="px-4 py-2 border border-gray-300 rounded-lg">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-emerald-500 text-white rounded-lg hover:bg-emerald-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function openEditModal(id, nama, jenis, icon, warna, urutan) {
        const modal = document.getElementById('editModal');
        const form = document.getElementById('editForm');
        
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_jenis').value = jenis;
        document.getElementById('edit_icon').value = icon;
        document.getElementById('edit_warna').value = warna;
        document.getElementById('edit_urutan').value = urutan;
        
        form.action = '/admin/keuangan/kategori/' + id;
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeEditModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
</script>
@endsection