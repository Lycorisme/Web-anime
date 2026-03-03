{{-- Anime Form Modal — Premium Wizard Design --}}
<template x-teleport="body">
    <div x-show="showModal"
         x-data="{
            currentStep: 1,
            totalSteps: 4,
            direction: 'forward',
            get isLastStep() { return this.currentStep === this.totalSteps },
            get minStep() { return this.$wire.isEditing ? 2 : 1 },
            get isFirstStep() { return this.currentStep <= this.minStep },
            goTo(step) {
                if (step === this.currentStep) return;
                this.direction = step > this.currentStep ? 'forward' : 'backward';
                this.currentStep = step;
            },
            next() { if (!this.isLastStep) this.goTo(this.currentStep + 1) },
            prev() { if (!this.isFirstStep) this.goTo(this.currentStep - 1) },
            get filledCount() {
                const fields = [
                    this.$wire.title, this.$wire.title_english, this.$wire.title_japanese, 
                    this.$wire.type, this.$wire.episodes, this.$wire.source, 
                    this.$wire.studios, this.$wire.premiered, this.$wire.status, 
                    this.$wire.genres, this.$wire.themes, this.$wire.synopsis, 
                    this.$wire.image_url, this.$wire.mal_score, this.$wire.official_site, 
                    this.$wire.watch_status, this.$wire.personal_score, 
                    this.$wire.watch_start_date, this.$wire.watch_end_date, this.$wire.notes
                ];
                return fields.filter(f => f !== null && f !== '' && f !== undefined).length;
            },
            get totalFields() { return 20; },
            get progressPercent() { return Math.max(0, Math.min(100, Math.round((this.filledCount / this.totalFields) * 100))); },
            get isAllFilled() { return this.filledCount === this.totalFields; },
            get shouldShowSave() {
                if (!this.showModal) return false;
                if (this.$wire.isEditing) {
                    return this.isHoveringBottom;
                }
                return this.isAllFilled;
            },
            
            morph: false,
            out: false,
            isHoveringBottom: false,
            async saveAction() {
                const s = this.$refs.s;
                if (!s) return;
                const w = s.offsetWidth, h = s.offsetHeight;
                const sz = Math.max(h, 46);
                s.style.width = w + 'px';
                s.style.height = h + 'px';
                void s.offsetHeight;

                this.morph = true;

                requestAnimationFrame(() => {
                    s.style.width = sz + 'px';
                    s.style.height = sz + 'px';
                });

                if (this.$wire.isEditing) {
                    await this.$wire.update();
                } else {
                    await this.$wire.store();
                }

                setTimeout(() => {
                    this.out = true;
                    setTimeout(() => {
                        this.morph = false;
                        this.out = false;
                        s.style.width = '';
                        s.style.height = '';
                        this.showModal = false;
                    }, 600);
                }, 1000);
            },
            steps: [
                { id: 1, icon: 'bi-clipboard',     label: '{{ __("quick_import") }}',       desc: '{{ __("paste_from_mal") }}' },
                { id: 2, icon: 'bi-film',          label: '{{ __("basic_info_step") }}',    desc: '{{ __("title_type_source") }}' },
                { id: 3, icon: 'bi-image',         label: '{{ __("details_media") }}',      desc: '{{ __("genres_synopsis_image") }}' },
                { id: 4, icon: 'bi-person-heart',  label: '{{ __("personal_tracking") }}',  desc: '{{ __("score_status_dates") }}' }
            ]
         }"
         x-init="$watch('showModal', v => { if(v) currentStep = ($wire.isEditing ? 2 : 1) })"
         @mal-parsed.window="currentStep = 2"
         class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
         style="display: none;"
         @mousemove="if ($wire.isEditing) { isHoveringBottom = ($event.clientY > window.innerHeight - 150) }">

        {{-- Backdrop --}}
        <div x-show="showModal" class="absolute inset-0 bg-black/60 backdrop-blur-md"
             x-transition:enter="ease-out duration-400" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        {{-- Modal Container --}}
        <div x-show="showModal"
             class="af-modal relative w-full max-w-4xl h-[85vh] lg:h-[700px] max-h-[90vh] rounded-2xl shadow-2xl overflow-hidden border flex flex-col"
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
                <button type="button" @click="showModal = false; $wire.resetInputFields()"
                        class="w-9 h-9 rounded-xl flex items-center justify-center transition-all duration-200"
                        :class="darkMode ? 'text-slate-500 hover:text-white hover:bg-white/10' : 'text-slate-400 hover:text-slate-700 hover:bg-slate-100'">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            {{-- ═══ Body: Sidebar + Content ═══ --}}
            <div class="flex flex-1 overflow-hidden relative z-10">

                @include('livewire.partials.anime-form-sidebar')

                {{-- ── Right Content Area ── --}}
                <div class="flex-1 relative overflow-hidden bg-transparent">
                    @php $inputClass = "w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 transition-all duration-200"; @endphp

                    {{-- ▸ Step 1: MAL Paste (only when adding) --}}
                    <div x-show="currentStep === 1 && !$wire.isEditing"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="absolute inset-0 flex flex-col p-6 h-full">
                        <div class="flex-1 overflow-y-auto af-no-scrollbar">
                            @include('livewire.partials.anime-form-paste-tab')
                        </div>
                    </div>

                    {{-- ▸ Step 2: Basic Info --}}
                    <div x-show="currentStep === 2"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="absolute inset-0 flex flex-col p-6 h-full">
                        <div class="flex-1 overflow-y-auto af-no-scrollbar">
                            @include('livewire.partials.anime-form-step-basic')
                        </div>
                    </div>

                    {{-- ▸ Step 3: Details & Media --}}
                    <div x-show="currentStep === 3"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="absolute inset-0 flex flex-col p-6 h-full">
                        <div class="flex-1 overflow-y-auto af-no-scrollbar">
                            @include('livewire.partials.anime-form-step-details')
                        </div>
                    </div>

                    {{-- ▸ Step 4: Personal Tracking --}}
                    <div x-show="currentStep === 4"
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-x-4"
                         x-transition:enter-end="opacity-100 translate-x-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-x-0"
                         x-transition:leave-end="opacity-0 -translate-x-4"
                         class="absolute inset-0 flex flex-col p-6 h-full">
                        <div class="flex-1 overflow-y-auto af-no-scrollbar">
                            @include('livewire.partials.anime-form-step-tracking')
                        </div>
                    </div>
                </div>
            </div>

            {{-- ═══ Footer ═══ --}}
            <div class="relative z-10 flex-shrink-0 px-6 py-4 border-t flex flex-wrap sm:flex-nowrap items-center justify-between gap-4"
                 :class="darkMode ? 'border-white/[0.06] bg-white/[0.02]' : 'border-slate-100 bg-slate-50/30'">

                {{-- Left side --}}
                <div class="flex items-center gap-2 w-full sm:w-auto order-2 sm:order-1 sm:flex-1">
                    {{-- Back --}}
                    <button type="button" 
                            @click="prev()"
                            :disabled="isFirstStep"
                            class="w-full sm:w-auto px-4 py-2.5 rounded-xl text-sm font-bold transition-all duration-200 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed border"
                            :class="darkMode ? 'text-slate-300 border-white/10 hover:bg-white/5' : 'text-slate-600 border-slate-200 hover:bg-slate-50'">
                        <i class="bi bi-arrow-left"></i>
                        {{ __('back') }}
                    </button>
                </div>

                {{-- Right side --}}
                <div class="flex items-center gap-2 w-full sm:w-auto justify-end order-1 sm:order-2">
                    {{-- Next --}}
                    <button type="button"
                            @click="next()"
                            :disabled="isLastStep"
                            class="af-btn-next px-6 py-2.5 rounded-xl text-sm font-bold text-white transition-all duration-200 flex items-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none"
                            :class="!isLastStep ? 'shadow-lg hover:-translate-y-0.5' : ''"
                            style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));"
                            :style="!isLastStep ? 'box-shadow: 0 8px 20px -4px color-mix(in srgb, var(--gradient-start) 40%, transparent);' : ''">
                        {{ __('next') }}
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Floating Bulk Action for Save --}}
        <div x-show="shouldShowSave" x-cloak class="bp bp--fixed" style="display:none; position: fixed; bottom: 30px; left: 50%; transform: translateX(-50%); z-index: 100000;"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-300"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95"
             @mouseenter="if ($wire.isEditing) { isHoveringBottom = true }"
             @mouseleave="if ($wire.isEditing) { isHoveringBottom = false }">
            <div class="bp__s" x-ref="s" :class="{'bp__s--morph': morph, 'bp__s--exit': out}">
                <div class="bp__ring"></div>
                <div class="bp__row">
                    <div class="bp__info" x-show="!$wire.isEditing">
                        <div class="bp__n" x-text="filledCount"></div>
                        <span class="bp__t">/ <span x-text="totalFields"></span> {{ __('filled_data', ['default' => 'Data Terisi']) }}</span>
                    </div>

                    <div class="bp__info" x-show="$wire.isEditing">
                        <span class="bp__t"><i class="bi bi-pencil-square mr-1"></i> {{ __('edit_mode', ['default' => 'Mode Edit']) }}</span>
                    </div>

                    <button type="button" @click="saveAction()" class="bp__b bp__b--d" style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); border: none; color: white; margin-left: auto;">
                        <i class="bi" :class="$wire.isEditing ? 'bi-check-lg' : 'bi-save'"></i>
                        <span x-text="$wire.isEditing ? '{{ __('save_changes') ?? __('save') }}' : '{{ __('save') }}'"></span>
                    </button>
                </div>
                
                {{-- Checkmark --}}
                <div class="bp__ok">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                         stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                        <polyline class="bp__ok-p" points="20 6 9 17 4 12"></polyline>
                    </svg>
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

    /* Hide scrollbar for step contents */
    .af-no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .af-no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
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
