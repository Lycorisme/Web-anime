    {{-- Bulk Actions Bar --}}
    @if(count($selectedUsers) > 0)
    <div class="mb-4 animate-fade-in-up">
        <div class="rounded-2xl px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between flex-wrap gap-3"
             :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30'">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 btn-premium rounded-lg flex items-center justify-center text-white text-sm font-bold">{{ count($selectedUsers) }}</div>
                <span class="text-sm font-bold" :class="darkMode ? 'text-slate-300' : 'text-slate-600'">
                    {{ count($selectedUsers) }} {{ __('items_selected') }}
                </span>
            </div>
            <div class="flex items-center gap-2">
                <button @click="$dispatch('show-alert', { 
                            title: '{{ __('delete_selected') }}', 
                            message: '{{ __('confirm_delete_users') }}', 
                            type: 'danger', 
                            confirmText: '{{ __('yes_delete') }}', 
                            cancelText: '{{ __('cancel') }}', 
                            onConfirm: () => { $wire.bulkDelete() }
                        })"
                        class="btn-soft-danger px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2">
                    <span><i class="bi bi-trash3"></i></span>
                    <span>{{ __('delete_selected') }}</span>
                </button>
                <button wire:click="$set('selectedUsers', [])"
                        class="btn-ghost px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2">
                    <i class="bi bi-x-lg"></i>
                    <span>{{ __('cancel') }}</span>
                </button>
            </div>
        </div>
    </div>
    @endif
