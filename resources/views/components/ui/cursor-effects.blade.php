{{-- Global Cursor & Click Effects Component --}}
{{-- This component should be included in the main layout to enable cursor and click effects globally --}}

@php
use App\Models\SiteSetting;

$cursorStyle = SiteSetting::get('cursor_style', 'gradient_blob');
$clickAnimation = SiteSetting::get('click_animation', 'ring_pulse');
$cursorEnabled = (bool) SiteSetting::get('cursor_enabled', true);
$clickEnabled = (bool) SiteSetting::get('click_enabled', true);
@endphp

<div 
    id="cursor-effects-container"
    x-data="cursorEffects({
        cursorStyle: '{{ $cursorStyle }}',
        clickAnimation: '{{ $clickAnimation }}',
        cursorEnabled: {{ $cursorEnabled ? 'true' : 'false' }},
        clickEnabled: {{ $clickEnabled ? 'true' : 'false' }}
    })"
    x-init="init()"
    @effects-changed.window="updateSettings($event.detail)"
    class="fixed inset-0 pointer-events-none z-[9999] overflow-hidden"
>
    {{-- Cursor Highlight Element --}}
    <div 
        x-ref="cursorGlow" 
        x-show="cursorEnabled"
        class="cursor-glow"
        :class="'cursor-glow-' + cursorStyle"
        x-transition
    ></div>
    
    {{-- Particle Trail Container (for particle_trail style) --}}
    <div x-ref="particleContainer" class="particle-container"></div>
    
    {{-- Click Effects Container --}}
    <div x-ref="clickContainer" class="click-container"></div>
</div>

