{{-- resources/views/masyarakat/keuangan/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Transparansi Keuangan Desa')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

<style>
    /* ============================================
       DESIGN SYSTEM PREMIUM
    ============================================ */
    :root {
        --primary: #10b981;
        --primary-dark: #059669;
        --primary-light: #34d399;
        --primary-soft: rgba(16, 185, 129, 0.08);
        --dark: #0f172a;
        --gray: #64748b;
        --gray-light: #94a3b8;
        --gray-soft: #f1f5f9;
        --bg: #fafbfc;
        --card: #ffffff;
        --border: #eef2f6;
        --shadow-sm: 0 2px 8px rgba(0,0,0,0.03);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.05);
        --shadow-lg: 0 12px 32px rgba(0,0,0,0.08);
        --shadow-xl: 0 24px 48px rgba(0,0,0,0.1);
        --transition: all 0.3s cubic-bezier(0.2, 0, 0, 1);
        --transition-bounce: all 0.4s cubic-bezier(0.34, 1.2, 0.64, 1);
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--dark);
        -webkit-font-smoothing: antialiased;
    }

    /* Custom Scrollbar */
    ::-webkit-scrollbar { width: 5px; height: 5px; }
    ::-webkit-scrollbar-track { background: #e2e8f0; border-radius: 10px; }
    ::-webkit-scrollbar-thumb { background: var(--gray-light); border-radius: 10px; }
    ::-webkit-scrollbar-thumb:hover { background: var(--primary); }

    /* Background Pattern */
    .bg-pattern {
        position: fixed;
        inset: 0;
        z-index: -1;
        background-image: radial-gradient(#cbd5e1 0.5px, transparent 0.5px);
        background-size: 24px 24px;
        opacity: 0.3;
    }

    /* Container Premium */
    .container-premium {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem 1.5rem;
    }

    /* Header Section */
    .header-section {
        text-align: center;
        margin-bottom: 2.5rem;
    }

    .header-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: var(--primary-soft);
        padding: 0.3rem 1rem;
        border-radius: 100px;
        margin-bottom: 0.75rem;
    }

    .header-badge i { font-size: 0.65rem; color: var(--primary); }
    .header-badge span { font-size: 0.65rem; font-weight: 700; letter-spacing: 0.08em; color: var(--primary-dark); text-transform: uppercase; }

    .header-title {
        font-size: clamp(1.8rem, 5vw, 2.8rem);
        font-weight: 800;
        line-height: 1.2;
        letter-spacing: -0.03em;
    }

    .header-title span {
        color: var(--primary);
        font-family: 'Instrument Serif', serif;
        font-style: italic;
    }

    .header-subtitle {
        font-size: 0.85rem;
        color: var(--gray);
        margin-top: 0.5rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: 28px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .filter-card:hover {
        box-shadow: var(--shadow-lg);
    }

    /* Stat Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: white;
        border-radius: 28px;
        padding: 1.5rem;
        text-align: center;
        border: 1px solid var(--border);
        transition: var(--transition-bounce);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.6s ease;
        pointer-events: none;
    }

    .stat-card:hover::before {
        left: 100%;
    }

    .stat-card:hover {
        transform: translateY(-6px);
        border-color: var(--primary);
        box-shadow: var(--shadow-xl);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        transition: var(--transition-bounce);
    }

    .stat-card:hover .stat-icon {
        transform: scale(1.05);
    }

    .stat-value {
        font-size: 1.8rem;
        font-weight: 800;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
    }

    /* Chart Card */
    .chart-card {
        background: white;
        border-radius: 28px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }

    .chart-card:hover {
        box-shadow: var(--shadow-xl);
    }

    /* Table Card */
    .table-card {
        background: white;
        border-radius: 28px;
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--shadow-md);
    }

    .table-header {
        background: linear-gradient(135deg, rgba(16,185,129,0.05), transparent);
        padding: 1.2rem 1.5rem;
        border-bottom: 1px solid var(--border);
    }

    /* Tutorial Section */
    .tutorial-section {
        margin-top: 2.5rem;
        background: linear-gradient(135deg, var(--card), #ffffff);
        border-radius: 28px;
        padding: 1.8rem;
        border: 1px solid var(--border);
        transition: var(--transition);
    }

    .tutorial-section:hover {
        border-color: var(--primary);
        box-shadow: var(--shadow-md);
    }

    .tutorial-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1.2rem;
        border-bottom: 1px solid var(--border);
        padding-bottom: 0.8rem;
    }

    .tutorial-header i {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .tutorial-header h3 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0;
        color: var(--dark);
    }

    .tutorial-intro {
        font-size: 0.85rem;
        color: var(--gray);
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .tutorial-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.2rem;
    }

    .tutorial-item {
        display: flex;
        gap: 0.8rem;
        padding: 0.8rem;
        border-radius: 16px;
        transition: var(--transition);
        cursor: pointer;
        background: var(--gray-soft);
    }

    .tutorial-item:hover {
        background: var(--primary-soft);
        transform: translateX(5px);
    }

    .tutorial-num {
        width: 32px;
        height: 32px;
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 0.85rem;
        flex-shrink: 0;
        transition: transform 0.3s ease;
    }

    .tutorial-item:hover .tutorial-num {
        transform: scale(1.1);
    }

    .tutorial-text h4 {
        font-size: 0.85rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
        color: var(--dark);
    }

    .tutorial-text p {
        font-size: 0.7rem;
        color: var(--gray);
        line-height: 1.4;
    }

    .tutorial-footer {
        margin-top: 1rem;
        padding: 0.8rem 1rem;
        background: linear-gradient(135deg, #ecfdf5, #d1fae5);
        border-radius: 16px;
        display: flex;
        align-items: center;
        gap: 0.6rem;
        flex-wrap: wrap;
        transition: var(--transition);
    }

    .tutorial-footer:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.15);
    }

    .tutorial-footer i {
        color: var(--primary);
        font-size: 1rem;
    }

    .tutorial-footer span {
        font-size: 0.75rem;
        color: #059669;
        line-height: 1.4;
    }

    /* Table Styles */
    .data-table {
        width: 100%;
    }

    .data-table th {
        padding: 1rem 1rem;
        text-align: left;
        font-size: 0.7rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        color: var(--gray);
        border-bottom: 1px solid var(--border);
    }

    .data-table td {
        padding: 1rem 1rem;
        font-size: 0.8rem;
        border-bottom: 1px solid var(--border);
        transition: var(--transition);
    }

    .data-table tr {
        transition: var(--transition);
        cursor: pointer;
    }

    .data-table tr:hover {
        background: var(--primary-soft);
        transform: scale(1.01);
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .tutorial-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 768px) {
        .container-premium { padding: 1rem; }
        .stats-grid { grid-template-columns: 1fr; }
        .tutorial-grid { grid-template-columns: 1fr; }
        .tutorial-section { padding: 1rem; }
    }
