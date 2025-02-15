@extends('layouts.portal')
@section('title','Home')
@section('header','Portal')<!--pageheader-->
@section('active-header', 'Home')

@section('content')
<div class="influence-profile">
    @include('components.alert.alert')
    <div class="row">
        <!-- ============================================================== -->
        <!-- Employee HOME Dashboard -->
        <!-- ============================================================== -->
        <div class="col-xl-3 col-lg-3 col-md-5 col-sm-12 col-12">
            <!-- ============================================================== -->
            <!-- employee profile profile -->
            <!-- ============================================================== -->
            <div class="card">
                <div class="card-body">
                    <div class="user-avatar text-center d-block">
                        <img src="{{ asset('template/assets/images/user1.png') }}" alt="User Avatar"
                            class="rounded-circle user-avatar-xxl">
                    </div>
                    <div class="text-center">
                        <h2 class="font-24 mb-0">{{ Auth::user()->name }}</h2>
                        {{-- <p>Project Manager @Influnce</p> --}}
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Contact Information</h3>
                    <div class="">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i>{{ Auth::user()->email }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"></i>096666666</li>
                            <li class="mb-0"><i class="fas fa-map-marker-alt mr-2"></i>Quezon City</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div>
                        <ul class="list-unstyled mb-0">
                            <h3 class="font-16">Department</h3>
                            <li class="mb-2"><i class="fas fa-building mr-2"></i>HR</li>
                            <h3 class="font-16">Position</h3>
                            <li class="mb-2"><i class="fas fa-shopping-bag mr-2"></i>qpal</li>
                            <h3 class="font-16">Join Date</h3>
                            <li class="mb-0"><i class="far fa-calendar-check mr-2"></i>January 15, 2022</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end employee profile profile -->
            <!-- ============================================================== -->
        </div>
        <div class="col-xl-9 col-lg-9 col-md-7 col-sm-12 col-12">
            <!-- ============================================================== -->
            <!-- partial content -->
            <!-- ============================================================== -->
            <div class="influence-profile-content pills-regular">
                <ul class="nav nav-pills mb-3 nav-justified" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="self-service-tab" data-toggle="pill" href="#self-service"
                            role="tab" aria-controls="self-service" aria-selected="true">SELF-SERVICE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="my-information-tab" data-toggle="pill" href="#my-information"
                            role="tab" aria-controls="my-information" aria-selected="false">MY INFORMATION</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab"
                            aria-controls="pills-review" aria-selected="false">My Recognitions</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-msg-tab" data-toggle="pill" href="#pills-msg" role="tab"
                            aria-controls="pills-msg" aria-selected="false">Employee Feedback</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!-- partial self-service -->
                    <div class="tab-pane fade show active" id="self-service" role="tabpanel" aria-labelledby="self-service-tab">
                        @include('portal.partials.self-service')
                    </div>
                    <!-- partial my information -->
                    <div class="tab-pane fade" id="my-information" role="tabpanel" aria-labelledby="my-information-tab">
                        @include('portal.partials.my-information')
                    </div>
                    <!-- home>partial content -->
                    <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg- col-md-7 col-sm-12 col-12">
                                <div class="section-block">
                                    <div class="card">
                                        <h5 class="card-header">My Recognitions</h5>
                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Award Type</th>
                                                        <th scope="col">From</th>
                                                        <th scope="col">Points</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Performance Award</td>
                                                        <td>HR Manager</td>
                                                        <td>100</td>
                                                        <td>2024-10-24</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Team Player Award</td>
                                                        <td>Project Manager</td>
                                                        <td>50</td>
                                                        <td>2024-10-20</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- home>partial content -->
                    <div class="tab-pane fade" id="pills-msg" role="tabpanel" aria-labelledby="pills-msg-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block">
                                    <div class="card">
                                        <h5 class="card-header"><i class="fab fa-rocketchat" style="font-size: 20px;" title="us" id="us"></i> Employee Feedback</h5>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="employeeFeedbackTextarea">Employee Feedback</label>
                                                    <textarea class="form-control" id="employeeFeedbackTextarea" rows="3" placeholder="Share your thoughts, suggestions, or concerns..."></textarea>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
