{{-- Mobile Page Title Component - Simple Design --}}
@php
    $routeName = request()->route()?->getName();
    $pageTitle = match($routeName) {
        'management-user' => __('management_user'),
        'settings' => __('settings'),
        default => __('dashboard'),
    };
@endphp

<div class="md:hidden flex justify-center mb-6 animate-fade-in-up">
    <h2 class="text-sm font-black gradient-text uppercase tracking-[0.2em]">
        {{ $pageTitle }}
    </h2>
</div>
