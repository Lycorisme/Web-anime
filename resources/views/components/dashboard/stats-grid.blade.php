{{-- Ultra Premium Stats Grid --}}
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6 mb-8" 
     x-data="{ stats: [
        { label: 'Watching', value: '12', unit: 'Series', trend: '+2', trendUp: true, icon: 'bi-play-circle-fill', color: 'indigo', bgFrom: 'from-indigo-500', bgTo: 'to-indigo-600' },
        { label: 'Completed', value: '145', unit: 'Series', trend: '+8', trendUp: true, icon: 'bi-check-circle-fill', color: 'purple', bgFrom: 'from-purple-500', bgTo: 'to-purple-600' },
        { label: 'Watch Time', value: '1.2K', unit: 'Hours', trend: '+24h', trendUp: true, icon: 'bi-clock-history', color: 'cyan', bgFrom: 'from-cyan-500', bgTo: 'to-cyan-600' },
        { label: 'Achievements', value: '24', unit: 'Badges', trend: '+3', trendUp: true, icon: 'bi-award-fill', color: 'amber', bgFrom: 'from-amber-500', bgTo: 'to-amber-600' }
     ]}">
    
    <template x-for="(stat, index) in stats" :key="index">
        <div class="glass-panel p-5 lg:p-6 rounded-[1.5rem] lg:rounded-[2rem] card-hover relative group overflow-hidden border border-white/5 hover:border-indigo-500/20 animate-fade-in-up"
             :class="'stagger-' + (index + 1)"
             :style="{ animationDelay: (index * 0.1) + 's' }">
            
            {{-- Background Icon --}}
            <div class="absolute -top-4 -right-4 opacity-5 group-hover:opacity-10 transition-opacity duration-500">
                <i :class="stat.icon" class="text-[5rem] lg:text-[6rem] text-white"></i>
            </div>
            
            {{-- Hover Glow --}}
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity duration-500 rounded-[2rem]"
                 :class="'bg-gradient-to-br ' + stat.bgFrom + '/5 ' + stat.bgTo + '/10'"></div>
            
            {{-- Content --}}
            <div class="relative z-10">
                {{-- Header --}}
                <div class="flex items-center justify-between mb-4">
                    <div class="w-12 h-12 rounded-2xl flex items-center justify-center text-white shadow-lg transition-all duration-300 group-hover:scale-110 group-hover:rotate-3"
                         :class="'bg-gradient-to-br ' + stat.bgFrom + ' ' + stat.bgTo + ' shadow-' + stat.color + '-500/30'">
                        <i :class="stat.icon" class="text-xl"></i>
                    </div>
                    
                    {{-- Trend Badge --}}
                    <span class="text-[10px] font-bold px-2 py-1 rounded-lg flex items-center gap-1"
                          :class="stat.trendUp ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400'">
                        <i :class="stat.trendUp ? 'bi-arrow-up-right' : 'bi-arrow-down-right'" class="text-[8px]"></i>
                        <span x-text="stat.trend"></span>
                    </span>
                </div>
                
                {{-- Label --}}
                <h3 class="text-slate-500 text-xs font-bold uppercase tracking-widest mb-1" x-text="stat.label"></h3>
                
                {{-- Value --}}
                <div class="flex items-baseline gap-2">
                    <span class="text-3xl lg:text-4xl font-black text-white tracking-tight" x-text="stat.value"></span>
                    <span class="text-[10px] lg:text-xs text-slate-500 font-bold uppercase" x-text="stat.unit"></span>
                </div>
                
                {{-- Progress Bar --}}
                <div class="mt-4 h-1 bg-white/5 rounded-full overflow-hidden">
                    <div class="h-full rounded-full transition-all duration-1000 ease-out"
                         :class="'bg-gradient-to-r ' + stat.bgFrom + ' ' + stat.bgTo"
                         :style="{ width: (30 + Math.random() * 60) + '%' }"></div>
                </div>
            </div>
        </div>
    </template>
</div>
