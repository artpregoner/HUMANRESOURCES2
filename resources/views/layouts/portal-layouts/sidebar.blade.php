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
                    <li class="nav-divider">PORTAL</li> <!-- Title -->
                    <!-- ============================================================== -->
                    <!-- Dashboard -->
                    <!-- ============================================================== -->
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('portal') ? 'active' : '' }}" href="{{ route('home') }}"
                            aria-expanded="false">
                            <i class="m-r-10 mdi mdi-view-dashboard"></i>
                            Home
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('portal/myprofile') ? 'active' : '' }}"
                            href="{{ route('portal.myprofile') }}" aria-expanded="false">
                            <i class="m-r-10 mdi mdi-account-settings-variant"></i>
                            My Profile
                        </a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Employee Self-service -->
                    <!-- ============================================================== -->
                    <li class="nav-divider">SELF-SERVICE</li> <!-- Title -->
                    <li class="nav-item "><!-- Payslip -->
                        <a class="nav-link {{ request()->is('portal/self-service/payslip*') ? 'active' : '' }}"
                            href="{{ route('portal.ess.payslip.index') }}" aria-expanded="false">
                            <i class="m-d-10 mdi mdi-printer"></i>
                            Payslip
                        </a>
                    </li>
                    <li class="nav-item"><!-- Time off and Leave -->
                        <a class="nav-link {{ request()->is('portal/self-service/leave/*') ? 'active' : '' }}"
                            href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2"
                            aria-controls="submenu-2">
                            <i class="m-r-10 mdi mdi-airplane-takeoff"></i>
                            Time Off & Leave
                        </a>
                        <div id="submenu-2"
                            class="collapse submenu {{ request()->is('portal/self-service/leave/*') ? 'show' : '' }}">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('portal/self-service/leave') ? 'active' : '' }}"
                                        href="{{ url('portal/self-service/leave/list/requests') }}">
                                        <i class="fas fa-play icon-small"></i>Request
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('portal/self-service/leave') ? 'active' : '' }}"
                                        href="{{ url('portal/self-service/leave/list/history') }}">
                                        <i class="fas fa-play icon-small"></i>History
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Claims & Reimbursement -->
                    <!-- ============================================================== -->
                    <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-divider">Claims</li> <!-- Title -->
                    <li class="nav-item "><!-- Claims -->
                        <a class="nav-link {{ request()->is('portal/claims/*') ? 'active' : '' }}"
                            href="{{ route('portal.claims.index') }}" aria-expanded="false">
                            <i class="m-r-10 mdi mdi-currency-usd"></i>Expenses
                        </a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Helpdesk -->
                    <!-- ============================================================== -->
                    <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-divider">Helpdesk</li><!-- Title -->
                    <li class="nav-item"><!-- helpdesk -->
                        <a class="nav-link {{ request()->is('portal/helpdesk/*') ? 'active' : '' }}"
                            href="{{ route('portal.helpdesk.index') }}" aria-expanded="false">
                            <i class="m-r-10 mdi mdi-ticket-account"></i>
                            Tickets
                            <span class="badge badge-code8 badge-pill">14</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</div>
