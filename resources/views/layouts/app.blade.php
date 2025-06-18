<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/404/404621.png" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />


    <title>@yield('title')</title>

    @livewireStyles
    @fluxAppearance

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @yield('styles')
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        @font-face {
            font-family: 'Monolisa';
            src: url('/fonts/MonoLisa-Regular.woff2') format('woff2'),
                url('/fonts/MonoLisa-Regular.woff') format('woff');
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: 'Monolisa';
            src: '/fonts/MonoLisa-Medium.woff2' format('woff2'),
                '/fonts/MonoLisa-Medium.woff' format('woff');
            font-weight: 500;
            font-style: normal;
        }
    </style>
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    @adminOrHr
        @include('layouts.admin-layouts.sidebar') <!--Admin-->

        @include('layouts.topbar')
        <flux:main class="p-3 sm:p-5">
            <div class="max-w-screen-xl p-0 mx-auto"> <!-- Removed px-4 lg:px-12 -->
                @yield('content')<!--Content of dashboard-->
            </div>
        </flux:main>
    @endadminOrHr

    @yield('scripts')
    @stack('scripts')
    @livewireScripts
    @fluxScripts

</body>

</html>
