{{-- Appearance Settings Form - Redesigned & Premium --}}
@props([
    'currentLogo' => null, 
    'currentFavicon' => null,
    'siteLogo' => null,
    'siteFavicon' => null,
    'selectedLogoIcon' => 'sparkles',
    'selectedFaviconIcon' => 'sparkles',
    'iconOptions' => []
])

<div class="rounded-2xl overflow-hidden relative transition-colors duration-500"
     :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30 shadow-xl shadow-slate-200/20'">
    
    {{-- Decorative Background Blur --}}
    <div class="hidden sm:block absolute top-0 right-0 w-64 h-64 blur-[80px] rounded-full pointer-events-none -mr-32 -mt-32 transition-opacity duration-500"
         :class="darkMode ? 'bg-purple-500/10' : 'bg-purple-500/[0.07]'"></div>
    <div class="hidden sm:block absolute bottom-0 left-0 w-64 h-64 blur-[80px] rounded-full pointer-events-none -ml-32 -mb-32 transition-opacity duration-500"
         :class="darkMode ? 'bg-pink-500/10' : 'bg-pink-500/[0.07]'"></div>

    {{-- Header --}}
    <div class="relative px-6 py-6 transition-colors duration-500"
         :class="darkMode ? 'bg-gradient-to-r from-purple-500/10 via-pink-500/10 to-transparent border-b border-white/5' : 'bg-gradient-to-r from-purple-500/5 via-pink-500/5 to-transparent border-b border-slate-100'">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-500/20 ring-1 ring-white/20">
                <i class="bi bi-palette-fill text-2xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-xl tracking-tight transition-colors duration-500"
                    :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('visual_appearance') }}</h3>
                <p class="text-sm mt-1 transition-colors duration-500"
                   :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('customize_visual') }}</p>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-8 relative">

        @include('components.settings.partials.appearance-logo-section')

        {{-- Divider --}}
        <div class="h-px transition-colors duration-500"
             :class="darkMode ? 'bg-gradient-to-r from-transparent via-white/10 to-transparent' : 'bg-gradient-to-r from-transparent via-slate-200 to-transparent'"></div>

        @include('components.settings.partials.appearance-favicon-section')
        
        {{-- Save Action --}}
        <div class="pt-6 transition-colors duration-500"
             :class="darkMode ? 'border-t border-white/5' : 'border-t border-slate-100'">
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: '{{ __('confirm_save') }}',
                    message: '{{ __('confirm_save_message') }}',
                    type: 'info',
                    confirmText: '{{ __('save') }}',
                    cancelText: '{{ __('cancel') }}',
                    onConfirm: () => { $wire.save(); }
                })"
                class="w-full sm:w-auto relative group overflow-hidden rounded-xl px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold shadow-2xl hover:shadow-[0_0_30px_rgba(168,85,247,0.4)] transition-all hover:-translate-y-1 active:translate-y-0"
            >
                <div class="relative z-10 flex items-center justify-center gap-3">
                    <i class="bi bi-check-circle-fill text-xl"></i>
                    <span>{{ __('save_appearance') }}</span>
                </div>
                {{-- Shine Effect --}}
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
            </button>
        </div>

    </div>
</div>
