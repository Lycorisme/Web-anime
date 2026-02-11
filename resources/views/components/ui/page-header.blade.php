@props([
    'title',
    'icon' => 'bi-circle-fill',
    'breadcrumbItems' => [], // Array of ['label' => '...', 'url' => '...'] or simplistic logic
    'showClock' => true
])

<div class="mb-4 sm:mb-6 animate-fade-in-up">
    <div class="flex items-center justify-between gap-3">
        {{-- Left Section --}}
        <div class="flex items-center gap-3 sm:gap-4 min-w-0">
            <div class="w-10 h-10 sm:w-12 sm:h-12 btn-premium rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                <i class="{{ $icon }} text-lg sm:text-xl text-white"></i>
            </div>
            <div class="min-w-0">
                <h1 class="text-xl sm:text-2xl font-extrabold truncate">
                    <span class="gradient-text">{{ $title }}</span>
                </h1>
                
                {{-- Breadcrumb --}}
                <nav class="flex items-center gap-2 text-xs sm:text-sm mt-0.5">
                    <a href="/" wire:navigate 
                       class="transition-colors flex items-center"
                       :class="darkMode ? 'text-slate-400 hover:text-blue-400' : 'text-slate-500 hover:text-slate-900'"
                       title="{{ __('dashboard') }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                    </a>
                    
                    {{-- Default Breadcrumb Item (Current Page) --}}
                    @if(empty($breadcrumbItems))
                        <i class="bi bi-chevron-right text-[10px]"
                           :class="darkMode ? 'text-slate-500' : 'text-slate-500'"></i>
                        <span class="font-medium"
                              :class="darkMode ? 'text-slate-300' : 'text-slate-500'">{{ $title }}</span>
                    @else
                        @foreach($breadcrumbItems as $item)
                            <i class="bi bi-chevron-right text-[10px]"
                               :class="darkMode ? 'text-slate-500' : 'text-slate-500'"></i>
                            @if(isset($item['url']))
                                <a href="{{ $item['url'] }}" wire:navigate
                                   class="font-medium transition-colors"
                                   :class="darkMode ? 'text-slate-400 hover:text-blue-400' : 'text-slate-500 hover:text-slate-900'">
                                    {{ $item['label'] }}
                                </a>
                            @else
                                <span class="font-medium"
                                      :class="darkMode ? 'text-slate-300' : 'text-slate-500'">{{ $item['label'] }}</span>
                            @endif
                        @endforeach
                    @endif
                </nav>
            </div>
        </div>
        
        {{-- Right Section (Clock Widget) --}}
        @if($showClock)
            <x-ui.clock-widget />
        @endif
    </div>
</div>
