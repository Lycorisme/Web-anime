<!-- User Form Modal -->
<template x-teleport="body">
    <div x-show="showModal" 
         class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
         style="display: none;">
        
        <!-- Backdrop -->
        <div x-show="showModal"
             class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" 
             @click="showModal = false"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Modal Content -->
        <div x-show="showModal"
             class="relative w-full max-w-lg rounded-2xl shadow-2xl overflow-visible transform transition-all border group"
             :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95">
            
            <!-- Glow Effect -->
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none rounded-2xl"
                 style="background: linear-gradient(135deg, color-mix(in srgb, var(--gradient-start) 5%, transparent), color-mix(in srgb, var(--gradient-end) 5%, transparent));"></div>

            <!-- Particles -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-2xl">
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-blue-500/10 rounded-full blur-3xl animate-blob"></div>
                <div class="absolute top-20 -right-20 w-40 h-40 bg-purple-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-20 left-20 w-40 h-40 bg-pink-500/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
            </div>

            <!-- Header -->
            <div class="px-5 py-4 border-b flex items-center justify-between relative z-10"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg"
                         style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                        <i class="{{ $isEdit ? 'bi bi-pencil-square' : 'bi bi-person-plus' }} text-lg"></i>
                    </div>
                    <h3 class="font-bold text-base sm:text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">
                        {{ $isEdit ? __('edit_user') : __('add_user') }}
                    </h3>
                </div>
                <button wire:click="hideModal" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:bg-white/5 hover:text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800'">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-5 space-y-4 relative z-20 max-h-[70vh] overflow-y-auto custom-scrollbar">
                
                <!-- Name -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold uppercase tracking-wider block" 
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('full_name') }}
                    </label>
                    <div class="relative group/input">
                        <input type="text" wire:model="name"
                               class="w-full pl-4 pr-4 py-3 rounded-xl border appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-xs sm:text-sm font-medium placeholder-slate-400/50"
                               :class="darkMode ? 'bg-white/5 border-white/10 text-white focus:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 focus:bg-white'"
                               placeholder="{{ __('full_name') }}">
                    </div>
                    @error('name') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <!-- Email -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold uppercase tracking-wider block" 
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('email') }}
                    </label>
                    <div class="relative group/input">
                        <input type="email" wire:model="email"
                               class="w-full pl-4 pr-4 py-3 rounded-xl border appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-xs sm:text-sm font-medium placeholder-slate-400/50"
                               :class="darkMode ? 'bg-white/5 border-white/10 text-white focus:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 focus:bg-white'"
                               placeholder="user@example.com">
                    </div>
                    @error('email') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- Phone -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold uppercase tracking-wider block" 
                               :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                            {{ __('phone') }}
                        </label>
                        <div class="relative group/input">
                            <input type="text" wire:model="phone"
                                   class="w-full pl-4 pr-4 py-3 rounded-xl border appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-xs sm:text-sm font-medium placeholder-slate-400/50"
                                   :class="darkMode ? 'bg-white/5 border-white/10 text-white focus:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 focus:bg-white'"
                                   placeholder="+62 812 3456 7890">
                        </div>
                        @error('phone') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>

                    <!-- Password -->
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold uppercase tracking-wider block" 
                               :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                            {{ __('password') }}
                        </label>
                        <div class="relative group/input">
                            <input type="password" wire:model="password"
                                   class="w-full pl-4 pr-4 py-3 rounded-xl border appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-xs sm:text-sm font-medium placeholder-slate-400/50"
                                   :class="darkMode ? 'bg-white/5 border-white/10 text-white focus:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 focus:bg-white'"
                                   placeholder="••••••••">
                        </div>
                        @if($isEdit)
                            <p class="text-[10px] text-slate-500">{{ __('leave_blank_keep_current') }}</p>
                        @endif
                        @error('password') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Role -->
                <div class="space-y-1.5">
                    <x-ui.select 
                        label="{{ __('role') }}" 
                        model="role" 
                        :options="[
                            ['value' => 'Admin', 'label' => __('admin')],
                            ['value' => 'Editor', 'label' => __('editor')],
                            ['value' => 'Viewer', 'label' => __('viewer')],
                        ]"
                        placeholder="{{ __('select_role') }}"
                        icon="bi bi-person-badge"
                    />
                    @error('role') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <!-- Status -->
                <div class="space-y-1.5">
                    <x-ui.select 
                        label="{{ __('status') }}" 
                        model="status" 
                        :options="[
                            ['value' => 'Active', 'label' => __('active')],
                            ['value' => 'Inactive', 'label' => __('inactive')],
                        ]"
                        placeholder="{{ __('select_status') }}"
                        icon="bi bi-toggle-on"
                    />
                    @error('status') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

            </div>

            <!-- Footer -->
            <div class="px-5 py-4 border-t flex items-center justify-end gap-3 relative z-10"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                
                <button wire:click="hideModal" 
                        class="px-4 py-2.5 rounded-xl text-xs font-bold transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/5' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200'">
                    {{ __('cancel') }}
                </button>

                <button wire:click="{{ $isEdit ? 'update' : 'store' }}"
                        class="px-6 py-2.5 rounded-xl text-xs font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2"
                        style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--gradient-start) 40%, transparent);">
                    <i class="bi bi-check-lg text-sm"></i>
                    <span>{{ __('save') }}</span>
                </button>
            </div>
        </div>
    </div>
</template>
