{{-- Language Settings Form - Multi-language Support --}}
@props(['currentLocale' => 'en', 'availableLanguages' => []])

@php
$languages = count($availableLanguages) > 0 ? $availableLanguages : config('languages.supported', []);
@endphp

<div class="rounded-xl sm:rounded-2xl overflow-hidden transition-colors duration-500"
     :class="darkMode ? 'glass-card border border-white/10' : 'bg-white border border-slate-200 shadow-xl shadow-slate-200/50'">
    
    {{-- Header --}}
    <div class="px-4 sm:px-6 py-4 sm:py-5 transition-colors duration-500"
         :class="darkMode ? 'bg-gradient-to-r from-indigo-500/10 to-violet-500/10 border-b border-white/5' : 'bg-gradient-to-r from-indigo-500/5 to-violet-500/5 border-b border-slate-100'">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-indigo-500 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <i class="bi bi-translate text-lg sm:text-xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-base sm:text-lg transition-colors duration-500"
                    :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('language_settings') }}</h3>
                <p class="text-[11px] sm:text-xs transition-colors duration-500"
                   :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('choose_language') }}</p>
            </div>
        </div>
    </div>

    {{-- Language Selection Grid --}}
    <div class="p-4 sm:p-6">
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 max-h-[400px] overflow-y-auto p-4">
            @foreach($languages as $code => $lang)
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: '{{ __('change_language') }}',
                    message: '{{ __('confirm_language_change') }}',
                    confirmText: '{{ __('yes_continue') }}',
                    cancelText: '{{ __('cancel') }}',
                    onConfirm: () => { $wire.setLanguage('{{ $code }}') }
                })"
                class="group relative flex flex-col items-center gap-2 p-4 rounded-xl border-2 transition-all duration-300 hover:scale-[1.02]"
                :class="'{{ $currentLocale === $code }}' ? 
                    (darkMode ? 'border-indigo-500 bg-gradient-to-br from-indigo-500/20 to-violet-500/20 shadow-lg shadow-indigo-500/20' : 'border-indigo-500 bg-indigo-50 shadow-lg shadow-indigo-200/50') : 
                    (darkMode ? 'border-white/10 bg-white/5 hover:border-white/20 hover:bg-white/10' : 'border-slate-200 bg-slate-50 hover:border-indigo-300 hover:bg-indigo-50/30')"
            >
                {{-- Flag Emoji --}}
                <span class="text-3xl sm:text-4xl transition-transform group-hover:scale-110">
                    {{ $lang['flag'] ?? '🌐' }}
                </span>
                
                {{-- Native Name --}}
                <span class="font-bold text-sm text-center transition-colors duration-500"
                    :class="'{{ $currentLocale === $code }}' ? 
                        (darkMode ? 'text-white' : 'text-indigo-700') : 
                        (darkMode ? 'text-slate-300' : 'text-slate-700')">
                    {{ $lang['native'] ?? $lang['name'] }}
                </span>
                
                {{-- English Name (smaller) --}}
                <span class="text-[10px] sm:text-xs transition-colors duration-500"
                    :class="'{{ $currentLocale === $code }}' ? 
                        (darkMode ? 'text-indigo-400' : 'text-indigo-500') : 
                        (darkMode ? 'text-slate-500' : 'text-slate-400')">
                    {{ $lang['name'] }}
                </span>
                
                {{-- Active Indicator --}}
                @if($currentLocale === $code)
                <div class="absolute top-2 right-2">
                    <div class="w-5 h-5 rounded-full bg-gradient-to-r from-indigo-500 to-violet-500 flex items-center justify-center shadow-md">
                        <i class="bi bi-check text-white text-xs"></i>
                    </div>
                </div>
                @endif
                
                {{-- RTL Badge --}}
                @if(($lang['direction'] ?? 'ltr') === 'rtl')
                <span class="absolute bottom-2 right-2 text-[8px] px-1.5 py-0.5 rounded bg-amber-500/20 text-amber-400 font-medium">
                    RTL
                </span>
                @endif
            </button>
            @endforeach
        </div>

        {{-- Current Language Info --}}
        <div class="mt-6 p-4 rounded-xl transition-all duration-500 border"
             :class="darkMode ? 'bg-gradient-to-r from-indigo-500/10 to-violet-500/10 border-indigo-500/20' : 'bg-slate-50 border-slate-200'">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-indigo-500 to-violet-500 flex items-center justify-center shadow-md">
                    <span class="text-xl">{{ $languages[$currentLocale]['flag'] ?? '🌐' }}</span>
                </div>
                <div class="flex-1">
                    <p class="text-xs transition-colors duration-500"
                       :class="darkMode ? 'text-slate-500' : 'text-slate-500'">{{ __('language') }}</p>
                    <p class="font-bold transition-colors duration-500"
                       :class="darkMode ? 'text-white' : 'text-slate-800'">{{ $languages[$currentLocale]['native'] ?? 'English' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs transition-colors duration-500"
                       :class="darkMode ? 'text-slate-500' : 'text-slate-400'">Code</p>
                    <p class="font-mono font-bold text-indigo-500">{{ strtoupper($currentLocale) }}</p>
                </div>
            </div>
        </div>

        {{-- Info Note --}}
        <div class="mt-4 flex items-start gap-2 text-xs transition-colors duration-500"
             :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            <i class="bi bi-info-circle text-indigo-500 mt-0.5"></i>
            <p>{{ __('language_change_notice') }}</p>
        </div>
    </div>
</div>
