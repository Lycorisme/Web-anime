<x-ui.modal show="showModal" maxWidth="lg" onClose="hideModal">
     <x-slot:header>
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center text-white">
                <i class="{{ $isEdit ? 'bi bi-pencil-square' : 'bi bi-person-plus' }}"></i>
            </div>
            <h3 class="text-lg font-extrabold">
                {{ $isEdit ? __('edit_user') : __('add_user') }}
            </h3>
        </div>
        <button wire:click="hideModal" class="btn-icon w-8 h-8 rounded-lg">
            <i class="bi bi-x-lg"></i>
        </button>
     </x-slot:header>

     <div>
        {{-- Name --}}
        <div class="mb-4">
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
        <div class="mb-4">
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
        <div class="mb-4">
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
        <div class="mb-4">
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
        <div class="mb-4">
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
        <div class="mb-4">
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

     <x-slot:footer>
        <button wire:click="hideModal" 
                class="btn-ghost px-5 py-2.5 rounded-xl text-sm font-bold">
            {{ __('cancel') }}
        </button>
        <button wire:click="{{ $isEdit ? 'update' : 'store' }}"
                class="btn-premium btn-ripple text-white px-5 py-2.5 rounded-xl text-sm font-bold flex items-center gap-1.5">
            <i class="bi bi-check-lg relative z-[1]"></i>
            <span class="relative z-[1]">{{ __('save') }}</span>
        </button>
     </x-slot:footer>
</x-ui.modal>
