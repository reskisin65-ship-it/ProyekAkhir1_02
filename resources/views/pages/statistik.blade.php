{{-- resources/views/pages/statistik.blade.php --}}
@extends('layouts.app')

@section('title', 'Statistik Desa - Lumban Silintong')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-emerald-50/20 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Header Section Premium --}}
        <div class="text-center mb-16 relative">
            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                <div class="w-96 h-96 bg-emerald-400/10 rounded-full blur-3xl animate-pulse-slow"></div>
            </div>
            <div class="relative">
                <span class="inline-flex items-center gap-2 text-emerald-600 font-semibold tracking-wider uppercase text-sm mb-4 px-4 py-2 bg-emerald-50 rounded-full shadow-sm">
                    <i class="fa-solid fa-chart-line text-emerald-500"></i>
                    Informasi Publik
                </span>
                <h1 class="text-5xl md:text-6xl font-extrabold text-slate-900 mb-6 tracking-tight">
                    Statistik 
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-600">
                        Desa
                    </span>
                </h1>
                <div class="w-24 h-1 bg-gradient-to-r from-emerald-400 to-emerald-600 mx-auto rounded-full mb-6"></div>
                <p class="text-slate-500 mt-4 max-w-2xl mx-auto text-lg">
                    Visualisasi data dan informasi demografi terkini Desa Lumban Silintong
                </p>
            </div>
        </div>

        {{-- Statistik Cards Premium --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16">
            {{-- Card 1 - Total Penduduk --}}
            <div class="stat-card group relative bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-emerald-500/10 to-transparent rounded-full blur-2xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-users text-2xl"></i>
                        </div>
                        <span class="flex items-center text-emerald-600 text-xs font-semibold bg-emerald-50 px-3 py-1.5 rounded-full">
                            <i class="fa-solid fa-arrow-trend-up mr-1 text-xs"></i> Real-time
                        </span>
                    </div>
                    <h3 class="text-4xl font-bold text-slate-800 mb-1 counter">{{ number_format($statistics['total_penduduk'] ?? 0) }}</h3>
                    <p class="text-sm font-medium text-slate-500">Total Penduduk</p>
                    <div class="mt-3 flex items-center gap-2 text-[10px] text-emerald-600 opacity-0 group-hover:opacity-100 transition-opacity">
                        <i class="fa-solid fa-database"></i>
                        <span>Data realtime dari database</span>
                    </div>
                </div>
            </div>

            {{-- Card 2 - Laki-laki --}}
            <div class="stat-card group relative bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-500/10 to-transparent rounded-full blur-2xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-blue-600 text-white rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-mars text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold text-slate-800 mb-1 counter">{{ number_format($statistics['penduduk_pria'] ?? 0) }}</h3>
                    <p class="text-sm font-medium text-slate-500">Laki-laki</p>
                    <div class="mt-3 h-1.5 w-full bg-blue-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-blue-500 to-blue-600 rounded-full transition-all duration-700" style="width: {{ ($statistics['penduduk_pria'] / max($statistics['total_penduduk'], 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Card 3 - Perempuan --}}
            <div class="stat-card group relative bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-pink-500/10 to-transparent rounded-full blur-2xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-pink-500 to-pink-600 text-white rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-venus text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold text-slate-800 mb-1 counter">{{ number_format($statistics['penduduk_wanita'] ?? 0) }}</h3>
                    <p class="text-sm font-medium text-slate-500">Perempuan</p>
                    <div class="mt-3 h-1.5 w-full bg-pink-100 rounded-full overflow-hidden">
                        <div class="h-full bg-gradient-to-r from-pink-500 to-pink-600 rounded-full transition-all duration-700" style="width: {{ ($statistics['penduduk_wanita'] / max($statistics['total_penduduk'], 1)) * 100 }}%"></div>
                    </div>
                </div>
            </div>

            {{-- Card 4 - Kepala Keluarga --}}
            <div class="stat-card group relative bg-white rounded-2xl p-6 border border-slate-100 shadow-sm hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-amber-500/10 to-transparent rounded-full blur-2xl"></div>
                <div class="relative">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-14 h-14 bg-gradient-to-br from-amber-500 to-amber-600 text-white rounded-2xl flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                            <i class="fa-solid fa-house-user text-2xl"></i>
                        </div>
                    </div>
                    <h3 class="text-4xl font-bold text-slate-800 mb-1 counter">{{ number_format($statistics['total_kk'] ?? 0) }}</h3>
                    <p class="text-sm font-medium text-slate-500">Kepala Keluarga</p>
                    <div class="mt-3 flex items-center gap-1 text-[10px] text-amber-600">
                        <i class="fa-solid fa-chart-simple"></i>
                        <span>Rasio: {{ $statistics['total_penduduk'] > 0 ? round(($statistics['total_kk'] / $statistics['total_penduduk']) * 100, 1) : 0 }}% dari total</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Section Visualisasi Data Premium --}}
        <div class="bg-white rounded-3xl shadow-2xl border border-slate-100 overflow-hidden transition-all duration-500 hover:shadow-emerald-500/10">
            <div class="p-6 md:p-8 border-b border-slate-100 bg-gradient-to-r from-white via-emerald-50/30 to-white">
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-md">
                                <i class="fa-solid fa-chart-simple text-white text-sm"></i>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-800">Visualisasi Data</h2>
                        </div>
                        <p class="text-slate-500 text-sm">Pilih kategori dan jenis diagram untuk melihat detail statistik</p>
                    </div>

                    {{-- Tipe Chart Premium --}}
                    <div class="flex bg-slate-100/80 p-1.5 rounded-2xl self-start md:self-end backdrop-blur-sm">
                        <button onclick="changeChartType('bar', this)" class="chart-type-btn bg-white text-emerald-700 shadow-md px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:scale-105">
                            <i class="fa-solid fa-chart-column mr-2"></i> Bar Chart
                        </button>
                        <button onclick="changeChartType('line', this)" class="chart-type-btn text-slate-500 hover:text-emerald-600 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:scale-105">
                            <i class="fa-solid fa-chart-line mr-2"></i> Line Chart
                        </button>
                        <button onclick="changeChartType('pie', this)" class="chart-type-btn text-slate-500 hover:text-emerald-600 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:scale-105">
                            <i class="fa-solid fa-chart-pie mr-2"></i> Pie Chart
                        </button>
                        <button onclick="changeChartType('doughnut', this)" class="chart-type-btn text-slate-500 hover:text-emerald-600 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:scale-105">
                            <i class="fa-solid fa-circle-notch mr-2"></i> Donut Chart
                        </button>
                    </div>
                </div>
            </div>

            <div class="p-6 md:p-8">
                {{-- Kategori Premium --}}
                <div class="flex flex-wrap justify-center gap-3 mb-10">
                    <button id="btn-penduduk" onclick="loadChartData('penduduk', this)" class="kategori-btn bg-gradient-to-r from-emerald-600 to-emerald-500 text-white px-6 py-3 rounded-xl text-sm font-semibold shadow-lg shadow-emerald-500/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl">
                        <i class="fa-solid fa-users mr-2"></i> Statistik Penduduk
                    </button>
                    <button id="btn-umur" onclick="loadChartData('umur', this)" class="kategori-btn bg-white border-2 border-slate-200 text-slate-600 hover:border-emerald-300 hover:bg-emerald-50 px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:-translate-y-1">
                        <i class="fa-solid fa-chart-line mr-2"></i> Kelompok Umur
                    </button>
                </div>

                {{-- Canvas Chart Premium --}}
                <div class="relative h-[450px] w-full flex items-center justify-center bg-gradient-to-br from-slate-50/50 to-white rounded-2xl p-6 shadow-inner">
                    <!-- Efek dekoratif -->
                    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-emerald-400/5 to-transparent rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 w-64 h-64 bg-gradient-to-tr from-blue-400/5 to-transparent rounded-full blur-2xl"></div>
                    
                    <canvas id="statistikChart" class="relative z-10"></canvas>
                </div>

                {{-- Informasi Tambahan --}}
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
                    <div class="bg-gradient-to-r from-emerald-50 to-emerald-100/50 rounded-xl p-3">
                        <i class="fa-solid fa-database text-emerald-600 text-lg mb-1 block"></i>
                        <p class="text-[10px] text-emerald-700 font-semibold">DATA REALTIME</p>
                        <p class="text-[9px] text-emerald-600/70">Diperbarui secara otomatis</p>
                    </div>
                    <div class="bg-gradient-to-r from-blue-50 to-blue-100/50 rounded-xl p-3">
                        <i class="fa-solid fa-chart-simple text-blue-600 text-lg mb-1 block"></i>
                        <p class="text-[10px] text-blue-700 font-semibold">INTERAKTIF</p>
                        <p class="text-[9px] text-blue-600/70">Hover untuk detail lengkap</p>
                    </div>
                    <div class="bg-gradient-to-r from-purple-50 to-purple-100/50 rounded-xl p-3">
                        <i class="fa-solid fa-mobile-alt text-purple-600 text-lg mb-1 block"></i>
                        <p class="text-[10px] text-purple-700 font-semibold">RESPONSIF</p>
                        <p class="text-[9px] text-purple-600/70">Tampil optimal di semua device</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer Info --}}
        <div class="mt-12 text-center">
            <p class="text-xs text-slate-400 flex items-center justify-center gap-2 flex-wrap">
                <i class="fa-regular fa-clock"></i> Data terakhir diperbarui: {{ now()->format('d F Y H:i:s') }}
                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                <i class="fa-solid fa-chart-line"></i> Sumber: Database Desa Lumban Silintong
                <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                <i class="fa-solid fa-shield-alt"></i> Data terverifikasi
            </p>
        </div>
    </div>
