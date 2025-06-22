
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
                        <input type="text" wire:model.live.debounce.500ms="search" placeholder="Search tickets..." class="block w-full p-2 pl-10 text-sm border rounded-lg text-zinc-900 border-zinc-300 bg-zinc-50 focus:ring-primary-500 focus:border-primary-500 dark:bg-zinc-700 dark:border-zinc-600 dark:placeholder-zinc-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search" required="">
                    </div>
                </form>
            </div>
            <div class="flex flex-col items-stretch justify-end flex-shrink-0 w-full space-y-2 md:w-auto md:flex-row md:space-y-0 md:items-center md:space-x-3">
                <flux:button variant="primary" size="sm" :href="route('portal.helpdesk.create')">Create Ticket</flux:button>
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
                                <flux:menu.radio value="open">Open</flux:menu.radio>
                                <flux:menu.radio value="in_progress">In Progress</flux:menu.radio>
                                <flux:menu.radio value="resolved">Resolved</flux:menu.radio>
                                <flux:menu.radio value="closed">Closed</flux:menu.radio>
                            </flux:menu.radio.group>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>
        </x-slot:header>
        <x-slot:head>
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Subject</th>
                <th scope="col" class="px-6 py-3">Created at</th>
                <th scope="col" class="px-6 py-3">Updated at</th>
                <th scope="col" class="px-6 py-3">Status</th>
                <th scope="col" class="px-6 py-3">Actions</th>
            </tr>
        </x-slot:head>
                @forelse ($tickets as $ticket)
                    <tr class="dark:border-zinc-600 hover:bg-zinc-100 dark:hover:bg-zinc-700">
                        <th scope="row" class="px-6 py-4 font-medium text-zinc-900 whitespace-nowrap dark:text-white">
                            {{$ticket->id}}
                        </th>
                        <td class="px-6 py-4">
                            {{ Str::limit($ticket->title, 50, '...') }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $ticket->created_at->format('Y/m/d') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($ticket->responses->isNotEmpty())
                                {{ $ticket->responses->first()->created_at->format('d/m/Y H:i') }}
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <flux:badge variant="solid" color="{{ $ticket->status == 'open' ? 'purple' : ($ticket->status == 'in_progress' ? 'yellow' : ($ticket->status == 'resolved' ? 'green' : 'pink')) }}">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </flux:badge>
                        </td>
                        <td class="flex gap-2 px-6 py-4">
                            <flux:modal.trigger name="delete-claim-{{ $ticket->id }}">
                                <flux:button variant="danger" icon="trash"></flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-claim-{{ $ticket->id }}" class="min-w-[22rem]">
                                <div class="space-y-6">
                                    <div>
                                        <flux:heading size="lg">Archive Ticket?</flux:heading>

                                        <flux:text class="mt-2">
                                            <p>You're about to archive this ticket.</p>
                                            <p>You can restore it later if needed.</p>
                                        </flux:text>
                                    </div>

                                    <div class="flex gap-2">
                                        <flux:spacer />

                                        <flux:modal.close>
                                            <flux:button variant="ghost">Cancel</flux:button>
                                        </flux:modal.close>
                                        <form action="{{ route('portal.helpdesk.destroy', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <flux:button type="submit" variant="danger" onclick="\$dispatch('close-modal', 'delete-claim-{{ $ticket->id }}')">Archive</flux:button>
                                        </form>
                                    </div>
                                </div>
                            </flux:modal>
                            <flux:tooltip content="Response">
                                <flux:button variant="primary" href="{{ route('portal.helpdesk.show', $ticket->id) }}">Response</flux:button>
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
                {{ $tickets->links() }}
            </div>
        </x-slot:footer>
    </x-data-table>

</div>
