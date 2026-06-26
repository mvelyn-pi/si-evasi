<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SI-EVASI') }}</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.svg') }}" />
    @include('layouts.tailwind')
</head>
<body class="bg-surface-container-low min-h-screen flex flex-col font-body-md text-on-surface selection:bg-primary-fixed selection:text-on-primary-fixed p-4 sm:p-8">
    <div class="w-full max-w-md mx-auto my-auto bg-surface-container-lowest rounded-[8px] border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden shrink-0">
            <div class="px-6 py-8 sm:px-10 border-b border-outline-variant bg-surface-bright text-center flex flex-col items-center">
                <span class="material-symbols-outlined text-primary mb-2" style="font-size: 48px; font-variation-settings: 'FILL' 1;">assured_workload</span>
                <h1 class="font-display-md text-display-md text-primary mb-1">SI-EVASI</h1>
                <p class="font-body-md text-body-md text-on-surface-variant">
                    Sistem Evaluasi Aplikasi SAKTI
                </p>
            </div>
            <div class="px-6 py-8 sm:px-10">
                {{ $slot }}
            </div>
        </div>
</body>
</html>
