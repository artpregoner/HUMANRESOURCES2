<div>
    <h3 class="mb-4 text-lg font-bold text-gray-900 dark:text-white">Shortcut Tab</h3>

    <div class="grid grid-cols-1 gap-3 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:gap-4">

        <!-- My Claims -->
        <a wire:navigate href="{{route('portal.claims.index')}}" class="flex items-center p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg dark:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-800 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </div>
            <div class="ml-3">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->claims->count() }}</h5>
                <p class="text-sm text-gray-500 dark:text-gray-400">My Claims</p>
            </div>
        </a>

        <!-- My Ticket -->
        <a wire:navigate href="{{route('portal.helpdesk.index')}}" class="flex items-center p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg dark:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-800 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
                </svg>
            </div>
            <div class="ml-3">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">{{ Auth::user()->tickets->count() }}</h5>
                <p class="text-sm text-gray-500 dark:text-gray-400">My Ticket</p>
            </div>
        </a>

        <!-- My Profile -->
        <a wire:navigate href="{{route('portal.myprofile')}}" class="flex items-center p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg dark:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-800 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                </svg>
            </div>
            <div class="ml-3">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">My Profile</h5>
            </div>
        </a>

        <!-- Request -->
        <a href="#" class="flex items-center p-5 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
            <div class="flex items-center justify-center w-12 h-12 bg-gray-100 rounded-lg dark:bg-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-800 dark:text-white">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                </svg>
            </div>
            <div class="ml-3">
                <h5 class="text-xl font-bold text-gray-900 dark:text-white">Request</h5>
            </div>
        </a>

    </div>
</div>


{{-- <div class="row">
    <!-- ============================================================== -->
    <!-- four widgets   -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- total views   -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">My Tickets</h5>
                    <h2 class="mb-0">{{ Auth::user()->tickets->count() }}</h2>
                </div>
                <div class="float-right mt-1 icon-circle-medium icon-box-lg bg-info-light">
                    <i class="fas fa-ticket-alt fa-fw fa-sm text-info"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end total views   -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Claims & Reimbursement  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Claims</h5>
                    <h2 class="mb-0">{{ Auth::user()->claims->count() }}</h2>
                </div>
                <div
                    class="float-right mt-1 icon-circle-medium icon-box-lg bg-secondary-light">
                    <i class="fa fa-handshake fa-fw fa-sm text-secondary"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end Claims & Reimbursement   -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- total leave  -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Total Absent</h5>
                    <h2 class="mb-0">0</h2>
                </div>
                <div class="float-right mt-1 icon-circle-medium icon-box-lg bg-primary-light">
                    <i class="fas fa-calendar-times fa-fw fa-sm text-primary"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end total leave   -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- total earned   -->
    <!-- ============================================================== -->
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-inline-block">
                    <h5 class="text-muted">Paid Claims</h5>
                    <h2 class="mb-0">0</h2>
                </div>
                <div
                    class="float-right mt-1 icon-circle-medium icon-box-lg bg-success-light">
                    <i class="fa fa-money-bill-alt fa-fw fa-sm" style="color: #459423;"></i>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end total earned   -->
    <!-- ============================================================== -->
    <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <h5 class="card-header"><i class="m-r-10 mdi mdi-account-settings-variant" style="font-size: 30px;"></i></i> Self-Service</h5>
            <div class="p-0 card-body">
                <ul class="country-sales list-group list-group-flush">
                    <li class="country-sales-content list-group-item">
                        <span class="">Update Personal Info</span><span class="float-right text-dark"><a href="{{ route('portal.myprofile') }}" class="btn btn-info active">Update</a></span>
                    </li>
                    <li class="list-group-item country-sales-content">
                        <span class="">Download Payslip</span><span class="float-right text-dark"><a href="#" class="btn btn-info active">View</a></span>
                    </li>
                    <li class="list-group-item country-sales-content">
                        <span class="">Request Documents</span><span class="float-right text-dark"><a href="#" class="btn btn-info active">Request</a></span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div> --}}
