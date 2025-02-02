@extends('components.layouts.app')

    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center">
                <a href="#" class="navbar-brand">ECOMPANY</a>
                <span class="splash-description">Please enter your user information.adaa</span>
            </div>
            <div class="card-body">
                <form wire:submit.prevent="login" wire:navigate>
                    <div class="form-group">
                        <input for="email" class="form-control form-control-lg" wire:model="email" type="email" placeholder="Email" autocomplete="off" required>
                        @error('email') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group position-relative">
                        <input for="password" class="form-control form-control-lg" wire:model="password" type="password" placeholder="Password" required>
                        @error('password') <span class="text-danger text-xs">{{ $message }}</span> @enderror
                        <span id="togglePassword" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); cursor: pointer;">
                            <i class="fa fa-eye"></i>
                        </span>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color: #463426; border: 2px solid #463426;">Sign in</button>
                </form>
            </div>
        </div>
    </div>


