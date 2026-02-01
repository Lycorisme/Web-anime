{{-- Premium Dashboard Header - Smooth UX Animations --}}
<header 
    x-data="{ 
        isScrolled: false,
        searchOpen: false,
        mounted: false
    }"
    x-init="setTimeout(() => mounted = true, 50)"
    @scroll.window="isScrolled = (window.scrollY > 20)"
    @keydown.escape.window="searchOpen = false"
    class="flex items-center justify-between gap-3 px-4 lg:px-8 mb-2 relative z-30"
    :class="{
        'opacity-100': mounted,
        'opacity-0': !mounted,
        'glass-card py-3 shadow-lg': isScrolled,
        'pt-4 lg:pt-8': !isScrolled
    }"
    style="transition: opacity 0.4s ease-out, padding 0.5s ease, background 0.5s ease, box-shadow 0.5s ease;">

    {{-- Left Section --}}
    <div class="flex items-center gap-2 sm:gap-3"
         :class="mounted ? 'translate-x-0 opacity-100' : '-translate-x-4 opacity-0'"
         style="transition: transform 0.5s ease-out 0.1s, opacity 0.5s ease-out 0.1s;">
        
        {{-- Sidebar Toggle --}}
        <button @click="sidebarOpen = !sidebarOpen" 
                class="p-2.5 sm:p-3 rounded-xl sm:rounded-2xl flex-shrink-0 group"
                :class="darkMode 
                    ? 'glass-card text-slate-400 hover:text-blue-400' 
                    : 'bg-white shadow-md text-slate-500 hover:text-blue-500 hover:shadow-lg'"
                style="transition: all 0.25s ease;">
            <i class="bi text-lg sm:text-xl" 
               :class="sidebarOpen ? 'bi-text-indent-left' : 'bi-text-indent-right'"
               style="transition: transform 0.3s ease;"></i>
        </button>
        
        {{-- Search - Icon Only on Mobile --}}
        <div class="relative">
            {{-- Mobile Search Toggle --}}
            <button @click="searchOpen = !searchOpen"
                    class="p-2.5 sm:p-3 rounded-xl sm:rounded-2xl flex-shrink-0 sm:hidden"
                    :class="[
                        darkMode 
                            ? 'glass-card text-slate-400 hover:text-blue-400' 
                            : 'bg-white shadow-md text-slate-500 hover:text-blue-500',
                        searchOpen ? 'ring-2 ring-blue-500/50' : ''
                    ]"
                    style="transition: all 0.25s ease;">
                <i class="bi text-lg" :class="searchOpen ? 'bi-x-lg' : 'bi-search'"></i>
            </button>

            {{-- Desktop Search Bar --}}
            <div class="hidden sm:flex items-center px-4 py-2.5 rounded-2xl flex-1 max-w-md group"
                 :class="darkMode 
                     ? 'glass-card focus-within:ring-2 focus-within:ring-blue-500/40' 
                     : 'bg-white shadow-md focus-within:shadow-lg focus-within:ring-2 focus-within:ring-blue-500/30'"
                 style="transition: all 0.3s ease;">
                <i class="bi bi-search mr-3 flex-shrink-0"
                   :class="darkMode ? 'text-slate-400 group-focus-within:text-blue-400' : 'text-slate-400 group-focus-within:text-blue-500'"
                   style="transition: color 0.2s ease;"></i>
                <input type="text" 
                       placeholder="Cari anime, genre, atau karakter..." 
                       class="bg-transparent border-none outline-none text-sm w-full placeholder-slate-400"
                       :class="darkMode ? 'text-slate-200' : 'text-slate-700'">
                <div class="flex items-center gap-1 ml-3 flex-shrink-0">
                    <kbd class="text-[9px] px-1.5 py-0.5 rounded font-mono"
                         :class="darkMode ? 'bg-slate-700/80 text-slate-400' : 'bg-slate-100 text-slate-500'">⌘</kbd>
                    <kbd class="text-[9px] px-1.5 py-0.5 rounded font-mono"
                         :class="darkMode ? 'bg-slate-700/80 text-slate-400' : 'bg-slate-100 text-slate-500'">K</kbd>
                </div>
            </div>

            {{-- Mobile Search Overlay --}}
            <div x-show="searchOpen"
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-95 -translate-y-2"
                 @click.away="searchOpen = false"
                 class="absolute top-full left-0 mt-2 w-[calc(100vw-2rem)] sm:hidden z-50">
                <div class="flex items-center px-4 py-3 rounded-2xl"
                     :class="darkMode 
                         ? 'bg-slate-800/95 backdrop-blur-xl ring-1 ring-white/10 shadow-2xl' 
                         : 'bg-white shadow-2xl ring-1 ring-slate-200'">
                    <i class="bi bi-search mr-3"
                       :class="darkMode ? 'text-blue-400' : 'text-blue-500'"></i>
                    <input type="text" 
                           placeholder="Cari anime..." 
                           class="bg-transparent border-none outline-none text-sm w-full placeholder-slate-400"
                           :class="darkMode ? 'text-slate-200' : 'text-slate-700'"
                           x-ref="mobileSearch"
                           x-effect="if(searchOpen) $nextTick(() => $refs.mobileSearch.focus())">
                </div>
            </div>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="flex items-center gap-2 sm:gap-3"
         :class="mounted ? 'translate-x-0 opacity-100' : 'translate-x-4 opacity-0'"
         style="transition: transform 0.5s ease-out 0.2s, opacity 0.5s ease-out 0.2s;">
        
        {{-- Notifications --}}
        <button class="relative p-2.5 sm:p-3 rounded-xl sm:rounded-2xl group"
                :class="darkMode 
                    ? 'glass-card text-slate-400 hover:text-blue-400' 
                    : 'bg-white shadow-md text-slate-500 hover:text-blue-500'"
                style="transition: all 0.25s ease;">
            <i class="bi bi-bell text-lg group-hover:animate-wiggle"></i>
            {{-- Badge --}}
            <span class="absolute top-1.5 right-1.5 sm:top-2 sm:right-2 flex h-2.5 w-2.5">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-rose-500 border-2"
                      :class="darkMode ? 'border-slate-800' : 'border-white'"></span>
            </span>
        </button>
        
        {{-- Dark Mode Toggle --}}
        <button @click="toggleDarkMode()" 
                class="p-2.5 sm:p-3 rounded-xl sm:rounded-2xl overflow-hidden"
                :class="darkMode 
                    ? 'glass-card text-yellow-400 hover:text-yellow-300' 
                    : 'bg-white shadow-md text-indigo-500 hover:text-indigo-600'"
                style="transition: all 0.25s ease;">
            <i class="bi text-lg inline-block" 
               :class="darkMode ? 'bi-sun-fill' : 'bi-moon-stars-fill'"
               style="transition: transform 0.5s ease;"></i>
        </button>
        
        {{-- User Profile --}}
        <div class="flex items-center gap-2 sm:gap-3 p-1.5 sm:p-2 pr-3 sm:pr-4 lg:pr-5 rounded-xl sm:rounded-2xl cursor-pointer group"
             :class="darkMode 
                 ? 'glass-card hover:bg-white/5' 
                 : 'bg-white shadow-md hover:shadow-lg'"
             style="transition: all 0.25s ease;">
            
            {{-- Avatar --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg sm:rounded-xl blur opacity-0 group-hover:opacity-50"
                     style="transition: opacity 0.3s ease;"></div>
                <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff&bold=true" 
                     class="relative w-8 h-8 sm:w-10 sm:h-10 rounded-lg sm:rounded-xl ring-2"
                     :class="darkMode ? 'ring-white/20' : 'ring-blue-100'"
                     alt="User"
                     style="transition: transform 0.25s ease;">
            </div>
            
            {{-- User Info --}}
            <div class="hidden lg:block">
                <p class="text-sm font-semibold leading-none"
                   :class="darkMode ? 'text-white' : 'text-slate-700'">Alex Christie</p>
                <p class="text-[10px] font-medium mt-1"
                   :class="darkMode ? 'text-blue-400' : 'text-blue-500'">Administrator</p>
            </div>
            
            {{-- Arrow --}}
            <i class="bi bi-chevron-down text-xs hidden lg:block"
               :class="darkMode ? 'text-slate-400 group-hover:text-slate-300' : 'text-slate-400 group-hover:text-slate-600'"
               style="transition: transform 0.3s ease;"></i>
        </div>
    </div>
</header>

<style>
@keyframes wiggle {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(-8deg); }
    75% { transform: rotate(8deg); }
}
.group:hover .group-hover\:animate-wiggle {
    animation: wiggle 0.4s ease-in-out;
}
</style>
