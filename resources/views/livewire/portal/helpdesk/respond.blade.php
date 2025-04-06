<!-- Ticket Response UI -->
<div class="max-w-screen-xl p-0 mx-auto space-y-4">

    <!-- Message Threads -->
    <div class="w-full bg-gray-100 rounded-lg shadow-lg dark:bg-gray-800">
        <div class="p-4 rounded-t-lg bg-gray-50 dark:bg-gray-700">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-2">
                    <span class="hidden sm:block text-sm font-semibold text-gray-900 dark:text-white max-w-[250px]">
                        {{ $ticket->title }}
                    </span>

                    <!-- Truncated Title for Mobile -->
                    <span class="block sm:hidden text-sm font-semibold text-gray-900 dark:text-white truncate max-w-[120px]">
                        {{ Str::limit($ticket->title, 15, '...') }}
                    </span>
                </div>
                <div class="flex flex-col items-center space-y-2 sm:flex-row sm:space-y-0 sm:space-x-2">
                    <a href="{{ route('portal.helpdesk.index') }}"
                       class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700 sm:w-auto">
                        Return to Ticket List
                    </a>

                    <button wire:click="toggleReplyBox"
                            class="inline-flex items-center justify-center w-full px-3 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 sm:w-auto">
                        <svg class="w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v12m-6-6h12m-6 0 4-4m-4 4 4 4"/>
                        </svg>
                        Reply
                    </button>
                </div>
            </div>
        </div>

        @if ($showReplyBox)
        <div class="w-full bg-white rounded-lg shadow-lg dark:bg-gray-800">
            <div class="p-4">
                <!-- File Upload -->
                <div class="mb-4">
                    <label for="file-upload" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1Z"/>
                        </svg>
                        Upload File
                    </label>
                    <input id="file-upload" type="file" wire:model="files" multiple class="hidden">
                    <small class="ml-2 text-sm text-gray-500 dark:text-gray-400">Maximum 10 files total</small>
                </div>

                <!-- File Preview -->
                @if ($files)
                <div class="mb-4 space-y-2">
                    @foreach ($files as $index => $file)
                    <div class="flex items-center justify-between p-2 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <div class="flex items-center">
                            @if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                <img src="{{ $file->temporaryUrl() }}" class="object-cover w-10 h-10 mr-2 rounded-lg">
                            @else
                                <svg class="w-6 h-6 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.969.969 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9h14M5 14v4h4v-4m2 0h4v4h-4v-4"/>
                                </svg>
                            @endif
                            <span class="text-sm text-gray-900 dark:text-white">{{ $file->getClientOriginalName() }}</span>
                        </div>
                        <button
                            wire:click="removeFile({{ $index }})"
                            class="p-1 text-red-500 rounded-full hover:bg-red-100 dark:hover:bg-red-800"
                        >
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
                @endif

                <!-- Response Textarea -->
                <div class="mb-4">
                    <textarea
                        wire:model.defer="response"
                        rows="4"
                        class="w-full p-2.5 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Type your reply here..."
                    ></textarea>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-2">
                    <button
                        wire:click="discardReply"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                    >
                        Discard
                    </button>
                    <button
                        wire:click="sendReply"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    >
                        Send Reply
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="p-4 space-y-4 overflow-y-auto max-h-150">
            @foreach ($responses->reverse() as $response)
                @if (!empty($response->response_text) || $response->files->count() > 0)
                    <div class="flex {{ $response->user_id == Auth::id() ? 'flex-row-reverse' : 'flex-row' }} items-start gap-2.5">
                        <img
                            src="{{ $response->user->profile_photo_path ? Storage::url($response->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}"
                            alt="User Avatar"
                            class="w-8 h-8 rounded-full"
                        >
                        <div class="flex flex-col {{ $response->user_id == Auth::id() ? 'items-end' : 'items-start' }} gap-2.5">
                            <div class="flex items-center space-x-2">
                                <span class="text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $response->user_id == Auth::id() ? 'You' : $response->user->name }}
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $response->created_at->format('H:i') }}
                                </span>
                            </div>
                            @if (!empty($response->response_text))
                                <div class="{{ $response->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white' }}
                                    rounded-xl p-3 w-auto max-w-[200px] sm:max-w-[300px] md:max-w-[400px] lg:max-w-[500px] break-words">
                                    <p class="text-sm">{{ $response->response_text }}</p>
                                </div>
                            @endif

                            @if ($response->files->count() > 0)
                                <div class="flex flex-wrap gap-2 mt-2 {{ $response->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                                    @foreach ($response->files as $file)
                                        <div class="flex items-center p-2 bg-gray-300 rounded-lg dark:bg-gray-700">
                                            @if (in_array($file->file_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']))
                                                <img
                                                    src="{{ asset('storage/' . $file->file_path) }}"
                                                    alt="Attached Image"
                                                    class="object-cover w-24 h-24 rounded-lg cursor-pointer"
                                                    wire:click="showImage('{{ asset('storage/' . $file->file_path) }}')"
                                                >
                                            @else
                                                <div class="flex flex-col w-full max-w-[320px]">
                                                    <div class="flex items-center gap-2 p-2 dark:bg-gray-700 rounded-xl">
                                                        <svg fill="none" aria-hidden="true" class="w-5 h-5 shrink-0" viewBox="0 0 20 21">
                                                            <g clip-path="url(#clip0_3173_1381)">
                                                               <path fill="#E2E5E7" d="M5.024.5c-.688 0-1.25.563-1.25 1.25v17.5c0 .688.562 1.25 1.25 1.25h12.5c.687 0 1.25-.563 1.25-1.25V5.5l-5-5h-8.75z"/>
                                                               <path fill="#B0B7BD" d="M15.024 5.5h3.75l-5-5v3.75c0 .688.562 1.25 1.25 1.25z"/>
                                                               <path fill="#CAD1D8" d="M18.774 9.25l-3.75-3.75h3.75v3.75z"/>
                                                               <path fill="#F15642" d="M16.274 16.75a.627.627 0 01-.625.625H1.899a.627.627 0 01-.625-.625V10.5c0-.344.281-.625.625-.625h13.75c.344 0 .625.281.625.625v6.25z"/>
                                                               <path fill="#fff" d="M3.998 12.342c0-.165.13-.345.34-.345h1.154c.65 0 1.235.435 1.235 1.269 0 .79-.585 1.23-1.235 1.23h-.834v.66c0 .22-.14.344-.32.344a.337.337 0 01-.34-.344v-2.814zm.66.284v1.245h.834c.335 0 .6-.295.6-.605 0-.35-.265-.64-.6-.64h-.834zM7.706 15.5c-.165 0-.345-.09-.345-.31v-2.838c0-.18.18-.31.345-.31H8.85c2.284 0 2.234 3.458.045 3.458h-1.19zm.315-2.848v2.239h.83c1.349 0 1.409-2.24 0-2.24h-.83zM11.894 13.486h1.274c.18 0 .36.18.36.355 0 .165-.18.3-.36.3h-1.274v1.049c0 .175-.124.31-.3.31-.22 0-.354-.135-.354-.31v-2.839c0-.18.135-.31.355-.31h1.754c.22 0 .35.13.35.31 0 .16-.13.34-.35.34h-1.455v.795z"/>
                                                               <path fill="#CAD1D8" d="M15.649 17.375H3.774V18h11.875a.627.627 0 00.625-.625v-.625a.627.627 0 01-.625.625z"/>
                                                            </g>
                                                            <defs>
                                                               <clipPath id="clip0_3173_1381">
                                                                  <path fill="#fff" d="M0 0h20v20H0z" transform="translate(0 .5)"/>
                                                               </clipPath>
                                                            </defs>
                                                         </svg>
                                                        <a href="{{ asset('storage/' . $file->file_path) }}" class="text-sm font-medium text-gray-900 hover:underline dark:text-white" target="_blank">
                                                            {{ Str::limit($file->file_name, 15, '...') . substr($file->file_name, strrpos($file->file_name, '.')) }}
                                                        </a>
                                                    </div>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ number_format($file->file_size / 1024, 2) }} KB
                                                    </span>
                                                </div>
                                                <div class="inline-flex items-center self-center">
                                                    <button wire:click="downloadFile('{{ $file->id }}')"
                                                        class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 rounded-lg bg-gray-50 hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                                                        type="button">
                                                        <svg class="w-4 h-4 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                                            <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                                        </svg>
                                                    </button>
                                                 </div>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

    </div>

    <!-- Image Modal -->
    @if ($selectedImage)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-opacity-50">
            <div class="relative max-w-3xl max-h-full">
                <!-- Close Button -->
                <button
                    wire:click="closeImageModal"
                    class="absolute p-2 text-white bg-gray-800 rounded-full top-4 right-4 hover:bg-gray-700"
                >
                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>

                <!-- Download Button -->
                <a
                    href="{{ $selectedImage }}"
                    download
                    class="absolute p-2 text-white bg-blue-600 rounded-full top-4 right-16 hover:bg-blue-700"
                >
                    <svg class="w-6 h-6 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                        <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                     </svg>
                </a>

                <!-- Image -->
                <img
                    src="{{ $selectedImage }}"
                    alt="Enlarged Image"
                    class="max-w-full max-h-screen rounded-lg"
                >
            </div>
        </div>
    @endif

