{{-- Appearance Settings Form - Redesigned & Premium --}}
@props([
    'currentLogo' => null, 
    'currentFavicon' => null,
    'siteLogo' => null,
    'siteFavicon' => null,
    'selectedLogoIcon' => 'sparkles',
    'selectedFaviconIcon' => 'sparkles',
    'iconOptions' => []
])

<div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-200 border border-white/10 relative">
    
    {{-- Decorative Background Blur --}}
    <div class="hidden sm:block absolute top-0 right-0 w-64 h-64 bg-purple-500/10 blur-[80px] rounded-full pointer-events-none -mr-32 -mt-32"></div>
    <div class="hidden sm:block absolute bottom-0 left-0 w-64 h-64 bg-pink-500/10 blur-[80px] rounded-full pointer-events-none -ml-32 -mb-32"></div>

    {{-- Header --}}
    <div class="relative bg-gradient-to-r from-purple-500/10 via-pink-500/10 to-transparent px-6 py-6 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center shadow-lg shadow-purple-500/20 ring-1 ring-white/20">
                <i class="bi bi-palette-fill text-2xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-xl text-white tracking-tight">Tampilan Visual</h3>
                <p class="text-sm text-slate-400 mt-1">Sesuaikan identitas visual website Anda</p>
            </div>
        </div>
    </div>

    <div class="p-6 space-y-8 relative">

        {{-- SECTION: LOGO --}}
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-lg bg-purple-500/10 text-purple-400">
                        <i class="bi bi-image-fill text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm">Logo Situs</h4>
                        <p class="text-xs text-slate-500">Ditampilkan di header dan menu navigasi</p>
                    </div>
                </div>
                @if($currentLogo)
                    <button 
                        @click="$dispatch('swal-confirm-global-confirm', {
                            title: 'Hapus Logo?',
                            message: 'Logo akan dikembalikan ke default. Lanjutkan?',
                            type: 'danger',
                            confirmText: 'Hapus',
                            cancelText: 'Batal',
                            onConfirm: () => { $wire.removeLogo(); }
                        })"
                        class="text-xs text-rose-500 hover:text-rose-400 font-medium px-3 py-1.5 rounded-lg hover:bg-rose-500/10 transition-colors flex items-center gap-1.5"
                    >
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left: Preview --}}
                <div class="lg:col-span-1">
                    <div class="relative w-full aspect-square rounded-2xl overflow-hidden group shadow-2xl shadow-purple-500/10 ring-1 ring-white/10">
                        {{-- Background Art --}}
                        <div class="absolute inset-0 bg-[#0f172a]">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 via-transparent to-pink-500/10"></div>
                            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/20 blur-[50px] rounded-full"></div>
                            <div class="absolute bottom-0 left-0 w-32 h-32 bg-pink-500/20 blur-[50px] rounded-full"></div>
                            
                            {{-- Grid Pattern --}}
                            <div class="absolute inset-0 opacity-20" 
                                style="background-image: radial-gradient(#6366f1 1px, transparent 1px); background-size: 20px 20px;">
                            </div>
                        </div>

                        {{-- Content Container --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6 pb-12">
                            <div class="relative z-10 p-6 rounded-2xl bg-white/5 backdrop-blur-md border border-white/10 shadow-xl transition-transform duration-500 group-hover:scale-105 group-hover:-translate-y-2">
                                @if($selectedLogoIcon === 'none' && ($siteLogo || $currentLogo))
                                    <img src="{{ $siteLogo ? $siteLogo->temporaryUrl() : Storage::url($currentLogo) }}" class="w-16 h-16 sm:w-20 sm:h-20 object-contain drop-shadow-2xl">
                                @else
                                    <div class="text-white drop-shadow-[0_0_15px_rgba(168,85,247,0.5)]">
                                        @if(isset($iconOptions[$selectedLogoIcon]))
                                            <div class="w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center">
                                                {!! $iconOptions[$selectedLogoIcon] !!}
                                            </div>
                                        @else
                                            <i class="bi bi-image text-5xl opacity-20"></i>
                                        @endif
                                    </div>
                                @endif
                                
                                {{-- Shine Effect --}}
                                <div class="absolute inset-0 rounded-2xl ring-1 ring-inset ring-white/20"></div>
                            </div>
                            
                            {{-- Shadow Reflection --}}
                            <div class="absolute bottom-16 w-20 h-4 bg-black/40 blur-md rounded-[100%] transition-all duration-500 group-hover:scale-125 group-hover:opacity-60"></div>
                        </div>
                        
                        {{-- Overlay Label --}}
                        <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Preview</p>
                                    <p class="text-xs font-medium text-white">Tampilan Header</p>
                                </div>
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Controls --}}
                <div class="lg:col-span-2 space-y-4">
                    {{-- Upload Area --}}
                    <div class="relative group">
                        <input type="file" wire:model="siteLogo" id="logo-upload" class="hidden" accept="image/*">
                        <label for="logo-upload" class="block w-full h-32 rounded-xl border-2 border-dashed border-white/10 hover:border-purple-500/50 bg-white/5 hover:bg-white/[0.07] transition-all cursor-pointer flex flex-col items-center justify-center gap-2 group-hover:shadow-[0_0_20px_rgba(168,85,247,0.15)]">
                            <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="bi bi-cloud-arrow-up-fill text-purple-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <p class="text-sm font-bold text-white group-hover:text-purple-300 transition-colors">Klik untuk Upload Logo</p>
                                <p class="text-xs text-slate-500 mt-1">PNG, JPG, SVG (Max 2MB)</p>
                            </div>
                        </label>
                    </div>

                    {{-- Icon Selector --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                                <i class="bi bi-stars text-yellow-400"></i> Fallback Icon
                            </label>
                            <span class="text-[10px] text-slate-500 bg-white/5 px-2 py-0.5 rounded-full">Alternatif jika tidak ada logo</span>
                        </div>
                        
                        <div class="grid grid-cols-6 sm:grid-cols-8 gap-2">
                             @foreach($iconOptions as $key => $svg)
                                <button 
                                    type="button"
                                    wire:click="$set('selectedLogoIcon', '{{ $key }}')"
                                    class="aspect-square rounded-lg flex items-center justify-center transition-all duration-300 relative overflow-hidden {{ $selectedLogoIcon === $key ? 'bg-gradient-to-br from-purple-500 to-pink-500 text-white shadow-lg shadow-purple-500/30 ring-2 ring-white/20 scale-105' : 'bg-white/5 text-slate-400 hover:bg-white/10 hover:text-white hover:scale-105' }}"
                                    @if($key === 'none') title="Default / Logo Image" @endif
                                >
                                    @if($key === 'none' && ($siteLogo || $currentLogo))
                                        <img src="{{ $siteLogo ? $siteLogo->temporaryUrl() : Storage::url($currentLogo) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-5 h-5 {{ $selectedLogoIcon === $key ? 'animate-pulse' : '' }}">
                                            {!! $svg !!}
                                        </div>
                                    @endif

                                    @if($selectedLogoIcon === $key)
                                        <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-white rounded-full shadow-sm z-10">
                                            <i class="bi bi-check text-[8px] text-purple-600 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 font-bold"></i>
                                        </div>
                                    @endif
                                </button>
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

        {{-- SECTION: FAVICON --}}
        <div class="space-y-4">
             <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-lg bg-pink-500/10 text-pink-400">
                        <i class="bi bi-browser-chrome text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-white text-sm">Favicon Browser</h4>
                        <p class="text-xs text-slate-500">Ikon kecil di tab browser</p>
                    </div>
                </div>
                @if($currentFavicon)
                    <button 
                         @click="$dispatch('swal-confirm-global-confirm', {
                            title: 'Hapus Favicon?',
                            message: 'Favicon akan dihapus. Lanjutkan?',
                            type: 'danger',
                            confirmText: 'Hapus',
                            cancelText: 'Batal',
                            onConfirm: () => { $wire.removeFavicon(); }
                        })"
                        class="text-xs text-rose-500 hover:text-rose-400 font-medium px-3 py-1.5 rounded-lg hover:bg-rose-500/10 transition-colors flex items-center gap-1.5"
                    >
                        <i class="bi bi-trash"></i> Hapus
                    </button>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left: Preview --}}
                <div class="lg:col-span-1">
                    <div class="relative w-full aspect-square rounded-2xl overflow-hidden group shadow-2xl shadow-pink-500/10 ring-1 ring-white/10">
                        {{-- Background Art --}}
                        <div class="absolute inset-0 bg-[#0f172a]">
                            <div class="absolute inset-0 bg-gradient-to-tl from-pink-500/10 via-transparent to-purple-500/10"></div>
                            {{-- Animated Orbs --}}
                            <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-pink-500/20 blur-[60px] rounded-full mix-blend-screen animate-pulse-slow"></div>
                            <div class="absolute bottom-1/4 right-1/4 w-40 h-40 bg-purple-500/20 blur-[60px] rounded-full mix-blend-screen animate-pulse-slow" style="animation-delay: 1s"></div>
                        </div>

                        {{-- Centered Browser UI --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6">
                            {{-- Floating Browser Card --}}
                            <div class="w-full max-w-[220px] bg-slate-900/80 backdrop-blur-xl rounded-2xl border border-white/10 shadow-[0_20px_40px_-10px_rgba(0,0,0,0.5)] transform transition-transform duration-500 group-hover:scale-[1.03] group-hover:-translate-y-1">
                                
                                {{-- Window Controls --}}
                                <div class="px-4 py-3 border-b border-white/5 flex gap-2">
                                    <div class="w-2.5 h-2.5 rounded-full bg-rose-500/80 shadow-[0_0_10px_rgba(244,63,94,0.4)]"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500/80 shadow-[0_0_10px_rgba(245,158,11,0.4)]"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500/80 shadow-[0_0_10px_rgba(16,185,129,0.4)]"></div>
                                </div>
                                
                                {{-- Tab Content --}}
                                <div class="p-4 space-y-3">
                                    {{-- Active Tab Simulation --}}
                                    <div class="bg-gradient-to-b from-white/10 to-white/5 rounded-xl p-3 flex items-center gap-3 ring-1 ring-white/10 shadow-lg relative overflow-hidden">
                                        {{-- Glow behind icon --}}
                                        <div class="absolute left-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-pink-500/20 blur-xl rounded-full"></div>

                                        {{-- Favicon Slot --}}
                                        <div class="relative w-10 h-10 flex-shrink-0 flex items-center justify-center bg-[#0f172a] rounded-lg shadow-inner border border-white/10 z-10">
                                            @if($selectedFaviconIcon === 'none' && ($siteFavicon || $currentFavicon))
                                                <img src="{{ $siteFavicon ? $siteFavicon->temporaryUrl() : Storage::url($currentFavicon) }}" class="w-6 h-6 object-contain drop-shadow-md">
                                            @else
                                                <div class="w-6 h-6 flex items-center justify-center text-pink-400">
                                                    @if(isset($iconOptions[$selectedFaviconIcon]))
                                                        {!! $iconOptions[$selectedFaviconIcon] !!}
                                                    @else
                                                        <div class="w-2 h-2 rounded-full bg-slate-600"></div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Fake Title --}}
                                        <div class="space-y-1.5 flex-1 z-10">
                                            <div class="h-2 w-20 bg-white/40 rounded-full"></div>
                                            <div class="h-1.5 w-12 bg-white/20 rounded-full"></div>
                                        </div>
                                    </div>

                                    {{-- Address Bar Line --}}
                                    <div class="mx-2 h-1.5 bg-white/5 rounded-full w-2/3"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Label --}}
                        <div class="absolute bottom-4 inset-x-0 text-center">
                            <span class="text-[10px] font-bold text-white/40 uppercase tracking-widest">Browser Tab</span>
                        </div>
                    </div>
                </div>

                {{-- Right: Controls --}}
                <div class="lg:col-span-2 space-y-4">
                    {{-- Upload Area --}}
                    <div class="relative group">
                        <input type="file" wire:model="siteFavicon" id="favicon-upload" class="hidden" accept="image/*">
                        <label for="favicon-upload" class="block w-full h-32 rounded-xl border-2 border-dashed border-white/10 hover:border-pink-500/50 bg-white/5 hover:bg-white/[0.07] transition-all cursor-pointer flex flex-col items-center justify-center gap-2 group-hover:shadow-[0_0_20px_rgba(236,72,153,0.15)]">
                            <div class="w-10 h-10 rounded-full bg-pink-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="bi bi-cloud-arrow-up-fill text-pink-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <p class="text-sm font-bold text-white group-hover:text-pink-300 transition-colors">Klik untuk Upload Favicon</p>
                                <p class="text-xs text-slate-500 mt-1">ICO, PNG (32x32px)</p>
                            </div>
                        </label>
                    </div>

                    {{-- Icon Selector --}}
                    <div>
                         <div class="flex items-center justify-between mb-3">
                            <label class="text-xs font-bold text-slate-400 uppercase tracking-wider flex items-center gap-1.5">
                                <i class="bi bi-stars text-pink-400"></i> Fallback Icon
                            </label>
                        </div>
                        <div class="grid grid-cols-6 sm:grid-cols-8 gap-2">
                             @foreach($iconOptions as $key => $svg)
                                <button 
                                    type="button"
                                    wire:click="$set('selectedFaviconIcon', '{{ $key }}')"
                                    class="aspect-square rounded-lg flex items-center justify-center transition-all duration-300 relative overflow-hidden {{ $selectedFaviconIcon === $key ? 'bg-gradient-to-br from-pink-500 to-rose-500 text-white shadow-lg shadow-pink-500/30 ring-2 ring-white/20 scale-105' : 'bg-white/5 text-slate-400 hover:bg-white/10 hover:text-white hover:scale-105' }}"
                                    @if($key === 'none') title="Default / Favicon Image" @endif
                                >
                                    @if($key === 'none' && ($siteFavicon || $currentFavicon))
                                        <img src="{{ $siteFavicon ? $siteFavicon->temporaryUrl() : Storage::url($currentFavicon) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-5 h-5 {{ $selectedFaviconIcon === $key ? 'animate-pulse' : '' }}">
                                            {!! $svg !!}
                                        </div>
                                    @endif

                                    @if($selectedFaviconIcon === $key)
                                        <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-white rounded-full shadow-sm z-10">
                                            <i class="bi bi-check text-[8px] text-pink-600 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 font-bold"></i>
                                        </div>
                                    @endif
                                </button>
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Save Action --}}
        <div class="pt-6 border-t border-white/5">
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: 'Simpan Perubahan?',
                    message: 'Logo dan Favicon baru akan diterapkan ke seluruh halaman website.',
                    type: 'info',
                    confirmText: 'Simpan Sekatrang',
                    cancelText: 'Batal',
                    onConfirm: () => { $wire.save(); }
                })"
                class="w-full sm:w-auto relative group overflow-hidden rounded-xl px-8 py-4 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-bold shadow-2xl hover:shadow-[0_0_30px_rgba(168,85,247,0.4)] transition-all hover:-translate-y-1 active:translate-y-0"
            >
                <div class="relative z-10 flex items-center justify-center gap-3">
                    <i class="bi bi-check-circle-fill text-xl"></i>
                    <span>Simpan Tampilan</span>
                </div>
                {{-- Shine Effect --}}
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
            </button>
        </div>

    </div>
</div>
