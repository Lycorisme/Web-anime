{{-- UI Components Demo --}}
{{-- Demo page to showcase Alert Confirm and Toast components --}}

<div class="space-y-8">
    {{-- Page Header --}}
    <div class="glass-card rounded-2xl p-6 sm:p-8 animate-fade-in-up">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 rounded-xl btn-premium flex items-center justify-center shadow-lg">
                <i class="bi bi-bell-fill text-2xl text-white"></i>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold gradient-text">UI Components Demo</h1>
                <p class="text-slate-400 text-sm mt-1">Toast Notifications & Alert Confirmation</p>
            </div>
        </div>
    </div>

    {{-- Toast Section --}}
    <div class="glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-100">
        <div class="bg-gradient-to-r from-emerald-500/10 to-teal-500/10 px-6 py-5 border-b border-white/5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                    <i class="bi bi-chat-square-dots-fill text-xl text-white"></i>
                </div>
                <div>
                    <h2 class="font-bold text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">Toast Notifications</h2>
                    <p class="text-xs text-slate-400">Klik tombol untuk menampilkan toast</p>
                </div>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                {{-- Success Toast --}}
                <button 
                    @click="$dispatch('toast-success', { 
                        message: 'Data berhasil disimpan ke database!', 
                        title: 'Sukses' 
                    })"
                    class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-emerald-500/20 hover:border-emerald-500/50"
                >
                    <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-emerald-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="bi bi-check-circle-fill text-emerald-500 text-xl"></i>
                    </div>
                    <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">Success</span>
                </button>

                {{-- Error Toast --}}
                <button 
                    @click="$dispatch('toast-error', { 
                        message: 'Terjadi kesalahan saat memproses permintaan!', 
                        title: 'Error' 
                    })"
                    class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-red-500/20 hover:border-red-500/50"
                >
                    <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-red-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="bi bi-x-circle-fill text-red-500 text-xl"></i>
                    </div>
                    <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">Error</span>
                </button>

                {{-- Warning Toast --}}
                <button 
                    @click="$dispatch('toast-warning', { 
                        message: 'Session akan berakhir dalam 5 menit!', 
                        title: 'Peringatan' 
                    })"
                    class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-amber-500/20 hover:border-amber-500/50"
                >
                    <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-amber-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="bi bi-exclamation-triangle-fill text-amber-500 text-xl"></i>
                    </div>
                    <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">Warning</span>
                </button>

                {{-- Info Toast --}}
                <button 
                    @click="$dispatch('toast-info', { 
                        message: 'Sistem sedang melakukan sinkronisasi data...', 
                        title: 'Informasi' 
                    })"
                    class="group glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 active:scale-95 border border-blue-500/20 hover:border-blue-500/50"
                >
                    <div class="w-12 h-12 mx-auto mb-3 rounded-lg bg-blue-500/10 flex items-center justify-center group-hover:scale-110 transition-transform">
                        <i class="bi bi-info-circle-fill text-blue-500 text-xl"></i>
                    </div>
                    <span class="text-sm font-semibold" :class="darkMode ? 'text-white' : 'text-slate-700'">Info</span>
                </button>
            </div>

            {{-- Additional Options --}}
            <div class="mt-6 pt-6 border-t border-white/5">
                <div class="flex flex-wrap items-center gap-3">
                    <button 
                        @click="$dispatch('toast', { 
                            type: 'success', 
                            message: 'Toast ini akan bertahan lebih lama! (10 detik)', 
                            duration: 10000 
                        })"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-105 active:scale-95"
                        :class="darkMode ? 'bg-slate-800 text-slate-300 hover:bg-slate-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300'"
                    >
                        <i class="bi bi-clock mr-2"></i>Long Duration (10s)
                    </button>
                    
                    <button 
                        @click="$dispatch('toast', { 
                            type: 'info', 
                            message: 'Toast ini tidak akan hilang otomatis.', 
                            duration: 0 
                        })"
                        class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 hover:scale-105 active:scale-95"
                        :class="darkMode ? 'bg-slate-800 text-slate-300 hover:bg-slate-700' : 'bg-slate-200 text-slate-700 hover:bg-slate-300'"
                    >
                        <i class="bi bi-pin-angle mr-2"></i>Permanent
                    </button>
                    
                    <button 
                        @click="$dispatch('clear-toasts')"
                        class="px-4 py-2 rounded-lg text-sm font-medium bg-red-500/10 text-red-500 hover:bg-red-500/20 transition-all duration-200 hover:scale-105 active:scale-95"
                    >
                        <i class="bi bi-trash mr-2"></i>Clear All
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Alert Confirm Section --}}
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
                        confirmText: 'Ya, Simpan',
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

    {{-- Theme Integration Note --}}
    <div class="glass-card rounded-2xl p-6 animate-fade-in-up delay-300">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-lg btn-premium flex items-center justify-center flex-shrink-0">
                <i class="bi bi-palette-fill text-white"></i>
            </div>
            <div>
                <h3 class="font-bold mb-2" :class="darkMode ? 'text-white' : 'text-slate-800'">
                    <i class="bi bi-stars text-amber-400 mr-2"></i>Theme Integration
                </h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Kedua komponen terintegrasi dengan sistem tema. Tombol konfirmasi tipe <code class="px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-400 text-xs">info</code> 
                    menggunakan gradient tema aktif. Coba ubah tema di Theme Customizer untuk melihat perubahannya!
                </p>
            </div>
        </div>
    </div>
</div>
