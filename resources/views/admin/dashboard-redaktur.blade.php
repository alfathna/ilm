@extends('layouts.admin')

@section('title', 'Dashboard Redaktur')

@section('content')
{{-- Page Header --}}
<div class="mb-10">
    <div class="flex items-center gap-4 mb-2">
        <div class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
        </div>
        <h1 class="text-3xl font-black text-gray-900 uppercase tracking-tighter">
            Selamat Datang di Halaman Redaktur
        </h1>
    </div>
    <div class="flex items-center gap-2 text-[11px] font-bold text-gray-400 uppercase ml-14">
        <span>Dashboard</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
        <span class="text-red-500">Home</span>
    </div>
</div>

{{-- Stat Cards --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    {{-- Total Postingan --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-slate-50 overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col h-full min-h-[290px]">
        <div class="p-7 flex-1 flex flex-col items-start">
            <div class="flex items-start justify-between w-full mb-6">
                <div class="bg-red-600 p-3.5 rounded-[18px] shadow-[0_10px_20px_-5px_rgba(220,38,38,0.4)]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1">Live Data</span>
            </div>
            <div class="mt-auto">
                <p class="text-4xl font-black text-slate-800 tracking-tighter mb-1.5">{{ number_format($totalNews) }}</p>
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Berita</h3>
            </div>
        </div>
        <div class="px-5 pb-5">
            <a href="{{ route('admin.news.index') }}" class="w-full h-11 bg-red-600 hover:bg-slate-900 rounded-[14px] text-[9px] font-black text-white uppercase tracking-[0.15em] transition-all duration-300 flex items-center justify-center gap-2 shadow-md">
                Semua Postingan
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>
    </div>

    {{-- Total Pengunjung Web --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-slate-50 overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col h-full min-h-[290px]">
        <div class="p-7 flex-1 flex flex-col items-start">
            <div class="flex items-start justify-between w-full mb-6">
                <div class="bg-red-600 p-3.5 rounded-[18px] shadow-[0_10px_20px_-5px_rgba(220,38,38,0.4)]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1">Live Data</span>
            </div>
            <div class="mt-auto">
                @php
                    $viewsFormatted = $totalViews >= 1000000 ? number_format($totalViews / 1000000, 1) . 'M' : ($totalViews >= 1000 ? number_format($totalViews / 1000, 1) . 'k' : $totalViews);
                @endphp
                <p class="text-4xl font-black text-slate-800 tracking-tighter mb-1.5">{{ $viewsFormatted }}</p>
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Pembaca Berita</h3>
            </div>
        </div>
        <div class="px-5 pb-5">
            <button class="w-full h-11 bg-red-600 hover:bg-slate-900 rounded-[14px] text-[9px] font-black text-white uppercase tracking-[0.15em] transition-all duration-300 flex items-center justify-center gap-2 shadow-md">
                Statistik Web
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            </button>
        </div>
    </div>

    {{-- Total Video --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-slate-50 overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col h-full min-h-[290px]">
        <div class="p-7 flex-1 flex flex-col items-start">
            <div class="flex items-start justify-between w-full mb-6">
                <div class="bg-red-600 p-3.5 rounded-[18px] shadow-[0_10px_20px_-5px_rgba(220,38,38,0.4)]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="23 7 16 12 23 17 23 7"/><rect x="1" y="5" width="15" height="14" rx="2" ry="2"/></svg>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1">Live Data</span>
            </div>
            <div class="mt-auto">
                <p class="text-4xl font-black text-slate-800 tracking-tighter mb-1.5">{{ number_format($totalVideos) }}</p>
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Video</h3>
            </div>
        </div>
        <div class="px-5 pb-5">
            <a href="{{ route('admin.videos.index') }}" class="w-full h-11 bg-red-600 hover:bg-slate-900 rounded-[14px] text-[9px] font-black text-white uppercase tracking-[0.15em] transition-all duration-300 flex items-center justify-center gap-2 shadow-md">
                Semua Video
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>
    </div>

    {{-- Total Galeri / Potret Kelana Kota --}}
    <div class="bg-white rounded-[32px] shadow-sm border border-slate-50 overflow-hidden group hover:shadow-xl hover:-translate-y-1 transition-all duration-500 flex flex-col h-full min-h-[290px]">
        <div class="p-7 flex-1 flex flex-col items-start">
            <div class="flex items-start justify-between w-full mb-6">
                <div class="bg-red-600 p-3.5 rounded-[18px] shadow-[0_10px_20px_-5px_rgba(220,38,38,0.4)]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                </div>
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mt-1">Live Data</span>
            </div>
            <div class="mt-auto">
                <p class="text-4xl font-black text-slate-800 tracking-tighter mb-1.5">{{ number_format($totalGalleries) }}</p>
                <h3 class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Potret Kelana</h3>
            </div>
        </div>
        <div class="px-5 pb-5">
            <a href="{{ route('admin.galleries.index') }}" class="w-full h-11 bg-red-600 hover:bg-slate-900 rounded-[14px] text-[9px] font-black text-white uppercase tracking-[0.15em] transition-all duration-300 flex items-center justify-center gap-2 shadow-md">
                Semua Galeri
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"/></svg>
            </a>
        </div>
    </div>
</div>

{{-- Charts --}}
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    {{-- Grafik Pengunjung Web --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-tight">Grafik Pengunjung Web</h3>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Kunjungan Harian (30 Hari Terakhir)</p>
            </div>
            <div class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
            </div>
        </div>
        <canvas id="visitorChart" height="200"></canvas>
    </div>

    {{-- Grafik Postingan Paling Banyak Dibuka --}}
    <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-tight">Grafik Postingan Paling Banyak Dibuka</h3>
                <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">Berdasarkan Kategori Berita</p>
            </div>
            <div class="w-10 h-10 bg-red-50 rounded-full flex items-center justify-center text-red-600">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/></svg>
            </div>
        </div>
        <canvas id="categoryChart" height="200"></canvas>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // Visitor Line Chart
    const visitorCtx = document.getElementById('visitorChart').getContext('2d');
    new Chart(visitorCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode(array_slice($chartLabels, -15)) !!},
            datasets: [{
                label: 'Pengunjung',
                data: {!! json_encode(array_slice($chartViews, -15)) !!},
                borderColor: '#dc2626',
                backgroundColor: 'rgba(220, 38, 38, 0.05)',
                borderWidth: 2,
                fill: true,
                tension: 0.4,
                pointRadius: 3,
                pointBackgroundColor: '#dc2626',
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000) return (value/1000) + 'k';
                            return value;
                        },
                        font: { size: 10, weight: 'bold' },
                        color: '#9ca3af'
                    },
                    grid: { color: '#f3f4f6' }
                },
                x: {
                    ticks: { font: { size: 10, weight: 'bold' }, color: '#9ca3af' },
                    grid: { display: false }
                }
            }
        }
    });

    // Category Bar Chart
    const catCtx = document.getElementById('categoryChart').getContext('2d');
    new Chart(catCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($categoryStats->pluck('name')) !!},
            datasets: [{
                label: 'Views',
                data: {!! json_encode($categoryStats->pluck('total_views')->map(fn($v) => (int)($v ?? 0))) !!},
                backgroundColor: '#dc2626',
                borderRadius: 4,
                barThickness: 20,
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            if (value >= 1000000) return (value/1000000) + 'M';
                            if (value >= 1000) return (value/1000) + 'k';
                            return value;
                        },
                        font: { size: 10, weight: 'bold' },
                        color: '#9ca3af'
                    },
                    grid: { color: '#f3f4f6' }
                },
                x: {
                    ticks: { font: { size: 8, weight: 'bold' }, color: '#9ca3af', maxRotation: 45 },
                    grid: { display: false }
                }
            }
        }
    });
</script>
@endpush
