<div>
    <!-- Main Categories Modal -->
    <div class="modal fade" id="categoryModal" wire:ignore.self>
        <div class="modal-dialog modal-xxl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Manage Categories</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (session()->has('success'))
                        <div class="alert alert-success" wire:poll.5000ms>{{ session('success') }}</div>
                    @endif
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0" style="width: 60px;">Action</th>
                                </tr>
                            </thead>
                            <tbody wire:listen('refreshCategories')>
                                @foreach($categories as $category)
                                    <tr wire:key="{{ $category->id }}">
                                        <td>{{ $category->category_name }}</td>
                                        <td>{{ $category->description }}</td>
                                        <td>
                                            <button wire:click="edit({{ $category->id }})" class="btn btn-sm btn-code3">
                                                Edit
                                            </button>
                                            <button wire:click="delete({{ $category->id }})" class="btn btn-sm btn-danger">
                                                Delete
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-code3" wire:click="$dispatch('showAddModal')" data-toggle="modal" data-target="#addCategoryModal">
                        <i class="fas fa-plus"></i> Add New Category
                    </button>
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="store">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" wire:model="category_name" id="categoryName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="categoryDescription">Description</label>
                            <textarea wire:model="description" id="categoryDescription" class="form-control" required></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Add Category</button>
                            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" wire:ignore.self>
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <input type="hidden" wire:model="category_id">
                        <div class="form-group">
                            <label for="editCategoryName">Category Name</label>
                            <input type="text" wire:model="category_name" id="editCategoryName" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="editCategoryDescription">Description</label>
                            <textarea wire:model="description" id="editCategoryDescription" class="form-control"></textarea>
                        </div>
                        <div class="modal-footer">
                            <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                            <button type="submit" class="btn btn-success">Update Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
