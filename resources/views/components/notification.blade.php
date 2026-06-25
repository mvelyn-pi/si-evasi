<div x-data="{ items: [] }" x-init="window.addEventListener('notify', e => {
        const detail = e.detail || { message: 'Notifikasi', type: 'info' };
        const id = Date.now() + Math.random();
        items.push({ id, message: detail.message, type: detail.type || 'info' });
        setTimeout(() => items = items.filter(i => i.id !== id), 3500);
    })"
    class="fixed top-4 right-4 z-50 flex flex-col gap-3 pointer-events-none">
    <template x-for="item in items" :key="item.id">
        <div x-show="true" x-transition class="pointer-events-auto w-80 p-3 rounded-lg shadow-md flex items-start gap-3"
             :class="{ 'bg-[#d1fae5] text-[#065f46] border border-[#34d399]': item.type === 'success', 'bg-[#fee2e2] text-[#991b1b] border border-[#f87171]': item.type === 'error', 'bg-surface-container-low text-on-surface': item.type === 'info' }">
            <span class="material-symbols-outlined text-[20px]" x-text="item.type === 'success' ? 'check_circle' : (item.type === 'error' ? 'error' : 'info')"></span>
            <div class="flex-1 text-sm font-medium" x-text="item.message"></div>
            <button @click="items = items.filter(i => i.id !== item.id)" class="text-on-surface-variant">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>
    </template>
</div>
