{{-- Alert Confirm Demo Section --}}
{{-- Dipisahkan dari demo.blade.php --}}

<div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-200">
    <div class="bg-gradient-to-r from-orange-500/10 to-red-500/10 px-6 py-5 border-b border-white/5">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-orange-500 to-red-500 flex items-center justify-center shadow-lg shadow-orange-500/20">
                <i class="bi bi-question-circle-fill text-xl text-white"></i>
            </div>
            <div>
                <h2 class="font-bold text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">Alert Confirmation</h2>
                <p class="text-xs text-slate-400">Dialog konfirmasi dengan berbagai tipe</p>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            {{-- Warning Alert --}}
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: 'Perhatian!',
                    message: 'Apakah Anda yakin ingin melanjutkan aksi ini?',
                    type: 'warning',
                    confirmText: 'Ya, Lanjutkan',
                    cancelText: 'Batal',
                    onConfirm: () => {
                        $dispatch('toast-success', { message: 'Aksi berhasil dilakukan!' });
                    }
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-amber-500/20 hover:border-amber-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-amber-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-exclamation-triangle-fill text-amber-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">Warning</span>
            </button>

            {{-- Danger Alert --}}
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: 'Hapus Item?',
                    message: 'Item ini akan dihapus secara permanen dan tidak dapat dikembalikan!',
                    type: 'danger',
                    confirmText: 'Ya, Hapus',
                    cancelText: 'Batalkan',
                    onConfirm: () => {
                        $dispatch('toast-success', { message: 'Item berhasil dihapus!' });
                    }
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-red-500/20 hover:border-red-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-trash3-fill text-red-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">Danger</span>
            </button>

            {{-- Success Alert --}}
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: 'Simpan Perubahan?',
                    message: 'Perubahan yang Anda buat akan disimpan ke database.',
                    type: 'success',
                    confirmText: 'Simpan',
                    cancelText: 'Tinjau Ulang',
                    onConfirm: () => {
                        $dispatch('toast-success', { message: 'Perubahan berhasil disimpan!' });
                    }
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-emerald-500/20 hover:border-emerald-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-emerald-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-check-circle-fill text-emerald-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">Success</span>
            </button>

            {{-- Info Alert --}}
            <button 
                @click="$dispatch('swal-confirm-global-confirm', {
                    title: 'Informasi',
                    message: 'Fitur ini akan segera tersedia dalam update berikutnya.',
                    type: 'info',
                    confirmText: 'Mengerti',
                    cancelText: 'Tutup',
                    onConfirm: () => {
                        $dispatch('toast-info', { message: 'Terima kasih atas pengertiannya!' });
                    }
                })"
                class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-blue-500/20 hover:border-blue-500/50"
            >
                <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-blue-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <i class="bi bi-info-circle-fill text-blue-500 text-xl"></i>
                </div>
                <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">Info</span>
            </button>
        </div>
    </div>
</div>
