{{-- Premium Dashboard Sidebar --}}
<aside 
    :class="sidebarOpen ? 'translate-x-0 w-72' : 'lg:translate-x-0 lg:w-24 -translate-x-full'"
    class="fixed left-0 top-0 h-full glass-card transition-all duration-300 z-50 flex flex-col shadow-2xl overflow-hidden"
>
    {{-- Header / Brand --}}
    <div class="p-6 border-b border-slate-200 dark:border-white/10 flex items-center gap-4">
        <div class="relative group">
            {{-- Glow Effect --}}
            <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl blur-md opacity-50 group-hover:opacity-80 transition-opacity"></div>
            {{-- Logo --}}
            <div class="relative w-11 h-11 btn-premium rounded-xl flex items-center justify-center rotate-3 group-hover:rotate-0 transition-transform duration-300">
                <i class="bi bi-lightning-charge-fill text-white text-xl"></i>
            </div>
        </div>
        <div x-show="sidebarOpen" x-transition.opacity.duration.200ms>
            <span class="font-space font-bold text-xl tracking-tight text-slate-800 dark:text-white">PORTAL</span>
            <span class="font-space font-bold text-xl tracking-tight gradient-text">GG</span>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <template x-for="(item, index) in menuItems" :key="index">
            <a :href="item.url" 
               class="flex items-center gap-4 px-4 py-3.5 rounded-2xl transition-all duration-200 group"
               :class="item.active 
                   ? 'btn-premium text-white shadow-lg' 
                   : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-white/5 hover:text-slate-900 dark:hover:text-white'">
                <i :class="item.icon" class="text-xl flex-shrink-0"></i>
                <span x-show="sidebarOpen" 
                      x-text="item.title" 
                      class="font-semibold text-sm whitespace-nowrap" 
                      x-transition.opacity.duration.200ms></span>
                {{-- Active Indicator --}}
                <span x-show="item.active && sidebarOpen" 
                      class="ml-auto w-2 h-2 bg-white rounded-full shadow-lg"
                      x-transition></span>
            </a>
        </template>
    </nav>

    {{-- Footer / Pro Access --}}
    <div class="p-4 border-t border-slate-200 dark:border-white/10">
        {{-- Expanded State --}}
        <div x-show="sidebarOpen" 
             x-transition.opacity.duration.200ms
             class="p-5 rounded-2xl bg-gradient-to-br from-slate-100 via-slate-50 to-white dark:from-white/5 dark:via-white/[0.02] dark:to-transparent relative overflow-hidden group">
            {{-- Decorative --}}
            <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full blur-xl -mr-10 -mt-10 group-hover:scale-150 transition-transform"></div>
            
            <div class="relative z-10">
                <div class="flex items-center gap-2 mb-2">
                    <i class="bi bi-gem text-purple-500"></i>
                    <p class="text-xs font-bold text-purple-500 uppercase tracking-wider">Pro Access</p>
                </div>
                <p class="text-[11px] text-slate-500 dark:text-slate-400 mb-4">Unlock premium features and analytics.</p>
                <button class="w-full py-3 btn-premium rounded-xl text-xs font-bold text-white transition-all hover:scale-[1.02]">
                    Upgrade Now
                </button>
            </div>
        </div>
        
        {{-- Collapsed State --}}
        <div x-show="!sidebarOpen" 
             x-transition
             class="flex justify-center">
            <button class="w-12 h-12 btn-premium rounded-2xl flex items-center justify-center text-white hover:scale-110 transition-transform">
                <i class="bi bi-gem"></i>
            </button>
        </div>
    </div>
</aside>

{{-- Backdrop for mobile --}}
<div x-show="sidebarOpen" 
     x-transition.opacity
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm z-40 lg:hidden">
</div>
