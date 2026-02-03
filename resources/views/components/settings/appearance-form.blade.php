{{-- Appearance Settings Form --}}
<div class="glass-card rounded-3xl overflow-hidden animate-fade-in-up delay-200">
    <!-- Form Header -->
    <div class="bg-white/5 px-6 py-4 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="flex gap-1.5">
                <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
            </div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-2">
                Pengaturan Tampilan
            </span>
        </div>
    </div>

    <!-- Form Content -->
    <div class="p-6 space-y-6">
        <!-- Logo Upload -->
        <div class="space-y-4">
            <label class="text-sm font-bold text-slate-400 uppercase tracking-wider">
                Logo Situs
            </label>
            <div class="flex items-center gap-6">
                <div class="w-20 h-20 btn-premium rounded-2xl flex items-center justify-center text-white text-3xl">
                    <i class="bi bi-image"></i>
                </div>
                <div class="flex-1">
                    <input 
                        type="file" 
                        wire:model="logo"
                        class="hidden"
                        id="logo-upload"
                        accept="image/*"
                    >
                    <label 
                        for="logo-upload"
                        class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-xl text-sm font-medium cursor-pointer hover:bg-white/10 transition-all"
                    >
                        <i class="bi bi-upload"></i>
                        Pilih File
                    </label>
                    <p class="text-xs text-slate-500 mt-2">PNG, JPG, SVG. Maks 2MB</p>
                </div>
            </div>
        </div>

        <!-- Favicon Upload -->
        <div class="space-y-4">
            <label class="text-sm font-bold text-slate-400 uppercase tracking-wider">
                Favicon
            </label>
            <div class="flex items-center gap-6">
                <div class="w-16 h-16 glass-card rounded-xl flex items-center justify-center text-2xl">
                    <i class="bi bi-app"></i>
                </div>
                <div class="flex-1">
                    <input 
                        type="file" 
                        wire:model="favicon"
                        class="hidden"
                        id="favicon-upload"
                        accept="image/*"
                    >
                    <label 
                        for="favicon-upload"
                        class="inline-flex items-center gap-2 px-4 py-2 glass-card rounded-xl text-sm font-medium cursor-pointer hover:bg-white/10 transition-all"
                    >
                        <i class="bi bi-upload"></i>
                        Pilih File
                    </label>
                    <p class="text-xs text-slate-500 mt-2">ICO, PNG. 32x32px atau 64x64px</p>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="pt-4 border-t border-white/10">
            <button 
                wire:click="saveAppearance"
                class="btn-premium text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2"
            >
                <i class="bi bi-check-lg"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
