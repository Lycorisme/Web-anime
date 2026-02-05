{{-- Site Settings Page - Sidebar Layout --}}
<div>
    {{-- Page Header --}}
    <x-settings.page-header />

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
            <div class="animate-fade-in-up delay-200">
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
                @endif
            </div>
        </div>
    </div>
</div>