<style>
    /* ===== CURSOR GLOW STYLES ===== */
    .cursor-glow {
        position: fixed;
        pointer-events: none;
        transform: translate(-50%, -50%);
        transition: width 0.15s ease, height 0.15s ease, opacity 0.15s ease;
        z-index: 9998;
    }
    
    /* Soft Glow Style */
    .cursor-glow-soft_glow {
        width: 80px;
        height: 80px;
        background: radial-gradient(circle, var(--gradient-start, #6366f1) 0%, transparent 70%);
        filter: blur(15px);
        opacity: 0.5;
    }
    
    /* Gradient Blob Style */
    .cursor-glow-gradient_blob {
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, var(--gradient-start, #6366f1) 0%, var(--gradient-end, #8b5cf6) 40%, transparent 70%);
        filter: blur(12px);
        opacity: 0.4;
        border-radius: 50%;
        animation: blob-pulse 3s ease-in-out infinite;
    }
    
    /* Ring Outline Style */
    .cursor-glow-ring_outline {
        width: 40px;
        height: 40px;
        border: 2px solid var(--gradient-start, #6366f1);
        border-radius: 50%;
        background: transparent;
        box-shadow: 0 0 20px var(--gradient-start, #6366f1), 
                    inset 0 0 10px rgba(99, 102, 241, 0.2);
        opacity: 0.8;
    }
    
    /* Particle Trail Style (main glow is smaller) */
    .cursor-glow-particle_trail {
        width: 20px;
        height: 20px;
        background: var(--gradient-start, #6366f1);
        border-radius: 50%;
        filter: blur(4px);
        opacity: 0.6;
    }
    
    @keyframes blob-pulse {
        0%, 100% { transform: translate(-50%, -50%) scale(1); }
        50% { transform: translate(-50%, -50%) scale(1.1); }
    }
    
    /* ===== PARTICLE STYLES ===== */
    .cursor-particle {
        position: fixed;
        pointer-events: none;
        border-radius: 50%;
        z-index: 9997;
        animation: particle-fade 0.8s ease-out forwards;
    }
    
    @keyframes particle-fade {
        0% { opacity: 1; transform: scale(1); }
        100% { opacity: 0; transform: scale(0); }
    }
    
    /* ===== CLICK ANIMATION STYLES ===== */
    
    /* Ripple Wave */
    .click-ripple {
        position: fixed;
        pointer-events: none;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        border: 2px solid var(--gradient-start, #6366f1);
        animation: ripple-expand 0.5s ease-out forwards;
        z-index: 9999;
    }
    
    @keyframes ripple-expand {
        0% { width: 0; height: 0; opacity: 1; }
        100% { width: 100px; height: 100px; opacity: 0; }
    }
    
    /* Burst Effect */
    .click-burst-particle {
        position: fixed;
        pointer-events: none;
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: var(--gradient-start, #6366f1);
        z-index: 9999;
        animation: burst-fly 0.5s ease-out forwards;
    }
    
    @keyframes burst-fly {
        0% { opacity: 1; transform: translate(-50%, -50%) scale(1); }
        100% { opacity: 0; transform: translate(var(--tx), var(--ty)) scale(0); }
    }
    
    /* Ring Pulse */
    .click-ring-pulse {
        position: fixed;
        pointer-events: none;
        transform: translate(-50%, -50%);
        border-radius: 50%;
        border: 3px solid var(--gradient-start, #6366f1);
        box-shadow: 0 0 20px var(--gradient-start, #6366f1);
        animation: ring-pulse-expand 0.4s ease-out forwards;
        z-index: 9999;
    }
    
    @keyframes ring-pulse-expand {
        0% { width: 10px; height: 10px; opacity: 1; }
        100% { width: 80px; height: 80px; opacity: 0; }
    }
    
    /* Sparkle Effect */
    .click-sparkle {
        position: fixed;
        pointer-events: none;
        font-size: 12px;
        z-index: 9999;
        animation: sparkle-rise 0.6s ease-out forwards;
    }
    
    @keyframes sparkle-rise {
        0% { opacity: 1; transform: translate(var(--tx), 0) scale(1); }
        100% { opacity: 0; transform: translate(var(--tx), -30px) scale(0.5); }
    }
</style>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('cursorEffects', (config) => ({
        cursorStyle: config.cursorStyle,
        clickAnimation: config.clickAnimation,
        cursorEnabled: config.cursorEnabled,
        clickEnabled: config.clickEnabled,
        mouseX: 0,
        mouseY: 0,
        targetX: 0,
        targetY: 0,
        lastParticleTime: 0,
        rafId: null,
        
        init() {
            // Track mouse movement
            document.addEventListener('mousemove', (e) => {
                this.targetX = e.clientX;
                this.targetY = e.clientY;
            });
            
            // Handle clicks (both left and right)
            document.addEventListener('mousedown', (e) => {
                if (this.clickEnabled) {
                    this.createClickEffect(e.clientX, e.clientY);
                }
            });
            
            // Prevent context menu interference but still allow click effect
            document.addEventListener('contextmenu', (e) => {
                // Click effect already triggered by mousedown
            });
            
            // Start animation loop
            this.animate();
        },
        
        animate() {
            // Smooth cursor following with lerp
            const lerp = 0.15;
            this.mouseX += (this.targetX - this.mouseX) * lerp;
            this.mouseY += (this.targetY - this.mouseY) * lerp;
            
            // Update cursor glow position
            if (this.$refs.cursorGlow && this.cursorEnabled) {
                this.$refs.cursorGlow.style.left = this.mouseX + 'px';
                this.$refs.cursorGlow.style.top = this.mouseY + 'px';
            }
            
            // Create particles for particle_trail style
            if (this.cursorStyle === 'particle_trail' && this.cursorEnabled) {
                const now = Date.now();
                if (now - this.lastParticleTime > 50) { // Create particle every 50ms
                    this.createParticle(this.mouseX, this.mouseY);
                    this.lastParticleTime = now;
                }
            }
            
            this.rafId = requestAnimationFrame(() => this.animate());
        },
        
        createParticle(x, y) {
            const particle = document.createElement('div');
            particle.className = 'cursor-particle';
            
            // Get theme colors
            const style = getComputedStyle(document.documentElement);
            const colors = [
                style.getPropertyValue('--gradient-start').trim() || '#6366f1',
                style.getPropertyValue('--gradient-end').trim() || '#8b5cf6'
            ];
            
            particle.style.left = (x + (Math.random() - 0.5) * 10) + 'px';
            particle.style.top = (y + (Math.random() - 0.5) * 10) + 'px';
            particle.style.width = (Math.random() * 6 + 3) + 'px';
            particle.style.height = particle.style.width;
            particle.style.background = colors[Math.floor(Math.random() * colors.length)];
            
            this.$refs.particleContainer.appendChild(particle);
            
            // Remove after animation
            setTimeout(() => particle.remove(), 800);
        },
        
        createClickEffect(x, y) {
            const style = getComputedStyle(document.documentElement);
            const themeStart = style.getPropertyValue('--gradient-start').trim() || '#6366f1';
            const themeEnd = style.getPropertyValue('--gradient-end').trim() || '#8b5cf6';
            
            switch(this.clickAnimation) {
                case 'ripple':
                    this.createRipple(x, y, themeStart);
                    break;
                case 'burst':
                    this.createBurst(x, y, themeStart, themeEnd);
                    break;
                case 'ring_pulse':
                    this.createRingPulse(x, y, themeStart);
                    break;
                case 'sparkle':
                    this.createSparkle(x, y, themeStart, themeEnd);
                    break;
            }
        },
        
        createRipple(x, y, color) {
            const ripple = document.createElement('div');
            ripple.className = 'click-ripple';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.borderColor = color;
            
            this.$refs.clickContainer.appendChild(ripple);
            setTimeout(() => ripple.remove(), 500);
        },
        
        createBurst(x, y, colorStart, colorEnd) {
            const particleCount = 8;
            const colors = [colorStart, colorEnd];
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'click-burst-particle';
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                particle.style.background = colors[i % 2];
                
                // Calculate direction
                const angle = (360 / particleCount) * i;
                const distance = 40 + Math.random() * 20;
                const tx = Math.cos(angle * Math.PI / 180) * distance + 'px';
                const ty = Math.sin(angle * Math.PI / 180) * distance + 'px';
                particle.style.setProperty('--tx', tx);
                particle.style.setProperty('--ty', ty);
                
                this.$refs.clickContainer.appendChild(particle);
                setTimeout(() => particle.remove(), 500);
            }
        },
        
        createRingPulse(x, y, color) {
            const ring = document.createElement('div');
            ring.className = 'click-ring-pulse';
            ring.style.left = x + 'px';
            ring.style.top = y + 'px';
            ring.style.borderColor = color;
            ring.style.boxShadow = `0 0 20px ${color}`;
            
            this.$refs.clickContainer.appendChild(ring);
            setTimeout(() => ring.remove(), 400);
        },
        
        createSparkle(x, y, colorStart, colorEnd) {
            const sparkleCount = 5;
            const symbols = ['✦', '✧', '★', '☆', '✴'];
            const colors = [colorStart, colorEnd];
            
            for (let i = 0; i < sparkleCount; i++) {
                const sparkle = document.createElement('div');
                sparkle.className = 'click-sparkle';
                sparkle.textContent = symbols[i % symbols.length];
                sparkle.style.left = x + 'px';
                sparkle.style.top = y + 'px';
                sparkle.style.color = colors[i % 2];
                
                const tx = (Math.random() - 0.5) * 60 + 'px';
                sparkle.style.setProperty('--tx', tx);
                sparkle.style.animationDelay = (i * 0.05) + 's';
                
                this.$refs.clickContainer.appendChild(sparkle);
                setTimeout(() => sparkle.remove(), 600);
            }
        },
        
        updateSettings(settings) {
            this.cursorStyle = settings.cursorStyle;
            this.clickAnimation = settings.clickAnimation;
            this.cursorEnabled = settings.cursorEnabled;
            this.clickEnabled = settings.clickEnabled;
        },
        
        destroy() {
            if (this.rafId) {
                cancelAnimationFrame(this.rafId);
            }
        }
    }));
});
</script>
