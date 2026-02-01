{{-- General Settings Form Section - Premium Style (Light/Dark) --}}
@props(['siteName' => '', 'siteTagline' => '', 'siteDescription' => ''])

<div class="rounded-[1.5rem] overflow-hidden shadow-2xl transition-all duration-300"
     :class="darkMode ? 'glass-card' : 'bg-white border border-slate-200'">
    
    {{-- Section Header --}}
    <div class="p-6 border-b flex items-center gap-4" 
         :class="darkMode ? 'border-white/5' : 'border-slate-200'">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-purple-500 to-blue-600 shadow-lg shadow-purple-500/20">
            <i class="bi bi-globe-americas text-white text-xl"></i>
        </div>
        <div>
            <h2 class="font-bold text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">
                Pengaturan Umum
            </h2>
            <p class="text-sm" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                Informasi dasar tentang portal berita Anda
            </p>
        </div>
    </div>

    {{-- Form Content --}}
    <div class="p-6 space-y-6">
        
        {{-- Row: Nama Portal & Tagline --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Nama Portal --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold" :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                    Nama Portal <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    wire:model="siteName"
                    placeholder="Contoh: BTIKP PORTAL"
                    class="w-full px-4 py-3.5 rounded-xl border transition-all duration-300 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500/50 focus:outline-none"
                    :class="darkMode 
                        ? 'bg-[#111827] border-white/10 text-white placeholder:text-slate-500' 
                        : 'bg-slate-50 border-slate-200 text-slate-900 placeholder:text-slate-400'"
                >
                @error('siteName')
                    <p class="text-rose-500 dark:text-rose-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tagline --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold" :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                    Tagline
                </label>
                <input 
                    type="text" 
                    wire:model="siteTagline"
                    placeholder="Contoh: Informasi Terkini dan Terpercaya"
                    class="w-full px-4 py-3.5 rounded-xl border transition-all duration-300 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500/50 focus:outline-none"
                    :class="darkMode 
                        ? 'bg-[#111827] border-white/10 text-white placeholder:text-slate-500' 
                        : 'bg-slate-50 border-slate-200 text-slate-900 placeholder:text-slate-400'"
                >
            </div>
        </div>

        {{-- Deskripsi Website --}}
        <div class="space-y-2">
            <label class="block text-sm font-semibold" :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                Deskripsi Website
            </label>
            <textarea 
                wire:model="siteDescription"
                rows="4"
                placeholder="Deskripsi singkat tentang portal berita Anda..."
                class="w-full px-4 py-3.5 rounded-xl border transition-all duration-300 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500/50 focus:outline-none resize-none"
                :class="darkMode 
                    ? 'bg-[#111827] border-white/10 text-white placeholder:text-slate-500' 
                    : 'bg-slate-50 border-slate-200 text-slate-900 placeholder:text-slate-400'"
            ></textarea>
            <p class="text-xs text-slate-500 flex items-center gap-1.5">
                <i class="bi bi-info-circle"></i>
                Deskripsi ini akan digunakan untuk SEO dan meta description
            </p>
        </div>

        {{-- Row: Logo Utama & Favicon --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Logo Utama --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold" :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                    Logo Utama
                </label>
                <div class="relative group">
                    <div class="flex flex-col items-center justify-center w-full h-36 rounded-xl border-2 border-dashed transition-all duration-300 cursor-pointer group-hover:border-teal-500/50"
                         :class="darkMode 
                            ? 'bg-[#111827] border-slate-600 group-hover:bg-[#1a2332]' 
                            : 'bg-slate-50 border-slate-300 hover:bg-slate-100'">
                        <i class="bi bi-cloud-arrow-up text-3xl mb-2 group-hover:text-teal-500 transition-colors"
                           :class="darkMode ? 'text-slate-500 group-hover:text-teal-400' : 'text-slate-400'"></i>
                        <p class="text-sm transition-colors"
                           :class="darkMode ? 'text-slate-400 group-hover:text-slate-300' : 'text-slate-500 group-hover:text-slate-800'">
                            Klik untuk upload logo
                        </p>
                        <p class="text-xs mt-1" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                            PNG, JPG max 2MB
                        </p>
                    </div>
                    <input type="file" wire:model="siteLogo" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>

            {{-- Favicon --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold" :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                    Favicon
                </label>
                <div class="relative group">
                    <div class="flex flex-col items-center justify-center w-full h-36 rounded-xl border-2 border-dashed transition-all duration-300 cursor-pointer group-hover:border-teal-500/50"
                         :class="darkMode 
                            ? 'bg-[#111827] border-slate-600 group-hover:bg-[#1a2332]' 
                            : 'bg-slate-50 border-slate-300 hover:bg-slate-100'">
                        <i class="bi bi-image text-3xl mb-2 group-hover:text-teal-500 transition-colors"
                           :class="darkMode ? 'text-slate-500 group-hover:text-teal-400' : 'text-slate-400'"></i>
                        <p class="text-sm transition-colors"
                           :class="darkMode ? 'text-slate-400 group-hover:text-slate-300' : 'text-slate-500 group-hover:text-slate-800'">
                            Klik untuk upload favicon
                        </p>
                        <p class="text-xs mt-1" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                            ICO, PNG 32x32 atau 64x64
                        </p>
                    </div>
                    <input type="file" wire:model="siteFavicon" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>
        </div>
    </div>
</div>
