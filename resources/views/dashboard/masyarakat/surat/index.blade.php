<x-app-layout>
    <div class="max-w-[1400px] mx-auto px-10 py-20">
        <div class="flex justify-between items-end mb-20">
            <h1 class="text-[10rem] font-serif italic text-emerald-950 leading-none">Manajemen <br>Surat.</h1>
            <a href="{{ route('masyarakat.surat.create') }}" class="px-20 py-10 bg-emerald-950 text-white font-black rounded-full text-2xl hover:bg-emerald-600 transition shadow-giant uppercase">Ajukan Baru</a>
        </div>

        <div class="grid grid-cols-1 gap-16">
            @forelse($surats as $s)
            <div class="bg-white p-20 rounded-[6rem] border-8 border-emerald-50 shadow-giant flex flex-col lg:flex-row justify-between items-center gap-16">
                <div class="flex items-center gap-12 text-center lg:text-left flex-col lg:flex-row">
                    <span class="text-[12rem] opacity-20">📄</span>
                    <div>
                        <span class="text-emerald-500 font-black uppercase text-xl tracking-widest italic">ID: #SRT-{{ $s->id }}</span>
                        <h3 class="text-7xl font-bold text-emerald-950 mt-4 leading-tight">{{ $s->jenis_surat }}</h3>
                        <p class="text-3xl text-gray-400 mt-4 italic font-medium">Diajukan pada {{ $s->created_at->format('d F Y') }}</p>
                    </div>
                </div>

                <div class="flex flex-col items-center lg:items-end gap-10">
                    <!-- Status Label -->
                    <span class="px-16 py-6 rounded-full text-2xl font-black uppercase tracking-[0.3em]
                        {{ $s->status == 'pending' ? 'bg-amber-100 text-amber-600' : '' }}
                        {{ $s->status == 'diproses' ? 'bg-blue-100 text-blue-600' : '' }}
                        {{ $s->status == 'selesai' ? 'bg-emerald-100 text-emerald-600' : '' }}
                        {{ $s->status == 'ditolak' ? 'bg-red-100 text-red-600' : '' }}">
                        {{ $s->status }}
                    </span>

                    <!-- Action Buttons -->
                    @if($s->status == 'pending')
                    <div class="flex gap-6">
                        <a href="{{ route('masyarakat.surat.edit', $s->id) }}" class="px-12 py-5 bg-emerald-100 text-emerald-700 rounded-full font-black text-xl hover:bg-emerald-950 hover:text-white transition uppercase">Ubah Data</a>
                        <form action="{{ route('masyarakat.surat.destroy', $s->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pengajuan ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-12 py-5 bg-red-50 text-red-500 rounded-full font-black text-xl hover:bg-red-600 hover:text-white transition uppercase">Batalkan</button>
                        </form>
                    </div>
                    @else
                        <p class="text-2xl text-slate-400 italic">Data sudah dikunci oleh Admin.</p>
                    @endif
                </div>
            </div>
            @empty
                <p class="text-5xl text-center text-gray-300 py-32 italic">Anda belum memiliki riwayat pengajuan surat.</p>
            @endforelse
        </div>
    </div>
</x-app-layout>