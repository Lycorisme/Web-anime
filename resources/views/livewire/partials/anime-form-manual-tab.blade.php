{{-- Manual Input Tab Content --}}
@php $inputClass = "w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all"; @endphp

<div x-show="activeTab === 'manual' || $wire.isEditing">
    <div class="space-y-5">
        {{-- Title & Japanese Title --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    {{ __('title') }} <span class="text-red-400">*</span>
                </label>
                <input type="text" wire:model="title" class="{{ $inputClass }}"
                       :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'"
                       placeholder="Log Horizon">
                @error('title') <span class="text-red-400 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    {{ __('english_title') }}
                </label>
                <input type="text" wire:model="title_english" class="{{ $inputClass }}"
                       :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'"
                       placeholder="Log Horizon">
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    {{ __('japanese_title') }}
                </label>
                <input type="text" wire:model="title_japanese" class="{{ $inputClass }}"
                       :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'"
                       placeholder="ログ・ホライズン">
            </div>
        </div>

        {{-- Type, Episodes, Source --}}
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('type') }}</label>
                <x-ui.select model="type" :options="collect($types)->map(fn($t) => ['value' => $t, 'label' => $t])->toArray()" placeholder="Select type" teleport="true" />
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('episodes') }}</label>
                <input type="number" wire:model="episodes" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="25" min="0">
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('source') }}</label>
                <input type="text" wire:model="source" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="Light novel">
            </div>
        </div>

        {{-- Studios, Premiered, Airing Status --}}
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('studios') }}</label>
                <input type="text" wire:model="studios" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="Satelight">
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('premiered') }}</label>
                <input type="text" wire:model="premiered" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="Fall 2013">
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('airing_status') }}</label>
                <input type="text" wire:model="status" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="Finished Airing">
            </div>
        </div>

        {{-- Genres, Themes --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('genres') }}</label>
                <input type="text" wire:model="genres" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="Action, Adventure, Fantasy">
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('themes') }}</label>
                <input type="text" wire:model="themes" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="Adult Cast, Video Game">
            </div>
        </div>

        {{-- MAL Score, Image URL --}}
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('mal_score') }}</label>
                <input type="number" wire:model="mal_score" step="0.01" min="0" max="10" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="7.90">
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('image_url') }}</label>
                <input type="url" wire:model="image_url" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="https://...">
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('official_site') }}</label>
                <input type="url" wire:model="official_site" class="{{ $inputClass }}" :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'" placeholder="https://...">
            </div>
        </div>

        {{-- Synopsis --}}
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('synopsis') }}</label>
            <textarea wire:model="synopsis" rows="3" class="{{ $inputClass }} resize-none custom-scrollbar"
                      :class="darkMode ? 'bg-white/5 border-white/10 text-white placeholder-slate-500' : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400'"
                      placeholder="{{ __('synopsis') }}..."></textarea>
        </div>

        {{-- Personal Tracking Divider --}}
        <div class="flex items-center gap-3 pt-2">
            <div class="flex-1 h-px" :class="darkMode ? 'bg-white/10' : 'bg-slate-200'"></div>
            <span class="text-xs font-bold uppercase tracking-wider px-3 py-1 rounded-full"
                  :class="darkMode ? 'text-slate-400 bg-white/5' : 'text-slate-500 bg-slate-100'">
                <i class="bi bi-person-heart mr-1"></i> {{ __('personal_tracking') }}
            </span>
            <div class="flex-1 h-px" :class="darkMode ? 'bg-white/10' : 'bg-slate-200'"></div>
        </div>

        {{-- Watch Status, Score, Date --}}
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="col-span-2 sm:col-span-1">
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('watch_status') }} <span class="text-red-400">*</span></label>
                <x-ui.select model="watch_status" :options="collect($watchStatuses)->map(fn($s) => ['value' => $s, 'label' => __(str_replace(' ', '_', $s))])->toArray()" placeholder="Select status" teleport="true" />
            </div>
            <div class="col-span-2 sm:col-span-1">
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('personal_score') }}</label>
                <x-ui.select model="personal_score" :options="collect(range(10, 1))->map(fn($i) => ['value' => $i, 'label' => $i.'/10'])->prepend(['value' => '', 'label' => '-'])->toArray()" placeholder="Score" teleport="true" />
            </div>
            <div class="col-span-1 sm:col-span-1">
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('start_watching') }}</label>
                <x-ui.date-picker model="watch_start_date" placeholder="YYYY-MM-DD" />
            </div>
            <div class="col-span-1 sm:col-span-1">
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('end_watching') }}</label>
                <x-ui.date-picker model="watch_end_date" placeholder="YYYY-MM-DD" />
            </div>
        </div>

        {{-- Notes --}}
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('notes') }}</label>
            <textarea wire:model="notes" rows="2" class="{{ $inputClass }} resize-none custom-scrollbar"
                      :class="darkMode ? 'bg-white/5 border-white/10 text-white placeholder-slate-500' : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400'"
                      placeholder="{{ __('personal_notes_placeholder') }}..."></textarea>
        </div>
    </div>
</div>
