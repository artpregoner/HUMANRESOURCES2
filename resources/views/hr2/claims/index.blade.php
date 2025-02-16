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
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title"><span class="icon"><i class="fas fa-hand-holding-usd"></i></span>
                        Claims Request
                        <span class="new-messages badge badge-info badge-pill">{{$claimsCount}}</span>
                        <span class=" new-messages">all claims</span>
                    </div>
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
                                <tr>
                                    <td class="zero-space">
                                        <a href="#" class="btn-account" role="button">
                                            <span class="user-avatar">
                                                <img src="{{ asset('template/assets/images/user1.png') }}" alt="User Avatar" class="user-avatar-lg rounded-circle">
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
                                        @elseif ($claim->status == 'rejected')
                                            <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td class="zero-space">
                                        <a href="{{ route('hr2.claims.show', $claim->id)}}" class="btn btn-rounded btn-code3 btn-sm"><i class="fas fa-search"></i> View</a>
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

@endsection

@push('scripts')
@endpush
