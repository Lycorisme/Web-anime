<div class="flex w-full min-h-screen" x-data="{ sidebarOpen: false }">
    <!-- Mobile Backdrop -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false"
         x-transition:enter="transition-opacity ease-linear duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-linear duration-300"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 bg-slate-900/80 backdrop-blur-sm z-40 lg:hidden"
         style="display: none;">
    </div>

    <x-dashboard.sidebar />

    <main class="flex-1 overflow-y-auto w-full relative">
        <x-dashboard.header />
        
        <div class="p-4 lg:p-8">
            <x-dashboard.welcome-card />
            
            <x-dashboard.stats-grid />
            
            <x-dashboard.anime-table />
        </div>
    </main>
</div>
