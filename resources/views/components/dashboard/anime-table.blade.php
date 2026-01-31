{{-- Ultra Premium Anime Table --}}
<div class="glass-panel rounded-[2rem] lg:rounded-[2.5rem] overflow-hidden animate__animated animate__fadeInUp" style="animation-delay: 0.4s;">
    {{-- Header Bar --}}
    <div class="bg-slate-900/50 px-5 lg:px-6 py-4 border-b border-white/5 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div class="flex items-center gap-4">
            {{-- Browser Dots --}}
            <div class="flex gap-2">
                <div class="w-3 h-3 rounded-full bg-rose-500/80 shadow-[0_0_8px_rgba(244,63,94,0.5)]"></div>
                <div class="w-3 h-3 rounded-full bg-amber-500/80 shadow-[0_0_8px_rgba(245,158,11,0.5)]"></div>
                <div class="w-3 h-3 rounded-full bg-emerald-500/80 shadow-[0_0_8px_rgba(16,185,129,0.5)]"></div>
            </div>
            <div class="h-4 w-[1px] bg-slate-700"></div>
            <div class="flex items-center gap-2">
                <i class="bi bi-database text-indigo-400 text-sm"></i>
                <span class="text-xs font-bold text-slate-400 uppercase tracking-widest">My Anime Collection</span>
            </div>
        </div>
        
        {{-- Actions --}}
        <div class="flex items-center gap-2">
            <button class="p-2.5 rounded-xl glass-panel hover:bg-white/5 text-slate-500 hover:text-indigo-400 transition-all">
                <i class="bi bi-search text-sm"></i>
            </button>
            <button class="p-2.5 rounded-xl glass-panel hover:bg-white/5 text-slate-500 hover:text-indigo-400 transition-all">
                <i class="bi bi-filter text-sm"></i>
            </button>
            <button class="p-2.5 rounded-xl glass-panel hover:bg-white/5 text-slate-500 hover:text-indigo-400 transition-all">
                <i class="bi bi-grid-3x2-gap text-sm"></i>
            </button>
        </div>
    </div>

    {{-- Table Container --}}
    <div class="p-4 lg:p-6 overflow-x-auto custom-scrollbar">
        <table class="w-full text-left border-separate border-spacing-y-3" x-data="{
            animes: [
                { 
                    title: 'Solo Leveling', 
                    genre: 'Action, Fantasy',
                    image: 'https://cdn.myanimelist.net/images/anime/1007/145772.jpg',
                    season: 'Winter 2024',
                    currentEp: 7,
                    totalEp: 12,
                    rating: 4.5,
                    status: 'watching'
                },
                { 
                    title: 'Frieren: Beyond Journey\\'s End', 
                    genre: 'Adventure, Drama',
                    image: 'https://cdn.myanimelist.net/images/anime/1015/138006.jpg',
                    season: 'Fall 2023',
                    currentEp: 24,
                    totalEp: 28,
                    rating: 5,
                    status: 'watching'
                },
                { 
                    title: 'Jujutsu Kaisen S2', 
                    genre: 'Action, Supernatural',
                    image: 'https://cdn.myanimelist.net/images/anime/1792/138022.jpg',
                    season: 'Summer 2023',
                    currentEp: 23,
                    totalEp: 23,
                    rating: 4.5,
                    status: 'completed'
                },
                { 
                    title: 'Demon Slayer: Hashira Arc', 
                    genre: 'Action, Supernatural',
                    image: 'https://cdn.myanimelist.net/images/anime/1286/99889.jpg',
                    season: 'Spring 2024',
                    currentEp: 3,
                    totalEp: 8,
                    rating: 4,
                    status: 'watching'
                }
            ]
        }">
            <thead>
                <tr class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">
                    <th class="px-4 py-3">Anime Details</th>
                    <th class="px-4 py-3 hidden md:table-cell">Season</th>
                    <th class="px-4 py-3">Progress</th>
                    <th class="px-4 py-3 hidden sm:table-cell">Rating</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                <template x-for="(anime, index) in animes" :key="index">
                    <tr class="glass-panel hover:bg-white/5 transition-all duration-300 anime-card-hover group">
                        {{-- Anime Details --}}
                        <td class="p-4 rounded-l-2xl">
                            <div class="flex items-center gap-4">
                                <div class="relative group/img">
                                    <img :src="anime.image" 
                                         :alt="anime.title"
                                         class="w-12 h-16 lg:w-14 lg:h-[4.5rem] rounded-xl object-cover shadow-lg ring-2 ring-white/5 group-hover/img:ring-indigo-500/30 transition-all">
                                    {{-- Status Badge --}}
                                    <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full flex items-center justify-center text-[8px]"
                                         :class="anime.status === 'completed' ? 'bg-emerald-500' : 'bg-blue-500'">
                                        <i :class="anime.status === 'completed' ? 'bi-check' : 'bi-play-fill'" class="text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <p class="font-extrabold text-sm text-white group-hover:text-indigo-400 transition-colors truncate max-w-[150px] lg:max-w-none" 
                                       x-text="anime.title"></p>
                                    <p class="text-[11px] text-slate-500 mt-1 flex items-center gap-1">
                                        <i class="bi bi-tag"></i>
                                        <span x-text="anime.genre"></span>
                                    </p>
                                </div>
                            </div>
                        </td>
                        
                        {{-- Season --}}
                        <td class="p-4 hidden md:table-cell">
                            <span class="text-sm font-semibold text-slate-300 flex items-center gap-2">
                                <i class="bi bi-calendar4-week text-indigo-400/50 text-xs"></i>
                                <span x-text="anime.season"></span>
                            </span>
                        </td>
                        
                        {{-- Progress --}}
                        <td class="p-4">
                            <div class="w-28 lg:w-32">
                                <div class="flex justify-between text-[10px] font-bold mb-1.5">
                                    <span class="text-slate-400">
                                        Ep <span x-text="anime.currentEp" class="text-white"></span> / <span x-text="anime.totalEp"></span>
                                    </span>
                                    <span class="text-indigo-400" x-text="Math.round((anime.currentEp / anime.totalEp) * 100) + '%'"></span>
                                </div>
                                <div class="w-full h-1.5 bg-white/5 rounded-full overflow-hidden">
                                    <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transition-all"
                                         :style="{ width: (anime.currentEp / anime.totalEp * 100) + '%' }"></div>
                                </div>
                            </div>
                        </td>
                        
                        {{-- Rating --}}
                        <td class="p-4 hidden sm:table-cell">
                            <div class="flex items-center gap-0.5">
                                <template x-for="i in 5" :key="i">
                                    <i class="text-xs"
                                       :class="i <= anime.rating ? 'bi-star-fill text-amber-400' : (i - 0.5 <= anime.rating ? 'bi-star-half text-amber-400' : 'bi-star text-slate-600')"></i>
                                </template>
                            </div>
                        </td>
                        
                        {{-- Actions --}}
                        <td class="p-4 rounded-r-2xl">
                            <div class="flex items-center justify-center gap-2">
                                <button class="p-2.5 rounded-xl bg-white/5 hover:bg-indigo-500/20 text-slate-400 hover:text-indigo-400 transition-all">
                                    <i class="bi bi-pencil-square text-sm"></i>
                                </button>
                                <button class="p-2.5 rounded-xl bg-white/5 hover:bg-rose-500/20 text-slate-400 hover:text-rose-400 transition-all">
                                    <i class="bi bi-trash text-sm"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
        
        {{-- Footer Actions --}}
        <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4">
            {{-- Pagination --}}
            <div class="flex items-center gap-2">
                <button class="p-2.5 rounded-xl glass-panel text-slate-500 hover:text-white transition-all">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="px-4 py-2 rounded-xl bg-indigo-500/20 text-indigo-400 font-bold text-sm">1</button>
                <button class="px-4 py-2 rounded-xl glass-panel text-slate-500 hover:text-white font-bold text-sm transition-all">2</button>
                <button class="px-4 py-2 rounded-xl glass-panel text-slate-500 hover:text-white font-bold text-sm transition-all">3</button>
                <button class="p-2.5 rounded-xl glass-panel text-slate-500 hover:text-white transition-all">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
            
            {{-- Add New Button --}}
            <button class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 rounded-2xl text-sm font-bold text-white shadow-lg shadow-indigo-600/20 hover:shadow-indigo-600/40 transition-all hover:scale-105 active:scale-95 flex items-center gap-2">
                <i class="bi bi-plus-lg"></i>
                <span>Add New Anime</span>
            </button>
        </div>
    </div>
</div>
