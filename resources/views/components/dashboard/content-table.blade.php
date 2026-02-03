{{-- Content Table Component --}}
@php
$tableItems = [
    ['title' => 'Laporan Penjualan Q1', 'updated' => '2 jam yang lalu', 'status' => 'Verified', 'progress' => 75],
    ['title' => 'Inventaris Bulanan', 'updated' => '5 jam yang lalu', 'status' => 'Pending', 'progress' => 45],
    ['title' => 'Analisis Pasar', 'updated' => '1 hari yang lalu', 'status' => 'Completed', 'progress' => 100],
];
@endphp

<div class="glass-card rounded-3xl overflow-hidden animate-fade-in-up shadow-2xl">
    <!-- Table Header -->
    <div class="bg-white/5 px-6 py-4 border-b border-white/5 flex items-center justify-between">
        <div class="flex items-center gap-4">
            <!-- Window Controls -->
            <div class="flex gap-1.5">
                <div class="w-3 h-3 rounded-full bg-red-500/80"></div>
                <div class="w-3 h-3 rounded-full bg-yellow-500/80"></div>
                <div class="w-3 h-3 rounded-full bg-green-500/80"></div>
            </div>
            <span class="text-xs font-bold text-slate-400 uppercase tracking-widest ml-2">
                Manajemen Konten Utama
            </span>
        </div>
    </div>

    <!-- Table Content -->
    <div class="p-6 overflow-x-auto">
        <table class="w-full text-left border-separate border-spacing-y-4">
            <thead class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">
                <tr>
                    <th class="px-6">Informasi Item</th>
                    <th class="px-6">Status</th>
                    <th class="px-6">Progress</th>
                    <th class="px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items ?? $tableItems as $item)
                <tr class="glass-card hover:bg-white/5 transition-all group cursor-pointer">
                    <td class="p-4 rounded-l-2xl">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 btn-premium rounded-xl flex items-center justify-center text-white shadow-lg">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <div>
                                <p class="font-extrabold text-sm group-hover:text-blue-400 transition-colors">
                                    {{ $item['title'] }}
                                </p>
                                <p class="text-[11px] text-slate-500 mt-1">
                                    Update: {{ $item['updated'] }}
                                </p>
                            </div>
                        </div>
                    </td>
                    <td class="p-4">
                        @php
                        $statusColor = match($item['status']) {
                            'Verified' => 'bg-blue-500/10 text-blue-500',
                            'Pending' => 'bg-yellow-500/10 text-yellow-500',
                            'Completed' => 'bg-green-500/10 text-green-500',
                            default => 'bg-slate-500/10 text-slate-500'
                        };
                        @endphp
                        <span class="px-3 py-1 {{ $statusColor }} rounded-full text-[10px] font-bold uppercase">
                            {{ $item['status'] }}
                        </span>
                    </td>
                    <td class="p-4">
                        <div class="w-40">
                            <div class="flex justify-between text-[10px] font-bold mb-1.5 text-slate-400">
                                <span>Progress Kerja</span>
                                <span class="gradient-text">{{ $item['progress'] }}%</span>
                            </div>
                            <div class="w-full h-1.5 bg-slate-800 rounded-full overflow-hidden">
                                <div class="h-full btn-premium" style="width: {{ $item['progress'] }}%"></div>
                            </div>
                        </div>
                    </td>
                    <td class="p-4 rounded-r-2xl text-center">
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
