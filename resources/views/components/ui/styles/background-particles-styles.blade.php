{{-- Background Particles Styles --}}
<style>
    #bg-particles-container {
        position: fixed;
        inset: 0;
        z-index: -1; /* Behind everything */
        overflow: hidden;
        pointer-events: none;
    }

    .bg-particle {
        position: absolute;
        opacity: 0;
        pointer-events: none;
        animation: floatBgParticle 15s linear infinite;
        transition: background-color 0.7s cubic-bezier(0.2, 0.8, 0.2, 1), border-color 0.7s cubic-bezier(0.2, 0.8, 0.2, 1), opacity 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    /* Shapes */
    .bg-particle-square {
        border-radius: 4px; /* Slightly rounded square */
    }

    .bg-particle-cross {
        background: transparent !important;
        overflow: visible;
    }
    .bg-particle-cross::before,
    .bg-particle-cross::after {
        content: '';
        position: absolute;
        background: var(--particle-color);
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        border-radius: 2px;
        transition: background-color 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
    }
    .bg-particle-cross::before {
        width: 100%;
        height: 20%;
    }
    .bg-particle-cross::after {
        width: 20%;
        height: 100%;
    }

    .bg-particle-ring {
        background: transparent !important;
        border: 2px solid var(--particle-color);
        border-radius: 50%;
        box-sizing: border-box;
        transition: border-color 0.7s cubic-bezier(0.2, 0.8, 0.2, 1);
    }

    /* Animation */
    @keyframes floatBgParticle {
        0% {
            transform: translateY(110vh) rotate(0deg) scale(0.5);
            opacity: 0;
        }
        10% {
            opacity: 0.4;
            transform: translateY(100vh) rotate(45deg) scale(1);
        }
        90% {
            opacity: 0.4;
        }
        100% {
            transform: translateY(-10vh) rotate(360deg) scale(0.5);
            opacity: 0;
        }
    }

    /* Dark/Light mode color adjustment if needed, 
       but we will likely use JS to set dynamic colors based on theme */
</style>
