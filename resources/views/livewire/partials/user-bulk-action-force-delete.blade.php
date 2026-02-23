{{-- Bulk Action Pill — Force Delete & Restore (Trashed Data) --}}
{{-- Buttons: Cancel + Restore + Delete Permanently --}}
<template x-teleport="body">
    <div x-data="{
            show: false,
            out: false,
            cfm: false,
            cfmType: '',
            morph: false,
            count: 0,
            pop: false,

            init() {
                this.$watch('$wire.selectedUsers', v => {
                    const sel = v || [];
                    window.userTypes = window.userTypes || {};
                    const n = sel.filter(id => window.userTypes[id] === 'trashed').length;
                    if (this.out || this.morph) return;

                    if (n > 0 && !this.show) { this.show = true; this.cfm = false; this.cfmType = ''; }
                    else if (n === 0 && this.show) { this.dismiss(); }

                    if (n !== this.count && n > 0) {
                        this.pop = true;
                        setTimeout(() => this.pop = false, 350);
                        this.cfm = false;
                        this.cfmType = '';
                    }
                    this.count = n;
                });
            },

            dismiss() {
                this.out = true;
                setTimeout(() => this.reset(), 280);
            },

            reset() {
                Object.assign(this, { show:false, out:false, cfm:false, cfmType:'', morph:false, count:0 });
                const s = this.$refs.s;
                if (s) { s.style.width = ''; s.style.height = ''; }
            },

            cancel() {
                if (this.cfm) { this.cfm = false; this.cfmType = ''; return; }
                $wire.set('selectedUsers', []);
                $wire.set('selectAll', false);
                this.dismiss();
            },

            doAction(type) {
                if (!this.cfm || this.cfmType !== type) { 
                    this.cfm = true; 
                    this.cfmType = type; 
                    return; 
                }

                const s = this.$refs.s;
                const w = s.offsetWidth, h = s.offsetHeight;
                const sz = Math.max(h, 46);

                s.style.width = w + 'px';
                s.style.height = h + 'px';
                
                void s.offsetHeight;

                this.morph = true;
                this.cfm = false;
                this.cfmType = '';

                requestAnimationFrame(() => {
                    s.style.width = sz + 'px';
                    s.style.height = sz + 'px';
                });

                if (type === 'force') {
                    $wire.bulkForceDelete();
                } else {
                    $wire.bulkRestore();
                }

                setTimeout(() => {
                    this.out = true;
                    setTimeout(() => this.reset(), 600);
                }, 1000); 
            },
        }"
        x-show="show" x-cloak class="bp bp--trashed" style="display:none; perspective: 1000px;">

        <!-- Deep Crimson Ambient Glow -->
        <div class="absolute inset-0 bg-red-600/15 dark:bg-red-500/15 blur-2xl rounded-full pointer-events-none transition-all duration-700 shadow-[0_0_30px_rgba(239,68,68,0.2)]"
             :class="{'opacity-100 scale-105': show && !out, 'opacity-0 scale-90': out}"></div>

        <div class="bp__s shadow-2xl ring-1 ring-red-500/10 dark:ring-red-400/20" x-ref="s"
             :class="{
                 'bp__s--exit':    out,
                 'bp__s--confirm': cfm && !morph,
                 'bp__s--confirm-restore': cfm && cfmType === 'restore' && !morph,
                 'bp__s--confirm-force':   cfm && cfmType === 'force' && !morph,
                 'bp__s--morph':   morph,
             }">

            <div class="bp__ring"></div>

            <div class="bp__row">
                {{-- Info --}}
                <div class="bp__info">
                    <div class="bp__n bp__n--trashed" :class="pop && 'bp__n--pop'" x-text="count"></div>
                    <span class="bp__t">{{ __('items_selected') }}</span>
                    <div class="">
                        <i class="" style="font-size: .65rem;"></i>
                    </div>
                </div>

                <div class="bp__d"></div>

                {{-- Confirm label --}}
                <span class="bp__cl" x-show="cfmType === 'force'">{{ __('bulk_force_delete_confirm') }}</span>
                <span class="bp__cl bp__cl--restore" x-show="cfmType === 'restore'">{{ __('bulk_restore_confirm') }}</span>

                {{-- Cancel --}}
                <button @click="cancel()" class="bp__b bp__b--c hover:bg-slate-500/5 dark:hover:bg-slate-400/10">
                    <i class="bi bi-x-lg" style="font-size:.8rem"></i>
                    <span>{{ __('cancel') }}</span>
                </button>

                <div class="bp__d"></div>

                {{-- Restore --}}
                <button @click="doAction('restore')" class="bp__b bp__b--r">
                    <i :class="cfm && cfmType === 'restore' ? 'bi bi-check-lg' : 'bi bi-arrow-counterclockwise'"></i>
                    <span x-text="cfm && cfmType === 'restore' ? '{{ __('yes_restore') }}' : '{{ __('restore') }}'"></span>
                </button>

                <div class="bp__d" :class="{ 'hidden': cfm }"></div>

                {{-- Force Delete --}}
                <button @click="doAction('force')" class="bp__b bp__b--fd">
                    <i :class="cfm && cfmType === 'force' ? 'bi bi-check-lg' : 'bi bi-trash-fill'"></i>
                    <span x-text="cfm && cfmType === 'force' ? '{{ __('yes_delete_permanently') }}' : '{{ __('delete_permanently') }}'"></span>
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
