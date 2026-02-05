{{-- Cursor & Click Effects Settings Form --}}
@props([
    'cursorStyle' => 'gradient_blob',
    'clickAnimation' => 'ring_pulse',
    'cursorEnabled' => true,
    'clickEnabled' => true
])

@php
$cursorOptions = [
    [
        'id' => 'soft_glow',
        'name' => 'Soft Glow',
        'desc' => 'Lingkaran blur lembut',
        'icon' => 'bi-circle',
    ],
    [
        'id' => 'gradient_blob',
        'name' => 'Gradient Blob',
        'desc' => 'Blob gradien mengikuti cursor',
        'icon' => 'bi-moisture',
    ],
    [
        'id' => 'ring_outline',
        'name' => 'Ring Outline',
        'desc' => 'Cincin tipis dengan glow',
        'icon' => 'bi-record-circle',
    ],
    [
        'id' => 'particle_trail',
        'name' => 'Particle Trail',
        'desc' => 'Partikel mengikuti cursor',
        'icon' => 'bi-stars',
    ],
];

$clickOptions = [
    [
        'id' => 'ripple',
        'name' => 'Ripple Wave',
        'desc' => 'Gelombang yang menyebar',
        'icon' => 'bi-broadcast',
    ],
    [
        'id' => 'burst',
        'name' => 'Burst',
        'desc' => 'Ledakan partikel',
        'icon' => 'bi-lightning-charge',
    ],
    [
        'id' => 'ring_pulse',
        'name' => 'Ring Pulse',
        'desc' => 'Cincin yang membesar',
        'icon' => 'bi-bullseye',
    ],
    [
        'id' => 'sparkle',
        'name' => 'Sparkle',
        'desc' => 'Bintang-bintang kecil',
        'icon' => 'bi-star-fill',
    ],
];
@endphp

<div class="space-y-6">
    {{-- Cursor Highlight Section --}}
    <div class="glass-card rounded-xl sm:rounded-2xl overflow-hidden animate-fade-in-up delay-200">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-emerald-500/10 to-teal-500/10 px-4 sm:px-6 py-4 sm:py-5 border-b border-white/5">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-emerald-500 to-teal-500 flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <i class="bi bi-cursor-fill text-lg sm:text-xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-base sm:text-lg">Cursor Highlight</h3>
                        <p class="text-[11px] sm:text-xs text-slate-400">Efek visual yang mengikuti cursor</p>
                    </div>
                </div>
                
                {{-- Toggle Switch --}}
                <button 
                    wire:click="toggleCursor"
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-300 focus:outline-none {{ $cursorEnabled ? 'bg-gradient-to-r from-emerald-500 to-teal-500' : 'bg-slate-600' }}"
                >
                    <span class="sr-only">Toggle cursor effect</span>
                    <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-lg transition-transform duration-300 {{ $cursorEnabled ? 'translate-x-6' : 'translate-x-1' }}"></span>
                </button>
            </div>
        </div>

        {{-- Options Grid --}}
        <div class="p-4 sm:p-6 {{ !$cursorEnabled ? 'opacity-50 pointer-events-none' : '' }}">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($cursorOptions as $option)
                <button 
                    wire:click="setCursorStyle('{{ $option['id'] }}')"
                    class="group relative glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 {{ $cursorStyle === $option['id'] ? 'ring-2 ring-emerald-500 bg-emerald-500/10' : 'hover:bg-white/5' }}"
                >
                    {{-- Preview Animation Area --}}
                    <div class="relative w-16 h-16 mx-auto mb-3 rounded-xl bg-slate-800/50 overflow-hidden flex items-center justify-center">
                        {{-- Cursor Effect Preview --}}
                        <div class="cursor-preview cursor-preview-{{ $option['id'] }}"></div>
                        <i class="bi {{ $option['icon'] }} text-2xl relative z-10 {{ $cursorStyle === $option['id'] ? 'text-emerald-400' : 'text-slate-400' }}"></i>
                    </div>
                    
                    <h4 class="font-bold text-sm mb-1 {{ $cursorStyle === $option['id'] ? 'text-emerald-400' : '' }}">{{ $option['name'] }}</h4>
                    <p class="text-[10px] text-slate-500">{{ $option['desc'] }}</p>
                    
                    {{-- Selected Indicator --}}
                    @if($cursorStyle === $option['id'])
                    <div class="absolute top-2 right-2 w-5 h-5 rounded-full bg-emerald-500 flex items-center justify-center">
                        <i class="bi bi-check text-white text-xs"></i>
                    </div>
                    @endif
                </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Click Animation Section --}}
    <div class="glass-card rounded-xl sm:rounded-2xl overflow-hidden animate-fade-in-up delay-300">
        {{-- Header --}}
        <div class="bg-gradient-to-r from-violet-500/10 to-purple-500/10 px-4 sm:px-6 py-4 sm:py-5 border-b border-white/5">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3 sm:gap-4">
                    <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-violet-500 to-purple-500 flex items-center justify-center shadow-lg shadow-violet-500/20">
                        <i class="bi bi-hand-index-thumb-fill text-lg sm:text-xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-base sm:text-lg">Click Animation</h3>
                        <p class="text-[11px] sm:text-xs text-slate-400">Animasi saat klik kiri & kanan</p>
                    </div>
                </div>
                
                {{-- Toggle Switch --}}
                <button 
                    wire:click="toggleClick"
                    class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-300 focus:outline-none {{ $clickEnabled ? 'bg-gradient-to-r from-violet-500 to-purple-500' : 'bg-slate-600' }}"
                >
                    <span class="sr-only">Toggle click animation</span>
                    <span class="inline-block h-4 w-4 transform rounded-full bg-white shadow-lg transition-transform duration-300 {{ $clickEnabled ? 'translate-x-6' : 'translate-x-1' }}"></span>
                </button>
            </div>
        </div>

        {{-- Options Grid --}}
        <div class="p-4 sm:p-6 {{ !$clickEnabled ? 'opacity-50 pointer-events-none' : '' }}">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4">
                @foreach($clickOptions as $option)
                <button 
                    wire:click="setClickAnimation('{{ $option['id'] }}')"
                    class="group relative glass-card rounded-xl p-4 text-center transition-all duration-300 hover:scale-105 {{ $clickAnimation === $option['id'] ? 'ring-2 ring-violet-500 bg-violet-500/10' : 'hover:bg-white/5' }}"
                >
                    {{-- Preview Animation Area --}}
                    <div class="relative w-16 h-16 mx-auto mb-3 rounded-xl bg-slate-800/50 overflow-hidden flex items-center justify-center click-preview-container" data-click-type="{{ $option['id'] }}">
                        <i class="bi {{ $option['icon'] }} text-2xl relative z-10 {{ $clickAnimation === $option['id'] ? 'text-violet-400' : 'text-slate-400' }}"></i>
                    </div>
                    
                    <h4 class="font-bold text-sm mb-1 {{ $clickAnimation === $option['id'] ? 'text-violet-400' : '' }}">{{ $option['name'] }}</h4>
                    <p class="text-[10px] text-slate-500">{{ $option['desc'] }}</p>
                    
                    {{-- Selected Indicator --}}
                    @if($clickAnimation === $option['id'])
                    <div class="absolute top-2 right-2 w-5 h-5 rounded-full bg-violet-500 flex items-center justify-center">
                        <i class="bi bi-check text-white text-xs"></i>
                    </div>
                    @endif
                </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Live Preview Info --}}
    <div class="glass-card rounded-xl p-4 sm:p-5 animate-fade-in-up delay-400">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                <i class="bi bi-info-circle text-blue-400"></i>
            </div>
            <div>
                <h4 class="font-bold text-sm mb-1">Live Preview</h4>
                <p class="text-xs text-slate-400">Gerakkan cursor dan klik di mana saja untuk melihat efek secara langsung. Perubahan otomatis tersimpan.</p>
            </div>
        </div>
    </div>
