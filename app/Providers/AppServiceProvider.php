<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Ticket;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Blade::if('adminOrHr', function () {
            return Auth::check() && in_array(Auth::user()->role, ['admin', 'hr']);
        });
        Blade::if('adminOrHrOremployee', function () {
            return Auth::check() && in_array(Auth::user()->role, ['admin', 'hr', 'employee']);
        });
        // Check if the user is an Admin
        Blade::if('admin', function () {
            return Auth::check() && Auth::user()->role === 'admin';
        });

        // Check if the user is HR
        Blade::if('hr', function () {
            return Auth::check() && Auth::user()->role === 'hr';
        });

        // Check if the user is an Employee
        Blade::if('employee', function () {
            return Auth::check() && Auth::user()->role === 'employee';
        });

        View::composer('layouts.app', function ($view) {
            if (Auth::check()) {
                $user = Auth::user();
                $role = $user->role;

                if ($role === 'admin' || $role === 'hr') {
                    $view->with('ticketCount', Ticket::count());
                    $view->with('claimCount', Claim::count());
                } else {
                    $view->with('ticketCount', Ticket::where('user_id', $user->id)->count());
                    $view->with('claimCount', Claim::where('user_id', $user->id)->count());
                }
            }
        });
    }

}
