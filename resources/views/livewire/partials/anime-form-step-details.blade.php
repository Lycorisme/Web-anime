{{-- Step 2: Details & Media (Genres, Themes, Synopsis, Image, MAL Score, URLs) --}}
@php $inputClass = "w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 transition-all duration-200"; @endphp

<div class="space-y-6">
    {{-- Section Title --}}
    <div class="af-section-title">
        <div class="af-section-icon"><i class="bi bi-image"></i></div>
        <span class="af-section-text" :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('details_media') }}</span>
    </div>

    {{-- Genres & Themes --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                <i class="bi bi-tag mr-1"></i>{{ __('genres') }}
            </label>
            <input type="text" wire:model="genres" class="{{ $inputClass }}"
                   :class="darkMode
                       ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                       : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                   placeholder="Action, Adventure, Fantasy">
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                <i class="bi bi-tags mr-1"></i>{{ __('themes') }}
            </label>
            <input type="text" wire:model="themes" class="{{ $inputClass }}"
                   :class="darkMode
                       ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                       : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                   placeholder="Adult Cast, Video Game">
        </div>
    </div>

    {{-- Synopsis --}}
    <div>
        <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            <i class="bi bi-text-paragraph mr-1"></i>{{ __('synopsis') }}
        </label>
        <textarea wire:model="synopsis" rows="4" class="{{ $inputClass }} resize-none custom-scrollbar"
                  :class="darkMode
                      ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                      : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                  placeholder="{{ __('synopsis') }}..."></textarea>
    </div>

    {{-- Divider --}}
    <div class="h-px w-full" :class="darkMode ? 'bg-white/[0.06]' : 'bg-slate-100'"></div>

    {{-- Image URL with Live Preview --}}
    <div>
        <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            <i class="bi bi-image mr-1"></i>{{ __('image_url') }}
        </label>
        <div class="flex gap-4">
            <div class="flex-1">
                <input type="url" wire:model.live.debounce.500ms="image_url" class="{{ $inputClass }}"
                       :class="darkMode
                           ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                           : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                       placeholder="https://cdn.myanimelist.net/images/anime/...">
            </div>
            {{-- Live Preview Thumbnail --}}
            <div class="w-16 h-22 rounded-xl overflow-hidden flex-shrink-0 border transition-all duration-300"
                 :class="darkMode ? 'border-white/10 bg-white/[0.03]' : 'border-slate-200 bg-slate-50'">
                <template x-if="$wire.image_url">
                    <img :src="$wire.image_url" class="w-full h-full object-cover"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                </template>
                <div class="w-full h-full flex items-center justify-center"
                     :class="$wire.image_url ? 'hidden' : 'flex'"
                     :style="$wire.image_url ? '' : ''">
                    <i class="bi bi-image text-xl" :class="darkMode ? 'text-slate-600' : 'text-slate-300'"></i>
                </div>
            </div>
        </div>
    </div>

    {{-- MAL Score, Official Site --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                <i class="bi bi-star mr-1"></i>{{ __('mal_score') }}
            </label>
            <x-ui.number-spinner model="mal_score" step="0.01" min="0" max="10" placeholder="7.90" />
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                <i class="bi bi-globe2 mr-1"></i>{{ __('official_site') }}
            </label>
            <input type="url" wire:model="official_site" class="{{ $inputClass }}"
                   :class="darkMode
                       ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                       : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                   placeholder="https://...">
        </div>
    </div>
</div>
