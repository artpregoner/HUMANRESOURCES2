@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'Employee Requests')

@push('styles')
@endpush

@section('content')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                    <div class="email-title"><span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Claims &
                        Reimbursement
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered first dataTable">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Details</th>
                                    <th>Amount</th>
                                    <th>Created</th>
                                    <th>Actioned By</th>
                                    <th colspan="2">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="zero-space">
                                        <a href="#" class="btn-account" role="button">
                                            <span class="user-avatar">
                                                  <img src="{{ asset('template/assets/images/user1.png')}}" alt="User Avatar" class="user-avatar-lg rounded-circle">
                                            </span>
                                            <div class="account-summary">
                                                <h5 class="account-name">John Abraham</h5>
                                                <span class="account-description">Department</span>
                                            </div>
                                        </a>
                                    </td>
                                    <td>
                                        <ul class="mb-0 list-unstyled">
                                            <li>Example 1</li>
                                            <li>Example 2</li>
                                        </ul>
                                    </td>{{-- section for details expenses --}}
                                    <td>300</td>
                                    <td>01/18/2025</td>
                                    <td>Abubakar Khumag</td>
                                    <td class="zero-space"><span class="badge badge-success">Approved</span></td>
                                    {{-- <td>
                                        @if ($request->status == 'Approved')
                                        <span class="badge badge-success">Approved</span>
                                        @elseif ($request->status == 'Pending')
                                        <span class="badge badge-info">Pending</span>
                                        @elseif ($request->status == 'Rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                        @endif
                                    </td> --}}
                                    <td class="zero-space">
                                        <a href="#" class="btn btn-rounded btn-code3"><i class="fas fa-search"></i> View</a>
                                    </td>
                                </tr>
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
