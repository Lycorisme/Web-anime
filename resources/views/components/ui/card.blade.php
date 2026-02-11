@props([
    'padding' => 'p-4 sm:p-6',
    'rounded' => 'rounded-xl sm:rounded-2xl',
    'hoverEffect' => false,
    'animate' => false,
    'delay' => 0,
    'customClass' => '' // Additional classes
])

@php
    $baseClasses = "overflow-hidden transition-all duration-500 relative";
    $themeClasses = ":class=\"darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30 shadow-xl shadow-slate-200/20'\"";
    
    $hoverClasses = $hoverEffect ? "hover:translate-y-[-5px] hover:shadow-2xl group" : "";
    $animateClass = $animate ? "animate-fade-in-up" : "";
    $style = $delay > 0 ? "style=\"animation-delay: {$delay}ms\"" : "";
@endphp

<div {{ $attributes->merge(['class' => "$baseClasses $padding $rounded $hoverClasses $animateClass $customClass"]) }}
     {!! $themeClasses !!}
     {!! $style !!}>
    {{ $slot }}
</div>
