{{-- Watch Progress Chart Component --}}
<div class="glass-panel rounded-[2rem] lg:rounded-[2.5rem] p-6 lg:p-8 animate__animated animate__fadeInLeft">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
        <div>
            <h3 class="text-lg lg:text-xl font-bold text-white flex items-center gap-2">
                <i class="bi bi-graph-up-arrow text-indigo-400"></i>
                Watch Activity
            </h3>
            <p class="text-sm text-slate-500 mt-1">Episodes watched this week</p>
        </div>
        <select class="bg-white/5 border border-white/10 rounded-xl px-4 py-2.5 text-xs font-bold text-slate-300 outline-none focus:border-indigo-500/50 transition-colors cursor-pointer">
            <option value="7">Last 7 Days</option>
            <option value="30">Last 30 Days</option>
            <option value="90">Last 3 Months</option>
        </select>
    </div>
    
    {{-- Chart --}}
    <div class="h-56 lg:h-64 w-full flex items-end gap-2 lg:gap-3 px-2" x-data="{ 
        bars: [
            { day: 'Mon', value: 40, eps: 4 },
            { day: 'Tue', value: 70, eps: 7 },
            { day: 'Wed', value: 45, eps: 5 },
            { day: 'Thu', value: 90, eps: 9 },
            { day: 'Fri', value: 65, eps: 6 },
            { day: 'Sat', value: 85, eps: 8 },
            { day: 'Sun', value: 55, eps: 5 }
        ]
    }">
        <template x-for="(bar, index) in bars" :key="index">
            <div class="flex-1 flex flex-col items-center gap-2">
                {{-- Tooltip --}}
                <div class="opacity-0 group-hover:opacity-100 transition-opacity text-xs text-white font-bold bg-slate-800 px-2 py-1 rounded-lg"
                     x-text="bar.eps + ' eps'"></div>
                
                {{-- Bar --}}
                <div class="w-full chart-bar relative group cursor-pointer"
                     :style="{ height: bar.value + '%' }">
                    <div class="absolute inset-0 bg-gradient-to-t from-indigo-600/30 via-indigo-500 to-cyan-400 rounded-t-xl group-hover:from-indigo-500/50 group-hover:to-purple-400 transition-all duration-300"></div>
                    
                    {{-- Glow on hover --}}
                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity rounded-t-xl"
                         style="box-shadow: 0 0 20px rgba(99, 102, 241, 0.4)"></div>
                    
                    {{-- Tooltip on hover --}}
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 opacity-0 group-hover:opacity-100 transition-all duration-300 transform group-hover:-translate-y-1 z-10">
                        <div class="bg-slate-800 text-white text-xs font-bold px-3 py-1.5 rounded-lg whitespace-nowrap shadow-xl border border-white/10">
                            <span x-text="bar.eps"></span> episodes
                            <div class="absolute bottom-0 left-1/2 -translate-x-1/2 translate-y-1/2 rotate-45 w-2 h-2 bg-slate-800 border-r border-b border-white/10"></div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
    
    {{-- Day Labels --}}
    <div class="flex justify-between mt-4 px-2">
        <template x-for="day in ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun']" :key="day">
            <span class="text-[10px] lg:text-xs font-black text-slate-600 uppercase tracking-tighter flex-1 text-center" x-text="day"></span>
        </template>
    </div>
    
    {{-- Summary --}}
    <div class="flex items-center justify-between mt-6 pt-6 border-t border-white/5">
        <div class="flex items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-gradient-to-r from-indigo-500 to-cyan-400"></div>
                <span class="text-xs text-slate-400">This Week</span>
            </div>
            <div class="flex items-center gap-2">
                <div class="w-3 h-3 rounded-full bg-slate-700"></div>
                <span class="text-xs text-slate-500">Last Week</span>
            </div>
        </div>
        <div class="text-right">
            <span class="text-2xl font-black text-white">44</span>
            <span class="text-xs text-slate-500 ml-1">episodes</span>
        </div>
    </div>
</div>
