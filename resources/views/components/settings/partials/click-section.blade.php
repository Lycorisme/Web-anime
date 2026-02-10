{{-- Click Animation Section --}}
<div class="rounded-xl sm:rounded-2xl overflow-hidden animate-fade-in-up delay-300 transition-all duration-500"
     :class="darkMode ? 'glass-card border border-white/10' : 'bg-white border border-slate-200 shadow-xl shadow-slate-200/50'">
    {{-- Header --}}
    <div class="px-4 sm:px-6 py-4 sm:py-5 transition-colors duration-500"
         :class="darkMode ? 'bg-gradient-to-r from-violet-500/10 to-purple-500/10 border-b border-white/5' : 'bg-gradient-to-r from-violet-500/5 to-purple-500/5 border-b border-slate-100'">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-violet-500 to-purple-500 flex items-center justify-center shadow-lg shadow-violet-500/20">
                    <i class="bi bi-hand-index-thumb-fill text-lg sm:text-xl text-white"></i>
                </div>
                <div>
                    <h3 class="font-bold text-base sm:text-lg transition-colors duration-500"
                        :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('click_animation') }}</h3>
                    <p class="text-[11px] sm:text-xs transition-colors duration-500"
                       :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('click_animation_desc') }}</p>
                </div>
            </div>
            
            {{-- Toggle Switch --}}
            <button 
                wire:click="toggleClick"
                onclick="if(window.CursorEffects) window.CursorEffects.update({ clickEnabled: {{ $clickEnabled ? 'false' : 'true' }} })"
                class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-300 focus:outline-none"
                :class="'{{ $clickEnabled }}' ? 'bg-gradient-to-r from-violet-500 to-purple-500' : (darkMode ? 'bg-slate-700' : 'bg-slate-300')"
            >
                <span class="sr-only">Toggle click animation</span>
                <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-lg transition-transform duration-300 {{ $clickEnabled ? 'translate-x-6' : 'translate-x-1' }}"></span>
            </button>
        </div>
    </div>

    {{-- Options Grid --}}
    <div class="p-4 sm:p-6 transition-opacity duration-500 {{ !$clickEnabled ? 'opacity-50 pointer-events-none' : '' }}">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
            @foreach($clickOptions as $option)
            <button 
                wire:click="setClickAnimation('{{ $option['id'] }}')"
                onclick="if(window.CursorEffects) window.CursorEffects.update({ clickAnimation: '{{ $option['id'] }}' })"
                class="group relative rounded-xl p-4 text-center transition-all duration-300 hover:scale-105"
                :class="'{{ $clickAnimation === $option['id'] }}' ? 
                    (darkMode ? 'ring-2 ring-violet-500 bg-violet-500/10' : 'ring-2 ring-violet-500 bg-violet-50 shadow-lg shadow-violet-100') : 
                    (darkMode ? 'glass-card border border-white/5 hover:bg-white/5' : 'bg-slate-50 border border-slate-100 hover:bg-slate-100')"
            >
                {{-- Preview Animation Area --}}
                <div class="relative w-16 h-16 mx-auto mb-3 rounded-xl overflow-hidden flex items-center justify-center click-preview-container transition-colors duration-500" 
                     :class="darkMode ? 'bg-slate-800/50' : 'bg-slate-200/50'"
                     data-click-type="{{ $option['id'] }}">
                    <i class="bi {{ $option['icon'] }} text-2xl relative z-10 transition-colors duration-500"
                       :class="'{{ $clickAnimation === $option['id'] }}' ? 'text-violet-400' : (darkMode ? 'text-slate-400' : 'text-slate-500')"></i>
                    {{-- Reusing cursor previews for simplicity or add specific if needed --}}
                    <div class="cursor-preview cursor-preview-{{ $option['id'] }}"></div>
                </div>
                
                <h4 class="font-bold text-sm mb-1 transition-colors duration-500"
                    :class="'{{ $clickAnimation === $option['id'] }}' ? 'text-violet-500' : (darkMode ? 'text-slate-300' : 'text-slate-700')">{{ $option['name'] }}</h4>
                <p class="text-[10px] transition-colors duration-500"
                   :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ $option['desc'] }}</p>
                
                {{-- Selected Indicator --}}
                @if($clickAnimation === $option['id'])
                <div class="absolute top-2 right-2 w-5 h-5 rounded-full bg-violet-500 flex items-center justify-center shadow-md">
                    <i class="bi bi-check text-white text-xs font-bold"></i>
                </div>
                @endif
            </button>
            @endforeach
        </div>
    </div>
</div>
