{{-- SweetAlert Custom Premium Styles --}}
{{-- Dipisahkan dari sweet-alert.blade.php untuk maintainability --}}

<style>
    /* ============================================
       SWEETALERT CUSTOM PREMIUM DESIGN
       ============================================ */
    
    /* CSS Variables */
    :root {
        --swal-gradient: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
        --swal-icon-color: #f59e0b;
        --swal-glow-color: rgba(245, 158, 11, 0.3);
        --swal-button-gradient: linear-gradient(135deg, #f59e0b 0%, #f97316 100%);
    }
    
    /* Container - Custom Backdrop with Smooth Animation */
    .swal-custom-container {
        background: transparent !important;
        backdrop-filter: blur(0px);
        -webkit-backdrop-filter: blur(0px);
        transition: background 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                    backdrop-filter 0.4s cubic-bezier(0.4, 0, 0.2, 1),
                    -webkit-backdrop-filter 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .swal-custom-container.swal2-backdrop-show {
        background: rgba(0, 0, 0, 0.6) !important;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }
    
    .dark .swal-custom-container.swal2-backdrop-show,
    html.dark .swal-custom-container.swal2-backdrop-show {
        background: rgba(0, 0, 0, 0.75) !important;
    }
    
    /* Hide animation - fade out */
    .swal-custom-container.swal2-backdrop-hide {
        background: transparent !important;
        backdrop-filter: blur(0px);
        -webkit-backdrop-filter: blur(0px);
        transition: background 0.3s cubic-bezier(0.4, 0, 1, 1), 
                    backdrop-filter 0.3s cubic-bezier(0.4, 0, 1, 1),
                    -webkit-backdrop-filter 0.3s cubic-bezier(0.4, 0, 1, 1);
    }
    
    /* Popup Base */
    .swal-custom-popup {
        border-radius: 1.5rem !important;
        padding: 0 !important;
        overflow: hidden !important;
        max-width: 420px !important;
        width: 90% !important;
        font-family: 'Plus Jakarta Sans', 'Inter', system-ui, sans-serif !important;
    }
    
    /* Dark Mode Popup */
    .swal-custom-popup.swal-dark {
        background: linear-gradient(165deg, 
            rgba(30, 41, 59, 0.95) 0%, 
            rgba(15, 23, 42, 0.98) 100%) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        box-shadow: 
            0 0 0 1px rgba(255, 255, 255, 0.05),
            0 25px 80px -12px rgba(0, 0, 0, 0.8),
            0 0 60px var(--swal-glow-color),
            inset 0 1px 0 rgba(255, 255, 255, 0.05) !important;
    }
    
    /* Light Mode Popup */
    .swal-custom-popup.swal-light {
        background: linear-gradient(165deg, 
            rgba(255, 255, 255, 0.98) 0%, 
            rgba(248, 250, 252, 0.98) 100%) !important;
        border: 1px solid rgba(0, 0, 0, 0.08) !important;
        box-shadow: 
            0 0 0 1px rgba(0, 0, 0, 0.03),
            0 25px 80px -12px rgba(0, 0, 0, 0.25),
            0 0 40px var(--swal-glow-color),
            inset 0 1px 0 rgba(255, 255, 255, 0.8) !important;
    }
    
    /* Gradient Accent Line */
    .swal-accent-line {
        height: 4px;
        background: var(--swal-gradient);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        z-index: 10;
    }
    
    /* Floating Particles */
    .swal-particles {
        position: absolute;
        inset: 0;
        overflow: hidden;
        pointer-events: none;
        z-index: 0;
    }
    
    .swal-particle {
        position: absolute;
        width: 6px;
        height: 6px;
        background: var(--swal-glow-color);
        border-radius: 0;
        bottom: 0;
        opacity: 0;
        pointer-events: none;
        animation: floatParticleFire 3s ease-in infinite;
    }
    
    /* Shapes */
    .swal-particle-circle {
        border-radius: 50%;
    }
    
    .swal-particle-diamond {
        transform: rotate(45deg);
    }
    
    .swal-particle-triangle {
        clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
    }

    /* Fire/Ember Animation */
    @keyframes floatParticleFire {
        0% {
            transform: translateY(0) translateX(0) scale(0) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.8;
            transform: translateY(-20px) translateX(calc(5px * var(--sway-dir))) scale(1);
        }
        50% {
            opacity: 0.6;
        }
        100% {
            transform: translateY(-400px) translateX(calc(var(--sway-amount) * var(--sway-dir))) scale(0);
            opacity: 0;
        }
    }
    
    @include('components.ui.styles.sweet-alert-icons')

</style>
