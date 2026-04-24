{{-- resources/views/notifikasi/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Semua Notifikasi')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/30 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-wrap justify-between items-center mb-6 gap-4">
            <div class="flex items-center gap-3">
                <div class="w-12 h-12 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-2xl flex items-center justify-center shadow-lg">
                    <i class="fa-regular fa-bell text-white text-2xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Semua Notifikasi</h1>
                    <p class="text-sm text-gray-500">Kelola semua pemberitahuan Anda</p>
                </div>
            </div>
            
            <div class="flex gap-3">
                <button onclick="bacaSemua()" 
                        class="px-4 py-2 bg-emerald-500 hover:bg-emerald-600 text-white rounded-xl transition-all duration-300 hover:scale-105 flex items-center gap-2 shadow-md">
                    <i class="fa-regular fa-check-circle"></i>
                    <span>Tandai semua dibaca</span>
                </button>
                <button onclick="hapusSemua()" 
                        class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl transition-all duration-300 hover:scale-105 flex items-center gap-2 shadow-md">
                    <i class="fa-regular fa-trash-can"></i>
                    <span>Hapus semua</span>
                </button>
            </div>
        </div>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $notifikasi->total() }}</p>
                    </div>
                    <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-bell text-gray-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Belum Dibaca</p>
                        <p class="text-2xl font-bold text-emerald-600">{{ $notifikasi->where('dibaca', false)->count() }}</p>
                    </div>
                    <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-envelope text-emerald-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Sudah Dibaca</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $notifikasi->where('dibaca', true)->count() }}</p>
                    </div>
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-envelope-open text-blue-600"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Pengajuan Surat</p>
                        <p class="text-2xl font-bold text-gray-800">{{ $notifikasi->where('jenis', 'pengajuan_surat')->count() }}</p>
                    </div>
                    <div class="w-10 h-10 bg-amber-100 rounded-full flex items-center justify-center">
                        <i class="fa-regular fa-file-lines text-amber-600"></i>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            @forelse($notifikasi as $notif)
            <div class="group border-b border-gray-100 hover:bg-gray-50 transition-all duration-300 {{ !$notif->dibaca ? 'bg-emerald-50/20' : '' }}">
                <div class="px-6 py-4 flex items-center gap-4">
                    
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center transition-all duration-300 group-hover:scale-110
                            @if($notif->jenis == 'pengajuan_surat') bg-emerald-100
                            @elseif($notif->jenis == 'aspirasi') bg-blue-100
                            @elseif($notif->jenis == 'umkm') bg-amber-100
                            @else bg-gray-100 @endif">
                            <i class="text-xl
                                @if($notif->jenis == 'pengajuan_surat') fa-regular fa-file-lines text-emerald-600
                                @elseif($notif->jenis == 'aspirasi') fa-regular fa-comment-dots text-blue-600
                                @elseif($notif->jenis == 'umkm') fa-solid fa-store text-amber-600
                                @else fa-regular fa-bell text-gray-600 @endif">
                            </i>
                        </div>
                    </div>
                    
                    <div class="flex-1">
                        <div class="flex flex-wrap justify-between items-start gap-2">
                            <div>
                                <h3 class="font-semibold text-gray-800 {{ !$notif->dibaca ? 'font-bold' : '' }}">
                                    {{ $notif->judul }}
                                    @if(!$notif->dibaca)
                                    <span class="ml-2 text-[10px] bg-emerald-500 text-white px-2 py-0.5 rounded-full">Baru</span>
                                    @endif
                                </h3>
                                <p class="text-sm text-gray-600 mt-1">{{ $notif->pesan }}</p>
                                <div class="flex items-center gap-3 mt-2">
                                    <span class="text-xs text-gray-400">
                                        <i class="fa-regular fa-clock mr-1"></i>{{ $notif->created_at->diffForHumans() }}
                                    </span>
                                    <span class="text-xs text-gray-400">
                                        <i class="fa-regular fa-folder mr-1"></i>{{ ucfirst(str_replace('_', ' ', $notif->jenis)) }}
                                    </span>
                                </div>
                            </div>
                            
                            <div class="flex gap-2">
                                <a href="{{ $notif->link }}" 
                                   onclick="bacaNotif({{ $notif->id }})"
                                   class="px-3 py-1.5 bg-emerald-500 hover:bg-emerald-600 text-white text-sm rounded-lg transition-all duration-300 hover:scale-105 flex items-center gap-1">
                                    <i class="fa-regular fa-eye"></i>
                                    <span>Tinjau</span>
                                </a>
                                <button onclick="hapusNotif({{ $notif->id }})"
                                        class="px-3 py-1.5 bg-red-500 hover:bg-red-600 text-white text-sm rounded-lg transition-all duration-300 hover:scale-105 flex items-center gap-1">
                                    <i class="fa-regular fa-trash-can"></i>
                                    <span>Hapus</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    @if(!$notif->dibaca)
                    <div class="flex-shrink-0">
                        <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                    </div>
                    @endif
                </div>
            </div>
            @empty
            <div class="px-6 py-16 text-center">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fa-regular fa-bell-slash text-5xl text-gray-400"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-700 mb-1">Belum ada notifikasi</h3>
                <p class="text-gray-400">Notifikasi akan muncul saat ada aktivitas baru</p>
            </div>
            @endforelse
        </div>
        
        <div class="mt-6">
            {{ $notifikasi->links() }}
        </div>
    </div>
</div>

<script>
    function bacaNotif(id) {
        fetch('{{ route("notifikasi.baca") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ id: id })
        }).then(() => {
            location.reload();
        });
    }
    
    function bacaSemua() {
        if (confirm('Tandai semua notifikasi sebagai dibaca?')) {
            fetch('{{ route("notifikasi.baca-semua") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                location.reload();
            });
        }
    }
    
    function hapusNotif(id) {
        if (confirm('Hapus notifikasi ini?')) {
            fetch('/notifikasi/' + id, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                location.reload();
            });
        }
    }
    
    function hapusSemua() {
        if (confirm('Hapus semua notifikasi?')) {
            fetch('{{ route("notifikasi.hapus-semua") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            }).then(() => {
                location.reload();
            });
        }
    }
</script>
@endsection