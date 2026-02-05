<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Portal GG - Premium Cyber Dashboard">
<title>{{ \App\Models\SiteSetting::get('site_name', config('app.name', 'Portal GG')) }}</title>

<!-- Favicon -->
@php
    $favicon = \App\Models\SiteSetting::get('site_favicon');
    $faviconIcon = \App\Models\SiteSetting::get('site_favicon_icon', 'sparkles');
    $icons = \App\Models\SiteSetting::getTailwindIcons();
@endphp

@if($favicon)
    <link rel="icon" href="{{ Storage::url($favicon) }}">
@elseif(isset($icons[$faviconIcon]))
    <link rel="icon" href="data:image/svg+xml;base64,{{ base64_encode($icons[$faviconIcon]) }}">
@endif

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Icons -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">

<!-- Lucide Icons -->
<script src="https://unpkg.com/lucide@latest"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Styles -->
@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles

<!-- Prevent flash of wrong theme -->
<script>
    (function() {
        const darkMode = localStorage.getItem('darkMode') === 'true';
        if (darkMode) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        
        const savedTheme = JSON.parse(localStorage.getItem('userTheme') || 'null');
        if (savedTheme) {
            document.documentElement.style.setProperty('--gradient-start', savedTheme.start);
            document.documentElement.style.setProperty('--gradient-end', savedTheme.end);
        }
        
        // Store dark mode state for body class application
        window.__darkMode = darkMode;

        // Listen for appearance updates (favicon)
        window.addEventListener('appearance-updated', event => {
            const faviconUrl = event.detail.faviconUrl;
            const faviconDataUrl = event.detail.faviconDataUrl;
            
            let link = document.querySelector("link[rel~='icon']");
            if (!link) {
                link = document.createElement('link');
                link.rel = 'icon';
                document.head.appendChild(link);
            }
            
            if (faviconUrl) {
                link.href = faviconUrl;
            } else if (faviconDataUrl) {
                link.href = faviconDataUrl;
            }
        });
    })();
</script>

<style>[x-cloak] { display: none !important; }</style>
