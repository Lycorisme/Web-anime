{{-- Toast Notification Component --}}
{{-- Terintegrasi dengan tema warna dan dark/light mode --}}
@props([
    'position' => 'top-right', // top-right, top-left, bottom-right, bottom-left, top-center, bottom-center
    'duration' => 5000,
    'maxToasts' => 5,
])

@php
    $positionClasses = [
        'top-right' => 'top-4 right-4',
        'top-left' => 'top-4 left-4',
        'bottom-right' => 'bottom-4 right-4',
        'bottom-left' => 'bottom-4 left-4',
        'top-center' => 'top-4 left-1/2 -translate-x-1/2',
        'bottom-center' => 'bottom-4 left-1/2 -translate-x-1/2',
    ];
    $positionClass = $positionClasses[$position] ?? $positionClasses['top-right'];
@endphp

<div
    x-data="{
        toasts: [],
        maxToasts: {{ $maxToasts }},
        defaultDuration: {{ $duration }},
        counter: 0,
        
        add(options = {}) {
            const toast = {
                id: ++this.counter,
                type: options.type || 'info',
                title: options.title || null,
                message: options.message || 'Notification',
                duration: options.duration !== undefined ? options.duration : this.defaultDuration,
                progress: 100,
                progressInterval: null,
            };
            
            // Remove oldest toast if max reached
            if (this.toasts.length >= this.maxToasts) {
                this.remove(this.toasts[0].id);
            }
            
            this.toasts.push(toast);
            
            // Auto-remove with progress
            if (toast.duration > 0) {
                const startTime = Date.now();
                const endTime = startTime + toast.duration;
                
                toast.progressInterval = setInterval(() => {
                    const now = Date.now();
                    const remaining = endTime - now;
                    toast.progress = Math.max(0, (remaining / toast.duration) * 100);
                    
                    if (remaining <= 0) {
                        this.remove(toast.id);
                    }
                }, 50);
            }
        },
        
        remove(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index !== -1) {
                if (this.toasts[index].progressInterval) {
                    clearInterval(this.toasts[index].progressInterval);
                }
                this.toasts.splice(index, 1);
            }
        },
        
        success(message, title = null, duration = null) {
            this.add({ type: 'success', message, title, duration });
        },
        
        error(message, title = null, duration = null) {
            this.add({ type: 'error', message, title, duration });
        },
        
        warning(message, title = null, duration = null) {
            this.add({ type: 'warning', message, title, duration });
        },
        
        info(message, title = null, duration = null) {
            this.add({ type: 'info', message, title, duration });
        },
        
        clear() {
            this.toasts.forEach(t => {
                if (t.progressInterval) clearInterval(t.progressInterval);
            });
            this.toasts = [];
        },
        
        getIcon(type) {
            const icons = {
                success: 'bi-check-circle-fill',
                error: 'bi-x-circle-fill',
                warning: 'bi-exclamation-triangle-fill',
                info: 'bi-info-circle-fill',
            };
            return icons[type] || icons.info;
        },
        
        getIconColor(type) {
            const colors = {
                success: 'text-emerald-500',
                error: 'text-red-500',
                warning: 'text-amber-500',
                info: 'text-blue-500',
            };
            return colors[type] || colors.info;
        },
        
        getProgressColor(type) {
            const colors = {
                success: 'bg-gradient-to-r from-emerald-500 to-teal-500',
                error: 'bg-gradient-to-r from-red-500 to-pink-500',
                warning: 'bg-gradient-to-r from-amber-500 to-orange-500',
                info: 'btn-premium',
            };
            return colors[type] || colors.info;
        },
        
        getBorderColor(type) {
            const colors = {
                success: 'border-l-emerald-500',
                error: 'border-l-red-500',
                warning: 'border-l-amber-500',
                info: 'border-l-blue-500',
            };
            return colors[type] || colors.info;
        }
    }"
    x-on:toast.window="add($event.detail)"
    x-on:toast-success.window="success($event.detail.message, $event.detail.title, $event.detail.duration)"
    x-on:toast-error.window="error($event.detail.message, $event.detail.title, $event.detail.duration)"
    x-on:toast-warning.window="warning($event.detail.message, $event.detail.title, $event.detail.duration)"
    x-on:toast-info.window="info($event.detail.message, $event.detail.title, $event.detail.duration)"
    x-on:clear-toasts.window="clear()"
    class="fixed {{ $positionClass }} z-[200] flex flex-col gap-3 pointer-events-none max-w-sm w-full sm:max-w-md"
    {{ $attributes }}
>
    <template x-for="toast in toasts" :key="toast.id">
        <div
            x-show="true"
            x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 translate-x-8 scale-95"
            x-transition:enter-end="opacity-100 translate-x-0 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 translate-x-0 scale-100"
            x-transition:leave-end="opacity-0 translate-x-8 scale-95"
            class="relative overflow-hidden rounded-xl shadow-2xl pointer-events-auto border-l-4 transition-all duration-200 hover:scale-[1.02] hover:shadow-3xl"
            :class="[
                getBorderColor(toast.type),
                $root.darkMode 
                    ? 'bg-slate-900/95 backdrop-blur-xl border border-white/10 shadow-black/30' 
                    : 'bg-white/95 backdrop-blur-xl border border-slate-200 shadow-slate-900/10'
            ]"
        >
            <!-- Content -->
            <div class="flex items-start gap-3 p-4">
                <!-- Icon -->
                <div 
                    class="flex-shrink-0 w-8 h-8 flex items-center justify-center rounded-lg transition-colors"
                    :class="toast.type === 'success' ? 'bg-emerald-500/10' : 
                            toast.type === 'error' ? 'bg-red-500/10' : 
                            toast.type === 'warning' ? 'bg-amber-500/10' : 
                            'bg-blue-500/10'"
                >
                    <i 
                        class="bi text-lg"
                        :class="[getIcon(toast.type), getIconColor(toast.type)]"
                    ></i>
                </div>

                <!-- Text Content -->
                <div class="flex-1 min-w-0">
                    <!-- Title (optional) -->
                    <template x-if="toast.title">
                        <h4 
                            class="text-sm font-bold mb-0.5 truncate transition-colors"
                            :class="$root.darkMode ? 'text-white' : 'text-slate-800'"
                            x-text="toast.title"
                        ></h4>
                    </template>
                    
                    <!-- Message -->
                    <p 
                        class="text-sm leading-relaxed transition-colors"
                        :class="[
                            toast.title ? '' : 'font-medium',
                            $root.darkMode ? 'text-slate-300' : 'text-slate-600'
                        ]"
                        x-text="toast.message"
                    ></p>
                </div>

                <!-- Close Button -->
                <button
                    @click="remove(toast.id)"
                    class="flex-shrink-0 w-6 h-6 flex items-center justify-center rounded-lg transition-all duration-200 hover:scale-110"
                    :class="$root.darkMode 
                        ? 'text-slate-500 hover:text-slate-300 hover:bg-slate-800' 
                        : 'text-slate-400 hover:text-slate-600 hover:bg-slate-100'"
                >
                    <i class="bi bi-x-lg text-xs"></i>
                </button>
            </div>

            <!-- Progress Bar -->
            <div 
                class="h-1 transition-all duration-100 ease-linear"
                :class="getProgressColor(toast.type)"
                :style="`width: ${toast.progress}%; opacity: ${toast.progress > 0 ? '1' : '0'}`"
            ></div>
        </div>
    </template>
</div>
