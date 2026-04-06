<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel | Desa Lumban Silintong</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        
        /* Sidebar Active State - Hijau Botani Pekat */
        .nav-active { 
            background-color: #064e3b !important; 
            color: #ffffff !important; 
            box-shadow: 0 20px 30px -10px rgba(6, 78, 59, 0.3);
            transform: scale(1.05);
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }

        /* Transition Smooth */
        * { transition: all 0.3s ease; }
    </style>
</head>
<body class="antialiased">

    <div class="flex min-h-screen">
        <!-- SIDEBAR RAKSASA (320px) -->
        <aside class="w-[320px] bg-white border-r border-slate-200 flex flex-col sticky top-0 h-screen z-50">
            <!-- Brand Area -->
            <div class="p-10 flex items-center gap-4">
                <div class="w-14 h-14 bg-emerald-900 rounded-2xl flex items-center justify-center text-white text-2xl font-black shadow-lg">LS</div>
                <h1 class="text-2xl font-black tracking-tighter text-emerald-950 uppercase">Admin<span class="text-emerald-500">LS</span></h1>
            </div>

            <!-- Menu Area -->
            <nav class="flex-1 px-6 space-y-4 mt-6 overflow-y-auto">
                <p class="text-[12px] font-black text-slate-400 uppercase tracking-[0.3em] px-4 mb-6">Utama</p>
                
                <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg {{ Request::is('admin/dashboard') ? 'nav-active' : 'hover:bg-slate-50' }}">
                    <i class="fa-solid fa-chart-line text-2xl"></i>
                    <span>Dashboard</span>
                </a>

                <p class="text-[12px] font-black text-slate-400 uppercase tracking-[0.3em] px-4 mt-10 mb-6">Modul Data Desa</p>

                <a href="{{ route('admin.penduduk.index') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg {{ Request::is('admin/penduduk*') ? 'nav-active' : 'hover:bg-slate-50' }}">
                    <i class="fa-solid fa-users-rectangle text-2xl"></i>
                    <span>Data Penduduk</span>
                </a>

                <a href="{{ route('admin.surat.index') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg {{ Request::is('admin/surat*') ? 'nav-active' : 'hover:bg-slate-50' }}">
                    <i class="fa-solid fa-file-signature text-2xl"></i>
                    <span>Verifikasi Surat</span>
                </a>

                <a href="{{ route('admin.berita.index') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg {{ Request::is('admin/berita*') ? 'nav-active' : 'hover:bg-slate-50' }}">
                    <i class="fa-solid fa-newspaper text-2xl"></i>
                    <span>Kelola Berita</span>
                </a>

                <a href="{{ route('admin.umkm.index') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg {{ Request::is('admin/umkm*') ? 'nav-active' : 'hover:bg-slate-50' }}">
                <i class="fa-solid fa-store text-2xl"></i>
                <span>Profil UMKM</span>
                </a>

                <a href="#" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-images text-2xl"></i>
                    <span>Galeri Foto</span>
                </a>
            </nav>

            <!-- Bottom Copyright -->
            <div class="p-10 text-[10px] font-black text-slate-300 uppercase tracking-widest">
                v1.0 • Desa Lumban Silintong
            </div>
        </aside>

        <!-- MAIN CONTENT AREA -->
        <div class="flex-1 flex flex-col min-w-0">
            <!-- NAVBAR RAKSASA (120px) -->
            <header class="h-[120px] bg-white/80 backdrop-blur-md border-b border-slate-200 px-12 flex items-center justify-between sticky top-0 z-40">
                <div>
                    <h2 class="text-xl font-black text-slate-400 uppercase tracking-[0.2em]">Sistem Informasi Desa</h2>
                </div>

                <div class="flex items-center gap-10">
                    <!-- User Info -->
                    <div class="flex items-center gap-5 border-r border-slate-200 pr-10">
                        <div class="text-right">
                            <p class="text-lg font-black text-emerald-950 leading-none">{{ Auth::user()->name }}</p>
                            <p class="text-xs font-bold text-emerald-500 uppercase tracking-widest mt-1">Super Administrator</p>
                        </div>
                        <div class="w-16 h-16 rounded-2xl bg-emerald-100 flex items-center justify-center text-emerald-800 text-xl font-black border-4 border-white shadow-lg">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                    </div>

                    <!-- TOMBOL LOGOUT RAKSASA -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-3 px-8 py-4 bg-red-50 text-red-600 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100">
                            <i class="fa-solid fa-power-off text-lg"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </header>

            <!-- DASHBOARD CONTENT -->
            <main class="p-12">
                {{ $slot }}
            </main>
        </div>
    </div>

</body>
</html>