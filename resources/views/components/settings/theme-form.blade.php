<div class="space-y-6 sm:space-y-8">
    {{-- Header Section --}}
    <div class="relative overflow-hidden rounded-3xl p-8 sm:p-10 group">
        {{-- Dynamic Background Layers --}}
        <div class="absolute inset-0 rounded-3xl transition-colors duration-500"
             :class="darkMode ? 'bg-slate-900 border border-white/10' : 'bg-white border border-slate-200 shadow-xl shadow-slate-200/50'">
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

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 sm:gap-8">
        {{-- Left Column: Live Visualizer --}}
        <div class="lg:col-span-5 space-y-4">
             <div class="flex items-center justify-between px-1">
                 <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider flex items-center gap-2 transition-colors duration-500"
                     :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    <i class="bi bi-eye-fill"></i> {{ __('live_preview') }}
                 </h3>
                 <span class="text-[10px] px-2 py-1 rounded-md transition-colors duration-500"
                       :class="darkMode ? 'bg-white/10 text-white' : 'bg-slate-100 text-slate-600 border border-slate-200'">{{ __('realtime') }}</span>
             </div>

             <div class="relative w-full aspect-[4/3] lg:aspect-square xl:aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl group transition-colors duration-500"
                  :class="darkMode ? 'border border-white/10 bg-slate-900/50' : 'border border-slate-200 bg-slate-100/50 shadow-xl shadow-slate-300/30'">
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
                 <div class="absolute bottom-6 right-6 px-4 py-2 rounded-xl backdrop-blur-md text-white font-bold text-xs sm:text-sm shadow-xl transform translate-y-2 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300 pointer-events-none"
                      :class="darkMode ? 'bg-slate-900/80 border border-white/10' : 'bg-slate-800/90 border border-slate-700/30'">
                     <span class="text-slate-400 font-normal mr-1" x-text="'{{ __('previewing') }}'"></span>:
                     <span x-text="currentTheme.name"></span>
                 </div>
             </div>
        </div>

        {{-- Right Column: Selector Grid --}}
        <div class="lg:col-span-7 space-y-4">
             <div class="flex items-center justify-between px-1">
                 <h3 class="text-xs sm:text-sm font-bold uppercase tracking-wider flex items-center gap-2 transition-colors duration-500"
                     :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    <i class="bi bi-grid-fill"></i> {{ __('color_options') }}
                 </h3>
                 <span class="text-xs transition-colors duration-500"
                       :class="darkMode ? 'text-slate-500' : 'text-slate-400'"
                       x-text="`${colorThemes.length} {{ __('presets_available') }}`"></span>
             </div>

             <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 sm:gap-4 max-h-[530px] sm:max-h-[384px] overflow-y-auto p-2">
                 <template x-for="theme in colorThemes" :key="theme.name">
                     <button 
                        @click="setTheme(theme)"
                        class="group relative h-24 sm:h-28 rounded-2xl overflow-hidden transition-all duration-300 hover:scale-[1.02] hover:shadow-xl focus:outline-none"
                        :class="currentTheme.name === theme.name 
                            ? (darkMode ? 'ring-2 ring-white ring-offset-2 ring-offset-[#0f172a]' : 'ring-2 ring-slate-800 ring-offset-2 ring-offset-white shadow-lg') 
                            : (darkMode ? 'ring-1 ring-white/5 hover:ring-white/20 hover:shadow-black/20' : 'ring-1 ring-slate-200 hover:ring-slate-300 hover:shadow-slate-300/40')"
                     >
                        {{-- Gradient Background --}}
                        <div class="absolute inset-0 transition-transform duration-700 group-hover:scale-110" 
                             :style="`background: linear-gradient(135deg, ${theme.start}, ${theme.end})`">
                        </div>
                        
                        {{-- Shine Effect --}}
                        <div class="absolute inset-0 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 bg-gradient-to-r from-transparent via-white/20 to-transparent skew-x-12"></div>

                        {{-- Active Indicator --}}
                        <div x-show="currentTheme.name === theme.name" 
                             class="absolute top-2 right-2 text-[10px] sm:text-xs h-6 w-6 rounded-full flex items-center justify-center shadow-lg transform"
                             :class="darkMode ? 'bg-white text-slate-900' : 'bg-white text-slate-800 ring-1 ring-slate-200'"
                             x-transition:enter="transition cubic-bezier(0.34, 1.56, 0.64, 1) duration-300"
                             x-transition:enter-start="scale-0 rotate-90"
                             x-transition:enter-end="scale-100 rotate-0">
                             <i class="bi bi-check-lg font-bold"></i>
                        </div>

                        {{-- Label --}}
                        <div class="absolute bottom-0 inset-x-0 p-3 bg-gradient-to-t from-black/90 via-black/40 to-transparent flex flex-col justify-end h-full">
                            <span class="text-[10px] text-white/60 font-medium uppercase tracking-wider opacity-0 group-hover:opacity-100 transition-opacity transform translate-y-1 group-hover:translate-y-0" x-text="currentTheme.name === theme.name ? '{{ __('selected') }}' : '{{ __('select') }}'"></span>
                            <div class="text-white text-xs sm:text-sm font-bold text-left leading-tight" x-text="theme.name"></div>
                        </div>
                     </button>
                 </template>
             </div>
        </div>
    </div>

</div>
