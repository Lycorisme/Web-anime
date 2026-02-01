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

            {{-- Floating Action Bar --}}
            <div class="fixed bottom-6 right-6 z-50"
                 x-show="true"
                 x-transition:enter="transition ease-out duration-500 delay-500"
                 x-transition:enter-start="opacity-0 translate-y-10 scale-90"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100">
                <div class="bg-white/80 dark:bg-[#1f2937]/80 backdrop-blur-xl border border-slate-200 dark:border-white/10 shadow-2xl shadow-indigo-500/20 rounded-2xl p-2 flex items-center gap-2">
                    <a href="/"
                       wire:navigate
                       class="w-12 h-12 flex items-center justify-center rounded-xl text-slate-500 hover:bg-slate-100 dark:hover:bg-white/5 transition-colors"
                       title="Batal">
                        <i class="bi bi-x-lg text-lg"></i>
                    </a>
                    <button 
                        type="submit"
                        class="px-6 h-12 rounded-xl font-bold text-sm bg-gradient-to-r from-indigo-600 to-violet-600 text-white shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 hover:scale-105 active:scale-95 transition-all duration-300 flex items-center gap-2"
                    >
                        <span wire:loading.remove wire:target="save">Simpan Perubahan</span>
                        <span wire:loading wire:target="save">...</span>
                        <i class="bi bi-check-lg text-lg" wire:loading.remove></i>
                    </button>
                </div>
            </div>
        </form>
        
        {{-- Footer --}}
        <div class="mt-24">
            <x-settings.footer />
        </div>
    </div>
</div>
