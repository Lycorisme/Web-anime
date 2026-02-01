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
    public string $siteIcon = '';
    public $siteLogo = null;
    public ?string $currentLogo = null;
    public string $footerCopyright = '';
    
    public bool $showSuccess = false;
    public string $successMessage = '';

    public function mount(): void
    {
        $this->siteName = SiteSetting::get('site_name', 'PORTAL GG');
        $this->siteIcon = SiteSetting::get('site_icon', 'bi bi-lightning-charge-fill');
        $this->currentLogo = SiteSetting::get('site_logo');
        $this->footerCopyright = SiteSetting::get('footer_copyright', '© 2026 PORTAL GG. All rights reserved.');
    }

    public function save(): void
    {
        $this->validate([
            'siteName' => 'required|string|max:100',
            'siteIcon' => 'nullable|string|max:100',
            'siteLogo' => 'nullable|image|max:2048', // Max 2MB
            'footerCopyright' => 'required|string|max:255',
        ]);

        // Save site name
        SiteSetting::set('site_name', $this->siteName, [
            'type' => 'text',
            'group' => 'appearance',
            'label' => 'Nama Website',
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
                'label' => 'Logo Website',
            ]);

            $this->currentLogo = $path;
            $this->siteLogo = null;
        }

        // Save footer copyright
        SiteSetting::set('footer_copyright', $this->footerCopyright, [
            'type' => 'text',
            'group' => 'footer',
            'label' => 'Copyright Footer',
        ]);

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
    }

    public function render()
    {
        return view('livewire.site-settings')->layout('layouts.app');
    }
}
