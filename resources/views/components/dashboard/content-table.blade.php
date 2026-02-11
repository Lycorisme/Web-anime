{{-- Content Table Component --}}
@php
$tableItems = [
    ['title' => __('sales_report_q1'), 'updated_hours' => 2, 'updated_type' => 'hours', 'status' => 'verified', 'progress' => 75],
    ['title' => __('monthly_inventory'), 'updated_hours' => 5, 'updated_type' => 'hours', 'status' => 'pending', 'progress' => 45],
    ['title' => __('market_analysis'), 'updated_hours' => 1, 'updated_type' => 'days', 'status' => 'completed', 'progress' => 100],
];
@endphp

<x-ui.card-table :title="__('main_content_management')">
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
            @endphp
            <tr class="sm:hover:bg-white/5 transition-all group cursor-pointer flex flex-col sm:table-row p-4 sm:p-0"
                :class="darkMode ? 'glass-card' : ''">
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
                    <x-ui.status-badge :status="$item['status']" useTranslation="true" />
                </td>
                <td class="px-3 pb-3 sm:p-4 border-none sm:table-cell">
                    <div class="w-full sm:w-40">
                        <div class="flex justify-between text-[10px] font-bold mb-1.5 text-slate-400">
                            <span class="sm:hidden">{{ __('progress') }}</span>
                            <span class="hidden sm:inline">{{ __('work_progress') }}</span>
                            <span class="gradient-text">{{ $item['progress'] }}%</span>
                        </div>
                        <div class="w-full h-1.5 rounded-full overflow-hidden"
                                :class="darkMode ? 'bg-slate-800/60' : 'bg-slate-300/40'">
                            <div class="h-full btn-premium" style="width: {{ $item['progress'] }}%"></div>
                        </div>
                    </div>
                </td>
                <td class="px-3 pb-3 sm:p-4 rounded-r-none sm:rounded-r-2xl text-center border-none hidden sm:table-cell">
                    <button class="btn-icon p-2 w-9 h-9 rounded-lg">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-ui.card-table>

