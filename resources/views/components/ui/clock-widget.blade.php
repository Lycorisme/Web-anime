<div 
    x-data="{
        time: '',
        date: '',
        interval: null,
        locale: document.documentElement.lang || 'en',
        init() {
            this.updateTime();
            this.interval = setInterval(() => {
                this.updateTime();
            }, 1000);
        },
        updateTime() {
            const now = new Date();
            
            // Format Time: 14:30:45
            this.time = now.toLocaleTimeString(this.locale, { 
                hour: '2-digit', 
                minute: '2-digit', 
                second: '2-digit',
                hour12: false 
            }).replace(/\./g, ':');

            // Format Date using locale
            this.date = now.toLocaleDateString(this.locale, { 
                weekday: 'short', 
                day: 'numeric', 
                month: 'short', 
                year: 'numeric' 
            });
        }
    }" 
    x-init="init()"
    class="hidden sm:flex px-5 py-3 glass-card rounded-2xl items-center gap-4 border border-white/10 shadow-lg group relative overflow-hidden transition-all duration-300 hover:shadow-xl hover:scale-[1.02]"
>
    {{-- Dynamic Background Glow --}}
    <div class="absolute inset-0 opacity-5 group-hover:opacity-10 transition-opacity duration-500"
            style="background: linear-gradient(to right, var(--gradient-start), var(--gradient-end));">
    </div>

    {{-- Icon Box --}}
    <div class="relative w-12 h-12 rounded-xl flex items-center justify-center overflow-hidden">
        {{-- Icon Background --}}
        <div class="absolute inset-0 opacity-10 group-hover:opacity-20 transition-opacity duration-300"
                style="background: linear-gradient(to bottom right, var(--gradient-start), var(--gradient-end));">
        </div>
        
        {{-- Icon --}}
        <i class="bi bi-clock-fill text-xl" 
            style="background: linear-gradient(to bottom right, var(--gradient-start), var(--gradient-end)); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
        </i>
    </div>

    {{-- Time & Date --}}
    <div class="flex flex-col relative z-10">
        <div class="text-2xl font-space font-bold leading-none tracking-wider tabular-nums drop-shadow-sm" 
                x-text="time"
                style="background: linear-gradient(135deg, var(--gradient-start) 0%, var(--gradient-end) 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
        </div>
        <div class="text-[11px] text-slate-500 dark:text-slate-400 font-bold uppercase tracking-widest mt-1.5 flex items-center gap-2">
            <span class="w-1.5 h-1.5 rounded-full animate-pulse" 
                    style="background: linear-gradient(to bottom right, var(--gradient-start), var(--gradient-end));">
            </span>
            <span x-text="date"></span>
        </div>
    </div>
</div>
