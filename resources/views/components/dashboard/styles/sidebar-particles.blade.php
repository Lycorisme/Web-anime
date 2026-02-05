{{-- Sidebar Particle Styles --}}
<style>
    .sidebar-particles {
        position: absolute;
        inset: 0;
        z-index: -1; /* Behind sidebar content but inside glass card */
        overflow: hidden;
        pointer-events: none;
    }

    .sb-particle {
        position: absolute;
        width: 2px;
        height: 2px;
        background: rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        bottom: -10px;
        animation: floatSidebar 10s linear infinite;
    }

    @keyframes floatSidebar {
        0% {
            transform: translateY(0) translateX(0);
            opacity: 0;
        }
        10% {
            opacity: 0.5;
        }
        90% {
            opacity: 0.5;
        }
        100% {
            transform: translateY(-100vh) translateX(20px);
            opacity: 0;
        }
    }
</style>
