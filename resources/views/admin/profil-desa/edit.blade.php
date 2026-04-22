{{-- resources/views/admin/profil-desa/edit.blade.php --}}
@extends('layouts.app')

@section('title', 'Edit Profil Desa - Admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('admin.profil-desa.index') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 group">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition"></i> Kembali
            </a>
        </div>
        
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-6">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-solid fa-pen text-white text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-white">Edit Profil Desa</h1>
                        <p class="text-emerald-100 text-sm">Perbarui informasi profil desa Lumban Silintong</p>
                    </div>
                </div>
            </div>
            
            <form action="{{ route('admin.profil-desa.update') }}" method="POST" enctype="multipart/form-data" class="p-8">
                @csrf
                @method('PUT')
                
                <div class="space-y-8">
                    {{-- Sejarah --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fa-regular fa-clock text-emerald-500 mr-1"></i> Sejarah Desa
                        </label>
                        <textarea name="sejarah" rows="5" 
                                  class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition resize-none"
                                  placeholder="Tuliskan sejarah berdirinya Desa Lumban Silintong...">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Tuliskan sejarah desa secara lengkap dan informatif</p>
                    </div>
                    
                    {{-- Visi & Misi --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fa-solid fa-eye text-emerald-500 mr-1"></i> Visi
                            </label>
                            <textarea name="visi" rows="4" 
                                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition resize-none"
                                      placeholder="Visi desa...">{{ old('visi', $profil->visi ?? '') }}</textarea>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fa-solid fa-flag-checkered text-emerald-500 mr-1"></i> Misi
                            </label>
                            <textarea name="misi" rows="4" 
                                      class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition resize-none"
                                      placeholder="Misi desa (pisahkan dengan baris baru)...">{{ old('misi', $profil->misi ?? '') }}</textarea>
                        </div>
                    </div>
                    
                    {{-- Foto --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fa-solid fa-building text-emerald-500 mr-1"></i> Foto Kantor Desa
                            </label>
                            @if($profil && $profil->foto_kantor)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $profil->foto_kantor) }}" class="h-32 rounded-lg object-cover">
                                    <p class="text-xs text-gray-400 mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="foto_kantor" accept="image/*"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fa-solid fa-image text-emerald-500 mr-1"></i> Foto Kegiatan
                            </label>
                            @if($profil && $profil->foto_kegiatan)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $profil->foto_kegiatan) }}" class="h-32 rounded-lg object-cover">
                                    <p class="text-xs text-gray-400 mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            <input type="file" name="foto_kegiatan" accept="image/*"
                                   class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                        </div>
                    </div>
                    
                    {{-- Informasi Wilayah --}}
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fa-solid fa-map text-emerald-500"></i> Informasi Wilayah
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Luas Wilayah (km²)</label>
                                <input type="text" name="luas_wilayah" value="{{ old('luas_wilayah', $profil->luas_wilayah ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Kecamatan</label>
                                <input type="text" name="kecamatan" value="{{ old('kecamatan', $profil->kecamatan ?? 'Balige') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Kabupaten</label>
                                <input type="text" name="kabupaten" value="{{ old('kabupaten', $profil->kabupaten ?? 'Toba') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Provinsi</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi', $profil->provinsi ?? 'Sumatera Utara') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Tahun Berdiri</label>
                                <input type="text" name="tahun_berdiri" value="{{ old('tahun_berdiri', $profil->tahun_berdiri ?? '1920') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Jumlah Dusun</label>
                                <input type="number" name="jumlah_dusun" value="{{ old('jumlah_dusun', $profil->jumlah_dusun ?? 6) }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition">
                            </div>
                        </div>
                    </div>
                    
                    {{-- Kontak & Alamat --}}
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4 flex items-center gap-2">
                            <i class="fa-regular fa-address-card text-emerald-500"></i> Kontak & Alamat
                        </h3>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Kantor</label>
                                <textarea name="alamat_kantor" rows="2" 
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition"
                                          placeholder="Alamat lengkap kantor desa">{{ old('alamat_kantor', $profil->alamat_kantor ?? '') }}</textarea>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Desa</label>
                                <input type="email" name="email_desa" value="{{ old('email_desa', $profil->email_desa ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition"
                                       placeholder="desa@lumbansilintong.id">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Telepon Desa</label>
                                <input type="text" name="telepon_desa" value="{{ old('telepon_desa', $profil->telepon_desa ?? '') }}"
                                       class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition"
                                       placeholder="(0622) 123456">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-1">Embed Google Maps</label>
                                <textarea name="maps_embed" rows="2" 
                                          class="w-full px-4 py-3 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition"
                                          placeholder="URL embed Google Maps">{{ old('maps_embed', $profil->maps_embed ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-8 flex gap-4 justify-end">
                    <a href="{{ route('admin.profil-desa.index') }}" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:shadow-lg transition flex items-center gap-2">
                        <i class="fa-solid fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection