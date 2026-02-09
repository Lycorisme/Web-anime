{{-- Language Settings Form - Multi-language Support --}}
@props(['currentLocale' => 'en', 'availableLanguages' => []])

@php
$languages = count($availableLanguages) > 0 ? $availableLanguages : config('languages.supported', []);
@endphp

<div class="glass-card rounded-xl sm:rounded-2xl overflow-hidden">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-indigo-500/10 to-violet-500/10 px-4 sm:px-6 py-4 sm:py-5 border-b border-white/5">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-indigo-500 to-violet-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                <i class="bi bi-translate text-lg sm:text-xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-base sm:text-lg">{{ __('language_settings') }}</h3>
                <p class="text-[11px] sm:text-xs text-slate-400">{{ __('choose_language') }}</p>
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
                class="group relative flex flex-col items-center gap-2 p-4 rounded-xl border-2 transition-all duration-300 hover:scale-[1.02] {{ $currentLocale === $code ? 'border-indigo-500 bg-gradient-to-br from-indigo-500/20 to-violet-500/20 shadow-lg shadow-indigo-500/10' : 'border-white/10 bg-white/5 hover:border-white/20 hover:bg-white/10' }}"
            >
                {{-- Flag Emoji --}}
                <span class="text-3xl sm:text-4xl transition-transform group-hover:scale-110">
                    {{ $lang['flag'] ?? '🌐' }}
                </span>
                
                {{-- Native Name --}}
                <span class="font-bold text-sm text-center {{ $currentLocale === $code ? 'text-white' : '' }}">
                    {{ $lang['native'] ?? $lang['name'] }}
                </span>
                
                {{-- English Name (smaller) --}}
                <span class="text-[10px] sm:text-xs text-slate-400">
                    {{ $lang['name'] }}
                </span>
                
                {{-- Active Indicator --}}
                @if($currentLocale === $code)
                <div class="absolute top-2 right-2">
                    <div class="w-5 h-5 rounded-full bg-gradient-to-r from-indigo-500 to-violet-500 flex items-center justify-center">
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
        <div class="mt-6 p-4 rounded-xl bg-gradient-to-r from-indigo-500/10 to-violet-500/10 border border-indigo-500/20">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg bg-gradient-to-r from-indigo-500 to-violet-500 flex items-center justify-center">
                    <span class="text-xl">{{ $languages[$currentLocale]['flag'] ?? '🌐' }}</span>
                </div>
                <div class="flex-1">
                    <p class="text-xs text-slate-400">{{ __('language') }}</p>
                    <p class="font-bold">{{ $languages[$currentLocale]['native'] ?? 'English' }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-slate-400">Code</p>
                    <p class="font-mono font-bold text-indigo-400">{{ strtoupper($currentLocale) }}</p>
                </div>
            </div>
        </div>

        {{-- Info Note --}}
        <div class="mt-4 flex items-start gap-2 text-xs text-slate-400">
            <i class="bi bi-info-circle text-indigo-400 mt-0.5"></i>
            <p>{{ __('language_change_notice') }}</p>
        </div>
    </div>
</div>
