@extends('layouts.portal')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'My claims invoice')

@push('styles')
    {{-- <style>
    th, td {
        white-space: nowrap; /* Prevent text wrapping for better spacing */
        text-align: center; /* Center align text */
    }
</style> --}}
@endpush

@section('content')
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    <div class="float-right">
                        <h3 class="mb-0">
                            <span class="badge {{ $statusBadge }}">
                                {{ ucfirst($claim->status) }}
                            </span>
                        </h3>

                        <span>{{ $actionedBy }}</span>
                    </div>


                    <div class="float-left">
                        <h3 class="mb-0">Expense Claim</h3>
                        Claims # {{ $claim->id }}
                    </div>
                </div>

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
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="currencySelector">
                            Currency
                        </label>
                        <select class="custom-select d-block w-100 col-sm-2" id="currencySelector"
                            disabled>
                            <option>{{ $claim->currency }}</option>
                        </select>
                    </div>
                    <!-- Description of the claim -->
                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="inputDescription" class="col-form-label">Description</label>
                            <input value="{{ $claim->description }}" id="inputDescription" type="text" class="form-control" placeholder="" disabled>
                        </div>
                    </div>

                    <!-- Optional comments field -->
                    <div class="row">
                        <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <label for="inputComments">Comments</label>
                            <textarea class="form-control" type="text" rows="6" disabled>{{ $claim->comments}}</textarea>
                        </div>
                    </div>

                    <!-- expenses date-->
                    <div class="form-row">
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="validationCustom03">Expense Date</label>
                            <input value="{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}"
                                type="text" class="form-control" id="validationCustom03" placeholder="date" disabled>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="validationCustom04">Submitted Date</label>
                            <input value="{{ Carbon\Carbon::parse($claim->submitted_date)->format('M d, Y - h:i A') }}"
                                type="text" class="form-control" id="validationCustom04" placeholder="date" disabled>
                        </div>
                        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                            <label for="validationCustom05">Approved Date</label>
                            <input value="{{ $claim->approved_date ? Carbon\Carbon::parse($claim->approved_date)->format('M d, Y') : 'N/A' }}" type="text" class="form-control"
                                id="validationCustom05" placeholder="date" disabled>
                        </div>
                    </div>
                    <div class="table-responsive-sm">
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
                                        <td class="left">{{ $item->category->name }}</td>
                                        <td class="left">{{ $item->details }}</td>
                                        <td class="text-right">{{ number_format($item->amount, 2) }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <th scope="row" colspan="2" class="text-right">Total ({{ $claim->currency }}):</th>
                                    <th class="text-right">{{ number_format($claim->total_amount, 2) }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                @if($claim->reimbursement_required)
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-sm-6 d-flex align-items-center">
                            <label class="custom-control custom-checkbox mb-0">
                                <input type="checkbox" class="custom-control-input" name="reimbursement_required" checked
                                    disabled>
                                <span class="custom-control-label">Reimbursement is required for this expense
                                    claim</span>
                            </label>
                        </div>
                    </div>
                </div>
                @endif


                <!-- Attachments Section -->
                <div class="card-body border-top">
                    <div class="row">
                        @forelse($claim->attachments as $attachment)
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
                        @empty
                        <div class="col-12">
                            <p class="text-muted mb-0">No attachments found</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <!-- Footer Section -->
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h5 class="mb-2">Payroll Status</h5>

                            <div>Status: Processing</div>
                            <div>Paid At: June 3 2025</div>
                            <div>Actioned by: hr manager</div>
                            <div>Remarks: ok na to!</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">

    </div>
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <!-- Footer Section -->
                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-sm-6 col-sm-6 text-left">
                            <a href="{{ route('claims.download-pdf', $claim->id) }}" class="btn btn-code3 btn-space">
                                Download PDF
                            </a>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{ route('portal.claims.index') }}" class="btn btn-light btn-space">Back to Lists</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
