{{-- AI Provider Settings Form --}}
@props([
    'providers' => [],
    'availableProviders' => [],
    'showModal' => false,
    'editingId' => null,
    'testingId' => null,
    'aiProvider' => '',
    'testResult' => null,
])

<x-ui.card padding="" rounded="rounded-xl sm:rounded-2xl" class="transition-colors duration-500">
    {{-- Header --}}
    <div class="px-4 sm:px-6 py-4 sm:py-5 transition-colors duration-500"
         :class="darkMode ? 'bg-gradient-to-r from-rose-500/10 to-orange-500/10 border-b border-white/5' : 'bg-gradient-to-r from-rose-500/5 to-orange-500/5 border-b border-slate-100'">
        <div class="flex items-center justify-between">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-rose-500 to-orange-500 flex items-center justify-center shadow-lg shadow-rose-500/20">
                    <i class="bi bi-robot text-lg sm:text-xl text-white"></i>
                </div>
                <div>
                    <h3 class="font-bold text-base sm:text-lg">{{ __('ai_providers') }}</h3>
                    <p class="text-[11px] sm:text-xs text-slate-400">{{ __('manage_ai_api') }}</p>
                </div>
            </div>
            {{-- Add Provider Button --}}
            <button wire:click="openAddProvider"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold text-white
                           bg-gradient-to-r from-rose-500 to-orange-500 hover:from-rose-600 hover:to-orange-600
                           shadow-lg shadow-rose-500/20 transition-all duration-300 hover:scale-105 active:scale-95">
                <i class="bi bi-plus-lg"></i>
                <span class="hidden sm:inline">{{ __('add_provider') }}</span>
            </button>
        </div>
    </div>

    {{-- Provider List --}}
    <div class="p-4 sm:p-6">
        @if(count($providers) === 0)
            {{-- Empty State --}}
            <div class="text-center py-12 sm:py-16">
                <div class="w-16 h-16 sm:w-20 sm:h-20 mx-auto rounded-2xl bg-gradient-to-r from-rose-500/10 to-orange-500/10 flex items-center justify-center mb-4">
                    <i class="bi bi-robot text-3xl sm:text-4xl text-rose-400/50"></i>
                </div>
                <h4 class="text-base sm:text-lg font-bold mb-2"
                    :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                    {{ __('no_providers') }}
                </h4>
                <p class="text-xs sm:text-sm text-slate-400 max-w-sm mx-auto mb-6">
                    {{ __('no_providers_desc') }}
                </p>
                <button wire:click="openAddProvider"
                        class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold text-white
                               bg-gradient-to-r from-rose-500 to-orange-500 hover:from-rose-600 hover:to-orange-600
                               shadow-lg transition-all duration-300 hover:scale-105">
                    <i class="bi bi-plus-lg"></i>
                    {{ __('add_provider') }}
                </button>
            </div>
        @else
            {{-- Provider Cards --}}
            <div class="space-y-3">
                @foreach($providers as $provider)
                <div class="relative group rounded-xl border transition-all duration-300 overflow-hidden"
                     :class="darkMode ? 'border-white/10 bg-white/[0.02] hover:bg-white/[0.05]' : 'border-slate-200 bg-slate-50/50 hover:bg-slate-100/50'">
                    <div class="p-4 sm:p-5">
                        <div class="flex items-start justify-between gap-4">
                            {{-- Provider Info --}}
                            <div class="flex items-start gap-3 sm:gap-4 flex-1 min-w-0">
                                {{-- Provider Icon --}}
                                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shrink-0
                                            {{ $provider->is_active
                                                ? 'bg-gradient-to-r from-emerald-500 to-teal-500 shadow-lg shadow-emerald-500/20'
                                                : '' }}"
                                     :class="{{ !$provider->is_active ? ('{darkMode: \'bg-white/10\', true: \'bg-slate-200\'}[darkMode]') : '\"\"' }}">
                                    @switch($provider->provider)
                                        @case('groq')
                                            <i class="bi bi-lightning-charge-fill text-lg {{ $provider->is_active ? 'text-white' : 'text-orange-400' }}"></i>
                                            @break
                                        @case('gemini')
                                            <i class="bi bi-stars text-lg {{ $provider->is_active ? 'text-white' : 'text-blue-400' }}"></i>
                                            @break
                                        @case('openrouter')
                                            <i class="bi bi-diagram-3-fill text-lg {{ $provider->is_active ? 'text-white' : 'text-purple-400' }}"></i>
                                            @break
                                        @case('mistral')
                                            <i class="bi bi-wind text-lg {{ $provider->is_active ? 'text-white' : 'text-cyan-400' }}"></i>
                                            @break
                                    @endswitch
                                </div>

                                {{-- Details --}}
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-center gap-2 flex-wrap">
                                        <h4 class="font-bold text-sm sm:text-base truncate"
                                            :class="darkMode ? 'text-white' : 'text-slate-800'">
                                            {{ $provider->name }}
                                        </h4>
                                        @if($provider->is_active)
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-400 animate-pulse"></span>
                                                {{ __('active') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-[10px] font-bold border"
                                                  :class="darkMode ? 'bg-white/5 text-slate-400 border-white/10' : 'bg-slate-100 text-slate-500 border-slate-200'">
                                                {{ __('inactive') }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center gap-3 mt-1.5 text-xs text-slate-400 flex-wrap">
                                        <span class="inline-flex items-center gap-1">
                                            <i class="bi bi-cpu text-[10px]"></i>
                                            {{ $provider->getProviderLabel() }}
                                        </span>
                                        <span class="inline-flex items-center gap-1">
                                            <i class="bi bi-box text-[10px]"></i>
                                            {{ $provider->model }}
                                        </span>
                                        <span class="inline-flex items-center gap-1">
                                            <i class="bi bi-sort-numeric-up text-[10px]"></i>
                                            P{{ $provider->priority }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            {{-- Kebab Action Menu --}}
                            <div x-data="{
                                open: false,
                                uid: 'ai-dropdown-{{ $provider->id }}',
                                dropdownStyle: { top: '0px', left: '0px' },
                                rafId: null,
                                updatePosition() {
                                    const btn = this.$refs.triggerBtn;
                                    const menu = this.$refs.dropdownMenu;
                                    if (!btn) return;
                                    const rect = btn.getBoundingClientRect();
                                    const dropdownW = 220;
                                    const dropdownH = menu ? menu.offsetHeight : 200;
                                    const gap = 4;
                                    const vw = window.innerWidth;
                                    const vh = window.innerHeight;

                                    let top, left;
                                    if (vh - rect.bottom >= dropdownH + gap) {
                                        top = rect.bottom + gap;
                                    } else if (rect.top >= dropdownH + gap) {
                                        top = rect.top - dropdownH - gap;
                                    } else {
                                        top = Math.max(gap, vh - dropdownH - gap);
                                    }

                                    if (rect.right >= dropdownW) {
                                        left = rect.right - dropdownW;
                                    } else {
                                        left = rect.left;
                                    }

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
                               class="relative inline-block text-left shrink-0">
                                <button x-ref="triggerBtn" @click.stop="toggleDropdown()"
                                        class="w-8 h-8 sm:w-9 sm:h-9 rounded-lg flex items-center justify-center transition-all duration-200"
                                        :class="darkMode ? 'hover:bg-white/10 text-slate-400' : 'hover:bg-slate-200 text-slate-500'"
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
                                         class="fixed z-[9999] w-56 rounded-xl shadow-2xl border focus:outline-none overflow-hidden"
                                         :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
                                         :style="`top: ${dropdownStyle.top}; left: ${dropdownStyle.left};`"
                                         style="display: none;">

                                        <div class="py-1.5 flex flex-col text-left">
                                            {{-- Test Connection --}}
                                            <button wire:click="openTestModal({{ $provider->id }})"
                                                    @click="$nextTick(() => { $wire.testConnection({{ $provider->id }}) }); open = false; stopTracking()"
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-emerald-400' : 'text-slate-600 hover:bg-slate-50 hover:text-emerald-600'">
                                                <i class="bi bi-wifi mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('test_connection') }}
                                            </button>

                                            {{-- Toggle Active/Inactive --}}
                                            <button wire:click="toggleActive({{ $provider->id }})"
                                                    @click="open = false; stopTracking()"
                                                    class="group flex w-full items-center justify-between px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-{{ $provider->is_active ? 'rose' : 'emerald' }}-400' : 'text-slate-600 hover:bg-slate-50 hover:text-{{ $provider->is_active ? 'rose' : 'emerald' }}-600'">
                                                <span class="flex items-center">
                                                    <i class="bi bi-{{ $provider->is_active ? 'toggle-on text-emerald-400' : 'toggle-off' }} mr-2.5 opacity-70 group-hover:opacity-100 text-base"></i>
                                                    {{ $provider->is_active ? __('deactivate') : __('activate') }}
                                                </span>
                                                <span class="text-[10px] px-1.5 py-0.5 rounded-full font-bold
                                                             {{ $provider->is_active ? 'bg-emerald-500/10 text-emerald-400' : 'bg-white/5 text-slate-400' }}">
                                                    {{ $provider->is_active ? 'ON' : 'OFF' }}
                                                </span>
                                            </button>

                                            {{-- Edit --}}
                                            <button wire:click="openEditProvider({{ $provider->id }})"
                                                    @click="open = false; stopTracking()"
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-blue-400' : 'text-slate-600 hover:bg-slate-50 hover:text-blue-600'">
                                                <i class="bi bi-pencil-square mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('edit') }}
                                            </button>

                                            <div class="my-1 border-t" :class="darkMode ? 'border-white/5' : 'border-slate-100'"></div>

                                            {{-- Delete --}}
                                            <button @click="$dispatch('show-alert', {
                                                        title: '{{ __('delete_provider_title') }}',
                                                        message: '{{ __('delete_provider_confirm') }}',
                                                        type: 'danger',
                                                        confirmText: '{{ __('yes_delete') }}',
                                                        cancelText: '{{ __('cancel') }}',
                                                        onConfirm: () => { $wire.deleteProvider({{ $provider->id }}) }
                                                    }); open = false; stopTracking()"
                                                    class="group flex w-full items-center px-4 py-2.5 text-xs sm:text-sm font-medium transition-colors"
                                                    :class="darkMode ? 'text-slate-300 hover:bg-white/5 hover:text-red-400' : 'text-slate-600 hover:bg-slate-50 hover:text-red-600'">
                                                <i class="bi bi-trash mr-2.5 opacity-70 group-hover:opacity-100"></i>
                                                {{ __('delete') }}
                                            </button>
                                        </div>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
</x-ui.card>

<!-- Add/Edit Provider Modal -->
<template x-teleport="body">
    <div x-show="showModal" 
         x-data="{ 
            initParticles() {
                const container = this.$refs.particlesContainer;
                if (!container) return;
                container.innerHTML = '';

                for (let i = 0; i < 40; i++) {
                    const particle = document.createElement('div');
                    const shapes = ['circle', 'diamond', 'triangle'];
                    const shape = shapes[Math.floor(Math.random() * shapes.length)];
                    
                    particle.className = `swal-particle swal-particle-${shape}`;
                    
                    const size = 3 + Math.random() * 6; 
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.bottom = `${-20 + Math.random() * 40}px`; 
                    
                    const isStart = Math.random() > 0.5;
                    particle.style.background = isStart ? '#f43f5e' : '#f97316';
                    
                    particle.style.animationDelay = `${Math.random() * 2}s`;
                    particle.style.animationDuration = `${3 + Math.random() * 4}s`;
                    
                    particle.style.setProperty('--sway-dir', Math.random() > 0.5 ? 1 : -1);
                    particle.style.setProperty('--sway-amount', `${20 + Math.random() * 50}px`);
                    
                    container.appendChild(particle);
                }
            }
         }"
         x-effect="if(showModal) { $nextTick(() => initParticles()); document.body.style.overflow = 'hidden'; } else { document.body.style.overflow = ''; }"
         class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
         style="display: none;">
        
        <!-- Backdrop -->
        <div x-show="showModal"
             class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Modal Content -->
        <div x-show="showModal"
             class="relative w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden transform transition-all border group"
             :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95">
            
            <!-- Glow Effect -->
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none rounded-2xl"
                 style="background: linear-gradient(135deg, color-mix(in srgb, #f43f5e 5%, transparent), color-mix(in srgb, #f97316 5%, transparent));"></div>

            <!-- Particles -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-2xl">
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-rose-500/10 rounded-full blur-3xl animate-blob"></div>
                <div class="absolute top-20 -right-20 w-40 h-40 bg-orange-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-20 left-20 w-40 h-40 bg-rose-500/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
            </div>

            <!-- Floating Particles Container -->
            <div x-ref="particlesContainer" class="swal-particles absolute inset-0 pointer-events-none rounded-2xl overflow-hidden z-0"></div>

            <!-- Header -->
            <div class="px-5 py-4 border-b flex items-center justify-between relative z-10"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg"
                         style="background: linear-gradient(135deg, #f43f5e, #f97316);">
                        <i class="bi bi-robot text-lg"></i>
                    </div>
                    <h3 class="font-bold text-base sm:text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">
                        {{ $editingId ? __('edit_provider') : __('add_provider') }}
                    </h3>
                </div>
                <button wire:click="closeModal" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:bg-white/5 hover:text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800'">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-5 space-y-4 relative z-20 max-h-[70vh] overflow-y-auto custom-scrollbar">
                
                {{-- Provider Type --}}
                <div class="space-y-1.5">
                    @php
                        $providerOptions = [];
                        foreach($availableProviders as $key => $prov) {
                            $providerOptions[] = ['value' => $key, 'label' => $prov['label']];
                        }
                    @endphp
                    <x-ui.select 
                        label="{{ __('provider_type') }}"
                        model="aiProvider"
                        :options="$providerOptions"
                        placeholder="{{ __('select_provider') }}"
                        icon="bi bi-cpu"
                        teleport="true"
                        live="true"
                    />
                    @error('aiProvider') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                <!-- Display Name -->
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold uppercase tracking-wider block" 
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        <i class="bi bi-tag text-blue-400 mr-1"></i> {{ __('provider_name') }}
                    </label>
                    <div class="relative group/input">
                        <input type="text" wire:model="aiName"
                               class="w-full pl-4 pr-4 py-3 rounded-xl border appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-xs sm:text-sm font-medium placeholder-slate-400/50"
                               :class="darkMode ? 'bg-white/5 border-white/10 text-white focus:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 focus:bg-white'"
                               placeholder="{{ __('provider_name_placeholder') }}">
                    </div>
                    @error('aiName') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                {{-- Model Name --}}
                <div class="space-y-1.5">
                    @if($aiProvider && isset($availableProviders[$aiProvider]))
                        @php
                            $modelOptions = [];
                            foreach($availableProviders[$aiProvider]['models'] as $modelOpt) {
                                $modelOptions[] = ['value' => $modelOpt, 'label' => $modelOpt];
                            }
                        @endphp
                        <x-ui.select 
                            label="{{ __('model_name') }}"
                            model="aiModel"
                            :options="$modelOptions"
                            placeholder="{{ __('select_model') }}"
                            icon="bi bi-box"
                            teleport="true"
                        />
                        <p class="text-[10px] text-slate-500">{{ __('model_hint') }}</p>
                    @else
                        <label class="text-[10px] font-bold uppercase tracking-wider block"
                               :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                            <i class="bi bi-box text-blue-400 mr-1"></i> {{ __('model_name') }}
                        </label>
                        <input type="text" wire:model="aiModel" disabled
                               class="w-full pl-4 pr-4 py-3 rounded-xl border appearance-none text-xs sm:text-sm font-medium opacity-50"
                               :class="darkMode ? 'bg-white/5 border-white/10 text-white' : 'bg-slate-50 border-slate-200 text-slate-700'"
                               placeholder="{{ __('select_provider_first') }}">
                    @endif
                    @error('aiModel') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                {{-- API Key --}}
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold uppercase tracking-wider block"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        <i class="bi bi-key text-blue-400 mr-1"></i> {{ __('api_key') }}
                    </label>
                    <div class="relative group/input">
                        <input type="password" wire:model="aiApiKey"
                               class="w-full pl-4 pr-4 py-3 rounded-xl border appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-xs sm:text-sm font-medium placeholder-slate-400/50"
                               :class="darkMode ? 'bg-white/5 border-white/10 text-white focus:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 focus:bg-white'"
                               placeholder="{{ $editingId ? __('api_key_edit_placeholder') : __('api_key_placeholder') }}">
                    </div>
                    @if($editingId)
                        <p class="text-[10px] mt-1 text-slate-500">{{ __('api_key_edit_hint') }}</p>
                    @endif
                    @error('aiApiKey') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

                {{-- Base URL --}}
                @if($aiProvider && $aiProvider !== 'gemini')
                    <div class="space-y-1.5">
                        <label class="text-[10px] font-bold uppercase tracking-wider block"
                               :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                            <i class="bi bi-link-45deg text-blue-400 mr-1"></i> {{ __('base_url') }}
                        </label>
                        <div class="relative group/input">
                            <input type="text" wire:model="aiBaseUrl"
                                   class="w-full pl-4 pr-4 py-3 rounded-xl border appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50 transition-all text-xs sm:text-sm font-medium placeholder-slate-400/50"
                                   :class="darkMode ? 'bg-white/5 border-white/10 text-white focus:bg-white/10' : 'bg-slate-50 border-slate-200 text-slate-700 focus:bg-white'"
                                   placeholder="{{ __('base_url_placeholder') }}">
                        </div>
                        <p class="text-[10px] mt-1 text-slate-500">{{ __('base_url_hint') }}</p>
                        @error('aiBaseUrl') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                    </div>
                @endif

                {{-- Priority --}}
                <div class="space-y-1.5">
                    <label class="text-[10px] font-bold uppercase tracking-wider block"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                        <i class="bi bi-sort-numeric-up text-blue-400 mr-1"></i> {{ __('priority') }}
                    </label>
                    <div class="relative group/input">
                        <x-ui.number-spinner model="aiPriority" placeholder="0" />
                    </div>
                    <p class="text-[10px] mt-1 text-slate-500">{{ __('priority_hint') }}</p>
                    @error('aiPriority') <span class="text-red-500 text-[10px] font-bold">{{ $message }}</span> @enderror
                </div>

            </div>

            <!-- Footer -->
            <div class="px-5 py-4 border-t flex items-center justify-end gap-3 relative z-10"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                
                <button wire:click="closeModal" 
                        class="px-4 py-2.5 rounded-xl text-xs font-bold transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/5' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200'">
                    {{ __('cancel') }}
                </button>

                <button wire:click="saveProvider"
                        wire:loading.attr="disabled"
                        wire:target="saveProvider"
                        class="px-6 py-2.5 rounded-xl text-xs font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5 flex items-center gap-2 disabled:opacity-50"
                        style="background: linear-gradient(135deg, #f43f5e, #f97316); box-shadow: 0 10px 15px -3px color-mix(in srgb, #f43f5e 40%, transparent);">
                    <span wire:loading wire:target="saveProvider">
                        <i class="bi bi-arrow-repeat animate-spin mr-1"></i>
                    </span>
                    <span wire:loading.remove wire:target="saveProvider">
                        <i class="bi bi-check-lg text-sm mr-1"></i>
                    </span>
                    <span>{{ $editingId ? __('update') : __('save') }}</span>
                </button>
            </div>
        </div>
    </div>
</template>
