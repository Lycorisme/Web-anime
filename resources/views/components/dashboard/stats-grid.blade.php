{{-- Stats Grid Component --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-6 sm:mb-10">
    <template x-for="(stat, index) in stats" :key="index">
        <div 
            class="glass-card p-4 sm:p-6 rounded-2xl sm:rounded-3xl shadow-xl hover:translate-y-[-5px] transition-all group overflow-hidden relative animate-fade-in-up"
            :style="`animation-delay: ${index * 100}ms`"
        >
            <!-- Decorative Circle -->
            <div class="absolute top-0 right-0 w-20 h-20 sm:w-24 sm:h-24 bg-white/5 rounded-full -mr-8 -mt-8 sm:-mr-10 sm:-mt-10 group-hover:scale-150 transition-transform duration-500"></div>
            
            <!-- Header -->
            <div class="flex justify-between items-start mb-3 sm:mb-4">
                <div 
                    :style="`background: linear-gradient(135deg, ${currentTheme.start}, ${currentTheme.end})`" 
                    class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl sm:rounded-2xl flex items-center justify-center text-white text-lg sm:text-xl shadow-lg"
                >
                    <i :class="stat.icon"></i>
                </div>
                <span 
                    class="text-[10px] sm:text-xs font-bold px-2 py-1 rounded"
                    :class="stat.trend.startsWith('+') ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'"
                    x-text="stat.trend"
                ></span>
            </div>
            
            <!-- Content -->
            <p class="text-slate-500 text-[10px] sm:text-xs font-bold uppercase tracking-wider" x-text="stat.label"></p>
            <h3 class="text-2xl sm:text-3xl font-black mt-1" x-text="stat.value"></h3>
        </div>
    </template>
</div>
