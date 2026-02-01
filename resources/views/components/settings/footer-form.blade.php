{{-- Footer Settings Form Section --}}
@props(['footerCopyright'])

<div class="rounded-2xl p-6 transition-all duration-300"
     :class="darkMode ? 'glass-card' : 'bg-white/80 backdrop-blur-xl border border-slate-200 shadow-xl'">
    
    {{-- Section Header --}}
    <div class="flex items-center gap-3 mb-6 pb-4 border-b"
         :class="darkMode ? 'border-white/10' : 'border-slate-200'">
        <div class="p-2 rounded-lg bg-gradient-to-br from-amber-500 to-orange-600">
            <i class="bi bi-layout-three-columns text-white text-lg"></i>
        </div>
        <div>
            <h2 class="font-space font-bold text-lg"
                :class="darkMode ? 'text-white' : 'text-slate-800'">
                Footer
            </h2>
            <p class="text-sm"
               :class="darkMode ? 'text-slate-400' : 'text-slate-600'">
                Atur informasi yang ditampilkan di footer
            </p>
        </div>
    </div>

    <div>
        <label class="block text-sm font-medium mb-2"
               :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
            <i class="bi bi-c-circle mr-1"></i>
            Teks Copyright
        </label>
        <input 
            type="text" 
            wire:model="footerCopyright"
            placeholder="© 2026 Your Company. All rights reserved."
            class="w-full px-4 py-3 rounded-xl transition-all duration-300 focus:ring-2 focus:ring-purple-500 focus:outline-none"
            :class="darkMode 
                ? 'bg-white/5 border border-white/10 text-white placeholder:text-slate-500' 
                : 'bg-slate-50 border border-slate-200 text-slate-800 placeholder:text-slate-400'"
        >
        @error('footerCopyright')
            <p class="text-rose-400 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
