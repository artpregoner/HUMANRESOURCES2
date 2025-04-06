<div class="max-w-2xl px-4 py-4 mx-auto bg-white dark:bg-gray-900 lg:py-10 rounded-2xl">
    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Submit New Ticket</h2>

    <form wire:submit.prevent="store">
        <div class="grid gap-4 mb-4 sm:grid-cols-2">
            <!-- Subject -->
            <div class="sm:col-span-2">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Subject</label>
                <input type="text" wire:model="title" id="title"
                       class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600">
                @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Category</label>
                <select wire:model="category_id" id="category_id"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg block w-full p-2.5 dark:bg-gray-700">
                    <option value="">Select a category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- File Upload -->
            <div class="sm:col-span-2">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Attachments</label>
                <div class="mb-4">
                    <flux:tooltip content="Attach a file up to 2 MB">
                        <label for="file-upload" class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-700">
                            <svg class="w-4 h-4 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M16 18H8l2.5-6 2 4 1.5-2 2 4Zm-1-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/>
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 3v4a1 1 0 0 1-1 1H5m14-4v16a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1ZM8 18h8l-2-4-1.5 2-2-4L8 18Zm7-8.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0Z"/>
                            </svg>

                        </label>
                        <input id="file-upload" type="file" wire:model="files" multiple class="hidden">
                    </flux:tooltip>
                    <small class="ml-2 text-sm text-gray-500 dark:text-gray-400">Maximum 10 files total</small>
                </div>
                <!-- File List -->
                @if ($files)
                <div class="mb-4 space-y-2">
                    @foreach ($files as $index => $file)
                    <div class="flex items-center justify-between p-2 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <div class="flex items-center">
                            @if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'PNG', 'gif', 'webp', 'png']))
                                <img src="{{ $file->temporaryUrl() }}" class="object-cover w-10 h-10 mr-2 rounded-lg">
                            @else
                                <svg class="w-6 h-6 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.969.969 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9h14M5 14v4h4v-4m2 0h4v4h-4v-4"/>
                                </svg>
                            @endif
                            <span class="block text-sm text-gray-900 dark:text-white truncate overflow-hidden whitespace-nowrap max-w-[7.5rem] sm:max-w-full">
                                <flux:tooltip toggleable>
                                    <flux:button size="sm" variant="ghost" class="w-full overflow-hidden text-left truncate whitespace-nowrap">
                                        {{ $file->getClientOriginalName() }}
                                    </flux:button>
                                    <flux:tooltip.content class="max-w-[20rem] space-y-2">
                                        <p>{{ $file->getClientOriginalName() }}</p>
                                    </flux:tooltip.content>
                                </flux:tooltip>
                            </span>

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

                @error('files.*') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Response -->
            <div class="sm:col-span-2">
                <label for="response" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Response</label>
                <textarea wire:model="response" id="response" rows="4"
                          class="block w-full p-2 text-sm text-gray-900 bg-white border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white"></textarea>
                @error('response') <span class="text-red-500">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end space-x-4">
            <button type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                Submit
            </button>
            <a href="{{ route('portal.helpdesk.index') }}"
               class="text-gray-900 bg-white border border-gray-300 hover:bg-gray-100 font-medium rounded-lg text-sm px-5 py-2.5">
                Cancel
            </a>
        </div>
    </form>
</div>
