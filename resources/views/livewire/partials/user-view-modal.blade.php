<!-- User View Modal -->
<template x-teleport="body">
    <div x-show="showViewModal" 
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
                    
                    // Random size
                    const size = 3 + Math.random() * 6; 
                    particle.style.width = `${size}px`;
                    particle.style.height = `${size}px`;
                    
                    // Position
                    particle.style.left = `${Math.random() * 100}%`;
                    particle.style.bottom = `${-20 + Math.random() * 40}px`; 
                    
                    // Simple color logic
                    const isStart = Math.random() > 0.5;
                    particle.style.background = isStart ? 'var(--gradient-start)' : 'var(--gradient-end)';
                    
                    particle.style.animationDelay = `${Math.random() * 2}s`;
                    particle.style.animationDuration = `${3 + Math.random() * 4}s`;
                    
                    // Sway
                    particle.style.setProperty('--sway-dir', Math.random() > 0.5 ? 1 : -1);
                    particle.style.setProperty('--sway-amount', `${20 + Math.random() * 50}px`);
                    
                    container.appendChild(particle);
                }
            }
         }"
         x-effect="if(showViewModal) { $nextTick(() => initParticles()); document.body.style.overflow = 'hidden'; } else { document.body.style.overflow = ''; }"
         class="fixed inset-0 z-[99999] flex items-center justify-center px-4"
         style="display: none;">
        
        <!-- Backdrop -->
        <div x-show="showViewModal"
             class="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity" 
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"></div>

        <!-- Modal Content -->
        <div x-show="showViewModal"
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
                 style="background: linear-gradient(135deg, color-mix(in srgb, var(--gradient-start) 5%, transparent), color-mix(in srgb, var(--gradient-end) 5%, transparent));"></div>

            <!-- Particles -->
            <div class="absolute inset-0 pointer-events-none overflow-hidden rounded-2xl">
                <div class="absolute -top-10 -left-10 w-32 h-32 bg-blue-500/10 rounded-full blur-3xl animate-blob"></div>
                <div class="absolute top-20 -right-20 w-32 h-32 bg-purple-500/10 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-20 left-20 w-32 h-32 bg-pink-500/10 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
            </div>

            <!-- Floating Particles Container -->
            <div x-ref="particlesContainer" class="swal-particles absolute inset-0 pointer-events-none rounded-2xl overflow-hidden z-0"></div>

            <!-- Header -->
            <div class="px-5 py-4 border-b flex items-center justify-between relative z-10"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center text-white shadow-lg"
                         style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                        <i class="bi bi-person-lines-fill text-lg"></i>
                    </div>
                    <h3 class="font-bold text-base sm:text-lg" :class="darkMode ? 'text-white' : 'text-slate-800'">
                        {{ __('view_details') }}
                    </h3>
                </div>
                <button @click="showViewModal = false" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-colors"
                        :class="darkMode ? 'text-slate-400 hover:bg-white/5 hover:text-white' : 'text-slate-500 hover:bg-slate-100 hover:text-slate-800'">
                    <i class="bi bi-x-lg text-sm"></i>
                </button>
            </div>

            <!-- Body -->
            <div class="p-6 space-y-6 relative z-20">
                
                <div x-if="viewUser" class="flex flex-col items-center">
                    <!-- Avatar Large -->
                    <div class="w-24 h-24 rounded-2xl flex items-center justify-center text-white text-3xl font-bold shadow-xl mb-4 relative overflow-hidden"
                         style="background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));">
                        <span x-text="viewUser?.name?.charAt(0)?.toUpperCase() || '?'"></span>
                        
                        <!-- Shine effect -->
                        <div class="absolute inset-0 bg-white/20 translate-y-full rotate-45 transform transition-transform duration-1000 group-hover:translate-y-[-150%]"></div>
                    </div>
                    
                    <!-- Name & Email -->
                    <h4 class="text-xl font-extrabold text-center" x-text="viewUser?.name || ''"
                        :class="darkMode ? 'text-white' : 'text-slate-800'"></h4>
                    <p class="text-sm text-center mt-1 font-medium" x-text="viewUser?.email || ''"
                       :class="darkMode ? 'text-slate-400' : 'text-slate-500'"></p>
                </div>

                <div class="space-y-3" x-if="viewUser">
                    <!-- Role -->
                    <div class="flex items-center justify-between py-3 px-4 rounded-xl border transition-all hover:bg-opacity-80"
                         :class="darkMode ? 'bg-white/5 border-white/5 hover:bg-white/10' : 'bg-slate-50 border-slate-100 hover:bg-slate-100'">
                        <span class="text-xs font-bold uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('role') }}</span>
                        <span class="text-xs font-bold px-3 py-1 rounded-full border shadow-sm"
                              :class="viewUser?.role === 'Admin' ? 'bg-purple-500/10 text-purple-500 border-purple-500/20' : (viewUser?.role === 'Editor' ? 'bg-blue-500/10 text-blue-500 border-blue-500/20' : 'bg-slate-500/10 text-slate-400 border-slate-500/20')"
                              x-text="viewUser?.role || ''"></span>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center justify-between py-3 px-4 rounded-xl border transition-all hover:bg-opacity-80"
                         :class="darkMode ? 'bg-white/5 border-white/5 hover:bg-white/10' : 'bg-slate-50 border-slate-100 hover:bg-slate-100'">
                        <span class="text-xs font-bold uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('status') }}</span>
                        <div class="flex items-center gap-2 px-3 py-1 rounded-full border shadow-sm"
                             :class="viewUser?.status === 'Active' ? 'bg-green-500/10 border-green-500/20 text-green-500' : 'bg-red-500/10 border-red-500/20 text-red-500'">
                            <span class="relative flex h-2 w-2">
                              <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75" :class="viewUser?.status === 'Active' ? 'bg-green-500' : 'bg-red-500'"></span>
                              <span class="relative inline-flex rounded-full h-2 w-2" :class="viewUser?.status === 'Active' ? 'bg-green-500' : 'bg-red-500'"></span>
                            </span>
                            <span class="text-xs font-bold" x-text="viewUser?.status || ''"></span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between py-3 px-4 rounded-xl border transition-all hover:bg-opacity-80 group/row"
                         :class="darkMode ? 'bg-white/5 border-white/5 hover:bg-white/10' : 'bg-slate-50 border-slate-100 hover:bg-slate-100'">
                        <span class="text-xs font-bold uppercase tracking-wider" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">{{ __('phone') }}</span>
                        
                        <div class="relative">
                            <!-- Phone Actions -->
                            <div x-show="viewUser?.phone" class="flex items-center gap-2">
                                <!-- Phone Pill (Click to Copy) -->
                                <button @click="navigator.clipboard.writeText(viewUser?.phone); $dispatch('show-toast', { type: 'success', message: '{{ __('phone_copied') }}' })"
                                        class="flex items-center gap-2 px-3 py-1 rounded-full border shadow-sm transition-all hover:scale-105 active:scale-95 group/btn"
                                        :class="darkMode ? 'bg-cyan-500/10 border-cyan-500/20 text-cyan-400 hover:bg-cyan-500/20' : 'bg-cyan-50 border-cyan-100 text-cyan-600 hover:bg-cyan-100'"
                                        title="{{ __('copy_phone') }}">
                                    <i class="bi bi-telephone-fill text-[10px] opacity-70 group-hover/btn:opacity-100"></i>
                                    <span class="text-xs font-bold font-mono tracking-wide" x-text="viewUser?.phone"></span>
                                    <i class="bi bi-files text-[10px] opacity-0 w-0 group-hover/btn:w-auto group-hover/btn:opacity-100 -translate-x-2 group-hover/btn:translate-x-0 transition-all duration-300"></i>
                                </button>

                                <!-- WhatsApp Button -->
                                <a :href="'https://wa.me/' + (viewUser?.phone || '').replace(/[^0-9]/g, '')" 
                                   target="_blank"
                                   class="w-7 h-7 flex items-center justify-center rounded-full border shadow-sm transition-all hover:scale-110 active:scale-95"
                                   :class="darkMode ? 'bg-green-500/10 border-green-500/20 text-green-400 hover:bg-green-500/20' : 'bg-green-50 border-green-100 text-green-600 hover:bg-green-100'"
                                   title="Chat on WhatsApp">
                                    <i class="bi bi-whatsapp text-[10px]"></i>
                                </a>
                            </div>

                            <!-- Fallback -->
                            <span x-show="!viewUser?.phone" 
                                  class="text-xs font-bold font-mono opacity-50" 
                                  :class="darkMode ? 'text-white' : 'text-slate-700'">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="px-5 py-4 border-t flex items-center justify-end relative z-10"
                 :class="darkMode ? 'border-white/5 bg-white/5' : 'border-slate-100 bg-slate-50/50'">
                
                <button @click="showViewModal = false"
                        class="px-6 py-2 rounded-xl text-xs font-bold text-white shadow-lg transition-all transform hover:-translate-y-0.5"
                        style="background: linear-gradient(135deg, var(--slate-600, #475569), var(--slate-800, #1e293b)); box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                    {{ __('close') }}
                </button>
            </div>
        </div>
    </div>
</template>
