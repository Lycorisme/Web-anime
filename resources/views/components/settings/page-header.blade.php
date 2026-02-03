{{-- Settings Page Header - Harmonious Style --}}
<div class="flex flex-col xl:flex-row items-start xl:items-center justify-between gap-6 mb-6"
     x-data="{ 
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
             
             this.date = `${days[now.getDay()]} • ${now.getDate()} ${months[now.getMonth()]} ${now.getFullYear()}`;
         }
     }">
        
    {{-- Left Content: Icon, Title, Breadcrumb --}}
    <div class="flex items-center gap-4">
        {{-- Settings Icon --}}
        <div class="w-12 h-12 rounded-2xl flex items-center justify-center border shadow-lg"
             :class="darkMode ? 'border-transparent shadow-theme-primary' : 'bg-white border-slate-200 shadow-slate-200/50'"
             style="background: linear-gradient(to bottom right, color-mix(in srgb, var(--theme-primary) 20%, transparent), color-mix(in srgb, var(--theme-secondary) 20%, transparent));">
            <i class="bi bi-gear-fill text-xl text-theme-primary"></i>
        </div>
        
        {{-- Title and Breadcrumb --}}
        <div>
            <h1 class="text-xl lg:text-2xl font-black tracking-tight"
                :class="darkMode ? 'text-white' : 'text-slate-800'">
                Pengaturan Portal
            </h1>
            <div class="flex items-center gap-2 text-sm mt-1">
                <i class="bi bi-grid-fill" :class="darkMode ? 'text-slate-500' : 'text-slate-400'"></i>
                <span :class="darkMode ? 'text-slate-500' : 'text-slate-400'">></span>
                <span class="font-semibold text-theme-primary">Konfigurasi Sistem</span>
            </div>
        </div>
    </div>

    {{-- Right Content: Timer Widget (Dashboard Style) --}}
    <div class="flex-shrink-0 w-full xl:w-auto">
        <div class="p-2.5 lg:p-3 rounded-2xl flex items-center gap-3 shadow-xl relative overflow-hidden transition-all duration-500 group border"
             :class="darkMode ? 'glass-card border-transparent' : 'bg-white border-slate-200 shadow-slate-200/50'">
            
            {{-- Decorative Line --}}
            <div class="absolute top-0 left-0 w-full h-[1px] opacity-50" style="background: linear-gradient(to right, transparent, color-mix(in srgb, var(--theme-primary) 50%, transparent), transparent);"></div>

            {{-- Icon --}}
            <div class="w-8 h-8 rounded-full border-2 flex items-center justify-center shrink-0 text-theme-primary"
                 style="border-color: color-mix(in srgb, var(--theme-primary) 20%, transparent);">
                <i class="bi bi-clock text-base"></i>
            </div>

            {{-- Time & Date --}}
            <div>
                <div class="flex items-center gap-1 text-lg lg:text-xl font-bold tabular-nums tracking-wider mb-0.5 font-mono"
                     :class="darkMode ? 'text-white' : 'text-slate-800'">
                    <span x-text="timeHours">10</span>
                    <span class="animate-pulse px-0.5" :class="darkMode ? 'text-slate-600' : 'text-slate-400'">:</span>
                    <span x-text="timeMinutes">00</span>
                    <span class="animate-pulse font-light text-base px-0.5" :class="darkMode ? 'text-slate-600' : 'text-slate-400'">:</span>
                    <span x-text="timeSeconds" class="text-base" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">00</span>
                </div>
                <div class="font-bold text-[10px] uppercase tracking-wider text-theme-primary" 
                     x-text="date">
                    SABTU • 1 FEBRUARI 2026
                </div>
            </div>
        </div>
    </div>
</div>
