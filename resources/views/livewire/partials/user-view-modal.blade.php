<x-ui.modal show="showViewModal" maxWidth="md">
    <x-slot:header>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center text-white">
                <i class="bi bi-person"></i>
            </div>
            <h3 class="text-lg font-extrabold">{{ __('view_details') }}</h3>
        </div>
        <button @click="showViewModal = false" class="btn-icon w-8 h-8 rounded-lg">
            <i class="bi bi-x-lg"></i>
        </button>
    </x-slot:header>

    <div x-if="viewUser">
        <div class="flex flex-col items-center mb-6">
            <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-xl mb-3 bg-gradient-to-br from-indigo-500 to-purple-500">
                <span x-text="viewUser?.name?.charAt(0)?.toUpperCase() || '?'"></span>
            </div>
            <h4 class="text-lg font-extrabold" x-text="viewUser?.name || ''"></h4>
            <span class="text-xs text-slate-400 mt-1" x-text="viewUser?.email || ''"></span>
        </div>
        <div class="space-y-3">
            <div class="flex items-center justify-between py-2.5 px-4 rounded-xl" :class="darkMode ? 'bg-white/5' : 'bg-slate-50'">
                <span class="text-xs font-bold text-slate-400">{{ __('role') }}</span>
                <span class="text-xs font-bold px-3 py-1 rounded-full"
                      :class="viewUser?.role === 'Admin' ? 'bg-purple-500/10 text-purple-500' : (viewUser?.role === 'Editor' ? 'bg-blue-500/10 text-blue-500' : 'bg-slate-500/10 text-slate-400')"
                      x-text="viewUser?.role || ''"></span>
            </div>
            <div class="flex items-center justify-between py-2.5 px-4 rounded-xl" :class="darkMode ? 'bg-white/5' : 'bg-slate-50'">
                <span class="text-xs font-bold text-slate-400">{{ __('status') }}</span>
                <span class="text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1.5"
                      :class="viewUser?.status === 'Active' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'">
                    <span class="w-1.5 h-1.5 rounded-full" :class="viewUser?.status === 'Active' ? 'bg-green-500 animate-pulse' : 'bg-red-500'"></span>
                    <span x-text="viewUser?.status"></span>
                </span>
            </div>
            <div class="flex items-center justify-between py-2.5 px-4 rounded-xl" :class="darkMode ? 'bg-white/5' : 'bg-slate-50'">
                <span class="text-xs font-bold text-slate-400">{{ __('phone') }}</span>
                <span class="text-xs font-medium" x-text="viewUser?.phone || '-'"></span>
            </div>
        </div>
    </div>

    <x-slot:footer>
        <button @click="showViewModal = false"
                class="btn-ghost px-5 py-2.5 rounded-xl text-sm font-bold">
            {{ __('close') }}
        </button>
    </x-slot:footer>
</x-ui.modal>
