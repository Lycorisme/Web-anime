{{-- Sidebar Transition Styles --}}
<style>
    /* ==========================================
       SIDEBAR TRANSITION ENGINE
       Premium smooth collapse/expand animation
       ========================================== */

    /* Base sidebar transition (width, transform) */
    .sidebar-animate {
        transition: 
            width 0.4s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.4s cubic-bezier(0.4, 0, 0.2, 1),
            box-shadow 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* ---- Text Container Transitions ---- */
    .sidebar-text-container {
        transition: 
            max-width 0.35s cubic-bezier(0.4, 0, 0.2, 1),
            opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            margin-left 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        max-width: 200px;
        opacity: 1;
    }

    .sidebar-text {
        transition: 
            transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
            opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        transform: translateX(0);
        opacity: 1;
    }

    /* Collapsed state: hide text */
    .sidebar-collapsed .sidebar-text-container {
        max-width: 0;
        opacity: 0;
        margin-left: 0;
    }

    .sidebar-collapsed .sidebar-text {
        transform: translateX(-10px);
        opacity: 0;
    }

    /* Expanded state: show text with slide-in */
    .sidebar-expanded .sidebar-text-container {
        max-width: 200px;
        opacity: 1;
    }

    .sidebar-expanded .sidebar-text {
        transform: translateX(0);
        opacity: 1;
    }

    /* ---- Footer Transitions ---- */
    .sidebar-footer-expanded {
        transition: 
            opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
            max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        max-height: 200px;
        opacity: 1;
        transform: scale(1) translateY(0);
        overflow: hidden;
    }

    .sidebar-footer-collapsed {
        transition: 
            opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1),
            transform 0.35s cubic-bezier(0.4, 0, 0.2, 1),
            max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        max-height: 60px;
        opacity: 1;
        transform: scale(1);
        overflow: hidden;
    }

    /* Collapsed: hide expanded footer, show collapsed */
    .sidebar-collapsed .sidebar-footer-expanded {
        max-height: 0;
        opacity: 0;
        transform: scale(0.95) translateY(8px);
        pointer-events: none;
    }

    .sidebar-collapsed .sidebar-footer-collapsed {
        max-height: 60px;
        opacity: 1;
        transform: scale(1);
    }

    /* Expanded: show expanded footer, hide collapsed */
    .sidebar-expanded .sidebar-footer-expanded {
        max-height: 200px;
        opacity: 1;
        transform: scale(1) translateY(0);
        transition-delay: 0.1s;
    }

    .sidebar-expanded .sidebar-footer-collapsed {
        max-height: 0;
        opacity: 0;
        transform: scale(0.8);
        pointer-events: none;
    }

    /* ---- Navigation Icon Animation ---- */
    .sidebar-collapsed nav a {
        justify-content: center;
        transition: 
            justify-content 0.3s ease,
            padding 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .sidebar-collapsed nav a i {
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .sidebar-collapsed nav a:hover i {
        transform: scale(1.2);
    }



    /* ---- Subtle Glow on Expand ---- */
    .sidebar-expanded {
        box-shadow: 
            0 25px 50px -12px rgba(0, 0, 0, 0.25),
            0 0 30px rgba(var(--gradient-start-rgb, 29, 78, 216), 0.05);
    }

    .sidebar-collapsed {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
    }
</style>
