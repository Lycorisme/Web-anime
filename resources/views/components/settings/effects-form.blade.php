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
        'name' => __('soft_glow'),
        'desc' => __('soft_blur_circle'),
        'icon' => 'bi-circle',
    ],
    [
        'id' => 'gradient_blob',
        'name' => __('gradient_blob'),
        'desc' => __('gradient_follows_cursor'),
        'icon' => 'bi-moisture',
    ],
    [
        'id' => 'ring_outline',
        'name' => __('ring_outline'),
        'desc' => __('thin_ring_glow'),
        'icon' => 'bi-record-circle',
    ],
    [
        'id' => 'particle_trail',
        'name' => __('particle_trail'),
        'desc' => __('particles_follow_cursor'),
        'icon' => 'bi-stars',
    ],
];

$clickOptions = [
    [
        'id' => 'ripple',
        'name' => __('ripple_wave'),
        'desc' => __('spreading_wave'),
        'icon' => 'bi-broadcast',
    ],
    [
        'id' => 'burst',
        'name' => __('burst'),
        'desc' => __('particle_explosion'),
        'icon' => 'bi-lightning-charge',
    ],
    [
        'id' => 'ring_pulse',
        'name' => __('ring_pulse'),
        'desc' => __('expanding_ring'),
        'icon' => 'bi-bullseye',
    ],
    [
        'id' => 'sparkle',
        'name' => __('sparkle'),
        'desc' => __('small_stars'),
        'icon' => 'bi-star-fill',
    ],
];
@endphp

<div class="space-y-6">
    {{-- Cursor Highlight Section --}}
    @include('components.settings.partials.cursor-section', ['cursorOptions' => $cursorOptions, 'cursorEnabled' => $cursorEnabled, 'cursorStyle' => $cursorStyle])

    {{-- Click Animation Section --}}
    @include('components.settings.partials.click-section', ['clickOptions' => $clickOptions, 'clickEnabled' => $clickEnabled, 'clickAnimation' => $clickAnimation])
</div>

{{-- Include Styles --}}
@include('components.settings.styles.effects-form-styles')
