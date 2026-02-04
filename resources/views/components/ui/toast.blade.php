{{-- Toast Notification Component --}}
{{-- Modern Center Toast - Glassmorphism Design dengan animasi dropIn/fadeUp --}}
@props([
    'position' => 'top-center',
    'duration' => 4000,
    'maxToasts' => 5,
])

<div
    x-data="{
        toasts: [],
        maxToasts: {{ $maxToasts }},
        defaultDuration: {{ $duration }},
        counter: 0,
        
        add(options = {}) {
            const id = ++this.counter;
            const duration = options.duration !== undefined ? options.duration : this.defaultDuration;
            
            const toast = {
                id: id,
                type: options.type || 'info',
                title: options.title || null,
                message: options.message || 'Notification',
                duration: duration,
                removing: false,
            };
            
            if (this.toasts.length >= this.maxToasts) {
                this.removeToast(this.toasts[0].id);
            }
            
            this.toasts.push(toast);
        },
        
        startTimer(id, duration) {
            // Timer dimulai saat toast di-render
            setTimeout(() => {
                this.removeToast(id);
            }, duration);
        },
        
        removeToast(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index === -1) return;
            if (this.toasts[index].removing) return;
            
            // Mulai animasi fadeUp
            this.toasts[index].removing = true;
            
            // Hapus dari DOM setelah animasi selesai (400ms)
            setTimeout(() => {
                const removeIndex = this.toasts.findIndex(t => t.id === id);
                if (removeIndex !== -1) {
                    this.toasts.splice(removeIndex, 1);
                }
            }, 400);
        },
        
        success(message, title = null, duration = null) {
            this.add({ type: 'success', message, title: title || 'Berhasil!', duration });
        },
        
        error(message, title = null, duration = null) {
            this.add({ type: 'error', message, title: title || 'Error!', duration });
        },
        
        warning(message, title = null, duration = null) {
            this.add({ type: 'warning', message, title: title || 'Perhatian!', duration });
        },
        
        info(message, title = null, duration = null) {
            this.add({ type: 'info', message, title: title || 'Informasi', duration });
        },
        
        clear() {
            this.toasts = [];
        }
    }"
    x-on:toast.window="add($event.detail)"
    x-on:toast-success.window="success($event.detail.message, $event.detail.title, $event.detail.duration)"
    x-on:toast-error.window="error($event.detail.message, $event.detail.title, $event.detail.duration)"
    x-on:toast-warning.window="warning($event.detail.message, $event.detail.title, $event.detail.duration)"
    x-on:toast-info.window="info($event.detail.message, $event.detail.title, $event.detail.duration)"
    x-on:clear-toasts.window="clear()"
    class="toast-container"
    {{ $attributes }}
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            class="toast"
            :class="{ 'removing': toast.removing }"
            x-init="if(toast.duration > 0) startTimer(toast.id, toast.duration)"
        >
            {{-- Content --}}
            <div class="toast-content">
                {{-- Icon Wrapper - Menggunakan warna tema --}}
                <div class="icon-wrapper" :class="'icon-' + toast.type">
                    {{-- Success Icon --}}
                    <template x-if="toast.type === 'success'">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M5 13l4 4L19 7"></path>
                        </svg>
                    </template>
                    {{-- Error Icon --}}
                    <template x-if="toast.type === 'error'">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </template>
                    {{-- Warning Icon --}}
                    <template x-if="toast.type === 'warning'">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M12 9v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </template>
                    {{-- Info Icon --}}
                    <template x-if="toast.type === 'info'">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </template>
                </div>

                {{-- Text Group --}}
                <div class="text-group">
                    <p class="toast-title" x-text="toast.title"></p>
                    <p class="toast-desc" x-text="toast.message"></p>
                </div>
            </div>

            {{-- Close Button --}}
            <button class="close-btn" @click="removeToast(toast.id)">
                <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>

            {{-- Timer Progress Line - Menggunakan warna tema --}}
            <div class="timer-line" :class="'timer-' + toast.type"></div>
        </div>
    </template>
</div>

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
    gap: 12px;
    z-index: 10000;
    width: 100%;
    pointer-events: none;
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
    
    /* Animasi Muncul Drop-down */
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

/* Timer Progress Bar - Base */
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
