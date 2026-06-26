@extends('layouts.app')
@section('title', 'Halaman Tidak Ditemukan - 404')

@section('content')
<section class="flex-1 w-full flex items-center justify-center bg-surface py-16 md:py-24 my-auto">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="w-24 h-24 rounded-full bg-primary-container/20 flex items-center justify-center mx-auto mb-6 border border-primary-container/50">
            <span class="material-symbols-outlined text-primary text-[48px]">search_off</span>
        </div>
        <h1 class="font-display-lg text-6xl md:text-8xl text-primary font-bold mb-4 tracking-tight">404</h1>
        <h2 class="font-display-md text-2xl md:text-3xl text-primary mb-4 font-bold">Halaman Tidak Ditemukan</h2>
        <p class="font-body-md text-lg text-on-surface-variant mb-8">
            Maaf, halaman yang Anda tuju tidak tersedia atau telah dipindahkan.
        </p>
        <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 bg-primary text-white font-label-md text-base px-8 h-[48px] rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-sm">
            <span class="material-symbols-outlined text-[20px]">home</span>
            Kembali ke Beranda
        </a>
    </div>
</section>
@endsection
