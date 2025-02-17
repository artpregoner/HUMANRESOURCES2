{{-- @if (!empty(session('success')))
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif
@if (!empty(session('error')))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif --}}
@if (session('success'))
    <div class="alert alert-message alert-success" role="alert">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-message alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif

@if (session()->has('message'))
    <div class="alert alert-message alert-success" role="alert">
        {{ session('message') }}
    </div>
@endif


@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                let flashMessages = document.querySelectorAll(".alert-message");
                flashMessages.forEach(function (alert) {
                    alert.style.transition = "opacity 0.5s ease";
                    alert.style.opacity = "0";
                    setTimeout(() => alert.remove(), 500);
                });
            }, 5000); // 5 seconds
        });
    </script>
@endpush
