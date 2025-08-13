<!DOCTYPE html>
<html lang="{{ App::currentLocale() }}" dir="rtl" x-data="{
    darkMode: localStorage.getItem('darkMode') === 'true',
    sidebarOpen: window.innerWidth > 768,
    mobileSidebarOpen: false,
    isRTL: false
}" x-init="$watch('darkMode', value => localStorage.setItem('darkMode', value));
isRTL = document.documentElement.getAttribute('dir') === 'rtl';"
    :class="{ 'dark': darkMode }" class="[unicode-bidi:plaintext]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard - admin')</title>


    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        bg: 'var(--color-bg)',
                        primary: 'var(--color-primary)',
                        secondary: 'var(--color-secondary)',
                        text: 'var(--color-text)',
                        accent: 'var(--color-accent)',
                        surface: 'var(--color-surface)',
                        border: 'var(--color-border)',
                    },
                    fontFamily: {
                        'sans': ['Tajawal', 'ui-sans-serif', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style type="text/css">
        :root {
            --color-bg: #ffffff;
            --color-primary: #4f46e5;
            --color-secondary: #64748b;
            --color-text: #1e293b;
            --color-accent: #f97316;
            --color-surface: #f1f5f9;
            --color-border: #e2e8f0;
        }

        .dark {
            --color-bg: #0f172a;
            --color-primary: #818cf8;
            --color-secondary: #cbd5e1;
            --color-text: #f1f5f9;
            --color-accent: #fb923c;
            --color-surface: #1e293b;
            --color-border: #334155;
        }

        .sidebar-transition {
            transition: all 0.3s ease;
        }

        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        [dir="rtl"] .sidebar-icon {
            margin-right: 0;
            margin-left: 0.75rem;
        }

        [dir="rtl"] .search-icon {
            left: auto;
            right: 0.75rem;
        }

        [dir="rtl"] .border-r {
            border-right: none;
            border-left: 1px solid var(--color-border);
        }

        [dir="rtl"] .border-l {
            border-left: none;
            border-right: 1px solid var(--color-border);
        }

        [dir="rtl"] .ml-2 {
            margin-left: 0;
            margin-right: 0.5rem;
        }

        [dir="rtl"] .mr-2 {
            margin-right: 0;
            margin-left: 0.5rem;
        }

        [dir="rtl"] .pl-10 {
            padding-left: 0;
            padding-right: 2.5rem;
        }

        [dir="rtl"] .text-left {
            text-align: right;
        }

        [dir="rtl"] .text-right {
            text-align: left;
        }
    </style>
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-surface text-text font-sans flex h-screen overflow-hidden">

    @livewire('admin.common.side-bar')

    <div class="flex-1 flex flex-col overflow-hidden">

        @livewire('super-admin.common.header')

        <main class="flex-1 overflow-y-auto p-4 bg-surface">

            @yield('content')

        </main>
        <div class="space-y-4">
            @if (session('success'))
                <x-alert title="{{ session('success') }}" positive />
            @endif

            @if (session('warning'))
                <x-alert title="{{ session('warning') }}" warning />
            @endif

            @if (session('error'))
                <x-alert title="{{ session('error') }}" negative />
            @endif
        </div>
    </div>




    @livewireScripts
</body>

</html>
