{{-- Anime Form Modal (Add/Edit with MAL Paste) --}}
<template x-teleport="body">
    <div x-show="showModal" class="fixed inset-0 z-[99999] flex items-center justify-center px-4" style="display: none;">
        <div x-show="showModal" class="absolute inset-0 bg-black/50 backdrop-blur-sm"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <div x-show="showModal" x-data="{ activeTab: 'paste' }"
             class="relative w-full max-w-3xl max-h-[90vh] rounded-2xl shadow-2xl overflow-hidden transform transition-all border flex flex-col"
             :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95"
             @mal-parsed.window="activeTab = 'manual'">

            {{-- Header --}}
            <div class="px-6 py-4 border-b flex items-center justify-between relative z-10 flex-shrink-0"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg"
                         style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                        <i class="bi" :class="$wire.isEditing ? 'bi-pencil-square' : 'bi-plus-circle'"></i>
                    </div>
                    <h3 class="font-bold text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">
                        <span x-text="$wire.isEditing ? '{{ __('edit_anime') }}' : '{{ __('add_anime') }}'"></span>
                    </h3>
                </div>
                <button @click="showModal = false; $wire.resetInputFields()"
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:bg-white/5 hover:text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800'">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            {{-- Tabs (only when adding) --}}
            <div class="flex border-b relative z-10 flex-shrink-0"
                 :class="darkMode ? 'border-white/5' : 'border-slate-100'" x-show="!$wire.isEditing">
                <button @click="activeTab = 'paste'"
                        class="flex-1 px-4 py-3 text-sm font-bold transition-all relative"
                        :class="activeTab === 'paste' ? (darkMode ? 'text-white' : 'text-slate-800') : (darkMode ? 'text-slate-500 hover:text-slate-300' : 'text-slate-400 hover:text-slate-600')">
                    <i class="bi bi-clipboard-data mr-1.5"></i> {{ __('paste_from_mal') }}
                    <div x-show="activeTab === 'paste'" class="absolute bottom-0 left-0 right-0 h-0.5 rounded-full"
                         style="background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));"></div>
                </button>
                <button @click="activeTab = 'manual'"
                        class="flex-1 px-4 py-3 text-sm font-bold transition-all relative"
                        :class="activeTab === 'manual' ? (darkMode ? 'text-white' : 'text-slate-800') : (darkMode ? 'text-slate-500 hover:text-slate-300' : 'text-slate-400 hover:text-slate-600')">
                    <i class="bi bi-input-cursor-text mr-1.5"></i> {{ __('manual_input') }}
                    <div x-show="activeTab === 'manual'" class="absolute bottom-0 left-0 right-0 h-0.5 rounded-full"
                         style="background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));"></div>
                </button>
            </div>

            {{-- Body --}}
            <div class="overflow-y-auto flex-1 p-6 relative z-10 custom-scrollbar">
                @include('livewire.partials.anime-form-paste-tab')
                @include('livewire.partials.anime-form-manual-tab')
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t flex items-center justify-end gap-3 relative z-10 flex-shrink-0"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                <button @click="showModal = false; $wire.resetInputFields()"
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/5' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200'">
                    {{ __('cancel') }}
                </button>
                <button wire:click="{{ $isEditing ? 'update' : 'store' }}"
                        x-show="activeTab === 'manual' || $wire.isEditing"
                        class="px-6 py-2.5 rounded-xl text-sm font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2"
                        style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                    <i class="bi" :class="$wire.isEditing ? 'bi-check-lg' : 'bi-plus-circle'"></i>
                    <span x-text="$wire.isEditing ? '{{ __('save') }}' : '{{ __('add_anime') }}'"></span>
                </button>
            </div>
        </div>
    </div>
</template>
