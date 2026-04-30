{{-- resources/views/admin/berita.blade.php --}}
@extends('layouts.admin')

@section('title', 'System Intelligence — Newsroom')

@section('content')
<!-- Core Asset Architecture -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;400;600;800&family=Instrument+Sans:ital,wght@0,400;0,700;1,600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<style>
    :root {
        --system-bg: #0a0a0a;
        --card-bg: #ffffff;
        --accent-primary: #10b981;
        --text-main: #171717;
        --text-mute: #737373;
        --border-color: #f1f1f1;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #fafafa;
        color: var(--text-main);
        letter-spacing: -0.02em;
    }

    .font-display { font-family: 'Instrument Sans', sans-serif; }

    /* Background Pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#e5e7eb 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        mask-image: radial-gradient(ellipse at center, black, transparent 80%);
    }

    /* Premium Container */
    .dashboard-wrapper {
        max-width: 1440px;
        margin: 0 auto;
        padding: 4rem 2rem;
    }

    /* Ultra-Nav */
    .editorial-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        margin-bottom: 5rem;
    }

    .brand-title {
        font-size: 5rem;
        font-weight: 800;
        line-height: 0.9;
        letter-spacing: -0.05em;
        color: var(--system-bg);
    }

    .brand-subtitle {
        font-size: 1.1rem;
        color: var(--text-mute);
        margin-top: 1.5rem;
        max-width: 450px;
        line-height: 1.6;
    }

    /* Action Button - Dark Aesthetic */
    .btn-system {
        background: var(--system-bg);
        color: white;
        padding: 1.25rem 2.5rem;
        border-radius: 100px;
        font-size: 0.75rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.2em;
        transition: all 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        display: inline-flex;
        align-items: center;
        gap: 1rem;
    }

    .btn-system:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        background: var(--accent-primary);
    }

    /* The Bento-Row Architecture */
    .news-architecture {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .news-node {
        background: var(--card-bg);
        border: 1px solid var(--border-color);
        border-radius: 32px;
        padding: 1.5rem 2rem;
        display: grid;
        grid-template-columns: 100px 2fr 1fr 1fr 120px;
        align-items: center;
        transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        cursor: pointer;
    }

    .news-node:hover {
        border-color: var(--system-bg);
        transform: scale(1.01);
        box-shadow: 0 40px 80px -20px rgba(0,0,0,0.05);
    }

    /* Media Frame */
    .node-media {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        background: #f9f9f9;
        overflow: hidden;
        border: 1px solid var(--border-color);
    }

    .node-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: grayscale(100%);
        transition: all 0.8s ease;
    }

    .news-node:hover .node-media img {
        filter: grayscale(0%);
        transform: scale(1.1);
    }

    /* Typography inside Nodes */
    .node-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--system-bg);
        padding-left: 1.5rem;
    }

    .node-meta {
        font-size: 0.75rem;
        color: var(--text-mute);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        margin-top: 0.25rem;
        padding-left: 1.5rem;
    }

    /* Classification Pills */
    .pill-category {
        font-size: 10px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.15em;
        padding: 0.6rem 1.2rem;
        border-radius: 100px;
        background: #f5f5f5;
        color: #525252;
        text-align: center;
        width: fit-content;
        margin: 0 auto;
        border: 1px solid transparent;
        transition: all 0.4s;
    }

    .news-node:hover .pill-category {
        border-color: #000;
        background: transparent;
        color: #000;
    }

    /* Status Visualizer */
    .status-engine {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        justify-content: center;
    }

    .engine-light {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        position: relative;
    }

    .light-active { background: var(--accent-primary); }
    .light-active::after {
        content: '';
        position: absolute;
        inset: -4px;
        border-radius: 50%;
        background: var(--accent-primary);
        opacity: 0.3;
        animation: pulse 2s infinite;
    }

    /* Action Deck */
    .action-deck {
        display: flex;
        justify-content: flex-end;
        gap: 0.5rem;
        opacity: 0;
        transform: translateX(20px);
        transition: all 0.5s;
    }

    .news-node:hover .action-deck {
        opacity: 1;
        transform: translateX(0);
    }

    .deck-btn {
        width: 44px;
        height: 44px;
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid var(--border-color);
        transition: all 0.3s;
        color: var(--text-mute);
    }

    .deck-btn:hover {
        background: var(--system-bg);
        color: white;
        border-color: var(--system-bg);
    }

    @keyframes pulse {
        0% { transform: scale(1); opacity: 0.5; }
        100% { transform: scale(2.5); opacity: 0; }
    }

    /* Empty State */
    .void-container {
        padding: 10rem 0;
        text-align: center;
        border: 2px dashed #e5e5e5;
        border-radius: 40px;
    }

    /* Custom Scrollbar for the Elite */
    ::-webkit-scrollbar { width: 4px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #d4d4d4; border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: #000; }

</style>

<div class="bg-pattern"></div>

<div class="dashboard-wrapper">
    
    {{-- Main Editorial Nav --}}
    <header class="editorial-header">
        <div class="animate__animated animate__fadeInLeft">
            <h1 class="brand-title font-display">Kelola<br><span class="text-white" style="-webkit-text-stroke: 1.5px #000;">Berita</span>.</h1>
            <p class="brand-subtitle">
                buat dan kelola berita di halaman ini.
            </p>
        </div>

        <div class="animate__animated animate__fadeInRight">
            <a href="{{ route('admin.berita.create') }}" class="btn-system group">
                <span>buat berita baru</span>
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="group-hover:rotate-90 transition-transform"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
            </a>
        </div>
    </header>

    {{-- System Status & Alert --}}
    @if(session('success'))
    <div class="mb-12 animate__animated animate__fadeInDown bg-emerald-950 text-emerald-400 p-6 rounded-[24px] flex items-center justify-between border border-emerald-500/20">
        <div class="flex items-center gap-4">
            <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
            <span class="text-xs font-black uppercase tracking-widest">Perubahan Berhasil: {{ session('success') }}</span>
        </div>
        <button onclick="this.parentElement.remove()" class="text-emerald-400/50 hover:text-emerald-400 transition-colors">
            <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M18 6L6 18M6 6l12 12"></path></svg>
        </button>
    </div>
    @endif

    {{-- Architecture Grid --}}
    <div class="news-architecture">
        {{-- Structural Header --}}
        <div class="hidden lg:grid grid-cols-[100px_2fr_1fr_1fr_120px] px-8 mb-4 opacity-70">
            <div class="text-[10px] font-black uppercase tracking-[0.3em]">Asset</div>
            <div class="text-[10px] font-black uppercase tracking-[0.3em] pl-6">judul</div>
            <div class="text-[10px] font-black uppercase tracking-[0.3em] text-center">Kategori</div>
            <div class="text-[10px] font-black uppercase tracking-[0.3em] text-center">Status</div>
            <div class="text-[10px] font-black uppercase tracking-[0.3em] text-right">Aksi</div>
        </div>

        @forelse($beritas as $item)
        <article class="news-node group animate__animated animate__fadeInUp" style="animation-delay: {{ $loop->index * 0.1 }}s">
            {{-- Visual Frame --}}
            <div class="node-media">
                @if($item->foto)
                    <img src="{{ asset('storage/' . $item->foto) }}" alt="Identity">
                @else
                    <div class="w-full h-full flex items-center justify-center bg-slate-50">
                        <svg width="20" height="20" class="text-slate-200" fill="currentColor" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zm-5.04-6.71l-2.75 3.54-1.96-2.36L6.5 17h11l-3.54-4.71z"/></svg>
                    </div>
                @endif
            </div>

            {{-- Identity Box --}}
            <div>
                <h3 class="node-title truncate">{{ $item->judul }}</h3>
                <p class="node-meta">Ref: 0x{{ $item->id_berita }} • Created {{ $item->created_at->translatedFormat('d M Y') }}</p>
            </div>

            {{-- Taxonomy Box --}}
            <div>
                <div class="pill-category">
                    {{ $item->kategori }}
                </div>
            </div>

            {{-- Engine Status Box --}}
            <div class="status-engine">
                @if($item->status == 'publish')
                    <div class="engine-light"></div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-emerald-600">Publish</span>
                @else
                    <div class="engine-light bg-slate-200"></div>
                    <span class="text-[10px] font-black uppercase tracking-widest text-slate-300">draft</span>
                @endif
            </div>

            {{-- Command Deck --}}
            <div class="action-deck">
                <a href="{{ route('admin.berita.edit', $item->id_berita) }}" class="deck-btn" title="Modify Node">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7M18.5 2.5a2.121 2.121 0 113 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                </a>
                
                <form action="{{ route('admin.berita.destroy', $item->id_berita) }}" method="POST" class="inline">
                    @csrf @method('DELETE')
                    <button type="submit" onclick="return confirm('Terminate this content node?')" class="deck-btn hover:!bg-red-600" title="Purge Node">
                        <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </form>
            </div>
        </article>
        @empty
        <div class="void-container animate__animated animate__fadeIn">
            <h2 class="font-display text-4xl font-bold text-slate-200 uppercase italic">Belum ada berita</h2>
            <p class="text-slate-400 mt-4 tracking-[0.2em] text-xs font-black">Menunggu berita baru...</p>
        </div>
        @endforelse
    </div>
</div>

@endsection