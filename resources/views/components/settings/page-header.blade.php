{{-- Settings Page Header - Responsive --}}
<div class="mb-4 sm:mb-6 animate-fade-in-up">
    <div class="flex items-center justify-between gap-3">
        {{-- Left Section --}}
        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 btn-premium rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="bi bi-gear-fill text-lg sm:text-xl text-white"></i>
            </div>
            <div class="min-w-0">
                <h1 class="text-xl sm:text-2xl font-extrabold truncate">
                    <span class="gradient-text">Pengaturan</span>
                </h1>
                
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-xs sm:text-sm mt-0.5">
                    <a href="/" wire:navigate class="text-slate-400 hover:text-blue-400 transition-colors flex items-center" title="Dashboard">
                        <i class="bi bi-grid-1x2-fill"></i>
                    </a>
                    <i class="bi bi-chevron-right text-[10px] text-slate-600"></i>
                    <span class="text-slate-200 font-medium">Pengaturan</span>
                </nav>
            </div>
        </div>
        
        {{-- Right Section (Optional: Back Button - Keeping it as user didn't ask to remove) --}}
        <a 
            href="/" 
            wire:navigate
            class="px-3 sm:px-4 py-2 glass-card rounded-lg sm:rounded-xl text-xs sm:text-sm font-medium transition-all flex items-center gap-2 hover:bg-white/10 flex-shrink-0"
        >
            <i class="bi bi-arrow-left"></i>
            <span class="hidden sm:inline">Dashboard</span>
        </a>
    </div>
</div>
