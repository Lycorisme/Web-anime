@props([
    'action' => 'save', // wire:click action or custom function
    'title' => null,
    'message' => null,
    'confirmText' => null,
    'cancelText' => null,
    'type' => 'info',
    'icon' => 'bi-check-circle-fill',
    'label' => null,
    // Styling
    'variant' => 'premium', // premium, primary, danger
    'fullWidth' => false,
    'customClass' => ''
])

@php
    $defaultTitle = __('confirm_save');
    $defaultMessage = __('confirm_save_message');
    $defaultConfirmText = __('save');
    $defaultCancelText = __('cancel');
    $defaultLabel = __('save_changes');

    $finalTitle = $title ?? $defaultTitle;
    $finalMessage = $message ?? $defaultMessage;
    $finalConfirmText = $confirmText ?? $defaultConfirmText;
    $finalCancelText = $cancelText ?? $defaultCancelText;
    $finalLabel = $label ?? $defaultLabel;

    // Style Variants
    $baseClasses = "relative group overflow-hidden rounded-xl px-6 sm:px-8 py-3.5 sm:py-4 font-bold shadow-xl transition-all hover:-translate-y-1 active:translate-y-0 disabled:opacity-50 disabled:cursor-not-allowed";
    
    $variants = [
        'premium' => 'bg-gradient-to-r from-purple-600 to-pink-600 text-white hover:shadow-[0_0_30px_rgba(168,85,247,0.4)]',
        'primary' => 'btn-premium text-white hover:shadow-lg', 
        'danger' => 'bg-gradient-to-r from-red-600 to-orange-600 text-white hover:shadow-[0_0_30px_rgba(239,68,68,0.4)]',
    ];

    $variantClass = $variants[$variant] ?? $variants['premium'];
    $widthClass = $fullWidth ? 'w-full' : 'w-full sm:w-auto';
@endphp

<button 
    @click="$dispatch('swal-confirm-global-confirm', {
        title: '{{ $finalTitle }}',
        message: '{{ $finalMessage }}',
        type: '{{ $type }}',
        confirmText: '{{ $finalConfirmText }}',
        cancelText: '{{ $finalCancelText }}',
        onConfirm: () => { $wire.{{ $action }}(); }
    })"
    {{ $attributes->merge(['class' => "$baseClasses $variantClass $widthClass $customClass"]) }}
>
    <div class="relative z-10 flex items-center justify-center gap-2 sm:gap-3">
        @if($icon)
            <i class="{{ $icon }} text-lg sm:text-xl"></i>
        @endif
        <span class="text-xs sm:text-sm">{{ $finalLabel }}</span>
    </div>
    
    {{-- Generic Shine Effect --}}
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
</button>
