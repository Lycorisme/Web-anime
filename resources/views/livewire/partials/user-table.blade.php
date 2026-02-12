<x-ui.card-table :title="__('management_user')">
    <x-slot:actions>
        {{-- Search Icon --}}
        <button class="btn-icon w-8 h-8 sm:w-10 sm:h-10 rounded-lg p-1 hover:bg-white/5">
            <i class="bi bi-search text-base"></i>
        </button>
        
        {{-- Filter Icon --}}
        <button class="btn-icon w-8 h-8 sm:w-10 sm:h-10 rounded-lg p-1 hover:bg-white/5">
            <i class="bi bi-funnel text-base"></i>
        </button>

        {{-- Add User Button --}}
        <button wire:click="create" 
                class="btn-icon w-8 h-8 sm:w-10 sm:h-10 rounded-lg p-1 hover:bg-white/5 text-blue-500 hover:text-blue-400">
            <i class="bi bi-plus-circle-fill text-lg sm:text-xl transition-transform hover:rotate-90"></i>
        </button>
    </x-slot:actions>

    <table class="w-full text-left border-separate border-spacing-y-3">
        <thead class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">
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
        <tbody class="divide-y-0">
            @forelse($users as $user)
                <tr wire:key="user-{{ $user->id }}" 
                    class="hover:bg-white/5 transition-all group from-slate-500/5 to-transparent table-row"
                    :class="darkMode ? 'glass-card' : ''">
                    
                    {{-- Checkbox --}}
                    <td class="p-4 rounded-l-2xl border-none w-12 text-center">
                        <label class="relative flex items-center justify-center cursor-pointer">
                            <input type="checkbox" wire:model.live="selectedUsers" value="{{ $user->id }}"
                                   class="w-4 h-4 rounded border-2 appearance-none cursor-pointer transition-all duration-200"
                                   :class="darkMode ? 'border-slate-600 bg-white/5 checked:bg-blue-500 checked:border-blue-500' : 'border-slate-300 bg-white/20 checked:bg-blue-500 checked:border-blue-500'">
                            <i class="bi bi-check absolute text-white text-xs pointer-events-none opacity-0 check-icon"></i>
                        </label>
                    </td>

                    {{-- Item Info --}}
                    <td class="p-4 border-none">
                        <div class="flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl flex items-center justify-center text-white shadow-lg flex-shrink-0 font-bold text-sm bg-gradient-to-br from-indigo-500 to-purple-500">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            <div>
                                <p class="font-extrabold text-sm group-hover:text-blue-400 transition-colors" 
                                   :class="darkMode ? 'text-white' : 'text-slate-800'">
                                    {{ $user->name }}
                                </p>
                                <p class="text-[11px] text-slate-500 mt-1">
                                    {{ $user->email }}
                                </p>
                            </div>
                        </div>
                    </td>

                    {{-- Status --}}
                    <td class="p-4 border-none">
                        <div class="flex items-center justify-start">
                            <x-ui.status-badge :status="$user->status" />
                        </div>
                    </td>

                    {{-- Role --}}
                    <td class="p-4 border-none">
                        <div class="flex items-center justify-start">
                            <x-ui.status-badge :status="$user->role" :showDot="false" />
                        </div>
                    </td>

                    {{-- Actions --}}
                    <td class="p-4 rounded-r-2xl text-center border-none">
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

    <x-slot:footer>
        {{ $users->links() }}
    </x-slot:footer>
</x-ui.card-table>
