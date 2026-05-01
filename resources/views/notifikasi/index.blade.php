{{-- resources/views/notifikasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Notification Center')

@section('content')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
    
    body { font-family: 'Plus Jakarta Sans', sans-serif; }

    .glass-card {
        background: rgba(255, 255, 255, 0.7);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.4);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.04);
    }

    .notif-item {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .notif-item:hover {
        transform: translateX(8px);
        background: white;
    }

    .filter-tab.active {
        background: #0ea5e9; /* Sky-500 */
        color: white;
        box-shadow: 0 10px 15px -3px rgba(14, 165, 233, 0.3);
    }

    @keyframes fadeInScale {
        from { opacity: 0; transform: scale(0.98) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }

    .animate-list {
        animation: fadeInScale 0.6s ease-out forwards;
    }
</style>

<div class="min-h-screen bg-[#fcfcfd] py-12 px-4 sm:px-6">
    <div class="max-w-5xl mx-auto">
        
        <!-- Top Header & Action -->
        <div class="flex flex-col lg:flex-row lg:items-center justify-between mb-12 gap-6">
            <div>
                <h1 class="text-4xl font-[800] text-slate-900 tracking-tight mb-2">Pusat Notifikasi</h1>
                <p class="text-slate-500 font-medium">Pantau aktivitas dan kelola pemberitahuan dalam satu tempat.</p>
            </div>
            
            <div class="flex items-center gap-3 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                <button onclick="bacaSemua()" class="group px-4 py-2 text-sm font-semibold text-slate-600 hover:text-emerald-600 transition-colors flex items-center gap-2">
                    <i class="fa-solid fa-check-double transition-transform group-hover:scale-110"></i>
                    Tandai Semua Dibaca
                </button>
                <div class="w-[1px] h-6 bg-slate-200"></div>
                <button onclick="hapusSemua()" class="group px-4 py-2 text-sm font-semibold text-red-500 hover:bg-red-50 rounded-xl transition-all flex items-center gap-2">
                    <i class="fa-regular fa-trash-can transition-transform group-hover:shake"></i>
                    Bersihkan
                </button>
            </div>
        </div>

        <!-- Interactive Filter Tabs -->
        <div class="flex flex-wrap items-center gap-2 mb-8 p-1.5 bg-slate-100/50 rounded-[22px] w-fit border border-slate-200/60">
            <button onclick="filterNotif('all')" class="filter-tab active px-6 py-2.5 rounded-[18px] text-sm font-bold transition-all duration-300" data-filter="all">
                Semua
            </button>
            <button onclick="filterNotif('pengajuan_surat')" class="filter-tab px-6 py-2.5 rounded-[18px] text-sm font-bold text-slate-500 hover:text-slate-800 transition-all duration-300" data-filter="pengajuan_surat">
                Surat
            </button>
            <button onclick="filterNotif('aspirasi')" class="filter-tab px-6 py-2.5 rounded-[18px] text-sm font-bold text-slate-500 hover:text-slate-800 transition-all duration-300" data-filter="aspirasi">
                Aspirasi
            </button>
            <button onclick="filterNotif('umkm')" class="filter-tab px-6 py-2.5 rounded-[18px] text-sm font-bold text-slate-500 hover:text-slate-800 transition-all duration-300" data-filter="umkm">
                UMKM
            </button>
        </div>

        <!-- List Container -->
        <div class="glass-card rounded-[32px] overflow-hidden border border-white animate-list">
            <div id="notification-list" class="divide-y divide-slate-100/80">
                @forelse($notifikasi as $notif)
                <div class="notif-item group p-6 sm:p-8 relative {{ !$notif->dibaca ? 'bg-sky-50/20' : '' }}" data-category="{{ $notif->jenis }}">
                    <div class="flex items-start gap-6">
                        <!-- Icon dengan Ring Dinamis -->
                        <div class="relative flex-shrink-0">
                            <div class="w-16 h-16 rounded-[24px] flex items-center justify-center transition-all duration-500 group-hover:rotate-[10deg] shadow-lg
                                @if($notif->jenis == 'pengajuan_surat') bg-gradient-to-br from-emerald-400 to-emerald-600 text-white
                                @elseif($notif->jenis == 'aspirasi') bg-gradient-to-br from-sky-400 to-sky-600 text-white
                                @elseif($notif->jenis == 'umkm') bg-gradient-to-br from-amber-400 to-amber-600 text-white
                                @else bg-gradient-to-br from-slate-400 to-slate-600 text-white @endif">
                                <i class="text-2xl
                                    @if($notif->jenis == 'pengajuan_surat') fa-solid fa-envelope-open-text
                                    @elseif($notif->jenis == 'aspirasi') fa-solid fa-lightbulb
                                    @elseif($notif->jenis == 'umkm') fa-solid fa-shop
                                    @else fa-solid fa-bell @endif">
                                </i>
                            </div>
                            @if(!$notif->dibaca)
                                <div class="absolute -top-1 -right-1 flex h-4 w-4">
                                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-sky-400 opacity-75"></span>
                                    <span class="relative inline-flex rounded-full h-4 w-4 bg-sky-500 border-2 border-white"></span>
                                </div>
                            @endif
                        </div>

                        <!-- Content Body -->
                        <div class="flex-1 min-w-0">
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2 mb-2">
                                <h3 class="text-xl font-bold text-slate-800 leading-tight group-hover:text-sky-600 transition-colors">
                                    {{ $notif->judul }}
                                </h3>
                                <span class="text-[11px] font-extrabold uppercase tracking-widest text-slate-400 bg-slate-50 px-3 py-1 rounded-full border border-slate-100">
                                    {{ $notif->created_at->diffForHumans() }}
                                </span>
                            </div>
                            <p class="text-slate-500 leading-relaxed text-sm sm:text-base mb-6 line-clamp-2">
                                {{ $notif->pesan }}
                            </p>
                            
                            <div class="flex items-center justify-between">
                                <div class="flex gap-4">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-bold uppercase tracking-wider">
                                        <i class="fa-solid fa-tag opacity-50"></i>
                                        {{ str_replace('_', ' ', $notif->jenis) }}
                                    </span>
                                </div>

                                <!-- Hover Actions -->
                                <div class="flex gap-2 opacity-0 group-hover:opacity-100 transform translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                    <a href="{{ $notif->link }}" onclick="bacaNotif({{ $notif->id }})" class="flex items-center gap-2 px-5 py-2.5 bg-sky-500 text-white text-sm font-bold rounded-2xl hover:bg-sky-600 shadow-lg shadow-sky-100 transition-all">
                                        <span>Tinjau</span>
                                        <i class="fa-solid fa-arrow-right-long"></i>
                                    </a>
                                    <button onclick="hapusNotif({{ $notif->id }})" class="p-2.5 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition-all">
                                        <i class="fa-regular fa-trash-can"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div id="empty-state" class="py-32 text-center">
                    <div class="w-32 h-32 bg-slate-50 rounded-[40px] flex items-center justify-center mx-auto mb-6 rotate-12">
                        <i class="fa-solid fa-inbox text-5xl text-slate-200"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-800">Semua Terbaca!</h3>
                    <p class="text-slate-400 mt-2 font-medium">Kotak masuk Anda sedang beristirahat sekarang.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination (Opsional jika ingin pakai filter Frontend) -->
        <div class="mt-12 px-2">
            {{ $notifikasi->links() }}
        </div>
    </div>
</div>

<script>
    // Filter Logic (Frontend Version untuk interaksi instan)
    function filterNotif(category) {
        // Update Tab UI
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.classList.remove('active', 'text-white');
            tab.classList.add('text-slate-500');
        });
        const activeTab = document.querySelector(`[data-filter="${category}"]`);
        activeTab.classList.add('active');
        activeTab.classList.remove('text-slate-500');

        // Filter Items
        const items = document.querySelectorAll('.notif-item');
        let hasVisible = false;

        items.forEach(item => {
            item.style.display = 'block';
            item.style.opacity = '0';
            
            if (category === 'all' || item.getAttribute('data-category') === category) {
                item.style.display = 'block';
                setTimeout(() => item.style.opacity = '1', 10);
                hasVisible = true;
            } else {
                item.style.display = 'none';
            }
        });

        // Toggle Empty State if none match
        const emptyState = document.getElementById('empty-state');
        if (emptyState) {
            emptyState.style.display = hasVisible ? 'none' : 'block';
        }
    }

    // API Actions
    function bacaNotif(id) {
        fetch('{{ route("notifikasi.baca") }}', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: JSON.stringify({ id: id })
        });
    }
    
    function bacaSemua() {
        if(confirm('Tandai semua sebagai dibaca?')) {
            fetch('{{ route("notifikasi.baca-semua") }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => location.reload());
        }
    }
    
    function hapusNotif(id) {
        if(confirm('Hapus notifikasi ini?')) {
            fetch('/notifikasi/' + id, {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => location.reload());
        }
    }

    function hapusSemua() {
        if(confirm('Bersihkan semua notifikasi?')) {
            fetch('{{ route("notifikasi.hapus-semua") }}', {
                method: 'DELETE',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => location.reload());
        }
    }
</script>
@endsection