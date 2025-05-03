<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Homepage</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    {{-- from libraries --}}
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
    @livewireStyles
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

    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/404/404621.png" type="image/x-icon">
</head>

<body class="bg-gray-50">
    <!-- Navigation -->
    <header>
        <nav class="px-4 py-4 bg-white border-gray-200 lg:px-6 dark:bg-gray-800">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl mx-auto">
                <a href="{{route('landingpage')}}" class="flex items-center">
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">FAR EAST</span>
                </a>
                <div class="flex items-center lg:order-2">
                    @if (Route::has('login'))
                        @auth
                            @php
                                $role = Auth::user()->role;
                                $redirectRoute = match ($role){
                                    'admin', 'hr' => 'admin.index',
                                    'employee' => 'home',
                                    default => null,
                                }
                            @endphp
                            <a href="{{route($redirectRoute)}}"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                                Dashboard</a>
                            @else
                                <a href="{{route('login')}}" type="button" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Login</a>
                        @endauth
                    @endif
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="bg-white dark:bg-gray-900">
        <div class="grid max-w-screen-xl px-4 py-8 mx-auto lg:gap-8 xl:gap-0 lg:py-16 lg:grid-cols-12">
            <div class="mr-auto place-self-center lg:col-span-7">
                <h1 class="max-w-2xl mb-4 text-4xl font-extrabold leading-none tracking-tight md:text-5xl xl:text-6xl dark:text-white">
                    Human Resouces</h1>
                <p class="max-w-2xl mb-6 font-light text-gray-500 lg:mb-8 md:text-lg lg:text-xl dark:text-gray-400">
                    Our integrated workforce analytics platform offers specialized submodules to streamline various HR and operational processes. Track employee performance, measure productivity, analyze engagement, and optimize team collaboration—all while driving efficiency and growth within your organization.</p>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 mr-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 dark:focus:ring-blue-900">
                    Get started
                </a>
                <a href="#"
                    class="inline-flex items-center justify-center px-5 py-3 text-base font-medium text-center text-gray-900 border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 dark:text-white dark:border-gray-700 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                    Learn more
                </a>
            </div>
            <div class="hidden lg:mt-0 lg:col-span-5 lg:flex">
                <img src="https://cdn-icons-png.flaticon.com/512/404/404621.png" alt="mockup" class="rounded-lg">
            </div>
        </div>
    </section>



    <!-- Submodules Section -->
    <section class="py-16 bg-gray-50 dark:bg-gray-800">
        <div class="max-w-screen-xl px-4 mx-auto">
            <h2 class="mb-12 text-3xl font-extrabold text-center text-gray-900 dark:text-white">Our Key Modules</h2>
            <div class="grid grid-cols-1 gap-8 md:grid-cols-2 lg:grid-cols-3">

                <!-- Helpdesk -->
                <div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-700">
                    <img src="https://cdn-icons-png.flaticon.com/512/7928/7928625.png" alt="HR helpdesk" class="object-cover w-full h-48">
                    <div class="p-6">
                        <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">HR Helpdesk</h3>
                        <p class="text-gray-500 dark:text-gray-400">Streamline HR processes by managing employee inquiries, tracking requests, and providing timely support. Our HR helpdesk solution improves communication and ensures that employee needs are addressed efficiently.</p>
                        <a href="#"
                            class="inline-block mt-4 text-blue-700 dark:text-blue-400 hover:underline">Learn more</a>
                    </div>
                </div>


                <!-- Claims & Reimbursement -->
                <div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-700">
                    <img src="https://t3.ftcdn.net/jpg/05/02/99/26/360_F_502992616_pVwetHOHZEoYgNYiT66lshNx9HbprZuX.jpg" alt="claims and reimbursement" class="object-cover w-full h-48">
                    <div class="p-6">
                        <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Claims & Reimbursement</h3>
                        <p class="text-gray-500 dark:text-gray-400">Simplify and automate the claims and reimbursement process for your employees. Our platform ensures efficient claims submission, approval workflows, and quick reimbursements, improving accuracy and reducing administrative overhead.</p>
                        <a href="#"
                            class="inline-block mt-4 text-blue-700 dark:text-blue-400 hover:underline">Learn more</a>
                    </div>
                </div>


                <!-- Workforce Analytics -->
                <div class="overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-700">
                    <img src="https://cdn-icons-png.flaticon.com/512/404/404621.png" alt="workforce analytics" class="object-cover w-full h-48">
                    <div class="p-6">
                        <h3 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Workforce Analytics</h3>
                        <p class="text-gray-500 dark:text-gray-400">Gain valuable insights into your small company's workforce. Track employee performance, optimize resource allocation, and make data-driven decisions to enhance productivity and growth.</p>
                        <a href="#"
                            class="inline-block mt-4 text-blue-700 dark:text-blue-400 hover:underline">Learn more</a>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Features Section -->
    <!-- Existing content remains unchanged here -->

    <!-- Footer -->
    <footer class="py-6 bg-white dark:bg-gray-900">
        <div class="max-w-screen-xl px-4 mx-auto text-center">
            <p class="text-gray-500 dark:text-gray-400">© 2025 FAR EAST. All rights reserved.</p>
        </div>
    </footer>
    @fluxScripts
    @livewireScripts
</body>

</html>