</style>

<div class="bg-pattern"></div>

<div class="container-premium">
    
    {{-- ============================================ --}}
    {{-- HEADER SECTION --}}
    {{-- ============================================ --}}
    <div class="header-section animate__animated animate__fadeInUp">
        <div class="header-badge">
            <i class="fa-regular fa-building"></i>
            <span>Transparansi Publik</span>
        </div>
        <h1 class="header-title">
            Keuangan <span>Desa</span>
        </h1>
        <p class="header-subtitle">
            Informasi pemasukan dan pengeluaran desa secara transparan dan akuntabel
        </p>
        <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto mt-4 rounded-full"></div>
    </div>

    {{-- ============================================ --}}
    {{-- FILTER CARD PREMIUM --}}
    {{-- ============================================ --}}
    <div class="filter-card animate__animated animate__fadeInUp" style="animation-delay: 0.05s">
        <form method="GET" class="flex flex-wrap gap-4 items-end justify-center">
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">
                    <i class="fa-solid fa-calendar mr-1"></i> Tahun
                </label>
                <select name="tahun" class="px-5 py-3 rounded-xl border border-gray-200 bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition outline-none">
                    @for($i = date('Y'); $i >= date('Y')-5; $i--)
                        <option value="{{ $i }}" {{ $tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">
                    <i class="fa-solid fa-moon mr-1"></i> Bulan
                </label>
                <select name="bulan" class="px-5 py-3 rounded-xl border border-gray-200 bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition outline-none">
                    <option value="semua" {{ $bulan == 'semua' ? 'selected' : '' }}>Semua Bulan</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>{{ date('F', mktime(0, 0, 0, $i, 1)) }}</option>
                    @endfor
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-gray-400 uppercase tracking-wider mb-1">
                    <i class="fa-solid fa-tag mr-1"></i> Jenis
                </label>
                <select name="jenis" class="px-5 py-3 rounded-xl border border-gray-200 bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-200 transition outline-none">
                    <option value="semua" {{ $jenis == 'semua' ? 'selected' : '' }}>Semua</option>
                    <option value="pemasukan" {{ $jenis == 'pemasukan' ? 'selected' : '' }}>💰 Pemasukan</option>
                    <option value="pengeluaran" {{ $jenis == 'pengeluaran' ? 'selected' : '' }}>💸 Pengeluaran</option>
                </select>
            </div>
            <div>
                <button type="submit" class="group relative overflow-hidden px-8 py-3 bg-gradient-to-r from-emerald-500 to-teal-500 text-white rounded-xl font-bold shadow-lg shadow-emerald-200 hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                    <span class="relative z-10 flex items-center gap-2">
                        <i class="fa-solid fa-filter"></i> Filter
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-teal-600 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                </button>
            </div>
        </form>
    </div>

    {{-- ============================================ --}}
    {{-- STATISTICS CARDS PREMIUM --}}
    {{-- ============================================ --}}
    <div class="stats-grid animate__animated animate__fadeInUp" style="animation-delay: 0.1s">
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(16,185,129,0.1);">
                <i class="fa-solid fa-money-bill-trend-up text-emerald-600 text-2xl"></i>
            </div>
            <div class="stat-value text-emerald-600">Rp {{ number_format($totalPemasukan, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pemasukan</div>
            <div class="mt-3 h-1 w-full bg-emerald-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full" style="width: 100%"></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(239,68,68,0.1);">
                <i class="fa-solid fa-money-bill-trend-down text-red-500 text-2xl"></i>
            </div>
            <div class="stat-value text-red-500">Rp {{ number_format($totalPengeluaran, 0, ',', '.') }}</div>
            <div class="stat-label">Total Pengeluaran</div>
            <div class="mt-3 h-1 w-full bg-red-100 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-red-500 to-red-600 rounded-full" style="width: {{ $totalPemasukan > 0 ? ($totalPengeluaran / $totalPemasukan) * 100 : 0 }}%"></div>
            </div>
        </div>
        <div class="stat-card">
            <div class="stat-icon" style="background: rgba(59,130,246,0.1);">
                <i class="fa-solid fa-wallet text-blue-600 text-2xl"></i>
            </div>
            <div class="stat-value text-blue-600">Rp {{ number_format($saldo, 0, ',', '.') }}</div>
            <div class="stat-label">Saldo Akhir</div>
            <div class="mt-3 flex items-center justify-center gap-2 text-[10px] text-blue-500">
                <i class="fa-solid fa-chart-line"></i>
                <span>Transparansi penuh</span>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- CHART CARD PREMIUM --}}
    {{-- ============================================ --}}
    <div class="chart-card animate__animated animate__fadeInUp" style="animation-delay: 0.15s">
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-xl flex items-center justify-center shadow-md">
                <i class="fa-solid fa-chart-line text-white text-sm"></i>
            </div>
            <div>
                <h3 class="font-bold text-gray-800">Grafik Keuangan</h3>
                <p class="text-xs text-gray-400">Pemasukan vs Pengeluaran {{ $tahun }}</p>
            </div>
        </div>
        <canvas id="keuanganChart" height="100" class="w-full"></canvas>
    </div>

    {{-- ============================================ --}}
    {{-- TABLE CARD PREMIUM --}}
    {{-- ============================================ --}}
    <div class="table-card animate__animated animate__fadeInUp" style="animation-delay: 0.2s">
        <div class="table-header">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-table-list text-emerald-500"></i>
                <h3 class="font-bold text-gray-800">Daftar Transaksi</h3>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Jenis</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                        <th>Jumlah</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($transaksis as $t)
                    <tr onclick="window.location='{{ route('masyarakat.keuangan.show', $t->id_transaksi) }}'">
                        <td>{{ \Carbon\Carbon::parse($t->tanggal)->translatedFormat('d F Y') }}</td>
                        <td>
                            <span class="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-semibold {{ $t->jenis == 'pemasukan' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $t->jenis == 'pemasukan' ? '💰 Pemasukan' : '💸 Pengeluaran' }}
                            </span>
                        </td>
                        <td>{{ $t->kategori->nama_kategori }}</td>
                        <td>{{ Str::limit($t->deskripsi, 50) }}</td>
                        <td class="font-semibold {{ $t->jenis == 'pemasukan' ? 'text-green-600' : 'text-red-600' }}">
                            Rp {{ number_format($t->jumlah, 0, ',', '.') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-12 text-gray-400">
                            <i class="fa-regular fa-folder-open text-4xl mb-3 block"></i>
                            <p>Belum ada transaksi</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $transaksis->appends(request()->query())->links() }}
        </div>
    </div>

    {{-- ============================================== --}}
    {{-- TUTORIAL SECTION PREMIUM --}}
    {{-- ============================================== --}}
    <div class="tutorial-section animate__animated animate__fadeInUp" style="animation-delay: 0.25s">
        <div class="tutorial-header">
            <i class="fa-regular fa-circle-question"></i>
            <h3>📖 Tentang Halaman Keuangan Desa</h3>
        </div>
        
        <p class="tutorial-intro">
            Halaman <strong>Transparansi Keuangan</strong> menyajikan informasi lengkap tentang pemasukan 
            dan pengeluaran Desa Lumban Silintong secara terbuka dan akuntabel.
        </p>
        
        <div class="tutorial-grid">
            <div class="tutorial-item">
                <div class="tutorial-num">1</div>
                <div class="tutorial-text">
                    <h4>📊 Filter Data</h4>
                    <p>Gunakan filter tahun, bulan, dan jenis transaksi untuk menyaring data yang ditampilkan.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">2</div>
                <div class="tutorial-text">
                    <h4>💰 Kartu Statistik</h4>
                    <p>Lihat ringkasan total pemasukan, pengeluaran, dan saldo akhir dengan visual menarik.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">3</div>
                <div class="tutorial-text">
                    <h4>📈 Grafik Interaktif</h4>
                    <p>Grafik garis yang menunjukkan tren pemasukan dan pengeluaran sepanjang tahun.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">4</div>
                <div class="tutorial-text">
                    <h4>📋 Daftar Transaksi</h4>
                    <p>Tabel lengkap semua transaksi yang dapat di-klik untuk melihat detail.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">5</div>
                <div class="tutorial-text">
                    <h4>🖱️ Hover Interaktif</h4>
                    <p>Arahkan kursor ke card atau baris tabel untuk efek visual yang menarik.</p>
                </div>
            </div>
            <div class="tutorial-item">
                <div class="tutorial-num">6</div>
                <div class="tutorial-text">
                    <h4>🔄 Klik Detail</h4>
                    <p>Klik pada baris tabel untuk melihat detail lengkap transaksi.</p>
                </div>
            </div>
        </div>
        
        <div class="tutorial-footer">
            <i class="fa-regular fa-lightbulb"></i>
            <span>💡 <strong>Tips Penting:</strong> Gunakan filter untuk mempersempit data dan klik pada grafik untuk melihat detail nilai. Data keuangan diperbarui secara berkala oleh admin desa.</span>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Chart.js konfigurasi premium
    Chart.defaults.font.family = "'Plus Jakarta Sans', 'Segoe UI', system-ui, sans-serif";
    Chart.defaults.font.size = 11;
    Chart.defaults.color = '#64748b';

    const ctx = document.getElementById('keuanganChart').getContext('2d');
    const grafikData = @json($grafikData);
    
    const labels = [];
    const pemasukanData = [];
    const pengeluaranData = [];
    
    Object.values(grafikData).forEach(item => {
        labels.push(item.bulan.substring(0, 3));
        pemasukanData.push(item.pemasukan);
        pengeluaranData.push(item.pengeluaran);
    });
    
    // Gradient untuk chart
    const pemasukanGradient = ctx.createLinearGradient(0, 0, 0, 400);
    pemasukanGradient.addColorStop(0, 'rgba(16, 185, 129, 0.3)');
    pemasukanGradient.addColorStop(1, 'rgba(16, 185, 129, 0.02)');
    
    const pengeluaranGradient = ctx.createLinearGradient(0, 0, 0, 400);
    pengeluaranGradient.addColorStop(0, 'rgba(239, 68, 68, 0.3)');
    pengeluaranGradient.addColorStop(1, 'rgba(239, 68, 68, 0.02)');
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Pemasukan',
                    data: pemasukanData,
                    borderColor: '#10b981',
                    backgroundColor: pemasukanGradient,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: '#10b981',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#059669'
                },
                {
                    label: 'Pengeluaran',
                    data: pengeluaranData,
                    borderColor: '#ef4444',
                    backgroundColor: pengeluaranGradient,
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: '#ef4444',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 8,
                    pointHoverBackgroundColor: '#dc2626'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.95)',
                    titleColor: '#f1f5f9',
                    bodyColor: '#cbd5e1',
                    borderColor: '#10b981',
                    borderWidth: 1,
                    padding: 12,
                    cornerRadius: 12,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': Rp ' + context.raw.toLocaleString('id-ID');
                        }
                    }
                },
                legend: {
                    position: 'top',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: { size: 11, weight: '600' }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#e2e8f0', drawBorder: false },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        },
                        font: { size: 10 }
                    }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, weight: '600' }, color: '#334155' }
                }
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Tutorial Items Interactive
    document.querySelectorAll('.tutorial-item').forEach(item => {
        item.addEventListener('click', function() {
            this.style.transform = 'scale(0.98)';
            setTimeout(() => { this.style.transform = ''; }, 200);
            
            const title = this.querySelector('.tutorial-text h4').innerText;
            
            // Highlight related element
            if (title.includes('Filter')) {
                document.querySelector('.filter-card').scrollIntoView({ behavior: 'smooth', block: 'center' });
                document.querySelector('.filter-card').style.boxShadow = '0 0 0 3px rgba(16,185,129,0.2)';
                setTimeout(() => {
                    document.querySelector('.filter-card').style.boxShadow = '';
                }, 2000);
            } else if (title.includes('Kartu Statistik')) {
                document.querySelector('.stats-grid').scrollIntoView({ behavior: 'smooth', block: 'center' });
            } else if (title.includes('Grafik')) {
                document.querySelector('.chart-card').scrollIntoView({ behavior: 'smooth', block: 'center' });
                document.querySelector('.chart-card').style.boxShadow = '0 0 0 3px rgba(16,185,129,0.2)';
                setTimeout(() => {
                    document.querySelector('.chart-card').style.boxShadow = '';
                }, 2000);
            } else if (title.includes('Daftar Transaksi')) {
                document.querySelector('.table-card').scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        });
    });
</script>
@endsection