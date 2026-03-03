{{-- Step 3: Personal Tracking (Watch Status, Score, Dates, Notes) --}}
@php $inputClass = "w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 transition-all duration-200"; @endphp

<div class="space-y-6">
    {{-- Section Title --}}
    <div class="af-section-title">
        <div class="af-section-icon"><i class="bi bi-person-heart"></i></div>
        <span class="af-section-text" :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('personal_tracking') }}</span>
    </div>

    {{-- Quick summary card of what you're tracking --}}
    <div class="rounded-xl p-4 border relative overflow-hidden"
         :class="darkMode ? 'bg-white/[0.02] border-white/[0.06]' : 'bg-slate-50/60 border-slate-100'"
         x-show="$wire.title">
        <div class="absolute -top-4 -right-4 w-16 h-16 rounded-full blur-2xl opacity-20"
             style="background: var(--gradient-end);"></div>
        <div class="flex items-center gap-3 relative z-10">
            {{-- Cover mini --}}
            <div class="w-10 h-14 rounded-lg overflow-hidden flex-shrink-0 shadow-lg"
                 :class="darkMode ? 'ring-1 ring-white/10' : 'ring-1 ring-slate-200'">
                <template x-if="$wire.image_url">
                    <img :src="$wire.image_url" class="w-full h-full object-cover">
                </template>
                <div x-show="!$wire.image_url" class="w-full h-full flex items-center justify-center"
                     style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                    <i class="bi bi-film text-white/60 text-xs"></i>
                </div>
            </div>
            <div class="min-w-0">
                <p class="text-sm font-bold truncate" :class="darkMode ? 'text-white' : 'text-slate-800'" x-text="$wire.title || '—'"></p>
                <p class="text-[11px] mt-0.5" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                    <span x-text="$wire.type || '—'"></span>
                    <span x-show="$wire.episodes"> · <span x-text="$wire.episodes"></span> eps</span>
                </p>
            </div>
        </div>
    </div>

    {{-- Watch Status & Score --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                <i class="bi bi-bookmark mr-1"></i>{{ __('watch_status') }} <span class="text-red-400">*</span>
            </label>
            <x-ui.select model="watch_status" :options="collect($watchStatuses)->map(fn($s) => ['value' => $s, 'label' => __(str_replace(' ', '_', $s))])->toArray()" placeholder="Select status" teleport="true" />
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                <i class="bi bi-star mr-1"></i>{{ __('personal_score') }}
            </label>
            <x-ui.select model="personal_score" :options="collect(range(10, 1))->map(fn($i) => ['value' => $i, 'label' => $i.'/10'])->prepend(['value' => '', 'label' => '-'])->toArray()" placeholder="Score" teleport="true" />
        </div>
    </div>

    {{-- Dates --}}
    <div class="grid grid-cols-2 gap-4">
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                <i class="bi bi-calendar-event mr-1"></i>{{ __('start_watching') }}
            </label>
            <x-ui.date-picker model="watch_start_date" placeholder="YYYY-MM-DD" />
        </div>
        <div>
            <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                <i class="bi bi-calendar-check mr-1"></i>{{ __('end_watching') }}
            </label>
            <x-ui.date-picker model="watch_end_date" placeholder="YYYY-MM-DD" />
        </div>
    </div>

    {{-- Divider --}}
    <div class="h-px w-full" :class="darkMode ? 'bg-white/[0.06]' : 'bg-slate-100'"></div>

    {{-- Notes --}}
    <div>
        <label class="block text-xs font-bold mb-2 uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            <i class="bi bi-journal-text mr-1"></i>{{ __('notes') }}
        </label>
        <textarea wire:model="notes" rows="3" class="{{ $inputClass }} resize-none custom-scrollbar"
                  :class="darkMode
                      ? 'bg-white/[0.03] border-white/[0.08] text-white placeholder-slate-600 focus:bg-white/[0.05] focus:border-white/[0.15] focus:ring-blue-500/20'
                      : 'bg-slate-50 border-slate-200 text-slate-700 placeholder-slate-400 focus:bg-white focus:border-blue-300 focus:ring-blue-500/20'"
                  placeholder="{{ __('personal_notes_placeholder') }}..."></textarea>
    </div>

    {{-- Ready to save indicator --}}
    <div class="rounded-xl p-4 border flex items-center gap-3"
         :class="darkMode ? 'bg-emerald-500/[0.06] border-emerald-400/10' : 'bg-emerald-50/60 border-emerald-200/50'">
        <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0"
             :class="darkMode ? 'bg-emerald-500/20 text-emerald-400' : 'bg-emerald-100 text-emerald-600'">
            <i class="bi bi-check-circle"></i>
        </div>
        <p class="text-xs font-medium" :class="darkMode ? 'text-emerald-300/80' : 'text-emerald-700'">
            {{ __('ready_to_save_hint') }}
        </p>
    </div>
</div>
