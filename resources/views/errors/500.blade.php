@extends('layouts.app')
@section('title', 'Kesalahan Server - 500')

@section('content')
<section class="flex-1 w-full flex items-center justify-center bg-surface py-16 md:py-24 my-auto">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="w-24 h-24 rounded-full bg-[#fee2e2] flex items-center justify-center mx-auto mb-6 border border-[#fecaca]">
            <span class="material-symbols-outlined text-[#991b1b] text-[48px]">error</span>
        </div>
        <h1 class="font-display-lg text-6xl md:text-8xl text-[#991b1b] font-bold mb-4 tracking-tight">500</h1>
        <h2 class="font-display-md text-2xl md:text-3xl text-primary mb-4 font-bold">Kesalahan Server Internal</h2>
        <p class="font-body-md text-lg text-on-surface-variant mb-8">
            Maaf, telah terjadi kesalahan pada server kami saat memproses permintaan Anda. Silakan coba kembali beberapa saat lagi.
        </p>
        <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 bg-primary text-white font-label-md text-base px-8 h-[48px] rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-sm">
            <span class="material-symbols-outlined text-[20px]">refresh</span>
            Coba Lagi (Beranda)
        </a>
    </div>
</section>
@endsection
