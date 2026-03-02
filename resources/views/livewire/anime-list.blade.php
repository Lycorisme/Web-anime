{{-- Anime List Page --}}
<div x-data="{ 
    showModal: false, 
    showViewModal: false,
    viewAnime: null,
    init() {
        Livewire.on('open-anime-modal', () => { this.showModal = true });
        Livewire.on('close-anime-modal', () => { this.showModal = false });
    }
}" x-init="init()">
    
    <x-ui.page-header :title="__('anime_list')" icon="bi-film" />

    @include('livewire.partials.anime-table')

    @include('livewire.partials.anime-form-modal')

    @include('livewire.partials.anime-view-modal')

</div>
