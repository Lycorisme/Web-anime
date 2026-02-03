{{-- General Settings - Colorful Premium Layout --}}
@props(['siteName' => '', 'siteTagline' => '', 'siteDescription' => '', 'siteIcon' => '', 'activeTheme' => 'lycoris_cyber', 'themePresets' => [], 'customColors' => [], 'customizableColors' => []])

<div class="space-y-8">
    
    {{-- Section 1: Core Identity & Assets --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Left Column: Identity Form --}}
        <div class="lg:col-span-2 relative group">
            <div class="absolute -inset-0.5 bg-theme-gradient-btn rounded-[2rem] blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
            
            <div class="relative h-full rounded-[2rem] p-8 border transition-all duration-300 backdrop-blur-xl"
                 :class="darkMode ? 'bg-[#0f172a]/80 border-white/5' : 'bg-white/80 border-slate-200'">
                
                {{-- Decoration --}}
                <div class="absolute top-0 right-0 p-8 opacity-10 pointer-events-none">
                    <i class="bi bi-globe-americas text-9xl text-theme-primary transform rotate-12"></i>
                </div>

                <div class="relative z-10">
                    <div class="mb-8 flex items-center gap-4">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center bg-theme-gradient-btn shadow-lg shadow-theme-primary">
                            <i class="bi bi-fingerprint text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold" :class="darkMode ? 'text-white' : 'text-slate-800'">
                                Identitas Utama
                            </h3>
                            <p class="text-sm opacity-60" :class="darkMode ? 'text-slate-300' : 'text-slate-500'">
                                Informasi dasar website anda.
                            </p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- Name & Tagline --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider ml-1 text-theme-primary">
                                    Website Name
                                </label>
                                <input 
                                    type="text" 
                                    wire:model="siteName"
                                    class="w-full px-5 py-4 rounded-xl border-2 transition-all duration-300 outline-none font-bold text-lg"
                                    :class="darkMode 
                                        ? 'bg-[#1e293b]/50 border-white/10 focus:border-theme-primary text-white placeholder:text-slate-600' 
                                        : 'bg-slate-50 border-slate-200 focus:border-theme-primary text-slate-900 placeholder:text-slate-400'"
                                    placeholder="Nama Brand"
                                >
                                @error('siteName') <span class="text-rose-500 text-xs ml-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold uppercase tracking-wider ml-1 text-theme-secondary">
                                    Tagline
                                </label>
                                <input 
                                    type="text" 
                                    wire:model="siteTagline"
                                    class="w-full px-5 py-4 rounded-xl border-2 transition-all duration-300 outline-none font-bold text-lg"
                                    :class="darkMode 
                                        ? 'bg-[#1e293b]/50 border-white/10 focus:border-theme-secondary text-white placeholder:text-slate-600' 
                                        : 'bg-slate-50 border-slate-200 focus:border-theme-secondary text-slate-900 placeholder:text-slate-400'"
                                    placeholder="Slogan Website"
                                >
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="space-y-2">
                            <label class="text-xs font-bold uppercase tracking-wider ml-1 text-theme-accent">
                                Description
                            </label>
                            <textarea 
                                wire:model="siteDescription"
                                rows="3"
                                class="w-full px-5 py-4 rounded-xl border-2 transition-all duration-300 outline-none font-medium text-sm leading-relaxed resize-none"
                                :class="darkMode 
                                    ? 'bg-[#1e293b]/50 border-white/10 focus:border-theme-accent text-white placeholder:text-slate-600' 
                                    : 'bg-slate-50 border-slate-200 focus:border-theme-accent text-slate-900 placeholder:text-slate-400'"
                                placeholder="Jelaskan deskripsi website untuk SEO..."
                            ></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Right Column: Assets & Icon --}}
        <div class="lg:col-span-1 space-y-6">
            
            {{-- Assets Card --}}
            <div class="relative group">
                <div class="absolute -inset-0.5 bg-theme-gradient rounded-[2rem] blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                
                <div class="relative rounded-[2rem] p-6 border transition-all duration-300 backdrop-blur-xl"
                     :class="darkMode ? 'bg-[#0f172a]/80 border-white/5' : 'bg-white/80 border-slate-200'">
                    
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-theme-gradient shadow-lg shadow-theme-primary">
                            <i class="bi bi-images text-white"></i>
                        </div>
                        <h4 class="font-bold text-sm" :class="darkMode ? 'text-white' : 'text-slate-800'">Visual Assets</h4>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        {{-- Logo --}}
                        <div class="text-center group/item cursor-pointer">
                            <div class="relative w-full aspect-square rounded-2xl border-2 border-dashed flex items-center justify-center transition-all duration-300 overflow-hidden mb-2"
                                 :class="darkMode ? 'border-pink-500/20 hover:border-pink-500 bg-[#1e293b]/50' : 'border-slate-200 hover:border-pink-500 bg-slate-50'">
                                <i class="bi bi-image text-2xl text-theme-accent group-hover/item:scale-110 transition-transform"></i>
                                <input type="file" wire:model="siteLogo" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                            </div>
                            <span class="text-[10px] font-bold uppercase tracking-wider opacity-60" :class="darkMode ? 'text-white' : 'text-slate-800'">Logo</span>
                        </div>

                        {{-- Favicon --}}
                        <div class="text-center group/item cursor-pointer">
                            <div class="relative w-full aspect-square rounded-2xl border-2 border-dashed flex items-center justify-center transition-all duration-300 overflow-hidden mb-2"
                                 :class="darkMode ? 'border-purple-500/20 hover:border-purple-500 bg-[#1e293b]/50' : 'border-slate-200 hover:border-purple-500 bg-slate-50'">
                                <i class="bi bi-box-seam text-2xl text-theme-secondary group-hover/item:scale-110 transition-transform"></i>
                                <input type="file" wire:model="siteFavicon" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full z-10">
                            </div>
                             <span class="text-[10px] font-bold uppercase tracking-wider opacity-60" :class="darkMode ? 'text-white' : 'text-slate-800'">Favicon</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Icon Input --}}
            <div class="relative group">
                <div class="absolute -inset-0.5 bg-theme-gradient-btn rounded-[2rem] blur opacity-20 group-hover:opacity-40 transition duration-500"></div>
                
                <div class="relative rounded-[2rem] p-6 border transition-all duration-300 backdrop-blur-xl"
                     :class="darkMode ? 'bg-[#0f172a]/80 border-white/5' : 'bg-white/80 border-slate-200'">
                    
                    <div class="space-y-2">
                        <label class="text-xs font-bold uppercase tracking-wider ml-1 text-theme-primary">
                            Menu Icon (Bootstrap)
                        </label>
                        <div class="flex items-center gap-3">
                            <input 
                                type="text" 
                                wire:model.live="siteIcon"
                                class="flex-1 px-4 py-3 rounded-xl border-2 transition-all duration-300 outline-none font-mono text-sm"
                                :class="darkMode 
                                    ? 'bg-[#1e293b]/50 border-emerald-500/20 focus:border-emerald-500 text-white placeholder:text-slate-600' 
                                    : 'bg-slate-50 border-slate-200 focus:border-emerald-500 text-slate-900 placeholder:text-slate-400'"
                                placeholder="bi bi-activity"
                            >
                            <div class="w-12 h-12 rounded-xl flex items-center justify-center border-2 transition-colors"
                                 :class="darkMode ? 'border-emerald-500/20 bg-[#1e293b]/50' : 'border-slate-200 bg-slate-50'">
                                 @if($siteIcon)
                                    <i class="{{ $siteIcon }} text-xl text-theme-primary"></i>
                                 @else
                                    <i class="bi bi-question text-xl opacity-30"></i>
                                 @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Section 2: Theme Library --}}
    <x-settings.theme-selector 
        :activeTheme="$activeTheme" 
        :themePresets="$themePresets" 
    />

    {{-- Section 3: Color Customizer --}}
    <x-settings.color-customizer 
        :customColors="$customColors"
        :customizableColors="$customizableColors"
        :activeTheme="$activeTheme"
    />

</div>

