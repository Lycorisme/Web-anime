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
