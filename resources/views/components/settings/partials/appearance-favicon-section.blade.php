        {{-- SECTION: FAVICON --}}
        <div class="space-y-4">
             <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-lg bg-pink-500/10 text-pink-400">
                        <i class="bi bi-browser-chrome text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm transition-colors duration-500"
                            :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('favicon_browser') }}</h4>
                        <p class="text-xs transition-colors duration-500"
                           :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('small_icon_browser') }}</p>
                    </div>
                </div>
                @if($currentFavicon)
                    <button 
                         @click="$dispatch('swal-confirm-global-confirm', {
                            title: '{{ __('delete_favicon') }}',
                            message: '{{ __('favicon_delete_message') }}',
                            type: 'danger',
                            confirmText: '{{ __('delete') }}',
                            cancelText: '{{ __('cancel') }}',
                            onConfirm: () => { $wire.removeFavicon(); }
                        })"
                        class="text-xs text-rose-500 hover:text-rose-400 font-medium px-3 py-1.5 rounded-lg hover:bg-rose-500/10 transition-colors flex items-center gap-1.5"
                    >
                        <i class="bi bi-trash"></i> {{ __('delete') }}
                    </button>
                @endif
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                {{-- Left: Preview --}}
                <div class="lg:col-span-1">
                    <div class="relative w-full aspect-square rounded-2xl overflow-hidden group shadow-2xl ring-1 transition-all duration-500"
                         :class="darkMode ? 'shadow-pink-500/10 ring-white/10' : 'shadow-pink-500/5 ring-slate-200'">
                        {{-- Background Art --}}
                        <div class="absolute inset-0 transition-colors duration-500"
                             :class="darkMode ? 'bg-[#0f172a]' : 'bg-slate-100'">
                            <div class="absolute inset-0 bg-gradient-to-tl from-pink-500/10 via-transparent to-purple-500/10"></div>
                            {{-- Animated Orbs --}}
                            <div class="absolute top-1/4 left-1/4 w-32 h-32 bg-pink-500/20 blur-[60px] rounded-full mix-blend-screen animate-pulse-slow"></div>
                            <div class="absolute bottom-1/4 right-1/4 w-40 h-40 bg-purple-500/20 blur-[60px] rounded-full mix-blend-screen animate-pulse-slow" style="animation-delay: 1s"></div>
                        </div>

                        {{-- Centered Browser UI --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6">
                            {{-- Floating Browser Card --}}
                            <div class="w-full max-w-[220px] backdrop-blur-xl rounded-2xl shadow-[0_20px_40px_-10px_rgba(0,0,0,0.5)] transform transition-all duration-500 group-hover:scale-[1.03] group-hover:-translate-y-1"
                                 :class="darkMode ? 'bg-slate-900/80 border border-white/10' : 'bg-white/80 border border-slate-200/60'">
                                
                                {{-- Window Controls --}}
                                <div class="px-4 py-3 flex gap-2 transition-colors duration-500"
                                     :class="darkMode ? 'border-b border-white/5' : 'border-b border-slate-100'">
                                    <div class="w-2.5 h-2.5 rounded-full bg-rose-500/80 shadow-[0_0_10px_rgba(244,63,94,0.4)]"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-amber-500/80 shadow-[0_0_10px_rgba(245,158,11,0.4)]"></div>
                                    <div class="w-2.5 h-2.5 rounded-full bg-emerald-500/80 shadow-[0_0_10px_rgba(16,185,129,0.4)]"></div>
                                </div>
                                
                                {{-- Tab Content --}}
                                <div class="p-4 space-y-3">
                                    {{-- Active Tab Simulation --}}
                                    <div class="rounded-xl p-3 flex items-center gap-3 ring-1 shadow-lg relative overflow-hidden transition-colors duration-500"
                                         :class="darkMode ? 'bg-gradient-to-b from-white/10 to-white/5 ring-white/10' : 'bg-gradient-to-b from-slate-50 to-white ring-slate-200/60'">
                                        {{-- Glow behind icon --}}
                                        <div class="absolute left-2 top-1/2 -translate-y-1/2 w-10 h-10 bg-pink-500/20 blur-xl rounded-full"></div>

                                        {{-- Favicon Slot --}}
                                        <div class="relative w-10 h-10 flex-shrink-0 flex items-center justify-center rounded-lg shadow-inner z-10 transition-colors duration-500"
                                             :class="darkMode ? 'bg-[#0f172a] border border-white/10' : 'bg-slate-100 border border-slate-200'">
                                            @if($selectedFaviconIcon === 'none' && ($siteFavicon || $currentFavicon))
                                                <img src="{{ $siteFavicon ? $siteFavicon->temporaryUrl() : Storage::url($currentFavicon) }}" class="w-6 h-6 object-contain drop-shadow-md">
                                            @else
                                                <div class="w-6 h-6 flex items-center justify-center text-pink-400">
                                                    @if(isset($iconOptions[$selectedFaviconIcon]))
                                                        {!! $iconOptions[$selectedFaviconIcon] !!}
                                                    @else
                                                        <div class="w-2 h-2 rounded-full bg-slate-600"></div>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Fake Title --}}
                                        <div class="space-y-1.5 flex-1 z-10">
                                            <div class="h-2 w-20 rounded-full transition-colors duration-500"
                                                 :class="darkMode ? 'bg-white/40' : 'bg-slate-300'"></div>
                                            <div class="h-1.5 w-12 rounded-full transition-colors duration-500"
                                                 :class="darkMode ? 'bg-white/20' : 'bg-slate-200'"></div>
                                        </div>
                                    </div>

                                    {{-- Address Bar Line --}}
                                    <div class="mx-2 h-1.5 rounded-full w-2/3 transition-colors duration-500"
                                         :class="darkMode ? 'bg-white/5' : 'bg-slate-100'"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Label --}}
                        <div class="absolute bottom-4 inset-x-0 text-center">
                            <span class="text-[10px] font-bold uppercase tracking-widest transition-colors duration-500"
                                  :class="darkMode ? 'text-white/40' : 'text-slate-400'">{{ __('browser_tab') }}</span>
                        </div>
                    </div>
                </div>

                {{-- Right: Controls --}}
                <div class="lg:col-span-2 space-y-4">
                    {{-- Upload Area --}}
                    <div class="relative group">
                        <input type="file" wire:model="siteFavicon" id="favicon-upload" class="hidden" accept="image/*">
                        <label for="favicon-upload" class="block w-full h-32 rounded-xl border-2 border-dashed transition-all cursor-pointer flex flex-col items-center justify-center gap-2"
                               :class="darkMode 
                                   ? 'border-white/10 hover:border-pink-500/50 bg-white/5 hover:bg-white/[0.07] group-hover:shadow-[0_0_20px_rgba(236,72,153,0.15)]' 
                                   : 'border-slate-200 hover:border-pink-400/50 bg-white/10 backdrop-blur-sm hover:bg-pink-50/30 group-hover:shadow-[0_0_20px_rgba(236,72,153,0.1)]'">
                            <div class="w-10 h-10 rounded-full bg-pink-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="bi bi-cloud-arrow-up-fill text-pink-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <p class="text-sm font-bold transition-colors"
                                   :class="darkMode ? 'text-white group-hover:text-pink-300' : 'text-slate-700 group-hover:text-pink-500'">{{ __('click_upload_favicon') }}</p>
                                <p class="text-xs mt-1 transition-colors duration-500"
                                   :class="darkMode ? 'text-slate-500' : 'text-slate-400'">ICO, PNG (32x32px)</p>
                            </div>
                        </label>
                    </div>

                    {{-- Icon Selector --}}
                    <div>
                         <div class="flex items-center justify-between mb-3">
                            <label class="text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors duration-500"
                                   :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                <i class="bi bi-stars text-pink-400"></i> {{ __('fallback_icon') }}
                            </label>
                        </div>
                        <div class="grid grid-cols-6 sm:grid-cols-8 gap-2">
                             @foreach($iconOptions as $key => $svg)
                                <button 
                                    type="button"
                                    wire:click="$set('selectedFaviconIcon', '{{ $key }}')"
                                    class="aspect-square rounded-lg flex items-center justify-center transition-all duration-300 relative overflow-hidden {{ $selectedFaviconIcon === $key ? 'bg-gradient-to-br from-pink-500 to-rose-500 text-white shadow-lg shadow-pink-500/30 ring-2 ring-white/20 scale-105' : '' }}"
                                    :class="'{{ $selectedFaviconIcon === $key }}' === '1' ? '' : (darkMode ? 'bg-white/5 text-slate-400 hover:bg-white/10 hover:text-white hover:scale-105' : 'bg-slate-100 text-slate-400 hover:bg-slate-200 hover:text-slate-600 hover:scale-105')"
                                    @if($key === 'none') title="Default / Favicon Image" @endif
                                >
                                    @if($key === 'none' && ($siteFavicon || $currentFavicon))
                                        <img src="{{ $siteFavicon ? $siteFavicon->temporaryUrl() : Storage::url($currentFavicon) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-5 h-5 {{ $selectedFaviconIcon === $key ? 'animate-pulse' : '' }}">
                                            {!! $svg !!}
                                        </div>
                                    @endif

                                    @if($selectedFaviconIcon === $key)
                                        <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-white rounded-full shadow-sm z-10">
                                            <i class="bi bi-check text-[8px] text-pink-600 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 font-bold"></i>
                                        </div>
                                    @endif
                                </button>
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
