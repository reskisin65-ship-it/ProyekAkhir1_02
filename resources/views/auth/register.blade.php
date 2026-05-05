{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bergabung - Lumban Silintong</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        :root {
            --forest-deep: #064e3b;
            --lake-blue: #0c4a6e;
            --nature-green: #10b981;
        }

        body {
            /* Background dengan nuansa kabut hutan dan air danau */
            background: 
                linear-gradient(135deg, rgba(255,255,255,0.8) 0%, rgba(255,255,255,0.4) 100%),
                url('https://images.unsplash.com/photo-1441974231531-c6227db76b6e?auto=format&fit=crop&q=80&w=2560');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        .glass-nature {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 20px 50px rgba(6, 78, 59, 0.15);
        }

        .input-nature {
            transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
            background: rgba(255, 255, 255, 0.5);
        }

        .input-nature:focus {
            background: white;
            transform: scale(1.01);
            box-shadow: 0 10px 20px -10px rgba(16, 185, 129, 0.3);
        }

        .btn-nature {
            background: linear-gradient(135deg, #064e3b 0%, #0c4a6e 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.5s ease;
        }

        .btn-nature::after {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-nature:hover::after {
            left: 100%;
        }

        .btn-nature:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(6, 78, 59, 0.3);
        }

        .leaf-icon {
            animation: sway 3s ease-in-out infinite alternate;
            transform-origin: bottom center;
        }

        @keyframes sway {
            from { transform: rotate(-5deg); }
            to { transform: rotate(5deg); }
        }

        /* Custom Scrollbar Nuansa Alam */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f1f1; }
        ::-webkit-scrollbar-thumb { background: #064e3b; border-radius: 10px; }
    </style>
</head>
<body class="font-['Plus_Jakarta_Sans'] min-h-screen flex items-center justify-center p-6">

    <div class="max-w-4xl w-full grid md:grid-cols-2 bg-white/40 backdrop-blur-md rounded-[3rem] overflow-hidden shadow-2xl animate__animated animate__fadeIn">
        
        <!-- Kolom Kiri: Visual/Welcome (Hanya muncul di Desktop) -->
        <div class="hidden md:flex flex-col justify-between p-12 bg-cover bg-center relative" style="background-image: url('{{ asset('images/login dan register/4.jpeg') }}');">
            <div class="absolute inset-0 bg-gradient-to-b from-emerald-950/40 to-sky-900/60"></div>
            
            <div class="relative z-10">
                <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-xl flex items-center justify-center text-white font-bold border border-white/30">
                    LS
                </div>
            </div>

            <div class="relative z-10 text-white">
                <h1 class="text-4xl font-serif italic mb-4">Temukan Ketenangan di Lumban Silintong</h1>
                <p class="text-emerald-50/80 leading-relaxed">Bergabunglah dalam komunitas digital kami. Mari lestarikan keindahan hutan dan kejernihan danau bersama-sama.</p>
            </div>
        </div>

        <!-- Kolom Kanan: Form -->
        <div class="p-8 md:p-12 glass-nature">
            <div class="text-center mb-8">
                <i class="fa-solid fa-leaf text-emerald-600 text-3xl mb-4 leaf-icon"></i>
                <h2 class="text-3xl font-serif text-emerald-950">Daftar Akun</h2>
                <p class="text-gray-500 text-sm mt-1">Lengkapi data untuk akses layanan desa</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf
                
                <div class="group">
                    <label class="text-[11px] font-bold text-emerald-800 uppercase tracking-widest ml-1 mb-2 block">Nama Sesuai KTP</label>
                    <div class="relative">
                        <i class="fa-regular fa-user absolute left-4 top-1/2 -translate-y-1/2 text-emerald-800/30 group-focus-within:text-emerald-600 transition-colors"></i>
                        <input type="text" name="name" class="input-nature w-full pl-12 pr-4 py-3.5 rounded-2xl border border-emerald-100 focus:outline-none focus:border-emerald-500 text-sm" placeholder="Contoh: Michael Manurung" value="{{ old('name') }}">
                    </div>
                </div>

                <div class="group">
                    <label class="text-[11px] font-bold text-emerald-800 uppercase tracking-widest ml-1 mb-2 block">Alamat Email</label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-emerald-800/30 group-focus-within:text-emerald-600 transition-colors"></i>
                        <input type="email" name="email" class="input-nature w-full pl-12 pr-4 py-3.5 rounded-2xl border border-emerald-100 focus:outline-none focus:border-emerald-500 text-sm" placeholder="email@desa.com" value="{{ old('email') }}">
                    </div>
                </div>

                <div class="group">
                    <label class="text-[11px] font-bold text-emerald-800 uppercase tracking-widest ml-1 mb-2 block">Nomor WhatsApp</label>
                    <div class="relative">
                        <i class="fa-brands fa-whatsapp absolute left-4 top-1/2 -translate-y-1/2 text-emerald-800/30 group-focus-within:text-emerald-600 transition-colors"></i>
                        <input type="tel" name="nomor_telepon" class="input-nature w-full pl-12 pr-4 py-3.5 rounded-2xl border border-emerald-100 focus:outline-none focus:border-emerald-500 text-sm" placeholder="0812xxxx" value="{{ old('nomor_telepon') }}">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="group">
                        <label class="text-[11px] font-bold text-emerald-800 uppercase tracking-widest ml-1 mb-2 block">Password</label>
                        <input type="password" name="password" class="input-nature w-full px-4 py-3.5 rounded-2xl border border-emerald-100 focus:outline-none focus:border-emerald-500 text-sm" placeholder="••••••••">
                    </div>
                    <div class="group">
                        <label class="text-[11px] font-bold text-emerald-800 uppercase tracking-widest ml-1 mb-2 block">Konfirmasi</label>
                        <input type="password" name="password_confirmation" class="input-nature w-full px-4 py-3.5 rounded-2xl border border-emerald-100 focus:outline-none focus:border-emerald-500 text-sm" placeholder="••••••••">
                    </div>
                </div>

                <button type="submit" class="btn-nature w-full py-4 text-white rounded-2xl font-bold uppercase tracking-widest text-xs mt-4 group">
                    Mulai Bergabung 
                    <i class="fa-solid fa-chevron-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                </button>
            </form>

            <div class="mt-8 text-center">
                <p class="text-xs text-gray-500">
                    Sudah memiliki akun warga? 
                    <a href="{{ route('login') }}" class="text-emerald-700 font-bold hover:underline">Masuk Sekarang</a>
                </p>
            </div>
        </div>
    </div>

    <!-- Background Elements -->
   
    <div class="fixed top-0 right-0 p-8 opacity-10 pointer-events-none hidden lg:block">
        <i class="fa-solid fa-cloud text-9xl text-sky-900"></i>
    </div>

</body>
</html>