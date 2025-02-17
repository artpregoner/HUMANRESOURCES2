@extends('layouts.app')
@section('title','Human Resources')
@section('header','Human Resources')
@section('active-header', 'Dashboard') <!--Example :)-->

@section('content')
@include('components.alert.alert')

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

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block">
            <h3 class="section-title">Claims&Reimbursement Section</h3>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <livewire:claims.claims-status-count />
    </div>

    <!-- Total Employee -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">Total Claims</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ $totalClaims }}</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Helpdesk Tickets -->
    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
        <div class="card border-3 border-top border-top-primary">
            <div class="card-body">
                <h5 class="text-muted">New Claims</h5>
                <div class="metric-value d-inline-block">
                    <h1 class="mb-1">{{ $newSubmittedClaims }}</h1>
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
</div>

<div class="card-body border-top"></div>


<!-- Dashboard Cards Section -->
<div class="row">
    <!-- Employee Self-service -->
    <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12">
        <div class="card">
            <h5 class="card-header"><i class="fas fa-user-circle"></i> Employee Self-service</h5>
            <div class="card-body p-0">
                <ul class="country-sales list-group list-group-flush">
                    <li class="list-group-item">Pending Leave Requests <span class="float-right text-dark">7</span></li>
                    <li class="list-group-item">Schedule Changes <span class="float-right text-dark">7</span></li>
                    <li class="list-group-item">Document Requests <span class="float-right text-dark">4</span></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Helpdesk -->
    <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12">
        <div class="card">
            <h5 class="card-header"><i class="fas fa-headphones"></i> Helpdesk</h5>
            <div class="card-body p-0">
                <ul class="country-sales list-group list-group-flush">
                    <li class="list-group-item">Open Tickets <span class="float-right text-dark">3</span></li>
                    <li class="list-group-item">Resolved Today <span class="float-right text-dark">12</span></li>
                    <li class="list-group-item">Avg. Response Time <span class="float-right text-dark">2.5h</span></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Claims & Reimbursement -->
    <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12">
        <div class="card">
            <h5 class="card-header"><i class="fas fa-hand-holding-usd"></i> Claims & Reimbursement</h5>
            <div class="card-body p-0">
                <ul class="country-sales list-group list-group-flush">
                    <li class="list-group-item">Pending Claims <span class="float-right text-dark">3</span></li>
                    <li class="list-group-item">Processed Today <span class="float-right text-dark">7</span></li>
                    <li class="list-group-item">Total Pending Amount <span class="float-right text-dark">₱45,670</span></li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Workforce Analytics -->
    <div class="col-xl-3 col-lg-12 col-md-6 col-sm-12">
        <div class="card">
            <h5 class="card-header"><i class="fas fa-chart-line"></i> Workforce Analytics</h5>
            <div class="card-body p-0">
                <ul class="country-sales list-group list-group-flush">
                    <li class="list-group-item">Attendance Rate <span class="float-right text-dark">78%</span></li>
                    <li class="list-group-item">Productivity Score <span class="float-right text-dark">7%</span></li>
                    <li class="list-group-item">Turnover Rate <span class="float-right text-dark">4%</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="card-body border-top"></div>

<!-- Employee Feedback Section -->
<div class="row">
    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">Well Done!</h4>
                    <p>Great job on the recent project! Your hard work is appreciated.</p>
                    <hr>
                    <p class="mb-0">Keep up the excellent work and continue to communicate openly with your team.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">Fantastic Effort!</h4>
                    <p>Thank you for your dedication to improving our processes. Your input is valuable.</p>
                    <hr>
                    <p class="mb-0">Let’s continue to work together to achieve our goals.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card">
            <div class="card-body border-top">
                <div class="alert alert-primary" role="alert">
                    <h4 class="alert-heading">Great Collaboration!</h4>
                    <p>Your teamwork on the recent task has made a significant impact. Thank you!</p>
                    <hr>
                    <p class="mb-0">Keep sharing your ideas and feedback with the team!</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


