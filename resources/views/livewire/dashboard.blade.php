<div class="flex w-full">
    {{-- Sidebar --}}
    <x-dashboard.sidebar />

    {{-- Main Content --}}
    <main :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-24'" class="flex-1 w-full p-4 lg:p-8 transition-all duration-300">
        
        {{-- Header --}}
        <x-dashboard.header />

        {{-- Welcome Card --}}
        <x-dashboard.welcome-card />

        {{-- Stats Grid --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <template x-for="(stat, index) in stats" :key="index">
                <div class="glass-card p-6 rounded-3xl shadow-xl hover:translate-y-[-5px] transition-all group overflow-hidden relative">
                    <div class="absolute top-0 right-0 w-24 h-24 bg-white/5 rounded-full -mr-10 -mt-10 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="flex justify-between items-start mb-4">
                        <div :class="stat.bgIcon" class="w-12 h-12 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg">
                            <i :class="stat.icon"></i>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-1 rounded"
                              :class="stat.trend.startsWith('+') ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'"
                              x-text="stat.trend"></span>
                    </div>
                    <p class="text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider" x-text="stat.label"></p>
                    <h3 class="text-3xl font-black mt-1 text-slate-800 dark:text-white" x-text="stat.value"></h3>
                </div>
            </template>
        </div>

        {{-- Main Content Table --}}
        <div class="glass-card rounded-3xl overflow-hidden shadow-2xl">
            {{-- Table Header Controls --}}
            <div class="bg-white/5 px-6 py-4 border-b border-white/10 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="flex gap-1.5">
                        <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                        <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
                    </div>
                    <span class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-2">Manajemen Konten Utama</span>
                </div>
                <div class="flex gap-4">
                    <button class="text-slate-400 hover:text-blue-400 transition-colors"><i class="bi bi-search"></i></button>
                    <button class="text-slate-400 hover:text-blue-400 transition-colors"><i class="bi bi-funnel"></i></button>
                </div>
            </div>

            {{-- Table Content --}}
            <div class="p-6 overflow-x-auto">
                <table class="w-full text-left border-separate border-spacing-y-3">
                    <thead class="text-slate-500 dark:text-slate-400 text-[10px] font-bold uppercase tracking-widest">
                        <tr>
                            <th class="px-6 pb-2">Informasi Item</th>
                            <th class="px-6 pb-2">Status / Kategori</th>
                            <th class="px-6 pb-2">Progress</th>
                            <th class="px-6 pb-2 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Row 1 --}}
                        <tr class="glass-card hover:bg-white/5 transition-all group cursor-pointer">
                            <td class="p-4 rounded-l-2xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 btn-premium rounded-xl flex items-center justify-center text-white shadow-lg">
                                        <i class="bi bi-file-earmark-text text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-slate-700 dark:text-slate-200 group-hover:text-blue-400 transition-colors">Laporan Penjualan Q1</p>
                                        <p class="text-[11px] text-slate-500 mt-1">Update: 2 jam yang lalu</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1.5 bg-blue-500/10 text-blue-500 rounded-full text-[10px] font-bold uppercase">Verified</span>
                            </td>
                            <td class="p-4">
                                <div class="w-40">
                                    <div class="flex justify-between text-[10px] font-bold mb-1.5 text-slate-400">
                                        <span>Progress Kerja</span>
                                        <span class="text-blue-500">75%</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                        <div class="h-full btn-premium rounded-full" style="width: 75%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 rounded-r-2xl text-center">
                                <button class="p-2.5 hover:bg-blue-500/20 rounded-xl text-blue-500 transition-all"><i class="bi bi-pencil-square"></i></button>
                                <button class="p-2.5 hover:bg-red-500/20 rounded-xl text-red-500 transition-all"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        
                        {{-- Row 2 --}}
                        <tr class="glass-card hover:bg-white/5 transition-all group cursor-pointer">
                            <td class="p-4 rounded-l-2xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                                        <i class="bi bi-bar-chart-line text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-slate-700 dark:text-slate-200 group-hover:text-emerald-400 transition-colors">Analisis Data Marketing</p>
                                        <p class="text-[11px] text-slate-500 mt-1">Update: 5 jam yang lalu</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1.5 bg-amber-500/10 text-amber-500 rounded-full text-[10px] font-bold uppercase">Pending</span>
                            </td>
                            <td class="p-4">
                                <div class="w-40">
                                    <div class="flex justify-between text-[10px] font-bold mb-1.5 text-slate-400">
                                        <span>Progress Kerja</span>
                                        <span class="text-emerald-500">45%</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full" style="width: 45%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 rounded-r-2xl text-center">
                                <button class="p-2.5 hover:bg-blue-500/20 rounded-xl text-blue-500 transition-all"><i class="bi bi-pencil-square"></i></button>
                                <button class="p-2.5 hover:bg-red-500/20 rounded-xl text-red-500 transition-all"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>

                        {{-- Row 3 --}}
                        <tr class="glass-card hover:bg-white/5 transition-all group cursor-pointer">
                            <td class="p-4 rounded-l-2xl">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-rose-500 to-pink-600 rounded-xl flex items-center justify-center text-white shadow-lg">
                                        <i class="bi bi-calendar-event text-lg"></i>
                                    </div>
                                    <div>
                                        <p class="font-bold text-sm text-slate-700 dark:text-slate-200 group-hover:text-rose-400 transition-colors">Jadwal Meeting Board</p>
                                        <p class="text-[11px] text-slate-500 mt-1">Update: 1 hari yang lalu</p>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1.5 bg-green-500/10 text-green-500 rounded-full text-[10px] font-bold uppercase">Completed</span>
                            </td>
                            <td class="p-4">
                                <div class="w-40">
                                    <div class="flex justify-between text-[10px] font-bold mb-1.5 text-slate-400">
                                        <span>Progress Kerja</span>
                                        <span class="text-green-500">100%</span>
                                    </div>
                                    <div class="w-full h-2 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden">
                                        <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full" style="width: 100%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="p-4 rounded-r-2xl text-center">
                                <button class="p-2.5 hover:bg-blue-500/20 rounded-xl text-blue-500 transition-all"><i class="bi bi-pencil-square"></i></button>
                                <button class="p-2.5 hover:bg-red-500/20 rounded-xl text-red-500 transition-all"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Footer --}}
        <footer class="mt-10 py-6 border-t border-slate-200 dark:border-white/10 text-center sm:text-left">
            <p class="text-sm text-slate-500">© 2026 <span class="font-bold text-slate-600 dark:text-slate-400">Portal Admin Premium</span>. All rights reserved.</p>
        </footer>
    </main>
</div>
