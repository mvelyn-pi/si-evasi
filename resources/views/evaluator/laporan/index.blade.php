@extends('layouts.evaluator')
@section('title', 'Laporan Evaluasi')
@section('page-title', 'Laporan Evaluasi')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-4">
    <div>
        <p class="text-on-surface-variant font-body-md text-sm">Lihat, filter, dan ekspor data hasil evaluasi SAKTI.</p>
    </div>
    <div class="flex gap-2">
        <a href="{{ route('evaluator.laporan.pdf', request()->query()) }}" class="flex items-center gap-2 bg-[#fee2e2] hover:bg-[#fca5a5] text-[#991b1b] px-4 py-2 rounded-lg font-label-md text-sm transition-colors border border-[#fca5a5]">
            <span class="material-symbols-outlined" style="font-size: 18px;">picture_as_pdf</span>
            Export PDF
        </a>
        <a href="{{ route('evaluator.laporan.excel', request()->query()) }}" class="flex items-center gap-2 bg-[#d1fae5] hover:bg-[#6ee7b7] text-[#065f46] px-4 py-2 rounded-lg font-label-md text-sm transition-colors border border-[#6ee7b7]">
            <span class="material-symbols-outlined" style="font-size: 18px;">table</span>
            Export Excel
        </a>
    </div>
</div>

<!-- Filter Section -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] p-5 mb-6">
    <form method="GET" action="{{ route('evaluator.laporan.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
        <div class="flex flex-col gap-2">
            <label class="font-label-md text-xs text-on-surface-variant font-semibold uppercase tracking-wider">Filter Polres</label>
            <div class="relative">
                <select name="id_polres" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface appearance-none cursor-pointer">
                    <option value="">Semua Polres</option>
                    @foreach($polresList as $p)
                    <option value="{{ $p->id_polres }}" {{ request('id_polres') == $p->id_polres ? 'selected' : '' }}>{{ $p->nama_polres }}</option>
                    @endforeach
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
            </div>
        </div>
        <div class="flex flex-col gap-2">
            <label class="font-label-md text-xs text-on-surface-variant font-semibold uppercase tracking-wider">Tanggal Mulai</label>
            <input type="date" name="tanggal_mulai" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface" value="{{ request('tanggal_mulai') }}">
        </div>
        <div class="flex flex-col gap-2">
            <label class="font-label-md text-xs text-on-surface-variant font-semibold uppercase tracking-wider">Tanggal Akhir</label>
            <input type="date" name="tanggal_akhir" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface" value="{{ request('tanggal_akhir') }}">
        </div>
        <div>
            <button type="submit" class="w-full h-[40px] flex items-center justify-center gap-2 bg-primary hover:bg-primary/90 text-white rounded-lg font-label-md text-sm transition-colors shadow-sm">
                <span class="material-symbols-outlined" style="font-size: 18px;">filter_list</span>
                Terapkan Filter
            </button>
        </div>
    </form>
</div>

<!-- Table Section -->
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden">
    <div class="p-4 border-b border-outline-variant bg-surface-bright flex justify-between items-center">
        <h6 class="font-display-sm text-sm font-bold text-primary m-0">Data Hasil Evaluasi</h6>
        <span class="text-on-surface-variant font-body-md text-sm">{{ $data->total() }} data ditemukan</span>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[1000px]">
            <thead>
                <tr class="bg-surface-bright border-b border-outline-variant text-on-surface-variant font-label-sm text-xs uppercase tracking-wider">
                    <th class="p-3 font-semibold w-12 text-center">No</th>
                    <th class="p-3 font-semibold">Kode</th>
                    <th class="p-3 font-semibold">Polres</th>
                    <th class="p-3 font-semibold">Jabatan</th>
                    <th class="p-3 font-semibold text-center">Pemahaman</th>
                    <th class="p-3 font-semibold text-center">Kat.</th>
                    <th class="p-3 font-semibold text-center">TAM</th>
                    <th class="p-3 font-semibold text-center">Kat.</th>
                    <th class="p-3 font-semibold text-center">SUS</th>
                    <th class="p-3 font-semibold text-center">Kat.</th>
                </tr>
            </thead>
            <tbody class="text-sm font-body-md divide-y divide-outline-variant/50">
                @php 
                    $no = $data->firstItem(); 
                    if (!function_exists('getBadgeClasses')) {
                        function getBadgeClasses($kat) {
                            if(str_contains($kat, 'Sangat Baik') || str_contains($kat, 'Sangat Tinggi')) return 'bg-[#d1fae5] text-[#065f46]';
                            if(str_contains($kat, 'Baik') || str_contains($kat, 'Tinggi')) return 'bg-[#dbeafe] text-[#1e40af]';
                            if(str_contains($kat, 'Cukup')) return 'bg-[#fef9c3] text-[#854d0e]';
                            if(str_contains($kat, 'Rendah')) return 'bg-[#fee2e2] text-[#991b1b]';
                            if(str_contains($kat, 'Sangat Rendah')) return 'bg-[#fce7f3] text-[#9d174d]';
                            return 'bg-surface-variant text-on-surface';
                        }
                    }
                @endphp
                @forelse($data as $h)
                <tr class="hover:bg-surface-container-low/30 transition-colors">
                    <td class="p-3 text-center text-on-surface-variant">{{ $no++ }}</td>
                    <td class="p-3 font-medium text-primary text-xs">{{ $h->responden->kode_responden }}</td>
                    <td class="p-3 text-on-surface text-xs">{{ $h->responden->polres->nama_polres ?? '-' }}</td>
                    <td class="p-3 text-on-surface-variant text-xs max-w-[120px] truncate" title="{{ $h->responden->jabatan }}">{{ $h->responden->jabatan }}</td>
                    <td class="p-3 text-center font-medium">{{ number_format($h->skor_pemahaman, 2) }}</td>
                    <td class="p-3 text-center">
                        <span class="inline-flex items-center justify-center px-2 py-0.5 rounded text-[10px] font-bold {{ getBadgeClasses($h->kategori_pemahaman) }}">
                            {{ $h->kategori_pemahaman }}
                        </span>
                    </td>
                    <td class="p-3 text-center font-medium">{{ number_format($h->skor_tam, 2) }}</td>
                    <td class="p-3 text-center">
                        <span class="inline-flex items-center justify-center px-2 py-0.5 rounded text-[10px] font-bold {{ getBadgeClasses($h->kategori_tam) }}">
                            {{ $h->kategori_tam }}
                        </span>
                    </td>
                    <td class="p-3 text-center font-medium">{{ number_format($h->skor_sus, 1) }}</td>
                    <td class="p-3 text-center">
                        <span class="inline-flex items-center justify-center px-2 py-0.5 rounded text-[10px] font-bold {{ getBadgeClasses($h->kategori_sus) }}">
                            {{ $h->kategori_sus }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr><td colspan="10" class="text-center p-4 text-on-surface-variant text-sm">Belum ada data evaluasi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($data->hasPages())
    <div class="p-4 border-t border-outline-variant bg-white">
        {{ $data->links() }}
    </div>
    @endif
</div>
@endsection
