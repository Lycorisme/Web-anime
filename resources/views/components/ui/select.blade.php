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
    dropUp: false,
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
    rafId: null,
    getDropdownHeight() {
        // Each option ~40px + padding, max-h-60 = 240px
        const itemHeight = 40;
        const padding = 8;
        const estimated = (this.filteredOptions.length * itemHeight) + padding;
        return Math.min(estimated, 240);
    },
    getScrollParent(el) {
        // Walk up the DOM to find the nearest scrollable ancestor
        let node = el.parentElement;
        while (node) {
            const style = getComputedStyle(node);
            const overflowY = style.overflowY;
            if ((overflowY === 'auto' || overflowY === 'scroll') && node.scrollHeight > node.clientHeight) {
                return node;
            }
            node = node.parentElement;
        }
        return null;
    },
    isTriggerVisible() {
        // Check if trigger is still visible within its scroll parent
        const trigger = this.$refs.trigger;
        if (!trigger) return false;
        const rect = trigger.getBoundingClientRect();
        const scrollParent = this.getScrollParent(trigger);
        
        if (scrollParent) {
            const parentRect = scrollParent.getBoundingClientRect();
            // Trigger is clipped if it's completely above or below the scroll parent
            if (rect.bottom < parentRect.top || rect.top > parentRect.bottom) {
                return false;
            }
        }
        
        // Also check viewport bounds
        const vh = window.innerHeight;
        if (rect.bottom < 0 || rect.top > vh) {
            return false;
        }
        return true;
    },
    updatePosition() {
        const trigger = this.$refs.trigger;
        if (!trigger) return;
        const rect = trigger.getBoundingClientRect();
        const dropH = this.getDropdownHeight();
        const gap = 8;
        const vh = window.innerHeight;

        // Clamp available space to the scroll parent boundaries if inside one
        let visibleTop = 0;
        let visibleBottom = vh;
        const scrollParent = this.getScrollParent(trigger);
        if (scrollParent) {
            const parentRect = scrollParent.getBoundingClientRect();
            visibleTop = Math.max(0, parentRect.top);
            visibleBottom = Math.min(vh, parentRect.bottom);
        }

        const spaceBelow = visibleBottom - rect.bottom;
        const spaceAbove = rect.top - visibleTop;

        // Decide direction: prefer below, flip to above if not enough space below
        if (spaceBelow >= dropH + gap) {
            this.dropUp = false;
        } else if (spaceAbove >= dropH + gap) {
            this.dropUp = true;
        } else {
            // Pick whichever side has more space
            this.dropUp = spaceAbove > spaceBelow;
        }

        if (this.teleport) {
            const effectiveMaxH = Math.min(240, this.dropUp ? spaceAbove - gap : spaceBelow - gap);
            const actualDropH = Math.min(dropH, effectiveMaxH);
            const top = this.dropUp
                ? rect.top - actualDropH - gap
                : rect.bottom + gap;

            this.dropdownStyle = {
                position: 'fixed',
                top: `${Math.max(4, top)}px`,
                left: `${rect.left}px`,
                width: `${rect.width}px`,
                zIndex: 99999,
                maxHeight: `${Math.max(40, effectiveMaxH)}px`
            };
        }
    },
    startTracking() {
        const track = () => {
            if (!this.open) return;
            // Close if trigger scrolled out of view
            if (!this.isTriggerVisible()) {
                this.open = false;
                this.search = '';
                return;
            }
            this.updatePosition();
            this.rafId = requestAnimationFrame(track);
        };
        track();
    },
    stopTracking() {
        if (this.rafId) {
            cancelAnimationFrame(this.rafId);
            this.rafId = null;
        }
    },
    init() {
        this.$watch('open', value => {
            if (value) {
                this.$nextTick(() => {
                    this.updatePosition();
                    this.startTracking();
                });
            } else {
                this.stopTracking();
            }
        });
        window.addEventListener('resize', () => { if (this.open) this.updatePosition(); });
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

        @php
            $dropdownClasses = "rounded-xl shadow-2xl overflow-hidden custom-scrollbar max-h-60 overflow-y-auto ring-1 ring-black/5";
            $darkModeClasses = "bg-[#1e293b]/80 backdrop-blur-md ring-white/10";
            $lightModeClasses = "bg-white/80 backdrop-blur-md ring-slate-200";
        @endphp

        <!-- Standard Dropdown (Non-Teleport) -->
        <template x-if="!teleport">
            <div x-show="open" x-ref="dropdownLocal"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="absolute z-50 w-full {{ $dropdownClasses }}"
                 :class="[
                     darkMode ? '{{ $darkModeClasses }}' : '{{ $lightModeClasses }}',
                     dropUp ? 'bottom-full mb-2' : 'top-full mt-2'
                 ]"
                 style="display: none;">
                @include('components.ui.partials.select-options')
            </div>
        </template>

        <!-- Teleported Dropdown -->
        <template x-teleport="body">
            <div x-show="open && teleport" x-ref="dropdownTeleport"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="{{ $dropdownClasses }}"
                 :class="darkMode ? '{{ $darkModeClasses }}' : '{{ $lightModeClasses }}'"
                 :style="dropdownStyle"
                 style="display: none;">
                @include('components.ui.partials.select-options')
            </div>
        </template>

    </div>
</div>
