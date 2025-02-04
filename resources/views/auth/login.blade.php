<!doctype html>
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
    html,
    body {
        height: 100%;
    }

    body {
        background: linear-gradient(to bottom right, #2563eb, #9333ea);
        /* background: #1e40af; */
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .splash-container {
        width: 100%;
        max-width: 375px;
        padding: 15px;
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
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center"><a href="#">
                <a class="navbar-brand" href="https://hr2.fareastcafeshop.com/">ECOMPANY</a>
                </a><span class="splash-description">Please enter your user information.</span>
            </div>
            <div class="card-body" id="loginForm">
                @include('components.alert.alert')
                @livewire('auth.login')
                {{-- <form action="{{ route('submitLogin')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <input class="form-control form-control-lg" name="email" id="yourEmail" type="email" placeholder="Email" autocomplete="off" required>
                    </div>
                    <div class="form-group position-relative">
                        <input class="form-control form-control-lg" name="password" id="yourPassword" type="password" placeholder="Password" required>
                        <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    <div class="form-group">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #463426; border: 2px solid #463426;">Sign in</button>
                </form> --}}
            </div>
        </div>
    </div>

    <script src="{{ asset('template/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('template/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('asset/libs/js/javascript.js') }}"></script>
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const passwordField = document.querySelector('#yourPassword');

        togglePassword.addEventListener('click', function () {
            // Toggle the type attribute
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);

            // Toggle the eye icon
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>

</body>
</html>
