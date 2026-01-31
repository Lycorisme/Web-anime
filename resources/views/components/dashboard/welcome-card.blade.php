{{-- Welcome Card Component with Animations --}}
<div class="glass-card rounded-3xl p-6 lg:p-8 mb-10 relative overflow-hidden group"
     :class="darkMode ? '' : 'shadow-lg shadow-slate-200/50'">
    
    {{-- Background Decorations with Animation --}}
    <div class="absolute top-0 right-0 w-72 h-72 rounded-full blur-3xl -mr-36 -mt-36 transition-all duration-700 group-hover:scale-125"
         :class="darkMode ? 'bg-gradient-to-br from-blue-500/20 to-purple-500/20' : 'bg-gradient-to-br from-blue-400/15 to-purple-400/15'"></div>
    <div class="absolute bottom-0 left-0 w-56 h-56 rounded-full blur-2xl -ml-28 -mb-28 transition-all duration-700 group-hover:scale-110"
         :class="darkMode ? 'bg-gradient-to-tr from-purple-500/10 to-pink-500/10' : 'bg-gradient-to-tr from-purple-400/10 to-pink-400/10'"></div>
    
    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        {{-- Left: Greeting --}}
        <div class="flex items-center gap-5"
             x-show="true"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 -translate-x-4"
             x-transition:enter-end="opacity-100 translate-x-0">
            
            {{-- Avatar with Glow and Animation --}}
            <div class="relative group/avatar">
                {{-- Animated Glow --}}
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl blur-lg opacity-50 group-hover/avatar:opacity-80 transition-all duration-500 group-hover/avatar:scale-110"></div>
                
                {{-- Avatar Image --}}
                <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff&size=96&bold=true" 
                     class="relative w-16 h-16 lg:w-20 lg:h-20 rounded-2xl ring-4 shadow-xl transition-all duration-300 group-hover/avatar:scale-105"
                     :class="darkMode ? 'ring-white/10' : 'ring-white'"
                     alt="User Avatar">
                
                {{-- Online Badge with Pulse --}}
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-500 rounded-full border-4 shadow-lg animate-pulse"
                     :class="darkMode ? 'border-slate-900' : 'border-white'"></div>
            </div>
            
            {{-- Text Content --}}
            <div>
                <p class="text-sm font-medium mb-1"
                   :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    <span class="inline-block origin-[70%_70%]"
                          x-data="{ waving: true }"
                          x-init="setInterval(() => waving = !waving, 2000)"
                          :class="waving ? 'animate-wave' : ''"
                          style="animation: wave 0.5s ease-in-out">👋</span>
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
        
        {{-- Right: Quick Actions & Stats --}}
        <div class="flex flex-wrap items-center gap-4"
             x-show="true"
             x-transition:enter="transition ease-out duration-500 delay-200"
             x-transition:enter-start="opacity-0 translate-x-4"
             x-transition:enter-end="opacity-100 translate-x-0">
            
            {{-- Quick Stats Card --}}
            <div class="flex items-center gap-6 px-6 py-4 rounded-2xl border transition-all duration-300 group/stats hover:scale-[1.02]"
                 :class="darkMode ? 'bg-white/5 border-white/10 hover:bg-white/10' : 'bg-white/80 border-slate-200 hover:bg-white shadow-sm'">
                
                {{-- Tasks --}}
                <div class="text-center"
                     x-data="{ count: 0 }"
                     x-init="setTimeout(() => { let interval = setInterval(() => { if(count < 12) count++; else clearInterval(interval); }, 100); }, 300)">
                    <p class="text-2xl font-black transition-all duration-300"
                       :class="darkMode ? 'text-white' : 'text-slate-800'"
                       x-text="count"></p>
                    <p class="text-[10px] font-bold uppercase tracking-wider"
                       :class="darkMode ? 'text-slate-500' : 'text-slate-400'">Tasks</p>
                </div>
                
                <div class="w-px h-10"
                     :class="darkMode ? 'bg-slate-700' : 'bg-slate-200'"></div>
                
                {{-- Done --}}
                <div class="text-center"
                     x-data="{ count: 0 }"
                     x-init="setTimeout(() => { let interval = setInterval(() => { if(count < 8) count++; else clearInterval(interval); }, 125); }, 400)">
                    <p class="text-2xl font-black text-emerald-500" x-text="count"></p>
                    <p class="text-[10px] font-bold uppercase tracking-wider"
                       :class="darkMode ? 'text-slate-500' : 'text-slate-400'">Done</p>
                </div>
                
                <div class="w-px h-10"
                     :class="darkMode ? 'bg-slate-700' : 'bg-slate-200'"></div>
                
                {{-- Pending --}}
                <div class="text-center"
                     x-data="{ count: 0 }"
                     x-init="setTimeout(() => { let interval = setInterval(() => { if(count < 4) count++; else clearInterval(interval); }, 150); }, 500)">
                    <p class="text-2xl font-black text-amber-500" x-text="count"></p>
                    <p class="text-[10px] font-bold uppercase tracking-wider"
                       :class="darkMode ? 'text-slate-500' : 'text-slate-400'">Pending</p>
                </div>
            </div>
            
            {{-- Add New Button --}}
            <button class="btn-premium px-6 py-4 rounded-2xl text-white font-bold text-sm flex items-center gap-2 transition-all duration-300 hover:scale-105 hover:-rotate-1 active:scale-95">
                <i class="bi bi-plus-lg text-lg transition-transform duration-300 group-hover:rotate-90"></i>
                <span class="hidden sm:inline">Tambah Baru</span>
            </button>
        </div>
    </div>
</div>

<style>
@keyframes wave {
    0%, 100% { transform: rotate(0deg); }
    25% { transform: rotate(20deg); }
    75% { transform: rotate(-15deg); }
}
.animate-wave {
    animation: wave 0.5s ease-in-out infinite;
}
</style>
