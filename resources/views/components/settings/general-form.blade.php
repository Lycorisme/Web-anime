{{-- General Settings Form - Responsive --}}
@props(['siteName' => '', 'footerCopyright' => ''])

<x-ui.card padding="" rounded="rounded-xl sm:rounded-2xl" class="transition-colors duration-500">
    {{-- Header --}}
    <div class="px-4 sm:px-6 py-4 sm:py-5 transition-colors duration-500"
         :class="darkMode ? 'bg-gradient-to-r from-blue-500/10 to-cyan-500/10 border-b border-white/5' : 'bg-gradient-to-r from-blue-500/5 to-cyan-500/5 border-b border-slate-100'">
        <div class="flex items-center gap-3 sm:gap-4">
            <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-lg sm:rounded-xl bg-gradient-to-r from-blue-500 to-cyan-500 flex items-center justify-center shadow-lg shadow-blue-500/20">
                <i class="bi bi-building text-lg sm:text-xl text-white"></i>
            </div>
            <div>
                <h3 class="font-bold text-base sm:text-lg">{{ __('site_identity') }}</h3>
                <p class="text-[11px] sm:text-xs text-slate-400">{{ __('basic_info') }}</p>
            </div>
        </div>
    </div>

    {{-- Form Content --}}
    <div class="p-4 sm:p-6">
        {{-- Site Name Field --}}
        <x-ui.input 
            model="siteName" 
            :label="__('site_name')" 
            icon="bi-type" 
            :placeholder="__('enter_site_name')" 
        />

        {{-- Footer Copyright Field --}}
        <div class="mt-4 sm:mt-6">
            <x-ui.input 
                model="footerCopyright" 
                :label="__('footer_copyright')" 
                icon="bi-c-circle" 
                :placeholder="__('enter_copyright')" 
            />
        </div>

        {{-- Save Button with Confirmation --}}
        <div class="mt-6 sm:mt-8 pt-4 sm:pt-6 border-t border-white/5">
            <x-ui.confirm-button 
                action="save" 
                :label="__('save_changes')"
                variant="primary"
                icon="bi-check-circle-fill"
            />
        </div>
    </div>
</x-ui.card>
