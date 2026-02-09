{{-- SweetAlert Confirmation Dialog Component --}}
{{-- Custom Premium Design dengan Glassmorphism dan Animasi Modern --}}
@props([
    'id' => 'swal-confirm',
])

<div
    x-data="{
        show(options = {}) {
            const isDark = document.documentElement.classList.contains('dark');
            const type = options.type || 'warning';
            
            // Get theme colors from CSS variables
            const themeStart = getComputedStyle(document.documentElement).getPropertyValue('--gradient-start').trim() || '#1d4ed8';
            const themeEnd = getComputedStyle(document.documentElement).getPropertyValue('--gradient-end').trim() || '#7c3aed';
            
            // Type configurations with gradients
            const typeConfig = {
                'warning': {
                    icon: 'warning',
                    gradient: 'linear-gradient(135deg, #f59e0b 0%, #f97316 100%)',
                    iconColor: '#f59e0b',
                    glowColor: 'rgba(245, 158, 11, 0.3)',
                    buttonGradient: 'linear-gradient(135deg, #f59e0b 0%, #f97316 100%)'
                },
                'danger': {
                    icon: 'error',
                    gradient: 'linear-gradient(135deg, #ef4444 0%, #ec4899 100%)',
                    iconColor: '#ef4444',
                    glowColor: 'rgba(239, 68, 68, 0.3)',
                    buttonGradient: 'linear-gradient(135deg, #ef4444 0%, #ec4899 100%)'
                },
                'info': {
                    icon: 'info',
                    gradient: `linear-gradient(135deg, ${themeStart} 0%, ${themeEnd} 100%)`,
                    iconColor: themeStart,
                    glowColor: `${themeStart}4d`,
                    buttonGradient: `linear-gradient(135deg, ${themeStart} 0%, ${themeEnd} 100%)`
                },
                'success': {
                    icon: 'success',
                    gradient: 'linear-gradient(135deg, #10b981 0%, #14b8a6 100%)',
                    iconColor: '#10b981',
                    glowColor: 'rgba(16, 185, 129, 0.3)',
                    buttonGradient: 'linear-gradient(135deg, #10b981 0%, #14b8a6 100%)'
                },
                'question': {
                    icon: 'question',
                    gradient: 'linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%)',
                    iconColor: '#8b5cf6',
                    glowColor: 'rgba(139, 92, 246, 0.3)',
                    buttonGradient: 'linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%)'
                }
            };
            
            const config = typeConfig[type] || typeConfig['warning'];
            
            // Set CSS custom properties for dynamic styling
            document.documentElement.style.setProperty('--swal-gradient', config.gradient);
            document.documentElement.style.setProperty('--swal-icon-color', config.iconColor);
            document.documentElement.style.setProperty('--swal-glow-color', config.glowColor);
            document.documentElement.style.setProperty('--swal-button-gradient', config.buttonGradient);
            
            Swal.fire({
                title: options.title || '{{ __('confirm') }}',
                html: `<p class='swal-custom-message'>${options.message || '{{ __('confirm_action_message') }}'}</p>`,
                icon: config.icon,
                showCancelButton: true,
                confirmButtonText: `<i class='bi bi-check2-circle me-2'></i>${options.confirmText || '{{ __('yes_continue') }}'}`,
                cancelButtonText: `<i class='bi bi-x-circle me-2'></i>${options.cancelText || '{{ __('cancel') }}'}`,
                reverseButtons: true,
                focusCancel: false,
                buttonsStyling: false,
                customClass: {
                    container: 'swal-custom-container',
                    popup: isDark ? 'swal-custom-popup swal-dark' : 'swal-custom-popup swal-light',
                    title: 'swal-custom-title',
                    htmlContainer: 'swal-custom-html',
                    icon: 'swal-custom-icon',
                    confirmButton: 'swal-custom-confirm-btn',
                    cancelButton: isDark ? 'swal-custom-cancel-btn swal-cancel-dark' : 'swal-custom-cancel-btn swal-cancel-light',
                    actions: 'swal-custom-actions'
                },
                showClass: {
                    popup: 'swal-animate-in'
                },
                hideClass: {
                    popup: 'swal-animate-out'
                },
                backdrop: 'transparent',
                allowOutsideClick: true,
                allowEscapeKey: true,
                didOpen: (popup) => {
                    // Add gradient accent line at top
                    const accentLine = document.createElement('div');
                    accentLine.className = 'swal-accent-line';
                    popup.insertBefore(accentLine, popup.firstChild);
                    
                    // Add floating particles effect
                    const particlesContainer = document.createElement('div');
                    particlesContainer.className = 'swal-particles';
                    for (let i = 0; i < 50; i++) {
                        const particle = document.createElement('div');
                        const shapes = ['circle', 'diamond', 'triangle'];
                        const shape = shapes[Math.floor(Math.random() * shapes.length)];
                        
                        particle.className = `swal-particle swal-particle-${shape}`;
                        
                        // Random size
                        const size = 4 + Math.random() * 8; 
                        particle.style.width = `${size}px`;
                        particle.style.height = `${size}px`;
                        
                        particle.style.left = `${Math.random() * 100}%`;
                        particle.style.bottom = `${-20 + Math.random() * 40}px`; 
                        
                        particle.style.animationDelay = `${Math.random() * 2}s`;
                        particle.style.animationDuration = `${2 + Math.random() * 4}s`;
                        
                        // Random horizontal movement direction for fire effect
                        particle.style.setProperty('--sway-dir', Math.random() > 0.5 ? 1 : -1);
                        particle.style.setProperty('--sway-amount', `${20 + Math.random() * 50}px`);
                        
                        particlesContainer.appendChild(particle);
                    }
                    popup.appendChild(particlesContainer);
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    if (options.onConfirm && typeof options.onConfirm === 'function') {
                        options.onConfirm();
                    }
                } else if (result.isDismissed) {
                    if (options.onCancel && typeof options.onCancel === 'function') {
                        options.onCancel();
                    }
                }
            });
        }
    }"
    x-on:swal-confirm-{{ $id }}.window="show($event.detail)"
    {{ $attributes }}
></div>

{{-- Include separated style files --}}
@include('components.ui.styles.sweet-alert-styles')
@include('components.ui.styles.sweet-alert-buttons')
@include('components.ui.styles.sweet-alert-animations')
