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
        border-radius: 50%;
        bottom: -20px;
        opacity: 0;
        animation: floatParticle 3s ease-in-out infinite;
    }
    
    @keyframes floatParticle {
        0% {
            transform: translateY(0) scale(0);
            opacity: 0;
        }
        20% {
            opacity: 0.6;
            transform: scale(1);
        }
        100% {
            transform: translateY(-300px) scale(0.5);
            opacity: 0;
        }
    }
    
    /* Custom Icon Styling */
    .swal-custom-popup .swal2-icon {
        margin: 2rem auto 1rem !important;
        border-width: 4px !important;
        position: relative;
        z-index: 1;
    }
    
    .swal-custom-popup .swal2-icon::before {
        content: '';
        position: absolute;
        inset: -15px;
        background: var(--swal-glow-color);
        border-radius: 50%;
        filter: blur(20px);
        z-index: -1;
        animation: iconPulse 2s ease-in-out infinite;
    }
    
    @keyframes iconPulse {
        0%, 100% {
            opacity: 0.5;
            transform: scale(1);
        }
        50% {
            opacity: 0.8;
            transform: scale(1.1);
        }
    }
    
    /* Icon Colors */
    .swal-custom-popup .swal2-icon.swal2-warning {
        border-color: #f59e0b !important;
        color: #f59e0b !important;
    }
    
    .swal-custom-popup .swal2-icon.swal2-error {
        border-color: #ef4444 !important;
    }
    
    .swal-custom-popup .swal2-icon.swal2-error [class^='swal2-x-mark-line'] {
        background-color: #ef4444 !important;
    }
    
    .swal-custom-popup .swal2-icon.swal2-success {
        border-color: #10b981 !important;
    }
    
    .swal-custom-popup .swal2-icon.swal2-success [class^='swal2-success-line'] {
        background-color: #10b981 !important;
    }
    
    .swal-custom-popup .swal2-icon.swal2-success .swal2-success-ring {
        border-color: rgba(16, 185, 129, 0.3) !important;
    }
    
    .swal-custom-popup .swal2-icon.swal2-info {
        border-color: var(--swal-icon-color) !important;
        color: var(--swal-icon-color) !important;
    }
    
    .swal-custom-popup .swal2-icon.swal2-question {
        border-color: #8b5cf6 !important;
        color: #8b5cf6 !important;
    }
    
    /* Title Styling */
    .swal-custom-title {
        padding: 0.5rem 2rem 0 !important;
        font-size: 1.375rem !important;
        font-weight: 800 !important;
        letter-spacing: -0.02em !important;
        position: relative;
        z-index: 1;
    }
    
    .swal-dark .swal-custom-title {
        color: #f8fafc !important;
    }
    
    .swal-light .swal-custom-title {
        color: #0f172a !important;
    }
    
    /* Message Styling */
    .swal-custom-html {
        padding: 0 2rem !important;
        position: relative;
        z-index: 1;
    }
    
    .swal-custom-message {
        font-size: 0.95rem !important;
        line-height: 1.6 !important;
        margin: 0 !important;
    }
    
    .swal-dark .swal-custom-message {
        color: #94a3b8 !important;
    }
    
    .swal-light .swal-custom-message {
        color: #64748b !important;
    }
</style>
