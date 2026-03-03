<?php

use App\Livewire\AnimeList;
use App\Livewire\Dashboard;
use App\Livewire\ManagementUser;
use App\Livewire\SiteSettings;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', Dashboard::class)->name('dashboard');
Route::get('/management-user', ManagementUser::class)->name('management-user');
Route::get('/anime-list', AnimeList::class)->name('anime-list');
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
