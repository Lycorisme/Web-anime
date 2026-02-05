{{-- Toast Icons Partial --}}
{{-- Dipisahkan dari toast.blade.php --}}

{{-- Success Icon --}}
<template x-if="toast.type === 'success'">
    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path d="M5 13l4 4L19 7"></path>
    </svg>
</template>
{{-- Error Icon --}}
<template x-if="toast.type === 'error'">
    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path d="M6 18L18 6M6 6l12 12"></path>
    </svg>
</template>
{{-- Warning Icon --}}
<template x-if="toast.type === 'warning'">
    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path d="M12 9v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
</template>
{{-- Info Icon --}}
<template x-if="toast.type === 'info'">
    <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
        <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
    </svg>
</template>
