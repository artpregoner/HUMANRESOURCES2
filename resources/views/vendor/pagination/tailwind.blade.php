@if ($paginator->hasPages())
    <nav class="flex flex-wrap items-center justify-between px-4 py-4 flex-column md:flex-row" aria-label="Table navigation">
        <span class="block w-full mb-4 text-sm font-normal text-gray-500 dark:text-gray-400 md:mb-0 md:inline md:w-auto">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $paginator->firstItem() ?? 0 }}-{{ $paginator->lastItem() ?? 0 }}
            </span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">
                {{ $paginator->total() }}
            </span>
        </span>

        <ul class="inline-flex h-8 -space-x-px text-sm rtl:space-x-reverse">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li>
                    <span class="flex items-center justify-center h-8 px-3 leading-tight text-gray-400 bg-gray-200 border border-gray-300 cursor-not-allowed ms-0 rounded-s-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500">
                        Previous
                    </span>
                </li>
            @else
                <li>
                    <a href="{{ $paginator->previousPageUrl() }}" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 ms-0 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Previous
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                @if (is_string($element))
                    <li>
                        <span class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400">
                            {{ $element }}
                        </span>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li>
                                <span aria-current="page" class="flex items-center justify-center h-8 px-3 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
                                    {{ $page }}
                                </span>
                            </li>
                        @else
                            <li>
                                <a href="{{ $url }}" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                    {{ $page }}
                                </a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a href="{{ $paginator->nextPageUrl() }}" class="flex items-center justify-center h-8 px-3 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Next
                    </a>
                </li>
            @else
                <li>
                    <span class="flex items-center justify-center h-8 px-3 leading-tight text-gray-400 bg-gray-200 border border-gray-300 cursor-not-allowed rounded-e-lg dark:bg-gray-700 dark:border-gray-600 dark:text-gray-500">
                        Next
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
