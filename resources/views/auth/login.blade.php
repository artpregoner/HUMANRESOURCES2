<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login - HR 2</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('template/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('template/assets/libs/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/libs/css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="icon" href="{{ asset('template/images/storelogo.png') }}" type="image/x-icon">
    <style>
        body {
            /* background: linear-gradient(to bottom right, #2563eb, #9333ea); */
            background: #1e40af;
        }

        .splash-container {
            width: 100%;
            max-width: 375px;
            margin: auto;
            background-color: #E9DCC9;
        }

        .splash-container .card-header {
            padding: 10px;

        }

        .splash-description {
            text-align: center;
            display: block;
            line-height: 20px;
            font-size: 1rem;
            margin-top: 20px;

        }

        .splash-title {
            text-align: center;
            display: block;
            font-size: 14px;
            font-weight: 300;
        }

        .splash-container .card-footer-item {
            padding: 12px 28px;
        }
    </style>
</head>

<body>
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="https://hr2.fareastcafeshop.com/">ECOMPANY</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-fw fa-th"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://admin.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/github.png" alt="" />
                                                <span>Admin</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://hr1.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/dribbble.png" alt="" />
                                                <span>HR1</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://hr2.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/dropbox.png" alt="" />
                                                <span>HR3</span></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://core1.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/bitbucket.png" alt="" />
                                                <span>CORE 1</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://core2.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/mail_chimp.png" alt="" />
                                                <span>CORE 2</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://core3.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/slack.png" alt="" />
                                                <span>CORE 3</span></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://finance.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/bitbucket.png" alt="" />
                                                <span>FINANCE</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://logi1.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/mail_chimp.png" alt="" />
                                                <span>LOGISTIC 1</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                            <a href="https://logi2.fareastcafeshop.com/" class="connection-item"><img
                                                    src="../assets/images/slack.png" alt="" />
                                                <span>LOGISTIC 2</span></a>
                                        </div>
                                    </div>
                                </li>
                                {{-- <li>
                                    <div class="conntection-footer"><a href="#">More</a></div>
                                </li> --}}
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="container-fluid dashboard-content">
            <div class="card-body d-none d-sm-block"></div>
            <div class="card-body d-none d-sm-block"></div>
            <div class="card-body"></div>
            <div class="row offset-xl-1">
                <div class="splash-container">
                    <div class="card">
                        <div class="card-header text-center"><a href="#">
                                <a class="navbar-brand" href="https://hr2.fareastcafeshop.com/">ECOMPANY</a>
                            </a><span class="splash-description">Please enter your user information.</span>
                        </div>
                        <div class="card-body">
                            @include('components.alert.alert')
                            @livewire('auth.login')
                        </div>
                        <div class="card-footer bg-white p-0  ">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="card-body d-none d-sm-block"></div>
                    <div class="card-body d-none d-sm-block"></div>
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="card-body">
                            <!-- Display headings for desktop (Hidden on mobile) -->
                            <h1 class="text-center text-light display-3 d-none d-lg-block">HUMAN RESOURCES 2</h1>
                            <h1 class="text-center text-light display-4 d-none d-lg-block">ECOMPANY</h1>

                            <!-- Normal h1 and h2 for mobile (Hidden on desktop) -->
                            <h1 class="text-center text-light d-lg-none">HUMAN RESOURCES 2</h1>
                            <h2 class="text-center text-light d-lg-none">ECOMPANY</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body d-none d-sm-block"></div>

        {{-- <div class="section-block">
            <h1 class="text-center text-light display-6 d-none d-lg-block">Job Listings</h1>
            <!-- Normal h1 and h2 for mobile (Hidden on desktop) -->
            <h1 class="text-center text-light d-lg-none">Job Listings</h1>
        </div> --}}


        <div class="card-body d-none d-sm-block"></div>
        <div class="card-body d-none d-sm-block"></div>
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-block">
                            <h1 class="section-title">Job Openings</h1>
                        </div>
                    </div>
                    <!-- Job Listing 1 -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card job-card">
                            <div class="card-body">
                                <div class="job-info">
                                    <h3 class="job-title mb-2">Software Engineer</h3>
                                    <p class="job-description mb-3">We are looking for an experienced software engineer to develop high-quality applications using modern technologies.</p>
                                    <div class="job-details alert alert-primary mb-3">
                                        <p><strong>Date Posted:</strong> <span class="text-dark">March 1, 2025</span></p>
                                        <p><strong>Location:</strong> <span class="text-dark">Manila, Philippines</span></p>
                                        <p><strong>Openings:</strong> <span class="text-dark">3 positions</span></p>
                                    </div>
                                    <button class="btn btn-code3 btn-block">Apply Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job Listing 2 -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card job-card">
                            <div class="card-body">
                                <div class="job-info">
                                    <h3 class="job-title mb-2">UI/UX Designer</h3>
                                    <p class="job-description mb-3">Join our creative team to design user-friendly interfaces and exceptional user experiences for our products.</p>
                                    <div class="job-details alert alert-primary mb-3">
                                        <p><strong>Date Posted:</strong> <span class="text-dark">February 25, 2025</span></p>
                                        <p><strong>Location:</strong> <span class="text-dark">Cebu City, Philippines</span></p>
                                        <p><strong>Openings:</strong> <span class="text-dark">2 positions</span></p>
                                    </div>
                                    <button class="btn btn-code3 btn-block">Apply Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Job Listing 3 -->
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="card job-card">
                            <div class="card-body">
                                <div class="job-info">
                                    <h3 class="job-title mb-2">Digital Marketing Specialist</h3>
                                    <p class="job-description mb-3">Drive our online marketing campaigns and help grow our digital presence across multiple platforms.</p>
                                    <div class="job-details alert alert-primary mb-3">
                                        <p><strong>Date Posted:</strong> <span class="text-dark">February 28, 2025</span></p>
                                        <p><strong>Location:</strong> <span class="text-dark">Davao City, Philippines</span></p>
                                        <p><strong>Openings:</strong> <span class="text-dark">1 position</span></p>
                                    </div>
                                    <button class="btn btn-code3 btn-block">Apply Now</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        Copyright © 2025 Company Name. All rights reserved.
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript: void(0);">About</a>
                            <a href="javascript: void(0);">Support</a>
                            <a href="javascript: void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('template/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('asset/libs/js/javascript.js') }}"></script>
</body>

</html>
