{{-- resources/views/pages/statistik.blade.php --}}
@extends('layouts.app')

@section('title', 'Statistik Desa - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Playfair+Display:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
:root {
    --primary:#10b981;--primary-dark:#059669;--primary-light:#34d399;
    --primary-soft:rgba(16,185,129,0.08);
    --dark:#0f172a;--gray:#64748b;--gray-soft:#f1f5f9;
    --card:#ffffff;--border:#eef2f6;
    --shadow-sm:0 2px 8px rgba(0,0,0,0.03);
    --shadow-md:0 8px 24px rgba(0,0,0,0.06);
    --shadow-lg:0 20px 48px rgba(0,0,0,0.10);
    --transition:all 0.3s cubic-bezier(0.2,0,0,1);
    --transition-bounce:all 0.45s cubic-bezier(0.34,1.2,0.64,1);
}
*{margin:0;padding:0;box-sizing:border-box;}
body{font-family:'Plus Jakarta Sans',sans-serif;background:linear-gradient(135deg,#f8fafc 0%,#f1f5f9 100%);color:var(--dark);-webkit-font-smoothing:antialiased;}
::-webkit-scrollbar{width:5px}::-webkit-scrollbar-track{background:#e2e8f0;border-radius:10px}::-webkit-scrollbar-thumb{background:#94a3b8;border-radius:10px}
.bg-pattern{position:fixed;inset:0;z-index:-1;background-image:radial-gradient(#cbd5e1 0.5px,transparent 0.5px);background-size:24px 24px;opacity:0.25;}
.wrap{max-width:1280px;margin:0 auto;padding:2.5rem 1.5rem;}

/* ── Section card ─────────────────────────────── */
.sec{background:var(--card);border:1px solid var(--border);border-radius:28px;overflow:hidden;margin-bottom:1.5rem;transition:var(--transition);}
.sec:hover{box-shadow:var(--shadow-md);}
.sec-head{padding:1.2rem 1.8rem;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:0.75rem;}
.sec-head-icon{width:40px;height:40px;border-radius:14px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.sec-head h2{font-size:1rem;font-weight:700;color:var(--dark);}
.sec-head p{font-size:0.65rem;color:var(--gray);margin-top:0.1rem;}
.sec-body{padding:1.5rem 1.8rem;}

/* ── Gradient stat card ───────────────────────── */
.gcard{border-radius:20px;padding:1.2rem 1.4rem;color:white;position:relative;overflow:hidden;transition:var(--transition-bounce);}
.gcard:hover{transform:translateY(-4px);}
.gcard::after{content:'';position:absolute;top:0;left:-100%;width:100%;height:100%;background:linear-gradient(90deg,transparent,rgba(255,255,255,0.12),transparent);transition:left 0.5s;}
.gcard:hover::after{left:100%;}
.gcard .val{font-size:2rem;font-weight:800;letter-spacing:-0.04em;line-height:1;}
.gcard .lbl{font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;opacity:0.75;margin-top:0.25rem;}
.gcard .sub{font-size:0.65rem;opacity:0.6;margin-top:0.15rem;}
.gcard i.bg-icon{position:absolute;right:1rem;top:50%;transform:translateY(-50%);font-size:3rem;opacity:0.12;}

/* ── Progress bar row ─────────────────────────── */
.prow{padding:0.8rem 0;border-bottom:1px solid var(--border);}
.prow:last-child{border-bottom:none;}
.prow-top{display:flex;justify-content:space-between;align-items:center;margin-bottom:0.3rem;}
.prow-label{font-size:0.8rem;font-weight:600;color:var(--dark);}
.prow-val{font-size:0.8rem;font-weight:800;color:var(--dark);}
.prow-pct{font-size:0.62rem;color:var(--gray);margin-left:0.3rem;font-weight:400;}
.pbar{height:6px;background:#f1f5f9;border-radius:4px;overflow:hidden;}
.pbar-fill{height:100%;border-radius:4px;transition:width 0.8s ease;}

/* ── Mini stat tile ───────────────────────────── */
.tile{display:flex;align-items:center;gap:0.75rem;padding:0.9rem 1rem;background:var(--gray-soft);border-radius:16px;transition:var(--transition-bounce);}
.tile:hover{background:white;box-shadow:var(--shadow-sm);transform:translateY(-2px);}
.tile-icon{width:36px;height:36px;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;}
.tile-val{font-size:1.2rem;font-weight:800;letter-spacing:-0.03em;line-height:1;}
.tile-lbl{font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:0.07em;color:var(--gray);margin-top:0.1rem;}

/* ── Responsive ───────────────────────────────── */
@media(max-width:768px){.wrap{padding:1rem;}.sec-body{padding:1rem;}.sec-head{padding:1rem;}}
</style>

<div class="bg-pattern"></div>
<div class="wrap">

@php
    $s   = $statistics;
    $pop = max($s['total_penduduk'] ?? 1, 1);

    // color palettes
    $pal1 = ['#10b981','#3b82f6','#f59e0b','#8b5cf6','#ec4899','#06b6d4','#f97316'];
    $pal2 = ['#059669','#2563eb','#d97706','#7c3aed','#db2777','#0891b2','#ea580c'];

    $agMax  = $s['distribusi_agama']?->max('total') ?: 1;
    $pdMax  = $s['distribusi_pendidikan']?->max('total') ?: 1;
    $pkjMax = $s['distribusi_pekerjaan']?->max('total') ?: 1;
    $pkwMax = $s['distribusi_perkawinan']?->max('total') ?: 1;

    $maxUmur = max($s['kelompok_umur_0_14']??0, $s['kelompok_umur_15_29']??0,
                   $s['kelompok_umur_30_59']??0, $s['kelompok_umur_60']??0, 1);
@endphp

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- HERO BANNER --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div class="animate__animated animate__fadeInDown" style="background:linear-gradient(135deg,#064e3b 0%,#0f766e 45%,#059669 100%);border-radius:32px;padding:2.5rem 2rem;margin-bottom:2rem;position:relative;overflow:hidden;">
    <div style="position:absolute;top:-80px;right:-80px;width:260px;height:260px;background:rgba(255,255,255,0.04);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-60px;left:25%;width:180px;height:180px;background:rgba(255,255,255,0.03);border-radius:50%;"></div>
    <div style="position:relative;z-index:1;">
        <span style="display:inline-block;padding:0.3rem 1rem;background:rgba(255,255,255,0.15);border-radius:40px;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.9);margin-bottom:1rem;">
            📊 Data Kependudukan &amp; Desa
        </span>
        <h1 style="font-family:'Playfair Display',serif;font-size:clamp(2rem,5vw,3rem);font-weight:700;color:white;line-height:1.1;margin-bottom:0.6rem;">
            Statistik <em>Desa Lumban Silintong</em>
        </h1>
        <p style="color:rgba(255,255,255,0.7);font-size:0.88rem;max-width:520px;line-height:1.6;margin-bottom:1.5rem;">
            Data kependudukan, demografi, UMKM, dan layanan desa yang diperbarui langsung dari database.
        </p>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;">
            @foreach([
                ['Total Penduduk', number_format($s['total_penduduk']??0)],
                ['Kepala Keluarga', number_format($s['total_kk']??0)],
                ['Total UMKM', number_format($s['total_umkm']??0)],
                ['Pengajuan Surat', number_format($s['total_surat']??0)],
            ] as [$lbl,$val])
            <div style="background:rgba(255,255,255,0.12);backdrop-filter:blur(10px);border-radius:16px;padding:0.8rem 1.2rem;text-align:center;border:1px solid rgba(255,255,255,0.2);">
                <div style="font-size:1.4rem;font-weight:800;color:white;">{{ $val }}</div>
                <div style="font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.65);">{{ $lbl }}</div>
            </div>
            @endforeach
        </div>
        <div style="margin-top:1rem;font-size:0.65rem;color:rgba(255,255,255,0.5);">
            <i class="fa-regular fa-clock" style="margin-right:0.3rem;"></i> Terakhir diperbarui: {{ now()->translatedFormat('d F Y, H:i') }} WIB
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- SEC 1: 5 KARTU UTAMA KEPENDUDUKAN --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div class="sec animate__animated animate__fadeInUp">
    <div class="sec-head">
        <div class="sec-head-icon" style="background:rgba(16,185,129,0.1);">
            <i class="fa-solid fa-users" style="color:#10b981;"></i>
        </div>
        <div><h2>Data Kependudukan</h2><p>Ringkasan jumlah penduduk desa</p></div>
    </div>
    <div class="sec-body">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(180px,1fr));gap:1rem;">
            @foreach([
                ['Total Penduduk', $s['total_penduduk']??0, 'fa-users',       'linear-gradient(135deg,#10b981,#059669)', ''],
                ['Laki-laki',      $s['penduduk_pria']??0,  'fa-mars',        'linear-gradient(135deg,#3b82f6,#2563eb)', round(($s['penduduk_pria']??0)/$pop*100,1).'% dari total'],
                ['Perempuan',      $s['penduduk_wanita']??0,'fa-venus',        'linear-gradient(135deg,#ec4899,#db2777)', round(($s['penduduk_wanita']??0)/$pop*100,1).'% dari total'],
                ['Kepala Keluarga',$s['total_kk']??0,       'fa-house-user',  'linear-gradient(135deg,#f59e0b,#d97706)', 'rata-rata '.($s['total_kk']>0 ? round($pop/$s['total_kk'],1) : '-').' jiwa/KK'],
                ['Data Terdaftar', $s['total_penduduk']??0, 'fa-id-card',     'linear-gradient(135deg,#8b5cf6,#7c3aed)', 'warga terdaftar NIK'],
            ] as [$lbl,$val,$icon,$bg,$sub])
            <div class="gcard" style="background:{{ $bg }};">
                <i class="fa-solid {{ $icon }} bg-icon"></i>
                <div class="val">{{ number_format($val) }}</div>
                <div class="lbl">{{ $lbl }}</div>
                @if($sub)<div class="sub">{{ $sub }}</div>@endif
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- SEC 2: KELOMPOK UMUR + JENIS KELAMIN --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;" class="animate__animated animate__fadeInUp">

    {{-- Kelompok Umur --}}
    <div class="sec" style="margin-bottom:0;">
        <div class="sec-head">
            <div class="sec-head-icon" style="background:rgba(139,92,246,0.1);">
                <i class="fa-solid fa-chart-bar" style="color:#8b5cf6;"></i>
            </div>
            <div><h2>Kelompok Umur</h2><p>Sebaran usia penduduk desa</p></div>
        </div>
        <div class="sec-body">
            @foreach([
                ['0 – 14 Tahun (Anak)'       , $s['kelompok_umur_0_14']??0,  '#10b981'],
                ['15 – 29 Tahun (Remaja)'     , $s['kelompok_umur_15_29']??0, '#3b82f6'],
                ['30 – 59 Tahun (Produktif)'  , $s['kelompok_umur_30_59']??0, '#f59e0b'],
                ['60+ Tahun (Lansia)'         , $s['kelompok_umur_60']??0,    '#8b5cf6'],
            ] as [$lbl,$val,$color])
            @php $pct = round($val/$pop*100,1); $barW = round($val/$maxUmur*100); @endphp
            <div class="prow">
                <div class="prow-top">
                    <span class="prow-label">{{ $lbl }}</span>
                    <span><span class="prow-val">{{ number_format($val) }}</span><span class="prow-pct">({{ $pct }}%)</span></span>
                </div>
                <div class="pbar"><div class="pbar-fill" style="width:{{ $barW }}%;background:{{ $color }};"></div></div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Komposisi Jenis Kelamin (visual) --}}
    <div class="sec" style="margin-bottom:0;">
        <div class="sec-head">
            <div class="sec-head-icon" style="background:rgba(236,72,153,0.1);">
                <i class="fa-solid fa-venus-mars" style="color:#ec4899;"></i>
            </div>
            <div><h2>Komposisi Gender</h2><p>Rasio laki-laki dan perempuan</p></div>
        </div>
        <div class="sec-body">
            @php
                $priaP  = $pop > 0 ? round(($s['penduduk_pria']??0)/$pop*100,1) : 0;
                $wanP   = $pop > 0 ? round(($s['penduduk_wanita']??0)/$pop*100,1) : 0;
            @endphp
            {{-- Visual bar --}}
            <div style="height:20px;border-radius:10px;overflow:hidden;display:flex;margin-bottom:1.2rem;">
                <div style="width:{{ $priaP }}%;background:linear-gradient(90deg,#3b82f6,#2563eb);transition:width 1s;"></div>
                <div style="flex:1;background:linear-gradient(90deg,#ec4899,#db2777);"></div>
            </div>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
                <div style="background:#eff6ff;border-radius:20px;padding:1.2rem;text-align:center;">
                    <i class="fa-solid fa-mars" style="color:#3b82f6;font-size:1.8rem;display:block;margin-bottom:0.5rem;"></i>
                    <div style="font-size:2rem;font-weight:800;color:#1d4ed8;">{{ number_format($s['penduduk_pria']??0) }}</div>
                    <div style="font-size:0.7rem;font-weight:700;color:#3b82f6;text-transform:uppercase;">Laki-laki</div>
                    <div style="font-size:1.1rem;font-weight:800;color:#1d4ed8;margin-top:0.3rem;">{{ $priaP }}%</div>
                </div>
                <div style="background:#fdf2f8;border-radius:20px;padding:1.2rem;text-align:center;">
                    <i class="fa-solid fa-venus" style="color:#ec4899;font-size:1.8rem;display:block;margin-bottom:0.5rem;"></i>
                    <div style="font-size:2rem;font-weight:800;color:#be185d;">{{ number_format($s['penduduk_wanita']??0) }}</div>
                    <div style="font-size:0.7rem;font-weight:700;color:#ec4899;text-transform:uppercase;">Perempuan</div>
                    <div style="font-size:1.1rem;font-weight:800;color:#be185d;margin-top:0.3rem;">{{ $wanP }}%</div>
                </div>
            </div>
            <div style="margin-top:1rem;padding:0.8rem 1rem;background:#f0fdf4;border-radius:14px;display:flex;align-items:center;gap:0.5rem;">
                <i class="fa-solid fa-circle-info" style="color:#10b981;"></i>
                <span style="font-size:0.72rem;color:#065f46;">
                    Sex ratio: <strong>{{ ($s['penduduk_wanita']??0) > 0 ? round(($s['penduduk_pria']??0)/($s['penduduk_wanita']??0)*100) : '-' }}</strong>
                    (jumlah laki-laki per 100 perempuan)
                </span>
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- SEC 3: AGAMA + PENDIDIKAN --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;" class="animate__animated animate__fadeInUp">

    {{-- Agama --}}
    <div class="sec" style="margin-bottom:0;">
        <div class="sec-head">
            <div class="sec-head-icon" style="background:rgba(245,158,11,0.1);">
                <i class="fa-solid fa-place-of-worship" style="color:#f59e0b;"></i>
            </div>
            <div><h2>Distribusi Agama</h2><p>Keberagaman keyakinan warga desa</p></div>
        </div>
        <div class="sec-body">
            @if(($s['distribusi_agama']??collect())->count() > 0)
                @foreach($s['distribusi_agama'] as $i => $row)
                @php $pct = $pop>0 ? round($row->total/$pop*100,1) : 0; @endphp
                <div class="prow">
                    <div class="prow-top">
                        <span class="prow-label">{{ $row->agama }}</span>
                        <span><span class="prow-val">{{ number_format($row->total) }}</span><span class="prow-pct">({{ $pct }}%)</span></span>
                    </div>
                    <div class="pbar"><div class="pbar-fill" style="width:{{ round($row->total/$agMax*100) }}%;background:{{ $pal1[$i % count($pal1)] }};"></div></div>
                </div>
                @endforeach
            @else
                <div style="padding:2rem;text-align:center;color:#94a3b8;font-size:0.8rem;">
                    <i class="fa-solid fa-database" style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.4;"></i>
                    Data agama belum diisi di profil penduduk
                </div>
            @endif
        </div>
    </div>

    {{-- Pendidikan --}}
    <div class="sec" style="margin-bottom:0;">
        <div class="sec-head">
            <div class="sec-head-icon" style="background:rgba(6,182,212,0.1);">
                <i class="fa-solid fa-graduation-cap" style="color:#06b6d4;"></i>
            </div>
            <div><h2>Tingkat Pendidikan</h2><p>Jenjang pendidikan terakhir warga</p></div>
        </div>
        <div class="sec-body">
            @if(($s['distribusi_pendidikan']??collect())->count() > 0)
                @foreach($s['distribusi_pendidikan'] as $i => $row)
                @php $pct = $pop>0 ? round($row->total/$pop*100,1) : 0; @endphp
                <div class="prow">
                    <div class="prow-top">
                        <span class="prow-label">{{ $row->pendidikan }}</span>
                        <span><span class="prow-val">{{ number_format($row->total) }}</span><span class="prow-pct">({{ $pct }}%)</span></span>
                    </div>
                    <div class="pbar"><div class="pbar-fill" style="width:{{ round($row->total/$pdMax*100) }}%;background:{{ $pal2[$i % count($pal2)] }};"></div></div>
                </div>
                @endforeach
            @else
                <div style="padding:2rem;text-align:center;color:#94a3b8;font-size:0.8rem;">
                    <i class="fa-solid fa-database" style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.4;"></i>
                    Data pendidikan belum diisi di profil penduduk
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- SEC 4: PEKERJAAN + STATUS PERKAWINAN --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;" class="animate__animated animate__fadeInUp">

    {{-- Pekerjaan --}}
    <div class="sec" style="margin-bottom:0;">
        <div class="sec-head">
            <div class="sec-head-icon" style="background:rgba(16,185,129,0.1);">
                <i class="fa-solid fa-briefcase" style="color:#10b981;"></i>
            </div>
            <div><h2>Mata Pencaharian</h2><p>8 pekerjaan terbanyak warga desa</p></div>
        </div>
        <div class="sec-body">
            @if(($s['distribusi_pekerjaan']??collect())->count() > 0)
                @foreach($s['distribusi_pekerjaan'] as $i => $row)
                @php $pct = $pop>0 ? round($row->total/$pop*100,1) : 0; @endphp
                <div class="prow">
                    <div class="prow-top">
                        <span class="prow-label">{{ $row->pekerjaan }}</span>
                        <span><span class="prow-val">{{ number_format($row->total) }}</span><span class="prow-pct">({{ $pct }}%)</span></span>
                    </div>
                    <div class="pbar"><div class="pbar-fill" style="width:{{ round($row->total/$pkjMax*100) }}%;background:{{ $pal1[$i % count($pal1)] }};"></div></div>
                </div>
                @endforeach
            @else
                <div style="padding:2rem;text-align:center;color:#94a3b8;font-size:0.8rem;">
                    <i class="fa-solid fa-database" style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.4;"></i>
                    Data pekerjaan belum diisi di profil penduduk
                </div>
            @endif
        </div>
    </div>

    {{-- Status Perkawinan --}}
    <div class="sec" style="margin-bottom:0;">
        <div class="sec-head">
            <div class="sec-head-icon" style="background:rgba(236,72,153,0.1);">
                <i class="fa-solid fa-heart" style="color:#ec4899;"></i>
            </div>
            <div><h2>Status Perkawinan</h2><p>Distribusi status pernikahan warga</p></div>
        </div>
        <div class="sec-body">
            @if(($s['distribusi_perkawinan']??collect())->count() > 0)
                @php $pkwTotal = $s['distribusi_perkawinan']->sum('total') ?: 1; @endphp
                @foreach($s['distribusi_perkawinan'] as $i => $row)
                @php $pct = round($row->total/$pkwTotal*100,1); @endphp
                <div class="prow">
                    <div class="prow-top">
                        <span class="prow-label">{{ $row->status_perkawinan }}</span>
                        <span><span class="prow-val">{{ number_format($row->total) }}</span><span class="prow-pct">({{ $pct }}%)</span></span>
                    </div>
                    <div class="pbar"><div class="pbar-fill" style="width:{{ round($row->total/$pkwMax*100) }}%;background:{{ $pal2[$i % count($pal2)] }};"></div></div>
                </div>
                @endforeach
            @else
                <div style="padding:2rem;text-align:center;color:#94a3b8;font-size:0.8rem;">
                    <i class="fa-solid fa-database" style="font-size:2rem;display:block;margin-bottom:0.5rem;opacity:0.4;"></i>
                    Data status perkawinan belum diisi di profil penduduk
                </div>
            @endif
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- SEC 5: UMKM --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div class="sec animate__animated animate__fadeInUp">
    <div class="sec-head">
        <div class="sec-head-icon" style="background:rgba(245,158,11,0.1);">
            <i class="fa-solid fa-store" style="color:#f59e0b;"></i>
        </div>
        <div><h2>Statistik UMKM</h2><p>Usaha Mikro Kecil dan Menengah Desa Lumban Silintong</p></div>
        <a href="{{ route('umkm') }}" style="margin-left:auto;font-size:0.72rem;font-weight:600;color:#f59e0b;text-decoration:none;white-space:nowrap;">Lihat UMKM →</a>
    </div>
    <div class="sec-body">
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:1rem;">
            @foreach([
                ['Total UMKM',      $s['total_umkm']??0,    'fa-shop',        'linear-gradient(135deg,#f59e0b,#d97706)'],
                ['UMKM Aktif',      $s['umkm_approved']??0, 'fa-circle-check','linear-gradient(135deg,#10b981,#059669)'],
                ['Menunggu Verif.', $s['umkm_pending']??0,  'fa-clock',       'linear-gradient(135deg,#3b82f6,#2563eb)'],
                ['Ditolak',         $s['umkm_rejected']??0, 'fa-circle-xmark','linear-gradient(135deg,#ef4444,#dc2626)'],
            ] as [$lbl,$val,$icon,$bg])
            <div class="gcard" style="background:{{ $bg }};">
                <i class="fa-solid {{ $icon }} bg-icon"></i>
                <i class="fa-solid {{ $icon }}" style="font-size:1.4rem;opacity:0.85;display:block;margin-bottom:0.5rem;"></i>
                <div class="val">{{ number_format($val) }}</div>
                <div class="lbl">{{ $lbl }}</div>
                @if(($s['total_umkm']??0) > 0)
                <div class="sub">{{ round($val/($s['total_umkm']??1)*100) }}% dari total</div>
                @endif
            </div>
            @endforeach
        </div>

        @if(($s['total_umkm']??0) > 0)
        <div style="margin-top:1.2rem;display:flex;gap:0.75rem;align-items:center;flex-wrap:wrap;">
            <div style="flex:1;background:#fffbeb;border-radius:14px;padding:0.8rem 1rem;">
                <div style="font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:#92400e;margin-bottom:0.25rem;">Tingkat Aktivasi</div>
                <div style="height:8px;background:#fde68a;border-radius:4px;overflow:hidden;">
                    <div style="height:100%;background:linear-gradient(90deg,#f59e0b,#d97706);border-radius:4px;width:{{ ($s['total_umkm']??0)>0 ? round(($s['umkm_approved']??0)/($s['total_umkm']??1)*100) : 0 }}%;"></div>
                </div>
                <div style="font-size:0.7rem;color:#b45309;margin-top:0.3rem;font-weight:600;">{{ ($s['total_umkm']??0)>0 ? round(($s['umkm_approved']??0)/($s['total_umkm']??1)*100) : 0 }}% UMKM aktif beroperasi</div>
            </div>
        </div>
        @endif
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- SEC 6: LAYANAN DIGITAL --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div class="sec animate__animated animate__fadeInUp">
    <div class="sec-head">
        <div class="sec-head-icon" style="background:rgba(6,182,212,0.1);">
            <i class="fa-solid fa-bolt" style="color:#06b6d4;"></i>
        </div>
        <div><h2>Layanan Digital Desa</h2><p>Aktivitas penggunaan layanan administrasi online</p></div>
    </div>
    <div class="sec-body">

        {{-- 3 big cards --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:1.2rem;">
            @foreach([
                ['Pengajuan Surat', $s['total_surat']??0,    'fa-file-signature','linear-gradient(135deg,#10b981,#059669)'],
                ['Aspirasi Warga',  $s['total_aspirasi']??0, 'fa-comment-dots', 'linear-gradient(135deg,#8b5cf6,#7c3aed)'],
                ['Berita Publik',   $s['total_berita']??0,   'fa-newspaper',    'linear-gradient(135deg,#3b82f6,#2563eb)'],
            ] as [$lbl,$val,$icon,$bg])
            <div class="gcard" style="background:{{ $bg }};">
                <i class="fa-solid {{ $icon }} bg-icon"></i>
                <i class="fa-solid {{ $icon }}" style="font-size:1.4rem;opacity:0.85;display:block;margin-bottom:0.5rem;"></i>
                <div class="val">{{ number_format($val) }}</div>
                <div class="lbl">{{ $lbl }}</div>
            </div>
            @endforeach
        </div>

        {{-- Status Surat breakdown --}}
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:1rem;">
            <div>
                <div style="font-size:0.75rem;font-weight:700;color:var(--dark);margin-bottom:0.75rem;display:flex;align-items:center;gap:0.5rem;">
                    <i class="fa-regular fa-file-lines" style="color:#10b981;"></i> Status Pengajuan Surat
                </div>
                @php $suratT = max($s['total_surat']??0, 1); @endphp
                @foreach([
                    ['Selesai',  $s['surat_selesai']??0,  '#10b981'],
                    ['Menunggu', $s['surat_menunggu']??0, '#f59e0b'],
                    ['Ditolak',  $s['surat_ditolak']??0,  '#ef4444'],
                ] as [$lbl,$val,$color])
                <div class="prow">
                    <div class="prow-top">
                        <span class="prow-label">{{ $lbl }}</span>
                        <span><span class="prow-val">{{ number_format($val) }}</span><span class="prow-pct">({{ round($val/$suratT*100) }}%)</span></span>
                    </div>
                    <div class="pbar"><div class="pbar-fill" style="width:{{ round($val/$suratT*100) }}%;background:{{ $color }};"></div></div>
                </div>
                @endforeach
            </div>
            <div>
                <div style="font-size:0.75rem;font-weight:700;color:var(--dark);margin-bottom:0.75rem;display:flex;align-items:center;gap:0.5rem;">
                    <i class="fa-solid fa-comment-dots" style="color:#8b5cf6;"></i> Status Aspirasi Warga
                </div>
                @php $aspT = max($s['total_aspirasi']??0, 1); @endphp
                @foreach([
                    ['Selesai Ditanggapi', $s['aspirasi_selesai']??0, '#10b981'],
                    ['Belum Ditanggapi',   ($s['total_aspirasi']??0) - ($s['aspirasi_selesai']??0), '#8b5cf6'],
                ] as [$lbl,$val,$color])
                <div class="prow">
                    <div class="prow-top">
                        <span class="prow-label">{{ $lbl }}</span>
                        <span><span class="prow-val">{{ number_format($val) }}</span><span class="prow-pct">({{ round($val/$aspT*100) }}%)</span></span>
                    </div>
                    <div class="pbar"><div class="pbar-fill" style="width:{{ round($val/$aspT*100) }}%;background:{{ $color }};"></div></div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- FOOTER --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div style="background:linear-gradient(135deg,#ecfdf5,#d1fae5);border-radius:20px;padding:1rem 1.5rem;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.75rem;margin-bottom:2rem;" class="animate__animated animate__fadeInUp">
    <div style="display:flex;align-items:center;gap:0.75rem;">
        <i class="fa-solid fa-shield-halved" style="color:#10b981;font-size:1.2rem;"></i>
        <div>
            <div style="font-size:0.75rem;font-weight:700;color:#065f46;">Data terverifikasi &amp; realtime</div>
            <div style="font-size:0.65rem;color:#6b7280;">Sumber: Database resmi Desa Lumban Silintong · {{ now()->format('d M Y') }}</div>
        </div>
    </div>
    <div style="display:flex;gap:0.5rem;flex-wrap:wrap;">
        @auth
        <a href="{{ route('masyarakat.statistik') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;background:#10b981;color:white;border-radius:20px;font-size:0.72rem;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-chart-line" style="font-size:0.65rem;"></i> Statistik Saya
        </a>
        @endauth
        <a href="{{ route('home') }}" style="display:inline-flex;align-items:center;gap:0.5rem;padding:0.5rem 1rem;background:white;border:1px solid #d1fae5;color:#059669;border-radius:20px;font-size:0.72rem;font-weight:700;text-decoration:none;">
            <i class="fa-solid fa-house" style="font-size:0.65rem;"></i> Kembali ke Beranda
        </a>
    </div>
</div>

</div>{{-- end wrap --}}
@endsection
