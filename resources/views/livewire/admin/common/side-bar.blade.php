<aside
    class="sidebar-transition flex flex-col bg-bg border-r border-border md:static absolute inset-y-0 left-0 transform md:translate-x-0 z-30"
    :class="isRTL ? { 'translate-x-0': mobileSidebarOpen, 'translate-x-full': !mobileSidebarOpen } :
    { 'translate-x-0': mobileSidebarOpen, '-translate-x-full': !mobileSidebarOpen }"
    :style="isRTL ? 'right: 0; left: auto; border-left: 1px solid var(--color-border); border-right: none;' : ''">
    <div class="flex items-center justify-between p-4 border-b border-border">
        <div class="flex items-center space-x-2">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20" fill="currentColor">
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
            <x-superAdmin.navButton :href="route('admin.dashboard')" :icon="view('components.icons.home')" :text="__('sidebar.admin.dashboard')" :isActive="Request()->routeIs('admin.dashboard*')" />

            <x-superAdmin.navButton :href="route('admin.customers.index')" :icon="view('components.icons.customers')" :text="__('sidebar.admin.customers')" :isActive="Request()->routeIs('admin.customers*')" />
            <x-superAdmin.navButton :href="route('admin.registrations.index')" :icon="view('components.icons.registration')" :text="__('sidebar.admin.registration')" :isActive="Request()->routeIs('admin.registrations*')" />
            <x-superAdmin.navButton :href="route('admin.debts.index')" :icon="view('components.icons.debt')" :text="__('sidebar.admin.debt')" :isActive="Request()->routeIs('admin.debts*')" />


            <x-superAdmin.navButton :href="route('admin.plans.index')" :icon="view('components.icons.plan')" :text="__('sidebar.admin.plan')" :isActive="Request()->routeIs('admin.plans*')" />

        </nav>


    </div>

    <div class="p-4 border-t border-border" x-data="{ open: false }" @keydown.escape.window="open=false">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-3 rtl:space-x-reverse">
                <div class="w-9 h-9 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                    <span class="font-medium" x-text="isRTL ? 'م.ع' : 'JD'"></span>
                </div>
                <div>
                    <p class="text-sm font-medium">{{ $name }}</p>
                    <p class="text-xs text-secondary">{{ $owner_name }}</p>
                </div>
            </div>


            <div class="relative">
                <button type="button"
                    class="text-secondary hover:text-text focus:outline-none focus:ring-2 focus:ring-primary rounded-md p-1"
                    @click="open = !open" :aria-expanded="open.toString()" aria-haspopup="true">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm0 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                </button>


                <div x-cloak x-show="open" @click.outside="open=false"
                    x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0 translate-y-1"
                    x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-100"
                    x-transition:leave-start="opacity-100 translate-y-0"
                    x-transition:leave-end="opacity-0 translate-y-1"
                    class="absolute z-50 bottom-full mb-2 min-w-44 rounded-md border border-border bg-surface shadow-lg focus:outline-none"
                    role="menu" tabindex="-1">

                    <div x-cloak class="py-1">
                        <a href="" class="block px-3 py-2 text-sm hover:bg-surface/60" role="menuitem"
                            tabindex="-1">
                            {{ __('sidebar.admin.settings') }}
                        </a>


                        <a href="" class="block px-3 py-2 text-sm hover:bg-surface/60" role="menuitem"
                            tabindex="-1">
                            {{ __('sidebar.admin.logout') }}
                        </a>

                    </div>
                </div>
            </div>
        </div>
    </div>

</aside>
