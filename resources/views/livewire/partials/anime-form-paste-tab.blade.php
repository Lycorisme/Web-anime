{{-- MAL Paste — Step 0 (Import from MAL) --}}
<div class="space-y-6">
    {{-- Section Title --}}
    <div class="af-section-title">
        <div class="af-section-icon"><i class="bi bi-clipboard-data"></i></div>
        <span class="af-section-text" :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('paste_from_mal') }}</span>
    </div>

    {{-- Info Card --}}
    <div class="rounded-xl p-4 border relative overflow-hidden"
         :class="darkMode ? 'bg-blue-500/[0.06] border-blue-400/10' : 'bg-blue-50/80 border-blue-200/60'">
        <div class="absolute -top-6 -right-6 w-20 h-20 rounded-full blur-2xl opacity-30"
             style="background: var(--gradient-start);"></div>
        <div class="flex items-start gap-3 relative z-10">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 mt-0.5"
                 :class="darkMode ? 'bg-blue-500/20 text-blue-400' : 'bg-blue-100 text-blue-600'">
                <i class="bi bi-info-circle"></i>
            </div>
            <div>
                <p class="text-xs font-bold mb-1" :class="darkMode ? 'text-blue-300' : 'text-blue-700'">{{ __('quick_import') }}</p>
                <p class="text-[11px] leading-relaxed" :class="darkMode ? 'text-blue-300/70' : 'text-blue-600/80'">
                    {{ __('mal_paste_instruction') }}
                </p>
            </div>
        </div>
    </div>

    {{-- Textarea --}}
    <div>
        <label class="block text-xs font-bold mb-2.5 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            <i class="bi bi-file-text mr-1"></i> {{ __('paste_mal_text') }}
        </label>
        <div class="relative group">
            <textarea wire:model="malRawText" rows="14"
                      class="w-full px-4 py-4 rounded-xl border text-sm font-mono appearance-none focus:outline-none focus:ring-2 transition-all duration-200 resize-none custom-scrollbar"
                      :class="darkMode
                          ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                          : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                      placeholder="{{ __('paste_mal_placeholder') }}"></textarea>

            {{-- Decorative corner lines --}}
            <div class="absolute top-2 left-2 w-4 h-4 border-l-2 border-t-2 rounded-tl-md pointer-events-none opacity-20"
                 style="border-color: var(--gradient-start);"></div>
            <div class="absolute bottom-2 right-2 w-4 h-4 border-r-2 border-b-2 rounded-br-md pointer-events-none opacity-20"
                 style="border-color: var(--gradient-end);"></div>
        </div>
    </div>

    {{-- Parse Button --}}
    <button wire:click="parseFromMAL"
            class="w-full py-3.5 rounded-xl text-sm font-bold text-white shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center justify-center gap-2.5 relative overflow-hidden group"
            style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); box-shadow: 0 10px 25px -5px color-mix(in srgb, var(--gradient-start) 40%, transparent);">
        <div class="absolute inset-0 bg-white/10 translate-x-full group-hover:translate-x-0 transition-transform duration-500 skew-x-12"></div>
        <i class="bi bi-magic relative z-10"></i>
        <span class="relative z-10">{{ __('parse_and_fill') }}</span>
    </button>
</div>
