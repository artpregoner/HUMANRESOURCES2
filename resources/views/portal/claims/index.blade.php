@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'My Expenses')

@section('content')
    @include('components.alert.alert')

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title">
                        <span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Claims & Reimbursement
                    </div>
                    <button type="button" class="btn btn-space btn-code3"
                        onclick="window.location.href='{{ route('portal.claims.create') }}'">
                        <i class="fas fa-plus"></i> Add Expense Claim
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Expense Date/Time</th>
                                    <th>Details</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($claims as $claim)
                                    <tr style="cursor: pointer" data-toggle="modal" data-target="#showClaims">
                                        <td>{{ \Carbon\Carbon::parse($claim->expense_date)->format('m/d/Y h:i A') }}</td>
                                        <td>
                                            <ul class="mb-0 list-unstyled">
                                                @foreach ($claim->items as $item)
                                                    <li>{{ $item->details }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                        <td>${{ number_format($claim->total_amount, 2) }}</td>
                                        <td>
                                            @if ($claim->status == 'Approved')
                                                <span class="badge badge-success">Approved</span>
                                            @elseif ($claim->status == 'Pending')
                                                <span class="badge badge-info">Pending</span>
                                            @elseif ($claim->status == 'submitted')
                                                <span class="badge badge-light">Submitted</span>
                                            @elseif ($claim->status == 'Rejected')
                                                <span class="badge badge-danger">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center">No claims found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @include('portal.claims.show')
                </div>
            </div>
        </div>
    </div>
@endsection
