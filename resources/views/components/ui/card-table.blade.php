@props(['title' => 'Table'])

<div class="rounded-2xl sm:rounded-3xl overflow-hidden animate-fade-in-up shadow-2xl"
     :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30 shadow-xl shadow-slate-200/20'">
    
    {{-- Table Header Bar --}}
    <div class="pl-4 sm:pl-6 border-b flex items-stretch justify-between bg-white/5 h-14 sm:h-16"
         :class="darkMode ? 'border-white/5' : 'border-white/20'">
        <div class="flex items-center gap-2 sm:gap-3">
            {{-- Window Controls --}}
            <div class="flex gap-1.5 flex-shrink-0">
                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500/80"></div>
                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500/80"></div>
                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500/80"></div>
            </div>
            
            <div class="h-full flex items-center pl-2">
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest">
                    {{ $title }}
                </span>
            </div>
        </div>

        {{-- Actions & Filter --}}
        <div class="flex items-center gap-1 sm:gap-2 pr-4 sm:pr-6">
            {{ $actions ?? '' }}
        </div>
    </div>

    {{-- Table Content --}}
    <div class="p-0 sm:p-6 overflow-x-auto">
        {{ $slot }}
    </div>

    {{-- Table Footer --}}
    @if(isset($footer))
    <div class="px-4 sm:px-6 py-3 sm:py-4 border-t flex items-center justify-between bg-white/5"
         :class="darkMode ? 'border-white/5' : 'border-white/20'">
        <div class="w-full">
            {{ $footer }}
        </div>
    </div>
    @endif
</div>
