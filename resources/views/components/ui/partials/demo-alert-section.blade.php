{{-- Alert Confirm Demo Section --}}
{{-- Dipisahkan dari demo.blade.php --}}

<div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-200">
    <div class="bg-gradient-to-r from-orange-500/10 to-red-500/10 px-6 py-5 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/20">
                <i class="bi bi-question-circle-fill text-xl text-white"></i>
            </div>
            <div>
                <h2 class="font-bold text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('alert_confirmation') }}</h2>
                <p class="text-xs text-slate-400">{{ __('alert_types_desc') }}</p>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            {{-- Warning Alert --}}
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: '{{ __('demo_warning_title') }}',
                    message: '{{ __('demo_warning_message') }}',
                    type: 'warning',
                    confirmText: '{{ __('yes_continue') }}',
                    cancelText: '{{ __('cancel') }}',
                    onConfirm: () => {
                        $dispatch('toast-success', { message: '{{ __('demo_action_success') }}' });
                    }
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-amber-500/20 hover:border-amber-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-amber-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-exclamation-triangle-fill text-amber-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">{{ __('warning') }}</span>
            </button>

            {{-- Danger Alert --}}
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: '{{ __('demo_delete_title') }}',
                    message: '{{ __('demo_delete_message') }}',
                    type: 'danger',
                    confirmText: '{{ __('yes_delete') }}',
                    cancelText: '{{ __('cancel') }}',
                    onConfirm: () => {
                        $dispatch('toast-success', { message: '{{ __('demo_delete_success') }}' });
                    }
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-red-500/20 hover:border-red-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-trash3-fill text-red-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">{{ __('delete') }}</span>
            </button>

            {{-- Success Alert --}}
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: '{{ __('demo_save_title') }}',
                    message: '{{ __('demo_save_message') }}',
                    type: 'success',
                    confirmText: '{{ __('save') }}',
                    cancelText: '{{ __('review_again') }}',
                    onConfirm: () => {
                        $dispatch('toast-success', { message: '{{ __('demo_save_success') }}' });
                    }
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-emerald-500/20 hover:border-emerald-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-emerald-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-check-circle-fill text-emerald-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">{{ __('success') }}</span>
            </button>

            {{-- Info Alert --}}
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: '{{ __('demo_info_title') }}',
                    message: '{{ __('demo_info_message') }}',
                    type: 'info',
                    confirmText: '{{ __('understood') }}',
                    cancelText: '{{ __('close') }}',
                    onConfirm: () => {
                        $dispatch('toast-info', { message: '{{ __('demo_info_thanks') }}' });
                    }
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-blue-500/20 hover:border-blue-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-blue-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-info-circle-fill text-blue-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">{{ __('info') }}</span>
            </button>
        </div>
    </div>
</div>
