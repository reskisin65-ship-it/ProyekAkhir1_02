<x-admin-layout>
    <div class="flex justify-between items-end mb-12">
        <div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight uppercase">Database Warga</h2>
            <p class="text-slate-400 font-bold text-[10px] uppercase tracking-[0.3em] mt-2">Kependudukan Desa Lumban Silintong</p>
        </div>
        <a href="{{ route('admin.penduduk.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-4 rounded-2xl font-bold text-xs shadow-lg shadow-emerald-100 transition-all flex items-center gap-3 uppercase tracking-widest">
            <i class="fa-solid fa-user-plus"></i> Tambah Warga
        </a>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-400">
                    <th class="px-10 py-6">Nama Lengkap</th>
                    <th class="px-10 py-6">NIK</th>
                    <th class="px-10 py-6">Jenis Kelamin</th>
                    <th class="px-10 py-6">Status Akun</th>
                    <th class="px-10 py-6 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm font-medium text-slate-600">
                @forelse($penduduks as $p)
                <tr class="hover:bg-slate-50 transition duration-300 group">
                    <td class="px-10 py-6">
                        <p class="font-bold text-slate-900 text-base leading-none">{{ $p->nama_lengkap }}</p>
                        <p class="text-[10px] text-slate-400 mt-2 uppercase tracking-tighter italic">{{ $p->tgl_lahir }}</p>
                    </td>
                    <td class="px-10 py-6 font-black tracking-widest text-emerald-700">{{ $p->nik }}</td>
                    <td class="px-10 py-6">{{ $p->jenis_kelamin }}</td>
                    <td class="px-10 py-6">
                        @if($p->user_id)
                            <span class="px-4 py-1 bg-emerald-100 text-emerald-700 rounded-full text-[9px] font-black uppercase">Terkoneksi</span>
                        @else
                            <span class="px-4 py-1 bg-slate-100 text-slate-400 rounded-full text-[9px] font-black uppercase">Offline</span>
                        @endif
                    </td>
                    <td class="px-10 py-6 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity">
                            <form action="{{ route('admin.penduduk.destroy', $p->nik) }}" method="POST" onsubmit="return confirm('Hapus data warga ini?')">
                                @csrf @method('DELETE')
                                <button class="w-10 h-10 rounded-xl bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-20 text-center text-slate-300 italic font-bold">Belum ada data warga.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>