@extends('layouts.app')
@section('title', 'My Profile')
@section('header', 'HR2')
@section('active-header', 'My Profile')

@push('styles')
    <link rel="stylesheet" href="{{ asset('asset/vendor/image-modal/style.css') }}">
@endpush

@section('content')
    <div class="row">
        @include('components.modal.image-modal')
        <!-- Profile Section -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card influencer-profile-data">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12">
                            <div class="text-center">
                                <img src="{{ asset('template/assets/images/user1.png') }}" alt="User Avatar"
                                class="rounded-circle user-avatar-xxl img-fluid modalThisImage">
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                            <div class="user-avatar-info">
                                <div class="m-b-20">
                                    <div class="user-avatar-name">
                                        <h2 class="mb-1">Henry Barbara</h2>
                                    </div>
                                    <div class="rating-star d-inline-block">
                                        {{-- <p class="d-inline-block text-dark">14 Reviews </p> --}}
                                    </div>
                                </div>
                                <!--  <div class="float-right"><a href="#" class="user-avatar-email text-secondary">www.henrybarbara.com</a></div> -->
                                <div class="user-avatar-address">
                                    <p class="border-bottom pb-3">
                                        <span class="d-xl-inline-block d-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary"></i>4045 Denver Avenue, Los Angeles, CA 90017</span>
                                        <span class="mb-2 ml-xl-4 d-xl-inline-block d-block">Joined date: 23 June, 2018</span>
                                        <span class="mb-2 d-xl-inline-block d-block ml-xl-4">Male</span>
                                        <span class="mb-2 d-xl-inline-block d-block ml-xl-4">29 Year Old</span>
                                    </p>
                                    <div class="mt-3">
                                        <a href="#" class="badge badge-light mr-1">Admin</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top user-social-box">
                    <div class="user-social-media d-xl-inline-block"><span class="mr-2 twitter-color"><i class="fab fa-twitter-square"></i></span><span>13,291</span></div>
                    <div class="user-social-media d-xl-inline-block"><span class="mr-2 pinterest-color"><i class="fab fa-pinterest-square"></i></span><span>84,019</span></div>
                    <div class="user-social-media d-xl-inline-block"><span class="mr-2 instagram-color"><i class="fab fa-instagram"></i></span><span>12,300</span></div>
                    <div class="user-social-media d-xl-inline-block"><span class="mr-2 facebook-color"><i class="fab fa-facebook-square"></i></span><span>92,920</span></div>
                </div>
            </div>
        </div>
    </div>

    <div class="card-body border-top"></div>

    <!--Overview of update profile-->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-section" id="overview">
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <h2>My Account</h2>
                        <p class="lead">Manage the settings for your hr2 account here.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Overview of update profile-->


    <div class="card-body border-top"></div>


    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="email-title">Profile Picture</h5>
                </div>
                <div class="card-body">
                    <div class="user-avatar text-center d-block">
                        <img src="{{asset('template/assets/images/avatar-1.jpg')}}" alt="User Avatar" class="rounded-circle user-avatar-xxl">
                    </div>
                </div>
                <div class="card-footer d-flex text-muted">
                    Click on the image above, or drag and drop a new one on top, in order to update the profile picture for your account ( 128 x 128px size recommended. Limit 5MB. ).
                </div>
            </div>
        </div>
    </div>

    <div class="card-body border-top"></div>

    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="cards">
                <h3 class="section-title">Profile Information</h3>
                <p>Update your account's profile information. ( Display name for Human Resources 2 only).</p>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form id="form" data-parsley-validate="" novalidate="">
                        <div class="form-group">
                            <label for="inputName" class="col-form-label">Name</label>
                            <input id="inputName" type="text" value="" class="form-control form-control-lg">
                        </div>
                        <div class="row">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-dark active">SAVE</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body border-top"></div>

    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="cards">
                <h3 class="section-title">Update Password</h3>
                <p>Ensure your account is using a long, random password to stay secure.</p>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <form id="form" data-parsley-validate="" novalidate="">
                        <div class="form-group">
                            <label for="inputCurrentPassword" class="col-form-label">Current Password</label>
                            <input id="inputCurrentPassword" type="text" value="" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="inputNewPassword" class="col-form-label">New Password</label>
                            <input id="inputNewPassword" type="text" value="" class="form-control form-control-lg">
                        </div>
                        <div class="form-group">
                            <label for="inputConfirmPassword" class="col-form-label">Confirm Password</label>
                            <input id="inputConfirmPassword" type="text" value="" class="form-control form-control-lg">
                        </div>
                        <div class="row">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-dark active">SAVE</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body border-top"></div>

    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="cards">
                <h3 class="section-title">Browser Sessions</h3>
                <p>Manage and log out active sessions on other browsers and devices.</p>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">If necessary, you may log out of all your other browser sessions across all of your devices. Some of your recent sessions listed below; however, this list may not be exhausted. If you feel your account has been compromised, you should also update your password</p>
                    <div class="media align-items-center">
                        <a class="user-avatar user-avatar-xl mr-3 d-flex align-items-center justify-content-center rounded-circle">
                            <i class="fas fas fa-desktop fa-2x text-dark"></i>
                        </a>
                        <div class="media-body">
                            <h3 class="card-title mb-2 text-truncate">
                                <a>Windows - Chrome</a>
                            </h3>
                            <h6 class="card-subtitle text-muted">127.0.0.1</h6>
                            <p class="text-success">Current device</p>
                        </div>
                    </div>
                    <div class="media align-items-center">
                        <a class="user-avatar user-avatar-xl mr-3 d-flex align-items-center justify-content-center rounded-circle">
                            <i class="fas fas fa-desktop fa-2x text-dark"></i>
                        </a>
                        <div class="media-body">
                            <h3 class="card-title mb-2 text-truncate">
                                <a>Windows - Chrome</a>
                            </h3>
                            <h6 class="card-subtitle text-muted">127.0.0.1</h6>
                            <p class="text-dark">Last active 2 days ago.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                        </div>
                        <div class="col-sm-6 pl-0">
                            <p class="text-right">
                                <button type="submit" class="btn btn-space btn-dark active">LOG OUT OTHER BROWSER SESSIONS</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('asset/vendor/image-modal/scripts.js') }}"></script>
@endpush
