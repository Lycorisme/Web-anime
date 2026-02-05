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
    @include('components.settings.partials.cursor-section', ['cursorOptions' => $cursorOptions, 'cursorEnabled' => $cursorEnabled, 'cursorStyle' => $cursorStyle])

    {{-- Click Animation Section --}}
    @include('components.settings.partials.click-section', ['clickOptions' => $clickOptions, 'clickEnabled' => $clickEnabled, 'clickAnimation' => $clickAnimation])

    {{-- Live Preview Info --}}
    <div class="glass-card rounded-xl p-4 sm:p-5 animate-fade-in-up delay-400">
        <div class="flex items-start gap-3">
            <div class="w-8 h-8 rounded-lg bg-blue-500/20 flex items-center justify-center flex-shrink-0">
                <i class="bi bi-info-circle text-blue-400"></i>
            </div>
        </div>
    </div>
</div>

{{-- Include Styles --}}
@include('components.settings.styles.effects-form-styles')
