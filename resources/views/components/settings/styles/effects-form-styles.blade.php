<style>
    /* Cursor Preview Animations */
    .cursor-preview {
        position: absolute;
        inset: 0;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .group:hover .cursor-preview,
    .ring-emerald-500 .cursor-preview,
    .ring-violet-500 .cursor-preview {
        opacity: 1;
    }
    
    /* Cursor Styles Previews */
    .cursor-preview-soft_glow {
        background: radial-gradient(circle at center, var(--gradient-start, #10b981) 0%, transparent 70%);
        filter: blur(8px);
        animation: pulse-soft 2s ease-in-out infinite;
    }
    
    .cursor-preview-gradient_blob {
        background: radial-gradient(circle at center, var(--gradient-start, #10b981) 0%, var(--gradient-end, #14b8a6) 50%, transparent 70%);
        filter: blur(6px);
        animation: blob-morph 3s ease-in-out infinite;
    }
    
    .cursor-preview-ring_outline {
        border: 3px solid var(--gradient-start, #10b981);
        border-radius: 50%;
        margin: 20%;
        box-shadow: 0 0 15px var(--gradient-start, #10b981);
        animation: ring-pulse-preview 1.5s ease-in-out infinite;
    }
    
    .cursor-preview-particle_trail {
        background-image: 
            radial-gradient(circle at 30% 40%, var(--gradient-start, #10b981) 2px, transparent 2px),
            radial-gradient(circle at 60% 30%, var(--gradient-end, #14b8a6) 2px, transparent 2px),
            radial-gradient(circle at 50% 60%, var(--gradient-start, #10b981) 2px, transparent 2px),
            radial-gradient(circle at 70% 70%, var(--gradient-end, #14b8a6) 2px, transparent 2px);
        animation: particles-float 2s ease-in-out infinite;
    }
    
    /* Click Animation Previews - Reuse basic animations or define specific ones if needed */
    /* Adjust colors for click section (violet) */
    .ring-violet-500 .cursor-preview-ripple {
        /* Custom preview for ripple if needed, otherwise reuses generic or adds specific class */
    }

    /* Animations */
    @keyframes pulse-soft {
        0%, 100% { transform: scale(0.9); opacity: 0.6; }
        50% { transform: scale(1.1); opacity: 1; }
    }
    
    @keyframes blob-morph {
        0%, 100% { transform: scale(1) rotate(0deg); }
        33% { transform: scale(1.1) rotate(5deg); }
        66% { transform: scale(0.95) rotate(-5deg); }
    }
    
    @keyframes ring-pulse-preview {
        0%, 100% { transform: scale(0.8); opacity: 1; }
        50% { transform: scale(1); opacity: 0.7; }
    }
    
    @keyframes particles-float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-5px); }
    }
</style>
