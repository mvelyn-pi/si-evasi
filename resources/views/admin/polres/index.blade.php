@extends('layouts.admin')
@section('title', 'Data Polres')
@section('page-title', 'Data Polres')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
    <div>
        <p class="text-on-surface-variant font-body-md text-sm">Kelola data Polres yang menjadi unit evaluasi.</p>
    </div>
    <a href="{{ route('admin.polres.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-label-md text-sm transition-colors shadow-sm">
        <span class="material-symbols-outlined" style="font-size: 18px;">add</span>
        Tambah Polres
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-surface-bright border-b border-outline-variant text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold w-16">No</th>
                    <th class="p-4 font-semibold">Nama Polres</th>
                    <th class="p-4 font-semibold">Wilayah</th>
                    <th class="p-4 font-semibold text-center">Jml Responden</th>
                    <th class="p-4 font-semibold text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm font-body-md divide-y divide-outline-variant/50">
                @forelse($polresList as $polres)
                <tr class="hover:bg-surface-container-low/50 transition-colors">
                    <td class="p-4 text-on-surface-variant">{{ $polresList->firstItem() + $loop->index }}</td>
                    <td class="p-4 font-medium text-primary">{{ $polres->nama_polres }}</td>
                    <td class="p-4 text-on-surface">{{ $polres->wilayah }}</td>
                    <td class="p-4 text-center">
                        <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full bg-primary-fixed text-on-primary-fixed text-xs font-semibold">
                            {{ $polres->respondens_count }}
                        </span>
                    </td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.polres.edit', $polres) }}" class="w-8 h-8 rounded border border-outline-variant flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            <form action="{{ route('admin.polres.destroy', $polres) }}" method="POST" class="inline" data-confirm-name="Polres {{ $polres->nama_polres }}">
                                @csrf @method('DELETE')
                                <button type="button" data-confirm-delete data-confirm-name="Polres {{ $polres->nama_polres }}" class="w-8 h-8 rounded border border-error/50 flex items-center justify-center text-error hover:bg-error-container transition-colors disabled:opacity-50 disabled:cursor-not-allowed" {{ $polres->respondens_count > 0 ? 'disabled title="Tidak dapat dihapus karena memiliki responden"' : 'title="Hapus"' }}>
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-4 text-on-surface-variant">Belum ada data Polres</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($polresList->hasPages())
    <div class="p-4 border-t border-outline-variant bg-white">
        {{ $polresList->links() }}
    </div>
    @endif
</div>
@endsection
