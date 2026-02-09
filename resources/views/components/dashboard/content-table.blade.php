{{-- Content Table Component --}}
@php
$tableItems = [
    ['title' => 'Laporan Penjualan Q1', 'updated_hours' => 2, 'updated_type' => 'hours', 'status' => 'verified', 'progress' => 75],
    ['title' => 'Inventaris Bulanan', 'updated_hours' => 5, 'updated_type' => 'hours', 'status' => 'pending', 'progress' => 45],
    ['title' => 'Analisis Pasar', 'updated_hours' => 1, 'updated_type' => 'days', 'status' => 'completed', 'progress' => 100],
];
@endphp

<div class="glass-card rounded-2xl sm:rounded-3xl overflow-hidden animate-fade-in-up shadow-2xl">
    <!-- Table Header -->
    <div class="bg-white/5 px-4 sm:px-6 py-3 sm:py-4 border-b border-white/5 flex items-center justify-between">
        <div class="flex items-center gap-3 sm:gap-4">
            <!-- Window Controls -->
            <div class="flex gap-1.5">
                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500/80"></div>
                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500/80"></div>
                <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500/80"></div>
            </div>
            <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest ml-1 sm:ml-2">
                {{ __('main_content_management') }}
            </span>
        </div>
    </div>

    <!-- Table Content -->
    <div class="p-0 sm:p-6 overflow-x-auto">
        <table class="w-full text-left border-separate border-spacing-y-0 sm:border-spacing-y-4">
            <thead class="text-slate-500 text-[10px] font-bold uppercase tracking-widest hidden sm:table-header-group">
                <tr>
                    <th class="px-6">{{ __('item_info') }}</th>
                    <th class="px-6">{{ __('status') }}</th>
                    <th class="px-6">{{ __('progress') }}</th>
                    <th class="px-6 text-center">{{ __('action') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5 sm:divide-y-0">
                @foreach($items ?? $tableItems as $item)
                @php
                    // Determine time ago text
                    $timeAmount = $item['updated_hours'] ?? 2;
                    $timeType = $item['updated_type'] ?? 'hours';
                    if ($timeType === 'hours') {
                        $timeAgo = $timeAmount . ' ' . __('hours_ago');
                    } elseif ($timeType === 'days') {
                        $timeAgo = $timeAmount . ' ' . __('days_ago');
                    } else {
                        $timeAgo = $timeAmount . ' ' . __('minutes_ago');
                    }
                    
                    // Determine status display
                    $statusKey = strtolower($item['status'] ?? 'pending');
                    $statusDisplay = __('status_' . $statusKey);
                @endphp
                <tr class="glass-card sm:hover:bg-white/5 transition-all group cursor-pointer flex flex-col sm:table-row p-4 sm:p-0">
                    <td class="p-3 sm:p-4 rounded-l-none sm:rounded-l-2xl border-none">
                        <div class="flex items-center gap-3 sm:gap-4">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 btn-premium rounded-xl flex items-center justify-center text-white shadow-lg flex-shrink-0">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div>
                                <p class="font-extrabold text-xs sm:text-sm group-hover:text-blue-400 transition-colors">
                                    {{ $item['title'] }}
                                </p>
                                <p class="text-[10px] sm:text-[11px] text-slate-500 mt-0.5 sm:mt-1">
                                    {{ __('update') }}: {{ $timeAgo }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 pb-3 sm:p-4 border-none flex items-center justify-between sm:table-cell">
                        <span class="sm:hidden text-xs text-slate-400 font-bold">{{ __('status') }}</span>
                        @php
                        $statusColor = match($statusKey) {
                            'verified' => 'bg-blue-500/10 text-blue-500',
                            'pending' => 'bg-yellow-500/10 text-yellow-500',
                            'completed' => 'bg-green-500/10 text-green-500',
                            default => 'bg-slate-500/10 text-slate-500'
                        };
                        @endphp
                        <span class="px-2.5 sm:px-3 py-1 {{ $statusColor }} rounded-full text-[9px] sm:text-[10px] font-bold uppercase">
                            {{ $statusDisplay }}
                        </span>
                    </td>
                    <td class="px-3 pb-3 sm:p-4 border-none sm:table-cell">
                        <div class="w-full sm:w-40">
                            <div class="flex justify-between text-[10px] font-bold mb-1.5 text-slate-400">
                                <span class="sm:hidden">{{ __('progress') }}</span>
                                <span class="hidden sm:inline">{{ __('work_progress') }}</span>
                                <span class="gradient-text">{{ $item['progress'] }}%</span>
                            </div>
                            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full btn-premium" style="width: {{ $item['progress'] }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="px-3 pb-3 sm:p-4 rounded-r-none sm:rounded-r-2xl text-center border-none hidden sm:table-cell">
                        <button class="p-2 hover:bg-white/10 rounded-lg text-slate-400 transition-all">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
