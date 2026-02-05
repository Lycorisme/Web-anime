{{-- Toast Button & Timer Styles --}}
{{-- Dipisahkan dari toast.blade.php untuk maintainability --}}

<style>
/* Close Button */
.close-btn {
    background: rgba(0, 0, 0, 0.05);
    border: none;
    width: 28px;
    height: 28px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    justify-content: center;
    align-items: center;
    color: #64748b;
    transition: all 0.2s;
    margin-left: 10px;
    flex-shrink: 0;
}

.close-btn:hover {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    transform: rotate(90deg);
}

/* Dark Mode Close Button */
:root.dark .close-btn,
.dark .close-btn {
    background: rgba(255, 255, 255, 0.1);
    color: #94a3b8;
}

:root.dark .close-btn:hover,
.dark .close-btn:hover {
    background: rgba(239, 68, 68, 0.2);
    color: #ef4444;
}

/* Timer Progress Bar - Base - 4 detik */
.timer-line {
    position: absolute;
    bottom: 0;
    left: 0;
    height: 3px;
    width: 100%;
    transform-origin: left;
    animation: shrink 4s linear forwards;
}

/* Timer colors - Menggunakan warna tema untuk success & info */
.timer-line.timer-success {
    background: var(--gradient-start, #10b981);
}

.timer-line.timer-error {
    background: #ef4444;
}

.timer-line.timer-warning {
    background: #f59e0b;
}

.timer-line.timer-info {
    background: var(--gradient-start, #6366f1);
}

@keyframes shrink {
    from { 
        transform: scaleX(1); 
    }
    to { 
        transform: scaleX(0); 
    }
}

/* Hover effect for toast */
.toast:hover {
    box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.15), 0 15px 15px -5px rgba(0, 0, 0, 0.08);
}

:root.dark .toast:hover,
.dark .toast:hover {
    box-shadow: 0 25px 30px -5px rgba(0, 0, 0, 0.4), 0 15px 15px -5px rgba(0, 0, 0, 0.3);
}
</style>
