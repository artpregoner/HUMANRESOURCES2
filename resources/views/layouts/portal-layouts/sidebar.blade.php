<div class="nav-left-sidebar sidebar-dark">
    <div class="menu-list">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="d-xl-none d-lg-none" href="#">Dashboard</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav flex-column">
                    <li class="nav-divider">PORTAL</li> <!-- Title -->
                    <!-- ============================================================== -->
                    <!-- Dashboard -->
                    <!-- ============================================================== -->
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('portal') ? 'active' : '' }}" href="{{ route('home')}}" aria-expanded="false"><i class="fa fa-fw fas fa-home"></i>Home </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('portal/employee/profile') ? 'active' : '' }}" href="{{url('portal/employee/profile')}}" aria-expanded="false"><i class="fa fa-fw fas fa-user"></i>My Profile </a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Employee Self-service -->
                    <!-- ============================================================== -->
                    <li class="nav-divider">SELF-SERVICE</li> <!-- Title -->
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('portal/schedule') ? 'active' : '' }}" href="{{url('portal/schedule')}}" aria-expanded="false"><i class="fa fa-fw fas fa-calendar-alt"></i>Schedule </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('portal/leave/list*') ? 'active' : '' }}" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2">
                            <i class="far fas fa-plane"></i>Time Off & Leave </a>
                        <div id="submenu-2" class="collapse submenu {{ request()->is('portal/leave/list*') ? 'show' : '' }}">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('portal/leave/list/requests') ? 'active' : '' }}" href="{{ url('portal/leave/list/requests') }}">Request</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->is('portal/leave/list/history') ? 'active' : '' }}" href="{{ url('portal/leave/list/history') }}">History</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Claims & Reimbursement -->
                    <!-- ============================================================== -->
                    <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-divider">Claims</li>
                    <li class="nav-item ">
                        <a class="nav-link {{ request()->is('portal/expense/list/requests') ? 'active' : '' }}" href="{{url('portal/expense/list/requests')}}" aria-expanded="false"><i class="fas fa-dollar-sign"></i>Expenses<span class="badge badge-success">6</span></a>
                    </li>
                    <!-- ============================================================== -->
                    <!-- Helpdesk -->
                    <!-- ============================================================== -->
                    <div style="border-top: 1px solid #ddd; margin: 10px 0;"></div>
                    <li class="nav-divider">Helpdesk</li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('portal/helpdesk/list') ? 'active' : '' }}" href="{{url('portal/helpdesk/list')}}" aria-expanded="false"><i class="fas fa-fw  fa-envelope"></i>Tickets</a>
                    </li>
                    {{-- <li class="nav-item">
                        <a class="nav-link" href="{{url('helpdesk/ticket-inbox')}}" aria-expanded="false"><i class="fas fa-inbox"></i>Inbox <span class="badge badge-secondary">New</span></a>
                    </li> --}}
                </ul>
            </div>
        </nav>
    </div>
</div>
