{{-- UI Components Demo --}}
{{-- Demo page to showcase Alert Confirm and Toast components --}}

<div class="space-y-8">
    {{-- Page Header --}}
    <div class="glass-card rounded-2xl p-6 sm:p-8 animate-fade-in-up">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-14 h-14 rounded-xl btn-premium flex items-center justify-center shadow-lg">
                <i class="bi bi-bell-fill text-2xl text-white"></i>
            </div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold gradient-text">UI Components Demo</h1>
                <p class="text-slate-400 text-sm mt-1">Toast Notifications & Alert Confirmation</p>
            </div>
        </div>
    </div>

    {{-- Toast Section --}}
    @include('components.ui.partials.demo-toast-section')

    {{-- Alert Confirm Section --}}
    @include('components.ui.partials.demo-alert-section')

    {{-- Theme Integration Note --}}
    <div class="glass-card rounded-2xl p-6 animate-fade-in-up delay-300">
        <div class="flex items-start gap-4">
            <div class="w-10 h-10 rounded-lg btn-premium flex items-center justify-center flex-shrink-0">
                <i class="bi bi-palette-fill text-white"></i>
            </div>
            <div>
                <h3 class="font-bold mb-2" :class="darkMode ? 'text-white' : 'text-slate-800'">
                    <i class="bi bi-stars text-amber-400 mr-2"></i>Theme Integration
                </h3>
                <p class="text-sm text-slate-400 leading-relaxed">
                    Kedua komponen terintegrasi dengan sistem tema. Tombol konfirmasi tipe <code class="px-1.5 py-0.5 rounded bg-blue-500/10 text-blue-400 text-xs">info</code> 
                    menggunakan gradient tema aktif. Coba ubah tema di Theme Customizer untuk melihat perubahannya!
                </p>
            </div>
        </div>
    </div>
</div>
