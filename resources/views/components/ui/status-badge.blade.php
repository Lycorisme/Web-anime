@props(['status', 'showDot' => true, 'useTranslation' => false])

@php
    $key = strtolower($status ?? 'pending');
    
    if ($useTranslation) {
        $display = __('status_' . $key);
    } else {
        $display = $status;
    }

    // Re-implement logic from previous component but cleaner
    $colorClass = match($key) {
        'active', 'verified', 'completed', 'success' => 'bg-green-500/10 text-green-500', 
        'inactive', 'banned', 'rejected', 'danger'   => 'bg-red-500/10 text-red-500',
        'pending', 'warning'                         => 'bg-yellow-500/10 text-yellow-500',
        'admin', 'administrator'                     => 'bg-purple-500/10 text-purple-500',
        'editor'                                     => 'bg-blue-500/10 text-blue-500',
        'viewer'                                     => 'bg-slate-500/10 text-slate-500',
        default                                      => 'bg-slate-500/10 text-slate-500'
    };

    $dotColor = match($key) {
        'active', 'verified', 'completed', 'success' => 'bg-green-500 animate-pulse',
        'inactive', 'banned', 'rejected', 'danger'   => 'bg-red-500',
        'pending', 'warning'                         => 'bg-yellow-500',
        default                                      => 'bg-slate-500'
    };
@endphp

<span class="px-2.5 sm:px-3 py-1 rounded-full text-[9px] sm:text-[10px] font-bold uppercase flex items-center gap-1.5 w-fit {{ $colorClass }}">
    @if($showDot)
        <span class="w-1.5 h-1.5 rounded-full {{ $dotColor }}"></span>
    @endif
    <span>{{ $display }}</span>
</span>
