{{-- ============================================
    Floating Bulk-Action Pill
    Teleported to <body> → always bottom-center.
    ============================================ --}}
<template x-teleport="body">
    <div x-data="{
            show:     false,
            leaving:  false,
            confirm:  false,
            morphing: false,
            count:    0,
            pop:      false,

            /* ── Lifecycle ─────────────────────── */
            init() {
                this.$watch('$wire.selectedUsers', v => {
                    const n = v ? v.length : 0;
                    if (this.leaving || this.morphing) return;

                    if (n > 0 && !this.show) {
                        this.show    = true;
                        this.confirm = false;
                    } else if (n === 0 && this.show) {
                        this.exit();
                    }

                    if (n !== this.count && n > 0) {
                        this.pop = true;
                        setTimeout(() => this.pop = false, 450);
                        this.confirm = false;
                    }
                    this.count = n;
                });
            },

            /* ── Exit (slide-down) ─────────────── */
            exit() {
                this.leaving = true;
                setTimeout(() => {
                    this.reset();
                }, 350);
            },

            /* ── Full reset ────────────────────── */
            reset() {
                this.show     = false;
                this.leaving  = false;
                this.confirm  = false;
                this.morphing = false;
                this.count    = 0;
                const s = this.$refs.shell;
                if (s) { s.style.width = ''; s.style.height = ''; }
            },

            /* ── Cancel click ──────────────────── */
            onCancel() {
                if (this.confirm) {
                    this.confirm = false;           // back to normal
                } else {
                    $wire.set('selectedUsers', []);
                    $wire.set('selectAll', false);
                    this.exit();
                }
            },

            /* ── Delete click (two-step) ───────── */
            onDelete() {
                if (!this.confirm) {
                    this.confirm = true;
                    return;
                }

                /* — Phase 1: capture size, start morph — */
                const shell = this.$refs.shell;
                const w = shell.offsetWidth;
                const h = shell.offsetHeight;

                shell.style.width  = w + 'px';
                shell.style.height = h + 'px';
                shell.offsetHeight;               // reflow

                this.morphing = true;
                this.confirm  = false;

                requestAnimationFrame(() => {
                    shell.style.width  = h + 'px'; // square → circle
                });

                /* — Phase 2: call server — */
                $wire.bulkDelete();

                /* — Phase 3: after success anim, exit — */
                setTimeout(() => this.exit(), 1600);
            },
        }"
        x-show="show"
        x-cloak
        class="bpill"
        style="display:none">

        {{-- ── Pill shell ── --}}
        <div class="bpill__shell"
             x-ref="shell"
             :class="{
                 'bpill__shell--exit':    leaving,
                 'bpill__shell--confirm': confirm  && !morphing,
                 'bpill__shell--morph':   morphing,
             }">

            {{-- Expanding rings (visible only during morph) --}}
            <div class="bpill__ring"></div>
            <div class="bpill__ring bpill__ring--2"></div>

            {{-- ── Main content row ── --}}
            <div class="bpill__content">

                {{-- 1 ▸ Info --}}
                <div class="bpill__info">
                    <div class="bpill__badge" :class="pop && 'bpill__badge--pop'" x-text="count"></div>
                    <span class="bpill__text">{{ __('items_selected') }}</span>
                </div>

                {{-- Confirm label (replaces info) --}}
                <span class="bpill__confirm-label">{{ __('bulk_delete_confirm') }}</span>

                <div class="bpill__div"></div>

                {{-- 2 ▸ Cancel --}}
                <button @click="onCancel()" class="bpill__btn bpill__btn--cancel">
                    <i class="bi bi-x-lg" style="font-size:.85rem"></i>
                    <span>{{ __('cancel') }}</span>
                </button>

                <div class="bpill__div"></div>

                {{-- 3 ▸ Delete / Confirm --}}
                <button @click="onDelete()" class="bpill__btn bpill__btn--delete">
                    <i :class="confirm ? 'bi bi-check-lg' : 'bi bi-trash3'"></i>
                    <span x-text="confirm ? '{{ __('yes_delete') }}' : '{{ __('delete_selected') }}'"></span>
                </button>
            </div>

            {{-- ── Success check (visible only during morph) ── --}}
            <div class="bpill__ok">
                <svg width="28" height="28" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline class="bpill__ok-path" points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
        </div>
    </div>
</template>
