<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">
                        Menu
                    </li>


                    <!-- ============================================================== -->
                    <!-- Dashboard -->
                    <!-- ============================================================== -->
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('hr2') ? 'active' : '' }}" href="{{ route('hr2.index') }}"
                            aria-expanded="false"><i class="m-r-10 mdi mdi-view-dashboard"></i>Dashboard</a>
                    </li>


                    <!-- ============================================================== -->
                    <!-- Workforce Analytics -->
                    <!-- ============================================================== -->
                    {{-- <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div> --}}
                    {{-- <li class="nav-item">
                        <a class="nav-link {{ request()->is('workforce/*') ? 'active' : '' }}" href="#"
                            data-toggle="collapse" data-target="#workforce-submenu" aria-expanded="false">
                            <i class="m-r-10 mdi mdi-chart-bar" aria-controls="workforce-submenu"></i>Workforce Analytics
                        </a>
                        <div id="workforce-submenu" class="collapse submenu {{ request()->is('workforce*') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('workforce/skill-gap') ? 'active' : '' }}"
                                        href="{{ url('workforce/skill-gap') }}">Skill Analysis Tool</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('workforce/employee-metrics') ? 'active' : '' }}"
                                        href="{{ url('workforce/employee-metrics') }}">Employee Metrics<span class="badge badge-secondary">New</span></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('workforce/turnover-hiring') ? 'active' : '' }}"
                                        href="{{ url('workforce/turnover-hiring') }}">Turnover & Hiring Needs</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}


                    <!-- ============================================================== -->
                    <!-- Claims -->
                    <!-- ============================================================== -->
                    <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-divider">
                        Claims & Reimbursement
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->Is('hr2/claims/*') ? 'active' : '' }}"
                            href="{{ route('hr2.claims.index') }}" aria-expanded="false"><i
                            class="m-r-10 mdi mdi-currency-usd"></i>Claims Request
                            <span class="badge badge-code8 badge-pill">{{ $claimCount }}</span>
                        </a>
                    </li>

                    <!-- ============================================================== -->
                    <!-- Emloyee Self-service -->
                    <!-- ============================================================== -->


                    {{-- <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-divider">
                        Self-Service
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#self-service-submenu" aria-controls="self-service-submenu"><i class="m-r-10 mdi mdi-account-settings"></i>Self-Service <span class="badge badge-success">6</span></a>
                        <div id="self-service-submenu" class="collapse submenu" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="index.html" data-toggle="collapse" aria-expanded="false" data-target="#self-service-submenu-1" aria-controls="self-service-submenu-1"><i class="m-r-10 mdi mdi-airplane-takeoff icon-small"></i>Time Off & Leave</a>
                                    <div id="self-service-submenu-1" class="collapse submenu" style="">
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link" href="../leave-requests.html">All Leave Requests</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../leave-approve.html">Approve Leave</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" href="../leave-history.html">Leave History</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../leave-policy.html"><i class="m-r-10 mdi mdi-account-plus"></i>Add new Employee</a>
                    </li> --}}


                    <!-- ============================================================== -->
                    <!-- Employee Engagement -->
                    <!-- ============================================================== -->


                    {{-- <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('employee-engagement/*') ? 'active' : '' }}" href="#"
                            data-toggle="collapse" aria-expanded="false" data-target="#employee-engagement-submenu"
                            aria-controls="employee-engagement-submenu">
                            <i class="m-r-10 mdi mdi-account-multiple"></i>Employee Engagement
                        </a>
                        <div id="employee-engagement-submenu" class="collapse submenu {{ request()->is('employee-engagement*') ? 'show' : '' }}" style="">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('employee-engagement/recognition') ? 'active' : '' }}"
                                        href="{{ url('employee-engagement/recognition') }}">
                                        Recognition and Rewards Programs
                                    </a>
                                </li>
                                <!-- Example of an additional item; Uncomment if needed -->
                                <li class="nav-item">
                                    <a class="nav-link" href="form-validation.html">Engagement Metrics Overview</a>
                                </li>
                            </ul>
                        </div>
                    </li> --}}


                    <!-- ============================================================== -->
                    <!-- Helpdesk -->
                    <!-- ============================================================== -->
                    <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-divider">
                        Helpdesk
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->Is('hr2/helpdesk/*') ? 'active' : '' }}"
                            href="{{ route('hr2.helpdesk.index') }}" aria-expanded="false"><i
                            class="m-r-10 mdi mdi-ticket-account"></i>Tickets
                            <span class="badge badge-code8 badge-pill">{{ $ticketCount }}</span>
                        </a>

                    </li>


                    <!-- ============================================================== -->
                    <!-- hr access to portal -->
                    <!-- ============================================================== -->
                    <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-divider">
                        Portal
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link"
                            href="{{ route('home') }}" target="_blank" aria-expanded="false"><i
                            class="m-r-10 mdi mdi-account-settings-variant"></i>Go to Portal</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
