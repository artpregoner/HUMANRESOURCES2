<div>
    @include('components.alert.alert')
    <form class="space-y-5" wire:submit.prevent="submitLogin">
        <div>
            <label for="email"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                email</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="text-gray-500 fas fa-envelope dark:text-gray-400"></i>
                </div>
                <flux:input type="email" wire:model.defer="email"  value="{{ session('login_email', old('email')) }}" placeholder="Email" clearable />
            </div>
            @error('email') <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="password"
                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="text-gray-500 fas fa-lock dark:text-gray-400"></i>
                </div>
                <flux:input type="password" wire:model.defer="password" placeholder="Password" viewable />
            </div>
            @error('password')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-start">
            </div>
            <a href="#"
                class="text-sm font-medium text-blue-600 hover:underline dark:text-blue-500">Forgot
                password?</a>
        </div>
        <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sign
            in</button>
    </form>
</div>
