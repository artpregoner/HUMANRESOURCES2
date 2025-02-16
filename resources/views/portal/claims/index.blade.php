@extends('layouts.portal')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'My Expenses')

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
                    <div class="email-title">
                        <span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Claims & Reimbursement
                        <span class="new-messages badge badge-info badge-pill">{{ $claims->count() }}</span>
                        <span class=" new-messages">all claims</span>
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
                                    <th class="center" style="width: 105px;">Expense Date/Time</th>
                                    <th>Details</th>
                                    <th style="width: 90px;">Total Amount</th>
                                    <th style="width: 60px;">Status</th>
                                    <th class="right" style="width: 90px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($claims as $claim)
                                    <tr>
                                        <td>{{ \Carbon\Carbon::parse($claim->expense_date)->format('M/d/Y - h:i A') }}</td>
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
                                        <td class="right">
                                            <div class="btn-group ml-auto">
                                                <form action="{{ route('portal.claims.destroy', $claim->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure you want to archive this claim?');">
                                                        <i class="far fa-trash-alt"></i> Archive
                                                    </button>
                                                </form>
                                                <a href="{{ route('portal.claims.show', $claim->id)}}" class="btn btn-rounded btn-code3 btn-sm"><i class="fas fa-search"></i> View</a>
                                            </div>
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
            <a href="{{ route('portal.claims.trash') }}" class="card-link">
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
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    $('.dataTable').DataTable({
        "order": [] // Disable automatic sorting
    });
});
</script>
@endpush
