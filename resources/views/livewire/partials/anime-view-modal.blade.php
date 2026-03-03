{{-- Anime Detail View Modal --}}
<template x-teleport="body">
    <div x-show="showViewModal" class="fixed inset-0 z-[99999] flex items-center justify-center px-4" style="display: none;">
        <div x-show="showViewModal" class="absolute inset-0 bg-black/50 backdrop-blur-sm"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>

        <div x-show="showViewModal"
             class="relative w-full max-w-2xl max-h-[90vh] rounded-2xl shadow-2xl overflow-hidden transform transition-all border flex flex-col"
             :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 scale-95" x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 scale-100" x-transition:leave-end="opacity-0 translate-y-4 scale-95">

            {{-- Header with Cover --}}
            <div class="relative h-48 overflow-hidden flex-shrink-0">
                <template x-if="viewAnime && viewAnime.image_url">
                    <img :src="viewAnime.image_url" class="w-full h-full object-cover filter blur-sm scale-110 opacity-60">
                </template>
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent"></div>
                
                {{-- Close Button --}}
                <button @click="showViewModal = false"
                        class="absolute top-4 right-4 w-8 h-8 rounded-lg bg-black/40 backdrop-blur-md flex items-center justify-center text-white/70 hover:text-white hover:bg-black/60 transition-colors z-20">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>

                {{-- Info Overlay --}}
                <div class="absolute bottom-0 left-0 right-0 p-6 z-10">
                    <div class="flex items-end gap-4">
                        <template x-if="viewAnime && viewAnime.image_url">
                            <div class="w-20 h-28 rounded-xl overflow-hidden shadow-2xl ring-2 ring-white/20 flex-shrink-0">
                                <img :src="viewAnime.image_url" class="w-full h-full object-cover">
                            </div>
                        </template>
                        <template x-if="viewAnime && !viewAnime.image_url">
                            <div class="w-20 h-28 rounded-xl shadow-2xl flex items-center justify-center flex-shrink-0"
                                 style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                                <i class="bi bi-film text-3xl text-white/60"></i>
                            </div>
                        </template>
                        <div class="flex-1 min-w-0">
                            <h2 class="text-xl font-extrabold text-white truncate" x-text="viewAnime?.title"></h2>
                            <p class="text-sm text-white/60 mt-0.5" x-text="viewAnime?.title_japanese" x-show="viewAnime?.title_japanese"></p>
                            <p class="text-sm text-white/50 mt-0.5 max-w-sm truncate" x-text="viewAnime?.title_english" x-show="viewAnime?.title_english"></p>
                            <div class="flex items-center gap-2 mt-2 flex-wrap">
                                <span class="px-2 py-0.5 rounded-md text-[10px] font-bold uppercase text-white bg-white/20 backdrop-blur-md" x-text="viewAnime?.type"></span>
                                <span class="text-xs text-white/60" x-show="viewAnime?.episodes"><span x-text="viewAnime?.episodes"></span> eps</span>
                                <span class="text-xs text-white/60" x-show="viewAnime?.premiered" x-text="viewAnime?.premiered"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Body --}}
            <div class="overflow-y-auto flex-1 p-6 custom-scrollbar">
                {{-- Score Row --}}
                <div class="flex items-center gap-4 mb-5 flex-wrap">
                    <template x-if="viewAnime?.watch_status">
                        <div class="flex items-center gap-2 px-3 py-2 rounded-xl"
                             :class="{
                                 'bg-emerald-500/20 text-emerald-500': viewAnime?.watch_status === 'completed',
                                 'bg-blue-500/20 text-blue-500': viewAnime?.watch_status === 'watching',
                                 'bg-yellow-500/20 text-yellow-500': viewAnime?.watch_status === 'on_hold',
                                 'bg-red-500/20 text-red-500': viewAnime?.watch_status === 'dropped',
                                 'bg-slate-500/20 text-slate-400': viewAnime?.watch_status === 'plan_to_watch'
                             }">
                            <i class="bi bi-bookmark-fill text-xs"></i>
                            <span class="text-sm font-bold capitalize" x-text="viewAnime.watch_status.replace(/_/g, ' ')"></span>
                        </div>
                    </template>
                    <template x-if="viewAnime?.personal_score">
                        <div class="flex items-center gap-2 px-3 py-2 rounded-xl" style="background: linear-gradient(135deg, color-mix(in srgb, var(--gradient-start) 15%, transparent), color-mix(in srgb, var(--gradient-end) 15%, transparent));">
                            <i class="bi bi-star-fill text-yellow-400"></i>
                            <span class="text-lg font-extrabold" :class="darkMode ? 'text-white' : 'text-slate-800'" x-text="viewAnime.personal_score + '/10'"></span>
                            <span class="text-xs" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('my_score') }}</span>
                        </div>
                    </template>
                    <template x-if="viewAnime?.mal_score">
                        <div class="flex items-center gap-2 px-3 py-2 rounded-xl" :class="darkMode ? 'bg-white/5' : 'bg-slate-100'">
                            <i class="bi bi-star-fill text-yellow-500 text-xs"></i>
                            <span class="text-sm font-bold" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.mal_score"></span>
                            <span class="text-[10px]" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">MAL</span>
                        </div>
                    </template>
                </div>

                {{-- Info Grid --}}
                <div class="grid grid-cols-2 gap-3 text-sm mb-5">
                    <template x-if="viewAnime?.genres">
                        <div class="col-span-2 flex items-start gap-2">
                            <span class="text-xs font-bold uppercase tracking-wider flex-shrink-0 mt-0.5" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('genres') }}</span>
                            <div class="flex flex-wrap gap-1.5">
                                <template x-for="g in (viewAnime.genres || '').split(',')" :key="g">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold" :class="darkMode ? 'bg-white/10 text-slate-300' : 'bg-slate-100 text-slate-600'" x-text="g.trim()"></span>
                                </template>
                            </div>
                        </div>
                    </template>
                    <template x-if="viewAnime?.themes">
                        <div class="col-span-2 flex items-start gap-2 mt-1">
                            <span class="text-xs font-bold uppercase tracking-wider flex-shrink-0 mt-0.5" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('themes') }}</span>
                            <div class="flex flex-wrap gap-1.5">
                                <template x-for="t in (viewAnime.themes || '').split(',')" :key="t">
                                    <span class="px-2 py-0.5 rounded-md text-[10px] font-bold" :class="darkMode ? 'bg-white/10 text-slate-300' : 'bg-slate-100 text-slate-600'" x-text="t.trim()"></span>
                                </template>
                            </div>
                        </div>
                    </template>
                    <template x-if="viewAnime?.studios">
                        <div><span class="text-xs font-bold uppercase" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('studios') }}</span><p class="mt-1 font-medium" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.studios"></p></div>
                    </template>
                    <template x-if="viewAnime?.source">
                        <div><span class="text-xs font-bold uppercase" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('source') }}</span><p class="mt-1 font-medium" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.source"></p></div>
                    </template>
                    <template x-if="viewAnime?.aired">
                        <div><span class="text-xs font-bold uppercase" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('aired') }}</span><p class="mt-1 font-medium" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.aired"></p></div>
                    </template>
                    <template x-if="viewAnime?.rating">
                        <div><span class="text-xs font-bold uppercase" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('rating') }}</span><p class="mt-1 font-medium" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.rating"></p></div>
                    </template>
                    <template x-if="viewAnime?.status">
                        <div><span class="text-xs font-bold uppercase" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('airing_status') }}</span><p class="mt-1 font-medium" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.status"></p></div>
                    </template>
                    <template x-if="viewAnime?.duration">
                        <div><span class="text-xs font-bold uppercase" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('duration') }}</span><p class="mt-1 font-medium" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.duration"></p></div>
                    </template>
                    <template x-if="viewAnime?.watch_start_date">
                        <div><span class="text-xs font-bold uppercase" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('start_watching') }}</span><p class="mt-1 font-medium" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.watch_start_date"></p></div>
                    </template>
                    <template x-if="viewAnime?.watch_end_date">
                        <div><span class="text-xs font-bold uppercase" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('end_watching') }}</span><p class="mt-1 font-medium" :class="darkMode ? 'text-white' : 'text-slate-700'" x-text="viewAnime.watch_end_date"></p></div>
                    </template>
                </div>

                {{-- Synopsis --}}
                <template x-if="viewAnime?.synopsis">
                    <div class="mb-5">
                        <h4 class="text-xs font-bold uppercase tracking-wider mb-2" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('synopsis') }}</h4>
                        <p class="text-sm leading-relaxed" :class="darkMode ? 'text-slate-300' : 'text-slate-600'" x-text="viewAnime.synopsis"></p>
                    </div>
                </template>

                {{-- Notes --}}
                <template x-if="viewAnime?.notes">
                    <div class="rounded-xl p-4 border" :class="darkMode ? 'bg-white/5 border-white/10' : 'bg-slate-50 border-slate-200'">
                        <h4 class="text-xs font-bold uppercase tracking-wider mb-2" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                            <i class="bi bi-journal-text mr-1"></i> {{ __('notes') }}
                        </h4>
                        <p class="text-sm" :class="darkMode ? 'text-slate-300' : 'text-slate-600'" x-text="viewAnime.notes"></p>
                    </div>
                </template>

                {{-- Links --}}
                <div class="mt-4 flex flex-wrap gap-4">
                    <template x-if="viewAnime?.mal_url">
                        <a :href="viewAnime.mal_url" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 text-xs font-bold transition-colors mb-2"
                           :class="darkMode ? 'text-blue-400 hover:text-blue-300' : 'text-blue-600 hover:text-blue-700'">
                            <i class="bi bi-box-arrow-up-right"></i> {{ __('view_on_mal') }}
                        </a>
                    </template>
                    <template x-if="viewAnime?.official_site">
                        <a :href="viewAnime.official_site" target="_blank" rel="noopener"
                           class="inline-flex items-center gap-2 text-xs font-bold transition-colors mb-2"
                           :class="darkMode ? 'text-emerald-400 hover:text-emerald-300' : 'text-emerald-600 hover:text-emerald-700'">
                            <i class="bi bi-globe2"></i> {{ __('official_site') }}
                        </a>
                    </template>
                </div>
            </div>

            {{-- Footer --}}
            <div class="px-6 py-4 border-t flex items-center justify-between relative z-10 flex-shrink-0"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                <button @click="if(viewAnime) { $wire.edit(viewAnime.id); showViewModal = false; }"
                        class="px-4 py-2 rounded-xl text-xs font-bold transition-colors flex items-center gap-2"
                        :class="darkMode ? 'text-slate-400 hover:text-yellow-400 hover:bg-white/5' : 'text-slate-500 hover:text-yellow-600 hover:bg-slate-100'">
                    <i class="bi bi-pencil-square"></i> {{ __('edit') }}
                </button>
                <button @click="showViewModal = false"
                        class="px-6 py-2 rounded-xl text-xs font-bold text-white shadow-lg transition-all"
                        style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                    {{ __('close') }}
                </button>
            </div>
        </div>
    </div>
</template>
