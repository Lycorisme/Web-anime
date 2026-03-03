{{-- Anime Form Modal — Premium Wizard Design --}}
<template x-teleport="body">
    <div x-show="showModal"
         x-data="{
            currentStep: 1,
            totalSteps: 3,
            direction: 'forward',
            get isLastStep() { return this.currentStep === this.totalSteps },
            get minStep() { return this.$wire.isEditing ? 1 : 0 },
            get isFirstStep() { return this.currentStep <= this.minStep },
            goTo(step) {
                if (step === this.currentStep) return;
                this.direction = step > this.currentStep ? 'forward' : 'backward';
                this.currentStep = step;
            },
            next() { if (!this.isLastStep) this.goTo(this.currentStep + 1) },
            prev() { if (!this.isFirstStep) this.goTo(this.currentStep - 1) },
            steps: [
                { id: 1, icon: 'bi-film',          label: '{{ __("basic_info_step") }}',    desc: '{{ __("title_type_source") }}' },
                { id: 2, icon: 'bi-image',          label: '{{ __("details_media") }}',      desc: '{{ __("genres_synopsis_image") }}' },
                { id: 3, icon: 'bi-person-heart',   label: '{{ __("personal_tracking") }}',  desc: '{{ __("score_status_dates") }}' }
            ]
         }"
         x-init="$watch('showModal', v => { if(v) currentStep = ($wire.isEditing ? 1 : 0) })"
         @mal-parsed.window="currentStep = 1"
         class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
         style="display: none;">

        {{-- Backdrop --}}
        <div x-show="showModal" class="absolute inset-0 bg-black/60 backdrop-blur-md"
             x-transition:enter="ease-out duration-400" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="showModal = false; $wire.resetInputFields()"></div>

        {{-- Modal Container --}}
        <div x-show="showModal"
             class="af-modal relative w-full max-w-4xl max-h-[88vh] rounded-2xl shadow-2xl overflow-hidden border flex flex-col"
             :class="darkMode ? 'bg-[#0f172a]/95 border-white/[0.08] shadow-black/50' : 'bg-white/95 border-slate-200/80 shadow-slate-400/20'"
             style="backdrop-filter: blur(40px) saturate(1.5);"
             x-transition:enter="ease-out duration-400" x-transition:enter-start="opacity-0 translate-y-6 scale-[0.96]" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="ease-in duration-250" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-6 scale-[0.96]">

            {{-- Ambient glow --}}
            <div class="absolute -top-32 -right-32 w-64 h-64 rounded-full opacity-20 pointer-events-none blur-3xl"
                 style="background: var(--gradient-start);"></div>
            <div class="absolute -bottom-32 -left-32 w-64 h-64 rounded-full opacity-15 pointer-events-none blur-3xl"
                 style="background: var(--gradient-end);"></div>

            {{-- ═══ Header ═══ --}}
            <div class="relative z-10 flex-shrink-0 px-6 py-4 border-b flex items-center justify-between"
                 :class="darkMode ? 'border-white/[0.06] bg-white/[0.02]' : 'border-slate-100 bg-slate-50/30'">
                <div class="flex items-center gap-3">
                    <div class="af-icon-box w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg relative overflow-hidden"
                         style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                        <i class="bi relative z-10" :class="$wire.isEditing ? 'bi-pencil-square' : 'bi-plus-circle'"></i>
                        <div class="absolute inset-0 bg-white/10 opacity-0 hover:opacity-100 transition-opacity"></div>
                    </div>
                    <div>
                        <h3 class="font-extrabold text-base leading-tight" :class="darkMode ? 'text-white' : 'text-slate-800'">
                            <span x-text="$wire.isEditing ? '{{ __('edit_anime') }}' : '{{ __('add_anime') }}'"></span>
                        </h3>
                        <p class="text-[11px] font-medium mt-0.5" :class="darkMode ? 'text-slate-500' : 'text-slate-400'"
                           x-show="currentStep > 0">
                            <span x-text="steps[currentStep - 1]?.label || ''"></span>
                            <span class="mx-1">·</span>
                            <span x-text="'Step ' + currentStep + '/' + totalSteps"></span>
                        </p>
                    </div>
                </div>
                <button @click="showModal = false; $wire.resetInputFields()"
                        class="w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-200"
                        :class="darkMode ? 'text-slate-500 hover:text-white hover:bg-white/10' : 'text-slate-400 hover:text-slate-700 hover:bg-slate-100'">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            {{-- ═══ Body: Sidebar + Content ═══ --}}
            <div class="flex flex-1 overflow-hidden relative z-10">

                {{-- ── Left Sidebar: Step Navigation ── --}}
                <div class="af-sidebar flex-shrink-0 w-56 border-r flex flex-col justify-between py-5 px-4"
                     :class="darkMode ? 'border-white/[0.06] bg-white/[0.015]' : 'border-slate-100 bg-slate-50/40'"
                     x-show="currentStep > 0">

                    <div class="space-y-1">
                        <template x-for="step in steps" :key="step.id">
                            <button @click="goTo(step.id)"
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
                                         :class="{
                                            '': currentStep === step.id,
                                            '': currentStep > step.id,
                                         }"
                                         :style="currentStep >= step.id
                                            ? 'background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); color: white; box-shadow: 0 4px 15px -3px color-mix(in srgb, var(--gradient-start) 50%, transparent);'
                                            : (darkMode ? 'background: rgba(255,255,255,0.05); color: rgba(148,163,184,0.6);' : 'background: rgb(241,245,249); color: rgba(148,163,184,0.8);')"
                                    >
                                        <i class="bi" :class="currentStep > step.id ? 'bi-check-lg' : step.icon"></i>
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
                    <div class="mt-6 px-1">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[10px] font-bold uppercase tracking-wider"
                                  :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('progress') }}</span>
                            <span class="text-[10px] font-bold"
                                  :class="darkMode ? 'text-slate-400' : 'text-slate-500'"
                                  x-text="Math.round((currentStep / totalSteps) * 100) + '%'"></span>
                        </div>
                        <div class="h-1.5 rounded-full overflow-hidden"
                             :class="darkMode ? 'bg-white/[0.06]' : 'bg-slate-200'">
                            <div class="h-full rounded-full transition-all duration-500 ease-out"
                                 style="background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));"
                                 :style="'width: ' + ((currentStep / totalSteps) * 100) + '%'"></div>
                        </div>
                    </div>
                </div>

                {{-- ── Right Content Area ── --}}
                <div class="flex-1 overflow-y-auto custom-scrollbar relative">
                    @php $inputClass = "w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 transition-all duration-200"; @endphp

                    {{-- ▸ Step 0: MAL Paste (only when adding) --}}
                    <div x-show="currentStep === 0 && !$wire.isEditing"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="p-6">
                        @include('livewire.partials.anime-form-paste-tab')
                    </div>

                    {{-- ▸ Step 1: Basic Info --}}
                    <div x-show="currentStep === 1"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="p-6">
                        @include('livewire.partials.anime-form-step-basic')
                    </div>

                    {{-- ▸ Step 2: Details & Media --}}
                    <div x-show="currentStep === 2"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="p-6">
                        @include('livewire.partials.anime-form-step-details')
                    </div>

                    {{-- ▸ Step 3: Personal Tracking --}}
                    <div x-show="currentStep === 3"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="p-6">
                        @include('livewire.partials.anime-form-step-tracking')
                    </div>
                </div>
            </div>

            {{-- ═══ Footer ═══ --}}
            <div class="relative z-10 flex-shrink-0 px-6 py-4 border-t flex items-center justify-between"
                 :class="darkMode ? 'border-white/[0.06] bg-white/[0.02]' : 'border-slate-100 bg-slate-50/30'">

                {{-- Left side --}}
                <div>
                    {{-- Back --}}
                    <button x-show="currentStep > minStep"
                            @click="prev()"
                            class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 flex items-center gap-2"
                            :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/5' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-100'">
                        <i class="bi bi-arrow-left"></i>
                        {{ __('back') }}
                    </button>

                    {{-- Skip MAL paste --}}
                    <button x-show="currentStep === 0 && !$wire.isEditing"
                            @click="goTo(1)"
                            class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 flex items-center gap-2"
                            :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/5' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-100'">
                        <i class="bi bi-skip-forward"></i>
                        {{ __('skip_manual_input') }}
                    </button>
                </div>

                {{-- Right side --}}
                <div class="flex items-center gap-3">
                    {{-- Cancel --}}
                    <button @click="showModal = false; $wire.resetInputFields()"
                            class="px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200"
                            :class="darkMode ? 'text-slate-500 hover:text-slate-300 hover:bg-white/5' : 'text-slate-400 hover:text-slate-600 hover:bg-slate-100'">
                        {{ __('cancel') }}
                    </button>

                    {{-- Next / Save --}}
                    <button x-show="!isLastStep && currentStep > 0"
                            @click="next()"
                            class="af-btn-next px-6 py-2.5 rounded-xl text-sm font-bold text-white shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center gap-2"
                            style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); box-shadow: 0 8px 20px -4px color-mix(in srgb, var(--gradient-start) 40%, transparent);">
                        {{ __('next') }}
                        <i class="bi bi-arrow-right"></i>
                    </button>

                    <button x-show="isLastStep"
                            wire:click="{{ $isEditing ? 'update' : 'store' }}"
                            class="af-btn-save px-6 py-2.5 rounded-xl text-sm font-bold text-white shadow-lg transition-all duration-200 transform hover:-translate-y-0.5 flex items-center gap-2"
                            style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); box-shadow: 0 8px 20px -4px color-mix(in srgb, var(--gradient-start) 40%, transparent);">
                        <i class="bi" :class="$wire.isEditing ? 'bi-check-lg' : 'bi-plus-circle'"></i>
                        <span x-text="$wire.isEditing ? '{{ __('save') }}' : '{{ __('add_anime') }}'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<style>
    /* ── Anime Form Modal Specific Styles ── */
    .af-modal {
        animation: af-glow-pulse 4s ease-in-out infinite alternate;
    }
    @keyframes af-glow-pulse {
        0%   { box-shadow: 0 0 40px -10px color-mix(in srgb, var(--gradient-start) 15%, transparent); }
        100% { box-shadow: 0 0 60px -10px color-mix(in srgb, var(--gradient-end) 20%, transparent); }
    }

    .af-step-btn.af-step-active {
        background: color-mix(in srgb, var(--gradient-start) 8%, transparent);
    }
    [x-data] .dark .af-step-btn.af-step-active,
    .af-step-btn.af-step-active {
        border: 1px solid color-mix(in srgb, var(--gradient-start) 15%, transparent);
    }

    .af-step-btn.af-step-completed {
        opacity: 0.7;
    }
    .af-step-btn.af-step-completed:hover {
        opacity: 1;
    }

    .af-step-btn.af-step-pending {
        opacity: 0.45;
    }
    .af-step-btn.af-step-pending:hover {
        opacity: 0.7;
    }

    .af-btn-next:active,
    .af-btn-save:active {
        transform: translateY(0) scale(0.98);
    }

    /* Section headers inside steps */
    .af-section-title {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.25rem;
    }
    .af-section-title .af-section-icon {
        width: 2rem;
        height: 2rem;
        border-radius: 0.625rem;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        color: white;
        background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
        box-shadow: 0 4px 12px -2px color-mix(in srgb, var(--gradient-start) 35%, transparent);
    }
    .af-section-title .af-section-text {
        font-size: 0.8rem;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    /* Responsive: collapse sidebar on mobile */
    @media (max-width: 640px) {
        .af-sidebar {
            display: none !important;
        }
        .af-modal {
            max-width: 100%;
            max-height: 95vh;
            border-radius: 1rem;
        }
    }
</style>
