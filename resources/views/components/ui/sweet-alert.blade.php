{{-- SweetAlert Confirmation Dialog Component --}}
{{-- Custom Premium Design dengan Glassmorphism dan Animasi Modern --}}
@props([
    'id' => 'swal-confirm',
])

<div
    x-data="{
        show(options = {}) {
            const isDark = document.documentElement.classList.contains('dark');
            const type = options.type || 'warning';
            
            // Get theme colors from CSS variables
            const themeStart = getComputedStyle(document.documentElement).getPropertyValue('--gradient-start').trim() || '#1d4ed8';
            const themeEnd = getComputedStyle(document.documentElement).getPropertyValue('--gradient-end').trim() || '#7c3aed';
            
            // Type configurations with gradients
            const typeConfig = {
                'warning': {
                    icon: 'warning',
                    gradient: 'linear-gradient(135deg, #f59e0b 0%, #f97316 100%)',
                    iconColor: '#f59e0b',
                    glowColor: 'rgba(245, 158, 11, 0.3)',
                    buttonGradient: 'linear-gradient(135deg, #f59e0b 0%, #f97316 100%)'
                },
                'danger': {
                    icon: 'error',
                    gradient: 'linear-gradient(135deg, #ef4444 0%, #ec4899 100%)',
                    iconColor: '#ef4444',
                    glowColor: 'rgba(239, 68, 68, 0.3)',
                    buttonGradient: 'linear-gradient(135deg, #ef4444 0%, #ec4899 100%)'
                },
                'info': {
                    icon: 'info',
                    gradient: `linear-gradient(135deg, ${themeStart} 0%, ${themeEnd} 100%)`,
                    iconColor: themeStart,
                    glowColor: `${themeStart}4d`,
                    buttonGradient: `linear-gradient(135deg, ${themeStart} 0%, ${themeEnd} 100%)`
                },
                'success': {
                    icon: 'success',
                    gradient: 'linear-gradient(135deg, #10b981 0%, #14b8a6 100%)',
                    iconColor: '#10b981',
                    glowColor: 'rgba(16, 185, 129, 0.3)',
                    buttonGradient: 'linear-gradient(135deg, #10b981 0%, #14b8a6 100%)'
                },
                'question': {
                    icon: 'question',
                    gradient: 'linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%)',
                    iconColor: '#8b5cf6',
                    glowColor: 'rgba(139, 92, 246, 0.3)',
                    buttonGradient: 'linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%)'
                }
            };
            
            const config = typeConfig[type] || typeConfig['warning'];
            
            // Set CSS custom properties for dynamic styling
            document.documentElement.style.setProperty('--swal-gradient', config.gradient);
            document.documentElement.style.setProperty('--swal-icon-color', config.iconColor);
            document.documentElement.style.setProperty('--swal-glow-color', config.glowColor);
            document.documentElement.style.setProperty('--swal-button-gradient', config.buttonGradient);
            
            Swal.fire({
                title: options.title || 'Konfirmasi',
                html: `<p class='swal-custom-message'>${options.message || 'Apakah Anda yakin ingin melanjutkan?'}</p>`,
                icon: config.icon,
                showCancelButton: true,
                confirmButtonText: `<i class='bi bi-check2-circle me-2'></i>${options.confirmText || 'Ya, Lanjutkan'}`,
                cancelButtonText: `<i class='bi bi-x-circle me-2'></i>${options.cancelText || 'Batal'}`,
                reverseButtons: true,
                focusCancel: false,
                buttonsStyling: false,
                customClass: {
                    container: 'swal-custom-container',
                    popup: isDark ? 'swal-custom-popup swal-dark' : 'swal-custom-popup swal-light',
                    title: 'swal-custom-title',
                    htmlContainer: 'swal-custom-html',
                    icon: 'swal-custom-icon',
                    confirmButton: 'swal-custom-confirm-btn',
                    cancelButton: isDark ? 'swal-custom-cancel-btn swal-cancel-dark' : 'swal-custom-cancel-btn swal-cancel-light',
                    actions: 'swal-custom-actions'
                },
                showClass: {
                    popup: 'swal-animate-in'
                },
                hideClass: {
                    popup: 'swal-animate-out'
                },
                backdrop: 'transparent',
                allowOutsideClick: true,
                allowEscapeKey: true,
                didOpen: (popup) => {
                    // Add gradient accent line at top
                    const accentLine = document.createElement('div');
                    accentLine.className = 'swal-accent-line';
                    popup.insertBefore(accentLine, popup.firstChild);
                    
                    // Add floating particles effect
                    const particlesContainer = document.createElement('div');
                    particlesContainer.className = 'swal-particles';
                    for (let i = 0; i < 6; i++) {
                        const particle = document.createElement('div');
                        particle.className = 'swal-particle';
                        particle.style.left = `${Math.random() * 100}%`;
                        particle.style.animationDelay = `${Math.random() * 2}s`;
                        particle.style.animationDuration = `${2 + Math.random() * 2}s`;
                        particlesContainer.appendChild(particle);
                    }
                    popup.appendChild(particlesContainer);
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (options.onConfirm && typeof options.onConfirm === 'function') {
                        options.onConfirm();
                    }
                } else if (result.isDismissed) {
                    if (options.onCancel && typeof options.onCancel === 'function') {
                        options.onCancel();
                    }
                }
            });
        }
    }"
    x-on:swal-confirm-{{ $id }}.window="show($event.detail)"
    {{ $attributes }}
