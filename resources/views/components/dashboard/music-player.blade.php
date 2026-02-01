{{-- Music Player Component --}}
<div class="p-3 border-t"
     :class="darkMode ? 'border-white/10' : 'border-slate-200'"
     x-data="{ 
         isPlaying: false,
         currentTime: 0,
         duration: 234,
         volume: 75,
         isMuted: false,
         showVolume: false,
         songTitle: 'Gurenge',
         artist: 'LiSA',
         
         formatTime(seconds) {
             const mins = Math.floor(seconds / 60);
             const secs = Math.floor(seconds % 60);
             return `${mins}:${secs.toString().padStart(2, '0')}`;
         },
         
         togglePlay() {
             this.isPlaying = !this.isPlaying;
         },
         
         seekTo(event) {
             const rect = event.target.getBoundingClientRect();
             const x = event.clientX - rect.left;
             const percentage = x / rect.width;
             this.currentTime = Math.floor(percentage * this.duration);
         },
         
         get progress() {
             return (this.currentTime / this.duration) * 100;
         },
         
         init() {
             setInterval(() => {
                 if (this.isPlaying && this.currentTime < this.duration) {
                     this.currentTime++;
                 } else if (this.currentTime >= this.duration) {
                     this.currentTime = 0;
                     this.isPlaying = false;
                 }
             }, 1000);
         }
     }">
    <div class="p-4 rounded-2xl relative overflow-hidden"
         :class="darkMode 
             ? 'bg-gradient-to-br from-[#0d1525] to-[#111827] border border-white/5' 
             : 'bg-gradient-to-br from-slate-50 to-white border border-slate-200'">
        
        {{-- Animated Background Glow --}}
        <div class="absolute inset-0 opacity-30 pointer-events-none">
            <div class="absolute -top-10 -left-10 w-24 h-24 bg-pink-500/30 rounded-full blur-[40px]" :class="isPlaying ? 'animate-pulse' : ''"></div>
            <div class="absolute -bottom-10 -right-10 w-24 h-24 bg-purple-500/30 rounded-full blur-[40px]" :class="isPlaying ? 'animate-pulse' : ''" style="animation-delay: 0.5s;"></div>
        </div>
        
        <div class="relative z-10">
            {{-- Header with Now Playing --}}
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center shadow-lg shadow-pink-500/25">
                        <i class="bi bi-music-note-beamed text-white text-xs"></i>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-wider"
                          :class="darkMode ? 'text-slate-400' : 'text-slate-500'">Now Playing</span>
                </div>
                
                {{-- Equalizer --}}
                <div class="flex items-end gap-[2px] h-4">
                    <template x-for="i in 3" :key="i">
                        <div class="w-[3px] rounded-full transition-all duration-150"
                             :class="isPlaying ? 'bg-gradient-to-t from-pink-500 to-purple-400' : (darkMode ? 'bg-slate-700' : 'bg-slate-300')"
                             :style="isPlaying ? `height: ${Math.random() * 12 + 4}px; animation: equalizer 0.5s ease infinite; animation-delay: ${i * 0.1}s;` : 'height: 4px;'">
                        </div>
                    </template>
                </div>
            </div>

            {{-- Album Art + Info Row --}}
            <div class="flex items-center gap-3 mb-3">
                {{-- Mini Album Art --}}
                <div class="relative shrink-0">
                    <div class="w-12 h-12 rounded-xl overflow-hidden border shadow-lg"
                         :class="darkMode ? 'bg-slate-800 border-white/10' : 'bg-slate-100 border-slate-200'">
                        <div class="absolute inset-0 bg-gradient-to-br from-pink-600/20 via-purple-600/20 to-blue-600/20"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <i class="bi bi-vinyl text-2xl" 
                               :class="[isPlaying ? 'animate-spin-slow' : '', darkMode ? 'text-white/20' : 'text-slate-400']"></i>
                        </div>
                    </div>
                </div>

                {{-- Song Info --}}
                <div class="flex-1 min-w-0">
                    <h4 class="font-bold text-sm truncate"
                        :class="darkMode ? 'text-white' : 'text-slate-800'" 
                        x-text="songTitle">Gurenge</h4>
                    <p class="text-xs truncate"
                       :class="darkMode ? 'text-slate-500' : 'text-slate-500'" 
                       x-text="artist">LiSA</p>
                </div>
            </div>

            {{-- Progress Bar --}}
            <div class="mb-3">
                <div class="relative h-1 rounded-full cursor-pointer group overflow-hidden"
                     :class="darkMode ? 'bg-slate-700' : 'bg-slate-200'"
                     @click="seekTo($event)">
                    <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-pink-500 to-purple-500 rounded-full transition-all duration-100"
                         :style="`width: ${progress}%`"></div>
                </div>
                <div class="flex justify-between text-[9px] mt-1 tabular-nums"
                     :class="darkMode ? 'text-slate-600' : 'text-slate-400'">
                    <span x-text="formatTime(currentTime)">0:00</span>
                    <span x-text="formatTime(duration)">3:54</span>
                </div>
            </div>

            {{-- Controls --}}
            <div class="flex items-center justify-center gap-2">
                {{-- Shuffle --}}
                <button class="w-7 h-7 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110"
                        :class="darkMode ? 'text-slate-500 hover:text-pink-400 hover:bg-white/5' : 'text-slate-400 hover:text-pink-500 hover:bg-slate-100'">
                    <i class="bi bi-shuffle text-xs"></i>
                </button>
                
                {{-- Previous --}}
                <button class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110"
                        :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/10' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100'">
                    <i class="bi bi-skip-start-fill text-sm"></i>
                </button>
                
                {{-- Play/Pause --}}
                <button class="w-10 h-10 rounded-xl bg-gradient-to-br from-pink-500 to-purple-600 flex items-center justify-center text-white shadow-lg shadow-pink-500/30 hover:shadow-pink-500/50 transition-all duration-300 hover:scale-105 active:scale-95"
                        @click="togglePlay()">
                    <i class="bi text-lg" :class="isPlaying ? 'bi-pause-fill' : 'bi-play-fill ml-0.5'"></i>
                </button>
                
                {{-- Next --}}
                <button class="w-8 h-8 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110"
                        :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/10' : 'text-slate-500 hover:text-slate-800 hover:bg-slate-100'">
                    <i class="bi bi-skip-end-fill text-sm"></i>
                </button>
                
                {{-- Repeat --}}
                <button class="w-7 h-7 rounded-lg flex items-center justify-center transition-all duration-200 hover:scale-110"
                        :class="darkMode ? 'text-slate-500 hover:text-pink-400 hover:bg-white/5' : 'text-slate-400 hover:text-pink-500 hover:bg-slate-100'">
                    <i class="bi bi-repeat text-xs"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes equalizer {
        0%, 100% { height: 4px; }
        50% { height: 16px; }
    }
    
    .animate-spin-slow {
        animation: spin 3s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
