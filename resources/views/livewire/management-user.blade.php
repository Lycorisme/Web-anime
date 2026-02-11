{{-- Management User Page --}}
<div x-data="{ 
    showModal: false, 
    showViewModal: false,
    viewUser: null,
    init() {
        Livewire.on('open-modal', () => { this.showModal = true });
        Livewire.on('close-modal', () => { this.showModal = false });
        Livewire.on('toast-success', (event) => {
            window.dispatchEvent(new CustomEvent('toast-success', { detail: event[0]?.detail || event.detail }));
        });
    }
}" x-init="init()">
    
    @include('livewire.partials.user-page-header')

    @include('livewire.partials.user-bulk-actions')

    @include('livewire.partials.user-table')

    @include('livewire.partials.user-form-modal')

    @include('livewire.partials.user-view-modal')

</div>
