<?php
// resources/views/layouts/admin.blade.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel | Lumban Silintong</title>

    <!-- Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind & Icons -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #F8FAFC; }
        .sidebar-active { 
            background-color: #064e3b; 
            color: white !important; 
            box-shadow: 0 10px 15px -3px rgba(6, 78, 59, 0.4);
        }
        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 0.875rem 1.25rem;
            border-radius: 1rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #64748b;
            transition: all 0.3s;
        }
        .nav-link:hover { background-color: #f1f5f9; color: #064e3b; }
    </style>
</head>
<body class="antialiased text-slate-800 uppercase tracking-tighter">

    <div class="flex min-h-screen">
        <!-- SIDEBAR (SESUAI MODUL DOKUMEN) -->
        <aside class="w-80 bg-white border-r border-slate-200 flex flex-col sticky top-0 h-screen z-50">
            <div class="p-8 flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-900 rounded-2xl flex items-center justify-center text-white text-xl font-bold shadow-lg">LS</div>
                <div>
                    <h1 class="text-xl font-black text-slate-900 leading-none">ADMIN PANEL</h1>
                    <p class="text-[9px] tracking-[0.3em] text-slate-400 mt-1 font-bold">DESA SILINTONG</p>
                </div>
            </div>

            <nav class="flex-1 px-6 space-y-1 overflow-y-auto">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-4 mb-4 mt-4">Utama</p>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Request::is('admin/dashboard') ? 'sidebar-active' : '' }}">
                    <i class="fa-solid fa-chart-pie text-lg"></i> Dashboard
                </a>

                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-4 mb-4 mt-8">Kependudukan</p>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-users-rectangle text-lg"></i> Data Penduduk
                </a>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-file-circle-check text-lg"></i> Pelayanan Surat
                </a>

                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-4 mb-4 mt-8">Konten & Ekonomi</p>
                <a href="{{ route('admin.berita.index') }}" class="nav-link {{ Request::is('admin/berita*') ? 'sidebar-active' : '' }}">
                    <i class="fa-solid fa-newspaper text-lg"></i> Berita & Info
                </a>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-shop text-lg"></i> Manajemen UMKM
                </a>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-images text-lg"></i> Galeri Desa
                </a>

                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] px-4 mb-4 mt-8">Komunikasi</p>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-comment-dots text-lg"></i> Aspirasi Warga
                </a>
                <a href="#" class="nav-link">
                    <i class="fa-solid fa-circle-info text-lg"></i> Profil Desa (About)
                </a>
            </nav>

            <!-- Logout -->
            <div class="p-6 border-t border-slate-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="w-full flex items-center gap-3 px-5 py-4 text-red-500 hover:bg-red-50 rounded-2xl transition font-black text-xs uppercase tracking-widest">
                        <i class="fa-solid fa-power-off"></i> Keluar Sistem
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <div class="flex-1 flex flex-col">
            <!-- Topbar -->
            <header class="h-24 bg-white border-b border-slate-200 px-10 flex items-center justify-between sticky top-0 z-40">
                <div class="flex items-center gap-3 text-slate-400 font-bold text-sm italic">
                    Administrator <i class="fa-solid fa-chevron-right text-[10px]"></i> {{ Request::is('admin/dashboard') ? 'Dashboard' : 'Kelola Data' }}
                </div>
                
                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <p class="text-sm font-black text-slate-900">{{ Auth::user()->name }}</p>
                        <span class="text-[9px] bg-emerald-100 text-emerald-700 px-2 py-1 rounded-md font-black uppercase">Level: Admin</span>
                    </div>
                    <img src="https://ui-avatars.com/api/?name=Admin&background=064e3b&color=fff" class="w-12 h-12 rounded-2xl border-2 border-white shadow-lg">
                </div>
            </header>

            <!-- Content -->
            <div class="p-12 max-w-[1600px]">
                {{ $slot }}
            </div>
        </div>
    </div>

</body>
</html>