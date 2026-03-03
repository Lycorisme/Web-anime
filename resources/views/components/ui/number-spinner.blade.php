@props([
    'model',
    'min' => null,
    'max' => null,
    'step' => 1,
    'placeholder' => null,
])

<div x-data="{
    value: @entangle($model),
    min: {{ $min !== null ? $min : 'null' }},
    max: {{ $max !== null ? $max : 'null' }},
    step: {{ $step }},
    focused: false,
    increment() {
        let current = parseFloat(this.value);
        if (isNaN(current)) current = 0;
        let next = current + this.step;
        if (this.max !== null && next > this.max) return;
        this.value = parseFloat(next.toFixed(10));
    },
    decrement() {
        let current = parseFloat(this.value);
        if (isNaN(current)) current = 0;
        let prev = current - this.step;
        if (this.min !== null && prev < this.min) return;
        this.value = parseFloat(prev.toFixed(10));
    }
}" class="relative flex items-center w-full">
    
    {{-- Background and Border --}}
    <div class="absolute inset-0 rounded-xl transition-colors" 
         :class="darkMode ? 'bg-white/5 border border-white/10 hover:bg-white/10' : 'bg-slate-50 border border-slate-200 hover:bg-slate-100'"
         :style="focused ? 'border-color: var(--gradient-start); box-shadow: 0 0 0 2px color-mix(in srgb, var(--gradient-start) 50%, transparent);' : ''"></div>
         
    {{-- Minus Button --}}
    <button type="button" @click="decrement()"
            class="absolute left-1 w-8 h-8 flex items-center justify-center rounded-lg transition-colors z-20 focus:outline-none"
            :class="darkMode ? 'text-slate-400 hover:bg-white/10 hover:text-white' : 'text-slate-500 hover:bg-slate-200 hover:text-slate-800'">
        <i class="bi bi-dash font-bold text-lg"></i>
    </button>
    
    {{-- Input Field --}}
    <input type="number" 
           step="{{ $step }}"
           @if($min !== null) min="{{ $min }}" @endif
           @if($max !== null) max="{{ $max }}" @endif
           x-model="value"
           placeholder="{{ $placeholder }}"
           @focus="focused = true"
           @blur="focused = false"
           class="w-full px-10 py-3 rounded-xl border-transparent appearance-none focus:outline-none focus:border-transparent focus:ring-0 transition-all text-sm font-medium text-center relative z-10 bg-transparent [appearance:textfield] [&::-webkit-outer-spin-button]:appearance-none [&::-webkit-inner-spin-button]:appearance-none"
           :class="[darkMode ? 'text-white' : 'text-slate-700']"
           onwheel="return false;">
           
    {{-- Plus Button --}}
    <button type="button" @click="increment()"
            class="absolute right-1 w-8 h-8 flex items-center justify-center rounded-lg transition-colors z-20 focus:outline-none"
            :class="darkMode ? 'text-slate-400 hover:bg-white/10 hover:text-white' : 'text-slate-500 hover:bg-slate-200 hover:text-slate-800'">
        <i class="bi bi-plus font-bold text-lg"></i>
    </button>
</div>
