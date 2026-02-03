{{-- Site Settings Page --}}
<div>
    {{-- Page Header --}}
    <x-settings.page-header />

    {{-- Tab Navigation --}}
    <x-settings.tab-navigation :activeTab="$activeTab" />

    {{-- Tab Content --}}
    @if($activeTab === 'general')
        <x-settings.general-form />
    @elseif($activeTab === 'appearance')
        <x-settings.appearance-form />
    @elseif($activeTab === 'theme')
        <x-settings.theme-form />
    @endif
</div>
