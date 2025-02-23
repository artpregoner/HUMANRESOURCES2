{{-- Create a new file: resources/views/portal/claims/claim_details.blade.php --}}
<div class="card-body">
    <!-- User Information -->
    <div class="row">
        <div class="form-group col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
            <div class="btn-account">
                <span class="user-avatar">
                    <img src="{{ $claim->user->profile_photo_path ? Storage::url($claim->user->profile_photo_path) : asset('template/assets/images/avatar-1.jpg') }}"
                        alt="User Avatar" class="user-avatar-lg rounded-circle">
                </span>
                <div class="account-summary">
                    <h5 class="account-name">{{ $claim->user->name }}</h5>
                    <span class="account-description">{{ $claim->user->email }}</span>
                    @if($claim->assigned_to_id)
                        <small class="text-muted d-block">Assigned to: {{ $claim->assignedTo->name }}</small>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6 text-right">
            <small class="text-muted">Submitted by: {{ $claim->submittedBy->name }}</small>
            <h3 class="mb-0">Claims #{{ $claim->id }}</h3>
        </div>
    </div>

    <div class="form-group">
        <label for="currencySelector">Currency</label>
        <select class="custom-select d-block w-100 col-sm-2" id="currencySelector" disabled>
            <option>{{ $claim->currency }}</option>
        </select>
    </div>

    <!-- Description -->
    <div class="row">
        <div class="form-group col-12">
            <label for="inputDescription">Description</label>
            <input value="{{ $claim->description }}" id="inputDescription" type="text" class="form-control" disabled>
        </div>
    </div>

    <!-- Comments -->
    <div class="row">
        <div class="form-group col-12">
            <label for="inputComments">Comments</label>
            <textarea class="form-control" rows="6" disabled>{{ $claim->comments }}</textarea>
        </div>
    </div>

    <!-- Dates -->
    <div class="form-row">
        <div class="col-md-4 mb-2">
            <label>Expense Date</label>
            <input value="{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}"
                type="text" class="form-control" disabled>
        </div>
        <div class="col-md-4 mb-2">
            <label>Submitted Date</label>
            <input value="{{ \Carbon\Carbon::parse($claim->submitted_date)->format('M d, Y - h:i A') }}"
                type="text" class="form-control" disabled>
        </div>
        <div class="col-md-4 mb-2">
            <label>Approved Date</label>
            <input value="{{ $claim->approved_date ? \Carbon\Carbon::parse($claim->approved_date)->format('M d, Y') : 'N/A' }}"
                type="text" class="form-control" disabled>
        </div>
    </div>

    <!-- Items Table -->
    <div class="table-responsive-sm mt-4">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Details</th>
                    <th class="text-right">Amount ({{ $claim->currency }})</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($claim->items as $item)
                    <tr>
                        <td>{{ $item->category->name }}</td>
                        <td>{{ $item->details }}</td>
                        <td class="text-right">{{ number_format($item->amount, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <th colspan="2" class="text-right">Total:</th>
                    <th class="text-right">{{ number_format($claim->total_amount, 2) }}</th>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Reimbursement Checkbox -->
    @if($claim->reimbursement_required)
        <div class="border-top pt-3">
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" checked disabled>
                <label class="custom-control-label">Reimbursement is required for this expense claim</label>
            </div>
        </div>
    @endif

    <!-- Attachments -->
    <div class="border-top pt-3">
        <h6 class="mb-3">Attachments</h6>
        <div class="row">
            @forelse($claim->attachments as $attachment)
                <div class="col-12">
                    <div class="media media-attachment">
                        <div class="avatar bg-primary">
                            <i class="far fa-file-image"></i>
                        </div>
                        <div class="media-body">
                            <a href="{{ Storage::url($attachment->file_path) }}" class="d-block text-truncate" target="_blank">
                                {{ $attachment->file_name }}
                            </a>
                            <span class="text-muted">
                                {{ number_format($attachment->file_size / 1048576, 2) }} MB
                                <small class="text-muted ml-2">{{ $attachment->file_type }}</small>
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-muted mb-0">No attachments found</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
