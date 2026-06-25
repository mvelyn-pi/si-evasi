@extends('layouts.admin')
@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard Admin')

@section('content')
<!-- Page Header & Filters -->
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-2">
    <div>
        <h2 class="font-display-lg text-display-lg text-primary font-bold">Dashboard Admin</h2>
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

<!-- Row 2 & 3: Charts Area (Bento-like layout) -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
    <!-- Grouped Bar Chart: Skor per Polres -->
    <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] lg:col-span-2">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-display-sm text-display-sm text-primary font-semibold">Skor Evaluasi per Polres</h3>
        </div>
        <div class="h-[300px] relative w-full">
            <canvas id="chartPolres"></canvas>
        </div>
    </div>

    <!-- Right Column: TAM Bar & SUS Donut -->
    <div class="flex flex-col gap-4 lg:col-span-1">
        <!-- Donut Chart: Distribusi SUS -->
        <div class="bg-surface-container-lowest rounded-xl p-5 border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] flex-1 flex flex-col">
            <h3 class="font-display-sm text-display-sm text-primary font-semibold mb-2">Distribusi SUS Grade</h3>
            <div class="h-[200px] relative w-full flex items-center justify-center">
                <canvas id="chartSUS"></canvas>
            </div>
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

<!-- Row 4: Data Table -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden">
    <div class="p-5 border-b border-outline-variant flex justify-between items-center bg-white">
        <h3 class="font-display-sm text-display-sm text-primary font-semibold">Detail Responden Terbaru</h3>
        <a href="{{ route('admin.laporan.index') }}" class="flex items-center gap-2 text-sm font-label-md text-primary bg-primary/5 hover:bg-primary/10 px-3 py-1.5 rounded-lg transition-colors border border-primary/20">
            <span class="material-symbols-outlined text-[18px]">open_in_new</span> Lihat Semua
        </a>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-surface-bright border-b border-outline-variant text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Kode</th>
                    <th class="p-4 font-semibold">Polres</th>
                    <th class="p-4 font-semibold">Jabatan</th>
                    <th class="p-4 font-semibold text-center">Skor Pemahaman</th>
                    <th class="p-4 font-semibold text-center">Skor TAM</th>
                    <th class="p-4 font-semibold text-center">Skor SUS</th>
                    <th class="p-4 font-semibold text-center">Kategori SUS</th>
                </tr>
            </thead>
            <tbody class="text-sm font-body-md divide-y divide-outline-variant/50">
                @forelse($rekap as $h)
                <tr class="hover:bg-surface-container-low/50 transition-colors">
                    <td class="p-4 font-medium text-primary">{{ $h->responden->kode_responden }}</td>
                    <td class="p-4 text-on-surface">{{ $h->responden->polres->nama_polres ?? '-' }}</td>
                    <td class="p-4 text-on-surface-variant">{{ $h->responden->jabatan }}</td>
                    <td class="p-4 text-center font-medium">{{ number_format($h->skor_pemahaman, 2) }}</td>
                    <td class="p-4 text-center font-medium">{{ number_format($h->skor_tam, 2) }}</td>
                    <td class="p-4 text-center font-medium">{{ number_format($h->skor_sus, 1) }}</td>
                    <td class="p-4 text-center">
                        @php 
                            $kat = $h->kategori_sus;
                            $bg = 'bg-surface-variant';
                            $text = 'text-on-surface';
                            if(str_contains($kat, 'Sangat Baik')) { $bg = 'bg-[#d1fae5]'; $text = 'text-[#065f46]'; }
                            elseif(str_contains($kat, 'Baik')) { $bg = 'bg-[#dbeafe]'; $text = 'text-[#1e40af]'; }
                            elseif(str_contains($kat, 'Cukup')) { $bg = 'bg-[#fef9c3]'; $text = 'text-[#854d0e]'; }
                            elseif(str_contains($kat, 'Rendah')) { $bg = 'bg-[#fee2e2]'; $text = 'text-[#991b1b]'; }
                        @endphp
                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full {{ $bg }} {{ $text }} text-xs font-semibold">
                            {{ $kat }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center p-4 text-on-surface-variant">Belum ada data evaluasi.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($rekap->hasPages())
    <div class="p-4 border-t border-outline-variant bg-white">
        {{ $rekap->links() }}
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// Data dari backend
const polresLabels = {!! json_encode($dataPerPolres->pluck('nama_polres')) !!};
const polresDataPemahaman = {!! json_encode($dataPerPolres->pluck('avg_pemahaman')) !!};
const polresDataTAM = {!! json_encode($dataPerPolres->pluck('avg_tam')) !!};
const polresDataSUS = {!! json_encode($dataPerPolres->pluck('avg_sus')->map(fn($v) => $v ? round($v/20,2) : null)) !!};

// Chart per Polres
new Chart(document.getElementById('chartPolres'), {
    type: 'bar',
    data: {
        labels: polresLabels,
        datasets: [
            { label: 'Pemahaman (1-100)', data: polresDataPemahaman, backgroundColor: '#1B3A5C', borderRadius: 4 },
            { label: 'TAM (1-5)', data: polresDataTAM, backgroundColor: '#2E6DA4', borderRadius: 4 },
            { label: 'SUS (konversi 1-5)', data: polresDataSUS, backgroundColor: '#c49b5f', borderRadius: 4 },
        ]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'top', labels: { font: { family: 'Inter', size: 12 }, boxWidth: 12 } } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#e3e2e5' }, ticks: { font: { family: 'Inter', size: 11 } } },
            x: { grid: { display: false }, ticks: { font: { family: 'Inter', size: 11 }, maxRotation: 45 } }
        }
    }
});

// Pie distribusi SUS
const susLabels = {!! json_encode($distribusiSUS->pluck('kategori_sus')) !!};
const susData   = {!! json_encode($distribusiSUS->pluck('jumlah')) !!};
new Chart(document.getElementById('chartSUS'), {
    type: 'doughnut',
    data: {
        labels: susLabels,
        datasets: [{ data: susData, backgroundColor: ['#2D9E6B','#2E6DA4','#E8A020','#C0392B'], borderWidth: 0 }]
    },
    options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { font: { family: 'Inter', size: 11 }, boxWidth: 12 } } },
        cutout: '65%'
    }
});

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
