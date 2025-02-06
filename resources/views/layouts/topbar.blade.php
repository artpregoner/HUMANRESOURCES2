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
                        <span class="indicator"></span>
                        <span class="topnav-dropdown mdi mdi-arrow-down-drop-circle"></span>
                    </a>
                    @include('layouts.partials.notification')
                </li>

                {{-- User Profile Section --}}
                @php
                    $user = auth()->user();
                    $avatar = ($user->role === 'admin' || $user->role === 'hr')
                              ? asset('template/assets/images/admin.webp')
                              : asset('template/assets/images/user1.png');
                @endphp

                <li class="nav-item dropdown nav-user" wire.ignore>
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown"
                       aria-haspopup="true" aria-expanded="false">
                        <img src="{{ $avatar }}" alt="User Avatar" class="user-avatar-md rounded-circle">
                        <span class="topnav-dropdown mdi mdi-arrow-down-drop-circle"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name">{{ $user->name }}</h5>
                            <span class="status"></span><span class="ml-2">{{ $user->email }}</span>
                        </div>

                        {{-- Uncomment if you plan to add Account Settings --}}
                        {{-- <a class="dropdown-item" href="{{ url('user.account.settings') }}">
                            <i class="m-r-10 mdi mdi-account-settings-variant" style="font-size: 20px;"></i> Account Settings
                        </a> --}}

                        {{-- Logout Option --}}
                        <a wire:navigate class="dropdown-item" href="#"
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
