{{-- Premium Dashboard Sidebar --}}
<aside 
    class="fixed left-0 top-0 h-full w-72 z-50 flex flex-col shadow-2xl transition-transform duration-300 ease-out"
    :class="[
        sidebarOpen ? 'translate-x-0' : '-translate-x-full',
        darkMode ? 'glass-card' : 'bg-white/95 backdrop-blur-xl border-r border-slate-200'
    ]"
>
    {{-- Header / Brand --}}
    <div class="p-5 border-b flex items-center justify-between"
         :class="darkMode ? 'border-white/10' : 'border-slate-200'">
        <div class="flex items-center gap-3">
            {{-- Logo --}}
            <div class="relative group">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 rounded-xl blur-md opacity-50 group-hover:opacity-80 transition-all duration-500"></div>
                @if(isset($siteSettings['site_logo']) && $siteSettings['site_logo'])
                    <div class="relative w-10 h-10 rounded-xl overflow-hidden transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <img src="{{ Storage::url($siteSettings['site_logo']) }}" 
                             alt="{{ $siteSettings['site_name'] ?? 'Logo' }}" 
                             class="w-full h-full object-cover">
                    </div>
                @else
                    <div class="relative w-10 h-10 btn-premium rounded-xl flex items-center justify-center transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                        <i class="{{ $siteSettings['site_icon'] ?? 'bi bi-lightning-charge-fill' }} text-white text-lg"></i>
                    </div>
                @endif
            </div>
            {{-- Brand Name --}}
            @php
                $siteName = $siteSettings['site_name'] ?? 'PORTAL GG';
                $nameParts = explode(' ', $siteName, 2);
            @endphp
            <div>
                <span class="font-space font-bold text-lg tracking-tight"
                      :class="darkMode ? 'text-white' : 'text-slate-800'">{{ $nameParts[0] ?? 'PORTAL' }}</span>
                @if(isset($nameParts[1]))
                    <span class="font-space font-bold text-lg tracking-tight gradient-text">{{ $nameParts[1] }}</span>
                @endif
            </div>
        </div>
        
        {{-- Close button for mobile --}}
        <button @click="sidebarOpen = false"
                class="lg:hidden p-2 rounded-xl transition-all duration-300 hover:scale-110"
                :class="darkMode ? 'text-slate-400 hover:bg-white/10' : 'text-slate-500 hover:bg-slate-100'">
            <i class="bi bi-x-lg text-xl"></i>
        </button>
    </div>

    {{-- Navigation --}}
    <nav class="flex-1 px-3 py-4 space-y-1 overflow-y-auto">
        <template x-for="(item, index) in menuItems" :key="index">
            <a :href="item.url" 
               wire:navigate
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-300 group relative overflow-hidden"
               :class="item.active 
                   ? 'btn-premium text-white shadow-lg' 
                   : (darkMode 
                       ? 'text-slate-400 hover:bg-white/5 hover:text-white' 
                       : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900')">
                
                {{-- Icon --}}
                <i :class="item.icon" 
                   class="text-lg flex-shrink-0 transition-transform duration-300 group-hover:scale-110"></i>
                
                {{-- Title --}}
                <span x-text="item.title" class="font-medium text-sm"></span>
                
                {{-- Active Indicator --}}
                <span x-show="item.active" 
                      class="ml-auto w-2 h-2 bg-white rounded-full shadow-lg animate-pulse"></span>
            </a>
        </template>
    </nav>

    {{-- Footer / Music Player --}}
    <x-dashboard.music-player />
</aside>

{{-- Backdrop for mobile --}}
<div x-show="sidebarOpen" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     @click="sidebarOpen = false"
     class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden">
</div>


