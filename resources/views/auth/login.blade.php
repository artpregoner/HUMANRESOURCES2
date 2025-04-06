<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Login - HR 2</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- from libraries --}}
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @livewireStyles
    @fluxAppearance
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="icon" href="{{ asset('template/images/storelogo.png') }}" type="image/x-icon">
</head>

<body class="min-h-screen bg-white dark:bg-zinc-800">
    <flux:header container class="border-b bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="FAR EAST" class="max-lg:hidden dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="FAR EAST" class="max-lg:hidden! hidden dark:flex" />

        <flux:navbar class="-mb-px max-lg:hidden">
            <flux:navbar.item icon="home" :href="route('login')"
            :current="request()->routeIs('home') || request()->is('/')" wire:navigate>Home</flux:navbar.item>
            <flux:separator vertical variant="subtle" class="my-2"/>
        </flux:navbar>

        <flux:spacer />

        <flux:navbar class="mr-1">
            <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                <flux:radio value="light" icon="sun" />
                <flux:radio value="dark" icon="moon" />
            </flux:radio.group>
        </flux:navbar>

    </flux:header>

    <flux:sidebar stashable sticky class="border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
        <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

        <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Far East." class="px-2 dark:hidden" />
        <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Far East." class="hidden px-2 dark:flex" />

        <flux:navlist variant="outline">
            <flux:navlist.item icon="home" :href="route('login')"
            :current="request()->routeIs('home') || request()->is('/')" wire:navigate>Home</flux:navlist.item>

        </flux:navlist>


    </flux:sidebar>

    <flux:main container>
        <div class="flex items-center justify-center">
            <div class="w-full max-w-md overflow-hidden bg-white rounded-lg shadow-xl">
                <!-- Logo and heading -->
                <div class="p-6 bg-blue-600 sm:p-8">
                    <div class="flex justify-center mb-4">
                        <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zm0 14a6 6 0 110-12 6 6 0 010 12z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-center text-white">Sign in to your account</h2>
                </div>

                <!-- Form -->
                <div class="p-6 space-y-6 sm:p-8">
                    @livewire('auth.login')

                    <!-- Social logins -->
                    <div class="mt-6">
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 text-gray-500 bg-white">Or continue with</span>
                            </div>
                        </div>

                        <div class="grid grid-cols-3 gap-3 mt-6">
                            <button disabled type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                            </button>
                            <button disabled type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 4.42 2.865 8.166 6.839 9.489.5.092.682-.217.682-.482 0-.237-.008-.866-.013-1.7-2.782.605-3.369-1.343-3.369-1.343-.454-1.155-1.11-1.462-1.11-1.462-.908-.62.069-.608.069-.608 1.003.07 1.531 1.03 1.531 1.03.892 1.529 2.341 1.088 2.91.832.092-.647.35-1.088.636-1.338-2.22-.253-4.555-1.11-4.555-4.943 0-1.091.39-1.984 1.029-2.683-.103-.253-.446-1.27.098-2.647 0 0 .84-.268 2.75 1.026A9.564 9.564 0 0110 4.836c.85.004 1.705.114 2.504.336 1.909-1.294 2.747-1.026 2.747-1.026.546 1.377.203 2.394.1 2.647.64.699 1.028 1.592 1.028 2.683 0 3.842-2.339 4.687-4.566 4.934.359.309.678.92.678 1.855 0 1.338-.012 2.419-.012 2.747 0 .268.18.58.688.482A10.019 10.019 0 0020 10C20 4.477 15.523 0 10 0z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <button disabled type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 0C4.477 0 0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.879V12.89h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.989C16.343 19.129 20 14.99 20 10c0-5.523-4.477-10-10-10z" clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </flux:main>
    @fluxScripts
    @livewireScripts
</body>

</html>
