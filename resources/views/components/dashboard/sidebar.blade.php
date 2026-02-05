{{-- Sidebar Component --}}
@php
    $siteName = \App\Models\SiteSetting::get('site_name', 'PORTAL GG');
    $siteLogo = \App\Models\SiteSetting::get('site_logo');
    $logoIcon = \App\Models\SiteSetting::get('site_logo_icon', 'sparkles');
    $icons = \App\Models\SiteSetting::getTailwindIcons();
@endphp

<aside 
    :class="sidebarOpen ? 'translate-x-0 w-72' : 'lg:translate-x-0 lg:w-24 -translate-x-full'"
    class="fixed left-0 top-0 h-full glass-card transition-all duration-300 z-50 flex flex-col shadow-2xl overflow-hidden"
>
    <!-- Sidebar Particles -->
    <div class="sidebar-particles" id="sidebar-particles"></div>

    <!-- Brand -->
    <div 
        class="p-6 border-b border-white/10 flex items-center gap-4 h-24"
        x-data="{ 
            logoUrl: '{{ $siteLogo ? Storage::url($siteLogo) : '' }}',
            logoSvg: `{{ isset($icons[$logoIcon]) ? $icons[$logoIcon] : '' }}`
        }"
        @appearance-updated.window="
            logoUrl = $event.detail.logoUrl;
            logoSvg = $event.detail.logoSvg;
        "
    >
        <template x-if="logoUrl">
            <img 
                :src="logoUrl" 
                alt="Logo" 
                class="w-10 h-10 rounded-xl object-cover flex-shrink-0 bg-white/5"
            >
        </template>
        
        <template x-if="!logoUrl && logoSvg">
             <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center flex-shrink-0 rotate-3 text-white">
                <div class="w-6 h-6" x-html="logoSvg"></div>
            </div>
        </template>
        
        <template x-if="!logoUrl && !logoSvg">
            <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center flex-shrink-0 rotate-3">
                <i class="bi bi-lightning-charge-fill text-white text-xl"></i>
            </div>
        </template>

        <span 
            x-show="sidebarOpen" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-x-2"
            x-transition:enter-end="opacity-100 translate-x-0"
            class="font-space font-bold text-xl tracking-tighter uppercase truncate"
        >
            {{ $siteName }}
        </span>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
        <template x-for="(item, index) in menuItems" :key="index">
            <a 
                :href="item.url" 
                wire:navigate
                class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-200 group relative overflow-hidden"
                :class="item.active 
                    ? 'btn-premium text-white shadow-lg' 
                    : 'text-slate-400 hover:bg-white/10 hover:translate-x-1 dark:hover:text-white'"
            >
                <!-- Active Indicator -->
                <div 
                    x-show="item.active"
                    class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-20 transition-opacity"
                ></div>

                <i :class="item.icon" class="text-xl flex-shrink-0 transition-transform group-hover:scale-110"></i>
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
            class="glass-card rounded-2xl p-4 text-center relative overflow-hidden group"
        >
            <!-- Background Glow -->
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-500/10 to-purple-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
            
            <p class="text-xs text-slate-400 mb-2 relative z-10">Butuh bantuan?</p>
            <button class="btn-premium text-white text-xs px-4 py-2 rounded-lg w-full font-medium relative z-10 hover:scale-105 active:scale-95 transition-transform">
                <i class="bi bi-headset mr-2"></i>Support
            </button>
        </div>
        
        <!-- Collapsed Footer (Icon Only) -->
        <div 
            x-show="!sidebarOpen"
            class="flex justify-center"
        >
             <button class="w-10 h-10 rounded-xl glass-card flex items-center justify-center text-slate-400 hover:text-white hover:bg-white/10 transition-all" title="Support">
                <i class="bi bi-headset"></i>
            </button>
        </div>
    </div>
    @include('components.dashboard.styles.sidebar-particles')
    
    <script>
        document.addEventListener('livewire:navigated', () => {
            initSidebarParticles();
        });
        
        // Initial load
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSidebarParticles);
        } else {
            initSidebarParticles();
        }

        function initSidebarParticles() {
            const container = document.getElementById('sidebar-particles');
            if (!container) return;
            
            // Clear existing
            container.innerHTML = '';
            
            const count = 15; // Not too many to distract
            for (let i = 0; i < count; i++) {
                const p = document.createElement('div');
                p.className = 'sb-particle';
                
                const size = 1 + Math.random() * 3;
                p.style.width = `${size}px`;
                p.style.height = `${size}px`;
                
                p.style.left = `${Math.random() * 100}%`;
                p.style.animationDuration = `${5 + Math.random() * 10}s`;
                p.style.animationDelay = `${Math.random() * 5}s`;
                p.style.opacity = `${0.1 + Math.random() * 0.3}`; // Subtle transparency
                
                container.appendChild(p);
            }
        }
    </script>
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
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden"
    x-cloak
></div>
