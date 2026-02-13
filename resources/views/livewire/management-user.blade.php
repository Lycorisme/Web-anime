{{-- Management User Page --}}
<div x-data="{ 
    showModal: false, 
    showViewModal: false,
    viewUser: null,
    init() {
        Livewire.on('open-modal', () => { this.showModal = true });
        Livewire.on('close-modal', () => { this.showModal = false });
    }
}" x-init="init()">
    
    <x-ui.page-header :title="__('management_user')" icon="bi-people-fill" />

    @include('livewire.partials.user-bulk-actions')

    @include('livewire.partials.user-table')

    @include('livewire.partials.user-form-modal')

    @include('livewire.partials.user-view-modal')

</div>
