{{-- Sidebar Component --}}
@php
    $siteName = \App\Models\SiteSetting::get('site_name', 'PORTAL GG');
    $siteLogo = \App\Models\SiteSetting::get('site_logo');
    $logoIcon = \App\Models\SiteSetting::get('site_logo_icon', 'sparkles');
    $icons = \App\Models\SiteSetting::getTailwindIcons();
    $logoSvgContent = isset($icons[$logoIcon]) ? $icons[$logoIcon] : '';
@endphp

<aside 
    x-data="{ sidebarLoaded: false }"
    x-init="setTimeout(() => sidebarLoaded = true, 100)"
    :class="[
        $store.layout.sidebarOpen ? 'translate-x-0 w-72' : 'lg:translate-x-0 lg:w-24 -translate-x-full',
        sidebarLoaded ? 'transition-all duration-500 ease-[cubic-bezier(0.2,0.8,0.2,1)]' : ''
    ]"
    class="fixed left-0 top-0 h-full glass-card z-50 flex flex-col shadow-2xl overflow-hidden"
>
    <!-- Sidebar Particles -->
    <div class="sidebar-particles" id="sidebar-particles"></div>

    <!-- Brand -->
    <div 
        class="p-6 border-b border-white/10 flex items-center gap-4 h-24"
        x-data="{ 
            logoUrl: {{ json_encode($siteLogo ? Storage::url($siteLogo) : '') }},
            logoSvg: {{ json_encode($logoSvgContent) }},
            logoIcon: {{ json_encode($logoIcon) }}
        }"
        @appearance-updated.window="
            logoUrl = $event.detail.logoUrl || '';
            logoSvg = $event.detail.logoSvg || '';
            logoIcon = $event.detail.logoIcon || 'none';
        "
    >
        <!-- Logic: Prioritize Image IF logoIcon is 'none', otherwise Prioritize SVG -->
        
        <template x-if="logoIcon === 'none' && logoUrl">
            <img 
                :src="logoUrl" 
                alt="Logo" 
                class="w-10 h-10 rounded-xl object-cover flex-shrink-0 bg-white/5"
            >
        </template>
        
        <template x-if="logoIcon !== 'none' && logoSvg">
             <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center flex-shrink-0 rotate-3 text-white">
                <div class="w-6 h-6" x-html="logoSvg"></div>
            </div>
        </template>
        
        <!-- Fallback if (Icon is none AND No Image) OR (Icon is not none BUT No SVG) -->
        <template x-if="(logoIcon === 'none' && !logoUrl) || (logoIcon !== 'none' && !logoSvg)">
            <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center flex-shrink-0 rotate-3">
                <i class="bi bi-lightning-charge-fill text-white text-xl"></i>
            </div>
        </template>

        <span 
            x-show="$store.layout.sidebarOpen" 
            x-transition:enter="transition ease-out duration-300 delay-200"
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
                class="flex items-center gap-4 px-4 py-3 rounded-xl transition-all duration-500 group relative overflow-hidden isolate"
                :class="item.active 
                    ? 'text-white translate-x-2' 
                    : 'text-slate-400 hover:bg-white/5 hover:translate-x-1 dark:hover:text-white'"
            >
                <!-- Animated Active Background -->
                <div 
                    x-show="item.active"
                    x-transition:enter="transition ease-spring duration-500"
                    x-transition:enter-start="opacity-0 scale-90 -translate-x-full"
                    x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                    x-transition:leave="transition ease-out duration-300"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-90"
                    class="absolute inset-0 btn-premium rounded-xl -z-10 shadow-lg"
                ></div>

                <!-- Hover Effect (Non-active) -->
                <div 
                    x-show="!item.active"
                    class="absolute inset-0 bg-white/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 -z-10 rounded-xl"
                ></div>

                <i :class="item.icon" class="text-xl flex-shrink-0 transition-transform duration-300 group-hover:scale-110 relative z-10"></i>
                <span 
                    x-show="$store.layout.sidebarOpen" 
                    x-text="item.title" 
                    x-transition:enter="transition ease-out duration-300 delay-150"
                    x-transition:enter-start="opacity-0 -translate-x-2"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    class="font-medium whitespace-nowrap relative z-10"
                ></span>
            </a>
        </template>
    </nav>

    <!-- Sidebar Footer -->
    <div class="p-4 border-t border-white/10">
        <div 
            x-show="$store.layout.sidebarOpen"
            x-transition:enter="transition ease-out duration-300 delay-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
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
            x-show="!$store.layout.sidebarOpen"
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
    x-show="$store.layout.sidebarOpen && window.innerWidth < 1024"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    @click="$store.layout.sidebarOpen = false"
    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-40 lg:hidden"
    x-cloak
></div>
