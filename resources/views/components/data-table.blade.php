<!-- resources/views/components/data-table.blade.php -->
<div class="relative overflow-x-auto sm:rounded-lg">
    <div class="relative overflow-hidden bg-white border shadow-md dark:bg-zinc-800 sm:rounded-lg border-zinc-200 dark:border-zinc-900">
        <!-- Header Slot: For search, filters, and action buttons -->
        @if (isset($header))
            <div class="flex flex-col items-center justify-between p-4 space-y-3 border-b md:flex-row md:space-y-0 md:space-x-4 border-zinc-200 bg-zinc-100 dark:bg-zinc-900 dark:border-zinc-900">
                {{ $header }}
            </div>
        @endif

        <!-- Loading State -->
        <div wire:loading.block wire:target="perPage, search, statusFilter">
            <div role="status" class="w-full p-4 space-y-4 border divide-y rounded-sm shadow-sm border-zinc-300 divide-zinc-300 animate-pulse dark:divide-zinc-700 md:p-6 dark:border-zinc-700">
                @for ($i = 0; $i < 5; $i++)
                <div class="flex items-center justify-between {{ $i > 0 ? 'pt-4' : '' }}">
                    <div>
                        <div class="h-2.5 bg-zinc-300 rounded-full dark:bg-zinc-600 w-24 mb-2.5"></div>
                        <div class="w-32 h-2 rounded-full bg-zinc-200 dark:bg-zinc-700"></div>
                    </div>
                    <div class="h-2.5 bg-zinc-300 rounded-full dark:bg-zinc-700 w-12"></div>
                </div>
                @endfor
            </div>
        </div>

        <!-- Table Content -->
        <div class="overflow-x-auto" wire:loading.remove wire:target="perPage, search, statusFilter">
            <table class="w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
                <thead class="text-xs uppercase text-zinc-700 bg-zinc-50 dark:bg-zinc-700 dark:text-zinc-200">
                    <!-- Table Head Slot -->
                    {{ $head }}
                </thead>
                <tbody>
                    <!-- Default Slot for Table Body Rows -->
                    {{ $slot }}
                </tbody>
            </table>
        </div>

        <!-- Footer Slot: For pagination links -->
        @if (isset($footer))
            <div class="p-4 border-t border-zinc-200 dark:border-zinc-700">
                {{ $footer }}
            </div>
        @endif
    </div>
</div>
