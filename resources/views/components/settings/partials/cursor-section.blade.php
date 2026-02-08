{{-- Cursor Highlight Section --}}
<div class="glass-card rounded-xl sm:rounded-2xl overflow-hidden animate-fade-in-up delay-200">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-emerald-500/10 to-teal-500/10 px-4 sm:px-6 py-4 sm:py-5 border-b border-white/5">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <i class="bi bi-cursor-fill text-lg sm:text-xl text-white"></i>
                </div>
                <div>
                    <h3 class="font-bold text-base sm:text-lg">{{ __('cursor_highlight') }}</h3>
                    <p class="text-[11px] sm:text-xs text-slate-400">{{ __('visual_follows_cursor') }}</p>
                </div>
            </div>
            
            {{-- Toggle Switch --}}
            <button 
                wire:click="toggleCursor"
                onclick="if(window.CursorEffects) window.CursorEffects.update({ cursorEnabled: {{ $cursorEnabled ? 'false' : 'true' }} })"
                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-300 focus:outline-none {{ $cursorEnabled ? 'bg-gradient-to-r from-emerald-500 to-teal-500' : 'bg-slate-600' }}"
            >
                <span class="sr-only">Toggle cursor effect</span>
                <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-lg transition-transform duration-300 {{ $cursorEnabled ? 'translate-x-6' : 'translate-x-1' }}"></span>
            </button>
        </div>
    </div>

    {{-- Options Grid --}}
    <div class="p-4 sm:p-6 {{ !$cursorEnabled ? 'opacity-50 pointer-events-none' : '' }}">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach($cursorOptions as $option)
            <button 
                wire:click="setCursorStyle('{{ $option['id'] }}')"
                onclick="if(window.CursorEffects) window.CursorEffects.update({ cursorStyle: '{{ $option['id'] }}' })"
                class="group relative glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 {{ $cursorStyle === $option['id'] ? 'ring-2 ring-emerald-500 bg-emerald-500/10' : 'hover:bg-white/5' }}"
            >
                {{-- Preview Animation Area --}}
                <div class="relative w-16 h-16 mx-auto mb-3 rounded-xl bg-slate-800/50 overflow-hidden flex items-center justify-center">
                    {{-- Cursor Effect Preview --}}
                    <div class="cursor-preview cursor-preview-{{ $option['id'] }}"></div>
                    <i class="bi {{ $option['icon'] }} text-2xl relative z-10 {{ $cursorStyle === $option['id'] ? 'text-emerald-400' : 'text-slate-400' }}"></i>
                </div>
                
                <h4 class="font-bold text-sm mb-1 {{ $cursorStyle === $option['id'] ? 'text-emerald-400' : '' }}">{{ $option['name'] }}</h4>
                <p class="text-[10px] text-slate-500">{{ $option['desc'] }}</p>
                
                {{-- Selected Indicator --}}
                @if($cursorStyle === $option['id'])
                <div class="absolute top-2 right-2 w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center">
                    <i class="bi bi-check text-white text-xs"></i>
                </div>
                @endif
            </button>
            @endforeach
        </div>
    </div>
</div>
