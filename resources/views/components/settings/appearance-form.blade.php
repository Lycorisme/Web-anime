{{-- Appearance Settings Form - Premium Design --}}
@props(['currentLogo' => null, 'currentFavicon' => null])

<div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-200">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 px-6 py-5 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-500/20">
                <i class="bi bi-palette-fill text-xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-lg">Tampilan Visual</h3>
                <p class="text-xs text-slate-400">Logo & favicon website</p>
            </div>
        </div>
    </div>

    {{-- Form Content --}}
    <div class="p-6 space-y-8">
        {{-- Logo Upload Section --}}
        <div class="space-y-4">
            <label class="flex items-center gap-2 text-sm font-bold text-slate-400">
                <i class="bi bi-image-fill text-purple-400"></i>
                Logo Situs
            </label>
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                {{-- Preview --}}
                <div class="relative group">
                    @if($currentLogo)
                        <img src="{{ Storage::url($currentLogo) }}" alt="Logo" class="w-24 h-24 rounded-2xl object-cover shadow-xl">
                    @else
                        <div class="w-24 h-24 rounded-2xl bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-4xl shadow-xl shadow-purple-500/20 overflow-hidden">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 rounded-2xl bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                        <i class="bi bi-camera-fill text-white text-xl"></i>
                    </div>
                </div>
                
                {{-- Upload Button --}}
                <div class="flex-1 space-y-3">
                    <input 
                        type="file" 
                        wire:model="siteLogo"
                        class="hidden"
                        id="logo-upload"
                        accept="image/*"
                    >
                    <label 
                        for="logo-upload"
                        class="inline-flex items-center gap-3 px-6 py-3 glass-card rounded-xl text-sm font-bold cursor-pointer hover:bg-white/10 transition-all hover:scale-[1.02] active:scale-[0.98]"
                    >
                        <i class="bi bi-cloud-arrow-up-fill text-purple-400 text-lg"></i>
                        Upload Logo Baru
                    </label>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                        <span class="px-2 py-1 rounded-md bg-white/5">PNG</span>
                        <span class="px-2 py-1 rounded-md bg-white/5">JPG</span>
                        <span class="px-2 py-1 rounded-md bg-white/5">SVG</span>
                        <span class="text-slate-400">• Max 2MB</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

        {{-- Favicon Upload Section --}}
        <div class="space-y-4">
            <label class="flex items-center gap-2 text-sm font-bold text-slate-400">
                <i class="bi bi-app-indicator text-pink-400"></i>
                Favicon
            </label>
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center gap-6">
                {{-- Preview --}}
                <div class="relative group">
                    @if($currentFavicon)
                        <img src="{{ Storage::url($currentFavicon) }}" alt="Favicon" class="w-20 h-20 rounded-xl object-cover">
                    @else
                        <div class="w-20 h-20 rounded-xl glass-card flex items-center justify-center text-3xl border-2 border-dashed border-white/20">
                            <i class="bi bi-app text-slate-400"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 rounded-xl bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                        <i class="bi bi-camera-fill text-white"></i>
                    </div>
                </div>
                
                {{-- Upload Button --}}
                <div class="flex-1 space-y-3">
                    <input 
                        type="file" 
                        wire:model="siteFavicon"
                        class="hidden"
                        id="favicon-upload"
                        accept="image/*"
                    >
                    <label 
                        for="favicon-upload"
                        class="inline-flex items-center gap-3 px-6 py-3 glass-card rounded-xl text-sm font-bold cursor-pointer hover:bg-white/10 transition-all hover:scale-[1.02] active:scale-[0.98]"
                    >
                        <i class="bi bi-cloud-arrow-up-fill text-pink-400 text-lg"></i>
                        Upload Favicon
                    </label>
                    <div class="flex flex-wrap items-center gap-3 text-xs text-slate-500">
                        <span class="px-2 py-1 rounded-md bg-white/5">ICO</span>
                        <span class="px-2 py-1 rounded-md bg-white/5">PNG</span>
                        <span class="text-slate-400">• 32×32 atau 64×64px</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Save Button --}}
        <div class="pt-6 border-t border-white/5">
            <button 
                wire:click="save"
                class="btn-premium text-white px-8 py-4 rounded-xl font-bold text-sm flex items-center gap-3 hover:scale-[1.02] active:scale-[0.98] transition-transform shadow-xl"
            >
                <i class="bi bi-check-circle-fill text-lg"></i>
                Simpan Tampilan
            </button>
        </div>
    </div>
</div>
