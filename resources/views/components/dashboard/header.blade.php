{{-- Header Component --}}
<header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-10 animate-fade-in-up">
    <div class="flex items-center gap-4">
        <!-- Sidebar Toggle -->
        <button 
            @click="sidebarOpen = !sidebarOpen" 
            class="p-2 rounded-xl glass-card hover:bg-white/10 transition-all"
        >
            <i data-lucide="menu" class="w-6 h-6"></i>
        </button>
        
        <!-- Welcome Text -->
        <div>
            <h1 class="text-2xl lg:text-3xl font-extrabold tracking-tight">
                Halo, <span class="gradient-text">Alex Christie!</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm">
                Update aktivitas sistem Anda hari ini.
            </p>
        </div>
    </div>

    <div class="flex items-center gap-3">
        <!-- Dark Mode Toggle -->
        <button 
            @click="toggleDarkMode()" 
            class="p-3 rounded-xl glass-card hover:scale-110 transition-all"
        >
            <i :class="darkMode ? 'bi bi-sun-fill text-yellow-400' : 'bi bi-moon-stars-fill text-indigo-500'"></i>
        </button>
        
        <!-- User Profile -->
        <div class="flex items-center gap-3 glass-card p-2 pr-6 rounded-2xl shadow-xl">
            <img 
                src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff" 
                class="w-10 h-10 rounded-xl" 
                alt="User"
            >
            <div class="hidden sm:block">
                <p class="text-sm font-bold leading-none">Alex Christie</p>
                <p class="text-[10px] gradient-text font-bold uppercase mt-1">Administrator</p>
            </div>
        </div>
    </div>
</header>
