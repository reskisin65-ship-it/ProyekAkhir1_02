{{-- resources/views/masyarakat/statistik.blade.php --}}
@extends('layouts.app')

@section('title', 'Statistik Saya - Lumban Silintong')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Playfair+Display:ital,wght@0,700;1,400&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
:root {
    --primary:#10b981;--primary-dark:#059669;--primary-light:#34d399;
    --primary-soft:rgba(16,185,129,0.08);
    --blue:#3b82f6;--purple:#8b5cf6;--orange:#f59e0b;--pink:#ec4899;
    --cyan:#06b6d4;--teal:#14b8a6;--red:#ef4444;
    --dark:#0f172a;--gray:#64748b;--gray-soft:#f1f5f9;
    --card:#ffffff;--border:#eef2f6;
    --shadow-sm:0 2px 8px rgba(0,0,0,0.03);
    --shadow-md:0 8px 24px rgba(0,0,0,0.06);
    --shadow-lg:0 20px 48px rgba(0,0,0,0.10);
    --shadow-xl:0 32px 64px rgba(0,0,0,0.12);
    --transition:all 0.3s cubic-bezier(0.2,0,0,1);
    --transition-bounce:all 0.45s cubic-bezier(0.34,1.2,0.64,1);
}
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f8fafc;color:var(--dark);-webkit-font-smoothing:antialiased;}
.bg-pattern{position:fixed;inset:0;z-index:0;background-image:radial-gradient(#cbd5e1 0.5px,transparent 0.5px);background-size:26px 26px;opacity:0.18;pointer-events:none;}
.page-wrap{max-width:1200px;margin:0 auto;padding:2.5rem 1.5rem;position:relative;z-index:1;}
</style>

<div class="bg-pattern"></div>
<div class="min-h-screen" style="background:linear-gradient(135deg,#f8fafc 0%,#f1f5f9 100%);">
<div class="page-wrap">

@php
    $user = auth()->user();
    $uid  = $user->user_id;  // primary key custom

    // ── Surat user ──────────────────────────────────────────────────────
    $suratAll      = \App\Models\PengajuanSurat::where('user_id',$uid)->orderByDesc('created_at')->get();
    $suratTotal    = $suratAll->count();
    $suratMenunggu = $suratAll->where('status','menunggu')->count();
    $suratDiproses = $suratAll->whereIn('status',['diproses','disetujui'])->count();
    $suratSelesai  = $suratAll->where('status','selesai')->count();
    $suratDitolak  = $suratAll->where('status','ditolak')->count();
    $suratTerbaru  = $suratAll->take(6);
    // Jenis surat terbanyak
    $jenisSurat    = $suratAll->groupBy('jenis_surat')->map->count()->sortDesc()->take(4);
    // ── Aspirasi user ────────────────────────────────────────────────────
    $aspAll        = \App\Models\Aspirasi::where('user_id',$uid)->orderByDesc('created_at')->get();
    $aspTotal      = $aspAll->count();
    $aspBaru       = $aspAll->where('status','baru')->count();
    $aspDiproses   = $aspAll->where('status','diproses')->count();
    $aspSelesai    = $aspAll->where('status','selesai')->count();
    $aspTerbaru    = $aspAll->take(6);
    $aspKategori   = $aspAll->groupBy('kategori')->map->count()->sortDesc()->take(4);
    // ── Surat bulan ini ──────────────────────────────────────────────────
    $suratBulanIni  = $suratAll->where('created_at','>=',now()->startOfMonth())->count();
    $aspBulanIni    = $aspAll->where('created_at','>=',now()->startOfMonth())->count();
    // ── Akun info ────────────────────────────────────────────────────────
    $akunDibuat     = $user->created_at->diffForHumans();
    $totalAktivitas = $suratTotal + $aspTotal;
@endphp

{{-- ═══════════════════════════════════════════════════════════════════ --}}
{{-- HERO GREETING --}}
{{-- ═══════════════════════════════════════════════════════════════════ --}}
<div class="relative mb-10 rounded-[2.5rem] overflow-hidden animate__animated animate__fadeInDown"
     style="background:linear-gradient(135deg,#064e3b 0%,#0f766e 50%,#059669 100%);padding:2.5rem 2rem;">
    <div style="position:absolute;top:-60px;right:-60px;width:220px;height:220px;background:rgba(255,255,255,0.04);border-radius:50%;"></div>
    <div style="position:absolute;bottom:-40px;left:30%;width:160px;height:160px;background:rgba(255,255,255,0.03);border-radius:50%;"></div>
    <div style="position:relative;z-index:1;display:flex;justify-content:space-between;align-items:flex-end;flex-wrap:wrap;gap:1.5rem;">
        <div>
            <span style="display:inline-block;padding:0.3rem 1rem;background:rgba(255,255,255,0.15);border-radius:40px;font-size:0.65rem;font-weight:700;letter-spacing:0.12em;text-transform:uppercase;color:rgba(255,255,255,0.9);margin-bottom:1rem;">
                📊 Statistik Aktivitas
            </span>
            <h1 style="font-family:'Playfair Display',serif;font-size:clamp(2rem,5vw,3.5rem);font-weight:700;color:white;line-height:1.1;margin-bottom:0.5rem;">
                Halo, <em>{{ $user->name }}</em>
            </h1>
            <p style="color:rgba(255,255,255,0.75);font-size:0.9rem;max-width:480px;line-height:1.6;">
                Berikut ringkasan lengkap aktivitas & pengajuan layanan yang pernah kamu lakukan.
            </p>
        </div>
        <div style="display:flex;gap:1rem;flex-wrap:wrap;">
            <div style="background:rgba(255,255,255,0.12);backdrop-filter:blur(12px);border-radius:20px;padding:1rem 1.5rem;text-align:center;border:1px solid rgba(255,255,255,0.2);">
                <div style="font-size:1.8rem;font-weight:800;color:white;">{{ $totalAktivitas }}</div>
                <div style="font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.7);">Total Aktivitas</div>
            </div>
            <div style="background:rgba(255,255,255,0.12);backdrop-filter:blur(12px);border-radius:20px;padding:1rem 1.5rem;text-align:center;border:1px solid rgba(255,255,255,0.2);">
                <div style="font-size:1.8rem;font-weight:800;color:white;">{{ $suratBulanIni + $aspBulanIni }}</div>
                <div style="font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.7);">Bulan Ini</div>
            </div>
            <div style="background:rgba(255,255,255,0.12);backdrop-filter:blur(12px);border-radius:20px;padding:1rem 1.5rem;text-align:center;border:1px solid rgba(255,255,255,0.2);">
                <div style="font-size:1.8rem;font-weight:800;color:white;">{{ $suratSelesai + $aspSelesai }}</div>
                <div style="font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:0.1em;color:rgba(255,255,255,0.7);">Selesai</div>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════ --}}
{{-- SUMMARY CARDS — 6 KARTU --}}
{{-- ═══════════════════════════════════════════════════════════════════ --}}
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;margin-bottom:2rem;" class="animate__animated animate__fadeInUp">
    @foreach([
        ['label'=>'Total Surat','val'=>$suratTotal,'icon'=>'fa-file-lines','grad'=>'from-emerald-500 to-teal-500','light'=>'#ecfdf5','text'=>'#059669'],
        ['label'=>'Surat Selesai','val'=>$suratSelesai,'icon'=>'fa-circle-check','grad'=>'from-teal-500 to-cyan-500','light'=>'#f0fdfa','text'=>'#0d9488'],
        ['label'=>'Surat Menunggu','val'=>$suratMenunggu,'icon'=>'fa-hourglass-half','grad'=>'from-orange-500 to-amber-500','light'=>'#fff7ed','text'=>'#c2410c'],
        ['label'=>'Surat Ditolak','val'=>$suratDitolak,'icon'=>'fa-circle-xmark','grad'=>'from-red-500 to-rose-500','light'=>'#fff1f2','text'=>'#be123c'],
        ['label'=>'Total Aspirasi','val'=>$aspTotal,'icon'=>'fa-comment-dots','grad'=>'from-violet-500 to-purple-500','light'=>'#f5f3ff','text'=>'#6d28d9'],
        ['label'=>'Aspirasi Selesai','val'=>$aspSelesai,'icon'=>'fa-comments','grad'=>'from-blue-500 to-cyan-500','light'=>'#eff6ff','text'=>'#1d4ed8'],
    ] as $c)
    <div class="group" style="background:{{ $c['light'] }};border-radius:24px;padding:1.4rem;border:1px solid {{ $c['light'] }};transition:all 0.35s cubic-bezier(0.34,1.2,0.64,1);cursor:default;"
         onmouseover="this.style.transform='translateY(-6px)';this.style.boxShadow='0 16px 40px rgba(0,0,0,0.1)'"
         onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:0.75rem;">
            <div style="width:44px;height:44px;background:linear-gradient(135deg,{{ explode(' ',$c['grad'])[0] === 'from-emerald-500' ? '#10b981,#14b8a6' : (str_contains($c['grad'],'teal-500 to-cyan') ? '#14b8a6,#06b6d4' : (str_contains($c['grad'],'orange') ? '#f97316,#f59e0b' : (str_contains($c['grad'],'red') ? '#ef4444,#f43f5e' : (str_contains($c['grad'],'violet') ? '#8b5cf6,#a855f7' : '#3b82f6,#06b6d4')))) }});border-radius:14px;display:flex;align-items:center;justify-content:center;box-shadow:0 4px 12px rgba(0,0,0,0.12);">
                <i class="fa-solid {{ $c['icon'] }}" style="color:white;font-size:1rem;"></i>
            </div>
            <span style="font-size:0.6rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:{{ $c['text'] }};opacity:0.7;">Saya</span>
        </div>
        <div style="font-size:2.2rem;font-weight:800;letter-spacing:-0.04em;line-height:1;color:{{ $c['text'] }};">{{ $c['val'] }}</div>
        <div style="font-size:0.65rem;font-weight:700;text-transform:uppercase;letter-spacing:0.08em;color:{{ $c['text'] }};opacity:0.6;margin-top:0.3rem;">{{ $c['label'] }}</div>
    </div>
    @endforeach
