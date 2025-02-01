<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <a class="navbar-brand" href="https://hr2.fareastcafeshop.com/">ECOMPANY</a>
        {{-- <img src="{{ asset('template\images\storelogo.png') }}" alt="" style="width: 100px; padding-left: 10px;"> --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-fw fa-user-circle"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                {{-- <li class="nav-item">
                    <div id="custom-search" class="top-search-bar">
                        <input class="form-control" type="text" placeholder="Search..">
                    </div>
                </li> --}}
                <li class="nav-item dropdown notification">
                    <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span>
                        <span class="topnav-dropdown m-r-10 mdi mdi-arrow-down-drop-circle"></span>
                    </a>
                    @include('layouts.partials.notification')
                </li>
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <!-- Check if the user is admin or HR, and show their specific avatar -->
                        @if(auth()->user()->role == 'admin' || auth()->user()->role == 'hr')
                            <img src="{{ asset('template/assets/images/admin.webp') }}" alt="" class="user-avatar-md rounded-circle">
                        @else
                            <!-- Default avatar for employees -->
                            <img src="{{ asset('template/assets/images/user1.png') }}" alt="" class="user-avatar-md rounded-circle">
                        @endif
                        <span class="topnav-dropdown m-r-10 mdi mdi-arrow-down-drop-circle"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            {{-- <h5 class="mb-0 text-white nav-user-name">{{ Auth::user()->name }}</h5>
                            <span class="status"></span><span class="ml-2">{{ Auth::user()->email }}</span> --}}
                            <h5 class="mb-0 text-white nav-user-name">Hello</h5>
                            <span class="status"></span><span class="ml-2">email@gail.cpm</span>
                        </div>
                        <a class="dropdown-item" href="{{ url('user.account.settings') }}"><i class="m-r-10 mdi mdi-account-settings-variant" style="font-size: 20px;"></i>Account Settings</a>
                        <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fas fa-power-off mr-2"></i>Logout</a>
                        <form id="logout-form" action="{{ url('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
