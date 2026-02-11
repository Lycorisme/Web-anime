@props([
    'model' => null, // wire:model
    'modelLive' => null, // wire:model.live
    'type' => 'text',
    'label' => null,
    'placeholder' => null,
    'icon' => null,
    'error' => null, // Error key for validation
    'hint' => null,
])

@php
    $wireModel = $modelLive ? "wire:model.live=\"$modelLive\"" : ($model ? "wire:model=\"$model\"" : '');
@endphp

<div class="space-y-2 sm:space-y-3">
    @if($label)
        <label class="flex items-center gap-2 text-xs sm:text-sm font-bold text-slate-400">
            @if($icon)
                <i class="{{ $icon }} text-blue-400"></i>
            @endif
            {{ $label }}
        </label>
    @endif

    <div class="relative group">
        <input 
            type="{{ $type }}" 
            {!! $wireModel !!}
            {{ $attributes->merge(['class' => 'w-full px-4 sm:px-5 py-3 sm:py-4 rounded-lg sm:rounded-xl bg-white/5 border-2 border-white/10 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all outline-none text-sm sm:text-base font-medium placeholder:text-slate-500']) }}
            placeholder="{{ $placeholder }}"
        >
    </div>

    @if($error)
        @error($error) <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
    @endif
    
    @if($hint)
        <p class="text-[10px] text-slate-500">{{ $hint }}</p>
    @endif
</div>
