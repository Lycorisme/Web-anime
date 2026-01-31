{{-- Welcome Card Component --}}
<div class="glass-card rounded-3xl p-6 lg:p-8 mb-10 relative overflow-hidden group">
    {{-- Background Decorations --}}
    <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-500/20 to-purple-500/20 rounded-full blur-3xl -mr-32 -mt-32 group-hover:scale-110 transition-transform duration-700"></div>
    <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-purple-500/10 to-pink-500/10 rounded-full blur-2xl -ml-24 -mb-24"></div>
    
    <div class="relative z-10 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
        {{-- Left: Greeting --}}
        <div class="flex items-center gap-5">
            {{-- Avatar with Glow --}}
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl blur-lg opacity-50 group-hover:opacity-70 transition-opacity"></div>
                <img src="https://ui-avatars.com/api/?name=Alex+Christie&background=4f46e5&color=fff&size=80&bold=true" 
                     class="relative w-16 h-16 lg:w-20 lg:h-20 rounded-2xl ring-4 ring-white/10 shadow-xl" 
                     alt="User Avatar">
                {{-- Online Badge --}}
                <div class="absolute -bottom-1 -right-1 w-5 h-5 bg-green-500 rounded-full border-4 border-slate-900 shadow-lg"></div>
            </div>
            
            {{-- Text --}}
            <div>
                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-1">
                    <span class="inline-block animate-wave origin-[70%_70%]">👋</span> Selamat datang kembali,
                </p>
                <h2 class="text-2xl lg:text-3xl font-extrabold text-slate-800 dark:text-white">
                    Alex <span class="gradient-text">Christie</span>
                </h2>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                    <i class="bi bi-calendar3 mr-1.5"></i>
                    <span x-text="new Date().toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })"></span>
                </p>
            </div>
        </div>
        
        {{-- Right: Quick Actions & Stats --}}
        <div class="flex flex-wrap items-center gap-4">
            {{-- Quick Stats --}}
            <div class="flex items-center gap-6 px-6 py-4 glass-card rounded-2xl">
                <div class="text-center">
                    <p class="text-2xl font-black text-slate-800 dark:text-white">12</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Tasks</p>
                </div>
                <div class="w-px h-10 bg-slate-200 dark:bg-slate-700"></div>
                <div class="text-center">
                    <p class="text-2xl font-black text-emerald-500">8</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Done</p>
                </div>
                <div class="w-px h-10 bg-slate-200 dark:bg-slate-700"></div>
                <div class="text-center">
                    <p class="text-2xl font-black text-amber-500">4</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Pending</p>
                </div>
            </div>
            
            {{-- Add New Button --}}
            <button class="btn-premium px-6 py-4 rounded-2xl text-white font-bold text-sm flex items-center gap-2 hover:scale-105 transition-transform shadow-xl">
                <i class="bi bi-plus-lg text-lg"></i>
                <span class="hidden sm:inline">Tambah Baru</span>
            </button>
        </div>
    </div>
</div>

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
}
</style>
