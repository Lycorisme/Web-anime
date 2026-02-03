{{-- Settings Page Header --}}
<div class="glass-card rounded-3xl p-6 mb-8 animate-fade-in-up">
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight">
                <span class="gradient-text">Pengaturan Situs</span>
            </h1>
            <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">
                Kelola konfigurasi dan tampilan website Anda
            </p>
        </div>
        
        <div class="flex items-center gap-3">
            <a 
                href="/" 
                wire:navigate
                class="px-4 py-2 glass-card rounded-xl text-sm font-medium hover:bg-white/10 transition-all flex items-center gap-2"
            >
                <i class="bi bi-arrow-left"></i>
                Kembali
            </a>
        </div>
    </div>
</div>
