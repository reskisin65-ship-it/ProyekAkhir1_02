<x-admin-layout>
    <div class="mb-12" data-aos="fade-down">
        <h2 class="text-5xl font-black text-emerald-950 tracking-tighter uppercase leading-none">Direktori UMKM</h2>
        <p class="text-xl text-slate-400 font-medium mt-4 italic uppercase tracking-widest">Manajemen Sektor Ekonomi Kreatif Desa</p>
    </div>

    <div class="bg-white rounded-[4rem] shadow-xl shadow-slate-200/50 border border-white overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr class="text-[12px] font-black uppercase tracking-[0.3em] text-slate-400">
                    <th class="px-10 py-8">Nama Usaha & Pemilik</th>
                    <th class="px-10 py-8">Kategori</th>
                    <th class="px-10 py-8">Kontak</th>
                    <th class="px-10 py-8">Legalitas</th>
                    <th class="px-10 py-8 text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-lg font-bold text-slate-700">
                @forelse($umkms as $u)
                <tr class="hover:bg-slate-50 transition duration-300 group">
                    <td class="px-10 py-8">
                        <div class="flex items-center gap-6">
                            <div class="w-16 h-16 bg-emerald-100 rounded-2xl flex items-center justify-center text-3xl shadow-inner italic text-emerald-700">
                                {{ substr($u->nama_usaha, 0, 1) }}
                            </div>
                            <div>
                                <p class="text-2xl font-black text-emerald-950">{{ $u->nama_usaha }}</p>
                                <p class="text-sm text-slate-400 font-medium uppercase tracking-widest mt-1">Owner: {{ $u->user->name }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-10 py-8">
                        <span class="px-6 py-2 bg-emerald-50 text-emerald-700 rounded-full text-xs font-black uppercase tracking-widest border border-emerald-100">
                            {{ $u->kategori }}
                        </span>
                    </td>
                    <td class="px-10 py-8 tracking-tighter text-slate-500">
                        {{ $u->no_telepon }}
                    </td>
                    <td class="px-10 py-8">
                        @if($u->bukti_usaha)
                            <a href="{{ asset('storage/' . $u->bukti_usaha) }}" target="_blank" class="flex items-center gap-2 text-emerald-600 hover:text-emerald-900 transition underline">
                                <i class="fa-solid fa-file-circle-check text-xl"></i> Lihat Dokumen
                            </a>
                        @else
                            <span class="text-slate-300 italic font-medium">Tidak Ada Data</span>
                        @endif
                    </td>
                    <td class="px-10 py-8 text-right">
                        <div class="flex justify-end gap-4 opacity-0 group-hover:opacity-100 transition-opacity">
                             <form action="{{ route('admin.umkm.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus UMKM ini dari sistem?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-14 h-14 bg-red-50 text-red-600 rounded-2xl hover:bg-red-600 hover:text-white transition shadow-sm flex items-center justify-center text-xl">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-32 text-center text-slate-300 italic font-black text-3xl uppercase tracking-tighter">Belum ada UMKM yang terdaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>