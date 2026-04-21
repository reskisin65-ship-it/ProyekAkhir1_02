{{-- resources/views/admin/keuangan/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Tambah Transaksi - Keuangan Desa')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header --}}
        <div class="mb-6">
            <a href="{{ route('admin.keuangan.index') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali
            </a>
        </div>
        
        {{-- Form Card --}}
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-plus text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Tambah Transaksi</h1>
                        <p class="text-emerald-100 text-sm">Catat pemasukan atau pengeluaran desa</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('admin.keuangan.store') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                
                <div class="space-y-6">
                    {{-- Tanggal --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-calendar text-emerald-500 mr-1"></i> Tanggal Transaksi
                        </label>
                        <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" required
                               class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                    </div>
                    
                    {{-- Jenis Transaksi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-3">
                            <i class="fa-solid fa-tag text-emerald-500 mr-1"></i> Jenis Transaksi
                        </label>
                        <div class="grid grid-cols-2 gap-4">
                            <label class="relative cursor-pointer">
                                <input type="radio" name="jenis" value="pemasukan" class="sr-only peer" required>
                                <div class="p-5 border-2 rounded-xl text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 hover:shadow-md">
                                    <i class="fa-solid fa-money-bill-trend-up text-3xl text-emerald-500 mb-2 block"></i>
                                    <span class="font-semibold text-gray-700">💰 Pemasukan</span>
                                    <p class="text-xs text-gray-400 mt-1">Dana masuk ke kas desa</p>
                                </div>
                            </label>
                            <label class="relative cursor-pointer">
                                <input type="radio" name="jenis" value="pengeluaran" class="sr-only peer" required>
                                <div class="p-5 border-2 rounded-xl text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 hover:shadow-md">
                                    <i class="fa-solid fa-money-bill-trend-down text-3xl text-red-500 mb-2 block"></i>
                                    <span class="font-semibold text-gray-700">💸 Pengeluaran</span>
                                    <p class="text-xs text-gray-400 mt-1">Dana keluar dari kas desa</p>
                                </div>
                            </label>
                        </div>
                    </div>
                    
                    {{-- Kategori --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-list text-emerald-500 mr-1"></i> Kategori
                        </label>
                        <select name="id_kategori" required class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                            <option value="">Pilih Kategori</option>
                            @foreach($kategoris as $k)
                                <option value="{{ $k->id_kategori }}" data-jenis="{{ $k->jenis }}">
                                    {{ $k->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    {{-- Deskripsi --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-align-left text-emerald-500 mr-1"></i> Deskripsi
                        </label>
                        <textarea name="deskripsi" rows="3" required
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition resize-none"
                                  placeholder="Contoh: Pembangunan jalan desa, Pembayaran gaji perangkat desa, dll">{{ old('deskripsi') }}</textarea>
                    </div>
                    
                    {{-- Jumlah --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-money-bill text-emerald-500 mr-1"></i> Jumlah (Rp)
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500">Rp</span>
                            <input type="number" name="jumlah" step="1000" required
                                   class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition"
                                   placeholder="0" value="{{ old('jumlah') }}">
                        </div>
                    </div>
                    
                    {{-- Bukti Foto --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-solid fa-camera text-emerald-500 mr-1"></i> Bukti Transaksi (Opsional)
                        </label>
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-400 transition">
                            <input type="file" name="bukti_foto" id="bukti_foto" class="hidden" accept="image/*">
                            <label for="bukti_foto" class="cursor-pointer flex flex-col items-center gap-2">
                                <i class="fa-solid fa-cloud-upload-alt text-4xl text-gray-400 hover:text-emerald-500 transition"></i>
                                <span class="text-sm text-gray-500">Klik untuk upload bukti transaksi</span>
                                <span class="text-xs text-gray-400">Format: JPG, PNG (Maks. 2MB)</span>
                            </label>
                            <div id="preview" class="mt-3 hidden">
                                <img id="previewImage" src="#" alt="Preview" class="max-h-32 mx-auto rounded-lg">
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Submit Button --}}
                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('admin.keuangan.index') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center gap-2">
                        <i class="fa-solid fa-save"></i> Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Preview image
    document.getElementById('bukti_foto').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                const preview = document.getElementById('preview');
                const previewImage = document.getElementById('previewImage');
                previewImage.src = event.target.result;
                preview.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });
</script>
@endsection