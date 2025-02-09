<div>
    @if (session()->has('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if ($errorMessage)
        <div class="alert alert-danger">{{ $errorMessage }}</div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form wire:submit.prevent="submitLogin">
        <div class="form-group">
            <input class="form-control form-control-lg" wire:model.defer="email" type="email" placeholder="Email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group position-relative">
            <input class="form-control form-control-lg" wire:model.defer="password" type="{{ $passwordVisible ? 'text' : 'password'}}" placeholder="Password">
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
            <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;" wire:click="togglePasswordVisibility">
                <i class="fa {{ $passwordVisible ? 'fa-eye-slash' : 'fa-eye' }}"></i>
            </span>
        </div>

        <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #463426; border: 2px solid #463426;">Sign in</button>
    </form>
</div>
