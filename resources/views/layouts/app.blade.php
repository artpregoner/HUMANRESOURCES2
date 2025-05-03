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
    {{-- @fluxAppearance --}}
    <script>
        // On page load, check and set the theme based on localStorage or system preference
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    @yield('styles')
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">

    @adminOrHr
        @include('layouts.admin-layouts.sidebar') <!--Admin-->

        @include('layouts.topbar')
        <flux:main class="p-3 bg-gray-200 dark:bg-gray-900 sm:p-5">
            <div class="max-w-screen-xl p-0 mx-auto"> <!-- Removed px-4 lg:px-12 -->
                @yield('content')<!--Content of dashboard-->
            </div>
        </flux:main>
    @endadminOrHr

    @yield('scripts')
    @stack('scripts')
    @livewireScripts
    @fluxScripts

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('themeToggle', () => ({
                // Get the current theme from localStorage or fallback to system preference
                isDark: localStorage.getItem('color-theme') === 'dark' ||
                        (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches),

                init() {
                    // Apply the theme on page load
                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                },

                toggleTheme() {
                    // Toggle the dark mode state
                    this.isDark = !this.isDark;

                    if (this.isDark) {
                        document.documentElement.classList.add('dark');
                        localStorage.setItem('color-theme', 'dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                        localStorage.setItem('color-theme', 'light');
                    }
                }
            }));
        });
    </script>

    <!-- Initialize Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>

</body>

</html>
