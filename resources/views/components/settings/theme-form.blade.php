{{-- Theme Settings Form --}}
@props(['colorThemes' => []])

<div class="glass-card rounded-3xl overflow-hidden animate-fade-in-up delay-200">
    <!-- Form Header -->
    <div class="bg-white/5 px-6 py-4 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="flex gap-1.5">
                <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
            </div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-2">
                Tema Warna
            </span>
        </div>
    </div>

    <!-- Form Content -->
    <div class="p-6" x-data>
        <p class="text-sm text-slate-400 mb-6">
            Pilih tema gradien untuk mengubah tampilan dashboard secara instan.
        </p>

        <!-- Theme Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
            <template x-for="theme in colorThemes" :key="theme.name">
                <button 
                    @click="setTheme(theme)" 
                    class="relative h-24 rounded-2xl border-2 transition-all hover:scale-105 active:scale-95 overflow-hidden group"
                    :class="currentTheme.name === theme.name ? 'border-white ring-2 ring-white/50' : 'border-transparent'"
                    :style="`background: linear-gradient(135deg, ${theme.start} 0%, ${theme.end} 100%)`"
                >
                    <!-- Theme Name -->
                    <div class="absolute bottom-0 left-0 right-0 p-2 bg-black/30 backdrop-blur-sm">
                        <span x-text="theme.name" class="text-[10px] font-bold text-white uppercase tracking-wider"></span>
                    </div>
                    
                    <!-- Check Mark -->
                    <div 
                        x-show="currentTheme.name === theme.name"
                        class="absolute top-2 right-2 w-6 h-6 bg-white rounded-full flex items-center justify-center"
                    >
                        <i class="bi bi-check text-sm text-slate-900"></i>
                    </div>
                </button>
            </template>
        </div>

        <!-- Current Theme Info -->
        <div class="glass-card rounded-2xl p-4 flex items-center justify-between">
            <div class="flex items-center gap-4">
                <div 
                    class="w-10 h-10 rounded-xl"
                    :style="`background: linear-gradient(135deg, ${currentTheme.start}, ${currentTheme.end})`"
                ></div>
                <div>
                    <p class="text-xs text-slate-500 uppercase tracking-wider">Tema Aktif</p>
                    <p class="font-bold" x-text="currentTheme.name"></p>
                </div>
            </div>
            <span class="text-[10px] font-bold bg-green-500/10 text-green-500 px-3 py-1 rounded-full">
                AKTIF
            </span>
        </div>
    </div>
</div>
