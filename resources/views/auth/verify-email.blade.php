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
                    <div class="flex space-x-4">
                        <flux:dropdown position="top" align="start" class="max-lg:hidden">
                            @if (Auth::user()->profile_photo_path)
                                <flux:profile
                                    avatar="{{ Auth::user()->profile_photo_url }}"
                                    name="{{ Auth::user()->name }}"
                                />
                            @else
                                <flux:profile
                                name="{{ Auth::user()->name }}" avatar:color="auto"/>
                            @endif

                            <flux:menu>
                                <flux:subheading>Signed in as</flux:subheading>
                                <flux:heading>{{  Auth::user()->email }}</flux:heading>
                                <flux:menu.separator />
                                <flux:menu.item icon="arrow-right-start-on-rectangle" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout
                                </flux:menu.item>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </flux:menu.seperator>
                        </flux:dropdown>
                    </div>

                    @if (session('message'))
                        <flux:callout variant="secondary" icon="information-circle" heading="{{ session('message') }}" />
                    @endif
                    <form class="mt-2 space-y-4" action="{{route ('verification.send')}}" method="post">
                        @csrf
                        @if (Auth::user()->hasVerifiedEmail())
                            <flux:callout variant="success" icon="check-circle" heading="Email Already Verified." />
                                @php
                                    $role = Auth::user()->role;
                                    $redirectRoute = match ($role){
                                        'admin', 'hr' => 'admin.index',
                                        'employee' => 'home',
                                        default => null,
                                    }
                                @endphp
                                @if ($redirectRoute)
                                    <flux:button
                                        type="button"
                                        variant="primary"
                                        color="zinc"
                                        :href="route($redirectRoute)">
                                        Dashboard
                                    </flux:button>
                                    @else
                                    <p class="text-red-500">Invalid user role. Please contact support.</p>
                                @endif
                        @else
                            <flux:callout variant="warning" icon="exclamation-circle" heading="Please check your email for a verification link." />
                            <flux:button type="submit" variant="primary" color="zinc">
                                Resend Verification Email
                            </flux:button>
                        @endif

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
