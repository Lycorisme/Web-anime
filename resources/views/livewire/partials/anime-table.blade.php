{{-- Anime Table/Grid View --}}
<x-ui.card-table :title="__('anime_list')">
    <x-slot:actions>
        <div class="flex items-center gap-1 sm:gap-2"
             x-data="{
                showFilterModal: false,
                showSearchModal: false,
                init() {
                    this.$watch('showFilterModal', val => {
                        document.body.style.overflow = val ? 'hidden' : '';
                    });
                    this.$watch('showSearchModal', val => {
                        document.body.style.overflow = val ? 'hidden' : '';
                        if(val) this.$nextTick(() => {
                            setTimeout(() => $refs.animeSearchInput.focus(), 100);
                        });
                    });
                }
             }">

            {{-- Search Icon --}}
            <button @click="showSearchModal = true"
                    class="btn-icon w-8 h-8 sm:w-10 sm:h-10 rounded-lg p-1 hover:bg-white/5 transition-colors"
                    :style="(showSearchModal || '{{ $search ?? '' }}' !== '') ? 'color: var(--gradient-start); background-color: color-mix(in srgb, var(--gradient-start) 10%, transparent);' : ''">
                <i class="bi bi-search text-base"></i>
            </button>

            {{-- Filter Icon --}}
            <button @click="showFilterModal = true"
                    class="btn-icon w-8 h-8 sm:w-10 sm:h-10 rounded-lg p-1 hover:bg-white/5 transition-colors relative"
                    :style="(showFilterModal || ('{{ $filterType }}' !== '' || '{{ $filterWatchStatus }}' !== '')) ? 'color: var(--gradient-start); background-color: color-mix(in srgb, var(--gradient-start) 10%, transparent);' : ''">
                <i class="bi bi-funnel text-base"></i>
                @if($filterType || $filterWatchStatus)
                    <span class="absolute top-2 right-2 w-1.5 h-1.5 rounded-full ring-2 ring-white dark:ring-slate-900" style="background-color: var(--gradient-start)"></span>
                @endif
            </button>

            {{-- Add Anime Button --}}
            <button wire:click="create"
                    class="btn-icon w-8 h-8 sm:w-10 sm:h-10 rounded-lg p-1 hover:bg-white/5 text-blue-500 hover:text-blue-400">
                <i class="bi bi-plus-circle-fill text-lg sm:text-xl transition-transform hover:rotate-90"></i>
            </button>

            {{-- Filter Modal --}}
            <template x-teleport="body">
                <div x-show="showFilterModal"
                     class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
                     style="display: none;">

                    {{-- Backdrop --}}
                    <div x-show="showFilterModal"
                         class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0"
                         x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100"
                         x-transition:leave-end="opacity-0"></div>

                    {{-- Modal Content --}}
                    <div x-show="showFilterModal"
                         class="relative w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden transform transition-all border group"
                         :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
                         x-transition:enter="ease-out duration-300"
                         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                         x-transition:leave-end="opacity-0 translate-y-4 scale-95">

                        {{-- Glow --}}
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none rounded-2xl"
                             style="background: linear-gradient(135deg, color-mix(in srgb, var(--gradient-start) 5%, transparent), color-mix(in srgb, var(--gradient-end) 5%, transparent));"></div>

                        {{-- Blob Particles --}}
                        <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-2xl opacity-50">
                            <div class="absolute top-10 left-10 w-20 h-20 bg-blue-500/10 rounded-full blur-2xl animate-blob"></div>
                            <div class="absolute top-10 right-10 w-20 h-20 bg-purple-500/10 rounded-full blur-2xl animate-blob animation-delay-2000"></div>
                            <div class="absolute bottom-10 left-20 w-20 h-20 bg-pink-500/10 rounded-full blur-2xl animate-blob animation-delay-4000"></div>
                        </div>

                        {{-- Header --}}
                        <div class="px-5 py-4 border-b flex items-center justify-between relative z-10"
                             :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg"
                                     style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                                    <i class="bi bi-sliders text-lg"></i>
                                </div>
                                <h3 class="font-bold text-base sm:text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">
                                    {{ __('filter_options') }}
                                </h3>
                            </div>
                            <button @click="showFilterModal = false"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                                    :class="darkMode ? 'text-slate-400 hover:bg-white/5 hover:text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800'">
                                <i class="bi bi-x-lg text-sm"></i>
                            </button>
                        </div>

                        {{-- Body --}}
                        <div class="p-5 space-y-5 relative z-20">
                            {{-- Type Filter --}}
                            <div>
                                <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                                       :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                    <i class="bi bi-collection-play mr-1"></i> {{ __('type') }}
                                </label>
                                <select wire:model.live="filterType"
                                        class="w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all"
                                        :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                    <option value="">{{ __('all_types') }}</option>
                                    @foreach($types as $t)
                                        <option value="{{ $t }}">{{ $t }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Watch Status Filter --}}
                            <div>
                                <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                                       :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                    <i class="bi bi-eye mr-1"></i> {{ __('watch_status') }}
                                </label>
                                <select wire:model.live="filterWatchStatus"
                                        class="w-full px-4 py-3 rounded-xl border text-sm font-medium appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all"
                                        :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'">
                                    <option value="">{{ __('all_statuses') }}</option>
                                    @foreach($watchStatuses as $ws)
                                        <option value="{{ $ws }}">{{ __(str_replace(' ', '_', $ws)) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="px-5 py-4 border-t flex items-center justify-between gap-3 relative z-10"
                             :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                            <button wire:click="$set('filterType', ''); $set('filterWatchStatus', '')"
                                    @click="showFilterModal = false"
                                    class="px-4 py-2 rounded-xl text-xs font-bold transition-colors"
                                    :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/5' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200'">
                                {{ __('reset_filter') }}
                            </button>
                            <button @click="showFilterModal = false"
                                    class="px-6 py-2 rounded-xl text-xs font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5"
                                    style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--gradient-start) 40%, transparent);">
                                {{ __('apply_filter') }}
                            </button>
                        </div>
                    </div>
                </div>
            </template>

            {{-- Search Modal --}}
            <template x-teleport="body">
                <div x-show="showSearchModal"
                     class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
                     style="display: none;">

                    <div x-show="showSearchModal"
                         class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity"
                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

                    <div x-show="showSearchModal"
                         class="relative w-full max-w-2xl rounded-2xl shadow-2xl overflow-hidden transform transition-all border group"
                         :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
                         x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                         x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95">

                        <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none rounded-2xl"
                             style="background: linear-gradient(135deg, color-mix(in srgb, var(--gradient-start) 5%, transparent), color-mix(in srgb, var(--gradient-end) 5%, transparent));"></div>

                        {{-- Header --}}
                        <div class="px-5 py-4 border-b flex items-center justify-between relative z-10"
                             :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg"
                                     style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                                    <i class="bi bi-search text-lg"></i>
                                </div>
                                <h3 class="font-bold text-base sm:text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">
                                    {{ __('search_anime') }}
                                </h3>
                            </div>
                            <button @click="showSearchModal = false"
                                    class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                                    :class="darkMode ? 'text-slate-400 hover:bg-white/5 hover:text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800'">
                                <i class="bi bi-x-lg text-sm"></i>
                            </button>
                        </div>

                        {{-- Body --}}
                        <div class="p-6 relative z-20">
                            <div class="relative group/input">
                                <i class="bi bi-search absolute left-4 top-1/2 -translate-y-1/2 text-lg transition-colors"
                                   :class="darkMode ? 'text-slate-400 group-focus-within/input:text-blue-400' : 'text-slate-500 group-focus-within/input:text-blue-500'"></i>
                                <input type="text"
                                       wire:model.live.debounce.300ms="search"
                                       x-ref="animeSearchInput"
                                       class="w-full pl-12 pr-4 py-4 rounded-xl border appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-base font-medium placeholder-slate-400/50"
                                       :class="darkMode ? 'bg-white/5 border-white/10 text-white focus:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 focus:bg-white'"
                                       placeholder="{{ __('search_anime_placeholder') }}..."
                                       @keydown.enter="showSearchModal = false">

                                <button x-show="($wire.search || '').length > 0"
                                        wire:click="$set('search', '')"
                                        class="absolute right-4 top-1/2 -translate-y-1/2 p-1 rounded-full transition-colors"
                                        :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/10' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200'">
                                    <i class="bi bi-x-circle-fill"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="px-5 py-4 border-t flex items-center justify-end gap-3 relative z-10"
                             :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                            <button @click="showSearchModal = false"
                                    class="px-6 py-2 rounded-xl text-xs font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2"
                                    style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)); box-shadow: 0 10px 15px -3px color-mix(in srgb, var(--gradient-start) 40%, transparent);">
                                <i class="bi bi-search"></i>
                                {{ __('search') }}
                            </button>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </x-slot:actions>

    {{-- Anime Grid/Cards --}}
    <div class="p-4 sm:p-6">
        @if($animes->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 sm:gap-5">
                @foreach($animes as $anime)
                    <div wire:key="anime-{{ $anime->id }}"
                         class="group relative rounded-xl overflow-hidden cursor-pointer transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl"
                         :class="darkMode ? 'bg-white/5 hover:bg-white/10 border border-white/5 hover:border-white/20' : 'bg-white hover:bg-slate-50 border border-slate-200 hover:border-slate-300 shadow-md'"
                         @click="viewAnime = {{ json_encode($anime) }}; showViewModal = true;">

                        {{-- Cover Image --}}
                        <div class="aspect-[3/4] w-full overflow-hidden relative">
                            @if($anime->image_url)
                                <img src="{{ $anime->image_url }}" 
                                     alt="{{ $anime->title }}"
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                                     loading="lazy"
                                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                <div class="w-full h-full items-center justify-center hidden"
                                     style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                                    <i class="bi bi-film text-4xl text-white/60"></i>
                                </div>
                            @else
                                <div class="w-full h-full flex items-center justify-center"
                                     style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                                    <i class="bi bi-film text-4xl text-white/60"></i>
                                </div>
                            @endif

                            {{-- Score Badge --}}
                            @if($anime->personal_score)
                                <div class="absolute top-2 right-2 px-2 py-1 rounded-lg text-xs font-extrabold text-white shadow-lg backdrop-blur-md"
                                     style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                                    <i class="bi bi-star-fill text-yellow-300 mr-0.5"></i> {{ $anime->personal_score }}
                                </div>
                            @elseif($anime->mal_score)
                                <div class="absolute top-2 right-2 px-2 py-1 rounded-lg text-xs font-extrabold text-white/90 bg-black/50 backdrop-blur-md shadow-lg">
                                    <i class="bi bi-star-fill text-yellow-400 mr-0.5"></i> {{ $anime->mal_score }}
                                </div>
                            @endif

                            {{-- Type Badge --}}
                            <div class="absolute top-2 left-2 px-2 py-0.5 rounded-md text-[10px] font-bold uppercase tracking-wider text-white bg-black/50 backdrop-blur-md">
                                {{ $anime->type }}
                            </div>

                            {{-- Watch Status Strip --}}
                            @php
                                $statusColors = [
                                    'completed' => 'bg-emerald-500',
                                    'watching' => 'bg-blue-500',
                                    'on_hold' => 'bg-yellow-500',
                                    'dropped' => 'bg-red-500',
                                    'plan_to_watch' => 'bg-slate-500',
                                ];
                                $statusColor = $statusColors[$anime->watch_status] ?? 'bg-slate-500';
                            @endphp
                            <div class="absolute bottom-0 left-0 right-0 h-1 {{ $statusColor }}"></div>

                            {{-- Hover Gradient Overlay --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

                            {{-- Hover Actions --}}
                            <div class="absolute bottom-3 left-0 right-0 flex items-center justify-center gap-2 opacity-0 group-hover:opacity-100 translate-y-2 group-hover:translate-y-0 transition-all duration-300">
                                <button wire:click.stop="edit({{ $anime->id }})"
                                        class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-white/30 transition-colors"
                                        title="{{ __('edit') }}">
                                    <i class="bi bi-pencil-square text-sm"></i>
                                </button>
                                <button @click.stop="$dispatch('show-alert', {
                                            title: '{{ __('delete_anime') }}',
                                            message: '{{ __('confirm_delete_anime') }}',
                                            type: 'danger',
                                            confirmText: '{{ __('yes_delete') }}',
                                            cancelText: '{{ __('cancel') }}',
                                            onConfirm: () => { $wire.delete({{ $anime->id }}) }
                                        })"
                                        class="w-8 h-8 rounded-lg bg-white/20 backdrop-blur-md flex items-center justify-center text-white hover:bg-red-500/50 transition-colors"
                                        title="{{ __('delete') }}">
                                    <i class="bi bi-trash text-sm"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Info --}}
                        <div class="p-3">
                            <h3 class="text-xs sm:text-sm font-bold truncate leading-tight"
                                :class="darkMode ? 'text-white' : 'text-slate-800'"
                                title="{{ $anime->title }}">
                                {{ $anime->title }}
                            </h3>
                            <div class="flex items-center gap-2 mt-1.5">
                                @if($anime->episodes)
                                    <span class="text-[10px] font-medium"
                                          :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                        {{ $anime->episodes }} {{ __('eps') }}
                                    </span>
                                @endif
                                @if($anime->premiered)
                                    <span class="text-[10px] font-medium"
                                          :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                                        {{ $anime->premiered }}
                                    </span>
                                @endif
                            </div>
                            <div class="mt-2">
                                <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-md text-[10px] font-bold {{ $statusColor }} text-white">
                                    {{ __(str_replace(' ', '_', $anime->watch_status)) }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-16">
                <div class="flex flex-col items-center gap-4">
                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center"
                         :class="darkMode ? 'bg-white/5' : 'bg-slate-100'">
                        <i class="bi bi-film text-4xl text-slate-400"></i>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-slate-400">{{ __('no_anime_data') }}</p>
                        <p class="text-xs text-slate-500 mt-1">{{ __('add_first_anime') }}</p>
                    </div>
                    <button wire:click="create"
                            class="mt-2 px-6 py-2.5 rounded-xl text-sm font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5 hover:shadow-xl"
                            style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                        <i class="bi bi-plus-circle mr-2"></i>{{ __('add_anime') }}
                    </button>
                </div>
            </div>
        @endif
    </div>

    <x-slot:footer>
        <div class="flex flex-col md:flex-row justify-between items-center gap-4">
            {{ $animes->links() }}
        </div>
    </x-slot:footer>
</x-ui.card-table>
