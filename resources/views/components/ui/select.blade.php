@props([
    'label' => '',
    'model' => null,
    'options' => [],
    'placeholder' => 'Select an option',
    'icon' => null,
    'searchable' => false
])

<div x-data="{
    open: false,
    selected: @entangle($model),
    search: '',
    options: {{ json_encode($options) }},
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
        <button @click="open = !open" 
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

        <!-- Dropdown Menu -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-y-2 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-2 scale-95"
             class="absolute z-50 w-full mt-2 rounded-xl shadow-2xl overflow-hidden custom-scrollbar max-h-60 overflow-y-auto ring-1 ring-black/5"
             :class="darkMode ? 'bg-[#1e293b] ring-white/10' : 'bg-white ring-slate-200'"
             style="display: none;">

            @if($searchable)
                <div class="p-2 sticky top-0 z-10" :class="darkMode ? 'bg-[#1e293b]' : 'bg-white'">
                    <div class="relative">
                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                        <input x-model="search" 
                               type="text" 
                               placeholder="Search..." 
                               class="w-full pl-9 pr-3 py-2 rounded-lg text-xs border focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all placeholder:text-slate-500/50"
                               :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'">
                    </div>
                </div>
            @endif

            <ul class="py-1">
                <template x-for="option in filteredOptions" :key="option.value">
                    <li class="px-1.5 py-0.5">
                        <button @click="select(option.value)"
                                class="w-full text-left px-3 py-2.5 rounded-lg text-xs sm:text-sm transition-all flex items-center justify-between group relative overflow-hidden"
                                :style="isActive(option.value) ? 'background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));' : ''"
                                :class="[
                                    isActive(option.value) 
                                        ? 'text-white shadow-lg' 
                                        : (darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-white' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900')
                                ]">
                            <span x-text="option.label" class="relative z-10 font-bold"></span>
                            
                            <!-- Check Icon -->
                            <i class="bi bi-check-lg relative z-10 text-lg" 
                               x-show="isActive(option.value)"
                               x-transition:enter="transition-transform ease-out duration-300"
                               x-transition:enter-start="scale-50 opacity-0"
                               x-transition:enter-end="scale-100 opacity-100"></i>
                        </button>
                    </li>
                </template>
                <div x-show="filteredOptions.length === 0" class="px-4 py-3 text-xs text-center text-slate-500 italic">
                    No options found
                </div>
            </ul>
        </div>
    </div>
</div>
