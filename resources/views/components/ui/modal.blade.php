@props([
    'show' => 'showModal',
    'maxWidth' => 'lg', 
    'onClose' => null,
    'title' => null,
    'icon' => null
])

@php
$maxWidthClasses = [
    'sm' => 'max-w-sm',
    'md' => 'max-w-md',
    'lg' => 'max-w-lg',
    'xl' => 'max-w-xl',
    '2xl' => 'max-w-2xl',
][$maxWidth];
@endphp

<div x-show="{{ $show }}" 
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0"
     x-transition:enter-end="opacity-100"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100"
     x-transition:leave-end="opacity-0"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4"         
     style="display: none;">
     
    {{-- Backdrop --}}
    <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" 
         @if($onClose) wire:click="{{ $onClose }}" @else @click="{{ $show }} = false" @endif>
    </div>
    
    {{-- Modal Content --}}
    <div x-show="{{ $show }}"
         x-transition:enter="transition ease-out duration-300 delay-100"
         x-transition:enter-start="opacity-0 scale-90 translate-y-8"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-90"
         class="relative w-full {{ $maxWidthClasses }} rounded-3xl shadow-2xl overflow-hidden z-10 border"
         :class="darkMode ? 'bg-slate-900/95 backdrop-blur-xl border-white/10' : 'bg-white/95 backdrop-blur-xl border-slate-200'">
         
         {{-- Optional Header --}}
         @if($title || isset($header))
            <div class="px-6 py-5 border-b flex items-center justify-between"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                @if(isset($header))
                    {{ $header }}
                @else
                    <div class="flex items-center gap-3">
                        @if($icon)
                            <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center text-white">
                                <i class="{{ $icon }}"></i>
                            </div>
                        @endif
                        <h3 class="text-lg font-extrabold">
                            {{ $title }}
                        </h3>
                    </div>
                    <button @if($onClose) wire:click="{{ $onClose }}" @else @click="{{ $show }} = false" @endif
                            class="btn-icon w-8 h-8 rounded-lg">
                        <i class="bi bi-x-lg"></i>
                    </button>
                @endif
            </div>
         @endif

         {{-- Body --}}
         <div class="px-6 py-5 space-y-4 max-h-[60vh] overflow-y-auto custom-scrollbar">
             {{ $slot }}
         </div>

         {{-- Footer --}}
         @if(isset($footer))
             <div class="px-6 py-4 border-t flex items-center justify-end gap-3"
                  :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                 {{ $footer }}
             </div>
         @endif
    </div>
</div>
