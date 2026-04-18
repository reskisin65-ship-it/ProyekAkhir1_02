<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Merchant Panel | Silintong UMKM</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
        .nav-active { background-color: #064e3b !important; color: #ffffff !important; box-shadow: 0 15px 25px -5px rgba(6, 78, 59, 0.2); }
        * { transition: all 0.3s ease; }
    </style>
</head>
<body class="antialiased">
    <div class="flex min-h-screen">
        <!-- SIDEBAR UMKM (320px) -->
        <aside class="w-[320px] bg-white border-r border-slate-200 flex flex-col sticky top-0 h-screen z-50">
            <div class="p-10 flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-600 rounded-2xl flex items-center justify-center text-white text-xl font-black shadow-lg italic">S</div>
                <h1 class="text-xl font-black tracking-tighter text-emerald-950 uppercase">UMKM<span class="text-emerald-500">Center</span></h1>
            </div>

            <nav class="flex-1 px-6 space-y-4 mt-6">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-4 mb-4">Merchant Menu</p>
                
                <a href="{{ route('umkm.dashboard') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg {{ Request::is('umkm/dashboard') ? 'nav-active' : 'hover:bg-slate-50' }}">
                    <i class="fa-solid fa-house-user text-2xl"></i>
                    <span>Dashboard</span>
                </a>

                <a href="#" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-shop text-2xl"></i>
                    <span>Profil Usaha</span>
                </a>

                <a href="#" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-boxes-stacked text-2xl"></i>
                    <span>Kelola Produk</span>
                </a>
            </nav>

            <div class="p-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full py-4 bg-red-50 text-red-600 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-red-600 hover:text-white transition shadow-sm border border-red-100">
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        <!-- MAIN AREA -->
        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-[120px] bg-white border-b border-slate-200 px-12 flex items-center justify-between sticky top-0 z-40">
                <h2 class="text-xl font-black text-slate-400 uppercase tracking-widest">Portal Bisnis Desa</h2>
                <div class="flex items-center gap-6">
                    <div class="text-right">
                        <p class="text-lg font-black text-emerald-950">{{ Auth::user()->name }}</p>
                        <span class="text-[10px] font-bold text-emerald-500 bg-emerald-50 px-3 py-1 rounded-full uppercase italic">Pemilik Usaha</span>
                    </div>
                </div>
            </header>
            <main class="p-12">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
