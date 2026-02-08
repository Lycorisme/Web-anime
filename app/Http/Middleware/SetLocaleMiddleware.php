<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use App\Models\SiteSetting;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Priority: Session > Database Setting > Config Default
        $locale = $this->getLocale();
        
        // Validate the locale is supported
        $supportedLocales = array_keys(config('languages.supported', ['en' => []]));
        
        if (!in_array($locale, $supportedLocales)) {
            $locale = config('languages.default', 'en');
        }
        
        // Set the application locale
        App::setLocale($locale);
        
        // Store in session for persistence
        Session::put('locale', $locale);
        
        return $next($request);
    }

    /**
     * Get the locale to use
     */
    protected function getLocale(): string
    {
        // 1. Check session first (user preference)
        if (Session::has('locale')) {
            return Session::get('locale');
        }

        // 2. Check database setting
        try {
            $dbLocale = SiteSetting::get('site_locale');
            if ($dbLocale) {
                return $dbLocale;
            }
        } catch (\Exception $e) {
            // Database might not be available yet
        }

        // 3. Fall back to config default
        return config('languages.default', 'en');
    }
}
