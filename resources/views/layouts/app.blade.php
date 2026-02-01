<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth"
      x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }"
      x-init="$watch('darkMode', val => localStorage.setItem('darkMode', val))"
      :class="{ 'dark': darkMode }">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Portal GG - Premium Cyber Dashboard">
    <title>{{ config('app.name', 'Portal GG') }} - Dashboard</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <!-- Prevent flash of wrong theme -->
    <script>
        if (localStorage.getItem('darkMode') === 'true') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body 
    x-data="appState()" 
    x-init="init()"
    class="min-h-screen overflow-x-hidden antialiased transition-all duration-700 ease-in-out"
    :class="darkMode ? 'bg-[#020617] text-slate-100' : 'bg-gradient-to-br from-slate-100 via-blue-50 to-purple-50 text-slate-900'"
>
    <!-- Background Blobs - Persist across navigation -->
    @persist('background-blobs')
    <div class="blob w-[500px] h-[500px] bg-blue-500 fixed -top-[10%] -left-[10%]" 
         x-show="true"
         x-transition:enter="transition ease-out duration-1000"
         x-transition:enter-start="opacity-0 scale-50"
         x-transition:enter-end="opacity-100 scale-100"></div>
    <div class="blob w-[400px] h-[400px] bg-purple-500 fixed -bottom-[5%] -right-[5%]" style="animation-delay: -7s;"></div>
    <div class="blob w-[300px] h-[300px] bg-pink-500 fixed top-[40%] -right-[10%]" style="animation-delay: -14s;"></div>
    <div class="blob w-[350px] h-[350px] bg-cyan-500 fixed top-[60%] -left-[8%]" style="animation-delay: -21s;"></div>
    @endpersist

    <!-- Main Container -->
    <div class="relative z-10 w-full min-h-screen">
        {{ $slot }}
    </div>

    @livewireScripts
    
    <script>
        function appState() {
            return {
                sidebarOpen: localStorage.getItem('sidebarOpen') !== null 
                    ? localStorage.getItem('sidebarOpen') === 'true' 
                    : window.innerWidth >= 1024,
                darkMode: localStorage.getItem('darkMode') === 'true',
                
                menuItems: [],
                
                getMenuItems() {
                    return [
                        { title: 'Dashboard', icon: 'bi bi-grid-1x2-fill', url: '/', active: window.location.pathname === '/' },
                        { title: 'Pengaturan', icon: 'bi bi-gear-fill', url: '/settings', active: window.location.pathname === '/settings' },
                    ];
                },

                stats: [
                    { label: 'Total User', value: '2,840', icon: 'bi bi-people', trend: '+12%', bgIcon: 'bg-blue-500' },
                    { label: 'Revenue', value: '$12.4k', icon: 'bi bi-currency-dollar', trend: '+8.4%', bgIcon: 'bg-emerald-500' },
                    { label: 'Active Session', value: '452', icon: 'bi bi-cpu', trend: '+24%', bgIcon: 'bg-purple-500' },
                    { label: 'Complaints', value: '12', icon: 'bi bi-exclamation-triangle', trend: '-2%', bgIcon: 'bg-rose-500' },
                ],
                
                init() {
                    this.menuItems = this.getMenuItems();
                    this.syncDarkMode();
                    
                    // Watch sidebarOpen changes and save to localStorage
                    this.$watch('sidebarOpen', (value) => {
                        localStorage.setItem('sidebarOpen', value.toString());
                    });
                    
                    // Update menu items on Livewire navigation
                    document.addEventListener('livewire:navigated', () => {
                        this.menuItems = this.getMenuItems();
                    });
                    
                    // Handle resize
                    window.addEventListener('resize', () => {
                        if (window.innerWidth >= 1024) {
                            this.sidebarOpen = true;
                        } else {
                            this.sidebarOpen = false;
                        }
                    });

                    // Sync with html element
                    this.$watch('darkMode', (value) => {
                        this.syncDarkMode();
                    });
                },

                syncDarkMode() {
                    if (this.darkMode) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                    localStorage.setItem('darkMode', this.darkMode.toString());
                },

                toggleDarkMode() {
                    this.darkMode = !this.darkMode;
                }
            }
        }
    </script>
</body>
</html>
