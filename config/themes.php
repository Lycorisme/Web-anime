<?php

/**
 * Theme Library Configuration
 * 
 * Defines all available theme presets for the application.
 * Each theme has colors, effects, and metadata.
 */

return [
    /*
    |--------------------------------------------------------------------------
    | Default Theme
    |--------------------------------------------------------------------------
    */
    'default' => 'lycoris_cyber',

    /*
    |--------------------------------------------------------------------------
    | Theme Presets
    |--------------------------------------------------------------------------
    */
    'presets' => [
        
        /*
         * Lycoris Cyber - Premium Dark Theme
         * Glassmorphism aesthetic with deep slate backgrounds
         */
        'lycoris_cyber' => [
            'name' => 'Lycoris Cyber',
            'description' => 'Premium dark interface with glassmorphism',
            'icon' => 'bi-moon-stars-fill',
            'mode' => 'dark',
            'colors' => [
                'primary' => '#6366f1',      // Indigo-500
                'secondary' => '#8b5cf6',    // Purple-500
                'accent' => '#ec4899',       // Pink-500
                'background' => '#0f172a',   // Slate-900
                'surface' => '#1e293b',      // Slate-800
                'text' => '#f8fafc',         // Slate-50
                'text_muted' => '#94a3b8',   // Slate-400
                'border' => 'rgba(255, 255, 255, 0.1)',
            ],
            'effects' => [
                'glassmorphism' => true,
                'blur_intensity' => 20,
                'glow' => true,
                'animated_blobs' => true,
            ],
        ],

        /*
         * Arctic Snow - Clean Light Theme
         * Fresh, minimal aesthetic with cool tones
         */
        'arctic_snow' => [
            'name' => 'Arctic Snow',
            'description' => 'Clean & refreshing light theme',
            'icon' => 'bi-snow',
            'mode' => 'light',
            'colors' => [
                'primary' => '#0ea5e9',      // Sky-500
                'secondary' => '#06b6d4',    // Cyan-500
                'accent' => '#14b8a6',       // Teal-500
                'background' => '#f8fafc',   // Slate-50
                'surface' => '#ffffff',      // White
                'text' => '#0f172a',         // Slate-900
                'text_muted' => '#64748b',   // Slate-500
                'border' => 'rgba(15, 23, 42, 0.1)',
            ],
            'effects' => [
                'glassmorphism' => true,
                'blur_intensity' => 16,
                'glow' => false,
                'animated_blobs' => true,
            ],
        ],

        /*
         * Midnight Purple - Deep Purple Theme
         * Rich purple aesthetic for night owls
         */
        'midnight_purple' => [
            'name' => 'Midnight Purple',
            'description' => 'Deep purple aesthetic for night mode',
            'icon' => 'bi-stars',
            'mode' => 'dark',
            'colors' => [
                'primary' => '#a855f7',      // Purple-500
                'secondary' => '#c084fc',    // Purple-400
                'accent' => '#f472b6',       // Pink-400
                'background' => '#0f0720',   // Deep purple
                'surface' => '#1a0b2e',      // Purple-dark
                'text' => '#faf5ff',         // Purple-50
                'text_muted' => '#a78bfa',   // Purple-400
                'border' => 'rgba(168, 85, 247, 0.2)',
            ],
            'effects' => [
                'glassmorphism' => true,
                'blur_intensity' => 24,
                'glow' => true,
                'animated_blobs' => true,
            ],
        ],

        /*
         * Sunset Gradient - Warm Vibrant Theme
         * Beautiful orange/rose gradient for sunset vibes
         */
        'sunset_gradient' => [
            'name' => 'Sunset Gradient',
            'description' => 'Warm vibrant colors inspired by sunset',
            'icon' => 'bi-sunset-fill',
            'mode' => 'dark',
            'colors' => [
                'primary' => '#f97316',      // Orange-500
                'secondary' => '#fb923c',    // Orange-400
                'accent' => '#f43f5e',       // Rose-500
                'background' => '#1c1917',   // Stone-900
                'surface' => '#292524',      // Stone-800
                'text' => '#fafaf9',         // Stone-50
                'text_muted' => '#a8a29e',   // Stone-400
                'border' => 'rgba(251, 146, 60, 0.2)',
            ],
            'effects' => [
                'glassmorphism' => true,
                'blur_intensity' => 20,
                'glow' => true,
                'animated_blobs' => true,
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Customizable Color Keys
    |--------------------------------------------------------------------------
    | These are the color keys that users can customize
    */
    'customizable_colors' => [
        'primary' => [
            'label' => 'Primary Color',
            'description' => 'Main brand color used for buttons and accents',
        ],
        'secondary' => [
            'label' => 'Secondary Color', 
            'description' => 'Supporting color for gradients and highlights',
        ],
        'accent' => [
            'label' => 'Accent Color',
            'description' => 'Eye-catching color for important elements',
        ],
        'background' => [
            'label' => 'Background Color',
            'description' => 'Main page background color',
        ],
        'surface' => [
            'label' => 'Surface Color',
            'description' => 'Card and panel background color',
        ],
        'text' => [
            'label' => 'Text Color',
            'description' => 'Main text color',
        ],
        'text_muted' => [
            'label' => 'Muted Text Color',
            'description' => 'Secondary/dimmed text color',
        ],
    ],
];
