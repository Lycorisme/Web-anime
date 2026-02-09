{{-- Alert Confirmation Dialog Component --}}
{{-- Terintegrasi dengan tema warna dan dark/light mode --}}
@props([
    'id' => 'confirm-dialog',
    'title' => __('confirm'),
    'message' => __('confirm_action_message'),
    'confirmText' => __('yes_continue'),
    'cancelText' => __('cancel'),
    'type' => 'warning', // warning, danger, info, success
    'confirmAction' => null,
])

@php
    $typeConfig = [
        'warning' => [
            'icon' => 'bi-exclamation-triangle-fill',
            'iconColor' => 'text-amber-500',
            'bgGlow' => 'from-amber-500/20 to-orange-500/20',
            'buttonBg' => 'bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600',
        ],
        'danger' => [
            'icon' => 'bi-trash3-fill',
            'iconColor' => 'text-red-500',
            'bgGlow' => 'from-red-500/20 to-pink-500/20',
            'buttonBg' => 'bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600',
        ],
        'info' => [
            'icon' => 'bi-info-circle-fill',
            'iconColor' => 'text-blue-500',
            'bgGlow' => 'from-blue-500/20 to-cyan-500/20',
            'buttonBg' => 'btn-premium',
        ],
        'success' => [
            'icon' => 'bi-check-circle-fill',
            'iconColor' => 'text-emerald-500',
            'bgGlow' => 'from-emerald-500/20 to-teal-500/20',
            'buttonBg' => 'bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600',
        ],
    ];
    $config = $typeConfig[$type] ?? $typeConfig['warning'];
@endphp

<div
    x-data="{ 
        open: false,
        title: '{{ $title }}',
        message: '{{ $message }}',
        confirmText: '{{ $confirmText }}',
        cancelText: '{{ $cancelText }}',
        type: '{{ $type }}',
        confirmCallback: null,
        cancelCallback: null,
        
        show(options = {}) {
            this.title = options.title || this.title;
            this.message = options.message || this.message;
            this.confirmText = options.confirmText || this.confirmText;
            this.cancelText = options.cancelText || this.cancelText;
            this.type = options.type || this.type;
            this.confirmCallback = options.onConfirm || null;
            this.cancelCallback = options.onCancel || null;
            this.open = true;
        },
        
        close() {
            this.open = false;
        },
        
        confirm() {
            if (this.confirmCallback) this.confirmCallback();
            this.close();
        },
        
        cancel() {
            if (this.cancelCallback) this.cancelCallback();
            this.close();
        }
    }"
    x-on:open-confirm-{{ $id }}.window="show($event.detail)"
    x-on:close-confirm-{{ $id }}.window="close()"
    x-cloak
    {{ $attributes }}
