<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public $email, $password;
    public $errorMessage;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    protected $messages = [
        'email.required' => 'Email is required.',
        'email.email' => 'Please enter a valid email address.',
        'password.required' => 'Password is required.',
    ];

        // Redirect logged-in users inside mount() (NOT render)
    public function mount()
    {
        // Capture session flash messages
        $this->errorMessage = session('error', null);
        $this->email = session('login_email', ''); // Restore email from session


        if (Auth::check()) {
            return redirect()->to(match (Auth::user()->role) {
                'employee' => route('home'),
                'admin', 'hr' => route('admin.index'),
                default => route('login'),
            });
        }

    }

    public function lumasubmitLogin()
    {
        $this->validate();

        $key = 'login-attempts:' . request()->ip();
        $maxAttempts = 5; // Limit to 5 attempts
        $decaySeconds = 60; // Lockout time in seconds

        // Check if too many attempts
        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            throw ValidationException::withMessages([
                'email' => ['Too many login attempts. Please try again in ' . RateLimiter::availableIn($key) . ' seconds.'],
            ]);
        }

        // Record an attempt
        RateLimiter::hit($key, $decaySeconds);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {

            RateLimiter::clear($key);

            $user = Auth::user();

            /** @var \App\Models\User $user */
            $user->last_login = now();
            $user->save();

            session()->flash('success', 'Welcome: ' . $user->name);
            session()->forget('login_email'); // Clear email on successful login

            return redirect()->route(match ($user->role) {
                'employee' => 'home',
                'hr' => 'hr2.index',
                'admin' => 'admin.index',
                default => 'login',
            });
        }

        return redirect()->route('login')->with([
            'error' => 'The provided credentials do not match our records.',
            'login_email' => $this->email // Store email in session
        ]);
    }
    public function submitLogin()
    {
        $this->validate();

        $key = 'login-attempts:' . request()->ip() . ':' . $this->email;
        $maxAttempts = 5; // Limit to 5 attempts
        $decaySeconds = 60; // Lockout time in seconds

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            throw ValidationException::withMessages([
                'email' => ['Too many login attempts. Please try again in ' . RateLimiter::availableIn($key) . ' seconds.'],
            ]);
        }

        RateLimiter::hit($key, $decaySeconds);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate(); // Prevent session fixation
            RateLimiter::clear($key);

            $user = Auth::user();
            $user->last_login = now();
            $user->save();

            session()->flash('success', 'Welcome: ' . $user->name);
            session()->forget('login_email'); // Clear email on success

            return redirect()->route(match ($user->role) {
                'employee' => 'home',
                // 'hr' => 'hr2.index',
                'admin' , 'hr' => 'admin.index',
                default => 'login',
            });
        }

        return redirect()->route('login')->with([
            'error' => 'The provided credentials do not match our records.',
            'login_email' => $this->email // Store email in session
        ]);
    }


    public function render()
    {
        $key = 'login-attempts:' . request()->ip() . ':' . $this->email;
        $secondsRemaining = RateLimiter::availableIn($key);

        return view('livewire.auth.login', [
            'lockoutRemaining' => $secondsRemaining > 0 ? $secondsRemaining : null,
        ]);
    }

}
