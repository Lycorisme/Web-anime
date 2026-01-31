<aside 
    class="fixed inset-y-0 left-0 z-50 w-72 bg-[#0b0f19] border-r border-white/5 transition-transform duration-300 lg:static lg:translate-x-0 flex flex-col pt-0 font-sans shadow-[5px_0_30px_rgba(0,0,0,0.5)]"
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
>
    <!-- Ambient Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
        <div class="absolute top-0 left-0 w-full h-96 bg-indigo-500/5 blur-[80px]"></div>
        <div class="absolute bottom-0 right-0 w-64 h-64 bg-indigo-600/5 blur-[60px]"></div>
    </div>
    <!-- Brand -->
    <x-dashboard.brand />

    <nav class="relative z-10 flex-1 overflow-y-auto px-6 space-y-2 mt-6 custom-scrollbar">
        <!-- Main Library -->
        <div>
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-4 mb-4">Library</p>
            
            <a href="#" class="group relative flex items-center gap-3 px-4 py-3.5 rounded-xl transition-all duration-300">
                <div class="absolute inset-0 bg-gradient-to-r from-indigo-600 to-indigo-800 rounded-xl shadow-lg shadow-indigo-500/25 opacity-100 transition-opacity"></div>
                <i class="bi bi-grid-fill relative z-10 text-white group-hover:scale-110 transition-transform duration-300"></i> 
                <span class="relative z-10 font-bold text-white tracking-wide">Dashboard</span>
            </a>

            <a href="#" class="group relative flex items-center gap-3 px-4 py-3.5 text-slate-400 hover:text-indigo-100 transition-all rounded-xl hover:bg-white/5">
                <i class="bi bi-collection-play group-hover:text-indigo-400 transition-colors"></i> 
                <span class="font-medium group-hover:font-semibold transition-all">Anime List</span>
            </a>
            
            <a href="#" class="group relative flex items-center gap-3 px-4 py-3.5 text-slate-400 hover:text-indigo-100 transition-all rounded-xl hover:bg-white/5">
                <i class="bi bi-people group-hover:text-indigo-400 transition-colors"></i> 
                <span class="font-medium group-hover:font-semibold transition-all">Users Data</span>
            </a>
        </div>
            
        <!-- Community -->
        <div class="mt-8">
            <p class="text-[10px] font-bold text-slate-500 uppercase tracking-widest px-4 mb-4">Community</p>
            <a href="#" class="group flex items-center gap-3 px-4 py-3.5 text-slate-400 hover:text-indigo-100 hover:bg-white/5 transition-all rounded-xl">
                <i class="bi bi-chat-dots group-hover:text-indigo-400 transition-colors"></i> 
                <span class="font-medium">Discussions</span>
                <span class="ml-auto text-[10px] font-bold px-2 py-0.5 rounded-md bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 shadow-[0_0_10px_rgba(99,102,241,0.1)]">12</span>
            </a>
            <a href="#" class="group flex items-center gap-3 px-4 py-3.5 text-slate-400 hover:text-indigo-100 hover:bg-white/5 transition-all rounded-xl">
                <i class="bi bi-star group-hover:text-indigo-400 transition-colors"></i> 
                <span class="font-medium">Reviews</span>
            </a>
        </div>
    </nav>

    <!-- Bottom Promo -->
    <!-- Bottom Promo -->
    <div class="relative z-10 p-6">
        <div class="relative overflow-hidden rounded-2xl p-0.5 group">
            <div class="absolute inset-0 bg-gradient-to-br from-indigo-500 via-indigo-600 to-indigo-800 opacity-20 group-hover:opacity-100 transition-opacity duration-500"></div>
            <div class="relative bg-[#0f121b] rounded-[14px] p-5 border border-white/5 group-hover:border-transparent transition-colors">
                <div class="absolute top-0 right-0 w-20 h-20 bg-indigo-500/20 rounded-full blur-2xl -mr-10 -mt-10 pointer-events-none"></div>
                
                <p class="text-xs font-bold opacity-80 uppercase mb-2 text-indigo-200">Upgrade Profile</p>
                <p class="text-sm font-extrabold mb-4 leading-tight text-white">Dapatkan Badge Otaku Premium</p>
                
                <button class="w-full py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-500 hover:to-indigo-600 rounded-xl text-xs font-bold transition-all text-white shadow-lg shadow-indigo-500/20 group-hover:scale-[1.02] active:scale-95 border border-white/10">
                    Go Pro
                </button>
            </div>
        </div>
    </div>
</aside>
