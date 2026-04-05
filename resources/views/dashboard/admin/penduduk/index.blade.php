<x-admin-layout>
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">DATA PENDUDUK</h1>
            <p class="text-slate-500 font-medium mt-1 uppercase text-xs tracking-widest">Manajemen Identitas Warga Silintong</p>
        </div>
        <a href="{{ route('admin.penduduk.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-2xl font-bold text-sm shadow-lg shadow-emerald-100 transition-all flex items-center gap-2">
            <i class="fa-solid fa-user-plus"></i> Tambah Warga
        </a>
    </div>

    @if(session('success'))
    <div class="bg-emerald-100 border border-emerald-200 text-emerald-700 px-6 py-4 rounded-2xl mb-8 font-bold text-sm">
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-slate-50 border-b border-slate-100">
                    <tr class="text-slate-400 text-[10px] uppercase tracking-[0.2em] font-black italic">
                        <th class="px-10 py-6">Identitas Warga</th>
                        <th class="px-10 py-6">NIK</th>
                        <th class="px-10 py-6">Jenis Kelamin</th>
                        <th class="px-10 py-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($penduduks as $p)
                    <tr class="hover:bg-slate-50/50 transition">
                        <td class="px-10 py-6">
                            <p class="font-black text-slate-800 text-lg uppercase tracking-tighter">{{ $p->nama_lengkap }}</p>
                            <p class="text-xs text-slate-400 font-medium">Lahir: {{ \Carbon\Carbon::parse($p->tgl_lahir)->format('d F Y') }}</p>
                        </td>
                        <td class="px-10 py-6">
                            <span class="font-mono text-emerald-700 font-bold bg-emerald-50 px-3 py-1 rounded-lg">{{ $p->nik }}</span>
                        </td>
                        <td class="px-10 py-6 text-sm font-bold text-slate-600">
                            {{ $p->jenis_kelamin }}
                        </td>
                        <td class="px-10 py-6 text-center">
                            <div class="flex justify-center gap-3">
                                <a href="{{ route('admin.penduduk.edit', $p->nik) }}" class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center hover:bg-indigo-600 hover:text-white transition">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.penduduk.destroy', $p->nik) }}" method="POST" onsubmit="return confirm('Hapus data warga ini?')">
                                    @csrf @method('DELETE')
                                    <button class="w-10 h-10 rounded-xl bg-rose-50 text-rose-500 flex items-center justify-center hover:bg-rose-500 hover:text-white transition">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="py-20 text-center text-slate-400 italic">Belum ada data warga terdaftar.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>