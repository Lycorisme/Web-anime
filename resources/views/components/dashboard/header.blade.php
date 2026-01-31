<header class="sticky top-0 z-30 flex items-center justify-between px-4 lg:px-6 h-16 bg-[#020617]/80 backdrop-blur-md border-b border-[#1e293b] transition-all duration-300">
    <div class="flex items-center gap-4 flex-1">
        <!-- Mobile Sidebar Toggle -->
        <button @click="sidebarOpen = !sidebarOpen" 
                class="lg:hidden w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:text-white hover:bg-slate-800 transition-all">
            <i class="bi bi-list text-2xl"></i>
        </button>

        <!-- Search Bar -->
        <div class="hidden md:flex items-center w-full max-w-sm relative">
            <div class="relative w-full group">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="bi bi-search text-slate-500 group-focus-within:text-blue-500 transition-colors"></i>
                </div>
                <input type="text" 
                       placeholder="Search..." 
                       class="w-full bg-[#0f172a] border border-[#1e293b] rounded-lg py-2 pl-10 pr-12 text-sm text-slate-200 placeholder-slate-500 focus:outline-none focus:border-blue-500/50 focus:ring-1 focus:ring-blue-500/50 transition-all">
                <div class="absolute inset-y-0 right-0 flex items-center pr-2">
                    <kbd class="hidden sm:inline-flex items-center h-5 px-1.5 text-[10px] font-medium text-slate-500 bg-[#1e293b] rounded border border-slate-700/50">⌘K</kbd>
                </div>
            </div>
        </div>
    </div>

    <!-- Right Actions -->
    <div class="flex items-center gap-3">
        <div class="flex items-center gap-1 border-r border-[#1e293b] pr-3 mr-1">
            <!-- Theme Toggle -->
            <button class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:text-amber-400 hover:bg-amber-400/10 transition-colors">
                <i class="bi bi-sun-fill"></i>
            </button>

            <!-- Notifications -->
            <button class="w-9 h-9 flex items-center justify-center rounded-lg text-slate-400 hover:text-blue-400 hover:bg-blue-400/10 transition-colors relative">
                <i class="bi bi-bell-fill"></i>
                <span class="absolute top-2.5 right-2.5 w-1.5 h-1.5 bg-red-500 rounded-full border border-[#020617]"></span>
            </button>
        </div>

        <!-- User Dropdown Trigger -->
        <button class="flex items-center gap-3 pl-1 pr-1 rounded-lg hover:bg-[#1e293b]/50 transition-colors py-1">
           <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=3b82f6&color=fff" class="w-8 h-8 rounded-lg object-cover ring-1 ring-[#1e293b]" alt="User">
           <div class="hidden md:block text-left mr-1">
                <div class="text-xs font-bold text-slate-200">Alex Christie</div>
                <div class="text-[10px] text-slate-500">Super Admin</div>
           </div>
           <i class="bi bi-chevron-down text-[10px] text-slate-400 hidden md:block"></i>
        </button>
    </div>
</header>
