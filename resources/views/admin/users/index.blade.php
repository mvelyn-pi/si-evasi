@extends('layouts.admin')
@section('title', 'Manajemen User')
@section('page-title', 'Manajemen User')

@section('content')
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-4">
    <div>
        <p class="text-on-surface-variant font-body-md text-sm">Kelola akun Admin dan Evaluator.</p>
    </div>
    <a href="{{ route('admin.users.create') }}" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-white px-4 py-2 rounded-lg font-label-md text-sm transition-colors shadow-sm">
        <span class="material-symbols-outlined" style="font-size: 18px;">person_add</span>
        Tambah User
    </a>
</div>

<div class="bg-surface-container-lowest rounded-xl border border-outline-variant shadow-[0_1px_4px_rgba(0,0,0,0.05)] overflow-hidden">
    <div class="overflow-x-auto w-full">
        <table class="w-full text-left border-collapse min-w-[800px]">
            <thead>
                <tr class="bg-surface-bright border-b border-outline-variant text-on-surface-variant font-label-sm text-label-sm uppercase tracking-wider">
                    <th class="p-4 font-semibold">Nama</th>
                    <th class="p-4 font-semibold">Email</th>
                    <th class="p-4 font-semibold text-center">Role</th>
                    <th class="p-4 font-semibold text-center">Terdaftar</th>
                    <th class="p-4 font-semibold text-center w-32">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-sm font-body-md divide-y divide-outline-variant/50">
                @forelse($users as $user)
                <tr class="hover:bg-surface-container-low/50 transition-colors">
                    <td class="p-4 font-medium text-primary flex items-center gap-2">
                        {{ $user->name }}
                        @if($user->id === auth()->id())
                            <span class="inline-flex items-center justify-center px-2 py-0.5 rounded text-[10px] font-bold bg-primary-fixed/50 text-on-primary-fixed uppercase tracking-wider">Anda</span>
                        @endif
                    </td>
                    <td class="p-4 text-on-surface">{{ $user->email }}</td>
                    <td class="p-4 text-center">
                        @if($user->role === 'admin')
                            <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full bg-[#fee2e2] text-[#991b1b] text-xs font-semibold">Admin</span>
                        @else
                            <span class="inline-flex items-center justify-center px-2.5 py-0.5 rounded-full bg-secondary-fixed/50 text-[#005084] text-xs font-semibold">Evaluator</span>
                        @endif
                    </td>
                    <td class="p-4 text-center text-on-surface-variant text-sm">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="p-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="w-8 h-8 rounded border border-outline-variant flex items-center justify-center text-on-surface-variant hover:bg-surface-container-low transition-colors" title="Edit">
                                <span class="material-symbols-outlined text-[18px]">edit</span>
                            </a>
                            @if($user->id !== auth()->id())
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline" data-confirm-name="akun {{ $user->name }}">
                                @csrf @method('DELETE')
                                <button type="button" data-confirm-delete data-confirm-name="akun {{ $user->name }}" class="w-8 h-8 rounded border border-error/50 flex items-center justify-center text-error hover:bg-error-container transition-colors" title="Hapus">
                                    <span class="material-symbols-outlined text-[18px]">delete</span>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="5" class="text-center p-4 text-on-surface-variant">Belum ada user</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
    <div class="p-4 border-t border-outline-variant bg-white">
        {{ $users->links() }}
    </div>
    @endif
</div>
@endsection
