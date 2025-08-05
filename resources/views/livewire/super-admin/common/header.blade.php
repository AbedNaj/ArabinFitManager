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
                    <div class="relative">
                        <input type="text" :placeholder="isRTL ? 'بحث...' : 'Search...'"
                            class="pl-10 pr-4 py-2 rounded-lg bg-surface border border-border focus:border-primary focus:outline-none w-64">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 text-secondary absolute left-3 top-2.5 search-icon" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <button @click="darkMode = !darkMode" class="text-secondary hover:text-text">
                        <svg x-show="!darkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                        </svg>
                        <svg x-show="darkMode" xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </button>

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
