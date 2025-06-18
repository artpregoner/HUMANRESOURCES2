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

    <main class="bg-gray-50 dark:bg-gray-900">

        <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
            <a href="https://flowbite-admin-dashboard.vercel.app/" class="flex items-center justify-center mb-8 text-2xl font-semibold lg:mb-10 dark:text-white">
                <img src="https://flowbite-admin-dashboard.vercel.app/images/logo.svg" class="mr-4 h-11" alt="FlowBite Logo">
                <span>Human Resources</span>
            </a>
            <!-- Card -->
            <div class="w-full max-w-md bg-white rounded-lg shadow md:mt-0 xl:p-0 dark:bg-gray-800">
                <div class="w-full p-6 sm:p-8">
                    @if (session('message'))
                        <div class="alert alert-success">{{ session('message') }}</div>
                    @endif
                    <div class="flex space-x-4">
                        @if (Auth::user()->profile_photo_path)
                            <flux:profile
                                avatar="{{ Auth::user()->profile_photo_url }}"
                            />

                        @else
                            <flux:avatar
                                name="{{ Auth::user()->name }}"
                                initials:single
                            />
                        @endif
                        <h2 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Hi! {{Auth::user()->name}}</h2>
                    </div>
                    <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                        Please check your email for a verification link.
                    </p>
                    <form class="mt-8 space-y-6" action="{{route ('verification.send')}}" method="post">
                        @csrf
                        {{-- <div>
                            <label for="profile-lock" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PIN</label>
                            <input type="text" name="profile-lock" id="profile-lock" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="" required>
                        </div> --}}

                        <button type="submit" class="inline-flex items-center justify-center w-full px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                            Resend Verification Email
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </main>
    @yield('scripts')
    @stack('scripts')
    @livewireScripts
    @fluxScripts

</body>

</html>
