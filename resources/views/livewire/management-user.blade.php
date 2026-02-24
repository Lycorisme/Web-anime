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

    @include('livewire.partials.user-bulk-action-delete')
    @include('livewire.partials.user-bulk-action-force-delete')

    @include('livewire.partials.user-table')

    @include('livewire.partials.user-form-modal')

    @include('livewire.partials.user-view-modal')

    @include('livewire.partials.image-editor-modal')

</div>
