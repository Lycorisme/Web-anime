{{-- Premium Dashboard Header --}}
<header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
    {{-- Left Section --}}
    <div class="flex items-center gap-4">
        {{-- Sidebar Toggle Button --}}
        <button @click="sidebarOpen = !sidebarOpen" 
                class="p-3 rounded-2xl glass-card hover:bg-white/10 transition-all text-slate-500 dark:text-slate-400 hover:text-blue-500 dark:hover:text-blue-400 group">
            <i class="bi text-xl transition-transform duration-300" 
               :class="sidebarOpen ? 'bi-text-indent-left' : 'bi-text-indent-right'"></i>
        </button>
        
        {{-- Breadcrumb / Title --}}
        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500 dark:text-slate-400 mb-1">
                <i class="bi bi-house-door"></i>
                <span>/</span>
                <span class="text-blue-500 font-medium">Dashboard</span>
            </div>
            <h1 class="text-xl lg:text-2xl font-extrabold text-slate-800 dark:text-white">
                Overview
            </h1>
        </div>
    </div>

    {{-- Right Section --}}
    <div class="flex items-center gap-3">
        {{-- Search Bar - Desktop --}}
        <div class="hidden md:flex items-center glass-card px-4 py-2.5 rounded-2xl group focus-within:ring-2 focus-within:ring-blue-500/30 transition-all">
            <i class="bi bi-search text-slate-400 group-focus-within:text-blue-500 transition-colors mr-3"></i>
            <input type="text" 
                   placeholder="Cari sesuatu..." 
                   class="bg-transparent border-none outline-none text-sm w-40 lg:w-56 text-slate-700 dark:text-slate-300 placeholder-slate-400 dark:placeholder-slate-500">
            <div class="flex items-center gap-1 ml-3">
                <kbd class="text-[9px] bg-slate-200 dark:bg-slate-700 px-1.5 py-0.5 rounded text-slate-500 font-mono">⌘</kbd>
                <kbd class="text-[9px] bg-slate-200 dark:bg-slate-700 px-1.5 py-0.5 rounded text-slate-500 font-mono">K</kbd>
            </div>
        </div>
        
        {{-- Search Button - Mobile --}}
        <button class="md:hidden p-3 rounded-2xl glass-card text-slate-500 hover:text-blue-500 transition-all">
            <i class="bi bi-search"></i>
        </button>
        
        {{-- Notifications --}}
        <button class="relative p-3 rounded-2xl glass-card text-slate-500 hover:text-blue-500 transition-all group">
            <i class="bi bi-bell text-lg group-hover:animate-swing"></i>
            {{-- Badge --}}
            <span class="absolute top-2 right-2 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white dark:border-slate-900"></span>
        </button>
        
        {{-- Dark Mode Toggle - FUNCTIONAL --}}
        <button @click="toggleDarkMode()" 
                class="p-3 rounded-2xl glass-card transition-all overflow-hidden group"
                :class="darkMode ? 'text-yellow-400 hover:bg-yellow-500/10' : 'text-indigo-500 hover:bg-indigo-500/10'">
            <i class="bi text-lg transition-transform duration-300 group-hover:rotate-12" 
               :class="darkMode ? 'bi-sun-fill' : 'bi-moon-stars-fill'"></i>
        </button>
        
        {{-- User Profile Dropdown --}}
        <div class="flex items-center gap-3 glass-card p-2 pr-4 lg:pr-5 rounded-2xl hover:bg-white/5 transition-all cursor-pointer group">
            {{-- Avatar --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-500 rounded-xl blur opacity-40 group-hover:opacity-60 transition-opacity"></div>
                <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff&bold=true" 
                     class="relative w-10 h-10 rounded-xl ring-2 ring-white/20" 
                     alt="User">
            </div>
            
            {{-- User Info --}}
            <div class="hidden lg:block">
                <p class="text-sm font-bold text-slate-700 dark:text-white leading-none">Alex Christie</p>
                <p class="text-[10px] text-blue-500 font-bold uppercase mt-1">Administrator</p>
            </div>
            
            {{-- Dropdown Arrow --}}
            <i class="bi bi-chevron-down text-xs text-slate-400 hidden lg:block"></i>
        </div>
    </div>
</header>

<style>
@keyframes swing {
    20% { transform: rotate(15deg); }
    40% { transform: rotate(-10deg); }
    60% { transform: rotate(5deg); }
    80% { transform: rotate(-5deg); }
    100% { transform: rotate(0deg); }
}
.animate-swing {
    animation: swing 1s ease-in-out;
    transform-origin: top center;
}
.group:hover .group-hover\:animate-swing {
    animation: swing 1s ease-in-out;
}
</style>
