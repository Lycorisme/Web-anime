{{-- Bulk Action Pill — Force Delete & Restore (Trashed Data) --}}
{{-- Buttons: Cancel + Restore + Delete Permanently --}}
<template x-teleport="body">
    <div x-data="{
            show: false,
            out: false,
            cfm: false,
            cfmType: '',
            confirmText: '',
            morph: false,
            count: 0,
            pop: false,

            init() {
                this.$watch('$wire.selectedUsers', v => {
                    const sel = v || [];
                    window.userTypes = window.userTypes || {};
                    const n = sel.filter(id => window.userTypes[id] === 'trashed').length;
                    if (this.out || this.morph) return;

                    if (n > 0 && !this.show) { this.show = true; this.cfm = false; this.cfmType = ''; this.confirmText = ''; }
                    else if (n === 0 && this.show) { this.dismiss(); }

                    if (n !== this.count && n > 0) {
                        this.pop = true;
                        setTimeout(() => this.pop = false, 350);
                        this.cfm = false;
                        this.cfmType = '';
                        this.confirmText = '';
                    }
                    this.count = n;
                });

                // Watch typing to auto-submit when user types exactly DELETE
                this.$watch('confirmText', val => {
                    if (this.cfm && this.cfmType === 'force' && val.toUpperCase() === 'DELETE') {
                        setTimeout(() => this.doAction('force-confirmed'), 300);
                    }
                });
            },

            dismiss() {
                this.out = true;
                setTimeout(() => this.reset(), 280);
            },

            reset() {
                Object.assign(this, { show:false, out:false, cfm:false, cfmType:'', confirmText:'', morph:false, count:0 });
                const s = this.$refs.s;
                if (s) { s.style.width = ''; s.style.height = ''; }
            },

            cancel() {
                if (this.cfm) { this.cfm = false; this.cfmType = ''; this.confirmText = ''; return; }
                $wire.set('selectedUsers', []);
                $wire.set('selectAll', false);
                this.dismiss();
            },

            async doAction(type) {
                // If opening force confirmation modal
                if (!this.cfm || (type !== 'force-confirmed' && type !== 'restore')) { 
                    this.cfm = true; 
                    this.cfmType = type; 
                    if (type === 'force') {
                        // Focus the main modal input instead of inline input
                        setTimeout(() => this.$refs.confirmModalInput && this.$refs.confirmModalInput.focus(), 150);
                    }
                    return; 
                }

                // Actually doing the action
                const isForceConfirmed = type === 'force-confirmed';
                
                // If it's the force delete, close the modal immediately to show the pill resolving state
                if (isForceConfirmed) {
                    this.cfm = false;
                    this.cfmType = '';
                    this.confirmText = '';
                }

                const s = this.$refs.s;
                const w = s.offsetWidth, h = s.offsetHeight;
                const sz = Math.max(h, 46);

                s.style.width = w + 'px';
                s.style.height = h + 'px';
                
                void s.offsetHeight;

                this.morph = true;
                
                // reset restore confirmation state for pill morph
                if (type === 'restore') {
                    this.cfm = false;
                    this.cfmType = '';
                }

                requestAnimationFrame(() => {
                    s.style.width = sz + 'px';
                    s.style.height = sz + 'px';
                });

                if (isForceConfirmed) {
                    await $wire.bulkForceDelete();
                } else {
                    await $wire.bulkRestore();
                }

                setTimeout(() => {
                    this.out = true;
                    setTimeout(() => this.reset(), 600);
                }, 400); 
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
                <span class="bp__cl bp__cl--restore" x-show="cfmType === 'restore'">{{ __('bulk_restore_confirm') }}</span>

                {{-- Cancel --}}
                <button @click="cancel()" class="bp__b bp__b--c hover:bg-slate-500/5 dark:hover:bg-slate-400/10">
                    <i class="bi bi-x-lg" style="font-size:.8rem"></i>
                    <span>{{ __('cancel') }}</span>
                </button>

                <div class="bp__d"></div>

                {{-- Restore --}}
                <button @click="doAction('restore')" class="bp__b bp__b--r" x-show="cfmType !== 'force'">
                    <i :class="cfm && cfmType === 'restore' ? 'bi bi-check-lg' : 'bi bi-arrow-counterclockwise'"></i>
                    <span x-text="cfm && cfmType === 'restore' ? '{{ __('yes_restore') }}' : '{{ __('restore') }}'"></span>
                </button>

                <div class="bp__d" :class="{ 'hidden': cfm }"></div>

                {{-- Force Delete --}}
                <button @click="doAction('force')" class="bp__b bp__b--fd" x-show="cfmType !== 'restore'">
                    <i class="bi bi-trash-fill"></i>
                    <span>{{ __('delete_permanently') }}</span>
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
        
        <!-- Force Delete Confirmation Modal — teleported separately to escape perspective -->
        <template x-teleport="body">
            <div x-show="cfm && cfmType === 'force' && !morph" 
                 class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm"
                 x-transition.opacity.duration.300ms
                 style="display: none;">
                 
                 <!-- Modal Content -->
                 <div class="bg-white dark:bg-slate-800 rounded-xl shadow-2xl p-6 w-full max-w-md mx-4 border border-red-500/20"
                      @click.outside="if(cfmType === 'force') cancel()"
                      x-show="cfm && cfmType === 'force' && !morph"
                      x-transition:enter="ease-out duration-300"
                      x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                      x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                      x-transition:leave="ease-in duration-200"
                      x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                      x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                      
                     <div class="flex items-center gap-4 mb-4 text-red-600 dark:text-red-500">
                         <div class="p-3 bg-red-100 dark:bg-red-500/20 rounded-full flex-shrink-0">
                             <i class="bi bi-exclamation-triangle text-xl"></i>
                         </div>
                         <h3 class="text-lg font-bold">Permanent Deletion</h3>
                     </div>
                     
                     <p class="text-slate-600 dark:text-slate-300 mb-6 text-sm">
                         You are about to permanently delete <strong x-text="count" class="text-slate-900 dark:text-white"></strong> users. This action <span class="font-bold underline">cannot be undone</span>.
                     </p>
                     
                     <div class="mb-6">
                         <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                             Please type <strong class="select-none text-red-600 dark:text-red-400">DELETE</strong> to confirm:
                         </label>
                         <input type="text" 
                                x-ref="confirmModalInput"
                                x-model="confirmText" 
                                class="w-full px-4 py-2 border border-slate-300 dark:border-slate-600 rounded-lg shadow-sm bg-white dark:bg-slate-700 text-slate-900 dark:text-white focus:ring-2 focus:ring-red-500 focus:border-red-500 outline-none uppercase font-bold tracking-widest transition-all font-mono"
                                placeholder="DELETE"
                                autocomplete="off">
                     </div>
                     
                     <div class="flex justify-end gap-3">
                         <button @click="cancel()" class="px-4 py-2 text-sm font-medium text-slate-700 bg-white dark:bg-slate-800 border border-slate-300 dark:border-slate-600 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-700 dark:text-slate-300 focus:outline-none focus:ring-2 focus:ring-slate-500">
                             Cancel
                         </button>
                     </div>
                 </div>
            </div>
        </template>
    </div>
</template>
