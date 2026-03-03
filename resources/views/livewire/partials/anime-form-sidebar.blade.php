{{-- ── Left Sidebar: Step Navigation ── --}}
<div class="af-sidebar flex-shrink-0 w-56 border-r flex flex-col justify-between py-5 px-4"
     :class="darkMode ? 'border-white/[0.06] bg-white/[0.015]' : 'border-slate-100 bg-slate-50/40'"
     x-show="currentStep > 0">

    <div class="space-y-1">
        <template x-for="step in steps" :key="step.id">
            <button type="button" @click="goTo(step.id)"
                    x-show="!($wire.isEditing && step.id === 1)"
                    class="af-step-btn w-full flex items-start gap-3 px-3 py-3 rounded-xl text-left transition-all duration-300 group relative"
                    :class="{
                        'af-step-active': currentStep === step.id,
                        'af-step-completed': currentStep > step.id,
                        'af-step-pending': currentStep < step.id,
                    }">

                {{-- Step indicator dot + line --}}
                <div class="flex flex-col items-center flex-shrink-0 pt-0.5">
                    {{-- Circle --}}
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-300 text-sm"
                         :style="currentStep >= step.id
                            ? 'background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); color: white; box-shadow: 0 4px 15px -3px color-mix(in srgb, var(--gradient-start) 50%, transparent);'
                            : (darkMode ? 'background: rgba(255,255,255,0.05); color: rgba(148,163,184,0.6);' : 'background: rgb(241,245,249); color: rgba(148,163,184,0.8);')"
                    >
                        <i class="bi" :class="step.icon"></i>
                    </div>
                </div>

                {{-- Label --}}
                <div class="flex-1 min-w-0">
                    <span class="block text-xs font-bold leading-tight truncate transition-colors duration-300"
                          :class="currentStep === step.id
                            ? (darkMode ? 'text-white' : 'text-slate-800')
                            : currentStep > step.id
                              ? (darkMode ? 'text-slate-300' : 'text-slate-600')
                              : (darkMode ? 'text-slate-500' : 'text-slate-400')">
                        <span x-text="step.label"></span>
                    </span>
                    <span class="block text-[10px] font-medium mt-0.5 truncate transition-colors duration-300"
                          :class="currentStep === step.id
                            ? (darkMode ? 'text-slate-400' : 'text-slate-500')
                            : (darkMode ? 'text-slate-600' : 'text-slate-400')">
                        <span x-text="step.desc"></span>
                    </span>
                </div>
            </button>
        </template>
    </div>

    {{-- Progress bar at bottom of sidebar --}}
    <div class="mt-6 px-1 relative">
        <div class="flex items-center justify-between mb-2">
            <span class="text-[10px] font-bold uppercase tracking-wider"
                  :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('progress') }}</span>
            <span class="text-[10px] font-bold"
                  :class="darkMode ? 'text-slate-400' : 'text-slate-500'"
                  x-text="progressPercent + '%'"></span>
        </div>
        <div class="h-1.5 rounded-full overflow-hidden relative"
             :class="darkMode ? 'bg-white/[0.06]' : 'bg-slate-200'">
            <div class="absolute inset-y-0 left-0 rounded-full transition-all duration-500 ease-out"
                 :style="`background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end)); width: ${progressPercent}%`">
                {{-- Pulse Overlay Animation --}}
                <div class="absolute inset-0 bg-white/20"
                     style="animation: progress-pulse 1.5s infinite linear; transform-origin: left; background-image: linear-gradient(45deg, rgba(255, 255, 255, 0.15) 25%, transparent 25%, transparent 50%, rgba(255, 255, 255, 0.15) 50%, rgba(255, 255, 255, 0.15) 75%, transparent 75%, transparent); background-size: 1rem 1rem;">
                </div>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes progress-pulse {
            0% { background-position: 1rem 0; }
            100% { background-position: 0 0; }
        }
    </style>
</div>
