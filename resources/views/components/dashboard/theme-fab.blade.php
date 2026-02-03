{{-- Theme FAB (Floating Action Button) Component --}}
<div class="fixed bottom-8 right-8 z-[999]" x-data="{ open: false }">
    <!-- FAB Button -->
    <button 
        @click="open = !open" 
        class="w-14 h-14 btn-premium rounded-full flex items-center justify-center text-white shadow-2xl hover:scale-110 transition-transform active:scale-95 relative z-[1001]"
    >
        <i class="bi bi-palette-fill text-xl" :class="open ? 'animate-spin' : ''"></i>
    </button>

    <!-- Theme Panel -->
    <div 
        x-show="open" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-10 scale-90"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-10 scale-90"
        class="absolute bottom-20 right-0 glass-card p-4 rounded-3xl shadow-2xl w-64 border border-white/20 z-[1000]"
        @click.away="open = false"
        x-cloak
    >
        <h4 class="text-xs font-bold uppercase tracking-widest mb-4 text-slate-400">
            Pilih Tema Gradien
        </h4>
        
        <!-- Theme Grid -->
        <div class="grid grid-cols-2 gap-3">
            <template x-for="theme in colorThemes" :key="theme.name">
                <button 
                    @click="setTheme(theme)" 
                    class="h-12 rounded-xl border-2 transition-all hover:scale-105 active:scale-95"
                    :class="currentTheme.name === theme.name ? 'border-white' : 'border-transparent'"
                    :style="`background: linear-gradient(135deg, ${theme.start} 0%, ${theme.end} 100%)`"
                    :title="theme.name"
                >
                </button>
            </template>
        </div>
        
        <!-- Panel Footer -->
        <div class="mt-4 pt-4 border-t border-white/10">
            <p class="text-[10px] text-slate-500 text-center italic">
                Klik warna untuk mengubah gradien sistem secara instan.
            </p>
        </div>
    </div>
</div>
