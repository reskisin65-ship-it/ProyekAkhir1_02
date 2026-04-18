{{-- resources/views/auth/login.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Lumban Silintong</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="font-['Plus_Jakarta_Sans'] bg-gradient-to-br from-emerald-50 to-white min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-emerald-950 rounded-3xl flex items-center justify-center text-white text-3xl font-black mx-auto shadow-2xl">
                LS
            </div>
            <h2 class="text-3xl font-serif italic text-emerald-950 mt-6">Portal Warga</h2>
            <p class="text-gray-400 text-sm mt-2">Masuk ke layanan digital desa</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/50">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 rounded-2xl text-red-600 text-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 rounded-2xl text-emerald-600 text-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-check"></i>
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-emerald-600 mb-2">Email</label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="email" name="email" class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-100 focus:border-emerald-500 focus:outline-none transition" placeholder="contoh@email.com" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="mb-8">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-emerald-600 mb-2">Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="password" name="password" class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-100 focus:border-emerald-500 focus:outline-none transition" placeholder="********">
                    </div>
                </div>
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-2xl font-bold uppercase tracking-wider text-sm hover:from-emerald-500 hover:to-emerald-600 transition shadow-lg">
                    <i class="fa-solid fa-arrow-right-to-bracket mr-2"></i> Masuk Portal
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-xs text-gray-400">Belum punya akun? 
                    <a href="{{ route('register') }}" class="text-emerald-600 hover:underline font-semibold">Daftar Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
