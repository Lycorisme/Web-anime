@props([
    'label' => '',
    'model' => null,
    'options' => [],
    'placeholder' => 'Select an option',
    'icon' => null,
    'searchable' => false,
    'teleport' => false
])

<div x-data="{
    open: false,
    selected: @entangle($model),
    search: '',
    options: {{ json_encode($options) }},
    teleport: {{ $teleport ? 'true' : 'false' }},
    triggerRect: null,
    dropdownStyle: {},
    get displayValue() {
        const option = this.options.find(o => o.value == this.selected);
        if (option) return option.label;
        return '{{ $placeholder }}';
    },
    get filteredOptions() {
        if (this.search === '') return this.options;
        return this.options.filter(o => o.label.toLowerCase().includes(this.search.toLowerCase()));
    },
    select(value) {
        this.selected = value;
        this.open = false;
        this.search = '';
    },
    isActive(value) {
        return this.selected == value;
    },
    updatePosition() {
        if (!this.teleport || !this.open) return;
        const trigger = this.$refs.trigger;
        const rect = trigger.getBoundingClientRect();
        
        this.dropdownStyle = {
            position: 'fixed',
            top: `${rect.bottom + 8}px`,
            left: `${rect.left}px`,
            width: `${rect.width}px`,
            zIndex: 99999
        };
    },
    init() {
        if (this.teleport) {
            this.$watch('open', value => {
                if (value) this.$nextTick(() => this.updatePosition());
            });
            window.addEventListener('resize', () => this.updatePosition());
            window.addEventListener('scroll', () => { if(this.open) this.open = false; }, true);
        }
    }
}" class="relative group space-y-2">

    @if($label)
        <label class="text-[10px] font-bold uppercase tracking-wider block"
               :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            {{ $label }}
        </label>
    @endif

    <div class="relative" @click.outside="open = false; search = ''">
        <!-- Trigger Button -->
        <button x-ref="trigger"
                @click="open = !open" 
                type="button"
                class="w-full pl-4 pr-10 py-3 rounded-xl border appearance-none focus:outline-none transition-all text-xs sm:text-sm font-medium cursor-pointer flex items-center justify-between group"
                :class="[
                    darkMode ? 'bg-white/5 border-white/10 text-white hover:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 hover:bg-slate-100',
                    open ? 'ring-2 ring-blue-500/50 border-blue-500/50' : ''
                ]">
            
            <div class="flex items-center gap-3 overflow-hidden">
                @if($icon)
                    <i class="{{ $icon }} text-lg" :class="selected ? 'text-blue-500' : 'text-slate-400'"></i>
                @endif
                <span class="truncate" :class="selected ? '' : 'text-slate-400'">
                    <span x-text="displayValue"></span>
                </span>
            </div>

            <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none transition-transform duration-300"
                 :class="open ? 'rotate-180' : ''">
                <i class="bi bi-chevron-down text-xs text-slate-400"></i>
            </div>
        </button>

        <!-- Dropdown Template (Used for both Teleport and Normal) -->
        @php
            $dropdownClasses = "mt-2 rounded-xl shadow-2xl overflow-hidden custom-scrollbar max-h-60 overflow-y-auto ring-1 ring-black/5";
            $darkModeClasses = "bg-[#1e293b]/80 backdrop-blur-md ring-white/10";
            $lightModeClasses = "bg-white/80 backdrop-blur-md ring-slate-200";
        @endphp

        <!-- Standard Dropdown (Non-Teleport) -->
        <template x-if="!teleport">
            <div x-show="open" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                 class="absolute z-50 w-full {{ $dropdownClasses }}"
                 :class="darkMode ? '{{ $darkModeClasses }}' : '{{ $lightModeClasses }}'"
                 style="display: none;">
                @include('components.ui.partials.select-options')
            </div>
        </template>

        <!-- Teleported Dropdown -->
        <template x-teleport="body">
            <div x-show="open && teleport" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 translate-y-2 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-2 scale-95"
                 class="{{ $dropdownClasses }}"
                 :class="darkMode ? '{{ $darkModeClasses }}' : '{{ $lightModeClasses }}'"
                 :style="dropdownStyle"
                 style="display: none;">
                @include('components.ui.partials.select-options')
            </div>
        </template>


    </div>
</div>
