@props(['activeTheme' => 'default'])

<div class="rounded-3xl p-8 border transition-all duration-300 relative overflow-hidden group"
     :class="darkMode ? 'bg-[#111827]/40 border-white/5' : 'bg-white border-slate-200 shadow-xl shadow-slate-200/50'">
    
    <div class="absolute top-0 right-0 p-6 opacity-5 pointer-events-none">
        <i class="bi bi-palette text-9xl transform rotate-12" :class="darkMode ? 'text-white' : 'text-slate-900'"></i>
    </div>

    <div class="relative z-10 mb-8">
        <h3 class="text-lg font-bold flex items-center gap-2" :class="darkMode ? 'text-white' : 'text-slate-800'">
            <i class="bi bi-stars text-indigo-500"></i>
            Theme Library
        </h3>
        <p class="text-sm opacity-60" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            Pilih visual style yang paling cocok dengan brand anda.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- Card: Lycoris Cyber (Default) --}}
        <div class="group/card relative cursor-pointer">
            
            {{-- Selection Ring --}}
            <div class="absolute -inset-[2px] rounded-[1.2rem] bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 opacity-100 transition-all duration-300"></div>

            <div class="relative h-64 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col"
                 :class="darkMode ? 'bg-[#0f172a]' : 'bg-slate-50'">
                
                {{-- Preview Area --}}
                <div class="flex-1 relative overflow-hidden bg-[#0f172a] group-hover/card:scale-105 transition-transform duration-700">
                    {{-- Abstract UI Representation --}}
                    <div class="absolute top-4 left-4 right-8 h-2 rounded-full bg-slate-700/50"></div>
                    <div class="absolute top-4 right-4 h-2 w-2 rounded-full bg-indigo-500"></div>
                    
                    <div class="absolute top-10 left-4 w-1/3 h-20 rounded-lg bg-gradient-to-br from-indigo-500/20 to-purple-600/20 border border-indigo-500/30"></div>
                    <div class="absolute top-10 right-4 left-[40%] h-8 rounded-lg bg-slate-800/50"></div>
                    <div class="absolute top-20 right-4 left-[40%] h-8 rounded-lg bg-slate-800/30"></div>
                    <div class="absolute bottom-4 left-4 right-4 h-24 rounded-lg bg-slate-800/20 grid grid-cols-3 gap-2 p-2">
                        <div class="rounded bg-slate-700/30"></div>
                        <div class="rounded bg-slate-700/30"></div>
                        <div class="rounded bg-slate-700/30"></div>
                    </div>

                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0f172a] via-transparent to-transparent"></div>
                </div>

                {{-- Info Area --}}
                <div class="p-4 relative z-10 bg-[#0f172a] border-t border-white/5">
                    <div class="flex items-center justify-between mb-1">
                        <span class="font-bold text-white text-sm">Lycoris Cyber</span>
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold bg-indigo-500 text-white">ACTIVE</span>
                    </div>
                    <p class="text-[10px] text-slate-400">Premium dark interface with glassmorphism.</p>
                </div>
            </div>
        </div>

        {{-- Card: Light Breeze --}}
        <div class="group/card relative cursor-not-allowed opacity-60 hover:opacity-100 transition-opacity">
            <div class="relative h-64 rounded-2xl overflow-hidden border transition-all duration-300 flex flex-col"
                 :class="darkMode ? 'bg-[#111827] border-white/5' : 'bg-white border-slate-200'">
                
                <div class="flex-1 relative bg-slate-50 flex items-center justify-center">
                   <div class="text-slate-400 flex flex-col items-center">
                        <i class="bi bi-brightness-high text-3xl mb-2"></i>
                        <span class="text-xs font-bold uppercase tracking-widest">Coming Soon</span>
                   </div>
                </div>

                <div class="p-4 border-t" :class="darkMode ? 'border-white/5 bg-[#1f2937]' : 'border-slate-100 bg-white'">
                    <div class="flex items-center justify-between mb-1">
                        <span class="font-bold text-sm" :class="darkMode ? 'text-white' : 'text-slate-800'">Light Breeze</span>
                        <i class="bi bi-lock-fill text-xs text-slate-400"></i>
                    </div>
                    <p class="text-[10px]" :class="darkMode ? 'text-slate-500' : 'text-slate-500'">Clean & minimal light theme.</p>
                </div>
            </div>
        </div>

         {{-- Card: Midnight Purple --}}
         <div class="group/card relative cursor-not-allowed opacity-60 hover:opacity-100 transition-opacity">
             <div class="absolute inset-0 bg-purple-500/5 blur-xl rounded-2xl"></div>
            <div class="relative h-64 rounded-2xl overflow-hidden border transition-all duration-300 flex flex-col"
                 :class="darkMode ? 'bg-[#0f0720] border-white/5' : 'bg-[#1a0b2e] border-slate-800'">
                
                <div class="flex-1 relative flex items-center justify-center">
                   <div class="text-purple-400/50 flex flex-col items-center">
                        <i class="bi bi-moon-stars text-3xl mb-2"></i>
                        <span class="text-xs font-bold uppercase tracking-widest">Coming Soon</span>
                   </div>
                </div>

                <div class="p-4 border-t border-white/5 bg-white/5">
                    <div class="flex items-center justify-between mb-1">
                        <span class="font-bold text-white text-sm">Midnight Purple</span>
                        <i class="bi bi-lock-fill text-xs text-slate-500"></i>
                    </div>
                    <p class="text-[10px] text-slate-500">Deep purple aesthetic optimized for night.</p>
                </div>
            </div>
        </div>

        {{-- Card: Custom (Pro) --}}
        <div class="group/card relative cursor-not-allowed border-2 border-dashed rounded-2xl flex flex-col items-center justify-center text-center p-6 transition-all"
             :class="darkMode ? 'border-white/10 hover:border-white/20 bg-white/5' : 'border-slate-300 hover:border-slate-400 bg-slate-50'">
            <div class="w-12 h-12 rounded-full mb-4 flex items-center justify-center" :class="darkMode ? 'bg-white/10' : 'bg-slate-200'">
                <i class="bi bi-plus-lg text-lg opacity-50"></i>
            </div>
            <div class="font-bold text-sm" :class="darkMode ? 'text-white' : 'text-slate-800'">Custom Theme</div>
            <p class="text-[10px] mt-1 mb-3 opacity-60" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                Create your own color palette
            </p>
            <span class="px-2 py-1 rounded text-[10px] font-bold bg-gradient-to-r from-amber-500 to-orange-500 text-white">
                PRO FEATURE
            </span>
        </div>

    </div>
</div>
