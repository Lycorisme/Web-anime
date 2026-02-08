<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Livewire\Dashboard;
use App\Livewire\SiteSettings;
use App\Models\SiteSetting;

Route::get('/', Dashboard::class);
Route::get('/settings', SiteSettings::class)->name('settings');

// Language Switch Route
Route::post('/language/switch', function (Request $request) {
    $locale = $request->input('locale', 'en');
    $supportedLocales = array_keys(config('languages.supported', []));
    
    if (in_array($locale, $supportedLocales)) {
        session()->put('locale', $locale);
        
        // Also save to database
        SiteSetting::set('site_locale', $locale, [
            'type' => 'text',
            'group' => 'language',
            'label' => 'Site Locale',
        ]);
        SiteSetting::clearCache();
    }
    
    return redirect()->back();
})->name('language.switch');
