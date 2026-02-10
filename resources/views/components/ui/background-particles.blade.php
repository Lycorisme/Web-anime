{{-- Background Global Elements (Blobs & Particles) --}}
<div id="bg-background-wrapper" class="fixed inset-0 overflow-hidden pointer-events-none -z-50">
    <!-- Dynamic Blobs (Glow effects) -->
    <div class="blob w-96 h-96 top-[-10%] left-[-10%]" :style="`background: ${currentTheme.start}`"></div>
    <div class="blob w-80 h-80 bottom-[-5%] right-[0%]" :style="`background: ${currentTheme.end}; animation-delay: -5s;`"></div>

    <div id="bg-particles-container" 
         x-data="bgParticles()" 
         x-init="initParticles()" 
         x-cloak>
        <template x-for="particle in particles" :key="particle.id">
            <div :class="`bg-particle bg-particle-${particle.shape}`"
                 :style="particle.style">
            </div>
        </template>
    </div>
</div>

@include('components.ui.styles.background-particles-styles')

<script>
    function bgParticles() {
        return {
            particles: [],
            initParticles() {
                // Initial Color Setup
                this.updateThemeColor();

                // Listen for theme changes if dispatched
                window.addEventListener('theme-changed', () => this.updateThemeColor());
                
                // Also observe html class changes for dark mode if needed (MutationObserver), 
                // but usually theme-changed event is enough if existing system fires it.
                // If not, we rely on CSS variables which update automatically if we use them directly.
                // But since we are extracting the value to put into a var, we use this helper.

                const shapes = ['square', 'cross', 'ring'];
                const count = 30; // Quantity
                
                for (let i = 0; i < count; i++) {
                    const shape = shapes[Math.floor(Math.random() * shapes.length)];
                    const size = 15 + Math.random() * 25; // 15px - 40px
                    const left = Math.random() * 100; 
                    const duration = 25 + Math.random() * 25; // Slow & calm
                    const delay = Math.random() * -50; 
                    const opacity = 0.05 + Math.random() * 0.15; // Very subtle (0.05 - 0.20)
                    
                    this.particles.push({
                        id: i,
                        shape: shape,
                        style: `
                            left: ${left}%;
                            width: ${size}px;
                            height: ${size}px;
                            animation-duration: ${duration}s;
                            animation-delay: ${delay}s;
                            opacity: ${opacity};
                            --particle-color: var(--global-particle-color);
                        `
                    });
                }
            },
            updateThemeColor() {
                const docStyle = getComputedStyle(document.documentElement);
                let themeColor = docStyle.getPropertyValue('--gradient-start').trim();
                // If empty, fallback
                if (!themeColor) themeColor = '#6366f1';
                
                const container = document.getElementById('bg-particles-container');
                if (container) {
                    container.style.setProperty('--global-particle-color', themeColor);
                }
            }
        }
    }
</script>
