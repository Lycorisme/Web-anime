{{-- General Settings Form Section - Modern Clean Style --}}
@props(['siteName' => '', 'siteTagline' => '', 'siteDescription' => ''])

<div class="rounded-[1.5rem] overflow-hidden transition-all duration-300 border shadow-sm"
     :class="darkMode ? 'bg-[#111827]/40 border-white/5' : 'bg-white border-slate-200'">
    
    {{-- Section Header --}}
    <div class="px-6 py-5 border-b flex items-center justify-between" 
         :class="darkMode ? 'border-white/5' : 'border-slate-100'">
        <div class="flex items-center gap-4">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center bg-gradient-to-br from-indigo-500 to-violet-600 shadow-md shadow-indigo-500/20">
                <i class="bi bi-person-badge text-white text-lg"></i>
            </div>
            <div>
                <h2 class="font-bold text-base" :class="darkMode ? 'text-white' : 'text-slate-800'">
                    Informasi Portal
                </h2>
                <p class="text-xs font-medium" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                    Update identitas utama website
                </p>
            </div>
        </div>
        
        {{-- Status Badge --}}
        <div class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border"
             :class="darkMode ? 'bg-emerald-500/10 border-emerald-500/20 text-emerald-400' : 'bg-emerald-50 border-emerald-200 text-emerald-600'">
            Active
        </div>
    </div>

    {{-- Form Content --}}
    <div class="p-6 lg:p-8 space-y-8">
        
        {{-- Group 1: Text Fields --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
            {{-- Nama Portal --}}
            <div class="space-y-1.5 group">
                <label class="block text-xs font-bold uppercase tracking-wider ml-1" 
                       :class="darkMode ? 'text-slate-400 group-focus-within:text-indigo-400' : 'text-slate-500 group-focus-within:text-indigo-600'">
                    Nama Portal <span class="text-rose-500">*</span>
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model="siteName"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border-2 transition-all duration-300 outline-none font-medium text-sm"
                        :class="darkMode 
                            ? 'bg-[#1f2937]/50 border-white/5 focus:border-indigo-500/50 text-white placeholder:text-slate-600' 
                            : 'bg-slate-50 border-slate-200 focus:border-indigo-500/30 text-slate-900 placeholder:text-slate-400'"
                        placeholder="Nama website anda..."
                    >
                    <i class="bi bi-globe absolute left-3.5 top-1/2 -translate-y-1/2 text-lg transition-colors duration-300"
                       :class="darkMode ? 'text-slate-500 group-focus-within:text-indigo-400' : 'text-slate-400 group-focus-within:text-indigo-500'"></i>
                </div>
                @error('siteName')
                    <p class="text-rose-500 text-xs mt-1 ml-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tagline --}}
            <div class="space-y-1.5 group">
                <label class="block text-xs font-bold uppercase tracking-wider ml-1" 
                       :class="darkMode ? 'text-slate-400 group-focus-within:text-indigo-400' : 'text-slate-500 group-focus-within:text-indigo-600'">
                    Tagline
                </label>
                <div class="relative">
                    <input 
                        type="text" 
                        wire:model="siteTagline"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border-2 transition-all duration-300 outline-none font-medium text-sm"
                        :class="darkMode 
                            ? 'bg-[#1f2937]/50 border-white/5 focus:border-indigo-500/50 text-white placeholder:text-slate-600' 
                            : 'bg-slate-50 border-slate-200 focus:border-indigo-500/30 text-slate-900 placeholder:text-slate-400'"
                        placeholder="Slogan singkat..."
                    >
                    <i class="bi bi-megaphone absolute left-3.5 top-1/2 -translate-y-1/2 text-lg transition-colors duration-300"
                       :class="darkMode ? 'text-slate-500 group-focus-within:text-indigo-400' : 'text-slate-400 group-focus-within:text-indigo-500'"></i>
                </div>
            </div>

            {{-- Deskripsi Website --}}
            <div class="md:col-span-2 space-y-1.5 group">
                <div class="flex items-center justify-between ml-1">
                    <label class="block text-xs font-bold uppercase tracking-wider" 
                           :class="darkMode ? 'text-slate-400 group-focus-within:text-indigo-400' : 'text-slate-500 group-focus-within:text-indigo-600'">
                        Deskripsi
                    </label>
                    <span class="text-[10px]" :class="darkMode ? 'text-slate-600' : 'text-slate-400'">Max 250 karakter</span>
                </div>
                <div class="relative">
                    <textarea 
                        wire:model="siteDescription"
                        rows="3"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border-2 transition-all duration-300 outline-none font-medium text-sm resize-none"
                        :class="darkMode 
                            ? 'bg-[#1f2937]/50 border-white/5 focus:border-indigo-500/50 text-white placeholder:text-slate-600' 
                            : 'bg-slate-50 border-slate-200 focus:border-indigo-500/30 text-slate-900 placeholder:text-slate-400'"
                        placeholder="Jelaskan tentang website anda secara singkat..."
                    ></textarea>
                    <i class="bi bi-card-text absolute left-3.5 top-4 text-lg transition-colors duration-300"
                       :class="darkMode ? 'text-slate-500 group-focus-within:text-indigo-400' : 'text-slate-400 group-focus-within:text-indigo-500'"></i>
                </div>
            </div>
        </div>

        {{-- Divider --}}
        <div class="h-px w-full" :class="darkMode ? 'bg-white/5' : 'bg-slate-100'"></div>

        {{-- Group 2: Media Uploads --}}
        <div>
            <h3 class="text-sm font-bold mb-4 flex items-center gap-2" :class="darkMode ? 'text-slate-200' : 'text-slate-800'">
                <i class="bi bi-images text-indigo-500"></i> Media Assets
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Logo Upload --}}
                <div class="relative group cursor-pointer">
                    <div class="absolute inset-0 bg-indigo-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative border-2 border-dashed rounded-2xl p-6 flex items-center gap-4 transition-all duration-300"
                         :class="darkMode 
                            ? 'border-slate-700 bg-[#1f2937]/30 group-hover:border-indigo-500/50' 
                            : 'border-slate-200 bg-slate-50/50 group-hover:border-indigo-500/50'">
                        
                        {{-- Icon Placeholder --}}
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                             :class="darkMode ? 'bg-[#111827] group-hover:bg-[#1f2937]' : 'bg-white shadow-sm group-hover:shadow-md'">
                            <i class="bi bi-cloud-arrow-up text-2xl" :class="darkMode ? 'text-indigo-400' : 'text-indigo-600'"></i>
                        </div>

                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold truncate transition-colors" :class="darkMode ? 'text-slate-200 group-hover:text-white' : 'text-slate-700 group-hover:text-slate-900'">Main Logo</h4>
                            <p class="text-xs mt-1 truncate" :class="darkMode ? 'text-slate-500' : 'text-slate-500'">Support PNG, JPG</p>
                            <p class="text-[10px] mt-0.5" :class="darkMode ? 'text-slate-600' : 'text-slate-400'">Max file size 2MB</p>
                        </div>

                        <input type="file" wire:model="siteLogo" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    </div>
                </div>

                {{-- Favicon Upload --}}
                <div class="relative group cursor-pointer">
                    <div class="absolute inset-0 bg-indigo-500/5 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    <div class="relative border-2 border-dashed rounded-2xl p-6 flex items-center gap-4 transition-all duration-300"
                         :class="darkMode 
                            ? 'border-slate-700 bg-[#1f2937]/30 group-hover:border-indigo-500/50' 
                            : 'border-slate-200 bg-slate-50/50 group-hover:border-indigo-500/50'">
                        
                        {{-- Icon Placeholder --}}
                        <div class="w-16 h-16 rounded-xl flex items-center justify-center flex-shrink-0 transition-colors duration-300"
                             :class="darkMode ? 'bg-[#111827] group-hover:bg-[#1f2937]' : 'bg-white shadow-sm group-hover:shadow-md'">
                            <i class="bi bi-box text-2xl" :class="darkMode ? 'text-indigo-400' : 'text-indigo-600'"></i>
                        </div>

                        <div class="flex-1 min-w-0">
                            <h4 class="text-sm font-bold truncate transition-colors" :class="darkMode ? 'text-slate-200 group-hover:text-white' : 'text-slate-700 group-hover:text-slate-900'">Favicon</h4>
                            <p class="text-xs mt-1 truncate" :class="darkMode ? 'text-slate-500' : 'text-slate-500'">Support ICO, PNG</p>
                            <p class="text-[10px] mt-0.5" :class="darkMode ? 'text-slate-600' : 'text-slate-400'">Rec. 32x32px</p>
                        </div>
                        
                        <input type="file" wire:model="siteFavicon" class="absolute inset-0 opacity-0 cursor-pointer z-10">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
