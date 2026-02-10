{{-- Header Component --}}
<header class="flex items-center justify-between gap-2 sm:gap-4 mb-6 sm:mb-10 animate-fade-in-up">
    {{-- Left Side --}}
    <div class="flex items-center gap-2 sm:gap-4 flex-1 min-w-0">
        {{-- Sidebar Toggle --}}
        <button 
            @click="$store.layout.toggle()" 
            class="p-2 sm:p-2.5 rounded-xl hover:bg-white/10 transition-all flex-shrink-0"
            :class="darkMode ? 'glass-card' : 'bg-white/15 backdrop-blur-md border border-white/30'"
        >
            <i data-lucide="menu" class="w-5 h-5 sm:w-6 sm:h-6"></i>
        </button>
        
        {{-- Search Box - Desktop --}}
        <div class="hidden md:flex flex-1 max-w-md">
            <div class="relative w-full group">
                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-blue-400 transition-colors"></i>
                <input 
                    type="text" 
                    placeholder="{{ __('search_placeholder') }}"
                    class="w-full pl-11 pr-4 py-3 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none text-sm placeholder:text-slate-400"
                    :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30'"
                >
                <kbd class="absolute right-3 top-1/2 -translate-y-1/2 hidden lg:flex items-center gap-1 px-2 py-1 rounded-md bg-white/5 text-[10px] text-slate-400 font-mono">
                    <span>⌘</span>
                    <span>K</span>
                </kbd>
            </div>
        </div>
        
        {{-- Search Icon - Mobile --}}
        <button 
            x-data="{ open: false }"
            @click="$dispatch('toggle-mobile-search')"
            class="md:hidden p-2.5 sm:p-3 rounded-xl hover:bg-white/10 transition-all"
            :class="darkMode ? 'glass-card' : 'bg-white/15 backdrop-blur-md border border-white/30'"
        >
            <i class="bi bi-search"></i>
        </button>
    </div>

    {{-- Right Side --}}
    <div class="flex items-center gap-2 sm:gap-3">
        {{-- Dark Mode Toggle --}}
        <button 
            @click="toggleDarkMode($event)" 
            class="relative p-2.5 sm:p-3 rounded-xl hover:scale-110 transition-all w-10 h-10 sm:w-12 sm:h-12 flex items-center justify-center overflow-hidden"
            :class="darkMode ? 'glass-card' : 'bg-white/15 backdrop-blur-md border border-white/30'"
            aria-label="Toggle Dark Mode"
        >
            <div class="relative w-5 h-5 sm:w-6 sm:h-6">
                <!-- Sun Icon (Show in Dark Mode to switch to Light) -->
                <i class="bi bi-sun-fill text-yellow-400 absolute inset-0 transition-all duration-500 transform"
                   :class="darkMode ? 'opacity-100 rotate-0 scale-100' : 'opacity-0 rotate-90 scale-0'"
                ></i>
                <!-- Moon Icon (Show in Light Mode to switch to Dark) -->
                <i class="bi bi-moon-stars-fill text-indigo-500 absolute inset-0 transition-all duration-500 transform"
                   :class="darkMode ? 'opacity-0 -rotate-90 scale-0' : 'opacity-100 rotate-0 scale-100'"
                ></i>
            </div>
        </button>
        
        {{-- User Profile --}}
        <div class="flex items-center gap-2 sm:gap-3 p-1.5 sm:p-2 pr-2 sm:pr-6 rounded-xl sm:rounded-2xl shadow-xl"
             :class="darkMode ? 'glass-card' : 'bg-white/15 backdrop-blur-md border border-white/30'">
            <img 
                src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff" 
                class="w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl" 
                alt="User"
            >
            <div class="hidden sm:block">
                <p class="text-sm font-bold leading-none">Alex Christie</p>
                <p class="text-[10px] gradient-text font-bold uppercase mt-1">{{ __('administrator') }}</p>
            </div>
        </div>
    </div>
</header>

{{-- Mobile Search Overlay --}}
<div 
    x-data="{ open: false }"
    @toggle-mobile-search.window="open = !open"
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @keydown.escape.window="open = false"
    class="md:hidden fixed inset-0 z-50 bg-black/50 backdrop-blur-sm"
    x-cloak
>
    <div class="p-4 pt-20">
        <div class="relative">
            <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-400"></i>
            <input 
                type="text" 
                placeholder="{{ __('search_placeholder') }}"
                class="w-full pl-11 pr-12 py-4 rounded-2xl glass-card border border-white/10 focus:border-blue-500 transition-all outline-none text-base"
                x-ref="searchInput"
                x-init="$watch('open', value => { if(value) setTimeout(() => $refs.searchInput.focus(), 100) })"
            >
            <button 
                @click="open = false"
                class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-white"
            >
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
    </div>
</div>
