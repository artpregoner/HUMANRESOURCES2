<div>
    <!-- resources/views/livewire/profile/update-password-form.blade.php -->
    <div class="row">
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
            <div class="section-block" id="cards">
                <h3 class="section-title">Update Password</h3>
                <p>Ensure your account is using a long, random password to stay secure.</p>
            </div>
        </div>
        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="updatePassword">
                        <div class="form-group">
                            <label for="inputCurrentPassword" class="col-form-label">Current Password</label>
                            <input id="inputCurrentPassword" type="password" wire:model="current_password" class="form-control form-control-lg">
                            @error('current_password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputNewPassword" class="col-form-label">New Password</label>
                            <input id="inputNewPassword" type="password" wire:model="password" class="form-control form-control-lg">
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="inputConfirmPassword" class="col-form-label">Confirm Password</label>
                            <input id="inputConfirmPassword" type="password" wire:model="password_confirmation" class="form-control form-control-lg">
                        </div>
                        <div class="row">
                            <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0">
                            </div>
                            <div class="col-sm-6 pl-0">
                                <p class="text-right">
                                    <button type="submit" class="btn btn-space btn-dark active">SAVE</button>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
