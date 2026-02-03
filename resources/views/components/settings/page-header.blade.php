{{-- Settings Page Header - Responsive --}}
<div class="mb-4 sm:mb-6 animate-fade-in-up">
    <div class="flex items-center justify-between gap-3">
        {{-- Left Section --}}
        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 btn-premium rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="bi bi-gear-fill text-lg sm:text-xl text-white"></i>
            </div>
            <div class="min-w-0">
                <h1 class="text-xl sm:text-2xl font-extrabold truncate">
                    <span class="gradient-text">Pengaturan</span>
                </h1>
                
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-xs sm:text-sm mt-0.5">
                    <a href="/" wire:navigate class="text-slate-700 dark:text-slate-400 hover:text-slate-900 dark:hover:text-blue-400 transition-colors flex items-center" title="Dashboard">
                        <i class="bi bi-grid-1x2-fill"></i>
                    </a>
                    <i class="bi bi-chevron-right text-[10px] text-slate-500 dark:text-slate-500"></i>
                    <span class="text-slate-700 dark:text-slate-300 font-medium">Pengaturan</span>
                </nav>
            </div>
        </div>
        
        {{-- Right Section (Clock Widget) --}}
        <div 
            x-data="clock()" 
            x-init="init()"
            class="hidden sm:flex px-4 py-2 glass-card rounded-xl items-center gap-3 border border-white/5 shadow-lg group hover:border-white/10 transition-colors"
        >
            {{-- Icon Box --}}
            <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-blue-500/10 to-purple-500/10 flex items-center justify-center border border-white/5 group-hover:from-blue-500/20 group-hover:to-purple-500/20 transition-all">
                <i class="bi bi-clock-history text-xl text-blue-400"></i>
            </div>

            {{-- Time & Date --}}
            <div class="flex flex-col">
                <div class="text-lg font-space font-bold leading-none tracking-widest tabular-nums gradient-text" x-text="time"></div>
                <div class="text-[10px] text-slate-400 uppercase tracking-wide mt-0.5 font-medium" x-text="date"></div>
            </div>
        </div>

        {{-- Mobile Logic (Optional: Hide on very small screens or distinct style) --}}
        {{-- For now hidden on < sm as per 'hidden sm:flex' class above to save space --}}

        <script>
            function clock() {
                return {
                    time: '',
                    date: '',
                    interval: null,
                    init() {
                        this.updateTime();
                        this.interval = setInterval(() => {
                            this.updateTime();
                        }, 1000);
                    },
                    updateTime() {
                        const now = new Date();
                        
                        // Format Time: 14:30:45
                        this.time = now.toLocaleTimeString('id-ID', { 
                            hour: '2-digit', 
                            minute: '2-digit', 
                            second: '2-digit',
                            hour12: false 
                        }).replace(/\./g, ':');

                        // Format Date: Senin, 3 Feb 2026
                        this.date = now.toLocaleDateString('id-ID', { 
                            weekday: 'short', 
                            day: 'numeric', 
                            month: 'short', 
                            year: 'numeric' 
                        });
                    }
                }
            }
        </script>
    </div>
</div>
