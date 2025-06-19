<div>
    <div class="grid grid-cols-2 grid-rows-2 gap-4 lg:grid-cols-4 lg:grid-rows-1">
        <div class="flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
            <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                <div class="z-10 flex items-center justify-center w-10 h-10 bg-blue-100 rounded-lg dark:bg-blue-900 shrink-0">
                    <flux:icon.ticket class="text-blue-900 dark:text-blue-100" />
                </div>
            </div>
            <div class="mr-4">
                <flux:heading size="xl" class="mb-1">{{ $this->totalTickets }}</flux:heading>
                <flux:text>Total tickets</flux:text>
            </div>
        </div>
        <div class="flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
            <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                <div class="z-10 flex items-center justify-center w-10 h-10 bg-yellow-100 rounded-lg dark:bg-yellow-900 shrink-0">
                    <flux:icon.hourglass class="text-yellow-900 dark:text-yellow-100" />
                </div>
            </div>
            <div class="mr-4">
                <flux:heading size="xl" class="mb-1">{{ $this->pendingTickets }}</flux:heading>
                <flux:text>Pending tickets</flux:text>
            </div>
        </div>
        <div class="flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
            <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                <div class="z-10 flex items-center justify-center w-10 h-10 bg-green-100 rounded-lg dark:bg-green-900 shrink-0">
                    <flux:icon.ticket-check class="text-green-900 dark:text-green-100" />
                </div>
            </div>
            <div class="mr-4">
                <flux:heading size="xl" class="mb-1">{{ $this->resolvedTickets }}</flux:heading>
                <flux:text>Solved tickets</flux:text>
            </div>
        </div>
        <a href="{{ route('admin.helpdesk.trash')}}">
            <div class="flex items-center p-3 mb-3.5 border border-gray-200 dark:border-gray-700 rounded-lg">
                <div class="flex items-center justify-center w-10 h-10 mr-3 rounded-lg bg-primary-100 dark:bg-primary-900">
                    <div class="z-10 flex items-center justify-center w-10 h-10 bg-red-100 rounded-lg dark:bg-red-900 shrink-0">
                        <flux:icon.trash class="text-red-900 dark:text-red-100" />
                    </div>
                </div>
                <div class="mr-4">
                    <flux:heading size="xl" class="mb-1">{{ $this->deletedTickets }}</flux:heading>
                    <flux:text>Deleted tickets</flux:text>
                </div>
            </div>
        </a>
    </div>
</div>
