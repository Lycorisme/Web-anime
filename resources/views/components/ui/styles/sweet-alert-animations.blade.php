{{-- SweetAlert Animation Styles --}}
{{-- Dipisahkan dari sweet-alert.blade.php untuk maintainability --}}

<style>
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
