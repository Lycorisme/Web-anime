{{-- Success Alert Component --}}
@props(['show' => false, 'message' => ''])

@if($show)
<div 
    x-data="{ show: true }"
    x-init="setTimeout(() => { show = false; $wire.set('showSuccess', false); }, 3000)"
    x-show="show"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-[-10px]"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    class="mb-6"
>
    <div class="p-4 rounded-xl bg-emerald-500/20 border border-emerald-500/30 text-emerald-400 flex items-center gap-3">
        <i class="bi bi-check-circle-fill text-xl"></i>
        <span>{{ $message }}</span>
    </div>
</div>
@endif
