{{-- Tab Navigation - Responsive Horizontal on Mobile, Vertical on Desktop --}}
@props(['activeTab' => 'general'])

@php
$tabs = [
    [
        'id' => 'general', 
        'label' => __('site_identity'), 
        'icon' => 'bi-building', 
        'desc' => __('site_name'),
        'color' => 'from-blue-500 to-cyan-500'
    ],
    [
        'id' => 'appearance', 
        'label' => __('appearance'), 
        'icon' => 'bi-palette-fill', 
        'desc' => __('logo') . ' & ' . __('favicon'),
        'color' => 'from-purple-500 to-pink-500'
    ],
    [
        'id' => 'theme', 
        'label' => __('color_theme'), 
        'icon' => 'bi-brush-fill', 
        'desc' => __('theme_presets'),
        'color' => 'from-orange-500 to-red-500'
    ],
    [
        'id' => 'effects', 
        'label' => __('cursor_effects'), 
        'icon' => 'bi-cursor-fill', 
        'desc' => __('cursor_style'),
        'color' => 'from-emerald-500 to-teal-500'
    ],
    [
        'id' => 'language', 
        'label' => __('language'), 
        'icon' => 'bi-translate', 
        'desc' => __('select_language'),
        'color' => 'from-indigo-500 to-violet-500'
    ],
];
@endphp

{{-- Mobile: Horizontal Scroll Tabs --}}
<div class="lg:hidden glass-card rounded-2xl p-2 animate-fade-in-up delay-100 overflow-x-auto">
    <div class="flex gap-2 min-w-max">
        @foreach($tabs as $tab)
        <button 
            wire:click="setTab('{{ $tab['id'] }}')"
            class="flex items-center gap-2 px-4 py-3 rounded-xl font-medium text-sm transition-all whitespace-nowrap"
            :class="{{ $activeTab === $tab['id'] ? "'bg-gradient-to-r " . $tab['color'] . " text-white shadow-lg'" : "(darkMode ? 'hover:bg-white/10 text-slate-200' : 'hover:bg-black/5 text-slate-800')" }}"
        >
            <div class="w-8 h-8 rounded-lg flex items-center justify-center {{ $activeTab === $tab['id'] ? 'bg-white/20' : 'bg-gradient-to-r ' . $tab['color'] . ' text-white' }}">
                <i class="bi {{ $tab['icon'] }}"></i>
            </div>
            <span class="font-bold">{{ $tab['label'] }}</span>
        </button>
        @endforeach
    </div>
</div>

{{-- Desktop: Vertical Sidebar --}}
<div class="hidden lg:block glass-card rounded-2xl overflow-hidden animate-fade-in-up delay-100">
    {{-- Navigation Items --}}
    <div class="p-3 space-y-1.5">
        @foreach($tabs as $index => $tab)
        <button 
            wire:click="setTab('{{ $tab['id'] }}')"
            @if($activeTab !== $tab['id'])
                x-data
                @mouseenter="$el.querySelector('.tab-text').style.color = currentTheme.start; $el.querySelector('.tab-desc').style.color = currentTheme.start;"
                @mouseleave="$el.querySelector('.tab-text').style.color = ''; $el.querySelector('.tab-desc').style.color = '';"
            @endif
            class="w-full group flex items-center gap-4 px-4 py-3.5 rounded-xl font-medium text-sm transition-all duration-300 {{ $activeTab === $tab['id'] ? 'bg-gradient-to-r ' . $tab['color'] . ' text-white shadow-lg' : 'hover:bg-white/10' }}"
            style="animation-delay: {{ $index * 50 }}ms"
        >
            {{-- Icon --}}
            <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-all {{ $activeTab === $tab['id'] ? 'bg-white/20' : 'bg-gradient-to-r ' . $tab['color'] . ' text-white' }}">
                <i class="bi {{ $tab['icon'] }} text-lg"></i>
            </div>
            
            {{-- Text --}}
            <div class="flex-1 text-left">
                <div class="font-bold tab-text transition-colors duration-300"
                     :class="{{ $activeTab === $tab['id'] ? "'text-white'" : "(darkMode ? 'text-slate-300' : 'text-slate-800')" }}">
                     {{ $tab['label'] }}
                </div>
                <div class="text-xs tab-desc transition-colors duration-300"
                     :class="{{ $activeTab === $tab['id'] ? "'text-white/70'" : "(darkMode ? 'text-slate-400' : 'text-slate-500')" }}">
                     {{ $tab['desc'] }}
                </div>
            </div>
            
            {{-- Arrow --}}
            <div class="transition-transform"
                 :class="{{ $activeTab === $tab['id'] ? "'translate-x-1 text-white'" : "(darkMode ? 'text-slate-400' : 'text-slate-800') + ' group-hover:translate-x-1'" }}">
                <i class="bi bi-chevron-right"></i>
            </div>
        </button>
        @endforeach
    </div>
    
    {{-- Divider --}}
    <div class="px-4">
        <div class="h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>
    </div>
    
    {{-- Quick Tips --}}
    <div class="p-4">
    </div>
</div>
