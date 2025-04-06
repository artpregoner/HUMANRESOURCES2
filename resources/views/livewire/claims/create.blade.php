<div class="max-w-6xl px-4 py-4 mx-auto bg-white dark:bg-gray-900 lg:py-10 rounded-2xl">
    <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Submit new Claim</h2>

        <form wire:submit.prevent="submit">
            <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                <div>
                    <label for="currency" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Currency</label>
                    <select wire:model="currency" id="currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                        <option selected="PHP">PHP</option>
                        <option value="USD">USD</option>
                    </select>
                    @error('currency')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ $message }}.</p>
                    @enderror
                </div>
                <div>
                    <label for="expense_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Expense Claim Date</label>
                    <input type="datetime-local" wire:model="expense_date" name="expense_date" id="expense_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="12">
                    @error('expense_date')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ $message }}.</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <input wire:model="description" type="text" name="description" id="description" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="">
                    @error('description')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ $message }}.</p>
                    @enderror
                </div>
                <div class="sm:col-span-2">
                    <label for="comments" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comments (Optional)</label>
                    <textarea wire:model="comments" id="comments" rows="8" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Your description here"></textarea>
                    @error('comments')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ $message }}.</p>
                    @enderror
                </div>
            </div>

            <!-- Claim Lines Section -->
            <div class="gap-4 pt-2 mt-4 border-t border-gray-200 sm:gap-6">
                <!-- Desktop Headers -->
                <div class="hidden mb-3 text-sm font-medium text-gray-700 md:grid md:grid-cols-12 dark:text-gray-300">
                    <div class="col-span-4">
                        <div class="flex items-center gap-1">
                            <span>Category</span>
                        </div>
                    </div>
                    <div class="col-span-4">
                        <div class="flex items-center gap-1">
                            <span>Details</span>
                        </div>
                    </div>
                    <div class="col-span-3">
                        <div class="flex items-center gap-1">
                            <span>Amount</span>
                        </div>
                    </div>
                    <div class="col-span-1"></div> <!-- Space for actions -->
                </div>

                <!-- Claim Lines -->
                <div id="claimLines" class="space-y-4">
                    @foreach ($claim_lines as $index => $line)
                        <div class="p-3 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-800 dark:border-gray-700">
                            <!-- Mobile Headers (visible only on mobile) -->
                            <div class="grid grid-cols-2 gap-2 mb-2 text-xs font-medium text-gray-500 md:hidden dark:text-gray-400">
                                <div>Category</div>
                            </div>

                            <!-- Line Items -->
                            <div class="grid grid-cols-1 gap-3 md:grid-cols-12">
                                <div class="md:col-span-4">
                                    <select wire:model="claim_lines.{{ $index }}.category"
                                            class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5">
                                        <option value="">Select category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error("claim_lines.{$index}.category")
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Mobile header for amount (visible only on mobile) -->
                                <div class="grid grid-cols-1 gap-2 mt-2 text-xs font-medium text-gray-500 md:hidden dark:text-gray-400">
                                    <div>Details</div>
                                </div>
                                <div class="md:col-span-4">
                                    <input wire:model="claim_lines.{{ $index }}.details"
                                        type="text"
                                        class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5"
                                        placeholder="Enter expense details">
                                    @error("claim_lines.{$index}.details")
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <!-- Mobile header for amount (visible only on mobile) -->
                                <div class="grid grid-cols-1 gap-2 mt-2 text-xs font-medium text-gray-500 md:hidden dark:text-gray-400">
                                    <div>Amount</div>
                                </div>
                                <div class="md:col-span-3">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                            <span class="text-gray-500 dark:text-gray-400">{{ $currency }} </span>
                                        </div>
                                        <input wire:model.lazy="claim_lines.{{ $index }}.amount"
                                            type="number"
                                            step="0.01"
                                            class="bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 text-gray-900 dark:text-white text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2.5"
                                            placeholder="0.00">
                                    </div>
                                    @error("claim_lines.{$index}.amount")
                                        <p class="mt-1 text-xs text-red-600 dark:text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="flex items-center justify-end md:col-span-1">
                                    @if (!$line['is_fixed'])
                                        <button wire:click.prevent="removeClaimLine({{ $index }})"
                                                class="p-1 text-red-500 rounded-full hover:text-red-700 hover:bg-red-50 dark:hover:bg-red-900/20"
                                                title="Remove line">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                <path fill-rule="evenodd" d="M8.75 1A2.75 2.75 0 006 3.75v.443c-.795.077-1.584.176-2.365.298a.75.75 0 10.23 1.482l.149-.022.841 10.518A2.75 2.75 0 007.596 19h4.807a2.75 2.75 0 002.742-2.53l.841-10.52.149.023a.75.75 0 00.23-1.482A41.03 41.03 0 0014 4.193V3.75A2.75 2.75 0 0011.25 1h-2.5zM10 4c.84 0 1.673.025 2.5.075V3.75c0-.69-.56-1.25-1.25-1.25h-2.5c-.69 0-1.25.56-1.25 1.25v.325C8.327 4.025 9.16 4 10 4zM8.58 7.72a.75.75 0 00-1.5.06l.3 7.5a.75.75 0 101.5-.06l-.3-7.5zm4.34.06a.75.75 0 10-1.5-.06l-.3 7.5a.75.75 0 101.5.06l.3-7.5z" clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Add Line and Total Section -->
                <div class="flex flex-col items-start justify-between gap-4 mt-4 md:flex-row md:items-center">
                    <div>
                        @if ($canAddMore)
                            <button wire:click.prevent="addClaimLine" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Add Expense Line</button>
                        @endif
                    </div>

                    <div class="px-4 py-3 bg-gray-100 rounded-lg dark:bg-gray-800">
                        <div class="flex items-center gap-2">
                            <span class="text-gray-700 dark:text-gray-300">Total:</span>
                            <span wire:ignore.self wire:listen="totalUpdated" class="text-lg font-bold text-gray-900 dark:text-white">
                                {{ number_format($total, 2) }} {{ $currency }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>


            <!-- File Upload Section -->
            <div class="pt-4 mt-4 border-t border-gray-200">
                {{-- not working --}}
                <div class="flex items-center">
                    <label for="file-upload" class="px-3 py-1.5 text-sm bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-400 dark:bg-gray-700 dark:text-white rounded cursor-pointer flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Upload Receipts
                    </label>
                    <span class="ml-2 text-xs text-gray-500">Maximum 10 images</span>
                    {{-- <input wire:model="files" x-data="{ files: @entangle('files') }" type="file" id="file-upload" class="hidden" multiple accept="image/*" max="10"> --}}
                    <input wire:model="files" type="file" id="file-upload" class="hidden" multiple accept="image/*" max="10">
                </div>


                <!-- Uploaded Files List -->
                <div class="w-full">
                    @foreach ($files as $index => $file)
                    <div class="flex items-center justify-between gap-2 p-2 bg-gray-100 rounded-lg dark:bg-gray-700">
                        <div class="flex items-center">
                            @if (in_array($file->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif', 'PNG', 'webp']))
                                <img src="{{ $file->temporaryUrl() }}" class="object-cover w-10 h-10 mr-2 rounded-lg">
                            @else
                                <svg class="w-6 h-6 mr-2 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 18a.969.969 0 0 0 .933 1h12.134A.97.97 0 0 0 15 18M1 7V5.828a2 2 0 0 1 .586-1.414l2.828-2.828A2 2 0 0 1 5.828 1h8.239A.969.969 0 0 1 15 2v5M6 1v4a1 1 0 0 1-1 1H1m0 9h14M5 14v4h4v-4m2 0h4v4h-4v-4"/>
                                </svg>
                            @endif

                            <div class="font-medium dark:text-white">
                                <div class="text-sm sm:text-base sm:hidden">
                                    {{ Str::limit($file->getClientOriginalName(), 20, '...') }}
                                </div>
                                <div class="hidden sm:block">
                                    {{ Str::limit($file->getClientOriginalName(), 50, '...') }}
                                </div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ isset($fileSizes[$index]) ? number_format($fileSizes[$index] / 1024, 2) : '0' }} KB</div>
                            </div>

                        </div>
                        <button
                            wire:click="removeFile({{ $index }})"
                            type="button"
                            class="p-1 text-red-500 rounded-full hover:bg-red-100 dark:hover:bg-red-800"
                        >
                            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- Flash Messages -->
            @if (session()->has('message'))
                <p class="mt-2 text-sm text-green-600 dark:green-red-500">{{ session('message') }}.</p>
            @endif

            @if (session()->has('error'))
                <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oh, snapp!</span> {{ session('error') }}.</p>
            @endif
            <div class="flex justify-end py-4 space-x-4">
                {{-- <input wire:model="reimbursement_required" type="checkbox" class="custom-control-input"
                                id="reimbursement_required" hidden> --}}
                <button
                    type="submit"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"
                >
                    Submit
                </button>
                <a
                    href="{{ route('portal.claims.index') }}"
                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                >
                    Cancel
                </a>
            </div>
        </form>
</div>
