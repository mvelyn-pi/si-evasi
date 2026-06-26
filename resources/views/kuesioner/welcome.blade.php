@extends('layouts.app')
@section('title', 'Beranda')

@section('content')
    <!-- Hero Section -->
    <section class="w-full py-16 md:py-24 border-b border-surface-variant">
        <div
            class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <!-- Text Content -->
            <div class="flex flex-col items-start max-w-2xl">
                <div
                    class="inline-flex items-center px-3 py-1 rounded-full bg-secondary-container/20 border border-secondary-container/50 mb-6">
                    <span class="font-label-sm text-label-sm text-on-secondary-container">Portal Evaluasi Resmi</span>
                </div>
                <h1 class="font-display-lg text-display-lg text-primary mb-stack-md leading-tight">
                    Sistem Evaluasi Penggunaan Aplikasi SAKTI
                </h1>
                <p class="font-body-lg text-body-lg text-on-surface-variant mb-8 max-w-xl">
                    Kepolisian Resor Se-Sulawesi Selatan
                </p>
                <a href="{{ route('kuesioner.mulai') }}" id="btn-isi-kuesioner"
                    class="inline-flex items-center justify-center bg-primary-container text-white font-label-md text-label-md px-6 h-[40px] rounded-lg hover:bg-primary transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-primary-container">
                    Mulai Pengisian Kuesioner →
                </a>
            </div>

            <!-- Hero Image (Institutional context) -->
            <div
                class="relative w-full aspect-[4/3] rounded-xl overflow-hidden border border-outline-variant shadow-sm bg-surface-container-low">
                <img alt="Hero Image" class="w-full h-full object-cover"
                    data-alt="A high-quality, professional photograph of a modern government administrative office in Indonesia. The scene shows focused officers in neat uniforms or formal attire working diligently on computer terminals. The environment is well-lit with natural daylight, featuring a clean, minimalist interior with subtle blue accents matching a corporate government identity. The mood is serious, secure, and highly official, representing the rigorous evaluation of the SAKTI financial system."
                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuCjtGI5Yia_OTg-gr5WPlWqr0ti7E250bfM0MtbbZO2N_L8c5_Xw6SkUsuAkaL3MpWx5AfpQCvjdhuk1JfKMJEMZcxMU35MWd0uZ4ZcDXYZAHV4Z7AF_pstkTal14ax_0Zgcu7IKrJk2_ldIMlBeAoi9Rrcalx2IbIcb0s2jKkrw4DlRVfH4B5TxgDjmca60FzyNbykQ-qTZKH4731RSnSr09QJLnnHWkRJFUDgDVa89mN2fxSDfuQ-KP2inar8eAmUG1Da3RlKIqZl">
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="w-full py-16 md:py-24 bg-surface">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop">
            <div class="text-center mb-12">
                <h2 class="font-display-md text-display-md text-primary mb-stack-sm">Aspek Evaluasi Komprehensif</h2>
                <p class="font-body-md text-body-md text-on-surface-variant max-w-2xl mx-auto">
                    Pengukuran efektivitas sistem dilakukan melalui tiga pilar utama untuk memastikan keandalan dan
                    kenyamanan operasional.
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-gutter">
                <!-- Feature 1 -->
                <div
                    class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow">
                    <div
                        class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center mb-6 border border-surface-variant">
                        <span class="material-symbols-outlined text-secondary text-[28px]">psychology</span>
                    </div>
                    <h3 class="font-display-sm text-display-sm text-primary mb-stack-sm">Pemahaman Pengguna</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Mengukur tingkat literasi dan kapasitas aparatur dalam mengoperasikan modul-modul finansial pada
                        aplikasi SAKTI.
                    </p>
                </div>
                <!-- Feature 2 -->
                <div
                    class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow">
                    <div
                        class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center mb-6 border border-surface-variant">
                        <span class="material-symbols-outlined text-secondary text-[28px]">devices</span>
                    </div>
                    <h3 class="font-display-sm text-display-sm text-primary mb-stack-sm">Penerimaan Teknologi (TAM)</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Evaluasi berdasarkan Technology Acceptance Model untuk menilai persepsi kemudahan penggunaan dan
                        kemanfaatan sistem.
                    </p>
                </div>
                <!-- Feature 3 -->
                <div
                    class="bg-surface-container-lowest p-6 rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] hover:shadow-md transition-shadow">
                    <div
                        class="w-12 h-12 rounded-lg bg-surface-container flex items-center justify-center mb-6 border border-surface-variant">
                        <span class="material-symbols-outlined text-secondary text-[28px]">touch_app</span>
                    </div>
                    <h3 class="font-display-sm text-display-sm text-primary mb-stack-sm">Usabilitas Sistem (SUS)</h3>
                    <p class="font-body-md text-body-md text-on-surface-variant leading-relaxed">
                        Pengukuran menggunakan System Usability Scale untuk menentukan tingkat keandalan antarmuka dan
                        interaksi pengguna.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <!-- CTA Section -->
    <section class="w-full py-16 md:py-24 bg-primary">
        <div class="max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop text-center">
            <h2 class="font-display-md text-display-md text-on-primary mb-stack-sm">Partisipasi Anda Sangat Berarti</h2>
            <p class="font-body-lg text-body-lg text-primary-fixed max-w-xl mx-auto mb-8">
                Kuesioner ini bersifat anonim. Identitas Anda tidak akan terungkap dalam laporan penelitian manapun.
            </p>
            <a href="{{ route('kuesioner.mulai') }}" id="btn-mulai-bottom"
                class="inline-flex items-center justify-center gap-2 bg-surface-container-lowest text-primary font-label-md text-label-md px-8 h-[48px] rounded-lg hover:bg-surface-container transition-colors focus:ring-2 focus:ring-offset-2 focus:ring-on-primary">
                <span class="material-symbols-outlined text-[20px]">edit_square</span>
                Mulai Mengisi Kuesioner Sekarang
            </a>
        </div>
    </section>


@endsection