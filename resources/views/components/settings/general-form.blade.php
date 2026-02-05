{{-- General Settings Form - Responsive --}}
@props(['siteName' => '', 'footerCopyright' => ''])

<div class="glass-card rounded-xl sm:rounded-2xl overflow-hidden">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-500/10 to-cyan-500/10 px-4 sm:px-6 py-4 sm:py-5 border-b border-white/5">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                <i class="bi bi-building text-lg sm:text-xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-base sm:text-lg">Identitas Situs</h3>
                <p class="text-[11px] sm:text-xs text-slate-400">Informasi dasar website Anda</p>
            </div>
        </div>
    </div>

    {{-- Form Content --}}
    <div class="p-4 sm:p-6">
        {{-- Site Name Field --}}
        <div class="space-y-2 sm:space-y-3">
            <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
                <i class="bi bi-type text-blue-400"></i>
                Nama Situs
            </label>
            <div class="relative group">
                <input 
                    type="text" 
                    wire:model="siteName"
                    class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-lg sm:rounded-xl bg-white/5 border-2 border-white/10 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-sm sm:text-base font-medium placeholder:text-slate-500"
                    placeholder="Masukkan nama situs..."
                >
            </div>
        </div>

        {{-- Footer Copyright Field --}}
        <div class="space-y-2 sm:space-y-3 mt-4 sm:mt-6">
            <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
                <i class="bi bi-c-circle text-blue-400"></i>
                Footer Copyright
            </label>
            <div class="relative group">
                <input 
                    type="text" 
                    wire:model="footerCopyright"
                    class="w-full px-4 sm:px-5 py-3 sm:py-4 rounded-lg sm:rounded-xl bg-white/5 border-2 border-white/10 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-sm sm:text-base font-medium placeholder:text-slate-500"
                    placeholder="Contoh: © 2026 Portal Admin Premium. All rights reserved."
                >
            </div>
        </div>

        {{-- Save Button with Confirmation --}}
        <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-white/5">
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: 'Simpan Nama Situs?',
                    message: 'Perubahan nama situs akan langsung diterapkan ke seluruh website.',
                    type: 'info',
                    confirmText: 'Simpan',
                    cancelText: 'Batal',
                    onConfirm: () => {
                        $wire.save();
                    }
                })"
                class="btn-premium text-white px-6 sm:px-8 py-3 sm:py-4 rounded-lg sm:rounded-xl font-bold text-xs sm:text-sm flex items-center gap-2 sm:gap-3 hover:scale-[1.02] active:scale-[0.98] transition-transform shadow-xl w-full sm:w-auto justify-center"
            >
                <i class="bi bi-check-circle-fill text-base sm:text-lg"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>

