{{-- General Settings Form Section - Premium Style (Light/Dark) --}}
@props(['siteName' => '', 'siteTagline' => '', 'siteDescription' => ''])

<div class="rounded-[1.5rem] glass-card overflow-hidden shadow-2xl">
    
    {{-- Section Header --}}
    <div class="p-6 border-b border-slate-200 dark:border-white/5 flex items-center gap-4">
        <div class="w-12 h-12 rounded-xl flex items-center justify-center bg-gradient-to-br from-purple-500 to-blue-600 shadow-lg shadow-purple-500/20">
            <i class="bi bi-globe-americas text-white text-xl"></i>
        </div>
        <div>
            <h2 class="font-bold text-lg text-slate-800 dark:text-white">
                Pengaturan Umum
            </h2>
            <p class="text-sm text-slate-500 dark:text-slate-400">
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
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                    Nama Portal <span class="text-rose-500">*</span>
                </label>
                <input 
                    type="text" 
                    wire:model="siteName"
                    placeholder="Contoh: BTIKP PORTAL"
                    class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-[#111827] border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-all duration-300 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500/50 focus:outline-none"
                >
                @error('siteName')
                    <p class="text-rose-500 dark:text-rose-400 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tagline --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                    Tagline
                </label>
                <input 
                    type="text" 
                    wire:model="siteTagline"
                    placeholder="Contoh: Informasi Terkini dan Terpercaya"
                    class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-[#111827] border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-all duration-300 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500/50 focus:outline-none"
                >
            </div>
        </div>

        {{-- Deskripsi Website --}}
        <div class="space-y-2">
            <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                Deskripsi Website
            </label>
            <textarea 
                wire:model="siteDescription"
                rows="4"
                placeholder="Deskripsi singkat tentang portal berita Anda..."
                class="w-full px-4 py-3.5 rounded-xl bg-slate-50 dark:bg-[#111827] border border-slate-200 dark:border-white/10 text-slate-900 dark:text-white placeholder:text-slate-400 dark:placeholder:text-slate-500 transition-all duration-300 focus:ring-2 focus:ring-teal-500/50 focus:border-teal-500/50 focus:outline-none resize-none"
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
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                    Logo Utama
                </label>
                <div class="relative group">
                    <div class="flex flex-col items-center justify-center w-full h-36 rounded-xl bg-slate-50 dark:bg-[#111827] border-2 border-dashed border-slate-300 dark:border-slate-600 transition-all duration-300 cursor-pointer group-hover:border-teal-500/50 hover:bg-slate-100 dark:group-hover:bg-[#1a2332]">
                        <i class="bi bi-cloud-arrow-up text-3xl text-slate-400 dark:text-slate-500 mb-2 group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors"></i>
                        <p class="text-sm text-slate-500 dark:text-slate-400 group-hover:text-slate-800 dark:group-hover:text-slate-300 transition-colors">
                            Klik untuk upload logo
                        </p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                            PNG, JPG max 2MB
                        </p>
                    </div>
                    <input type="file" wire:model="siteLogo" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>

            {{-- Favicon --}}
            <div class="space-y-2">
                <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                    Favicon
                </label>
                <div class="relative group">
                    <div class="flex flex-col items-center justify-center w-full h-36 rounded-xl bg-slate-50 dark:bg-[#111827] border-2 border-dashed border-slate-300 dark:border-slate-600 transition-all duration-300 cursor-pointer group-hover:border-teal-500/50 hover:bg-slate-100 dark:group-hover:bg-[#1a2332]">
                        <i class="bi bi-image text-3xl text-slate-400 dark:text-slate-500 mb-2 group-hover:text-teal-500 dark:group-hover:text-teal-400 transition-colors"></i>
                        <p class="text-sm text-slate-500 dark:text-slate-400 group-hover:text-slate-800 dark:group-hover:text-slate-300 transition-colors">
                            Klik untuk upload favicon
                        </p>
                        <p class="text-xs text-slate-400 dark:text-slate-500 mt-1">
                            ICO, PNG 32x32 atau 64x64
                        </p>
                    </div>
                    <input type="file" wire:model="siteFavicon" class="absolute inset-0 opacity-0 cursor-pointer">
                </div>
            </div>
        </div>
    </div>
</div>
