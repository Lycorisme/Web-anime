@props(['model', 'placeholder' => 'Select date'])
<div x-data="{
    open: false,
    value: @entangle($model),
    currentMonth: new Date().getMonth(),
    currentYear: new Date().getFullYear(),
    days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
    months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
    get blankDays() {
        let daysInMonth = new Date(this.currentYear, this.currentMonth, 1).getDay();
        return Array.from({length: daysInMonth}, (_, i) => i);
    },
    get noOfDays() {
        let daysInMonth = new Date(this.currentYear, this.currentMonth + 1, 0).getDate();
        return Array.from({length: daysInMonth}, (_, i) => i + 1);
    },
    selectDate(date) {
        let m = this.currentMonth + 1;
        let d = date;
        if(m < 10) m = '0' + m;
        if(d < 10) d = '0' + d;
        this.value = this.currentYear + '-' + m + '-' + d;
        this.open = false;
    },
    isToday(date) {
        const today = new Date();
        const d = new Date(this.currentYear, this.currentMonth, date);
        return today.toDateString() === d.toDateString();
    },
    isSelected(date) {
        if(!this.value) return false;
        // The value from entangle comes back as YYYY-MM-DD
        const [year, month, day] = this.value.split('-');
        return parseInt(year) === this.currentYear && 
               parseInt(month) - 1 === this.currentMonth && 
               parseInt(day) === date;
    },
    prevMonth() {
        if (this.currentMonth === 0) {
            this.currentMonth = 11;
            this.currentYear--;
        } else {
            this.currentMonth--;
        }
    },
    nextMonth() {
        if (this.currentMonth === 11) {
            this.currentMonth = 0;
            this.currentYear++;
        } else {
            this.currentMonth++;
        }
    },
    dropUp: false,
    teleport: true,
    dropdownStyle: {},
    rafId: null,
    getScrollParent(el) {
        let node = el.parentElement;
        while (node) {
            const style = getComputedStyle(node);
            const overflowY = style.overflowY;
            if ((overflowY === 'auto' || overflowY === 'scroll') && node.scrollHeight > node.clientHeight) {
                return node;
            }
            node = node.parentElement;
        }
        return null;
    },
    isTriggerVisible() {
        const trigger = this.$refs.trigger;
        if (!trigger) return false;
        const rect = trigger.getBoundingClientRect();
        const scrollParent = this.getScrollParent(trigger);
        if (scrollParent) {
            const parentRect = scrollParent.getBoundingClientRect();
            if (rect.bottom < parentRect.top || rect.top > parentRect.bottom) {
                return false;
            }
        }
        const vh = window.innerHeight;
        if (rect.bottom < 0 || rect.top > vh) {
            return false;
        }
        return true;
    },
    updatePosition() {
        const trigger = this.$refs.trigger;
        if (!trigger) return;
        const rect = trigger.getBoundingClientRect();
        const dropH = 340; 
        const gap = 8;
        const vh = window.innerHeight;

        let visibleTop = 0;
        let visibleBottom = vh;
        const scrollParent = this.getScrollParent(trigger);
        if (scrollParent) {
            const parentRect = scrollParent.getBoundingClientRect();
            visibleTop = Math.max(0, parentRect.top);
            visibleBottom = Math.min(vh, parentRect.bottom);
        }

        const spaceBelow = visibleBottom - rect.bottom;
        const spaceAbove = rect.top - visibleTop;

        if (spaceBelow >= dropH + gap) {
            this.dropUp = false;
        } else if (spaceAbove >= dropH + gap) {
            this.dropUp = true;
        } else {
            this.dropUp = spaceAbove > spaceBelow;
        }

        if (this.teleport) {
            const top = this.dropUp
                ? rect.top - dropH - gap
                : rect.bottom + gap;

            this.dropdownStyle = {
                position: 'fixed',
                top: `${Math.max(4, top)}px`,
                left: `${rect.left}px`,
                width: '18rem',
                zIndex: 99999
            };
        }
    },
    startTracking() {
        const track = () => {
            if (!this.open) return;
            if (!this.isTriggerVisible()) {
                this.open = false;
                return;
            }
            this.updatePosition();
            this.rafId = requestAnimationFrame(track);
        };
        track();
    },
    stopTracking() {
        if (this.rafId) {
            cancelAnimationFrame(this.rafId);
            this.rafId = null;
        }
    },
    init() {
        if (this.value) {
            const [year, month, day] = this.value.split('-');
            this.currentMonth = parseInt(month) - 1;
            this.currentYear = parseInt(year);
        }
        this.$watch('value', val => {
            if(val) {
                const [year, month, day] = val.split('-');
                this.currentMonth = parseInt(month) - 1;
                this.currentYear = parseInt(year);
            }
        });
        this.$watch('open', value => {
            if (value) {
                this.$nextTick(() => {
                    this.updatePosition();
                    this.startTracking();
                });
            } else {
                this.stopTracking();
            }
        });
        window.addEventListener('resize', () => { if (this.open) this.updatePosition(); });
    }
}" class="relative w-full" @click.outside="open = false">
    {{-- Input Field --}}
    <div class="relative cursor-pointer" x-ref="trigger" @click="open = !open">
        <input type="text" readonly x-model="value" placeholder="{{ $placeholder }}"
               class="w-full pl-10 pr-10 py-3 rounded-xl border appearance-none focus:outline-none transition-all text-sm font-medium cursor-pointer relative z-10 bg-transparent"
               :class="[
                    darkMode ? 'text-white' : 'text-slate-700',
               ]"
               :style="open ? 'border-color: var(--gradient-start); box-shadow: 0 0 0 2px color-mix(in srgb, var(--gradient-start) 50%, transparent);' : ''">
        <div class="absolute inset-0 rounded-xl" :class="darkMode ? 'bg-white/5 border border-white/10 hover:bg-white/10' : 'bg-slate-50 border border-slate-200 hover:bg-slate-100'"></div>

        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none z-20">
            <i class="bi bi-calendar-event text-slate-400"></i>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none z-20">
            <i class="bi bi-chevron-down text-slate-400 text-xs transition-transform" :class="open ? 'rotate-180' : ''"></i>
        </div>
    </div>

    {{-- Calendar Popup --}}
    <template x-teleport="body">
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute z-[99999] p-4 rounded-xl shadow-2xl overflow-hidden backdrop-blur-md w-72"
             :class="darkMode ? 'bg-[#1e293b]/90 border border-white/10' : 'bg-white/90 border border-slate-200'"
             :style="dropdownStyle"
             style="display: none;"
             @click.outside="open = false">
         
         <div class="flex items-center justify-between mb-4">
             <button type="button" @click="prevMonth" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-500/10 transition-colors">
                 <i class="bi bi-chevron-left text-sm" :class="darkMode ? 'text-slate-300' : 'text-slate-600'"></i>
             </button>
             <div class="text-sm font-bold" :class="darkMode ? 'text-white' : 'text-slate-800'">
                 <span x-text="months[currentMonth]"></span> <span x-text="currentYear"></span>
             </div>
             <button type="button" @click="nextMonth" class="w-8 h-8 flex items-center justify-center rounded-lg hover:bg-slate-500/10 transition-colors">
                 <i class="bi bi-chevron-right text-sm" :class="darkMode ? 'text-slate-300' : 'text-slate-600'"></i>
             </button>
         </div>

         <div class="grid grid-cols-7 gap-1 mb-2">
             <template x-for="day in days">
                 <div class="text-center text-[10px] uppercase font-bold text-slate-400" x-text="day"></div>
             </template>
         </div>

         <div class="grid grid-cols-7 gap-1">
             <template x-for="blank in blankDays">
                 <div class="aspect-square"></div>
             </template>
             <template x-for="date in noOfDays">
                 <button type="button" @click="selectDate(date)"
                         class="aspect-square flex items-center justify-center rounded-lg text-xs font-bold transition-all w-full relative overflow-hidden group"
                         :class="{
                             'text-white shadow-lg': isSelected(date),
                             'hover:bg-slate-500/10 text-slate-700': !isSelected(date) && !isToday(date) && !darkMode,
                             'hover:bg-slate-500/50 text-slate-300': !isSelected(date) && !isToday(date) && darkMode,
                         }"
                         :style="isSelected(date) 
                            ? 'background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));' 
                            : (!isSelected(date) && isToday(date) 
                                ? 'background-color: color-mix(in srgb, var(--gradient-start) 20%, transparent); color: var(--gradient-start);' 
                                : '')"
                         x-text="date">
                 </button>
             </template>
         </div>
         
         {{-- Action clear --}}
         <div class="mt-4 pt-3 border-t flex justify-end" :class="darkMode ? 'border-white/10' : 'border-slate-200'">
            <button type="button" @click="value = null; open = false;" class="text-xs font-bold transition-colors" :class="darkMode ? 'text-slate-400 hover:text-white' : 'text-slate-500 hover:text-slate-800'">
                Clear
            </button>
         </div>
    </div>
    </template>
</div>
