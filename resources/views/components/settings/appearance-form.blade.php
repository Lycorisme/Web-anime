{{-- Appearance Settings Form - Responsive --}}
@props(['currentLogo' => null, 'currentFavicon' => null])

<div class="glass-card rounded-xl sm:rounded-2xl overflow-hidden animate-fade-in-up delay-200">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-purple-500/10 to-pink-500/10 px-4 sm:px-6 py-4 sm:py-5 border-b border-white/5">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-500/20">
                <i class="bi bi-palette-fill text-lg sm:text-xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-base sm:text-lg">Tampilan Visual</h3>
                <p class="text-[11px] sm:text-xs text-slate-400">Logo & favicon website</p>
            </div>
        </div>
    </div>

    {{-- Form Content --}}
    <div class="p-4 sm:p-6 space-y-6 sm:space-y-8">
        {{-- Logo Upload Section --}}
        <div class="space-y-3 sm:space-y-4">
            <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
                <i class="bi bi-image-fill text-purple-400"></i>
                Logo Situs
            </label>
            
            <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                {{-- Preview --}}
                <div class="relative group flex-shrink-0">
                    @if($currentLogo)
                        <img src="{{ Storage::url($currentLogo) }}" alt="Logo" class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl object-cover shadow-xl">
                    @else
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white text-3xl sm:text-4xl shadow-xl shadow-purple-500/20 overflow-hidden">
                            <i class="bi bi-image"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 rounded-xl sm:rounded-2xl bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                        <i class="bi bi-camera-fill text-white text-lg sm:text-xl"></i>
                    </div>
                </div>
                
                {{-- Upload Button --}}
                <div class="flex-1 space-y-2 sm:space-y-3 w-full sm:w-auto text-center sm:text-left">
                    <input 
                        type="file" 
                        wire:model="siteLogo"
                        class="hidden"
                        id="logo-upload"
                        accept="image/*"
                    >
                    <label 
                        for="logo-upload"
                        class="inline-flex items-center gap-2 sm:gap-3 px-4 sm:px-6 py-2.5 sm:py-3 glass-card rounded-lg sm:rounded-xl text-xs sm:text-sm font-bold cursor-pointer hover:bg-white/10 transition-all hover:scale-[1.02] active:scale-[0.98]"
                    >
                        <i class="bi bi-cloud-arrow-up-fill text-purple-400 text-base sm:text-lg"></i>
                        Upload Logo
                    </label>
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 text-[10px] sm:text-xs text-slate-500">
                        <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded bg-white/5">PNG</span>
                        <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded bg-white/5">JPG</span>
                        <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded bg-white/5">SVG</span>
                        <span class="text-slate-400">• Max 2MB</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

        {{-- Favicon Upload Section --}}
        <div class="space-y-3 sm:space-y-4">
            <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
                <i class="bi bi-app-indicator text-pink-400"></i>
                Favicon
            </label>
            
            <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                {{-- Preview --}}
                <div class="relative group flex-shrink-0">
                    @if($currentFavicon)
                        <img src="{{ Storage::url($currentFavicon) }}" alt="Favicon" class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl object-cover">
                    @else
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl glass-card flex items-center justify-center text-2xl sm:text-3xl border-2 border-dashed border-white/20">
                            <i class="bi bi-app text-slate-400"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 rounded-lg sm:rounded-xl bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center cursor-pointer">
                        <i class="bi bi-camera-fill text-white"></i>
                    </div>
                </div>
                
                {{-- Upload Button --}}
                <div class="flex-1 space-y-2 sm:space-y-3 w-full sm:w-auto text-center sm:text-left">
                    <input 
                        type="file" 
                        wire:model="siteFavicon"
                        class="hidden"
                        id="favicon-upload"
                        accept="image/*"
                    >
                    <label 
                        for="favicon-upload"
                        class="inline-flex items-center gap-2 sm:gap-3 px-4 sm:px-6 py-2.5 sm:py-3 glass-card rounded-lg sm:rounded-xl text-xs sm:text-sm font-bold cursor-pointer hover:bg-white/10 transition-all hover:scale-[1.02] active:scale-[0.98]"
                    >
                        <i class="bi bi-cloud-arrow-up-fill text-pink-400 text-base sm:text-lg"></i>
                        Upload Favicon
                    </label>
                    <div class="flex flex-wrap items-center justify-center sm:justify-start gap-2 text-[10px] sm:text-xs text-slate-500">
                        <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded bg-white/5">ICO</span>
                        <span class="px-1.5 sm:px-2 py-0.5 sm:py-1 rounded bg-white/5">PNG</span>
                        <span class="text-slate-400">• 32×32 atau 64×64px</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Save Button --}}
        <div class="pt-4 sm:pt-6 border-t border-white/5">
            <button 
                wire:click="save"
                class="btn-premium text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm flex items-center gap-2 sm:gap-3 hover:scale-[1.02] active:scale-[0.98] transition-transform shadow-xl w-full sm:w-auto justify-center"
            >
                <i class="bi bi-check-circle-fill text-base sm:text-lg"></i>
                Simpan Tampilan
            </button>
        </div>
    </div>
</div>
