{{-- Mobile Page Title Component --}}
@php
    $routeName = request()->route()?->getName();
    $pageTitle = match($routeName) {
        'management-user' => __('management_user'),
        'settings' => __('settings'),
        default => __('dashboard'),
    };
@endphp

<div class="md:hidden flex justify-center -mt-4 mb-6 animate-fade-in-up">
    <h2 class="text-sm font-extrabold gradient-text uppercase tracking-[0.2em]">
        {{ $pageTitle }}
    </h2>
</div>
