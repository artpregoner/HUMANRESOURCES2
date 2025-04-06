@extends('layouts.portal')
@section('title','Home')
@section('header','Portal')
@section('active-header', 'Home')

@section('content')
    @include('components.alert.alert')
    <div class="max-w-screen-xl p-0 mx-auto space-y-4">
        <div class="w-full p-6 bg-white shadow-lg rounded-xl dark:bg-gray-800">
            <div class="grid grid-cols-1 gap-4 border-gray-200 dark:border-gray-700 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 xl:gap-16">
                <!-- Profile Section -->
                <div class="flex space-x-4">
                    <img class="w-20 h-20 rounded-lg"
                            src="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}"
                            alt="{{ Auth::user()->name }}" />
                    <div class="text-left">
                        <span class="mb-2 inline-block rounded bg-primary-100 px-2.5 py-0.5 text-xs font-medium text-primary-800 dark:bg-primary-900 dark:text-primary-300">
                            {{ Auth::user()->role }}
                        </span>
                        <h2 class="text-xl font-bold leading-none text-gray-900 dark:text-white sm:text-2xl">
                            {{ Auth::user()->name }}
                        </h2>
                    </div>
                </div>

                <!-- Email Section -->
                <div class="flex space-x-4">
                    <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Email Address</dt>
                        <dd class="text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</dd>
                    </dl>
                </div>

                <!-- Last Login Section -->
                <div class="flex space-x-4">
                    <dl>
                        <dt class="font-semibold text-gray-900 dark:text-white">Last Login</dt>
                        <dd class="text-gray-500 dark:text-gray-400">
                            {{ Auth::user()->last_login ? Auth::user()->last_login->format('F d, Y h:i A') : 'Never logged in' }}
                        </dd>
                    </dl>
                </div>

            </div>
        </div>



        <div x-data="{ activeTab: 'shortcut' }" class="md:flex">
            <ul class="grid grid-cols-2 gap-4 mb-4 text-sm font-medium text-gray-500 dark:text-gray-400 md:grid-cols-1 md:me-4 md:mb-0">
                <li>
                    <a href="#" @click.prevent="activeTab = 'shortcut'"
                        :class="{'text-white bg-blue-700 dark:bg-blue-600': activeTab === 'shortcut', 'bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white': activeTab !== 'shortcut'}"
                        class="inline-flex items-center w-full px-4 py-3 rounded-lg">
                        {{-- <svg class="w-4 h-4 me-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z"/>
                        </svg> --}}
                        SHORTCUT
                    </a>
                </li>
                <li>
                    <a href="#" @click.prevent="activeTab = 'profile'"
                        :class="{'text-white bg-blue-700 dark:bg-blue-600': activeTab === 'profile', 'bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white': activeTab !== 'profile'}"
                        class="inline-flex items-center w-full px-4 py-3 rounded-lg">
                        PROFILE
                    </a>
                </li>
                <li>
                    <a href="#" @click.prevent="activeTab = 'employee'"
                        :class="{'text-white bg-blue-700 dark:bg-blue-600': activeTab === 'employee', 'bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white': activeTab !== 'employee'}"
                        class="inline-flex items-center w-full px-4 py-3 rounded-lg">
                        EMPLOYEE
                    </a>
                </li>
                <li>
                    <a href="#" @click.prevent="activeTab = 'feedback'"
                        :class="{'text-white bg-blue-700 dark:bg-blue-600': activeTab === 'feedback', 'bg-gray-50 hover:bg-gray-100 dark:bg-gray-800 dark:hover:bg-gray-700 dark:hover:text-white': activeTab !== 'feedback'}"
                        class="inline-flex items-center w-full px-4 py-3 rounded-lg">
                        FEEDBACK
                    </a>
                </li>
            </ul>
            <div class="w-full p-6 text-gray-500 rounded-lg bg-gray-50 text-medium dark:text-gray-400 dark:bg-gray-800">
                <template x-if="activeTab === 'shortcut'">
                    @include('portal.partials.self-service')
                </template>
                <template x-if="activeTab === 'profile'">
                    <div>
                        <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white">Profile Tab</h3>
                        <p class="mb-2">This is some placeholder content for the Profile tab.</p>
                        <p>The tab JavaScript swaps classes to control visibility.</p>
                    </div>
                </template>
                <template x-if="activeTab === 'employee'">
                    <div>
                        <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white">Employee Tab</h3>
                        <p class="mb-2">This is some placeholder content for the Employee tab.</p>
                    </div>
                </template>
                <template x-if="activeTab === 'feedback'">
                    <div>
                        <h3 class="mb-2 text-lg font-bold text-gray-900 dark:text-white">Feedback Tab</h3>
                        <p class="mb-2">This is some placeholder content for the Feedback tab.</p>
                    </div>
                </template>
            </div>
        </div>

    </div>



