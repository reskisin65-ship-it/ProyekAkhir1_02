{{-- resources/views/masyarakat/aspirasi/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Sampaikan Aspirasi - Lumban Silintong')

@section('content')
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.4; transform: scale(1); }
        50% { opacity: 0.8; transform: scale(1.05); }
    }
    @keyframes shine {
        0% { background-position: -100px; }
        100% { background-position: 200px; }
    }
    
    .floating {
        animation: float 4s ease-in-out infinite;
    }
    .hero-gradient {
        background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);
    }
    .card-hover {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .card-hover:hover {
        transform: translateY(-2px);
        box-shadow: 0 20px 25px -12px rgba(0, 0, 0, 0.15);
    }
    input:checked + label {
        background: #10b981;
        color: white;
        border-color: #10b981;
    }
    .kategori-option {
        transition: all 0.3s ease;
    }
    .kategori-option:hover {
        transform: scale(1.02);
    }
</style>

<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Hero Section dengan Gambar Estetik --}}
        <div class="relative mb-10 overflow-hidden rounded-3xl hero-gradient shadow-2xl">
            <div class="absolute inset-0 bg-black/20"></div>
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-pulse-slow"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-emerald-400/20 rounded-full blur-2xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row items-center justify-between p-8 md:p-12">
                <div class="text-center md:text-left mb-6 md:mb-0">
                    <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/20 backdrop-blur-sm rounded-full text-white text-sm mb-4">
                        <i class="fa-regular fa-comment-dots"></i>
                        <span>Suara Anda Didengar</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-serif italic text-white mb-3">💬 Sampaikan Aspirasi</h1>
                    <p class="text-emerald-100 text-lg max-w-md">Setiap suara, saran, dan keluhan Anda adalah bahan bakar untuk kemajuan desa Lumban Silintong.</p>
                    <div class="flex items-center gap-3 mt-4 text-emerald-100/80 text-sm">
                        <i class="fa-regular fa-clock"></i>
                        <span>Ditanggapi maksimal 3 hari kerja</span>
                        <i class="fa-regular fa-lock ml-2"></i>
                        <span>Identitas Anda aman</span>
                    </div>
                </div>
                <div class="floating">
                    <div class="w-32 h-32 md:w-40 md:h-40 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-paper-plane text-6xl md:text-7xl text-white/80"></i>
                    </div>
                </div>
            </div>
        </div>

        {{-- Back Button --}}
        <div class="mb-6">
            <a href="{{ route('masyarakat.aspirasi.index') }}" class="inline-flex items-center gap-2 text-emerald-600 hover:text-emerald-700 group transition-all duration-300 hover:gap-3">
                <i class="fa-solid fa-arrow-left group-hover:-translate-x-1 transition-transform"></i>
                <span class="font-medium">Kembali ke Aspirasi Saya</span>
            </a>
        </div>

        {{-- Form Card Premium --}}
        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100">
            <div class="bg-gradient-to-r from-emerald-600 to-emerald-700 px-8 py-5">
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                        <i class="fa-regular fa-pen-to-square text-white text-xl"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white">Formulir Aspirasi</h2>
                        <p class="text-emerald-100 text-sm">Isi data dengan jelas agar mudah dipahami</p>
                    </div>
                </div>
            </div>

            <div class="p-8">
                @if($errors->any())
                <div class="mb-6 p-5 bg-gradient-to-r from-red-50 to-red-100/30 rounded-2xl border-l-4 border-red-500 shadow-md">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-500 rounded-full flex items-center justify-center">
                            <i class="fa-solid fa-circle-exclamation text-white text-lg"></i>
                        </div>
                        <div>
                            <p class="font-semibold text-red-700">Perhatian!</p>
                            <ul class="text-sm text-red-600 list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                <form action="{{ route('masyarakat.aspirasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="space-y-7">
                        {{-- Kategori dengan Desain Card --}}
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                                <i class="fa-solid fa-tag text-emerald-500"></i>
                                <span>Kategori Aspirasi</span>
                                <span class="text-red-500 text-xs">*</span>
                            </label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                                <label class="kategori-option relative cursor-pointer">
                                    <input type="radio" name="kategori" value="saran" class="sr-only peer" required>
                                    <div class="p-4 border-2 rounded-xl text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 hover:shadow-md">
                                        <i class="fa-regular fa-lightbulb text-2xl text-amber-500 mb-2 block"></i>
                                        <span class="font-semibold text-gray-700">💡 Saran</span>
                                        <p class="text-[10px] text-gray-400 mt-1">Ide untuk kemajuan</p>
                                    </div>
                                </label>
                                <label class="kategori-option relative cursor-pointer">
                                    <input type="radio" name="kategori" value="keluhan" class="sr-only peer">
                                    <div class="p-4 border-2 rounded-xl text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 hover:shadow-md">
                                        <i class="fa-regular fa-face-frown text-2xl text-red-500 mb-2 block"></i>
                                        <span class="font-semibold text-gray-700">😞 Keluhan</span>
                                        <p class="text-[10px] text-gray-400 mt-1">Masalah yang dihadapi</p>
                                    </div>
                                </label>
                                <label class="kategori-option relative cursor-pointer">
                                    <input type="radio" name="kategori" value="masukan" class="sr-only peer">
                                    <div class="p-4 border-2 rounded-xl text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 hover:shadow-md">
                                        <i class="fa-regular fa-message text-2xl text-blue-500 mb-2 block"></i>
                                        <span class="font-semibold text-gray-700">📝 Masukan</span>
                                        <p class="text-[10px] text-gray-400 mt-1">Saran konstruktif</p>
                                    </div>
                                </label>
                                <label class="kategori-option relative cursor-pointer">
                                    <input type="radio" name="kategori" value="pertanyaan" class="sr-only peer">
                                    <div class="p-4 border-2 rounded-xl text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 hover:shadow-md">
                                        <i class="fa-regular fa-circle-question text-2xl text-purple-500 mb-2 block"></i>
                                        <span class="font-semibold text-gray-700">❓ Pertanyaan</span>
                                        <p class="text-[10px] text-gray-400 mt-1">Info yang dibutuhkan</p>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Judul --}}
                        <div class="card-hover">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-heading text-emerald-500"></i>
                                <span>Judul Aspirasi</span>
                                <span class="text-red-500 text-xs">*</span>
                            </label>
                            <input type="text" name="judul" value="{{ old('judul') }}" required
                                   class="w-full px-5 py-3.5 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-300"
                                   placeholder="Contoh: Usulan Pembangunan Jalan Desa">
                        </div>

                        {{-- Isi Aspirasi --}}
                        <div class="card-hover">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-message text-emerald-500"></i>
                                <span>Isi Aspirasi</span>
                                <span class="text-red-500 text-xs">*</span>
                            </label>
                            <textarea name="isi" rows="6" required
                                      class="w-full px-5 py-3.5 rounded-xl border-2 border-gray-200 focus:border-emerald-500 focus:ring-4 focus:ring-emerald-100 transition-all duration-300 resize-none"
                                      placeholder="Tulis aspirasi, saran, atau keluhan Anda secara detail dan jelas...">{{ old('isi') }}</textarea>
                            <p class="text-xs text-gray-400 mt-2 flex items-center gap-1">
                                <i class="fa-regular fa-info-circle"></i>
                                Minimal 10 karakter, semakin detail semakin baik
                            </p>
                        </div>

                        {{-- Lampiran --}}
                        <div class="card-hover">
                            <label class="block text-sm font-bold text-gray-700 mb-2 flex items-center gap-2">
                                <i class="fa-solid fa-paperclip text-emerald-500"></i>
                                <span>Lampiran (Opsional)</span>
                            </label>
                            <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-400 transition-all duration-300">
                                <input type="file" name="lampiran" id="file-input" class="hidden">
                                <label for="file-input" class="cursor-pointer flex flex-col items-center gap-2">
                                    <i class="fa-solid fa-cloud-upload-alt text-4xl text-gray-400 hover:text-emerald-500 transition"></i>
                                    <span class="text-sm text-gray-500">Klik untuk upload atau drag & drop</span>
                                    <span class="text-xs text-gray-400">PDF, JPG, PNG (Maks. 2MB)</span>
                                </label>
                            </div>
                            <div id="file-name" class="text-xs text-emerald-600 mt-2 hidden"></div>
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <div class="mt-8 flex flex-col sm:flex-row gap-4 justify-end">
                        <a href="{{ route('masyarakat.aspirasi.index') }}" class="px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition-all duration-300 text-center">
                            Batal
                        </a>
                        <button type="submit" class="px-8 py-3.5 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:from-emerald-500 hover:to-emerald-600 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2 group">
                            <i class="fa-regular fa-paper-plane group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></i>
                            Kirim Aspirasi
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Info Box Premium --}}
        <div class="mt-8 grid md:grid-cols-3 gap-4">
            <div class="bg-gradient-to-r from-emerald-50 to-emerald-100/50 rounded-xl p-4 flex items-start gap-3">
                <i class="fa-solid fa-bolt text-emerald-500 text-xl"></i>
                <div>
                    <h4 class="font-semibold text-emerald-800 text-sm">Respon Cepat</h4>
                    <p class="text-xs text-emerald-700">Ditanggapi maksimal 3 hari kerja</p>
                </div>
            </div>
            <div class="bg-gradient-to-r from-blue-50 to-blue-100/50 rounded-xl p-4 flex items-start gap-3">
                <i class="fa-solid fa-shield-alt text-blue-500 text-xl"></i>
                <div>
                    <h4 class="font-semibold text-blue-800 text-sm">Identitas Terjaga</h4>
                    <p class="text-xs text-blue-700">Privasi Anda sepenuhnya aman</p>
                </div>
            </div>
            <div class="bg-gradient-to-r from-purple-50 to-purple-100/50 rounded-xl p-4 flex items-start gap-3">
                <i class="fa-solid fa-chart-line text-purple-500 text-xl"></i>
                <div>
                    <h4 class="font-semibold text-purple-800 text-sm">Pantau Status</h4>
                    <p class="text-xs text-purple-700">Cek perkembangan aspirasi Anda</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Tampilkan nama file yang diupload
    document.getElementById('file-input')?.addEventListener('change', function(e) {
        const fileName = e.target.files[0]?.name;
        const fileNameDiv = document.getElementById('file-name');
        if (fileName) {
            fileNameDiv.innerHTML = `<i class="fa-regular fa-file"></i> ${fileName}`;
            fileNameDiv.classList.remove('hidden');
        } else {
            fileNameDiv.classList.add('hidden');
        }
    });
</script>
@endsection