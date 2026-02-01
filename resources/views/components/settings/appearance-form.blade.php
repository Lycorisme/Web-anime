{{-- Appearance Settings Form Section --}}
@props(['siteName', 'siteIcon', 'siteLogo', 'currentLogo'])

<div class="rounded-2xl p-6 transition-all duration-300"
     :class="darkMode ? 'glass-card' : 'bg-white/80 backdrop-blur-xl border border-slate-200 shadow-xl'">
    
    {{-- Section Header --}}
    <div class="flex items-center gap-3 mb-6 pb-4 border-b"
         :class="darkMode ? 'border-white/10' : 'border-slate-200'">
        <div class="p-2 rounded-lg bg-gradient-to-br from-blue-500 to-purple-600">
            <i class="bi bi-palette-fill text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-space font-bold text-lg"
                :class="darkMode ? 'text-white' : 'text-slate-800'">
                Tampilan Website
            </h2>
            <p class="text-sm"
               :class="darkMode ? 'text-slate-400' : 'text-slate-600'">
                Atur nama, logo, dan tampilan sidebar
            </p>
        </div>
    </div>

    <div class="space-y-5">
        {{-- Site Name --}}
        <div>
            <label class="block text-sm font-medium mb-2"
                   :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                <i class="bi bi-type mr-1"></i>
                Nama Website
            </label>
            <input 
                type="text" 
                wire:model="siteName"
                placeholder="Masukkan nama website..."
                class="w-full px-4 py-3 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-purple-500 focus:outline-none"
                :class="darkMode 
                    ? 'bg-white/5 border border-white/10 text-white placeholder:text-slate-500' 
                    : 'bg-slate-50 border border-slate-200 text-slate-800 placeholder:text-slate-400'"
            >
            @error('siteName')
                <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- Site Icon --}}
        <div>
            <label class="block text-sm font-medium mb-2"
                   :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                <i class="bi bi-lightning-charge mr-1"></i>
                Icon Default (Bootstrap Icons)
            </label>
            <div class="flex items-center gap-4">
                <input 
                    type="text" 
                    wire:model.live="siteIcon"
                    placeholder="bi bi-lightning-charge-fill"
                    class="flex-1 px-4 py-3 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-purple-500 focus:outline-none"
                    :class="darkMode 
                        ? 'bg-white/5 border border-white/10 text-white placeholder:text-slate-500' 
                        : 'bg-slate-50 border border-slate-200 text-slate-800 placeholder:text-slate-400'"
                >
                {{-- Icon Preview --}}
                <div class="w-12 h-12 rounded-xl btn-premium flex items-center justify-center">
                    <i class="{{ $siteIcon }} text-white text-xl"></i>
                </div>
            </div>
            <p class="text-xs mt-2"
               :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                Lihat daftar icon di <a href="https://icons.getbootstrap.com/" target="_blank" class="text-purple-400 hover:underline">Bootstrap Icons</a>
            </p>
        </div>

        {{-- Logo Upload --}}
        <x-settings.logo-upload :currentLogo="$currentLogo" :siteLogo="$siteLogo" />
    </div>
</div>