<div class="influence-profile">
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
                    <div class="text-center user-avatar d-block">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}" alt="User Avatar"
                            class="rounded-circle user-avatar-xxl">
                    </div>
                    <div class="text-center">
                        <h2 class="mb-0 font-24">{{ Auth::user()->name }}</h2>
                        <p>{{ Auth::user()->employeeDetails->designation }}</p>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Contact Information</h3>
                    <div class="">
                        <ul class="mb-0 list-unstyled">
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-envelope"></i>{{ Auth::user()->email }}</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-phone"></i>{{ Auth::user()->personalInformation->phone_number ?? 'N/A' }}</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-calendar-check"></i>{{ Auth::user()->personalInformation->date_of_birth->format('F d, Y') ?? 'N/A' }}</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-map-marker-alt"></i>{{ Auth::user()->personalInformation->address ?? 'N/A' }},
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
                        <ul class="mb-0 list-unstyled">
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-user"></i>{{ Auth::user()->personalInformation->emergency_contact_name ?? 'N/A' }}</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-phone"></i>{{ Auth::user()->personalInformation->emergency_contact_number ?? 'N/A' }}</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-handshake"></i>{{ Auth::user()->personalInformation->emergency_relationship ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div>
                        <ul class="mb-0 list-unstyled">
                            <h3 class="font-16">Last Login</h3>
                            <li class="mb-2"><i class="mr-2 far fa-calendar-check"></i>{{ Auth::user()->last_login ? Auth::user()->last_login->format('F d, Y h:i A') : 'Never logged in' }}</li>
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
                <ul class="mb-3 nav nav-pills nav-justified" id="pills-tab" role="tablist">
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
                    <div class="text-center user-avatar d-block">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}" alt="User Avatar"
                            class="rounded-circle user-avatar-xxl">
                    </div>
                    <div class="text-center">
                        <h2 class="mb-0 font-24">{{ Auth::user()->name }}</h2>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="card-body border-top">
                    <h3 class="font-16">Contact Information</h3>
                    <div class="">
                        <ul class="mb-0 list-unstyled">
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-envelope"></i>N/A</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-phone"></i>N/A</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-calendar-check"></i>N/A</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-map-marker-alt"></i>N/A</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div>
                        <h3 class="font-16">Emergency Contact Information</h3>
                        <ul class="mb-0 list-unstyled">
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-user"></i>N/A</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-phone"></i>N/A</li>
                            <li class="mb-2"><i class="mr-2 fas fa-fw fa-handshake"></i>N/A</li>
                        </ul>
                    </div>
                </div>
                <div class="card-body border-top">
                    <div>
                        <ul class="mb-0 list-unstyled">
                            <h3 class="font-16">Last Login</h3>
                            <li class="mb-2"><i class="mr-2 far fa-calendar-check"></i>{{ Auth::user()->last_login ? Auth::user()->last_login->format('F d, Y h:i A') : 'Never logged in' }}</li>
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
                <ul class="mb-3 nav nav-pills nav-justified" id="pills-tab" role="tablist">
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
</div>
@endsection
