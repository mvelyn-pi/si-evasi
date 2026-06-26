@extends('layouts.app')
@section('title', 'Sistem Evaluasi SAKTI - Panduan')

@section('content')
    <section class="w-full py-12 md:py-16 border-b border-surface-variant bg-surface-container-lowest">
        <div class="max-w-container-max mx-auto px-4 sm:px-margin-mobile md:px-margin-desktop text-center">
            <h1 class="font-display-lg text-[2rem] md:text-[2.5rem] text-primary mb-stack-sm leading-tight font-bold">
                Panduan Penggunaan SI-EVASI
            </h1>
            <p class="font-body-lg text-lg text-on-surface-variant max-w-2xl mx-auto">
                Langkah-langkah pengisian kuesioner evaluasi aplikasi SAKTI bagi responden di lingkungan Kepolisian Resor
                Se-Sulawesi Selatan.
            </p>
        </div>
    </section>

    <section class="w-full py-16 bg-surface flex-1">
        <div class="max-w-3xl mx-auto px-4 sm:px-margin-mobile md:px-margin-desktop">
            <div
                class="space-y-8 relative before:absolute before:inset-0 before:ml-6 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-outline-variant before:to-transparent">

                <!-- Step 1 -->
                <div
                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-surface bg-primary text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-sm relative z-10">
                        1
                    </div>
                    <div
                        class="w-[calc(100%-4rem)] md:w-[calc(50%-3rem)] bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm ml-4 md:ml-0 md:group-odd:text-right hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3 md:group-odd:justify-end">
                            <span class="material-symbols-outlined text-secondary">badge</span>
                            <h3 class="font-display-sm text-lg font-bold text-primary">Isi Identitas Diri</h3>
                        </div>
                        <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                            Klik tombol <strong>"Mulai Pengisian Kuesioner"</strong> di halaman beranda. Masukkan beberapa
                            data yang tersedia dihalaman tersebut.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div
                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-surface bg-primary text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-sm relative z-10">
                        2
                    </div>
                    <div
                        class="w-[calc(100%-4rem)] md:w-[calc(50%-3rem)] bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm ml-4 md:ml-0 md:group-odd:text-right hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3 md:group-odd:justify-end">
                            <span class="material-symbols-outlined text-secondary">psychology</span>
                            <h3 class="font-display-sm text-lg font-bold text-primary">Tahap 1: Pemahaman</h3>
                        </div>
                        <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                            Jawab daftar pertanyaan mengenai tingkat pemahaman Anda terhadap fitur dan prosedur penggunaan
                            aplikasi SAKTI.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div
                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-surface bg-primary text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-sm relative z-10">
                        3
                    </div>
                    <div
                        class="w-[calc(100%-4rem)] md:w-[calc(50%-3rem)] bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm ml-4 md:ml-0 md:group-odd:text-right hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3 md:group-odd:justify-end">
                            <span class="material-symbols-outlined text-secondary">devices</span>
                            <h3 class="font-display-sm text-lg font-bold text-primary">Tahap 2: Evaluasi TAM</h3>
                        </div>
                        <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                            Berikan penilaian Anda mengenai seberapa besar manfaat dan kemudahan (Technology Acceptance
                            Model) yang Anda rasakan selama menggunakan aplikasi.
                        </p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div
                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-surface bg-primary text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-sm relative z-10">
                        4
                    </div>
                    <div
                        class="w-[calc(100%-4rem)] md:w-[calc(50%-3rem)] bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm ml-4 md:ml-0 md:group-odd:text-right hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3 md:group-odd:justify-end">
                            <span class="material-symbols-outlined text-secondary">touch_app</span>
                            <h3 class="font-display-sm text-lg font-bold text-primary">Tahap 3: Evaluasi SUS</h3>
                        </div>
                        <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                            Jawab 10 pertanyaan standar System Usability Scale (SUS) untuk mengukur tingkat usabilitas dan
                            antarmuka aplikasi.
                        </p>
                    </div>
                </div>

                <!-- Step 5 -->
                <div
                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                    <div
                        class="flex items-center justify-center w-12 h-12 rounded-full border-4 border-surface bg-primary text-white font-bold shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 shadow-sm relative z-10">
                        5
                    </div>
                    <div
                        class="w-[calc(100%-4rem)] md:w-[calc(50%-3rem)] bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-sm ml-4 md:ml-0 md:group-odd:text-right hover:shadow-md transition-shadow">
                        <div class="flex items-center gap-3 mb-3 md:group-odd:justify-end">
                            <span class="material-symbols-outlined text-[28px] text-[#2D9E6B]">task_alt</span>
                            <h3 class="font-display-sm text-lg font-bold text-primary">Selesai</h3>
                        </div>
                        <p class="font-body-md text-sm text-on-surface-variant leading-relaxed">
                            Setelah semua tahapan selesai, Anda akan menerima konfirmasi. Data Anda akan disimpan secara
                            aman dan digunakan untuk peningkatan aplikasi di masa mendatang.
                        </p>
                    </div>
                </div>

            </div>

            <div class="mt-16 text-center">
                <a class="inline-flex items-center justify-center bg-primary-container text-white font-label-md text-base px-8 h-[48px] rounded-lg hover:bg-primary transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary-container shadow-sm hover:shadow"
                    href="{{ route('kuesioner.mulai') }}">
                    Mulai Pengisian Kuesioner Sekarang &rarr;
                </a>
            </div>
        </div>
    </section>
@endsection