{{-- AI Provider Manager - Livewire Component View --}}
<div x-data="{ showModal: @entangle('showModal'), showTestModal: @entangle('showTestModal') }">
    <x-settings.ai-form
        :providers="$providers"
        :availableProviders="$availableProviders"
        :showModal="$showModal"
        :editingId="$editingId"
        :testingId="$testingId"
        :aiProvider="$aiProvider"
        :testResult="$testResult"
    />

    {{-- Test Connection Modal --}}
    @include('livewire.partials.ai-test-connection-modal')
</div>
