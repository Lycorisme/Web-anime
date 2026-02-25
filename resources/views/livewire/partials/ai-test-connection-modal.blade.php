{{-- AI Test Connection Modal --}}
<template x-teleport="body">
    <div x-show="showTestModal" 
         x-data="{ 
            initParticles() {
                const container = this.$refs.testParticlesContainer;
                if (!container) return;
                container.innerHTML = '';

                for (let i = 0; i < 30; i++) {
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
                    particle.style.background = isStart ? '#10b981' : '#06b6d4';
                    
                    particle.style.animationDelay = `${Math.random() * 2}s`;
                    particle.style.animationDuration = `${3 + Math.random() * 4}s`;
                    
                    particle.style.setProperty('--sway-dir', Math.random() > 0.5 ? 1 : -1);
                    particle.style.setProperty('--sway-amount', `${20 + Math.random() * 50}px`);
                    
                    container.appendChild(particle);
                }
            }
         }"
         x-effect="if(showTestModal) { $nextTick(() => initParticles()); document.body.style.overflow = 'hidden'; } else { document.body.style.overflow = ''; }"
         class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
         style="display: none;">
        
        <!-- Backdrop -->
        <div x-show="showTestModal"
             class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Modal Content -->
        <div x-show="showTestModal"
             class="relative w-full max-w-sm rounded-2xl shadow-2xl overflow-hidden transform transition-all border group"
             :class="darkMode ? 'bg-[#1e293b] border-white/10' : 'bg-white border-slate-200'"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 scale-95">
            
            <!-- Glow Effect -->
            <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none rounded-2xl"
                 style="background: linear-gradient(135deg, color-mix(in srgb, #10b981 5%, transparent), color-mix(in srgb, #06b6d4 5%, transparent));"></div>

            <!-- Particles -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-2xl">
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl animate-blob"></div>
                <div class="absolute top-20 -right-20 w-40 h-40 bg-cyan-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-20 left-20 w-40 h-40 bg-emerald-500/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
            </div>

            <!-- Floating Particles Container -->
            <div x-ref="testParticlesContainer" class="swal-particles absolute inset-0 pointer-events-none rounded-2xl overflow-hidden z-0"></div>

            <!-- Header -->
            <div class="px-5 py-4 border-b flex items-center justify-between relative z-10"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg"
                         style="background: linear-gradient(135deg, #10b981, #06b6d4);">
                        <i class="bi bi-wifi text-lg"></i>
                    </div>
                    <h3 class="font-bold text-base sm:text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">
                        {{ __('test_connection') }}
                    </h3>
                </div>
                <button @click="showTestModal = false; $wire.set('testResult', null)" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:bg-white/5 hover:text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800'">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-5 relative z-20">
                {{-- Loading State --}}
                <div wire:loading wire:target="testConnection" class="text-center py-8">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-r from-emerald-500/10 to-cyan-500/10 flex items-center justify-center mb-4">
                        <i class="bi bi-arrow-repeat animate-spin text-3xl text-emerald-400"></i>
                    </div>
                    <p class="font-bold text-sm" :class="darkMode ? 'text-white' : 'text-slate-800'">
                        {{ __('testing_connection') }}...
                    </p>
                    <p class="text-xs text-slate-400 mt-1">{{ __('please_wait') }}</p>
                </div>

                {{-- Result State --}}
                <div wire:loading.remove wire:target="testConnection">
                    @if($testResult)
                        <div class="text-center py-4">
                            @if($testResult['success'])
                                {{-- Success --}}
                                <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-r from-emerald-500/10 to-teal-500/10 flex items-center justify-center mb-4">
                                    <i class="bi bi-check-circle-fill text-3xl text-emerald-400"></i>
                                </div>
                                <h4 class="font-bold text-base mb-1" :class="darkMode ? 'text-emerald-400' : 'text-emerald-600'">
                                    {{ __('connection_success') }} ✅
                                </h4>
                            @else
                                {{-- Failed --}}
                                <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-r from-red-500/10 to-rose-500/10 flex items-center justify-center mb-4">
                                    <i class="bi bi-x-circle-fill text-3xl text-red-400"></i>
                                </div>
                                <h4 class="font-bold text-base mb-1" :class="darkMode ? 'text-red-400' : 'text-red-600'">
                                    {{ __('connection_failed') }} ❌
                                </h4>
                            @endif

                            <p class="text-xs mt-2 px-4" :class="darkMode ? 'text-slate-300' : 'text-slate-600'">
                                {{ $testResult['message'] }}
                            </p>

                            @if($testResult['success'] && isset($testResult['latency_ms']))
                                <div class="mt-4 inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs font-bold"
                                     :class="darkMode ? 'bg-white/5 text-slate-300' : 'bg-slate-50 text-slate-600'">
                                    <i class="bi bi-speedometer2 text-cyan-400"></i>
                                    {{ __('latency') }}: {{ $testResult['latency_ms'] }}ms
                                </div>
                            @endif
                        </div>
                    @else
                        <div class="text-center py-8">
                            <div class="w-16 h-16 mx-auto rounded-2xl bg-gradient-to-r from-emerald-500/10 to-cyan-500/10 flex items-center justify-center mb-4">
                                <i class="bi bi-wifi text-3xl text-slate-400"></i>
                            </div>
                            <p class="text-sm text-slate-400">{{ __('click_test_to_start') }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Footer -->
            <div class="px-5 py-4 border-t flex items-center justify-end gap-3 relative z-10"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                <button @click="showTestModal = false; $wire.set('testResult', null)" 
                        class="px-4 py-2.5 rounded-xl text-xs font-bold transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:text-white hover:bg-white/5' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-200'">
                    {{ __('close') }}
                </button>
            </div>
        </div>
    </div>
</template>
