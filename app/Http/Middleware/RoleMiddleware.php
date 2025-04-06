<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $roles)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in first.');
        }

        // Convert 'admin|hr' to array ['admin', 'hr']
        $roleArray = explode('|', $roles);

        if (in_array(Auth::user()->role, $roleArray)) {
            return $next($request);
        }

        // Redirect unauthorized users to their correct dashboard
        return redirect()->route(match (Auth::user()->role) {
            'admin' => 'admin.index',
            'hr' => 'hr2.index',
            'employee' => 'home',
            default => 'login',
        })->with('error', 'Unauthorized access.');
    }

}



// public function handle(Request $request, Closure $next, string $role)
// {
//     // If user is not authenticated, redirect to login with flash message
//     if (!Auth::check()) {
//         return redirect()->route('login')->with('error', 'Please log in first.');
//     }

//     // If user has the required role, continue the request
//     if (Auth::user()->role === $role) {
//         return $next($request);
//     }

//     // Redirect unauthorized users to their correct dashboard
//     return redirect()->route(match (Auth::user()->role) {
//         'admin' => 'admin.index',
//         'hr' => 'hr2.index',
//         'employee' => 'home',
//         default => 'login',
//     })->with('error', 'Unauthorized access.');
// }


// class RoleMiddleware
// {
//     public function handle(Request $request, Closure $next, string $role)
//     {
//         if (!Auth::check()) {
//             return redirect()->route('login')->with('error', 'Please log in first.');
//         }

//         if (Auth::check() && Auth::user()->role === $role) {
//             return $next($request);
//         }

//         return redirect()->route('login');
//     }
// }
