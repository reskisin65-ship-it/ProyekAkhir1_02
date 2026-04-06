<x-admin-layout>
    <div class="flex flex-col md:flex-row justify-between items-end mb-12 gap-6">
        <div>
            <h2 class="text-5xl font-serif italic text-emerald-950 leading-tight">Kelola Berita.</h2>
            <p class="text-slate-400 font-bold text-xs mt-4 uppercase tracking-[0.3em]">Manajemen Informasi Publik Desa</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="px-10 py-5 bg-emerald-900 text-white font-black rounded-[2rem] shadow-giant hover:bg-emerald-700 transition-all uppercase tracking-widest text-xs flex items-center gap-3">
            <i class="fa-solid fa-plus text-lg"></i> Tambah Berita
        </a>
    </div>

    <div class="bg-white rounded-[4rem] shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50/50 border-b border-slate-100 font-black text-[10px] uppercase tracking-[0.2em] text-slate-400">
                <tr>
                    <th class="px-10 py-6">Thumbnail</th>
                    <th class="px-10 py-6">Informasi Berita</th>
                    <th class="px-10 py-6 text-center">Status</th>
                    <th class="px-10 py-6">Tanggal</th>
                    <th class="px-10 py-6 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($beritas as $b)
                <tr class="group hover:bg-slate-50/50 transition-all duration-300">
                    <td class="px-10 py-8">
                        <img src="{{ asset('storage/' . $b->foto) }}" class="w-32 h-20 rounded-[2rem] object-cover shadow-xl group-hover:scale-110 transition duration-500">
                    </td>
                    <td class="px-10 py-8">
                        <h4 class="text-lg font-bold text-slate-800 leading-tight group-hover:text-emerald-700 transition">{{ $b->judul }}</h4>
                        <span class="inline-block mt-2 px-4 py-1 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest">{{ $b->kategori }}</span>
                    </td>
                    <td class="px-10 py-8 text-center">
                        <span class="px-6 py-2 bg-emerald-100 text-emerald-700 rounded-full font-black text-[9px] uppercase tracking-[0.3em]">{{ $b->status }}</span>
                    </td>
                    <td class="px-10 py-8 text-sm font-bold text-slate-400 italic uppercase tracking-tighter">
                        {{ $b->created_at->format('d M Y') }}
                    </td>
                    <td class="px-10 py-8 text-right">
                        <div class="flex justify-end gap-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <button class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl hover:bg-emerald-600 hover:text-white transition shadow-sm"><i class="fa-solid fa-pen-to-square"></i></button>
                            <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST" onsubmit="return confirm('Hapus berita ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-12 h-12 bg-red-50 text-red-500 rounded-2xl hover:bg-red-500 hover:text-white transition shadow-sm"><i class="fa-solid fa-trash-can"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="py-20 text-center text-slate-300 italic font-medium">Belum ada berita yang tersedia.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>