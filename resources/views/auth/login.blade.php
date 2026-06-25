<x-guest-layout>
    <!-- Session Status -->
    @if (session('status'))
        <div class="bg-[#d1fae5] text-[#065f46] p-3 rounded mb-4 font-label-md">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="flex flex-col gap-[20px]">
        @csrf

        <!-- Email Address -->
        <div class="flex flex-col gap-2">
            <label for="email" class="font-label-md text-label-md text-on-surface-variant">Email</label>
            <input id="email" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('email') border-error @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="flex flex-col gap-2">
            <label for="password" class="font-label-md text-label-md text-on-surface-variant">Password</label>
            <input id="password" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('password') border-error @enderror" type="password" name="password" required autocomplete="current-password">
            @error('password')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="flex items-center gap-3 cursor-pointer group mt-2">
            <input id="remember_me" type="checkbox" class="w-4 h-4 text-primary bg-surface-container-lowest border-outline-variant focus:ring-primary focus:ring-offset-0 rounded" name="remember">
            <label for="remember_me" class="font-body-md text-body-md text-on-surface-variant cursor-pointer group-hover:text-primary transition-colors">Ingat Saya</label>
        </div>

        <!-- Actions -->
        <div class="pt-6 mt-2 border-t border-outline-variant flex flex-col gap-3">
            <button class="w-full h-[40px] bg-[#1B3A5C] hover:bg-primary text-white font-label-md text-label-md rounded-[4px] transition-colors flex items-center justify-center gap-2 shadow-sm" type="submit">
                Log in
            </button>
            <a class="w-full h-[40px] border border-[#1B3A5C] text-[#1B3A5C] font-label-md text-label-md rounded-[4px] transition-colors flex items-center justify-center hover:bg-surface-container-low" href="{{ route('home') }}">
                Kembali ke Beranda
            </a>
        </div>
    </form>
</x-guest-layout>
