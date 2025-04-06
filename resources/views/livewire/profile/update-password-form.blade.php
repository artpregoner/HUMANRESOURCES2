<div>
    @include('components.alert.alert')
    <div class="flex flex-col gap-4 item-center">
        <div class="max-w-screen-xl md:grid md:grid-cols-2 md:gap-8">
            <div class="rounded-lg ">
                <div class="mt-4 md:mt-0">
                    <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
                        Update Password
                    </h2>
                    <p class="mb-6 font-light text-gray-500 md:text-lg dark:text-gray-400">
                        Ensure your account is using a long, random password to stay secure.
                    </p>
                </div>
            </div>
            <div class="rounded-lg ">
                <div class="mt-4 md:mt-0">
                    <div class="w-full p-4 bg-white shadow-lg rounded-xl dark:bg-gray-800">
                        <h2 class="mb-4 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Update Password
                        </h2>
                        <form wire:submit.prevent="updatePassword">
                            <div class="mb-4">
                                <label for="current-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Current Password</label>
                                <input type="password" wire:model="current_password" name="current-password" id="current-password"
                                    class="w-full p-3 text-lg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Current Password" required>
                                    @error('current_password') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="mb-4">
                                <label for="new-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                                <input type="password" wire:model="password" name="new-password" id="new-password"
                                    class="w-full p-3 text-lg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="New Password" required>
                                    @error('password') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
                            </div>
                            <div class="">
                                <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm Password</label>
                                <input type="password" wire:model="password_confirmation" name="confirm-password" id="confirm-password"
                                    class="w-full p-3 text-lg text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-600 focus:border-primary-600 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Confirm Password" required>
                            </div>

                            <div class="flex justify-end pt-4">
                                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
