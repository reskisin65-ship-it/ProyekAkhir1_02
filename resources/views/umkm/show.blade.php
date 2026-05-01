@extends('layouts.app')

@section('content')
<!-- Menambahkan Animate.css untuk animasi masuk -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="min-h-screen bg-[#FDFDFD] pb-20 overflow-x-hidden">
    <div class="max-w-6xl mx-auto px-6 pt-12">
        
        {{-- Breadcrumb / Back Button --}}
        <div class="animate__animated animate__fadeIn">
            <a href="{{ route('umkm.index') }}" class="group inline-flex items-center gap-3 text-slate-400 hover:text-emerald-600 transition-all mb-10 font-bold tracking-tight">
                <span class="w-10 h-10 rounded-full bg-white shadow-sm border border-slate-100 flex items-center justify-center group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                    <i class="fa-solid fa-arrow-left"></i>
                </span>
                Kembali ke Eksplorasi
            </a>
        </div>

        {{-- Main UMKM Card --}}
        <div class="bg-white rounded-[3.5rem] shadow-[0_30px_100px_-20px_rgba(0,0,0,0.04)] overflow-hidden border border-slate-50 mb-20 animate__animated animate__fadeInUp">
            <div class="flex flex-col lg:flex-row">
                {{-- Bagian Gambar dengan Overlay Estetik --}}
                <div class="lg:w-2/5 relative h-[400px] lg:h-auto overflow-hidden">
                    <img src="{{ asset('storage/'.$umkm->logo) }}" class="w-full h-full object-cover transition-transform duration-1000 hover:scale-110" onerror="this.src='https://images.unsplash.com/photo-1542838132-92c53300491e?w=800'">
                    <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/40 via-transparent to-transparent"></div>
                    <div class="absolute top-8 left-8">
                        <span class="px-6 py-2 bg-white/90 backdrop-blur-md text-emerald-800 text-[10px] font-black uppercase tracking-[0.2em] rounded-full shadow-xl">
                            {{ $umkm->kategori }}
                        </span>
                    </div>
                </div>

                {{-- Bagian Konten --}}
                <div class="lg:w-3/5 p-10 md:p-20 relative">
                    {{-- Dekorasi Latar Belakang --}}
                    <div class="absolute top-0 right-0 p-12 opacity-[0.03] pointer-events-none">
                        <i class="fa-solid fa-quote-right text-9xl text-emerald-900"></i>
                    </div>

                    <h1 class="text-5xl md:text-6xl font-black text-slate-900 mb-8 tracking-tighter leading-tight animate__animated animate__fadeInUp animate__delay-1s">
                        {{ $umkm->nama_usaha }}
                    </h1>
                    
                    <div class="prose prose-slate max-w-none mb-12">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-8 h-[2px] bg-emerald-500"></div>
                            <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Manifesto Usaha</span>
                        </div>
                        <p class="text-slate-500 text-lg leading-relaxed font-light italic">
                            "{{ $umkm->deskripsi }}"
                        </p>
                    </div>

                    {{-- Contact Info Grid - 3 Kolom --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 pt-10 border-t border-slate-50">
                        {{-- Card 1: Founding Member (Pemilik) --}}
                        <div class="group p-6 rounded-[2rem] bg-slate-50 hover:bg-emerald-50 transition-all duration-500 hover:-translate-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Founding Member</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-emerald-600 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-id-badge text-lg"></i>
                                </div>
                                <span class="font-bold text-slate-800 tracking-tight break-words">{{ $umkm->pemilik ?? 'Belum diisi' }}</span>
                            </div>
                        </div>
                        
                        {{-- Card 2: Lokasi Usaha --}}
                        <div class="group p-6 rounded-[2rem] bg-slate-50 hover:bg-blue-50 transition-all duration-500 hover:-translate-y-1">
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Lokasi Usaha</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-blue-600 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-location-dot text-lg"></i>
                                </div>
                                <span class="font-bold text-slate-800 tracking-tight break-words">{{ $umkm->alamat_usaha ?? 'Alamat belum diisi' }}</span>
                            </div>
                        </div>
                        
                        {{-- Card 3: Official Line (WhatsApp) --}}
                        @php
                            $phoneNumber = preg_replace('/[^0-9]/', '', $umkm->no_telepon ?? '');
                            $hasPhone = !empty($phoneNumber);
                        @endphp
                        
                        @if($hasPhone)
                            <a href="https://wa.me/{{ $phoneNumber }}" 
                               target="_blank"
                               class="group p-6 rounded-[2rem] bg-slate-50 hover:bg-green-50 transition-all duration-500 cursor-pointer block hover:-translate-y-1">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 group-hover:text-green-600 transition-colors">Official Line</p>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-green-600 group-hover:bg-green-500 group-hover:text-white transition-all duration-300 group-hover:scale-110">
                                        <i class="fa-brands fa-whatsapp text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <span class="font-bold text-slate-800 tracking-tight group-hover:text-green-600 transition-colors block break-words">{{ $umkm->no_telepon }}</span>
                                        <p class="text-[10px] text-slate-400 group-hover:text-green-500 transition-colors mt-1">Klik untuk chat →</p>
                                    </div>
                                </div>
                            </a>
                        @else
                            <div class="group p-6 rounded-[2rem] bg-slate-50 opacity-60">
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Official Line</p>
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-white shadow-sm flex items-center justify-center text-slate-400">
                                        <i class="fa-brands fa-whatsapp text-xl"></i>
                                    </div>
                                    <div class="flex-1">
                                        <span class="font-bold text-slate-500 tracking-tight block">Nomor tidak tersedia</span>
                                        <p class="text-[10px] text-slate-400 mt-1">Belum diisi</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Product Catalog Section --}}
        <div class="mt-32">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16 gap-6">
                <div class="animate__animated animate__fadeInLeft">
                    <h2 class="text-4xl md:text-5xl font-black text-slate-900 tracking-tighter mb-4 italic">
                        Katalog <span class="text-emerald-500 font-light not-italic">Produk</span>
                    </h2>
                    <p class="text-slate-400 max-w-md font-medium">Kurasi produk terbaik yang dikerjakan dengan penuh ketelitian dan kasih sayang.</p>
                </div>
                
                @auth
                    @if(auth()->id() == $umkm->user_id)
                        @if($umkm->status == 'approved')
                            <button onclick="openModal()" class="group relative px-10 py-5 bg-slate-900 text-white rounded-full font-bold overflow-hidden shadow-2xl transition-all hover:scale-105 active:scale-95">
                                <span class="relative z-10 flex items-center gap-3 tracking-widest text-xs">
                                    <i class="fa-solid fa-plus text-emerald-400"></i> TAMBAH PRODUK BARU
                                </span>
                                <div class="absolute inset-0 bg-emerald-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                            </button>
                        @else
                            <div class="flex items-center gap-4 px-8 py-5 bg-amber-50 text-amber-600 rounded-[2rem] font-bold border border-amber-100/50 shadow-sm animate-pulse">
                                <i class="fa-solid fa-hourglass-half"></i>
                                <span class="text-xs tracking-widest uppercase">Verifikasi Admin Diperlukan</span>
                            </div>
                        @endif
                    @endif
                @endauth
            </div>

            {{-- Grid Daftar Produk --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($umkm->products as $index => $produk)
                    <div class="product-card group bg-white rounded-[3rem] p-5 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.03)] hover:shadow-[0_40px_100px_-20px_rgba(0,0,0,0.08)] transition-all duration-700 hover:-translate-y-4 animate__animated animate__fadeInUp" style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="relative h-64 w-full mb-8 overflow-hidden rounded-[2.5rem] shadow-inner">
                            <img src="{{ asset('storage/'.$produk->foto_produk) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" onerror="this.src='https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400'">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        </div>

                        <div class="px-4">
                            <h4 class="text-2xl font-black text-slate-800 mb-2 group-hover:text-emerald-600 transition-colors line-clamp-1">{{ $produk->nama_produk }}</h4>
                            <div class="flex items-center gap-2 mb-4">
                                <span class="text-emerald-500 font-black text-xl">Rp {{ number_format($produk->harga, 0, ',', '.') }}</span>
                                <div class="h-1 w-1 rounded-full bg-slate-300"></div>
                                <span class="text-[10px] text-slate-400 font-bold uppercase tracking-widest">IDR</span>
                            </div>
                            <p class="text-slate-400 text-sm mb-8 font-light leading-relaxed line-clamp-2">
                                {{ $produk->deskripsi }}
                            </p>
                            
                            @auth
                                @if(auth()->id() == $umkm->user_id)
                                <form action="{{ route('produk.destroy', $produk->id_produk) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full py-4 border border-red-100 text-red-400 font-black rounded-2xl hover:bg-red-500 hover:text-white hover:border-red-500 transition-all duration-500 text-[10px] tracking-[0.2em] uppercase">
                                        <i class="fa-solid fa-trash-can mr-2"></i> Hapus Produk
                                    </button>
                                </form>
                                @elseif($hasPhone)
                                    <a href="https://wa.me/{{ $phoneNumber }}?text=Halo%20{{ urlencode($umkm->nama_usaha) }}%2C%20saya%20tertarik%20dengan%20produk%20{{ urlencode($produk->nama_produk) }}%20dengan%20harga%20Rp%20{{ number_format($produk->harga, 0, ',', '.') }}.%20Apakah%20masih%20tersedia%3F" 
                                       target="_blank"
                                       class="w-full py-4 bg-emerald-50 text-emerald-600 font-black rounded-2xl hover:bg-emerald-600 hover:text-white transition-all duration-500 text-[10px] tracking-[0.2em] uppercase flex items-center justify-center gap-2">
                                        <i class="fa-brands fa-whatsapp"></i> Pesan Sekarang
                                    </a>
                                @else
                                    <button disabled class="w-full py-4 bg-slate-100 text-slate-400 font-black rounded-2xl text-[10px] tracking-[0.2em] uppercase flex items-center justify-center gap-2 cursor-not-allowed">
                                        <i class="fa-brands fa-whatsapp"></i> No WhatsApp
                                    </button>
                                @endif
                            @endauth
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-32 text-center bg-white rounded-[4rem] border border-dashed border-slate-200 animate__animated animate__fadeIn">
                        <div class="text-8xl mb-6 opacity-20">🎨</div>
                        <h3 class="text-2xl font-black text-slate-300 uppercase tracking-[0.3em] italic">Empty Gallery</h3>
                        <p class="text-slate-400 font-light mt-2">Katalog produk masih kosong.</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- ============================================== --}}
{{-- TUTORIAL SECTION PREMIUM --}}
{{-- ============================================== --}}
<div class="tutorial-section">
    <div class="tutorial-header">
        <i class="fa-regular fa-circle-question"></i>
        <h3>📖 Tentang Halaman Detail UMKM</h3>
    </div>
    
    <p class="tutorial-intro">
        Halaman <strong>Detail UMKM</strong> menyajikan informasi lengkap tentang pelaku usaha, 
        produk unggulan, serta cara terhubung dengan pemilik usaha.
    </p>
    
    <div class="tutorial-grid">
        <div class="tutorial-item">
            <div class="tutorial-num">1</div>
            <div class="tutorial-text">
                <h4>🏷️ Informasi Usaha</h4>
                <p>Lihat profil lengkap UMKM termasuk nama usaha, deskripsi, kategori, dan status verifikasi.</p>
            </div>
        </div>
        <div class="tutorial-item">
            <div class="tutorial-num">2</div>
            <div class="tutorial-text">
                <h4>📍 Lokasi & Kontak</h4>
                <p>Temukan alamat lengkap dan nomor WhatsApp pemilik usaha untuk memudahkan komunikasi.</p>
            </div>
        </div>
        <div class="tutorial-item">
            <div class="tutorial-num">3</div>
            <div class="tutorial-text">
                <h4>📦 Katalog Produk</h4>
                <p>Jelajahi berbagai produk unggulan dari UMKM dengan harga dan deskripsi lengkap.</p>
            </div>
        </div>
        <div class="tutorial-item">
            <div class="tutorial-num">4</div>
            <div class="tutorial-text">
                <h4>🛒 Cara Memesan</h4>
                <p>Klik tombol "Pesan Sekarang" untuk terhubung langsung via WhatsApp ke pemilik usaha.</p>
            </div>
        </div>
        <div class="tutorial-item">
            <div class="tutorial-num">5</div>
            <div class="tutorial-text">
                <h4>➕ Tambah Produk (Pemilik)</h4>
                <p>Jika Anda pemilik UMKM, klik tombol "Tambah Produk" untuk menambahkan produk baru.</p>
            </div>
        </div>
        <div class="tutorial-item">
            <div class="tutorial-num">6</div>
            <div class="tutorial-text">
                <h4>✏️ Edit & Hapus (Pemilik)</h4>
                <p>Kelola produk Anda dengan mudah - edit informasi atau hapus produk yang tidak tersedia.</p>
            </div>
        </div>
    </div>
    
    <div class="tutorial-footer">
        <i class="fa-regular fa-lightbulb"></i>
        <span>💡 <strong>Tips Penting:</strong> Selalu konfirmasi ketersediaan produk dan harga sebelum melakukan transaksi. Jangan ragu untuk bertanya detail produk kepada pemilik UMKM.</span>
    </div>
