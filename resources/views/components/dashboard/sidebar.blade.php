{{-- Sidebar Component --}}
<aside 
    :class="sidebarOpen ? 'translate-x-0 w-72' : 'lg:translate-x-0 lg:w-24 -translate-x-full'"
    class="fixed left-0 top-0 h-full glass-card transition-all duration-300 z-50 flex flex-col shadow-2xl overflow-hidden"
>
    <!-- Brand -->
    <div class="p-6 border-b border-white/10 flex items-center gap-4">
        <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center flex-shrink-0 rotate-3">
            <i class="bi bi-lightning-charge-fill text-white text-xl"></i>
        </div>
        <span 
            x-show="sidebarOpen" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-x-2"
            x-transition:enter-end="opacity-100 translate-x-0"
            class="font-space font-bold text-xl tracking-tighter uppercase"
        >
            PORTAL GG
        </span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto">
        <template x-for="(item, index) in menuItems" :key="index">
            <a 
                :href="item.url" 
                wire:navigate
                class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group"
                :class="item.active 
                    ? 'btn-premium text-white' 
                    : 'text-slate-400 hover:bg-white/10 hover:translate-x-1 dark:hover:text-white'"
            >
                <i :class="item.icon" class="text-xl flex-shrink-0"></i>
                <span 
                    x-show="sidebarOpen" 
                    x-text="item.title" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    class="font-medium whitespace-nowrap"
                ></span>
            </a>
        </template>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-white/10">
        <div 
            x-show="sidebarOpen"
            x-transition
            class="glass-card rounded-2xl p-4 text-center"
        >
            <p class="text-xs text-slate-400 mb-2">Butuh bantuan?</p>
            <button class="btn-premium text-white text-xs px-4 py-2 rounded-lg w-full font-medium">
                <i class="bi bi-headset mr-2"></i>Support
            </button>
        </div>
    </div>
</aside>

{{-- Mobile Overlay --}}
<div 
    x-show="sidebarOpen && window.innerWidth < 1024"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="sidebarOpen = false"
    class="fixed inset-0 bg-black/50 z-40 lg:hidden"
></div>
