{{-- Click Animation CSS Styles --}}
{{-- Dipisahkan dari cursor-effects.blade.php untuk maintainability --}}

<style>
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
