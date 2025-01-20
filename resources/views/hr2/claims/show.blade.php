@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'Employee Claims Details')

@push('styles')

@endpush

@section('content')
    <div class="row">
        <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
            <div class="card">
                <div class="card-header p-2">
                    <div class="float-left">
                        <div class="email-title">
                            <span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Expense Claim
                        </div>
                    </div>
                    <div class="float-right">
                        <h3 class="mb-0"><span class="badge badge-info">Pending</span></h3>
                        {{-- <h3 class="mb-0">
                                    @if ($request->status == 'Approved')
                                        <span class="badge badge-success">Approve</span>
                                    @elseif ($request->status == 'Pending')
                                        <span class="badge badge-info">Pending</span>
                                    @elseif ($request->status == 'Rejected')
                                        <span class="badge badge-danger">Reject</span>
                                    @endif
                                </h3> --}}
                        {{-- <span>by: cute</span> <!-- kung may roon na approved--> --}}
                    </div>
                </div>
                <div class="card-body">
                    <!-- Form for basic claim request details -->
                    <form action="#" id="basicform" data-parsley-validate="">
                        <!-- Select recipient of the claim -->
                        <div class="row">
                            <div class="form-group col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                                <a href="#" class="btn-account" role="button">
                                    <span class="user-avatar">
                                          <img src="{{ asset('template/assets/images/user1.png')}}" alt="User Avatar" class="user-avatar-lg rounded-circle">
                                    </span>
                                    <div class="account-summary">
                                        <h5 class="account-name">John Abraham ddawdawd</h5>
                                        <span class="account-description">Department</span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <!-- Description of the claim -->
                        <div class="row">
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="inputDescription" class="col-form-label">Description</label>
                                <input id="inputDescription" type="text" class="form-control" placeholder="" disabled>
                            </div>
                        </div>

                        <!-- Optional comments field -->
                        <div class="row">
                            <div class="form-group col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <label for="inputComments">Comments</label>
                                <textarea class="form-control" id="inputComments" rows="3" disabled></textarea>
                            </div>
                        </div>

                        <!-- expenses date-->
                        <div class="form-row">
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom03">Expense Data</label>
                                <input type="text" class="form-control" id="validationCustom03" placeholder="date" disabled>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom04">Submitted Date</label>
                                <input type="text" class="form-control" id="validationCustom04" placeholder="date" disabled>
                            </div>
                            <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                                <label for="validationCustom05">Approved Date</label>
                                <input type="text" class="form-control" id="validationCustom05" placeholder="date" disabled>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body border-top">
                    <!-- Expense Table -->
                    <div class="table-responsive-sm offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Details</th>
                                    <th class="right">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="left strong">Origin License</td>
                                    <td class="left">Extended License</td>
                                    <td class="right">0</td>
                                </tr>
                                <tr>
                                    <td class="left">Custom Services</td>
                                    <td class="left">Installation and Customization (cost per hour)</td>
                                    <td class="right">0</td>
                                </tr>
                                <tr><!--Important table row, this is for total amount of expenses-->
                                    <th scope="row" colspan="2">Total:</th>
                                    <td>0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <!-- Checkbox for reimbursement -->
                        <div class="col-sm-6 d-flex align-items-center">
                            <label class="custom-control custom-checkbox mb-0">
                                <input type="checkbox" class="custom-control-input" name="reimbursement_required" checked disabled>
                                <span class="custom-control-label">Reimbursement is required for this expense
                                    claim</span>
                            </label>
                        </div>
                    </div>
                    <div class="card-body border-top">
                        <div class="row">
                            <div class="media media-attachment">
                                <div class="avatar bg-primary">
                                    <i class="far fa-file-image"></i>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="">receipt.png</a>
                                    <span>24kb Document</span>
                                </div>
                            </div>
                            <div class="media media-attachment">
                                <div class="avatar bg-primary">
                                    <i class="far fa-file-image"></i>
                                </div>
                                <div class="media-body">
                                    <a href="#" class="">receipt.png</a>
                                    <span>24kb Document</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header">Approval Panel</h5>
                <div class="card-body">
                    <a href="#" class="btn btn-success btn-space float-left">Approved</a>
                    <a href="#" class="btn btn-danger btn-space float-right">Rejected</a>
                </div>
                <div class="card-body border-top">
                    <a href="{{ route('hr2.claims.index')}}" class="btn btn-light btn-block">Cancel</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')

@endpush
