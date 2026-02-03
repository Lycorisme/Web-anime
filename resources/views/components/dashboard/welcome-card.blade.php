{{-- Welcome Card Component - Ultra Premium Admin Style (Compact Version) --}}
<div class="relative overflow-hidden rounded-[2rem] p-5 lg:p-6 mb-6 border transition-all duration-300 group"
     :class="darkMode ? 'bg-[#0B1121] border-white/5 shadow-none' : 'bg-white border-slate-200 shadow-2xl'"
     x-data="{ 
         username: 'Administrator',
         timeHours: '00',
         timeMinutes: '00',
         timeSeconds: '00',
         date: '',
         init() {
             this.updateClock();
             setInterval(() => this.updateClock(), 1000);
         },
         updateClock() {
             const now = new Date();
             this.timeHours = String(now.getHours()).padStart(2, '0');
             this.timeMinutes = String(now.getMinutes()).padStart(2, '0');
             this.timeSeconds = String(now.getSeconds()).padStart(2, '0');
             
             const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
             const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
             
             // Format: Selasa • 13 Januari 2026
             this.date = `${days[now.getDay()]} • ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
         }
     }">
     
    {{-- Grid Pattern Background --}}
    <div class="absolute inset-0 bg-[size:24px_24px] pointer-events-none"
         :class="darkMode ? 'bg-[linear-gradient(to_right,#ffffff05_1px,transparent_1px),linear-gradient(to_bottom,#ffffff05_1px,transparent_1px)]' : 'bg-[linear-gradient(to_right,#00000005_1px,transparent_1px),linear-gradient(to_bottom,#00000005_1px,transparent_1px)]'"></div>
    
    {{-- Ambient Glow --}}
    <div class="absolute top-0 right-0 w-[400px] h-[400px] rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2 pointer-events-none" style="background-color: color-mix(in srgb, var(--theme-accent) 10%, transparent);"></div>

    <div class="relative z-10 flex flex-col xl:flex-row items-center justify-between gap-6">
        
        {{-- Left Content --}}
        <div class="flex-1 w-full text-center xl:text-left">
            {{-- System Badge --}}
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border mb-4 transition-colors duration-500"
                 :class="darkMode ? 'bg-[#161F32] border-white/5' : 'bg-slate-100 border-slate-200'"
                 style="--hover-border: var(--theme-accent);">
                <span class="relative flex h-2 w-2">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" style="background-color: var(--theme-accent);"></span>
                    <span class="relative inline-flex rounded-full h-2 w-2" style="background-color: var(--theme-accent);"></span>
                </span>
                <span class="text-[10px] font-bold uppercase tracking-wider"
                      :class="darkMode ? 'text-slate-400' : 'text-slate-600'">System Online</span>
            </div>

            {{-- Headline --}}
            <h1 class="text-xl lg:text-2xl font-black mb-2 tracking-tight leading-tight"
                :class="darkMode ? 'text-white' : 'text-slate-900'">
                Welcome back, <span class="text-theme-accent" x-text="username">Administrator</span>
                <span class="inline-block animate-wave origin-[70%_70%] ml-1">👋</span>
            </h1>
            
            {{-- Subtitle --}}
            <p class="text-sm font-medium max-w-2xl mx-auto xl:mx-0"
               :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                Semua sistem berjalan normal. Have a productive day! 🚀
            </p>
        </div>

        {{-- Right Content: Timer Widget --}}
        <div class="hidden xl:block flex-shrink-0 w-full xl:w-auto">
            <div class="border p-3 lg:p-4 rounded-[1.25rem] flex items-center justify-between xl:justify-start gap-4 shadow-xl relative overflow-hidden transition-all duration-500"
                 :class="darkMode ? 'bg-[#111827] border-white/5 hover:border-white/10 shadow-none' : 'bg-white border-slate-200 hover:border-slate-300 hover:shadow-2xl'">
                
                {{-- Decorative Line --}}
                <div class="absolute top-0 left-0 w-full h-[1px] opacity-50" style="background: linear-gradient(to right, transparent, color-mix(in srgb, var(--theme-accent) 50%, transparent), transparent);"></div>

                {{-- Icon --}}
                <div class="w-10 h-10 rounded-full border-2 flex items-center justify-center text-theme-accent shrink-0" style="border-color: color-mix(in srgb, var(--theme-accent) 20%, transparent);">
                    <i class="bi bi-clock text-lg"></i>
                </div>

                {{-- Time & Date --}}
                <div class="text-right xl:text-left">
                    <div class="flex items-center justify-end xl:justify-start gap-1 text-xl lg:text-2xl font-bold tabular-nums tracking-wider mb-0.5 font-mono"
                         :class="darkMode ? 'text-white' : 'text-slate-800'">
                        <span x-text="timeHours">07</span>
                        <span class="animate-pulse text-slate-400 dark:text-slate-600 px-0.5">:</span>
                        <span x-text="timeMinutes">58</span>
                        <span class="animate-pulse text-slate-400 dark:text-slate-600 font-light text-lg px-0.5">:</span>
                        <span x-text="timeSeconds" class="text-slate-500 dark:text-slate-400 text-lg">30</span>
                    </div>
                    <div class="text-theme-accent font-bold text-[10px] uppercase tracking-wider" x-text="date">
                        SELASA • 13 JANUARI 2026
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes wave {
        0% { transform: rotate(0.0deg) }
        10% { transform: rotate(14.0deg) }
        20% { transform: rotate(-8.0deg) }
        30% { transform: rotate(14.0deg) }
        40% { transform: rotate(-4.0deg) }
        50% { transform: rotate(10.0deg) }
        60% { transform: rotate(0.0deg) }
        100% { transform: rotate(0.0deg) }
    }
    .animate-wave {
        animation-name: wave;
        animation-duration: 2.5s;
        animation-iteration-count: infinite;
        transform-origin: 70% 70%;
        display: inline-block;
    }
</style>
