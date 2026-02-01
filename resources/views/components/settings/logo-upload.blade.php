{{-- Logo Upload Component --}}
@props(['currentLogo', 'siteLogo'])

<div>
    <label class="block text-sm font-medium mb-2"
           :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
        <i class="bi bi-image mr-1"></i>
        Logo Website (Opsional)
    </label>
    
    <div class="flex items-start gap-4">
        {{-- Current/Preview Logo --}}
        <div class="relative group">
            <div class="w-20 h-20 rounded-xl overflow-hidden border-2 border-dashed transition-all duration-300"
                 :class="darkMode ? 'border-white/20 bg-white/5' : 'border-slate-300 bg-slate-100'">
                @if($currentLogo)
                    <img src="{{ Storage::url($currentLogo) }}" 
                         alt="Logo Preview" 
                         class="w-full h-full object-cover">
                @elseif($siteLogo)
                    <img src="{{ $siteLogo->temporaryUrl() }}" 
                         alt="Logo Preview" 
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center"
                         :class="darkMode ? 'text-slate-600' : 'text-slate-400'">
                        <i class="bi bi-image text-2xl"></i>
                    </div>
                @endif
            </div>
            
            @if($currentLogo)
            <button 
                type="button"
                wire:click="removeLogo"
                class="absolute -top-2 -right-2 w-6 h-6 rounded-full bg-rose-500 text-white flex items-center justify-center hover:bg-rose-600 transition-colors opacity-0 group-hover:opacity-100">
                <i class="bi bi-x text-sm"></i>
            </button>
            @endif
        </div>

        {{-- Upload Input --}}
        <div class="flex-1">
            <label 
                class="flex items-center justify-center gap-2 px-4 py-3 rounded-xl cursor-pointer transition-all duration-300 hover:scale-[1.02]"
                :class="darkMode 
                    ? 'bg-white/5 border border-white/10 hover:bg-white/10 text-slate-300' 
                    : 'bg-slate-50 border border-slate-200 hover:bg-slate-100 text-slate-600'"
            >
                <i class="bi bi-cloud-arrow-up"></i>
                <span>Pilih Gambar</span>
                <input 
                    type="file" 
                    wire:model="siteLogo"
                    accept="image/*"
                    class="hidden"
                >
            </label>
            <p class="text-xs mt-2"
               :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                Format: JPG, PNG, SVG • Max: 2MB
            </p>
            
            {{-- Upload Loading --}}
            <div wire:loading wire:target="siteLogo" class="mt-2 flex items-center gap-2 text-purple-400">
                <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-sm">Mengupload...</span>
            </div>
        </div>
    </div>
    @error('siteLogo')
        <p class="text-rose-400 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
