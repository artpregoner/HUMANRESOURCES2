<div class="relative overflow-x-auto sm:rounded-lg">
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
                <div class="flex items-center w-full space-x-3 md:w-auto">
                    <div>
                        <span class="hidden ml-2 text-sm text-gray-700 sm:inline dark:text-gray-300">show</span>
                        <select wire:model.live="perPage" id="per_page"
                            class="bg-white border sm border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-3 py-1.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                            @foreach ([10, 15, 25, 50, 100] as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                        <span class="hidden ml-2 text-sm text-gray-700 sm:inline dark:text-gray-300">entries</span>
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
        </div>
        <!-- Loading State - Show when searching or changing per page -->
        <div wire:loading.block wire:target="perPage, statusFilter">
            <div role="status" class="max-w-full p-4 space-y-4 border border-gray-300 divide-y divide-gray-300 rounded-sm shadow-sm animate-pulse dark:divide-gray-700 md:p-6 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div>
                        <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-900 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-800"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-900 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-800"></div>
                    </div>
                    <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-900 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-800"></div>
                    </div>
                    <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-900 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-800"></div>
                    </div>
                    <div class="h-2.5 bg-gray-300 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-900 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-800"></div>
                    </div>
                    <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-900 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-800"></div>
                    </div>
                    <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-900 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-800"></div>
                    </div>
                    <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
                <div class="flex items-center justify-between pt-4">
                    <div>
                        <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-900 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 bg-gray-200 rounded-full dark:bg-gray-800"></div>
                    </div>
                    <div class="h-2.5 bg-gray-500 rounded-full dark:bg-gray-700 w-12"></div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto" wire:loading.remove wire:target="perPage, statusFilter">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">ID</th>
                        <th scope="col" class="px-6 py-3">Expense Date</th>
                        <th scope="col" class="px-6 py-3">Submitted By</th>
                        <th scope="col" class="px-6 py-3">Deleted By</th>
                        <th scope="col" class="px-6 py-3">Deleted Comments</th>
                        <th scope="col" class="px-6 py-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($claims as $claim)
                        <tr class=" dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$claim->id}}
                            </th>
                            <td class="px-6 py-4">
                                {{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">{{ $claim->submittedBy->name }}</p>
                            </td>
                            <td class="px-6 py-4">
                                @if ($claim->deleted_by)
                                    @php
                                        $deletedUser = \App\Models\User::find($claim->deleted_by);
                                    @endphp

                                    @if ($deletedUser)
                                        @if ($deletedUser->id === Auth::id())
                                            You
                                        @else
                                            {{ $deletedUser->name }}
                                            @if ($deletedUser->role === 'hr')
                                                (HR)
                                            @elseif ($deletedUser->role === 'admin')
                                                (Admin)
                                            @else
                                                (Unknown Role)
                                            @endif
                                        @endif
                                    @else
                                        Unknown User
                                    @endif
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                {{ $claim->delete_comments ?? 'No comments' }}
                            </td>
                            <td class="flex gap-2 px-6 py-4">
                                <flux:modal.trigger name="delete-claim-{{ $claim->id }}">
                                    <flux:button variant="danger" icon="trash"></flux:button>
                                </flux:modal.trigger>

                                <flux:modal.trigger name="restore-claim-{{ $claim->id }}">
                                    <flux:button variant="primary">Restore</flux:button>
                                </flux:modal.trigger>

                                <flux:modal name="delete-claim-{{ $claim->id }}" class="min-w-[22rem]">
                                    <div class="space-y-6">
                                        <div>
                                            <flux:heading size="lg">Delete Claim?</flux:heading>

                                            <flux:text class="mt-2">
                                                <p>You're about to permanently delete this claim.</p>
                                                <p>This action cannot be undone.</p>
                                            </flux:text>
                                        </div>

                                        <div class="flex gap-2">
                                            <flux:spacer />

                                            <flux:modal.close>
                                                <flux:button variant="ghost">Cancel</flux:button>
                                            </flux:modal.close>

                                            <form action="{{ route('portal.claims.forceDelete', $claim->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <flux:button type="submit" variant="danger">Delete Claim</flux:button>
                                            </form>
                                        </div>
                                    </div>
                                </flux:modal>

                                <flux:modal name="restore-claim-{{ $claim->id }}" class="min-w-[22rem]">
                                    <div class="space-y-6">
                                        <div>
                                            <flux:heading size="lg">Restore Claim?</flux:heading>

                                            <flux:text class="mt-2">
                                                <p>You're about to restore this claim.</p>
                                                <p>This action will reactivate the claim.</p>
                                            </flux:text>
                                        </div>

                                        <div class="flex gap-2">
                                            <flux:spacer />

                                            <flux:modal.close>
                                                <flux:button variant="ghost">Cancel</flux:button>
                                            </flux:modal.close>

                                            <form action="{{ route('portal.claims.restore', $claim->id) }}" method="POST">
                                                @csrf
                                                <flux:button type="submit" variant="primary" onclick="\$dispatch('close-modal', 'restore-claim-{{ $claim->id }}')">Restore Claim</flux:button>
                                            </form>
                                        </div>
                                    </div>
                                </flux:modal>
                            </td>
                        </tr>
                        @empty
                        <tr class=" dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700">
                            <th colspan="6" class="px-4 py-3 font-medium text-center text-gray-900 whitespace-nowrap dark:text-white">No data available</th>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            {{ $claims->links() }}
        </div>
    </div>
</div>
