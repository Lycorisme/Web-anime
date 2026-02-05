{{-- Appearance Settings Form - Responsive --}}
@props([
    'currentLogo' => null, 
    'currentFavicon' => null,
    'siteLogo' => null,
    'siteFavicon' => null,
    'selectedLogoIcon' => 'sparkles',
    'selectedFaviconIcon' => 'sparkles',
    'iconOptions' => []
])

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
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
                    <i class="bi bi-image-fill text-purple-400"></i>
                    Logo Situs
                </label>
                @if($currentLogo)
                    <button 
                        @click="$dispatch('swal-confirm-global-confirm', {
                            title: 'Hapus Logo?',
                            message: 'Logo akan dihapus dan kembali ke tampilan default. Aksi ini tidak dapat dibatalkan.',
                            type: 'danger',
                            confirmText: 'Ya, Hapus',
                            cancelText: 'Batal',
                            onConfirm: () => {
                                $wire.removeLogo();
                            }
                        })"
                        class="text-[10px] sm:text-xs text-red-500 hover:text-red-400 font-bold flex items-center gap-1 transition-colors"
                    >
                        <i class="bi bi-trash"></i> Hapus Logo
                    </button>
                @endif
            </div>
            
            <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                {{-- Preview --}}
                <div class="relative group flex-shrink-0">
                    @if($siteLogo)
                        <img src="{{ $siteLogo->temporaryUrl() }}" alt="Preview Logo" class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl object-cover shadow-xl bg-white/5 ring-2 ring-purple-500">
                    @elseif($currentLogo)
                        <img src="{{ Storage::url($currentLogo) }}" alt="Logo" class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl object-cover shadow-xl bg-white/5">
                    @else
                        <div class="w-20 h-20 sm:w-24 sm:h-24 rounded-xl sm:rounded-2xl bg-gradient-to-r from-purple-500 to-pink-500 flex items-center justify-center text-white shadow-xl shadow-purple-500/20 overflow-hidden">
                            @if(isset($iconOptions[$selectedLogoIcon]))
                                <div class="w-10 h-10 sm:w-12 sm:h-12">
                                    {!! $iconOptions[$selectedLogoIcon] !!}
                                </div>
                            @else
                                <i class="bi bi-image text-3xl sm:text-4xl"></i>
                            @endif
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

        
        {{-- Logo Icon Selection --}}
        <div class="space-y-3 sm:space-y-4">
            <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
                <i class="bi bi-stars text-yellow-400"></i>
                Logo Alternatif
            </label>
            <p class="text-[10px] sm:text-xs text-slate-500">
                Icon ini akan ditampilkan jika Anda belum mengupload logo gambar atau menghapusnya.
            </p>
            
            <div class="grid grid-cols-6 sm:grid-cols-8 gap-2 sm:gap-3">
                @foreach($iconOptions as $key => $svg)
                    @if($key === 'none')
                        <button 
                            type="button"
                            wire:click="$set('selectedLogoIcon', 'none')"
                            class="aspect-square rounded-lg flex items-center justify-center transition-all duration-200 overflow-hidden {{ $selectedLogoIcon === 'none' ? 'bg-gradient-to-br from-purple-500 to-pink-500 text-white shadow-lg shadow-purple-500/25 scale-105 ring-2 ring-purple-500/50' : 'bg-white/5 text-slate-400 hover:bg-white/10 hover:scale-105' }}"
                            title="Gunakan Logo Situs"
                        >
                            @if($siteLogo)
                                <img src="{{ $siteLogo->temporaryUrl() }}" class="w-full h-full object-cover" alt="Preview">
                            @elseif($currentLogo)
                                <img src="{{ Storage::url($currentLogo) }}" class="w-full h-full object-cover" alt="Logo">
                            @else
                                <div class="w-5 h-5 sm:w-6 sm:h-6">
                                    {!! $svg !!}
                                </div>
                            @endif
                        </button>
                    @else
                        <button 
                            type="button"
                            wire:click="$set('selectedLogoIcon', '{{ $key }}')"
                            class="aspect-square rounded-lg flex items-center justify-center transition-all duration-200 {{ $selectedLogoIcon === $key ? 'bg-gradient-to-br from-purple-500 to-pink-500 text-white shadow-lg shadow-purple-500/25 scale-105 ring-2 ring-purple-500/50' : 'bg-white/5 text-slate-400 hover:bg-white/10 hover:scale-105' }}"
                        >
                            <div class="w-5 h-5 sm:w-6 sm:h-6">
                                {!! $svg !!}
                            </div>
                        </button>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

        {{-- Favicon Upload Section --}}
        <div class="space-y-3 sm:space-y-4">
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
                    <i class="bi bi-app-indicator text-pink-400"></i>
                    Favicon
                </label>
                @if($currentFavicon)
                    <button 
                        @click="$dispatch('swal-confirm-global-confirm', {
                            title: 'Hapus Favicon?',
                            message: 'Favicon akan dihapus dan kembali ke tampilan default. Aksi ini tidak dapat dibatalkan.',
                            type: 'danger',
                            confirmText: 'Ya, Hapus',
                            cancelText: 'Batal',
                            onConfirm: () => {
                                $wire.removeFavicon();
                            }
                        })"
                        class="text-[10px] sm:text-xs text-red-500 hover:text-red-400 font-bold flex items-center gap-1 transition-colors"
                    >
                        <i class="bi bi-trash"></i> Hapus Favicon
                    </button>
                @endif
            </div>
            
            <div class="flex flex-col sm:flex-row items-center gap-4 sm:gap-6">
                {{-- Preview --}}
                <div class="relative group flex-shrink-0">
                    @if($siteFavicon)
                        <img src="{{ $siteFavicon->temporaryUrl() }}" alt="Preview Favicon" class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl object-cover bg-white/5 ring-2 ring-pink-500">
                    @elseif($currentFavicon)
                        <img src="{{ Storage::url($currentFavicon) }}" alt="Favicon" class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl object-cover bg-white/5">
                    @else
                        <div class="w-16 h-16 sm:w-20 sm:h-20 rounded-lg sm:rounded-xl glass-card flex items-center justify-center border-2 border-dashed border-white/20">
                            @if(isset($iconOptions[$selectedFaviconIcon]))
                                <div class="w-8 h-8 sm:w-10 sm:h-10 text-slate-400">
                                    {!! $iconOptions[$selectedFaviconIcon] !!}
                                </div>
                            @else
                                <i class="bi bi-app text-slate-400 text-2xl sm:text-3xl"></i>
                            @endif
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

        {{-- Favicon Icon Selection --}}
        <div class="space-y-3 sm:space-y-4">
            <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
                <i class="bi bi-stars text-pink-400"></i>
                Favicon Alternatif
            </label>
            <p class="text-[10px] sm:text-xs text-slate-500">
                Icon ini akan ditampilkan jika Anda belum mengupload favicon gambar atau menghapusnya.
            </p>
            
            <div class="grid grid-cols-6 sm:grid-cols-8 gap-2 sm:gap-3">
                @foreach($iconOptions as $key => $svg)
                    @if($key === 'none')
                        <button 
                            type="button"
                            wire:click="$set('selectedFaviconIcon', 'none')"
                            class="aspect-square rounded-lg flex items-center justify-center transition-all duration-200 overflow-hidden {{ $selectedFaviconIcon === 'none' ? 'bg-gradient-to-br from-pink-500 to-rose-500 text-white shadow-lg shadow-pink-500/25 scale-105 ring-2 ring-pink-500/50' : 'bg-white/5 text-slate-400 hover:bg-white/10 hover:scale-105' }}"
                            title="Gunakan Favicon Situs"
                        >
                            @if($siteFavicon)
                                <img src="{{ $siteFavicon->temporaryUrl() }}" class="w-full h-full object-cover" alt="Preview">
                            @elseif($currentFavicon)
                                <img src="{{ Storage::url($currentFavicon) }}" class="w-full h-full object-cover" alt="Favicon">
                            @else
                                <div class="w-5 h-5 sm:w-6 sm:h-6">
                                    {!! $svg !!}
                                </div>
                            @endif
                        </button>
                    @else
                        <button 
                            type="button"
                            wire:click="$set('selectedFaviconIcon', '{{ $key }}')"
                            class="aspect-square rounded-lg flex items-center justify-center transition-all duration-200 {{ $selectedFaviconIcon === $key ? 'bg-gradient-to-br from-pink-500 to-rose-500 text-white shadow-lg shadow-pink-500/25 scale-105 ring-2 ring-pink-500/50' : 'bg-white/5 text-slate-400 hover:bg-white/10 hover:scale-105' }}"
                        >
                            <div class="w-5 h-5 sm:w-6 sm:h-6">
                                {!! $svg !!}
                            </div>
                        </button>
                    @endif
                @endforeach
            </div>
        </div>

        {{-- Save Button with Confirmation --}}
        <div class="pt-4 sm:pt-6 border-t border-white/5">
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: 'Simpan Tampilan Visual?',
                    message: 'Perubahan logo dan favicon akan langsung diterapkan ke seluruh website. Pastikan gambar yang diupload sudah benar.',
                    type: 'info',
                    confirmText: 'Simpan',
                    cancelText: 'Batal',
                    onConfirm: () => {
                        $wire.save();
                    }
                })"
                class="btn-premium text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm flex items-center gap-2 sm:gap-3 hover:scale-[1.02] active:scale-[0.98] transition-transform shadow-xl w-full sm:w-auto justify-center"
            >
                <i class="bi bi-check-circle-fill text-base sm:text-lg"></i>
                Simpan Tampilan
            </button>
        </div>
    </div>
</div>

