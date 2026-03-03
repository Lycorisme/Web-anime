{{-- Step 1: Basic Info (Title, Type, Source, Studios, Status) --}}
@php $inputClass = "w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 transition-all duration-200"; @endphp

<div class="space-y-6">
    {{-- Section Title --}}
    <div class="af-section-title">
        <div class="af-section-icon"><i class="bi bi-film"></i></div>
        <span class="af-section-text" :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('basic_info_step') }}</span>
    </div>

    {{-- Title Group --}}
    <div class="space-y-4">
        {{-- Main Title --}}
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                {{ __('title') }} <span class="text-red-400">*</span>
            </label>
            <input type="text" wire:model="title" class="{{ $inputClass }}"
                   :class="darkMode
                       ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                       : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                   placeholder="Log Horizon">
            @error('title') <span class="text-red-400 text-xs mt-1 flex items-center gap-1"><i class="bi bi-exclamation-circle"></i> {{ $message }}</span> @enderror
        </div>

        {{-- English & Japanese Title --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    {{ __('english_title') }}
                </label>
                <input type="text" wire:model="title_english" class="{{ $inputClass }}"
                       :class="darkMode
                           ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                           : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                       placeholder="Log Horizon">
            </div>
            <div>
                <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    {{ __('japanese_title') }}
                </label>
                <input type="text" wire:model="title_japanese" class="{{ $inputClass }}"
                       :class="darkMode
                           ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                           : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                       placeholder="ログ・ホライズン">
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <div class="h-px w-full" :class="darkMode ? 'bg-white/[0.06]' : 'bg-slate-100'"></div>

    {{-- Type, Episodes, Source --}}
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('type') }}</label>
            <x-ui.select model="type" :options="collect($types)->map(fn($t) => ['value' => $t, 'label' => $t])->toArray()" placeholder="Select type" teleport="true" />
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('episodes') }}</label>
            <x-ui.number-spinner model="episodes" placeholder="25" min="0" />
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('source') }}</label>
            <input type="text" wire:model="source" class="{{ $inputClass }}"
                   :class="darkMode
                       ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                       : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                   placeholder="Light novel">
        </div>
    </div>

    {{-- Studios, Premiered, Status --}}
    <div class="grid grid-cols-3 gap-4">
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('studios') }}</label>
            <input type="text" wire:model="studios" class="{{ $inputClass }}"
                   :class="darkMode
                       ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                       : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                   placeholder="Satelight">
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('premiered') }}</label>
            <input type="text" wire:model="premiered" class="{{ $inputClass }}"
                   :class="darkMode
                       ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                       : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                   placeholder="Fall 2013">
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('airing_status') }}</label>
            <input type="text" wire:model="status" class="{{ $inputClass }}"
                   :class="darkMode
                       ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                       : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                   placeholder="Finished Airing">
        </div>
    </div>
</div>