</div>

<style>
    /* Tutorial Section Styles */
    .tutorial-section {
        margin-top: 2rem;
        background: linear-gradient(135deg, #ffffff, #ffffff);
        border-radius: 28px;
        padding: 1.5rem;
        border: 1px solid #eef2f6;
        transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
    }

    .tutorial-section:hover {
        border-color: #10b981;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        transform: translateY(-2px);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid #eef2f6;
        padding-bottom: 0.8rem;
    }

    .tutorial-header i {
        font-size: 1.3rem;
        color: #10b981;
    }

    .tutorial-header h3 {
        font-size: 0.95rem;
        font-weight: 700;
        margin: 0;
        color: #0f172a;
    }

    .tutorial-intro {
        font-size: 0.8rem;
        color: #64748b;
        margin-bottom: 1.2rem;
        line-height: 1.5;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0.8rem;
        margin-bottom: 1rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.6rem;
        padding: 0.6rem;
        border-radius: 16px;
        transition: all 0.3s cubic-bezier(0.34, 1.2, 0.64, 1);
        cursor: pointer;
    }

    .tutorial-item:hover {
        background: rgba(16, 185, 129, 0.08);
        transform: translateX(5px);
    }

    .tutorial-num {
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.75rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .tutorial-item:hover .tutorial-num {
        transform: scale(1.1);
    }

    .tutorial-text h4 {
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 0.2rem;
        color: #0f172a;
    }

    .tutorial-text p {
        font-size: 0.65rem;
        color: #64748b;
        line-height: 1.4;
    }

    .tutorial-footer {
        margin-top: 0.8rem;
        padding: 0.7rem 0.9rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
        transition: all 0.3s ease;
    }

    .tutorial-footer:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .tutorial-footer i {
        color: #10b981;
        font-size: 0.8rem;
    }

    .tutorial-footer span {
        font-size: 0.7rem;
        color: #059669;
        line-height: 1.4;
    }

    @media (max-width: 1024px) {
        .tutorial-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .tutorial-section {
            padding: 1rem;
        }
        .tutorial-grid {
            grid-template-columns: 1fr;
        }
        .tutorial-header h3 {
            font-size: 0.85rem;
        }
        .tutorial-intro {
            font-size: 0.7rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Interactive tutorial items with smooth scroll hints
        const tutorialItems = document.querySelectorAll('.tutorial-item');
        
        tutorialItems.forEach((item, index) => {
            item.addEventListener('click', function() {
                // Add click feedback animation
                this.style.transform = 'scale(0.98)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
                
                // Get the section name from tutorial text
                const sectionName = this.querySelector('.tutorial-text h4').innerText;
                
                // Optional: Show toast notification
                showTutorialToast(`💡 ${sectionName} - Klik pada elemen terkait untuk mencoba`);
            });
        });
        
        // Toast notification function
        function showTutorialToast(message) {
            // Remove existing toast
            const existingToast = document.querySelector('.tutorial-toast');
            if (existingToast) existingToast.remove();
            
            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'tutorial-toast';
            toast.innerHTML = `
                <i class="fa-regular fa-lightbulb"></i>
                <span>${message}</span>
            `;
            toast.style.cssText = `
                position: fixed;
                bottom: 20px;
                right: 20px;
                background: linear-gradient(135deg, #10b981, #059669);
                color: white;
                padding: 10px 16px;
                border-radius: 40px;
                font-size: 0.75rem;
                font-weight: 500;
                z-index: 9999;
                display: flex;
                align-items: center;
                gap: 8px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                animation: slideInRight 0.3s ease;
                pointer-events: none;
            `;
            
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.animation = 'slideOutRight 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }
        
        // Add animation keyframes if not exists
        if (!document.querySelector('#tutorial-animations')) {
            const style = document.createElement('style');
            style.id = 'tutorial-animations';
            style.textContent = `
                @keyframes slideInRight {
                    from {
                        opacity: 0;
                        transform: translateX(100px);
                    }
                    to {
                        opacity: 1;
                        transform: translateX(0);
                    }
                }
                @keyframes slideOutRight {
                    from {
                        opacity: 1;
                        transform: translateX(0);
                    }
                    to {
                        opacity: 0;
                        transform: translateX(100px);
                    }
                }
            `;
            document.head.appendChild(style);
        }
        
        // Add scroll animation for tutorial section
        const tutorialSection = document.querySelector('.tutorial-section');
        if (tutorialSection) {
            tutorialSection.style.opacity = '0';
            tutorialSection.style.transform = 'translateY(20px)';
            tutorialSection.style.transition = 'all 0.6s ease';
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, { threshold: 0.1 });
            
            observer.observe(tutorialSection);
        }
    });
</script>

    </div>
</div>

{{-- MODAL TAMBAH PRODUK --}}
<div id="modalTambahProduk" class="fixed inset-0 bg-slate-900/5 backdrop-blur-xl hidden items-center justify-center z-[9999] p-6 transition-all duration-1000" onclick="if(event.target===this) closeModal()">
    <div class="bg-white max-w-lg w-full rounded-[3.5rem] shadow-[0_40px_120px_-20px_rgba(0,0,0,0.06)] relative scale-95 opacity-0 transition-all duration-700 ease-[cubic-bezier(0.23,1,0.32,1)] overflow-hidden" id="modalContent">
        
        <div class="absolute top-0 left-0 w-full h-[3px] bg-slate-50">
            <div class="h-full bg-emerald-500/40 w-0 transition-all duration-700" id="formProgress"></div>
        </div>

        <div class="p-12 md:p-16">
            <header class="mb-14 relative">
                <span class="text-[9px] font-black uppercase tracking-[0.4em] text-emerald-600/60 mb-2 block animate-fadeIn">Produk Baru</span>
                <h3 class="text-4xl font-light text-slate-900 tracking-tighter leading-none">
                    Lengkapi <span class="font-serif italic text-slate-400">Katalog</span>
                </h3>
                <button onclick="closeModal()" class="absolute -top-4 -right-4 w-10 h-10 flex items-center justify-center text-slate-300 hover:text-slate-900 transition-all duration-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </header>

            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data" class="space-y-12" id="productForm">
                @csrf
                <input type="hidden" name="umkm_id" value="{{ $umkm->id_umkm }}">

                <div class="space-y-10">
                    <div class="relative group">
                        <label class="text-[14px] font-bold uppercase tracking-[0.2em] text-slate-300 group-focus-within:text-emerald-500 transition-colors duration-300">Nama Produk</label>
                        <input type="text" name="nama_produk" required oninput="updateProgress()"
                            class="w-full bg-transparent border-b border-slate-100 py-3 outline-none focus:border-slate-900 transition-all duration-700 font-light text-lg text-slate-800 placeholder-slate-200"
                            placeholder="Nama produk Anda...">
                    </div>

                    <div class="grid grid-cols-2 gap-12">
                        <div class="relative group">
                            <label class="text-[14px] font-bold uppercase tracking-[0.2em] text-slate-300 group-focus-within:text-emerald-500 transition-colors duration-300">Harga</label>
                            <input type="number" name="harga" required oninput="updateProgress()"
                                class="w-full bg-transparent border-b border-slate-100 py-3 outline-none focus:border-slate-900 transition-all duration-700 font-medium text-slate-800 placeholder-slate-200"
                                placeholder="0">
                        </div>

                        <div class="relative group border-b border-slate-100 focus-within:border-slate-900 transition-all duration-700">
                            <label class="text-[14px] font-bold uppercase tracking-[0.2em] text-slate-300 group-focus-within:text-emerald-500 transition-colors duration-300">Gambar</label>
                            <input type="file" name="foto" required class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="updateFileName(this); updateProgress();">
                            <div class="flex justify-between items-center py-3">
                                <span id="fileNameDisplay" class="text-xs font-light text-slate-300 truncate tracking-wide">Pilih File</span>
                                <svg class="w-3 h-3 text-slate-300 group-hover:text-slate-900 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <label class="text-[14px] font-bold uppercase tracking-[0.2em] text-slate-300 group-focus-within:text-emerald-500 transition-colors duration-300">Deskripsi</label>
                        <textarea name="deskripsi" rows="1" oninput="updateProgress()"
                            class="w-full bg-transparent border-b border-slate-100 py-3 outline-none focus:border-slate-900 transition-all duration-700 font-light text-slate-500 placeholder-slate-200 resize-none"
                            placeholder="Ceritakan singkat..."></textarea>
                    </div>
                </div>

                <div class="pt-8 text-center">
                    <button type="submit" class="group relative inline-flex items-center justify-center px-12 py-5 bg-slate-900 text-white rounded-full overflow-hidden transition-all duration-500 hover:px-16 active:scale-95">
                        <span class="relative z-10 text-[10px] font-black uppercase tracking-[0.5em] transition-all group-hover:tracking-[0.6em]">Simpan</span>
                        <div class="absolute inset-0 bg-emerald-600 translate-y-full group-hover:translate-y-0 transition-transform duration-500"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fadeIn { animation: fadeIn 1s ease-out forwards; }

    #modalTambahProduk.flex { display: flex !important; }
    #modalContent.active { transform: scale(1); opacity: 1; }

    input::-webkit-outer-spin-button, input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
    textarea:focus { min-height: 80px; }
    
    .line-clamp-1 {
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .break-words {
        word-break: break-word;
    }
</style>

<script>
    function openModal() {
        const modal = document.getElementById('modalTambahProduk');
        const content = document.getElementById('modalContent');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        setTimeout(() => {
            content.classList.remove('scale-90', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        const modal = document.getElementById('modalTambahProduk');
        const content = document.getElementById('modalContent');
        content.classList.add('scale-90', 'opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 500);
        document.body.style.overflow = 'auto';
    }
    
    function updateFileName(input) {
        const display = document.getElementById('fileNameDisplay');
        if (input.files.length > 0) {
            display.innerText = input.files[0].name;
            display.classList.remove('text-slate-300');
            display.classList.add('text-slate-900', 'font-medium');
        }
    }

    function updateProgress() {
        const form = document.getElementById('productForm');
        const progress = document.getElementById('formProgress');
        const inputs = form.querySelectorAll('input[required], textarea[required]');
        let filled = 0;
        
        inputs.forEach(input => {
            if (input.type === 'file') {
                if (input.files.length > 0) filled++;
            } else {
                if (input.value.trim() !== '') filled++;
            }
        });

        const percentage = (filled / inputs.length) * 100;
        if (progress) progress.style.width = percentage + '%';
    }
    
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const modal = document.getElementById('modalTambahProduk');
            if (modal && !modal.classList.contains('hidden')) {
                closeModal();
            }
        }
    });
</script>
@endsection