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
        <div class="w-14 h-14 rounded-2xl flex items-center justify-center bg-gradient-to-br from-teal-500/20 to-cyan-500/20 border border-teal-500/30 shadow-lg shadow-teal-500/10">
            <i class="bi bi-gear-fill text-2xl text-teal-600 dark:text-teal-400"></i>
        </div>
        
        {{-- Title and Breadcrumb --}}
        <div>
            <h1 class="text-2xl lg:text-3xl font-black text-slate-800 dark:text-white tracking-tight">
                Pengaturan Portal
            </h1>
            <div class="flex items-center gap-2 text-sm mt-1">
                <i class="bi bi-grid-fill text-slate-400 dark:text-slate-500"></i>
                <span class="text-slate-400 dark:text-slate-500">></span>
                <span class="text-teal-600 dark:text-teal-400 font-semibold">Konfigurasi Sistem</span>
            </div>
        </div>
    </div>

    {{-- Right Content: Timer Widget (Dashboard Style) --}}
    <div class="flex-shrink-0 w-full xl:w-auto">
        <div class="glass-card p-4 lg:p-5 rounded-[1.5rem] flex items-center gap-5 shadow-xl relative overflow-hidden transition-all duration-500 group">
            
            {{-- Decorative Line --}}
            <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-teal-500/50 to-transparent opacity-50"></div>

            {{-- Icon --}}
            <div class="w-12 h-12 rounded-full border-2 border-teal-500/20 flex items-center justify-center text-teal-600 dark:text-teal-400 shrink-0">
                <i class="bi bi-clock text-xl"></i>
            </div>

            {{-- Time & Date --}}
            <div>
                <div class="flex items-center gap-1 text-2xl lg:text-3xl font-bold text-slate-800 dark:text-white tabular-nums tracking-wider mb-0.5 font-mono">
                    <span x-text="timeHours">10</span>
                    <span class="animate-pulse text-slate-400 dark:text-slate-600 px-0.5">:</span>
                    <span x-text="timeMinutes">00</span>
                    <span class="animate-pulse text-slate-400 dark:text-slate-600 font-light text-xl px-0.5">:</span>
                    <span x-text="timeSeconds" class="text-slate-400 dark:text-slate-500 text-xl">00</span>
                </div>
                <div class="text-teal-600 dark:text-teal-400 font-bold text-[10px] uppercase tracking-wider" x-text="date">
                    SABTU • 1 FEBRUARI 2026
                </div>
            </div>
        </div>
    </div>
</div>
