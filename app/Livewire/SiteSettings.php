<?php

namespace App\Livewire;

use App\Models\SiteSetting;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class SiteSettings extends Component
{
    use WithFileUploads;

    public string $siteName = '';
    public string $siteTagline = '';
    public string $siteDescription = '';
    public string $siteIcon = '';
    public $siteLogo = null;
    public $siteFavicon = null;
    public ?string $currentLogo = null;
    public ?string $currentFavicon = null;
    public string $footerCopyright = '';
    
    // Theme Properties
    public string $activeTheme = 'lycoris_cyber';
    public array $customColors = [];
    public array $themePresets = [];
    
    public bool $showSuccess = false;
    public string $successMessage = '';
    
    public string $activeTab = 'general';

    public function mount(): void
    {
        $this->siteName = SiteSetting::get('site_name', 'PORTAL GG');
        $this->siteTagline = SiteSetting::get('site_tagline', '');
        $this->siteDescription = SiteSetting::get('site_description', '');
        $this->siteIcon = SiteSetting::get('site_icon', 'bi bi-lightning-charge-fill');
        $this->currentLogo = SiteSetting::get('site_logo');
        $this->currentFavicon = SiteSetting::get('site_favicon');
        $this->footerCopyright = SiteSetting::get('footer_copyright', '© 2026 PORTAL GG. All rights reserved.');
        
        // Load theme settings
        $this->activeTheme = SiteSetting::get('active_theme', config('themes.default', 'lycoris_cyber'));
        $this->themePresets = config('themes.presets', []);
        
        // Load custom colors or use preset defaults
        $savedColors = SiteSetting::get('custom_colors');
        if ($savedColors) {
            $this->customColors = json_decode($savedColors, true) ?? [];
        } else {
            $this->customColors = $this->getPresetColors($this->activeTheme);
        }
    }

    /**
     * Get colors for a specific theme preset
     */
    public function getPresetColors(string $themeName): array
    {
        return $this->themePresets[$themeName]['colors'] ?? config('themes.presets.lycoris_cyber.colors', []);
    }

    /**
     * Apply a theme preset
     */
    public function applyTheme(string $themeName): void
    {
        if (!isset($this->themePresets[$themeName])) {
            return;
        }

        $this->activeTheme = $themeName;
        $this->customColors = $this->getPresetColors($themeName);
        
        // Save immediately
        $this->saveTheme();
        
        // Dispatch event for frontend
        $this->dispatch('theme-changed', [
            'theme' => $themeName,
            'colors' => $this->customColors,
            'mode' => $this->themePresets[$themeName]['mode'] ?? 'dark',
        ]);
    }

    /**
     * Update a custom color
     */
    public function updateColor(string $colorKey, string $colorValue): void
    {
        $this->customColors[$colorKey] = $colorValue;
        
        // Dispatch live preview
        $this->dispatch('color-preview', [
            'key' => $colorKey,
            'value' => $colorValue,
        ]);
    }

    /**
     * Reset colors to current theme preset
     */
    public function resetColors(): void
    {
        $this->customColors = $this->getPresetColors($this->activeTheme);
        $this->dispatch('theme-changed', [
            'theme' => $this->activeTheme,
            'colors' => $this->customColors,
            'mode' => $this->themePresets[$this->activeTheme]['mode'] ?? 'dark',
        ]);
    }

    /**
     * Save theme settings to database
     */
    public function saveTheme(): void
    {
        SiteSetting::set('active_theme', $this->activeTheme, [
            'type' => 'text',
            'group' => 'theme',
            'label' => 'Active Theme',
        ]);

        SiteSetting::set('custom_colors', json_encode($this->customColors), [
            'type' => 'json',
            'group' => 'theme',
            'label' => 'Custom Colors',
        ]);

        SiteSetting::clearCache();
    }

    public function save(): void
    {
        $this->validate([
            'siteName' => 'required|string|max:100',
            'siteTagline' => 'nullable|string|max:255',
            'siteDescription' => 'nullable|string|max:1000',
            'siteIcon' => 'nullable|string|max:100',
            'siteLogo' => 'nullable|image|max:2048', // Max 2MB
            'siteFavicon' => 'nullable|image|max:1024', // Max 1MB
            'footerCopyright' => 'required|string|max:255',
        ]);

        // Save site name
        SiteSetting::set('site_name', $this->siteName, [
            'type' => 'text',
            'group' => 'general',
            'label' => 'Nama Portal',
        ]);

        // Save site tagline
        SiteSetting::set('site_tagline', $this->siteTagline, [
            'type' => 'text',
            'group' => 'general',
            'label' => 'Tagline',
        ]);

        // Save site description
        SiteSetting::set('site_description', $this->siteDescription, [
            'type' => 'textarea',
            'group' => 'general',
            'label' => 'Deskripsi Website',
        ]);

        // Save site icon
        SiteSetting::set('site_icon', $this->siteIcon, [
            'type' => 'text',
            'group' => 'appearance',
            'label' => 'Icon Default',
        ]);

        // Handle logo upload
        if ($this->siteLogo) {
            // Delete old logo if exists
            if ($this->currentLogo && Storage::disk('public')->exists($this->currentLogo)) {
                Storage::disk('public')->delete($this->currentLogo);
            }

            // Store new logo
            $path = $this->siteLogo->store('logos', 'public');
            
            SiteSetting::set('site_logo', $path, [
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Logo Utama',
            ]);

            $this->currentLogo = $path;
            $this->siteLogo = null;
        }

        // Handle favicon upload
        if ($this->siteFavicon) {
            // Delete old favicon if exists
            if ($this->currentFavicon && Storage::disk('public')->exists($this->currentFavicon)) {
                Storage::disk('public')->delete($this->currentFavicon);
            }

            // Store new favicon
            $faviconPath = $this->siteFavicon->store('favicons', 'public');
            
            SiteSetting::set('site_favicon', $faviconPath, [
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Favicon',
            ]);

            $this->currentFavicon = $faviconPath;
            $this->siteFavicon = null;
        }

        // Save footer copyright
        SiteSetting::set('footer_copyright', $this->footerCopyright, [
            'type' => 'text',
            'group' => 'footer',
            'label' => 'Copyright Footer',
        ]);

        // Save theme settings
        $this->saveTheme();

        // Clear all settings cache to ensure fresh data
        SiteSetting::clearCache();

        $this->showSuccess = true;
        $this->successMessage = 'Pengaturan berhasil disimpan!';

        $this->dispatch('settings-saved');
    }

    public function removeLogo(): void
    {
        if ($this->currentLogo && Storage::disk('public')->exists($this->currentLogo)) {
            Storage::disk('public')->delete($this->currentLogo);
        }

        SiteSetting::set('site_logo', null, [
            'type' => 'image',
            'group' => 'appearance',
            'label' => 'Logo Website',
        ]);

        $this->currentLogo = null;
        SiteSetting::clearCache();

        $this->dispatch('settings-saved');
    }

    public function removeFavicon(): void
    {
        if ($this->currentFavicon && Storage::disk('public')->exists($this->currentFavicon)) {
            Storage::disk('public')->delete($this->currentFavicon);
        }

        SiteSetting::set('site_favicon', null, [
            'type' => 'image',
            'group' => 'appearance',
            'label' => 'Favicon',
        ]);

        $this->currentFavicon = null;
        SiteSetting::clearCache();
        
        $this->dispatch('settings-saved');
    }

    public function setTab(string $tab): void
    {
        $this->activeTab = $tab;
    }

    public function cancel(): void
    {
        $this->mount();
        $this->reset(['siteLogo', 'siteFavicon']);
        $this->resetErrorBag();
    }

    public function render()
    {
        return view('livewire.site-settings', [
            'themePresets' => $this->themePresets,
            'customizableColors' => config('themes.customizable_colors', []),
        ])->layout('layouts.app');
    }
}

