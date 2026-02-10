/**
 * Theme Handler
 * Handles theme loading, saving, and application
 */
window.ThemeHandler = {
    /**
     * Initialize theme from localStorage or database
     */
    init() {
        this.loadTheme();
        this.setupListeners();
    },

    /**
     * Load theme from localStorage (fast) or use defaults
     */
    loadTheme() {
        const savedTheme = localStorage.getItem('activeTheme');
        const savedColors = localStorage.getItem('themeColors');
        const savedMode = localStorage.getItem('darkMode');

        // Apply dark mode
        if (savedMode !== null) {
            const isDark = savedMode === 'true';
            // Only toggle if necessary to avoid redundant operations
            if (document.documentElement.classList.contains('dark') !== isDark) {
                document.documentElement.classList.toggle('dark', isDark);
            }
        }

        // Apply colors from cache
        if (savedColors) {
            try {
                const colors = JSON.parse(savedColors);
                this.applyCSSVariables(colors);
            } catch (e) {
                console.warn('Failed to parse theme colors from localStorage');
            }
        }

        console.log('Theme loaded:', savedTheme || 'default');
    },

    /**
     * Apply CSS variables from colors object
     */
    applyCSSVariables(colors) {
        const root = document.documentElement;

        Object.entries(colors).forEach(([key, value]) => {
            if (value && !value.includes('rgba')) {
                const cssKey = '--theme-' + key.replace(/_/g, '-');
                root.style.setProperty(cssKey, value);
            }
        });
    },

    /**
     * Save theme to localStorage
     */
    saveToLocalStorage(themeName, colors, isDark) {
        localStorage.setItem('activeTheme', themeName);
        localStorage.setItem('themeColors', JSON.stringify(colors));
        localStorage.setItem('darkMode', isDark.toString());
        // Sync cookie for SSR
        document.cookie = `theme_dark=${isDark}; path=/; max-age=31536000; SameSite=Lax`;
    },

    /**
     * Setup Livewire event listeners
     */
    setupListeners() {
        // Listen for theme changes from Livewire
        document.addEventListener('livewire:init', () => {
            Livewire.on('theme-changed', (data) => {
                const payload = data[0] || data;
                // Handle structure from CustomEvent detail (payload.detail) or direct payload
                const { theme, colors, mode } = payload.detail || payload;

                // Update dark mode only if mode is explicitly provided
                if (mode !== undefined && mode !== null) {
                    const isDark = mode === 'dark';
                    if (document.documentElement.classList.contains('dark') !== isDark) {
                        document.documentElement.classList.toggle('dark', isDark);
                    }
                }

                // Apply CSS variables
                if (colors) {
                    this.applyCSSVariables(colors);
                }

                // Save to localStorage (and cookies)
                // Use current state if mode not provided
                const currentDark = document.documentElement.classList.contains('dark');
                this.saveToLocalStorage(theme?.name || theme, colors, mode === 'dark' ? true : (mode === 'light' ? false : currentDark));

                console.log('Theme changed to:', theme);
            });

            Livewire.on('color-preview', (data) => {
                const { key, value } = data[0] || data;
                if (value && /^#[0-9A-Fa-f]{6}$/.test(value)) {
                    const cssKey = '--theme-' + key.replace(/_/g, '-');
                    document.documentElement.style.setProperty(cssKey, value);
                }
            });
        });
    }
};

// Auto-initialize on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    window.ThemeHandler.init();
});
