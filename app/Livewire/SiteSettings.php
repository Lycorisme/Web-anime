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
    public string $selectedLogoIcon = 'sparkles';
    public string $selectedFaviconIcon = 'sparkles';
    public string $footerCopyright = '';
    
    // Theme Properties
    public string $activeTheme = 'lycoris_cyber';
    public array $customColors = [];
    public array $themePresets = [];
    
    // Cursor & Click Animation Properties
    public string $cursorStyle = 'gradient_blob';
    public string $clickAnimation = 'ring_pulse';
    public bool $cursorEnabled = true;
    public bool $clickEnabled = true;
    
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
        $this->selectedLogoIcon = SiteSetting::get('site_logo_icon', 'sparkles');
        $this->selectedFaviconIcon = SiteSetting::get('site_favicon_icon', 'sparkles');
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
        
        // Load cursor & click animation settings
        $this->cursorStyle = SiteSetting::get('cursor_style', 'gradient_blob');
        $this->clickAnimation = SiteSetting::get('click_animation', 'ring_pulse');
        $this->cursorEnabled = (bool) SiteSetting::get('cursor_enabled', true);
        $this->clickEnabled = (bool) SiteSetting::get('click_enabled', true);

        // Check for session flash message for toast
        if (session()->has('toast_success')) {
            $this->dispatch('toast-success', session('toast_success'));
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
        
        // Dispatch toast notification
        $this->dispatch('toast-success', [
            'message' => 'Tema "' . ($this->themePresets[$themeName]['name'] ?? $themeName) . '" berhasil diterapkan!',
            'title' => 'Tema Berubah 🎨'
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

    /**
     * Save cursor & click animation settings to database
     */
    public function saveEffects(): void
    {
        SiteSetting::set('cursor_style', $this->cursorStyle, [
            'type' => 'text',
            'group' => 'effects',
            'label' => 'Cursor Style',
        ]);

        SiteSetting::set('click_animation', $this->clickAnimation, [
            'type' => 'text',
            'group' => 'effects',
            'label' => 'Click Animation',
        ]);

        SiteSetting::set('cursor_enabled', $this->cursorEnabled ? '1' : '0', [
            'type' => 'boolean',
            'group' => 'effects',
            'label' => 'Cursor Enabled',
        ]);

        SiteSetting::set('click_enabled', $this->clickEnabled ? '1' : '0', [
            'type' => 'boolean',
            'group' => 'effects',
            'label' => 'Click Enabled',
        ]);

        SiteSetting::clearCache();

        // Dispatch event for frontend
        $this->dispatch('effects-changed', [
            'cursorStyle' => $this->cursorStyle,
            'clickAnimation' => $this->clickAnimation,
            'cursorEnabled' => $this->cursorEnabled,
            'clickEnabled' => $this->clickEnabled,
        ]);

        // Dispatch toast notification
        $this->dispatch('toast-success', [
            'message' => 'Pengaturan efek kursor berhasil disimpan!',
            'title' => 'Efek Diperbarui ✨'
        ]);
    }

    /**
     * Update cursor style
     */
    public function setCursorStyle(string $style): void
    {
        $this->cursorStyle = $style;
        $this->saveEffects();
    }

    /**
     * Update click animation
     */
    public function setClickAnimation(string $animation): void
    {
        $this->clickAnimation = $animation;
        $this->saveEffects();
    }

    /**
     * Toggle cursor effect
     */
    public function toggleCursor(): void
    {
        $this->cursorEnabled = !$this->cursorEnabled;
        $this->saveEffects();
    }

    /**
     * Toggle click animation
     */
    public function toggleClick(): void
    {
        $this->clickEnabled = !$this->clickEnabled;
        $this->saveEffects();
    }

    public function save()
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

        SiteSetting::set('site_icon', $this->siteIcon, [
            'type' => 'text',
            'group' => 'appearance',
            'label' => 'Icon Default',
        ]);

        // Save Logo Icon Selection
        SiteSetting::set('site_logo_icon', $this->selectedLogoIcon, [
            'type' => 'text',
            'group' => 'appearance',
            'label' => 'Logo Fallback Icon',
        ]);

        // Save Favicon Icon Selection
        SiteSetting::set('site_favicon_icon', $this->selectedFaviconIcon, [
            'type' => 'text',
            'group' => 'appearance',
            'label' => 'Favicon Fallback Icon',
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
        
        // Always dispatch appearance update first so sidebar updates
        $this->dispatchAppearanceUpdate();
        
        if ($this->activeTab === 'appearance') {
            session()->flash('toast_success', [
                'message' => 'Tampilan visual berhasil disimpan! Halaman telah dimuat ulang.',
                'title' => 'Disimpan & Refresh 🔄'
            ]);
            
            return $this->redirect(request()->header('Referer'));
        }

        // Dispatch toast notification for other tabs
        $this->dispatch('toast-success', [
            'message' => 'Semua pengaturan telah berhasil disimpan!',
            'title' => 'Berhasil Disimpan ✨'
        ]);
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
        
        // Dispatch toast notification
        $this->dispatch('toast-success', [
            'message' => 'Logo berhasil dihapus dari website.',
            'title' => 'Logo Dihapus'
        ]);

        $this->dispatchAppearanceUpdate();
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
        
        // Dispatch toast notification
        $this->dispatch('toast-success', [
            'message' => 'Favicon berhasil dihapus dari website.',
            'title' => 'Favicon Dihapus'
        ]);

        $this->dispatchAppearanceUpdate();
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

    protected function dispatchAppearanceUpdate()
    {
        $icons = SiteSetting::getTailwindIcons();
        
        $logoSvg = isset($icons[$this->selectedLogoIcon]) ? $icons[$this->selectedLogoIcon] : null;
        $faviconSvg = isset($icons[$this->selectedFaviconIcon]) ? $icons[$this->selectedFaviconIcon] : null;
        
        $this->dispatch('appearance-updated', [
            'logoUrl' => $this->currentLogo ? Storage::url($this->currentLogo) : null,
            'logoSvg' => $logoSvg,
            'logoIcon' => $this->selectedLogoIcon,
            'faviconUrl' => $this->currentFavicon ? Storage::url($this->currentFavicon) : null,
            'faviconSvg' => $faviconSvg, // raw svg
            'faviconIcon' => $this->selectedFaviconIcon,
            'faviconDataUrl' => $faviconSvg ? 'data:image/svg+xml;base64,' . base64_encode($faviconSvg) : null,
        ]);
    }

    public function getIconOptionsProperty()
    {
        return SiteSetting::getTailwindIcons();
    }

    public function render()
    {
        return view('livewire.site-settings', [
            'themePresets' => $this->themePresets,
            'customizableColors' => config('themes.customizable_colors', []),
            'iconOptions' => $this->iconOptions,
        ])->layout('layouts.app');
    }
}


