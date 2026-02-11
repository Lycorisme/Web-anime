{{-- Site Settings Page - Sidebar Layout --}}
<div>
    {{-- Page Header --}}
    <x-ui.page-header :title="__('settings')" icon="bi-gear-fill" />

    {{-- Main Content with Sidebar --}}
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        {{-- Left Sidebar - Tab Navigation --}}
        <div class="lg:col-span-3">
            <div class="lg:sticky lg:top-6">
                <x-settings.tab-navigation :activeTab="$activeTab" />
            </div>
        </div>
        
        {{-- Right Content Area --}}
        <div class="lg:col-span-9">
            <div wire:key="tab-content-{{ $activeTab }}" class="animate-fade-in-up">
                @if($activeTab === 'general')
                    <x-settings.general-form :siteName="$siteName" :footerCopyright="$footerCopyright" />
                @elseif($activeTab === 'appearance')
                    <x-settings.appearance-form 
                        :currentLogo="$currentLogo" 
                        :currentFavicon="$currentFavicon"
                        :selectedLogoIcon="$selectedLogoIcon"
                        :selectedFaviconIcon="$selectedFaviconIcon"
                        :iconOptions="$iconOptions"
                        :siteLogo="$siteLogo"
                        :siteFavicon="$siteFavicon"
                    />
                @elseif($activeTab === 'theme')
                    <x-settings.theme-form :themePresets="$themePresets" :activeTheme="$activeTheme" />
                @elseif($activeTab === 'effects')
                    <x-settings.effects-form 
                        :cursorStyle="$cursorStyle" 
                        :clickAnimation="$clickAnimation"
                        :cursorEnabled="$cursorEnabled"
                        :clickEnabled="$clickEnabled"
                    />
                @elseif($activeTab === 'language')
                    <x-settings.language-form 
                        :currentLocale="$currentLocale"
                        :availableLanguages="$availableLanguages"
                    />
                @endif
            </div>
        </div>
    </div>
</div>
