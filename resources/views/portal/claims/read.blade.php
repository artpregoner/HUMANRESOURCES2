@extends('layouts.app')
@section('title', 'Claims&Reimbursement')
@section('header','Claims&Reimbursement') <!--pageheader-->
@section('active-header', 'my expenses') <!--active pageheader-->
@section('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/select.bootstrap4.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('template/assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="email-title"><span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Claims & Reimbursement</div>
                <button type="button" class="btn btn-space btn-primary" onclick="window.location.href='{{ route('portal.claims.create') }}'">Request</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Claim Type</th>
                                <th>Claim Amount</th>
                                <th>Description</th>
                                <th style="width: 0%">Status</th>
                                <th style="width: 0px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Travel</td>
                                <td>$320,800</td>
                                <td>Pamasahe papuntang sm fairview</td>
                                <td>Rejected</td>
                                <td>
                                    <div class="btn-group ml-auto">
                                        <button class="btn btn-sm btn-outline-light">
                                            <i class="far fa-trash-alt"></i>
                                        </button>
                                    </div>
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

@section('scripts')
    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('template/assets/libs/js/main-js.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('template/assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('template/assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/datatables/js/data-table.js') }}"></script>
@endsection
