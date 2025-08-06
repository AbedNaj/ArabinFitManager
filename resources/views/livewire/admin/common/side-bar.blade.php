    <aside
        class="sidebar-transition flex flex-col bg-bg border-r border-border md:static absolute inset-y-0 left-0 transform md:translate-x-0 z-30"
        :class="isRTL ? { 'translate-x-0': mobileSidebarOpen, 'translate-x-full': !mobileSidebarOpen } :
        { 'translate-x-0': mobileSidebarOpen, '-translate-x-full': !mobileSidebarOpen }"
        :style="isRTL ? 'right: 0; left: auto; border-left: 1px solid var(--color-border); border-right: none;' : ''">
        <div class="flex items-center justify-between p-4 border-b border-border">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path
                            d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-primary" x-text="isRTL ? 'لوحة التحكم' : 'Dashboard'"></span>
            </div>
            <button @click="mobileSidebarOpen = false" class="md:hidden text-secondary hover:text-accent">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="flex-1 overflow-y-auto scrollbar-hide p-4">
            <nav class="space-y-1">


            </nav>


        </div>

        <div class="p-4 border-t border-border">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                        <span class="font-medium" x-text="isRTL ? 'م.ع' : 'JD'"></span>
                    </div>
                    <div>
                        <p class="text-sm font-medium" x-text="isRTL ? 'محمد أحمد' : 'John Doe'"></p>
                        <p class="text-xs text-secondary" x-text="isRTL ? 'مدير النظام' : 'Administrator'"></p>
                    </div>
                </div>
                <button class="text-secondary hover:text-text">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>
    </aside>
