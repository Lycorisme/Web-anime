{{-- Settings Page Header --}}
<div class="flex items-center gap-4 mb-2">
    <a href="/" 
       class="p-2 rounded-xl transition-all duration-300 hover:scale-110"
       :class="darkMode ? 'text-slate-400 hover:bg-white/10 hover:text-white' : 'text-slate-500 hover:bg-slate-200 hover:text-slate-700'">
        <i class="bi bi-arrow-left text-xl"></i>
    </a>
    <h1 class="font-space font-bold text-2xl md:text-3xl"
        :class="darkMode ? 'text-white' : 'text-slate-800'">
        <i class="bi bi-gear-fill gradient-text mr-2"></i>
        Pengaturan Situs
    </h1>
</div>
<p class="text-sm ml-12"
   :class="darkMode ? 'text-slate-400' : 'text-slate-600'">
    Kelola tampilan dan informasi website Anda
</p>
