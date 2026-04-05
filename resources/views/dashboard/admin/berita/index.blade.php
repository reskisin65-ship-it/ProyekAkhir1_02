<x-admin-layout>
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-2xl font-bold text-slate-900">Kelola Berita</h1>
            <p class="text-slate-500 text-sm mt-1">Daftar berita dan pengumuman yang tampil di website publik.</p>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl font-bold text-sm shadow-lg shadow-emerald-200 transition">
            <i class="fa-solid fa-plus mr-2"></i> Tambah Berita
        </a>
    </div>

    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                    <th class="px-8 py-4">Thumbnail</th>
                    <th class="px-8 py-4">Judul & Kategori</th>
                    <th class="px-8 py-4">Status</th>
                    <th class="px-8 py-4">Tanggal Post</th>
                    <th class="px-8 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50">
                @forelse($beritas as $b)
                <tr class="hover:bg-slate-50/80 transition">
                    <td class="px-8 py-5">
                        <img src="{{ asset('storage/' . $b->foto) }}" class="w-20 h-14 rounded-lg object-cover shadow-sm">
                    </td>
                    <td class="px-8 py-5">
                        <p class="text-sm font-bold text-slate-800">{{ $b->judul }}</p>
                        <span class="text-[10px] font-bold text-emerald-600 uppercase">{{ $b->kategori }}</span>
                    </td>
                    <td class="px-8 py-5">
                        <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase {{ $b->status == 'publik' ? 'bg-emerald-100 text-emerald-600' : 'bg-slate-100 text-slate-400' }}">
                            {{ $b->status }}
                        </span>
                    </td>
                    <td class="px-8 py-5 text-sm font-medium text-slate-500">
                        {{ $b->created_at->format('d/m/Y') }}
                    </td>
                    <td class="px-8 py-5 text-center">
                        <div class="flex justify-center gap-2">
                            <button class="w-8 h-8 rounded-lg bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition"><i class="fa-solid fa-pen-to-square text-xs"></i></button>
                            <form action="{{ route('admin.berita.destroy', $b->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button class="w-8 h-8 rounded-lg bg-red-50 text-red-500 hover:bg-red-500 hover:text-white transition"><i class="fa-solid fa-trash text-xs"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-20 text-center text-slate-400 italic font-medium">Belum ada berita yang diupload.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>