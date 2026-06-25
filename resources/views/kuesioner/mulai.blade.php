@extends('layouts.app')
@section('title', 'Data Identitas Responden - SAKTI')

@section('content')
<div class="w-full max-w-2xl mx-auto my-auto py-8 px-4 shrink-0">
    <!-- Form Card Container -->
    <div class="bg-surface-container-lowest w-full rounded-[8px] border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden">
        <!-- Card Header -->
        <div class="px-6 py-8 sm:px-10 border-b border-outline-variant bg-surface-bright">
            <h1 class="font-display-md text-display-md text-primary mb-2">Data Identitas Responden</h1>
            <div class="flex items-start gap-2 bg-primary-fixed/30 p-3 rounded-md border border-primary-fixed-dim mt-4">
                <span class="material-symbols-outlined text-secondary mt-0.5" style="font-size: 18px;">shield_lock</span>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Identitas dilindungi menggunakan kode responden anonim. Data yang Anda masukkan hanya digunakan untuk keperluan evaluasi sistem.
                </p>
            </div>
        </div>
        <!-- Card Body / Form -->
        <form action="{{ route('kuesioner.storeMulai') }}" method="POST" class="px-6 py-8 sm:px-10 flex flex-col gap-[20px]">
            @csrf

            <!-- Field: Polres -->
            <div class="flex flex-col gap-2">
                <label class="font-label-md text-label-md text-on-surface-variant" for="id_polres">Pilih Polres</label>
                <div class="relative">
                    <select class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface appearance-none cursor-pointer @error('id_polres') border-error @enderror" id="id_polres" name="id_polres" required>
                        <option disabled selected value="">Pilih instansi Anda bertugas</option>
                        @foreach($polresList as $p)
                            <option value="{{ $p->id_polres }}" {{ old('id_polres') == $p->id_polres ? 'selected' : '' }}>{{ $p->nama_polres }}</option>
                        @endforeach
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                </div>
                @error('id_polres')<div class="text-error font-label-sm">{{ $message }}</div>@enderror
            </div>

            <!-- Field: Jabatan/Fungsi -->
            <div class="flex flex-col gap-2">
                <label class="font-label-md text-label-md text-on-surface-variant" for="jabatan">Jabatan/Fungsi</label>
                <input class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('jabatan') border-error @enderror" id="jabatan" name="jabatan" placeholder="Contoh: Kasat Reskrim / Operator SAKTI" type="text" value="{{ old('jabatan') }}" required/>
                @error('jabatan')<div class="text-error font-label-sm">{{ $message }}</div>@enderror
            </div>

            <!-- Field: Lama Penggunaan SAKTI -->
            <div class="flex flex-col gap-2">
                <label class="font-label-md text-label-md text-on-surface-variant" for="lama_penggunaan">Lama Penggunaan SAKTI</label>
                <div class="relative">
                    <select class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface appearance-none cursor-pointer @error('lama_penggunaan') border-error @enderror" id="lama_penggunaan" name="lama_penggunaan" required>
                        <option disabled selected value="">Pilih durasi penggunaan</option>
                        <option value="< 1 tahun" {{ old('lama_penggunaan') == '< 1 tahun' ? 'selected' : '' }}>Kurang dari 1 Tahun</option>
                        <option value="1–3 tahun" {{ old('lama_penggunaan') == '1–3 tahun' ? 'selected' : '' }}>1 - 3 Tahun</option>
                        <option value="> 3 tahun" {{ old('lama_penggunaan') == '> 3 tahun' ? 'selected' : '' }}>Lebih dari 3 Tahun</option>
                    </select>
                    <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
                </div>
                @error('lama_penggunaan')<div class="text-error font-label-sm">{{ $message }}</div>@enderror
            </div>

            <!-- Field: Frekuensi Penggunaan (Radio) -->
            <div class="flex flex-col gap-2">
                <label class="font-label-md text-label-md text-on-surface-variant">Frekuensi Penggunaan</label>
                <div class="flex flex-col gap-3 mt-1">
                    @foreach(['Harian' => 'Setiap Hari', 'Mingguan' => 'Beberapa kali seminggu', 'Bulanan' => 'Jarang (Hanya saat dibutuhkan)'] as $val => $label)
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input class="w-4 h-4 text-primary bg-surface-container-lowest border-outline-variant focus:ring-primary focus:ring-offset-0 rounded-full" name="frekuensi_penggunaan" type="radio" value="{{ $val }}" {{ old('frekuensi_penggunaan') == $val ? 'checked' : '' }} required/>
                        <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">{{ $label }}</span>
                    </label>
                    @endforeach
                </div>
                @error('frekuensi_penggunaan')<div class="text-error font-label-sm">{{ $message }}</div>@enderror
            </div>

            <!-- Field: Pernah Mengikuti Pelatihan (Radio) -->
            <div class="flex flex-col gap-2">
                <label class="font-label-md text-label-md text-on-surface-variant">Pernah Mengikuti Pelatihan SAKTI?</label>
                <div class="flex gap-6 mt-1">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input class="w-4 h-4 text-primary bg-surface-container-lowest border-outline-variant focus:ring-primary focus:ring-offset-0 rounded-full" name="pelatihan_sakti" type="radio" value="Pernah" {{ old('pelatihan_sakti') == 'Pernah' ? 'checked' : '' }} required/>
                        <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Ya, Pernah</span>
                    </label>
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <input class="w-4 h-4 text-primary bg-surface-container-lowest border-outline-variant focus:ring-primary focus:ring-offset-0 rounded-full" name="pelatihan_sakti" type="radio" value="Belum" {{ old('pelatihan_sakti') == 'Belum' ? 'checked' : '' }} required/>
                        <span class="font-body-md text-body-md text-on-surface group-hover:text-primary transition-colors">Tidak Pernah</span>
                    </label>
                </div>
                @error('pelatihan_sakti')<div class="text-error font-label-sm">{{ $message }}</div>@enderror
            </div>

            <!-- Action Area -->
            <div class="pt-6 mt-2 border-t border-outline-variant flex justify-end">
                <button type="submit" class="h-[40px] px-6 bg-[#1B3A5C] hover:bg-primary text-white font-label-md text-label-md rounded-[4px] transition-colors flex items-center justify-center gap-2 group shadow-sm">
                    Lanjutkan ke Kuesioner
                    <span class="material-symbols-outlined text-[18px] group-hover:translate-x-1 transition-transform">arrow_forward</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
