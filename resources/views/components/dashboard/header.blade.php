{{-- Premium Dashboard Header --}}
<header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    {{-- Left Section - Hamburger + Search --}}
    <div class="flex items-center gap-3"
         x-show="true"
         x-transition:enter="transition ease-out duration-400"
         x-transition:enter-start="opacity-0 -translate-x-4"
         x-transition:enter-end="opacity-100 translate-x-0">
        
        {{-- Sidebar Toggle Button --}}
        <button @click="sidebarOpen = !sidebarOpen" 
                class="p-3 rounded-2xl transition-all duration-300 hover:scale-110 active:scale-95 group flex-shrink-0"
                :class="darkMode 
                    ? 'glass-card text-slate-400 hover:text-blue-400 hover:bg-white/10' 
                    : 'bg-white shadow-md text-slate-500 hover:text-blue-500 hover:shadow-lg'">
            <i class="bi text-xl transition-transform duration-500" 
               :class="sidebarOpen ? 'bi-text-indent-left' : 'bi-text-indent-right'"></i>
        </button>
        
        {{-- Search Bar --}}
        <div class="flex items-center px-4 py-2.5 rounded-2xl group transition-all duration-300 flex-1 max-w-md"
             :class="darkMode 
                 ? 'glass-card focus-within:ring-2 focus-within:ring-blue-500/30' 
                 : 'bg-white shadow-md focus-within:shadow-lg focus-within:ring-2 focus-within:ring-blue-500/20'">
            <i class="bi bi-search mr-3 transition-colors duration-300 flex-shrink-0"
               :class="darkMode ? 'text-slate-400 group-focus-within:text-blue-400' : 'text-slate-400 group-focus-within:text-blue-500'"></i>
            <input type="text" 
                   placeholder="Cari sesuatu..." 
                   class="bg-transparent border-none outline-none text-sm w-full placeholder-slate-400"
                   :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
            <div class="hidden sm:flex items-center gap-1 ml-3 flex-shrink-0">
                <kbd class="text-[9px] px-1.5 py-0.5 rounded font-mono"
                     :class="darkMode ? 'bg-slate-700 text-slate-400' : 'bg-slate-100 text-slate-500'">⌘</kbd>
                <kbd class="text-[9px] px-1.5 py-0.5 rounded font-mono"
                     :class="darkMode ? 'bg-slate-700 text-slate-400' : 'bg-slate-100 text-slate-500'">K</kbd>
            </div>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="flex items-center gap-3"
         x-show="true"
         x-transition:enter="transition ease-out duration-400 delay-100"
         x-transition:enter-start="opacity-0 translate-x-4"
         x-transition:enter-end="opacity-100 translate-x-0">
        
        {{-- Notifications with Animation --}}
        <button class="relative p-3 rounded-2xl transition-all duration-300 hover:scale-110 group"
                :class="darkMode 
                    ? 'glass-card text-slate-400 hover:text-blue-400' 
                    : 'bg-white shadow-md text-slate-500 hover:text-blue-500'"
                x-data="{ ping: true }"
                x-init="setInterval(() => ping = !ping, 3000)">
            <i class="bi bi-bell text-lg transition-transform duration-300 group-hover:rotate-12"></i>
            {{-- Animated Badge --}}
            <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-rose-500 rounded-full border-2"
                  :class="[darkMode ? 'border-slate-900' : 'border-white', ping ? 'animate-ping' : '']"></span>
            <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-rose-500 rounded-full border-2"
                  :class="darkMode ? 'border-slate-900' : 'border-white'"></span>
        </button>
        
        {{-- Dark Mode Toggle --}}
        <button @click="toggleDarkMode()" 
                class="p-3 rounded-2xl transition-all duration-700 hover:scale-110 active:scale-95 overflow-hidden group/toggle"
                :class="darkMode 
                    ? 'glass-card text-yellow-400 hover:bg-yellow-500/10' 
                    : 'bg-white shadow-md text-indigo-500 hover:bg-indigo-50'">
            <i class="bi text-lg transition-all duration-700 inline-block" 
               :class="darkMode ? 'bi-sun-fill rotate-[360deg] scale-110' : 'bi-moon-stars-fill rotate-0 scale-100'"></i>
        </button>
        
        {{-- User Profile --}}
        <div class="flex items-center gap-3 p-2 pr-4 lg:pr-5 rounded-2xl transition-all duration-300 cursor-pointer group hover:scale-[1.02]"
             :class="darkMode 
                 ? 'glass-card hover:bg-white/10' 
                 : 'bg-white shadow-md hover:shadow-lg'">
            
            {{-- Avatar with Glow --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl blur opacity-40 group-hover:opacity-70 transition-all duration-300"></div>
                <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff&bold=true" 
                     class="relative w-10 h-10 rounded-xl ring-2 transition-all duration-300 group-hover:scale-105"
                     :class="darkMode ? 'ring-white/20' : 'ring-blue-100'"
                     alt="User">
            </div>
            
            {{-- User Info --}}
            <div class="hidden lg:block">
                <p class="text-sm font-bold leading-none transition-colors"
                   :class="darkMode ? 'text-white' : 'text-slate-700'">Alex Christie</p>
                <p class="text-[10px] text-blue-500 font-bold uppercase mt-1">Administrator</p>
            </div>
            
            {{-- Dropdown Arrow --}}
            <i class="bi bi-chevron-down text-xs hidden lg:block transition-transform duration-300 group-hover:rotate-180"
               :class="darkMode ? 'text-slate-400' : 'text-slate-500'"></i>
        </div>
    </div>
</header>
