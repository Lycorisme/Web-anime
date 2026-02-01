<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Dashboard;
use App\Livewire\SiteSettings;

Route::get('/', Dashboard::class);
Route::get('/settings', SiteSettings::class)->name('settings');

