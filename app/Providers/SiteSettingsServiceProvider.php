<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class SiteSettingsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Only run if the table exists (after migration)
        if (Schema::hasTable('site_settings')) {
            View::composer('*', function ($view) {
                $view->with('siteSettings', [
                    'site_name' => SiteSetting::get('site_name', 'PORTAL GG'),
                    'site_logo' => SiteSetting::get('site_logo'),
                    'site_icon' => SiteSetting::get('site_icon', 'bi bi-lightning-charge-fill'),
                    'footer_copyright' => SiteSetting::get('footer_copyright', '© 2026 PORTAL GG. All rights reserved.'),
                ]);
            });
        }
    }
}
