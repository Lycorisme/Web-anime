{{-- Settings Footer --}}
<footer class="mt-10 py-6 border-t text-center sm:text-left"
        :class="darkMode ? 'border-white/10' : 'border-slate-200'">
    <p class="text-sm" :class="darkMode ? 'text-slate-500' : 'text-slate-400'">
        {{ $siteSettings['footer_copyright'] ?? '© 2026 PORTAL GG. All rights reserved.' }}
    </p>
</footer>
