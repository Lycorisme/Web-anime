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
>
    <!-- Theme Transition Overlay (single element, very lightweight) -->
    <div id="theme-transition-overlay"></div>
    <!-- Global Background Elements (Blobs & Particles) -->
    @persist('background-elements')
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
            class="flex-1 p-6 lg:p-10 max-w-[1920px] mx-auto w-full"
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
    
    {{-- i18n Translations for JavaScript --}}
    <script>
        window.i18n = {
            dashboard: @json(__('dashboard')),
            data_master: @json(__('data_master')),
            statistics: @json(__('statistics')),
            users: @json(__('users')),
            settings: @json(__('settings')),
            theme_changed: @json(__('theme_changed')),
            theme_applied_message: @json(__('theme_applied_message')),
            need_help: @json(__('need_help')),
            support: @json(__('support')),
            search_placeholder: @json(__('search_placeholder')),
            administrator: @json(__('administrator')),
            confirm_save: @json(__('confirm_save')),
            cancel: @json(__('cancel')),
            save: @json(__('save')),
            delete: @json(__('delete')),
            success: @json(__('success')),
            error: @json(__('error')),
            warning: @json(__('warning')),
            live_preview: @json(__('live_preview')),
            realtime: @json(__('realtime')),
            color_options: @json(__('color_options')),
            presets_available: @json(__('presets_available')),
            previewing: @json(__('previewing')),
            cursor_highlight: @json(__('cursor_highlight')),
            visual_follows_cursor: @json(__('visual_follows_cursor')),
            click_animation: @json(__('click_animation')),
            click_animation_desc: @json(__('click_animation_desc')),
            soft_glow: @json(__('soft_glow')),
            soft_blur_circle: @json(__('soft_blur_circle')),
            gradient_blob: @json(__('gradient_blob')),
            gradient_follows_cursor: @json(__('gradient_follows_cursor')),
            ring_outline: @json(__('ring_outline')),
            thin_ring_glow: @json(__('thin_ring_glow')),
            particle_trail: @json(__('particle_trail')),
            particles_follow_cursor: @json(__('particles_follow_cursor')),
            ripple_wave: @json(__('ripple_wave')),
            spreading_wave: @json(__('spreading_wave')),
            burst: @json(__('burst')),
            particle_explosion: @json(__('particle_explosion')),
            ring_pulse: @json(__('ring_pulse')),
            expanding_ring: @json(__('expanding_ring')),
            sparkle: @json(__('sparkle')),
            small_stars: @json(__('small_stars')),
            color_theme: @json(__('color_theme')),
            choose_stunning_theme: @json(__('choose_stunning_theme')),
            active_now: @json(__('active_now')),
            total_user: @json(__('total_user')),
            revenue: @json(__('revenue')),
            active_session: @json(__('active_session')),
            complaints: @json(__('complaints')),
            select: @json(__('select')),
            selected: @json(__('selected')),
            apply_theme: @json(__('apply_theme')),
            apply: @json(__('apply')),
            demo_warning_title: @json(__('demo_warning_title')),
            demo_warning_message: @json(__('demo_warning_message')),
            demo_action_success: @json(__('demo_action_success')),
            demo_delete_title: @json(__('demo_delete_title')),
            demo_delete_message: @json(__('demo_delete_message')),
            yes_delete: @json(__('yes_delete')),
            yes_continue: @json(__('yes_continue')),
            demo_delete_success: @json(__('demo_delete_success')),
            demo_save_title: @json(__('demo_save_title')),
            demo_save_message: @json(__('demo_save_message')),
            review_again: @json(__('review_again')),
            demo_save_success: @json(__('demo_save_success')),
            demo_info_title: @json(__('demo_info_title')),
            demo_info_message: @json(__('demo_info_message')),
            understood: @json(__('understood')),
            close: @json(__('close')),
            demo_info_thanks: @json(__('demo_info_thanks')),
            demo_toast_success_msg: @json(__('demo_toast_success_msg')),
            demo_toast_error_msg: @json(__('demo_toast_error_msg')),
            demo_toast_warning_msg: @json(__('demo_toast_warning_msg')),
            demo_toast_info_msg: @json(__('demo_toast_info_msg')),
            demo_long_toast_msg: @json(__('demo_long_toast_msg')),
            demo_permanent_toast_msg: @json(__('demo_permanent_toast_msg'))
        };
    </script>
    
    @include('components.layouts.scripts.app-state')
</body>
</html>
