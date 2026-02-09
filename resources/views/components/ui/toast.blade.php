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
                message: options.message || '{{ __('notification') }}',
                duration: duration,
                removing: false,
                collapsing: false,
            };
            
            if (this.toasts.length >= this.maxToasts) {
                this.removeToast(this.toasts[0].id);
            }
            
            this.toasts.push(toast);
        },
        
        onTimerEnd(id) {
            this.removeToast(id);
        },
        
        removeToast(id) {
            const index = this.toasts.findIndex(t => t.id === id);
            if (index === -1) return;
            if (this.toasts[index].removing) return;
            
            // Phase 1: Mulai animasi fadeUp pada toast
            this.toasts[index].removing = true;
            
            // Phase 2: Setelah fadeUp selesai (400ms), mulai collapse height wrapper
            const self = this;
            setTimeout(function() {
                const collapseIndex = self.toasts.findIndex(t => t.id === id);
                if (collapseIndex !== -1) {
                    self.toasts[collapseIndex].collapsing = true;
                    
                    // Phase 3: Setelah collapse selesai (300ms), hapus dari DOM
                    setTimeout(function() {
                        const removeIndex = self.toasts.findIndex(t => t.id === id);
                        if (removeIndex !== -1) {
                            self.toasts.splice(removeIndex, 1);
                        }
                    }, 300);
                }
            }, 400);
        },
        
        success(message, title = null, duration = null) {
            this.add({ type: 'success', message, title: title || '{{ __('success') }}', duration });
        },
        
        error(message, title = null, duration = null) {
            this.add({ type: 'error', message, title: title || '{{ __('error') }}', duration });
        },
        
        warning(message, title = null, duration = null) {
            this.add({ type: 'warning', message, title: title || '{{ __('warning') }}', duration });
        },
        
        info(message, title = null, duration = null) {
            this.add({ type: 'info', message, title: title || '{{ __('info') }}', duration });
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
        {{-- Layout Transition Wrapper --}}
        <div 
            class="toast-wrapper"
            :class="{ 'collapsing': toast.collapsing }"
        >
            <div
                class="toast"
                :class="{ 'removing': toast.removing }"
            >
                {{-- Content --}}
                <div class="toast-content">
                    {{-- Icon Wrapper --}}
                    <div class="icon-wrapper" :class="'icon-' + toast.type">
                        @include('components.ui.partials.toast-icons')
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

                {{-- Timer Progress Line --}}
                <div 
                    class="timer-line" 
                    :class="'timer-' + toast.type"
                    @animationend="if($event.animationName === 'shrink') onTimerEnd(toast.id)"
                ></div>
            </div>
        </div>
    </template>
</div>

{{-- Include separated style files --}}
@include('components.ui.styles.toast-styles')
@include('components.ui.styles.toast-controls')
