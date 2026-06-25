@extends('layouts.admin')
@section('title', 'Tambah User')
@section('page-title', 'Tambah User')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-1 text-sm font-label-md text-on-surface-variant hover:text-primary transition-colors">
        <span class="material-symbols-outlined text-[18px]">arrow_back</span>
        Kembali ke Daftar User
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden max-w-2xl">
    <div class="p-5 border-b border-outline-variant bg-surface-bright">
        <h3 class="font-display-sm text-display-sm text-primary font-semibold">Form Tambah User</h3>
    </div>
    
    <form action="{{ route('admin.users.store') }}" method="POST" class="p-5 flex flex-col gap-4">
        @csrf
        
        <div class="flex flex-col gap-2">
            <label for="name" class="font-label-md text-label-md text-on-surface-variant">Nama Lengkap <span class="text-error">*</span></label>
            <input type="text" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('name') border-error @enderror" id="name" name="name" value="{{ old('name') }}" required>
            @error('name')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label for="email" class="font-label-md text-label-md text-on-surface-variant">Alamat Email <span class="text-error">*</span></label>
            <input type="email" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('email') border-error @enderror" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label for="password" class="font-label-md text-label-md text-on-surface-variant">Password <span class="text-error">*</span></label>
            <input type="password" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant @error('password') border-error @enderror" id="password" name="password" required>
            <span class="text-on-surface-variant text-xs font-body-md">Minimal 8 karakter.</span>
            @error('password')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="flex flex-col gap-2">
            <label for="password_confirmation" class="font-label-md text-label-md text-on-surface-variant">Konfirmasi Password <span class="text-error">*</span></label>
            <input type="password" class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface placeholder:text-outline-variant" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="flex flex-col gap-2">
            <label for="role" class="font-label-md text-label-md text-on-surface-variant">Role <span class="text-error">*</span></label>
            <div class="relative">
                <select class="custom-input w-full h-[40px] px-3 bg-surface-container-lowest border-[1.5px] border-outline-variant rounded-[6px] font-body-md text-on-surface appearance-none cursor-pointer @error('role') border-error @enderror" id="role" name="role" required>
                    <option value="" disabled {{ old('role') ? '' : 'selected' }}>Pilih Role</option>
                    <option value="evaluator" {{ old('role') == 'evaluator' ? 'selected' : '' }}>Evaluator (Akses Lihat Laporan)</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Akses Penuh)</option>
                </select>
                <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-outline pointer-events-none">expand_more</span>
            </div>
            @error('role')
                <div class="text-error font-label-sm mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="pt-4 flex justify-end gap-3 mt-2 border-t border-outline-variant">
            <a href="{{ route('admin.users.index') }}" class="h-[40px] px-4 rounded border border-outline-variant text-on-surface-variant font-label-md flex items-center justify-center hover:bg-surface-container-low transition-colors">
                Batal
            </a>
            <button type="submit" class="h-[40px] px-6 rounded bg-primary hover:bg-primary/90 text-white font-label-md flex items-center justify-center gap-2 shadow-sm transition-colors">
                <span class="material-symbols-outlined text-[18px]">save</span>
                Simpan
            </button>
        </div>
    </form>
</div>
@endsection
