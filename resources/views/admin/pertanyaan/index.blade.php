@extends('layouts.admin')
@section('title', 'Instrumen Kuesioner')
@section('page-title', 'Instrumen Kuesioner')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
    <div>
        <p class="text-on-surface-variant font-body-md text-sm">Kelola pertanyaan kuesioner. Klik toggle untuk mengaktifkan/menonaktifkan item.</p>
    </div>
    <a href="{{ route('admin.pertanyaan.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-label-md text-sm transition-colors shadow-sm">
        <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
        Tambah Pertanyaan
    </a>
</div>

@foreach(['pemahaman' => ['label'=>'Pemahaman Pengguna', 'color'=>'border-l-primary', 'text'=>'text-primary', 'bg'=>'bg-primary-fixed/30 text-on-primary-fixed'], 
          'tam' => ['label'=>'Technology Acceptance Model (TAM)', 'color'=>'border-l-secondary', 'text'=>'text-secondary', 'bg'=>'bg-secondary-fixed/50 text-[#005084]'], 
          'sus' => ['label'=>'System Usability Scale (SUS)', 'color'=>'border-l-[#c49b5f]', 'text'=>'text-[#c49b5f]', 'bg'=>'bg-[#ffddb1]/50 text-[#5f410c]']] as $jenis => $cfg)
@php $items = $$jenis; @endphp
<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden mb-6">
    <div class="p-4 border-b border-outline-variant bg-surface-bright flex justify-between items-center border-l-4 {{ $cfg['color'] }}">
        <div>
            <h6 class="font-display-sm text-sm font-bold m-0 {{ $cfg['text'] }}">{{ $cfg['label'] }}</h6>
            <small class="text-on-surface-variant font-body-md text-xs">{{ $items->count() }} item</small>
        </div>
        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-md text-xs font-bold uppercase {{ $cfg['bg'] }}">
            {{ $jenis }}
        </span>
    </div>
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-surface-bright border-b border-outline-variant text-on-surface-variant font-label-sm text-xs uppercase tracking-wider">
                    <th class="p-3 font-semibold w-12 text-center">No</th>
                    @if($jenis === 'tam')<th class="p-3 font-semibold w-32">Konstruk</th>@endif
                    <th class="p-3 font-semibold">Pernyataan</th>
                    @if($jenis === 'sus')<th class="p-3 font-semibold text-center w-24">Reverse</th>@endif
                    <th class="p-3 font-semibold text-center w-28">Status</th>
                    <th class="p-3 font-semibold text-center w-28">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm font-body-md divide-y divide-outline-variant/50">
                @forelse($items as $p)
                <tr class="hover:bg-surface-container-low/30 transition-colors">
                    <td class="p-3 text-center text-on-surface-variant font-medium">{{ $p->nomor_item }}</td>
                    @if($jenis === 'tam')
                    <td class="p-3">
                        <span class="inline-flex items-center justify-center px-2 py-0.5 rounded text-[11px] font-semibold {{ $cfg['bg'] }}">
                            {{ $p->konstruk }}
                        </span>
                    </td>
                    @endif
                    <td class="p-3 text-on-surface text-sm max-w-[400px]">{{ $p->teks_pertanyaan }}</td>
                    @if($jenis === 'sus')
                    <td class="p-3 text-center">
                        @if($p->is_reverse)
                            <span class="inline-flex items-center justify-center px-2 py-0.5 rounded-full bg-[#fce7f3] text-[#9d174d] text-[11px] font-bold">Ya</span>
                        @else
                            <span class="text-outline font-bold">-</span>
                        @endif
                    </td>
                    @endif
                    <td class="p-3 text-center">
                        <form action="{{ route('admin.pertanyaan.toggle', $p) }}" method="POST" class="inline">
                            @csrf @method('PATCH')
                            <button type="submit" class="inline-flex items-center justify-center px-2 py-1 rounded-full text-[11px] font-bold border transition-colors {{ $p->status === 'aktif' ? 'bg-[#d1fae5] text-[#065f46] border-[#a7f3d0] hover:bg-[#a7f3d0]' : 'bg-[#fee2e2] text-[#991b1b] border-[#fca5a5] hover:bg-[#fca5a5]' }}">
                                {{ $p->status === 'aktif' ? '● Aktif' : '○ Nonaktif' }}
                            </button>
                        </form>
                    </td>
                    <td class="p-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.pertanyaan.edit', $p) }}" class="w-8 h-8 rounded border border-outline-variant flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[16px]">edit</span>
                            </a>
                            <form action="{{ route('admin.pertanyaan.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Hapus pertanyaan ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-8 h-8 rounded border border-error/50 flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[16px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center p-4 text-on-surface-variant text-sm">Belum ada pertanyaan</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endforeach
@endsection
