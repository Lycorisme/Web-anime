{{-- Step 1: MAL Paste (hanya saat adding) --}}
@php $inputClass = "w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 transition-all duration-200"; @endphp

<div class="space-y-6">
    {{-- Section Title --}}
    <div class="af-section-title">
        <div class="af-section-icon"><i class="bi bi-clipboard"></i></div>
        <span class="af-section-text" :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('paste_from_mal') }}</span>
    </div>

    {{-- Info Alert --}}
    <div class="rounded-xl p-4 border relative overflow-hidden flex gap-3 items-start"
         :class="darkMode ? 'bg-blue-500/[0.04] border-blue-500/10' : 'bg-blue-50/50 border-blue-100'">
        <div class="absolute -top-6 -right-6 w-16 h-16 rounded-full blur-xl opacity-30 bg-blue-500"></div>
        <i class="bi bi-info-circle-fill text-lg mt-0.5" :class="darkMode ? 'text-blue-400' : 'text-blue-500'"></i>
        <p class="text-[13px] leading-relaxed relative z-10 font-medium" :class="darkMode ? 'text-blue-200/80' : 'text-blue-800'">
            {{ __('mal_paste_instruction') }}
        </p>
    </div>

    {{-- Textarea --}}
    <div class="relative group">
        <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            {{ __('paste_mal_text') }}
        </label>
        
        <textarea wire:model="malRawText" rows="9" 
                  class="{{ $inputClass }} resize-none custom-scrollbar font-mono text-[13px] relative z-10"
                  :class="darkMode 
                      ? 'bg-[#0b1120] border-white/10 text-slate-300 placeholder-slate-600 focus:bg-[#0b1120] focus:border-white/20 focus:ring-blue-500/20' 
                      : 'bg-white border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                  placeholder="{{ __('paste_mal_placeholder') }}"></textarea>
                  
        {{-- Decorative corner lines --}}
        <div class="absolute bottom-2 right-2 w-4 h-4 border-b-2 border-r-2 rounded-br pointer-events-none transition-all duration-300 z-20 group-focus-within:border-white/30"
             :class="darkMode ? 'border-white/10' : 'border-slate-300'"></div>
    </div>

    {{-- Parse Button --}}
    <button wire:click="parseFromMAL" wire:loading.attr="disabled"
            class="relative w-full py-3.5 rounded-xl text-sm font-bold text-white shadow-xl transition-all duration-300 overflow-hidden group flex items-center justify-center gap-2 transform hover:-translate-y-0.5"
            style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));"
            :class="{'opacity-70 cursor-not-allowed': $wire.malRawText === ''}">
        
        {{-- Sweep hover effect --}}
        <div class="absolute inset-0 translate-x-[-100%] group-hover:translate-x-[100%] transition-transform duration-1000 ease-out z-0"
             style="background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);"></div>
        
        <div class="relative z-10 flex items-center gap-2">
            <i class="bi bi-magic" wire:loading.remove wire:target="parseFromMAL"></i>
            <span wire:loading wire:target="parseFromMAL" class="w-4 h-4 border-2 border-white/30 border-t-white rounded-full animate-spin"></span>
            
            <span wire:loading.remove wire:target="parseFromMAL">{{ __('parse_and_fill') }}</span>
            <span wire:loading wire:target="parseFromMAL">{{ __('please_wait') }}</span>
        </div>
    </button>
</div>
