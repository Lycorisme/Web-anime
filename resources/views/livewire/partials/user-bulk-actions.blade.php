{{-- Floating Bulk Action Bar (Pill) --}}
{{-- Teleported to body for independent positioning at bottom center --}}
<template x-teleport="body">
    <div x-data="{
            show: false,
            leaving: false,
            confirming: false,
            deleting: false,
            successPulse: false,
            count: 0,
            popBadge: false,

            init() {
                this.$watch('$wire.selectedUsers', (val) => {
                    const newCount = val ? val.length : 0;

                    // Ignore changes during delete/exit animation
                    if (this.leaving || this.deleting) return;

                    if (newCount > 0 && !this.show) {
                        this.show = true;
                        this.leaving = false;
                        this.confirming = false;
                    } else if (newCount === 0 && this.show) {
                        this.dismiss();
                    }

                    // Pop animation when count changes
                    if (newCount !== this.count && newCount > 0) {
                        this.popBadge = false;
                        this.$nextTick(() => {
                            this.popBadge = true;
                            setTimeout(() => this.popBadge = false, 350);
                        });
                    }

                    // Reset confirm mode if count changes
                    if (newCount !== this.count) {
                        this.confirming = false;
                    }

                    this.count = newCount;
                });
            },

            dismiss() {
                this.leaving = true;
                setTimeout(() => {
                    this.show = false;
                    this.leaving = false;
                    this.confirming = false;
                    this.deleting = false;
                    this.successPulse = false;
                    if (this.count > 0) {
                        $wire.set('selectedUsers', []);
                        $wire.set('selectAll', false);
                    }
                    this.count = 0;
                    // Reset inline width
                    if (this.$refs.pillWrapper) {
                        this.$refs.pillWrapper.style.width = '';
                    }
                }, 250);
            },

            handleDelete() {
                if (!this.confirming) {
                    // First click: enter confirm mode
                    this.confirming = true;
                } else {
                    // Second click: morph to circle + delete
                    const wrapper = this.$refs.pillWrapper;
                    const currentWidth = wrapper.offsetWidth;
                    const targetSize = wrapper.offsetHeight;

                    // Set current width explicitly for transition start
                    wrapper.style.width = currentWidth + 'px';
                    wrapper.offsetHeight; // Force reflow

                    this.deleting = true;
                    this.confirming = false;

                    // Morph width to circle
                    requestAnimationFrame(() => {
                        wrapper.style.width = targetSize + 'px';
                    });

                    // Call bulkDelete on server
                    $wire.bulkDelete();

                    // Success pulse after checkmark draws
                    setTimeout(() => {
                        this.successPulse = true;
                    }, 750);

                    // Exit slide-down after success
                    setTimeout(() => {
                        this.leaving = true;
                        setTimeout(() => {
                            this.show = false;
                            this.leaving = false;
                            this.confirming = false;
                            this.deleting = false;
                            this.successPulse = false;
                            this.count = 0;
                            wrapper.style.width = '';
                        }, 250);
                    }, 1200);
                }
            }
        }"
        x-show="show"
        x-cloak
        class="bulk-pill-container"
        style="display: none;">

        <div class="bulk-pill-wrapper"
             x-ref="pillWrapper"
             :class="{
                'bulk-exit': leaving,
                'bulk-confirm-mode': confirming && !deleting,
                'bulk-deleting': deleting,
                'bulk-success-pulse': successPulse
             }">

            {{-- Content (fades out during delete morph) --}}
            <div class="bulk-pill-content">

                {{-- 1. Info Section (Count + Text) --}}
                <div class="bulk-pill-info">
                    <div class="bulk-pill-count" :class="{ 'pop': popBadge }">
                        <span x-text="count"></span>
                    </div>
                    <span class="bulk-pill-info-text" x-text="count + ' {{ __('items_selected') }}'"></span>
                </div>

                {{-- Confirm Label (replaces info during confirm mode) --}}
                <span class="bulk-confirm-label">{{ __('bulk_delete_confirm') }}</span>

                {{-- Divider --}}
                <div class="bulk-pill-divider"></div>

                {{-- 2. Cancel Button --}}
                <button @click="confirming ? (confirming = false) : dismiss()" class="bulk-pill-btn bulk-pill-btn-cancel">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <span>{{ __('cancel') }}</span>
                </button>

                {{-- Divider --}}
                <div class="bulk-pill-divider"></div>

                {{-- 3. Delete / Confirm Button --}}
                <button @click="handleDelete()" class="bulk-pill-btn bulk-pill-btn-delete">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                        <path x-show="!confirming" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                        <path x-show="confirming" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span x-text="confirming ? '{{ __('yes_delete') }}' : '{{ __('delete_selected') }}'"></span>
                </button>
            </div>

            {{-- Success Indicator (appears when morphing to circle) --}}
            <div class="bulk-pill-success">
                <svg viewBox="0 0 24 24" width="24" height="24">
                    <path class="bulk-check-path"
                          d="M5 13l4 4L19 7"
                          stroke="#22c55e"
                          stroke-width="2.5"
                          fill="none"
                          stroke-linecap="round"
                          stroke-linejoin="round" />
                </svg>
            </div>
        </div>
    </div>
</template>
