    {{-- Header Section --}}
    <div class="relative overflow-hidden rounded-3xl p-8 sm:p-10 group">
        {{-- Dynamic Background Layers --}}
        <div class="absolute inset-0 rounded-3xl transition-colors duration-500"
             :class="darkMode ? 'bg-slate-900 border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30 shadow-xl shadow-slate-200/20'">
        </div>
        
        {{-- Gradient Orbs --}}
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-gradient-to-b from-white/5 to-transparent rounded-full pointer-events-none -translate-y-1/2 translate-x-1/2 transition-opacity duration-500"
             :class="darkMode ? 'opacity-20 blur-[120px]' : 'opacity-10 blur-[150px]'"
             :style="`background-color: ${currentTheme.start}`">
        </div>
        <div class="absolute bottom-0 left-0 w-[300px] h-[300px] bg-gradient-to-t from-white/5 to-transparent rounded-full pointer-events-none translate-y-1/2 -translate-x-1/2 transition-opacity duration-500"
             :class="darkMode ? 'opacity-10 blur-[80px]' : 'opacity-[0.07] blur-[100px]'"
             :style="`background-color: ${currentTheme.end}`">
        </div>

        {{-- Noise Texture & Grid --}}
        <div class="absolute inset-0 mix-blend-soft-light pointer-events-none transition-opacity duration-500" 
             :class="darkMode ? 'opacity-20' : 'opacity-10'"
             style="background-image: url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.65%22 numOctaves=%223%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22 opacity=%221%22/%3E%3C/svg%3E');">
        </div>

        <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            {{-- Text Content --}}
            <div class="space-y-4">
                 <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full backdrop-blur-md transition-colors duration-500"
                      :class="darkMode ? 'bg-white/5 border border-white/10 shadow-lg shadow-black/10' : 'bg-slate-100/80 border border-slate-200/60 shadow-sm shadow-slate-200/30'">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" :style="`background-color: ${currentTheme.start}`"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2" :style="`background-color: ${currentTheme.start}`"></span>
                    </span>
                     <span class="text-[10px] uppercase tracking-widest font-bold transition-colors duration-500"
                           :class="darkMode ? 'text-slate-300' : 'text-slate-500'">{{ __('visual_appearance') }}</span>
                 </div>
                 
                 <div>
                     <h2 class="text-4xl sm:text-5xl font-black tracking-tight leading-[1.1] mb-3 transition-colors duration-500"
                         :class="darkMode ? 'text-white' : 'text-slate-800'">
                        {{ __('color_theme') }}
                     </h2>
                     <p class="text-sm sm:text-base leading-relaxed max-w-md font-medium transition-colors duration-500"
                        :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('choose_stunning_theme') }}
                     </p>
                 </div>
            </div>
            
            {{-- Active Theme Presenter --}}
            <div class="flex justify-start md:justify-end">
                 <div class="relative group/card cursor-default perspective-1000">
                    {{-- Ambient Glow --}}
                    <div class="absolute -inset-4 blur-2xl transition-all duration-700"
                         :class="darkMode ? 'opacity-30 group-hover/card:opacity-50' : 'opacity-15 group-hover/card:opacity-25'"
                         :style="`background: radial-gradient(circle, ${currentTheme.start}, transparent 70%)`">
                    </div>

                    {{-- Glass Card --}}
                    <div class="relative w-[280px] backdrop-blur-xl p-1 rounded-2xl shadow-2xl transition-all duration-500 hover:scale-[1.02] hover:-rotate-1"
                         :class="darkMode ? 'bg-slate-900/60 border border-white/10' : 'bg-white/80 border border-slate-200 shadow-xl shadow-slate-300/30'">
                        <div class="rounded-xl p-5 relative overflow-hidden transition-colors duration-500"
                             :class="darkMode ? 'bg-slate-950/50 border border-white/5' : 'bg-slate-50/80 border border-slate-100'">
                            {{-- Gradient Decoration --}}
                            <div class="absolute top-0 right-0 w-32 h-32 opacity-20 rounded-full blur-2xl pointer-events-none -translate-y-1/2 translate-x-1/2"
                                 :style="`background: ${currentTheme.end}`"></div>

                            <div class="relative z-10">
                                <div class="text-[10px] font-bold uppercase tracking-wider mb-4 flex justify-between items-center transition-colors duration-500"
                                     :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                    <span x-text="'{{ __('active_now') }}'"></span>
                                    <i class="bi bi-check-circle-fill text-emerald-400"></i>
                                </div>
                                
                                <div class="flex items-center gap-4">
                                    <div class="h-14 w-14 rounded-xl shadow-lg relative overflow-hidden group-hover/card:rotate-3 transition-transform duration-500"
                                         :class="darkMode ? 'ring-1 ring-white/10' : 'ring-1 ring-slate-200'">
                                        <div class="absolute inset-0" :style="`background: linear-gradient(135deg, ${currentTheme.start}, ${currentTheme.end})`"></div>
                                        <div class="absolute inset-0 bg-gradient-to-br from-white/40 to-transparent opacity-50"></div>
                                    </div>
                                    
                                    <div>
                                        <div class="text-2xl font-black tracking-tight transition-colors duration-500"
                                             :class="darkMode ? 'text-white' : 'text-slate-800'"
                                             x-text="currentTheme.name"></div>
                                        <div class="text-[10px] font-mono mt-1 transition-colors duration-500"
                                             :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('preset_gradient') }}</div>
                                    </div>
                                </div>

                                {{-- Color DNA Bar --}}
                                <div class="mt-5 pt-4 flex items-center justify-between gap-2 transition-colors duration-500"
                                     :class="darkMode ? 'border-t border-white/5' : 'border-t border-slate-200/60'">
                                     <div class="h-1.5 flex-1 rounded-full overflow-hidden flex transition-colors duration-500"
                                          :class="darkMode ? 'bg-slate-800' : 'bg-slate-200'">
                                         <div class="h-full w-1/2" :style="`background-color: ${currentTheme.start}`"></div>
                                         <div class="h-full w-1/2" :style="`background-color: ${currentTheme.end}`"></div>
                                     </div>
                                     <div class="text-[9px] font-mono transition-colors duration-500"
                                          :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('hex_code') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                 </div>
            </div>
        </div>
    </div>
