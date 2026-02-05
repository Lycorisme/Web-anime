{{-- SweetAlert Button Styles --}}
{{-- Dipisahkan dari sweet-alert.blade.php untuk maintainability --}}

<style>
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
</style>
