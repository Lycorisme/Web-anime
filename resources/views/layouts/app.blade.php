@php
    $darkMode = ($_COOKIE['theme_dark'] ?? 'false') === 'true';
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth {{ $darkMode ? 'dark' : '' }}">
<head>
    @include('components.layouts.partials.head')
</head>
<body 
    x-data="appState()" 
    x-init="init()"
    class="min-h-screen overflow-x-hidden"
    :class="loaded ? 'transition-colors duration-300' : ''"
>
    <!-- Background Blobs -->
    @persist('background-blobs')
    <div class="blob w-96 h-96 top-[-10%] left-[-10%]" :style="`background: ${currentTheme.start}`"></div>
    <div class="blob w-80 h-80 bottom-[-5%] right-[0%]" :style="`background: ${currentTheme.end}; animation-delay: -5s;`"></div>
    @endpersist

    <!-- Global Background Particles -->
    @persist('background-particles')
    <x-ui.background-particles />
    @endpersist

    <!-- Main Container -->
    <div class="flex relative z-10">
        <!-- Sidebar -->
        @persist('sidebar')
        <x-dashboard.sidebar />
        @endpersist

        <!-- Main Content -->
        <main 
            :class="[
                $store.layout.sidebarOpen ? 'lg:ml-72' : 'lg:ml-24',
                loaded ? 'transition-all duration-300' : ''
            ]" 
            class="flex-1 p-4 lg:p-8"
        >
            <!-- Header -->
            <x-dashboard.header />

            <!-- Page Content -->
            <div class="mt-6">
                {{ $slot }}
            </div>

            <!-- Footer -->
            <x-dashboard.footer />
        </main>
    </div>

    <!-- Theme Customizer FAB -->
    <x-dashboard.theme-fab />

    <!-- Global Toast Notifications -->
    <x-ui.toast position="top-center" :duration="4000" :maxToasts="5" />

    <!-- Global SweetAlert Confirmation Dialog -->
    <x-ui.sweet-alert id="global-confirm" />

    <!-- Global Cursor & Click Effects -->
    <x-ui.cursor-effects />

    @livewireScripts
    
    @include('components.layouts.scripts.app-state')
</body>
</html>
