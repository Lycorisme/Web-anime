{{-- Compact Music Player Component --}}
<div class="p-2 border-t"
     :class="darkMode ? 'border-white/10' : 'border-slate-200'"
     x-data="{ 
         isPlaying: false,
         currentTime: 0,
         duration: 234,
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
    
    <div class="p-2.5 rounded-xl relative overflow-hidden"
         :class="darkMode 
             ? 'bg-gradient-to-r from-[#0d1525]/80 to-[#111827]/80 border border-white/5' 
             : 'bg-gradient-to-r from-slate-50 to-white border border-slate-200'">
        
        {{-- Subtle Background Glow --}}
        <div class="absolute inset-0 opacity-20 pointer-events-none">
            <div class="absolute -top-6 -left-6 w-16 h-16 rounded-full blur-[30px]" style="background-color: color-mix(in srgb, var(--theme-accent) 30%, transparent);" :class="isPlaying ? 'animate-pulse' : ''"></div>
            <div class="absolute -bottom-6 -right-6 w-16 h-16 rounded-full blur-[30px]" style="background-color: color-mix(in srgb, var(--theme-secondary) 30%, transparent);" :class="isPlaying ? 'animate-pulse' : ''"></div>
        </div>
        
        <div class="relative z-10 flex items-center gap-2.5">
            {{-- Mini Album Art --}}
            <div class="relative shrink-0">
                <div class="w-9 h-9 rounded-lg overflow-hidden border shadow-md"
                     :class="darkMode ? 'bg-slate-800 border-white/10' : 'bg-slate-100 border-slate-200'">
                    <div class="absolute inset-0" style="background: linear-gradient(to bottom right, color-mix(in srgb, var(--theme-accent) 20%, transparent), color-mix(in srgb, var(--theme-secondary) 20%, transparent), color-mix(in srgb, var(--theme-primary) 20%, transparent));"></div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <i class="bi bi-vinyl text-lg" 
                           :class="[isPlaying ? 'animate-spin-slow' : '', darkMode ? 'text-white/30' : 'text-slate-400']"></i>
                    </div>
                </div>
            </div>

            {{-- Song Info + Progress --}}
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between gap-1.5 mb-1">
                    <div class="min-w-0 flex-1">
                        <h4 class="font-semibold text-xs truncate leading-tight"
                            :class="darkMode ? 'text-white' : 'text-slate-800'" 
                            x-text="songTitle">Gurenge</h4>
                        <p class="text-[10px] truncate opacity-60"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'" 
                           x-text="artist">LiSA</p>
                    </div>
                    
                    {{-- Time Display --}}
                    <span class="text-[9px] tabular-nums shrink-0"
                          :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                        <span x-text="formatTime(currentTime)">0:00</span>
                    </span>
                </div>
                
                {{-- Progress Bar --}}
                <div class="relative h-0.5 rounded-full cursor-pointer group overflow-hidden"
                     :class="darkMode ? 'bg-slate-700' : 'bg-slate-200'"
                     @click="seekTo($event)">
                    <div class="absolute inset-y-0 left-0 bg-theme-gradient-btn rounded-full transition-all duration-100"
                         :style="`width: ${progress}%`"></div>
                </div>
            </div>

            {{-- Compact Controls --}}
            <div class="flex items-center gap-0.5 shrink-0">
                {{-- Previous --}}
                <button class="w-6 h-6 rounded-md flex items-center justify-center transition-all duration-200 hover:scale-110"
                        :class="darkMode ? 'text-slate-500 hover:text-white hover:bg-white/10' : 'text-slate-400 hover:text-slate-700 hover:bg-slate-100'">
                    <i class="bi bi-skip-start-fill text-[10px]"></i>
                </button>
                
                {{-- Play/Pause --}}
                <button class="w-7 h-7 rounded-lg bg-theme-gradient-btn flex items-center justify-center text-white shadow-md shadow-theme-primary transition-all duration-300 hover:scale-105 active:scale-95"
                        @click="togglePlay()">
                    <i class="bi text-xs" :class="isPlaying ? 'bi-pause-fill' : 'bi-play-fill'"></i>
                </button>
                
                {{-- Next --}}
                <button class="w-6 h-6 rounded-md flex items-center justify-center transition-all duration-200 hover:scale-110"
                        :class="darkMode ? 'text-slate-500 hover:text-white hover:bg-white/10' : 'text-slate-400 hover:text-slate-700 hover:bg-slate-100'">
                    <i class="bi bi-skip-end-fill text-[10px]"></i>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    .animate-spin-slow {
        animation: spin 3s linear infinite;
    }
    
    @keyframes spin {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
</style>
