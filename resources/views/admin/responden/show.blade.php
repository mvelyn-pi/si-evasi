@extends('layouts.admin')
@section('title', 'Detail Responden')
@section('page-title', 'Detail Responden')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.responden.index') }}" class="inline-flex items-center gap-1 text-sm font-label-md text-on-surface-variant hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Data Responden
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Left Column: Identitas & Ringkasan -->
    <div class="flex flex-col gap-6">
        <!-- Identitas Card -->
        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] p-5">
            <div class="flex items-center gap-4 mb-5">
                <div class="w-14 h-14 bg-primary-fixed/30 rounded-xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-primary text-[28px]">person</span>
                </div>
                <div>
                    <div class="font-display-md text-lg font-bold text-primary">{{ $responden->kode_responden }}</div>
                    <div class="text-on-surface-variant text-sm">Identitas Anonim</div>
                </div>
            </div>
            <div class="flex flex-col gap-3">
                <div class="flex justify-between border-b border-outline-variant/50 pb-2">
                    <span class="text-on-surface-variant text-sm font-medium">Polres</span>
                    <span class="text-on-surface text-sm font-medium text-right">{{ $responden->polres->nama_polres ?? '-' }}</span>
                </div>
                <div class="flex justify-between border-b border-outline-variant/50 pb-2">
                    <span class="text-on-surface-variant text-sm font-medium">Jabatan</span>
                    <span class="text-on-surface text-sm font-medium text-right">{{ $responden->jabatan }}</span>
                </div>
                <div class="flex justify-between border-b border-outline-variant/50 pb-2">
                    <span class="text-on-surface-variant text-sm font-medium">Lama Penggunaan</span>
                    <span class="text-on-surface text-sm font-medium text-right">{{ $responden->lama_penggunaan }}</span>
                </div>
                <div class="flex justify-between border-b border-outline-variant/50 pb-2">
                    <span class="text-on-surface-variant text-sm font-medium">Frekuensi</span>
                    <span class="text-on-surface text-sm font-medium text-right">{{ $responden->frekuensi_penggunaan }}</span>
                </div>
                <div class="flex justify-between border-b border-outline-variant/50 pb-2">
                    <span class="text-on-surface-variant text-sm font-medium">Pelatihan SAKTI</span>
                    <div class="text-right">
                        @if($responden->pelatihan_sakti === 'Pernah')
                            <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-[#d1fae5] text-[#065f46] text-xs font-semibold">Pernah</span>
                        @else
                            <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-[#fee2e2] text-[#991b1b] text-xs font-semibold">Belum</span>
                        @endif
                    </div>
                </div>
                <div class="flex justify-between">
                    <span class="text-on-surface-variant text-sm font-medium">Tgl Pengisian</span>
                    <span class="text-on-surface text-sm font-medium text-right">{{ $responden->created_at->format('d M Y') }}</span>
                </div>
            </div>
        </div>

        @if($responden->hasilEvaluasi)
        <!-- Hasil Evaluasi Card -->
        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] p-5 flex flex-col gap-4">
            <h6 class="font-display-sm text-display-sm text-primary font-semibold m-0">Hasil Evaluasi</h6>
            
            <div>
                <div class="flex justify-between items-end mb-1">
                    <span class="font-label-md text-sm text-on-surface-variant">Pemahaman</span>
                    <span class="font-bold text-primary">{{ number_format($responden->hasilEvaluasi->skor_pemahaman,2) }}<span class="text-xs text-outline font-normal">/5</span></span>
                </div>
                <div class="w-full bg-surface-variant rounded-full h-2 mb-1">
                    <div class="bg-primary h-2 rounded-full" style="width: {{ ($responden->hasilEvaluasi->skor_pemahaman/5)*100 }}%"></div>
                </div>
                <div class="text-xs text-on-surface-variant">{{ $responden->hasilEvaluasi->kategori_pemahaman }}</div>
            </div>
            
            <div>
                <div class="flex justify-between items-end mb-1">
                    <span class="font-label-md text-sm text-on-surface-variant">TAM</span>
                    <span class="font-bold text-secondary">{{ number_format($responden->hasilEvaluasi->skor_tam,2) }}<span class="text-xs text-outline font-normal">/5</span></span>
                </div>
                <div class="w-full bg-surface-variant rounded-full h-2 mb-1">
                    <div class="bg-secondary h-2 rounded-full" style="width: {{ ($responden->hasilEvaluasi->skor_tam/5)*100 }}%"></div>
                </div>
                <div class="text-xs text-on-surface-variant">{{ $responden->hasilEvaluasi->kategori_tam }}</div>
            </div>

            <div>
                <div class="flex justify-between items-end mb-1">
                    <span class="font-label-md text-sm text-on-surface-variant">SUS</span>
                    <span class="font-bold text-[#c49b5f]">{{ number_format($responden->hasilEvaluasi->skor_sus,1) }}<span class="text-xs text-outline font-normal">/100</span></span>
                </div>
                <div class="w-full bg-surface-variant rounded-full h-2 mb-1">
                    <div class="bg-[#c49b5f] h-2 rounded-full" style="width: {{ $responden->hasilEvaluasi->skor_sus }}%"></div>
                </div>
                <div class="text-xs text-on-surface-variant">{{ $responden->hasilEvaluasi->kategori_sus }}</div>
            </div>
        </div>
        @endif
    </div>

    <!-- Right Column: Detail Jawaban -->
    <div class="lg:col-span-2 flex flex-col gap-6">
        @foreach([
            'pemahaman' => ['label'=>'Pemahaman Pengguna', 'color'=>'border-l-primary', 'text'=>'text-primary'], 
            'tam' => ['label'=>'TAM (Technology Acceptance Model)', 'color'=>'border-l-secondary', 'text'=>'text-secondary'], 
            'sus' => ['label'=>'SUS (System Usability Scale)', 'color'=>'border-l-[#c49b5f]', 'text'=>'text-[#c49b5f]']
        ] as $jenis => $cfg)
        
        @php $jawabans = $responden->jawabans->filter(fn($j) => $j->pertanyaan->jenis_kuesioner === $jenis)->sortBy('pertanyaan.nomor_item'); @endphp
        
        @if($jawabans->isNotEmpty())
        <div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden">
            <div class="p-4 border-b border-outline-variant bg-surface-bright border-l-4 {{ $cfg['color'] }}">
                <h6 class="font-display-sm text-sm font-bold m-0 {{ $cfg['text'] }}">{{ $cfg['label'] }}</h6>
            </div>
            <div class="overflow-x-auto w-full">
                <table class="w-full text-left border-collapse min-w-[600px]">
                    <thead>
                        <tr class="bg-surface-bright border-b border-outline-variant text-on-surface-variant font-label-sm text-xs uppercase tracking-wider">
                            <th class="p-3 font-semibold w-12 text-center">No</th>
                            <th class="p-3 font-semibold">Pernyataan</th>
                            <th class="p-3 font-semibold text-center w-24">Skor</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm font-body-md divide-y divide-outline-variant/50">
                        @foreach($jawabans as $j)
                        <tr class="hover:bg-surface-container-low/30 transition-colors">
                            <td class="p-3 text-center text-on-surface-variant">{{ $j->pertanyaan->nomor_item }}</td>
                            <td class="p-3 text-on-surface text-sm">{{ $j->pertanyaan->teks_pertanyaan }}</td>
                            <td class="p-3 text-center">
                                @php
                                    $bg = $j->skor >= 4 ? 'bg-[#d1fae5]' : ($j->skor >= 3 ? 'bg-[#fef9c3]' : 'bg-[#fee2e2]');
                                    $text = $j->skor >= 4 ? 'text-[#065f46]' : ($j->skor >= 3 ? 'text-[#854d0e]' : 'text-[#991b1b]');
                                @endphp
                                <span class="inline-flex items-center justify-center w-7 h-7 rounded-full {{ $bg }} {{ $text }} text-xs font-bold">
                                    {{ $j->skor }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection
