<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email;
    public $password;
    public $errorMessage;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
        'password.min' => 'Password must be at least 8 characters.',
    ];

    public function submitLogin()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            $user = Auth::user();
            session()->flash('success', 'Welcome: ' . $user->name);

            return redirect()->route(match ($user->role) {
                'employee' => 'home',
                'hr' => 'hr2.index',
                'admin' => 'admin.index',
                default => 'login',
            });
        }

        $this->errorMessage = 'The provided credentials do not match our records.';
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
