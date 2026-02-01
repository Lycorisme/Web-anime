{{-- Form Action Buttons - Harmonious Style --}}
<div class="flex justify-end gap-4 mt-8">
    <a href="/"
       wire:navigate
       class="px-6 py-3.5 rounded-xl font-semibold bg-white dark:bg-[#111827] border border-slate-200 dark:border-white/10 text-slate-600 dark:text-slate-300 hover:text-slate-900 dark:hover:text-white hover:border-slate-300 dark:hover:border-slate-500 hover:bg-slate-50 dark:hover:bg-[#1a2332] transition-all duration-300 flex items-center gap-2">
        <i class="bi bi-x-lg"></i>
        Batal
    </a>
    
    <button 
        type="submit"
        class="px-8 py-3.5 rounded-xl font-semibold bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg shadow-teal-500/30 transition-all duration-300 hover:shadow-xl hover:shadow-teal-500/40 hover:scale-[1.02] flex items-center gap-2"
        wire:loading.attr="disabled"
        wire:loading.class="opacity-75 cursor-wait"
    >
        <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
            <i class="bi bi-check-lg"></i>
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
