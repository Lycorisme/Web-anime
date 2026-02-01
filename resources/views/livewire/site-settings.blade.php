<div>
    {{-- Page Content --}}
    <div class="max-w-6xl mx-auto">
        
        {{-- Page Header with Clock --}}
        <div x-show="true"
                x-transition:enter="transition ease-out duration-500 delay-100"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">
            <x-settings.page-header />
        </div>

        {{-- Tab Navigation --}}
        <div x-show="true"
                x-transition:enter="transition ease-out duration-500 delay-150"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">
            <x-settings.tab-navigation activeTab="umum" />
        </div>

        {{-- Success Message --}}
        <x-settings.success-alert :show="$showSuccess" :message="$successMessage" />

        {{-- Settings Form --}}
        <form wire:submit="save" class="space-y-6">
            
            {{-- General Settings Section (Pengaturan Umum) --}}
            <div x-show="true"
                    x-transition:enter="transition ease-out duration-500 delay-200"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0">
                <x-settings.general-form 
                    :siteName="$siteName"
                    :siteTagline="$siteTagline ?? ''"
                    :siteDescription="$siteDescription ?? ''" />
            </div>

            {{-- Form Actions --}}
            <div x-show="true"
                    x-transition:enter="transition ease-out duration-500 delay-300"
                    x-transition:enter-start="opacity-0 translate-y-4"
                    x-transition:enter-end="opacity-100 translate-y-0">
                <x-settings.form-actions />
            </div>
        </form>
    </div>

    {{-- Footer --}}
    <x-settings.footer />
</div>
