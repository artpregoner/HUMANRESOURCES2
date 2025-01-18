@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'My Expenses')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title"><span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Claims &
                        Reimbursement</div>
                    <button type="button" class="btn btn-space btn-code3"
                        onclick="window.location.href='{{ route('portal.claims.create') }}'"><i class="fas fa-plus"></i> Add
                        Expense Claim</button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first">
                            <thead>
                                <tr>
                                    <th>Claim ID</th>
                                    <th>Claim Date</th>
                                    <th>Description</th>
                                    <th>Category</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr style="cursor: pointer" data-toggle="modal" data-target="#showClaims">
                                    <td>C200</td>
                                    <td>09/12/2024</td>
                                    <td>Pamasahe papuntang sm fairview</td>
                                    <td>Fuel</td>
                                    <td>$320,800</td>
                                    <td><span class="badge badge-success">Approved</span></td>
                                    {{-- <td>
                                    @if ($request->status == 'Approved')
                                        <span class="badge badge-success">Approved</span>
                                    @elseif ($request->status == 'Pending')
                                        <span class="badge badge-info">Pending</span>
                                    @elseif ($request->status == 'Rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @endif
                                </td> --}}
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @include('portal.claims.show')
                </div>
            </div>
        </div>
    </div>
@endsection



