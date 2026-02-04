<footer class="mt-10 py-6 border-t border-white/5 text-center sm:text-left transition-colors duration-300">
    <p class="text-sm text-slate-500 dark:text-slate-400">
        {{ \App\Models\SiteSetting::get('footer_copyright', '© ' . date('Y') . ' Portal Admin Premium. All rights reserved.') }}
    </p>
</footer>
