@extends('layouts.app')
@section('title','My Profile')
@section('header','HR2')
@section('active-header', 'My Profile')

@push('styles')
    <link rel="stylesheet" href="{{asset('asset/vendor/image-modal/style.css')}}">
@endpush

@section('content')
<div class="row">
    @include('components.modal.image-modal')
    <!-- Profile Section -->
    <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12">
        <div class="card influencer-profile-data">
            <div class="card-body">
                <div class="row">
                    <!-- Profile Image -->
                    <div class="col-xl-2 col-lg-4 col-md-4 col-sm-4 col-12 text-center">
                        <img src="{{ asset('template/assets/images/user1.png') }}" alt="User Avatar" class="rounded-circle user-avatar-xxl modalThisImage">
                    </div>
                    <!-- Profile Info -->
                    <div class="col-xl-10 col-lg-8 col-md-8 col-sm-8 col-12">
                        <div class="user-avatar-info">
                            <div class="m-b-20">
                                <div class="user-avatar-name">
                                    <h2 class="mb-1">Human Resources Name</h2>
                                </div>
                                <div class="user-avatar-address">
                                    <p class="border-bottom pb-3">
                                        <span class="d-xl-inline-block mb-2"><i class="fa fa-map-marker-alt mr-2 text-primary"></i>4045 Denver Avenue, Los Angeles, CA 90017</span>
                                        <span class="d-xl-inline-block mb-2 ml-xl-4">Joined: 23 June, 2018</span>
                                        <span class="d-xl-inline-block mb-2 ml-xl-4">Male</span>
                                        <span class="d-xl-inline-block mb-2 ml-xl-4">29 Years Old</span>
                                    </p>
                                    <div class="mt-3">
                                        <a href="#" class="badge badge-light mr-1">Fitness</a>
                                        <a href="#" class="badge badge-light mr-1">Life Style</a>
                                        <a href="#" class="badge badge-light">Gym</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top user-social-box">
                    <div class="user-social-media d-xl-inline-block">
                        <span class="mr-2 twitter-color"><i class="fab fa-twitter-square"></i></span><span>13,291</span>
                    </div>
                    <div class="user-social-media d-xl-inline-block">
                        <span class="mr-2 pinterest-color"><i class="fab fa-pinterest-square"></i></span><span>84,019</span>
                    </div>
                    <div class="user-social-media d-xl-inline-block">
                        <span class="mr-2 instagram-color"><i class="fab fa-instagram"></i></span><span>12,300</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('asset/vendor/image-modal/scripts.js')}}"></script>
@endpush
