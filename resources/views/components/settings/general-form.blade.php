{{-- General Settings Form - Premium Design --}}
@props(['siteName' => ''])

<div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-200">
    {{-- Header --}}
    <div class="bg-gradient-to-r from-blue-500/10 to-cyan-500/10 px-6 py-5 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                <i class="bi bi-building text-xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-lg">Identitas Situs</h3>
                <p class="text-xs text-slate-400">Informasi dasar website Anda</p>
            </div>
        </div>
    </div>

    {{-- Form Content --}}
    <div class="p-6">
        {{-- Site Name Field --}}
        <div class="space-y-3">
            <label class="flex items-center gap-2 text-sm font-bold text-slate-400">
                <i class="bi bi-type text-blue-400"></i>
                Nama Situs
            </label>
            <div class="relative group">
                <input 
                    type="text" 
                    wire:model="siteName"
                    class="w-full px-5 py-4 rounded-xl bg-white/5 border-2 border-white/10 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-base font-medium placeholder:text-slate-500"
                    placeholder="Masukkan nama situs..."
                >
                <div class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400">
                    <i class="bi bi-pencil-fill text-sm opacity-0 group-focus-within:opacity-100 transition-opacity"></i>
                </div>
            </div>
            <p class="text-xs text-slate-500 flex items-center gap-2">
                <i class="bi bi-info-circle"></i>
                Nama ini akan ditampilkan di header & browser tab
            </p>
        </div>

        {{-- Save Button --}}
        <div class="mt-8 pt-6 border-t border-white/5">
            <button 
                wire:click="save"
                class="btn-premium text-white px-8 py-4 rounded-xl font-bold text-sm flex items-center gap-3 hover:scale-[1.02] active:scale-[0.98] transition-transform shadow-xl"
            >
                <i class="bi bi-check-circle-fill text-lg"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
