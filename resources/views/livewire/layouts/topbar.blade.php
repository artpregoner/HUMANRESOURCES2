<nav class="navbar navbar-expand-lg bg-white fixed-top">
    <a class="navbar-brand" href="https://hr2.fareastcafeshop.com/">ECOMPANY</a>

    <button
        wire:click="toggleMobileMenu"
        class="navbar-toggler"
        type="button">
        <span class="fa fa-fw fa-user-circle"></span>
    </button>

    <div class="collapse navbar-collapse {{ $showMobileMenu ? 'show' : '' }}" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto navbar-right-top">
            <li class="nav-item dropdown notification">
                <div class="relative">
                    <a wire:click.stop="toggleNotificationDropdown" class="nav-link nav-icons cursor-pointer">
                        <i class="fas fa-fw fa-bell"></i>
                        <span class="indicator"></span>
                        <span class="topnav-dropdown mdi mdi-arrow-down-drop-circle"></span>
                    </a>

                    @if($showNotificationDropdown)
                    <ul class="dropdown-menu dropdown-menu-right notification-dropdown show">
                        <li>
                            <div class="card-header d-flex">
                                <h4 class="mb-0">Notification</h4>
                                <div class="dropdown ml-auto">
                                    <a class="toolbar" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="mdi mdi-dots-vertical"></i>  </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                                        <a class="dropdown-item" href="#">Mark all as read</a>
                                    </div>
                                </div>
                            </div>
                            <div class="notification-list">
                                <div class="list-group">
                                    @foreach($notifications as $notification)
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img">
                                                <img src="{{ asset('assets/images/avatar-2.jpg') }}" alt="" class="user-avatar-md rounded-circle">
                                            </div>
                                            <div class="notification-list-user-block">
                                                <span class="notification-list-user-name">{{ $notification->data['user_name'] }}</span> {{ $notification->data['message'] }}
                                                <div class="notification-date">{{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </a>
                                    @endforeach
                                    <a href="#" class="list-group-item list-group-item-action active">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img src="../template/assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span class="notification-list-user-name">Pregover Art Javar</span>Request Vacation Leave.
                                                <div class="notification-date">2 min ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="#" class="list-group-item list-group-item-action">
                                        <div class="notification-info">
                                            <div class="notification-list-user-img"><img src="../templateassets/images/avatar-3.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                            <div class="notification-list-user-block"><span class="notification-list-user-name">Whug John</span>Submit new Ticket
                                                <div class="notification-date">3 min ago</div>
                                            </div>
                                        </div>
                                    </a>
                                    <!-- Additional notifications -->
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="list-footer border-top">
                                <a class="" href="#">View all notifications</a>
                            </div>
                        </li>
                    </ul>
                    @endif
                </div>
            </li>

            <li class="nav-item dropdown nav-user">
                <div class="relative">
                    <a wire:click.stop="toggleUserDropdown" class="nav-link nav-user-img cursor-pointer">
                        <img src="{{ asset('template/assets/images/user1.png') }}" alt="User Avatar" class="user-avatar-md rounded-circle">
                        <span class="topnav-dropdown mdi mdi-arrow-down-drop-circle"></span>
                    </a>

                    @if($showUserDropdown)
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown show">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name">{{ Auth::user()->name }}</h5>
                            <span class="status"></span><span class="ml-2">{{ Auth::user()->email }}</span>
                        </div>

                        <a wire:click="logout" href="javascript:void(0);" class="dropdown-item cursor-pointer">
                            <i class="fas fa-power-off mr-2"></i> Logout
                        </a>
                    </div>
                    @endif
                </div>
            </li>
        </ul>
    </div>
    <script>
        document.addEventListener('click', function(event) {
            // Close notification dropdown if the click is outside of the dropdown
            if (!event.target.closest('.notification') && !event.target.closest('.nav-user')) {
                @this.call('closeDropdowns');
            }
        });
    </script>
</nav>
