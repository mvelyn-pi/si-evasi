<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Kuesioner Berhasil Dikirim! - SISTEM EVALUASI SAKTI</title>
    @include('layouts.tailwind')
</head>
<body class="bg-background text-on-background font-body-md min-h-screen flex flex-col">
    
    <!-- Main Content Canvas -->
    <main class="w-full max-w-md mx-auto my-auto bg-surface-container-lowest rounded-xl border border-outline-variant shadow-sm overflow-hidden text-center mt-8 md:mt-auto shrink-0">
        <div class="p-8 flex flex-col items-center">
            
            <!-- Success Icon -->
            <div class="mb-6 rounded-full bg-[#2D9E6B]/10 p-4 flex items-center justify-center">
                <span class="material-symbols-outlined text-[64px] text-[#2D9E6B]" style="font-variation-settings: 'FILL' 1;">
                    check_circle
                </span>
            </div>
            
            <!-- Heading -->
            <h1 class="font-display-md text-display-md text-on-surface mb-2">
                Kuesioner Berhasil Dikirim!
            </h1>
            
            <!-- Supporting Note -->
            <p class="font-body-md text-body-md text-on-surface-variant mb-8">
                Data Anda telah tersimpan. Terima kasih atas partisipasinya.
            </p>
            
            <!-- Respondent Code Box -->
            @if(session('kode_responden'))
            <div class="bg-surface-container-low border border-outline-variant rounded-lg p-4 w-full mb-8">
                <p class="font-label-sm text-label-sm text-on-surface-variant uppercase tracking-wider mb-1">
                    Kode Responden Anda
                </p>
                <p class="font-display-sm text-display-sm text-primary tracking-widest font-mono">
                    {{ session('kode_responden') }}
                </p>
                <button class="mt-2 text-secondary font-label-md text-label-md flex items-center justify-center w-full gap-1 hover:underline focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-1 rounded-sm" onclick="navigator.clipboard.writeText('{{ session('kode_responden') }}').then(function(){ window.dispatchEvent(new CustomEvent('notify',{detail:{message:'Kode disalin!', type:'success'}})); }).catch(function(){ window.dispatchEvent(new CustomEvent('notify',{detail:{message:'Gagal menyalin', type:'error'}})); });">
                    <span class="material-symbols-outlined text-[16px]">content_copy</span>
                    Salin Kode
                </button>
            </div>
            @endif
            
            <!-- Action Button -->
            <a href="{{ route('home') }}" class="w-full h-[40px] bg-primary text-on-primary font-label-md text-label-md rounded-lg flex items-center justify-center hover:bg-primary/90 transition-colors focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2">
                Kembali ke Halaman Utama
            </a>
            
        </div>
    </main>
    
    <!-- Footer for Transactional Screen Context -->
    <footer class="mt-8 text-center text-on-surface-variant font-label-sm text-label-sm max-w-container-max mx-auto px-margin-mobile md:px-margin-desktop w-full">
         &copy; {{ date('Y') }} Sistem Evaluasi SAKTI - Institusi Pemerintah Republik Indonesia
    </footer>
    
</body>
</html>
