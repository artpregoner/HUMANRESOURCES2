@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'Employee Requests')

@push('styles')
<style>
    th, td {
        white-space: nowrap; /* Prevent text wrapping for better spacing */
        text-align: center; /* Center align text */
    }
</style>
@endpush

@section('content')
    @include('components.alert.alert')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title"><span class="icon"><i class="fas fa-hand-holding-usd"></i></span>
                        Claims Request
                        <span class="new-messages badge badge-info badge-pill">{{$claimsCount}}</span>
                        <span class=" new-messages">all claims</span>
                    </div>
                    <!-- the modal button-->
                    <a href="#" class="btn btn-code3 btn-space" data-toggle="modal" data-target="#categoryModal">
                        Add new category
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first dataTable">
                            <thead>
                                <tr>
                                    <th class="center" style="width: 105px;">Employee</th>
                                    <th>Details</th>
                                    <th style="width: 90px;">Total Amount</th>
                                    <th style="width: 105px;">Expense date</th>
                                    <th style="width: 60px;">Status</th>
                                    <th class="right" style="width: 90px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($claims as $claim)
                                <tr class="view-claim" data-claim-id="{{ $claim->id }}" style="cursor: pointer">
                                    <td class="zero-space">
                                        <a href="#" class="btn-account" role="button">
                                            <span class="user-avatar">
                                                <img src="{{ $claim->user->profile_photo_path ? Storage::url($claim->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}"
                                                alt="User Avatar" class="user-avatar-lg rounded-circle">
                                            </span>
                                            <div class="account-summary">
                                                <h5 class="account-name">{{ $claim->user->name ?? 'Unknown User' }}</h5>
                                                <span class="account-description">{{ $claim->user->email ?? 'No Email' }}</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <ul class="mb-0 list-unstyled">
                                            @foreach ($claim->items as $item)
                                                <li>{{ $item->details }}</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>
                                        @php
                                            $currencySymbols = [
                                                'USD' => '$',
                                                'PHP' => '₱',
                                            ];
                                            $symbol = $currencySymbols[$claim->currency] ?? $claim->currency;
                                        @endphp
                                        {{ $claim->currency }} | {{ $symbol }}{{ number_format($claim->total_amount, 2) }}
                                    </td>
                                    <td>{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}</td>
                                    <td>
                                        @if ($claim->status == 'approved')
                                            <span class="badge badge-success">Approved</span>
                                        @elseif ($claim->status == 'pending')
                                            <span class="badge badge-info">Pending</span>
                                        @elseif ($claim->status == 'submitted')
                                            <span class="badge badge-light">Submitted</span>
                                        @elseif ($claim->status == 'unapproved')
                                            <span class="badge badge-warning">Unapproved</span>
                                        @elseif ($claim->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="zero-space">
                                        <form action="{{ route('admin.claims.destroy', $claim->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm except-button"
                                                onclick="return confirm('Are you sure you want to archive this claim?');">
                                                <i class="far fa-trash-alt"></i> Archive
                                            </button>
                                        </form>
                                        <a href="{{ route('admin.claims.show', $claim->id)}}" class="btn btn-rounded btn-code3 btn-sm except-button"><i class="fas fa-search"></i> View</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Claims Trash - Show Count of Deleted Claims -->
    <div class="row">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <a href="{{ route('admin.claims.trash') }}" class="card-link">
                <div class="card">
                    <div class="card-body">
                        <div class="d-inline-block">
                            <h5 class="text-muted">Archived Claims</h5>
                            <h2 class="mb-0">{{ $archivedClaimsCount }}</h2> <!-- Display deleted claims count -->
                        </div>
                        <div class="float-right icon-circle-medium icon-box-lg bg-danger-light mt-1">
                            <i class="fas fa-archive fa-sm text-danger"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="categoryModalLabel">Manage Categories</h5>
                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr class="border-0">
                                    <th class="border-0">Name</th>
                                    <th class="border-0">Description</th>
                                    <th class="border-0">Used Count</th>
                                    <th class="border-0">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->description }}</td>
                                    <td>{{ $category->claims_count }}</td>
                                    <td>
                                        <!-- Button to trigger update modal -->
                                        <button class="btn btn-sm btn-code3" data-toggle="modal" data-target="#editCategoryModal"
                                            data-id="{{ $category->id }}" data-name="{{ $category->name }}" data-description="{{ $category->description }}">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-code3" data-toggle="modal" data-target="#addCategoryModal">
                        <i class="fas fa-plus"></i> Add New Category
                    </button>
                    <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>


    <!-- Edit Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateCategoryForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" id="editCategoryId" name="category_id">
                        <div class="form-group">
                            <label for="editCategoryName">Category Name</label>
                            <input type="text" id="editCategoryName" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="editCategoryDescription">Description</label>
                            <textarea id="editCategoryDescription" name="description" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Add Category Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add New Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.categories.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="categoryName">Category Name</label>
                            <input type="text" id="categoryName" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="categoryDescription">Description</label>
                            <textarea id="categoryDescription" name="description" class="form-control" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <!-- Claim Details Modal -->
    <div class="modal fade" id="claimModal" tabindex="-1" role="dialog" aria-labelledby="claimModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="claimModalLabel">Claim Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="loading-spinner text-center">
                        <i class="dashboard-spinner spinner-info spinner-md"></i>
                    </div>
                    <div id="claimDetails" style="display: none;">
                        <!-- Claim details will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    $('#editCategoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var description = button.data('description');

        var modal = $(this);
        modal.find('#editCategoryId').val(id);
        modal.find('#editCategoryName').val(name);
        modal.find('#editCategoryDescription').val(description);

        // Update form action dynamically
        $('#updateCategoryForm').attr('action', '/claims/categories/' + id);
    });
</script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('.dataTable').DataTable({
            "order": []
        });

        // Handle claim view clicks
        $('.view-claim').click(function() {
            const claimId = $(this).data('claim-id');
            const modal = $('#claimModal');


            // Prevent modal from opening if clicking Delete or View
            if ($(event.target).closest('.except-button').length) {
                return;
            }
            // Show modal with loading state
            modal.modal('show');
            $('#claimDetails').hide();
            $('.loading-spinner').show();

            // Fetch claim details
            $.ajax({
                url: `/claims/${claimId}/details`,
                method: 'GET',
                success: function(response) {
                    // Hide loading spinner and show claim details
                    $('.loading-spinner').hide();
                    $('#claimDetails').html(response).show();

                },
                error: function(xhr) {
                    // Handle error
                    $('.loading-spinner').hide();
                    $('#claimDetails').html(
                        '<div class="alert alert-danger">Failed to load claim details. Please try again.</div>'
                    ).show();
                }
            });
        });
    });
</script>
@endpush
