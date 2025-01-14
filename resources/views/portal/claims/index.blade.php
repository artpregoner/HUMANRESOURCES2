@extends('layouts.app')
@section('title', 'Claims')
@section('header', 'Claims')
@section('active-header', 'My Expenses')

@push('styles')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('template/assets/vendor/bootstrap-select/css/bootstrap-select.css') }}">
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

    {{-- ITO AY PARA SA MGA SORTED TABLE NA NAKA DEPENDE SA STATUS --}}
    <div class="accordion-regular">
        <div id="accordion3">
            <!-- Approved Claims History -->
            <div class="card">
                <div class="card-header" id="headingSeven">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseSeven"
                            aria-expanded="false" aria-controls="collapseSeven">
                            <span class="fas mr-3 fa-angle-down"></span>APPROVE CLAIMS HISTORY
                        </button>
                        <div class="float-right">
                            <h3 class="mb-0"><span class="badge badge-success">Approve</span></h3>
                        </div>
                    </h5>
                </div>
                <div id="collapseSeven" class="collapse" aria-labelledby="headingSeven" data-parent="#accordion3">
                    <div class="card-body">
                        <!-- Table for Approved Claims History -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Claim date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">09/12/2024</th>
                                    <td>Pamasahe papuntang SM Fairview</td>
                                    <td>Fuel</td>
                                    <td>$320.80</td>
                                </tr>
                                <tr>
                                    <th scope="row">09/14/2024</th>
                                    <td>Taxi fare to office</td>
                                    <td>Transport</td>
                                    <td>$120.50</td>
                                </tr>
                                <tr>
                                    <th scope="row">09/16/2024</th>
                                    <td>Hotel accommodation for business trip</td>
                                    <td>Accommodation</td>
                                    <td>$500.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Deleted Claims History -->
            <div class="card mb-2">
                <div class="card-header bg-code1" id="headingEight">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" data-toggle="collapse" data-target="#collapseEight"
                            aria-expanded="false" aria-controls="collapseEight">
                            <span class="fas mr-3 fa-angle-down"></span>DELETED CLAIMS HISTORY
                        </button>
                        <div class="float-right">
                            <h3 class="mb-0"><span class="badge badge-danger">DELETED</span></h3>
                        </div>
                    </h5>
                </div>
                <div id="collapseEight" class="collapse" aria-labelledby="headingEight" data-parent="#accordion3">
                    <div class="card-body">
                        <!-- Table for Deleted Claims History -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Claim date</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">09/10/2024</th>
                                    <td>Client dinner expense</td>
                                    <td>Meal</td>
                                    <td>$150.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">09/11/2024</th>
                                    <td>Office supplies purchase</td>
                                    <td>Office Supplies</td>
                                    <td>$80.00</td>
                                </tr>
                                <tr>
                                    <th scope="row">09/13/2024</th>
                                    <td>Conference registration fee</td>
                                    <td>Event</td>
                                    <td>$250.00</td>
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
    <script src="{{ asset('template/assets/vendor/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <script>
        $('.collapse').on('shown.bs.collapse', function() {
            $(this).parent().find(".fa-angle-down").removeClass("fa-angle-down").addClass("fa-angle-up");
        }).on('hidden.bs.collapse', function() {
            $(this).parent().find(".fa-angle-up").removeClass("fa-angle-up").addClass("fa-angle-down");
        });

        $('.panel-heading a').click(function() {
            $('.panel-heading').removeClass('active');

            //If the panel was open and would be closed by this click, do not active it
            if (!$(this).closest('.panel').find('.panel-collapse').hasClass('in'))
                $(this).parents('.panel-heading').addClass('active');
        });
    </script>
@endpush
