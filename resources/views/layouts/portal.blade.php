<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/404/404621.png" type="image/x-icon">
    <title>@yield('title')</title>

    @livewireStyles
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @fluxAppearance
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @yield('styles')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    @adminOrHrOremployee
        @include('layouts.portal-layouts.sidebar')
        @include('layouts.topbar')
        <flux:main class="p-3 bg-gray-200 dark:bg-gray-900 sm:p-5">
            @yield('content')<!--Content of dashboard-->
        </flux:main>
    @endadminOrHrOremployee

    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
    @yield('scripts')
    @stack('scripts')
    @livewireScripts
    @fluxScripts
</body>

</html>
