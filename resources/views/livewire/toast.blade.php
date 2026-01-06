<div
    x-data="{
        toasts: @entangle('activeToasts'),
        add(toast) {
            this.toasts.push(toast);
            setTimeout(() => this.remove(toast.id), toast.timeout * 1000);
        },
        remove(id) {
            this.toasts = this.toasts.filter(t => t.id !== id);
            $wire.remove(id);
        }
    }"
    @toast.window="add({
        id: Date.now().toString(),
        text: $event.detail.message,
        type: $event.detail.type || 'success',
        timeout: $event.detail.timeout || 3
    })"
    class="fixed bottom-6 left-1/2 -translate-x-1/2 z-100 flex flex-col items-center gap-2"
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95"
            class="flex items-center gap-2 pl-3 pr-4 py-2.5 rounded-full shadow-lg border backdrop-blur-sm bg-white/90 dark:bg-zinc-800/90 border-zinc-200 dark:border-zinc-700 text-zinc-900 dark:text-white"
        >
            {{-- Success Icon --}}
            <template x-if="toast.type === 'success'">
                <div class="text-emerald-500 bg-emerald-500/10 p-1.5 rounded-full">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </template>

            {{-- Error Icon --}}
            <template x-if="toast.type === 'error'">
                <div class="text-red-500 bg-red-500/10 p-1.5 rounded-full">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </template>

            {{-- Warning Icon --}}
            <template x-if="toast.type === 'warning'">
                <div class="text-amber-500 bg-amber-500/10 p-1.5 rounded-full">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.054 0 1.502-1.32.712-2.098L13.012 4.614c-.632-.78-1.822-.78-2.454 0L3.27 16.902c-.79.778-.342 2.098.712 2.098z" />
                    </svg>
                </div>
            </template>

            {{-- Info Icon --}}
            <template x-if="toast.type === 'info'">
                <div class="text-blue-500 bg-blue-500/10 p-1.5 rounded-full">
                    <svg class="size-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </template>

            {{-- Message --}}
            <span class="text-sm font-medium" x-text="toast.text"></span>

            {{-- Close Button --}}
            <button
                @click="remove(toast.id)"
                class="ml-1 p-1 rounded-full text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-200 hover:bg-zinc-100 dark:hover:bg-zinc-700/50 transition-colors"
            >
                <svg class="size-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </template>
</div>
