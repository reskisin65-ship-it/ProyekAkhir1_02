{{-- 
    File: resources/views/masyarakat/aspirasi/show.blade.php
    Theme: Glassmorphism Ultra Elegant with Slide Up Animation
--}}

@extends('layouts.app')

@section('title', 'Detail Aspirasi - Lumban Silintong')

@section('content')

<!-- PRE-LOAD ASSETS -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    :root {
        --glass-bg: rgba(255, 255, 255, 0.7);
        --glass-border: rgba(255, 255, 255, 0.4);
        --accent-blue: #3b82f6;
        --accent-emerald: #10b981;
        --accent-amber: #f59e0b;
        --dark: #0f172a;
        --gray: #64748b;
        --border: #eef2f6;
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(135deg, #f8fafc 0%, #eff6ff 100%);
        min-height: 100vh;
    }

    .font-serif-premium { font-family: 'Instrument Serif', serif; }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: #94a3b8; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--accent-blue); }

    /* Container */
    .container-premium {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Slide Up Animation */
    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(40px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    @keyframes slideUpDelay {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes slideUpSlow {
        from { opacity: 0; transform: translateY(50px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-slide-up { animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; }
    .animate-slide-up-delay { animation: slideUpDelay 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; animation-delay: 0.1s; }
    .animate-slide-up-slow { animation: slideUpSlow 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; animation-delay: 0.2s; }
    .animate-slide-up-late { animation: slideUpSlow 0.7s cubic-bezier(0.16, 1, 0.3, 1) forwards; opacity: 0; animation-delay: 0.3s; }

    /* Glass Effect */
    .glass-card {
        background: var(--glass-bg);
        backdrop-filter: blur(20px) saturate(180%);
        -webkit-backdrop-filter: blur(20px) saturate(180%);
        border: 1px solid var(--glass-border);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.05);
        border-radius: 40px;
        overflow: hidden;
    }

    .glass-item {
        background: rgba(255, 255, 255, 0.5);
        border: 1px solid rgba(255, 255, 255, 0.8);
        border-radius: 24px;
        transition: var(--transition-bounce);
    }

    .glass-item:hover {
        transform: translateY(-3px);
        background: #ffffff;
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.05);
    }

    /* Back Button */
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 600;
        color: var(--gray);
        transition: var(--transition);
        margin-bottom: 1.5rem;
    }

    .back-link .back-icon {
        width: 40px;
        height: 40px;
        border-radius: 40px;
        border: 1px solid #e2e8f0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: white;
        transition: var(--transition);
    }

    .back-link:hover {
        color: var(--accent-blue);
    }

    .back-link:hover .back-icon {
        border-color: var(--accent-blue);
        background: rgba(59, 130, 246, 0.05);
    }

    /* Header Section */
    .glass-header {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.5);
        background: rgba(255, 255, 255, 0.3);
    }

    .info-badge {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        padding: 0.3rem 1rem;
        background: #dbeafe;
        color: var(--accent-blue);
        border-radius: 40px;
        display: inline-block;
    }

    /* Status Badge */
    .status-badge {
        padding: 0.5rem 1.5rem;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-baru { background: #fef3c7; color: #d97706; }
    .status-diproses { background: #dbeafe; color: #2563eb; }
    .status-selesai { background: #d1fae5; color: #059669; }

    /* Info Label */
    .info-label {
        font-size: 0.65rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: #94a3b8;
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .info-label i { font-size: 0.6rem; color: var(--accent-blue); }

    /* Content Area */
    .aspirasi-content {
        background: #f8fafc;
        border-radius: 28px;
        padding: 1.5rem;
        border: 1px solid var(--border);
        line-height: 1.7;
        color: var(--dark);
    }

    /* Response Card */
    .response-card {
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 28px;
        padding: 1.5rem;
        border-left: 4px solid var(--accent-emerald);
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        flex-wrap: wrap;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid var(--border);
    }

    .btn-primary {
        padding: 0.8rem 1.8rem;
        background: var(--dark);
        color: white;
        border: none;
        border-radius: 60px;
        font-weight: 700;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        cursor: pointer;
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .btn-primary:hover {
        background: var(--accent-blue);
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.25);
    }

    .btn-danger {
        padding: 0.8rem 1.8rem;
        background: white;
        border: 1px solid var(--border);
        color: #dc2626;
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        cursor: pointer;
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .btn-danger:hover {
        border-color: #dc2626;
        background: #fef2f2;
        transform: translateY(-2px);
    }

    .btn-secondary {
        padding: 0.8rem 1.8rem;
        background: transparent;
        border: 1px solid var(--border);
        color: var(--gray);
        border-radius: 60px;
        font-weight: 600;
        font-size: 0.85rem;
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        text-decoration: none;
        transition: var(--transition-bounce);
    }

    .btn-secondary:hover {
        border-color: var(--accent-blue);
        color: var(--accent-blue);
        background: rgba(59, 130, 246, 0.05);
        transform: translateY(-2px);
    }

    /* Tutorial Section */
    .tutorial-section {
        margin-top: 2rem;
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        border-radius: 28px;
        padding: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.5);
        transition: var(--transition);
    }

    .tutorial-section:hover {
        border-color: var(--accent-blue);
        box-shadow: 0 12px 32px rgba(0, 0, 0, 0.05);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i { font-size: 1.3rem; color: var(--accent-blue); }
    .tutorial-header h3 { font-size: 0.9rem; font-weight: 700; margin: 0; }

    .tutorial-intro {
        font-size: 0.8rem;
        color: var(--gray);
        margin-bottom: 1.2rem;
        line-height: 1.5;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.6rem;
        border-radius: 16px;
        transition: var(--transition);
    }

    .tutorial-item:hover {
        background: rgba(59, 130, 246, 0.08);
        transform: translateX(3px);
    }

    .tutorial-num {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--accent-blue), #2563eb);
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.8rem;
        flex-shrink: 0;
    }

    .tutorial-text h4 { font-size: 0.8rem; font-weight: 700; margin-bottom: 0.2rem; }
    .tutorial-text p { font-size: 0.7rem; color: var(--gray); line-height: 1.4; }

    .tutorial-footer {
        margin-top: 1rem;
        padding: 0.8rem 1rem;
        background: #eff6ff;
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }

    .tutorial-footer i { color: var(--accent-blue); font-size: 0.8rem; }
    .tutorial-footer span { font-size: 0.7rem; color: #1e40af; }

    /* Responsive */
    @media (max-width: 1024px) {
        .container-premium { padding: 1rem; }
        .tutorial-grid { grid-template-columns: 1fr; }
    }

    @media (max-width: 768px) {
        .glass-header { padding: 1rem; }
        .action-buttons { flex-direction: column; }
        .btn-primary, .btn-danger, .btn-secondary { justify-content: center; }
    }
    /* ============================================
   FIX OVERFLOW - Agar teks tidak memanjang ke samping
   ============================================ */
* {
    max-width: 100%;
    box-sizing: border-box;
}

/* Perbaikan untuk semua teks panjang */
.aspirasi-content,
.response-card p,
.tutorial-text p,
.info-content p,
.glass-item p,
h1, h2, h3, h4, p, span, div {
    word-wrap: break-word;
    overflow-wrap: break-word;
    word-break: break-word;
    white-space: normal;
}

/* Khusus untuk konten aspirasi */
.aspirasi-content {
    word-break: break-word;
    overflow-wrap: break-word;
    white-space: normal;
    overflow-x: auto;
}

/* Untuk elemen yang mungkin overflow */
.glass-card,
.glass-item,
.card-body,
.form-card {
    overflow-x: hidden;
}

/* Responsive untuk teks panjang di mobile */
@media (max-width: 768px) {
    .aspirasi-content {
        font-size: 0.85rem;
        padding: 1rem;
    }
    
    .response-card p {
        font-size: 0.8rem;
    }
}
</style>

<div class="container-premium">
    
    {{-- Back Button --}}
    <a href="{{ route('masyarakat.aspirasi.index') }}" class="back-link animate-slide-up">
        <div class="back-icon">
            <i class="fa-solid fa-arrow-left"></i>
        </div>
        <span>Kembali ke Aspirasi Saya</span>
    </a>

    {{-- Main Glass Card --}}
    <div class="glass-card animate-slide-up-slow">
        
        {{-- Header --}}
        <div class="glass-header">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <div class="info-badge mb-2">
                        <i class="fa-regular fa-id-card mr-1"></i> ID: #{{ str_pad($aspirasi->id_aspirasi, 5, '0', STR_PAD_LEFT) }}
                    </div>
                    <h1 class="text-3xl md:text-4xl font-serif-premium text-slate-900">
                        Detail <span class="text-blue-600 italic">Aspirasi</span>
                    </h1>
                </div>
                <div class="status-badge status-{{ $aspirasi->status }}">
                    @if($aspirasi->status == 'baru') 
                        <i class="fa-regular fa-clock"></i> Menunggu Tanggapan
                    @elseif($aspirasi->status == 'diproses') 
                        <i class="fa-solid fa-spinner fa-spin"></i> Sedang Diproses
                    @else 
                        <i class="fa-regular fa-circle-check"></i> Selesai Ditanggapi
                    @endif
                </div>
            </div>
        </div>

        {{-- Body --}}
        <div style="padding: 2rem;">
            <div class="grid md:grid-cols-12 gap-8">
                
                {{-- Left Side: Meta Info --}}
                <div class="md:col-span-5 space-y-4">
                    <div class="glass-item p-5 animate-slide-up-delay">
                        <div class="info-label">
                            <i class="fa-regular fa-tag"></i> Kategori Laporan
                        </div>
                        <div class="flex items-center gap-3 mt-2">
                            <div class="text-2xl">
                                @if($aspirasi->kategori == 'saran') 💡
                                @elseif($aspirasi->kategori == 'keluhan') 😞
                                @elseif($aspirasi->kategori == 'masukan') 📝
                                @else ❓ @endif
                            </div>
                            <p class="text-lg font-bold text-slate-800 capitalize">
                                @if($aspirasi->kategori == 'saran') Saran
                                @elseif($aspirasi->kategori == 'keluhan') Keluhan
                                @elseif($aspirasi->kategori == 'masukan') Masukan
                                @else Pertanyaan @endif
                            </p>
                        </div>
                    </div>

                    <div class="glass-item p-5 animate-slide-up-delay" style="animation-delay: 0.15s">
                        <div class="info-label">
                            <i class="fa-regular fa-calendar"></i> Metadata Dokumen
                        </div>
                        <div class="mt-4 space-y-3">
                            <div class="flex justify-between items-center border-b border-slate-100 pb-2">
                                <span class="text-xs text-slate-500">Diajukan</span>
                                <span class="text-xs font-semibold text-slate-800">{{ $aspirasi->created_at->translatedFormat('d M Y') }}</span>
                            </div>
                            <div class="flex justify-between items-center border-b border-slate-100 pb-2">
                                <span class="text-xs text-slate-500">Waktu</span>
                                <span class="text-xs font-semibold text-slate-800">{{ $aspirasi->created_at->format('H:i') }} WIB</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-xs text-slate-500">Pelapor</span>
                                <span class="text-xs font-semibold text-slate-800">{{ Auth::user()->name }}</span>
                            </div>
                        </div>
                    </div>

                    @if($aspirasi->lampiran)
                    <a href="{{ Storage::url($aspirasi->lampiran) }}" target="_blank" class="glass-item p-5 block group animate-slide-up-delay" style="animation-delay: 0.2s">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-blue-500 text-white flex items-center justify-center shadow-md group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-paperclip text-sm"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-semibold text-slate-800">Lampiran Dokumen</p>
                                    <p class="text-xs text-slate-400">Klik untuk melihat file</p>
                                </div>
                            </div>
                            <i class="fa-solid fa-chevron-right text-slate-300 group-hover:translate-x-1 transition-transform"></i>
                        </div>
                    </a>
                    @endif
                </div>

                {{-- Right Side: Content --}}
                <div class="md:col-span-7 space-y-6">
                    <div class="animate-slide-up-delay" style="animation-delay: 0.1s">
                        <div class="info-label mb-2">
                            <i class="fa-solid fa-heading"></i> Subjek Utama
                        </div>
                        <h2 class="text-2xl font-bold text-slate-900 leading-tight">
                            {{ $aspirasi->judul }}
                        </h2>
                    </div>

                    <div class="animate-slide-up-delay" style="animation-delay: 0.2s">
                        <div class="info-label mb-2">
                            <i class="fa-solid fa-message"></i> Isi Aspirasi
                        </div>
                        <div class="aspirasi-content">
                            <i class="fa-solid fa-quote-left text-blue-400 text-sm mr-1"></i>
                            {{ $aspirasi->isi_aspirasi ?? $aspirasi->isi }}
                        </div>
                    </div>

                    {{-- Response Section --}}
                    @if(($aspirasi->respon_admin ?? $aspirasi->respon))
                    <div class="response-card animate-slide-up-late">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-md">
                                <i class="fa-solid fa-reply-all text-sm"></i>
                            </div>
                            <h3 class="font-bold text-emerald-700">Tanggapan Perangkat Desa</h3>
                        </div>
                        <p class="text-emerald-800 leading-relaxed">
                            {{ $aspirasi->respon_admin ?? $aspirasi->respon }}
                        </p>
                        <div class="mt-4 pt-3 border-t border-emerald-200 flex justify-between items-center text-[10px] text-emerald-600 font-semibold uppercase tracking-wider">
                            <span>Admin Desa Lumban Silintong</span>
                            <span>{{ $aspirasi->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                    @elseif($aspirasi->status == 'diproses')
                    <div class="response-card animate-slide-up-late" style="background: linear-gradient(135deg, #eff6ff, #dbeafe); border-left-color: #3b82f6;">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-blue-500 text-white flex items-center justify-center shadow-md">
                                <i class="fa-solid fa-spinner fa-spin"></i>
                            </div>
                            <h3 class="font-bold text-blue-700">Sedang Diproses</h3>
                        </div>
                        <p class="text-blue-700 leading-relaxed">
                            Aspirasi Anda sedang diproses oleh admin desa. Mohon tunggu tanggapan dalam 1-3 hari kerja.
                        </p>
                    </div>
                    @elseif($aspirasi->status == 'baru')
                    <div class="response-card animate-slide-up-late" style="background: linear-gradient(135deg, #fef3c7, #fde68a); border-left-color: #d97706;">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 rounded-full bg-amber-500 text-white flex items-center justify-center shadow-md">
                                <i class="fa-regular fa-bell"></i>
                            </div>
                            <h3 class="font-bold text-amber-700">Menunggu Respons</h3>
                        </div>
                        <p class="text-amber-700 leading-relaxed">
                            Aspirasi Anda telah terkirim dan akan segera ditanggapi oleh admin desa.
                        </p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="action-buttons animate-slide-up-late">
                @if($aspirasi->status == 'baru')
                <form action="{{ route('masyarakat.aspirasi.destroy', $aspirasi->id_aspirasi) }}" method="POST" onsubmit="return confirm('Yakin ingin membatalkan aspirasi ini?')" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-danger">
                        <i class="fa-solid fa-trash"></i> Batalkan Pengajuan
                    </button>
                </form>
                <a href="{{ route('masyarakat.aspirasi.edit', $aspirasi->id_aspirasi) }}" class="btn-primary">
                    <i class="fa-solid fa-pen"></i> Edit Aspirasi
                </a>
                @endif
                <a href="{{ route('masyarakat.aspirasi.index') }}" class="btn-secondary">
                    <i class="fa-solid fa-arrow-left"></i> Tutup Detail
                </a>
            </div>
        </div>
    </div>

    {{-- Tutorial Section --}}
    <div class="tutorial-section animate-slide-up-late" style="animation-delay: 0.4s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Ini</h3>
        </div>
        
        <p class="tutorial-intro">
            Halaman <strong>Detail Aspirasi</strong> menampilkan informasi lengkap tentang aspirasi yang Anda kirimkan, 
            termasuk status, isi aspirasi, dan tanggapan dari admin desa.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📊 Informasi Lengkap</h4>
                    <p>Lihat detail aspirasi termasuk kategori, tanggal pengajuan, dan status terkini.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>📎 Lampiran Dokumen</h4>
                    <p>Jika ada lampiran, klik untuk melihat file pendukung aspirasi Anda.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>💬 Tanggapan Admin</h4>
                    <p>Baca tanggapan atau respon dari perangkat desa terhadap aspirasi Anda.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>✏️ Edit / Batalkan</h4>
                    <p>Jika status masih <strong>"Baru"</strong>, Anda dapat mengedit atau membatalkan aspirasi.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">💡</div>
                <div class="tutorial-text">
                    <h4>Tips Penting</h4>
                    <p>Simpan nomor ID aspirasi untuk referensi jika perlu menghubungi admin desa.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">⏱️</div>
                <div class="tutorial-text">
                    <h4>Waktu Respons</h4>
                    <p>Aspirasi akan ditanggapi maksimal 3 hari kerja setelah status berubah menjadi "Diproses".</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-clock"></i>
            <span>⏱️ <strong>Perlu diingat:</strong> Edit hanya dapat dilakukan jika status aspirasi masih <strong>"Baru/Menunggu"</strong>.</span>
        </div>
    </div>
</div>

<script>
    // Smooth hover effect for glass card
    const card = document.querySelector('.glass-card');
    if (card) {
        card.style.transition = 'transform 0.3s ease, box-shadow 0.3s ease';
        card.addEventListener('mouseenter', () => {
            card.style.transform = 'translateY(-4px)';
            card.style.boxShadow = '0 30px 60px -12px rgba(0, 0, 0, 0.15)';
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'translateY(0)';
            card.style.boxShadow = '0 25px 50px -12px rgba(0, 0, 0, 0.05)';
        });
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endsection