{{-- Tab Navigation - Responsive Horizontal on Mobile, Vertical on Desktop --}}
@props(['activeTab' => 'general'])

@php
$tabs = [
    [
        'id' => 'general', 
        'label' => 'Identitas', 
        'icon' => 'bi-building', 
        'desc' => 'Nama situs',
        'color' => 'from-blue-500 to-cyan-500'
    ],
    [
        'id' => 'appearance', 
        'label' => 'Tampilan', 
        'icon' => 'bi-palette-fill', 
        'desc' => 'Logo & Favicon',
        'color' => 'from-purple-500 to-pink-500'
    ],
    [
        'id' => 'theme', 
        'label' => 'Tema Warna', 
        'icon' => 'bi-brush-fill', 
        'desc' => 'Preset gradien',
        'color' => 'from-orange-500 to-red-500'
    ],
    [
        'id' => 'effects', 
        'label' => 'Efek Kursor', 
        'icon' => 'bi-cursor-fill', 
        'desc' => 'Cursor & Klik',
        'color' => 'from-emerald-500 to-teal-500'
    ],
];
@endphp

{{-- Mobile: Horizontal Scroll Tabs --}}
<div class="lg:hidden glass-card rounded-2xl p-2 animate-fade-in-up delay-100 overflow-x-auto">
    <div class="flex gap-2 min-w-max">
        @foreach($tabs as $tab)
        <button 
            wire:click="setTab('{{ $tab['id'] }}')"
            class="flex items-center gap-2 px-4 py-3 rounded-xl font-medium text-sm transition-all whitespace-nowrap {{ $activeTab === $tab['id'] ? 'bg-gradient-to-r ' . $tab['color'] . ' text-white shadow-lg' : 'hover:bg-white/10' }}"
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
            class="w-full group flex items-center gap-4 px-4 py-3.5 rounded-xl font-medium text-sm transition-all duration-300 {{ $activeTab === $tab['id'] ? 'bg-gradient-to-r ' . $tab['color'] . ' text-white shadow-lg' : 'hover:bg-white/10' }}"
            style="animation-delay: {{ $index * 50 }}ms"
        >
            {{-- Icon --}}
            <div class="w-10 h-10 rounded-xl flex items-center justify-center transition-all {{ $activeTab === $tab['id'] ? 'bg-white/20' : 'bg-gradient-to-r ' . $tab['color'] . ' text-white' }}">
                <i class="bi {{ $tab['icon'] }} text-lg"></i>
            </div>
            
            {{-- Text --}}
            <div class="flex-1 text-left">
                <div class="font-bold {{ $activeTab === $tab['id'] ? 'text-white' : '' }}">{{ $tab['label'] }}</div>
                <div class="text-xs {{ $activeTab === $tab['id'] ? 'text-white/70' : 'text-slate-500' }}">{{ $tab['desc'] }}</div>
            </div>
            
            {{-- Arrow --}}
            <i class="bi bi-chevron-right transition-transform {{ $activeTab === $tab['id'] ? 'translate-x-1 text-white' : 'text-slate-400 group-hover:translate-x-1' }}"></i>
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
