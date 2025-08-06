<!DOCTYPE html>
<html lang="ar" dir="rtl" data-theme="light"
    class=" h-full bg-[--color-bg] text-[--color-text] dark:bg-[--color-bg-dark] dark:text-[--color-text-dark]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول – ArabianFit Manager</title>

    <wireui:scripts />


    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full flex items-center justify-center">

    <div class="w-full max-w-md bg-[--color-surface] p-8 rounded-lg shadow-lg border border-[--color-border]">
        <h1 class="text-2xl font-bold text-center mb-6 text-[--color-primary]">{{ __('login.login') }} </h1>

        @if (session('error'))
            <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}" class="space-y-5">
            @csrf

            <div>
                <x-input type="email" label="{{ __('login.email') }}" name="email" />

            </div>

            <div>

                <x-password label="{{ __('login.password') }}" name="password" />


            </div>


            <div class="flex items-center justify-between text-sm">



            </div>

            <x-button type="submit" label="{{ __('login.login') }}" />

        </form>

    </div>
    @livewireScripts


</body>

</html>