</div>

{{-- Preview Styles --}}
<style>
    /* Cursor Preview Animations */
    .cursor-preview {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .group:hover .cursor-preview,
    .ring-emerald-500 .cursor-preview {
        opacity: 1;
    }
    
    .cursor-preview-soft_glow {
        background: radial-gradient(circle at center, var(--gradient-start, #10b981) 0%, transparent 70%);
        filter: blur(8px);
        animation: pulse-soft 2s ease-in-out infinite;
    }
    
    .cursor-preview-gradient_blob {
        background: radial-gradient(circle at center, var(--gradient-start, #10b981) 0%, var(--gradient-end, #14b8a6) 50%, transparent 70%);
        filter: blur(6px);
        animation: blob-morph 3s ease-in-out infinite;
    }
    
    .cursor-preview-ring_outline {
        border: 3px solid var(--gradient-start, #10b981);
        border-radius: 50%;
        margin: 20%;
        box-shadow: 0 0 15px var(--gradient-start, #10b981);
        animation: ring-pulse-preview 1.5s ease-in-out infinite;
    }
    
    .cursor-preview-particle_trail {
        background-image: 
            radial-gradient(circle at 30% 40%, var(--gradient-start, #10b981) 2px, transparent 2px),
            radial-gradient(circle at 60% 30%, var(--gradient-end, #14b8a6) 2px, transparent 2px),
            radial-gradient(circle at 50% 60%, var(--gradient-start, #10b981) 2px, transparent 2px),
            radial-gradient(circle at 70% 70%, var(--gradient-end, #14b8a6) 2px, transparent 2px);
        animation: particles-float 2s ease-in-out infinite;
    }
    
    @keyframes pulse-soft {
        0%, 100% { transform: scale(0.9); opacity: 0.6; }
        50% { transform: scale(1.1); opacity: 1; }
    }
    
    @keyframes blob-morph {
        0%, 100% { transform: scale(1) rotate(0deg); }
        33% { transform: scale(1.1) rotate(5deg); }
        66% { transform: scale(0.95) rotate(-5deg); }
    }
    
    @keyframes ring-pulse-preview {
        0%, 100% { transform: scale(0.8); opacity: 1; }
        50% { transform: scale(1); opacity: 0.7; }
    }
    
    @keyframes particles-float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
</style>
