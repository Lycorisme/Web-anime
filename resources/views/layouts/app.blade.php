<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
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
    <link href="https://cdn.jsdelivr.net/npm/animate.css@4.1.1/animate.min.css" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    
    <!-- Inline critical dark mode to prevent flash -->
    <script>
        if (localStorage.getItem('darkMode') === 'true' || 
            (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
</head>
<body 
    x-data="appState()" 
    x-init="init()"
    :class="{ 'dark': darkMode }"
    class="bg-slate-100 dark:bg-[#020617] text-slate-900 dark:text-slate-100 min-h-screen overflow-x-hidden antialiased transition-colors duration-300"
>
    <!-- Background Blobs -->
    <div class="blob w-96 h-96 bg-blue-500 top-[-10%] left-[-10%]"></div>
    <div class="blob w-80 h-80 bg-purple-500 bottom-[-5%] right-[0%]" style="animation-delay: -5s;"></div>
    <div class="blob w-64 h-64 bg-pink-500 top-[50%] right-[-5%]" style="animation-delay: -10s;"></div>

    <!-- Main Container -->
    <div class="relative z-10 w-full min-h-screen">
        {{ $slot }}
    </div>

    @livewireScripts
    
    <script>
        function appState() {
            return {
                sidebarOpen: window.innerWidth >= 1024,
                darkMode: localStorage.getItem('darkMode') === 'true' || 
                          (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches),
                
                menuItems: [
                    { title: 'Dashboard', icon: 'bi bi-grid-1x2-fill', url: '#', active: true },
                    { title: 'Data Master', icon: 'bi bi-database-fill', url: '#', active: false },
                    { title: 'Statistik', icon: 'bi bi-bar-chart-line-fill', url: '#', active: false },
                    { title: 'Pengguna', icon: 'bi bi-people-fill', url: '#', active: false },
                    { title: 'Laporan', icon: 'bi bi-file-earmark-bar-graph-fill', url: '#', active: false },
                    { title: 'Pengaturan', icon: 'bi bi-gear-fill', url: '#', active: false },
                ],

                stats: [
                    { label: 'Total User', value: '2,840', icon: 'bi bi-people', trend: '+12%', bgIcon: 'bg-blue-600' },
                    { label: 'Revenue', value: '$12.4k', icon: 'bi bi-currency-dollar', trend: '+8.4%', bgIcon: 'bg-emerald-600' },
                    { label: 'Active Session', value: '452', icon: 'bi bi-cpu', trend: '+24%', bgIcon: 'bg-purple-600' },
                    { label: 'Complaints', value: '12', icon: 'bi bi-exclamation-triangle', trend: '-2%', bgIcon: 'bg-rose-600' },
                ],
                
                init() {
                    this.applyDarkMode();
                    
                    // Listen for system preference changes
                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                        if (!localStorage.getItem('darkMode')) {
                            this.darkMode = e.matches;
                            this.applyDarkMode();
                        }
                    });
                    
                    // Handle resize
                    window.addEventListener('resize', () => {
                        if (window.innerWidth >= 1024) {
                            this.sidebarOpen = true;
                        }
                    });
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
                    localStorage.setItem('darkMode', this.darkMode.toString());
                    this.applyDarkMode();
                }
            }
        }
    </script>
</body>
</html>
