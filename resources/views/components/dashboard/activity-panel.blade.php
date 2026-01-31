{{-- Recent Activity Panel --}}
<div class="glass-panel rounded-[2rem] lg:rounded-[2.5rem] p-6 lg:p-8 animate__animated animate__fadeInRight">
    {{-- Header --}}
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg lg:text-xl font-bold text-white flex items-center gap-2">
            <i class="bi bi-activity text-purple-400"></i>
            Recent Activity
        </h3>
        <button class="text-xs text-indigo-400 hover:text-indigo-300 font-semibold transition-colors">
            View All
        </button>
    </div>
    
    {{-- Activity List --}}
    <div class="space-y-4 lg:space-y-5" x-data="{ 
        activities: [
            { 
                title: 'Started watching Frieren',
                subtitle: 'Episode 1 of 28',
                time: '2 mins ago',
                icon: 'bi-play-circle-fill',
                color: 'emerald',
                dotColor: 'bg-emerald-500'
            },
            { 
                title: 'Completed Solo Leveling',
                subtitle: 'All 12 episodes',
                time: '1 hour ago',
                icon: 'bi-check-circle-fill',
                color: 'blue',
                dotColor: 'bg-blue-500'
            },
            { 
                title: 'Added to Watchlist',
                subtitle: 'Demon Slayer S4',
                time: '3 hours ago',
                icon: 'bi-bookmark-plus-fill',
                color: 'purple',
                dotColor: 'bg-purple-500'
            },
            { 
                title: 'Gave 5★ Rating',
                subtitle: 'Attack on Titan',
                time: '5 hours ago',
                icon: 'bi-star-fill',
                color: 'amber',
                dotColor: 'bg-amber-500'
            },
            { 
                title: 'Joined Discussion',
                subtitle: 'One Piece Episode 1100',
                time: '8 hours ago',
                icon: 'bi-chat-dots-fill',
                color: 'rose',
                dotColor: 'bg-rose-500'
            }
        ]
    }">
        <template x-for="(activity, index) in activities" :key="index">
            <div class="flex items-start gap-4 group cursor-pointer p-3 -mx-3 rounded-xl hover:bg-white/5 transition-all duration-300">
                {{-- Timeline Dot --}}
                <div class="relative">
                    <div class="w-2.5 h-2.5 rounded-full mt-1.5 shadow-lg activity-dot"
                         :class="activity.dotColor"
                         :style="{ boxShadow: '0 0 10px currentColor' }"></div>
                    {{-- Timeline Line --}}
                    <div class="absolute top-4 left-1/2 -translate-x-1/2 w-px h-full bg-gradient-to-b from-white/10 to-transparent"
                         x-show="index < activities.length - 1"></div>
                </div>
                
                {{-- Content --}}
                <div class="flex-1 min-w-0">
                    <div class="flex items-start justify-between gap-2">
                        <div class="min-w-0">
                            <p class="text-sm font-semibold text-slate-200 group-hover:text-white transition-colors truncate" 
                               x-text="activity.title"></p>
                            <p class="text-xs text-slate-500 mt-0.5 truncate" x-text="activity.subtitle"></p>
                        </div>
                        <span class="text-[10px] text-slate-600 whitespace-nowrap font-medium flex items-center gap-1">
                            <i class="bi bi-clock text-[8px]"></i>
                            <span x-text="activity.time"></span>
                        </span>
                    </div>
                </div>
            </div>
        </template>
    </div>
    
    {{-- Load More Button --}}
    <button class="w-full mt-6 py-3.5 glass-panel hover:bg-white/5 rounded-2xl text-xs font-bold text-indigo-400 hover:text-indigo-300 transition-all flex items-center justify-center gap-2 group border border-white/5 hover:border-indigo-500/30">
        <span>View All Activity</span>
        <i class="bi bi-arrow-right group-hover:translate-x-1 transition-transform"></i>
    </button>
</div>