</div>

{{-- ═══════════════════════════════════════════════════════════════════ --}}
{{-- ROW 1: Status Surat + Jenis Surat Terbanyak --}}
{{-- ═══════════════════════════════════════════════════════════════════ --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;" class="animate__animated animate__fadeInUp">

    {{-- Status Surat Detail --}}
    <div style="background:var(--card,#fff);border-radius:28px;overflow:hidden;border:1px solid #eef2f6;box-shadow:0 4px 16px rgba(0,0,0,0.04);">
        <div style="padding:1.1rem 1.5rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:0.75rem;">
            <div style="width:36px;height:36px;border-radius:12px;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fa-regular fa-file-lines" style="color:#10b981;"></i>
            </div>
            <div style="flex:1;">
                <div style="font-size:0.9rem;font-weight:700;color:#0f172a;">Status Pengajuan Surat</div>
                <div style="font-size:0.65rem;color:#64748b;">{{ $suratTotal }} total pengajuan kamu</div>
            </div>
            <a href="{{ route('masyarakat.surat.index') }}" style="font-size:0.7rem;font-weight:600;color:#10b981;text-decoration:none;">Kelola →</a>
        </div>
        @foreach([
            ['label'=>'Menunggu Diproses','count'=>$suratMenunggu,'color'=>'#f59e0b','bg'=>'rgba(245,158,11,0.1)'],
            ['label'=>'Sedang Diproses','count'=>$suratDiproses,'color'=>'#3b82f6','bg'=>'rgba(59,130,246,0.1)'],
            ['label'=>'Selesai','count'=>$suratSelesai,'color'=>'#10b981','bg'=>'rgba(16,185,129,0.1)'],
            ['label'=>'Ditolak','count'=>$suratDitolak,'color'=>'#ef4444','bg'=>'rgba(239,68,68,0.1)'],
        ] as $r)
        @php $pct = $suratTotal > 0 ? round($r['count']/$suratTotal*100) : 0; @endphp
        <div style="padding:1rem 1.5rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:1rem;">
            <div style="width:36px;height:36px;border-radius:12px;background:{{ $r['bg'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span style="font-size:1rem;font-weight:800;color:{{ $r['color'] }};">{{ $r['count'] }}</span>
            </div>
            <div style="flex:1;">
                <div style="display:flex;justify-content:space-between;margin-bottom:0.3rem;">
                    <span style="font-size:0.78rem;font-weight:600;color:#0f172a;">{{ $r['label'] }}</span>
                    <span style="font-size:0.65rem;color:#64748b;">{{ $pct }}%</span>
                </div>
                <div style="height:5px;background:#f1f5f9;border-radius:4px;overflow:hidden;">
                    <div style="height:100%;width:{{ $pct }}%;background:{{ $r['color'] }};border-radius:4px;transition:width 0.8s ease;"></div>
                </div>
            </div>
        </div>
        @endforeach
        <div style="padding:1rem 1.5rem;background:#f8fafc;display:flex;gap:0.75rem;">
            <a href="{{ route('masyarakat.surat.create') }}" style="flex:1;display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.7rem;background:linear-gradient(135deg,#10b981,#059669);color:white;border-radius:14px;font-size:0.75rem;font-weight:700;text-decoration:none;transition:all 0.3s;">
                <i class="fa-solid fa-plus" style="font-size:0.7rem;"></i> Ajukan Baru
            </a>
            <a href="{{ route('masyarakat.surat.index') }}" style="flex:1;display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.7rem;background:white;border:1px solid #eef2f6;color:#64748b;border-radius:14px;font-size:0.75rem;font-weight:600;text-decoration:none;transition:all 0.3s;">
                <i class="fa-solid fa-list" style="font-size:0.7rem;"></i> Lihat Semua
            </a>
        </div>
    </div>

    {{-- Aspirasi Status Detail --}}
    <div style="background:var(--card,#fff);border-radius:28px;overflow:hidden;border:1px solid #eef2f6;box-shadow:0 4px 16px rgba(0,0,0,0.04);">
        <div style="padding:1.1rem 1.5rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:0.75rem;">
            <div style="width:36px;height:36px;border-radius:12px;background:rgba(139,92,246,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-comment-dots" style="color:#8b5cf6;"></i>
            </div>
            <div style="flex:1;">
                <div style="font-size:0.9rem;font-weight:700;color:#0f172a;">Status Aspirasi</div>
                <div style="font-size:0.65rem;color:#64748b;">{{ $aspTotal }} total aspirasi kamu</div>
            </div>
            <a href="{{ route('masyarakat.aspirasi.index') }}" style="font-size:0.7rem;font-weight:600;color:#8b5cf6;text-decoration:none;">Kelola →</a>
        </div>
        @foreach([
            ['label'=>'Baru / Menunggu','count'=>$aspBaru,'color'=>'#8b5cf6','bg'=>'rgba(139,92,246,0.1)'],
            ['label'=>'Sedang Diproses','count'=>$aspDiproses,'color'=>'#3b82f6','bg'=>'rgba(59,130,246,0.1)'],
            ['label'=>'Selesai Ditanggapi','count'=>$aspSelesai,'color'=>'#10b981','bg'=>'rgba(16,185,129,0.1)'],
        ] as $r)
        @php $pct = $aspTotal > 0 ? round($r['count']/$aspTotal*100) : 0; @endphp
        <div style="padding:1rem 1.5rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:1rem;">
            <div style="width:36px;height:36px;border-radius:12px;background:{{ $r['bg'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span style="font-size:1rem;font-weight:800;color:{{ $r['color'] }};">{{ $r['count'] }}</span>
            </div>
            <div style="flex:1;">
                <div style="display:flex;justify-content:space-between;margin-bottom:0.3rem;">
                    <span style="font-size:0.78rem;font-weight:600;color:#0f172a;">{{ $r['label'] }}</span>
                    <span style="font-size:0.65rem;color:#64748b;">{{ $pct }}%</span>
                </div>
                <div style="height:5px;background:#f1f5f9;border-radius:4px;overflow:hidden;">
                    <div style="height:100%;width:{{ $pct }}%;background:{{ $r['color'] }};border-radius:4px;transition:width 0.8s ease;"></div>
                </div>
            </div>
        </div>
        @endforeach
        <div style="padding:1rem 1.5rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:1rem;background:#faf5ff;">
            <i class="fa-solid fa-circle-info" style="color:#8b5cf6;flex-shrink:0;"></i>
            <p style="font-size:0.72rem;color:#6d28d9;line-height:1.5;margin:0;">Aspirasi yang sudah ditanggapi admin akan berstatus "Selesai". Kamu bisa lihat balasannya di detail aspirasi.</p>
        </div>
        <div style="padding:1rem 1.5rem;background:#f8fafc;display:flex;gap:0.75rem;">
            <a href="{{ route('masyarakat.aspirasi.create') }}" style="flex:1;display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.7rem;background:linear-gradient(135deg,#8b5cf6,#7c3aed);color:white;border-radius:14px;font-size:0.75rem;font-weight:700;text-decoration:none;">
                <i class="fa-solid fa-plus" style="font-size:0.7rem;"></i> Kirim Baru
            </a>
            <a href="{{ route('masyarakat.aspirasi.index') }}" style="flex:1;display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.7rem;background:white;border:1px solid #eef2f6;color:#64748b;border-radius:14px;font-size:0.75rem;font-weight:600;text-decoration:none;">
                <i class="fa-solid fa-list" style="font-size:0.7rem;"></i> Lihat Semua
            </a>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════ --}}
{{-- ROW 2: Surat Terbaru + Aspirasi Terbaru --}}
{{-- ═══════════════════════════════════════════════════════════════════ --}}
<div style="display:grid;grid-template-columns:1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;" class="animate__animated animate__fadeInUp">

    {{-- Surat Terbaru --}}
    <div style="background:#fff;border-radius:28px;overflow:hidden;border:1px solid #eef2f6;box-shadow:0 4px 16px rgba(0,0,0,0.04);">
        <div style="padding:1.1rem 1.5rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:0.75rem;">
            <div style="width:36px;height:36px;border-radius:12px;background:rgba(16,185,129,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-clock-rotate-left" style="color:#10b981;font-size:0.85rem;"></i>
            </div>
            <div style="flex:1;">
                <div style="font-size:0.9rem;font-weight:700;color:#0f172a;">Surat Terbaru</div>
                <div style="font-size:0.65rem;color:#64748b;">6 pengajuan terakhir</div>
            </div>
            <a href="{{ route('masyarakat.surat.index') }}" style="font-size:0.7rem;font-weight:600;color:#10b981;text-decoration:none;">Semua →</a>
        </div>
        @forelse($suratTerbaru as $i => $s)
        @php
            $badgeMap = ['menunggu'=>['bg'=>'#fed7aa','color'=>'#c2410c'],'diproses'=>['bg'=>'#dbeafe','color'=>'#1d4ed8'],'disetujui'=>['bg'=>'#dbeafe','color'=>'#1d4ed8'],'selesai'=>['bg'=>'#d1fae5','color'=>'#065f46'],'ditolak'=>['bg'=>'#fee2e2','color'=>'#be123c']];
            $b = $badgeMap[$s->status] ?? ['bg'=>'#f1f5f9','color'=>'#64748b'];
        @endphp
        <div style="display:flex;align-items:flex-start;gap:0.75rem;padding:0.85rem 1.5rem;border-bottom:1px solid #eef2f6;transition:background 0.2s;"
             onmouseover="this.style.background='#f8fffe'" onmouseout="this.style.background='transparent'">
            <div style="width:30px;height:30px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span style="font-size:0.65rem;font-weight:800;color:#64748b;">{{ $i+1 }}</span>
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:0.8rem;font-weight:600;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $s->jenis_surat }}</div>
                <div style="font-size:0.62rem;color:#94a3b8;margin-top:0.1rem;">{{ $s->created_at->format('d M Y') }} · {{ $s->created_at->diffForHumans() }}</div>
            </div>
            <span style="font-size:0.58rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:20px;background:{{ $b['bg'] }};color:{{ $b['color'] }};text-transform:uppercase;flex-shrink:0;">{{ $s->status }}</span>
        </div>
        @empty
        <div style="padding:2.5rem;text-align:center;">
            <i class="fa-regular fa-file-lines" style="font-size:2.5rem;color:#cbd5e1;display:block;margin-bottom:0.75rem;"></i>
            <p style="font-size:0.8rem;color:#94a3b8;">Belum ada pengajuan surat</p>
            <a href="{{ route('masyarakat.surat.create') }}" style="display:inline-block;margin-top:0.75rem;padding:0.5rem 1.2rem;background:#10b981;color:white;border-radius:20px;font-size:0.72rem;font-weight:700;text-decoration:none;">+ Ajukan Sekarang</a>
        </div>
        @endforelse
    </div>

    {{-- Aspirasi Terbaru --}}
    <div style="background:#fff;border-radius:28px;overflow:hidden;border:1px solid #eef2f6;box-shadow:0 4px 16px rgba(0,0,0,0.04);">
        <div style="padding:1.1rem 1.5rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:0.75rem;">
            <div style="width:36px;height:36px;border-radius:12px;background:rgba(139,92,246,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-clock-rotate-left" style="color:#8b5cf6;font-size:0.85rem;"></i>
            </div>
            <div style="flex:1;">
                <div style="font-size:0.9rem;font-weight:700;color:#0f172a;">Aspirasi Terbaru</div>
                <div style="font-size:0.65rem;color:#64748b;">6 aspirasi terakhir</div>
            </div>
            <a href="{{ route('masyarakat.aspirasi.index') }}" style="font-size:0.7rem;font-weight:600;color:#8b5cf6;text-decoration:none;">Semua →</a>
        </div>
        @forelse($aspTerbaru as $i => $a)
        @php $b = ['baru'=>['bg'=>'#ede9fe','color'=>'#5b21b6'],'diproses'=>['bg'=>'#dbeafe','color'=>'#1d4ed8'],'selesai'=>['bg'=>'#d1fae5','color'=>'#065f46']][$a->status] ?? ['bg'=>'#f1f5f9','color'=>'#64748b']; @endphp
        <div style="display:flex;align-items:flex-start;gap:0.75rem;padding:0.85rem 1.5rem;border-bottom:1px solid #eef2f6;transition:background 0.2s;"
             onmouseover="this.style.background='#faf5ff'" onmouseout="this.style.background='transparent'">
            <div style="width:30px;height:30px;border-radius:10px;background:#f5f3ff;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <span style="font-size:0.65rem;font-weight:800;color:#8b5cf6;">{{ $i+1 }}</span>
            </div>
            <div style="flex:1;min-width:0;">
                <div style="font-size:0.8rem;font-weight:600;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ \Illuminate\Support\Str::limit($a->judul,45) }}</div>
                <div style="font-size:0.62rem;color:#94a3b8;margin-top:0.1rem;">{{ $a->created_at->format('d M Y') }}@if($a->kategori) · {{ $a->kategori }}@endif</div>
            </div>
            <span style="font-size:0.58rem;font-weight:700;padding:0.2rem 0.6rem;border-radius:20px;background:{{ $b['bg'] }};color:{{ $b['color'] }};text-transform:uppercase;flex-shrink:0;">{{ $a->status }}</span>
        </div>
        @empty
        <div style="padding:2.5rem;text-align:center;">
            <i class="fa-regular fa-comment-dots" style="font-size:2.5rem;color:#cbd5e1;display:block;margin-bottom:0.75rem;"></i>
            <p style="font-size:0.8rem;color:#94a3b8;">Belum ada aspirasi yang dikirim</p>
            <a href="{{ route('masyarakat.aspirasi.create') }}" style="display:inline-block;margin-top:0.75rem;padding:0.5rem 1.2rem;background:#8b5cf6;color:white;border-radius:20px;font-size:0.72rem;font-weight:700;text-decoration:none;">+ Kirim Sekarang</a>
        </div>
        @endforelse
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════ --}}
{{-- ROW 3: Jenis Surat Terbanyak + Kategori Aspirasi + Info Akun --}}
{{-- ═══════════════════════════════════════════════════════════════════ --}}
<div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:1.5rem;margin-bottom:1.5rem;" class="animate__animated animate__fadeInUp">

    {{-- Jenis Surat Terbanyak --}}
    <div style="background:#fff;border-radius:28px;overflow:hidden;border:1px solid #eef2f6;box-shadow:0 4px 16px rgba(0,0,0,0.04);">
        <div style="padding:1.1rem 1.4rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:0.6rem;">
            <div style="width:34px;height:34px;border-radius:11px;background:rgba(20,184,166,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-chart-bar" style="color:#0d9488;font-size:0.8rem;"></i>
            </div>
            <div>
                <div style="font-size:0.82rem;font-weight:700;color:#0f172a;">Jenis Surat</div>
                <div style="font-size:0.6rem;color:#64748b;">Yang paling sering diajukan</div>
            </div>
        </div>
        @if($jenisSurat->count() > 0)
            @php $maxJ = $jenisSurat->max(); @endphp
            @foreach($jenisSurat as $jenis => $jumlah)
            <div style="padding:0.85rem 1.4rem;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.25rem;">
                    <span style="font-size:0.72rem;font-weight:600;color:#0f172a;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:70%;">{{ $jenis }}</span>
                    <span style="font-size:0.72rem;font-weight:800;color:#0d9488;">{{ $jumlah }}x</span>
                </div>
                <div style="height:4px;background:#f1f5f9;border-radius:4px;overflow:hidden;">
                    <div style="height:100%;width:{{ $maxJ > 0 ? round($jumlah/$maxJ*100) : 0 }}%;background:linear-gradient(90deg,#14b8a6,#10b981);border-radius:4px;"></div>
                </div>
            </div>
            @endforeach
        @else
        <div style="padding:2rem;text-align:center;color:#94a3b8;font-size:0.78rem;">Belum ada data</div>
        @endif
    </div>

    {{-- Kategori Aspirasi --}}
    <div style="background:#fff;border-radius:28px;overflow:hidden;border:1px solid #eef2f6;box-shadow:0 4px 16px rgba(0,0,0,0.04);">
        <div style="padding:1.1rem 1.4rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:0.6rem;">
            <div style="width:34px;height:34px;border-radius:11px;background:rgba(139,92,246,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-tags" style="color:#8b5cf6;font-size:0.8rem;"></i>
            </div>
            <div>
                <div style="font-size:0.82rem;font-weight:700;color:#0f172a;">Kategori Aspirasi</div>
                <div style="font-size:0.6rem;color:#64748b;">Distribusi topik aspirasimu</div>
            </div>
        </div>
        @if($aspKategori->count() > 0)
            @php $maxA = $aspKategori->max(); @endphp
            @foreach($aspKategori as $kat => $jml)
            <div style="padding:0.85rem 1.4rem;border-bottom:1px solid #f1f5f9;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:0.25rem;">
                    <span style="font-size:0.72rem;font-weight:600;color:#0f172a;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;max-width:70%;">{{ $kat ?: 'Umum' }}</span>
                    <span style="font-size:0.72rem;font-weight:800;color:#8b5cf6;">{{ $jml }}x</span>
                </div>
                <div style="height:4px;background:#f1f5f9;border-radius:4px;overflow:hidden;">
                    <div style="height:100%;width:{{ $maxA > 0 ? round($jml/$maxA*100) : 0 }}%;background:linear-gradient(90deg,#8b5cf6,#a855f7);border-radius:4px;"></div>
                </div>
            </div>
            @endforeach
        @else
        <div style="padding:2rem;text-align:center;color:#94a3b8;font-size:0.78rem;">Belum ada data</div>
        @endif
    </div>

    {{-- Info Akun --}}
    <div style="background:#fff;border-radius:28px;overflow:hidden;border:1px solid #eef2f6;box-shadow:0 4px 16px rgba(0,0,0,0.04);">
        <div style="padding:1.1rem 1.4rem;border-bottom:1px solid #eef2f6;display:flex;align-items:center;gap:0.6rem;">
            <div style="width:34px;height:34px;border-radius:11px;background:rgba(59,130,246,0.1);display:flex;align-items:center;justify-content:center;">
                <i class="fa-solid fa-user-circle" style="color:#3b82f6;font-size:0.8rem;"></i>
            </div>
            <div>
                <div style="font-size:0.82rem;font-weight:700;color:#0f172a;">Info Akun</div>
                <div style="font-size:0.6rem;color:#64748b;">Detail profil kamu</div>
            </div>
        </div>
        <div style="padding:1rem 1.4rem;">
            @foreach([
                ['icon'=>'fa-user','label'=>'Nama','val'=>$user->name,'color'=>'#3b82f6'],
                ['icon'=>'fa-envelope','label'=>'Email','val'=>$user->email,'color'=>'#8b5cf6'],
                ['icon'=>'fa-calendar-plus','label'=>'Bergabung','val'=>$user->created_at->format('d M Y'),'color'=>'#10b981'],
                ['icon'=>'fa-clock','label'=>'Sejak','val'=>$akunDibuat,'color'=>'#f59e0b'],
                ['icon'=>'fa-file-signature','label'=>'Total Surat','val'=>$suratTotal.' pengajuan','color'=>'#14b8a6'],
                ['icon'=>'fa-comment-dots','label'=>'Total Aspirasi','val'=>$aspTotal.' kiriman','color'=>'#8b5cf6'],
            ] as $info)
            <div style="display:flex;align-items:center;gap:0.7rem;padding:0.5rem 0;border-bottom:1px solid #f1f5f9;">
                <div style="width:28px;height:28px;border-radius:9px;background:rgba({{ $info['color'] === '#3b82f6' ? '59,130,246' : ($info['color'] === '#8b5cf6' ? '139,92,246' : ($info['color'] === '#10b981' ? '16,185,129' : ($info['color'] === '#f59e0b' ? '245,158,11' : '20,184,166'))) }},0.1);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <i class="fa-solid {{ $info['icon'] }}" style="color:{{ $info['color'] }};font-size:0.7rem;"></i>
                </div>
                <div style="flex:1;min-width:0;">
                    <div style="font-size:0.6rem;color:#94a3b8;text-transform:uppercase;letter-spacing:0.05em;">{{ $info['label'] }}</div>
                    <div style="font-size:0.75rem;font-weight:600;color:#0f172a;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;">{{ $info['val'] }}</div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="padding:1rem 1.4rem;border-top:1px solid #eef2f6;">
            <a href="{{ route('masyarakat.profil') }}" style="display:flex;align-items:center;justify-content:center;gap:0.5rem;padding:0.7rem;background:linear-gradient(135deg,#3b82f6,#2563eb);color:white;border-radius:14px;font-size:0.75rem;font-weight:700;text-decoration:none;">
                <i class="fa-solid fa-pen" style="font-size:0.7rem;"></i> Edit Profil
            </a>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════ --}}
{{-- ROW 4: AKSI CEPAT + LINK KE STATISTIK DESA --}}
{{-- ═══════════════════════════════════════════════════════════════════ --}}
<div style="display:grid;grid-template-columns:2fr 1fr;gap:1.5rem;margin-bottom:1.5rem;" class="animate__animated animate__fadeInUp">

    {{-- Quick Actions --}}
    <div style="background:linear-gradient(135deg,#064e3b,#065f46);border-radius:28px;padding:2rem;position:relative;overflow:hidden;">
        <div style="position:absolute;top:-40px;right:-40px;width:150px;height:150px;background:rgba(255,255,255,0.04);border-radius:50%;"></div>
        <div style="position:absolute;bottom:-30px;left:20%;width:100px;height:100px;background:rgba(255,255,255,0.03);border-radius:50%;"></div>
        <div style="position:relative;z-index:1;">
            <h3 style="font-size:1rem;font-weight:700;color:white;margin-bottom:0.3rem;">Aksi Cepat</h3>
            <p style="font-size:0.72rem;color:rgba(255,255,255,0.6);margin-bottom:1.5rem;">Akses layanan tanpa perlu kembali ke dashboard</p>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:0.75rem;">
                @foreach([
                    ['href'=>route('masyarakat.surat.create'),'icon'=>'fa-file-signature','label'=>'Ajukan Surat','sub'=>'Buat pengajuan baru','bg'=>'rgba(255,255,255,0.1)'],
                    ['href'=>route('masyarakat.aspirasi.create'),'icon'=>'fa-comment-dots','label'=>'Kirim Aspirasi','sub'=>'Sampaikan suaramu','bg'=>'rgba(255,255,255,0.1)'],
                    ['href'=>route('masyarakat.surat.index'),'icon'=>'fa-list-check','label'=>'Riwayat Surat','sub'=>'Semua pengajuanmu','bg'=>'rgba(255,255,255,0.08)'],
                    ['href'=>route('masyarakat.aspirasi.index'),'icon'=>'fa-comments','label'=>'Riwayat Aspirasi','sub'=>'Semua aspirasimu','bg'=>'rgba(255,255,255,0.08)'],
                ] as $act)
                <a href="{{ $act['href'] }}" style="display:flex;align-items:center;gap:0.75rem;padding:0.9rem 1rem;background:{{ $act['bg'] }};border-radius:16px;border:1px solid rgba(255,255,255,0.1);text-decoration:none;transition:all 0.3s;"
                   onmouseover="this.style.background='rgba(255,255,255,0.18)';this.style.transform='translateY(-2px)'"
                   onmouseout="this.style.background='{{ $act['bg'] }}';this.style.transform='translateY(0)'">
                    <div style="width:34px;height:34px;border-radius:12px;background:rgba(255,255,255,0.15);display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fa-solid {{ $act['icon'] }}" style="color:white;font-size:0.85rem;"></i>
                    </div>
                    <div>
                        <div style="font-size:0.75rem;font-weight:700;color:white;">{{ $act['label'] }}</div>
                        <div style="font-size:0.6rem;color:rgba(255,255,255,0.55);">{{ $act['sub'] }}</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Link ke Statistik Desa --}}
    <div style="display:flex;flex-direction:column;gap:0.75rem;">
        <a href="{{ route('statistik.publik') }}" style="background:linear-gradient(135deg,#eff6ff,#dbeafe);border-radius:24px;padding:1.4rem;text-decoration:none;border:1px solid #bfdbfe;transition:all 0.35s;"
           onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(59,130,246,0.15)'"
           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
            <div style="width:40px;height:40px;border-radius:14px;background:linear-gradient(135deg,#3b82f6,#2563eb);display:flex;align-items:center;justify-content:center;margin-bottom:0.75rem;box-shadow:0 4px 12px rgba(59,130,246,0.25);">
                <i class="fa-solid fa-chart-simple" style="color:white;font-size:0.9rem;"></i>
            </div>
            <div style="font-size:0.85rem;font-weight:700;color:#1d4ed8;margin-bottom:0.25rem;">Statistik Desa</div>
            <div style="font-size:0.7rem;color:#3b82f6;line-height:1.4;">Data kependudukan dan umum desa Lumban Silintong</div>
        </a>
        <a href="{{ route('masyarakat.keuangan.index') }}" style="background:linear-gradient(135deg,#fefce8,#fef9c3);border-radius:24px;padding:1.4rem;text-decoration:none;border:1px solid #fde68a;transition:all 0.35s;"
           onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(245,158,11,0.15)'"
           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
            <div style="width:40px;height:40px;border-radius:14px;background:linear-gradient(135deg,#f59e0b,#d97706);display:flex;align-items:center;justify-content:center;margin-bottom:0.75rem;box-shadow:0 4px 12px rgba(245,158,11,0.25);">
                <i class="fa-solid fa-coins" style="color:white;font-size:0.9rem;"></i>
            </div>
            <div style="font-size:0.85rem;font-weight:700;color:#b45309;margin-bottom:0.25rem;">Keuangan Desa</div>
            <div style="font-size:0.7rem;color:#d97706;line-height:1.4;">Lihat transparansi keuangan desa secara publik</div>
        </a>
        <a href="{{ route('masyarakat.profil') }}" style="background:linear-gradient(135deg,#fdf4ff,#fae8ff);border-radius:24px;padding:1.4rem;text-decoration:none;border:1px solid #e9d5ff;transition:all 0.35s;"
           onmouseover="this.style.transform='translateY(-4px)';this.style.boxShadow='0 12px 32px rgba(139,92,246,0.15)'"
           onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='none'">
            <div style="width:40px;height:40px;border-radius:14px;background:linear-gradient(135deg,#8b5cf6,#7c3aed);display:flex;align-items:center;justify-content:center;margin-bottom:0.75rem;box-shadow:0 4px 12px rgba(139,92,246,0.25);">
                <i class="fa-solid fa-user-cog" style="color:white;font-size:0.9rem;"></i>
            </div>
            <div style="font-size:0.85rem;font-weight:700;color:#6d28d9;margin-bottom:0.25rem;">Kelola Profil</div>
            <div style="font-size:0.7rem;color:#8b5cf6;line-height:1.4;">Ubah foto, nama, dan password akunmu</div>
        </a>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════ --}}
{{-- FOOTER INFO --}}
{{-- ═══════════════════════════════════════════════════════════════════ --}}
<div style="background:linear-gradient(135deg,#ecfdf5,#d1fae5);border-radius:20px;padding:1rem 1.5rem;display:flex;align-items:center;gap:1rem;margin-bottom:2rem;" class="animate__animated animate__fadeInUp">
    <i class="fa-solid fa-circle-info" style="color:#10b981;font-size:1rem;flex-shrink:0;"></i>
    <p style="font-size:0.78rem;color:#065f46;line-height:1.5;margin:0;">
        Halaman ini hanya menampilkan aktivitas milik akunmu sendiri.
        Data diperbarui secara realtime dari database.
        Terakhir dilihat: <strong>{{ now()->format('d M Y, H:i') }} WIB</strong>
    </p>
</div>

</div>{{-- end page-wrap --}}
</div>{{-- end min-h-screen --}}

@endsection
