{{-- Language Switcher - Compact Dropdown for Navbar --}}
@php
$currentLocale = app()->getLocale();
$languages = config('languages.supported', []);
$currentLang = $languages[$currentLocale] ?? ['name' => 'English', 'native' => 'English', 'flag' => '🌐'];
@endphp

<div 
    x-data="{ 
        open: false,
        setLanguage(locale) {
            // Create a form and submit to change language
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '{{ route('language.switch') }}';
            
            const csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);
            
            const localeInput = document.createElement('input');
            localeInput.type = 'hidden';
            localeInput.name = 'locale';
            localeInput.value = locale;
            form.appendChild(localeInput);
            
            document.body.appendChild(form);
            form.submit();
        }
    }"
    @click.away="open = false"
    class="relative"
>
    {{-- Trigger Button --}}
    <button 
        @click="open = !open"
        class="flex items-center gap-2 px-3 py-2 rounded-xl glass-card hover:bg-white/10 transition-all duration-300 group"
        :class="{ 'bg-white/10': open }"
    >
        <span class="text-lg">{{ $currentLang['flag'] }}</span>
        <span class="text-sm font-medium hidden sm:inline">{{ $currentLang['native'] }}</span>
        <i class="bi bi-chevron-down text-xs transition-transform duration-300" :class="{ 'rotate-180': open }"></i>
    </button>

    {{-- Dropdown Menu --}}
    <div 
        x-show="open"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="absolute right-0 mt-2 w-56 max-h-80 overflow-y-auto glass-card rounded-xl shadow-2xl border border-white/10 z-50"
        x-cloak
    >
        <div class="p-2">
            @foreach($languages as $code => $lang)
            <button 
                @click="setLanguage('{{ $code }}')"
                class="w-full flex items-center gap-3 px-3 py-2.5 rounded-lg transition-all duration-200 text-left {{ $currentLocale === $code ? 'bg-gradient-to-r from-indigo-500/20 to-violet-500/20 border border-indigo-500/30' : 'hover:bg-white/10' }}"
            >
                <span class="text-xl flex-shrink-0">{{ $lang['flag'] }}</span>
                <div class="flex-1 min-w-0">
                    <div class="font-medium text-sm truncate {{ $currentLocale === $code ? 'text-white' : '' }}">
                        {{ $lang['native'] }}
                    </div>
                    <div class="text-xs text-slate-400 truncate">{{ $lang['name'] }}</div>
                </div>
                @if($currentLocale === $code)
                <i class="bi bi-check-circle-fill text-indigo-400 flex-shrink-0"></i>
                @endif
            </button>
            @endforeach
        </div>
    </div>
</div>
