@props(['customColors' => [], 'customizableColors' => [], 'activeTheme' => 'lycoris_cyber'])

<div class="rounded-3xl p-8 border transition-all duration-300 relative overflow-hidden group"
     :class="darkMode ? 'bg-[#111827]/40 border-white/5' : 'bg-white border-slate-200 shadow-xl shadow-slate-200/50'"
     x-data="colorCustomizer()"
     x-init="initColors(@js($customColors))">
    
    {{-- Background Decoration --}}
    <div class="absolute top-0 right-0 p-6 opacity-5 pointer-events-none">
        <i class="bi bi-brush text-9xl transform -rotate-12" :class="darkMode ? 'text-white' : 'text-slate-900'"></i>
    </div>

    {{-- Header --}}
    <div class="relative z-10 mb-8 flex items-center justify-between">
        <div>
            <h3 class="text-lg font-bold flex items-center gap-2" :class="darkMode ? 'text-white' : 'text-slate-800'">
                <i class="bi bi-sliders text-pink-500"></i>
                Color Customizer
            </h3>
            <p class="text-sm opacity-60" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
                Sesuaikan warna sesuai preferensi anda.
            </p>
        </div>
        
        {{-- Reset Button --}}
        <button type="button"
                wire:click="resetColors"
                class="px-4 py-2 rounded-xl text-xs font-bold transition-all duration-300 flex items-center gap-2 hover:scale-105"
                :class="darkMode ? 'bg-white/10 text-white hover:bg-white/20' : 'bg-slate-100 text-slate-700 hover:bg-slate-200'">
            <i class="bi bi-arrow-counterclockwise"></i>
            Reset to Default
        </button>
    </div>

    {{-- Color Pickers Grid --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 relative z-10">
        
        @foreach($customizableColors as $colorKey => $colorInfo)
        <div class="group/picker">
            <label class="block text-sm font-medium mb-2" 
                   :class="darkMode ? 'text-slate-300' : 'text-slate-700'">
                {{ $colorInfo['label'] }}
            </label>
            
            <div class="relative">
                {{-- Color Input Container --}}
                <div class="flex items-center gap-3 p-3 rounded-xl border transition-all duration-300 group-hover/picker:border-purple-500/50"
                     :class="darkMode ? 'bg-white/5 border-white/10' : 'bg-slate-50 border-slate-200'">
                    
                    {{-- Color Preview Circle --}}
                    <div class="relative">
                        <input type="color" 
                               id="color_{{ $colorKey }}"
                               x-model="colors.{{ $colorKey }}"
                               wire:change="updateColor('{{ $colorKey }}', $event.target.value)"
                               @input="updatePreview('{{ $colorKey }}', $event.target.value)"
                               class="w-10 h-10 rounded-full cursor-pointer appearance-none border-2 transition-all hover:scale-110"
                               :class="darkMode ? 'border-white/20' : 'border-slate-300'"
                               style="background-color: {{ $customColors[$colorKey] ?? '#6366f1' }};">
                        
                        {{-- Glow effect --}}
                        <div class="absolute inset-0 rounded-full blur-md opacity-50 pointer-events-none"
                             :style="'background-color: ' + colors.{{ $colorKey }}"></div>
                    </div>
                    
                    {{-- Hex Value Input --}}
                    <div class="flex-1">
                        <input type="text" 
                               x-model="colors.{{ $colorKey }}"
                               @input="updatePreview('{{ $colorKey }}', $event.target.value); $wire.updateColor('{{ $colorKey }}', $event.target.value)"
                               class="w-full px-3 py-2 rounded-lg text-sm font-mono uppercase transition-all focus:ring-2 focus:ring-purple-500 focus:outline-none"
                               :class="darkMode ? 'bg-white/10 text-white border-0' : 'bg-white text-slate-800 border border-slate-200'"
                               placeholder="#000000">
                    </div>
                </div>
                
                {{-- Description --}}
                <p class="text-[10px] mt-2 opacity-60" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
                    {{ $colorInfo['description'] }}
                </p>
            </div>
        </div>
        @endforeach
        
    </div>

    {{-- Live Preview Section --}}
    <div class="mt-8 pt-6 border-t relative z-10" :class="darkMode ? 'border-white/10' : 'border-slate-200'">
        <h4 class="text-sm font-bold mb-4 flex items-center gap-2" :class="darkMode ? 'text-white' : 'text-slate-800'">
            <i class="bi bi-eye text-cyan-500"></i>
            Live Preview
        </h4>
        
        {{-- Preview Card --}}
        <div class="rounded-2xl p-6 border transition-all duration-300"
             :style="'background-color: ' + colors.surface + '; border-color: ' + colors.primary + '20'">
            
            <div class="flex items-center gap-4 mb-4">
                {{-- Simulated Button --}}
                <div class="px-4 py-2 rounded-lg text-white text-sm font-bold transition-all"
                     :style="'background: linear-gradient(135deg, ' + colors.primary + ', ' + colors.secondary + ')'">
                    Primary Button
                </div>
                
                {{-- Accent Badge --}}
                <div class="px-3 py-1 rounded-full text-white text-xs font-bold"
                     :style="'background-color: ' + colors.accent">
                    Accent Badge
                </div>
            </div>
            
            <div class="space-y-2">
                <p class="text-sm font-bold" :style="'color: ' + colors.text">
                    Ini adalah contoh heading text
                </p>
                <p class="text-xs" :style="'color: ' + colors.text_muted">
                    Ini adalah contoh muted text yang lebih subtle.
                </p>
            </div>
            
            {{-- Gradient Bar --}}
            <div class="mt-4 h-2 rounded-full overflow-hidden"
                 :style="'background: linear-gradient(90deg, ' + colors.primary + ', ' + colors.secondary + ', ' + colors.accent + ')'">
            </div>
        </div>
    </div>
</div>

{{-- Alpine.js Component --}}
<script>
function colorCustomizer() {
    return {
        colors: {
            primary: '#6366f1',
            secondary: '#8b5cf6',
            accent: '#ec4899',
            background: '#0f172a',
            surface: '#1e293b',
            text: '#f8fafc',
            text_muted: '#94a3b8',
        },
        
        initColors(initialColors) {
            if (initialColors && Object.keys(initialColors).length > 0) {
                this.colors = { ...this.colors, ...initialColors };
            }
            this.applyCSSVariables();
        },
        
        updatePreview(key, value) {
            if (value && /^#[0-9A-Fa-f]{6}$/.test(value)) {
                this.colors[key] = value;
                this.applyCSSVariables();
            }
        },
        
        applyCSSVariables() {
            const root = document.documentElement;
            Object.entries(this.colors).forEach(([key, value]) => {
                if (value && !value.includes('rgba')) {
                    root.style.setProperty('--theme-' + key.replace('_', '-'), value);
                }
            });
            
            // Save to localStorage for caching
            localStorage.setItem('themeColors', JSON.stringify(this.colors));
        }
    }
}
</script>