</div>
<div class="p-4 space-y-4 overflow-y-auto max-h-150">
    @foreach ($responses->reverse() as $response)
        @if (!empty($response->response_text) || $response->files->count() > 0)
            <div class="flex {{ $response->user_id == Auth::id() ? 'flex-row-reverse' : 'flex-row' }} items-start gap-2.5">
                <img
                    src="{{ $response->user->profile_photo_path ? Storage::url($response->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}"
                    alt="User Avatar"
                    class="w-8 h-8 rounded-full"
                >
                <div class="flex flex-col {{ $response->user_id == Auth::id() ? 'items-end' : 'items-start' }} gap-2.5">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $response->user_id == Auth::id() ? 'You' : $response->user->name }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $response->created_at->format('H:i') }}
                        </span>
                    </div>

                    <!-- Message Text -->
                    @if (!empty($response->response_text))
                        <div class="{{ $response->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white' }}
                            rounded-xl p-3 w-auto max-w-[200px] sm:max-w-[300px] md:max-w-[400px] lg:max-w-[500px] break-words">
                            <p class="text-sm">{{ $response->response_text }}</p>
                        </div>
                    @endif

                    <!-- Images Section -->
                    @php
                        $images = $response->files->filter(function($file) {
                            return in_array($file->file_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
                        });
                    @endphp

                    @if ($images->count() > 0)
                        <div class="flex flex-wrap gap-2 mt-2 {{ $response->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full max-w-[500px]">
                                @foreach ($images as $file)
                                    <div class="flex items-center p-2 bg-gray-300 rounded-lg dark:bg-gray-700">
                                        <img
                                            src="{{ asset('storage/' . $file->file_path) }}"
                                            alt="Attached Image"
                                            class="object-cover w-full h-24 rounded-lg cursor-pointer"
                                            wire:click="showImage('{{ asset('storage/' . $file->file_path) }}')"
                                        >
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Files Section -->
                    @php
                        $files = $response->files->filter(function($file) {
                            return !in_array($file->file_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
                        });
                    @endphp

                    @if ($files->count() > 0)
                        <div class="flex flex-wrap gap-2 mt-2 {{ $response->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2 w-full max-w-[500px]">
                                @foreach ($files as $file)
                                    <div class="leading-1.5 flex max-w-full">
                                        <div class="flex items-start w-full p-2 bg-gray-300 dark:bg-gray-700 rounded-xl">
                                            <div class="flex-grow me-2">
                                                <span class="flex items-center gap-2 pb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                    <svg fill="none" aria-hidden="true" class="w-5 h-5 shrink-0" viewBox="0 0 20 21">
                                                        <g clip-path="url(#clip0_3173_1381)">
                                                        <path fill="#E2E5E7" d="M5.024.5c-.688 0-1.25.563-1.25 1.25v17.5c0 .688.562 1.25 1.25 1.25h12.5c.687 0 1.25-.563 1.25-1.25V5.5l-5-5h-8.75z"/>
                                                        <path fill="#B0B7BD" d="M15.024 5.5h3.75l-5-5v3.75c0 .688.562 1.25 1.25 1.25z"/>
                                                        <path fill="#CAD1D8" d="M18.774 9.25l-3.75-3.75h3.75v3.75z"/>
                                                        <path fill="#F15642" d="M16.274 16.75a.627.627 0 01-.625.625H1.899a.627.627 0 01-.625-.625V10.5c0-.344.281-.625.625-.625h13.75c.344 0 .625.281.625.625v6.25z"/>
                                                        <path fill="#fff" d="M3.998 12.342c0-.165.13-.345.34-.345h1.154c.65 0 1.235.435 1.235 1.269 0 .79-.585 1.23-1.235 1.23h-.834v.66c0 .22-.14.344-.32.344a.337.337 0 01-.34-.344v-2.814zm.66.284v1.245h.834c.335 0 .6-.295.6-.605 0-.35-.265-.64-.6-.64h-.834zM7.706 15.5c-.165 0-.345-.09-.345-.31v-2.838c0-.18.18-.31.345-.31H8.85c2.284 0 2.234 3.458.045 3.458h-1.19zm.315-2.848v2.239h.83c1.349 0 1.409-2.24 0-2.24h-.83zM11.894 13.486h1.274c.18 0 .36.18.36.355 0 .165-.18.3-.36.3h-1.274v1.049c0 .175-.124.31-.3.31-.22 0-.354-.135-.354-.31v-2.839c0-.18.135-.31.355-.31h1.754c.22 0 .35.13.35.31 0 .16-.13.34-.35.34h-1.455v.795z"/>
                                                        <path fill="#CAD1D8" d="M15.649 17.375H3.774V18h11.875a.627.627 0 00.625-.625v-.625a.627.627 0 01-.625.625z"/>
                                                        </g>
                                                        <defs>
                                                        <clipPath id="clip0_3173_1381">
                                                            <path fill="#fff" d="M0 0h20v20H0z" transform="translate(0 .5)"/>
                                                        </clipPath>
                                                        </defs>
                                                    </svg>
                                                    <a href="{{ asset('storage/' . $file->file_path) }}" class="text-sm font-medium text-gray-900 hover:underline dark:text-white" target="_blank">
                                                        {{ Str::limit($file->file_name, 5, '...') . substr($file->file_name, strrpos($file->file_name, '.')) }}
                                                    </a>
                                                </span>
                                                <span class="text-xs text-gray-500 dark:text-gray-400">
                                                    {{ number_format($file->file_size / 1024, 2) }} KB
                                                </span>
                                            </div>
                                            <div class="inline-flex items-center self-center">
                                                <button wire:click="downloadFile('{{ $file->id }}')"
                                                    class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                                                    type="button">
                                                    <svg class="w-4 h-4 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                                        <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endforeach
</div>


old
<div class="p-4 space-y-4 overflow-y-auto max-h-150">
    @foreach ($responses->reverse() as $response)
        @if (!empty($response->response_text) || $response->files->count() > 0)
            <div class="flex {{ $response->user_id == Auth::id() ? 'flex-row-reverse' : 'flex-row' }} items-start gap-2.5">
                <img
                    src="{{ $response->user->profile_photo_path ? Storage::url($response->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}"
                    alt="User Avatar"
                    class="w-8 h-8 rounded-full"
                >
                <div class="flex flex-col {{ $response->user_id == Auth::id() ? 'items-end' : 'items-start' }} gap-2.5">
                    <div class="flex items-center space-x-2">
                        <span class="text-sm font-semibold text-gray-900 dark:text-white">
                            {{ $response->user_id == Auth::id() ? 'You' : $response->user->name }}
                        </span>
                        <span class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $response->created_at->format('H:i') }}
                        </span>
                    </div>
                    @if (!empty($response->response_text))
                        <div class="{{ $response->user_id == Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-300 dark:bg-gray-700 text-gray-900 dark:text-white' }}
                            rounded-xl p-3 w-auto max-w-[200px] sm:max-w-[300px] md:max-w-[400px] lg:max-w-[500px] break-words">
                            <p class="text-sm">{{ $response->response_text }}</p>
                        </div>
                    @endif

                    @if ($response->files->count() > 0)
                        <div class="flex flex-wrap gap-2 mt-2 {{ $response->user_id == Auth::id() ? 'justify-end' : 'justify-start' }}">
                            @foreach ($response->files as $file)
                                {{-- <div class="flex items-center p-2 bg-gray-300 rounded-lg dark:bg-gray-700"> --}}
                                    @if (in_array($file->file_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']))
                                    <div class="flex items-center p-2 bg-gray-300 rounded-lg dark:bg-gray-700">
                                        <img
                                            src="{{ asset('storage/' . $file->file_path) }}"
                                            alt="Attached Image"
                                            class="object-cover w-24 h-24 rounded-lg cursor-pointer"
                                            wire:click="showImage('{{ asset('storage/' . $file->file_path) }}')"
                                        >
                                    </div>
                                    @else
                                        <div class="leading-1.5 flex max-w-[320px] flex-col">
                                            <div class="flex items-start p-2 bg-gray-300 dark:bg-gray-700 rounded-xl">
                                                <div class="me-2">
                                                    <span class="flex items-center gap-2 pb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                        <svg fill="none" aria-hidden="true" class="w-5 h-5 shrink-0" viewBox="0 0 20 21">
                                                            <g clip-path="url(#clip0_3173_1381)">
                                                            <path fill="#E2E5E7" d="M5.024.5c-.688 0-1.25.563-1.25 1.25v17.5c0 .688.562 1.25 1.25 1.25h12.5c.687 0 1.25-.563 1.25-1.25V5.5l-5-5h-8.75z"/>
                                                            <path fill="#B0B7BD" d="M15.024 5.5h3.75l-5-5v3.75c0 .688.562 1.25 1.25 1.25z"/>
                                                            <path fill="#CAD1D8" d="M18.774 9.25l-3.75-3.75h3.75v3.75z"/>
                                                            <path fill="#F15642" d="M16.274 16.75a.627.627 0 01-.625.625H1.899a.627.627 0 01-.625-.625V10.5c0-.344.281-.625.625-.625h13.75c.344 0 .625.281.625.625v6.25z"/>
                                                            <path fill="#fff" d="M3.998 12.342c0-.165.13-.345.34-.345h1.154c.65 0 1.235.435 1.235 1.269 0 .79-.585 1.23-1.235 1.23h-.834v.66c0 .22-.14.344-.32.344a.337.337 0 01-.34-.344v-2.814zm.66.284v1.245h.834c.335 0 .6-.295.6-.605 0-.35-.265-.64-.6-.64h-.834zM7.706 15.5c-.165 0-.345-.09-.345-.31v-2.838c0-.18.18-.31.345-.31H8.85c2.284 0 2.234 3.458.045 3.458h-1.19zm.315-2.848v2.239h.83c1.349 0 1.409-2.24 0-2.24h-.83zM11.894 13.486h1.274c.18 0 .36.18.36.355 0 .165-.18.3-.36.3h-1.274v1.049c0 .175-.124.31-.3.31-.22 0-.354-.135-.354-.31v-2.839c0-.18.135-.31.355-.31h1.754c.22 0 .35.13.35.31 0 .16-.13.34-.35.34h-1.455v.795z"/>
                                                            <path fill="#CAD1D8" d="M15.649 17.375H3.774V18h11.875a.627.627 0 00.625-.625v-.625a.627.627 0 01-.625.625z"/>
                                                            </g>
                                                            <defs>
                                                            <clipPath id="clip0_3173_1381">
                                                                <path fill="#fff" d="M0 0h20v20H0z" transform="translate(0 .5)"/>
                                                            </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <a href="{{ asset('storage/' . $file->file_path) }}" class="text-sm font-medium text-gray-900 hover:underline dark:text-white" target="_blank">
                                                            {{ Str::limit($file->file_name, 15, '...') . substr($file->file_name, strrpos($file->file_name, '.')) }}
                                                        </a>
                                                    </span>
                                                    <span class="text-xs text-gray-500 dark:text-gray-400">
                                                        {{ number_format($file->file_size / 1024, 2) }} KB
                                                    </span>
                                                </div>
                                                <div class="inline-flex items-center self-center">
                                                        <button wire:click="downloadFile('{{ $file->id }}')"
                                                            class="inline-flex items-center self-center p-2 text-sm font-medium text-center text-gray-900 rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 dark:focus:ring-gray-600"
                                                            type="button">
                                                            <svg class="w-4 h-4 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                                                <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                                                            </svg>
                                                        </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                {{-- </div> --}}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif
    @endforeach
</div>
