{{-- resources/views/admin/statistik/kelola.blade.php --}}
@extends('layouts.admin')

@section('title', 'Kelola Statistik - Lumban Silintong')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
        <div>
            <h1 class="text-3xl font-bold tracking-tight">Kelola Statistik Desa</h1>
            <p class="mt-2 text-sm text-slate-500">Atur nilai statistik secara otomatis, hybrid, atau manual untuk metrik utama desa.</p>
        </div>
        <a href="{{ route('admin.statistik.index') }}" class="inline-flex items-center rounded-md bg-emerald-500 px-4 py-2 text-sm font-semibold text-white transition hover:bg-emerald-600">
            Kembali ke Ringkasan Statistik
        </a>
    </div>

    @if(session('success'))
        <div class="rounded-xl border border-emerald-200 bg-emerald-50 p-4 text-sm text-emerald-900">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-900">
            <ul class="list-disc space-y-1 pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid gap-5 lg:grid-cols-2">
        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold">Data Realtime</h2>
            <p class="mt-2 text-sm text-slate-500">Nilai statistik saat ini dihitung dari data terbaru di sistem.</p>
            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                @foreach([
                    'total_penduduk' => 'Total Penduduk',
                    'laki_laki' => 'Laki-laki',
                    'perempuan' => 'Perempuan',
                    'kepala_keluarga' => 'Kepala Keluarga',
                    'kelompok_umur_0_14' => 'Usia 0-14',
                    'kelompok_umur_15_29' => 'Usia 15-29',
                    'kelompok_umur_30_59' => 'Usia 30-59',
                    'kelompok_umur_60' => 'Usia 60+',
                    'total_umkm' => 'Total UMKM',
                    'umkm_aktif' => 'UMKM Aktif',
                    'total_surat' => 'Total Surat',
                    'total_aspirasi' => 'Total Aspirasi',
                    'total_berita' => 'Total Berita',
                ] as $key => $label)
                    <div class="rounded-3xl border border-slate-200 bg-slate-50 p-4">
                        <p class="text-xs uppercase tracking-[0.2em] text-slate-500">{{ $label }}</p>
                        <p class="mt-3 text-3xl font-semibold text-slate-900">{{ number_format($realtime[$key] ?? 0) }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-semibold">Panduan Pengaturan</h2>
            <p class="mt-2 text-sm text-slate-500">Gunakan opsi berikut untuk memilih bagaimana nilai statistik ditentukan.</p>
            <div class="mt-6 space-y-4">
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="font-semibold">Otomatis</h3>
                    <p class="mt-1 text-sm text-slate-600">Nilai dihitung langsung dari basis data dan tidak dapat diubah secara manual.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="font-semibold">Hybrid</h3>
                    <p class="mt-1 text-sm text-slate-600">Nilai otomatis digunakan sebagai dasar, tetapi tetap dapat diberi nilai awal khusus.</p>
                </div>
                <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                    <h3 class="font-semibold">Manual</h3>
                    <p class="mt-1 text-sm text-slate-600">Nilai yang dimasukkan akan disimpan secara permanen dan tidak diambil dari perhitungan realtime.</p>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('admin.statistik.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid gap-5">
            @foreach([
                'total_penduduk' => 'Total Penduduk',
                'laki_laki' => 'Laki-laki',
                'perempuan' => 'Perempuan',
                'kepala_keluarga' => 'Kepala Keluarga',
                'kelompok_umur_0_14' => 'Penduduk Usia 0-14',
                'kelompok_umur_15_29' => 'Penduduk Usia 15-29',
                'kelompok_umur_30_59' => 'Penduduk Usia 30-59',
                'kelompok_umur_60' => 'Penduduk Usia 60+',
                'total_umkm' => 'Total UMKM',
                'umkm_aktif' => 'UMKM Aktif',
                'total_surat' => 'Total Surat',
                'total_aspirasi' => 'Total Aspirasi',
                'total_berita' => 'Total Berita',
            ] as $key => $label)
                @php
                    $config = $pengaturan[$key] ?? null;
                    $selectedMode = old('mode_' . $key, optional($config)->mode ?? 'otomatis');
                    $value = old($key, optional($config)->nilai_awal ?? $realtime[$key] ?? '');
                @endphp
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h3 class="text-lg font-semibold">{{ $label }}</h3>
                            <p class="mt-1 text-sm text-slate-500">Nilai realtime: <span class="font-semibold">{{ number_format($realtime[$key] ?? 0) }}</span></p>
                        </div>
                        <div class="inline-flex items-center gap-2 rounded-full border border-slate-200 bg-slate-50 px-3 py-2 text-xs font-semibold text-slate-600">
                            Mode saat ini: {{ ucfirst($selectedMode) }}
                        </div>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-[1.2fr_1fr]">
                        <div>
                            <label class="block text-sm font-medium text-slate-700" for="mode_{{ $key }}">Mode</label>
                            <select name="mode_{{ $key }}" id="mode_{{ $key }}" class="mt-2 block w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100">
                                <option value="otomatis"{{ $selectedMode === 'otomatis' ? ' selected' : '' }}>Otomatis</option>
                                <option value="hybrid"{{ $selectedMode === 'hybrid' ? ' selected' : '' }}>Hybrid</option>
                                <option value="manual"{{ $selectedMode === 'manual' ? ' selected' : '' }}>Manual</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-slate-700" for="{{ $key }}">Nilai</label>
                            <input type="number" name="{{ $key }}" id="{{ $key }}" value="{{ $value }}" class="mt-2 block w-full rounded-xl border border-slate-300 bg-slate-50 px-4 py-3 text-sm text-slate-700 focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-100" step="1" min="0">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <p class="text-sm text-slate-500">Simpan perubahan untuk memperbarui pengaturan statistik manual dan hybrid.</p>
            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white transition hover:bg-emerald-700">Simpan Pengaturan Statistik</button>
        </div>
    </form>
</div>
@endsection
