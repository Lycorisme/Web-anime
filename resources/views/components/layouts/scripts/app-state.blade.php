<script>
    document.addEventListener('alpine:init', () => {
        Alpine.store('layout', {
            sidebarOpen: localStorage.getItem('sidebarOpen') === null 
                ? window.innerWidth >= 1024 
                : localStorage.getItem('sidebarOpen') === 'true',
            toggle() {
                this.sidebarOpen = !this.sidebarOpen;
                localStorage.setItem('sidebarOpen', this.sidebarOpen);
            }
        });
        
        window.addEventListener('resize', () => {
            // Only auto-collapse on small screens, don't auto-open
             if (window.innerWidth < 1024) {
                 Alpine.store('layout').sidebarOpen = false;
             }
        });
    });

    function appState() {
        return {
            // sidebarOpen moved to Alpine.store('layout')
            darkMode: localStorage.getItem('darkMode') === 'true',
            loaded: false,
            
            // Initialize directly from localStorage to prevent color flash
            currentTheme: JSON.parse(localStorage.getItem('userTheme')) || { name: 'Cyber', start: '#1d4ed8', end: '#7c3aed' },
            colorThemes: [
                { name: 'Cyber', start: '#1d4ed8', end: '#7c3aed' },
                { name: 'Sunset', start: '#f43f5e', end: '#fb923c' },
                { name: 'Emerald', start: '#059669', end: '#34d399' },
                { name: 'Ocean', start: '#0ea5e9', end: '#22d3ee' },
                { name: 'Midnight', start: '#2563eb', end: '#db2777' },
                { name: 'Gold', start: '#d97706', end: '#fcd34d' },
                { name: 'Indigo', start: '#3730a3', end: '#818cf8' },
                { name: 'Rose', start: '#be123c', end: '#fb7185' },
                { name: 'Teal', start: '#115e59', end: '#2dd4bf' }
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
                
                // Enable transitions after initial render
                setTimeout(() => this.loaded = true, 100);
                
                // Theme is already initialized in state definition causing no flash
                // Just ensure CSS variables are set
                if (this.currentTheme) {
                    document.documentElement.style.setProperty('--gradient-start', this.currentTheme.start);
                    document.documentElement.style.setProperty('--gradient-end', this.currentTheme.end);
                }
                
                window.addEventListener('resize', () => {
                    // Handled in store
                });

                document.addEventListener('livewire:navigated', () => {
                    this.menuItems = this.getMenuItems();
                    lucide.createIcons();
                    
                    // Reapply theme CSS variables (prevent reset after navigation)
                    const savedTheme = JSON.parse(localStorage.getItem('userTheme') || 'null');
                    if (savedTheme) {
                        this.currentTheme = savedTheme;
                        document.documentElement.style.setProperty('--gradient-start', savedTheme.start);
                        document.documentElement.style.setProperty('--gradient-end', savedTheme.end);
                    }
                });
            },

            setTheme(theme, showToast = true) {
                this.currentTheme = theme;
                document.documentElement.style.setProperty('--gradient-start', theme.start);
                document.documentElement.style.setProperty('--gradient-end', theme.end);
                localStorage.setItem('userTheme', JSON.stringify(theme));
                
                // Dispatch theme changed event for other components (like particles)
                window.dispatchEvent(new CustomEvent('theme-changed', { detail: theme }));
                
                // Show toast notification when theme is changed
                if (showToast) {
                    window.dispatchEvent(new CustomEvent('toast-success', {
                        detail: {
                            title: 'Tema Diubah!',
                            message: `Tema "${theme.name}" berhasil diterapkan`,
                            duration: 3000
                        }
                    }));
                }
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
        // Toast notifications are now handled directly in Livewire components
        
        // Bridge Livewire 'appearance-updated' event to window for Alpine.js components
        Livewire.on('appearance-updated', (data) => {
            const eventData = data[0] || data;
            window.dispatchEvent(new CustomEvent('appearance-updated', {
                detail: eventData
            }));
        });
    });
</script>
