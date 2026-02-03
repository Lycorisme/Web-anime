{{-- General Settings Form --}}
<div class="glass-card rounded-3xl overflow-hidden animate-fade-in-up delay-200">
    <!-- Form Header -->
    <div class="bg-white/5 px-6 py-4 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="flex gap-1.5">
                <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
            </div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-2">
                Pengaturan Umum
            </span>
        </div>
    </div>

    <!-- Form Content -->
    <div class="p-6 space-y-6">
        <!-- Site Name -->
        <div class="space-y-2">
            <label class="text-sm font-bold text-slate-400 uppercase tracking-wider">
                Nama Situs
            </label>
            <input 
                type="text" 
                wire:model="settings.site_name"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none text-sm"
                placeholder="Masukkan nama situs..."
            >
        </div>

        <!-- Site Description -->
        <div class="space-y-2">
            <label class="text-sm font-bold text-slate-400 uppercase tracking-wider">
                Deskripsi Situs
            </label>
            <textarea 
                wire:model="settings.site_description"
                rows="3"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none text-sm resize-none"
                placeholder="Deskripsi singkat tentang situs..."
            ></textarea>
        </div>

        <!-- Contact Email -->
        <div class="space-y-2">
            <label class="text-sm font-bold text-slate-400 uppercase tracking-wider">
                Email Kontak
            </label>
            <input 
                type="email" 
                wire:model="settings.contact_email"
                class="w-full px-4 py-3 rounded-xl bg-white/5 border border-white/10 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all outline-none text-sm"
                placeholder="email@example.com"
            >
        </div>

        <!-- Save Button -->
        <div class="pt-4 border-t border-white/10">
            <button 
                wire:click="save"
                class="btn-premium text-white px-6 py-3 rounded-xl font-bold text-sm flex items-center gap-2"
            >
                <i class="bi bi-check-lg"></i>
                Simpan Perubahan
            </button>
        </div>
    </div>
</div>
