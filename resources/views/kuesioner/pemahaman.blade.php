@extends('layouts.app')
@section('title', 'Kuesioner Pemahaman Pengguna - SAKTI')

@section('content')
<div class="w-full max-w-4xl mx-auto my-auto py-8 px-4 space-y-stack-lg shrink-0">
    <!-- Header & Progress -->
    <div class="space-y-4">
        <div>
            <h2 class="font-display-lg text-display-lg text-on-surface">Kuesioner Pemahaman Pengguna</h2>
            <p class="font-body-lg text-body-lg text-on-surface-variant mt-1">Silakan isi kuesioner berikut untuk mengevaluasi pemahaman Anda terhadap fitur SAKTI.</p>
        </div>
        <div class="bg-surface-container-low p-4 rounded-lg border border-outline-variant flex flex-col gap-2 shadow-[0_1px_4px_rgba(0,0,0,0.05)]">
            <div class="flex justify-between items-center text-label-sm font-label-sm text-on-surface-variant">
                <span>Langkah 1 dari 3 — Pemahaman Pengguna</span>
                <span>1</span>
            </div>
            <div class="w-full bg-surface-variant rounded-full h-2.5">
                <div class="bg-[#2E6DA4] h-2.5 rounded-full" style="width: 33%"></div>
            </div>
        </div>
    </div>

    <!-- Questionnaire Form -->
    <form action="{{ route('kuesioner.storePemahaman', $responden->kode_responden) }}" method="POST" class="space-y-stack-lg" x-data="{
        answers: {},
        totalQuestions: {{ $pertanyaans->count() }},
        get isComplete() { return Object.keys(this.answers).length === this.totalQuestions; }
    }">
        @csrf
        
        <div class="space-y-4">
            @foreach($pertanyaans as $p)
            <div class="bg-white rounded-[8px] border border-[#DDE3EC] shadow-[0_1px_4px_rgba(0,0,0,0.05)] p-4 sm:p-6 flex flex-col md:flex-row gap-4 md:items-center justify-between">
                <p class="font-body-md text-body-md text-on-surface flex-1">
                    {{ $p->nomor_item }}. {{ $p->teks_pertanyaan }}
                </p>
                <div class="flex gap-2 justify-between md:justify-end shrink-0">
                    @foreach([1=>'STS', 2=>'TS', 3=>'N', 4=>'S', 5=>'SS'] as $val => $label)
                    <label class="cursor-pointer relative">
                        <input type="radio" name="jawaban[{{ $p->id_pertanyaan }}]" value="{{ $val }}" class="custom-radio sr-only" required x-model="answers[{{ $p->id_pertanyaan }}]">
                        <div class="w-[40px] h-[40px] rounded border border-[#DDE3EC] flex items-center justify-center font-label-md text-label-md text-on-surface-variant transition-colors hover:bg-surface-container-low">
                            {{ $label }}
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <!-- Actions -->
        <div class="pt-6 flex justify-end gap-4 border-t border-outline-variant">
            <button type="submit" x-bind:disabled="!isComplete" class="h-[40px] px-6 rounded bg-[#1B3A5C] text-white font-label-md text-label-md disabled:opacity-50 disabled:cursor-not-allowed hover:bg-primary transition-colors flex items-center gap-2">
                Selanjutnya (TAM)
                <span class="material-symbols-outlined text-[18px]">arrow_forward</span>
            </button>
        </div>
    </form>
</div>
@endsection
