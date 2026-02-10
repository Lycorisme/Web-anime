{{-- Toast Demo Section --}}
{{-- Dipisahkan dari demo.blade.php --}}

<div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-100">
    <div class="bg-gradient-to-r from-emerald-500/10 to-teal-500/10 px-6 py-5 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                <i class="bi bi-chat-square-dots-fill text-xl text-white"></i>
            </div>
            <div>
                <h2 class="font-bold text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('toast_notifications') }}</h2>
                <p class="text-xs text-slate-400">{{ __('click_to_show_toast') }}</p>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            {{-- Success Toast --}}
            <button 
                @click="$dispatch('toast-success', { 
                    message: '{{ __('demo_toast_success_msg') }}', 
                    title: '{{ __('success') }}' 
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-emerald-500/20 hover:border-emerald-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-emerald-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-check-circle-fill text-emerald-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">{{ __('success') }}</span>
            </button>

            {{-- Error Toast --}}
            <button 
                @click="$dispatch('toast-error', { 
                    message: '{{ __('demo_toast_error_msg') }}', 
                    title: '{{ __('error') }}' 
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-red-500/20 hover:border-red-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-x-circle-fill text-red-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">{{ __('error') }}</span>
            </button>

            {{-- Warning Toast --}}
            <button 
                @click="$dispatch('toast-warning', { 
                    message: '{{ __('demo_toast_warning_msg') }}', 
                    title: '{{ __('warning') }}' 
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-amber-500/20 hover:border-amber-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-amber-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-exclamation-triangle-fill text-amber-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">{{ __('warning') }}</span>
            </button>

            {{-- Info Toast --}}
            <button 
                @click="$dispatch('toast-info', { 
                    message: '{{ __('demo_toast_info_msg') }}', 
                    title: '{{ __('info') }}' 
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-blue-500/20 hover:border-blue-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-blue-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-info-circle-fill text-blue-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">{{ __('info') }}</span>
            </button>
        </div>

        {{-- Additional Options --}}
        <div class="mt-6 pt-6 border-t border-white/5">
            <div class="flex flex-wrap items-center gap-3">
                <button 
                    @click="$dispatch('toast', { 
                        type: 'success', 
                        message: '{{ __('demo_long_toast_msg') }}', 
                        duration: 10000 
                    })"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-105 active:scale-95"
                    :class="darkMode ? 'bg-slate-800 text-slate-300 hover:bg-slate-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300'"
                >
                    <i class="bi bi-clock mr-2"></i>{{ __('long_duration') }}
                </button>
                
                <button 
                    @click="$dispatch('toast', { 
                        type: 'info', 
                        message: '{{ __('demo_permanent_toast_msg') }}', 
                        duration: 0 
                    })"
                    class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-105 active:scale-95"
                    :class="darkMode ? 'bg-slate-800 text-slate-300 hover:bg-slate-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300'"
                >
                    <i class="bi bi-pin-angle mr-2"></i>{{ __('permanent') }}
                </button>
                
                <button 
                    @click="$dispatch('clear-toasts')"
                    class="px-4 py-2 rounded-lg text-sm font-medium bg-red-500/10 text-red-500 hover:bg-red-500/20 transition-all duration-200 hover:scale-105 active:scale-95"
                >
                    <i class="bi bi-trash mr-2"></i>{{ __('clear_all') }}
                </button>
            </div>
        </div>
    </div>
</div>
