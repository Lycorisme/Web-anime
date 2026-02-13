{{-- Bulk Action Pill v4 --}}
<template x-teleport="body">
    <div x-data="{
            show: false,
            out: false,
            cfm: false,
            morph: false,
            count: 0,
            pop: false,

            init() {
                this.$watch('$wire.selectedUsers', v => {
                    const n = v ? v.length : 0;
                    if (this.out || this.morph) return;

                    if (n > 0 && !this.show) { this.show = true; this.cfm = false; }
                    else if (n === 0 && this.show) { this.dismiss(); }

                    if (n !== this.count && n > 0) {
                        this.pop = true;
                        setTimeout(() => this.pop = false, 350);
                        this.cfm = false;
                    }
                    this.count = n;
                });
            },

            dismiss() {
                this.out = true;
                setTimeout(() => this.reset(), 280);
            },

            reset() {
                Object.assign(this, { show:false, out:false, cfm:false, morph:false, count:0 });
                const s = this.$refs.s;
                if (s) { s.style.width = ''; s.style.height = ''; }
            },

            cancel() {
                if (this.cfm) { this.cfm = false; return; }
                $wire.set('selectedUsers', []);
                $wire.set('selectAll', false);
                this.dismiss();
            },

            del() {
                if (!this.cfm) { this.cfm = true; return; }

                const s = this.$refs.s;
                const w = s.offsetWidth, h = s.offsetHeight;
                const sz = Math.max(h, 46);

                s.style.width = w + 'px';
                s.style.height = h + 'px';
                s.offsetHeight;

                this.morph = true;
                this.cfm = false;

                requestAnimationFrame(() => {
                    s.style.width = sz + 'px';
                    s.style.height = sz + 'px';
                });

                $wire.bulkDelete();

                setTimeout(() => {
                    this.out = true;
                    setTimeout(() => this.reset(), 400);
                }, 900);
            },
        }"
        x-show="show" x-cloak class="bp" style="display:none">

        <div class="bp__s" x-ref="s"
             :class="{
                 'bp__s--exit':    out,
                 'bp__s--confirm': cfm && !morph,
                 'bp__s--morph':   morph,
             }">

            <div class="bp__ring"></div>

            <div class="bp__row">
                {{-- Info --}}
                <div class="bp__info">
                    <div class="bp__n" :class="pop && 'bp__n--pop'" x-text="count"></div>
                    <span class="bp__t">{{ __('items_selected') }}</span>
                </div>

                {{-- Confirm label --}}
                <span class="bp__cl">{{ __('bulk_delete_confirm') }}</span>

                <div class="bp__d"></div>

                {{-- Cancel --}}
                <button @click="cancel()" class="bp__b bp__b--c">
                    <i class="bi bi-x-lg" style="font-size:.8rem"></i>
                    <span>{{ __('cancel') }}</span>
                </button>

                <div class="bp__d"></div>

                {{-- Delete --}}
                <button @click="del()" class="bp__b bp__b--d">
                    <i :class="cfm ? 'bi bi-check-lg' : 'bi bi-trash3'"></i>
                    <span x-text="cfm ? '{{ __('yes_delete') }}' : '{{ __('delete_selected') }}'"></span>
                </button>
            </div>

            {{-- Checkmark --}}
            <div class="bp__ok">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                     stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <polyline class="bp__ok-p" points="20 6 9 17 4 12"></polyline>
                </svg>
            </div>
        </div>
    </div>
</template>
