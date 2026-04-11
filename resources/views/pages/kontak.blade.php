{{-- resources/views/pages/kontak.blade.php --}}
@extends('layouts.app')

@section('title', 'Kontak - Lumban Silintong')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- Header --}}
    <div class="text-center mb-12">
        <h1 class="text-4xl md:text-5xl font-serif italic text-emerald-900 mb-4">📞 Hubungi Kami</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto rounded-full"></div>
        <p class="text-gray-500 mt-4 max-w-2xl mx-auto">Ada pertanyaan atau masukan? Silakan hubungi kami melalui kontak di bawah ini</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12">
        
        {{-- Informasi Kontak --}}
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h2 class="text-2xl font-serif italic text-emerald-800 mb-6">📍 Informasi Kontak</h2>
            
            <div class="space-y-6">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-location-dot text-emerald-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Alamat Kantor Desa</h3>
                        <p class="text-gray-500">Kantor Kepala Desa Lumban Silintong<br>
                        Kec. Balige, Kab. Toba<br>
                        Sumatera Utara, 22312</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-regular fa-envelope text-emerald-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Email Resmi</h3>
                        <p class="text-gray-500">halo@lumbansilintong.id<br>
                        info@lumbansilintong.id</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-phone text-emerald-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Nomor Telepon</h3>
                        <p class="text-gray-500">+62 822 1234 5678 (Kantor)<br>
                        +62 812 3456 7890 (Hotline)</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center flex-shrink-0">
                        <i class="fa-regular fa-clock text-emerald-600 text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-1">Jam Operasional</h3>
                        <p class="text-gray-500">Senin - Jumat: 08:00 - 16:00 WIB<br>
                        Sabtu: 08:00 - 12:00 WIB<br>
                        Minggu & Hari Libur: Tutup</p>
                    </div>
                </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-gray-100">
                <h3 class="font-semibold text-gray-700 mb-3">Ikuti Kami di Sosial Media</h3>
                <div class="flex gap-3">
                    <a href="#" class="w-10 h-10 bg-[#1877f2] rounded-xl flex items-center justify-center text-white hover:scale-110 transition">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-[#1da1f2] rounded-xl flex items-center justify-center text-white hover:scale-110 transition">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-[#e4405f] rounded-xl flex items-center justify-center text-white hover:scale-110 transition">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-[#25d366] rounded-xl flex items-center justify-center text-white hover:scale-110 transition">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-[#ff0000] rounded-xl flex items-center justify-center text-white hover:scale-110 transition">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        
        {{-- Form Kontak --}}
        <div class="bg-white rounded-2xl shadow-lg p-8 border border-gray-100">
            <h2 class="text-2xl font-serif italic text-emerald-800 mb-6">✉️ Kirim Pesan</h2>
            
            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 text-emerald-700 rounded-xl flex items-center gap-3">
                <i class="fa-solid fa-circle-check text-emerald-500 text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif
            
            @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-xl flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation text-red-500 text-xl"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif
            
            <form action="{{ route('kontak.send') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                    <input type="text" name="nama" required 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:outline-none transition"
                           placeholder="Masukkan nama Anda">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" name="email" required 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:outline-none transition"
                           placeholder="Masukkan email Anda">
                </div>
                
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                    <input type="text" name="subjek" required 
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:outline-none transition"
                           placeholder="Masukkan subjek pesan">
                </div>
                
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                    <textarea name="pesan" rows="5" required 
                              class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:outline-none transition"
                              placeholder="Tulis pesan Anda di sini..."></textarea>
                </div>
                
                <button type="submit" class="w-full py-3 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-xl font-semibold hover:from-emerald-500 hover:to-emerald-600 transition shadow-md">
                    <i class="fa-regular fa-paper-plane mr-2"></i> Kirim Pesan
                </button>
            </form>
        </div>
    </div>

    {{-- Peta Lokasi --}}
    <div class="mt-16">
        <h2 class="text-2xl font-serif italic text-emerald-800 mb-6 text-center">🗺️ Peta Lokasi</h2>
        <div class="rounded-2xl overflow-hidden shadow-xl h-96">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.668102377317!2d99.0435942!3d2.332309!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x302e04306443c683%3A0x868a8600868a86!2sLumban%20Silintong!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
        <p class="text-center text-gray-500 text-sm mt-4">
            <i class="fa-solid fa-location-dot text-emerald-500 mr-1"></i> Kantor Kepala Desa Lumban Silintong, Kecamatan Balige, Kabupaten Toba
        </p>
    </div>
</div>
@endsection