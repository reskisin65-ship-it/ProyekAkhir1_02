{{-- resources/views/auth/register.blade.php --}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Lumban Silintong</title>
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
            <h2 class="text-3xl font-serif italic text-emerald-950 mt-6">Daftar Akun</h2>
            <p class="text-gray-400 text-sm mt-2">Bergabung sebagai warga digital</p>
        </div>

        <div class="bg-white/80 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border border-white/50">
            @if($errors->any())
                <div class="mb-6 p-4 bg-red-50 rounded-2xl text-red-600 text-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-emerald-600 mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <i class="fa-regular fa-user absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="text" name="name" class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-100 focus:border-emerald-500 focus:outline-none transition" placeholder="Nama lengkap" value="{{ old('nama') }}">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-emerald-600 mb-2">Email</label>
                    <div class="relative">
                        <i class="fa-regular fa-envelope absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="email" name="email" class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-100 focus:border-emerald-500 focus:outline-none transition" placeholder="contoh@email.com" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-emerald-600 mb-2">Nomor Telepon</label>
                    <div class="relative">
                        <i class="fa-solid fa-phone absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="tel" name="nomor_telepon" class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-100 focus:border-emerald-500 focus:outline-none transition" placeholder="08123456789" value="{{ old('nomor_telepon') }}">
                    </div>
                </div>
                <div class="mb-4">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-emerald-600 mb-2">Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="password" name="password" class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-100 focus:border-emerald-500 focus:outline-none transition" placeholder="********">
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-[10px] font-black uppercase tracking-wider text-emerald-600 mb-2">Konfirmasi Password</label>
                    <div class="relative">
                        <i class="fa-solid fa-lock absolute left-4 top-1/2 -translate-y-1/2 text-gray-300"></i>
                        <input type="password" name="password_confirmation" class="w-full pl-12 pr-4 py-4 rounded-2xl border border-gray-100 focus:border-emerald-500 focus:outline-none transition" placeholder="********">
                    </div>
                </div>
                <button type="submit" class="w-full py-4 bg-gradient-to-r from-emerald-600 to-emerald-700 text-white rounded-2xl font-bold uppercase tracking-wider text-sm hover:from-emerald-500 hover:to-emerald-600 transition shadow-lg">
                    <i class="fa-regular fa-user-plus mr-2"></i> Daftar Sekarang
                </button>
            </form>

            <div class="mt-6 text-center">
                <p class="text-xs text-gray-400">Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-emerald-600 hover:underline font-semibold">Masuk Sekarang</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
