<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal GG - Premium Cyber Dashboard">
    <title>{{ \App\Models\SiteSetting::get('site_name', config('app.name', 'Portal GG')) }}</title>
    
    <!-- Favicon -->
    @if($favicon = \App\Models\SiteSetting::get('site_favicon'))
        <link rel="icon" href="{{ Storage::url($favicon) }}">
    @endif
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <!-- Prevent flash of wrong theme -->
    <script>
        (function() {
            const darkMode = localStorage.getItem('darkMode') === 'true';
            if (darkMode) {
                document.documentElement.classList.add('dark');
            }
            
            const savedTheme = JSON.parse(localStorage.getItem('userTheme') || 'null');
            if (savedTheme) {
                document.documentElement.style.setProperty('--gradient-start', savedTheme.start);
                document.documentElement.style.setProperty('--gradient-end', savedTheme.end);
            }
        })();
    </script>
    
    <style>[x-cloak] { display: none !important; }</style>
</head>
<body 
    x-data="appState()" 
    x-init="init()"
    :class="darkMode ? 'bg-cyber-dark text-slate-100' : 'bg-slate-50 text-slate-900'"
    class="min-h-screen overflow-x-hidden transition-colors duration-300"
>
    <!-- Background Blobs -->
    @persist('background-blobs')
    <div class="blob w-96 h-96 top-[-10%] left-[-10%]" :style="`background: ${currentTheme.start}`"></div>
    <div class="blob w-80 h-80 bottom-[-5%] right-[0%]" :style="`background: ${currentTheme.end}; animation-delay: -5s;`"></div>
    @endpersist

    <!-- Main Container -->
    <div class="flex relative z-10">
        <!-- Sidebar -->
        <x-dashboard.sidebar />

        <!-- Main Content -->
        <main :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-24'" class="flex-1 p-4 lg:p-8 transition-all duration-300">
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
    <x-ui.toast position="top-right" :duration="5000" :maxToasts="5" />

    <!-- Global Alert Confirmation Dialog -->
    <x-ui.alert-confirm id="global-confirm" />

    @livewireScripts
    
    <script>
        function appState() {
            return {
                sidebarOpen: window.innerWidth >= 1024,
                darkMode: localStorage.getItem('darkMode') === 'true',
                
                currentTheme: { name: 'Cyber', start: '#1d4ed8', end: '#7c3aed' },
                colorThemes: [
                    { name: 'Cyber', start: '#1d4ed8', end: '#7c3aed' },
                    { name: 'Sunset', start: '#f43f5e', end: '#fb923c' },
                    { name: 'Emerald', start: '#059669', end: '#34d399' },
                    { name: 'Ocean', start: '#0ea5e9', end: '#22d3ee' },
                    { name: 'Midnight', start: '#2563eb', end: '#db2777' },
                    { name: 'Gold', start: '#d97706', end: '#fcd34d' }
                ],

                menuItems: [],
                
                getMenuItems() {
                    return [
                        { title: 'Dashboard', icon: 'bi bi-grid-1x2-fill', url: '/', active: window.location.pathname === '/' },
                        { title: 'Data Master', icon: 'bi bi-database-fill', url: '#', active: false },
                        { title: 'Statistik', icon: 'bi bi-bar-chart-line-fill', url: '#', active: false },
                        { title: 'Pengguna', icon: 'bi bi-people-fill', url: '#', active: false },
                        { title: 'Pengaturan', icon: 'bi bi-gear-fill', url: '/settings', active: window.location.pathname === '/settings' },
                    ];
                },

                stats: [
                    { label: 'Total User', value: '2,840', icon: 'bi bi-people', trend: '+12%' },
                    { label: 'Revenue', value: '$12.4k', icon: 'bi bi-currency-dollar', trend: '+8.4%' },
                    { label: 'Active Session', value: '452', icon: 'bi bi-cpu', trend: '+24%' },
                    { label: 'Complaints', value: '12', icon: 'bi bi-exclamation-triangle', trend: '-2%' },
                ],

                init() {
                    this.menuItems = this.getMenuItems();
                    this.applyDarkMode();
                    this.loadTheme();
                    
                    window.addEventListener('resize', () => {
                        this.sidebarOpen = window.innerWidth >= 1024;
                    });

                    document.addEventListener('livewire:navigated', () => {
                        this.menuItems = this.getMenuItems();
                        lucide.createIcons();
                    });
                },

                loadTheme() {
                    const savedTheme = JSON.parse(localStorage.getItem('userTheme') || 'null');
                    if (savedTheme) this.setTheme(savedTheme);
                },

                setTheme(theme) {
                    this.currentTheme = theme;
                    document.documentElement.style.setProperty('--gradient-start', theme.start);
                    document.documentElement.style.setProperty('--gradient-end', theme.end);
                    localStorage.setItem('userTheme', JSON.stringify(theme));
                },

                applyDarkMode() {
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },

                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                    localStorage.setItem('darkMode', this.darkMode);
                    this.applyDarkMode();
                }
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('settings-saved', () => {
                window.dispatchEvent(new CustomEvent('toast-success', { 
                    detail: { message: 'Perubahan berhasil disimpan!', title: 'Sukses' }
                }));
            });
        });
    </script>
</body>
</html>
