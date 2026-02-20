{{-- Cursor Effects CSS Styles --}}
{{-- Dipisahkan dari cursor-effects.blade.php untuk maintainability --}}

<style>
    /* ===== CURSOR GLOW STYLES ===== */
    .cursor-glow {
        position: fixed;
        pointer-events: none;
        transform: translate(-50%, -50%);
        transition: width 0.15s ease, height 0.15s ease, opacity 0.15s ease;
        z-index: 999999;
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
        z-index: 999998;
        animation: particle-fade 0.8s ease-out forwards;
    }
    
    @keyframes particle-fade {
        0% { opacity: 1; transform: scale(1); }
        100% { opacity: 0; transform: scale(0); }
    }
</style>
