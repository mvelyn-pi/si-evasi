@extends('layouts.evaluator')
@section('title', 'Dashboard Evaluator')
@section('page-title', 'Dashboard Evaluator')

@section('content')
<!-- Page Header & Filters -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-2">
    <div>
        <h2 class="font-display-lg text-display-lg text-primary font-bold">Dashboard Evaluator</h2>
        <p class="text-on-surface-variant mt-1">Ringkasan evaluasi kinerja sistem SAKTI</p>
    </div>
</div>

<!-- Row 1: Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 mb-4">
    <!-- Card 1 -->
    <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-on-surface-variant font-label-sm text-label-sm">Total Responden</p>
            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">group</span>
        </div>
        <div>
            <h3 class="font-display-md text-display-md text-primary font-bold">{{ number_format($totalResponden) }}</h3>
            <p class="text-xs text-on-surface-variant mt-1">Pengguna aktif</p>
        </div>
    </div>
    <!-- Card 2 -->
    <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-on-surface-variant font-label-sm text-label-sm">Total Polres</p>
            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">local_police</span>
        </div>
        <div>
            <h3 class="font-display-md text-display-md text-primary font-bold">{{ number_format($totalPolres) }}</h3>
            <p class="text-xs text-on-surface-variant mt-1">Seluruh wilayah</p>
        </div>
    </div>
    <!-- Card 3 -->
    <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-on-surface-variant font-label-sm text-label-sm">Rata-rata Pemahaman</p>
            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">psychology</span>
        </div>
        <div>
            <h3 class="font-display-md text-display-md text-primary font-bold">{{ number_format($avgPemahaman, 2) }}</h3>
            <p class="text-xs text-on-surface-variant mt-1">Dari skala 100</p>
        </div>
    </div>
    <!-- Card 4 -->
    <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-on-surface-variant font-label-sm text-label-sm">Skor TAM Rata-rata</p>
            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">extension</span>
        </div>
        <div>
            <h3 class="font-display-md text-display-md text-primary font-bold">{{ number_format($avgTAM, 2) }}<span class="text-sm font-normal text-outline">/5</span></h3>
            <p class="text-xs text-on-surface-variant mt-1">Penerimaan sistem</p>
        </div>
    </div>
    <!-- Card 5 -->
    <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] flex flex-col justify-between">
        <div class="flex justify-between items-start mb-4">
            <p class="text-on-surface-variant font-label-sm text-label-sm">Skor SUS Rata-rata</p>
            <span class="material-symbols-outlined text-secondary" style="font-variation-settings: 'FILL' 1;">touch_app</span>
        </div>
        <div>
            <h3 class="font-display-md text-display-md text-primary font-bold">{{ number_format($avgSUS, 1) }}</h3>
            <p class="text-xs text-on-surface-variant mt-1">Kebergunaan sistem</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
    <!-- Bar Chart: Konstruk TAM -->
    <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] flex flex-col">
        <h3 class="font-display-sm text-display-sm text-primary font-semibold mb-4">Rata-rata Konstruk TAM</h3>
        <div class="h-[250px] relative w-full">
            <canvas id="chartTAM"></canvas>
        </div>
    </div>

    <!-- TAM Progress Bars -->
    <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] flex flex-col justify-center">
        <h3 class="font-display-sm text-display-sm text-primary font-semibold mb-4">Ringkasan Konstruk TAM</h3>
        <div class="space-y-4">
            @php
                $konstruks = [
                    ['label' => 'Perceived Usefulness (PU)', 'skor' => $avgPU, 'color' => '#1B3A5C'],
                    ['label' => 'Perceived Ease of Use (PEOU)', 'skor' => $avgPEOU, 'color' => '#2E6DA4'],
                    ['label' => 'Attitude Toward Using (ATU)', 'skor' => $avgATU, 'color' => '#c49b5f'],
                    ['label' => 'Behavioral Intention (BI)', 'skor' => $avgBI, 'color' => '#2D9E6B'],
                ];
            @endphp
            @foreach($konstruks as $k)
            <div>
                <div class="flex justify-between text-xs mb-1">
                    <span class="font-medium text-on-surface-variant">{{ $k['label'] }}</span>
                    <span class="text-primary font-bold">{{ number_format($k['skor'], 2) }}/5</span>
                </div>
                <div class="w-full bg-surface-variant rounded-full h-2">
                    <div class="h-2 rounded-full" style="width: {{ ($k['skor']/5)*100 }}%; background-color: {{ $k['color'] }}"></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
// Bar konstruk TAM
new Chart(document.getElementById('chartTAM'), {
    type: 'bar',
    data: {
        labels: ['PU', 'PEOU', 'ATU', 'BI'],
        datasets: [{
            label: 'Rata-rata Skor',
            data: [{{ $avgPU }}, {{ $avgPEOU }}, {{ $avgATU }}, {{ $avgBI }}],
            backgroundColor: ['#1B3A5C','#2E6DA4','#c49b5f','#2D9E6B'],
            borderRadius: 6
        }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
            y: { min: 0, max: 5, grid: { color: '#e3e2e5' }, ticks: { font: { family: 'Inter', size: 11 } } },
            x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 11, weight: '600' } } }
        }
    }
});
</script>
@endpush
