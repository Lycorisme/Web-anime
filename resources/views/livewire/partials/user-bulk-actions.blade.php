{{-- =============================================
    Floating Bulk-Action Pill
    Teleported to <body> for fixed bottom-center.
    Layout: [info] | [cancel] | [delete]
    ============================================= --}}
<template x-teleport="body">
    <div x-data="{
            show:     false,
            leaving:  false,
            confirm:  false,
            morphing: false,
            glowing:  false,
            count:    0,
            pop:      false,

            init() {
                this.$watch('$wire.selectedUsers', v => {
                    const n = v ? v.length : 0;
                    if (this.leaving || this.morphing) return;

                    if (n > 0 && !this.show) {
                        this.show    = true;
                        this.confirm = false;
                    } else if (n === 0 && this.show) {
                        this.slideOut();
                    }

                    if (n !== this.count && n > 0) {
                        this.pop = true;
                        setTimeout(() => this.pop = false, 450);
                        this.confirm = false;
                    }
                    this.count = n;
                });
            },

            slideOut() {
                this.leaving = true;
                setTimeout(() => this.fullReset(), 350);
            },

            fullReset() {
                this.show = this.leaving = this.confirm = this.morphing = this.glowing = false;
                this.count = 0;
                const s = this.$refs.shell;
                if (s) { s.style.width = ''; s.style.height = ''; }
            },

            onCancel() {
                if (this.confirm) { this.confirm = false; return; }
                $wire.set('selectedUsers', []);
                $wire.set('selectAll', false);
                this.slideOut();
            },

            onDelete() {
                if (!this.confirm) { this.confirm = true; return; }

                const s = this.$refs.shell;
                const w = s.offsetWidth;
                const h = s.offsetHeight;
                const size = Math.max(h, 52);

                // lock current width for smooth transition start
                s.style.width  = w + 'px';
                s.style.height = h + 'px';
                s.offsetHeight;                    // force reflow

                this.morphing = true;
                this.confirm  = false;

                // morph to perfect circle
                requestAnimationFrame(() => {
                    s.style.width  = size + 'px';
                    s.style.height = size + 'px';
                });

                $wire.bulkDelete();

                // green glow pulse after checkmark draws
                setTimeout(() => { this.glowing = true; }, 850);

                // slide out after full sequence
                setTimeout(() => { this.slideOut(); }, 1700);
            },
        }"
        x-show="show" x-cloak class="bpill" style="display:none">

        <div class="bpill__shell" x-ref="shell"
             :class="{
                 'bpill__shell--exit':    leaving,
                 'bpill__shell--confirm': confirm  && !morphing,
                 'bpill__shell--morph':   morphing,
                 'bpill__shell--glow':    glowing,
             }">

            {{-- Expanding rings --}}
            <div class="bpill__ring"></div>
            <div class="bpill__ring bpill__ring--b"></div>

            {{-- Content row --}}
            <div class="bpill__row">

                {{-- 1. Info --}}
                <div class="bpill__info">
                    <div class="bpill__badge" :class="pop && 'bpill__badge--pop'" x-text="count"></div>
                    <span class="bpill__label">{{ __('items_selected') }}</span>
                </div>

                {{-- Confirm label --}}
                <span class="bpill__clabel">{{ __('bulk_delete_confirm') }}</span>

                <div class="bpill__sep"></div>

                {{-- 2. Cancel --}}
                <button @click="onCancel()" class="bpill__btn bpill__btn--cancel">
                    <i class="bi bi-x-lg" style="font-size:.85rem"></i>
                    <span>{{ __('cancel') }}</span>
                </button>

                <div class="bpill__sep"></div>

                {{-- 3. Delete --}}
                <button @click="onDelete()" class="bpill__btn bpill__btn--del">
                    <i :class="confirm ? 'bi bi-check-lg' : 'bi bi-trash3'"></i>
                    <span x-text="confirm ? '{{ __('yes_delete') }}' : '{{ __('delete_selected') }}'"></span>
                </button>
            </div>

            {{-- Success checkmark --}}
            <div class="bpill__ok">
                <svg width="26" height="26" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline class="bpill__ok-path" points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
        </div>
    </div>
</template>
