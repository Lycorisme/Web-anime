{{-- Table Card --}}
    <div class="rounded-2xl sm:rounded-3xl overflow-hidden animate-fade-in-up shadow-2xl"
         :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30 shadow-xl shadow-slate-200/20'">
        
        {{-- Table Header Bar --}}
        <div class="px-4 sm:px-6 border-b flex items-stretch justify-between bg-white/5 h-14 sm:h-16"
             :class="darkMode ? 'border-white/5' : 'border-white/20'">
            <div class="flex items-center gap-3 sm:gap-6">
                {{-- Window Controls --}}
                <div class="flex gap-1.5 flex-shrink-0">
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500/80"></div>
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500/80"></div>
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500/80"></div>
                </div>
                
                <div class="h-full flex items-center pl-4 sm:pl-6">
                    <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest">
                        {{ __('management_user') }}
                    </span>
                </div>

            </div>

            {{-- Actions & Filter --}}
            <div class="flex items-stretch gap-1 sm:gap-2 pr-1">
                {{-- Filter Icons --}}
                <button class="btn-icon w-8 h-8 sm:w-10 sm:h-10 rounded-lg p-1 hover:bg-white/5 self-center">
                    <i class="bi bi-search text-base"></i>
                </button>
                <button class="btn-icon w-8 h-8 sm:w-10 sm:h-10 rounded-lg p-1 hover:bg-white/5 self-center">
                    <i class="bi bi-funnel text-base"></i>
                </button>

                {{-- Add User Button as Integrated Tab --}}
                <button wire:click="create" 
                        class="btn-header-tab group relative flex items-center gap-2 px-4 h-full transition-all border-b-2 border-transparent hover:border-blue-500/50">
                    <i class="bi bi-plus-circle-fill text-blue-500 transition-transform group-hover:scale-110"></i>
                    <span class="text-xs sm:text-sm font-bold tracking-tight"
                          :class="darkMode ? 'text-white/90' : 'text-slate-800'">
                        {{ __('add_user') }}
                    </span>
                    {{-- Active Indicator Line --}}
                    <div class="absolute bottom-[-1px] left-0 w-full h-0.5 bg-gradient-to-r from-blue-500 to-indigo-500 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                </button>
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
                                <div x-data="{
                                    open: false,
                                    uid: 'dropdown-{{ $user->id }}',
                                    dropdownStyle: { top: '0px', left: '0px' },
                                    rafId: null,
                                    updatePosition() {
                                        const btn = this.$refs.triggerBtn;
                                        const menu = this.$refs.dropdownMenu;
                                        if (!btn) return;
                                        const rect = btn.getBoundingClientRect();
                                        const dropdownW = 192;
                                        const dropdownH = menu ? menu.offsetHeight : 150;
                                        const gap = 4;
                                        const vw = window.innerWidth;
                                        const vh = window.innerHeight;

                                        let top, left;

                                        // Vertical: prefer below, fallback above
                                        if (vh - rect.bottom >= dropdownH + gap) {
                                            top = rect.bottom + gap;
                                        } else if (rect.top >= dropdownH + gap) {
                                            top = rect.top - dropdownH - gap;
                                        } else {
                                            top = Math.max(gap, vh - dropdownH - gap);
                                        }

                                        // Horizontal: prefer align right edge to button
                                        if (rect.right >= dropdownW) {
                                            left = rect.right - dropdownW;
                                        } else {
                                            left = rect.left;
                                        }

                                        // Clamp to viewport
                                        if (left + dropdownW > vw) left = vw - dropdownW - gap;
                                        if (left < gap) left = gap;
                                        if (top + dropdownH > vh) top = vh - dropdownH - gap;
                                        if (top < gap) top = gap;

                                        this.dropdownStyle = {
                                            top: top + 'px',
                                            left: left + 'px'
                                        };
                                    },
                                    startTracking() {
                                        const track = () => {
                                            if (!this.open) return;
                                            this.updatePosition();
                                            this.rafId = requestAnimationFrame(track);
                                        };
                                        track();
                                    },
                                    stopTracking() {
                                        if (this.rafId) {
                                            cancelAnimationFrame(this.rafId);
                                            this.rafId = null;
                                        }
                                    },
                                    toggleDropdown() {
                                        if (this.open) {
                                            this.open = false;
                                            this.stopTracking();
                                        } else {
                                            // Close any other open dropdown first
                                            window.dispatchEvent(new CustomEvent('close-action-dropdowns', { detail: this.uid }));
                                            this.open = true;
                                            this.$nextTick(() => {
                                                this.updatePosition();
                                                this.startTracking();
                                            });
                                        }
                                    },
                                    closeDropdown(e) {
                                        if (!this.$refs.triggerBtn.contains(e.target) &&
                                            !(this.$refs.dropdownMenu && this.$refs.dropdownMenu.contains(e.target))) {
                                            this.open = false;
                                            this.stopTracking();
                                        }
                                    },
                                    handleCloseOthers(e) {
                                        if (e.detail !== this.uid && this.open) {
                                            this.open = false;
                                            this.stopTracking();
                                        }
                                    }
                                }" x-init="$nextTick(() => {
                                    document.addEventListener('click', (e) => closeDropdown(e));
                                    window.addEventListener('close-action-dropdowns', (e) => handleCloseOthers(e));
                                })"
                                   class="relative inline-block text-left">
                                    <button x-ref="triggerBtn" @click.stop="toggleDropdown()"
                                            class="btn-icon p-2 w-9 h-9 rounded-lg"
                                            :aria-expanded="open">
                                        <i class="bi bi-three-dots-vertical text-lg"></i>
                                    </button>

                                    <template x-teleport="body">
                                        <div x-show="open" x-ref="dropdownMenu"
                                             x-transition:enter="transition ease-out duration-200"
                                             x-transition:enter-start="opacity-0 scale-95"
                                             x-transition:enter-end="opacity-100 scale-100"
                                             x-transition:leave="transition ease-in duration-150"
                                             x-transition:leave-start="opacity-100 scale-100"
                                             x-transition:leave-end="opacity-0 scale-95"
                                             class="fixed z-[9999] w-48 rounded-xl shadow-2xl border focus:outline-none overflow-hidden"
                                             :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
                                             :style="`top: ${dropdownStyle.top}; left: ${dropdownStyle.left};`"
                                             style="display: none;">

                                            <div class="py-1.5 flex flex-col text-left">
                                                <!-- View -->
                                                <button @click="viewUser = {{ json_encode($user) }}; showViewModal = true; open = false; stopTracking()"
                                                        class="group flex w-full items-center px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                        :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-blue-400' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'">
                                                    <i class="bi bi-eye mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                    {{ __('view_details') }}
                                                </button>

                                                <!-- Edit -->
                                                <button wire:click="edit({{ $user->id }})" @click="open = false; stopTracking()"
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
                                                        }); open = false; stopTracking()"
                                                        class="group flex w-full items-center px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                        :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-red-400' : 'text-slate-600 hover:bg-slate-50 hover:text-red-600'">
                                                    <i class="bi bi-trash mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                    {{ __('delete_user') }}
                                                </button>
                                            </div>
                                        </div>
                                    </template>
                                </div>
                            </td>
                            
                            {{-- Mobile Actions --}}
                            <td class="px-3 pb-3 border-none sm:hidden flex justify-end border-t pt-3 relative"
                                :class="darkMode ? 'border-white/5' : 'border-slate-100'">
                                <div x-data="{ open: false }" @click.outside="open = false" class="relative inline-block text-left">
                                    <button @click="open = !open" 
                                            class="btn-ghost p-2 rounded-lg flex items-center gap-2 text-xs font-bold"
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
