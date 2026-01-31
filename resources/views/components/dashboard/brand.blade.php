{{-- Brand Component - Cyber Anime Dashboard --}}
<div class="p-6 flex items-center gap-4 relative">
    {{-- Animated Logo --}}
    <div class="relative group">
        {{-- Glow Effect --}}
        <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-cyan-400 rounded-xl blur-md opacity-50 group-hover:opacity-80 transition-opacity duration-500"></div>
        
        {{-- Logo Container --}}
        <div class="relative w-11 h-11 bg-gradient-to-tr from-indigo-500 via-purple-500 to-cyan-400 rounded-xl flex items-center justify-center shadow-lg rotate-6 group-hover:rotate-0 transition-all duration-500 group-hover:scale-110">
            <i class="bi bi-collection-play-fill text-white text-xl"></i>
        </div>
    </div>
    
    {{-- Brand Text --}}
    <div x-show="sidebarOpen" x-transition.opacity.duration.300ms>
        <span class="font-extrabold text-xl tracking-tight bg-clip-text text-transparent bg-gradient-to-r from-white via-indigo-200 to-slate-400">
            ANIMECORE
        </span>
        <p class="text-[10px] text-slate-500 font-semibold uppercase tracking-[0.15em] -mt-0.5">
            Premium Tracker
        </p>
    </div>
    
    {{-- Collapsed State Icon --}}
    <div x-show="!sidebarOpen" x-transition class="hidden lg:block">
        {{-- Only show icon in collapsed state on desktop --}}
    </div>
</div>
