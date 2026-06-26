<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>@yield('title', 'Evaluasi Mandiri - SAKTI')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" />
    @include('layouts.tailwind')
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    @stack('styles')
</head>

<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="w-full bg-surface-container-lowest border-b border-outline-variant py-2 sticky top-0 z-50"
        x-data="{ mobileMenuOpen: false }">
        <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop flex items-center justify-between h-[48px] md:h-[56px]">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[28px]"
                    style="font-variation-settings: 'FILL' 1;">assured_workload</span>
                <span class="font-display-sm text-lg md:text-[22px] font-bold text-primary hidden sm:block">SISTEM
                    EVALUASI SAKTI</span>
                <span class="font-display-sm text-lg font-bold text-primary sm:hidden">SI-EVASI</span>
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}"
                    class="font-label-md text-[13px] font-semibold text-primary hover:text-secondary transition-colors">Beranda</a>
                <a href="{{ route('panduan') }}"
                    class="font-label-md text-[13px] font-semibold text-on-surface-variant hover:text-primary transition-colors">Panduan</a>
                <a href="{{ route('home') }}#kontak"
                    class="font-label-md text-[13px] font-semibold text-on-surface-variant hover:text-primary transition-colors">Kontak</a>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center justify-center bg-primary-container text-white font-label-md text-[13px] px-4 h-[36px] rounded-md hover:bg-primary transition-colors gap-2 ml-2 shadow-sm">
                    <span class="material-symbols-outlined" style="font-size: 16px;">login</span>
                    Login Admin
                </a>
            </nav>

            <!-- Mobile: Hamburger Button -->
            <div class="flex md:hidden items-center gap-2">
                <button @click="mobileMenuOpen = !mobileMenuOpen"
                    class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-surface-container-low text-on-surface-variant transition-colors"
                    aria-label="Menu">
                    <span class="material-symbols-outlined text-[24px]" x-text="mobileMenuOpen ? 'close' : 'menu'"></span>
                </button>
            </div>
        </div>

        <!-- Mobile Dropdown Menu -->
        <div x-show="mobileMenuOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-surface-container-lowest border-t border-outline-variant shadow-md"
             @click.away="mobileMenuOpen = false">
            <nav class="flex flex-col px-4 py-3 gap-1">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md text-[13px] font-semibold text-primary hover:bg-surface-container-low transition-colors">
                    <span class="material-symbols-outlined text-[18px]">home</span>
                    Beranda
                </a>
                <a href="{{ route('panduan') }}" @click="mobileMenuOpen = false"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md text-[13px] font-semibold text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[18px]">menu_book</span>
                    Panduan
                </a>
                <a href="{{ route('home') }}#kontak" @click="mobileMenuOpen = false"
                    class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md text-[13px] font-semibold text-on-surface-variant hover:bg-surface-container-low hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-[18px]">call</span>
                    Kontak
                </a>
                <div class="border-t border-outline-variant my-1"></div>
                <a href="{{ route('login') }}" @click="mobileMenuOpen = false"
                    class="flex items-center justify-center gap-2 bg-primary text-white font-label-md text-[13px] px-4 h-[40px] rounded-lg hover:bg-primary/90 transition-colors shadow-sm">
                    <span class="material-symbols-outlined text-[16px]">login</span>
                    Login Admin
                </a>
            </nav>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="flex-1 w-full bg-background flex flex-col">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer id="kontak"
        class="bg-surface-container-lowest w-full border-t border-outline-variant mt-auto scroll-mt-[60px]">
        <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop py-12">
            <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-12">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[24px]"
                            style="font-variation-settings: 'FILL' 1;">assured_workload</span>
                        <span class="font-display-sm text-[18px] font-bold text-primary">SISTEM EVALUASI SAKTI</span>
                    </div>
                    <p class="font-body-md text-sm text-on-surface-variant max-w-xs mt-2">
                        Portal Evaluasi Kinerja Internal Kepolisian
                    </p>
                    <div class="mt-4 flex items-start gap-3">
                        <span class="material-symbols-outlined text-primary text-[20px] mt-0.5">support_agent</span>
                        <div>
                            <p class="font-label-md text-xs font-semibold text-on-surface-variant mb-1">Layanan Bantuan
                                Teknis</p>
                            <p class="font-display-sm text-base font-bold text-primary">0812 1554 3127</p>
                        </div>
                    </div>
                </div>
                <nav class="grid grid-cols-2 md:flex md:gap-12 gap-x-12 gap-y-4">
                    <div class="flex flex-col gap-4">
                        <a class="font-label-md text-[13px] font-semibold text-on-surface hover:text-primary transition-colors"
                            href="{{ route('home') }}">Beranda</a>
                        <a class="font-label-md text-[13px] font-semibold text-on-surface hover:text-primary transition-colors"
                            href="{{ route('panduan') }}">Panduan</a>
                    </div>
                    <div class="flex flex-col gap-4">
                        <a class="font-label-md text-[13px] font-semibold text-on-surface hover:text-primary transition-colors"
                            href="{{ route('home') }}#kontak">Kontak</a>
                        <a class="font-label-md text-[13px] font-semibold text-on-surface hover:text-primary transition-colors"
                            href="#">Kebijakan Privasi</a>
                    </div>
                </nav>
            </div>
            <div class="pt-8 border-t border-outline-variant">
                <p class="font-label-sm text-[12px] font-semibold text-on-surface-variant text-center md:text-left">
                    &copy; {{ date('Y') }} Sistem Evaluasi SAKTI - Institusi Pemerintah Republik Indonesia
                </p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <!-- Floating WhatsApp Button -->
    <a href="https://wa.me/6281215543127?text=Halo%20saya%20memiliki%20kendala%20terkait%20pengisian%20kuesioner%20SI-EVASI..."
        target="_blank"
        class="fixed bottom-6 right-6 md:bottom-10 md:right-10 z-[100] bg-[#2D9E6B] hover:bg-[#2D9E6B]/90 text-white transition-transform hover:scale-105 flex items-center justify-center"
        style="width: 60px !important; height: 60px !important; border-radius: 50% !important; padding: 0 !important; box-shadow: 0 4px 12px rgba(45,158,107,0.4);"
        title="Hubungi Layanan Bantuan">
        <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z" />
        </svg>
    </a>
</body>

</html>