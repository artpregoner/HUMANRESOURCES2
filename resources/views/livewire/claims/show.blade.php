<div>
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-4">
                    <div class="float-left">
                        <h3 class="mb-0">
                            @if ($status == 'approved')
                                <span class="badge badge-success">Approved</span>
                            @elseif ($status == 'pending')
                                <span class="badge badge-info">Pending</span>
                            @elseif ($status == 'submitted')
                                <span class="badge badge-light">Submitted</span>
                            @elseif ($status == 'unapproved')
                                <span class="badge badge-warning">Unapprove</span>
                            @elseif ($status == 'rejected')
                                <span class="badge badge-danger">Rejected</span>
                            @endif
                        </h3>

                        @if ($status === 'approved' && $approverName)
                            <span>Approved by: <span class="text-dark font-weight-bold">{{ $approverName }}</span></span>
                        @elseif ($status === 'rejected' && $rejectedBy)
                            <span>Rejected by: <span class="text-dark font-weight-bold">{{ $rejectedBy }}</span></span>
                        @elseif ($status === 'unapproved' && $unapprovedBy)
                            <span>Unapproved by: <span class="text-dark font-weight-bold">{{ $unapprovedBy }}</span></span>
                        @endif
                    </div>
                    <div class="float-right">
                        <h3 class="mb-0">Invoice #{{ $claim->id }}</h3>
                        Claims
                    </div>
                </div>
                <div class="card-body">
                    <!-- User Information -->
                    <div class="row">
                        <div class="form-group col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                            <div class="btn-account">
                                <span class="user-avatar">
                                    <img src="{{ $claim->user->avatar_url ?? asset('template/assets/images/user1.png') }}" alt="User Avatar" class="user-avatar-lg rounded-circle">
                                </span>
                                <div class="account-summary">
                                    <h5 class="account-name">{{ $claim->user->name ?? 'N/A' }}</h5>
                                    <span class="account-description">{{ $claim->user->email ?? 'N/A' }}</span>
                                    @if($claim->assigned_to_id)
                                    <small class="text-muted d-block">Assigned to: {{ $claim->assignedTo->name ?? 'N/A' }}</small>
                                     @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 text-right">
                            <small class="text-muted">Submitted by: {{ $claim->submittedBy->name ?? 'N/A' }}</small>
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
                            <label for="validationCustom03">Expense Data</label>
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
                                    <th scope="row" colspan="2" class="text-right">Total:</th>
                                    <th class="text-right">{{ number_format($claim->total_amount, 2) }}</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body border-top">
                    <div class="form-group row text-right">
                        <div class="col-sm-6 text-left">
                            @if (!$isOwner) {{-- Only show if the logged-in user is NOT the owner --}}
                                @if($status !== 'rejected')
                                    <button wire:click="approve" class="btn btn-space {{ $status === 'approved' ? 'btn-warning' : 'btn-code3' }}">
                                        {{ $status === 'approved' ? 'Unapprove' : 'Approve' }}
                                    </button>
                                @endif
                                @if($status !== 'approved')
                                    <button wire:click="reject" class="btn btn-space {{ $status === 'rejected' ? 'btn-warning' : 'btn-danger' }}">
                                        {{ $status === 'rejected' ? 'Unreject' : 'Reject' }}
                                    </button>
                                @endif
                            @endif
                        </div>
                        @php
                            $role = Auth::user()->role;
                            $redirectRoute = match ($role) {
                                'admin' => 'admin.claims.index',
                                'hr' => 'hr2.claims.index',
                                default => null,
                            };
                        @endphp
                        @if ($redirectRoute)
                            <div class="col-sm-6 text-right">
                                <a href="{{ route($redirectRoute) }}" class="btn btn-light btn-space">Cancel</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <div class="row">
        <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body border-top">
                    <div class="form-group row text-right">
                        <div class="col-sm-6 col-sm-6 text-left">
                            @if($status !== 'rejected')
                                <button wire:click="approve" class="btn btn-space {{ $status === 'approved' ? 'btn-warning' : 'btn-code3' }}">
                                    {{ $status === 'approved' ? 'Unapprove' : 'Approve' }}
                                </button>
                            @endif
                            @if($status !== 'approved')
                                <button wire:click="reject" class="btn btn-space {{ $status === 'rejected' ? 'btn-warning' : 'btn-danger' }}">
                                    {{ $status === 'rejected' ? 'Unreject' : 'Reject' }}
                                </button>
                            @endif
                        </div>
                        @php
                            $role = Auth::user()->role;
                            $redirectRoute = match ($role) {
                                'admin' => 'admin.claims.index',
                                'hr' => 'hr2.claims.index',
                                default => null,
                            };
                        @endphp
                        @if ($redirectRoute)
                            <div class="col-sm-6 col-sm-6 text-right">
                                <a href="{{ route($redirectRoute) }}" class="btn btn-light btn-space">Cancel</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
