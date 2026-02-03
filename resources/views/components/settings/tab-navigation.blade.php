{{-- Tab Navigation --}}
@props(['activeTab' => 'general'])

<div class="glass-card rounded-2xl p-2 mb-8 animate-fade-in-up delay-100">
    <div class="flex flex-wrap gap-2">
        @php
        $tabs = [
            ['id' => 'general', 'label' => 'Umum', 'icon' => 'bi-gear'],
            ['id' => 'appearance', 'label' => 'Tampilan', 'icon' => 'bi-palette'],
            ['id' => 'theme', 'label' => 'Tema', 'icon' => 'bi-brush'],
        ];
        @endphp
        
        @foreach($tabs as $tab)
        <button 
            wire:click="setTab('{{ $tab['id'] }}')"
            class="flex items-center gap-2 px-5 py-3 rounded-xl font-medium text-sm transition-all duration-300 {{ $activeTab === $tab['id'] ? 'btn-premium text-white' : 'text-slate-500 hover:text-slate-700 dark:hover:text-white hover:bg-white/10' }}"
        >
            <i class="bi {{ $tab['icon'] }}"></i>
            {{ $tab['label'] }}
        </button>
        @endforeach
    </div>
</div>
