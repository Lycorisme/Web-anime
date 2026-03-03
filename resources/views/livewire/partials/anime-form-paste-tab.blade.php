{{-- MAL Paste Tab Content (Slide 1) --}}
<div x-show="slide === 1" 
     x-transition:enter="transition-all ease-[0.23,1,0.32,1] duration-700"
     x-transition:enter-start="opacity-0 scale-[0.98] blur-sm translate-y-4"
     x-transition:enter-end="opacity-100 scale-100 blur-none translate-y-0"
     x-transition:leave="transition-all ease-in-out duration-300 absolute top-6 left-6 right-6 z-0"
     x-transition:leave-start="opacity-100 scale-100 blur-none translate-y-0"
     x-transition:leave-end="opacity-0 scale-[0.98] blur-sm -translate-y-4">
    <div class="space-y-4">
        <div class="rounded-xl p-4 border"
             :class="darkMode ? 'bg-blue-500/10 border-blue-500/20' : 'bg-blue-50 border-blue-200'">
            <p class="text-xs font-medium" :class="darkMode ? 'text-blue-300' : 'text-blue-700'">
                <i class="bi bi-info-circle mr-1"></i>
                {{ __('mal_paste_instruction') }}
            </p>
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                   :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                {{ __('paste_mal_text') }}
            </label>
            <textarea wire:model="malRawText" rows="12"
                      class="w-full px-4 py-3 rounded-xl border text-sm font-mono appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all resize-none custom-scrollbar"
                      :class="darkMode ? 'bg-white/5 border-white/10 text-white placeholder-slate-500' : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400'"
                      placeholder="{{ __('paste_mal_placeholder') }}"></textarea>
        </div>
        <button wire:click="parseFromMAL"
                class="w-full py-3 rounded-xl text-sm font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center justify-center gap-2"
                style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
            <i class="bi bi-magic"></i>
            {{ __('parse_and_fill') }}
        </button>
    </div>
</div>
