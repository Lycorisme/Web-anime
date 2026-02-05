{{-- Toast Notification Styles --}}
{{-- Dipisahkan dari toast.blade.php untuk maintainability --}}

<style>
/* Container Toast di Tengah Atas */
.toast-container {
    position: fixed;
    top: 24px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0;
    z-index: 10000;
    width: 100%;
    pointer-events: none;
}

/* Toast Wrapper - untuk Layout Transition Animation */
.toast-wrapper {
    max-height: 200px;
    margin-bottom: 12px;
    overflow: visible;
    transition: max-height 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                margin-bottom 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.3s ease;
}

/* Animasi Collapsing */
.toast-wrapper.collapsing {
    max-height: 0;
    margin-bottom: 0;
    overflow: hidden;
}

/* Toast Item */
.toast {
    pointer-events: auto;
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(16px) saturate(180%);
    -webkit-backdrop-filter: blur(16px) saturate(180%);
    border: 1px solid rgba(255, 255, 255, 0.5);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    border-radius: 20px;
    padding: 12px 16px;
    min-width: 350px;
    max-width: 450px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    animation: dropIn 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
}

/* Dark Mode Support */
:root.dark .toast,
.dark .toast {
    background: rgba(30, 41, 59, 0.9);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.3), 0 10px 10px -5px rgba(0, 0, 0, 0.2);
}

/* Animasi Keluar */
.toast.removing {
    animation: fadeUp 0.4s cubic-bezier(0.7, 0, 0.84, 0) forwards;
}

@keyframes dropIn {
    from { 
        opacity: 0; 
        transform: translateY(-100%) scale(0.9); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0) scale(1); 
    }
}

@keyframes fadeUp {
    from { 
        opacity: 1; 
        transform: translateY(0) scale(1); 
    }
    to { 
        opacity: 0; 
        transform: translateY(-20px) scale(0.95); 
    }
}

/* Content Styling */
.toast-content {
    display: flex;
    align-items: center;
    gap: 14px;
    flex: 1;
}

/* Icon Wrapper - Base */
.icon-wrapper {
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 12px;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-shrink: 0;
}

/* Icon colors - Menggunakan warna tema untuk success & info */
.icon-wrapper.icon-success {
    background: var(--gradient-start, #10b981);
    box-shadow: 0 4px 12px color-mix(in srgb, var(--gradient-start, #10b981) 30%, transparent);
}

.icon-wrapper.icon-error {
    background: #ef4444;
    box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
}

.icon-wrapper.icon-warning {
    background: #f59e0b;
    box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
}

.icon-wrapper.icon-info {
    background: var(--gradient-start, #6366f1);
    box-shadow: 0 4px 12px color-mix(in srgb, var(--gradient-start, #6366f1) 30%, transparent);
}

.text-group {
    display: flex;
    flex-direction: column;
}

.toast-title {
    font-weight: 700;
    font-size: 0.9rem;
    color: #1e293b;
    margin: 0;
}

.toast-desc {
    font-size: 0.8rem;
    color: #64748b;
    margin: 0;
}

/* Dark Mode Text */
:root.dark .toast-title,
.dark .toast-title {
    color: #f1f5f9;
}

:root.dark .toast-desc,
.dark .toast-desc {
    color: #94a3b8;
}
</style>
