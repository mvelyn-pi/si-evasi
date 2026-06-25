<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>@yield('title', 'Evaluasi Mandiri - SAKTI')</title>
    @include('layouts.tailwind')
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    @stack('styles')
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
    <!-- Navbar -->
    <header class="w-full bg-surface-container-lowest border-b border-outline-variant py-2 sticky top-0 z-50">
        <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop flex items-center justify-between h-[48px] md:h-[56px]">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary text-[28px]" style="font-variation-settings: 'FILL' 1;">assured_workload</span>
                <span class="font-display-sm text-lg md:text-[22px] font-bold text-primary hidden sm:block">SISTEM EVALUASI SAKTI</span>
                <span class="font-display-sm text-lg font-bold text-primary sm:hidden">SI-EVASI</span>
            </div>
            
            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-6">
                <a href="{{ route('home') }}" class="font-label-md text-[13px] font-semibold text-primary hover:text-secondary transition-colors">Beranda</a>
                <a href="#" class="font-label-md text-[13px] font-semibold text-on-surface-variant hover:text-primary transition-colors">Panduan</a>
                <a href="#" class="font-label-md text-[13px] font-semibold text-on-surface-variant hover:text-primary transition-colors">Kontak</a>
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-primary-container text-white font-label-md text-[13px] px-4 h-[36px] rounded-md hover:bg-primary transition-colors gap-2 ml-2 shadow-sm">
                    <span class="material-symbols-outlined" style="font-size: 16px;">login</span>
                    Login Admin
                </a>
            </nav>

            <!-- Mobile Nav -->
            <div class="flex md:hidden items-center">
                <a href="{{ route('login') }}" class="inline-flex items-center justify-center bg-primary-container text-white font-label-md text-[13px] px-4 h-[36px] rounded-md hover:bg-primary transition-colors shadow-sm">
                    Login
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content Canvas -->
    <main class="flex-1 w-full bg-background flex flex-col">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-surface-container-lowest w-full border-t border-outline-variant mt-auto">
        <div class="max-w-container-max mx-auto px-4 md:px-margin-desktop py-12">
            <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-12">
                <div class="flex flex-col gap-2">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary text-[24px]" style="font-variation-settings: 'FILL' 1;">assured_workload</span>
                        <span class="font-display-sm text-[18px] font-bold text-primary">SISTEM EVALUASI SAKTI</span>
                    </div>
                    <p class="font-body-md text-sm text-on-surface-variant max-w-xs mt-2">
                        Portal Evaluasi Kinerja Internal Kepolisian
                    </p>
                </div>
                <nav class="grid grid-cols-2 md:flex md:gap-12 gap-x-12 gap-y-4">
                    <div class="flex flex-col gap-4">
                        <a class="font-label-md text-[13px] font-semibold text-on-surface hover:text-primary transition-colors" href="{{ route('home') }}">Beranda</a>
                        <a class="font-label-md text-[13px] font-semibold text-on-surface hover:text-primary transition-colors" href="#">Panduan</a>
                    </div>
                    <div class="flex flex-col gap-4">
                        <a class="font-label-md text-[13px] font-semibold text-on-surface hover:text-primary transition-colors" href="#">Kontak</a>
                        <a class="font-label-md text-[13px] font-semibold text-on-surface hover:text-primary transition-colors" href="#">Kebijakan Privasi</a>
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
</body>
</html>