</div>

<style>
    /* Animasi Premium */
    @keyframes pulse-slow {
        0%, 100% { opacity: 0.3; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(1.1); }
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-5px); }
    }
    
    @keyframes shimmer {
        0% { transform: translateX(-100%); }
        100% { transform: translateX(100%); }
    }
    
    .animate-pulse-slow {
        animation: pulse-slow 6s ease-in-out infinite;
    }
    
    /* Stat Card Premium */
    .stat-card {
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
        transition: left 0.6s ease;
        z-index: 1;
        pointer-events: none;
    }
    
    .stat-card:hover::before {
        left: 100%;
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 25px 40px -15px rgba(0, 0, 0, 0.15);
    }
    
    /* Counter Animation */
    .counter {
        animation: countUp 0.8s ease-out;
    }
    
    @keyframes countUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Chart Type Button */
    .chart-type-btn {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .chart-type-btn.active {
        background: white;
        color: #059669;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.15);
    }
    
    /* Kategori Button */
    .kategori-btn {
        position: relative;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .kategori-btn:active {
        transform: scale(0.95);
    }
    
    /* Canvas Container */
    canvas {
        max-height: 400px;
        width: 100%;
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .chart-type-btn {
            padding: 8px 12px;
            font-size: 11px;
        }
        
        .kategori-btn {
            padding: 10px 16px;
            font-size: 12px;
        }
        
        .stat-card {
            padding: 16px;
        }
        
        .stat-card h3 {
            font-size: 28px;
        }
    }
    
    /* Scrollbar Custom */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb {
        background: #10b981;
        border-radius: 10px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: #059669;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Konfigurasi default Chart.js untuk tampilan premium
    Chart.defaults.font.family = "'Inter', 'Segoe UI', 'Roboto', system-ui, sans-serif";
    Chart.defaults.font.size = 12;
    Chart.defaults.color = '#64748b';
    
    // Data chart hanya untuk Penduduk dan Kelompok Umur (tanpa UMKM & Layanan)
    const chartData = @json($chartData);
    
    let statistikChart = null;
    let currentChartType = 'bar';
    let currentKategori = 'penduduk';
    
    function loadChartData(kategori, btnElement = null) {
        currentKategori = kategori;
        const data = chartData[kategori];
        
        // Validasi data
        if (!data || !data.labels || !data.values) {
            console.error("Data grafik tidak ditemukan untuk kategori: " + kategori);
            return;
        }
        
        // Efek loading halus
        const canvas = document.getElementById('statistikChart');
        canvas.style.opacity = '0.5';
        
        setTimeout(() => {
            if (statistikChart) statistikChart.destroy();
            
            const ctx = canvas.getContext('2d');
            const isPieType = ['pie', 'doughnut'].includes(currentChartType);
            
            // Gradient untuk Line Chart yang lebih premium
            let gradientFill = ctx.createLinearGradient(0, 0, 0, 400);
            gradientFill.addColorStop(0, 'rgba(16, 185, 129, 0.35)');
            gradientFill.addColorStop(0.5, 'rgba(16, 185, 129, 0.15)');
            gradientFill.addColorStop(1, 'rgba(16, 185, 129, 0.02)');
            
            // Opsi umum premium
            const commonOptions = {
                responsive: true,
                maintainAspectRatio: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    legend: {
                        position: isPieType ? 'bottom' : 'top',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle',
                            font: { size: 11, weight: '500' },
                            boxWidth: 10,
                            boxHeight: 10
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(15, 23, 42, 0.95)',
                        titleColor: '#f1f5f9',
                        bodyColor: '#cbd5e1',
                        borderColor: '#10b981',
                        borderWidth: 1,
                        padding: 12,
                        cornerRadius: 12,
                        displayColors: true,
                        titleFont: { size: 12, weight: 'bold' },
                        bodyFont: { size: 11 },
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label || '';
                                let value = context.raw;
                                let total = 0;
                                if (isPieType && data.values) {
                                    total = data.values.reduce((a, b) => a + b, 0);
                                }
                                let percentage = total > 0 ? ` (${((value / total) * 100).toFixed(1)}%)` : '';
                                return `${label}: ${value.toLocaleString()} data${percentage}`;
                            }
                        }
                    }
                },
                onHover: function(event, activeElements) {
                    const canvas = document.getElementById('statistikChart');
                    canvas.style.cursor = activeElements.length ? 'pointer' : 'default';
                }
            };
            
            // Tambah scales untuk chart non-pie
            if (!isPieType) {
                commonOptions.scales = {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: '#e2e8f0',
                            drawBorder: false,
                            lineWidth: 1,
                            drawTicks: false
                        },
                        ticks: {
                            padding: 10,
                            callback: function(value) {
                                return value.toLocaleString();
                            },
                            font: { size: 11 }
                        },
                        title: {
                            display: true,
                            text: '📊 Jumlah Data',
                            font: { size: 11, weight: '500' },
                            color: '#64748b'
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { 
                            font: { size: 12, weight: '500' },
                            color: '#334155'
                        }
                    }
                };
            }
            
            if (isPieType) {
                statistikChart = new Chart(ctx, {
                    type: currentChartType,
                    data: {
                        labels: data.labels,
                        datasets: [{
                            data: data.values,
                            backgroundColor: data.colors,
                            borderWidth: 3,
                            borderColor: '#ffffff',
                            hoverOffset: 15,
                            cutout: currentChartType === 'doughnut' ? '65%' : 0,
                            borderRadius: 10
                        }]
                    },
                    options: {
                        ...commonOptions,
                        layout: {
                            padding: 20
                        }
                    }
                });
            } else {
                statistikChart = new Chart(ctx, {
                    type: currentChartType,
                    data: {
                        labels: data.labels,
                        datasets: [{
                            label: data.title || kategori.toUpperCase(),
                            data: data.values,
                            backgroundColor: currentChartType === 'line' ? gradientFill : data.colors,
                            borderColor: currentChartType === 'line' ? '#10b981' : data.borderColors || data.colors,
                            borderWidth: currentChartType === 'line' ? 3 : 1,
                            borderRadius: currentChartType === 'bar' ? 8 : 0,
                            borderSkipped: false,
                            fill: currentChartType === 'line',
                            tension: 0.4,
                            pointBackgroundColor: '#10b981',
                            pointBorderColor: '#ffffff',
                            pointBorderWidth: 2,
                            pointRadius: currentChartType === 'line' ? 5 : 0,
                            pointHoverRadius: 8,
                            pointHoverBackgroundColor: '#059669',
                            hoverBackgroundColor: currentChartType === 'bar' ? data.hoverColors || data.colors : null,
                            maxBarThickness: 80,
                            barPercentage: 0.7,
                            categoryPercentage: 0.8
                        }]
                    },
                    options: commonOptions
                });
            }
            
            canvas.style.opacity = '1';
        }, 200);
        
        // Update styling tombol Kategori
        if (btnElement) {
            document.querySelectorAll('.kategori-btn').forEach(btn => {
                btn.className = 'kategori-btn bg-white border-2 border-slate-200 text-slate-600 hover:border-emerald-300 hover:bg-emerald-50 px-6 py-3 rounded-xl text-sm font-semibold transition-all duration-300 hover:-translate-y-1';
            });
            btnElement.className = 'kategori-btn bg-gradient-to-r from-emerald-600 to-emerald-500 text-white px-6 py-3 rounded-xl text-sm font-semibold shadow-lg shadow-emerald-500/30 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl';
        }
    }
    
    function changeChartType(type, btnElement) {
        currentChartType = type;
        
        // Update styling tombol Tipe Chart
        if (btnElement) {
            document.querySelectorAll('.chart-type-btn').forEach(btn => {
                btn.className = 'chart-type-btn text-slate-500 hover:text-emerald-600 px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:scale-105';
            });
            btnElement.className = 'chart-type-btn bg-white text-emerald-700 shadow-md px-5 py-2.5 rounded-xl text-sm font-semibold transition-all duration-300 hover:scale-105';
        }
        
        // Reload chart dengan tipe baru
        loadChartData(currentKategori);
    }
    
    // Inisialisasi default saat halaman dimuat
    document.addEventListener('DOMContentLoaded', function() {
        const defaultBtn = document.getElementById('btn-penduduk');
        loadChartData('penduduk', defaultBtn);
    });
</script>
@endsection