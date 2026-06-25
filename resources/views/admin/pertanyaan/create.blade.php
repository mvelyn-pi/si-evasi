@extends('layouts.admin')
@section('title', 'Tambah Pertanyaan')
@section('page-title', 'Tambah Pertanyaan')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.pertanyaan.index') }}" class="inline-flex items-center gap-1 text-sm font-label-md text-on-surface-variant hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Daftar Pertanyaan
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden max-w-3xl">
    <div class="p-5 border-b border-outline-variant bg-surface-bright">
        <h3 class="font-display-sm text-display-sm text-primary font-semibold">Form Tambah Pertanyaan</h3>
    </div>
    
    <form action="{{ route('admin.pertanyaan.store') }}" method="POST" class="p-5 flex flex-col gap-5" x-data="{ jenis: '{{ old('jenis_kuesioner', 'pemahaman') }}' }">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div class="flex flex-col gap-2">
                <label for="jenis_kuesioner" class="font-label-md text-label-md text-on-surface-variant">Jenis Kuesioner <span class="text-error">*</span></label>
                <div class="relative">
                    <select class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface appearance-none cursor-pointer @error('jenis_kuesioner') border-error @enderror" id="jenis_kuesioner" name="jenis_kuesioner" x-model="jenis" required>
                        <option value="pemahaman" {{ old('jenis_kuesioner') == 'pemahaman' ? 'selected' : '' }}>Pemahaman Pengguna</option>
                        <option value="tam" {{ old('jenis_kuesioner') == 'tam' ? 'selected' : '' }}>Technology Acceptance Model (TAM)</option>
                        <option value="sus" {{ old('jenis_kuesioner') == 'sus' ? 'selected' : '' }}>System Usability Scale (SUS)</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                </div>
                @error('jenis_kuesioner')
                    <div class="text-error font-label-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="nomor_item" class="font-label-md text-label-md text-on-surface-variant">Nomor Urut <span class="text-error">*</span></label>
                <input type="number" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('nomor_item') border-error @enderror" id="nomor_item" name="nomor_item" value="{{ old('nomor_item') }}" required>
                @error('nomor_item')
                    <div class="text-error font-label-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <template x-if="jenis === 'tam'">
            <div class="flex flex-col gap-2">
                <label for="konstruk" class="font-label-md text-label-md text-on-surface-variant">Konstruk TAM <span class="text-error">*</span></label>
                <div class="relative">
                    <select class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface appearance-none cursor-pointer @error('konstruk') border-error @enderror" id="konstruk" name="konstruk" :required="jenis === 'tam'">
                        <option value="Perceived Usefulness" {{ old('konstruk') == 'Perceived Usefulness' ? 'selected' : '' }}>Perceived Usefulness</option>
                        <option value="Perceived Ease of Use" {{ old('konstruk') == 'Perceived Ease of Use' ? 'selected' : '' }}>Perceived Ease of Use</option>
                        <option value="Attitude Toward Using" {{ old('konstruk') == 'Attitude Toward Using' ? 'selected' : '' }}>Attitude Toward Using</option>
                        <option value="Behavioral Intention" {{ old('konstruk') == 'Behavioral Intention' ? 'selected' : '' }}>Behavioral Intention</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                </div>
                @error('konstruk')
                    <div class="text-error font-label-sm mt-1">{{ $message }}</div>
                @enderror
            </div>
        </template>

        <div class="flex flex-col gap-2">
            <label for="teks_pertanyaan" class="font-label-md text-label-md text-on-surface-variant">Teks Pertanyaan <span class="text-error">*</span></label>
            <textarea class="custom-input w-full p-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('teks_pertanyaan') border-error @enderror" id="teks_pertanyaan" name="teks_pertanyaan" rows="3" required>{{ old('teks_pertanyaan') }}</textarea>
            @error('teks_pertanyaan')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <template x-if="jenis === 'sus'">
            <div class="flex items-center gap-3 mt-1">
                <input type="hidden" name="is_reverse" value="0">
                <input class="w-4 h-4 text-primary bg-surface-container-lowest border-outline-variant focus:ring-primary rounded" type="checkbox" id="is_reverse" name="is_reverse" value="1" {{ old('is_reverse') ? 'checked' : '' }}>
                <label class="font-body-md text-sm text-on-surface-variant cursor-pointer" for="is_reverse">Tandai sebagai Pertanyaan Reverse (Skor Dibalik)</label>
            </div>
        </template>

        <div class="flex flex-col gap-2 mt-2">
            <label for="status" class="font-label-md text-label-md text-on-surface-variant">Status</label>
            <div class="relative">
                <select class="custom-input w-full md:w-1/3 h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface appearance-none cursor-pointer @error('status') border-error @enderror" id="status" name="status">
                    <option value="aktif" {{ old('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none md:right-[68%]">expand_more</span>
            </div>
        </div>

        <div class="pt-4 flex justify-end gap-3 mt-2 border-t border-outline-variant">
            <a href="{{ route('admin.pertanyaan.index') }}" class="h-[40px] px-4 rounded border border-outline-variant text-on-surface-variant font-label-md flex items-center justify-center hover:bg-surface-container-low transition-colors">
                Batal
            </a>
            <button type="submit" class="h-[40px] px-6 rounded bg-primary hover:bg-primary/90 text-white font-label-md flex items-center justify-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
