<aside 
    class="fixed inset-y-0 left-0 z-50 w-64 bg-[#020617] border-r border-[#1e293b] transition-transform duration-300 lg:static lg:translate-x-0 flex flex-col pt-0"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <!-- Brand Section -->
    <x-dashboard.brand />

    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-6 px-3 space-y-8 custom-scrollbar">
        <!-- Section: Menu -->
        <div>
            <h3 class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Main Menu</h3>
            <ul class="space-y-1">
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg bg-blue-500/10 text-blue-500 group transition-all">
                        <i class="bi bi-grid-fill text-base"></i>
                        <span class="font-medium text-sm">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-[#1e293b]/50 group transition-all">
                        <i class="bi bi-collection-play text-base group-hover:text-blue-400 transition-colors"></i>
                        <span class="font-medium text-sm">Anime List</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-[#1e293b]/50 group transition-all">
                        <i class="bi bi-people text-base group-hover:text-violet-400 transition-colors"></i>
                        <span class="font-medium text-sm">Users</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Section: General -->
        <div>
            <h3 class="px-3 text-[11px] font-bold text-slate-500 uppercase tracking-wider mb-2">Management</h3>
            <ul class="space-y-1">
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-[#1e293b]/50 group transition-all">
                        <i class="bi bi-chat-square-text text-base group-hover:text-emerald-400 transition-colors"></i>
                        <span class="font-medium text-sm">Comments</span>
                        <span class="ml-auto text-[10px] font-bold px-1.5 py-0.5 rounded bg-[#1e293b] text-emerald-500 border border-emerald-500/20">12</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg text-slate-400 hover:text-slate-200 hover:bg-[#1e293b]/50 group transition-all">
                        <i class="bi bi-star text-base group-hover:text-amber-400 transition-colors"></i>
                        <span class="font-medium text-sm">Reviews</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- User Mini Profile (Bottom) -->
    <div class="p-3 border-t border-[#1e293b] bg-[#020617]">
        <button class="flex items-center gap-3 w-full p-2 rounded-lg hover:bg-[#1e293b]/50 transition-colors group border border-transparent hover:border-[#1e293b]">
            <div class="relative">
                <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=334155&color=fff" class="w-8 h-8 rounded-md object-cover" alt="User">
                <span class="absolute -bottom-1 -right-1 w-2.5 h-2.5 bg-green-500 border-2 border-[#020617] rounded-full"></span>
            </div>
            <div class="flex-1 min-w-0 text-left">
                <p class="text-sm font-semibold text-slate-300 truncate group-hover:text-white">Alex Christie</p>
                <p class="text-[10px] text-slate-500 truncate">alex@example.com</p>
            </div>
            <i class="bi bi-box-arrow-right text-slate-500 group-hover:text-red-400 transition-colors text-lg"></i>
        </button>
    </div>
</aside>
