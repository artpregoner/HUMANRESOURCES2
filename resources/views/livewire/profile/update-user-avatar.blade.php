<div>
    <div class="w-full p-6 bg-white shadow-lg rounded-xl dark:bg-gray-800">
        <div class="grid grid-cols-1 gap-4">
            <div class="flex flex-col items-center px-2">
                <!-- Hidden File Input -->
                <input
                    type="file"
                    wire:model.live="photo"
                    class="hidden"
                    id="upload-photo"
                    accept="image/*">

                <!-- Avatar Preview -->
                <div class="relative">
                    <label for="upload-photo" class="cursor-pointer">
                        @if ($photo)
                            <!-- Show temporary preview -->
                            <img class="w-32 h-32 rounded-full shadow-lg"
                                 src="{{ $photo->temporaryUrl() }}"
                                 alt="Profile Preview"/>
                        @else
                            <!-- Show current avatar or default -->
                            <img class="w-32 h-32 rounded-full shadow-lg"
                                 src="{{ Auth::user()->profile_photo_path
                                        ? Storage::url(Auth::user()->profile_photo_path)
                                        : asset('template/assets/images/avatar-1.jpg') }}"
                                 alt="{{ Auth::user()->name }}"/>
                        @endif
                    </label>
                </div>

                <!-- Error Message -->
                @error('photo')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror

                <!-- Loading Indicator -->
                <div wire:loading wire:target="photo" class="mt-2 text-blue-600">
                    <svg class="inline w-4 h-4 mr-2 animate-spin" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Uploading...
                </div>

                <!-- Helper Text -->
                <span class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                    Click the image to upload a new photo (128x128px recommended, max 5MB)
                </span>

                <!-- Button Group -->
                <div class="flex mt-4 space-x-2" wire:loading.remove wire:target="photo">
                    @if ($photo)
                        <!-- When new photo is selected but not saved -->
                        <button type="button" wire:click="save"
                            class="px-4 py-2 text-sm font-medium text-white bg-green-700 rounded-lg hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300">
                            Save
                        </button>

                        <button type="button" wire:click="cancelPhoto"
                            class="px-4 py-2 text-sm font-medium text-gray-900 bg-gray-200 border border-gray-400 rounded-lg hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-200">
                            Cancel
                        </button>
                    @else
                        <!-- When no new photo is selected -->
                        <button type="button" onclick="document.getElementById('upload-photo').click()"
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                            Upload Photo
                        </button>

                        @if (Auth::user()->profile_photo_path)
                            <button type="button" wire:click="removePhoto"
                                class="px-4 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-100">
                                Remove
                            </button>
                        @endif
                    @endif
                </div>

                <!-- Success Message -->
                @if (session()->has('message'))
                    <p class="mt-2 text-sm text-green-600">{{ session('message') }}</p>
                @endif
            </div>
        </div>
    </div>
</div>
