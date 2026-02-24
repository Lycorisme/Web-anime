<!-- Avatar Preview Modal (Independent) -->
<template x-teleport="body">
    <div x-data="{ 
            showAvatar: false, 
            avatarUrl: '',
            init() {
                window.addEventListener('open-avatar-preview', (e) => {
                    this.avatarUrl = e.detail.url;
                    this.showAvatar = true;
                    document.body.style.overflow = 'hidden';
                });
            },
            closePreview() {
                this.showAvatar = false;
                document.body.style.overflow = '';
            }
         }"
         x-show="showAvatar" 
         class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
         style="display: none;">
        
        <!-- Backdrop (no click-to-close) -->
        <div x-show="showAvatar"
             class="absolute inset-0 bg-black/80 backdrop-blur-md transition-opacity" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Modal Content -->
        <div x-show="showAvatar"
             class="relative max-w-3xl w-full max-h-[90vh] flex items-center justify-center pointer-events-none"
             x-transition:enter="ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 scale-90"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90">
            
            <img :src="avatarUrl" class="max-w-full max-h-[85vh] object-contain rounded-2xl shadow-2xl pointer-events-auto border-4 border-white/10 bg-slate-900">
            
            <!-- Close Button (X) — satu-satunya cara menutup modal -->
            <button @click="closePreview()"
                    class="absolute -top-4 -right-4 sm:-top-6 sm:-right-6 w-10 h-10 sm:w-12 sm:h-12 bg-black/50 hover:bg-red-500 text-white rounded-full flex items-center justify-center backdrop-blur-md transition-colors pointer-events-auto shadow-xl ring-2 ring-white/20">
                <i class="bi bi-x-lg text-base sm:text-xl"></i>
            </button>
        </div>
    </div>
</template>
