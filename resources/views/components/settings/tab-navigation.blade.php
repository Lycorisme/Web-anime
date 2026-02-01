{{-- Settings Tab Navigation - Premium Style --}}
@props(['activeTab' => 'umum'])

@php
$tabs = [
    ['id' => 'umum', 'icon' => 'bi-house-door', 'label' => 'Umum'],
    ['id' => 'kontak', 'icon' => 'bi-telephone', 'label' => 'Kontak'],
    ['id' => 'seo', 'icon' => 'bi-search', 'label' => 'SEO'],
    ['id' => 'tampilan', 'icon' => 'bi-palette', 'label' => 'Tampilan'],
    ['id' => 'kop-surat', 'icon' => 'bi-envelope-paper', 'label' => 'Kop Surat'],
    ['id' => 'mandatum', 'icon' => 'bi-award', 'label' => 'Mandatum'],
    ['id' => 'keamanan', 'icon' => 'bi-shield-check', 'label' => 'Keamanan'],
    ['id' => 'email', 'icon' => 'bi-envelope', 'label' => 'Email'],
];
@endphp

<div class="mb-8" x-data="{ activeTab: '{{ $activeTab }}' }">
    {{-- Tab Container with horizontal scroll on mobile --}}
    <div class="flex flex-nowrap gap-2 overflow-x-auto pb-2 scrollbar-hide">
        @foreach($tabs as $tab)
        <button 
            type="button"
            @click="activeTab = '{{ $tab['id'] }}'"
            class="flex items-center gap-2 px-5 py-3 rounded-xl font-semibold text-sm whitespace-nowrap transition-all duration-300 relative overflow-hidden group"
            :class="activeTab === '{{ $tab['id'] }}'
                ? 'bg-gradient-to-r from-teal-500 to-cyan-500 text-white shadow-lg shadow-teal-500/30'
                : 'bg-[#111827] border border-white/5 text-slate-400 hover:text-white hover:border-teal-500/30 hover:bg-[#1a2332]'">
            
            {{-- Hover glow effect --}}
            <div class="absolute inset-0 bg-gradient-to-r from-teal-500/10 to-cyan-500/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"
                 x-show="activeTab !== '{{ $tab['id'] }}'"></div>
            
            <i class="bi {{ $tab['icon'] }} relative z-10"></i>
            <span class="relative z-10">{{ $tab['label'] }}</span>
        </button>
        @endforeach
    </div>
</div>

<style>
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
