<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Ticket;
use App\Models\Claim;
use Illuminate\Support\Facades\Auth;

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
