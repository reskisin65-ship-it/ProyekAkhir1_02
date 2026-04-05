<x-admin-layout>
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-3xl font-black text-slate-900 tracking-tight">Verifikasi Surat</h1>
            <p class="text-slate-500 font-medium mt-1">Daftar permohonan administrasi dari warga Desa Lumban Silintong.</p>
        </div>
    </div>

    <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead class="bg-slate-50 border-b border-slate-100">
                <tr class="text-[11px] font-black uppercase tracking-[0.2em] text-slate-400">
                    <th class="px-8 py-6">Pemohon & NIK</th>
                    <th class="px-8 py-6">Jenis Surat</th>
                    <th class="px-8 py-6">Berkas</th>
                    <th class="px-8 py-6 text-center">Status Saat Ini</th>
                    <th class="px-8 py-6 text-right">Aksi Verifikasi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 text-sm">
                @forelse($surats as $s)
                <tr class="hover:bg-slate-50/80 transition duration-300">
                    <td class="px-8 py-6">
                        <p class="font-bold text-slate-800">{{ $s->user->name }}</p>
                        <p class="text-xs text-slate-400 font-medium">NIK: {{ $s->nik }}</p>
                    </td>
                    <td class="px-8 py-6 font-semibold text-slate-600">
                        {{ $s->jenis_surat }}
                    </td>
                    <td class="px-8 py-6">
                        @if($s->nama_berkas)
                            <a href="{{ asset('storage/' . $s->nama_berkas) }}" target="_blank" class="text-emerald-600 font-bold hover:underline">
                                <i class="fa-solid fa-file-pdf mr-1"></i> Lihat Berkas
                            </a>
                        @else
                            <span class="text-slate-300 italic">Tanpa Lampiran</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest
                            {{ $s->status == 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                            {{ $s->status == 'diproses' ? 'bg-blue-100 text-blue-600' : '' }}
                            {{ $s->status == 'selesai' ? 'bg-emerald-100 text-emerald-600' : '' }}
                            {{ $s->status == 'ditolak' ? 'bg-red-100 text-red-600' : '' }}">
                            {{ $s->status }}
                        </span>
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex justify-end gap-2">
                            <!-- Tombol Proses -->
                            <form action="{{ route('admin.surat.status', $s->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="diproses">
                                <button type="submit" class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition shadow-sm" title="Proses Surat"><i class="fa-solid fa-spinner"></i></button>
                            </form>

                            <!-- Tombol Selesai -->
                            <form action="{{ route('admin.surat.status', $s->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="selesai">
                                <button type="submit" class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 hover:bg-emerald-600 hover:text-white transition shadow-sm" title="Setujui"><i class="fa-solid fa-check"></i></button>
                            </form>

                            <!-- Tombol Tolak -->
                            <form action="{{ route('admin.surat.status', $s->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="ditolak">
                                <button type="submit" class="w-10 h-10 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition shadow-sm" title="Tolak"><i class="fa-solid fa-xmark"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="py-20 text-center text-slate-400 italic font-medium">Belum ada pengajuan surat yang masuk.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>