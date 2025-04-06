<div>
    @include('components.alert.alert')

    <div class="flex flex-col gap-4 item-center">
        @livewire('profile.update-user-avatar')

        <div class="max-w-screen-xl gap-4 md:grid md:grid-cols-2 md:gap-8">
            <div class="rounded-lg ">
                <div class="mt-4 md:mt-0">
                    <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        Profile Information
                    </h2>
                    <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                        Update your account's profile information.
                    </p>
                </div>
            </div>
            <div class="rounded-lg ">
                <div class="mt-4 md:mt-0">
                    <form wire:submit.prevent="save">

                        <div class="w-full p-4 bg-white shadow-lg rounded-xl dark:bg-gray-800">
                            <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                                Edit Name
                            </h2>

                            <label for="name" class="col-form-label">Name</label>
                            <input type="text" wire:model="name" name="name" id="inputName"
                                class="w-full p-3 text-lg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Enter your name" required>

                            @error('name')
                                <p class="mt-2 text-red-500">{{ $message }}</p>
                            @enderror
                            <div class="flex justify-end pt-4">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('photoUpdated', () => {
                alert('Profile photo updated successfully!');
            });
        });
    </script> --}}
</div>