>
    <!-- Backdrop Overlay -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-[100] bg-black/60 backdrop-blur-sm"
        @click="cancel()"
    ></div>

    <!-- Dialog Container -->
    <div
        x-show="open"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100 translate-y-0"
        x-transition:leave-end="opacity-0 scale-95 translate-y-4"
        class="fixed inset-0 z-[101] flex items-center justify-center p-4"
        @click.self="cancel()"
    >
        <!-- Dialog Box -->
        <div 
            class="w-full max-w-md overflow-hidden rounded-2xl shadow-2xl"
            :class="$root.darkMode ? 'bg-slate-900/95 border border-white/10' : 'bg-white/95 border border-slate-200'"
            @click.stop
        >
            <!-- Header Glow Effect -->
            <div class="relative p-6 sm:p-8">
                <!-- Gradient Glow Background -->
                <div 
                    class="absolute inset-0 opacity-70 transition-opacity duration-500"
                    :class="type === 'danger' ? 'bg-gradient-to-br from-red-500/20 to-pink-500/20' : 
                            type === 'success' ? 'bg-gradient-to-br from-emerald-500/20 to-teal-500/20' : 
                            type === 'info' ? 'bg-gradient-to-br from-blue-500/20 to-cyan-500/20' : 
                            'bg-gradient-to-br from-amber-500/20 to-orange-500/20'"
                ></div>
                
                <!-- Premium Theme Accent Border (Top) -->
                <div class="absolute top-0 left-0 right-0 h-1 btn-premium"></div>
                
                <!-- Content -->
                <div class="relative z-10 text-center">
                    <!-- Icon with Pulse Animation -->
                    <div class="mx-auto mb-4 flex h-16 w-16 sm:h-20 sm:w-20 items-center justify-center rounded-full transition-all duration-300"
                         :class="type === 'danger' ? 'bg-red-500/10' : 
                                 type === 'success' ? 'bg-emerald-500/10' : 
                                 type === 'info' ? 'bg-blue-500/10' : 
                                 'bg-amber-500/10'">
                        <!-- Icon based on type -->
                        <template x-if="type === 'danger'">
                            <i class="bi bi-trash3-fill text-3xl sm:text-4xl text-red-500 animate-pulse"></i>
                        </template>
                        <template x-if="type === 'success'">
                            <i class="bi bi-check-circle-fill text-3xl sm:text-4xl text-emerald-500"></i>
                        </template>
                        <template x-if="type === 'info'">
                            <i class="bi bi-info-circle-fill text-3xl sm:text-4xl text-blue-500"></i>
                        </template>
                        <template x-if="type === 'warning'">
                            <i class="bi bi-exclamation-triangle-fill text-3xl sm:text-4xl text-amber-500 animate-pulse"></i>
                        </template>
                    </div>

                    <!-- Title -->
                    <h3 
                        class="mb-2 text-xl sm:text-2xl font-bold transition-colors"
                        :class="$root.darkMode ? 'text-white' : 'text-slate-800'"
                        x-text="title"
                    ></h3>

                    <!-- Message -->
                    <p 
                        class="text-sm sm:text-base leading-relaxed transition-colors"
                        :class="$root.darkMode ? 'text-slate-400' : 'text-slate-600'"
                        x-text="message"
                    ></p>
                </div>
            </div>

            <!-- Footer Actions -->
            <div 
                class="flex flex-col-reverse sm:flex-row gap-3 p-4 sm:p-6 border-t transition-colors"
                :class="$root.darkMode ? 'border-white/10 bg-slate-900/50' : 'border-slate-100 bg-slate-50/50'"
            >
                <!-- Cancel Button -->
                <button
                    @click="cancel()"
                    class="flex-1 px-5 py-3 rounded-xl font-semibold text-sm transition-all duration-200 
                           focus:outline-none focus:ring-2 focus:ring-offset-2 active:scale-95"
                    :class="$root.darkMode 
                        ? 'bg-slate-800 text-slate-300 hover:bg-slate-700 focus:ring-slate-600 focus:ring-offset-slate-900' 
                        : 'bg-slate-200 text-slate-700 hover:bg-slate-300 focus:ring-slate-400 focus:ring-offset-white'"
                    x-text="cancelText"
                ></button>

                <!-- Confirm Button -->
                <button
                    @click="confirm()"
                    class="flex-1 px-5 py-3 rounded-xl font-semibold text-sm text-white transition-all duration-200 
                           shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 active:scale-95 hover:shadow-xl hover:translate-y-[-1px]"
                    :class="type === 'danger' 
                        ? 'bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 focus:ring-red-500 shadow-red-500/25' 
                        : type === 'success'
                        ? 'bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 focus:ring-emerald-500 shadow-emerald-500/25'
                        : type === 'info'
                        ? 'btn-premium focus:ring-blue-500 shadow-blue-500/25'
                        : 'bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 focus:ring-amber-500 shadow-amber-500/25'"
                    x-text="confirmText"
                ></button>
            </div>
        </div>
    </div>
</div>
