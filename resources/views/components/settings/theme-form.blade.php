<div class="space-y-6 sm:space-y-8">
    {{-- Header Section --}}
    {{-- Header Section --}}
    <div class="relative overflow-hidden rounded-3xl p-8 sm:p-10 group">
        {{-- Dynamic Background Layers --}}
        <div class="absolute inset-0 bg-slate-900 border border-white/10 rounded-3xl"></div>
        
        {{-- Gradient Orbs --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-b from-white/5 to-transparent opacity-20 blur-[120px] rounded-full pointer-events-none -translate-y-1/2 translate-x-1/2"
             :style="`background-color: ${currentTheme.start}`">
        </div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-gradient-to-t from-white/5 to-transparent opacity-10 blur-[80px] rounded-full pointer-events-none translate-y-1/2 -translate-x-1/2"
             :style="`background-color: ${currentTheme.end}`">
        </div>

        {{-- Noise Texture & Grid --}}
        <div class="absolute inset-0 opacity-20 mix-blend-soft-light pointer-events-none" 
             style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22 opacity=%221%22/%3E%3C/svg%3E');">
        </div>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            {{-- Text Content --}}
            <div class="space-y-4">
                 <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/5 border border-white/10 backdrop-blur-md shadow-lg shadow-black/10">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" :style="`background-color: ${currentTheme.start}`"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2" :style="`background-color: ${currentTheme.start}`"></span>
                    </span>
                    <span class="text-[10px] uppercase tracking-widest text-slate-300 font-bold">Tampilan Visual</span>
                 </div>
                 
                 <div>
                     <h2 class="text-4xl sm:text-5xl font-black text-white tracking-tight leading-[1.1] mb-3">
                        Tema <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-white/40">Warna</span>
                     </h2>
                     <p class="text-sm sm:text-base text-slate-400 leading-relaxed max-w-md font-medium">
                        Pilih identitas visual yang memukau. Tema ini akan diterapkan secara global termasuk pada elemen interaktif.
                     </p>
                 </div>
            </div>
            
            {{-- Active Theme Presenter --}}
            <div class="flex justify-start md:justify-end">
                 <div class="relative group/card cursor-default perspective-1000">
                    {{-- Ambient Glow --}}
                    <div class="absolute -inset-4 opacity-30 group-hover/card:opacity-50 blur-2xl transition-all duration-700"
                         :style="`background: radial-gradient(circle, ${currentTheme.start}, transparent 70%)`">
                    </div>

                    {{-- Glass Card --}}
                    <div class="relative w-[280px] bg-slate-900/60 backdrop-blur-xl border border-white/10 p-1 rounded-2xl shadow-2xl transition-transform duration-500 hover:scale-[1.02] hover:-rotate-1">
                        <div class="bg-slate-950/50 rounded-xl p-5 border border-white/5 relative overflow-hidden">
                            {{-- Gradient Decoration --}}
                            <div class="absolute top-0 right-0 w-32 h-32 opacity-20 rounded-full blur-2xl pointer-events-none -translate-y-1/2 translate-x-1/2"
                                 :style="`background: ${currentTheme.end}`"></div>

                            <div class="relative z-10">
                                <div class="text-[10px] text-slate-400 font-bold uppercase tracking-wider mb-4 flex justify-between items-center">
                                    <span>Sedang Aktif</span>
                                    <i class="bi bi-check-circle-fill text-emerald-400"></i>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    <div class="h-14 w-14 rounded-xl shadow-lg ring-1 ring-white/10 relative overflow-hidden group-hover/card:rotate-3 transition-transform duration-500">
                                        <div class="absolute inset-0" :style="`background: linear-gradient(135deg, ${currentTheme.start}, ${currentTheme.end})`"></div>
                                        <div class="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent opacity-50"></div>
                                    </div>
                                    
                                    <div>
                                        <div class="text-2xl font-black text-white tracking-tight" x-text="currentTheme.name"></div>
                                        <div class="text-[10px] text-slate-500 font-mono mt-1">Preset Gradient</div>
                                    </div>
                                </div>

                                {{-- Color DNA Bar --}}
                                <div class="mt-5 pt-4 border-t border-white/5 flex items-center justify-between gap-2">
                                     <div class="h-1.5 flex-1 rounded-full bg-slate-800 overflow-hidden flex">
                                         <div class="h-full w-1/2" :style="`background-color: ${currentTheme.start}`"></div>
                                         <div class="h-full w-1/2" :style="`background-color: ${currentTheme.end}`"></div>
                                     </div>
                                     <div class="text-[9px] text-slate-500 font-mono">HEX</div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
        {{-- Left Column: Live Visualizer --}}
        <div class="lg:col-span-5 space-y-4">
             <div class="flex items-center justify-between px-1">
                 <h3 class="text-xs sm:text-sm font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <i class="bi bi-eye-fill"></i> Live Preview
                 </h3>
                 <span class="text-[10px] bg-white/10 text-white px-2 py-1 rounded-md">Realtime</span>
             </div>

             <div class="relative w-full aspect-[4/3] lg:aspect-square xl:aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl border border-white/10 group bg-slate-900/50">
                 {{-- Dynamic Background Gradient --}}
                 <div class="absolute inset-0 transition-all duration-700 ease-out" 
                      :style="`background: linear-gradient(135deg, ${currentTheme.start}, ${currentTheme.end})`">
                 </div>
                 
                 {{-- Noise Texture --}}
                 <div class="absolute inset-0 opacity-20" 
                      style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22 opacity=%221%22/%3E%3C/svg%3E'); mix-blend-mode: overlay;">
                 </div>

                 {{-- Glass Mockup UI --}}
                 <div class="absolute inset-6 sm:inset-8 bg-black/10 backdrop-blur-xl rounded-2xl border border-white/20 p-4 sm:p-5 flex flex-col gap-4 shadow-2xl">
                      {{-- Mock Header --}}
                      <div class="h-10 w-full flex items-center justify-between border-b border-white/10 pb-3">
                           <div class="h-2.5 w-24 bg-white/60 rounded-full"></div>
                           <div class="flex gap-2">
                                <div class="h-2 w-2 rounded-full bg-white/40"></div>
                                <div class="h-2 w-2 rounded-full bg-white/40"></div>
                           </div>
                      </div>
                      
                      {{-- Mock Content Body --}}
                      <div class="flex-1 flex gap-4 overflow-hidden">
                           {{-- Sidebar --}}
                           <div class="w-12 h-full bg-white/10 rounded-xl hidden sm:flex flex-col gap-2 p-2">
                                <div class="w-full aspect-square rounded-lg bg-white/20"></div>
                                <div class="w-full aspect-square rounded-lg bg-white/10"></div>
                                <div class="w-full aspect-square rounded-lg bg-white/10"></div>
                           </div>
                           
                           {{-- Main Area --}}
                           <div class="flex-1 flex flex-col gap-3">
                                {{-- Hero Card --}}
                                <div class="h-28 w-full rounded-xl relative overflow-hidden p-3 flex flex-col justify-end">
                                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-white/5"></div>
                                    <div class="relative z-10 w-2/3 h-2 bg-white/80 rounded mb-2"></div>
                                    <div class="relative z-10 w-1/2 h-2 bg-white/40 rounded"></div>
                                </div>
                                
                                {{-- Grid Items --}}
                                <div class="flex-1 grid grid-cols-2 gap-3">
                                     <div class="bg-white/10 rounded-xl relative overflow-hidden group/item">
                                        <div class="absolute inset-0 bg-white/0 group-hover/item:bg-white/10 transition-colors"></div>
                                     </div>
                                     <div class="bg-white/10 rounded-xl"></div>
                                </div>
                           </div>
                      </div>
                 </div>

                 {{-- Theme Name Tag --}}
                 <div class="absolute bottom-6 right-6 px-4 py-2 rounded-xl bg-slate-900/80 backdrop-blur-md border border-white/10 text-white font-bold text-xs sm:text-sm shadow-xl transform translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none">
                     <span class="text-slate-400 font-normal mr-1">Previewing:</span>
                     <span x-text="currentTheme.name"></span>
                 </div>
             </div>
        </div>

        {{-- Right Column: Selector Grid --}}
        <div class="lg:col-span-7 space-y-4">
             <div class="flex items-center justify-between px-1">
                 <h3 class="text-xs sm:text-sm font-bold text-slate-400 uppercase tracking-wider flex items-center gap-2">
                    <i class="bi bi-grid-fill"></i> Pilihan Warna
                 </h3>
                 <span class="text-xs text-slate-500" x-text="`${colorThemes.length} presets available`"></span>
             </div>

             <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 max-h-[530px] sm:max-h-[384px] overflow-y-auto p-2">
                 <template x-for="theme in colorThemes" :key="theme.name">
                     <button 
                        @click="setTheme(theme)"
                        class="group relative h-24 sm:h-28 rounded-2xl overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl hover:shadow-black/20 focus:outline-none"
                        :class="currentTheme.name === theme.name ? 'ring-2 ring-white ring-offset-2 ring-offset-[#0f172a]' : 'ring-1 ring-white/5 hover:ring-white/20'"
                     >
                        {{-- Gradient Background --}}
                        <div class="absolute inset-0 transition-transform duration-700 group-hover:scale-110" 
                             :style="`background: linear-gradient(135deg, ${theme.start}, ${theme.end})`">
                        </div>
                        
                        {{-- Shine Effect --}}
                        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/20 to-transparent skew-x-12"></div>

                        {{-- Active Indicator --}}
                        <div x-show="currentTheme.name === theme.name" 
                             class="absolute top-2 right-2 bg-white text-slate-900 text-[10px] sm:text-xs h-6 w-6 rounded-full flex items-center justify-center shadow-lg transform"
                             x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-300"
                             x-transition:enter-start="scale-0 rotate-90"
                             x-transition:enter-end="scale-100 rotate-0">
                             <i class="bi bi-check-lg font-bold"></i>
                        </div>

                        {{-- Label --}}
                        <div class="absolute bottom-0 inset-x-0 p-3 bg-gradient-to-t from-black/90 via-black/40 to-transparent flex flex-col justify-end h-full">
                            <span class="text-[10px] text-white/60 font-medium uppercase tracking-wider opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-1 group-hover:translate-y-0" x-text="currentTheme.name === theme.name ? 'Dipilih' : 'Pilih'"></span>
                            <div class="text-white text-xs sm:text-sm font-bold text-left leading-tight" x-text="theme.name"></div>
                        </div>
                     </button>
                 </template>
             </div>
        </div>
    </div>
</div>
