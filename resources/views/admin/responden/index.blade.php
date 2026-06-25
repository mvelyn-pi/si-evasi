@extends('layouts.admin')
@section('title', 'Data Responden')
@section('page-title', 'Data Responden')

@section('content')
<div class="flex flex-col md:flex-row justify-between items-start md:items-end gap-4 mb-4">
    <div>
        <p class="text-on-surface-variant font-body-md text-sm">Filter data responden berdasarkan Polres dan tanggal pendaftaran.</p>
    </div>
    <div>
        <a href="{{ route('admin.responden.index') }}" class="inline-flex items-center gap-2 bg-surface-container-highest border border-outline-variant text-on-surface px-4 py-2 rounded-lg font-label-md text-sm transition-colors hover:bg-surface-container-low">
            <span class="material-symbols-outlined" style="font-size: 18px;">refresh</span>
            Reset Filter
        </a>
    </div>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] p-5 mb-6">
    <form method="GET" action="{{ route('admin.responden.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
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

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden">
    <div class="p-5 border-b border-outline-variant bg-surface-bright flex justify-between items-center">
        <div>
            <h6 class="font-display-sm text-display-sm text-primary font-semibold mb-0">Daftar Responden</h6>
            <small class="text-on-surface-variant font-body-md text-sm">Total: {{ $respondens->total() }} responden</small>
        </div>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[1000px]">
            <thead>
                <tr class="bg-surface-bright border-b border-outline-variant text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Kode</th>
                    <th class="p-4 font-semibold">Polres</th>
                    <th class="p-4 font-semibold">Jabatan</th>
                    <th class="p-4 font-semibold">Lama Pakai</th>
                    <th class="p-4 font-semibold">Pelatihan</th>
                    <th class="p-4 font-semibold text-center">Pemahaman</th>
                    <th class="p-4 font-semibold text-center">TAM</th>
                    <th class="p-4 font-semibold text-center">SUS</th>
                    <th class="p-4 font-semibold text-center w-24">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm font-body-md divide-y divide-outline-variant/50">
                @forelse($respondens as $r)
                <tr class="hover:bg-surface-container-low/50 transition-colors">
                    <td class="p-4 font-medium text-primary">{{ $r->kode_responden }}</td>
                    <td class="p-4 text-on-surface text-sm">{{ $r->polres->nama_polres ?? '-' }}</td>
                    <td class="p-4 text-on-surface-variant text-sm">{{ $r->jabatan }}</td>
                    <td class="p-4 text-on-surface-variant text-sm">{{ $r->lama_penggunaan }}</td>
                    <td class="p-4">
                        @if($r->pelatihan_sakti === 'Pernah')
                            <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-[#d1fae5] text-[#065f46] text-xs font-semibold">Pernah</span>
                        @else
                            <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-[#fee2e2] text-[#991b1b] text-xs font-semibold">Belum</span>
                        @endif
                    </td>
                    <td class="p-4 text-center font-medium">
                        @if($r->hasilEvaluasi)
                            {{ number_format($r->hasilEvaluasi->skor_pemahaman, 2) }}
                        @else <span class="text-outline">-</span> @endif
                    </td>
                    <td class="p-4 text-center font-medium">
                        @if($r->hasilEvaluasi)
                            {{ number_format($r->hasilEvaluasi->skor_tam, 2) }}
                        @else <span class="text-outline">-</span> @endif
                    </td>
                    <td class="p-4 text-center font-medium">
                        @if($r->hasilEvaluasi)
                            {{ number_format($r->hasilEvaluasi->skor_sus, 1) }}
                        @else <span class="text-outline">-</span> @endif
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.responden.show', $r) }}" class="w-8 h-8 rounded border border-outline-variant flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors" title="Lihat Detail">
                                <span class="material-symbols-outlined text-[18px]">visibility</span>
                            </a>
                            <form action="{{ route('admin.responden.destroy', $r) }}" method="POST" class="inline" data-confirm-name="Responden {{ $r->kode_responden }}">
                                @csrf @method('DELETE')
                                <button type="button" data-confirm-delete data-confirm-name="Responden {{ $r->kode_responden }}" class="w-8 h-8 rounded border border-error/50 flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="9" class="text-center p-4 text-on-surface-variant">Belum ada data responden</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4 border-t border-outline-variant bg-white flex flex-col md:flex-row items-center justify-between gap-3">
        <div class="text-on-surface-variant text-sm">
            Showing {{ $respondens->firstItem() ?? 0 }} to {{ $respondens->lastItem() ?? 0 }} of {{ $respondens->total() }} results
        </div>
        <div class="w-full md:w-auto">
            {{ $respondens->links() }}
        </div>
    </div>
</div>
@endsection
