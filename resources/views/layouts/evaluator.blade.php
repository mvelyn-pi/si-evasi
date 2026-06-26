<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Evaluator') | SI-EVASI</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" />
    @include('layouts.tailwind')
    <style>
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        @media (max-width: 768px) {
            .sidebar-hidden {
                transform: translateX(-100%);
            }
        }
    </style>
    @stack('styles')
</head>

<body class="bg-[#F5F7FA] text-on-surface font-body-md min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- SideNavBar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
        class="w-[260px] h-full fixed left-0 top-0 bg-primary dark:bg-primary-container text-on-primary font-body-md text-body-md border-r border-outline-variant flex flex-col h-screen overflow-y-auto px-stack-sm py-stack-md z-50 sidebar-transition">
        <div class="flex items-center gap-3 mb-8 px-4 mt-2 md:mt-0">
            <div class="w-10 h-10 rounded bg-white/20 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-white"
                    style="font-variation-settings: 'FILL' 1;">assured_workload</span>
            </div>
            <div>
                <h1 class="font-display-md text-[18px] font-bold text-white tracking-tight leading-tight">SI-EVASI</h1>
                <p class="text-white/70 font-label-sm text-xs">Sistem Evaluasi SAKTI</p>
            </div>
            <button class="md:hidden ml-auto text-white" @click="sidebarOpen = false">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <nav class="flex flex-col gap-1 flex-1">
            <div class="text-xs font-bold text-white/50 uppercase tracking-wider px-4 mt-2 mb-1">Utama</div>
            <a href="{{ route('evaluator.dashboard') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors duration-200 ease-in-out {{ request()->routeIs('evaluator.dashboard') ? 'text-white border-l-4 border-secondary-container bg-primary-container/50' : 'text-white/60 hover:text-white hover:bg-primary-container/30' }}">
                <span class="material-symbols-outlined" style="font-size:20px;">dashboard</span>
                Dashboard
            </a>

            <div class="text-xs font-bold text-white/50 uppercase tracking-wider px-4 mt-4 mb-1">Laporan</div>
            <a href="{{ route('evaluator.laporan.index') }}"
                class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-colors duration-200 ease-in-out {{ request()->routeIs('evaluator.laporan.*') ? 'text-white border-l-4 border-secondary-container bg-primary-container/50' : 'text-white/60 hover:text-white hover:bg-primary-container/30' }}">
                <span class="material-symbols-outlined" style="font-size:20px;">description</span>
                Laporan Evaluasi
            </a>
        </nav>
    </aside>

    <!-- Overlay -->
    <div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 bg-black/50 z-40 md:hidden"
        style="display: none;"></div>

    <!-- Main Content Wrapper -->
    <div class="md:ml-[260px] flex flex-col flex-1 min-h-screen w-full">
        <!-- TopNavBar -->
        <header
            class="h-[60px] w-full sticky top-0 bg-surface text-primary font-label-md text-label-md border-b border-outline-variant shadow-sm flex items-center justify-between px-4 md:px-margin-desktop z-10">
            <div class="flex items-center gap-3">
                <button
                    class="md:hidden flex items-center justify-center w-10 h-10 rounded-full hover:bg-surface-container-low text-on-surface-variant"
                    @click="sidebarOpen = true">
                    <span class="material-symbols-outlined">menu</span>
                </button>
                <h1 class="font-display-sm text-display-sm font-bold m-0 hidden sm:block">
                    @yield('page-title', 'Dashboard Evaluator')</h1>
            </div>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2">
                    <div
                        class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center font-bold text-xs">
                        {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                    </div>
                    <div class="hidden md:flex flex-col">
                        <span class="text-sm font-medium leading-tight">{{ auth()->user()->name }}</span>
                    </div>
                    <form method="POST" action="{{ route('logout') }}" class="ml-2">
                        @csrf
                        <button type="submit"
                            class="w-8 h-8 rounded-full flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors tooltip-wrapper"
                            title="Logout">
                            <span class="material-symbols-outlined" style="font-size: 20px;">logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </header>

        <!-- Main Content Area -->
        <main
            class="p-4 md:p-margin-desktop max-w-container-max mx-auto w-full flex-1 flex flex-col gap-gutter overflow-x-hidden">
            @if(session('success'))
                <div
                    class="bg-[#d1fae5] text-[#065f46] p-4 rounded-lg flex items-center gap-3 mb-2 border border-[#34d399]">
                    <span class="material-symbols-outlined">check_circle</span>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
            @endif
            @if(session('error'))
                <div
                    class="bg-[#fee2e2] text-[#991b1b] p-4 rounded-lg flex items-center gap-3 mb-2 border border-[#f87171]">
                    <span class="material-symbols-outlined">error</span>
                    <span class="font-medium text-sm">{{ session('error') }}</span>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
    @stack('scripts')
</body>

</html>