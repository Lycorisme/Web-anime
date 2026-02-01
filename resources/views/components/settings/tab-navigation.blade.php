{{-- Settings Tab Navigation - Modern Pill Style --}}
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
    <div class="p-1 rounded-2xl border"
         :class="darkMode ? 'bg-[#111827]/50 border-white/5' : 'bg-white border-slate-200'">
        
        <div class="flex flex-nowrap gap-1 overflow-x-auto pb-0 scrollbar-hide py-1 px-1">
            @foreach($tabs as $tab)
            <button 
                type="button"
                @click="activeTab = '{{ $tab['id'] }}'"
                class="relative flex items-center gap-2 px-4 py-2.5 rounded-xl font-medium text-sm whitespace-nowrap transition-all duration-300 flex-shrink-0"
                :class="activeTab === '{{ $tab['id'] }}'
                    ? (darkMode ? 'text-white' : 'text-slate-800')
                    : (darkMode ? 'text-slate-400 hover:text-slate-300 hover:bg-[#1f2937]' : 'text-slate-500 hover:text-slate-700 hover:bg-slate-50')">
                
                {{-- Active Background Pill --}}
                <div class="absolute inset-0 rounded-xl shadow-sm transition-all duration-300"
                     :class="darkMode ? 'bg-[#1f2937] border border-white/5' : 'bg-white border border-slate-200'"
                     x-show="activeTab === '{{ $tab['id'] }}'"
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"></div>

                {{-- Active Indicator Dot --}}
                <div class="absolute bottom-1.5 left-1/2 -translate-x-1/2 w-1 h-1 rounded-full bg-teal-500 transition-all duration-300"
                     x-show="activeTab === '{{ $tab['id'] }}'"
                     x-transition:enter="transition ease-out duration-300 delay-100"
                     x-transition:enter-start="opacity-0 scale-0"
                     x-transition:enter-end="opacity-100 scale-100"></div>
                
                <i class="bi {{ $tab['icon'] }} relative z-10 text-lg"
                   :class="activeTab === '{{ $tab['id'] }}' ? 'text-teal-500' : ''"></i>
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
</div>

