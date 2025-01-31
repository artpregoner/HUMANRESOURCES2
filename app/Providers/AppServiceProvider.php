<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Ticket;
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
        // Share the ticket count across all views that use the 'layouts.app' layout
        View::composer('layouts.app', function ($view) {
            $view->with('ticketCount', Ticket::where('user_id', Auth::id())->count());
        });
    }
}
