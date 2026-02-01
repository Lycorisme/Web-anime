{{-- Site Settings Page with Sidebar, Header, Footer --}}
<div class="flex w-full">
    {{-- Sidebar --}}
    <x-dashboard.sidebar />

    {{-- Main Content --}}
    <main :class="sidebarOpen ? 'lg:ml-72' : 'lg:ml-0'" 
          class="flex-1 w-full p-4 lg:p-8 transition-all duration-300 ease-out">
        
        {{-- Header --}}
        <div x-show="true"
             class="sticky top-0 z-40 -mx-4 -mt-4 lg:-mx-8 lg:-mt-8"
             x-transition:enter="transition ease-out duration-500"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0">
            <x-dashboard.header />
        </div>

        {{-- Page Content --}}
        <div class="max-w-4xl mx-auto">
            
            {{-- Page Header --}}
            <div class="mb-8"
                 x-show="true"
                 x-transition:enter="transition ease-out duration-500 delay-100"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0">
                <x-settings.page-header />
            </div>

            {{-- Success Message --}}
            <x-settings.success-alert :show="$showSuccess" :message="$successMessage" />

            {{-- Settings Form --}}
            <form wire:submit="save" class="space-y-6">
                
                {{-- Appearance Section --}}
                <div x-show="true"
                     x-transition:enter="transition ease-out duration-500 delay-200"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <x-settings.appearance-form 
                        :siteName="$siteName" 
                        :siteIcon="$siteIcon"
                        :siteLogo="$siteLogo"
                        :currentLogo="$currentLogo" />
                </div>

                {{-- Footer Section --}}
                <div x-show="true"
                     x-transition:enter="transition ease-out duration-500 delay-300"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <x-settings.footer-form :footerCopyright="$footerCopyright" />
                </div>

                {{-- Form Actions --}}
                <div x-show="true"
                     x-transition:enter="transition ease-out duration-500 delay-400"
                     x-transition:enter-start="opacity-0 translate-y-4"
                     x-transition:enter-end="opacity-100 translate-y-0">
                    <x-settings.form-actions />
                </div>
            </form>
        </div>

        {{-- Footer --}}
        <x-settings.footer />
    </main>
</div>
