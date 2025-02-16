    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <a class="navbar-brand" href="https://hr2.fareastcafeshop.com/">ECOMPANY</a>

        {{-- Toggle Button for Mobile View --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-fw fa-user-circle"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">

                {{-- Notification Section --}}
                <li class="nav-item dropdown notification">
                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-fw fa-bell"></i>
                        <span class="indicator"></span><!--heartbeat for notification-->
                        <span class="topnav-dropdown mdi mdi-arrow-down-drop-circle"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                        <li>
                            <div class="notification-title">Notification</div>
                            <div class="notification-list">
                                <div class="list-group">
                                    <a href="#" class="list-group-item list-group-item-action active">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img src="assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block">
                                                <span class="notification-list-user-name">Jeremy Rakestraw</span> accepted your invitation to join the team.
                                                <div class="notification-date">2 min ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img src="assets/images/avatar-5.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span class="notification-list-user-name">Jessica Caruso</span> accepted your invitation to join the team.
                                                <div class="notification-date">2 min ago</div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="list-footer"><a href="#">View all notifications</a></div>
                        </li>
                    </ul>
                </li>


                <!-- User Dropdown -->
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img src="{{ Auth::user()->profile_photo_url ?? asset('template/assets/images/avatar-1.jpg') }}" alt="User Avatar" class="user-avatar-md rounded-circle">
                        <span class="topnav-dropdown mdi mdi-arrow-down-drop-circle"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name">{{  Auth::user()->name }}</h5>
                            <span class="status"></span><span class="ml-2">{{  Auth::user()->email }}</span>
                        </div>

                        {{-- Logout Option --}}
                        <a class="dropdown-item" href="#"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-power-off mr-2"></i> Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
