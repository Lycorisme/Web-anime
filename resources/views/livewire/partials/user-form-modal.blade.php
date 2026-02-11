    {{-- Add/Edit User Modal --}}
    <div x-show="showModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" wire:click="hideModal"></div>
        
        {{-- Modal Content --}}
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             class="relative w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden z-10 border"
             :class="darkMode ? 'bg-slate-900/95 backdrop-blur-xl border-white/10' : 'bg-white/95 backdrop-blur-xl border-slate-200'">
            
            {{-- Modal Header --}}
            <div class="px-6 py-5 border-b flex items-center justify-between"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center text-white">
                        <i class="{{ $isEdit ? 'bi bi-pencil-square' : 'bi bi-person-plus' }}"></i>
                    </div>
                    <h3 class="text-lg font-extrabold">
                        {{ $isEdit ? __('edit_user') : __('add_user') }}
                    </h3>
                </div>
                <button wire:click="hideModal" 
                        class="btn-icon w-8 h-8 rounded-lg">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="px-6 py-5 space-y-4 max-h-[60vh] overflow-y-auto custom-scrollbar">
                {{-- Name --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider" 
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('full_name') }}
                    </label>
                    <input type="text" wire:model="name"
                           class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'"
                           placeholder="{{ __('full_name') }}">
                    @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Email --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('email') }}
                    </label>
                    <input type="email" wire:model="email"
                           class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'"
                           placeholder="user@example.com">
                    @error('email') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Phone --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('phone') }}
                    </label>
                    <input type="text" wire:model="phone"
                           class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'"
                           placeholder="+62 812 3456 7890">
                    @error('phone') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Role --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('role') }}
                    </label>
                    <select wire:model="role"
                            class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all appearance-none cursor-pointer"
                            :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'">
                        <option value="" disabled>{{ __('select_role') }}</option>
                        <option value="Admin">Admin</option>
                        <option value="Editor">Editor</option>
                        <option value="Viewer">Viewer</option>
                    </select>
                    @error('role') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Status --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('status') }}
                    </label>
                    <select wire:model="status"
                            class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all appearance-none cursor-pointer"
                            :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'">
                        <option value="Active">{{ __('active') }}</option>
                        <option value="Inactive">{{ __('inactive') }}</option>
                    </select>
                    @error('status') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
                {{-- Password --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        {{ __('password') }}
                    </label>
                    <input type="password" wire:model="password"
                           class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'"
                           placeholder="••••••••">
                    @if($isEdit)
                        <p class="text-[10px] text-slate-500 mt-1">{{ __('leave_blank_keep_current') }}</p>
                    @endif
                    @error('password') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="px-6 py-4 border-t flex items-center justify-end gap-3"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                <button wire:click="hideModal" 
                        class="btn-ghost px-5 py-2.5 rounded-xl text-sm font-bold">
                    {{ __('cancel') }}
                </button>
                <button wire:click="{{ $isEdit ? 'update' : 'store' }}"
                        class="btn-premium btn-ripple text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-1.5">
                    <i class="bi bi-check-lg relative z-[1]"></i>
                    <span class="relative z-[1]">{{ __('save') }}</span>
                </button>
            </div>
        </div>
    </div>
