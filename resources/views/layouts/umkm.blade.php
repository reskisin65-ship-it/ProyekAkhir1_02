<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel UMKM | Silintong UMKM</title>
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
                @php $currentUmkmId = optional(Auth::user()->umkm)->id_umkm; @endphp
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-4 mb-4">Merchant Menu</p>
                
                <a href="{{ $currentUmkmId ? route('umkm.show', $currentUmkmId) : route('umkm') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-boxes-stacked text-2xl"></i>
                    <span>Kelola Produk</span>
                </a>

                <div class="h-px bg-slate-200 my-4"></div>

                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] px-4 mb-4 mt-6">Fitur Lainnya</p>

                <a href="{{ route('masyarakat.dashboard') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-chart-line text-2xl"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('masyarakat.surat.create') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-file-signature text-2xl"></i>
                    <span>Ajukan Surat</span>
                </a>

                <a href="{{ route('masyarakat.surat.index') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-envelope text-2xl"></i>
                    <span>Riwayat Surat</span>
                </a>

                <a href="{{ route('masyarakat.aspirasi.index') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-comment-dots text-2xl"></i>
                    <span>Aspirasi Saya</span>
                </a>

                <a href="{{ route('berita') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-newspaper text-2xl"></i>
                    <span>Berita</span>
                </a>

                <a href="{{ route('galeri') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-photo-film text-2xl"></i>
                    <span>Galeri</span>
                </a>

                <a href="{{ route('umkm') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-shop text-2xl"></i>
                    <span>UMKM Lainnya</span>
                </a>

                <a href="{{ route('statistik.publik') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-chart-simple text-2xl"></i>
                    <span>Statistik Desa</span>
                </a>

                <a href="{{ route('masyarakat.keuangan.index') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-coins text-2xl"></i>
                    <span>Keuangan Desa</span>
                </a>

                <a href="{{ route('profil-desa') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-solid fa-landmark-dome text-2xl"></i>
                    <span>Profil Desa</span>
                </a>

                <a href="{{ route('notifikasi.index') }}" class="flex items-center gap-5 px-6 py-5 rounded-[2rem] text-slate-500 font-bold text-lg hover:bg-slate-50">
                    <i class="fa-regular fa-bell text-2xl"></i>
                    <span>Notifikasi</span>
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
    {{-- Confirm Dialog (Global) --}}
    <div id="confirm-dialog" class="fixed inset-0 z-[9999] hidden" aria-hidden="true">
        <div id="confirm-backdrop" class="absolute inset-0 bg-slate-950/55 backdrop-blur-md opacity-0 transition-opacity duration-200"></div>
        <div class="absolute inset-0 flex items-center justify-center p-4 sm:p-8">
            <div id="confirm-panel" class="w-full max-w-md opacity-0 scale-[0.98] translate-y-2 transition-all duration-200">
                <div class="relative overflow-hidden rounded-[28px] border border-white/30 bg-white/85 shadow-[0_30px_80px_-20px_rgba(2,6,23,0.5)]">
                    <div class="absolute -top-24 -right-24 h-56 w-56 rounded-full bg-emerald-400/20 blur-3xl"></div>
                    <div class="absolute -bottom-24 -left-24 h-56 w-56 rounded-full bg-amber-400/20 blur-3xl"></div>

                    <div class="relative p-7 sm:p-8">
                        <div class="flex items-start gap-4">
                            <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-rose-600 to-orange-500 text-white shadow-lg shadow-rose-500/20 flex items-center justify-center">
                                <i class="fa-solid fa-triangle-exclamation text-lg"></i>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 id="confirm-title" class="text-lg sm:text-xl font-black text-slate-900 tracking-tight">
                                    Konfirmasi
                                </h3>
                                <p id="confirm-message" class="mt-1.5 text-sm sm:text-[15px] leading-relaxed text-slate-600">
                                    Anda yakin mau hapus?
                                </p>
                            </div>
                            <button type="button" id="confirm-close" class="group -mr-1 -mt-1 h-10 w-10 rounded-2xl border border-slate-200/70 bg-white/70 hover:bg-white transition flex items-center justify-center">
                                <i class="fa-solid fa-xmark text-slate-500 group-hover:text-slate-900 transition"></i>
                            </button>
                        </div>

                        <div class="mt-7 flex flex-col-reverse sm:flex-row gap-3 sm:justify-end">
                            <button type="button" id="confirm-cancel"
                                    class="w-full sm:w-auto px-5 py-3 rounded-2xl font-extrabold text-[12px] uppercase tracking-[0.18em]
                                           border border-slate-200 bg-white/70 text-slate-700
                                           hover:bg-slate-50 hover:shadow-md hover:-translate-y-0.5 transition-all duration-300">
                                Batal
                            </button>
                            <button type="button" id="confirm-ok"
                                    class="w-full sm:w-auto px-5 py-3 rounded-2xl font-extrabold text-[12px] uppercase tracking-[0.18em]
                                           bg-gradient-to-r from-rose-600 to-orange-500 text-white shadow-lg shadow-rose-500/20
                                           hover:shadow-xl hover:shadow-rose-500/30 hover:-translate-y-0.5 transition-all duration-300">
                                Ya, Hapus
                            </button>
                        </div>

                        <div class="mt-5 text-[11px] text-slate-400">
                            Tindakan ini tidak bisa dibatalkan.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media (prefers-reduced-motion: reduce) {
            #confirm-backdrop, #confirm-panel { transition: none !important; }
        }
    </style>

    <script>
        (function () {
            const dialog = document.getElementById('confirm-dialog');
            const backdrop = document.getElementById('confirm-backdrop');
            const panel = document.getElementById('confirm-panel');
            const titleEl = document.getElementById('confirm-title');
            const messageEl = document.getElementById('confirm-message');
            const okBtn = document.getElementById('confirm-ok');
            const cancelBtn = document.getElementById('confirm-cancel');
            const closeBtn = document.getElementById('confirm-close');

            let resolver = null;
            let isOpen = false;

            function openDialog({ title, message, confirmText, cancelText }) {
                if (!dialog || !backdrop || !panel) return Promise.resolve(window.confirm(message || 'Anda yakin?'));

                titleEl.textContent = title || 'Konfirmasi';
                messageEl.textContent = message || 'Anda yakin?';
                okBtn.textContent = confirmText || 'Ya, Hapus';
                cancelBtn.textContent = cancelText || 'Batal';

                dialog.classList.remove('hidden');
                dialog.setAttribute('aria-hidden', 'false');
                isOpen = true;

                requestAnimationFrame(() => {
                    backdrop.classList.remove('opacity-0');
                    backdrop.classList.add('opacity-100');
                    panel.classList.remove('opacity-0', 'scale-[0.98]', 'translate-y-2');
                    panel.classList.add('opacity-100', 'scale-100', 'translate-y-0');
                });

                const previouslyFocused = document.activeElement;
                okBtn.focus();

                return new Promise(resolve => {
                    resolver = (value) => {
                        resolve(!!value);
                        resolver = null;
                        isOpen = false;

                        backdrop.classList.remove('opacity-100');
                        backdrop.classList.add('opacity-0');
                        panel.classList.remove('opacity-100', 'scale-100', 'translate-y-0');
                        panel.classList.add('opacity-0', 'scale-[0.98]', 'translate-y-2');

                        setTimeout(() => {
                            dialog.classList.add('hidden');
                            dialog.setAttribute('aria-hidden', 'true');
                            if (previouslyFocused && previouslyFocused.focus) previouslyFocused.focus();
                        }, 210);
                    };
                });
            }

            function close(value) {
                if (resolver) resolver(value);
            }

            function isDeleteForm(form) {
                const methodInput = form.querySelector('input[name="_method"]');
                return (methodInput && String(methodInput.value).toUpperCase() === 'DELETE')
                    || form.getAttribute('data-confirm-delete') === 'true';
            }

            window.__confirmDialog = openDialog;

            if (dialog) {
                okBtn.addEventListener('click', () => close(true));
                cancelBtn.addEventListener('click', () => close(false));
                closeBtn.addEventListener('click', () => close(false));
                backdrop.addEventListener('click', () => close(false));
                document.addEventListener('keydown', (e) => {
                    if (!isOpen) return;
                    if (e.key === 'Escape') close(false);
                    if (e.key === 'Enter') close(true);
                });
            }

            document.addEventListener('submit', async function (e) {
                const form = e.target;
                if (!(form instanceof HTMLFormElement)) return;
                if (!isDeleteForm(form)) return;

                e.preventDefault();
                e.stopImmediatePropagation();

                const message = form.getAttribute('data-confirm-message') || 'Anda yakin mau hapus?';
                const ok = await openDialog({ title: 'Konfirmasi Hapus', message, confirmText: 'Ya, Hapus', cancelText: 'Batal' });
                if (!ok) return;

                form.submit();
            }, true);
        })();
    </script>
</body>
</html>
