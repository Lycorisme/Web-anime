{{-- Stats Grid Component --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6 mb-6 sm:mb-10">
    <template x-for="(stat, index) in stats" :key="index">
        <x-ui.stats-card ::stat="stat" ::index="index" />
    </template>
</div>
