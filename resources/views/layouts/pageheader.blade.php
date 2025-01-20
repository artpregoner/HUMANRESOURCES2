@hasSection('header')
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <div class="toolbar">
                    @yield('back-button')
                </div>
                <h2 class="pageheader-title">@yield('header')</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">@yield('header')</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">@yield('active-header')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
@endif
