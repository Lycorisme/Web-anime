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
            // Initialize based on what the Server (SSR) rendered, effectively trusting the Cookie/HTML class.
            // This prevents JS from flipping the class back and forth on load.
            darkMode: document.documentElement.classList.contains('dark'),
            loaded: false,
            
            // Theme colors still need localStorage as they are dynamic CSS variables
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
                { name: 'Teal', start: '#115e59', end: '#2dd4bf' },
                { name: 'Violet', start: '#7c3aed', end: '#a78bfa' },
                { name: 'Fuchsia', start: '#c026d3', end: '#e879f9' },
                { name: 'Lime', start: '#65a30d', end: '#a3e635' },
                { name: 'Aurora', start: '#0d9488', end: '#a855f7' },
                { name: 'Sakura', start: '#ec4899', end: '#f97316' },
                { name: 'Nebula', start: '#1e3a8a', end: '#c026d3' },
                { name: 'Amber', start: '#b45309', end: '#facc15' }
            ],

            menuItems: [],
            
            getMenuItems() {
                const path = window.location.pathname;
                return [
                    { title: window.i18n?.dashboard || 'Dashboard', icon: 'bi bi-grid-1x2-fill', url: '/', active: path === '/' },
                    { title: window.i18n?.management_user || 'Management User', icon: 'bi bi-people-fill', url: '/management-user', active: path.startsWith('/management-user') },
                    { title: window.i18n?.settings || 'Settings', icon: 'bi bi-gear-fill', url: '/settings', active: path.startsWith('/settings') },
                ];
            },

            stats: [],
            
            getStats() {
                return [
                    { label: window.i18n?.total_user || 'Total User', value: '2,840', icon: 'bi bi-people', trend: '+12%' },
                    { label: window.i18n?.revenue || 'Revenue', value: '$12.4k', icon: 'bi bi-currency-dollar', trend: '+8.4%' },
                    { label: window.i18n?.active_session || 'Active Session', value: '452', icon: 'bi bi-cpu', trend: '+24%' },
                    { label: window.i18n?.complaints || 'Complaints', value: '12', icon: 'bi bi-exclamation-triangle', trend: '-2%' },
                ];
            },

            init() {
                this.menuItems = this.getMenuItems();
                this.stats = this.getStats();
                
                // PASSIVE INIT: Do NOT force applyDarkMode(). 
                // The class is already on <html> from PHP (SSR).
                // Just sync our internal JS state to match DOM if needed.
                if (document.documentElement.classList.contains('dark') !== this.darkMode) {
                    this.darkMode = document.documentElement.classList.contains('dark');
                }

                // Sync cookie if totally missing (redundancy)
                if (!document.cookie.includes('theme_dark')) {
                     document.cookie = `theme_dark=${this.darkMode}; path=/; max-age=31536000; SameSite=Lax`;
                }
                
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
                // Include current mode to prevent theme-handler from resetting it
                window.dispatchEvent(new CustomEvent('theme-changed', { 
                    detail: { 
                        theme: theme, 
                        colors: theme, 
                        mode: this.darkMode ? 'dark' : 'light' 
                    } 
                }));
                
                // Show toast notification when theme is changed (no confirmation, no reload)
                if (showToast) {
                    window.dispatchEvent(new CustomEvent('toast-success', {
                        detail: {
                            title: window.i18n?.theme_changed || 'Theme Changed',
                            message: (window.i18n?.theme_applied_message || 'Theme has been applied successfully!').replace('!', '') + `: "${theme.name}"`,
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

            toggleDarkMode(event) {
                // Direct toggle
                this.setDarkMode(!this.darkMode);
            },
            
            setDarkMode(value) {
                this.darkMode = value;
                localStorage.setItem('darkMode', this.darkMode);
                document.cookie = `theme_dark=${this.darkMode}; path=/; max-age=31536000; SameSite=Lax`;
                this.applyDarkMode();
                
                window.dispatchEvent(new CustomEvent('theme-changed', { 
                    detail: { 
                        theme: this.currentTheme, 
                        colors: this.currentTheme, 
                        mode: this.darkMode ? 'dark' : 'light' 
                    } 
                }));
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
