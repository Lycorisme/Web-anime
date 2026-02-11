        {{-- SECTION: LOGO --}}
        <div class="space-y-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="p-2 rounded-lg bg-purple-500/10 text-purple-400">
                        <i class="bi bi-image-fill text-lg"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-sm transition-colors duration-500"
                            :class="darkMode ? 'text-white' : 'text-slate-800'">{{ __('site_logo') }}</h4>
                        <p class="text-xs transition-colors duration-500"
                           :class="darkMode ? 'text-slate-500' : 'text-slate-400'">{{ __('displayed_header_nav') }}</p>
                    </div>
                </div>
                @if($currentLogo)
                    <button 
                        @click="$dispatch('swal-confirm-global-confirm', {
                            title: '{{ __('delete_logo') }}',
                            message: '{{ __('logo_reset_message') }}',
                            type: 'danger',
                            confirmText: '{{ __('delete') }}',
                            cancelText: '{{ __('cancel') }}',
                            onConfirm: () => { $wire.removeLogo(); }
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
                         :class="darkMode ? 'shadow-purple-500/10 ring-white/10' : 'shadow-purple-500/5 ring-slate-200'">
                        {{-- Background Art --}}
                        <div class="absolute inset-0 transition-colors duration-500"
                             :class="darkMode ? 'bg-[#0f172a]' : 'bg-slate-100'">
                            <div class="absolute inset-0 bg-gradient-to-br from-purple-500/10 via-transparent to-pink-500/10"></div>
                            <div class="absolute top-0 right-0 w-32 h-32 bg-purple-500/20 blur-[50px] rounded-full"></div>
                            <div class="absolute bottom-0 left-0 w-32 h-32 bg-pink-500/20 blur-[50px] rounded-full"></div>
                            
                            {{-- Grid Pattern --}}
                            <div class="absolute inset-0 opacity-20" 
                                style="background-image: radial-gradient(#6366f1 1px, transparent 1px); background-size: 20px 20px;">
                            </div>
                        </div>

                        {{-- Content Container --}}
                        <div class="absolute inset-0 flex flex-col items-center justify-center p-6 pb-12">
                            <div class="relative z-10 p-6 rounded-2xl backdrop-blur-md shadow-xl transition-all duration-500 group-hover:scale-105 group-hover:-translate-y-2"
                                 :class="darkMode ? 'bg-white/5 border border-white/10' : 'bg-white/60 border border-white/40'">
                                @if($selectedLogoIcon === 'none' && ($siteLogo || $currentLogo))
                                    <img src="{{ $siteLogo ? $siteLogo->temporaryUrl() : Storage::url($currentLogo) }}" class="w-16 h-16 sm:w-20 sm:h-20 object-contain drop-shadow-2xl">
                                @else
                                    <div class="drop-shadow-[0_0_15px_rgba(168,85,247,0.5)]"
                                         :class="darkMode ? 'text-white' : 'text-slate-700'">
                                        @if(isset($iconOptions[$selectedLogoIcon]))
                                            <div class="w-16 h-16 sm:w-20 sm:h-20 flex items-center justify-center">
                                                {!! $iconOptions[$selectedLogoIcon] !!}
                                            </div>
                                        @else
                                            <i class="bi bi-image text-5xl opacity-20"></i>
                                        @endif
                                    </div>
                                @endif
                                
                                {{-- Shine Effect --}}
                                <div class="absolute inset-0 rounded-2xl ring-1 ring-inset transition-colors duration-500"
                                     :class="darkMode ? 'ring-white/20' : 'ring-white/40'"></div>
                            </div>
                            
                            {{-- Shadow Reflection --}}
                            <div class="absolute bottom-16 w-20 h-4 bg-black/40 blur-md rounded-[100%] transition-all duration-500 group-hover:scale-125 group-hover:opacity-60"></div>
                        </div>
                        
                        {{-- Overlay Label --}}
                        <div class="absolute bottom-0 inset-x-0 p-4 bg-gradient-to-t from-black/80 to-transparent">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ __('preview') }}</p>
                                    <p class="text-xs font-medium text-white">{{ __('header_display') }}</p>
                                </div>
                                <div class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right: Controls --}}
                <div class="lg:col-span-2 space-y-4">
                    {{-- Upload Area --}}
                    <div class="relative group">
                        <input type="file" wire:model="siteLogo" id="logo-upload" class="hidden" accept="image/*">
                        <label for="logo-upload" class="block w-full h-32 rounded-xl border-2 border-dashed transition-all cursor-pointer flex flex-col items-center justify-center gap-2"
                               :class="darkMode 
                                   ? 'border-white/10 hover:border-purple-500/50 bg-white/5 hover:bg-white/[0.07] group-hover:shadow-[0_0_20px_rgba(168,85,247,0.15)]' 
                                   : 'border-slate-200 hover:border-purple-400/50 bg-white/10 backdrop-blur-sm hover:bg-purple-50/30 group-hover:shadow-[0_0_20px_rgba(168,85,247,0.1)]'">
                            <div class="w-10 h-10 rounded-full bg-purple-500/20 flex items-center justify-center group-hover:scale-110 transition-transform">
                                <i class="bi bi-cloud-arrow-up-fill text-purple-400 text-xl"></i>
                            </div>
                            <div class="text-center">
                                <p class="text-sm font-bold transition-colors"
                                   :class="darkMode ? 'text-white group-hover:text-purple-300' : 'text-slate-700 group-hover:text-purple-500'">{{ __('click_upload_logo') }}</p>
                                <p class="text-xs mt-1 transition-colors duration-500"
                                   :class="darkMode ? 'text-slate-500' : 'text-slate-400'">PNG, JPG, SVG (Max 2MB)</p>
                            </div>
                        </label>
                    </div>

                    {{-- Icon Selector --}}
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <label class="text-xs font-bold uppercase tracking-wider flex items-center gap-1.5 transition-colors duration-500"
                                   :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                                <i class="bi bi-stars text-yellow-400"></i> {{ __('fallback_icon') }}
                            </label>
                            <span class="text-[10px] px-2 py-0.5 rounded-full transition-colors duration-500"
                                  :class="darkMode ? 'text-slate-500 bg-white/5' : 'text-slate-400 bg-slate-100'">{{ __('alt_if_no_logo') }}</span>
                        </div>
                        
                        <div class="grid grid-cols-6 sm:grid-cols-8 gap-2">
                             @foreach($iconOptions as $key => $svg)
                                <button 
                                    type="button"
                                    wire:click="$set('selectedLogoIcon', '{{ $key }}')"
                                    class="aspect-square rounded-lg flex items-center justify-center transition-all duration-300 relative overflow-hidden {{ $selectedLogoIcon === $key ? 'bg-gradient-to-br from-purple-500 to-pink-500 text-white shadow-lg shadow-purple-500/30 ring-2 ring-white/20 scale-105' : '' }}"
                                    :class="'{{ $selectedLogoIcon === $key }}' === '1' ? '' : (darkMode ? 'bg-white/5 text-slate-400 hover:bg-white/10 hover:text-white hover:scale-105' : 'bg-slate-100 text-slate-400 hover:bg-slate-200 hover:text-slate-600 hover:scale-105')"
                                    @if($key === 'none') title="Default / Logo Image" @endif
                                >
                                    @if($key === 'none' && ($siteLogo || $currentLogo))
                                        <img src="{{ $siteLogo ? $siteLogo->temporaryUrl() : Storage::url($currentLogo) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-5 h-5 {{ $selectedLogoIcon === $key ? 'animate-pulse' : '' }}">
                                            {!! $svg !!}
                                        </div>
                                    @endif

                                    @if($selectedLogoIcon === $key)
                                        <div class="absolute -top-1 -right-1 w-2.5 h-2.5 bg-white rounded-full shadow-sm z-10">
                                            <i class="bi bi-check text-[8px] text-purple-600 absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 font-bold"></i>
                                        </div>
                                    @endif
                                </button>
                             @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
