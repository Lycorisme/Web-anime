{{-- Anime Form Modal (Add/Edit Wizard) --}}
<template x-teleport="body">
    <div x-show="showModal" class="fixed inset-0 z-[99999] flex items-center justify-center px-4" style="display: none;">
        <div x-show="showModal" class="absolute inset-0 bg-black/60 backdrop-blur-md"
             x-transition:enter="transition-opacity ease-[0.23,1,0.32,1] duration-700" 
             x-transition:enter-start="opacity-0" 
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-in-out duration-500" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0"></div>

        <div x-show="showModal" 
             x-data="{ 
                 slide: 1, 
                 maxSlide: 5,
                 init() {
                     this.$watch('showModal', (val) => {
                         if (val) {
                             this.slide = this.$wire.isEditing ? 2 : 1;
                         }
                     });
                 }
             }"
             class="relative w-full max-w-3xl h-[600px] rounded-2xl shadow-2xl overflow-hidden transform border flex flex-col"
             :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
             x-transition:enter="transition-all ease-[0.23,1,0.32,1] duration-700" 
             x-transition:enter-start="opacity-0 translate-y-12 scale-95 blur-sm" 
             x-transition:enter-end="opacity-100 translate-y-0 scale-100 blur-none"
             x-transition:leave="transition-all ease-in-out duration-500" 
             x-transition:leave-start="opacity-100 translate-y-0 scale-100 blur-none" 
             x-transition:leave-end="opacity-0 translate-y-12 scale-95 blur-sm"
             @mal-parsed.window="slide = 2">

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

            {{-- Wizard Progress Bar --}}
            <div class="w-full h-1 bg-slate-200 dark:bg-white/5 flex-shrink-0">
                <div class="h-full transition-all duration-300"
                     style="background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));"
                     :style="`width: ${((slide - ($wire.isEditing ? 1 : 0)) / (maxSlide - ($wire.isEditing ? 1 : 0))) * 100}%`"></div>
            </div>

            {{-- Body --}}
            <div class="overflow-y-auto flex-1 p-6 relative z-10 custom-scrollbar overflow-x-hidden min-h-[300px]">
                @include('livewire.partials.anime-form-paste-tab')
                @include('livewire.partials.anime-form-manual-tab')
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t flex items-center justify-between gap-3 relative z-10 flex-shrink-0"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                
                {{-- Left: Cancel or Prev --}}
                <div class="flex gap-2">
                    <button x-show="slide === ($wire.isEditing ? 2 : 1)" @click="showModal = false; $wire.resetInputFields()"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold transition-colors"
                            :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/5' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200'">
                        {{ __('cancel') }}
                    </button>
                    <button x-show="slide > ($wire.isEditing ? 2 : 1)" @click="slide--"
                            class="px-5 py-2.5 rounded-xl text-sm font-bold transition-colors flex items-center gap-2 border"
                            :class="darkMode ? 'text-slate-300 border-white/10 hover:bg-white/5' : 'text-slate-700 border-slate-200 hover:bg-slate-50'">
                        <i class="bi bi-chevron-left"></i> {{ __('back') ?? 'Back' }}
                    </button>
                </div>

                {{-- Right: Next or Save --}}
                <div>
                    <button x-show="slide < maxSlide" @click="slide++"
                            class="px-6 py-2.5 rounded-xl text-sm font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2"
                            style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                        {{ __('next') ?? 'Next' }} <i class="bi bi-chevron-right"></i>
                    </button>
                    
                    <button x-show="slide === maxSlide" wire:click="{{ $isEditing ? 'update' : 'store' }}"
                            class="px-6 py-2.5 rounded-xl text-sm font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2"
                            style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                        <i class="bi" :class="$wire.isEditing ? 'bi-check-lg' : 'bi-plus-circle'"></i>
                        <span x-text="$wire.isEditing ? '{{ __('save') }}' : '{{ __('add_anime') }}'"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
