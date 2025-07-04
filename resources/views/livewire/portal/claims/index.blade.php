<div class="relative overflow-x-auto sm:rounded-lg">
    @include('components.alert.alert')
    <x-data-table>

        <x-slot:header>
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-zinc-500 dark:text-zinc-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search claims..." class="block w-full p-2 pl-10 text-sm border rounded-lg text-zinc-900 border-zinc-300 bg-zinc-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                    </div>
                </form>
            </div>
            <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                <flux:button variant="primary" :href="route('portal.claims.create')" size="sm">Create Claim</flux:button>
                <div class="flex items-center w-full space-x-3 md:w-auto">
                    <div>
                        <span class="hidden ml-2 text-sm text-zinc-700 sm:inline dark:text-zinc-300">show</span>
                        <select wire:model.live="perPage" id="per_page"
                            class="bg-white border sm border-zinc-300 focus:outline-none hover:bg-zinc-100 focus:ring-4 focus:ring-zinc-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-zinc-800 dark:text-white dark:border-zinc-600 dark:hover:bg-zinc-700 dark:hover:border-zinc-600 dark:focus:ring-zinc-700">
                            @foreach ([10, 15, 25, 50, 100] as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                        <span class="hidden ml-2 text-sm text-zinc-700 sm:inline dark:text-zinc-300">entries</span>
                    </div>
                    <flux:dropdown>
                        <flux:button icon:leading="filter" size="sm">Choose Status</flux:button>

                        <flux:menu>
                            <flux:menu.radio.group wire:model.live="statusFilter">
                                <flux:menu.radio value="">All</flux:menu.radio>
                                <flux:menu.radio value="submitted">Submitted</flux:menu.radio>
                                <flux:menu.radio value="pending">Pending</flux:menu.radio>
                                <flux:menu.radio value="approved">Approved</flux:menu.radio>
                                <flux:menu.radio value="rejected">Rejected</flux:menu.radio>
                                <flux:menu.radio value="unapproved">Unapproved</flux:menu.radio>
                            </flux:menu.radio.group>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </x-slot:header>
        <x-slot:head>
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Expense Date/Time</th>
                <th scope="col" class="px-6 py-3">Details</th>
                <th scope="col" class="px-6 py-3">Total Amount</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </x-slot:head>

            @forelse ($claims as $claim)
            <tr class="dark:border-zinc-600 hover:bg-zinc-100 dark:bg-zinc-800 dark:hover:bg-zinc-900">
                    <th scope="row" class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">{{$claim->id}}</th>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}
                    </td>
                    <td class="px-6 py-4">
                        @foreach ($claim->items as $item)
                            <p class="text-sm truncate text-zinc-500 dark:text-zinc-400">{{ $item->details }}</p>
                        @endforeach
                    </td>
                    <td class="px-6 py-4">
                        @php
                            $currencySymbols = [
                                'USD' => '$',
                                'PHP' => '₱',
                            ];
                            $symbol = $currencySymbols[$claim->currency] ?? $claim->currency;
                        @endphp
                        {{ $claim->currency }} | {{ $symbol }}{{ number_format($claim->total_amount, 2) }}
                    </td>
                    <td class="px-6 py-4">
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
                    <td class="flex gap-2 px-6 py-4">
                        <flux:modal.trigger name="delete-claim-{{ $claim->id }}">
                            <flux:button variant="danger" icon="trash"></flux:button>
                        </flux:modal.trigger>

                        <flux:modal name="delete-claim-{{ $claim->id }}" class="min-w-[22rem]">
                            <div class="space-y-6">
                                <div>
                                    <flux:heading size="lg">Archive Claim?</flux:heading>

                                    <flux:text class="mt-2">
                                        <p>You're about to archive this claim.</p>
                                        <p>You can restore it later if needed.</p>
                                    </flux:text>
                                </div>

                                <div class="flex gap-2">
                                    <flux:spacer />

                                    <flux:modal.close>
                                        <flux:button variant="ghost">Cancel</flux:button>
                                    </flux:modal.close>

                                    <form action="{{ route('portal.claims.destroy', $claim->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <flux:button type="submit" variant="danger">Archive</flux:button>
                                    </form>
                                </div>
                            </div>
                        </flux:modal>
                        <flux:tooltip content="View">
                            <flux:button variant="primary" href="{{ route('portal.claims.show', $claim->id)}}">View</flux:button>
                        </flux:tooltip>
                    </td>
                </tr>
                    @empty
                    <tr class=" dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-700">

                        <th colspan="6" class="px-4 py-3 font-medium text-center text-zinc-900 whitespace-nowrap dark:text-white">No data available</th>
                    </tr>
            @endforelse

        <x-slot:footer>
            <div>
                {{ $claims->links() }}
            </div>
        </x-slot:footer>
    </x-data-table>
</div>
