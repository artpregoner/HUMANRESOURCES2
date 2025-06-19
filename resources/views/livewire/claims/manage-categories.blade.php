<div>
    <flux:modal.trigger name="categoryModal">
        <flux:button type="button" size="sm" variant="primary">Add new Category</flux:button>
    </flux:modal.trigger>

    <flux:modal name="categoryModal" class="w-full max-w-md p-4 md:max-w-xl lg:max-w-2xl xl:max-w-4xl">
        <div class="relative">
            @include('components.alert.alert')
            <!-- Make the table container horizontally scrollable on small screens -->
            <div class="max-h-[calc(100vh-100px)] overflow-x-auto rounded-2xl">
                <table class="w-full min-w-[600px] text-sm text-left rtl:text-right">
                    <thead class="text-xs uppercase">
                        <tr>
                            <th scope="col" class="px-6 py-3">Name</th>
                            <th scope="col" class="px-6 py-3">Description</th>
                            <th scope="col" class="px-6 py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600" wire:key="{{ $category->id }}">
                                <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap">
                                    {{$category->name}}
                                </th>
                                <td class="px-6 py-4">{{$category->description}}</td>
                                <td class="px-6 py-4 text-right">
                                    <flux:button.group>
                                        <!-- Trigger for editing the category -->
                                        <flux:modal.trigger name="editCategoryModal-{{ $category->id }}">
                                            <flux:button type="button" wire:click="edit({{ $category->id }})">Edit</flux:button>
                                        </flux:modal.trigger>

                                        <!-- Trigger for deleting the category -->
                                        <flux:modal.trigger name="deleteCategoryModal-{{ $category->id }}">
                                            <flux:button variant="danger">Delete</flux:button>
                                        </flux:modal.trigger>
                                    </flux:button.group>
                                </td>
                            </tr>

                            <!-- Delete Category Modal -->
                            <flux:modal name="deleteCategoryModal-{{ $category->id }}" class="min-w-[22rem]">
                                <div class="space-y-6">
                                    <div>
                                        <flux:heading size="lg">Delete Category?</flux:heading>
                                        <flux:text class="mt-2">
                                            <p>You're about to delete this Category.</p>
                                            <p>This action cannot be undone.</p>
                                        </flux:text>
                                    </div>
                                    <div class="flex gap-2">
                                        <flux:spacer />
                                        <flux:modal.close>
                                            <flux:button variant="ghost">Cancel</flux:button>
                                        </flux:modal.close>
                                        <flux:button type="button" wire:click="delete({{ $category->id }})" variant="danger">Delete</flux:button>
                                    </div>
                                </div>
                            </flux:modal>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <nav class="flex flex-col flex-wrap items-center justify-start pt-4 md:justify-end md:flex-row" aria-label="Table navigation">
            <ul class="inline-flex h-8 -space-x-px text-sm rtl:space-x-reverse">
                <li>
                    <flux:modal.trigger name="addCategoryModal">
                        <flux:button type="button" variant="primary">Add new category</flux:button>
                    </flux:modal.trigger>
                </li>
            </ul>
        </nav>
    </flux:modal>

    <!-- Add Category Modal -->
    <flux:modal name="addCategoryModal" class="md:w-96" wire:ignore.self>
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Add a New Category</flux:heading>
                <flux:text class="mt-2">Enter details to add a new category to your list.</flux:text>
            </div>
            <form wire:submit.prevent="store">
                <flux:input label="Name" wire:model="name" placeholder="Category name" />

                <flux:textarea label="Description" wire:model="description" placeholder="Category description..." />

                <div class="flex pt-4">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Save changes</flux:button>
                </div>
            </form>
        </div>
    </flux:modal>

    <!-- Unique Edit Category Modal -->
    @foreach ($categories as $category)
        <flux:modal name="editCategoryModal-{{ $category->id }}" class="md:w-96" wire:ignore.self>
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Edit Category</flux:heading>
                    <flux:text class="mt-2">Modify the category name or description as needed.</flux:text>
                </div>

                <form wire:submit.prevent="update" class="space-y-4">
                    <input type="hidden" wire:model="category_id">

                    <flux:input label="Category Name" wire:model="name" placeholder="Enter category name" required />
                    @error('name') <div class="text-red-500">{{ $message }}</div> @enderror

                    <flux:textarea label="Description" wire:model="description" placeholder="Enter description" required />
                    @error('description') <div class="text-red-500">{{ $message }}</div> @enderror

                    <div class="flex pt-2">
                        <flux:button type="submit" variant="primary">Save Changes</flux:button>
                    </div>
                </form>

            </div>
        </flux:modal>
    @endforeach
</div>
