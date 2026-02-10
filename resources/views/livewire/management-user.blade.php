{{-- Management User Page --}}
<div x-data="{ 
    showModal: false, 
    showViewModal: false,
    viewUser: null,
    init() {
        Livewire.on('open-modal', () => { this.showModal = true });
        Livewire.on('close-modal', () => { this.showModal = false });
        Livewire.on('toast-success', (event) => {
            window.dispatchEvent(new CustomEvent('toast-success', { detail: event[0]?.detail || event.detail }));
        });
    }
}" x-init="init()">
    {{-- Page Header --}}
    <div class="mb-4 sm:mb-6 animate-fade-in-up">
        <div class="flex items-center justify-between gap-3">
            {{-- Left Section --}}
            <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                <div class="w-10 h-10 sm:w-12 sm:h-12 btn-premium rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-people-fill text-lg sm:text-xl text-white"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-xl sm:text-2xl font-extrabold truncate">
                        <span class="gradient-text">{{ __('management_user') }}</span>
                    </h1>
                    {{-- Breadcrumb --}}
                    <nav class="flex items-center gap-2 text-xs sm:text-sm mt-0.5">
                        <a href="/" wire:navigate
                           class="transition-colors flex items-center"
                           :class="darkMode ? 'text-slate-400 hover:text-blue-400' : 'text-slate-500 hover:text-slate-900'"
                           title="{{ __('dashboard') }}">
                            <i class="bi bi-grid-1x2-fill"></i>
                        </a>
                        <i class="bi bi-chevron-right text-[10px]"
                           :class="darkMode ? 'text-slate-500' : 'text-slate-500'"></i>
                        <span class="font-medium"
                              :class="darkMode ? 'text-slate-300' : 'text-slate-500'">{{ __('management_user') }}</span>
                    </nav>
                </div>
            </div>

            {{-- Right Section - Add User Button --}}
            <button wire:click="create" 
                    class="btn-premium text-white text-xs sm:text-sm px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl font-bold flex items-center gap-2 hover:scale-105 active:scale-95 transition-transform shadow-lg">
                <i class="bi bi-plus-lg"></i>
                <span class="hidden sm:inline">{{ __('add_user') }}</span>
            </button>
        </div>
    </div>

    {{-- Bulk Actions Bar --}}
    @if(count($selectedUsers) > 0)
    <div class="mb-4 animate-fade-in-up">
        <div class="rounded-2xl px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between flex-wrap gap-3"
             :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30'">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 btn-premium rounded-lg flex items-center justify-center text-white text-sm font-bold">{{ count($selectedUsers) }}</div>
                <span class="text-sm font-bold" :class="darkMode ? 'text-slate-300' : 'text-slate-600'">
                    {{ count($selectedUsers) }} {{ __('items_selected') }}
                </span>
            </div>
            <div class="flex items-center gap-2">
                <button @click="$dispatch('show-alert', { 
                            title: '{{ __('delete_selected') }}', 
                            message: '{{ __('confirm_delete_users') }}', 
                            type: 'danger', 
                            confirmText: '{{ __('yes_delete') }}', 
                            cancelText: '{{ __('cancel') }}', 
                            onConfirm: () => { $wire.bulkDelete() }
                        })"
                        class="px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 transition-all hover:scale-105 active:scale-95 bg-red-500/10 text-red-500 hover:bg-red-500/20">
                    <i class="bi bi-trash3"></i>
                    <span>{{ __('delete_selected') }}</span>
                </button>
                <button wire:click="$set('selectedUsers', [])"
                        class="px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 transition-all hover:scale-105 active:scale-95"
                        :class="darkMode ? 'bg-white/5 text-slate-400 hover:bg-white/10' : 'bg-slate-200/50 text-slate-500 hover:bg-slate-200'">
                    <i class="bi bi-x-lg"></i>
                    <span>{{ __('cancel') }}</span>
                </button>
            </div>
        </div>
    </div>
    @endif

    {{-- Table Card --}}
    <div class="rounded-2xl sm:rounded-3xl overflow-hidden animate-fade-in-up shadow-2xl"
         :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30 shadow-xl shadow-slate-200/20'">
        
        {{-- Table Header Bar --}}
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b flex items-center justify-between bg-white/5"
             :class="darkMode ? 'border-white/5' : 'border-white/20'">
            <div class="flex items-center gap-3 sm:gap-4">
                {{-- Window Controls --}}
                <div class="flex gap-1.5">
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500/80"></div>
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500/80"></div>
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500/80"></div>
                </div>
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest ml-1 sm:ml-2">
                    {{ __('management_user') }}
                </span>
            </div>
            {{-- Search & Filter --}}
            <div class="flex items-center gap-3">
                <div class="relative group">
                    <input type="text" wire:model.live.debounce.300ms="searchQuery" 
                           placeholder="{{ __('search') }}..."
                           class="w-32 sm:w-48 pl-8 pr-3 py-1.5 rounded-lg text-xs font-medium outline-none transition-all focus:w-40 sm:focus:w-56"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-white/20' : 'bg-slate-50 border border-slate-200 text-slate-600 focus:border-slate-300'">
                    <i class="bi bi-search absolute left-2.5 top-1/2 -translate-y-1/2 text-slate-400 text-xs"></i>
                </div>
                {{-- Filter Icons --}}
                <div class="flex items-center gap-1">
                    <button class="text-slate-400 hover:text-white transition-colors p-1">
                        <i class="bi bi-search"></i>
                    </button>
                    <button class="text-slate-400 hover:text-white transition-colors p-1">
                        <i class="bi bi-funnel"></i>
                    </button>
                </div>
            </div>
        </div>

        {{-- Table Content --}}
        <div class="p-0 sm:p-6 overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-0 sm:border-spacing-y-3">
                <thead class="text-slate-500 text-[10px] font-bold uppercase tracking-widest hidden sm:table-header-group">
                    <tr>
                        <th class="px-4 w-12 text-center">
                            <label class="relative flex items-center justify-center cursor-pointer">
                                <input type="checkbox" wire:model.live="selectAll"
                                       class="w-4 h-4 rounded border-2 appearance-none cursor-pointer transition-all duration-200"
                                       :class="darkMode ? 'border-slate-600 bg-white/5 checked:bg-blue-500 checked:border-blue-500' : 'border-slate-300 bg-white/20 checked:bg-blue-500 checked:border-blue-500'">
                                <i class="bi bi-check absolute text-white text-xs pointer-events-none opacity-0 check-icon"></i>
                                <style>.check-icon { display: none; } input:checked ~ .check-icon { display: block; opacity: 1; }</style>
                            </label>
                        </th>
                        <th class="px-6 py-3">{{ __('item_info') }}</th>
                        <th class="px-6 py-3">{{ __('status') }}</th>
                        <th class="px-6 py-3">{{ __('role') }}</th>
                        <th class="px-6 py-3 text-center">{{ __('action') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 sm:divide-y-0">
                    @forelse($users as $user)
                        <tr wire:key="user-{{ $user->id }}" 
                            class="sm:hover:bg-white/5 transition-all group from-slate-500/5 to-transparent flex flex-col sm:table-row p-4 sm:p-0"
                            :class="darkMode ? 'glass-card' : ''">
                            
                            {{-- Checkbox --}}
                            <td class="p-3 sm:p-4 rounded-l-none sm:rounded-l-2xl border-none hidden sm:table-cell w-12 text-center">
                                <label class="relative flex items-center justify-center cursor-pointer">
                                    <input type="checkbox" wire:model.live="selectedUsers" value="{{ $user->id }}"
                                           class="w-4 h-4 rounded border-2 appearance-none cursor-pointer transition-all duration-200"
                                           :class="darkMode ? 'border-slate-600 bg-white/5 checked:bg-blue-500 checked:border-blue-500' : 'border-slate-300 bg-white/20 checked:bg-blue-500 checked:border-blue-500'">
                                    <i class="bi bi-check absolute text-white text-xs pointer-events-none opacity-0 check-icon"></i>
                                </label>
                            </td>

                            {{-- Item Info --}}
                            <td class="p-3 sm:p-4 border-none">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl flex items-center justify-center text-white shadow-lg flex-shrink-0 font-bold text-sm bg-gradient-to-br from-indigo-500 to-purple-500">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div>
                                        <p class="font-extrabold text-xs sm:text-sm group-hover:text-blue-400 transition-colors" 
                                           :class="darkMode ? 'text-white' : 'text-slate-800'">
                                            {{ $user->name }}
                                        </p>
                                        <p class="text-[10px] sm:text-[11px] text-slate-500 mt-0.5 sm:mt-1">
                                            {{ $user->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-3 pb-3 sm:p-4 border-none flex items-center justify-between sm:table-cell">
                                <span class="sm:hidden text-xs text-slate-400 font-bold">{{ __('status') }}</span>
                                <span class="px-2.5 sm:px-3 py-1 rounded-full text-[9px] sm:text-[10px] font-bold uppercase flex items-center gap-1.5 w-fit
                                    {{ $user->status === 'Active' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500' }}">
                                    <span class="w-1.5 h-1.5 rounded-full {{ $user->status === 'Active' ? 'bg-green-500 animate-pulse' : 'bg-red-500' }}"></span>
                                    <span>{{ $user->status }}</span>
                                </span>
                            </td>

                            {{-- Role --}}
                            <td class="px-3 pb-3 sm:p-4 border-none flex items-center justify-between sm:table-cell">
                                <span class="sm:hidden text-xs text-slate-400 font-bold">{{ __('role') }}</span>
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-opacity-10
                                    {{ $user->role === 'Admin' ? 'bg-purple-500/10 text-purple-500' : ($user->role === 'Editor' ? 'bg-blue-500/10 text-blue-500' : 'bg-slate-500/10 text-slate-500') }}">
                                    {{ $user->role }}
                                </span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-3 pb-3 sm:p-4 rounded-r-none sm:rounded-r-2xl text-center border-none hidden sm:table-cell">
                                <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">
                                    <button @click="open = !open" 
                                            class="p-2 rounded-lg transition-all duration-200"
                                            :class="darkMode ? 'hover:bg-white/10 text-slate-400 hover:text-white' : 'hover:bg-slate-100 text-slate-400 hover:text-slate-600'"
                                            :aria-expanded="open">
                                        <i class="bi bi-three-dots-vertical text-lg"></i>
                                    </button>
                                    
                                    <div x-show="open" 
                                         x-transition:enter="transition ease-out duration-200"
                                         x-transition:enter-start="opacity-0 scale-95 translate-y-2"
                                         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                                         x-transition:leave="transition ease-in duration-150"
                                         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                                         x-transition:leave-end="opacity-0 scale-95 translate-y-2"
                                         class="absolute right-0 z-50 mt-2 w-48 rounded-xl shadow-xl border focus:outline-none overflow-hidden"
                                         :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
                                         style="display: none;" x-show.important="open">
                                        
                                        <div class="py-1.5 flex flex-col text-left">
                                            <!-- View -->
                                            <button @click="viewUser = {{ json_encode($user) }}; showViewModal = true; open = false" 
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-blue-400' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'">
                                                <i class="bi bi-eye mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('view_details') }}
                                            </button>

                                            <!-- Edit -->
                                            <button wire:click="edit({{ $user->id }})" @click="open = false"
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-yellow-400' : 'text-slate-600 hover:bg-slate-50 hover:text-yellow-600'">
                                                <i class="bi bi-pencil-square mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('edit_user') }}
                                            </button>
                                            
                                            <div class="my-1 border-t" :class="darkMode ? 'border-white/5' : 'border-slate-100'"></div>

                                            <!-- Delete -->
                                            <button @click="$dispatch('show-alert', { 
                                                        title: '{{ __('delete_user') }}', 
                                                        message: '{{ __('confirm_delete_user') }}', 
                                                        type: 'danger', 
                                                        confirmText: '{{ __('yes_delete') }}', 
                                                        cancelText: '{{ __('cancel') }}', 
                                                        onConfirm: () => { $wire.delete({{ $user->id }}) }
                                                    }); open = false"
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-red-400' : 'text-slate-600 hover:bg-slate-50 hover:text-red-600'">
                                                <i class="bi bi-trash mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('delete_user') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            
                            {{-- Mobile Actions --}}
                            <td class="px-3 pb-3 border-none sm:hidden flex justify-end border-t pt-3 relative"
                                :class="darkMode ? 'border-white/5' : 'border-slate-100'">
                                <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">
                                    <button @click="open = !open" 
                                            class="p-2 rounded-lg transition-all duration-200 flex items-center gap-2 text-xs font-bold"
                                            :class="darkMode ? 'bg-white/5 text-slate-400 hover:text-white' : 'bg-slate-100 text-slate-500 hover:text-slate-700'"
                                            :aria-expanded="open">
                                        <span>{{ __('actions') }}</span>
                                        <i class="bi bi-three-dots-vertical"></i>
                                    </button>
                                    
                                    <div x-show="open" 
                                         class="absolute right-0 bottom-full mb-2 z-50 w-48 rounded-xl shadow-xl border focus:outline-none overflow-hidden origin-bottom-right"
                                         :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
                                         style="display: none;" x-show.important="open">
                                        
                                        <div class="py-1.5 flex flex-col text-left">
                                            <!-- Actions duplicates of desktop for mobile -->
                                             <button @click="viewUser = {{ json_encode($user) }}; showViewModal = true; open = false" 
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-blue-400' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'">
                                                <i class="bi bi-eye mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('view_details') }}
                                            </button>
                                             <button wire:click="edit({{ $user->id }})" @click="open = false"
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-yellow-400' : 'text-slate-600 hover:bg-slate-50 hover:text-yellow-600'">
                                                <i class="bi bi-pencil-square mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('edit_user') }}
                                            </button>
                                            <div class="my-1 border-t" :class="darkMode ? 'border-white/5' : 'border-slate-100'"></div>
                                            <!-- Delete -->
                                            <button @click="$dispatch('show-alert', { 
                                                        title: '{{ __('delete_user') }}', 
                                                        message: '{{ __('confirm_delete_user') }}', 
                                                        type: 'danger', 
                                                        confirmText: '{{ __('yes_delete') }}', 
                                                        cancelText: '{{ __('cancel') }}', 
                                                        onConfirm: () => { $wire.delete({{ $user->id }}) }
                                                    }); open = false"
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-red-400' : 'text-slate-600 hover:bg-slate-50 hover:text-red-600'">
                                                <i class="bi bi-trash mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('delete_user') }}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        {{-- Empty State --}}
                        <tr>
                            <td colspan="5" class="text-center py-12">
                                <div class="flex flex-col items-center gap-3">
                                    <div class="w-16 h-16 rounded-2xl flex items-center justify-center"
                                         :class="darkMode ? 'bg-white/5' : 'bg-slate-100'">
                                        <i class="bi bi-people text-3xl text-slate-400"></i>
                                    </div>
                                    <p class="text-sm font-bold text-slate-400">{{ __('no_data') }}</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Table Footer --}}
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-t flex items-center justify-between bg-white/5"
             :class="darkMode ? 'border-white/5' : 'border-white/20'">
            <div class="w-full">
                {{ $users->links() }}
            </div>
        </div>
    </div>

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
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all hover:scale-110"
                        :class="darkMode ? 'hover:bg-white/10 text-slate-400' : 'hover:bg-slate-100 text-slate-500'">
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
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-105 active:scale-95"
                        :class="darkMode ? 'bg-white/5 text-slate-300 hover:bg-white/10' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'">
                    {{ __('cancel') }}
                </button>
                <button wire:click="{{ $isEdit ? 'update' : 'store' }}"
                        class="btn-premium text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-105 active:scale-95 shadow-lg">
                    <i class="bi bi-check-lg mr-1"></i>
                    {{ __('save') }}
                </button>
            </div>
        </div>
    </div>

    {{-- View User Modal --}}
    <div x-show="showViewModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showViewModal = false"></div>
        <div x-show="showViewModal"
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="relative w-full max-w-md rounded-3xl shadow-2xl overflow-hidden z-10 border"
             :class="darkMode ? 'bg-slate-900/95 backdrop-blur-xl border-white/10' : 'bg-white/95 backdrop-blur-xl border-slate-200'">
            
            {{-- Header --}}
            <div class="px-6 py-5 border-b flex items-center justify-between"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center text-white">
                        <i class="bi bi-person"></i>
                    </div>
                    <h3 class="text-lg font-extrabold">{{ __('view_details') }}</h3>
                </div>
                <button @click="showViewModal = false" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all hover:scale-110"
                        :class="darkMode ? 'hover:bg-white/10 text-slate-400' : 'hover:bg-slate-100 text-slate-500'">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            {{-- Body --}}
            <div class="px-6 py-6" x-if="viewUser">
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
            {{-- Footer --}}
            <div class="px-6 py-4 border-t flex justify-end"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                <button @click="showViewModal = false"
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-105 active:scale-95"
                        :class="darkMode ? 'bg-white/5 text-slate-300 hover:bg-white/10' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'">
                    {{ __('close') }}
                </button>
            </div>
        </div>
    </div>
</div>
