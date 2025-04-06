<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        {{-- from libraries --}}
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600&display=swap" rel="stylesheet" />
        @livewireStyles
        @fluxAppearance
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen bg-white dark:bg-zinc-800">
        <flux:header container class="border-b bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.toggle class="lg:hidden" icon="bars-2" inset="left" />

            <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="max-lg:hidden dark:hidden" />
            <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="max-lg:hidden! hidden dark:flex" />

            <flux:navbar class="-mb-px max-lg:hidden">
                <flux:navbar.item icon="home" href="#" current>Home</flux:navbar.item>
                <flux:navbar.item icon="inbox" badge="12" href="#">Inbox</flux:navbar.item>
                <flux:navbar.item icon="document-text" href="#">Documents</flux:navbar.item>
                <flux:navbar.item icon="calendar" href="#">Calendar</flux:navbar.item>

                <flux:separator vertical variant="subtle" class="my-2"/>

                <flux:dropdown class="max-lg:hidden">
                    <flux:navbar.item icon-trailing="chevron-down">Favorites</flux:navbar.item>

                    <flux:navmenu>
                        <flux:navmenu.item href="#">Marketing site</flux:navmenu.item>
                        <flux:navmenu.item href="#">Android app</flux:navmenu.item>
                        <flux:navmenu.item href="#">Brand guidelines</flux:navmenu.item>
                    </flux:navmenu>
                </flux:dropdown>
            </flux:navbar>

            <flux:spacer />

            <flux:navbar class="mr-4">
                <flux:navbar.item icon="magnifying-glass" href="#" label="Search" />
                <flux:navbar.item class="max-lg:hidden" icon="cog-6-tooth" href="#" label="Settings" />
                <flux:navbar.item class="max-lg:hidden" icon="information-circle" href="#" label="Help" />
            </flux:navbar>

            <flux:dropdown position="top" align="start">
                <flux:profile avatar="https://fluxui.dev/img/demo/user.png" />

                <flux:menu>
                    <flux:menu.radio.group>
                        <flux:menu.radio checked>Olivia Martin</flux:menu.radio>
                        <flux:menu.radio>Truly Delta</flux:menu.radio>
                    </flux:menu.radio.group>

                    <flux:menu.separator />

                    <flux:menu.item icon="arrow-right-start-on-rectangle">Logout</flux:menu.item>
                </flux:menu>
            </flux:dropdown>
        </flux:header>

        <flux:sidebar stashable sticky class="border-r lg:hidden bg-zinc-50 dark:bg-zinc-900 border-zinc-200 dark:border-zinc-700">
            <flux:sidebar.toggle class="lg:hidden" icon="x-mark" />

            <flux:brand href="#" logo="https://fluxui.dev/img/demo/logo.png" name="Acme Inc." class="px-2 dark:hidden" />
            <flux:brand href="#" logo="https://fluxui.dev/img/demo/dark-mode-logo.png" name="Acme Inc." class="hidden px-2 dark:flex" />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="home" href="#" current>Home</flux:navlist.item>
                <flux:navlist.item icon="inbox" badge="12" href="#">Inbox</flux:navlist.item>
                <flux:navlist.item icon="document-text" href="#">Documents</flux:navlist.item>
                <flux:navlist.item icon="calendar" href="#">Calendar</flux:navlist.item>

                <flux:navlist.group expandable heading="Favorites" class="max-lg:hidden">
                    <flux:navlist.item href="#">Marketing site</flux:navlist.item>
                    <flux:navlist.item href="#">Android app</flux:navlist.item>
                    <flux:navlist.item href="#">Brand guidelines</flux:navlist.item>
                </flux:navlist.group>
            </flux:navlist>

            <flux:spacer />

            <flux:navlist variant="outline">
                <flux:navlist.item icon="cog-6-tooth" href="#">Settings</flux:navlist.item>
                <flux:navlist.item icon="information-circle" href="#">Help</flux:navlist.item>
            </flux:navlist>
        </flux:sidebar>

        <flux:main container>
            <section class="p-3 bg-gray-50 dark:bg-gray-900 sm:p-5">
                <div class="max-w-screen-xl px-4 mx-auto lg:px-12">
                    <!-- Start coding here -->
                    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                        <div class="flex flex-col items-center justify-between p-4 space-y-3 md:flex-row md:space-y-0 md:space-x-4">
                            <div class="w-full md:w-1/2">
                                <form class="flex items-center">
                                    <label for="simple-search" class="sr-only">Search</label>
                                    <div class="relative w-full">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                                            </svg>
                                        </div>
                                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search claims..." class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                                    </div>
                                </form>
                            </div>
                            <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                                <!-- <button type="button" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add product
                                </button> -->
                                <flux:button variant="primary" :href="route('portal.claims.create')">Create Claim</flux:button>
                                <div class="flex items-center w-full space-x-3 md:w-auto">
                                    <button id="actionsDropdownButton" data-dropdown-toggle="actionsDropdown" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                        <svg class="-ml-1 mr-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                        Actions
                                    </button>
                                    <div id="actionsDropdown" class="z-10 hidden bg-white divide-y divide-gray-100 rounded shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="actionsDropdownButton">
                                            <li>
                                                <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mass Edit</a>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">Delete all</a>
                                        </div>
                                    </div>
                                    <button id="filterDropdownButton" data-dropdown-toggle="filterDropdown" class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg md:w-auto focus:outline-none hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="w-4 h-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd" />
                                        </svg>
                                        Filter
                                        <svg class="-mr-1 ml-1.5 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                            <path clip-rule="evenodd" fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" />
                                        </svg>
                                    </button>
                                    <div id="filterDropdown" class="z-10 hidden w-48 p-3 bg-white rounded-lg shadow dark:bg-gray-700">
                                        <h6 class="mb-3 text-sm font-medium text-gray-900 dark:text-white">Choose status</h6>
                                        <ul class="space-y-2 text-sm" aria-labelledby="filterDropdownButton">
                                            <li class="flex items-center">
                                                <input id="all" wire:model.live="statusFilter" type="checkbox" value="" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="all" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">All</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="submitted" wire:model.live="statusFilter" type="checkbox" value="submitted" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="submitted" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Submitted</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="pending" wire:model.live="statusFilter" type="checkbox" value="pending" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="pending" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Pending</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="razor" wire:model.live="statusFilter" type="checkbox" value="approved" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="razor" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Approved</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="nikon" wire:model.live="statusFilter" type="checkbox" value="rejected" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="nikon" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Rejected</label>
                                            </li>
                                            <li class="flex items-center">
                                                <input id="benq" wire:model.live="statusFilter" type="checkbox" value="unapproved" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-primary-600 focus:ring-primary-500 dark:focus:ring-primary-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                                <label for="benq" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-100">Unapproved</label>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Expense Date/Time</th>
                                        <th scope="col" class="px-4 py-3">Details</th>
                                        <th scope="col" class="px-4 py-3">Total Amount</th>
                                        <th scope="col" class="px-4 py-3">Status</th>
                                        <th scope="col" class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($claims as claim)
                                        <tr class="border-b dark:border-gray-700">
                                            <th scope="row" class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}</th>
                                            <td class="px-4 py-3">
                                                @foreach ($claim->items as $item)
                                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $item->details }}</p>
                                                @endforeach
                                            </td>
                                            <td class="px-4 py-3">
                                                @php
                                                    $currencySymbols = [
                                                        'USD' => '$',
                                                        'PHP' => '₱',
                                                    ];
                                                    $symbol = $currencySymbols[$claim->currency] ?? $claim->currency;
                                                @endphp
                                                {{ $claim->currency }} | {{ $symbol }}{{ number_format($claim->total_amount, 2) }}
                                            </td>
                                            <td class="px-4 py-3">
                                                @if ($claim->status == 'approved')
                                                    <flux:badge variant="solid" color="green">Approved</flux:badge>
                                                @elseif ($claim->status == 'pending')
                                                    <flux:badge variant="solid" color="sky">Pending</flux:badge>
                                                @elseif ($claim->status == 'submitted')
                                                    <flux:badge variant="solid" color="zinc">Submitted</flux:badge>
                                                @elseif ($claim->status == 'unapproved')
                                                    <flux:badge variant="solid" color="yellow">Unapproved</flux:badge>
                                                @elseif ($claim->status == 'rejected')
                                                    <flux:badge variant="solid" color="red">Rejected</flux:badge>
                                                @endif
                                            </td>
                                            <td class="px-4 py-3">
                                                <flux:button.group>
                                                    <flux:tooltip content="Archive this claim">
                                                        <flux:button wire:click="destroyClaim({{ $claim->id }})" wire:confirm="Are you sure you want to archive this claim?" variant="danger">Archive</flux:button>
                                                    </flux:tooltip>
                                                    <flux:tooltip content="View">
                                                        <flux:button variant="primary" href="{{ route('portal.claims.show', $claim->id)}}">View</flux:button>
                                                    </flux:tooltip>
                                                </flux:button.group>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
            <flux:heading size="xl" level="1">Good afternoon, Olivia</flux:heading>

            <flux:subheading size="lg" class="mb-6">Here's what's new today</flux:subheading>

            <flux:separator variant="subtle" />
        </flux:main>

        @fluxScripts
    </body>
</html>
