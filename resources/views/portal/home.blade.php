@extends('layouts.portal')
@section('title','Home')
@section('header','Portal')<!--pageheader-->
@section('active-header', 'Home')

@section('content')
<div class="influence-profile">
    @include('components.alert.alert')
    {{-- <div class="row">
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
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}" alt="User Avatar"
                            class="rounded-circle user-avatar-xxl">
                    </div>
                    <div class="text-center">
                        <h2 class="font-24 mb-0">{{ Auth::user()->name }}</h2>
                        <p>{{ Auth::user()->employeeDetails->designation }}</p>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Contact Information</h3>
                    <div class="">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i>{{ Auth::user()->email }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"></i>{{ Auth::user()->personalInformation->phone_number ?? 'N/A' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-calendar-check mr-2"></i>{{ Auth::user()->personalInformation->date_of_birth->format('F d, Y') ?? 'N/A' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-map-marker-alt mr-2"></i>{{ Auth::user()->personalInformation->address ?? 'N/A' }},
                                {{ Auth::user()->personalInformation->city ?? 'N/A' }},
                                {{ Auth::user()->personalInformation->state ?? 'N/A' }},
                                {{ Auth::user()->personalInformation->country ?? 'N/A' }}
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div>
                        <h3 class="font-16">Emergency Contact Information</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-fw fa-user mr-2"></i>{{ Auth::user()->personalInformation->emergency_contact_name ?? 'N/A' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"></i>{{ Auth::user()->personalInformation->emergency_contact_number ?? 'N/A' }}</li>
                            <li class="mb-2"><i class="fas fa-fw fa-handshake mr-2"></i>{{ Auth::user()->personalInformation->emergency_relationship ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div>
                        <ul class="list-unstyled mb-0">
                            <h3 class="font-16">Last Login</h3>
                            <li class="mb-2"><i class="far fa-calendar-check mr-2"></i>{{ Auth::user()->last_login ? Auth::user()->last_login->format('F d, Y h:i A') : 'Never logged in' }}</li>
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
                            role="tab" aria-controls="my-information" aria-selected="false">EMPLOYEE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab"
                            aria-controls="pills-review" aria-selected="false">PERSONAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-msg-tab" data-toggle="pill" href="#pills-msg" role="tab"
                            aria-controls="pills-msg" aria-selected="false">FEEDBACK</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!-- partial self-service -->
                    <div class="tab-pane fade show active" id="self-service" role="tabpanel" aria-labelledby="self-service-tab">
                        @include('portal.partials.self-service')
                    </div>
                    <!-- partial employee information -->
                    <div class="tab-pane fade" id="my-information" role="tabpanel" aria-labelledby="my-information-tab">
                        @include('portal.partials.employee-details')
                    </div>
                    <!-- partial personal information -->
                    <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                        @include('portal.partials.personal-details')
                    </div>
                    <!-- home>partial content -->
                    <div class="tab-pane fade" id="pills-msg" role="tabpanel" aria-labelledby="pills-msg-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block">
                                    <div class="card">
                                        <h5 class="card-header"><i class="fab fa-rocketchat" style="font-size: 20px;" title="us" id="us"></i>Feedback</h5>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="employeeFeedbackTextarea">Feedback</label>
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
    </div> --}}




    <!-- ============================================================== -->
    <!-- NO DATA -->
    <!-- ============================================================== -->
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
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}" alt="User Avatar"
                            class="rounded-circle user-avatar-xxl">
                    </div>
                    <div class="text-center">
                        <h2 class="font-24 mb-0">{{ Auth::user()->name }}</h2>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Contact Information</h3>
                    <div class="">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-fw fa-envelope mr-2"></i>N/A</li>
                            <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"></i>N/A</li>
                            <li class="mb-2"><i class="fas fa-fw fa-calendar-check mr-2"></i>N/A</li>
                            <li class="mb-2"><i class="fas fa-fw fa-map-marker-alt mr-2"></i>N/A</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div>
                        <h3 class="font-16">Emergency Contact Information</h3>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2"><i class="fas fa-fw fa-user mr-2"></i>N/A</li>
                            <li class="mb-2"><i class="fas fa-fw fa-phone mr-2"></i>N/A</li>
                            <li class="mb-2"><i class="fas fa-fw fa-handshake mr-2"></i>N/A</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div>
                        <ul class="list-unstyled mb-0">
                            <h3 class="font-16">Last Login</h3>
                            <li class="mb-2"><i class="far fa-calendar-check mr-2"></i>{{ Auth::user()->last_login ? Auth::user()->last_login->format('F d, Y h:i A') : 'Never logged in' }}</li>
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
                            role="tab" aria-controls="my-information" aria-selected="false">EMPLOYEE</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab"
                            aria-controls="pills-review" aria-selected="false">PERSONAL</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-msg-tab" data-toggle="pill" href="#pills-msg" role="tab"
                            aria-controls="pills-msg" aria-selected="false">FEEDBACK</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <!-- partial self-service -->
                    <div class="tab-pane fade show active" id="self-service" role="tabpanel" aria-labelledby="self-service-tab">
                        @include('portal.partials.self-service')
                    </div>
                    <!-- partial employee information -->
                    <div class="tab-pane fade" id="my-information" role="tabpanel" aria-labelledby="my-information-tab">
                        @include('portal.partials.employee-details')
                    </div>
                    <!-- partial personal information -->
                    <div class="tab-pane fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                        @include('portal.partials.personal-details')
                    </div>
                    <!-- home>partial content -->
                    <div class="tab-pane fade" id="pills-msg" role="tabpanel" aria-labelledby="pills-msg-tab">
                        <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="section-block">
                                    <div class="card">
                                        <h5 class="card-header"><i class="fab fa-rocketchat" style="font-size: 20px;" title="us" id="us"></i>Feedback</h5>
                                        <div class="card-body">
                                            <form>
                                                <div class="form-group">
                                                    <label for="employeeFeedbackTextarea">Feedback</label>
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
