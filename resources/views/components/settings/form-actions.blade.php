{{-- Form Action Buttons --}}
<div class="flex justify-end gap-4">
    <a href="/"
       class="px-6 py-3 rounded-xl font-medium transition-all duration-300 hover:scale-105"
       :class="darkMode 
           ? 'bg-white/5 border border-white/10 text-slate-300 hover:bg-white/10' 
           : 'bg-slate-100 border border-slate-200 text-slate-600 hover:bg-slate-200'">
        <i class="bi bi-x-lg mr-2"></i>
        Batal
    </a>
    
    <button 
        type="submit"
        class="px-8 py-3 rounded-xl font-medium btn-premium text-white transition-all duration-300 hover:scale-105 hover:shadow-xl hover:shadow-purple-500/25 flex items-center gap-2"
        wire:loading.attr="disabled"
        wire:loading.class="opacity-75 cursor-wait"
    >
        <span wire:loading.remove wire:target="save">
            <i class="bi bi-check-lg mr-2"></i>
            Simpan Perubahan
        </span>
        <span wire:loading wire:target="save" class="flex items-center gap-2">
            <svg class="animate-spin h-5 w-5" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...
        </span>
    </button>
</div>
