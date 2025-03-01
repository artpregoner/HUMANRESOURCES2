@extends('layouts.app')
@section('title','Human Resources')
@section('header','Human Resources')
@section('active-header', 'Dashboard') <!--Example :)-->

@section('content')
    @include('components.alert.alert')

    <div class="ecommerce-widget">

        <!-- Dashboard Metrics Section -->
        <div class="row">
            <!-- Total Employee -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Total Employee</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">{{ $totalUsers }}</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Helpdesk Tickets -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Helpdesk Tickets</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">0</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Claims & Reimbursement -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">Claims & Reimbursement</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">14</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- New Hires -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                <div class="card border-3 border-top border-top-primary">
                    <div class="card-body">
                        <h5 class="text-muted">New Hires</h5>
                        <div class="metric-value d-inline-block">
                            <h1 class="mb-1">0</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body border-top"></div>

        <!-- Claims & Reimbursement Section -->
        @include('claims.claims-section')
    </div>
@endsection


