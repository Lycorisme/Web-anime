<header class="sticky top-0 z-30 flex items-center justify-between px-4 lg:px-6 h-20 bg-[#0b0f19]/80 backdrop-blur-xl border-b border-white/5 transition-all duration-300 font-sans shadow-[0_4px_30px_rgba(0,0,0,0.1)]">
    <div class="flex items-center gap-6 flex-1">
        <!-- Mobile Sidebar Toggle -->
        <button @click="sidebarOpen = !sidebarOpen" 
                class="lg:hidden w-10 h-10 flex items-center justify-center rounded-lg text-slate-400 hover:text-white hover:bg-white/5 transition-all">
            <i class="bi bi-list text-2xl"></i>
        </button>

        <!-- Search Bar -->
        <div class="hidden md:flex items-center w-full max-w-sm relative group">
            <div class="relative w-full flex items-center bg-[#131620] rounded-xl border border-white/5 focus-within:border-indigo-500/50 focus-within:bg-[#161b28] focus-within:shadow-[0_0_20px_rgba(99,102,241,0.15)] transition-all duration-300 group-hover:border-white/10">
                <div class="pl-4 text-slate-500 group-focus-within:text-indigo-400 transition-colors">
                    <i class="bi bi-search text-base"></i>
                </div>
                <input type="text" 
                       placeholder="Search resources..." 
                       class="w-full bg-transparent border-none text-sm text-slate-200 placeholder-slate-500 focus:ring-0 py-2.5 px-3">
                <div class="pr-3">
                    <kbd class="hidden sm:inline-flex items-center h-6 px-2 text-[10px] font-bold text-slate-500 bg-[#1a1f2e] rounded-md border border-white/5 shadow-sm font-mono tracking-wide group-focus-within:text-indigo-400 group-focus-within:border-indigo-500/20">CTRL K</kbd>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Actions -->
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-1">
            <!-- Theme Toggle -->
            <button class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:text-amber-400 hover:bg-amber-500/10 transition-colors">
                <i class="bi bi-sun-fill text-base"></i>
            </button>

            <!-- Notifications -->
            <button class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:text-indigo-300 hover:bg-indigo-500/10 transition-colors relative group">
                <i class="bi bi-bell-fill text-base group-hover:animate-swing group-hover:drop-shadow-[0_0_5px_rgba(99,102,241,0.5)]"></i>
                <span class="absolute top-2.5 right-2.5 w-1.5 h-1.5 bg-indigo-500 rounded-full shadow-[0_0_8px_rgba(99,102,241,0.8)] z-10"></span>
            </button>
        </div>

        <!-- Divider -->
        <div class="h-6 w-px bg-[#1a1f2e]"></div>

        <!-- User Dropdown Trigger -->
        <button class="flex items-center gap-3 pl-1 pr-2 rounded-xl hover:bg-white/5 transition-all py-1.5 group border border-transparent hover:border-white/5">
           <div class="relative">
                <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff" class="w-8 h-8 rounded-lg object-cover ring-2 ring-transparent group-hover:ring-indigo-500/50 transition-all shadow-sm" alt="User">
                <div class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 border-2 border-[#0b0f19] rounded-full"></div>
           </div>
           <div class="hidden md:block text-left mr-1">
                <div class="text-xs font-extra-bold text-slate-300 group-hover:text-white transition-colors">Alex C.</div>
           </div>
           <i class="bi bi-chevron-down text-[10px] text-slate-500 hidden md:block group-hover:text-white transition-colors"></i>
        </button>
    </div>
</header>
