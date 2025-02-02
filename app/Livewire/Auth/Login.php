<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $email, $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:8',
    ];

    public function login()
    {
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();
            $user = Auth::user();

            if ($user->role === 'employee') {
                return redirect()->route('home')->with('success', 'Welcome: ' . $user->name);
            } elseif ($user->role === 'hr') {
                return redirect()->route('hr2.index');
            } elseif ($user->role === 'admin') {
                return redirect()->route('admin');
            }
        }

        $this->addError('email', 'The provided credentials do not match our records.');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
