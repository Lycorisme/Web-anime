{{-- Global Cursor & Click Effects Component --}}
{{-- This component should be included in the main layout to enable cursor and click effects globally --}}

@php
use App\Models\SiteSetting;

$cursorStyle = SiteSetting::get('cursor_style', 'gradient_blob');
$clickAnimation = SiteSetting::get('click_animation', 'ring_pulse');
$cursorEnabled = (bool) SiteSetting::get('cursor_enabled', true);
$clickEnabled = (bool) SiteSetting::get('click_enabled', true);
@endphp

<div id="cursor-effects-container" class="fixed inset-0 pointer-events-none z-[9999] overflow-hidden">
    {{-- Cursor Highlight Element --}}
    <div id="cursor-glow" class="cursor-glow cursor-glow-{{ $cursorStyle }}" style="display: {{ $cursorEnabled ? 'block' : 'none' }};"></div>
    
    {{-- Particle Trail Container --}}
    <div id="cursor-particle-container"></div>
    
    {{-- Click Effects Container --}}
    <div id="cursor-click-container"></div>
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
    
    /* Particle Trail Style */
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
// Global Cursor Effects Manager - Accessible from anywhere
(function() {
    'use strict';
    
    // Create global namespace
    window.CursorEffects = {
        // Current settings
        settings: {
            cursorStyle: '{{ $cursorStyle }}',
            clickAnimation: '{{ $clickAnimation }}',
            cursorEnabled: {{ $cursorEnabled ? 'true' : 'false' }},
            clickEnabled: {{ $clickEnabled ? 'true' : 'false' }}
        },
        
        // State
        mouseX: 0,
        mouseY: 0,
        targetX: 0,
        targetY: 0,
        lastParticleTime: 0,
        rafId: null,
        initialized: false,
        
        // DOM refs
        glowEl: null,
        particleContainer: null,
        clickContainer: null,
        
        // Initialize
        init() {
            if (this.initialized) return;
            
            // Get DOM elements
            this.glowEl = document.getElementById('cursor-glow');
            this.particleContainer = document.getElementById('cursor-particle-container');
            this.clickContainer = document.getElementById('cursor-click-container');
            
            if (!this.glowEl) {
                console.warn('Cursor effects: glow element not found');
                return;
            }
            
            // Load from localStorage for instant apply
            this.loadFromStorage();
            
            // Apply initial state
            this.applySettings();
            
            // Track mouse movement
            document.addEventListener('mousemove', (e) => {
                this.targetX = e.clientX;
                this.targetY = e.clientY;
            });
            
            // Handle clicks (both left and right)
            document.addEventListener('mousedown', (e) => {
                if (this.settings.clickEnabled) {
                    this.createClickEffect(e.clientX, e.clientY);
                }
            });
            
            // Start animation loop
            this.animate();
            
            this.initialized = true;
            console.log('🖱️ Cursor Effects initialized:', this.settings);
        },
        
        // Load from localStorage
        loadFromStorage() {
            const saved = localStorage.getItem('cursorEffects');
            if (saved) {
                try {
                    const settings = JSON.parse(saved);
                    Object.assign(this.settings, settings);
                } catch (e) {
                    console.warn('Failed to load cursor effects from storage:', e);
                }
            }
        },
        
        // Save to localStorage
        saveToStorage() {
            localStorage.setItem('cursorEffects', JSON.stringify(this.settings));
        },
        
        // Apply settings to DOM
        applySettings() {
            if (!this.glowEl) return;
            
            // Update cursor glow visibility
            this.glowEl.style.display = this.settings.cursorEnabled ? 'block' : 'none';
            
            // Update cursor glow class
            this.glowEl.className = 'cursor-glow cursor-glow-' + this.settings.cursorStyle;
            
            console.log('🎨 Cursor Effects applied:', this.settings);
        },
        
        // Update settings (called from anywhere to update instantly)
        update(newSettings) {
            Object.assign(this.settings, newSettings);
            this.saveToStorage();
            this.applySettings();
            console.log('✨ Cursor Effects updated:', this.settings);
        },
        
        // Animation loop
        animate() {
            // Smooth cursor following with lerp
            const lerp = 0.15;
            this.mouseX += (this.targetX - this.mouseX) * lerp;
            this.mouseY += (this.targetY - this.mouseY) * lerp;
            
            // Update cursor glow position
            if (this.glowEl && this.settings.cursorEnabled) {
                this.glowEl.style.left = this.mouseX + 'px';
                this.glowEl.style.top = this.mouseY + 'px';
            }
            
            // Create particles for particle_trail style
            if (this.settings.cursorStyle === 'particle_trail' && this.settings.cursorEnabled) {
                const now = Date.now();
                if (now - this.lastParticleTime > 50) {
                    this.createParticle(this.mouseX, this.mouseY);
                    this.lastParticleTime = now;
                }
            }
            
            this.rafId = requestAnimationFrame(() => this.animate());
        },
        
        // Create particle
        createParticle(x, y) {
            if (!this.particleContainer) return;
            
            const particle = document.createElement('div');
            particle.className = 'cursor-particle';
            
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
            
            this.particleContainer.appendChild(particle);
            setTimeout(() => particle.remove(), 800);
        },
        
        // Create click effect
        createClickEffect(x, y) {
            const style = getComputedStyle(document.documentElement);
            const themeStart = style.getPropertyValue('--gradient-start').trim() || '#6366f1';
            const themeEnd = style.getPropertyValue('--gradient-end').trim() || '#8b5cf6';
            
            switch(this.settings.clickAnimation) {
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
            if (!this.clickContainer) return;
            
            const ripple = document.createElement('div');
            ripple.className = 'click-ripple';
            ripple.style.left = x + 'px';
            ripple.style.top = y + 'px';
            ripple.style.borderColor = color;
            
            this.clickContainer.appendChild(ripple);
            setTimeout(() => ripple.remove(), 500);
        },
        
        createBurst(x, y, colorStart, colorEnd) {
            if (!this.clickContainer) return;
            
            const particleCount = 8;
            const colors = [colorStart, colorEnd];
            
            for (let i = 0; i < particleCount; i++) {
                const particle = document.createElement('div');
                particle.className = 'click-burst-particle';
                particle.style.left = x + 'px';
                particle.style.top = y + 'px';
                particle.style.background = colors[i % 2];
                
                const angle = (360 / particleCount) * i;
                const distance = 40 + Math.random() * 20;
                const tx = Math.cos(angle * Math.PI / 180) * distance + 'px';
                const ty = Math.sin(angle * Math.PI / 180) * distance + 'px';
                particle.style.setProperty('--tx', tx);
                particle.style.setProperty('--ty', ty);
                
                this.clickContainer.appendChild(particle);
                setTimeout(() => particle.remove(), 500);
            }
        },
        
        createRingPulse(x, y, color) {
            if (!this.clickContainer) return;
            
            const ring = document.createElement('div');
            ring.className = 'click-ring-pulse';
            ring.style.left = x + 'px';
            ring.style.top = y + 'px';
            ring.style.borderColor = color;
            ring.style.boxShadow = `0 0 20px ${color}`;
            
            this.clickContainer.appendChild(ring);
            setTimeout(() => ring.remove(), 400);
        },
        
        createSparkle(x, y, colorStart, colorEnd) {
            if (!this.clickContainer) return;
            
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
                
                this.clickContainer.appendChild(sparkle);
                setTimeout(() => sparkle.remove(), 600);
            }
        }
    };
    
    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => window.CursorEffects.init());
    } else {
        window.CursorEffects.init();
    }
    
    // Also re-init after Livewire navigation (SPA)
    document.addEventListener('livewire:navigated', () => {
        // Re-get DOM elements after navigation
        window.CursorEffects.glowEl = document.getElementById('cursor-glow');
        window.CursorEffects.particleContainer = document.getElementById('cursor-particle-container');
        window.CursorEffects.clickContainer = document.getElementById('cursor-click-container');
        window.CursorEffects.applySettings();
    });
    
    // Listen for Livewire events
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('effects-changed', (data) => {
            // Handle array wrapper from Livewire events
            const settings = Array.isArray(data) ? data[0] : data;
            window.CursorEffects.update(settings);
        });
    });
})();
</script>
