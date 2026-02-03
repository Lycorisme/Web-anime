{{-- Theme Settings Form - Premium Design with Alpine.js --}}
@props(['themePresets' => [], 'activeTheme' => 'lycoris_cyber'])

<div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-200">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-orange-500/10 to-red-500/10 px-6 py-5 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/20">
                <i class="bi bi-brush-fill text-xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-lg">Tema Warna</h3>
                <p class="text-xs text-slate-400">Pilih gradien untuk seluruh website</p>
            </div>
        </div>
    </div>

    {{-- Form Content - Menggunakan Alpine.js dari parent (appState) --}}
    <div class="p-6">
        {{-- Current Theme Preview --}}
        <div class="glass-card rounded-2xl p-5 mb-6">
            <div class="flex flex-col sm:flex-row items-center gap-5">
                {{-- Theme Preview Box --}}
                <div 
                    class="w-full sm:w-32 h-24 rounded-xl shadow-xl transition-all duration-500"
                    :style="`background: linear-gradient(135deg, ${currentTheme.start}, ${currentTheme.end})`"
                ></div>
                
                {{-- Theme Info --}}
                <div class="flex-1 text-center sm:text-left">
                    <div class="flex items-center justify-center sm:justify-start gap-2 mb-2">
                        <span class="px-2.5 py-1 rounded-full bg-green-500/10 text-green-400 text-[10px] font-bold uppercase tracking-wider flex items-center gap-1">
                            <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                            Aktif
                        </span>
                    </div>
                    <p class="text-2xl font-extrabold" x-text="currentTheme.name"></p>
                    <p class="text-xs text-slate-400 mt-1">Tema yang sedang digunakan</p>
                </div>
            </div>
        </div>

        {{-- Theme Label --}}
        <div class="flex items-center gap-2 mb-4">
            <i class="bi bi-grid-3x3-gap-fill text-orange-400"></i>
            <span class="text-sm font-bold text-slate-400">Pilih Tema</span>
        </div>

        {{-- Theme Grid - Menggunakan colorThemes dari Alpine.js --}}
        <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
            <template x-for="theme in colorThemes" :key="theme.name">
                <button 
                    @click="setTheme(theme)"
                    class="relative group rounded-2xl overflow-hidden transition-all duration-300 hover:scale-105 active:scale-95 focus:outline-none"
                    :class="currentTheme.name === theme.name ? 'ring-4 ring-white/50 ring-offset-2 ring-offset-slate-900' : ''"
                >
                    {{-- Gradient Background --}}
                    <div 
                        class="h-24 w-full"
                        :style="`background: linear-gradient(135deg, ${theme.start} 0%, ${theme.end} 100%)`"
                    ></div>
                    
                    {{-- Theme Name Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent flex items-end p-3">
                        <span x-text="theme.name" class="text-xs font-bold text-white uppercase tracking-wider"></span>
                    </div>
                    
                    {{-- Selected Indicator --}}
                    <div 
                        x-show="currentTheme.name === theme.name"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="scale-0 opacity-0"
                        x-transition:enter-end="scale-100 opacity-100"
                        class="absolute top-3 right-3 w-7 h-7 bg-white rounded-full flex items-center justify-center shadow-lg"
                    >
                        <i class="bi bi-check-lg text-slate-900 font-bold"></i>
                    </div>
                    
                    {{-- Hover Effect --}}
                    <div class="absolute inset-0 border-4 border-white/0 group-hover:border-white/30 rounded-2xl transition-all duration-300"></div>
                </button>
            </template>
        </div>

        {{-- Pro Tips --}}
        <div class="mt-6 p-4 rounded-xl bg-gradient-to-r from-orange-500/5 to-red-500/5 border border-orange-500/10">
            <div class="flex items-start gap-3">
                <i class="bi bi-stars text-orange-400 mt-0.5"></i>
                <p class="text-xs text-slate-400">
                    <span class="font-bold text-orange-400">Tip:</span> 
                    Klik tema untuk mengubah warna gradien secara instan. Perubahan akan tersimpan otomatis.
                </p>
            </div>
        </div>
    </div>
</div>
