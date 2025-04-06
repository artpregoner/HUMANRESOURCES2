{{-- @if (!empty(session('success')))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (!empty(session('error')))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif --}}
@php
    $successMessage = session('success') ?? session('message');
    $errorMessage = session('error') ?? session('delete');
    $warningMessage = session('warning') ?? session('update');
@endphp

@if ($successMessage)
<div x-data="{ show: true, timeout: null }"
x-init="timeout = setTimeout(() => show = false, 9000)"
x-show="show"
@mouseenter="if (timeout) clearTimeout(timeout)"
@mouseleave="timeout = setTimeout(() => show = false, 9000)"
        class="fixed z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg top-5 right-5 dark:text-gray-400 dark:bg-gray-800"
        role="alert">

        <div
            class="inline-flex items-center justify-center w-8 h-8 text-green-500 bg-green-100 rounded-lg shrink-0 dark:bg-green-800 dark:text-green-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
            </svg>
            <span class="sr-only">Check icon</span>
        </div>

        <div class="text-sm font-normal ms-3">{{ $successMessage }}</div>

        <button type="button" @click="show = false"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif

@if ($errorMessage)
<div x-data="{ show: true, timeout: null }"
x-init="timeout = setTimeout(() => show = false, 9000)"
x-show="show"
@mouseenter="if (timeout) clearTimeout(timeout)"
@mouseleave="timeout = setTimeout(() => show = false, 9000)"
        class="fixed z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg top-5 right-5 dark:text-gray-400 dark:bg-gray-800"
        role="alert">

        <div
            class="inline-flex items-center justify-center w-8 h-8 text-red-500 bg-red-100 rounded-lg shrink-0 dark:bg-red-800 dark:text-red-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z" />
            </svg>
            <span class="sr-only">Error icon</span>
        </div>

        <div class="text-sm font-normal ms-3">{{ $errorMessage }}</div>

        <button type="button" @click="show = false"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif


@if ($warningMessage)
<div x-data="{ show: true, timeout: null }"
x-init="timeout = setTimeout(() => show = false, 9000)"
x-show="show"
@mouseenter="if (timeout) clearTimeout(timeout)"
@mouseleave="timeout = setTimeout(() => show = false, 9000)"
        class="fixed z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg top-5 right-5 dark:text-gray-400 dark:bg-gray-800"
        role="alert">

        <div
            class="inline-flex items-center justify-center w-8 h-8 text-orange-500 bg-orange-100 rounded-lg shrink-0 dark:bg-orange-700 dark:text-orange-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM10 15a1 1 0 1 1 0-2 1 1 0 0 1 0 2Zm1-4a1 1 0 0 1-2 0V6a1 1 0 0 1 2 0v5Z" />
            </svg>
            <span class="sr-only">Warning icon</span>
        </div>

        <div class="text-sm font-normal ms-3">{{ $warningMessage }}</div>

        <button type="button" @click="show = false"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
@endif

<div wire:offline x-data="{ show: true, timeout: null }"
x-init="timeout = setTimeout(() => show = false, 9000)"
x-show="show"
@mouseenter="if (timeout) clearTimeout(timeout)"
@mouseleave="timeout = setTimeout(() => show = false, 9000)"
        class="fixed z-50 flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg top-5 right-5 dark:text-gray-400 dark:bg-gray-800"
        role="alert">

        <div
            class="inline-flex items-center justify-center w-8 h-8 text-orange-500 bg-orange-100 rounded-lg shrink-0 dark:bg-orange-700 dark:text-orange-200">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 0 1 7.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 0 1 1.06 0Z" />
              </svg>
        </div>

        <div class="text-sm font-normal ms-3">You are currently offline.</div>

        <button type="button" @click="show = false"
            class="ms-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
            data-dismiss-target="#toast-success" aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
        </button>
    </div>
