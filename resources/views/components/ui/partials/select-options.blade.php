@if($searchable)
    <div class="p-2 sticky top-0 z-10" :class="darkMode ? 'bg-[#1e293b]/80 backdrop-blur-md' : 'bg-white/80 backdrop-blur-md'">
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
                    type="button"
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