></div>

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
    
    /* Actions Container */
    .swal-custom-actions {
        padding: 1.5rem 1.5rem 2rem !important;
        gap: 0.75rem !important;
        flex-direction: row !important;
        position: relative;
        z-index: 1;
    }
    
    /* Confirm Button */
    .swal-custom-confirm-btn {
        background: var(--swal-button-gradient) !important;
        color: white !important;
        border: none !important;
        border-radius: 0.875rem !important;
        padding: 0.875rem 1.75rem !important;
        font-size: 0.875rem !important;
        font-weight: 700 !important;
        font-family: inherit !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.5rem !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        box-shadow: 
            0 4px 15px var(--swal-glow-color),
            0 2px 4px rgba(0, 0, 0, 0.1) !important;
        position: relative;
        overflow: hidden;
        line-height: 1 !important;
    }
    
    .swal-custom-confirm-btn i,
    .swal-custom-cancel-btn i {
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-size: 1em !important;
        line-height: 1 !important;
        vertical-align: middle !important;
        margin-right: 0.25rem !important;
    }
    
    .swal-custom-confirm-btn::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255,255,255,0.2) 0%, transparent 50%);
        opacity: 1;
        transition: opacity 0.3s;
    }
    
    .swal-custom-confirm-btn:hover {
        transform: translateY(-2px) scale(1.02) !important;
        box-shadow: 
            0 8px 25px var(--swal-glow-color),
            0 4px 8px rgba(0, 0, 0, 0.15) !important;
    }
    
    .swal-custom-confirm-btn:active {
        transform: translateY(0) scale(0.98) !important;
    }
    
    /* Cancel Button - Dark Mode */
    .swal-custom-cancel-btn {
        border: 2px solid transparent !important;
        border-radius: 0.875rem !important;
        padding: 0.875rem 1.75rem !important;
        font-size: 0.875rem !important;
        font-weight: 600 !important;
        font-family: inherit !important;
        cursor: pointer !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 0.5rem !important;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
        line-height: 1 !important;
    }
    
    .swal-custom-cancel-btn.swal-cancel-dark {
        background: rgba(51, 65, 85, 0.6) !important;
        color: #cbd5e1 !important;
        border-color: rgba(255, 255, 255, 0.1) !important;
    }
    
    .swal-custom-cancel-btn.swal-cancel-dark:hover {
        background: rgba(71, 85, 105, 0.8) !important;
        border-color: rgba(255, 255, 255, 0.2) !important;
        transform: translateY(-2px) !important;
    }
    
    .swal-custom-cancel-btn.swal-cancel-light {
        background: rgba(241, 245, 249, 0.8) !important;
        color: #475569 !important;
        border-color: rgba(0, 0, 0, 0.08) !important;
    }
    
    .swal-custom-cancel-btn.swal-cancel-light:hover {
        background: rgba(226, 232, 240, 0.9) !important;
        border-color: rgba(0, 0, 0, 0.12) !important;
        transform: translateY(-2px) !important;
    }
    
    .swal-custom-cancel-btn:active {
        transform: translateY(0) scale(0.98) !important;
    }
    
    /* Animations */
    .swal-animate-in {
        animation: swalPopIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    
    .swal-animate-out {
        animation: swalPopOut 0.25s cubic-bezier(0.4, 0, 1, 1);
    }
    
    @keyframes swalPopIn {
        0% {
            opacity: 0;
            transform: scale(0.8) translateY(20px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    
    @keyframes swalPopOut {
        0% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
        100% {
            opacity: 0;
            transform: scale(0.9) translateY(-10px);
        }
    }
    
    /* Backdrop Animation */
    .swal2-container.swal2-backdrop-show {
        animation: backdropFadeIn 0.3s ease-out;
    }
    
    @keyframes backdropFadeIn {
        0% {
            background-color: transparent;
        }
        100% {
            background-color: var(--swal-backdrop);
        }
    }
    
    /* Close Button (if shown) */
    .swal-custom-popup .swal2-close {
        position: absolute;
        top: 1rem;
        right: 1rem;
        width: 2rem;
        height: 2rem;
        border-radius: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        z-index: 10;
    }
    
    .swal-dark .swal2-close {
        color: #64748b;
        background: rgba(255, 255, 255, 0.05);
    }
    
    .swal-dark .swal2-close:hover {
        color: #f8fafc;
        background: rgba(255, 255, 255, 0.1);
    }
    
    .swal-light .swal2-close {
        color: #94a3b8;
        background: rgba(0, 0, 0, 0.05);
    }
    
    .swal-light .swal2-close:hover {
        color: #1e293b;
        background: rgba(0, 0, 0, 0.1);
    }
    
    /* Responsive */
    @media (max-width: 480px) {
        .swal-custom-popup {
            max-width: 95% !important;
            border-radius: 1.25rem !important;
        }
        
        .swal-custom-title {
            font-size: 1.25rem !important;
            padding: 0.5rem 1.5rem 0 !important;
        }
        
        .swal-custom-html {
            padding: 0 1.5rem !important;
        }
        
        .swal-custom-actions {
            padding: 1.25rem 1.25rem 1.5rem !important;
            flex-direction: row !important;
            flex-wrap: nowrap !important;
        }
        
        .swal-custom-confirm-btn,
        .swal-custom-cancel-btn {
            flex: 1 1 0 !important;
            min-width: 0 !important;
            padding: 0.75rem 0.5rem !important;
            font-size: 0.8rem !important;
        }
    }
</style>
