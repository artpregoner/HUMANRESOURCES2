<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    public function submitLogin(request $request){
        // $request->validate([
        //     'email' => 'required|email',
        //     'password' => 'required|min:8',
        // ], [
        //     'email.required' => 'Email is required.',
        //     'email.email' => 'Please enter a valid email address',
        //     'password.required' => 'Password is required.',
        //     'password.min' => 'Password must be at least 8 characters.',
        // ]);

        // if (Auth::attempt([
        //     'email' => $request->email,
        //     'password' => $request->password
        // ])) {
        //     $user = Auth::user();
        //     if ($user->role === 'employee') {
        //         return redirect()->route('home')->with('success', 'Welcome: ' . $user->name);
        //     } elseif ($user->role === 'hr') {
        //         return redirect()->route('hr2.index')->with('success', 'Welcome HR: ' . $user->name);
        //     } elseif ($user->role === 'admin') {
        //         return redirect()->route('admin.index')->with('success', 'Welcome Admin: ' . $user->name);
        //     }

        // }
        // If authentication fails, redirect back with an error message
        return redirect()->route('login')->with('error', 'The provided credentials do not match our records');
    }

    public function verifyNotice (){
        return view ('auth.verify-email');
    }

    public function verifyEmail (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/dashboard')->with('message', 'Email verified successfully!');
    }

    public function resendVerification (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

}
