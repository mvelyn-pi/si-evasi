@extends('layouts.app')
@section('title', 'Akses Ditolak - 403')

@section('content')
<section class="flex-1 w-full flex items-center justify-center bg-surface py-16 md:py-24 my-auto">
    <div class="max-w-2xl mx-auto px-4 text-center">
        <div class="w-24 h-24 rounded-full bg-[#fce7f3] flex items-center justify-center mx-auto mb-6 border border-[#fbcfe8]">
            <span class="material-symbols-outlined text-[#9d174d] text-[48px]">block</span>
        </div>
        <h1 class="font-display-lg text-6xl md:text-8xl text-[#9d174d] font-bold mb-4 tracking-tight">403</h1>
        <h2 class="font-display-md text-2xl md:text-3xl text-primary mb-4 font-bold">Akses Ditolak</h2>
        <p class="font-body-md text-lg text-on-surface-variant mb-8">
            Maaf, Anda tidak memiliki izin yang sesuai untuk mengakses halaman ini.
        </p>
        <a href="{{ route('home') }}" class="inline-flex items-center justify-center gap-2 bg-primary text-white font-label-md text-base px-8 h-[48px] rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-sm">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Kembali ke Beranda
        </a>
    </div>
</section>
@endsection
