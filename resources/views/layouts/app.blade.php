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

    @if (Auth::check())
        @php
            $role = Auth::user()->role;
        @endphp
        @if ($role == 'hr')
            @include('layouts.hr2-layouts.sidebar') <!-- Sidebar for admin and HR-->
        @elseif ($role == 'admin')
            @include('layouts.admin-layouts.sidebar') <!--Admin-->
        @endif
        @include('layouts.topbar')
        <flux:main class="p-3 bg-gray-200 dark:bg-gray-900 sm:p-5">
            <div class="max-w-screen-xl p-0 mx-auto"> <!-- Removed px-4 lg:px-12 -->
                @yield('content')<!--Content of dashboard-->
            </div>
        </flux:main>
    @endif

    @yield('scripts')
    @stack('scripts')
    @livewireScripts
    @fluxScripts

</body>

</html>
