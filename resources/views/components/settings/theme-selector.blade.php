@props(['activeTheme' => 'lycoris_cyber', 'themePresets' => []])

<div class="rounded-3xl p-8 border transition-all duration-300 relative overflow-hidden group"
     :class="darkMode ? 'bg-[#111827]/40 border-white/5' : 'bg-white border-slate-200 shadow-xl shadow-slate-200/50'">
    
    <div class="absolute top-0 right-0 p-6 opacity-5 pointer-events-none">
        <i class="bi bi-palette text-9xl transform rotate-12" :class="darkMode ? 'text-white' : 'text-slate-900'"></i>
    </div>

    <div class="relative z-10 mb-8">
        <h3 class="text-lg font-bold flex items-center gap-2" :class="darkMode ? 'text-white' : 'text-slate-800'">
            <i class="bi bi-stars text-indigo-500"></i>
            Theme Library
        </h3>
        <p class="text-sm opacity-60" :class="darkMode ? 'text-slate-400' : 'text-slate-500'">
            Pilih visual style yang paling cocok dengan brand anda.
        </p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        
        @foreach($themePresets as $themeKey => $theme)
        {{-- Theme Card --}}
        <div class="group/card relative cursor-pointer"
             wire:click="applyTheme('{{ $themeKey }}')"
             x-on:click="
                // Update dark mode based on theme
                @if($theme['mode'] === 'light')
                    darkMode = false;
                    document.documentElement.classList.remove('dark');
                @else
                    darkMode = true;
                    document.documentElement.classList.add('dark');
                @endif
                // Save to localStorage
                localStorage.setItem('darkMode', darkMode);
                localStorage.setItem('activeTheme', '{{ $themeKey }}');
                localStorage.setItem('themeColors', JSON.stringify(@js($theme['colors'])));
                
                // Apply CSS variables immediately
                const colors = @js($theme['colors']);
                const root = document.documentElement;
                Object.entries(colors).forEach(([key, value]) => {
                    if (value && !value.includes('rgba')) {
                        root.style.setProperty('--theme-' + key.replace(/_/g, '-'), value);
                    }
                });
             ">
            
            {{-- Selection Ring (only for active theme) --}}
            @if($activeTheme === $themeKey)
            <div class="absolute -inset-[2px] rounded-[1.2rem] bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 opacity-100 transition-all duration-300"></div>
            @else
            <div class="absolute -inset-[2px] rounded-[1.2rem] bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 opacity-0 group-hover/card:opacity-50 transition-all duration-300"></div>
            @endif

            <div class="relative h-64 rounded-2xl overflow-hidden transition-all duration-300 flex flex-col border"
                 style="background-color: {{ $theme['colors']['background'] }}; border-color: {{ $theme['colors']['border'] }};">
                
                {{-- Preview Area --}}
                <div class="flex-1 relative overflow-hidden group-hover/card:scale-105 transition-transform duration-700"
                     style="background-color: {{ $theme['colors']['background'] }};">
                    
                    {{-- Abstract UI Representation --}}
                    <div class="absolute top-4 left-4 right-8 h-2 rounded-full" 
                         style="background-color: {{ $theme['colors']['surface'] }};"></div>
                    <div class="absolute top-4 right-4 h-2 w-2 rounded-full" 
                         style="background-color: {{ $theme['colors']['primary'] }};"></div>
                    
                    {{-- Sidebar Preview --}}
                    <div class="absolute top-10 left-4 w-1/3 h-20 rounded-lg border"
                         style="background: linear-gradient(135deg, {{ $theme['colors']['primary'] }}20, {{ $theme['colors']['secondary'] }}20); border-color: {{ $theme['colors']['primary'] }}30;"></div>
                    
                    {{-- Content Preview --}}
                    <div class="absolute top-10 right-4 left-[40%] h-8 rounded-lg" 
                         style="background-color: {{ $theme['colors']['surface'] }};"></div>
                    <div class="absolute top-20 right-4 left-[40%] h-8 rounded-lg opacity-60" 
                         style="background-color: {{ $theme['colors']['surface'] }};"></div>
                    
                    {{-- Cards Preview --}}
                    <div class="absolute bottom-4 left-4 right-4 h-24 rounded-lg grid grid-cols-3 gap-2 p-2"
                         style="background-color: {{ $theme['colors']['surface'] }}40;">
                        <div class="rounded" style="background-color: {{ $theme['colors']['surface'] }};"></div>
                        <div class="rounded" style="background-color: {{ $theme['colors']['surface'] }};"></div>
                        <div class="rounded" style="background-color: {{ $theme['colors']['surface'] }};"></div>
                    </div>

                    {{-- Accent dot decorations --}}
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-16 h-16 rounded-full blur-xl opacity-30"
                         style="background-color: {{ $theme['colors']['primary'] }};"></div>

                    {{-- Overlay Gradient --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                </div>

                {{-- Info Area --}}
                <div class="p-4 relative z-10 border-t"
                     style="background-color: {{ $theme['colors']['surface'] }}; border-color: {{ $theme['colors']['border'] }};">
                    <div class="flex items-center justify-between mb-1">
                        <span class="font-bold text-sm flex items-center gap-2" style="color: {{ $theme['colors']['text'] }};">
                            <i class="bi {{ $theme['icon'] }}" style="color: {{ $theme['colors']['primary'] }};"></i>
                            {{ $theme['name'] }}
                        </span>
                        @if($activeTheme === $themeKey)
                        <span class="px-2 py-0.5 rounded text-[10px] font-bold text-white"
                              style="background-color: {{ $theme['colors']['primary'] }};">ACTIVE</span>
                        @else
                        <span class="px-2 py-0.5 rounded text-[10px] font-medium opacity-60"
                              style="color: {{ $theme['colors']['text_muted'] }};">
                            {{ $theme['mode'] === 'dark' ? 'Dark' : 'Light' }}
                        </span>
                        @endif
                    </div>
                    <p class="text-[10px]" style="color: {{ $theme['colors']['text_muted'] }};">
                        {{ $theme['description'] }}
                    </p>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    {{-- Color Palette Preview for Active Theme --}}
    <div class="mt-8 pt-6 border-t" :class="darkMode ? 'border-white/10' : 'border-slate-200'">
        <h4 class="text-sm font-bold mb-4 flex items-center gap-2" :class="darkMode ? 'text-white' : 'text-slate-800'">
            <i class="bi bi-palette2 text-purple-500"></i>
            Active Color Palette
        </h4>
        <div class="flex flex-wrap gap-3">
            @if(isset($themePresets[$activeTheme]['colors']))
                @foreach($themePresets[$activeTheme]['colors'] as $colorName => $colorValue)
                    @if(!str_contains($colorValue, 'rgba'))
                    <div class="flex items-center gap-2 px-3 py-2 rounded-xl border transition-all hover:scale-105"
                         :class="darkMode ? 'bg-white/5 border-white/10' : 'bg-slate-50 border-slate-200'">
                        <div class="w-5 h-5 rounded-full ring-2 ring-white/20 shadow-lg" 
                             style="background-color: {{ $colorValue }};"></div>
                        <span class="text-xs font-medium capitalize" :class="darkMode ? 'text-slate-300' : 'text-slate-600'">
                            {{ str_replace('_', ' ', $colorName) }}
                        </span>
                    </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
</div>
