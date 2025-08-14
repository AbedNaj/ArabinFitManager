        <header class="bg-bg border-b border-border">
            <div class="flex items-center justify-between px-4 py-3">
                <div class="flex items-center">
                    <button @click="mobileSidebarOpen = true" class="md:hidden text-secondary hover:text-text mr-2"
                        :class="{ 'ml-2 mr-0': isRTL }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <button @click="sidebarOpen = !sidebarOpen"
                        class="hidden md:block text-secondary hover:text-text mr-4" :class="{ 'ml-4 mr-0': isRTL }">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                </div>

                <div class="flex items-center space-x-4">


                    <button class="text-secondary hover:text-text relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span class="absolute top-0 right-0 w-2 h-2 bg-accent rounded-full"
                            :class="{ 'right-auto left-0': isRTL }"></span>
                    </button>

                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary">
                        <span class="font-medium" x-text="isRTL ? 'م.ع' : 'JD'"></span>
                    </div>
                </div>
            </div>
        </header>
