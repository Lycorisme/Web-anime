{{-- Global Cursor & Click Effects Component --}}
{{-- This component should be included in the main layout to enable cursor and click effects globally --}}

@php
use App\Models\SiteSetting;

$cursorStyle = SiteSetting::get('cursor_style', 'gradient_blob');
$clickAnimation = SiteSetting::get('click_animation', 'ring_pulse');
$cursorEnabled = (bool) SiteSetting::get('cursor_enabled', true);
$clickEnabled = (bool) SiteSetting::get('click_enabled', true);
@endphp

<div id="cursor-effects-container" class="fixed inset-0 pointer-events-none z-[999999] overflow-hidden">
    {{-- Cursor Highlight Element --}}
    <div id="cursor-glow" class="cursor-glow cursor-glow-{{ $cursorStyle }}" style="display: {{ $cursorEnabled ? 'block' : 'none' }};"></div>
    
    {{-- Particle Trail Container --}}
    <div id="cursor-particle-container"></div>
    
    {{-- Click Effects Container --}}
    <div id="cursor-click-container"></div>
</div>

{{-- Include separated style files --}}
@include('components.ui.styles.cursor-glow-styles')
@include('components.ui.styles.click-animation-styles')

{{-- Include JavaScript --}}
@include('components.ui.scripts.cursor-effects-script', [
    'cursorStyle' => $cursorStyle,
    'clickAnimation' => $clickAnimation,
    'cursorEnabled' => $cursorEnabled,
    'clickEnabled' => $clickEnabled
])
