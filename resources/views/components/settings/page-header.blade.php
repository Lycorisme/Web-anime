{{-- Settings Page Header - Clean Design --}}
<div class="mb-6 animate-fade-in-up">
    <div class="flex items-center justify-between">
        {{-- Left Section --}}
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 btn-premium rounded-xl flex items-center justify-center">
                <i class="bi bi-gear-fill text-xl text-white"></i>
            </div>
            <div>
                <h1 class="text-2xl font-extrabold">
                    <span class="gradient-text">Pengaturan</span>
                </h1>
                <p class="text-slate-400 text-sm">Kelola identitas & tampilan website</p>
            </div>
        </div>
        
        {{-- Right Section --}}
        <a 
            href="/" 
            wire:navigate
            class="px-4 py-2 glass-card rounded-xl text-sm font-medium transition-all flex items-center gap-2 hover:bg-white/10"
        >
            <i class="bi bi-arrow-left"></i>
            Dashboard
        </a>
    </div>
</div>
