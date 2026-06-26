@extends('layouts.app')
@section('title', 'Sistem Evaluasi SAKTI - Beranda')

@section('content')
<!-- Hero Section -->
<section class="w-full py-16 md:py-24 border-b border-surface-variant bg-surface-container-lowest">
    <div class="max-w-container-max mx-auto px-4 sm:px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <!-- Text Content -->
        <div class="flex flex-col items-start max-w-2xl">
            <div class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-container/20 border border-secondary-container/50 mb-6">
                <span class="font-label-sm text-label-sm text-on-secondary-container">Portal Evaluasi Resmi</span>
            </div>
            <h1 class="font-display-lg text-[2rem] md:text-[2.5rem] text-primary mb-stack-md leading-tight font-bold">
                Sistem Evaluasi Penggunaan Aplikasi SAKTI
            </h1>
            <p class="font-body-lg text-lg text-on-surface-variant mb-8 max-w-xl">
                Kepolisian Resor Se-Sulawesi Selatan
            </p>
            <a class="inline-flex items-center justify-center bg-primary-container text-white font-label-md text-base px-6 h-[48px] rounded-lg hover:bg-primary transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary-container shadow-sm hover:shadow" href="{{ route('kuesioner.mulai') }}">
                Mulai Pengisian Kuesioner &rarr;
            </a>
        </div>
        <!-- Hero Image (Institutional context) -->
        <div class="relative w-full aspect-[4/3] rounded-xl overflow-hidden border border-outline-variant shadow-sm bg-surface-container-low">
            <img alt="Hero Image" class="w-full h-full object-cover" src="https://images.unsplash.com/photo-1497366216548-37526070297c?auto=format&fit=crop&q=80">
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="w-full py-16 md:py-24 bg-surface flex-1">
    <div class="max-w-container-max mx-auto px-4 sm:px-margin-mobile md:px-margin-desktop">
        <div class="text-center mb-12">
            <h2 class="font-display-md text-2xl md:text-3xl font-bold text-primary mb-stack-sm">Aspek Evaluasi Komprehensif</h2>
            <p class="font-body-md text-base text-on-surface-variant max-w-2xl mx-auto">
                Pengukuran efektivitas sistem dilakukan melalui tiga pilar utama untuk memastikan keandalan dan kenyamanan operasional.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Feature 1 -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center mb-6 border border-surface-variant">
                    <span class="material-symbols-outlined text-secondary text-[28px]">psychology</span>
                </div>
                <h3 class="font-display-sm text-xl font-bold text-primary mb-stack-sm">Pemahaman Pengguna</h3>
                <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                    Mengukur tingkat literasi dan kapasitas aparatur dalam mengoperasikan modul-modul finansial pada aplikasi SAKTI.
                </p>
            </div>
            <!-- Feature 2 -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center mb-6 border border-surface-variant">
                    <span class="material-symbols-outlined text-secondary text-[28px]">devices</span>
                </div>
                <h3 class="font-display-sm text-xl font-bold text-primary mb-stack-sm">Penerimaan Teknologi (TAM)</h3>
                <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                    Evaluasi berdasarkan Technology Acceptance Model untuk menilai persepsi kemudahan penggunaan dan kemanfaatan sistem.
                </p>
            </div>
            <!-- Feature 3 -->
            <div class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow">
                <div class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center mb-6 border border-surface-variant">
                    <span class="material-symbols-outlined text-secondary text-[28px]">touch_app</span>
                </div>
                <h3 class="font-display-sm text-xl font-bold text-primary mb-stack-sm">Usabilitas Sistem (SUS)</h3>
                <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                    Pengukuran menggunakan System Usability Scale untuk menentukan tingkat keandalan antarmuka dan interaksi pengguna.
                </p>
            </div>
        </div>
    </div>
</section>

@endsection
