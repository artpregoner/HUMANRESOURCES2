@extends('layouts.app')
@section('title', 'Claims & Reimbursement')
@section('header', 'Claims & Reimbursement')
@section('active-header', 'Requests')

@section('content')
<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                <div class="email-title"><span class="icon"><i class="fas fa-hand-holding-usd"></i></span> Claims & Reimbursement <span class="new-messages">(1 new request)</span> </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered first">
                        <thead>
                            <tr>
                                <th>Employee Name</th>
                                <th>Claim Type</th>
                                <th>Claim Amount</th>
                                <th>Description</th>
                                <th>Date</th>
                                <th style="width: 0%">Status</th>
                                <th style="width: 0%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr style="cursor: pointer" onclick="window.location='{{ route('hr2.index')}}'">
                                <td>Art Pregoner </td>
                                <td>Travel</td>
                                <td>$320,800</td>
                                <td>Pamasahe papuntang sm fairview</td>
                                <td>10-10-2024</td>
                                <td>Rejected</td>
                                <td>
                                    <div class="btn-group ml-auto">
                                        <button class="btn btn-sm btn-outline-light">Approve</button>
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

