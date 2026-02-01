{{-- Success Alert - Premium Dark Style --}}
@props(['show' => false, 'message' => ''])

<div x-data="{ show: @entangle('showSuccess') }"
     x-show="show"
     x-transition:enter="transition ease-out duration-300"
     x-transition:enter-start="opacity-0 translate-y-2"
     x-transition:enter-end="opacity-100 translate-y-0"
     x-transition:leave="transition ease-in duration-200"
     x-transition:leave-start="opacity-100 translate-y-0"
     x-transition:leave-end="opacity-0 -translate-y-2"
     x-init="$watch('show', value => { if(value) setTimeout(() => show = false, 4000) })"
     class="mb-6 p-4 rounded-xl bg-gradient-to-r from-emerald-500/20 to-teal-500/20 border border-emerald-500/30 flex items-center gap-3">
    
    <div class="w-10 h-10 rounded-full bg-emerald-500/20 flex items-center justify-center flex-shrink-0">
        <i class="bi bi-check-circle-fill text-emerald-400 text-lg"></i>
    </div>
    
    <div class="flex-1">
        <p class="text-emerald-300 font-semibold">{{ $message ?: 'Berhasil!' }}</p>
    </div>
    
    <button @click="show = false" class="text-emerald-400 hover:text-emerald-300 transition-colors p-1">
        <i class="bi bi-x-lg"></i>
    </button>
</div>
