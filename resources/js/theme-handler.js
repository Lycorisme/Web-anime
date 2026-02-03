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
            document.documentElement.classList.toggle('dark', isDark);
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
    },

    /**
     * Setup Livewire event listeners
     */
    setupListeners() {
        // Listen for theme changes from Livewire
        document.addEventListener('livewire:init', () => {
            Livewire.on('theme-changed', (data) => {
                const { theme, colors, mode } = data[0] || data;

                // Update dark mode
                const isDark = mode === 'dark';
                document.documentElement.classList.toggle('dark', isDark);

                // Apply CSS variables
                this.applyCSSVariables(colors);

                // Save to localStorage
                this.saveToLocalStorage(theme, colors, isDark);

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
