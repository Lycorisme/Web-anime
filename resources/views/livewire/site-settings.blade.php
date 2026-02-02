<div>
    {{-- Page Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        {{-- Page Header --}}
        <div x-show="true"
             x-transition:enter="transition ease-out duration-500 delay-100"
             x-transition:enter-start="opacity-0 translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             class="mb-12">
            <x-settings.page-header />
        </div>

        {{-- Success Message --}}
        <div class="mb-8">
            <x-settings.success-alert :show="$showSuccess" :message="$successMessage" />
        </div>

        <form wire:submit="save">
            {{-- Main Form Container - The grid will be handled inside general-form for better modularity --}}
            <div x-show="true"
                 x-transition:enter="transition ease-out duration-500 delay-200"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                
                <x-settings.general-form 
                    :siteName="$siteName"
                    :siteTagline="$siteTagline ?? ''"
                    :siteDescription="$siteDescription ?? ''" 
                    :siteIcon="$siteIcon ?? ''"
                />

            </div>

            {{-- Bulk Action Bar --}}
            <div class="fixed bottom-10 left-1/2 -translate-x-1/2 z-50 transition-all duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)] transform opacity-0 translate-y-12 pointer-events-none"
                 wire:dirty.class="opacity-100 translate-y-0 pointer-events-auto"
                 wire:dirty.remove.class="opacity-0 translate-y-12 pointer-events-none">
                
                {{-- Main Container with Glass and Gradient Border --}}
                <div class="relative group">
                    {{-- Glow Effect --}}
                    <div class="absolute -inset-1 bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 rounded-full blur opacity-30 group-hover:opacity-60 transition duration-500 animate-pulse"></div>
                    
                    {{-- Card Content --}}
                    <div class="relative flex items-center gap-6 p-2 pr-2 pl-6 rounded-full bg-white/90 dark:bg-[#0f172a]/90 backdrop-blur-2xl border border-white/20 shadow-[0_8px_30px_rgb(0,0,0,0.12)] dark:shadow-[0_8px_30px_rgb(0,0,0,0.3)] ring-1 ring-black/5 dark:ring-white/10 scale-100 hover:scale-[1.02] transition-transform duration-300">
                        
                        {{-- Text Indicator --}}
                        <div class="flex items-center gap-3">
                            <div class="relative flex h-3 w-3">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-rose-400 opacity-75"></span>
                              <span class="relative inline-flex rounded-full h-3 w-3 bg-gradient-to-r from-rose-500 to-pink-600"></span>
                            </div>
                            <span class="text-sm font-bold bg-clip-text text-transparent bg-gradient-to-r from-slate-700 to-slate-500 dark:from-white dark:to-slate-300 whitespace-nowrap">
                                Perubahan terdeteksi
                            </span>
                        </div>

                        {{-- Divider --}}
                        <div class="h-6 w-px bg-gradient-to-b from-transparent via-slate-300 dark:via-slate-600 to-transparent"></div>

                        {{-- Actions --}}
                        <div class="flex items-center gap-2">
                            {{-- Cancel Button --}}
                            <button 
                                type="button"
                                wire:click="cancel"
                                class="px-5 py-2.5 rounded-full text-xs font-bold text-slate-600 dark:text-slate-300 hover:bg-slate-100 dark:hover:bg-white/10 hover:text-rose-500 dark:hover:text-rose-400 transition-all duration-300"
                            >
                                Batal
                            </button>

                            {{-- Save Button --}}
                            <button 
                                type="submit"
                                class="group/btn relative px-6 py-2.5 rounded-full overflow-hidden shadow-lg shadow-indigo-500/30 dark:shadow-indigo-500/50 hover:shadow-indigo-500/60 transition-all duration-300 active:scale-95"
                            >
                                <div class="absolute inset-0 bg-gradient-to-r from-violet-600 via-fuchsia-600 to-pink-600 transition-all duration-300 group-hover/btn:scale-110"></div>
                                <div class="absolute inset-0 bg-white/20 group-hover/btn:opacity-0 transition-opacity duration-300"></div>
                                
                                <span class="relative flex items-center gap-2 text-xs font-bold text-white uppercase tracking-wider">
                                    <span wire:loading.remove wire:target="save">Simpan</span>
                                    <span wire:loading wire:target="save" class="flex items-center gap-2">
                                         <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                        </svg>
                                        Saving
                                    </span>
                                    <i class="bi bi-arrow-right group-hover/btn:translate-x-1 transition-transform" wire:loading.remove></i>
                                </span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        {{-- Footer --}}
        <div class="mt-24">
            <x-settings.footer />
        </div>
    </div>
</div>
