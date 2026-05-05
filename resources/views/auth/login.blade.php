{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Lumban Silintong</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    
    <style>
        body {
            /* Latar belakang alam: perpaduan hutan dan danau */
            background: 
                linear-gradient(135deg, rgba(255,255,255,0.7) 0%, rgba(255,255,255,0.3) 100%),
                url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&q=80&w=2000');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
        }

        .glass-nature {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            box-shadow: 0 25px 50px -12px rgba(6, 78, 59, 0.2);
        }

        .input-nature {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            background: rgba(255, 255, 255, 0.5);
        }

        .input-nature:focus {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -5px rgba(16, 185, 129, 0.2);
        }

        .btn-nature {
            background: linear-gradient(135deg, #064e3b 0%, #0c4a6e 100%);
            background-size: 200% auto;
            transition: all 0.5s ease;
        }

        .btn-nature:hover {
            background-position: right center;
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 15px 30px rgba(6, 78, 59, 0.3);
        }

        .floating-leaf {
            animation: floating 6s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
            100% { transform: translateY(0px) rotate(0deg); }
        }
    </style>
</head>
<body class="font-['Plus_Jakarta_Sans'] min-h-screen flex items-center justify-center p-6 relative overflow-hidden">

   

    <div class="max-w-4xl w-full grid md:grid-cols-2 glass-nature rounded-[3rem] overflow-hidden shadow-2xl animate__animated animate__zoomIn">
        
        <!-- Kolom Kiri: Visual Pemandangan (Desktop) -->
        <div class="hidden md:block relative bg-cover bg-center" style="background-image: url('{{ asset('images/login dan register/2.jpeg') }}');">
            <div class="absolute inset-0 bg-gradient-to-t from-emerald-950/60 via-transparent to-transparent"></div>
            <div class="absolute bottom-12 left-12 right-12 text-white">
                <h2 class="text-3xl font-serif italic mb-2 tracking-wide">Selamat Datang Kembali</h2>
                <p class="text-emerald-50/80 text-sm leading-relaxed font-light">Masuk untuk menikmati kenyamanan layanan warga digital di tengah asrinya Lumban Silintong.</p>
            </div>
        </div>

        <!-- Kolom Kanan: Form Login -->
        <div class="p-8 md:p-14 flex flex-col justify-center">
            <div class="text-center md:text-left mb-10">
                <div class="inline-flex w-16 h-16 bg-emerald-950 rounded-2xl items-center justify-center text-white text-2xl font-black shadow-lg mb-6 transform hover:rotate-6 transition-transform">
                    LS
                </div>
                <h1 class="text-3xl font-serif text-emerald-950 mb-2">Portal Warga</h1>
                <p class="text-emerald-800/40 text-sm font-semibold tracking-widest uppercase">Layanan Digital Desa</p>
            </div>

            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50/80 backdrop-blur-sm border border-red-100 rounded-2xl text-red-600 text-sm flex items-center gap-3 animate__animated animate__shakeX">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf
                
                <div class="group">
                    <label class="block text-[11px] font-bold text-emerald-800 uppercase tracking-widest ml-1 mb-2">Email Warga</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-emerald-800/20 group-focus-within:text-emerald-600 transition-colors">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" 
                            class="input-nature w-full pl-12 pr-4 py-4 rounded-2xl border border-emerald-100 focus:outline-none focus:border-emerald-500 text-sm" 
                            placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <div class="group">
                    <label class="block text-[11px] font-bold text-emerald-800 uppercase tracking-widest ml-1 mb-2">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-emerald-800/20 group-focus-within:text-emerald-600 transition-colors">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" 
                            class="input-nature w-full pl-12 pr-4 py-4 rounded-2xl border border-emerald-100 focus:outline-none focus:border-emerald-500 text-sm" 
                            placeholder="••••••••" required>
                    </div>
                </div>

                <div class="flex items-center justify-between px-1">
                    <label class="flex items-center gap-2 cursor-pointer group">
                        <input type="checkbox" name="remember" class="w-4 h-4 rounded border-emerald-200 text-emerald-600 focus:ring-emerald-500">
                        <span class="text-xs text-emerald-800/60 group-hover:text-emerald-800 transition-colors">Ingat Saya</span>
                    </label>
                    <a href="#" class="text-xs text-emerald-700 font-bold hover:underline">Lupa Password?</a>
                </div>

                <button type="submit" class="btn-nature w-full py-4 text-white rounded-2xl font-bold uppercase tracking-[0.2em] text-xs shadow-xl flex items-center justify-center gap-3">
                    Masuk Sekarang <i class="fa-solid fa-arrow-right-long animate__animated animate__fadeInLeft animate__infinite"></i>
                </button>
            </form>

            <div class="mt-12 pt-8 border-t border-emerald-100/50 text-center">
                <p class="text-sm text-emerald-900/40 italic">
                    Belum bergabung dengan kami? 
                    <a href="{{ route('register') }}" class="text-emerald-700 font-bold hover:text-emerald-900 transition-colors not-italic ml-1">
                        Daftar Akun Warga
                    </a>
                </p>
            </div>
        </div>
    </div>

   

</body>
</html>