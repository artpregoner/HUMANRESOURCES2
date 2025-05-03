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

    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/404/404621.png" type="image/x-icon">
</head>

<body class="bg-gray-50 dark:bg-gray-900">
    <div class="flex flex-col min-h-screen md:flex-row">
        <!-- Left Section - Login Form -->
        <div class="flex items-center justify-center w-full px-6 py-8 md:w-1/2">
            <div class="w-full max-w-md">
                <a href="{{route('landingpage')}}" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                    <img class="w-8 h-8 mr-2" src="https://cdn-icons-png.flaticon.com/512/404/404621.png"
                        alt="logo">
                    FAR EAST
                </a>
                <div
                    class="w-full bg-white rounded-lg shadow dark:border sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                        <h1
                            class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            Sign in to your account
                        </h1>
                        @livewire('auth.login')
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                            </div>
                            <a href="{{route('landingpage')}}"
                                class="text-sm font-medium text-black-600 hover:underline dark:text-white-500">Homepage</a>
                        </div>
                        {{-- <div class="relative flex items-center justify-center">
                            <hr class="w-full h-px my-8 bg-gray-300 border-0 dark:bg-gray-700">
                            <span
                                class="absolute px-3 font-medium text-gray-900 -translate-x-1/2 bg-white left-1/2 dark:text-white dark:bg-gray-800">or</span>
                        </div>
                        <div class="flex space-x-4">
                            <button type="button"
                                class="flex-1 text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800 flex justify-center items-center">
                                <i class="mr-2 fab fa-facebook-f"></i> Facebook
                            </button>
                            <button type="button"
                                class="flex-1 text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-red-800 flex justify-center items-center">
                                <i class="mr-2 fab fa-google"></i> Google
                            </button>
                        </div> --}}
                        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
                            <flux:radio value="light" icon="sun">Light</flux:radio>
                            <flux:radio value="dark" icon="moon">Dark</flux:radio>
                            <flux:radio value="system" icon="computer-desktop">System</flux:radio>
                        </flux:radio.group>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Section - Security Content -->
        <div class="flex items-center justify-center w-full px-6 py-8 bg-blue-600 md:w-1/2">
            <div class="max-w-md p-6 text-white">
                <div class="mb-8">
                    <h2 class="mb-6 text-3xl font-bold">Secure Account Protection</h2>
                    <p class="mb-4 text-lg">Your security is our top priority. Our platform offers industry-leading
                        protection for your data and privacy.</p>
                </div>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="text-2xl text-white fas fa-shield-alt"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="mb-2 text-xl font-semibold">Advanced Encryption</h3>
                            <p>All your data is protected with end-to-end encryption keeping your information safe and
                                secure.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="text-2xl text-white fas fa-fingerprint"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="mb-2 text-xl font-semibold">Two-Factor Authentication</h3>
                            <p>Add an extra layer of security to your account with our 2FA options.</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <i class="text-2xl text-white fas fa-history"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="mb-2 text-xl font-semibold">Activity Monitoring</h3>
                            <p>Monitor all login attempts and receive alerts for any suspicious activity.</p>
                        </div>
                    </div>
                </div>

                <div class="flex items-center p-4 mt-8 bg-blue-700 rounded-lg">
                    <div class="flex-shrink-0">
                        <i class="text-2xl fas fa-info-circle"></i>
                    </div>
                    <p class="ml-4">Join over 10,000+ users who trust our platform for their personal and business
                        needs.</p>
                </div>
            </div>
        </div>
    </div>
    @fluxScripts
    @livewireScripts
</body>

</html>
