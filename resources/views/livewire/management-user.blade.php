{{-- Management User Page --}}
<div x-data="userManagement()" x-init="init()">
    {{-- Page Header --}}
    <div class="mb-4 sm:mb-6 animate-fade-in-up">
        <div class="flex items-center justify-between gap-3">
            {{-- Left Section --}}
            <div class="flex items-center gap-3 sm:gap-4 min-w-0">
                <div class="w-10 h-10 sm:w-12 sm:h-12 btn-premium rounded-lg sm:rounded-xl flex items-center justify-center flex-shrink-0">
                    <i class="bi bi-people-fill text-lg sm:text-xl text-white"></i>
                </div>
                <div class="min-w-0">
                    <h1 class="text-xl sm:text-2xl font-extrabold truncate">
                        <span class="gradient-text">{{ __('management_user') }}</span>
                    </h1>
                    {{-- Breadcrumb --}}
                    <nav class="flex items-center gap-2 text-xs sm:text-sm mt-0.5">
                        <a href="/" wire:navigate
                           class="transition-colors flex items-center"
                           :class="darkMode ? 'text-slate-400 hover:text-blue-400' : 'text-slate-500 hover:text-slate-900'"
                           title="{{ __('dashboard') }}">
                            <i class="bi bi-grid-1x2-fill"></i>
                        </a>
                        <i class="bi bi-chevron-right text-[10px]"
                           :class="darkMode ? 'text-slate-500' : 'text-slate-500'"></i>
                        <span class="font-medium"
                              :class="darkMode ? 'text-slate-300' : 'text-slate-500'">{{ __('management_user') }}</span>
                    </nav>
                </div>
            </div>

            {{-- Right Section - Add User Button --}}
            <button @click="openAddModal()" 
                    class="btn-premium text-white text-xs sm:text-sm px-4 sm:px-5 py-2.5 sm:py-3 rounded-xl font-bold flex items-center gap-2 hover:scale-105 active:scale-95 transition-transform shadow-lg">
                <i class="bi bi-plus-lg"></i>
                <span class="hidden sm:inline">{{ __('add_user') }}</span>
            </button>
        </div>
    </div>

    {{-- Bulk Actions Bar --}}
    <div x-show="selectedUsers.length > 0" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-4"
         class="mb-4 animate-fade-in-up" x-cloak>
        <div class="rounded-2xl px-4 sm:px-6 py-3 sm:py-4 flex items-center justify-between flex-wrap gap-3"
             :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30'">
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 btn-premium rounded-lg flex items-center justify-center text-white text-sm font-bold" x-text="selectedUsers.length"></div>
                <span class="text-sm font-bold" :class="darkMode ? 'text-slate-300' : 'text-slate-600'" x-text="selectedUsers.length + ' ' + (window.i18n?.items_selected || 'items selected')"></span>
            </div>
            <div class="flex items-center gap-2">
                <button @click="bulkDelete()"
                        class="px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 transition-all hover:scale-105 active:scale-95 bg-red-500/10 text-red-500 hover:bg-red-500/20">
                    <i class="bi bi-trash3"></i>
                    <span>{{ __('delete_selected') }}</span>
                </button>
                <button @click="selectedUsers = []; selectAll = false"
                        class="px-4 py-2 rounded-xl text-xs font-bold flex items-center gap-2 transition-all hover:scale-105 active:scale-95"
                        :class="darkMode ? 'bg-white/5 text-slate-400 hover:bg-white/10' : 'bg-slate-200/50 text-slate-500 hover:bg-slate-200'">
                    <i class="bi bi-x-lg"></i>
                    <span>{{ __('cancel') }}</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Table Card --}}
    <div class="rounded-2xl sm:rounded-3xl overflow-hidden animate-fade-in-up shadow-2xl"
         :class="darkMode ? 'glass-card border border-white/10' : 'bg-white/15 backdrop-blur-md border border-white/30 shadow-xl shadow-slate-200/20'">
        
        {{-- Table Header Bar --}}
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-b flex items-center justify-between bg-white/5"
             :class="darkMode ? 'border-white/5' : 'border-white/20'">
            <div class="flex items-center gap-3 sm:gap-4">
                {{-- Window Controls --}}
                <div class="flex gap-1.5">
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-red-500/80"></div>
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-yellow-500/80"></div>
                    <div class="w-2.5 h-2.5 sm:w-3 sm:h-3 rounded-full bg-green-500/80"></div>
                </div>
                <span class="text-[10px] sm:text-xs font-bold text-slate-400 uppercase tracking-widest ml-1 sm:ml-2">
                    {{ __('management_user') }}
                </span>
            </div>
            
            {{-- Search & Filter Icons (Visual Only) --}}
            <div class="flex items-center gap-3">
                <button class="text-slate-400 hover:text-white transition-colors p-1">
                    <i class="bi bi-search"></i>
                </button>
                <button class="text-slate-400 hover:text-white transition-colors p-1">
                    <i class="bi bi-funnel"></i>
                </button>
            </div>
        </div>

        {{-- Table Content --}}
        <div class="p-0 sm:p-6 overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-0 sm:border-spacing-y-3">
                <thead class="text-slate-500 text-[10px] font-bold uppercase tracking-widest hidden sm:table-header-group">
                    <tr>
                        <th class="px-6 py-3">{{ __('item_info') }}</th>
                        <th class="px-6 py-3">{{ __('status') }}</th>
                        <th class="px-6 py-3">{{ __('role') }}</th>
                        <th class="px-6 py-3 text-center">{{ __('action') }}</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5 sm:divide-y-0">
                    <template x-for="(user, index) in filteredUsers" :key="user.id">
                        <tr class="sm:hover:bg-white/5 transition-all group cursor-pointer flex flex-col sm:table-row p-4 sm:p-0"
                            :class="darkMode ? 'glass-card' : ''">
                            
                            {{-- Item Info --}}
                            <td class="p-3 sm:p-4 rounded-l-none sm:rounded-l-2xl border-none">
                                <div class="flex items-center gap-3 sm:gap-4">
                                    <div class="w-10 h-10 sm:w-11 sm:h-11 rounded-xl flex items-center justify-center text-white shadow-lg flex-shrink-0 font-bold text-sm"
                                         :style="`background: linear-gradient(135deg, ${user.avatarColor}, ${user.avatarColorEnd})`">
                                        <span x-text="user.name.charAt(0).toUpperCase()"></span>
                                    </div>
                                    <div>
                                        <p class="font-extrabold text-xs sm:text-sm group-hover:text-blue-400 transition-colors" 
                                           :class="darkMode ? 'text-white' : 'text-slate-800'"
                                           x-text="user.name"></p>
                                        <p class="text-[10px] sm:text-[11px] text-slate-500 mt-0.5 sm:mt-1">
                                            <span x-text="user.email"></span>
                                        </p>
                                    </div>
                                </div>
                            </td>

                            {{-- Status --}}
                            <td class="px-3 pb-3 sm:p-4 border-none flex items-center justify-between sm:table-cell">
                                <span class="sm:hidden text-xs text-slate-400 font-bold">{{ __('status') }}</span>
                                <span class="px-2.5 sm:px-3 py-1 rounded-full text-[9px] sm:text-[10px] font-bold uppercase flex items-center gap-1.5 w-fit"
                                      :class="user.status === 'Active' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'">
                                    <span class="w-1.5 h-1.5 rounded-full" :class="user.status === 'Active' ? 'bg-green-500 animate-pulse' : 'bg-red-500'"></span>
                                    <span x-text="user.status"></span>
                                </span>
                            </td>

                            {{-- Role --}}
                            <td class="px-3 pb-3 sm:p-4 border-none flex items-center justify-between sm:table-cell">
                                <span class="sm:hidden text-xs text-slate-400 font-bold">{{ __('role') }}</span>
                                <span class="px-2.5 py-1 rounded-md text-[10px] font-bold uppercase tracking-wider bg-opacity-10"
                                      :class="user.role === 'Admin' ? 'bg-purple-500/10 text-purple-500' : (user.role === 'Editor' ? 'bg-blue-500/10 text-blue-500' : 'bg-slate-500/10 text-slate-500')"
                                      x-text="user.role"></span>
                            </td>

                            {{-- Actions --}}
                            <td class="px-3 pb-3 sm:p-4 rounded-r-none sm:rounded-r-2xl text-center border-none hidden sm:table-cell">
                                <div class="flex justify-center gap-2">
                                    <button @click="openEditModal(user)" class="p-2 hover:bg-white/10 rounded-lg text-slate-400 hover:text-blue-400 transition-all">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button @click="confirmDelete(user)" class="p-2 hover:bg-white/10 rounded-lg text-slate-400 hover:text-red-400 transition-all">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                            
                            {{-- Mobile Actions --}}
                            <td class="px-3 pb-3 border-none sm:hidden flex justify-end gap-2 border-t border-white/5 pt-3">
                                <button @click="openEditModal(user)" class="p-2 rounded-lg text-xs bg-blue-500/10 text-blue-400 hover:bg-blue-500/20 transition-colors">
                                    <i class="bi bi-pencil-square"></i>
                                </button>
                                <button @click="confirmDelete(user)" class="p-2 rounded-lg text-xs bg-red-500/10 text-red-400 hover:bg-red-500/20 transition-colors">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </td>
                        </tr>
                    </template>
                    
                    {{-- Empty State --}}
                    <tr x-show="filteredUsers.length === 0">
                        <td colspan="4" class="text-center py-12">
                            <div class="flex flex-col items-center gap-3">
                                <div class="w-16 h-16 rounded-2xl flex items-center justify-center"
                                     :class="darkMode ? 'bg-white/5' : 'bg-slate-100'">
                                    <i class="bi bi-people text-3xl text-slate-400"></i>
                                </div>
                                <p class="text-sm font-bold text-slate-400" x-text="window.i18n?.no_data || 'No data available'"></p>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        {{-- Table Footer --}}
        <div class="px-4 sm:px-6 py-3 sm:py-4 border-t flex items-center justify-between bg-white/5"
             :class="darkMode ? 'border-white/5' : 'border-white/20'">
            <span class="text-[10px] sm:text-xs text-slate-400 font-medium">
                <span x-text="(window.i18n?.showing || 'Showing') + ' ' + filteredUsers.length + ' ' + (window.i18n?.of || 'of') + ' ' + users.length + ' ' + (window.i18n?.entries || 'entries')"></span>
            </span>
        </div>
    </div>

    {{-- Add/Edit User Modal --}}
    <div x-show="showModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="closeModal()"></div>
        
        {{-- Modal Content --}}
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-90"
             class="relative w-full max-w-lg rounded-3xl shadow-2xl overflow-hidden z-10 border"
             :class="darkMode ? 'bg-slate-900/95 backdrop-blur-xl border-white/10' : 'bg-white/95 backdrop-blur-xl border-slate-200'">
            
            {{-- Modal Header --}}
            <div class="px-6 py-5 border-b flex items-center justify-between"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center text-white">
                        <i :class="editMode ? 'bi bi-pencil-square' : 'bi bi-person-plus'"></i>
                    </div>
                    <h3 class="text-lg font-extrabold" x-text="editMode ? (window.i18n?.edit_user || 'Edit User') : (window.i18n?.add_user || 'Add User')"></h3>
                </div>
                <button @click="closeModal()" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all hover:scale-110"
                        :class="darkMode ? 'hover:bg-white/10 text-slate-400' : 'hover:bg-slate-100 text-slate-500'">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>

            {{-- Modal Body --}}
            <div class="px-6 py-5 space-y-4 max-h-[60vh] overflow-y-auto custom-scrollbar">
                {{-- Name --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider" 
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'" 
                           x-text="window.i18n?.full_name || 'Full Name'"></label>
                    <input type="text" x-model="formData.name"
                           class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'"
                           :placeholder="window.i18n?.full_name || 'Full Name'">
                </div>
                {{-- Email --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'" 
                           x-text="window.i18n?.email || 'Email'"></label>
                    <input type="email" x-model="formData.email"
                           class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'"
                           placeholder="user@example.com">
                </div>
                {{-- Phone --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'" 
                           x-text="window.i18n?.phone || 'Phone'"></label>
                    <input type="text" x-model="formData.phone"
                           class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'"
                           placeholder="+62 812 3456 7890">
                </div>
                {{-- Role --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'" 
                           x-text="window.i18n?.role || 'Role'"></label>
                    <select x-model="formData.role"
                            class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all appearance-none cursor-pointer"
                            :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'">
                        <option value="" disabled x-text="window.i18n?.select_role || 'Select Role'"></option>
                        <option value="Admin" x-text="window.i18n?.admin || 'Admin'"></option>
                        <option value="Editor" x-text="window.i18n?.editor || 'Editor'"></option>
                        <option value="Viewer" x-text="window.i18n?.viewer || 'Viewer'"></option>
                    </select>
                </div>
                {{-- Status --}}
                <div>
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'" 
                           x-text="window.i18n?.status || 'Status'"></label>
                    <select x-model="formData.status"
                            class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all appearance-none cursor-pointer"
                            :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'">
                        <option value="Active" x-text="window.i18n?.active || 'Active'"></option>
                        <option value="Inactive" x-text="window.i18n?.inactive || 'Inactive'"></option>
                    </select>
                </div>
                {{-- Password (only for add) --}}
                <div x-show="!editMode">
                    <label class="block text-xs font-bold mb-2 uppercase tracking-wider"
                           :class="darkMode ? 'text-slate-400' : 'text-slate-500'" 
                           x-text="window.i18n?.password || 'Password'"></label>
                    <input type="password" x-model="formData.password"
                           class="w-full px-4 py-3 rounded-xl text-sm font-medium outline-none transition-all"
                           :class="darkMode ? 'bg-white/5 border border-white/10 text-white focus:border-blue-500/50' : 'bg-slate-50 border border-slate-200 text-slate-700 focus:border-blue-500/50'"
                           placeholder="••••••••">
                </div>
            </div>

            {{-- Modal Footer --}}
            <div class="px-6 py-4 border-t flex items-center justify-end gap-3"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                <button @click="closeModal()" 
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-105 active:scale-95"
                        :class="darkMode ? 'bg-white/5 text-slate-300 hover:bg-white/10' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'">
                    {{ __('cancel') }}
                </button>
                <button @click="saveUser()"
                        class="btn-premium text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-105 active:scale-95 shadow-lg">
                    <i class="bi bi-check-lg mr-1"></i>
                    {{ __('save') }}
                </button>
            </div>
        </div>
    </div>

    {{-- View User Modal --}}
    <div x-show="showViewModal" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4" x-cloak>
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="showViewModal = false"></div>
        <div x-show="showViewModal"
             x-transition:enter="transition ease-out duration-300 delay-100"
             x-transition:enter-start="opacity-0 scale-90 translate-y-8"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             class="relative w-full max-w-md rounded-3xl shadow-2xl overflow-hidden z-10 border"
             :class="darkMode ? 'bg-slate-900/95 backdrop-blur-xl border-white/10' : 'bg-white/95 backdrop-blur-xl border-slate-200'">
            
            {{-- Header --}}
            <div class="px-6 py-5 border-b flex items-center justify-between"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 btn-premium rounded-xl flex items-center justify-center text-white">
                        <i class="bi bi-person"></i>
                    </div>
                    <h3 class="text-lg font-extrabold" x-text="window.i18n?.view || 'View'"></h3>
                </div>
                <button @click="showViewModal = false" 
                        class="w-8 h-8 rounded-lg flex items-center justify-center transition-all hover:scale-110"
                        :class="darkMode ? 'hover:bg-white/10 text-slate-400' : 'hover:bg-slate-100 text-slate-500'">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            {{-- Body --}}
            <div class="px-6 py-6">
                <div class="flex flex-col items-center mb-6">
                    <div class="w-20 h-20 rounded-2xl flex items-center justify-center text-white text-2xl font-bold shadow-xl mb-3"
                         :style="`background: linear-gradient(135deg, ${viewUser?.avatarColor || '#6366f1'}, ${viewUser?.avatarColorEnd || '#8b5cf6'})`">
                        <span x-text="viewUser?.name?.charAt(0)?.toUpperCase() || '?'"></span>
                    </div>
                    <h4 class="text-lg font-extrabold" x-text="viewUser?.name || ''"></h4>
                    <span class="text-xs text-slate-400 mt-1" x-text="viewUser?.email || ''"></span>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center justify-between py-2.5 px-4 rounded-xl" :class="darkMode ? 'bg-white/5' : 'bg-slate-50'">
                        <span class="text-xs font-bold text-slate-400" x-text="window.i18n?.role || 'Role'"></span>
                        <span class="text-xs font-bold px-3 py-1 rounded-full"
                              :class="viewUser?.role === 'Admin' ? 'bg-purple-500/10 text-purple-500' : (viewUser?.role === 'Editor' ? 'bg-blue-500/10 text-blue-500' : 'bg-slate-500/10 text-slate-400')"
                              x-text="viewUser?.role || ''"></span>
                    </div>
                    <div class="flex items-center justify-between py-2.5 px-4 rounded-xl" :class="darkMode ? 'bg-white/5' : 'bg-slate-50'">
                        <span class="text-xs font-bold text-slate-400" x-text="window.i18n?.status || 'Status'"></span>
                        <span class="text-xs font-bold px-3 py-1 rounded-full flex items-center gap-1.5"
                              :class="viewUser?.status === 'Active' ? 'bg-green-500/10 text-green-500' : 'bg-red-500/10 text-red-500'">
                            <span class="w-1.5 h-1.5 rounded-full" :class="viewUser?.status === 'Active' ? 'bg-green-500 animate-pulse' : 'bg-red-500'"></span>
                            <span x-text="viewUser?.status === 'Active' ? (window.i18n?.active || 'Active') : (window.i18n?.inactive || 'Inactive')"></span>
                        </span>
                    </div>
                    <div class="flex items-center justify-between py-2.5 px-4 rounded-xl" :class="darkMode ? 'bg-white/5' : 'bg-slate-50'">
                        <span class="text-xs font-bold text-slate-400" x-text="window.i18n?.phone || 'Phone'"></span>
                        <span class="text-xs font-medium" x-text="viewUser?.phone || '-'"></span>
                    </div>
                </div>
            </div>
            {{-- Footer --}}
            <div class="px-6 py-4 border-t flex justify-end"
                 :class="darkMode ? 'border-white/10' : 'border-slate-100'">
                <button @click="showViewModal = false"
                        class="px-5 py-2.5 rounded-xl text-sm font-bold transition-all hover:scale-105 active:scale-95"
                        :class="darkMode ? 'bg-white/5 text-slate-300 hover:bg-white/10' : 'bg-slate-100 text-slate-600 hover:bg-slate-200'">
                    {{ __('close') }}
                </button>
            </div>
        </div>
    </div>

    <script>
        function userManagement() {
            return {
                users: [],
                filteredUsers: [],
                selectedUsers: [],
                selectAll: false,
                searchQuery: '',
                filterRole: '',
                showModal: false,
                showViewModal: false,
                editMode: false,
                editId: null,
                viewUser: null,
                formData: {
                    name: '',
                    email: '',
                    phone: '',
                    role: '',
                    status: 'Active',
                    password: ''
                },

                init() {
                    // Dummy user data
                    const colors = [
                        { start: '#6366f1', end: '#8b5cf6' },
                        { start: '#f43f5e', end: '#fb923c' },
                        { start: '#059669', end: '#34d399' },
                        { start: '#0ea5e9', end: '#22d3ee' },
                        { start: '#d97706', end: '#fcd34d' },
                        { start: '#be123c', end: '#fb7185' },
                        { start: '#7c3aed', end: '#a78bfa' },
                        { start: '#c026d3', end: '#e879f9' },
                    ];

                    this.users = [];

                    this.filteredUsers = [...this.users];
                },

                filterUsers() {
                    let result = [...this.users];
                    
                    if (this.searchQuery) {
                        const q = this.searchQuery.toLowerCase();
                        result = result.filter(u => 
                            u.name.toLowerCase().includes(q) || u.email.toLowerCase().includes(q)
                        );
                    }
                    
                    if (this.filterRole) {
                        result = result.filter(u => u.role === this.filterRole);
                    }
                    
                    this.filteredUsers = result;
                },

                toggleSelectAll() {
                    if (this.selectAll) {
                        this.selectedUsers = this.filteredUsers.map(u => u.id);
                    } else {
                        this.selectedUsers = [];
                    }
                },

                openAddModal() {
                    this.editMode = false;
                    this.editId = null;
                    this.formData = { name: '', email: '', phone: '', role: '', status: 'Active', password: '' };
                    this.showModal = true;
                },

                openEditModal(user) {
                    this.editMode = true;
                    this.editId = user.id;
                    this.formData = { 
                        name: user.name, 
                        email: user.email, 
                        phone: user.phone, 
                        role: user.role, 
                        status: user.status, 
                        password: '' 
                    };
                    this.showModal = true;
                },

                openViewModal(user) {
                    this.viewUser = user;
                    this.showViewModal = true;
                },

                closeModal() {
                    this.showModal = false;
                    this.editMode = false;
                    this.editId = null;
                },

                saveUser() {
                    if (!this.formData.name || !this.formData.email || !this.formData.role) return;

                    const colors = [
                        { start: '#6366f1', end: '#8b5cf6' },
                        { start: '#f43f5e', end: '#fb923c' },
                        { start: '#059669', end: '#34d399' },
                        { start: '#0ea5e9', end: '#22d3ee' },
                        { start: '#d97706', end: '#fcd34d' },
                    ];

                    if (this.editMode) {
                        const idx = this.users.findIndex(u => u.id === this.editId);
                        if (idx > -1) {
                            this.users[idx].name = this.formData.name;
                            this.users[idx].email = this.formData.email;
                            this.users[idx].phone = this.formData.phone;
                            this.users[idx].role = this.formData.role;
                            this.users[idx].status = this.formData.status;
                        }
                        window.dispatchEvent(new CustomEvent('toast-success', {
                            detail: { title: window.i18n?.success || 'Success', message: window.i18n?.user_updated || 'User updated successfully!' }
                        }));
                    } else {
                        const randomColor = colors[Math.floor(Math.random() * colors.length)];
                        const newUser = {
                            id: Date.now(),
                            name: this.formData.name,
                            email: this.formData.email,
                            phone: this.formData.phone,
                            role: this.formData.role,
                            status: this.formData.status,
                            avatarColor: randomColor.start,
                            avatarColorEnd: randomColor.end
                        };
                        this.users.push(newUser);
                        window.dispatchEvent(new CustomEvent('toast-success', {
                            detail: { title: window.i18n?.success || 'Success', message: window.i18n?.user_added || 'User added successfully!' }
                        }));
                    }

                    this.filterUsers();
                    this.closeModal();
                },

                confirmDelete(user) {
                    window.dispatchEvent(new CustomEvent('show-alert', {
                        detail: {
                            title: window.i18n?.delete_user || 'Delete User',
                            message: (window.i18n?.confirm_delete_user || 'Are you sure you want to delete this user?'),
                            type: 'danger',
                            confirmText: window.i18n?.yes_delete || 'Yes, Delete',
                            cancelText: window.i18n?.cancel || 'Cancel',
                            onConfirm: () => {
                                this.users = this.users.filter(u => u.id !== user.id);
                                this.selectedUsers = this.selectedUsers.filter(id => id !== user.id);
                                this.filterUsers();
                                window.dispatchEvent(new CustomEvent('toast-success', {
                                    detail: { title: window.i18n?.success || 'Success', message: window.i18n?.user_deleted || 'User deleted successfully!' }
                                }));
                            }
                        }
                    }));
                },

                bulkDelete() {
                    window.dispatchEvent(new CustomEvent('show-alert', {
                        detail: {
                            title: window.i18n?.delete_selected || 'Delete Selected',
                            message: (window.i18n?.confirm_delete_users || 'Are you sure you want to delete selected users?'),
                            type: 'danger',
                            confirmText: window.i18n?.yes_delete || 'Yes, Delete',
                            cancelText: window.i18n?.cancel || 'Cancel',
                            onConfirm: () => {
                                this.users = this.users.filter(u => !this.selectedUsers.includes(u.id));
                                this.selectedUsers = [];
                                this.selectAll = false;
                                this.filterUsers();
                                window.dispatchEvent(new CustomEvent('toast-success', {
                                    detail: { title: window.i18n?.success || 'Success', message: window.i18n?.users_deleted || 'Users deleted successfully!' }
                                }));
                            }
                        }
                    }));
                }
            }
        }
    </script>
</div>
