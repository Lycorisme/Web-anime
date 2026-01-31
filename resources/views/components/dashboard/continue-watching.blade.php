{{-- Continue Watching Section --}}
<div class="mb-8 animate__animated animate__fadeInUp" style="animation-delay: 0.3s">
    {{-- Section Header --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-2xl bg-gradient-to-br from-rose-500 to-orange-500 flex items-center justify-center shadow-lg shadow-rose-500/20">
                <i class="bi bi-fire text-white"></i>
            </div>
            <div>
                <h3 class="text-lg lg:text-xl font-bold text-white">Continue Watching</h3>
                <p class="text-xs text-slate-500">Pick up where you left off</p>
            </div>
        </div>
        <a href="#" class="text-xs text-indigo-400 hover:text-indigo-300 font-semibold flex items-center gap-1 transition-colors group">
            <span>See All</span>
            <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
        </a>
    </div>
    
    {{-- Anime Cards Grid --}}
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4 lg:gap-5" x-data="{
        animes: [
            { title: 'Frieren: Beyond Journey\'s End', episode: 'EP 18', progress: 64, image: 'https://cdn.myanimelist.net/images/anime/1015/138006.jpg', rating: 9.1 },
            { title: 'Solo Leveling', episode: 'EP 8', progress: 67, image: 'https://cdn.myanimelist.net/images/anime/1007/145772.jpg', rating: 8.9 },
            { title: 'Demon Slayer S4', episode: 'EP 3', progress: 43, image: 'https://cdn.myanimelist.net/images/anime/1286/99889.jpg', rating: 8.5 },
            { title: 'Jujutsu Kaisen S2', episode: 'EP 21', progress: 91, image: 'https://cdn.myanimelist.net/images/anime/1792/138022.jpg', rating: 8.7 },
            { title: 'One Piece', episode: 'EP 1096', progress: 23, image: 'https://cdn.myanimelist.net/images/anime/1244/138851.jpg', rating: 8.7 }
        ]
    }">
        <template x-for="(anime, index) in animes" :key="index">
            <div class="glass-panel rounded-2xl lg:rounded-3xl overflow-hidden anime-card-hover group cursor-pointer border border-white/5">
                {{-- Image Container --}}
                <div class="relative aspect-[3/4] overflow-hidden">
                    <img :src="anime.image" 
                         :alt="anime.title"
                         class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    
                    {{-- Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>
                    
                    {{-- Play Button --}}
                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <div class="w-14 h-14 rounded-full bg-white/20 backdrop-blur-sm flex items-center justify-center border border-white/30 transform scale-75 group-hover:scale-100 transition-transform duration-300">
                            <i class="bi bi-play-fill text-2xl text-white ml-1"></i>
                        </div>
                    </div>
                    
                    {{-- Rating Badge --}}
                    <div class="absolute top-3 right-3 flex items-center gap-1 px-2 py-1 rounded-lg bg-black/50 backdrop-blur-sm border border-white/10">
                        <i class="bi bi-star-fill text-amber-400 text-[10px]"></i>
                        <span class="text-[10px] font-bold text-white" x-text="anime.rating"></span>
                    </div>
                    
                    {{-- Episode Badge --}}
                    <div class="absolute bottom-3 left-3">
                        <span class="text-[10px] font-black text-white bg-indigo-600/90 px-2.5 py-1 rounded-lg uppercase tracking-wide" 
                              x-text="anime.episode"></span>
                    </div>
                </div>
                
                {{-- Content --}}
                <div class="p-4">
                    <h4 class="text-sm font-bold text-white truncate group-hover:text-indigo-400 transition-colors" 
                        x-text="anime.title"></h4>
                    
                    {{-- Progress Bar --}}
                    <div class="mt-3">
                        <div class="flex items-center justify-between text-[10px] mb-1.5">
                            <span class="text-slate-500">Progress</span>
                            <span class="text-indigo-400 font-bold" x-text="anime.progress + '%'"></span>
                        </div>
                        <div class="h-1.5 bg-white/5 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-indigo-500 to-purple-500 rounded-full transition-all duration-500"
                                 :style="{ width: anime.progress + '%' }"></div>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</div>
