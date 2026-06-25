@extends('layouts.admin')
@section('title', 'Edit Data Polres')
@section('page-title', 'Edit Data Polres')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.polres.index') }}" class="inline-flex items-center gap-1 text-sm font-label-md text-on-surface-variant hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Data Polres
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden max-w-2xl">
    <div class="p-5 border-b border-outline-variant bg-surface-bright">
        <h3 class="font-display-sm text-display-sm text-primary font-semibold">Form Edit Polres</h3>
    </div>
    
    <form action="{{ route('admin.polres.update', $polre) }}" method="POST" class="p-5 flex flex-col gap-4">
        @csrf
        @method('PUT')
        
        <div class="flex flex-col gap-2">
            <label for="nama_polres" class="font-label-md text-label-md text-on-surface-variant">Nama Polres <span class="text-error">*</span></label>
            <input type="text" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('nama_polres') border-error @enderror" id="nama_polres" name="nama_polres" value="{{ old('nama_polres', $polre->nama_polres) }}" required>
            @error('nama_polres')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label for="wilayah" class="font-label-md text-label-md text-on-surface-variant">Wilayah <span class="text-error">*</span></label>
            <input type="text" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('wilayah') border-error @enderror" id="wilayah" name="wilayah" value="{{ old('wilayah', $polre->wilayah) }}" required>
            @error('wilayah')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="pt-4 flex justify-end gap-3 mt-2">
            <a href="{{ route('admin.polres.index') }}" class="h-[40px] px-4 rounded border border-outline-variant text-on-surface-variant font-label-md flex items-center justify-center hover:bg-surface-container-low transition-colors">
                Batal
            </a>
            <button type="submit" class="h-[40px] px-6 rounded bg-primary hover:bg-primary/90 text-white font-label-md flex items-center justify-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Perbarui
            </button>
        </div>
    </form>
</div>
@endsection
