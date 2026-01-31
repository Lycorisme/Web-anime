{{-- Welcome Card Component with Live Clock --}}
<div class="glass-card rounded-3xl p-6 lg:p-8 mb-10 relative overflow-hidden group"
     :class="darkMode ? '' : 'shadow-lg shadow-slate-200/50'">
    
    {{-- Background Decorations --}}
    <div class="absolute top-0 right-0 w-72 h-72 rounded-full blur-3xl -mr-36 -mt-36 transition-all duration-700 group-hover:scale-125"
         :class="darkMode ? 'bg-gradient-to-br from-blue-500/20 to-purple-500/20' : 'bg-gradient-to-br from-blue-400/15 to-purple-400/15'"></div>
    <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full blur-2xl -ml-28 -mb-28 transition-all duration-700 group-hover:scale-110"
         :class="darkMode ? 'bg-gradient-to-tr from-purple-500/10 to-pink-500/10' : 'bg-gradient-to-tr from-purple-400/10 to-pink-400/10'"></div>
    
    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        {{-- Left: Greeting --}}
        <div class="flex items-center gap-5">
            {{-- Avatar with Glow --}}
            <div class="relative group/avatar">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl blur-lg opacity-50 group-hover/avatar:opacity-80 transition-all duration-500 group-hover/avatar:scale-110"></div>
                <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff&size=96&bold=true" 
                     class="relative w-16 h-16 lg:w-20 lg:h-20 rounded-2xl ring-4 shadow-xl transition-all duration-300 group-hover/avatar:scale-105"
                     :class="darkMode ? 'ring-white/10' : 'ring-white'"
                     alt="User Avatar">
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-4 shadow-lg"
                     :class="darkMode ? 'border-slate-900' : 'border-white'"></div>
            </div>
            
            {{-- Text Content --}}
            <div>
                <p class="text-sm font-medium mb-1"
                   :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    <span class="inline-block animate-wave">👋</span>
                    Selamat datang kembali,
                </p>
                <h2 class="text-2xl lg:text-3xl font-extrabold"
                    :class="darkMode ? 'text-white' : 'text-slate-800'">
                    Alex <span class="gradient-text">Christie</span>
                </h2>
                <p class="text-sm mt-1.5 flex items-center gap-2"
                   :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    <i class="bi bi-calendar3"></i>
                    <span x-text="new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></span>
                </p>
            </div>
        </div>
        
        {{-- Right: Live Clock --}}
        <div class="flex items-center gap-4"
             x-data="liveClock()"
             x-init="startClock()">
            
            {{-- Clock Display --}}
            <div class="flex items-center gap-3 px-6 py-5 rounded-2xl border transition-all duration-300"
                 :class="darkMode ? 'bg-white/5 border-white/10' : 'bg-white/80 border-slate-200 shadow-lg'">
                
                {{-- Clock Icon with Animation --}}
                <div class="relative">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center btn-premium shadow-lg">
                        <i class="bi bi-clock text-2xl text-white"></i>
                    </div>
                    {{-- Pulse ring --}}
                    <div class="absolute inset-0 rounded-2xl animate-ping opacity-20 btn-premium"></div>
                </div>
                
                {{-- Time Display --}}
                <div class="text-center">
                    <div class="flex items-baseline gap-1">
                        <span class="text-4xl lg:text-5xl font-black tabular-nums tracking-tight"
                              :class="darkMode ? 'text-white' : 'text-slate-800'"
                              x-text="hours"></span>
                        <span class="text-4xl lg:text-5xl font-black animate-pulse"
                              :class="darkMode ? 'text-blue-400' : 'text-blue-500'">:</span>
                        <span class="text-4xl lg:text-5xl font-black tabular-nums tracking-tight"
                              :class="darkMode ? 'text-white' : 'text-slate-800'"
                              x-text="minutes"></span>
                        <span class="text-xl font-bold ml-1"
                              :class="darkMode ? 'text-slate-400' : 'text-slate-500'"
                              x-text="seconds"></span>
                    </div>
                    <p class="text-[10px] font-bold uppercase tracking-widest mt-1"
                       :class="darkMode ? 'text-slate-500' : 'text-slate-400'"
                       x-text="period"></p>
                </div>
            </div>
            
            {{-- Add New Button --}}
            <button class="btn-premium px-5 py-5 rounded-2xl text-white font-bold transition-all duration-300 hover:scale-105 active:scale-95 shadow-xl hidden sm:flex items-center justify-center">
                <i class="bi bi-plus-lg text-xl"></i>
            </button>
        </div>
    </div>
</div>

<script>
function liveClock() {
    return {
        hours: '00',
        minutes: '00',
        seconds: '00',
        period: 'WIB',
        
        startClock() {
            this.updateTime();
            setInterval(() => this.updateTime(), 1000);
        },
        
        updateTime() {
            const now = new Date();
            this.hours = String(now.getHours()).padStart(2, '0');
            this.minutes = String(now.getMinutes()).padStart(2, '0');
            this.seconds = String(now.getSeconds()).padStart(2, '0');
            this.period = 'WIB';
        }
    }
}
</script>

<style>
@keyframes wave {
    0%, 60%, 100% { transform: rotate(0deg); }
    10%, 30% { transform: rotate(14deg); }
    20% { transform: rotate(-8deg); }
    40% { transform: rotate(-4deg); }
    50% { transform: rotate(10deg); }
}
.animate-wave {
    animation: wave 2.5s ease-in-out infinite;
    display: inline-block;
    transform-origin: 70% 70%;
}
</style>
