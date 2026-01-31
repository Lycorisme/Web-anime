<div class="flex w-full">
    {{-- Sidebar --}}
    <x-dashboard.sidebar />

    {{-- Main Content --}}
    <main :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-24'" 
          class="flex-1 w-full p-4 lg:p-8 transition-all duration-500 ease-out">
        
        {{-- Header with animation --}}
        <div x-show="true"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
            <x-dashboard.header />
        </div>

        {{-- Welcome Card with animation --}}
        <div x-show="true"
             x-transition:enter="transition ease-out duration-600 delay-100"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
            <x-dashboard.welcome-card />
        </div>

        {{-- Stats Grid with staggered animation --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <template x-for="(stat, index) in stats" :key="index">
                <div x-show="true"
                     x-transition:enter="transition ease-out duration-500"
                     x-transition:enter-start="opacity-0 translate-y-8 scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                     :style="`transition-delay: ${index * 100 + 200}ms`"
                     class="glass-card p-6 rounded-3xl shadow-xl hover:-translate-y-2 hover:shadow-2xl transition-all duration-300 group overflow-hidden relative cursor-pointer"
                     :class="darkMode ? 'hover:border-white/20' : 'hover:border-blue-200'">
                    
                    {{-- Decorative background --}}
                    <div class="absolute top-0 right-0 w-32 h-32 rounded-full -mr-16 -mt-16 transition-transform duration-500 group-hover:scale-150"
                         :class="stat.bgIcon.replace('bg-', 'bg-') + '/10'"></div>
                    
                    {{-- Icon and Trend --}}
                    <div class="flex justify-between items-start mb-4 relative z-10">
                        <div :class="stat.bgIcon" 
                             class="w-14 h-14 rounded-2xl flex items-center justify-center text-white text-2xl shadow-lg transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-3">
                            <i :class="stat.icon"></i>
                        </div>
                        <span class="text-[11px] font-bold px-2.5 py-1 rounded-lg transition-all duration-300"
                              :class="stat.trend.startsWith('+') 
                                  ? 'bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 group-hover:bg-emerald-500/20' 
                                  : 'bg-rose-500/10 text-rose-600 dark:text-rose-400 group-hover:bg-rose-500/20'"
                              x-text="stat.trend"></span>
                    </div>
                    
                    {{-- Label and Value --}}
                    <p class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider mb-1" x-text="stat.label"></p>
                    <h3 class="text-3xl font-black text-slate-800 dark:text-white transition-colors" x-text="stat.value"></h3>
                </div>
            </template>
        </div>

        {{-- Main Content Table with animation --}}
        <div x-show="true"
             x-transition:enter="transition ease-out duration-700"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="glass-card rounded-3xl overflow-hidden shadow-2xl"
             :class="darkMode ? '' : 'shadow-slate-200/50'">
            
            {{-- Table Header Controls --}}
            <div class="px-6 py-5 border-b flex items-center justify-between"
                 :class="darkMode ? 'bg-white/5 border-white/10' : 'bg-slate-50/80 border-slate-200'">
                <div class="flex items-center gap-4">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-rose-500 hover:scale-125 transition-transform cursor-pointer"></div>
                        <div class="w-3 h-3 rounded-full bg-amber-500 hover:scale-125 transition-transform cursor-pointer"></div>
                        <div class="w-3 h-3 rounded-full bg-emerald-500 hover:scale-125 transition-transform cursor-pointer"></div>
                    </div>
                    <span class="text-xs font-bold uppercase tracking-widest ml-2"
                          :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        Manajemen Konten Utama
                    </span>
                </div>
                <div class="flex gap-2">
                    <button class="p-2.5 rounded-xl transition-all duration-300 hover:scale-110"
                            :class="darkMode ? 'text-slate-400 hover:bg-white/10 hover:text-blue-400' : 'text-slate-500 hover:bg-slate-100 hover:text-blue-500'">
                        <i class="bi bi-search"></i>
                    </button>
                    <button class="p-2.5 rounded-xl transition-all duration-300 hover:scale-110"
                            :class="darkMode ? 'text-slate-400 hover:bg-white/10 hover:text-blue-400' : 'text-slate-500 hover:bg-slate-100 hover:text-blue-500'">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>
            </div>

            {{-- Table Content --}}
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-3">
                    <thead class="text-[10px] font-bold uppercase tracking-widest"
                           :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                        <tr>
                            <th class="px-6 pb-2">Informasi Item</th>
                            <th class="px-6 pb-2">Status</th>
                            <th class="px-6 pb-2">Progress</th>
                            <th class="px-6 pb-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Row 1 --}}
                        <tr x-show="true"
                            x-transition:enter="transition ease-out duration-500 delay-300"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            class="glass-card hover:scale-[1.01] transition-all duration-300 group cursor-pointer"
                            :class="darkMode ? 'hover:bg-white/5' : 'hover:bg-blue-50/50'">
                            <td class="p-4 rounded-l-2xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 btn-premium rounded-xl flex items-center justify-center text-white shadow-lg transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="bi bi-file-earmark-text text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm transition-colors duration-300"
                                           :class="darkMode ? 'text-slate-200 group-hover:text-blue-400' : 'text-slate-700 group-hover:text-blue-600'">
                                            Laporan Penjualan Q1
                                        </p>
                                        <p class="text-[11px] text-slate-500 mt-1">Update: 2 jam yang lalu</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1.5 bg-blue-500/10 text-blue-600 dark:text-blue-400 rounded-full text-[10px] font-bold uppercase">
                                    Verified
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="w-40">
                                    <div class="flex justify-between text-[10px] font-bold mb-2"
                                         :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                        <span>Progress</span>
                                        <span class="text-blue-500">75%</span>
                                    </div>
                                    <div class="w-full h-2 rounded-full overflow-hidden"
                                         :class="darkMode ? 'bg-slate-700' : 'bg-slate-200'">
                                        <div class="h-full btn-premium rounded-full transition-all duration-1000 ease-out" 
                                             style="width: 75%"
                                             x-init="$el.style.width = '0%'; setTimeout(() => $el.style.width = '75%', 500)"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 rounded-r-2xl text-center">
                                <button class="p-2.5 rounded-xl text-blue-500 transition-all duration-300 hover:scale-125"
                                        :class="darkMode ? 'hover:bg-blue-500/20' : 'hover:bg-blue-100'">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="p-2.5 rounded-xl text-rose-500 transition-all duration-300 hover:scale-125"
                                        :class="darkMode ? 'hover:bg-rose-500/20' : 'hover:bg-rose-100'">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                        
                        {{-- Row 2 --}}
                        <tr x-show="true"
                            x-transition:enter="transition ease-out duration-500 delay-400"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            class="glass-card hover:scale-[1.01] transition-all duration-300 group cursor-pointer"
                            :class="darkMode ? 'hover:bg-white/5' : 'hover:bg-emerald-50/50'">
                            <td class="p-4 rounded-l-2xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center text-white shadow-lg transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="bi bi-bar-chart-line text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm transition-colors duration-300"
                                           :class="darkMode ? 'text-slate-200 group-hover:text-emerald-400' : 'text-slate-700 group-hover:text-emerald-600'">
                                            Analisis Data Marketing
                                        </p>
                                        <p class="text-[11px] text-slate-500 mt-1">Update: 5 jam yang lalu</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1.5 bg-amber-500/10 text-amber-600 dark:text-amber-400 rounded-full text-[10px] font-bold uppercase">
                                    Pending
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="w-40">
                                    <div class="flex justify-between text-[10px] font-bold mb-2"
                                         :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                        <span>Progress</span>
                                        <span class="text-emerald-500">45%</span>
                                    </div>
                                    <div class="w-full h-2 rounded-full overflow-hidden"
                                         :class="darkMode ? 'bg-slate-700' : 'bg-slate-200'">
                                        <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full transition-all duration-1000 ease-out" 
                                             style="width: 45%"
                                             x-init="$el.style.width = '0%'; setTimeout(() => $el.style.width = '45%', 600)"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 rounded-r-2xl text-center">
                                <button class="p-2.5 rounded-xl text-blue-500 transition-all duration-300 hover:scale-125"
                                        :class="darkMode ? 'hover:bg-blue-500/20' : 'hover:bg-blue-100'">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="p-2.5 rounded-xl text-rose-500 transition-all duration-300 hover:scale-125"
                                        :class="darkMode ? 'hover:bg-rose-500/20' : 'hover:bg-rose-100'">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>

                        {{-- Row 3 --}}
                        <tr x-show="true"
                            x-transition:enter="transition ease-out duration-500 delay-500"
                            x-transition:enter-start="opacity-0 translate-x-4"
                            x-transition:enter-end="opacity-100 translate-x-0"
                            class="glass-card hover:scale-[1.01] transition-all duration-300 group cursor-pointer"
                            :class="darkMode ? 'hover:bg-white/5' : 'hover:bg-rose-50/50'">
                            <td class="p-4 rounded-l-2xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-rose-500 to-pink-600 rounded-xl flex items-center justify-center text-white shadow-lg transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-6">
                                        <i class="bi bi-calendar-event text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm transition-colors duration-300"
                                           :class="darkMode ? 'text-slate-200 group-hover:text-rose-400' : 'text-slate-700 group-hover:text-rose-600'">
                                            Jadwal Meeting Board
                                        </p>
                                        <p class="text-[11px] text-slate-500 mt-1">Update: 1 hari yang lalu</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1.5 bg-emerald-500/10 text-emerald-600 dark:text-emerald-400 rounded-full text-[10px] font-bold uppercase">
                                    Completed
                                </span>
                            </td>
                            <td class="p-4">
                                <div class="w-40">
                                    <div class="flex justify-between text-[10px] font-bold mb-2"
                                         :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                        <span>Progress</span>
                                        <span class="text-emerald-500">100%</span>
                                    </div>
                                    <div class="w-full h-2 rounded-full overflow-hidden"
                                         :class="darkMode ? 'bg-slate-700' : 'bg-slate-200'">
                                        <div class="h-full bg-gradient-to-r from-emerald-500 to-green-500 rounded-full transition-all duration-1000 ease-out" 
                                             style="width: 100%"
                                             x-init="$el.style.width = '0%'; setTimeout(() => $el.style.width = '100%', 700)"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 rounded-r-2xl text-center">
                                <button class="p-2.5 rounded-xl text-blue-500 transition-all duration-300 hover:scale-125"
                                        :class="darkMode ? 'hover:bg-blue-500/20' : 'hover:bg-blue-100'">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button class="p-2.5 rounded-xl text-rose-500 transition-all duration-300 hover:scale-125"
                                        :class="darkMode ? 'hover:bg-rose-500/20' : 'hover:bg-rose-100'">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer with animation --}}
        <footer x-show="true"
                x-transition:enter="transition ease-out duration-500 delay-700"
                x-transition:enter-start="opacity-0"
                x-transition:enter-end="opacity-100"
                class="mt-10 py-6 border-t text-center sm:text-left"
                :class="darkMode ? 'border-white/10' : 'border-slate-200'">
            <p class="text-sm" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                © 2026 <span class="font-bold" :class="darkMode ? 'text-slate-400' : 'text-slate-600'">Portal Admin Premium</span>. All rights reserved.
            </p>
        </footer>
    </main>
</div>
